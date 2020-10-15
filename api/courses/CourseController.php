<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

require('../db/databaseConnect.php');
require('./CourseQueries.php');

/*********************************************
 * Initialize Local Variables
 **********************************************/

$url = NULL;
$collection = NULL;
$serviceParam = NULL;
$service = NULL;
$subService = NULL;
$subServiceParam = NULL;

/*********************************************
 * Get URL
 **********************************************/

// Get and parse the server URL
$url = explode('/', trim(filter_input(INPUT_SERVER, 'REQUEST_URI'),'/'));

/*********************************************
 * -------- URL Path Naming --------
 * http://localhost/collection/{serviceParam}/service?subService={subServiceParam}
 * -------- Service Mapping --------
 * URL length [3] -> Collection
 * URL length [4] -> Collection, Service Param
 * URL length [5] -> Collection, Service Param, Service, Sub-Serivce, Sub-Serivce Param
 **********************************************/

switch (count($url)) {
    case 3:
        $collection = $url[2];
        $service = $collection;
        break;
    case 4:
        $collection = $url[2];
        $serviceParam = $url[3];
        $service = $serviceParam;
        break;
    case 5:
        $collection = $url[2];
        $serviceParam = $url[3];
        $service = $url[4];
        
        // Check the Service for a Sub-Service
        $pos = strpos($service, "?");
        if ($pos == TRUE) {
            $serviceExploded = explode("?", $service);
            $service = $serviceExploded[0];
            $subService = $serviceExploded[1];
            
            // Check the Sub-Service for a Sub-Service Parameter(s)
            $pos = strpos($subService, "=");
            if ($pos == TRUE) {
                $subServiceExploded = explode("=", $subService);
                $subService = $subServiceExploded[0];
                $subServiceParam = $subServiceExploded[1];
            }
        }
        break;
    default:
        $service = "error";
        break;
}

/*********************************************
 * Get request & data from user
 **********************************************/

// Prepare input
$input = json_decode(file_get_contents("php://input"));

// Check input GET/POST/SERVER for data, if data exists then decode it
$data = strtolower(filter_input(INPUT_POST, 'data'));
if ($data != NULL) {
    $data = $input->data;
}
elseif ($data == NULL) {
    $data = strtolower(filter_input(INPUT_GET, 'data'));
    if ($data != NULL) {
        $data = $input->data;
    }
    elseif ($data == NULL) {
        $data = strtolower(filter_input(INPUT_SERVER, 'data'));
        if ($data != NULL) {
            $data = $input->data;
        }
    }
}

/**********************************************
 * Validate whether data exists and assign a service to its respective GET/POST/DELETE/PUT
 **********************************************/

if (empty($input->data)) {
    $exists = FALSE;
}
else {
    $exists = TRUE;
}

if ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "POST") {
    if ($service == "courses" && $serviceParam == NULL && $subService == NULL && $subServiceParam == NULL) {
        $service = "insert";
    }
    else {
        $service = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    if ($service == "courses" && $serviceParam == NULL && $subService == NULL && $subServiceParam == NULL) {
        $service = "selectall";
    }
    elseif ($service == "courses" && $serviceParam != NULL && $subService == NULL && $subServiceParam == NULL) {
        $service = "select";
    }
    else {
        $service = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    if ($service == "courses" && $serviceParam != NULL && $subService == NULL && $subServiceParam == NULL) {
        $service = "update";
    }
    else {
        $service = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    if ($service == "courses" && $serviceParam != NULL && $subService == NULL && $subServiceParam == NULL) {
        $service = "delete";
    }
    else {
        $service = "error";
    }
}
else {
    $service = "error";
}

/**********************************************
 * Build and execute requested query
 **********************************************/

switch ($service) {
    case 'error':
        header('Accept: application/json, charset=utf-8');
        http_response_code(501);
        echo http_response_code().": Error, service not recognized";
        break;
    case 'select':
        // Get/check for service param
        if($serviceParam != NULL) {
            $course_id = $serviceParam;
            
            // Get results from SQL query
            $result = select($course_id);
        }
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        }
        else {
            http_response_code(404);
            echo http_response_code().": No course with id=$param found";
        }
        
        break;
    case 'update':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone_number;
        
        if ($serviceParam != NULL) {
            $course_id = $serviceParam;

            // Get the updated row count from the SQL query
            $result = update($course_name, $address, $phone, $course_id);
        }
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course updated successfully";
        }
        elseif ($result == 0) {
            header('Accept: application/json');
            http_response_code(204);
            echo http_response_code().": No changes were made";
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, course not updated";
        }
        break;
    case 'insert':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone_number;
        
        // Get the last inserted row number from SQL query
        $result = insert($course_name, $address, $phone);
        
        if ($result != 0) {
            http_response_code(201);
            echo http_response_code().": Course added successfully";
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, course not added";
        }
        break;
    case 'delete':
        // Get/check for service param
        if ($serviceParam != NULL) {
            $course_id = $serviceParam;

            // Get number of rows affected from SQL query
            $result = delete($course_id);
        }
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course deleted successfully";
        }
        else {
            http_response_code(404);
            echo http_response_code().": Error, course not deleted";
        }
        break;
    case "selectall":       
        // Get result from SQL query
        $result = selectall();

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            echo http_response_code().": No courses found";
        }
        break;      
}

/*********************************************
 * Troubleshooting
 **********************************************/

//echo "\n\n"."URL ";
//print_r($url);
//echo "\n"."HTTP Method: ".$_SERVER['REQUEST_METHOD'];
//echo "\n"."URL count: ".count($url)."\n";
//echo "Data exists (1=TRUE,''=FALSE): ".$exists."\n";
//if ($exists == "TRUE") {
//    echo "Data: "."\n";
//    print_r($input->data);
//}
//echo "Collection: ".$collection."\n";
//echo "Service Parameter: ".$serviceParam."\n";
//echo "Service: ".$service."\n";
//echo "Sub-Service: ".$subService."\n";
//echo "Sub-Service Param: ".$subServiceParam."\n";

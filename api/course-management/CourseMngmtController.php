<?php
/***********************
 * Cross-Origin Policy
************************/
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

require('../database-management/databaseConnect.php');
require('./CourseMngmtQueries.php');


/*********************************
 * Initialize Local Variables
*********************************/

$function = NULL;
$url = NULL;
$document = NULL;
$collection = NULL;
$collectionURI = NULL;
$storeURI = NULL;
$store = NULL;
$controller = NULL;
$filter = NULL;
$filterVal = NULL;


/*************
 * Get URL
*************/

// Get and parse the server URL
$url = explode('/', trim(filter_input(INPUT_SERVER, 'REQUEST_URI'),'/'));


/**************************************************************************************
 * -------- REST Resource Naming Templates --------
 * I.E.; http://localhost/GPTMS/api/document/collection/{URI}/store/controller
 * I.E.; http://localhost/GPTMS/api/document/collection?filter=value/{URI}/store/controller
 * -------- URI Indexing --------
 * URL length [3] -> Document
 * URL length [4] -> Collection
 * URL length [5] -> URI
 * URL length [6] -> Store
 * URL length [7] -> Controller
 * -------- REST Resource Naming Examples --------
 * Document
    * http://localhost/course-management
 * Collection
    * http://localhost/course-management/courses
        * -------- Query Component to Filter URI Collection --------
        * http://localhost/course-management/courses?course-name=Goodrich-Country-Club
 * Store
    * http://localhost/course-management/courses/{course_id}/employees
 * Controller
    * http://localhost/course-management/courses/{course_id}/employees/check-in
 * -------- Resource Options --------
 * Document => course-management
 * Collection => courses
 * URI => course_id
 * Store => 
 * Controller =>
***************************************************************************************/

switch (count($url)) {
    // I.E.; GPTMS/api/document
    case 3:
        $document = $url[2];
        break;
    // I.E.; GPTMS/api/document/collection
    case 4:
        $document = $url[2];
        $collection = $url[3];
        
        // Check Collecion for a Query Component
        // I.E.; GPTMS/api/document/collection?filter
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            // I.E.; GPTMS/api/document/collection?filter=filterVal
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        break;
    // I.E.; GPTMS/api/document/collection/collectionURI
    // --- OR ---
    // I.E.; GPTMS/api/document/collection/controller
    case 5:
        $document = $url[2];
        $collection = $url[3];
        
        // Check if URL index [4] is a controller name or URI numerical value
        if(is_numeric($url[4])) {
            $collectionURI = $url[4];
        }
        else {
            $controller = $url[4];
        }
        
        // Check Collecion for a Query Component
        // I.E.; GPTMS/api/document/collection?filter
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            // I.E.; GPTMS/api/document/collection?filter=filterVal
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        break;
    // I.E.; GPTMS/api/document/collection/collectionURI/store
    case 6:
        $document = $url[2];
        $collection = $url[3];
        $collectionURI = $url[4];
        $store = $url[5];
        
        // Check Collecion for a Query Component
        // I.E.; GPTMS/api/document/collection?filter/store
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            // I.E.; GPTMS/api/document/collection?filter=filterVal/store
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        break;
    // I.E.; GPTMS/api/document/collection/collectionURI/store/controller
    // --- OR ---
    // I.E.; GPTMS/api/document/collection/collectionURI/store/storeURI
    case 7:
        $document = $url[2];
        $collection = $url[3];
        $collectionURI = $url[4];
        $store = $url[5];
        
        // Check if URL index [6] is a controller name or URI numerical value
        if(is_numeric($url[6])) {
            $storeURI = $url[6];
        }
        else {
            $controller = $url[6];
        }
        
        // Check Collecion for a Query Component
        // I.E.; GPTMS/api/document/collection?filter/store/controller
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            // I.E.; GPTMS/api/document/collection?filter=filterVal/store/controller
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        break;
    default:
        $collection = "error";
        break;
}


/********************************
 * Get request & data from user
*********************************/

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


/*******************************************************************
 * Validate and assign a function(s) to each GET/POST/DELETE/PUT
********************************************************************/

if (empty($input->data)) {
    $exists = FALSE;
}
else {
    $exists = TRUE;
}

if ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "POST") {
    // GPTMS/api/course-management/courses
    if ($document == "course-management" && $collection == "courses" && $collectionURI == NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "insert";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    // GPTMS/api/course-management/courses
    if ($document == "course-management" && $collection == "courses" && $collectionURI == NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectall";
    }
    // GPTMS/api/course-management/courses/1
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "select";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/course-management/courses/1
    if ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "update";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    // GPTMS/api/course-management/courses/1
    if ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "delete";
    }
    else {
        $function = "error";
    }
}
else {
    $function = "error";
}


/**************************************************************
 * Build and execute requested controller function &  SQL query
**************************************************************/

switch ($function) {
    case 'error':
        header('Accept: application/json, charset=utf-8');
        http_response_code(501);
        echo http_response_code().": Error, service not recognized";
        break;
    case 'select':
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get results from SQL query
        $result = select($course_id);
        
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
        
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get the updated row count from the SQL query
        $result = update($course_name, $address, $phone, $course_id);
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course updated successfully";
        }
        // No changes were made (Acts as a "Save" function)
        elseif ($result === 0) {
            header('Accept: application/json');
            http_response_code(204);
            echo http_response_code();
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
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get number of rows affected from SQL query
        $result = delete($course_id);
        
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
//echo "Document: ".$document."\n";
//echo "Collection: ".$collection."\n";
//echo "Collection URI: ".$collectionURI."\n";
//echo "Store: ".$store."\n";
//echo "Store URI: ".$storeURI."\n";
//echo "Controller: ".$controller."\n";

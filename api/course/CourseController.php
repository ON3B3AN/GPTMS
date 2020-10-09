<?php
require('../db/databaseConnect.php');
require('../course/CourseQueries.php');

/*********************************************
 * Get request from user
 **********************************************/

// Initialize local variables
$param = NULL;
$result = NULL;
$service = NULL;
$collection = NULL;

// Request and parse the server URL to identify Collection
$url = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
$collection = $url[2];
echo "Collection: ".$collection."\n";

// Check if URL includes a Service and/or Service Parameters
if (count($url) == 4) {
    $service = $url[3];
    $pos = strpos($service, "?=");
    if ($pos == TRUE) {
        $service_url = explode("?=", $service);
        $service = $service_url[0];
        echo "Service: ".$service."\n";
        $param = $service_url[1];
        echo "Service Parameter: ".$param."\n";
    }
    elseif ($pos == FALSE) {
        echo "Service: ".$service."\n";
    }
}
elseif (count($url) == 3) {
    $service = NULL;
}

// Check input for HTTP method POST, and JSON decode it
$input = json_decode(file_get_contents("php://input"));
$data = strtolower(filter_input(INPUT_POST, 'data'));
$data = $input->data;
if ($data != NULL) {
    $data = $input->data;
}
// Check input for HTTP method GET, and JSON decode it
elseif ($data == NULL) {
    $data = strtolower(filter_input(INPUT_GET, 'data'));
    if ($data != NULL) {
        $data = $input->data;
    }
    // Set error case if input POST/GET data is NULL
    elseif ($data == NULL) {
        $service = 'error';
    }
}

/**********************************************
 * Build and execute requested query
 **********************************************/

switch ($service) {
    case 'error':
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        header('Accept: application/json, charset=utf-8');
        http_response_code(501);
        echo http_response_code().": Error, service not recognized";
        break;
    case 'select':
        // Get/check for service param
        if($param != NULL) {
            $course_id = $param;
            
            // Get results from SQL query
            $result = select($course_id);
        }
        
        if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        }
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            http_response_code(404);
            echo http_response_code().": No course with id=$param found";
        }
        
        break;
    case 'update':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone_number;
        
        if ($param != NULL && $param != "") {
            $course_id = $param;

            // Get the updated row count from the SQL query
            $result = update($course_name, $address, $phone, $course_id);
        }
        
        // Set universal header info
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        
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
        
        // Set universal header info
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        
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
        if ($param != NULL) {
            $course_id = $param;

            // Get number of rows affected from SQL query
            $result = delete($course_id);
        }
        
        // Set universal header info
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course deleted successfully";
        }
        else {
            http_response_code(404);
            echo http_response_code().": Error, course not deleted";
        }
        break;
    // Default SelectAll
    default:       
        // Get result from SQL query
        $result = selectall();

        if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            http_response_code(404);
            echo http_response_code().": No courses found";
        }
        break;      
}

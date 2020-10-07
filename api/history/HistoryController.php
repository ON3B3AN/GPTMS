<?php
require('../db/databaseConnect.php');
require('../history/HistoryQueries.php');

/*********************************************
 * Get request from user
 **********************************************/

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
    
switch ($service) {
    case 'error':
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        http_response_code(404);
        echo http_response_code().": Error, action not recognized";
        break;
    default:
        $user_id = $input->data->user_id;
        $result = history($user_id);
         if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            echo json_encode($result);
    
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('Accept: application/json, charset=utf-8');
            header('WWW-Authenticate: Basic; realm="Access to the landing page"');
            http_response_code(404);
            echo http_response_code().": No user history";
        }
        break;
        
}

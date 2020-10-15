<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
require('../db/databaseConnect.php');
require('./UserQueries.php');
require ('./Profile.php');


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
 * Validate and assign a service to its respective GET/POST/DELETE/PUT
 * A boolean converted to a string will be 1 for "true" and (empty) for "false"
 **********************************************/

if (empty($input->data)) {
    $exists = FALSE;
}
else {
    $exists = TRUE;
}

if ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "POST") {
    if ($service == "login" && $subService == NULL && $subServiceParam == NULL) {
        $service = "login";
    }
    elseif ($service == "signup" && $subService == NULL && $subServiceParam == NULL) {
        $service = "signup";
    }
    else {
        $service = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    if ($service == "history" && $subService == NULL && $subServiceParam == NULL) {
        $service = "history";
    }
    else {
        $service = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    $service = "error";
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    if ($service == "logout" && $subService == NULL && $subServiceParam == NULL) {
        $service = "logout";
    }
    else {
        $service = "error";
    }
}
else {
    $service = "error";
}

/**********************************************
 * Build and execute requested service & query
 **********************************************/

switch ($service) {
    case "error":
        header('Accept: application/json, charset=utf-8');
        http_response_code(501);
        echo http_response_code().": Error, service not recognized";
        break;
    case "login":
        // Get JSON data
        $email = $input->data->email;
        $pwd = $input->data->password;
        
        // Check if email is valid and password is not empty
        if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) && empty(trim($pwd)) === FALSE) {

            // Get result from SQL query
            $result = login($email, $pwd);
            
            if ($result != NULL && empty($result) === FALSE) {
                header('WWW-Authenticate: Basic; realm="Access to the landing page"');
                header('Content-Type: application/json, charset=utf-8');

                // Get user id from SQL query
                $user_id = $result["user_id"];

                // Start session
                session_start();
                
                // Set/Start session variable for user id
                $_SESSION["user"] = $user_id;

                // Check if session was set
                if (!isset($user_id)) {
                    break;
                }
                else {
                    // Return user data as JSON array
                    http_response_code(200);
                    echo json_encode($result);
                }
            }
        }
        else {
            header('Accept: application/json, charset=utf-8');
            header('WWW-Authenticate: Basic; realm="Access to the landing page"');
            http_response_code(401);
            echo http_response_code().": Login failed";
        }
        break;
    case "logout":
        session_start();
        session_unset();
        session_destroy();
        break;
    case "signup":
        // Get JSON data
        $fName = $input->data->first_name;
        $lName = $input->data->last_name;
        $phone = $input->data->phone;
        $email = $input->data->email;
        $pwd = $input->data->password;
        
        // Instantiate new Profile
        $profile = new Profile($fName, $lName, $phone, $email, $pwd);
        
        // Get result from SQL query
        $result = signup($fName, $lName, $email, $pwd, $phone);
        
        if ($result != NULL) {
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            http_response_code(201);
            echo http_response_code().": Profile created successfully";
        } 
        else {
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            header('Accept: application/json');
            http_response_code(500);
            echo http_response_code().": Error, profile not created";
        }
        break;
    case "history":
        // Get/check for service param
        if ($serviceParam != NULL) {
            $user_id = $serviceParam;
            
            // Get history from SQL query
            $result = historySelectAll($user_id);
        }
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            
            // Return history data as JSON array
            http_response_code(200);
            echo json_encode($result);
        } 
        else {
            header('Accept: application/json, charset=utf-8');
            http_response_code(500);
            echo http_response_code().": No user history";
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

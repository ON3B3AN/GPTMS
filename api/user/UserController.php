<?php
require('../db/databaseConnect.php');
require('./UserQueries.php');
require ('./Profile.php');

/*********************************************
 * Get URL
 **********************************************/

// Get and parse the server URL
$url = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

// -------- URL Mapping --------
// URL length [3] -> Collection
// URL length [4] -> Collection, Service
// URL length [5] -> Collection, Service, Service Param
// URL length [6] -> Collection, Service, Service Param, Sub-Serivce
// URL length [7] -> Collection, Service, Service Param, Sub-Serivce, Sub-Serivce Param

switch (count($url)) {
    case 3:
        $collection = $url[2];
        echo "Collection: ".$collection."\n";
        break;
    case 4:
        $collection = $url[2];
        echo "Collection: ".$collection."\n";
        $service = $url[3];
        echo "Service: ".$service."\n";
        break;
    case 5:
        $collection = $url[2];
        echo "Collection: ".$collection."\n";
        $service = $url[3];
        echo "Service: ".$service."\n";
        $serviceParam = $url[4];
        
        // Check the Service Parameter for a Sub-Service and/or Sub-Service Parameter(s)
        $pos = strpos($serviceParam, "?");
        if ($pos == TRUE) {
            $serviceParamExploded = explode("?", $serviceParam);
            $serviceParam = $serviceParamExploded[0];
            echo "Service Parameter: ".$serviceParam."\n";
            $subService = $serviceParamExploded[1];
            
            // Check the Sub-Service for a Sub-Service Parameter(s)
            $pos = strpos($subService, "=");
            if ($pos == TRUE) {
                $subServiceExploded = explode("=", $subService);
                $subService = $subServiceExploded[0];
                $subServiceParam = $subServiceExploded[1];
                echo "Sub-Service: ".$subService."\n";
                echo "Sub-Service Param: ".$subServiceParam."\n";
            }
            elseif ($pos == FALSE) {
                echo "Sub-Service: ".$subService."\n";
            }
        }
        elseif ($pos == FALSE) {
            echo "Service Parameter: ".$serviceParam."\n";
        }
        break;
    default:
        $service = NULL;
        break;
}

/*********************************************
 * Get request & data from user
 **********************************************/

// Prepare input
$input = json_decode(file_get_contents("php://input"));

// Check if data exists, if so decode it
$data = strtolower(filter_input(INPUT_POST, 'data'));
if ($data != NULL) {
    $data = $input->data;
}
elseif ($data == NULL) {
    $data = strtolower(filter_input(INPUT_GET, 'data'));
    $data = $input->data;
}

// Validate service for its respective GET/POST/DELETE/PUT
if (isset($data)) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($service == "login") {
            $service = "login";
        }
        elseif ($service == "signup") {
            $service = "signup";
        }
        else {
            $service = "error";
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
        if ($service == "history") {
            $service = "history";
        }
        else {
            $service = "error";
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {
        $service = "error";
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        if ($service == "logout") {
            $service = "logout";
        }
        else {
            $service = "error";
        }
    }
    else {
        $service = "error";
    }
}

/**********************************************
 * Build and execute requested service & query
 **********************************************/

switch ($service) {
    case "error":
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
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
            //echo $result;
            if ($result != NULL && empty($result) === FALSE) {
                header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
                header('Access-Control-Allow-Origin: *');
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
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
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
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            http_response_code(201);
            echo http_response_code().": Profile created successfully";
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            header('Accept: application/json');
            http_response_code(500);
            echo http_response_code().": Error, profile not created";
        }
        break;
    case "history":
        session_start();

        // Get/check for service param
        if ($serviceParam != NULL) {
            $user_id = $serviceParam;
            // Get history from SQL query
            $result = historySelectAll($user_id);
        }
        
        if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            
            // Return history data as JSON array
            http_response_code(200);
            echo json_encode($result);
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('Accept: application/json, charset=utf-8');
            http_response_code(500);
            echo http_response_code().": No user history";
        }
        break;
}

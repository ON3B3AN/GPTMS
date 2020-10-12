<?php
require('../db/databaseConnect.php');
require('../login/LoginQueries.php');

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

// Prepare input for JSON decode, and check input for HTTP method POST
$input = json_decode(file_get_contents("php://input"));
$data = strtolower(filter_input(INPUT_POST, 'data'));

// Validate collection or serivce for its respective GET/POST
if (isset($data) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if ($collection == "login") {
        $service = "login";
        $data = $input->data;
    }
}
elseif (isset($data) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if ($collection == "logout") {
        $service = "logout";
    }
}
else {
    $service = "error";
}

// Check if data exists, is so decode it
if ($data != NULL) {
    $data = $input->data;
}
else {
    $service = "error";
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
    default:
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
        header("Location: ../index.php");
        break;
}
>>>>>>> 4dcb2ef3f4ec061dc609023639e9f932f3b2796f

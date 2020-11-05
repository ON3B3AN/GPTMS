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
require('./UserMngmtQueries.php');
require('./Profile.php');

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
    * http://localhost/user-management
 * Collection
    * http://localhost/user-management/users
        * -------- Query Component to Filter URI Collection --------
        * http://localhost/user-management/users?first-name=John
 * Store
    * http://localhost/user-management/users/{user_id}/employees
 * Controller
    * http://localhost/user-management/users/{user_id}/employees/check-in
 * -------- Resource Options --------
 * Document => user-management
 * Collection => users
 * URI => user_id
 * Store => history
 * Controller => login, logout, signup
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
        
//        // Check if URL index [4] is a controller name or URI numerical value
//        if(is_numeric($url[4])) {
//            $collectionURI = $url[4];
//        }
//        else {
//            $controller = $url[4];
//        }
        
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
    // GPTMS/api/user-management/users/login
    if ($document == "user-management" && $collection == "users" && $controller == "login" && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "login";
    }
    // GPTMS/api/user-management/users
    elseif ($document == "user-management" && $collection == "users" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "signup";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    // GPTMS/api/user-management/users/1/history
    if ($document == "user-management" && $collection == "users" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "history" && $storeURI == NULL) {
        $function = "selectAllHistory";
    }
    // GPTMS/api/user-management/users
    elseif ($document == "user-management" && $collection == "users" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectAllUsers";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/user-management/users/1
    if ($document == "user-management" && $collection == "users" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "updateProfile";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    // GPTMS/api/user-management/users/logout
    if ($document == "user-management" && $collection == "users" && $controller == "logout" && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "logout";
    }
    // GPTMS/api/user-management/users/1
    elseif ($document == "user-management" && $collection == "users" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "deleteProfile";
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
                
                // Set session variable for user id, emplpoyee id, and employee level
                $_SESSION["user_id"] = $user_id;

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
            else {
                header('Accept: application/json, charset=utf-8');
                header('WWW-Authenticate: Basic; realm="Access to the landing page"');
                http_response_code(401);
                echo http_response_code().": Login failed. Incorrect email or password";
            }
        }
        else {
            header('Accept: application/json, charset=utf-8');
            header('WWW-Authenticate: Basic; realm="Access to the landing page"');
            http_response_code(401);
            echo http_response_code().": Login failed. Password or Email is not valid";
        }
        break;
    case "logout":
        session_start();
        session_unset();
        session_destroy();
        http_response_code(200);
        echo "Successfully Logged Off!";
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
    case "selectAllHistory":
        // Assign collection URI to user_id
        $user_id = $collectionURI;

        // Get history from SQL query
        $result = selectAllHistory($user_id);

        // Return history data
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
    case "updateUser":
        // Get JSON data
        $first_name = $input->data->first_name;
        $last_name = $input->data->last_name;
        $email = $input->data->email;
        $password = $input->data->password;
        $checkPassword = $input->data->check_password;
        $phone = $input->data->phone;
        
        // Validate passwords match
        if($password != $checkPassword) {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, passwords didn't match";
        }
        else {
            // Assign collection URI to user_id
            $user_id = $collectionURI;

            // Get the updated row count from the SQL query
            $result = updateUser($first_name, $last_name, $email, $password, $phone, $user_id);
            
            if ($result >= 1) {
                http_response_code(200);
                echo http_response_code().": Profile updated successfully";
            }
            // No changes were made (Acts as a "Save" function)
            elseif ($result === 0) {
                http_response_code(204);
                echo http_response_code();
            }
            else {
                header('Accept: application/json');
                http_response_code(404);
                echo http_response_code().": Error, profile not updated";
            }
        }
        break;
    case "deleteUser":
        // Assign collection URI to user_id
        $user_id = $collectionURI;

        // Get number of rows affected from SQL query
        $result = deleteUser($user_id);
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Profile deleted successfully";
        }
        else {
            http_response_code(404);
            echo http_response_code().": Error, profile not deleted";
        }
        break;
    case "selectAllUsers":
        // Get result from SQL query
        $result = selectAllUsers();

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);

            // Return user data as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            echo http_response_code().": No users found";
        }
        break;
}


/********************
 * Troubleshooting
*********************/

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

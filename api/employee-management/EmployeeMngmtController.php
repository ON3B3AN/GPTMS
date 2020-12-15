<?php
/***********************
 * Cross-Origin Policy
************************/
error_reporting(0);

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
require('./EmployeeMngmtQueries.php');


/*****************************************
 * Declare and Initialize Local Variables
*****************************************/

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
 * -------- URI Case Templates --------
 * Case 4 -> http://localhost/GPTMS/api/document/collection
 * Case 4 -> http://localhost/GPTMS/api/document/collection?filter={filterVal}
 * Case 5 -> http://localhost/GPTMS/api/document/collection/{collectionURI}
 * Case 5 -> http://localhost/GPTMS/api/document/collection/controller
 * Case 6 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store
 * Case 7 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store/{storeURI}
 * Case 7 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store/controller
 * -------- URI Resource Indexing --------
 * URL length [3] -> Document
 * URL length [4] -> Collection w/ OR w/o Query Component
 * URL length [5] -> Collection URI OR Controller
 * URL length [6] -> Store
 * URL length [7] -> Store URI OR Controller
 * -------- Resource Options --------
 * Document => employee-management
 * Collection => employees
 * Collection URI => user_id
 * Store => N/A
 * Store URI => N/A
 * Controller => N/A
***************************************************************************************/

// Switch cases based on URI length
switch (count($url)) {
    case 4:
        $document = $url[2];
        $collection = $url[3];
        
        // Check Collecion for a Query Component
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        break;
    case 5:
        $document = $url[2];
        $collection = $url[3];
        
        // Check Collecion for a Query Component
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        
        // Check if URL index [4] is a controller name or URI numerical value
        if(is_numeric($url[4])) {
            $collectionURI = $url[4];
        }
        else {
            $controller = $url[4];
        }     
        break;
    case 6:
        $document = $url[2];
        $collection = $url[3];
        
        // Check Collecion for a Query Component
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Filter for a Value(s)
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        else {
            $collectionURI = $url[4];
            $store = $url[5];
        }
        break;
    case 7:
        $document = $url[2];
        $collection = $url[3];
        
        // Check Collecion for a Query Component
        $pos = strpos($collection, "?");
        if ($pos == TRUE) {
            $collectionExploded = explode("?", $collection);
            $collection = $collectionExploded[0];
            $filter = $collectionExploded[1];
            
            // Check the Query for a Value(s)
            $pos = strpos($filter, "=");
            if ($pos == TRUE) {
                $filterExploded = explode("=", $filter);
                $filter = $filterExploded[0];
                $filterVal = $filterExploded[1];
            }
        }
        else {
            $collectionURI = $url[4];
            $store = $url[5];
            
            // Check if URL index [6] is a controller name or URI numerical value
            if(is_numeric($url[6])) {
                $storeURI = $url[6];
            }
            else {
                $controller = $url[6];
            }
        }
        break;
    default:
        $function = "error";
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
    // GPTMS/api/employee-management/employees
    if ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "insertEmployee";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    // GPTMS/api/employee-management/employees
    if ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectAllEmployees";
    }
    // GPTMS/api/employee-management/employees/1
    elseif ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectEmployee";
    }
    // GPTMS/api/employee-management/employees?course_id=1
    elseif ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI == NULL && $filter == "course_id" && $filterVal != NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectEmployeeByCourse";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/employee-management/employees/1
    if ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "updateEmployee";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
   // GPTMS/api/employee-management/employees/1
    if ($document == "employee-management" && $collection == "employees" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "deleteEmployee";
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
        $msg["message"] = http_response_code().": Error, service not recognized";
        echo json_encode($msg);
        break;
    case "insertEmployee":
        // Get JSON data
        $user_id = $input->data->User_user_id;
        $course_id = $input->data->Course_course_id;
        $security_lvl = $input->data->security_lvl;
        
        // Get result from SQL query
        $result = insertEmployee($user_id, $course_id, $security_lvl);
        
        if ($result != NULL) {
            http_response_code(201);
            $msg["message"] = http_response_code().": Employee created successfully";
            echo json_encode($msg);
        } 
        else {
            header('Accept: application/json');
            http_response_code(500);
            $msg["message"] = http_response_code().": Error, employee not created";
            echo json_encode($msg);
        }
        break;
    case "updateEmployee":
        // Get JSON data
        $course_id = $input->data->Course_course_id;
        $security_lvl = $input->data->security_lvl;
        
        // Assign collection URI to emp_id
        $user_id = $collectionURI;

        // Get the updated row count from the SQL query
        $result = updateEmployee($course_id, $security_lvl, $user_id);

        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Employee updated successfully";
            echo json_encode($msg);
        }
        // No changes were made (Acts as a "Save" function)
        elseif ($result === 0) {
            http_response_code(204);
            $msg["message"] = http_response_code().": No changes made";
            echo json_encode($msg);
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, employee not updated";
            echo json_encode($msg);
        }
        
        break;
    case "deleteEmployee":
        // Assign collection URI to emp_id
        $emp_id = $collectionURI;

        // Get number of rows affected from SQL query
        $result = deleteEmployee($emp_id);
        
        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Employee deleted successfully";
            echo json_encode($msg);
        }
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, employee not deleted";
            echo json_encode($msg);
        }
        break;
    case "selectAllEmployees":
        // Get result from SQL query
        $result = selectAllEmployees();

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);

            // Return user data as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": No employees found";
            echo json_encode($msg);
        }
        break;
    case "selectEmployeeByCourse":
        // Check if filter = course id
        if ($filter == "course_id") {
            //Get course id from URL
            $course_id = $filterVal;
        }
        
        // Get result from SQL query
        $result = selectEmployeeByCourse($course_id);

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);

            // Return user data as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": No employees found";
            echo json_encode($msg);
        }
        break;
    case "selectEmployee":
        // Get employee id from URL
        $emp_id = $collectionURI;
        
        // Get result from SQL query
        $result = selectEmployee($emp_id);
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);

            // Return employee data as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": No employees found";
            echo json_encode($msg);
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

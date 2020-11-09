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
 * -------- REST URI Case Templates --------
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
 * Document => course-management
 * Collection => courses
 * Collection URI => course_id
 * Store => holes
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
    // GPTMS/api/course-management/courses
    if ($document == "course-management" && $collection == "courses" && $collectionURI == NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "insertCourse";
    }
    // GPTMS/api/course-management/courses/1/holes
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == "holes" && $storeURI == NULL) {
        $function = "selectHoles";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    // GPTMS/api/course-management/courses
    if ($document == "course-management" && $collection == "courses" && $collectionURI == NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectAllCourses";
    }
    // GPTMS/api/course-management/courses/1
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectCourse";
    }
    // GPTMS/api/course-management/courses/1/holes
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == "holes" && $storeURI == NULL) {
        $function = "selectTees";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/course-management/courses/1
    if ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "updateCourse";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    // GPTMS/api/course-management/courses/1
    if ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "deleteCourse";
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
    case 'selectCourse':
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get results from SQL query
        $result = selectCourse($course_id);
        
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
    case 'updateCourse':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone_number;
        
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get the updated row count from the SQL query
        $result = updateCourse($course_name, $address, $phone, $course_id);
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course updated successfully";
        }
        // No changes were made (Acts as a "Save" function)
        elseif ($result === 0) {
            http_response_code(204);
            echo http_response_code();
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, course not updated";
        }
        break;
    case 'insertCourse':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone_number;
        
        // Get the last inserted row number from SQL query
        $result = insertCourse($course_name, $address, $phone);
        
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
    case 'deleteCourse':
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get number of rows affected from SQL query
        $result = deleteCourse($course_id);
        
        if ($result >= 1) {
            http_response_code(200);
            echo http_response_code().": Course deleted successfully";
        }
        else {
            http_response_code(404);
            echo http_response_code().": Error, course not deleted";
        }
        break;
    case "selectAllCourses":       
        // Get result from SQL query
        $result = selectallCourses();

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
    case "selectHoles":
        // Get JSON data
        $start_hole = $input->data->start_hole;
        $end_hole = $input->data->end_hole;
        
        // Assign collection URI to course_id
        $course_id = $collectionURI;
            
        // Get result from SQL query
        $result = selectHoles($course_id, $start_hole, $end_hole);

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        } 
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, no holes found";
        }
        break;
    case "selectTees":
        $course_id = $collectionURI;
        
        // Start session
        session_start();
        
        // Store course id into session variable
        $_SESSION["course_id"] = $course_id;
        
        // Get tees from SQL query
        $result = selectTees($course_id);
        
        if(!empty($result)) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return tee data as JSON array
            echo json_encode($result);
        }
        else {
            http_response_code(404);
            echo http_response_code().": Error, no tees found";
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

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
        $function = "selectHoles";
    }
    // GPTMS/api/course-management/courses/1/tees
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == "tees" && $storeURI == NULL) {
        $function = "selectTees";
    }
    // GPTMS/api/course-management/courses/1/records
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == "records" && $storeURI == NULL) {
        $function = "selectCourseRecords";
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
    // GPTMS/api/course-management/courses/1/holes
    elseif ($document == "course-management" && $collection == "courses" && $collectionURI != NULL && $controller == NULL && $filter == NULL && $filterVal == NULL && $store == "holes" && $storeURI == NULL) {
        $function = "updateHoles";
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
        $msg["message"] = http_response_code().": Error, service not recognized";
        echo json_encode($msg);
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
            $msg["message"] = http_response_code().": No course with id=$collectionURI found";
            echo json_encode($msg);
        }
        break;
    case 'updateCourse':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone;
            
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get the updated row count from the SQL query
        $result = updateCourse($course_name, $address, $phone, $course_id);
        
        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Course updated successfully";
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
            $msg["message"] = http_response_code().": Error, course not updated";
            echo json_encode($msg);
        }
        break;
    case 'insertCourse':
        // Get JSON data
        $course_name = $input->data->course_name;
        $address = $input->data->address;
        $phone = $input->data->phone;
        
        // Get the last inserted row number from SQL query
        $result = insertCourse($course_name, $address, $phone);
        
        if ($result != 0) {
            http_response_code(201);
            $msg["message"] = http_response_code().": Course added successfully";
            echo json_encode($msg);
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, course not added";
            echo json_encode($msg);
        }
        break;
    case 'deleteCourse':
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get number of rows affected from SQL query
        $result = deleteCourse($course_id);
        
        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Course deleted successfully";
            echo json_encode($msg);
        }
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, course not deleted";
            echo json_encode($msg);
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
            $msg["message"] = http_response_code().": No courses found";
            echo json_encode($msg);
        }
        break;
    case "selectHoles":
        // Assign collection URI to course_id
        $course_id = $collectionURI;
            
        // Get result from SQL query
        $result = selectHoles($course_id);

        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        } 
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, no holes found";
            echo json_encode($msg);
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
            $msg["message"] = http_response_code().": Error, no tees found";
            echo json_encode($msg);
        }
        break;
    case "selectCourseRecords":
        // Assign collection URI to course_id
        $course_id = $collectionURI;

        // Get results from SQL query
        $result = selectCourseRecords($course_id);
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return course data as JSON array
            echo json_encode($result);
        }
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": No course records with id=$collectionURI found";
            echo json_encode($msg);
        }
        break;
        // Updates Holes and Tees data
        case "updateHoles":
        $hole_result = 0;
        $tee_result = 0;
        $course_id = $collectionURI;
        
        //array of numbers 1-18. Used to keep track of which holes were
        //deleted on the front end, so that means they are to be deleted
        //from the database.
        $holesToDelete = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18];
        // Iterate through holes
        $i = 1;
        while ($i < 30) {
            $hole = "hole".strval($i);
            if ($input->data->$hole->hole_number != "") {
                try {
                    // Get JSON data 
                    $hole_number = $input->data->$hole->hole_number;
                    $mens_par = $input->data->$hole->mens_par;
                    $womens_par = $input->data->$hole->womens_par;
                    $mens_handicap = $input->data->$hole->mens_handicap;
                    $womens_handicap = $input->data->$hole->womens_handicap;
                    $perimeter_type = $input->data->$hole->perimeter->type;
                    $perimeter_coordinates = $input->data->$hole->perimeter->coordinates;
                    for ($c = 0; $c < count($perimeter_coordinates[0]); $c++){
                        $coordinates[] = "[ ".$perimeter_coordinates[0][$c][0].", ".$perimeter_coordinates[0][$c][1]." ]";
                    }
                    $perimeter = ("{ \"type\": \"".$perimeter_type."\", \"coordinates\": [ [ ".implode(", ", $coordinates)." ] ] }");
                    $hole_result += updateHoles($mens_par, $womens_par, $hole_number, $mens_handicap, $womens_handicap, $perimeter, $course_id);
                    print_r($hole_result);
                    //removes a hole number from the array if that number was not
                    //deleted on the front end
                    for ($j = 0; $j < sizeof($holesToDelete); $j++) {
                        if ($hole_number == $holesToDelete[$j]){
                            unset($holesToDelete[$j]);
                        }
                    }
                    
                    $holesToDelete = array_values($holesToDelete);
                    
                    //kill part for the kill and fill. Kills all tees for a given hole
                    deleteTees($course_id, $hole_number);
                    
                    // Iterate through tees
                    $x = 1;
                    while ($x < 8) {
                        $tee = "tee".strval($x);
                        if ($input->data->$hole->tees->$tee->tee_name != "") {
                            try {
                                // Get JSON data
                                $distance_to_pin = $input->data->$hole->tees->$tee->distance_to_pin;
                                $tee_name = $input->data->$hole->tees->$tee->tee_name;
                                $tee_result += insertTees($course_id, $hole_number, $distance_to_pin, $tee_name);
                            } catch (Exception $ex) {
                                continue;
                            }
                        }
                        $x += 1;
                    }
                } catch (Exception $ex) {
                    continue;
                }
            }
            $i += 1;
        }

        //if there is any holes that were deleted on front end
        //this finds which ones by hole number and course number and deletes them
        if(sizeof($holesToDelete) > 0){
            for ($j = 0; $j < sizeof($holesToDelete); $j++) {
//                $holes_deleted = implode(",", $holesToDelete);
                deleteHoles($course_id, $holesToDelete[$j]);
            }
        }
        
        $result = $hole_result + $tee_result;
        
        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = "Holes and tees updated successfully!";
            echo json_encode($msg);
        }
        // No changes were made (Acts as a "Save" function)
        elseif ($result == 0) {
            http_response_code(204);
            $msg["message"] = "No changes made";
            echo $msg;
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = "Error, holes or tees not updated";
            echo json_encode($msg);
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

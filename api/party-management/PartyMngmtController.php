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
require('./PartyMngmtQueries.php');
require('../course-management/CourseMngmtQueries.php');
require('../user-management/UserMngmtQueries.php');


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
 * Document => party-management
 * Collection => parties
 * Collection URI => party_id, course_id
 * Store => scores
 * Store URI => N/A
 * Controller => start-round
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
    // GPTMS/api/party-management/parties
    if ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "insertParty";
    }
    // GPTMS/api/party-management/parties/1/scores
    elseif ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
        $function = "insertScore";
    }
    // GPTMS/api/party-management/parties/1/rounds
    elseif ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "rounds" && $storeURI == NULL) {
        $function = "startRound";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    // GPTMS/api/party-management/parties?course_id=1
    if ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI == NULL && $filter != NULL && $filterVal != NULL && $store == NULL && $storeURI == NULL) {
        $function = "selectActiveParties";
    }
    // GPTMS/api/party-management/parties/1/request-services
    elseif ($document == "party-management" && $collection == "parties" && $controller == "request-services" && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "requestServices";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/party-management/parties/1/scores
    if ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
        $function = "updateScore";
    }
    // GPTMS/api/party-management/parties/1/coordinates
    elseif ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "coordinates" && $storeURI == NULL) {
        $function = "updatePartyCoordinates";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/party-management/parties/1
    if ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "endParty";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "DELETE") {
    $function = "error";
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
    case "insertParty":
        $handicap = $input->data->handicap;
        $email = $input->data->email;
        $course_id = $input->data->course_id;
        $size = $input->data->size;
        $party_size = (int)$size;
        $longitude = $input->data->longitude;
        $latitude = $input->data->latitude;
        $golf_cart = $input->data->golf_cart;
        
        // Parse emails from data object array
        $user_emails = explode(",", $email);
        
        // Check if the user exists by email
        foreach ($user_emails as &$user_email) {
            $user_result = selectUserByEmail($user_email);
        }
                
        if ($user_result != NULL) {
            // Get party id from SQL query
            $party_id = insertParty($course_id, $size, $longitude, $latitude, $golf_cart);

            $result_array = array();

            // Insert players into the newly created party
            for($i = 0; $i < $party_size; $i++) {
                $user_id_object = selectUserByEmail($user_emails[$i]);
                $user_id = (string)$user_id_object["user_id"];            
                $result = insertPlayer($user_id, $party_id, $handicap);
                array_push($result_array, $result);
            }

            if (count($result_array) != 0) {
                http_response_code(200);
                echo json_encode($party_id);
            }
            else {
                header('Accept: application/json');
                http_response_code(404);
                $msg["message"] = http_response_code().": Error, player not added";
                echo json_encode($msg);
            } 
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, user DNE";
            echo json_encode($msg);
        }   
        break;
    case "insertScore":
        $hole_id = $input->data->Hole_hole_id;
        $user_id = $input->data->Player_User_user_id;
        $party_id = $collectionURI;
        $stroke = $input->data->stroke;
        $total_score = $input->data->total_score;
        
        // Get results from SQL query
        $result = insertScore($hole_id, $user_id, $party_id, $stroke, $total_score);
        
        if ($result != 0) {
            http_response_code(201);
            $msg["message"] = http_response_code().": Score added successfully";
            echo json_encode($msg);
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, score not added";
            echo json_encode($msg);
        }
        break;
    case "updateScore":
        $stroke = $input->data->stroke;
        $total_score = $input->data->total_score;
        $hole_id = $input->data->Hole_hole_id;
        $user_id = $input->data->Player_User_user_id;
        $party_id = $collectionURI;
        
        // Get results from SQL query
        $result = updateScore($stroke, $total_score, $hole_id, $user_id, $party_id);
        
        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Score updated successfully";
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
            $msg["message"] = http_response_code().": Error, score not updated";
            echo json_encode($msg);
        }
        break;
    case "selectActiveParties":
        // Check if collection filter is course id and assign value
        if($filter == "course_id") {
            $course_id = $filterVal;
        }
        
        // Get results from SQL query
        $result = selectActiveParties($course_id);
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return active parties as JSON array
            echo json_encode($result);
        } 
        else {
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, no active parties found";
            echo json_encode($msg);
        }
        break;
    case "startRound":
        $party_id = $collectionURI;
        $course_id = $input->data->course_id;
        $start_hole = $input->data->start_hole;
        $end_hole = $input->data->end_hole;
        
        // Get results from SQL query
        $party_info = selectParty($party_id);
        unset($party_info["Course_course_id"]);
        $course_info = selectCourse($course_id);
        $hole_info = selectRangeOfHoles($course_id, $start_hole, $end_hole);
        unset($hole_info["Course_course_id"]);
        $tee_info = selectTees($course_id);
        
        foreach ($hole_info as &$hole) {
            $hole['tees'] = array_values(array_filter($tee_info, function($v) use ($hole) {
                return ($v['hole_number'] == $hole['hole_number']);
            }));
        }
        
        $course_info['holes'] = $hole_info;
        
        $result_array = new ArrayObject(array($party_info, $course_info));
        
        if ($result_array != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return game round data as JSON array
            echo json_encode($result_array);
        } 
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, no round started";
            echo json_encode($msg);
        }
        break;
    case "requestServices":
        $party_id = $collectionURI;
        http_response_code(200);
        $msg["message"] = http_response_code().": Services have been successfully requested!";
        echo json_encode($msg);
        break;
    case "updatePartyCoordinates":
        // Get JSON data
        $longitude = $input->data->longitude;
        $latitude = $input->data->latitude;
        
        // Assign collection URI to party_id
        $party_id = $collectionURI;

        // Get the updated row count from the SQL query
        $result = updatePartyCoordinates($party_id, $longitude, $latitude);

        if ($result >= 1) {
            http_response_code(200);
            $msg["message"] = http_response_code().": Party coordinates updated successfully";
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
            $msg["message"] = http_response_code().": Error, party coordinates not updated";
            echo json_encode($msg);
        }
        break;
    case "endParty":
        $party_id = $collectionURI;
        
        // Get results from SQL query
        $result = updateParty($party_id);
        
        if ($result != 0) {
            http_response_code(201);
            $msg["message"] = http_response_code().": Party updated successfully";
            echo json_encode($msg);
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            $msg["message"] = http_response_code().": Error, party not updated";
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

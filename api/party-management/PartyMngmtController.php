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
 * Collection => games
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
        $function = "insertPlayer";
    }
    // GPTMS/api/party-management/parties/1/scores
    elseif ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
        $function = "insertScore";
    }
    // GPTMS/api/party-management/parties/start-round
    elseif ($document == "party-management" && $collection == "parties" && $controller == "start-round" && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "startRound";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    $function = "error";
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/party-management/parties/1/scores
    if ($document == "party-management" && $collection == "parties" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
        $function = "updateScore";
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
        echo http_response_code().": Error, service not recognized";
        break;
    case 'insertPlayer':
        // Assign collection URI to course_id
        $user_id = $input->data->user_id;
        $handicap = $input->data->handicap;
        $course_id = $input->data->course_id;
        $size = $input->data->size;
        $longitude = $input->data->longitude;
        $latitude = $input->data->latitude;
        $golf_cart = $input->data->golf_cart; 

        // Get results from SQL query
        $result = insertPlayer($user_id, $handicap, $course_id, $size, $longitude, $latitude, $golf_cart);
        
        if ($result != 0) {
            http_response_code(200);
            echo http_response_code()." Player and Party added successfully!";
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, player and party not added";
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
            echo http_response_code().": Score added successfully";
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, score not added";
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
            echo http_response_code().": Score updated successfully";
        }
        // No changes were made (Acts as a "Save" function)
        elseif ($result === 0) {
            http_response_code(204);
            echo http_response_code();
        }
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, score not updated";
        }
        break;
    case "player-locations":
        $course_id = $collectionURI;
        
        
        break;
    case "startRound":
        $course_id = $input->data->course_id;
        $start_hole = $input->data->start_hole;
        $end_hole = $input->data->end_hole;
        
        // Get results from SQL query
        $result = startRound($course_id, $start_hole, $end_hole);
        
        if ($result != NULL) {
            header('Content-Type: application/json, charset=utf-8');
            http_response_code(200);
            
            // Return game round data as JSON array
            echo json_encode($result);
        } 
        else {
            header('Accept: application/json');
            http_response_code(404);
            echo http_response_code().": Error, no game round found";
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

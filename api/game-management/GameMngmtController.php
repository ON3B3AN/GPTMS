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
require('./GameMngmtQueries.php');


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
    * http://localhost/game-management
 * Collection
    * http://localhost/game-management/games
        * -------- Query Component to Filter URI Collection --------
        * http://localhost/game-management/games?first-name=John
 * Store
    * http://localhost/game-management/games/{user_id}/employees
 * Controller
    * http://localhost/game-management/games/{user_id}/employees/check-in
 * -------- Resource Options --------
 * Document => game-management
 * Collection => games
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
    // GPTMS/api/game-management/games
    if ($document == "game-management" && $collection == "games" && $controller == NULL && $collectionURI == NULL && $filter == NULL && $filterVal == NULL && $store == NULL && $storeURI == NULL) {
        $function = "insertPlayer";
    }
    // GPTMS/api/game-management/games/1/scores
    elseif ($document == "game-management" && $collection == "games" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
        $function = "insertScore";
    }
    else {
        $function = "error";
    }
}
elseif ($exists == FALSE && $_SERVER['REQUEST_METHOD'] == "GET") {
    $function = "error";
}
elseif ($exists == TRUE && $_SERVER['REQUEST_METHOD'] == "PUT") {
    // GPTMS/api/game-management/games/1/scores
    if ($document == "game-management" && $collection == "games" && $controller == NULL && $collectionURI != NULL && $filter == NULL && $filterVal == NULL && $store == "scores" && $storeURI == NULL) {
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
            echo http_response_code()." Player and Party added sucessfully!";
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
        $party_id = $input->data->Player_Party_party_id;
        
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

<?php

require('../db/databaseConnect.php');
require('../history/HistoryQueries.php');
require ('../profile/Profile.php');

/*********************************************
 * Get request from user
 **********************************************/

$input = json_decode(file_get_contents("php://input"));
$action = strtolower(filter_input(INPUT_POST, 'action'));
$action = $input->action;

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'error';
    }
} 
    
switch ($action) {
    case 'history' :
        $user_id = $input->data->user_id;
        $result = history($user_id);
         if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            echo json_encode($result);
    
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('Accept: application/json, charset=utf-8');
            header('WWW-Authenticate: Basic; realm="Access to the landing page"');
            http_response_code(401);
            echo http_response_code().": No user history";
        }
        break;
    case 'error':
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        http_response_code(501);
        echo http_response_code().": Error, action not recognized";
        break;
    }

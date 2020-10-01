<?php
require('../db/databaseConnect.php');
require('./profileQueries.php');

/*********************************************
 * Get request from user
 **********************************************/

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = '';
    }
}

/**********************************************
 * Build and execute requested query
 **********************************************/

switch ($action) {
    case 'login':
        
        // get row
        $email = filter_input(INPUT_POST, 'email');
        $pwd = filter_input(INPUT_POST, 'password');
        $result = login($email, $pwd);
        
        if ($result != NULL) {
            header('Content-Type: application/json;charset=UTF-8');
            echo json_encode($result);
        } 
        else {
            header('WWW-Authenticate: Basic;realm="Access to the landing page";charset=UTF-8');
            echo http_response_code(401);
        }
        break;
        
}

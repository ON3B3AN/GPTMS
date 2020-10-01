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
        $action = 'login';
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
        
        if ($result == NULL) {
            http_response_code(401);
        } 
        else {
            header('Content-Type: application/json;charset=utf-8');
            echo json_encode($result);
        }
        break;
        
}

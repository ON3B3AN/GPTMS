<?php
require('../db/databaseConnect.php');
require('./profileQueries.php');
require ('./User.php');

/*********************************************
 * Get request from user
 **********************************************/

$action = strtolower(filter_input(INPUT_POST, 'action'));
$input = json_decode(file_get_contents("php://input"));

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'login';
    }
}

$action = $input->action;

/**********************************************
 * Build and execute requested query
 **********************************************/

switch ($action) {
    case 'login':
        // get row
        $email = $input->data->email;
        $pwd = $input->data->password;

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
    case 'signup':
        $fName = $input->data->firstname;
        $lName = $input->data->lastname;
        $phone = $input->data->phone;
        $email = $input->data->email;
        $pwd = $input->data->password;
        $user = new User($fName, $lName, $phone, $email, $pwd);
        $result = signup($user);
        
        if ($result != NULL) {
            header('WWW-Authenticate: Basic;realm="Access to the landing page";charset=UTF-8');
            echo http_response_code(201);
        } 
        else {
            header('WWW-Authenticate: Basic;realm="Access to the landing page";charset=UTF-8');
            echo http_response_code(501);
        }
        break;
        
}

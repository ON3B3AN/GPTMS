<?php
require('../db/databaseConnect.php');
require('../signup/SignupQueries.php');
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

/**********************************************
 * Build and execute requested query
 **********************************************/

switch ($action) {
    case 'signup':
        $fName = $input->data->firstname;
        $lName = $input->data->lastname;
        $phone = $input->data->phone;
        $email = $input->data->email;
        $pwd = $input->data->password;
        //$profile = new Profile($fName, $lName, $phone, $email, $pwd);
        $result = signup($fName, $lName, $email, $pwd, $phone);
        
        if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            http_response_code(201);
            echo http_response_code().": Profile created successfully";
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
            header('WWW-Authenticate: Basic;realm="Access to the landing page"');
            header('Accept: application/json');
            http_response_code(501);
            echo http_response_code().": Error, profile not created";
        }
        break;
    case 'error':
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
        http_response_code(501);
        echo http_response_code().": Error, action not recognized";
        break;
}

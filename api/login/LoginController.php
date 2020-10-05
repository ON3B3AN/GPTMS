<?php
require('../db/databaseConnect.php');
<<<<<<< HEAD
require('../profile/ProfileQueries.php');
=======
require('../login/LoginQueries.php');
>>>>>>> 53d437eed948d17a5589861db637be03e6dc7328

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
    case 'login':
        // get row
        $email = $input->data->email;
        $pwd = $input->data->password;

        $result = login($email, $pwd);

        if ($result != NULL) {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json, charset=utf-8');
            echo json_encode($result);
        } 
        else {
            header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
            header('Access-Control-Allow-Origin: *');
<<<<<<< HEAD
            header('Accept: application/json, charset=utf-8');
            header('WWW-Authenticate: Basic; realm="Access to the landing page";charset=UTF-8');
            http_response_code(401);
            echo http_response_code().": Login failed";
=======
            header('WWW-Authenticate: Basic; realm="Access to the landing page"');
            http_response_code(401);
            echo http_response_code().": Error, login failed";
>>>>>>> 53d437eed948d17a5589861db637be03e6dc7328
        }
        break;
    case 'error':
        header('Access-Control-Allow-Headers: Access-Control-Allow-Origin');
        header('Access-Control-Allow-Origin: *');
<<<<<<< HEAD
        http_response_code(404);
        echo http_response_code(404).": Error, action value not specified";
=======
        http_response_code(501);
        echo http_response_code().": Error, action not recognized";
>>>>>>> 53d437eed948d17a5589861db637be03e6dc7328
        break;
}

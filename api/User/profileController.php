<?php
require('../model/databaseConnect.php');
require('../model/profileQueries.php');
//require('../model/Employee.php');
//require('../model/Admin.php');
//require('../model/User.php');

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
        $pwd = filter_input(INPUT_POST, 'pwd');
        $result = login($email, $pwd);
        
        if ($result == NULL) {
            $message = "Incorrect email $email or password $pwd";
            
            http_response_code(401);
            //include('../index.php');
        } 
        else {
            
            header('Content-Type: application/json;charset=utf-8');
            echo json_encode(['data'=>$result]);
//            $message = 'Login successful!';
//            include('../view/admin.component.php');
        }
        break;
        
}

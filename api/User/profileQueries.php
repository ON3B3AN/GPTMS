<?php
global $db;
function login($email, $pwd) {
    //global $db;
    $query = 'SELECT * FROM user WHERE email = ? AND password = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ss', $email, $pwd);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }  
}

function signup($fname, $lname, $email, $pwd, $employee){
    //global $db;
    $query = 'INSERT INTO user (first_name, last_name, email, password, employee)'
            . 'VALUES ($fname, $lname, $email, $pwd, $employee)';
    
    if($db->query($query) == TRUE) {
        echo "User created Successfully";
    } else {
        echo "Error: " . $db . "<br>" . $db->error;
    }
}

<?php
function login($email, $pwd) {
    global $db;
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

function signup($fName, $lName, $email, $pwd, $phone){
    global $db;
    $query = 'INSERT INTO user (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $fName, $lName, $email, $pwd, $phone);
        $statement->execute();
        $statement->close();

        // Get the last user ID that was inserted
        $usr_id = $db->insert_id;
        return $usr_id;
    } catch (Exception $ex) {
        exit;
    }

}

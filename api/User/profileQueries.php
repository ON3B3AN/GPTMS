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

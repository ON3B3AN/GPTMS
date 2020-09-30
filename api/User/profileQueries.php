<?php

function login($email, $pwd) {
    global $db;
    $query = 'SELECT * FROM user WHERE email = :email AND password = :pwd';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':pwd', $pwd);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (Exception $ex) {
        exit;
    }  
}

//function signup($fName, $lName, $email, $pwd, $phone, $) {
//    global $db;
//    $query = 'SELECT * FROM user WHERE email = :email AND password = :pwd';
//    try {
//        $statement = $db->prepare($query);
//        $statement->bindValue(':email', $email);
//        $statement->bindValue(':pwd', $pwd);
//        $statement->execute();
//        $result = $statement->fetchAll();
//        $statement->closeCursor();
//        return $result;
//    } catch (Exception $ex) {
//        exit;
//    }  
//}

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

function signup($user){
    global $db;
    $query = 'INSERT INTO user 
                (first_name, last_name, email, password, phone)
             VALUES 
                ($fName, $lName, $email, $pwd, $phone)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':fName', $user->getFName());
        $statement->bindValue(':lName', $user->getLName());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':pwd', $user->getPwd());
        $statement->bindValue(':phone', $user->getPhone());
        $statement->execute();
        $statement->closeCursor();

        // Get the last user ID that was inserted
        $usr_id = $db->lastInsertId();
        return $usr_id;
    } catch (Exception $ex) {
        exit;
    }

}

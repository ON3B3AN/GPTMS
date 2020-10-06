<?php
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

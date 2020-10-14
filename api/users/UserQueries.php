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

function historySelectAll($user_id) {
    global $db;
    $query = 'SELECT course_name, party_etime, stroke, hole_number 
        FROM History h 
        JOIN Score s ON s.score_id = h.Score_score_id 
        JOIN Party p
        ON p.party_id = h.Party_party_id AND p.party_etime IS NOT NULL
        JOIN Course c ON  c.course_id = h.Score_Hole_course_id
        JOIN Hole ho ON  ho.hole_id = h.Score_Hole_hole_id
        WHERE h.user_id = ?;';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_all();
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    } 
}

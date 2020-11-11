<?php
function insertParty($course_id, $size, $longitude,$latitude, $golf_cart) {
    global $db;
    $query = 'INSERT INTO party (Course_course_id, date, start_time, size, longitude, latitude, golf_cart) VALUES (?, CURRENT_DATE(), CURRENT_TIME(), ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $course_id, $size, $longitude, $latitude, $golf_cart);
        $statement->execute();
        $last_id = $statement->insert_id;
        $statement->close();

        return $last_id;
    } catch (Exception $ex) {
        exit;
    }
}

function insertPlayer($user_id, $handicap, $course_id, $size, $longitude, $latitude, $golf_cart){
    global $db;
    $party_id = partyInsert($course_id, $size, $longitude, $latitude, $golf_cart);
    $query = 'INSERT INTO player (Party_party_id, User_user_id, handicap) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $party_id, $user_id, $handicap);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

function updateScore($stroke, $total_score, $hole_id, $user_id, $party_id) {
    global $db;
    $query = 'UPDATE score SET stroke = ?, total_score = ? WHERE Hole_hole_id = ? AND Player_User_user_id = ? AND Player_Party_party_id = ?';
	try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $stroke, $total_score, $hole_id, $user_id, $party_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}
	
function insertScore($hole_id, $user_id, $party_id, $stroke, $total_score) {
    global $db;
    $query = 'INSERT INTO score (Hole_hole_id, Player_User_user_id, Player_Party_party_id, stroke, total_score)'
            . 'VALUES (?, ?, ?, ?, ?)';
	try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $hole_id, $user_id, $party_id, $stroke, $total_score);
        $statement->execute();
        $row_num = $statement->insert_id;  
        $statement->close();
     
        return $row_num;
    } catch (Exception $ex) {
        exit;
    }	
}

function startRound($course_id, $start_hole, $end_hole) {
    global $db;
    $query = 'SELECT course_name, address, phone, hole_number, hole_par, avg_pop, tee_name, distance_to_pin
                FROM course 
                join hole on course_id = Course_course_id
                join tee on hole_id = Hole_hole_id
                WHERE Course_course_id = ? 
                AND hole_number BETWEEN ? AND ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('iii', $course_id, $start_hole, $end_hole);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            array_push($res, $row);
        }
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

function selectActiveParties() {
    global $db;
    $query = 'SELECT * FROM party WHERE end_time IS NULL';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            array_push($res, $row);
        }
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

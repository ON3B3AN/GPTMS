<?php
<<<<<<< HEAD
/*function select($game_id) {
=======
<<<<<<< HEAD
function insert($course_id, $party_id) {
    global $db;
    $query = 'INSERT INTO golf_game (Course_course_id, Party_party_id) VALUES (?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $course_id, $party_id);
=======
function partyInsert($course_id, $size, $longitude,$latitude, $golf_cart) {
    global $db;
    $query = 'INSERT INTO party (Course_course_id, date, start_time, size, longitude, latitude, golf_cart) VALUES (?, CURRENT_DATE(), CURRENT_TIME(), ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $course_id, $size, $longitude,$latitude, $golf_cart);
>>>>>>> master
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

<<<<<<< HEAD
function select($game_id) {
>>>>>>> master
    global $db;
    $query = 'SELECT * FROM golf_game WHERE game_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $game_id);
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
<<<<<<< HEAD
*/

function partyInsert($course_id, $size, $longitude,$latitude, $golf_cart) {
    global $db;
    $query = 'INSERT INTO party (Course_course_id, date, start_time, size, longitude, latitude, golf_cart) VALUES (?, CURRENT_DATE(), CURRENT_TIME(), ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $course_id, $size, $longitude,$latitude, $golf_cart);
=======

function getID(){
    global $db;
    $query = 'SELECT LAST_INSERT_ID();';
    
    try{
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            array_push($res, $row);
        }
        $statement->close();
        return $result;

    } catch (Exception $ex) {
        exit;
    }
}

function partyInsert($size) {
    global $db;
    $query = 'INSERT INTO party (size, party_stime) VALUES (?, NOW());';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $size);
>>>>>>> master
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

<<<<<<< HEAD
        return $row_num;
=======
//        return $row_num;
        
        
        return getID();
>>>>>>> master
    } catch (Exception $ex) {
        exit;
    }
}

<<<<<<< HEAD
=======
function playerInsert($party_id, $user_id, $handicap){
    global $db;
    $query = 'INSERT INTO player (Party_party_id, User_user_id, handicap) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('iii', $party_id, $user_id, $handicap);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

=======
>>>>>>> master
function insert($user_id, $handicap, $course_id, $size, $longitude, $latitude, $golf_cart){
    global $db;
    $party_id = partyInsert($course_id, $size, $longitude, $latitude, $golf_cart);
    $query = 'INSERT INTO player (Party_party_id, User_user_id, handicap) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $party_id, $user_id, $handicap);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();
    //    $insert_array = [$row_num, $course_id, $size, $longitude, $latitude, $golf_cart];
<<<<<<< HEAD
=======
>>>>>>> master
>>>>>>> master
        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}
<<<<<<< HEAD

=======
>>>>>>> master

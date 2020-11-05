<?php
function partyInsert($course_id, $size, $longitude,$latitude, $golf_cart) {
    global $db;
    $query = 'INSERT INTO party (Course_course_id, date, start_time, size, longitude, latitude, golf_cart) VALUES (?, CURRENT_DATE(), CURRENT_TIME(), ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $course_id, $size, $longitude,$latitude, $golf_cart);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

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
        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

function scoreInsert($hole_id, $player_id, $user_id, $party_id, $stroke, $total_score) {
    global $db;
    $query = 'INSERT INTO score (Hole_hole_id, Player_player_id, Player_User_user_id, Player_Party_party_id, stroke, total_score)'
            . 'VALUES (?, ?, ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ssssss', $hole_id, $player_id, $user_id, $party_id, $stroke, $total_score);
        $statement->execute();
        $statement->close();
    } catch (Exception $ex) {
        exit;
    }

}

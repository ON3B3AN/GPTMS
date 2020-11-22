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
        unset($res["password"]);
        $statement->close();
        $user_id = $res["user_id"];
        
        if(checkEmployee($user_id)){
            $query2 = 'SELECT user_id, first_name, last_name, email, phone, emp_id, Course_course_id, security_lvl
                        FROM user
                        JOIN employee
                        ON user_id = User_user_id
                        WHERE user_id = ?';
            try {
                $statement2 = $db->prepare($query2);
                $statement2->bind_param('s', $user_id);
                $statement2->execute();
                $result2 = $statement2->get_result();
                $res2 = $result2->fetch_assoc();
                $statement2->close();
                return $res2;
            } catch (Exception $e) {
                exit;
            } 
            
        } else {
            return $res;
        }
        
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

function selectAllHistory($user_id) {
    global $db;
    $query = 'SELECT party_id, course_name, DATE_FORMAT(party.date, "%M %d %Y") as date_played, TIMEDIFF(end_time, start_time) as tot_time,
                SUM(CASE WHEN hole_number < "10" THEN stroke ELSE 0 END) as front_nine,
                SUM(CASE WHEN hole_number >= "10" THEN stroke ELSE 0 END) as back_nine,
                SUM(stroke) as total_score
                FROM party
                JOIN course ON party.Course_course_id = course_id
                JOIN hole ON course_id = hole.Course_course_id
                JOIN score ON hole_id = Hole_hole_id AND party_id = Player_Party_party_id
                WHERE Player_User_user_id = ?
                GROUP BY party_id
                ORDER BY date_played, end_time';
    
    $query2 = 'SELECT SUM(CASE WHEN tee_name = "tee1" THEN distance_to_pin else 0 END) as tee_1,
                SUM(CASE WHEN tee_name = "tee2" THEN distance_to_pin else 0 END) as tee_2,
                SUM(CASE WHEN tee_name = "tee3" THEN distance_to_pin else 0 END) as tee_3,
                hole_number, 
                hole_par, 
                stroke, 
                avg_pop
                FROM hole
                JOIN tee ON hole_id = tee.Hole_hole_id
                JOIN score ON tee.Hole_hole_id = score.Hole_hole_id
                JOIN player ON score.Player_Party_party_id = player.Party_party_id AND score.Player_User_user_id = player.User_user_id
                JOIN party ON player.Party_party_id = party_id
                WHERE player.User_user_id = ? AND party_id = ?
                group by hole_id, party.date, start_time
                ORDER BY hole_number, party.date, end_time';
    
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            $stmt = $db->prepare($query2);
            $stmt->bind_param('ss', $user_id, $row["party_id"]);
            $stmt->execute();
            $result2 = $stmt->get_result();
            $res2 = array();
            while($r = $result2->fetch_assoc()){
                array_push($res2, $r);
            }
            unset($row["party_id"]);
            $row["score"] = $res2;
            array_push($res, $row);
        }
        $statement->close();
        
        return $res;
    } catch (Exception $ex) {
        exit;
    } 
}

function updateUser($first_name, $last_name, $email, $password, $phone, $user_id) {
    global $db;
    $query = 'UPDATE user SET first_name = ?, last_name = ?, email = ?, password = ?, phone = ? WHERE user_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ssssss', $first_name, $last_name, $email, $password, $phone, $user_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function deleteUser($user_id) {
    global $db;
    $query = 'DELETE FROM user WHERE user_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $user_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();

        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function selectAllUsers() {
    global $db;
    $query = 'SELECT * FROM user';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            unset($row["password"]);
            array_push($res, $row);
        }
        $statement->close();
        
        return $res;
    } catch (Exception $ex) {
        exit;
    }  
}

function checkEmployee($user_id) {
    global $db;
    $query = 'select emp_id, security_lvl
                from user
                join employee
                on user_id = User_user_id
                where user_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $isEmployee = TRUE;
        if(empty($res)){
            $isEmployee = FALSE;
        }
        $statement->close();

        return $isEmployee;
    } catch (Exception $ex) {
        exit;
    } 
}

function selectUserByEmail($email) {
    global $db;
    $query = 'SELECT user_id FROM user WHERE email = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

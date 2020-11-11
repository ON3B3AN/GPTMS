<?php
function selectallCourses() {
    global $db;
    $query = 'SELECT * FROM course';
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

function selectCourse($course_id) {
    global $db;
    $query = 'SELECT * FROM course WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
        $statement->execute();
        $result = $statement->get_result();
        $result = $result->fetch_assoc();
        $statement->close();
        
        return $result;
    } catch (Exception $ex) {
        exit;
    }  
}

function deleteCourse($course_id) {
    global $db;
    $query = 'DELETE FROM course WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();

        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function insertCourse($course_name, $address, $phone) {
    global $db;
    $query = 'INSERT INTO course (course_name, address, phone) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $course_name, $address, $phone);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

function updateCourse($course_name, $address, $phone, $course_id) {
    global $db;
    $query = 'UPDATE course SET course_name = ?, address = ?, phone = ? WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ssss', $course_name, $address, $phone, $course_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function selectHoles($course_id, $start_hole, $end_hole) {
    global $db;
    $query = 'SELECT hole_number, hole_par, avg_pop,
              SUM(CASE WHEN tee_name = "tee1" THEN distance_to_pin else 0 END) as tee_1,
              SUM(CASE WHEN tee_name = "tee2" THEN distance_to_pin else 0 END) as tee_2,
              SUM(CASE WHEN tee_name = "tee3" THEN distance_to_pin else 0 END) as tee_3
              FROM hole join tee on hole_id = Hole_hole_id
              where Course_course_id = ? AND hole_number BETWEEN ? AND ?
              group by hole_id';
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

function selectTees($course_id) {
    global $db;
    $query = 'SELECT DISTINCT(tee_name)
                FROM tee
                JOIN hole ON hole_id = Hole_hole_id
                JOIN course ON Hole.course_id = Course.course_id
                WHERE course_id = ?;';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
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
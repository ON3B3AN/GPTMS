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

function selectHoles($course_id) {
    global $db;
    $query = 'SELECT *
                FROM hole
                WHERE Course_course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $course_id);
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
                JOIN course ON Course_course_id = course.course_id
                WHERE course.course_id = ?';
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

function selectCourseRecords($course_id){
    global $db;
    $query = 'SELECT course_id, course_name, address, phone, hole_number, hole_par, longitude, latitude, avg_pop, tee_name, distance_to_pin
                from course
                join hole on course_id = Course_course_id
                join tee on hole_id = Hole_hole_id
                where course_id = ?';
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

function requestHints($course_id) {
    global $db;
    $query = "SELECT * FROM hints WHERE course_id = ?";
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $course_id);
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
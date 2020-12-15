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

function selectRangeOfHoles($course_id, $start_hole, $end_hole) {
    global $db;
    $query = 'SELECT *
                FROM hole
                WHERE Course_course_id = ? 
                AND hole_number BETWEEN ? AND ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('iii', $course_id, $start_hole, $end_hole);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            unset($row["Course_course_id"]);
            unset($row["perimeter"]);
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
    $query = 'SELECT hole_number, tee_name, distance_to_pin
                FROM tee
                JOIN hole ON Hole_hole_id = hole_id
                WHERE hole.Course_course_id = ?';
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
    $query = 'SELECT course_id, course_name, address, phone, hole_id, mens_handicap, womens_handicap, hole_number, mens_par, womens_par, ST_AsGeoJSON(perimeter) AS perimeter, avg_pop, tee_id, tee_name, distance_to_pin
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
            if (!array_key_exists('course_id', $res)) {
                $res = array(
                    'course_id' => $row['course_id'],
                    'course_name' => $row['course_name'],
                    'address' => $row['address'],
                    'phone' => $row['phone'],
                    'holes' => array()
                );
            }
            $i = array_search($row['hole_number'], array_column($res['holes'], 'hole_number'));
            if ($i === False) {
                $hole = array(
                    'hole_id' => $row['hole_id'],
                    'hole_number' => $row['hole_number'],
                    'mens_par' => $row['mens_par'],
                    'womens_par' => $row['womens_par'],
                    'mens_handicap' => $row['mens_handicap'],
                    'womens_handicap' => $row['womens_handicap'],
                    'perimeter' => $row['perimeter'],
                    'avg_pop' => $row['avg_pop'],
                    'tees' => array(array('tee_id' => $row['tee_id'], 'tee_name' => $row['tee_name'], 'distance_to_pin' => $row['distance_to_pin']))
                );
                array_push($res['holes'], $hole);
            } else {
                array_push($res['holes'][$i]['tees'], array('tee_id' => $row['tee_id'], 'tee_name' => $row['tee_name'], 'distance_to_pin' => $row['distance_to_pin']));
            }
        }
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

function updateHoles($mens_par, $womens_par, $hole_number, $mens_handicap, $womens_handicap, $perimeter, $course_id){
    global $db;
    $query = 'UPDATE hole SET mens_par = ?, womens_par = ?, mens_handicap = ?, womens_handicap = ?, perimeter = ST_GeomFromGeoJSON(?) WHERE Course_course_id = ? AND hole_number = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssssss', $mens_par, $womens_par, $mens_handicap, $womens_handicap, $perimeter, $course_id, $hole_number);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}



// Kill-and-Fill tees. hole_id is based on course id and hole number
function insertTees($course_id, $hole_number, $distance_to_pin, $tee_name){
    global $db;
    $query = 'INSERT INTO tee (`Hole_hole_id`, `distance_to_pin`, `tee_name`) VALUES ((SELECT hole_id FROM hole WHERE Course_course_id = ? AND hole_number = ?), ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ssss', $course_id, $hole_number, $distance_to_pin, $tee_name);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function deleteHoles($course_id, $hole_number) {
    global $db;
    $query = 'DELETE FROM hole WHERE Course_course_id = ? AND hole_number = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ss', $course_id, $hole_number);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function deleteTees($course_id, $hole_number) {
    global $db;
    $query = 'DELETE tee FROM tee JOIN hole ON tee.Hole_hole_id = hole.hole_id WHERE hole.Course_course_id = ? AND hole.hole_number = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ss', $course_id, $hole_number);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}


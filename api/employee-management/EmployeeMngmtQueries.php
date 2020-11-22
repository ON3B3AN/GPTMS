<?php
function insertEmployee($user_id, $course_id, $security_lvl){
    global $db;
    $query = 'INSERT INTO employee (User_user_id, Course_course_id, security_lvl) VALUES (?,?,?)
';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $user_id, $course_id, $security_lvl);
        $statement->execute();
        $statement->close();

        // Get the last employee ID that was inserted
        $emp_id = $db->insert_id;
        return $emp_id;
    } catch (Exception $ex) {
        exit;
    }
}

function updateEmployee($course_id, $security_lvl, $emp_id) {
    global $db;
    $query = 'UPDATE employee SET Course_course_id = ?, security_lvl = ? WHERE emp_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $course_id, $security_lvl, $emp_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function deleteEmployee($emp_id) {
    global $db;
    $query = 'DELETE FROM employee WHERE emp_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $emp_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();

        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function selectAllEmployees() {
    global $db;
    $query = 'SELECT * FROM employee';
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

function selectEmployeeByCourse($course_id) {
    global $db;
    $query = 'SELECT * FROM employee WHERE Course_course_id = ?';
     try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

function selectEmployee($emp_id) {
    global $db;
    $query = 'SELECT * FROM employee WHERE emp_id = ?';
     try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $emp_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

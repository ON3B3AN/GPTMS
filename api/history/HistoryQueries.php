<?php
function history($user_id) {
    global $db;
    $query = 'SELECT * FROM History WHERE User_user_id = ? ORDER BY date ';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }  
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


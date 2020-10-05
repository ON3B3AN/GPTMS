<?php
function history($user_id) {
    global $db;
    $query = 'SELECT (Course.course_name, Party.party_etime, Score.stroke, Hole.hole_number) FROM History JOIN Score JOIN Party JOIN Course JOIN Hole'
            . 'WHERE History.Score_Hole_course_id = Course.course_id and'
            . 'History.Party_party_id = Party.party_id and History.Score_score_id = Score.score_id and'
            . 'History.Score_Hole_hole_id = Hole.hole_id and'
            . 'History.user_id = ? and Party.party_etime != NULL';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $user_id);
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


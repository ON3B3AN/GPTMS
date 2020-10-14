<?php
function selectall($user_id) {
    global $db;
    $query = 'SELECT course_name, party_etime, stroke, hole_number 
        FROM History h 
        JOIN Score s ON s.score_id = h.Score_score_id 
        JOIN Party p
        ON p.party_id = h.Party_party_id AND p.party_etime IS NOT NULL
        JOIN Course c ON  c.course_id = h.Score_Hole_course_id
        JOIN Hole ho ON  ho.hole_id = h.Score_Hole_hole_id
        WHERE h.user_id = ?;';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_all();
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }  
}

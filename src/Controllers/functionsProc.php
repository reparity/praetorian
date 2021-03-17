<?php

//get all agents
function getAllAgents($db) {
    $sql = 'Select * FROM agents';
    $stmt = $db->prepare($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get agent by id
function getAgent($db, $agentId) {
    $sql = 'Select * FROM agents ';
    $sql .= 'Where id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $agentId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new request
function createRequest($db, $form_data) {
    $sql = 'Insert into requests (name, email, category, description, date) ';
    $sql .= 'values (:name, :email, :category, :description, :date)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':email', $form_data['email']);
    $stmt->bindParam(':category', $form_data['category']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':date', $form_data['date']);
    $stmt->execute();
    return $db->lastInsertID(); //insert last number, continue
   // }
}

//auth check
function authCheck($db, $form_data) {

    $sql = "SELECT username, pass FROM admin WHERE username=:username and pass=:pass";
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':username', $form_data['username']);
    $stmt->bindParam(':pass', $form_data['pass']);
    $stmt->execute();
    return $stmt->rowCount();

}

//delete existing request
function deleteRequest($db, $requestId) {
    $sql = 'DELETE FROM requests WHERE id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $requestId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

//update agent assignment
function updateAgent($db, $requestId, $form_data) {
    $sql = 'UPDATE requests SET agent_id=:agentId WHERE id=:r_id';

    //echo $sql;
    $stmt = $db->prepare ($sql);
    $r_id = (int) $requestId;
    $stmt->bindParam(':r_id', $r_id, PDO::PARAM_INT);
    $stmt->bindParam(':agentId', $form_data['a_name']);
    $stmt->execute();
    return $stmt->rowCount();
}

?>
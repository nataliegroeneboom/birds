<?php

 function getCoords($id){
    include __DIR__ . '/../includes/DatabaseConnection.php';
    $sightingTable = new \Natalie\DatabaseTable($pdo, 'sightings', 'id');
    $sightings = $sightingTable->find('birdId', $id);
    $sightingsJson = json_encode($sightings);
    return $sightingsJson;
}
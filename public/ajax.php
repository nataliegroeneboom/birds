<?php

include_once '../config/core.php';
include_once '../config/database.php';
include_once "../objects/bird.php";


$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);

if((isset($_POST['search']))){
    $response = "<ul><li>no data found</li></ul>";
    $search = $_POST['q'];
    $stmt = $bird->autoCompleteSearch($search);
    $num = $stmt->rowCount();
    if($num>0){
        $response = "<ul>";
        while($data = $stmt->fetch()){
            $response .= "<li class='{$data['id']}'>". $data['name'] ."</li>";
        }
        $response .= "</ul>";

    }
    exit($response);






//     $search = $_RESPONSE['search'];
//    $stmt = $bird->autoCompleteSearch($search);
//
//    while($row = $stmt->fetch()) {
//        $arr[] = ['name' => $row['name'], 'description' => $row['description']];
//
//    }
//
//
//    echo json_encode($result);

}
<?php

try{
include __DIR__ . '../config/core.php';
include __DIR__ . '../config/database.php';
include __DIR__ . '../classes/DatabaseTable.php';
include __DIR__ . '../classes/Controllers/Register.php';

    $database = new Database();
    $db = $database->getConnection();

    $birdTable = new DatabaseTable($db, 'birds', 'id');
    $categoryTable = new DatabaseTable($db, 'categories', 'id');
    $locationTable = new DatabaseTable($db, 'location', 'id');
    $userTable = new DatabaseTable($db, 'users', 'id');

    $registerController = new RegisterController($userTable);

$action = $_GET['action'] ?? 'home';

if($action == strtolower($action)){
    $page_redirect= $registerController->$action();
}else{
    http_response_code(301);
    header('location: index.php?action=' . strtolower($action));
}

$page_title= $page_redirect['title'];

if(isset($page_redirect['variables'])){
    $output = loadTemplate($page_redirect['tempate'], $page_redirect['variables']);
}else{
    $output = loadTemplate($page_redirect['tempate']);
}

}catch(PDOException $e){
$page_title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include_once "../templates/layout.html.php";
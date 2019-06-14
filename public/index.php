<?php

try{

include __DIR__ . '/../includes/autoloader.php';

$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');


$entryPoint = new \Natalie\EntryPoint($route, new \Bird\BirdRoutes(), $_SERVER['REQUEST_METHOD']);
$entryPoint->run();

}catch(PDOException $e){
    $page_title = 'An error has occurred';
	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
    include_once "../templates/layout.html.php";

}

















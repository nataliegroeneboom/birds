<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';
include_once '../config/core.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$bird = new Bird($db);
$category = new Category($db);
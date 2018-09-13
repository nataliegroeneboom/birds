<?php
$id= isset($_GET['id'])? $_GET['id'] : die('ERROR: Record ID not found');
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';

$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$category = new Category($db);
$bird->id = $id;
$bird->readOne();

$page_title = $bird->name;
include_once "../templates/header.html.php";

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";

include_once '../templates/individual.html.php';

include '../templates/footer.html.php';

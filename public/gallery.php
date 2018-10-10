<?php
include_once '../config/database.php';
include_once '../objects/bird.php';

$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$total_rows=$bird->countAll();

if($total_rows>0){
  $stmt = $bird->readRandom();
  $page_title = "Australian Birds";
include_once "../templates/header.html.php";

  include_once "../templates/gallery.html.php";

include '../templates/footer.html.php';
}else{
  echo "<span>No Bird information</span>";
}

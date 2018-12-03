<?php

$id= isset($_GET['id'])? $_GET['id'] : die('ERROR: Record ID not found');

include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';
include_once '../config/core.php';

$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$category = new Category($db);

// set ID property of bird to be edited
$bird->id = $id;
echo $id ;
$bird->readOne();
echo "<br />";
echo $bird->birdname;

$page_title = "Update Bird";
include_once "../templates/header.html.php";

include_once "../templates/update.html.php";

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";

//get ID of teh product to be edited



  if($_POST){

      $bird->birdname = $_POST['name'];
      $bird->description = $_POST['description'];
      $bird->category_id = $_POST['category_id'];

    if($bird->update()){
      echo "<div class='alert-success alert-dismissable'>";
      echo "Details was updated";
      echo "</div>";
    }else{
      echo "<div class='alert-danger alert-dismissable'>";
      echo "Details could not be updated";
      echo "</div>";

    }

      $stmt->bindParam(':name', $birdname);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':id', $id);

      if($stmt->execute()){
        echo "<div class='alert alert-success'>Record was updated.</div>";
      }else{
        echo "<div class='alert alert-danger'>
        Unable to update  record.</div>";
      }

  }



include '../templates/footer.html.php';

<?php

include_once '../../config/core.php';
include_once '../../config/database.php';
include_once '../../objects/bird.php';
include_once '../../objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$bird = new Bird($db);
$category = new Category($db);


// set page headers
$page_title = "Add a Bird";

if($_POST){

    // set product property values
    $bird->name = $_POST['name'];
    $bird->description = $_POST['description'];
    $bird->category_id = $_POST['category_id'];
    $image=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";
    $bird->image = $image;
    // create the product
    if($bird->create()){
        echo "<div class='alert alert-success'>Bird was created.</div>";
        echo $bird->uploadPhoto();
    }

    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create bird.</div>";
    }
}


include_once "templates/header.html.php";

include_once "templates/create.html.php";

include_once "templates/footer.html.php";
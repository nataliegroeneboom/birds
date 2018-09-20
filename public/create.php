<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$bird = new Bird($db);
$category = new Category($db);

// set page headers
$page_title = "Add a Bird";
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){

    // set product property values
    $bird->name = $_POST['name'];
    $bird->description = $_POST['description'];
    $bird->category_id = $_POST['category_id'];
    $image=!empty($_FILES['image']["name"])?sha1_file($FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";

    // create the product
    if($bird->create()){
        echo "<div class='alert alert-success'>Bird was created.</div>";
    }

    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create bird.</div>";
    }
}

include_once "../templates/header.html.php";

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Birds</a>";
echo "</div>";

include_once "../templates/create.html.php";

// footer
include_once "../templates/footer.html.php";

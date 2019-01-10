<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';
include_once '../objects/location.php';
include_once '../config/core.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$bird = new Bird($db);
$category = new Category($db);
$location = new Location($db);


// set page headers
$page_title = "Add a Bird";
// if the form was submitted

if(isset($_POST['bird'])){
    $bird_variables = $_POST['bird'];

    // set product property values
    $bird->birdname = $bird_variables['name'];
    $bird->description = $bird_variables['description'];
    $bird->category_id = $bird_variables['category_id'];
    $bird->location_id = $bird_variables['location_id'];
    $bird->status = $bird_variables['status'];
    $bird_variables['image']=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";
    $bird->population = $bird_variables['population'];
    $bird->image = $bird_variables['image'];


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

include_once "../templates/header.html.php";

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Birds</a>";
echo "</div>";

include_once "../templates/create.html.php";

// footer
include_once "../templates/footer.html.php";

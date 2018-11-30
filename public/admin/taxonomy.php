<?php

//core configuration

include_once "../../config/core.php";

//include classes

include_once '../../config/database.php';
include_once '../../objects/category.php';
include_once '../../objects/location.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$location = new Location($db);

$page_title = "Manage Your Taxonomy";

include_once "templates/header.html.php";


echo "<h3>Add a Category</h3>";

include_once "templates/category.html.php";

if(isset($_POST['submitCategory'])){
    $category->name = $_POST['name'];
    if($category->create()){
        echo "<div>Category Created</div>";
       $category->read();
    }else{
        echo "<div>Unable to create category</div>";
    }

}

echo "<h3>Categories</h3>";

$stmt_category = $category->read();

echo "<table><tr><th>Category</th></tr> ";
while($row = $stmt_category->fetch(PDO::FETCH_ASSOC)){
    extract($row);
        echo " <tr><td>{$name}</td></tr>";
}

echo "</table>";

echo "<h3>Add a Location</h3>";

if(isset($_POST['submitLocation'])){
    $location->name = $_POST['name'];
    if($location->create()){
        echo "<div>New Location Created</div>";
        $location->read();
    }else{
        echo "<div>Unable to create category</div>";
    }


}

$stmt_location = $location->read();

echo "<table><tr><th>Location</th></tr> ";
while($row = $stmt_location->fetch(PDO::FETCH_ASSOC)){
    extract($row);
 //   $row['name'] = ucwords($row['name']);
    echo " <tr><td>{$name}</td></tr>";
}

echo "</table>";



include_once "templates/location.html.php";

include_once "templates/footer.html.php";

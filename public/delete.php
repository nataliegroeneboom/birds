<?php
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/product.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare product object
    $bird = new Bird($db);

    // set product id to be deleted
    $bird->id = $_POST['object_id'];

    // delete the product
    if($bird->delete()){
        echo "Object was deleted.";
    }

    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}

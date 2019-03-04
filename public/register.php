<?php
include_once '../config/core.php';

$page_title = "Register";

include_once "login_checker.php";

include_once "../config/database.php";
include_once "../classes/user.php";
include_once "libs/php/utils.php";

include_once "../templates/header.html.php";

if($_POST){
  $database = new Database();
  $db = $database->getConnection();

  $user = new User($db);
  $utils = new Utils();

  $user->email=$_POST['email'];

  $test = $user->emailExists();


  if($user->emailExists()){
    echo "<div class='alert alert-danger'>
    The email you have specified already exists
    </div>";
  }else{

    $user->firstname=$_POST['firstname'];
    $user->lastname= $_POST['lastname'];
    $user->contact_number = $_POST['contact_number'];
    $user->address = $_POST['address'];
    $user->password=$_POST['password'];
    $user->access_level = 'Customer';
    $user->access_code = 0;
    $user->status=1;


    if($user->create()){

         echo "<div class='alert alert-info'>";
         echo "Successfully registered. <a href='{$home_url}login.php'>Please login</a>.";
         echo "</div>";


         //empty posted values
         $_POST=array();





  }  else{

    echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
            }

       }
    }


include_once "../templates/register.html.php";

include_once "../templates/footer.html.php";

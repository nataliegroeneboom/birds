<?php

include_once "../config/core.php";
$page_title = "Login";

$required_login=false;
include_once "login_checker.php";


$access_denied=false;

if($_POST){
  include_once "../config/database.php";
  include_once "../objects/user.php";
  $database = new Database();
  $db = $database->getConnection();

  $user = new User($db);
  $user->email= $_POST['email'];
  $email_exists = $user->emailExists();
  //login validation goes here
  if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){

      // if it is, set the session value to true
      $_SESSION['logged_in'] = true;
      $_SESSION['user_id'] = $user->id;
      $_SESSION['access_level'] = $user->access_level;
      $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
      $_SESSION['lastname'] = $user->lastname;

      // if access level is 'Admin', redirect to admin section
      if($user->access_level=='Admin'){
          header("Location: {$home_url}admin/index.php?action=login_success");
      }

      // else, redirect only to 'Customer' section
      else{
          header("Location: {$home_url}index.php?action=login_success");
      }
  }

  // if username does not exist or password is wrong
  else{
      $access_denied=true;
  }

}

include_once "../templates/header.html.php";


    // alert messages will be here
include_once "../templates/login_form.html.php";
    // actual HTML login form


include_once "../templates/footer.html.php";

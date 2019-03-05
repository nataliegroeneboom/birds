<?php
if(isset($_SESSION['access_level'])&&$_SESSION['access_level']=="Admin"){
  header("Location:{$home_url}admin/index.php?action=logged_in_as_admin");
}
else if(isset($require_login)&&$require_login==true){
   if(!isset($_SESSION['access_level'])){
     header("Location: {$home_url}login.php?action=please_login");
   }
}
else if(isset($page_title)&&($page_title=="Login" || $page_title="Sign Up")){
  if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Customer"){
    header("Location: {$home_url}index.php?action=already_logged_in");
  }
}else{
  //no problem, stay on current page
}

<?php
if(empty($SESSION['logged_in'])){
  header("Location: {$home_url}login.php?action=not_yet_logged_in");

}else if($_SESSION['access_level']!='Admin'){
  header("Location: {$home_url}login.php?action=not_admin");
}
else{
  //no problem, stay on current page
}

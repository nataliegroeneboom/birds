<?php

include_once '../config/core.php';
include_once '../config/database.php';
include_once "../objects/user.php";
include_once "../objects/bird.php";
include_once "../objects/Siting.php";

$database = new Database();
$db = $database->getConnection();
$page_title = $_SESSION['firstname'] . "'s Profile Page";
$user = new User($db);
$bird = new Bird($db);
$siting = new Siting($db);



include_once "../templates/header.html.php";



if(isset($_SESSION['user_id'])){

    echo "You are logged in as user" . $_SESSION['user_id'];
    $user->id = $_SESSION['user_id'];
    $user->readProfile();
    if(empty($user->image)){
        $showForm = true;
    }else{

        $showForm = false;
    }

    if(isset($_POST['submit'])){

        $fileNameNew=!empty($_FILES['image']["name"])? basename($_FILES['image']['name']) : "";
        $user->image = $fileNameNew;
  //      $extension = pathinfo($fileNameNew, PATHINFO_EXTENSION);
        if(!empty($fileNameNew)){
            echo $user->uploadProfilePhoto();
            if($user->image){
                $showForm = false;
                $user->uploadPhotoTable();
            }else{
                $showForm = true;

            }
        }
    }


  if((isset($_POST['submitbird']))){
     $siting->bird_name = $_POST['search'];
     $siting->created = isset($_POST['sitingdate'])?date('Y-m-d',strtotime($_POST['sitingdate'])):'';
     $image=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : false;
     $siting->bird_image = $image;
     $bird->image = $image;
     $siting->author_id = $_SESSION['user_id'];
     if($siting->create()){
         echo "<div class='alert alert-success'>Your bird siting was logged</div>";
         if($bird->image){
             $bird->uploadPhoto();
         }
     }


  }

  $siting->getUserSitings();



    include_once "../templates/profile.html.php";

}




include_once "../templates/footer.html.php";
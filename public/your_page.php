<?php

include_once '../config/core.php';
include_once '../config/database.php';
include_once "../objects/user.php";

$database = new Database();
$db = $database->getConnection();
$page_title = $_SESSION['firstname'] . "'s Profile Page";
$user = new User($db);


include_once "../templates/header.html.php";

if(isset($_SESSION['user_id'])){

    echo "You are logged in as user" . $_SESSION['user_id'];
    $user->id = $_SESSION['user_id'];
 //   $profileimage_exists = $user->profileImage();



    include_once "../templates/profile.html.php";

}

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)&&$fileError === 0 && $fileSize < 1000000){
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'images/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: your_page.php?uploadsuccess");
    }else{
        echo "An error has occurred";
    }
}


include_once "../templates/footer.html.php";
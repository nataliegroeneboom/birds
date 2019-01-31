

<?php


include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/DatabaseTable.php';
include_once '../objects/controllers/BirdController.php';


// instantiate database and product object

$database = new Database();
$db = $database->getConnection();



$birdTable = new DatabaseTable($db, 'birds', 'id');
$categoryTable = new DatabaseTable($db, 'categories', 'id');
$locationTable = new DatabaseTable($db, 'location', 'id');

$controller = new BirdController($birdTable, $categoryTable, $locationTable);

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
//$allowedFile = array('jpg', 'png', 'jpeg');
//$fileUpload = new UploadFile($files = [], 'files/', 4024000, $allowedFile);

$page_redirect = $controller->$action();
if(isset($page_redirect['variables'])){
    extract($page_redirect['variables']);
}




$page_title = $page_redirect['title'];
$require_login = true;
include_once "login_checker.php";
include_once "../templates/header.html.php";


// specify the page where paging is used
$page_url = "index.php?";


if(isset($page_redirect['message'])){
    echo "{$page_redirect['message']}";
}



// read_template.php controls how the product list will be rendered
include_once "../templates/{$page_redirect['template']}";

// layout_footer.php holds our javascript and closing html tags
include_once "../templates/footer.html.php";

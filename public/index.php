

<?php
// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
//include_once '../objects/bird.php';
//include_once '../objects/category.php';
include_once '../objects/DatabaseTable.php';
include_once '../objects/controllers/BirdController.php';
include_once '../objects/UploadFile.php';
//include_once '../objects/location.php';

// instantiate database and product object

$database = new Database();
$db = $database->getConnection();

//$bird = new Bird($db);
//$category = new Category($db);
//$location = new Location($db);


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

// query products
//$stmt = $bird->readAll($from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
//$total_rows=$bird->countAll();

if(isset($page_redirect['message'])){
    echo "{$page_redirect['message']}";
}


//if($action=='login_success'){
//  echo "<div class='alert alert-info'><strong>Hi " . $_SESSION['firstname'] . ", welcome back!";
//  echo"</strong></div>";
//}
//else if($action=='already_logged_in'){
//  echo "<div>
//  <strong>You are already logged in</strong>
//  </div>";
//}
//echo "<div class='alert alert-info'>
//content when logged in will be here
//</div>";

// read_template.php controls how the product list will be rendered
include_once "../templates/{$page_redirect['template']}";

// layout_footer.php holds our javascript and closing html tags
include_once "../templates/footer.html.php";



<?php
// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';

// instantiate database and product object



$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$category = new Category($db);

$page_title = "Index";
$require_login = true;
include_once "login_checker.php";
include_once "../templates/header.html.php";

// query products
$stmt = $bird->readAll($from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
$total_rows=$bird->countAll();
$action = isset($_GET['action']) ? $_GET['action'] : '';



if($action=='login_success'){
  echo "<div class='alert alert-info'><strong>Hi " . $_SESSION['firstname'] . ", wecome back!";
  echo"</strong></div>";
}
else if($action=='already_logged_in'){
  echo "<div>
  <strong>You are already logged in</strong>
  </div>";
}
echo "<div class='alert alert-info'>
content when logged in will be here
</div>";

// read_template.php controls how the product list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "../templates/footer.html.php";

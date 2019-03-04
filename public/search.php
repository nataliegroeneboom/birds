<?php
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../classes/bird.php';
include_once '../classes/category.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$category = new Category($db);

// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';

$page_title = "You searched for \"{$search_term}\"";
include_once "../templates/header.html.php";

// query products
$stmt = $bird->search($search_term, $from_record_num, $records_per_page);

// specify the page where paging is used
$page_url="search.php?s={$search_term}&";

// count total rows - used for pagination
$total_rows=$bird->countAll_BySearch($search_term);

// read_template.php controls how the product list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "../templates/footer.html.php";
?>

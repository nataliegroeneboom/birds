<?php
// PAGINATION VARIABLES
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;


$page_title="Bird Encyclopaedia";
include_once __DIR__ . '/../templates/header.html.php';

// include database connection


$action = isset($_GET['action']) ? $_GET['action'] : "";


//database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
include_once '../objects/category.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$bird = new Bird($db);
$category = new Category($db);

//query products
$stmt = $bird->readAll($from_record_num, $records_per_page);
// this is how to get number of rows returned
 $num = $stmt->rowCount();


if($action == 'deleted'){
  echo "<div class='alert alert-success'>
  Record was deleted </div>";
}





// link to create record form
echo "<div class='right-button-margin'><a href='create.php' class='btn btn-default pull-right'>Create New Product</a></div>";

//check if more than 0 record found
if($num>0){

  echo "<table class='table table-hover table-responsive table-bordered'>";//start table

      //creating our table heading
      echo "<tr>";
          echo "<th>Bird</th>";
          echo "<th>Description</th>";
          echo "<th>Category</th>";
          echo "<th>Action</th>";
      echo "</tr>";

      // retrieve our table contents
      // fetch() is faster than fetchAll()
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['firstname'] to
          // just $firstname only
          extract($row);

          // creating new table row per record
          echo "<tr>";
              echo "<td>{$name}</td>";
              echo "<td>{$description}</td>";
              echo "<td>";
                 $category->id = $category_id;
                 $category->readName();
                 echo "</td>";
              echo "<td>";
                  // read one record
                  echo "<a href='individual.php?id={$id}' class='btn btn-primary m-r-1em'>Read</a>";

                  // Edit post
                  echo "<a href='update.php?id={$id}' class='btn btn-info m-r-1em'>Edit</a>";

                  // Delete this post
                  echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                    echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                      echo "</a>";
              echo "</td>";
          echo "</tr>";
      }

  // end table
  echo "</table>";

  $page_url = "index.php?";

// count all products in the database to calculate total pages
$total_rows = $bird->countAll();

// paging buttons here
include_once 'paging.php';


}

// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}

include "../templates/footer.html.php";

<?php
// include database connection
include 'database.php';

include __DIR__ . '/../templates/list.html.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
// PAGINATION VARIABLES
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

if($action == 'deleted'){
  echo "<div class='alert alert-success'>
  Record was deleted </div>";
}

// select all data
$query = "SELECT id, name, description FROM birds ORDER BY id DESC
    LIMIT :from_record_num, :records_per_page";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";

//check if more than 0 record found
if($num>0){

  echo "<table class='table table-hover table-responsive table-bordered'>";//start table

      //creating our table heading
      echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>Name</th>";
          echo "<th>Description</th>";
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
              echo "<td>{$id}</td>";
              echo "<td>{$name}</td>";
              echo "<td>{$description}</td>";
              echo "<td>";
                  // read one record
                  echo "<a href='individual.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

                  // Edit post
                  echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                  // Delete this post
                  echo "<a href='#' onclick='delete_bird({$id});'  class='btn btn-danger'>Delete</a>";
              echo "</td>";
          echo "</tr>";
      }

  // end table
  echo "</table>";
  // PAGINATION
  // count total number of rows
  $query = "SELECT COUNT(*) as total_rows FROM birds";
  $stmt = $pdo->prepare($query);

  // execute query
  $stmt->execute();

  // get total rows
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $total_rows = $row['total_rows'];

  // paginate records
   $page_url="index.php?";
  include_once "paging.php";

}

// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}

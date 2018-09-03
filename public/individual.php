<?php
include 'database.php';


$id= isset($_GET['id'])? $_GET['id'] : die('ERROR: Record ID not found');

try{
  $query = "SELECT id, name, description, image FROM birds WHERE id = ? LIMIT 0,1";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $id);
  $stmt->execute();
  $row = $stmt-> fetch(PDO::FETCH_ASSOC);

  $name = $row['name'];
  $description = $row['description'];
  $image = htmlspecialchars($row['image'], ENT_QUOTES);
}
catch(PDOException $e){
  die('ERROR: ' . $e->getMessage());
}
include '../templates/view.html.php';

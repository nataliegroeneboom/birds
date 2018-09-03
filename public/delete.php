<?php
include 'database.php';

try{
$id = isset($_GET['id'])? $_GET['id'] : die('ERROR: Record ID not found');
$query = "DELETE FROM birds WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $id);

if($stmt->execute()){
  header('Location: index.php?action=deleted');
}else{
  die('Unable to delete record');
}
}
catch(PDOException $e){
  die('ERROR: ' . $e->getMessage());
}

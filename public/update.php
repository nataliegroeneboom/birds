<?php
include 'database.php';


$id= isset($_GET['id'])? $_GET['id'] : die('ERROR: Record ID not found');

try{
  $query = "SELECT id, name, description FROM birds WHERE id = ? LIMIT 0,1";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $id);
  $stmt->execute();
  $row = $stmt-> fetch(PDO::FETCH_ASSOC);

  $name = $row['name'];
  $description = $row['description'];
  if($_POST){

      $query = "UPDATE birds SET name=:name, description=:description WHERE id=:id";
      $stmt = $pdo->prepare($query);
      $name = htmlspecialchars(strip_tags($_POST['name']));
      $description=htmlspecialchars(strip_tags($_POST['description']));

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

      if($stmt->execute()){
        echo "<div class='alert alert-success'>
        Record was updated.</div>";
      }else{
        echo "<div class='alert alert-danger'>
        Unable to update  record.</div>";
      }

  }

}
catch(PDOException $e){
  die('ERROR: ' . $e->getMessage());
}

include '../templates/update.html.php';

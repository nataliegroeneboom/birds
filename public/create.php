<?php
if($_POST){

    // include database connection
    include 'database.php';

    try{

        // insert query
        $query = "INSERT INTO birds SET name=:name, description=:description, image=:image, created=:created";

        // prepare query for execution
        $stmt = $pdo->prepare($query);

        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $image=!empty($_FILES["image"]["name"])
        ?sha1_file($_FILES["image"]["tmp_name"]) . "-" .
        basename($_FILES["image"]["name"]): "";
        $image=htmlspecialchars(strip_tags($image));
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);


        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);

        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
            if($image){
              $target_directory = "files/";
              $target_file = $target_directory . $image;
              $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
              $file_upload_error_message = '';
              $check = getimagesize($_FILES["image"]["tmp_name"]);
              if($check!==false){
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                // make sure file does not exist
                  if(file_exists($target_file)){
                      $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                  }
                  // make sure submitted file is not too large, can't be larger than 1 MB
                  if($_FILES['image']['size'] > (4024000)){
                      $file_upload_error_messages.="<div>Image must be less than 4 MB in size.</div>";
                  }
                  // make sure the 'uploads' folder exists
                  // if not, create it
                  if(!is_dir($target_directory)){
                      mkdir($target_directory, 0777, true);
                  }
                  // if $file_upload_error_messages is still empty
                  if(empty($file_upload_error_messages)){
                      // it means there are no errors, so try to upload the file
                      if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                          // it means photo was uploaded
                      }else{
                          echo "<div class='alert alert-danger'>";
                              echo "<div>Unable to upload photo.</div>";
                              echo "<div>Update the record to upload photo.</div>";
                          echo "</div>";
                      }
              }

              // if $file_upload_error_messages is NOT empty
              else{
                  // it means there are some errors, so show them to user
                  echo "<div class='alert alert-danger'>";
                      echo "<div>{$file_upload_error_messages}</div>";
                      echo "<div>Update the record to upload photo.</div>";
                  echo "</div>";
              }
              }else{
                $file_upload_error_message .="<div>
                Submitted file is not an image.
                </div>";

              }

            }
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}

include __DIR__ . '/../templates/create.html.php';

<?php

class User{

private $conn;
private $table_name = "users";

public $id;
public $firstname;
public $lastname;
public $email;
public $contact_number;
public $address;
public $password;
public $access_level;
public $access_code;
public $status;
public $created;
public $modified;
public $profileStatus;
public $image;



      public function __construct($db){
        $this->conn = $db;
      }

      public function showError($stmt){
    echo "<pre>";
        print_r($stmt->errorInfo());
    echo "</pre>";
}

  function emailExists(){

    // query to check if email exists
    $query = "SELECT id, firstname, lastname, access_level, password, status
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";

    // prepare the query
    $stmt = $this->conn->prepare( $query );

    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));

    // bind given email value
    $stmt->bindParam(1, $this->email);

    // execute the query
    $stmt->execute();

    // get number of rows
    $num = $stmt->rowCount();


    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){

        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // assign values to object properties
        $this->id = $row['id'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->access_level = $row['access_level'];
        $this->password = $row['password'];
        $this->status = $row['status'];
     //   print($this->id);
        // return true because email exists in the database
        return true;
    }
        return false;

}




// create new user record
function create(){

    // to get time stamp for 'created' field
    $this->created=date('Y-m-d H:i:s');


    // insert query
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                contact_number = :contact_number,
                address = :address,
                password = :password,
                access_level = :access_level,
                access_code = :access_code,
                status = :status,
                created = :created";


    // prepare the query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->access_level=htmlspecialchars(strip_tags($this->access_level));
    $this->access_code=htmlspecialchars(strip_tags($this->access_code));
    $this->status=htmlspecialchars(strip_tags($this->status));


    // bind the values
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':contact_number', $this->contact_number);
    $stmt->bindParam(':address', $this->address);

    // hash the password before saving to database
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);

    $stmt->bindParam(':access_level', $this->access_level);
    $stmt->bindParam(':access_code', $this->access_code);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':created', $this->created);

    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }else{
        $this->showError($stmt);
        return false;
    }

}

function profileExists(){
          $query = "SELECT * FROM profileimage WHERE user_id = ? LIMIT 0,1";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(1, $this->id);
          $stmt->execute();
          $num = $stmt->rowCount();
          if($num>0){
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->profileStatus = $row['status'];
              return true;
          }else{
              return false;
          }
}

function createProfile(){
          $userStatus = 1;
          $this->conn->beginTransaction();

          try{
              $query = "INSERT INTO profileimage(user_id) SELECT id FROM ". $this->table_name ." WHERE id = ?";
              $stmt = $this->conn->prepare($query);
              $stmt->execute(array($this->id));

              $query = "UPDATE profileimage SET status = ? WHERE ID = ?";
              $stmt = $this->conn->prepare($query);
              $stmt->bindParam(1, $userStatus);
              $stmt->bindParam(2, $this->id);
              $stmt->execute();

              $this->conn->commit();



          }catch(Exception $e){
              echo $e->getMessage();
              $this->conn->rollBack();
          }
}

    function uploadPhotoTable(){
        $query = "UPDATE profileimage SET photo=? WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        $this->image;
        $stmt->bindParam(1, $this->image);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }


//adding profile image

    function uploadProfilePhoto(){
        $result_message="";
        $file_upload_error_messages = "";
        if($this->image){
            $target_directory = "images/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $this->image = "profile" . $this->id . "." . $file_type;
            $new_target_file = $target_directory . "profile" . $this->id . "." . $file_type;
            $file_upload_error_messages = '';


            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                // make sure file does not exist
                if(file_exists($new_target_file)){
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
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $new_target_file)){
                        // it means photo was uploaded
                        $query = "UPDATE profileimage SET photo=? WHERE id=?";
                        $stmt = $this->conn->prepare($query);
                        $stmt->execute(array($this->image, $this->id));
                        $newStatus = 0;
                        $sql = "UPDATE profileimage SET status = ?";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindParam(1, $newStatus);
                        $stmt->execute();
                    }else{
                        $result_message.= "<div class='alert alert-danger'>";
                        $result_message.=  "<div>Unable to upload photo.</div>";
                        $result_message.=  "<div>Update the record to upload photo.</div>";
                        $result_message.= "</div>";
                    }
                }

                // if $file_upload_error_messages is NOT empty
                else{
                    // it means there are some errors, so show them to user
                    $result_message.=  "<div class='alert alert-danger'>";
                    $result_message.=  "<div>{$file_upload_error_messages}</div>";
                    $result_message.=  "<div>Update the record to upload photo.</div>";
                    $result_message.=  "</div>";
                }
            }else{
                $file_upload_error_messages .="<div>
      Submitted file is not an image.
      </div>";

            }

        }
        return $result_message;

    }

    function readProfile(){
        $query= "SELECT photo, status
  FROM profileimage
  WHERE user_id = ?
  LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->image = $row['photo'];
        $this->profileStatus = $row['status'];

    }

        function readAll($from_record_num, $records_per_page){
            $query = "SELECT
                id,
                firstname,
                lastname,
                email,
                contact_number,
                access_level,
                created
            FROM " . $this->table_name . "
            ORDER BY id DESC
            LIMIT ?, ?";

         $stmt = $this->conn->prepare($query);

         $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
         $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

         $stmt->execute();
         return $stmt;
        }

    // used for paging users
    public function countAll(){

        // query to select all user records
        $query = "SELECT id FROM " . $this->table_name . "";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // return row count
        return $num;
    }



}

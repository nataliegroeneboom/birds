<?php
class Bird{

    // database connection and table name
    private $conn;
    private $table_name = "birds";

    // object properties
    public $id;
    public $name;
    public $description;
    public $image;
    public $category_id;
    public $timestamp;
    public $population;
    public $location;
    public $status;

    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description, image=:image, category_id=:category_id, created=:created,
                    population=:population, location-:location, status=:status";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->population=htmlspecialchars(strip_tags($this->population));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->status=htmlspecialchars(strip_tags($this->status));



        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->timestamp);
        $stmt->bindParam(":population", $this->population);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 }

 function readAll($from_record_num, $records_per_page){

    $query = "SELECT
                id, name, description, category_id
            FROM
                " . $this->table_name . "
            ORDER BY
                name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    return $stmt;
}

//used for gallery

public function readRandom(){
  $query = "SELECT id, name, image FROM "
  . $this->table_name . "
  ORDER BY RAND() LIMIT 10";

  $stmt = $this->conn->prepare( $query );
  $stmt->execute();
  return $stmt;
}

// used for paging products
public function countAll(){

    $query = "SELECT id FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    $num = $stmt->rowCount();

    return $num;
}

function readOne(){
  $query= "SELECT name, description, category_id, image, population, location, status
  FROM " . $this->table_name . "
  WHERE id = ?
  LIMIT 0,1";

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $this->name = $row['name'];
  $this->description = $row['description'];
  $this->category_id = $row['category_id'];
  $this->image = $row['image'];
  $this->population = $row['population'];
  $this->location = $row['location'];
  $this->status = $row['status'];
}

function update(){
  $query =" UPDATE
        ". $this->table_name .  "
            SET name = :name,
            description = :description,
            category_id = :category_id
        WHERE id = :id";

  $stmt = $this->conn->prepare($query);

  //posted values
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->description= htmlspecialchars(strip_tags($this->description));
  $this->category_id = htmlspecialchars(strip_tags($this->category_id));
  $this->id = htmlspecialchars(strip_tags($this->id));
  //bind parameters
  $stmt->bindParam(':name', $this->name);
  $stmt->bindParam(':description', $this->description);
  $stmt->bindParam(':category_id', $this->category_id);
  $stmt->bindParam(':id', $this->id);
  if($stmt->execute()){
    return true;
  }
  return false;
}

// delete the product
function delete(){

    $query = "DELETE FROM
    ". $this->table_name ."
    WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// read products by search term
public function search($search_term, $from_record_num, $records_per_page){

    // select query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.category_id, p.image, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ?
            ORDER BY
                p.name ASC
            LIMIT
                ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
}

public function countAll_BySearch($search_term){

    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
}


function uploadPhoto(){
  $result_message="";
  $file_upload_error_messages = "";
  if($this->image){
    $target_directory = "files/";
    $target_file = $target_directory . $this->image;
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

function autoCompleteSearch($search_term){
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE ?";
        $stmt = $this->conn->prepare($query);
    $search = "%{$search_term}%";
    $stmt->bindParam(1, $search);
    $stmt->execute();
    return $stmt;
}

}

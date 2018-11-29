<?php
class Siting {
    private $conn;
    private $table_name = "sitings";

    // object properties
    public $id;
    public $image;
    public $bird_name;
    public $bird_id;
    public $category_id;
    public $date;
    public $location;
    public $author;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        //write query


        try{
            $this->conn->beginTransaction();

            $query = "SELECT id FROM birds WHERE name = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($query);

            $this->bird_image = htmlspecialchars(strip_tags($this->bird_image));

            $stmt->bindParam(1, $this->bird_name);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->bird_id = $row['id'];


            $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    bird_image=:bird_image, created=:created, author_id=:author_id, bird_id=:bird_id;";

            $stmt = $this->conn->prepare($query);

            // posted values
            $this->bird_image = htmlspecialchars(strip_tags($this->bird_image));
            $this->created = htmlspecialchars(strip_tags($this->created));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->bird_id = htmlspecialchars(strip_tags($this->bird_id));

            // bind values

            $stmt->bindParam(":bird_image", $this->bird_image);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":author_id", $this->author_id);
            $stmt->bindParam(":bird_id", $this->bird_id);

            if($stmt->execute()){
                return true;
            }


            $this->conn->commit();
        }  catch(Exception $e){

            $this->conn->rollback();
            $e->getMessage();
        }




    }

    function getUserSitings(){

    }




}
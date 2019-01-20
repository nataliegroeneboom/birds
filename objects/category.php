<?php
class Category{

    // database connection and table name
    private $conn;
    private $table_name = "categories";

    // object properties
    public $id;
    public $name;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // used to read category name by its ID
function readName(){

    $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $row['name'];
}

    function create(){

            $query = "INSERT INTO 
                          " . $this->table_name . "
                          SET 
                          name=:name, created=:created";

            $stmt = $this->conn->prepare($query);
            $this->name = strtolower($this->name);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->timestamp = date('Y-m-d H:i:s');

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam('created', $this->timestamp);

            if($stmt->execute()){

                return true;
            }else{
                return false;
            }


    }






}










<?php

class Location{

    private $conn;
    private $table_name = "location";

    public $id;
    public $name;

    public function __construct($db){
       $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO
        " . $this->table_name  .  "
        SET name=:name";

        $stmt = $this->conn->prepare($query);

        $this->name = strtolower($this->name);
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":name", $this->name);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

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

}
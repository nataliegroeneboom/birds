<?php

class DatabaseTable {
    private $conn;
    private $table;
    private $primaryKey;

    public function __construct(PDO $db, string $table, string $id)
    {
        $this->conn = $db;
        $this->table = $table;
        $this->primaryKey = $id;
    }

    private function query($sql, $parameters = []){
        $query = $this->conn->prepare($sql);
        $query->execute($parameters);
        return $query;

    }

    public function sanitise($post){
        foreach($post as $key => $value){
            $post[$key] = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
        }
    }

}
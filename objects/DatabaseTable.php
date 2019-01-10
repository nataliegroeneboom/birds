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

    public function readName($value){
        $query= 'SELECT `name` FROM `' . $this->table . '` WHERE `' . $this->primaryKey .  '` = :value';
        $parameters = [
            ':value' => $value
        ];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }

    public function readAll(){
        $result = $this->query('SELECT * FROM ' . $this->table);
        return $result->fetchAll();
    }
    private function insert($fields) {
        $query ='INSERT INTO `' . $this->table . '` (';
        foreach($fields as $key => $value){
            $query .='`' . $key . '`,';
        }
        $query = rtrim($query, ',');
        $query .= ') VALUES (';
        foreach ($fields as $key => $value){
            $query .=':' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .=')';
        $fields = $this->processDates($fields);
        if($this->query($query, $fields)){
            return true;
        }else{
            return false;
        };
    }

    private function processDates($fields) {
foreach($fields as $key => $value){
    if($value instanceof DateTime) {
        $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function save($records){
        try{
            if($records[$this->primaryKey] =='') {
                $records[$this->primaryKey] = null;

                if($this->insert($records)){
                return true;
                }else{

                return false;
            }
            }
        }catch(PDOException $e){

        }

    }



}
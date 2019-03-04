<?php
namespace Natalie;

class DatabaseTable {
    private $conn;
    private $table;
    private $primaryKey;

    public function __construct(\PDO $db, string $table, string $id)
    {
        $this->conn = $db;
        $this->table = $table;
        $this->primaryKey = $id;
    }

    private function query($sql, $parameters = []){
        $sql;
        $parameters;
        $query = $this->conn->prepare($sql);
        $query->execute($parameters);
        return $query;

    }

    public function sanitise($post){
        foreach($post as $key => $value){
            $post[$key] = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
        }
    }

    private function update($fields) {
        $query = ' UPDATE `' . $this->table .'` SET ';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        //Set the :primaryKey variable
        $fields['primaryKey'] = $fields['id'];
        $fields = $this->processDates($fields);
        $this->upload($fields['image']);
        $this->query($query, $fields);
    }

    public function readName($value){
        $query= 'SELECT `name` FROM `' . $this->table . '` WHERE `' . $this->primaryKey .  '` = :value';
        $parameters = [
            ':value' => $value
        ];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }

    public function delete($id){
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id';
        $parameters = [
            ':id' => $id
        ];
        $this->query($query, $parameters);
    }

    public function find($column, $value){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';
        $parameters = [
            'value' => $value
        ];
        $query = $this->query($query, $parameters);
        return $query->fetchAll();
     }

    public function findById($value){
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey .  '` = :value';
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
        $query = 'INSERT INTO `' . $this->table . '` (';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }
        $query = rtrim($query, ',');
        $query .= ') VALUES (';
        foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ')';
        $fields = $this->processDates($fields);

        $this->upload($fields['image']);
        $this->query($query, $fields);
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

            if ($records[$this->primaryKey] == '') {
                $records[$this->primaryKey] = null;
            }
            if($records[$this->primaryKey]){

                $this->update($records);
            }else{
                if($this->insert($records)){

                }else{

                    return false;
                }
            }


        }catch(PDOException $e){
          //  $this->update($records);
        }

    }

    private function upload($file){
        $upload = $_FILES['image'];
        if(isset($upload)){
        $path = 'files/';
        $size = 420000;
        $target_file = $path . $file;
        $allowedFiles = array('jpg', 'jpeg', 'png');
        $result = [];

            if(!empty($upload) && !empty($path) && !empty($size) && !empty($allowedFiles)){
                //check if upload and allowed are an array
                if(is_array($upload) && is_array($allowedFiles)){
                    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                    if(!in_array($file_type, $allowedFiles)){
                        $result['type'] = 'error';
                        //  $this->_result['message'] = "File should be less then ".$this->_size . "bytes";
                        $result['message'] = "Only JPG, JPEG, PNG, GIF files are allowed.";
                        $result['path'] = false;


                    }
                    if($upload['size'] > $size){
                        $result['type'] = 'error';
                        $result['message'] = "File should be less then ". $size . " bytes";
                        $result['path'] = false;
                    }
                    if(file_exists($target_file)){
                        $result['type'] = 'error';
                        $result['message'] = "Image already exists";
                        $result['path'] = false;
                    }
                    if(!isset($result['error'])){
                        if(move_uploaded_file($upload['tmp_name'], $target_file)){
                            $result['type'] = 'success';
                            $result['message'] = "Image uploaded";
                            $result['path'] = true;
                        }else{
                            $result['type'] = 'error';
                            $result['message'] = "Image unable to be upload";
                            $result['path'] = false;
                        }
                    }
                }
            }

        }

        return $result;


    }



}
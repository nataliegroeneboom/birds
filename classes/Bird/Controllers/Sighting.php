<?php
namespace Bird\Controllers;
use \Natalie\DatabaseTable;

class Sighting
{
    private $birdTable;
    private $sightingTable;
    private $errors;
    private $sessions;
  

 

    public function __construct(DatabaseTable $birdTable, DatabaseTable $sightingTable, \File\ErrorRoutes $errors, \Natalie\Authentication $sessions){
        $this->birdTable = $birdTable;
        $this->sightingTable = $sightingTable;  
        $this->errors = $errors->getRoutes();  
        $this->sessions = $sessions;
    }


    public function create(){
        $title = 'Add a Sighting';
        $birds = $this->birdTable->readAll();
        return [
            'template' => 'sighting-create.html.php',
            'title' => $title,
            'variables' => ['birds' => $birds] 
        ];
    }

    public function store(){
  
        $sighting_variables = $_POST['sighting'];
            $sighting_variables['userId'] = $_SESSION['userId'];
            $this->sightingTable->save($sighting_variables);
    
        
        
        $message = [];

        if(isset($_FILES['images'])){
         $file_array = $this->reArrayFiles($_FILES['images']); 
        for($i=0; $i<count($file_array); $i++){
            if($file_array[$i]['error']){
                $error =  "<div class='alert alert-danger'>{$file_array[$i]['name']} - {$this->errors[$file_array[$i]['error']]}";
                array_push($message, $error);

            }
            else{
              $extensions = array('jpg', 'jpeg', 'png');  
              $file_ext = explode('.', $file_array[$i]['name']);
              $file_ext = end($file_ext);
              if(!in_array($file_ext, $extensions)){
                $error= "<div class='alert alert-danger'>{$file_array[$i]['name']} is not an image</div>";
                array_push($message, $error);
              }
              else{
                  $this->pre_r($this->errors);
                 move_uploaded_file($file_array[$i]['tmp_name'],  'files/' . $file_array[$i]['name']);
                 $error= "<div class='alert alert-success'>{$file_array[$i]['name']} - {$this->errors[$file_array[$i]['error']]}</div>";
                 array_push($message, $error);
              }

            }
        }
        // var_dump($message);
        $this->sessions->setError($message);

        }
        header('location:/home');
        exit;
       
    }

    protected function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    protected function reArrayFiles($file_post){
        $file_array = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for($i=0; $i<$file_count; $i++){
            foreach($file_keys as $key){
                $file_array[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_array;
    }




}
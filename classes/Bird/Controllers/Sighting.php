<?php
namespace Bird\Controllers;
use \Natalie\DatabaseTable;

class Sighting
{
    private $birdTable;
    private $sightingTable;
    private $errors;
    private $sessions;
    private $imageTable;
    private $currentId;
 

    public function __construct(
        DatabaseTable $birdTable,
        DatabaseTable $sightingTable,
        \File\ErrorRoutes $errors,
        \Natalie\Authentication $sessions,
        DatabaseTable $imageTable){
        $this->birdTable = $birdTable;
        $this->sightingTable = $sightingTable;  
        $this->errors = $errors->getRoutes();  
        $this->sessions = $sessions;
        $this->imageTable = $imageTable;
    }


    public function create(){
        $message= [];
        if(!$this->sessions->isLoggedIn()){
            $error = "<div class='alert alert-danger'> You need to login to post bird sightings</div>";
            array_push($message, $error);
            $this->sessions->setError($message);
            header('location:/login');
            exit;

        }
        $title = 'Add a Sighting';
        $birds = $this->birdTable->readAll('birdname');
        return [
            'template' => 'sighting-create.html.php',
            'title' => $title,
            'variables' => ['birds' => $birds] 
        ];
    }

    public function store(){
        $message = [];
        $sighting_variables = $_POST['sighting'];
        $sighting_variables['userId'] = $_SESSION['userId'];
        if(!isset($sighting_variables['birdId'])){
            $error = "<div class='alert alert-danger'> Bird Select field can't be empty</div>";
            array_push($message, $error);
        }
        foreach ($sighting_variables as $key => $value){
          switch($key):
              case 'latitude':
                  break;
              case 'longitude':
                  break;
              case 'userId':
                  break;
              default:
                  if($value==''){
                      $error = "<div class='alert alert-danger'>{$key} field can't be empty</div>";
                      array_push($message, $error);
                  }
         endswitch;

        }

        if(!empty($message)){
            $this->sessions->setError($message);
            header('location:/sighting/create');
            exit;
        }else{

            $this->currentId = $this->sightingTable->lastPrimary($sighting_variables);
        }





        if(!empty($_FILES['images']['name'][0])){

         $file_array = $this->reArrayFiles($_FILES['images']); 
        for($i=0; $i<count($file_array); $i++){
           $image = $_FILES['images'];
            $image_name = sha1_file($image['tmp_name'][$i]) . "-" . basename($image['name'][$i]);
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

                 $images['fileName'] = $image_name;
                 $images['sightingId'] = $this->currentId;
                 $this->imageTable->save($images);
                 move_uploaded_file($file_array[$i]['tmp_name'],  'files/' . $image_name);
                 $error= "<div class='alert alert-success'>{$file_array[$i]['name']} - {$this->errors[$file_array[$i]['error']]}</div>";
                 array_push($message, $error);
              }

            }
        }
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
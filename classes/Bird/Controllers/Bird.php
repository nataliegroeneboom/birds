<?php

namespace Bird\Controllers;
use \Natalie\DatabaseTable;

class Bird{
    private $birdTable;
    private $categoryTable;
    private $sightingTable;
    private $sessions;



    public function __construct(DatabaseTable $birdTable, 
                            DatabaseTable $categoryTable,
                            DatabaseTable $sightingTable,
                            \Natalie\Authentication $sessions){
        $this->birdTable = $birdTable;
        $this->categoryTable = $categoryTable;
        $this->sightingTable = $sightingTable;
        $this->sessions = $sessions;
    }

    
    public function delete(){
        $this->birdTable->delete($_POST['id']);
        if($_POST['image']!==''){
            $image = $_POST['image'];
            if(!unlink('files/'.$image)){
                return;
            }
        }
        header('location: /home');
    }

    public function list(){
    $result = $this->birdTable->readAll('birdname');
    $birds = [];
    foreach($result as $bird){
        $category = $this->categoryTable->readName($bird['category_id']);
        $birds[] =  [
                    'id' => htmlspecialchars($bird['id'], ENT_QUOTES, 'UTF-8'),
                    'name' => htmlspecialchars($bird['birdname'], ENT_QUOTES, 'UTF-8'),
                    'description' => htmlspecialchars($bird['description'], ENT_QUOTES, 'UTF-8'),
                    'category' => htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'),
                   'image' => htmlspecialchars($bird['image'], ENT_QUOTES, 'UTF-8'),
                    ];
        }
        ob_start();
        if($_GET['message']=='success'){
            echo "<div class='alert alert-info'>Image uploaded</div>";
        }else{
            echo "<div class='alert alert-danger'>Error Image not uploaded</div>";
        }

        $message = ob_get_clean();
        $title = 'Australian Birds';
        return ['template' => 'read_template.html.php',
            'title' => $title,
            'message' => $message,
            'variables' => [
                'birds' => $birds
            ]
        ];

    }

    public function read(){
        if (isset($_GET['id'])) {
            $result = $this->birdTable->findById($_GET['id']);
           
            $category = $this->categoryTable->readName($result['category_id']);
            $individual = [];
            $individual[] = [
                'id' => htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'),
               'name' => htmlspecialchars($result['birdname'], ENT_QUOTES, 'UTF-8'),
               'description' => htmlspecialchars($result['description'], ENT_QUOTES, 'UTF-8'),
               'category' => htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'),
                'status' => htmlspecialchars($result['status'], ENT_QUOTES, 'UTF-8'),
                'image' => htmlspecialchars($result['image'], ENT_QUOTES, 'UTF-8'),
            ];

            $sightings = $this->sightingTable->getSightingByBirdId($_GET['id']);
            
            $title = $result['birdname'];

            return ['template' => 'individual.html.php',
                'title' => $title,
                'variables'=> [
                    'bird' => $result,
                    'category' => $category,
                    'sightings' => $sightings
                ]
        ];
        }
    }


    public function saveEdit(){
        $bird_variables = $_POST['bird'];
        $message = [];

        foreach($bird_variables as $key=>$value){
          
                switch($key):
                    case 'image':
                        break;
                    case 'id':
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
            header('location:/bird/edit');
            exit;
        }
        
        
        
        $file = new \File\Upload;
        $file->setImage($bird_variables['image']);
        if(!empty($_FILES['image']['name'])){
            if($file->uploadNewImage($_FILES['image'])){
            $file->deleteOldImage();
            $bird_variables['image'] = $file->getNewImage();
            }
        }
        if(!empty($_FILES['audioFile']['name'])){

            $audio = $_FILES['audioFile']['name'];
            $file->uploadAudio($_FILES['audioFile']);
            $bird_variables['audio'] = $file->getAudioName();
        }



        $result = $this->birdTable->save($bird_variables);
        header('location:/home');
        exit;


    }

    protected function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    public function edit(){

            if (isset($_GET['id'])) {
                $bird_variables = $this->birdTable->findById($_GET['id']);
            }
            if(isset($bird_variables['birdname'])){
                $title = 'Edit ' . $bird_variables['birdname'];
            }else{
                $title = 'Create Bird';
            }
            
            $categories = $this->categoryTable->readAll('name');
            return [
                'template' => 'create.html.php',
                'title' => $title,
                'variables' => [
                    'categories' => $categories,
                    'bird' => $bird_variables ?? null
                ]
            ];

         }
}
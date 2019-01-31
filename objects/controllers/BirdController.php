<?php

class BirdController{
    private $birdTable;
    private $categoryTable;
    private $locationTable;




    public function __construct(DatabaseTable $birdTable, DatabaseTable $categoryTable, DatabaseTable $locationTable){
        $this->birdTable = $birdTable;
        $this->categoryTable = $categoryTable;
        $this->locationTable = $locationTable;

    }

    public function list(){
    $result = $this->birdTable->readAll();
    $birds = [];
    foreach($result as $bird){
        $category = $this->categoryTable->readName($bird['category_id']);
        $birds[] =  [
                    'id' => htmlspecialchars($bird['id'], ENT_QUOTES, 'UTF-8'),
                    'name' => htmlspecialchars($bird['birdname'], ENT_QUOTES, 'UTF-8'),
                    'description' => htmlspecialchars($bird['description'], ENT_QUOTES, 'UTF-8'),
                    'category' => htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8')
                    ];
        }
        $title = 'Bird List';
        ob_start();
        echo "<div class='alert alert-info'>
        content when logged in will be here
         </div>";
        $message = ob_get_clean();
        $title = 'Bird list';
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
  //              'population' => htmlspecialchars($result['population'], ENT_QUOTES, 'UTF-8'),
                'status' => htmlspecialchars($result['status'], ENT_QUOTES, 'UTF-8'),
                'image' => htmlspecialchars($result['image'], ENT_QUOTES, 'UTF-8'),


            ];

            $title = $result['birdname'];

            return ['template' => 'individual.html.php',
                'title' => $title,
                'variables'=> [
                    'bird' => $result,

                ]
        ];
        }
    }



    public function edit(){
        $result = [];
        if(isset($_POST['bird'])){
            $bird_variables = $_POST['bird'];
            $bird_variables['image']=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";
            $bird_variables['created'] = date('Y-m-d H:i:s');

            $result = $this->birdTable->save($bird_variables);
            header('location: index.php?action=list');

        }else{

            if (isset($_GET['id'])) {
                $bird_variables = $this->birdTable->findById($_GET['id']);
            }

            $title = 'Create Bird';
            $categories = $this->categoryTable->readAll();
            $locations = $this->locationTable->readAll();
            return [
                'template' => 'create.html.php',
                'title' => $title,
                'variables' => [
                    'categories' => $categories,
                    'locations' => $locations,
                    'bird' => $bird_variables ?? null

                ]
            ];

        }


    }
}
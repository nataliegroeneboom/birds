<?php

class BirdController{
    private $birdTable;
    private $categoryTable;


    public function __construct(DatabaseTable $birdTable, DatabaseTable $categoryTable){
        $this->birdTable = $birdTable;
        $this->categoryTable = $categoryTable;
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



    public function edit(){
        if(isset($_POST['bird'])){
            $bird_variables = $_POST['bird'];
            $bird_variables['image']=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";
            $bird_variables['created'] = date('Y-m-d H:i:s');
            if($this->birdTable->save($bird_variables)){
                if($bird_variables['image']!==''){

                }
            };
        }
    }
}
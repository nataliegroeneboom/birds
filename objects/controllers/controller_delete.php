<?php

class Controller {
    private $birdTable;
    private $categoryTable;


    public function __construct(DatabaseTable $birdTable, DatabaseTable $categoryTable){
        $this->birdTable = $birdTable;
        $this->categoryTable = $categoryTable;
    }

    public function login_success(){
        header('location: index.php?action=list');

    }
    public function list(){
        $result = $this->birdTable->readAll();
        $birds = [];

        foreach($result as $bird){
            $bird['category_id'];
            $category = $this->categoryTable->readName($bird['category_id']);
            $birds[] = [
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





public function already_logged_in(){
        ob_start();
    echo "<div>
  <strong>You are already logged in</strong>
  </div>";
    return ob_get_clean();
}

public function home(){

    $title = 'Index';
    ob_start();
    echo "<div class='alert alert-info'>
content when logged in will be here
</div>";
    $message = ob_get_clean();

 //   return ['template' => 'read_template.html.php', 'title' => $title, 'message' => $message];

}


    

}

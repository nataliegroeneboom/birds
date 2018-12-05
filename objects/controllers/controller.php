<?php

class Controller {
    private $birdTable;
    private $categoryTable;


    public function __construct(DatabaseTable $birdTable, DatabaseTable $categoryTable){
        $this->birdTable = $birdTable;
        $this->categoryTable = $categoryTable;
    }

    public function login_success(){
        ob_start();
        echo "<div class='alert alert-info'><strong>Hi " . $_SESSION['firstname'] . ", welcome back!";
        echo"</strong></div>";
        return ob_get_clean();

    }
public function already_logged_in(){
        ob_start();
    echo "<div>
  <strong>You are already logged in</strong>
  </div>";
    return ob_get_clean();
}

public function home(){
        ob_start();
    echo "<div class='alert alert-info'>
content when logged in will be here
</div>";
    ob_get_clean();
}

    

}

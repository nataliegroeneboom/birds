# Bird Encyclopedia - learning to build a website in php

I am learning the basics of CRUD object orientated PHP by creating a table of bird species where you can add, delete, edit and view individually details about birds.  

## Rewriting my code: Adding Birds

I am rewriting my code so the there are reusable methods.

In my bird website I have a class called Bird that manages the update,
insert, deletion of birds on the website.  I want to move my some 
of my functions to a generic DatabaseTable class managing all tables queries. I am focusing on adding
birds to the database


## Adding the Action: edit
Within the read_template I added the action 'edit' to the create bird
```html
 <div class='right-button-margin'>
   <a href='index.php?action=edit' class='btn btn-primary pull-right'>
    <span class='glyphicon glyphicon-plus'></span> Create Bird </a>
  </div>
```

## Controller Class
In the contoller I create the edit method, if a post request was made the database table method save is triggered.
```php
   public function edit(){
        $result = [];
        if(isset($_POST['bird'])){
            $bird_variables = $_POST['bird'];
            $bird_variables['image']=!empty($_FILES['image']["name"])?sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES['image']['name']) : "";
            $bird_variables['created'] = date('Y-m-d H:i:s');

            $result = $this->birdTable->save($bird_variables);

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
                'result' => $result

            ]
        ];
    }

```

## DatabaseTable Class
The save method is triggered, which in turn triggers methods that create the query, run the query and upload the image (if there is one);

#### Database Table: Save method
```php
    public function save($records){
        try{
                if($this->insert($records)){

                }else{

                return false;
            }

        }catch(PDOException $e){

        }

    }
```
#### DatabaseTable: insert method
```php
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
```
### DatabaseTable: query method

```php
    private function query($sql, $parameters = []){
        $sql;
        $parameters;
        $query = $this->conn->prepare($sql);
        $query->execute($parameters);
        return $query;

    }
```
### DatabaseTable: upload method
```php
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
```
 
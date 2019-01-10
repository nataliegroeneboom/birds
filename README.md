# Bird Encyclopedia - learning to build a website in php

I am learning the basics of CRUD object orientated PHP by creating a table of bird species where you can add, delete, edit and view individually details about birds.  

## Rewriting my code

In this branch I am trying to rewrite my code so the there are reusable methods.

In my bird website I have a class called Bird that manages the update,
insert, deletion of birds on the website.  I want to move my some 
of my functions to a generic DatabaseTable class managing all tables queries.

## DatabaseTable Class
I created a Class that deals with all the sql queries to the database, reducing the 
code and repetition.  I save this file within the Objects folder.  The database connection, table name and primary key are
passed as parameters. The birdTable and categoryTable classes are instantiated in 
the index.php file.
 
```php
$birdTable = new DatabaseTable($db, 'birds', 'id');
$categoryTable = new DatabaseTable($db, 'categories', 'id');

```  

## Controllers
Within the objects folder I create another folder named controllers and I create a 
file named BirdController.php.  The BirdTable and CategoryTable DatabaseTable Class will
be passed as parameters to the controller.

```php
$controller = new BirdController($birdTable, $categoryTable);
```

I am currently working on the frontpage functionality of displaying all the bird
information on the front page.  The action is saved in a $action variable and then called as a 
$controller method.

```php
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$page_redirect = $controller->$action();
```

As no action is called for the list page (no redirection made), the method I create in the 
BirdController is the list method.

#### BirdController: list method
```php
   public function list(){
    $result = $this->birdTable->readAll();
``` 
I call the DatabaseTable method readAll()
#### DatabaseTable Class: readAll Method
```php
  public function readAll(){
        $result = $this->query('SELECT * FROM ' . $this->table);
        return $result->fetchAll();
    }
```
This calls a private method query that connects to the database, with optional parameters as we
select all no parameters are passed for readAll method. This returns the result to $result that is in turn
returns to the variable $result in the list method.

```php
    private function query($sql, $parameters = []){
        $query = $this->conn->prepare($sql);
        $query->execute($parameters);
        return $query;
    }
```

#### BirdController: back to the list method
I assign the $birds variable to an empty array and loop through the $result array.

```php
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
        
  ```
  Another DatabaseTable method readName() is called on the category table.  Passing the primary key (category_id) as a
  parameter to the readName method.   
  
  #### DatabaseTable Class: readName Method
  ```php
   public function readName($value){
          $query= 'SELECT `name` FROM `' . $this->table . '` WHERE `' . $this->primaryKey .  '` = :value';
          $parameters = [
              ':value' => $value
          ];
          $query = $this->query($query, $parameters);
          return $query->fetch();
      }
  ```
  
   #### BirdController: back to the list method
   $title, $message are assigned.  $variables holds one or more variables. 
  These all all returned in a array. 
  
  ```php

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
```

#### The index.php
The variable $page_redirect holds the data.  If there are variables, as they are embedded
in an array they are extracted.  The title is stored as a global variable $page_title.
The template returned from the controller is outputted.  This reusable code will help reduce
error and easiler to read.


```php
$page_title = $page_redirect['title'];
... 
echo "{$page_redirect['message']}";
...
include_once "../templates/{$page_redirect['template']}";

```


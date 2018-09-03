<?php

try{
  $pdo = new PDO('mysql:host=db;dbname=db;charset=utf8',
                 'db', 'db');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
  $output = 'Unable to connect to database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':'
  . $e->getLine();
}

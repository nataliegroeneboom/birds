<?php


include_once('workshop.html.php');
$workshop=$_POST['workshop'];
if(isset($workshop)){
    echo($workshop['name']);
};
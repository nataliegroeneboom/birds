<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $page_title? strip_tags($page_title): "Bird Encylopedia" ?></title>
    <!-- jquery theme roller -->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
  <!-- Bootstrap CSS -->

   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <link rel="stylesheet" type="text/css" href="http://wildlife.ddev.local/libs/css/style.css" />
   <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" />


</head>
<body>
<?php include_once "navigation.html.php" ?>
<div class="container"><!-- container -->
  <div class="page-header">
    <?php if($page_title!="Login"){ ?>
      <h1><?= isset($page_title) ? $page_title : "World of Australian Birds" ?></h1>
  </div>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= isset($page_title)? strip_tags($page_title): "Content Admin" ?></title>
  <!-- Bootstrap CSS -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$home_url . 'libs/css/admin.css' ?>" rel="stylesheet" />
</head>
<body>
<?php include_once "./navigation.html.php" ?>
<div class="container"><!-- container -->
  <div class="col-md-12">
      <div class="page-header">
        <h1><?= isset($page_title)? strip_tags($page_title): "Bird Encyclopedia" ?></h1>
      </div>
  </div>

</div><!-- end .container -->

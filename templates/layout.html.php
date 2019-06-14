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
  <link rel="stylesheet" type="text/css" href="/libs/css/style.css" />
   <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" />
</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home">Bird Encyclopedia</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php echo $page_title==="Index"?"class='active'":"";?>>
                <a href="/home"><span class="glyphicon glyphicon-home"></span>Home</a>
          </li>
        </ul>
        <?php if($loggedIn):?>
        <ul class="nav navbar-nav navbar-right" style="margin-bottom:0;">
          <li <?=$page_title=="Edit Profile"?"class='active'":"";?> >
            <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              &nbsp;&nbsp;<?=$_SESSION['username']; ?>
              &nbsp;&nbsp;
               <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="/sighting/create">Add a sighting</a>
                <a href="/logout">Logout</a>
              </li>

            </ul>
          </li>
        </ul>
      <?php else:?>
        <ul class="nav navbar-nav navbar-right">
          <li <?=$page_title=="Login"? "class='active'": "";?>>
            <a href="/login">
              <span class="glyphicon glyphicon-log-in"></span> Login
            </a>
          </li>
          <li <?=$page_title=="Register"?"class='active'": "";?>>
            <a href="/user/register">
              <span class="glyphicon glyphicon-check"></span>Register
            </a>
          </li>
        </ul>

<?php
endif;?>
      </div><!--/.nav-collapse-->
    </div>
</div>

<!--/.navbar-->
<div class="hero">
<div class="darken-overlay">
  <h1>Explore the world of Australian Birds</h1>
</div>
</div>

<div class="container"><!-- container -->
<?php  if(isset($_GET['q']) && $_GET['q']!=='/home'):
  echo '<button id="btn-back"><span class="	glyphicon glyphicon-arrow-left"></span><a href="/home"> Back to Home page</a></button>';
endif;
?>
  <div class="page-header">
    <?php if($page_title!="Login"){ ?>
      <h1><?= isset($page_title) ? $page_title : "World of Australian Birds" ?></h1>
  </div>
  <?php } 
 if(isset($_SESSION['error'])){
   foreach($_SESSION['error'] as $error){
    echo $error;
   }
   unset($_SESSION['error']);
 }

  ?>
  
<main>


<?=$output?>
</main>
  </div>
  <footer><div class="container"> This website is purely for website development training purposes</div></footer>
 </body> 
<!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- Clamp.js file library -->
<script src="/libs/js/clamp.min.js"></script>

<script src="/libs/js/main.js"></script>

</body>
</html>
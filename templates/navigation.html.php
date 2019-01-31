<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $home_url; ?>">Bird Encyclopedia</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php echo $page_title==="Index"?"class='active'":"";?>>
                <a href="<?= $home_url ?>">Home</a>
          </li>
        </ul>
        <?php
        // if user was logged in, show "Edit Profile", "Orders" and "Logout" option
        if(isset($_SESSION['logged_in'])&&$_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
?>
    <ul class="nav navbar-nav navbar-left">
      <li <?php echo $page_title==="About Us"?"class='active'":"";?>>
        <a >About</a>
      </li>
      <li <?php echo $page_title==="Glossary"?"class='active'":"";?>>
        <a >Glossary</a>
      </li>
      <li <?php echo $page_title==="Gallery"?"class='active'":"";?>>
        <a>Gallery</a>
      </li>
        <li <?php echo $page_title==="Your Page"?"class='active'":"";?>>
            <a>Your Page</a>
        </li>
    </ul>

        <ul class="nav navbar-nav navbar-right" style="margin-bottom:0;">
          <li<?=$page_title=="Edit Profile"?"class='active'":"";?>>
            <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              &nbsp;&nbsp;<?=$_SESSION['firstname']; ?>
              &nbsp;&nbsp;
               <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="<?=$home_url; ?>logout.php">Logout</a>
              </li>

            </ul>
          </li>
        </ul>
      <?php
        }
        else{
?>
        <ul class="nav navbar-nav navbar-right">
          <li <?=$page_title=="Login"? "class='active'": "";?>>
            <a href="<?= $home_url; ?>login.php">
              <span class="glyphicon glyphicon-log-in"></span> Login
            </a>
          </li>
          <li <?=$page_title=="Register"?"class='active'": "";?>>
            <a href="<?= $home_url; ?>register.php">
              <span class="glyphicon glyphicon-check"></span>Register
            </a>
          </li>
        </ul>

<?php
}
        ?>
      </div><!--/.nav-collapse-->
    </div>
</div>

<!--/.navbar-->
<div class="hero">
<div class="darken-overlay">
  <h1>Explore the world of Australian Birds</h1>
</div>
</div>



  <!-- get 'action' value in url parameter to display corresponding prompt message -->
<?php
  $action=isset($_GET['action'])?$_GET['action']:'';
  if($action =='not_yet_logged_in'){
?>
<div class='alert alert-danger margin-top-40' role='alert'>
    Please Login
    </div>
<?php
}else if($action=='please_login'){
  ?>
<div class="alert alert-info">
  <strong>Please login to access that page</strong>
</div>

  <?php
  if($access_denied){
    ?>
 <div class="alert alert-danger margin-top-40" role='alert'>
   Access Denied <br /><br />
   Your username or password maybe incorrect
 </div>

    <?php
  }

}
?>
<div class='col-sm-6 col-md-4 col-md-offset-4'>


    <div class="account-wall">
        <div id="my-tab-content" class="tab-content">
          <div class='tab-pane active' id='login'>
          <img class="profile-img" src='images/login-icon.png' />
          <form class="form-signin" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="text" name="email" class="form-control" placeholder="Email" required autofocus />
            <input type='password' name='password' class='form-control' placeholder='Password' required />
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" />
          </form>
          </div>
        </div>
    </div>
</div>

<?php 
    if(isset($error)):
        echo '<div class="error">' . $error . '</div>';
    endif;
?>

<form method="post" action="">
<label for="name">Name</label>
     <input type='text' id="name" class='form-control' require  />

      <label for="email">Email</label>
      <input id="email" type='email' class='form-control' name="email" require />
 

      <label for="password">Password</label>
      <input id="password" type='password' class='form-control' id='passwordInput' name="password" require> 

        <input type="submit" name="login" class="btn btn-primary" value="Log in"/>
</form>

<p>Don't have an account? <a href="/user/register">Click here to register an account</a></p>
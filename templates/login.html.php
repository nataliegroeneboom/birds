<?php 
    if(isset($error)): ?>
       <div class="errors"><p class="error"><?=$error;?></p></div>
<?php  endif;?>

<form method="post" action="">
 <div class="user-form">
 <label for="name">Name</label>
 <input type='text' id="name" class='form-control' require  />
 </div>   
<div class="user-form">
<label for="email">Email</label>
      <input id="email" type='email' class='form-control' name="email" require />
</div>

<div class="user-form">
<label for="password">Password</label>
      <input id="password" type='password' class='form-control' id='passwordInput' name="password" require> 
</div>   
 
<input type="submit" name="login" class="btn bird-primary submit" value="Log in"/>
</form>

<p>Don't have an account? <a href="/user/register">Click here to register an account</a></p>
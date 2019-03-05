<div class='col-md-12'>
<?php if(!empty($errors)):?>
  <div class="errors">
    <p>Your account couldn't be created, please check the following:</p>
    <ul>
      <?php foreach($errors as $error): ?>
        <li><?= $error ?></li>    
<?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?> 
<form action='' method='post' id='register'>
 
  <div class="user-form">
  <label for="name">Name</label>
     <input type='text' name='user[name]' id="name" class='form-control' require value="<?=$user['name'] ?? '' ?>" />
  </div>
     
  <div class="user-form">
  <label for="email">Email</label>
      <input type='email' name='user[email]' class='form-control' require value="<?=$user['email'] ?? '' ?>" />
  </div>
     
 
<div class="user-form">
<label for="password">Password</label>
      <input type='password' name='user[password]' class='form-control' require id='passwordInput' value="<?=$user['password'] ?? '' ?>" >
</div>
         
        <input type="submit" name="submit" class="btn bird-primary submit" value="Register"/>
         
        



</form>

</div>

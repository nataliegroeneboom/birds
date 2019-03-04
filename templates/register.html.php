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
 

      <label for="name">Name</label>
     <input type='text' name='user[name]' id="name" class='form-control' require value="<?=$user['name'] ?? '' ?>" />

      <label for="email">Email</label>
      <input type='email' name='user[email]' class='form-control' require value="<?=$user['email'] ?? '' ?>" />
 

      <label for="password">Password</label>
      <input type='password' name='user[password]' class='form-control' require id='passwordInput' value="<?=$user['password'] ?? '' ?>" >


      

        <input type="submit" name="submit" class="btn bird-primary" value="Register Account"/>
         
        



</form>

</div>

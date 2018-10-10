<div class='col-md-12'>
<form action='register.php' method='post' id='register'>
  <table class='table table-responsive'>
    <tr>
      <td class='width-30-percent'> Firstname</td>
      <td><input type='text' name='firstname' class='form-control' require value="<?=isset($_POST['firstname'])?htmlspecialchars($_POST['firstname'], ENT_QUOTES) : ''?>" /></td>
    </tr>
    <tr>
      <td> Lastname</td>
      <td><input type='text' name='lastname' class='form-control' require value="<?=isset($_POST['lastname'])?htmlspecialchars($_POST['firstname'], ENT_QUOTES) : ''?>" /></td>
    </tr>
    <tr>
      <td>Contact Number</td>
      <td><input type='text' name='contact_number' class='form-control' require value="<?=isset($_POST['contact_number'])?htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : ''?>" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><textarea name='address' class='form-control' require value="<?=isset($_POST['address'])?htmlspecialchars($_POST['address'], ENT_QUOTES) : ''?>"></textarea></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type='email' name='email' class='form-control' require value="<?=isset($_POST['email'])?htmlspecialchars($_POST['email'], ENT_QUOTES) : ''?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type='password' name='password' class='form-control' require id='passwordInput'</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <button type="submit" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> Register
        </button>
      </td>
    </tr>
  </table>
</form>

</div>
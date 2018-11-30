<?php

include_once "../../config/core.php";

//include_once "login_checker.php";

$page_title="Admin Index";

include_once 'header.html.php';

echo "<div class='col-md-12'>";

$action = isset($_GET['action'])? $_GET['action']:"";
if($action=='already_logged_in'){
echo "<div class='alert alert-info'>
<strong>You</strong> are already logged in.
</div>";



}else if($action=='logged_in_as_admin'){
  echo "<div class='alert alert-info'>
  <strong>You</strong> are already logged in as admin
  </div>";
}

echo "<div class='admin-content'>
<button><a href='content.php'>Add a Bird</a></button>
<button><a href='taxonomy.php'>Add Taxonomies</a></button>

</div>";

echo "</div>";

include_once 'templates/footer.html.php';

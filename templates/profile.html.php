<div class="profile">

<h1>Welcome to your page</h1>
<?php
if($profileimage_exists){

?>

    <div><?php echo "<img src='images/{$fileNameNew}'>"?></div>
<?php
}else {
    ?>

    <div><img src="images/profile_placeholder.jpg"></div>

    <?php
}
?>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" >
       <input type="file">
       <button type="submit" name="submit">UPLOAD</button>
   </form>

</div>
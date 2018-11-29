<div class="profile">

<h1>Welcome to your page</h1>
<?php
if($showForm){

?>

    <div><img src="images/profile_placeholder.jpg"></div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" >
        <input type="file" name="image">
        <button type="submit" name="submit">UPLOAD</button>
    </form>



<?php
}else {
    ?>

    <div><?php echo $user->id ?></div>
    <div><?php echo "<img src='images/{$user->image}'>"?></div>

    <?php
}
?>
    <h3>Add photos of birds you have taken</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" >
        <label for="search">Type of Bird Sited</label>
        <input type="text" name="search" id="search" value="" />
        <div id="response"></div>
        <label for="sitingdate">Date of Siting</label>
        <input type="date" name="sitingdate" id="siting" value="" />
        <label for="image">Date of Siting</label>
        <input type="file" name="image" />
        <button type="submit" name="submitbird">UPLOAD</button>
    </form>

</div>
<div class="gallery">
                <?php   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                $imagePath = 'files/' . $image;
                $htmlImage = strtolower(preg_replace('/\s+/', '', $name));
                ?>
    <div class="bird-image" id="<?=$htmlImage?>">
    <?php  if (file_exists('files/'.$image)&&$image) {  $imagePath = 'files/'.$image ?>

      <a href="individual.php?id=<?=$id?>"><img class="img-responsive" src="<?=$imagePath ?>"/></a>
      <div class="bird-name"><?=$name?></div>


    <?php } ?>
    </div>
    <?php } ?>
</div>

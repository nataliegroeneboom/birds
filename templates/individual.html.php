
<div class="container">


<div class="individual-page">
  <div class="individual-top">
    <div class="individual-image">
      <?php echo $bird->image? "<img class='img-responsive' src='files/{$bird->image}' />": "No image found"; ?>
    </div>
    <div class="individual-stats">
      <div class="population">
        <span class="indiv-label">Population:</span><span><?php if(empty($bird->population)){
          echo "Not Known";
        }else{
          echo "&nbsp;&nbsp;&nbsp;" .  $bird->population;
        }?></span>
      </div>
      <div class="category">
        <span class="indiv-label">Category:</span>
        <span>
        <?php
          $category->id = $bird->category_id;
          $category->readName();
          echo "&nbsp;&nbsp;" .  $category->name;
         ?>
         </span>
      </div>
      <div class="location">
        <span class="indiv-label">Location:</span>
        <span>
          <?php echo "&nbsp;&nbsp;" . $bird->location ?>
        </span>
      </div>
      <div class="status">
        <span class="indiv-label">Status:</span>
        <span>
          <?php echo "&nbsp;&nbsp;" . $bird->status ?>
        </span>
      </div>
    </div>
  </div>
  <div class="individual-bottom">
    <p>
      <?=$bird->description ?>
    </p>
  </div>
</div>

</div>

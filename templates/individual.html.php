



<div class="individual-page">
  <div class="individual-top indiv-layout">
    <div class="individual-image box">
      <?php

      echo $bird['image']? "<img class='img-responsive img-rounded' src='/files/{$bird['image']}' />": "No image found"; ?>
    </div>
    <div class="individual-stats box">
      <div class="category">
        <span class="indiv-label">Category:</span>
        <span>
        <?php
          echo "&nbsp;&nbsp;" .  $bird['birdname'];
         ?>
         </span>
      </div>

      <div class="status">
        <span class="indiv-label">Status:</span>
        <span>
          <?php echo "&nbsp;&nbsp;" . $bird['status'] ?>
        </span>
      </div>
    </div>
  </div>
  <div class="individual-bottom">
    <p>
      <?=$bird['description'] ?>
    </p>
  </div>
</div>



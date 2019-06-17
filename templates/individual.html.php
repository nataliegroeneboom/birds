



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
          echo "&nbsp;&nbsp;" .  $category['name'];
         ?>
         </span>
      </div>

      <div class="status">
        <span class="indiv-label">Status:</span>
        <span>
          <?php echo "&nbsp;&nbsp; Least Concern"; ?>
        </span>
      </div>

        <?php if(isset($bird['audio'])): ?>
            <div class="audio">
                <span class="indiv-label">Audio:</span>
                <span>
                <audio controls>
            <?php   echo  " <source src='/files/{$bird['audio']}' type='audio/mpeg'>
                            <source src='/files/{$bird['audio']}' type='audio/wav'>" ?>
            Your browser does not support the audio element.
            </audio>
        </span>
            </div>
        <?php endif; ?>
    </div>
  </div>
  <div class="individual-bottom">
    <p>
      <?=$bird['description'] ?>
    </p>
  </div>
    <div class="sighting-section">
        <h2>Bird Sightings</h2>
        <div class="owl-carousel owl-theme">
              <div class="item"><h4>1</h4></div>
              <div class="item"><h4>2</h4></div>
              <div class="item"><h4>3</h4></div>
              <div class="item"><h4>4</h4></div>
              <div class="item"><h4>5</h4></div>
              <div class="item"><h4>6</h4></div>
              <div class="item"><h4>7</h4></div>
              <div class="item"><h4>8</h4></div>
              <div class="item"><h4>9</h4></div>
              <div class="item"><h4>10</h4></div>
              <div class="item"><h4>11</h4></div>
              <div class="item"><h4>12</h4></div>
      </div>
      


<div id="map"></div>
</div>



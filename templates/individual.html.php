



<div class="individual-page">
  <pre>

  </pre>
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
        <div class="owl-carousel"
            <?php foreach($sightings as $sighting) { ?>
            <div class="carousel-image-wrapper">
                <?php
                if (!empty($sighting['fileName'])) {
                    $timestamp = strtotime($sighting['postDate']);
                    $date =  date("d F y", $timestamp);
                    echo "<div class='carousel-item'>";
                    echo "<img class='img-rounded' src='/files/{$sighting['fileName']}' />";
                    echo "<div class='img-info'>
                            <div class='img-position'>
                                 <p>Posted: {$date}</p>
                                 <p>Sighted: {$sighting['place']}</p>
                                 <h4>by {$sighting['name']}</h4>    
                            </div>
                       
                       </div>";
                    echo "</div>";
                }
                }
                ?>
            </div>

        </div>

    </div>
<div id="map"></div>
</div>



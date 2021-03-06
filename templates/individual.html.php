



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
        <h2>Sightings</h2>
        <div class="owl-carousel owl-theme">
            <?php 
              
              foreach($sightings as $sighting){
                $date = strtotime($sighting['postDate']);
                $dateFormatted = date('d M y', $date);
                echo "<div class='item'>";
                    echo "<img src='/files/{$sighting['fileName']}' />";
                     echo "<div class='sighting-abs'>
                              <div class='sighting-descrip'>
                                  <span>posted by {$sighting['name']}</span>
                                  <span>in {$sighting['place']}</span>
                                  <span>on {$dateFormatted}</span>
                              </div>
                          </div>";  
              echo "</div>";
                } 
                
            ?>
      </div>
      <?php if(empty($sightings)){
                  echo "<div>There are currently no sightings added </div>";
                } ?>
      
      <a class="bird-primary sighting-btn" href="/sighting/create" >Add a Sighting</a>

      <div style="width:100%; height:100%">
          <div id="map">
      </div>
     

</div>



<!-- 
                        echo "<div class='sighting-abs'>
                                  <div class='sighting-descrip'>
                                      <span>User</span>
                                      <span>location</span>
                                      <span>date</span>
                                  <div>
                              </div>";
            
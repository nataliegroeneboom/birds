

<?php
echo isset($result['message'])?"<p>{$result['message']}</p>": '';

?>

<form action="" method="post" enctype="multipart/form-data" id="create">

    <table class='table table-hover table-responsive table-bordered'>
        <input type="hidden" name="bird[id]" value="<?=$bird['id'] ?? '' ?>">
        <input type="hidden" name="bird[image]" value="<?=$bird['image'] ?? '' ?>">
        <tr>
            <td class="label"><label for="name">Name</label></td>
            <td><input type='text' name="bird[birdname]" id="name" class='form-control' value="<?=$bird['birdname']?? '' ?>"/></td>
        </tr>
        <tr>
            <td class="label"><label for="description">Description</label></td>
            <td><textarea name="bird[description]" id="description" rows="6" class='form-control' ?><?=$bird['description']??''; ?></textarea></td>
        </tr>

        <tr>
            <td class="label"><label for="category">Category</label></td>
            <td>

  <select class='form-control' name='bird[category_id]' id="category">;
      <option>Select category...</option>
      <?php
      foreach($categories as $category){
          echo "<option value='{$category['id']}' ";
          if($bird['category_id'] == $category['id']){
           echo "selected";
          }
         echo ">{$category['name']}</option>";
      }
      ?>
    </select>
      
            </td>
      </tr>
      <tr>
            <td class="label"><label for="location">Location</label></td>
            <td>
            <?php

            echo "<select class='form-control' id='location' name='bird[location_id]'>";
                echo "<option> Select Location... </option>";

                foreach($locations as $location){
                    echo "<option value='{$location['id']}' ";
                    if($bird['location_id'] == $location['id']){
                       echo "selected";
                    }
                   echo ">{$location['name']}</option>";
                }


            echo "</select>";
            ?>


            </td>
        </tr>
        <tr>
            <td class="label"><label for="status">Status</label></td>
            <td>
                <select class='form-control' id="status" name="bird[status]">
                    <option>Select Status...</option>
                    <option value="<?=$bird['status']?>"
                        <?php
                        if($bird['status'] == 'Threatened'){
                            echo "selected";
                        }
                        ?>
                     >Threatened</option>
                    <option value="<?=$bird['status']?>" selected
                        <?php
                        if($bird['status'] == "Least Concerned"){
                            echo " selected";
                        }
                        ?>
                    >Least Concerned</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label"><label for="sound">MP3 sound clip</label></td>
            <td><label class="imageUpload">choose mp3 sound<input type="file" value="audio" name="audioFile"></label>
                </td>
        </tr>
        <tr>
          <td class="label"><label for="files">
            Photo</label>
          </td>
          <td>
            
             <?php if(isset($bird['image'])){

                echo "<img id='previewbird' name='image' class='img-responsive' src='/files/{$bird["image"]}' />";
                echo "<label  class='imageUpload'>
                <input id='imagePreview' type='file' name='image' id='files' onchange='previewImage();'/>
                <span class='glyphicon glyphicon-upload'></span>Change Image
                </label>";
             }else{
                echo '<div id="imagePreviewContainer" ></div>';
                 echo "<label class='imageUpload'>
                 
                 <input id='imagePreview' type='file' name='image' id='files' onchange='previewImage();'/>
                 <span class='glyphicon glyphicon-upload'></span>Choose Image
                 </label>";
             }

             ?>

          </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn bird-primary submit">
                  <?=$bird['id']?"Save":"Create"
                  ?>
                </button>
            </td>
        </tr>

    </table>
</form>


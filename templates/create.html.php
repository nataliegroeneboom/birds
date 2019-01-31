

<?php
echo isset($result['message'])?"<p>{$result['message']}</p>": "<p>No Message</p>";

?>


<!-- HTML form for creating a product -->
<form action="" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered'>
    <input type="hidden" name="bird[id]" value="<?=$bird['id'] ?? '' ?>">
        <tr>
            <td>Name</td>
            <td><input type='text' name="bird[birdname]" class='form-control' value="<?=$bird['birdname']?? '' ?>"/></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name="bird[description]" rows="6" class='form-control' ?><?=$bird['description']??''; ?></textarea></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>

  <select class='form-control' name='bird[category_id]' >;
      <option>Select category...</option>
      <?php
      foreach($categories as $category){
          echo "<option value='{$category['id']}' ";
          if($bird['category_id'] == $category['id']){
           echo "selected";
          }
         echo "
>{$category['name']}</option>";
      }

  echo "</select>";
  ?>
            </td>
        </tr>
        <tr>
            <td>Location</td>
            <td>
            <?php

          // $stmt_location = $location->read();

            echo "<select class='form-control' name='bird[location_id]'>";
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
            <td>Status</td>
            <td>
                <select class='form-control' name="bird[status]">
                    <option>Select Status...</option>
                    <option
                        <?php
                        if($bird['status'] == "Threatened"){
                            echo " selected";
                        }
                        ?>
                     >Threatened</option>
                    <option
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
          <td>
            Photo
          </td>
          <td>
            <input id="imagePreview" type="file" name="image" id="files" onchange="previewImage();"/>
             <?php if(isset($bird['image'])){
                echo "<img id='previewbird' name='image' class='img-responsive' src='files/{$bird["image"]}' />";
                echo "<label for='files'>Change Image</label>";
             }else{
                echo '<div id="imagePreviewContainer" ></div>';
                 echo "<label for='files'>Upload Image</label>";
             }

             ?>

          </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                  <?=$bird['id']?"Save":"Create"
                  ?>
                </button>
            </td>
        </tr>

    </table>
</form>


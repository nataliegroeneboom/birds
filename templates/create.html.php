

<?php
echo isset($result['message'])?"<p>{$result['message']}</p>": '';

?>

<form action="" method="post" enctype="multipart/form-data" id="create">

    <table class='table table-hover table-responsive table-bordered'>
        <input type="hidden" name="bird[id]" value="<?=$bird['id'] ?? '' ?>">
        <input type="hidden" name="bird[image]" value="<?=$bird['image'] ?? '' ?>">
        <tr>
            <td class="label"><label class="bird-create" for="name">Name *</label></td>
            <td><input type='text' name="bird[birdname]" id="name" class='form-control' value="<?=$bird['birdname']?? '' ?>" required/></td>
        </tr>
        <tr>
            <td class="label"><label class="bird-create"  for="description">Description *</label></td>
            <td><textarea name="bird[description]" id="description" rows="6" class='form-control' required><?=$bird['description']??''; ?></textarea></td>
        </tr>

        <tr>
            <td class="label"><label class="bird-create"  for="category">Category *</label></td>
            <td>

  <select class='form-control' name='bird[category_id]' id="category" required>;
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
            <td class="label"><label class="bird-create" for="status">Status *</label></td>
            <td>
                <select class='form-control' id="status" name="bird[status]" required>
                    <option>Select Status...</option>
                    <option value="Threatened"
                        <?php
                        if($bird['status'] == 'Threatened'){
                            echo "selected";
                        }?>
                     >Threatened</option>
                    <option value="Least Concerned" 
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
            <td class="label"><label class="bird-create" for="sound" class="hidden-small">MP3 sound clip</label></td>
            <td><label class="imageUpload">choose mp3 sound<input type="file" value="audio" name="audioFile"></label>
                </td>
        </tr>
        <tr>
          <td class="label"><label class="bird-create" for="files" class="hidden-small">
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


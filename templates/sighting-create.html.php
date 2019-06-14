
<form action="" method="post" enctype="multipart/form-data" id="create-sighting">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td class="label"><label for="sighting[birdId]">Category</label></td>
            <td>
                <select class='form-control' name='sighting[birdId]' id="bird-sighting">
                    <option>Select bird...</option>
                    <?php
                        foreach($birds as $bird){
                            echo "<option value='{$bird['id']}' ";
                            echo ">{$bird['birdname']}</option>";
                            } ?>
                </select>
            </td>   
        </tr>
        <tr>
            <td><label for="sighting[body]">Add Details about your sighting</label></td>
             <td>  
                <textarea name="sighting[body]"cols="30" rows="10" placeholder="Add where you saw the bird and any further information"></textarea>
            </td>
        </tr>
        <tr>
            <td><label class='multiple' for="images[]">Select your images</label></td>
            <td>
            <label class="imageUpload">
            <input id='imagePreview' type='file' name='images[]' id='images' multiple="" />
                 <span class='glyphicon glyphicon-upload'></span>Choose Image
                </label>
                 
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="submit" class="btn bird-primary submit">
                 Create
                </button>
            </td>
        </tr>   
    </table>
</form>
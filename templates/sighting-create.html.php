
<form action="" method="post" enctype="multipart/form-data" id="create-sighting">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td><label for="sighting[birdId]">Category</label></td>
            <td>
                <select class='form-control' name='sighting[birdId]' id="bird-sighting">
                    <option value disabled selected>Select bird...</option>
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
                <textarea class="form-control" name="sighting[body]"cols="30" rows="10" placeholder="Add where you saw the bird and any further information"></textarea>
            </td>
        </tr>
        <tr>
            <td><label class='multiple hidden-small' for="images[]">Select your images</label></td>
            <td>
            <label class="imageUpload">
            <input id='imagePreview' type='file' name='images[]' id='images' multiple="" />
                 <span class='glyphicon glyphicon-upload'></span>Choose Image
                </label>
                 
        </tr>
        <tr>
        <tr>
            <td><label for="">Location</label></td>
            <td><div id="locationField">
                <input  id="autocomplete"
                        placeholder="Enter your address"
                        onFocus="geolocate()"
                        class="form-control"
                        type="text"/></div>
             <input type="hidden" id="place" name="sighting[place]" />
             <input type="hidden" id="lat" name="sighting[latitude]" />
             <input type="hidden" id="lng" name="sighting[longitude]" /> 
            </td>
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

<div id="locationField">
      <input id="autocomplete"
             placeholder="Enter your address"
        
             type="text"/>
    </div>





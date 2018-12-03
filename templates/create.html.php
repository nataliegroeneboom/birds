




<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>
              <?php
  // read the product categories from the database
  $stmt = $category->read();

  // put them in a select drop-down
  echo "<select class='form-control' name='category_id'>";
      echo "<option>Select category...</option>";

      while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row_category);
          echo "<option value='{$id}'>{$name}</option>";
      }

  echo "</select>";
  ?>
            </td>
        </tr>
        <tr>
            <td>Location</td>
            <td>
            <?php

           $stmt_location = $location->read();

            echo "<select class='form-control' name='location_id'>";
                echo "<option> Select Location... </option>";

                while($row_category = $stmt_location->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='{$id}'>{$name}</option>";
                }
            echo "</select>";
            ?>


            </td>
        </tr>
        <td>
            <tr>Population</tr>
            <tr><input type='number' name='population'></tr>
        </td>
        <tr>
            <td>Status</td>
            <td>
                <select class='form-control' name='status'>
                    <option>Select Status...</option>
                    <option>Threatened</option>
                    <option>Least Concerned</option>
                </select>
            </td>
        </tr>
        <tr>
          <td>
            Photo
          </td>
          <td>
            <input type="file" name="image"  />
          </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>


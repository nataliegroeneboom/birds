


        <h3>Checking<?php $bird->name ?></h3>
        <?php if($bird->name){
          echo "<p>access to bird description</p>";
        }else{
          echo "<p>" . $bird->name . "</p>";
        }?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value="<?php echo $bird->name ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'><?php echo $bird->description  ?></textarea></td>
            </tr>
            <tr>
                <td>Category</td>
                <?php
                  $stmt = $category->read();
                 ?>
                 <select class='form-control' name='category_id'>
                   <option>
                     Please select ...
                   </option>
                   <?php
                      while($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $category_id = $row_category['id'];
                        $category_name = $row_category['name'];
                        if($bird->category_id == $category_id){
                          echo "<option value='$category_id' selected>";

                        }
                        else{
                          echo "<option value='$category_id'>";
                        }
                        echo "$category_name</option>";
                      }

                   ?>
                 </select>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save Changes' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>
    </form>

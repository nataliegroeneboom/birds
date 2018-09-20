<table class='table table-hover table-responsive'>
   <tr>
        <td>Name </td>
        <td><?= $bird->name ?> </td>
   </tr>
   <tr>
        <td>Description </td>
        <td><?= $bird->description ?> </td>
   </tr>
   <tr>
        <td>Category</td>
        <td><?php
          $category->id = $bird->category_id;
          $category->readName();
          echo $category->name;
         ?> </td>
   </tr>
   <tr>
     <td>Image</td>
     <td>
       <?php echo $bird->image? "<img src='files/{$bird->image}' style='width:300px' />": "No image found"; ?>
     </td>
   </tr>
</table>

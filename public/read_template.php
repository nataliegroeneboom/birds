<?php
// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type bird or description...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";

// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create Product";
    echo "</a>";
echo "</div>";

// display the products if there are any
if($total_rows>0){
?>
  <table class='table table-hover table-responsive table-bordered'>
       <tr>
            <th>Product</th>
          <th>Description</th>
           <th>Category</th>
          <th>Actions</th>
      </tr>

    <?php    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); ?>

            <tr>
                <td><?=$birdname?></td>
                <td><?=$description?></td>
                <td><?php
                    $category->id = $category_id;
                    $category->readName();
                    echo $category->name; ?>
                </td>

               <td>


                    <a href='<?php echo "individual.php?id='{$id}'"?>' class='btn btn-primary left-margin'>
                       <span class='glyphicon glyphicon-list'></span> Read </a>


                  <a href='<?php echo "update.php?id='{$id}'"?>' class='btn btn-info left-margin'>
                     <span class='glyphicon glyphicon-edit'></span>
                     </a>


          <form action='delete.php' method='post'>
 <input type='hidden' name='id' value='{$id}'>
<input type='submit' value='Delete'>"
  </form>

                 </td>;

       </tr>;
      <?php

        }
      ?>

   </table>;

    // paging buttons
    include_once 'paging.php';
<?php
}

// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No Birds found.</div>";
}

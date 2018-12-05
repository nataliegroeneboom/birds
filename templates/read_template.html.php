<form role='search' action='search.php'>
  <div class='input-group col-md-3 pull-left margin-right-1em'>
<!--    --><?php //$search_value=isset($search_term) ?><!-- ??--><?//="value='{$search_term}'" ?><!--;-->
     <input type='text' class='form-control' placeholder='Type bird or description...' name='s' id='srch-term' required <?=$search_value?> />
        <div class='input-group-btn'>
            <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
           </div>
       </div>
 </form>


  <div class='right-button-margin'>
   <a href='create.php' class='btn btn-primary pull-right'>
    <span class='glyphicon glyphicon-plus'></span> Create Product </a>
  </div>

<?php if($total_rows>0){ ?>

<table class='table table-hover table-responsive table-bordered'>
    <tr>
     <th>Product</th>
        <th>Description</th>
        <th>Category</th>
        <th>Actions</th>
        </tr>

  <?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    extract($row); ?>

   <tr>
       <td><?php echo "{$birdname}"?></td>
       <td><?php echo "{$description}" ?></td>
       <td><?php
            $category->id = $category_id;
            $category->readName();
            echo "{$category->name}"; ?>
            </td>

        <td>


         <a href="individual.php?id=<?=$id?>" class='btn btn-primary left-margin'>
         <span class='glyphicon glyphicon-list'></span> Read
           </a>


         <a href="update.php?id=<?=$id?>" class='btn btn-info left-margin'>
          <span class='glyphicon glyphicon-edit'></span> Edit
          </a>

<!--            // echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";-->
<!--                //     echo "<span class='glyphicon glyphicon-remove'></span> Delete";-->
<!--                // echo "</a>";-->


            <form action='delete.php' method='post'>
            <input type='hidden' name='id' value='<?=$id?>'>
                <input type='submit' value='Delete'>
                </form>

            </td>

       </tr>

 <?php   } ?>

    </table>

<?php
include_once 'paging.php';
}

// tell the user there are no products
else{
echo "<div class='alert alert-danger'>No Birds found.</div>";
} ?>
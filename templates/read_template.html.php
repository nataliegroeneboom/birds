<form role='search' action='search.php'>
  <div class='input-group col-md-3 pull-left margin-right-1em'>
<!--    --><?php //$search_value=isset($search_term) ?><!-- ??--><?//="value='{$search_term}'" ?><!--;-->
     <input type='text' class='form-control' placeholder='Type bird or description...' name='s' id='srch-term'  />
        <div class='input-group-btn'>
            <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
           </div>
       </div>
 </form>


  <div class='right-button-margin'>
   <a href='index.php?action=edit' class='btn btn-primary pull-right'>
    <span class='glyphicon glyphicon-plus'></span> Create Product </a>
  </div>



<table class='table table-hover table-responsive table-bordered'>
    <tr>
     <th>Product</th>
        <th>Description</th>
        <th>Category</th>
        <th>Actions</th>
        </tr>



<?php foreach($birds as $bird){ ?>
    <tr>
        <td><?=$bird['name']?></td>
        <td><?=$bird['description']?></td>
        <td><?=$bird['category']?></td>

        <td>


            <a href="individual.php?id=<?=$bird['id']?>" class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
            </a>


            <a href="update.php?id=<?=$bird['id']?>" class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>



            <form action='delete.php' method='post'>
                <input type='hidden' name='id' value='<?=$bird['id']?>'>
                <input type='submit' value='Delete'>
            </form>

        </td>

    </tr>



<?php
} ?>





    </table>





<div class="bird-list">

<div class='right-button-margin'>
   <a href='/bird/edit' class='btn bird-primary pull-right'>
    <span class='glyphicon glyphicon-plus'></span> Create Bird </a>
  </div>



<table class='table table-hover table-responsive'>
    <tr>
     <th>Product</th>
        <th class="description">Description</th>
        <th>Category</th>
        <th>Actions</th>
        </tr>



<?php foreach($birds as $bird){ ?>
    <tr>
        <td><?=$bird['name']?></td>
        <td class="description"><?=$bird['description']?></td>
        <td><?=$bird['category']?></td>

        <td class="actions">


            <a class="bird-primary" href="/bird/read?id=<?=$bird['id']?>" class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
            </a>

       
            <a class="bird-primary" href="/bird/edit?id=<?=$bird['id']?>" class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>



            <form action='/bird/delete' method='post'>
                <input type='hidden' name='id' value='<?=$bird['id']?>'>
                <input type='hidden' name='image' value='<?=$bird['image']?>'>
               <div class="bird-warning"> <input type='submit' value='Delete'></div>
            </form>

        </td>

    </tr>



<?php
} ?>



    </table>



</div>



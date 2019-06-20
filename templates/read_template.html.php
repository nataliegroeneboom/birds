<?php
if(isset($message)){
echo $message;
}

?>
<div class="bird-list">

<?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <div class='right-button-margin'>
    <a href='/bird/edit' class='btn bird-primary pull-right'>
        <span class='glyphicon glyphicon-plus'></span> Add a new Bird </a>
    </div>
<?php endif ?>



<table class='table table-hover table-responsive'>
    <tr class="table-header">
     <th>Bird</th>
        <th class="description">Description</th>
        <th>Category</th>
        <th></th>
        </tr>



<?php foreach($birds as $bird){ ?>
    <tr>
        <td class="bird"><?=$bird['name']?></td>
        <td class="description"><p class="content"><?=$bird['description']?></p></td>
        <td class="category"><?=$bird['category']?></td>

        <td class="actions">


            <a class="bird-primary" href="/bird/read?id=<?=$bird['id']?>" class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
            </a>

    <?php if(isset($_SESSION['admin'])): ?>
            <a class="bird-primary" href="/sighting/create" class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Add sighting
            </a>
    <?php endif ?>

     <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
            <a class="bird-primary" href="/bird/edit?id=<?=$bird['id']?>" class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>

   
            <form action='/bird/delete' method='post'>
                <input type='hidden' name='id' value='<?=$bird['id']?>'>
                <input type='hidden' name='image' value='<?=$bird['image']?>'>
               <div class="bird-warning"> <input type='submit' value='Delete'></div>
            </form>
    <?php endif ?>

        </td>

    </tr>



<?php
} ?>



    </table>



</div>



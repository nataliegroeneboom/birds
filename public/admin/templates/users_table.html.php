<table class="table table-hover table-responsive table-bordered">
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Access Level</th>
    </tr>
    <?php
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         extract($row);
      ?>
        <tr>
            <th><?=$firstname ?></th>
            <th><?=$lastname ?></th>
            <th><?=$email ?></th>
            <th><?=$contact_number ?></th>
            <th><?=$access_level ?></th>
        </tr>
    <?php
     }
    ?>
</table>

<?php
    $page_url = "read_users?";
    $total_rows = $user->countAll();

    include_once 'paging.php';

?>
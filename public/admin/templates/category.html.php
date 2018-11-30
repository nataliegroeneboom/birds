<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table>
        <tr>
            <td>Category Name</td>
            <td><input type='text' name='name'></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submitCategory">Create Category</button></td>
        </tr>
    </table>
</form>
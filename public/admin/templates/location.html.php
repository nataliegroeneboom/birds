<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table>
        <tr>
            <td>Location Name</td>
            <td><textarea type='text' name='name'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submitLocation">Create Location</button></td>
        </tr>
    </table>
</form>
<?php
require '../templates/admin/sidebar.html.php';
?>

<h2>User Account Type</h2>
Account name: <?=$user['username']?>

<form action="" method="POST">
    <input type="hidden" name="user[id]" value="<?=$user['id']?>" />
    <label>User Type</label>
    <select name="user[user_type]">
        <option value="basic">Basic</option>
        <option value="staff">Staff</option>
    </select>
    <input type="submit" name="submit" value="Submit" />
</form>
<?php
require '../templates/admin/sidebar.html.php';
?>

<h2>User Enquiry</h2>
<p>Name: <?=$enquiry['name']?></p>
<p>Description: <?=$enquiry['description']?></p>

<form action="" method="POST">
    <label>Reply to user</label>
    <textarea name="enquiry[response]"></textarea>
    <label>Enquiry Status</label>

    <select name="enquiry[status]" >
        <option selected="selected" value="unresolved">Unresolved</option>
        <option selected="selected" value="archieved">Archieve</option>
    </select>

    <input type="hidden" name="enquiry[id]" value="<?= $enquiry['id']?>" />
    <input type="hidden" name="enquiry[staffName]" value="<?= $_SESSION['username']?>" />

    <input type="submit" name="submit" value="Submit" />
</form>
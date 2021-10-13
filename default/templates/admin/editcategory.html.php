<?php
require '../templates/admin/sidebar.html.php';
?>

<section class="right">			
    <h2>Edit Category</h2>
			
    <form action="" method="POST">
        <input type="hidden" name="category[id]" value="<?=$record['id'] ?? ''?>" />
        <label>Name</label>
        <input type="text" name="category[name]" value="<?=$record['name'] ?? ''?>" />
        <input type="submit" name="submit" value="Save Category" />
    </form>
</section>
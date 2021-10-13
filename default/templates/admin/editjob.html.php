<?php
require '../templates/admin/sidebar.html.php';
?>

<section class="right">

    <h2>Edit Job</h2>
	
    <form action="" method="POST">

        <input type="hidden" name="job[id]" value="<?=$record['id'] ?? ''?>" />
        <label>Title</label>
        <input type="text" name="job[title]" value="<?=$record['title'] ?? ''?>" />

        <label>Description</label>
        <textarea name="job[description]"><?=$record['description'] ?? ''?></textarea>

        <label>Location</label>
        <input type="text" name="job[location]" value="<?=$record['location'] ?? ''?>" />


        <label>Salary</label>
        <input type="text" name="job[salary]" value="<?=$record['salary'] ?? ''?>" />

        <label>Category</label>

        <select name="job[categoryId]">
        <?php

            foreach ($category as $row) {
                if ($job['categoryId'] == $row['id']) { ?>
                    <option selected="selected" value="<?=$row['id']?>"><?=$row['name']?></option>
                <?php 
                }
                else { ?>
                    <option value="<?=$row['id']?>"><?=$row['name'] ?? ''?></option>
                <?php
                }
            }
        ?>

        </select>
        
        <label>Closing Date</label>
        <input type="date" name="job[closingDate]" value="<?=$record['closingDate'] ?? ''?>"  />

        <input type="hidden" name="job[userId]" value="<?=$_SESSION['loggedin']?>"  />

        <input type="submit" name="submit" value="Save" />

    </form>
</section>
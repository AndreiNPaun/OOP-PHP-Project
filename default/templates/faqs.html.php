<h2>FAQs</h2>
<?php
foreach ($faq as $row) { ?>
    <p><b><?=$row['question']?></b></p>
	<p><?=$row['answer']?></p>
<?php
}
?>

<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_type'] === 'basic') {
    ?>
    <h3>Get in touch with user if you have any questions!</h3>
    <form action="" method="POST">
        <label>Name</label>
        <input type="text" name="enquiry[name]" /> 
        <label>Email</label>
        <input type="text" name="enquiry[email]" value="<?=$user['email'] ?? ''?>" /> 
        <label>Phone Number</label>
        <input type="text" name="enquiry[phone]" /> 
        <label>Description</label>

        <textarea name="enquiry[description]" rows="4" cols="50">Describe your enquiry.</textarea>

        <input type="hidden" name="enquiry[user_id]" value="<?=$user['id']?>" /> 
        <input type="hidden" name="enquiry[status]" value="unresolved"/>

        <input type="submit" name="submit" value="Submit" />
    </form>
    <?php
}


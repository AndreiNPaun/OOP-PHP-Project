<?php
require '../templates/admin/sidebar.html.php';
?>

<h2>User Enquiries</h2>
<p>See archieved enquiries <a href="/admin/archieve">Here</a>.</p>
</br>
<?php
foreach ($enquiries as $enquiry) { 
    if ($enquiry['status'] === 'unresolved') { 
        ?>
        <p>Name: <?=$enquiry['name']?></p>
        <p>Email: <?=$enquiry['email']?></p>
        <p>Phone Number: <?=$enquiry['phone']?></p>
        <p>Description: <?=$enquiry['description']?></p>
        <p><a href="/admin/answerenquiry?id=<?=$enquiry['id']?>">Solve Enquiry</a></p>
        <?php
        if ($_SESSION['user_type'] === 'admin') { 
            ?>
            <p><a href="/admin/deleteenquiry?id=<?=$enquiry['id']?>">Delete Enquiry</a></p>
            <?php
        }
        ?>
        <hr>
    <?php
    }
}
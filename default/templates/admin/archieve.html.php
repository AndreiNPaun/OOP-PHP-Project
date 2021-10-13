<?php
require '../templates/admin/sidebar.html.php';
?>

<h2>Archieved Enquiries</h2>
</br>
<?php
foreach ($enquiries as $enquiry) { 
    if ($enquiry['status'] === 'archieved') { 
        ?>
        <p>Name: <?=$enquiry['name']?></p>
        <p>Email: <?=$enquiry['email']?></p>
        <p>Phone Number: <?=$enquiry['phone']?></p>
        <p>Description: </p>
        <p><?=$enquiry['description']?></p>
        </br>
        <p>Staff response: </p>
        <p><?=$enquiry['response']?></p>
        <p>Answered by: <?=$enquiry['staffName']?></p>
        <hr>
        <?php
    }
    ?>
    <?php
}
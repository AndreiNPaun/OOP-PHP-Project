<section class="left">
<ul>
<?php 
$links = ['Categories', 'Enquiry', 'Users']; ?>

<li><a href="/admin/jobs">Jobs</a></li>

<?php
if ($_SESSION['user_type'] === 'admin') { ?>
    <?php
    foreach ($links as $link) { ?>
        <li><a href="/admin/<?=strtolower($link)?>"><?=$link?></a></li>
    <?php
    }
}

else if ($_SESSION['user_type'] === 'staff') { ?>
    <?php
    unset($links[2]);
    foreach ($links as $link) { ?>
        <li><a href="/admin/<?=strtolower($link)?>"><?=$link?></a></li>
    <?php
    }
}
?>

</ul>
</section>


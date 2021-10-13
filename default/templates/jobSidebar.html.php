<?php
require '../app/database.php';

$stmt = $pdo->prepare('SELECT * FROM category');
$stmt->execute();
$categories = $stmt->fetchAll();

foreach ($categories as $category) { 
    $id = $category['id'];
    ?>
    <li  class="<?php if($id==$_GET['id']){echo 'current';}?>"><a href="/category?id=<?=$category['id']?>"><?=$category['name']?></a></li>
    <?php
}
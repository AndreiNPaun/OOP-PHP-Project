<?php
require '../templates/admin/sidebar.html.php';
?>

<section class="right">
    <h2>Accounts</h2>

	<table>
	<thead>
	<tr>
	<th>Username</th>
	<th style="width: 5%">User Type</th>
	<th style="width: 5%">&nbsp;</th>
    </tr>
		
					
<?php
unset($user[1]);
foreach ($user as $users) { 
	?>
	<tr>
    <td><?=$users['username']?></td>
    <td><?=$users['user_type']?></td>

    <td><a style="float: right" href="/admin/edituser?id=<?=$users['id']?>">Edit</a></td>
	<td><form method="POST" action="/admin/deleteuser">
		    <input type="hidden" name="id" value="<?=$users['id']?>" />
			<input type="submit" name="submit" value="Delete" />
			</form></td>
	</tr>
<?php
}
?>
	
</thead>
</table>
</section>
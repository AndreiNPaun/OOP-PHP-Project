<?php
require '../templates/admin/sidebar.html.php';
?>

<section class="right">
    <h2>Jobs</h2>
	<a class="new" href="editjob">Add new job</a>
	
	<table>
	<thead>
	<tr>
	<th>Title</th>
	<th style="width: 15%">Salary</th>
	<th style="width: 5%">&nbsp;</th>
	<th style="width: 15%">&nbsp;</th>
	<th style="width: 5%">&nbsp;</th>
	<th style="width: 5%">&nbsp;</th>
	</tr>
<?php
//CHANGE ASAP
$pdo = new PDO('mysql:dbname=job;host=v.je', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);
foreach ($jobs as $job) {
	$applicants = $pdo->prepare('SELECT count(*) as count FROM applicants WHERE jobId = :jobId');
	$applicants->execute(['jobId' => $job['id']]);
	$applicantCount = $applicants->fetch();

	if ($_SESSION['user_type'] === 'admin'|| $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client' && $_SESSION['loggedin'] === $job['userId']) { 
        ?>

		<tr>
		<td><?=$job['title']?></td>
		<td><?=$job['salary']?></td>
		<td><a style="float: right" href="editjob?id=<?=$job['id']?>">Edit</a></td>
		<td><a style="float: right" href="applicants?id=<?=$job['id']?>">View applicants (<?=$applicantCount['count']?>)</a></td>

		<td><form method="POST" action="deletejob">
			<input type="hidden" name="id" value="<?=$job['id']?>" />
			<input type="submit" name="submit" value="Delete" />
		</form></td>

	<?php
	}
} 
?>
	
    </thead>
    </table>
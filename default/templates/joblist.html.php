<!--Admin/Staff/Client view on jobs-->
<section class="left">
		<ul>
			<?php
			require 'jobSidebar.html.php';
			?>
		</ul>
</section>

<section class="right">

<h1><?=$title['name']?></h1>

<ul class="listing">

<?php

foreach ($jobs as $job) { ?>
	<li>

	<div class="details">
	<h2><?=$job['title']?></h2>
	<h3><?=$job['salary']?></h3>
	<p><?=nl2br($job['description'])?></p>	
	<?php
		if (isset($_SESSION['loggedin']) && $_SESSION['user_type'] === 'basic') {
		?>
			<a class="more" href="/apply?id=<?= $job['id'] ?>">Apply for this job</a>	
		<?php
		}
	?>
		</div>
		</li>
<?php } ?>


</ul>

</section>
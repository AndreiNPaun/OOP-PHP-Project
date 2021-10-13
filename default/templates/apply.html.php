<section class="left">
    <ul>
		<?php
		require 'jobSidebar.html.php';
		?>
	</ul>
</section>

<section class="right">

<h2>Apply for <?=$job['title'] ?? ''?></h2>
<p>Fields with * must be completed.</p>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Your name *</label>
	<input type="text" name="applicant[name]" />

	<label>E-mail address *</label>
	<input type="text" name="applicant[email]" value="<?=$user['email'] ?? ''?>"/>

	<label>Cover letter</label>
	<textarea name="applicant[details]"></textarea>

	<label>CV *</label>
	<input type="file" name="cv" />

	<input type="hidden" name="applicant[jobId]" value="<?=$job['id']?>" />

	<input type="submit" name="submit" value="Apply" />
</form>

</section>

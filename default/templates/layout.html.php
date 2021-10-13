<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/css/styles.css"/>
		<title><?=$title?></title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Office Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<h1>Jo's Jobs</h1>

		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li>Jobs
				<ul>
					<?php
					require '../templates/categoryLinks.html.php';
					?>
				</ul>
			</li>
			<li><a href="/faqs">FAQs</a></li>
			<?php
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
					<li><a href="/logout">Logout</a></li>
					<?php
					if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client') { ?>
						<li><a href="/admin/home">Admin</a></li>
					<?php
					}
					?>
			<?php	
				}
				else { ?>
					<li><a href="/login">Login</a></li>
					<li><a href="/register">Register</a></li>
				<?php } ?>
		</ul>

	</nav>
<img src="/images/randombanner.php"/>

<?php

if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/about' || 
	$_SERVER['REQUEST_URI'] == '/login' || $_SERVER['REQUEST_URI'] == '/register' || $_SERVER['REQUEST_URI'] == '/faqs') { ?>

	<main class="home">

<?php
}

else { ?>

	<main class="sidebar">

<?php
}
?>

    <?=$output?>

</main>
<?php
$date = new DateTime();
?>
<footer>
		&copy; Jo's Jobs <?=$date->format('Y');?>
	</footer>
</body>
</html>
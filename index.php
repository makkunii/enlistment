<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="files/images/favicon.png" type="image/png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="files/css/styles.css">
	<title>CITE Online Enlistment</title>
</head>

<body>
	<header> <a href="index.php" class="logo">CITE | ONE</a>
		<div class="toggle" onclick="toggleMenu();"></div>
		<ul class="menu">
			<li><a href="index.php" onclick="toggleMenu();">Home</a></li>
			<li><a href="forms.php" onclick="toggleMenu();">Approved Forms</a></li>
		</ul>
	</header>
	<section class="banner" id="home">
		<div class="text-banner">
			<h3>Araullo University</h3>
			<h2><span>CITE ONLINE ENLISTMENT</span></h2>
			<br><br>
			<h3>Enlistment for old/continuing and returnee student</h3>
			<a href="./student.php" class="btn">Enlist Here</a>
			<br><br>
			<h3>Enlistment for irregular student</h3>
			<a href="./irregularStudent.php" class="btn">Enlist Here</a>
			
			</div>
	</section>
	<section class="services" id="services">
		<div class="heading white">
			<h2>Services</h2> </div>
		<div class="content">
			<div class="servicesbox">
				<div class="icon"><i class="fa fa-clock-o"></i></div>
				<h2>Fast Process</h2>
				<p>No need to wait for a long line</p>
			</div>
			<div class="servicesbox">
				<div class="icon"><i class="fa fa-commenting-o"></i></div>
				<h2>SMS</h2>
				<p>Approved forms will be notified via SMS</p>
			</div>
			<div class="servicesbox">
				<div class="icon"><i class="fa fa-check"></i></div>
				<h2>User Friendly</h2>
				<p>Anyone can enlist on their own</p>
			</div>
		</div>
		</div>
	</section>
	<div class="copyright"> Copyright 2021 © CITE. All Rights Reserved </div>
	<script type="text/javascript">
	window.addEventListener('scroll', function() {
		var header = document.querySelector('header');
		header.classList.toggle('sticky', window.scrollY > 0);
	});

	function toggleMenu() {
		var menutoggle = document.querySelector('.toggle');
		var menu = document.querySelector('.menu');
		menutoggle.classList.toggle('active');
		menu.classList.toggle('active')
	}
	</script>
</body>

</html>
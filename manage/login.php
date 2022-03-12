<?php
session_start();
$sessionId = $_SESSION['id']??'';
$sessionRole = $_SESSION['role']??'';
if ($sessionId && $sessionRole)
{
    header("location:index.php");
    die();
}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/all.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/login.css">
		<title>CITE Online Enlistment</title>
	</head>

	<body>
		<!--------------------------------- Main section -------------------------------->
		<div class="main__form">
			<div class="main__form--title text-center">LOGIN</div>
			<form action="login_core.php" method="GET">
				<div class="form-row">
					<div class="col col-12">
						<label class="input"> <i id="left" class="fas fa-envelope left"></i>
							<input type="text" name="Username" placeholder="Username" required> </label>
					</div>
					<div class="col col-12">
						<label class="input"> <i id="left" class="fas fa-key"></i>
							<input id="pwdinput" type="password" name="password" placeholder="Password" required> <i id="pwd" class="fas fa-eye right"></i> </label>
					</div>
					<div class="col col-12">
						<label class="input"> <i id="left" class="fas fa-male left"></i>
							<select name="role" id="Role">
								<option value="admin">admin</option>
								<option value="employee">employee</option>
							</select>
						</label>
					</div>
					<input type="hidden" name="action" value="login">
					<?php if (isset($_REQUEST['error']))
{
    echo "<h5 class='text-center' style='color:red;'>Username, Password & Role Doesn't match Or Something is Wrong</h5>";
} ?>
						<div class="col col-12">
							<input type="submit" value="Login"> </div>
				</div>
			</form>
		</div>
		<!--------------------------------- #Main section -------------------------------->
		<!-- Optional JavaScript -->
		<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Custom Js -->
		<script src="./assets/js/app.js"></script>
	</body>

	</html>
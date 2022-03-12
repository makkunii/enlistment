<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CITE Online Enlistment</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="shortcut icon" href="files/images/favicon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
	<!--===============================================================================================-->
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="css/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
	/* The container */
	
	.container {
		display: block;
		position: relative;
		padding-left: 35px;
		margin-bottom: 12px;
		cursor: pointer;
		font-size: 16px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	/* Hide the browser's default checkbox */
	
	.container input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
		height: 0;
		width: 0;
	}
	/* Create a custom checkbox */
	
	.checkmark {
		position: absolute;
		top: 0;
		left: 0;
		height: 25px;
		width: 25px;
		background-color: #eee;
	}
	/* On mouse-over, add a grey background color */
	
	.container:hover input ~ .checkmark {
		background-color: #ccc;
	}
	/* When the checkbox is checked, add a blue background */
	
	.container input:checked ~ .checkmark {
		background-color: #2196F3;
	}
	/* Create the checkmark/indicator (hidden when not checked) */
	
	.checkmark:after {
		content: "";
		position: absolute;
		display: none;
	}
	/* Show the checkmark when checked */
	
	.container input:checked ~ .checkmark:after {
		display: block;
	}
	/* Style the checkmark/indicator */
	
	.container .checkmark:after {
		left: 9px;
		top: 5px;
		width: 5px;
		height: 10px;
		border: solid white;
		border-width: 0 3px 3px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
	}
	</style>
</head>
<div class="back"> <a href="index.php" class="button2">Go back</a> </div>

<body class="form-v10" style="background-color: #153e90;">
	<div class="page-content">
		<div class="one-side">
			<div class="form-v10-content">
				<form enctype="multipart/form-data" class="form-detail" action="irregularEnlistForm.php" method="POST" id="myform">
					<div class="form-left">
						<h2>CITE Enlistment Form</h2>
						<div class="form-row">
							<input type="text" name="StudentNumber" class="S_Number" id="S_Number" placeholder="Student Number" required> </div>
						<div class="form-right">
							<br>
							<center>
								<input type="submit" name="register" class="register" value="Proceed" style="background-color: #153e90;
  border: none;
  color: white;
  padding: 16px 32px;
  width: 300px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;"
>

<br><br>
								<center>
						</div>
					</div>
				</form>
				
			</div>
		</div>
</body>

</html>
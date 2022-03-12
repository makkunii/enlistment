<?php 


include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }
?>
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

	<body class="form-v10" Style="background-color: #153e90;">
		<div class="page-content">
			<div class="one-side">
				<div class="form-v10-content">
					<?php 
				
				$Number = $_POST['StudentNumber'];
				$check=mysqli_query($connection,"SELECT * FROM formrequest WHERE StudentNumber='".$Number."'");
				$row = mysqli_num_rows($check);
				
if($row > 0 )
{ ?>
						<?php
			
                $query = "SELECT * FROM formrequest WHERE StudentNumber='".$Number."'";
                $result = mysqli_query( $connection, $query );

      if ( $data = mysqli_fetch_assoc( $result ) ) 
	     ?>
							<form enctype="multipart/form-data" class="form-detail" action="section.php" method="POST" id="myform">
								<div class="form-left">
									<h2>CITE Enlistment Form</h2>
									<div class="form-row">
										<input type="text" name="studentNumber" class="S_Number" id="S_Number" placeholder="Student Number" value="<?php echo $Number?>" required> </div>
									<div class="form-row">
										<div class="form-group options">
											<div id="enroll" class="enrollStatus">
												<label class="container">Old/Continuing
													<input type="checkbox" name="enroll" value="Old" required> <span class="checkmark"></span> </label>
												<label class="container">Returnee
													<input type="checkbox" name="enroll" value="Returnee" required> <span class="checkmark"></span> </label>
											</div>
										</div>
									</div>
									<div class="form-row form-row-1">
										<input type="text" name="name" id="S_name" class="input-text" placeholder="Student Name" value="<?php echo  $data['Name'] ?>" required> </div>
									<div class="form-row">
										<select name="ClassType" required>
											<option class="option" value="" disabled selected>Type Of Enrollment</option>
											<option class="option" value="FLEX">Flex</option>
											<option class="option" value="RAD">Rad</option>
										</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
									<!-- Course -->
									<?php 
                        $mysqli = NEW MySQLi('localhost','root','','dbenlist');

                        $resultset=$mysqli->query("SELECT CourseID,CourseName FROM course");
                          ?>
										<div class="form-row">
											<select name="course">
												<option class="option" value="" disabled selected>Course</option>
												<?php
						while($rows = $resultset->fetch_assoc())
						{
							$course=$rows['CourseID'];
							$selectcourse=$rows['CourseName'];
							echo"<option class='option' value='$course'>$course - $selectcourse</option>";
						}
						?>
											</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
										<div class="form-row">
											<select name="YearLevel">
												<option class="option" value="" disabled selected>Year Level</option>
												<option class="option" value="1st Year">1st year</option>
												<option class="option" value="2nd Year">2nd Year</option>
												<option class="option" value="3rd Year">3rd Year</option>
												<option class="option" value="4th Year">4th year</option>
											</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
										<div class="form-row">
											<input type="tel" name="contactNumber" id="ContactNumber" class="input-text" placeholder="Contact Number" value="<?php echo  $data['ContactNumber'] ?>" maxlength="10" required> </div>
								</div>
								<div class="form-right">
									<br>
									<br>
									<br>
									<br>
									<br>
									<div class="form-row">
										<select name="sem" required>
											<option class="option" value="" disabled selected>Semester</option>
											<option class="option" value="1st Sem">1st Sem</option>
											<option class="option" value="2nd Sem">2nd Sem</option>
										</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
									<div class="form-row form-row-1">
										<input type="text" name="address" id="C_address" class="input-text" placeholder="Complete Address" value="<?php echo  $data['Address'] ?>" required> </div>
									<div class="form-row form-row-1">
										<div class="input-name">
											<label for="birthday" style="color: #666;">&emsp;Birthday:</label>
											<input type="date" id="birthday" name="birthday" placeholder="BirthDate" style=" color:#666" value="<?php echo $data['Birthday'] ?>" required> </div>
									</div>
									<div class="form-row">
										<input type="email" name="email" class="E_address" id="E_address" placeholder="Email Address" value="<?php echo  $data['Email'] ?>" required> </div>
									<div class="form-row form-row-1">
										<input type="text" name="parent" class="company" id="company" placeholder="Parent's Name" value="<?php echo  $data['Parent'] ?>" required> </div>
									<div class="form-row form-row-1">
										<input type="tel" name="parentcontact" class="business" id="business" placeholder="Parent Contact Number" value="<?php echo  $data['ParentContact'] ?>" maxlength="10" required> </div>
									<div class="form-row-last">
										<center>
											<input type="submit" name="register" class="register" value="Next">
											<center>
									</div>
								</div>
							</form>
							<?php } 
else{ ?>
								<form enctype="multipart/form-data" class="form-detail" action="section.php" method="POST" id="myform">
									<div class="form-left">
										<h2>AU South Enlistment Form</h2>
										<div class="form-row">
											<input type="text" name="studentNumber" placeholder="Student Number" value="<?php echo $Number?>" required> </div>
										<div class="form-row">
											<div class="form-group options">
												<div id="enroll" class="enrollStatus">
													<label class="container">Old/Continuing
														<input type="checkbox" name="enroll" value="Old" required> <span class="checkmark"></span> </label>
													<label class="container">Returnee
														<input type="checkbox" name="enroll" value="Returnee" required> <span class="checkmark"></span> </label>
												</div>
											</div>
										</div>
										<div class="form-row form-row-1">
											<input type="text" name="name" id="S_name" class="input-text" placeholder="Student Name" required> </div>
										<div class="form-row">
											<select name="ClassType" required>
												<option class="option" value="" disabled selected>Type Of Enrollment</option>
												<option class="option" value="FLEX">Flex</option>
												<option class="option" value="RAD">Rad</option>
											</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
										<?php 
                        $mysqli = NEW MySQLi('localhost','root','','dbenlist');

                        $resultset=$mysqli->query("SELECT CourseID,CourseName FROM course");
                     ?>
											<div class="form-row">
												<select name="course" required>
													<option class="option" value="" disabled selected>Course</option>
													<?php
						while($rows = $resultset->fetch_assoc())
						{
							$course=$rows['CourseID'];
							$selectcourse=$rows['CourseName'];
							echo"<option class='option' value='$course'>$course - $selectcourse</option>";
						}
						?>
												</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
						</span> </div>
											<div class="form-row">
												<select name="YearLevel" required>
													<option class="option" value="" disabled selected>Year Level</option>
													<option class="option" value="1st Year">1st year</option>
													<option class="option" value="2nd Year">2nd Year</option>
													<option class="option" value="3rd Year">3rd Year</option>
													<option class="option" value="4th Year">4th year</option>
												</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
											<div class="form-row">
												<input type="tel" name="contactNumber" id="ContactNumber" class="input-text" placeholder="Contact Number: 9xxxxxxxxx" maxlength="10" required> </div>
									</div>
									<div class="form-right">
										<br>
										<br>
										<br>
										<br>
										<br>
										<div class="form-row">
											<select name="sem" required>
												<option class="option" value="" disabled selected>Semester</option>
												<option class="option" value="1st Sem">1st Sem</option>
												<option class="option" value="2nd Sem">2nd Sem</option>
											</select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span> </div>
										<div class="form-row form-row-1">
											<input type="text" name="address" id="C_address" class="input-text" placeholder="Complete Address" required> </div>
										<div class="form-row form-row-1">
											<div class="input-name">
												<label for="birthday" style="color: #666;">&emsp;Birthday:</label>
												<input type="date" id="birthday" name="birthday" placeholder="BirthDate" style=" color:#666 ;" required> </div>
										</div>
										<div class="form-row">
											<input type="email" name="email" class="E_address" id="E_address" placeholder="Email Address" required> </div>
										<div class="form-row form-row-1">
											<input type="text" name="parent" class="company" id="company" placeholder="Parent's Name" required> </div>
										<div class="form-row form-row-1">
											<input type="tel" name="parentcontact" class="business" id="business" placeholder="Parent Contact Number 9xxxxxxxxx" maxlength="10" required> </div>
										<div class="form-row-last">
											<center>
												<input type="submit" name="register" class="register" value="Next" style="background-color: #153e90;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;"
>
												<center>
										</div>
									</div>
								</form>
								<?php } ?>
									<script>
									$('.enrollStatus :checkbox').change(function() {
										var $cs = $(this).closest('.enrollStatus').find(':checkbox:checked');
										if($cs.length > 1) {
											this.checked = false;
										}
									});
									</script>
									<script>
									$(function() {
										var requiredCheckboxes = $('.options :checkbox[required]');
										requiredCheckboxes.change(function() {
											if(requiredCheckboxes.is(':checked')) {
												requiredCheckboxes.removeAttr('required');
											} else {
												requiredCheckboxes.attr('required', 'required');
											}
										});
									});
									</script>
				</div>
			</div>
	</body>

	</html>
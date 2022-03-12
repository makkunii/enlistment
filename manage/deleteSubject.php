<?php

include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

$id = $_GET['id'];
$sid = $_GET['sid'];

$deleteform = "DELETE FROM studentsubject WHERE SubjectCode='".$id."' AND StudentNumber='".$sid."'";				
				
				if(mysqli_query( $connection, $deleteform)) 
				{
					echo"<script>alert('Subject Removed')</script>";
					echo"<script>window.location='./employee.php?id=form'</script>";
				}

				else
				{
					echo"<script>alert('Declining form failed.')</script>";
					echo"<script>window.location='./employee.php?id=form'</script>";
    
				} 
?>

<p>testing <?php echo $id ?></p>
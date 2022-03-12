
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CITE Online Enlistment</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/montserrat-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

    <link rel="stylesheet" href="css/style.css"/>
	


<script>
function showSubject(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getsection.php?q="+str,true);
  xmlhttp.send();
}

function sem(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getsection.php?a="+str,true);
  xmlhttp.send();
}
</script>

</head>
<body class="form-v10" Style="background-color: #153e90;">
	<div class="page-content">


		<div class="one-side">
		
		<div class="form-v10-content" >
			<div   class="form-detail"  id="myform">

			
				<div class="form-left">
					
				<h2>CITE Enlistment Form</h2>
				<form  enctype="multipart/form-data" action="enlist.php" method="POST">
				  <?php
				  
			
				$enroll = $_POST['enroll'];
				$ClassType = $_POST['ClassType'];
				$course = $_POST['course'];
				$YearLevel = $_POST['YearLevel'];
				$contactNumber = $_POST['contactNumber'];
				$address = $_POST['address'];
				$birthday = $_POST['birthday'];
				$name = $_POST['name'];
				$studentNumber = $_POST['studentNumber'];
				$email = $_POST['email'];
				$parent = $_POST['parent'];
				$parentcontact = $_POST['parentcontact'];
				$sem = $_POST['sem'];
				
				//YUNG MULA CLASS SAKA YUNG $selectsection nalang yung IADD SA DB

                        $mysqli = NEW MySQLi('localhost','root','','dbenlist');

                        $resultset=$mysqli->query("SELECT Distinct section.Section FROM section,subject WHERE subject.Section=section.Section AND subject.Course='".$course."' AND section.YearLevel='".$YearLevel."' ");
                          ?>
					
					<div class="form-row">
					
						<select name="sect" onchange="showSubject(this.value)">

						   
						   <option class="option" name="section" value="section">Select a Section</option>
						   
						    <?php
						while($rows = $resultset->fetch_assoc())
						{
							$selectsection=$rows['Section'];
							echo"<option class='option' value='$selectsection'>$selectsection</option>";
						}
						
				
				
				
						echo"<input type='hidden' name='enroll' value='$enroll'>";
						echo"<input type='hidden' name='ClassType' value='$ClassType'>";
						echo"<input type='hidden' name='course' value='$course'>";
						echo"<input type='hidden' name='YearLevel' value='$YearLevel'>";
						echo"<input type='hidden' name='contactNumber' value='$contactNumber'>";
						echo"<input type='hidden' name='address' value='$address'>";
						echo"<input type='hidden' name='birthday' value='$birthday'>";
						echo"<input type='hidden' name='name' value='$name'>";
						echo"<input type='hidden' name='studentNumber' value='$studentNumber'>";
						echo"<input type='hidden' name='email' value='$email'>";
						echo"<input type='hidden' name='parent' value='$parent'>";
						echo"<input type='hidden' name='parentcontact' value='$parentcontact'>";
						echo"<input type='hidden' name='sem' value='$sem'>";
						
 						?>
						</select>
						
						
						<span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
					  </span>
					
					  <br><br>
					  
					  
					  <div id="txtHint"><b>Subjects Will Be Listed Here</b></div><br><br>
					  <center>
					  <input type="submit" name="submit" class="register" value="SUBMIT FORM" style="background-color: #153e90;
  border: none;
  color: white;
  padding: 16px 32px;
  width: 300px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;"
>
</center>
					  </form>
					 
					  
					
					
					</div>
					
					
					
				</div>

			
		
				</div>





			


				

		


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


	
		</div>

		
</div>
	
	
</body>
</html>
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
	<link rel="stylesheet" type="text/css" href="css/montserrat-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


<!--===============================================================================================-->
	
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

    <link rel="stylesheet" href="css/style.css"/>
	<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>



</head>

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
<body class="form-v10" Style="background-color: #153e90;">
	<div class="page-content">


		<div class="one-side">
		
		<div class="form-v10-content" >
			<div   class="form-detail"  id="myform">

			
				<div class="form-left">
					
				<h2>CITE Enlistment Form</h2>
				<form  enctype="multipart/form-data" name="form" action="Irregular.php" method="POST" style="padding: 10px;">
				  <?php
				  
			
				
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
				
				
						echo"<input type='hidden' name='enroll' value='Irregular'>";
						echo"<input type='hidden' name='sect' value='Irregular'>";
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
						
<table id="example" class="src-table" style="padding: 50px;">




							<div class="form-row">
		  <select id="cato" name"Course" class="form-control" >
			  <option class="option" value="" selected="true">Course</option>
			  <option>BSIT</option>
			  <option>BSCE</option>
		  </select></select> <span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
						</span> 
	</div>

	
<div class="form-row">
<select id="subo" class="form-control">
   <option value=""  selected="true">YearLevel</option>
   <option>1st Year</option>
   <option>2nd Year</option>
   <option>3rd Year</option>
   <option>4th Year</option>
</select><span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
						</span> 
</div>
  <thead>
    <tr>
	  <th>Select</th>
      <th>Subject Code</th>
	  <th>Subject Name</th>
	  <th>Units</th>
	  <th>Day</th>
	  <th>Time</th>
      <th>Year Level</th>
      <th>Course</th>
	  
	
    </tr>
  </thead>
  <tbody id="r">
      <?php
    $getload = "SELECT subject.subjectID, section.sectionID, subject.SubjectCode, subject.SubjectName, subject.Course, subject.LecUnits, subject.LabUnits, (LecUnits+LabUnits) AS TotalUnits, subject.lecHours, subject.labHours, (lecHours+labHours) AS TotalHours, subject.NoOfSection, subject.lecFaculty, subject.labFaculty, subject.Time, subject.Semester, subject.Days, subject.Section, section.Section, section.Room, section.YearLevel, section.SchoolYear, section.NoOfStudent FROM section,subject WHERE subject.Section=section.Section GROUP BY subjectID";
    $result = mysqli_query( $connection, $getload );
	while ( $load = mysqli_fetch_assoc( $result ) ) {?>
	
    <tr>
    
        <td><label class="container"><input type="checkbox" name="SubjectCodes[]" value="<?php printf("%s",$load['SubjectCode']);?>"><span class="checkmark"></span></label></td>
	  <td><?php printf("%s",$load['SubjectCode']);?>"</td>
	  <td><?php printf("%s",$load['SubjectName']);?></td>
	  <td><?php printf("%s",$load['TotalUnits']);?></td>
	  <td><?php printf("%s",$load['Days']);?></td>
	  <td><?php printf("%s",$load['Time']);?></td>
	  <td><?php printf("%s",$load['YearLevel']);?></td>
      <td><?php printf("%s",$load['Course']);?></td>
	 

    </tr>
  <?php }?>

  

    
  </tbody>
</table>
<br>
<center>
<input type="button" value="Add Subject" id="submit"
style="background-color: #153e90;
  border-radius: 30px;
  color: white;
  padding: 16px 32px;
  width: 300px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;"
>
</center>
<style>
.target-table {
  width: 100%;
  border-collapse: collapse;
}



.target-table th {text-align: left;}
</style>
<table class="target-table" >

  <tr >
      <th>Select</th>
      <th>Subject Code</th>
	  <th>Subject Name</th>
	  <th>Units</th>
	  <th>Day</th>
	  <th>Time</th>
      <th>Year Level</th>
      <th>Course</th>
  </tr>

</table>

<center>
<input type="button" value="Remove Subject" id="clear" style="background-color: #153e90;
  border-radius: 30px;
  color: white;
  padding: 16px 32px;
  width: 300px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;"
>
</center>		
						<br><br><br>
					
						<center>
								<input type="submit" id="submit" name="submit" class="register" value="SUBMIT FORM" style="background-color: #153e90;
																															border: none;
																															color: white;
																															padding: 16px 32px;
																															text-decoration: none;
																															margin: 4px 2px;
																															cursor: pointer;"
																															>
								<center>
					  </form>
					</div>
					
					
					
				</div>

			
		
				</div>





<script>
var table = $('#example').DataTable({
  "bLengthChange": false,
  //searching: false,

  dom: 'tip'
});
  
$(function() {
				$('#tableId').DataTable();
			});
			$('#tableId').dataTable({
				"ordering": false
			});  

  
$.fn.dataTable.ext.search.push(
function( settings, data, dataIndex ) {
    
    var filterCategory= $("#cato option:selected").text();
    var filterSubCategory= $("#subo option:selected").text();
    var subCategory = String(data[6]);
    var category = String(data[7]);
    
    //console.log(filterSubCategory);
    
    if(filterSubCategory != "YearLevel-") {
        if ( filterCategory == category && filterSubCategory == subCategory)
             return true;
        }
        else if(filterCategory != "-Course-") {
            if ( filterCategory == category)
             return true;
        }
  
        return false;
    }
);

</script>


<script>
$('#cato').on('change', function() {
  $('#subo').val("");
  table.draw();
});

$('#subo').on('change', function() {
  table.draw();
});


$(function(){
  $(document).on("click","#submit",function(){
    var getSelectedRows = $(".src-table input:checked").parents("tr").append();
    
    $(".target-table tbody").append(getSelectedRows);
  })
})
$(function(){
  $(document).on("click","#clear",function(){
    var getSelectedRows = $(".target-table input:checked").parents("tr").append();
    $(".src-table tbody").append(getSelectedRows);
  })
})
</script>


				

		


	

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
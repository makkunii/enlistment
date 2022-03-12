<html>
<head>
<style>
.tblform {
  width: 100%;
  border-collapse: collapse;
}

.tblform{
  border: 1px solid black;
  padding: 5px;
}

.container{
  height: auto;
  overflow: hidden;
}

.right{
  width: 50%;
  float: right;
  padding: 8px;
}

.left{
  width: auto;
  overflow: hidden;
  padding: 8px;
}


</style>

</head>
<body>

<?php
include "db.php";

$userid = $_POST['userid'];

$sql = "select * from formrequest where formID=".$userid."";
$result = mysqli_query($con,$sql);

$response = "<div class='container'>";
while( $row = mysqli_fetch_array($result) ){
 $id = $row['formID'];
 $Name = $row['Name'];
 $Class = $row['Class'];
 $YearLevel = $row['YearLevel'];
 $Course = $row['Course'];
 $Section = $row['Section'];
 $Address = $row['Address'];
 $Birthday = $row['Birthday'];
 $StudentNumber = $row['StudentNumber'];
 $Email = $row['Email'];
 $ContactNumber = $row['ContactNumber'];
 $Parent = $row['Parent'];
 $ParentContact = $row['ParentContact'];
 $sem = $row['Sem'];


 $response .= "<div class='right'>";
 $response .= "<b>Email:</b> ".$Email."<br>"; 
 $response .= "<b>Contact number:</b> ".$ContactNumber."<br>"; 
 $response .= "<b>Birthday:</b> ".$Birthday."<br>"; 
 $response .= "<b>Parent Name:</b> ".$Parent."<br>"; 
 $response .= "<b>Parent contact number:</b> ".$ParentContact."<br>"; 
 $response .= "<b>Address:</b> ".$Address.""; 
 $response .= "</div>";


 $response .= "<div class='left'>";
 $response .= "<b>Enrollment Type:</b> ".$Class."<br>";
 $response .= "<b>Name:</b> ".$Name."<br>";
 $response .= "<b>Course:</b> ".$Course."<br>";
 $response .= "<b>Year Level:</b> ".$YearLevel."<br>";
 $response .= "<b>Section:</b> ".$Section."<br>"; 
 $response .= "<b>Student Number:</b> ".$StudentNumber.""; 
 $response .= "</div>";

 $response .= "<br><br>";
 $response .= "<div><b>Subjects</b></div>";
 
 
 $sql2="SELECT 
	studentsubject.StudentNumber,
	studentsubject.SubjectCode,
	subject.SubjectName,
	(LabUnits+LecUnits) AS TotalUnits,
	studentsubject.Section,
	studentsubject.Semester,
	studentsubject.SchoolYear,
	studentsubject.YearLevel,
	subject.Days,
	subject.Time
	FROM
	subject,studentsubject

	WHERE 
	subject.SubjectCode=studentsubject.SubjectCode AND
	StudentNumber ='".$StudentNumber."' AND YearLevel='".$YearLevel."'
    Group BY SubjectCode";
 $result = mysqli_query($con,$sql2);
 
 $response .= "<table class='tblform'>
 <tr>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Subject Code</th>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Subject Name</th>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Units</th>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Section</th>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Time</th>
 <th style='border: 1px solid black; padding: 5px; text-align: left;'>Days</th>
  <th style='border: 1px solid black; padding: 5px; text-align: left;'>Remove</th>
 </tr>";
 
 while($row = mysqli_fetch_array($result)) {
   
   $Subject1 = $row['SubjectCode'];
   $Section1 = $row['Section'];
   $Semester1 = $row['Semester'];
   $SchoolYear1 = $row['SchoolYear'];
   $YearLevel1 = $row['YearLevel'];
   
  

  $response .= "<tr>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>". $row['SubjectCode']."</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['SubjectName'] . "</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['TotalUnits'] . "</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>".$row['Section']."</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['Time'] . "</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['Days'] . "</td>";
  $response .= "<td style='border: 1px solid black; padding: 5px;'><a style='color:red;' href='deleteSubject.php?id=".$row['SubjectCode']."&sid=".$StudentNumber."'>Remove</a></td>";
  
}
}


$response .= "</tr>";
$response .= "</table>";




echo $response;
exit;

?>
</body>
</html>
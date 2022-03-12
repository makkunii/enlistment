<!DOCTYPE html>
<html>
<head>

<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php


$con = mysqli_connect('localhost','root','','dbenlist');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$q = $_GET['q'];


$sql="SELECT *,(LecUnits+LabUnits) AS TotalUnits,(lecHours+labHours) AS TotalHours FROM section,subject 
	WHERE section.Section='".$q."' AND subject.Section=section.Section GROUP BY SubjectCode;";
$result = mysqli_query($con,$sql);



echo "<table>
<tr>

<th>Subject Code</th>
<th>SubjectName</th>
<th>Units</th>
<th>Section</th>
<th>Time</th>
<th>Days</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['SubjectCode'] . "</td>";
  echo "<td>" . $row['SubjectName'] . "</td>";
  echo "<td>" . $row['TotalUnits'] . "</td>";
  echo "<td>" . $row['Section'] . "</td>";
  echo "<td>" . $row['Time'] . "</td>";
  echo "<td>" . $row['Days'] . "</td>";
  
  echo "</tr>";
  echo"<input type='hidden' name='sem' value='".$row['Semester']."'>";
}
echo "</table>";

mysqli_close($con);

?>
</body>
</html>














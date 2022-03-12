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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">
    $(function() {

       var TotalValue = 0;

       $("tr #loop").each(function(index,value){
         currentRow = parseFloat($(this).text());
         TotalValue += currentRow
       });

       document.getElementById('total').innerHTML = "Total: "+TotalValue;

});
</script>
<?php
include "db.php";
session_start();
$userid2 = $_POST['userid'];

$sql = "SELECT 
approvedforms.formID, 
approvedforms.ApprovedBy, 

formrequest.Class, 
formrequest.Course, 
formrequest.YearLevel,
formrequest.ContactNumber,
formrequest.Address, 
formrequest.Birthday,
formrequest.Name,
formrequest.StudentNumber,
formrequest.Email,
formrequest.Parent,
formrequest.ParentContact, 
formrequest.Section,
approvedforms.Date,
formrequest.Sem

FROM approvedforms,formrequest
WHERE approvedforms.formID = formrequest.formID AND approvedforms.formID=" . $userid2 . " ";
$result = mysqli_query($con, $sql);

$response = "<div class='container'>";
while ($row = mysqli_fetch_array($result))
{
    $formID = $row['formID'];
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
    $adviser = $row['ApprovedBy'];
    $Date = $row['Date'];

    $sql2 = "SELECT 
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
	
    $result = mysqli_query($con, $sql2);

    $response .= "<table class='tblform'>";
    $response .= "<tr>";
    $response .= "<td colspan='6' style='border: 1px solid black; padding: 5px;'><center><b>UNOFFICIAL - FOR REFERENCE ONLY</b></center></td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td colspan='6' style='border: 1px solid black; padding: 5px;'><center><b>ADVISING SLIP - " . $sem . " 

	
	
	<b></center></td>";

    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Name</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $Name . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Student Number</td>";
    $response .= "<td colspan='3' style='border: 1px solid black; padding: 5px;'>" . $StudentNumber . "</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Year & Course</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $YearLevel . " " . $Course . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Contact Number</td>";
    $response .= "<td colspan='3' style='border: 1px solid black; padding: 5px;'>" . $ContactNumber . "</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Complete Address</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $Address . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Email Address</td>";
    $response .= "<td colspan='3' style='border: 1px solid black; padding: 5px;'>" . $Email . "</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Birthday</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $Birthday . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
    $response .= "<td colspan='3' style='border: 1px solid black; padding: 5px;'><center>Enrollment Status</center></td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Parent</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $Parent . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><center>New</center></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><center>Old/Continuing</center></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>Parent Contact</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $ParentContact . "</td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><center>Returnee</center></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><center>Transferee</center></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Subject Code</b></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Subject Title</b></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Units</b></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Section</b></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Time</b></td>";
    $response .= "<td style='border: 1px solid black; padding: 5px;'><b>Days</b></td>";
    $response .= "</tr>";

    while ($row = mysqli_fetch_array($result))
    {

        $Subject1 = $row['SubjectCode'];
        $Section1 = $row['Section'];
        $Semester1 = $row['Semester'];
        $SchoolYear1 = $row['SchoolYear'];
        $YearLevel1 = $row['YearLevel'];

        $getsubject = "SELECT * FROM studentsubject WHERE StudentNumber ='" . $StudentNumber . "' AND SubjectCode='" . $Subject1 . "'  AND Semester='" . $Semester1 . "' AND SchoolYear='" . $SchoolYear1 . "' AND YearLevel='" . $YearLevel . "' ";
        $result2 = mysqli_query($con, $getsubject);
        while ($row2 = mysqli_fetch_array($result2))
        {

            $response .= "<tr>";
            $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row2['SubjectCode'] . "</td>";
            $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['SubjectName'] . "</td>";
            $response .= "<td id='loop' style='border: 1px solid black; padding: 5px;'>" . $row['TotalUnits'] . "</td>";
            $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row2['Section'] . "</td>";
            $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['Time'] . "</td>";
            $response .= "<td style='border: 1px solid black; padding: 5px;'>" . $row['Days'] . "</td>";
            $response .= "</tr>";

        }
    }
}
$response .= "<tr>";
$response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
$response .= "<td id='total' style='border: 1px solid black; padding: 5px;'>Total:</td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'></td>";
$response .= "</tr>";

$response .= "<tr>";
$response .= "<td style='border: 1px solid black; padding: 5px;'>Adviser's Name </td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'>" . $adviser . "</td>";
$response .= "<td colspan='4' rowspan='2' style='border: 1px solid black; padding: 5px;'>Adviser's Signature</td>";
$response .= "</tr>";
$response .= "<tr>";
$response .= "<td style='border: 1px solid black; padding: 5px;'>Date: </td>";
$response .= "<td style='border: 1px solid black; padding: 5px;'>" . $Date . "</td>";

$response .= "</tr>";

$response .= "<tr>";
$response .= "<td colspan='6' rowspan='2' style='border: 1px solid black; padding: 5px;'><center>THIS IS NOT AN ENROLLMENT FORM</center></td>";
$response .= "</tr>";

$response .= "</table>";
$response .= "<br><br>";

echo $response;
exit;

?>

</body>
</html>

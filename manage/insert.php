<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$employee = $_GET['employee'];
$id = $_GET['id'];
$contact = $_GET['contact'];
$select = "select * FROM formrequest WHERE formID =" . $id . " & Status='PENDING'";
$go = mysqli_query($connection, $select);
 while ($sec = mysqli_fetch_array($go))
 {
	 $Section = $sec['Section'];
 }
$insert = "UPDATE formrequest SET
Status='APPROVED' WHERE formID='$id' ";


$sql2 = "SELECT *,(LecUnits+LabUnits) AS TotalUnits,(lecHours+labHours) AS TotalHours FROM section,subject 
WHERE section.Section='".$Section."' AND subject.Section=section.Section;";
$result = mysqli_query($connection, $sql2);
while ($row = mysqli_fetch_array($result))
    {
		$Section = $row['Section'];
		$NoOfStudent = $row['NoOfStudent'];
		$NewStudent = $NoOfStudent+1;
		
		$approved = "UPDATE section SET NoOfStudent='".$NewStudent."' WHERE Section='".$Section."'";
		$success = mysqli_query($connection, $approved);
	}




$Date = date("Y-m-d H:i:s");
$employeeCheck = "SELECT * FROM employee WHERE employeeID=" . $employee . " ";
$go2 = mysqli_query($connection, $employeeCheck);
while ($emp = mysqli_fetch_array($go2))
{

    $Name = $emp['Name'];

}
$approved = "INSERT INTO `approvedforms`(`id`, `formID`, `ApprovedBy`,`Date`) VALUES ('','$id','$Name','$Date')";
$success = mysqli_query($connection, $approved);

if (mysqli_query($connection, $insert))
{

    require_once __DIR__ . '/../vendor/autoload.php';

    $basic = new \Vonage\Client\Credentials\Basic("3849c4f6", "EeB9Vpk99zXpaVGc");
    $client = new \Vonage\Client($basic);

    $response = $client->sms()
        ->send(new \Vonage\SMS\Message\SMS($contact, "CITE ONE", 'Good day! Your enlistment form has been approved. Kindly check the website to get your form. Thank you!'));

    $message = $response->current();

    if ($message->getStatus() == 0)
    {
        echo "The message was sent successfully\n";
    }
    else
    {
        echo "The message failed with status: " . $message->getStatus() . "\n";
    }

    echo "<script>alert('Student enlistment form has been approved.')</script>";

    echo "<script>window.location='./employee.php?id=form'</script>";
}

else
{
    echo "<script>alert('Approving form failed.')</script>";
    echo "<script>window.location='./employee.php?id=form'</script>";

}
?>

<p>testing <?php echo $id ?></p>

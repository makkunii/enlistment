<?php

include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (isset($_POST['submit']))
{
    $enroll = $_POST['enroll'];
    $ClassType = $_POST['ClassType'];
    $course = $_POST['course'];
    $YearLevel = $_POST['YearLevel'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $name = $_POST['name'];
    $number = $_POST['studentNumber'];
    $email = $_POST['email'];
    $parent = $_POST['parent'];
    $parentcontact = $_POST['parentcontact'];
    $section = $_POST['sect'];
    $Sem = $_POST['sem'];

    $check = mysqli_query($connection, "SELECT * FROM formrequest WHERE StudentNumber ='$number' AND Yearlevel='$YearLevel' AND Sem='$Sem' ");
    $row = mysqli_num_rows($check);
    if ($row > 0)
    {
        echo "<script>alert('Failed filling out form')</script>";
        echo "<script>window.location='./index.php'</script>";

    }
    else
    {
        $query = "INSERT INTO formrequest VALUES ('','$ClassType','$course','$YearLevel','63$contactNumber','$address','$birthday','$name','$number','$email','$parent','$parentcontact','$section','PENDING','$enroll','$Sem')";

        if (mysqli_query($connection, $query))
        {

            $sql = "SELECT *,(LecUnits+LabUnits) AS TotalUnits,(lecHours+labHours) AS TotalHours FROM section,subject 
	WHERE section.Section='".$section."' AND subject.Section=section.Section GROUP BY SubjectCode;";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result))
            {

                $Subject = $row['SubjectCode'];
                $Section = $row['Section'];
                $Semester = $row['Semester'];
                $SchoolYear = $row['SchoolYear'];
                $YearLevel = $row['YearLevel'];
				$NoOfStudent =$row['NoOfStudent'];
				$NewStudent= $NoOfStudent+1;

                $insert2 = "INSERT INTO studentsubject VALUES ('','" . $number . "','" . $Subject . "','" . $Section . "','" . $Semester . "','" . $SchoolYear . "','" . $YearLevel . "')";
                mysqli_query($connection, $insert2);
				
				$update = "UPDATE section SET NoOfStudent='".$NewStudent."' WHERE Section = '".$Section."'";
				mysqli_query($connection, $update);
            }

            echo "<script>alert('Thank you for filling out the form')</script>";
            echo "<script>window.location='./index.php'</script>";

        }

        else
        {
            echo "<script>alert('Failed filling out form')</script>";
            echo "<script>window.location='./index.php'</script>";

        }

    }
}

else
{
    echo "<script>alert('Failed filling out form')</script>";
    echo "<script>window.location='./index.php'</script>";
}

?>

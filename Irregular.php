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

          

		$SubjectCodes = $_POST['SubjectCodes'];
		
	
		
		
		foreach($SubjectCodes as $chk1) 
    	{
			$test = "SELECT * FROM section WHERE Section='".$section."' AND YearLevel='".$YearLevel."' ";
		$run = mysqli_query($connection, $test);	
		while($row = mysqli_fetch_array($run))
		{
			$SchoolYear = $row['SchoolYear'];
		}
			
			$query ="INSERT INTO studentsubject(StudentNumber,SubjectCode,Section,Semester,SchoolYear,YearLevel) VALUES ('".$number."','".$chk1."','".$section."','".$Sem."','".$SchoolYear."','".$YearLevel."')";
			$query_run = mysqli_query($connection,$query);
			
		}
		if($query_run)  
		   {  
			 
		   }  
		else  
		   {  
			  echo'<script>alert("Failed To Insert")</script>';  
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

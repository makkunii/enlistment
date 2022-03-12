<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) 
{
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} 

else 
{
	$action = $_REQUEST['action'] ?? '';

		if ( 'addEmployee' == $action ) 
		{
			$Name = $_REQUEST['Name'] ?? '';
			$DateofBirth = $_REQUEST['DateofBirth'] ?? '';
			$ContactNo = $_REQUEST['ContactNo'] ?? '';
			$Address = $_REQUEST['Address'] ?? '';
			$Email = $_REQUEST['Email'] ?? '';
			$Username = $_REQUEST['Username'] ?? '';
			$password = $_REQUEST['password'] ?? '';
			$Department = $_REQUEST['Department'] ?? '';

		   
				$hashPassword = password_hash( $password, PASSWORD_BCRYPT );
				$query = "INSERT INTO employee(Name,DateofBirth,ContactNo,Address,Email,Username,password,role,Department) VALUES ('$Name','$DateofBirth','$ContactNo','$Address','$Email','$Username','$hashPassword','employee','$Department')";
				mysqli_query( $connection, $query );
				header( "location:index.php?id=allEmployee" );
		
			
		} 
		elseif ( 'addCourse' == $action ) 
		{
			$CourseID = $_REQUEST['CourseID'] ?? '';
			$CourseName = $_REQUEST['CourseName'] ?? '';
		   
				$query = "INSERT INTO course(CourseID,CourseName) VALUES ('$CourseID','$CourseName')";
				mysqli_query( $connection, $query );
				header( "location:index.php?id=allCourse" );
			
			
		}
		elseif ('editLoad' == $action)
		{
			
			$id1 = $_REQUEST['id1'] ?? '';
			$id2 = $_REQUEST['id2'] ?? '';
			$SubjectCode = $_REQUEST['SubjectCode'] ?? '';
			$SubjectName = $_REQUEST['SubjectName'] ?? '';
			$Course = $_REQUEST['Course'] ?? '';
			$LecUnits = $_REQUEST['LecUnits'] ?? '';
			$LabUnits = $_REQUEST['LabUnits'] ?? '';
			$lecHours = $_REQUEST['lecHours'] ?? '';
			$labHours = $_REQUEST['labHours'] ?? '';
			$NoOfStudents = $_REQUEST['NoOfStudents'] ?? '';
			$NoOfSection = $_REQUEST['NoOfSection'] ?? '';
			$lecFaculty = $_REQUEST['lecFaculty'] ?? '';
			$labFaculty = $_REQUEST['labFaculty'] ?? '';
			$Time = $_REQUEST['Time'] ?? '';
			$Days = $_REQUEST['Days'] ?? '';
			$Room = $_REQUEST['Room'] ?? '';
			$Section = $_REQUEST['Section'] ?? '';
			$YearLevel = $_REQUEST['YearLevel'] ?? '';
			$Semester = $_REQUEST['Semester'] ?? '';
			$SchoolYear = $_REQUEST['SchoolYear'] ?? '';
			
				$query = "UPDATE section SET 
				Section='{$Section}', 
				Room='{$Room}', 
				YearLevel='{$YearLevel}', 
				SchoolYear='{$SchoolYear}'
				WHERE sectionID='{$id1}' ";
				
				if(mysqli_query( $connection, $query))
				{
						$query2 = "UPDATE subject SET 
						
						SubjectCode='{$SubjectCode}',
						SubjectName='{$SubjectName}',
						Course='{$Course}',
						LecUnits='{$LecUnits}',
						LabUnits='{$LabUnits}',
						lecHours='{$lecHours}',
						labHours='{$labHours}',
						NoOfSection='{$NoOfSection}',
						lecFaculty='{$lecFaculty}', 
						labFaculty='{$labFaculty}',
						Section='{$Section}', 
						Days='{$Days}',
						Time='{$Time}',			
						Semester='{$Semester}'
						
						WHERE subjectID='{$id2}'";
						if(mysqli_query( $connection, $query2 )){
							header( "location:index.php?id=EmployeeLoad" );
						}
						else
						{
							echo"<script>alert('Failed')</script>";
						echo"<script>window.location='index.php?id=EmployeeLoad'</script>";
						}
				}
				else
				{
						echo"<script>alert('Failed')</script>";
						echo"<script>window.location='index.php?id=EmployeeLoad'</script>";
				}
		}
	
	
	
		elseif ( 'updateCourse' == $action ) 
		{
			 $id = $_REQUEST['id'] ?? '';
			 $CourseID = $_REQUEST['CourseID'] ?? '';
			 $CourseName = $_REQUEST['CourseName'] ?? '';

		   
				$query = "UPDATE course SET CourseID='{$CourseID}', CourseName='{$CourseName}' WHERE id='{$id}'";
				mysqli_query( $connection, $query );
				header( "location:index.php?id=allCourse" );
			
			
		} 
		elseif ( 'addSection' == $action ) 
		{
			$Section = $_REQUEST['Section'] ?? '';
			$Room = $_REQUEST['Room'] ?? '';
			$YearLevel = $_REQUEST['YearLevel'] ?? '';
			$SchoolYear = $_REQUEST['SchoolYear'] ?? '';
		   
				$query = "INSERT INTO section (Section,Room,YearLevel,SchoolYear) VALUES ('$Section','$Room','$YearLevel','$SchoolYear')";
				mysqli_query( $connection, $query );
				header( "location:index.php?id=allSection" );
			
			
		}
	elseif ( 'Section' == $action ) 
	{
			$id = $_REQUEST['section'] ?? '';
			$Section = $_REQUEST['Section'] ?? '';
			$Room = $_REQUEST['Room'] ?? '';
			$YearLevel = $_REQUEST['YearLevel'] ?? '';
			$Semester = $_REQUEST['Semester'] ?? '';
			$SchoolYear = $_REQUEST['SchoolYear'] ?? '';

       
            $query = "UPDATE section SET 
				Section='{$Section}', 
				Room='{$Room}', 
				YearLevel='{$YearLevel}', 
				SchoolYear='{$SchoolYear}'
				WHERE sectionID='{$id}' ";
			
            if(mysqli_query( $connection, $query ))
			{
				echo"<script>alert('Data Updated.')</script>";
            header( "location:index.php?id=allSection" );
			}
			else 
			{
				echo"<script>alert('Failed.')</script>";
				header( "location:index.php?id=allSection" );
			}
     
    } 
	
	elseif ( 'addSubject' == $action ) 
	{
		 $SubjectCode = $_REQUEST['SubjectCode'] ?? '';
		 $SubjectName = $_REQUEST['SubjectName'] ?? '';
		 $Course = $_REQUEST['Course'] ?? '';
		 $LecUnits = $_REQUEST['LecUnits'] ?? '';
		 $LabUnits = $_REQUEST['LabUnits'] ?? '';
		 $lecHours = $_REQUEST['lecHours'] ?? '';
		 $labHours = $_REQUEST['labHours'] ?? '';
		 $NoOfSection = $_REQUEST['NoOfSection'] ?? '';
		 $lecFaculty = $_REQUEST['lecFaculty'] ?? '';
		 $labFaculty = $_REQUEST['labFaculty'] ?? '';
		 $Section = $_REQUEST['Section'] ?? '';
		 $Days = $_REQUEST['Days'] ?? '';
		 $Time = $_REQUEST['Time'] ?? '';
		 $Semester = $_REQUEST['Semester'] ?? '';
		
       
            $query = "INSERT INTO subject (
			SubjectCode, 
			SubjectName, 
			Course, 
			LecUnits, 
			LabUnits, 
			lecHours, 
			labHours,
			NoOfSection, 
			lecFaculty, 
			labFaculty,
			Section,
			Days,
			Time, 
			Semester) VALUES 
			('$SubjectCode',
			'$SubjectName',
			'$Course',
			'$LecUnits',
			'$LabUnits',
			'$lecHours',
			'$labHours',
			'$NoOfSection',
			'$lecFaculty', 
			'$labFaculty',
			'$Section',
			'$Days',
			'$Time',
			'$Semester')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allSubject" );    
		
    } 
	elseif ( 'Subject' == $action ) 
	{
			$id = $_REQUEST['subject'] ?? '';
			$SubjectCode = $_REQUEST['SubjectCode'] ?? '';
			$SubjectName = $_REQUEST['SubjectName'] ?? '';
			$Course = $_REQUEST['Course'] ?? '';
			$LecUnits = $_REQUEST['LecUnits'] ?? '';
			$LabUnits = $_REQUEST['LabUnits'] ?? '';
			$lecHours = $_REQUEST['lecHours'] ?? '';
			$labHours = $_REQUEST['labHours'] ?? '';
			$NoOfSection = $_REQUEST['NoOfSection'] ?? '';
			$lecFaculty = $_REQUEST['lecFaculty'] ?? '';
			$labFaculty = $_REQUEST['labFaculty'] ?? '';
			$Days = $_REQUEST['Days'] ?? '';
			$Time = $_REQUEST['Time'] ?? '';
			$Section = $_REQUEST['Section'] ?? '';
			$Semester = $_REQUEST['Semester'] ?? '';
			

       
            $query = "UPDATE subject SET 
			SubjectCode='{$SubjectCode}',
			SubjectName='{$SubjectName}',
			Course='{$Course}', 
			LecUnits='{$LecUnits}',
			LabUnits='{$LabUnits}',
			lecHours='{$lecHours}',
			labHours='{$labHours}',
			NoOfSection='{$NoOfSection}',
			lecFaculty='{$lecFaculty}', 
			labFaculty='{$labFaculty}',
			Section='{$Section}', 
			Days='{$Days}',
			Time='{$Time}',	
			Semester='{$Semester}'
			WHERE 
			
			subjectID = '{$id}'
			";
            if(mysqli_query( $connection, $query ))
			{
            header( "location:index.php?id=allSubject" );
			}
			else 
			{
				echo"<script>alert('FAILED')</script>";
				echo"<script>window.location='index.php?id=allSubject'</script>";
			}
 
        
    }
	elseif ( 'updateProfile' == $action ) 
	{

        $Name = $_REQUEST['Name'] ?? '';
		$Username = $_REQUEST['Username'] ?? '';
		
        $oldPassword = $_REQUEST['oldPassword'] ?? '';
        $newPassword = $_REQUEST['newPassword'] ?? '';
        $sessionId = $_SESSION['id'] ?? '';
        $sessionRole = $_SESSION['role'] ?? '';
        $avatar = $_FILES['avatar']['name'] ?? "";

        if ( $Name && $Username && $oldPassword && $newPassword ) {
            $query = "SELECT password,avatar FROM {$sessionRole} WHERE id='$sessionId'";
            $result = mysqli_query( $connection, $query );

            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                $_avatar = $data['avatar'];
                $avatarName = '';
                if ( $_FILES['avatar']['name'] !== "" ) {
                    $allowType = array(
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    );
                    if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                        $avatarName = $_FILES['avatar']['name'];
                        $avatarTmpName = $_FILES['avatar']['tmp_name'];
                        move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                    } else {
                        header( "location:index.php?id=userProfileEdit&avatarError" );
                        return;
                    }
                } else {
                    $avatarName = $_avatar;
                }
                if ( password_verify( $oldPassword, $_password ) ) {
                    $hashPassword = password_hash( $newPassword, PASSWORD_BCRYPT );
                    $updateQuery = "UPDATE {$sessionRole} SET 
					Name='{$Name}',
					Username='{$Username}', 
					password='{$hashPassword}', avatar='{$avatarName}' WHERE id='{$sessionId}'";
                    mysqli_query( $connection, $updateQuery );

                    header( "location:index.php?id=userProfile" );
                }

            }

        } else {
            echo mysqli_error( $connection );
        }
//////////////////////////////////////
    } 
	
	elseif ( 'updateEmployeeProfile' == $action ) {

        $Name = $_REQUEST['Name'] ?? '';
		$DateofBirth = $_REQUEST['DateofBirth'] ?? '';
		$ContactNo = $_REQUEST['ContactNo'] ?? '';
		$Address = $_REQUEST['Address'] ?? '';
		$Email = $_REQUEST['Email'] ?? '';
		$Username = $_REQUEST['Username'] ?? '';
		
        $oldPassword = $_REQUEST['oldPassword'] ?? '';
        $newPassword = $_REQUEST['newPassword'] ?? '';
        $sessionId = $_SESSION['employeeID'] ?? '';
        $sessionRole = $_SESSION['role'] ?? '';
        $avatar = $_FILES['avatar']['name'] ?? "";

        if ( $Name && $Username && $oldPassword && $newPassword ) 
		{
            $query = "SELECT * FROM employee WHERE employeeID='$sessionId'";
            $result = mysqli_query( $connection, $query );

            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                $_avatar = $data['avatar'];
                $avatarName = '';
                if ( $_FILES['avatar']['name'] !== "" ) {
                    $allowType = array(
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    );
                    if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                        $avatarName = $_FILES['avatar']['name'];
                        $avatarTmpName = $_FILES['avatar']['tmp_name'];
                        move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                    } else {
                        header( "location:employee.php?id=userProfileEdit&avatarError" );
                        return;
                    }
                } else {
                    $avatarName = $_avatar;
                }
                if ( password_verify( $oldPassword, $_password ) ) {
                    $hashPassword = password_hash( $newPassword, PASSWORD_BCRYPT );
                    $updateQuery = "UPDATE {$sessionRole} SET Name='{$Name}',DateofBirth='{$DateofBirth}',ContactNo='{$ContactNo}',Address='{$Address}',Email='{$Email}',Username='{$Username}', password='{$hashPassword}', avatar='{$avatarName}' WHERE employeeID='{$sessionId}'";
                    mysqli_query( $connection, $updateQuery );

                    header( "location:employee.php?id=userProfile" );
                }

            }

        } 
		else 
		{
            echo mysqli_error( $connection );
        }

    }

}

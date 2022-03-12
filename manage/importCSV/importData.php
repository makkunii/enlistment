<?php
// Load the database configuration file
include_once '../dbConfig.php';

if(isset($_POST['importload'])){
    
    // Allowed mime types
    $csvMimes = array(
	'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
			fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
				
                $SubjectCode  = $line[0];
                $SubjectName  = $line[1];
				$Course   = $line[2];
                $LecUnits = $line[3];
				$LabUnits = $line[4];
				$TotalUnits = $line[5];
				$LecHours = $line[6];
				$LabHours = $line[7];
				$TotalHours = $line[8];
				$NoOfStudents = $line[9];
				$NoOfSection = $line[10];
				$LecFaculty = $line[11];
				$LabFaculty = $line[12];
				$Time = $line[13];
				$Day = $line[14];
				$Room = $line[15];
				$Section = $line[16];
				$YearLevel = $line[17];
				$Semester = $line[18];
				$SchoolYear = $line[19];
                
					$Query = "SELECT 
					subject.subjectID, 
					section.sectionID, 
					subject.SubjectCode, 
					subject.SubjectName, 
					subject.Course, 
					subject.LecUnits, 
					subject.LabUnits, 
					(LecUnits+LabUnits) AS TotalUnits, 
					subject.lecHours, 
					subject.labHours, 
					(lecHours+labHours) AS TotalHours, 
					subject.NoOfSection,
					subject.lecFaculty,
					subject.labFaculty,
					subject.Time, 
					subject.Semester,
					subject.Days, 
					subject.Section,
					section.Section,
					section.Room,
					section.YearLevel,
					section.SchoolYear, 
					section.NoOfStudent 
					
						FROM section,subject WHERE
					section.Section='".$line[16]."' AND 
					subject.Section = '".$line[16]."' AND
					subject.SubjectCode = '".$line[0]."'
					";
					
					
                   $Result = $db->query($Query);                        
					 if( $Result->num_rows > 0)
					 {
					 
					$update = "UPDATE section,subject SET
					subject.SubjectCode= '".$SubjectCode."', 
					subject.SubjectName= '".$SubjectName."', 
					subject.Course= '".$Course."', 
					subject.LecUnits= '".$LecUnits."', 
					subject.LabUnits= '".$LabUnits."', 
					subject.lecHours= '".$LecHours."', 
					subject.labHours= '".$LabHours."', 
					subject.NoOfSection= '".$NoOfSection."',
					subject.lecFaculty= '".$LecFaculty."',
					subject.labFaculty= '".$LabFaculty."',
					subject.Time= '".$Time."', 
					subject.Semester= '".$Semester."',
					subject.Days= '".$Day."', 
					subject.Section= '".$Section."',
					section.Section= '".$Section."',
					section.Room= '".$Room."',
					section.YearLevel= '".$YearLevel."',
					section.SchoolYear= '".$SchoolYear."', 
					section.NoOfStudent= '".$NoOfStudents."' 
					
					FROM section,subject WHERE
					section.Section='".$line[16]."' AND 
					subject.Setcion = '".$line[16]."' AND
					subject.SubjectCode = '".$line[0]."'
					";
					 
					 }
					else {	
                    // Insert member data in the database
                    $db->query("INSERT INTO subject 
					(`subjectID`,
					`SubjectCode`, 
					`SubjectName`, 
					`Course`, 
					`LecUnits`, 
					`LabUnits`, 
					`lecHours`, 
					`labHours`,
					`NoOfSection`, 
					`lecFaculty`, 
					`labFaculty`, 
					`Section`, 
					`Days`,
					`Time`, 
					`Semester`) VALUES 
					('',
					'".$line[0]."',
					'".$line[1]."', 
					'".$line[2]."', 
					'".$line[3]."', 
					'".$line[4]."', 
					'".$line[6]."',
					'".$line[7]."',
					'".$line[9]."',
					'".$line[11]."',
					'".$line[12]."',
					'".$line[16]."',
					'".$line[14]."',
					'".$line[13]."',
					'".$line[18]."'
					
					
					)");
					
					$db->query("INSERT INTO section
					(`sectionID`, `Section`, `Room`, `YearLevel`, `SchoolYear`) VALUES
					('',
					'".$line[16]."',
					'".$line[15]."', 
					'".$line[17]."', 
					'".$line[19]."'
					
					) ");
				}
					
                }
            
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
	
	// Redirect to the listing page
header("Location:../index.php?id=EmployeeLoad");
}



if(isset($_POST['importCourse'])){
    
    // Allowed mime types
    $csvMimes = array(
	'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
				
                $CourseID   = $line[0];
                $CourseName  = $line[1];
               
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM course WHERE 
				CourseID= '".$line[0]."' AND 
				CourseName = '".$line[1]."' ";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                 // Update member data in the database
                $db->query("UPDATE course SET
				CourseID= '".$line[0]."',
				CourseName = '".$line[1]."'
 
				WHERE 
				CourseID= '".$line[0]."' AND
				CourseName = '".$line[1]."' ");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO course 
					(`id`,`CourseID`,`CourseName`) VALUES 
					('',
					'".$line[0]."',
					'".$line[1]."')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
	
	// Redirect to the listing page
header("Location:../index.php?id=allCourse".$qstring);
}

if(isset($_POST['importEmployee'])){
    
    // Allowed mime types
    $csvMimes = array(
	'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
				
                $Name   = $line[0];
                $DateofBirth  = $line[1];
				$ContactNo   = $line[2];
                $Address  = $line[3];
				$Email   = $line[4];
                $UserName  = $line[5];
				$password   = $line[6];
				$department   = $line[7];
				
                
               $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM employee WHERE 
				Name= '".$line[0]."' AND 
				DateofBirth= '".$line[1]."' AND 
				ContactNo= '".$line[2]."' AND 
				Address= '".$line[3]."' AND 
				Email= '".$line[4]."' AND 
				UserName = '".$line[5]."' AND
				Department = '".$line[7]."' ";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                 // Update member data in the database
                $db->query("UPDATE emplpoyee SET
				Name= '".$line[0]."',
				DateofBirth= '".$line[1]."',
				ContactNo= '".$line[2]."', 
				Address= '".$line[3]."', 
				Email= '".$line[4]."', 
				UserName = '".$line[5]."' 
 
				WHERE 
				Name= '".$line[0]."' AND 
				DateofBirth= '".$line[1]."' AND 
				ContactNo= '".$line[2]."' AND 
				Address= '".$line[3]."' AND 
				Email= '".$line[4]."' AND 
				UserName = '".$line[5]."' ");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO employee 
					(Name,DateofBirth,ContactNo,Address,Email,Username,password,department,role) VALUES 
					('$Name',
					'$DateofBirth',
					'$ContactNo',
					'$Address',
					'$Email',
					'$Username',
					'$hashPassword',
					'$Department',
					'employee')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
	
	// Redirect to the listing page
header("Location:../index.php?id=allEmployee".$qstring);
}
























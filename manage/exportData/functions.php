<?php
include_once '../dbConfig.php';
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );


 if(isset($_POST["ExportLoadIT"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Code','Descriptive Title','Course','Units','','','Hours','','','No of Students','No of Section','Faculty','' ,'Time','Day','Room','Section','Year Level','Semester','School Year'));  
           fputcsv($output, array('','','','lec','lab','Total','lec','lab','Total','','','lec','lab' ,'','','','','','','')); 
     
	  $query ="SELECT 			subject.SubjectCode,
				subject.SubjectName,
				subject.Course,
				subject.LecUnits,
				subject.LabUnits,
				(subject.LecUnits + subject.LabUnits) AS Total1,
				lecHours,
				labHours,
				(subject.lecHours + subject.labHours) AS Total2,
				section.NoOfStudent,
				subject.NoOfSection,
				subject.lecFaculty,
				subject.labFaculty,
				subject.Time,
				subject.Days,
				section.Room,
				section.Section,
				section.YearLevel,
				subject.Semester,
				section.SchoolYear
		FROM subject,section
			WHERE subject.Section=section.Section AND Course LIKE '%BSIT%'";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }
 
 if(isset($_POST["ExportLoadCE"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Code','Descriptive Title','Course','Units','','','Hours','','','No of Students','No of Section','Faculty','' ,'Time','Day','Room','Section','Year Level','Semester','School Year'));  
       fputcsv($output, array('','','','lec','lab','Total','lec','lab','Total','','','lec','lab' ,'','','','','','',''));  
     
	  $query ="SELECT 			subject.SubjectCode,
				subject.SubjectName,
				subject.Course,
				subject.LecUnits,
				subject.LabUnits,
				(subject.LecUnits + subject.LabUnits) AS Total1,
				lecHours,
				labHours,
				(subject.lecHours + subject.labHours) AS Total2,
				section.NoOfStudent,
				subject.NoOfSection,
				subject.lecFaculty,
				subject.labFaculty,
				subject.Time,
				subject.Days,
				section.Room,
				section.Section,
				section.YearLevel,
				subject.Semester,
				section.SchoolYear
		FROM subject,section
			WHERE subject.Section=section.Section AND Course LIKE '%BSCE%'";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }

 if(isset($_POST["ExportSubjectIT"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Subject Code', 'Subject Name', 'Course' ,'Units','Time','Day','Room','Section'));  
      $query = "SELECT 	subject.SubjectCode,
				subject.SubjectName,
				subject.Course,
				(subject.LecUnits + subject.LabUnits) AS Total1,
				subject.Time,
				subject.Days,
				section.Room,
				section.Section
		FROM subject,section
			WHERE subject.Section=section.Section AND Course LIKE '%BSIT%'";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }
  if(isset($_POST["ExportSubjectCE"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Subject Code', 'Subject Name', 'Course' ,'Units','Time','Day','Room','Section'));  
      $query = "SELECT 	subject.SubjectCode,
				subject.SubjectName,
				subject.Course,
				(subject.LecUnits + subject.LabUnits) AS Total1,
				subject.Time,
				subject.Days,
				section.Room,
				section.Section
				
		FROM subject,section
			WHERE subject.Section=section.Section AND Course LIKE '%BSCE%'";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }
 if(isset($_POST["ExportSectionIT"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Section', 'Room', 'YearLevel', 'School Year'));  
      $query = "SELECT
				section.Section,
				section.Room,
				section.YearLevel,
				section.SchoolYear
			

				FROM subject,section WHERE 
				subject.Section = section.Section AND Course LIKE '%BSIT%' ";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 
  if(isset($_POST["ExportSectionCE"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Section', 'Room', 'YearLevel', 'School Year'));  
      $query = "SELECT
					section.Section,
				section.Room,
				section.YearLevel,
				section.SchoolYear
			

				FROM subject,section WHERE 
				subject.Section = section.Section AND Course LIKE '%BSCE%' "; 
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 
 if(isset($_POST["ExportCourse"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('CourseID','CourseName'));  
      $query = "SELECT CourseID,CourseName from course";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 
 if(isset($_POST["ExportEmployee"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Name','Email','Phone'));  
      $query = "SELECT Name,Email,ContactNo from employee";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 } 
 if(isset($_POST["ExportApprovedForm"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('StudentNumber','Name','ApprovedBy'));  
      $query = "SELECT approvedforms.ApprovedBy, 
                                formrequest.Name, formrequest.StudentNumber
                                FROM approvedforms,formrequest
                                WHERE approvedforms.formID = formrequest.formID;";  
      $result = mysqli_query($connection, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 
 
 

?>
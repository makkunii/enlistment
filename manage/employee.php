<?php
    session_start();
  
	$sessionId = $_SESSION['employeeID'] ?? '';
    $sessionRole = $_SESSION['role'] ?? '';
    echo "<div style='hidden'><p hidden>$sessionId</p></div>";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }

    ob_start();

    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }

    $id = $_REQUEST['id'] ?? 'dashboard';
    $action = $_REQUEST['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">
    
    
    <!-- Script -->
    <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src='bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/report.css">
    <title>CITE Online Enlistment</title>
</head>

<style>

#view{
  background-color: #3446c9;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
  width: 80px;
  height: 35px;
}

#approve{
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
  width: 80px;
  height: 35px;
}

#decline{
  background-color: #e33d3d;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
  width: 80px;
  height: 35px;
}

#view:hover{
  background-color: #2b3aab;
  color: white;
}

#approve:hover{
  background-color: #419444;
  color: white;
}

#decline:hover{
  background-color: #ba3030;
  color: white;
}

@media screen {
    #printSection {
        display: none;
    }
}
@media print {
    body * {
        visibility:hidden;
    }

    #printSection, #printSection * {
        visibility:visible;
        font-size: 20px;
    }
    #printSection {
        position:absolute;
        left: 150px;
        top:0;
        font-size: 20px;
    }
}

</style>

<body>
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "Dashboard";
                    }elseif ( 'EmployeeLoad' == $id ) {
                        echo "Employee Load";
                    } elseif ( 'form' == $id ) {
                        echo "Enlistment Forms";
                    } elseif ( 'Approvedform' == $id ) {
                        echo "Approved Forms";
                    } elseif ( 'allSection' == $id ) {
                        echo "Sections";
                    } elseif ( 'allSubject' == $id ) {
                        echo "Subjects";
                    }
                    
                ?>

            </span>
        </div>

        <div class="topber__profile">
             <?php
                $query = "SELECT * FROM employee WHERE employeeID='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $Name = $data['Name'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$Name (" . ucwords( $role ) . ")";
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="employee.php">Dashboard</a>
                        <a class="dropdown-item" href="employee.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
        </div>
    </section>
    


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel">CITE | ONE</h3>
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="employee.php?id=dashboard"><i id="left" class="fa fa-bars"></i>Dashboard</a>
            </li>
			 <li id="left" class="sideber__item<?php if ( 'EmployeeLoad' == $id ) {
    echo " active";
}?>">
                <a href="employee.php?id=EmployeeLoad"><i id="left" class="fas fa-users"></i>Employee Load</a>
            </li>
            <?php if ( 'employee' == $sessionRole ) {?>
                <!-- For Admin, Manager -->
                <?php }?>
            <li id="left" class="sideber__item<?php if ( 'form' == $id ) {
            echo " active";
            }?>">
                <a href="employee.php?id=form"><i id="left" class="fa fa-folder"></i>Enlistment Forms</a>
            </li>

            <li id="left" class="sideber__item<?php if ( 'Approvedform' == $id ) {
            echo " active";
            }?>">
                <a href="employee.php?id=Approvedform"><i id="left" class="fa fa-folder"></i>Approved Forms</a>
            </li>

            <li id="left" class="sideber__item<?php if ( 'allSection' == $id ) {
            echo " active";
            }?>">
                <a href="employee.php?id=allSection"><i id="left" class="fas fa-folder"></i>Sections</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'allSubject' == $id ) {
            echo " active";
            }?>">
                <a href="employee.php?id=allSubject"><i id="left" class="fas fa-folder"></i>Subjects</a>
            </li>
        </ul>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

           <!-- ---------------------- DashBoard ------------------------ -->
           <?php if ( 'dashboard' == $id ) {?>

               

<?php
$con = mysqli_connect("localhost", "root", "", "dbenlist"); 
$count = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED'"));
$count2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='PENDING'"));
$count3 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM approvedforms WHERE Date >= curdate()"));
$count4 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED' AND Course='BSIT'"));
$count5 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED' AND Course='BSCE'"));
?>
<main>
<div class="main__container">
<!-- MAIN TITLE STARTS HERE -->

<div class="main__title">
<img src="assets/img/hello.svg" alt="" />
<div class="main__greeting">
<h1>Hello, <?php echo "$Name"; ?></h1>
<p>Welcome to your dashboard</p>
</div>
</div>

<!-- MAIN TITLE ENDS HERE -->

<!-- MAIN CARDS STARTS HERE -->
<div class="main__cards">

<div class="card">
<div class="card_inner">
<p class="text-primary-p">Total Approved<br>Today</p>
<span class="font-bold text-title"><?php echo $count3[0]; ?></span>
</div>
</div>

<div class="card">
<div class="card_inner">
<p class="text-primary-p">Total Approved</p>
<span class="font-bold text-title"><?php echo $count[0]; ?></span>
</div>
</div>



<div class="card">
<div class="card_inner">
<p class="text-primary-p">Total Pending</p>
<span class="font-bold text-title"><?php echo $count2[0]; ?></span>
</div>
</div>

<br>

<div class="card">
<div class="card_inner">
<p class="text-primary-p">Total Approved BSIT</p>
<span class="font-bold text-title"><?php echo $count4[0]; ?></span>
</div>
</div>

<div class="card">
<div class="card_inner">
<p class="text-primary-p">Total Approved BSCE</p>
<span class="font-bold text-title"><?php echo $count5[0]; ?></span>
</div>
</div>

</div>
<!-- MAIN CARDS ENDS HERE -->
</div>
</main>



            <br><br>
            <h3 style="color:#2e4a66;">Today's Approved Forms</h3>
                <div class="">
                
                    <div class="form">
                        <div class="main__table">
                        <table class="table" id="tableId">
                                <thead>
                                    <tr>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Approved By</th>
                                        <th scope="col">Date Approved</th>
                                        
                                        
                                        <?php if ('employee' == $sessionRole ) {?>
                                            <!-- actions -->
                                            <th scope="col">View</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $getApproved = "SELECT approvedforms.formID, approvedforms.ApprovedBy, 
                                formrequest.Name, formrequest.StudentNumber, approvedforms.Date
                                FROM approvedforms,formrequest
                                WHERE approvedforms.formID = formrequest.formID AND approvedforms.Date >= curdate();";
                                $result = mysqli_query($connection,$getApproved);
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['formID'];
                                    $name = $row['Name'];
                                    $ApprovedBy = $row['ApprovedBy'];
                                    $StudentNumber = $row['StudentNumber'];
                                    $Date = $row['Date'];
                                    
                                    
                                    echo "<tr>";
                                    echo "<td>".$StudentNumber."</td>";
                                    echo "<td>".$name."</td>";
                                    echo "<td>".$ApprovedBy."</td>";
                                    echo "<td>".$Date."</td>";
                                    
                                    echo "<td><button data-id='".$id."' class='userform' id='view'>View</button></td>";
                                    echo "</tr>";
                                }
                                ?>

                                </tbody>
                            </table>


                        </div>
              
            </div>
            <?php }?>
            <!-- ---------------------- Approved Forms ------------------------ -->


<!-- ---------------------- DashBoard ------------------------ -->
 <!-- ---------------------- Employee Load ------------------------ -->
            <div class="">
                <?php if ( 'EmployeeLoad' == $id ) {?>
               
                    <div class="allCourse">
					
							
	<div class="row">

   
	<div class="main__table2" >							
								 <!-- Data list table --> 
									<table class="table2" id="tableId">
										<thead>
	<tr>
    <th scope="col" rowspan=2 width="50px">CODE</th>
<th scope="col" rowspan=2 width="50px">Descriptive Title</th>
																			<th scope="col" rowspan=2 width="50px">Course</th>
																			<th scope="col" colspan=3 width="80px">Units </th>
																			<th scope="col" colspan=3 width="80px">Number of Hours</th>
																			<th scope="col" rowspan=2 width="50px">No of Students</th>
																			<th scope="col" rowspan=2 width="50px">No. of Sections</th>
																			<th scope="col" colspan=2 width="50px">Faculty</th>
																			<th scope="col" rowspan=2 width="50px">TIME</th>
																			<th scope="col" rowspan=2 width="50px">DAY</th>
																			<th scope="col" rowspan=2 width="50px">ROOM</th>
																			<th scope="col" rowspan=2 width="50px">SECTION</th>
																			<th scope="col" rowspan=2 width="50px">Year Level</th>
																			<th scope="col" rowspan=2 width="50px">Semester</th>
																			<th scope="col" rowspan=2 width="50px">S.Y</th>
	</tr>
	<tr style="background-color: #153e90; color: white;">
		<td>LEC </td>
		<td>LAB </td>
		<td>TOTAL </td>
		<td>LEC </td>
		<td>LAB </td>
		<td>TOTAL </td>
		<td>LEC </td>
		<td>LAB </td>
	</tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getload = "SELECT subject.subjectID, section.sectionID, subject.SubjectCode, subject.SubjectName, subject.Course, subject.LecUnits, subject.LabUnits, (LecUnits+LabUnits) AS TotalUnits, subject.lecHours, subject.labHours, (lecHours+labHours) AS TotalHours, subject.NoOfSection, subject.lecFaculty, subject.labFaculty, subject.Time, subject.Semester, subject.Days, subject.Section, section.Section, section.Room, section.YearLevel, section.SchoolYear, section.NoOfStudent FROM section,subject WHERE subject.Section=section.Section GROUP BY sectionID";
                                            $result = mysqli_query( $connection, $getload );

                                        while ( $load = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            
                                            <td><?php printf( "%s", $load['SubjectCode'] );?></td>
											<td><?php printf( "%s", $load['SubjectName'] );?></td>
											<td><?php printf( "%s", $load['Course'] );?></td>
											<td><?php printf( "%s", $load['LecUnits'] );?></td>
											<td><?php printf( "%s", $load['LabUnits'] );?></td>
											<td><?php printf( "%s", $load['TotalUnits'] );?></td>
											<td><?php printf( "%s", $load['lecHours'] );?></td>
											<td><?php printf( "%s", $load['labHours'] );?></td>
											<td><?php printf( "%s", $load['TotalHours'] );?></td>
											<td><?php printf( "%s", $load['NoOfStudent'] );?></td>
											<td><?php printf( "%s", $load['NoOfSection'] );?></td>
											<td><?php printf( "%s", $load['lecFaculty'] );?></td>
											<td><?php printf( "%s", $load['labFaculty'] );?></td>
											<td><?php printf( "%s", $load['Time'] );?></td>
											<td><?php printf( "%s", $load['Days'] );?></td>
											<td><?php printf( "%s", $load['Room'] );?></td>
											<td><?php printf( "%s", $load['Section'] );?></td>
											<td><?php printf( "%s", $load['YearLevel'] );?></td>
											<td><?php printf( "%s", $load['Semester'] );?></td>
											<td><?php printf( "%s", $load['SchoolYear'] );?></td>
                                          
                                              
                                            
                                        </tr>

                                    <?php }?>

                                </tbody>
    </table>
	</div>
        
	                                                <div>
																<!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
																<form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
																	<div class="form-group">
																		<div class="col-md-4 col-md-offset-4" style="padding-left: 70px; margin-left: 50px; float:right ">
																			<input type="submit" name="ExportLoadIT" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download IT Load" /> </div>
																	</div>
																<div class="col-md-4 col-md-offset-4" style="padding-left: 70px;  float:left">
																			<input type="submit" name="ExportLoadCE" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download CE Load"/> </div>
																</form>
															</div>
 
                                                

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
                                           



 

 <?php }?>
            <!-- ---------------------- Enlistment Form ------------------------ -->
            <div class="">
                <?php if ( 'form' == $id ) {?>
                    <div class="form">
                        <div class="main__table">
                        <table class="table" id="tableId">
                                <thead>
                                    <tr>
                                        <th scope="col">FormID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Class</th>
                                        
                                        <?php if ('employee' == $sessionRole ) {?>
                                            <!-- actions -->
                                            <th scope="col">View</th>
                                            <th scope="col">Approve</th>
                                            <th scope="col">Decline</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $query = "select formID, Name, Course, YearLevel,ContactNumber, Class from formrequest WHERE Status='PENDING'";
                                $result = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['formID'];
                                    $name = $row['Name'];
                                    $course = $row['Course'];
                                    $year = $row['YearLevel'];
                                    $class = $row['Class'];
									$contact = $row['ContactNumber'];
                                    
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$name."</td>";
                                    echo "<td>".$course."</td>";
                                    echo "<td>".$year."</td>";
                                    echo "<td>".$class."</td>";
                                    echo "<td><button data-id='".$id."' class='userinfo' id='view'>View</button></td>";
                                    echo "<td><a id='approve' href='insert.php?id=".$row['formID']."&employee=".$sessionId."&contact=".$contact."'>Approve</a></td>";
                                    echo "<td><a id='decline' href='delete.php?id=".$row['formID']."&contact=".$contact."'>Decline</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>
            </div>
            <!-- ---------------------- Enlistment Form ------------------------ -->

            <!-- ---------------------- Modal ------------------------ -->
            <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog" >
            
                <!-- Modal content-->
                <div class="modal-content" style="width: 800px; height: auto; position: absolute; left: 50%; top: 50%; transform: translate(-40%, 0%);" >
                <div class="modal-header">
                    <h4 class="modal-title">Student Enlistment Form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
            
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
                </div>
            </div>

            <script type='text/javascript'>
            $(document).ready(function(){

                $('.userinfo').click(function(){
                   
                    var userid = $(this).data('id');
            
                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
                        }
                    });
                });
            });
            </script>

            <!-- ---------------------- Modal ------------------------ -->

            <!-- ---------------------- Approved Forms ------------------------ -->
            <div class="">
                <?php if ( 'Approvedform' == $id ) {?>
                    <div class="form">
                        <div class="main__table">
                        <table class="table" id="tableId">
                                <thead>
                                    <tr>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Approved By</th>
                                        <th scope="col">Date Approved</th>
                                        
                                        
                                        <?php if ('employee' == $sessionRole ) {?>
                                            <!-- actions -->
                                            <th scope="col">View</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $getApproved = "SELECT approvedforms.formID, approvedforms.ApprovedBy, 
                                formrequest.Name, formrequest.StudentNumber, approvedforms.Date
                                FROM approvedforms,formrequest
                                WHERE approvedforms.formID = formrequest.formID;";
                                $result = mysqli_query($connection,$getApproved);
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['formID'];
                                    $name = $row['Name'];
                                    $ApprovedBy = $row['ApprovedBy'];
                                    $StudentNumber = $row['StudentNumber'];
                                    $Date = $row['Date'];
                                    
                                    
                                    echo "<tr>";
                                    echo "<td>".$StudentNumber."</td>";
                                    echo "<td>".$name."</td>";
                                    echo "<td>".$ApprovedBy."</td>";
                                    echo "<td>".$Date."</td>";
                                    
                                    echo "<td><button data-id='".$id."' class='userform' id='view'>View</button></td>";
                                    echo "</tr>";
                                }
                                ?>

                                </tbody>
                            </table>


                        </div>
						<div>
 <!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
            <form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4" style="padding-left: 70px">
                                <input type="submit" name="ExportApprovedForm" class="btn btn-default" style="width: 120px; background-color: #153e90; color: white;" value="Export to csv"/>
                            </div>
                   </div>                    
            </form>           
 </div>
 

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
                    </div>
                <?php }?>
            </div>
            <!-- ---------------------- Approved Forms ------------------------ -->

            <!-- ---------------------- Modal ------------------------ -->
            <div class="modal fade" id="empModal2" role="dialog">
                <div class="modal-dialog" >
            
                <!-- Modal content-->
                <div class="modal-content" style="width: 800px; height: auto; position: absolute; left: 50%; top: 50%; transform: translate(-40%, 0%);" >
                <div class="modal-header">
                    <h4 class="modal-title">Approved Form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="printThis" class="modal-body">
            
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" id="Print">Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
                </div>
                </div>
                </div>
            </div>

            <script type='text/javascript'>
            $(document).ready(function(){

                $('.userform').click(function(){
                   
                    var userid2 = $(this).data('id');
            
                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile2.php',
                        type: 'post',
                        data: {userid2: userid2},
                        success: function(response){ 
                            // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal2').modal('show'); 
                        }
                    });
                });
            });
            </script>

            <script>
            document.getElementById("Print").onclick = function () {
                printElement(document.getElementById("printThis"));
            };

            function printElement(elem) {
                var domClone = elem.cloneNode(true);

                var $printSection = document.getElementById("printSection");

                if (!$printSection) {
                    var $printSection = document.createElement("div");
                    $printSection.id = "printSection";
                    document.body.appendChild($printSection);
                }

                $printSection.innerHTML = "";
                $printSection.appendChild(domClone);
                window.print();
            }
            </script>

            <!-- ---------------------- Modal ------------------------ -->

                       <!-- ---------------------- Section ------------------------ -->
                       <div class="section">
<?php if ( 'allSection' == $id ) {?>
                    <div class="allSection">
					

	<div class="main__table">							
 <!-- Data list table --> 
    <table class="table" id="tableId">
        <thead>
            <tr>
                <th scope="col">Section</th>
				<th scope="col">Room</th>
				<th scope="col">Year Level</th>
				<th scope="col">S.Y</th>

            </tr>
        </thead>
		<tbody>
        <?php
        // Get member rows
		 
        		$result = $db->query("SELECT * FROM section");
				
		 	
        if($result->num_rows > 0){
            while($section = $result->fetch_assoc()){
        ?>
            <tr>
               <td><?php printf( "%s", $section['Section'] );?></td>
				<td><?php printf( "%s", $section['Room'] );?></td>
				<td><?php printf( "%s", $section['YearLevel'] );?></td>
				<td><?php printf( "%s", $section['SchoolYear'] );?></td>

                
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No Section(s) found...</td></tr>
        <?php } ?>
        </tbody>
		
    </table>
</div>

                                                                                                                <div>
																													<!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
																													<form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
																														<div class="form-group">
																															<div class="col-md-8 col-md-offset-4" style="float:right; ">
																																<input type="submit" name="ExportSectionIT" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download IT Section" /> </div>
																														</div>
																													<div class="col-md-4 col-md-offset-4" style="float:left;">
																																<input type="submit" name="ExportSectionCE" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download CE Section"/> </div>
																													</form>
																												</div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
                    </div>
			 		 
<?php }?>
                <!-- ---------------------- Ssubject ------------------------ -->
            <div class="subject">
                 <?php if ( 'allSubject' == $id ) {?>
                    <div class="allSubject">
						<div class="row">	
                        <div class="main__table2">
                        <table class="table2" id="tableId">
                                <thead>
                                    <tr>
                                     <th rowspan="2" scope="col">Subject Code</th>
									<th rowspan="2" scope="col">Descriptive Title</th>
									<th rowspan="2" scope="col">Course</th>
									<th colspan="3" scope="col">Units</th>
									<th colspan="3" scope="col">Number of Hours</th>
									<th rowspan="2" scope="col">Number of Sections</th>
									<th colspan="2" scope="col">Faculty</th>
									<th rowspan="2" scope="col">Section</th>
									<th rowspan="2" scope="col">Days</th>
									<th rowspan="2" scope="col">Time</th>
									<th rowspan="2" scope="col">Semester</th>
                                        
                                       
                                    </tr>
									<tr style="background-color: #153e90; color: white;">
										<td>Lec</td>
										<td>Lab</td>
										<td>Total</td>
										<td>Lec</td>
										<td>Lab</td>
										<td>Total</td>
										<td>Lec</td>
										<td>Lab</td>
									</tr>
                                </thead>
								
                                 <tbody>
								 
								 
          <?php
        // Get member rows
        $result = $db->query("SELECT *,(LecUnits+LabUnits) AS TotalUnits,(lecHours+labHours) AS TotalHours FROM `subject`");
        if($result->num_rows > 0){
            while($subject = $result->fetch_assoc()){
        ?>
            <tr>
				<td><?php printf( "%s", $subject['SubjectCode'] );?></td>
                <td><?php printf( "%s", $subject['SubjectName'] );?></td>
				<td><?php printf( "%s", $subject['Course'] );?></td>
				<td><?php printf( "%s", $subject['LecUnits'] );?></td>
				<td><?php printf( "%s", $subject['LabUnits'] );?></td>
				<td><?php printf( "%s", $subject['TotalUnits'] );?></td>
				<td><?php printf( "%s", $subject['lecHours'] );?></td>
				<td><?php printf( "%s", $subject['labHours'] );?></td>
				<td><?php printf( "%s", $subject['TotalHours'] );?></td>
				<td><?php printf( "%s", $subject['NoOfSection'] );?></td>
				<td><?php printf( "%s", $subject['lecFaculty'] );?></td>
				<td><?php printf( "%s", $subject['labFaculty'] );?></td>
				<td><?php printf( "%s", $subject['Section'] );?></td>
				<td><?php printf( "%s", $subject['Days'] );?></td>
				<td><?php printf( "%s", $subject['Time'] );?></td>
				<td><?php printf( "%s", $subject['Semester'] );?></td>

              
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
		
								
                            </table>


                        </div>
                    </div>
                    <div>
																<!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
																<form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
																	<div class="form-group">
																	<div class="col-md-8 col-md-offset-4" style="float:right; ">
																			<input type="submit" name="ExportSubjectIT" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download IT Subject" /> </div>
																	</div>
																	<div class="col-md-4 col-md-offset-4" style="float:left;">
																			<input type="submit" name="ExportSubjectCE" class="btn btn-default" style="width: 220px; background-color: #153e90; color: white;" value="Download CE Subject"/> </div>
																</form>
															</div>
															<br>
 

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
					
					
                <?php }?>



            <!-- ---------------------- User Profile ------------------------ -->
            <?php if ( 'userProfile' == $id ) {
                    $query = "SELECT * FROM {$sessionRole} WHERE employeeID='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>
                <div class="userProfile">
                    <div class="main__form myProfile">
                        <form action="employee.php">
                            <div class="main__form--title myProfile__title text-center">My Profile</div>
                            <div class="form-row text-center">
                                <div class="col col-12 text-center pb-3">
                                    <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                 <div class="col col-12">
                                    <h4><b>Name : </b><?php printf( "%s", $data['Name'] );?></h4>
                                </div>
								
								<div class="col col-12">
                                    <h4><b>Username : </b><?php printf( "%s", $data['Username'] );?></h4>
                                </div>
                                
                                <input type="hidden" name="id" value="userProfileEdit">
                                <div class="col col-12">
                                    <input class="updateMyProfile" type="submit" value="Update Profile">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>

            <?php if ( 'userProfileEdit' == $id ) {
                    $query = "SELECT * FROM {$sessionRole} WHERE employeeID='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>


                <div class="userProfileEdit">
                    <div class="main__form">
                        <div class="main__form--title text-center">Update My Profile</div>
                        <form enctype="multipart/form-data" action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12 text-center pb-3">
                                    <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                    <i class="fas fa-pen pimgedit"></i>
                                    <input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar">
                                </div>
                                <div class="col col-12">
                                <?php if ( isset( $_REQUEST['avatarError'] ) ) {
                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
                                    }?>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="Name" placeholder="Name" value="<?php echo $data['Name']; ?>" required>
                                    </label>
                                </div>
								<div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-calendar"></i>
                                        <input type="date" name="DateofBirth" placeholder="Date of Birth" value="<?php echo $data['DateofBirth']; ?>" required>
                                    </label>
                                </div>
								<div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="text" name="ContactNo" placeholder="ContactNo" value="<?php echo $data['ContactNo']; ?>" required>
                                    </label>
                                </div>
								<div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-home"></i>
                                        <input type="text" name="Address" placeholder="Address" value="<?php echo $data['Address']; ?>" required>
                                    </label>
                                </div>
								<div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="email" name="Email" placeholder="email" value="<?php echo $data['Email']; ?>" required>
                                    </label>
                                </div>
                            
								
                         
								<div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="Username" placeholder="Username" value="<?php echo $data['Username']; ?>" required>
                                    </label>
                                </div>
                                
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password" required>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput2" type="password" name="newPassword" placeholder="New Password" required>
                                        <p>Type Old Password if you don't want to change</p>
                                        <i id="pwd2" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <input type="hidden" name="action" value="updateEmployeeProfile">
                                <div class="col col-12">
                                    <input type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- User Profile ------------------------ -->

        </div>

    </section>

    <!--------------------------------- #Main section -------------------------------->

    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#tableId').DataTable();
    });

    $('#tableId').dataTable( {
    "ordering": false
    } );
</script>
    
</body>

</html>
<?php if ( 'admin' == $sessionRole )
 {
	 
	  header( "location:index.php" );
 }
 
 
 ?>
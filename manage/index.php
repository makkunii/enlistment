<?php
session_start();
$sessionId = $_SESSION['id']??'';
$sessionRole = $_SESSION['role']??'';
$sessionDepartment = $_SESSION['Department']??'';
echo "<div style='visibility: hidden'>$sessionId $sessionRole</div/>";
if (!$sessionId && !$sessionRole)
{
    header("location:login.php");
    die();
}

ob_start();

include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection)
{
    echo mysqli_error($connection);
    throw new Exception("Database cannot Connect");
}

$id = $_REQUEST['id']??'dashboard';
$action = $_REQUEST['action']??'';
?>
	<!DOCTYPE html>
	<?php if ('admin' == $sessionRole)
{ ?>
		<html lang="en">

		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=1024">
			<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
			<script src="https://ajax.googleapis.com//ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<!-- Bootstrap CSS -->
			<link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
			<link rel="stylesheet" href="assets/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/css/all.min.css">
			<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="assets/css/report.css">
			<title>CITE Online Enlistment</title>
		</head>

		<body>
			<!--------------------------------- Secondary Navber -------------------------------->
			<section class="topber">
				<div class="topber__title"> <span class="topber__title--text">
                <?php
    if ('dashboard' == $id)
    {
        echo "Dashboard";
    }
    elseif ('EmployeeLoad' == $id)
    {
        echo "Employee Load";
    }
    elseif ('addEmployee' == $id)
    {
        echo "Add Employee";
    }
    elseif ('allEmployee' == $id)
    {
        echo "All Employee";
    }
    elseif ('addCourse' == $id)
    {
        echo "Add Course";
    }
    elseif ('allCourse' == $id)
    {
        echo "Courses";

    }
    elseif ('addSection' == $id)
    {
        echo "Add Section";
    }
    elseif ('allSection' == $id)
    {
        echo "Sections";

    }
    elseif ('addSubject' == $id)
    {
        echo "Add Subject";
    }
    elseif ('allSubject' == $id)
    {
        echo "Subjects";

    }
    elseif ('userProfile' == $id)
    {
        echo "Your Profile";
    }
    elseif ('editEmployee' == $action)
    {
        echo "Edit Employee";

    }
?>

            </span> </div>
				<div class="topber__profile">
					<?php
    $query = "SELECT * FROM admin WHERE id='$sessionId'";
    $result = mysqli_query($connection, $query);

    if ($data = mysqli_fetch_assoc($result))
    {
        $Name = $data['Name'];
        $role = $data['role'];
        $avatar = $data['avatar'];
?> <img src="assets/img/<?php echo "$avatar"?>" height="25" width="25" class="rounded-circle" alt="profile">
						<div class="dropdown">
							<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php
        echo "$Name (" . ucwords($role) . ")";
    }
?>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="index.php">Dashboard</a> <a class="dropdown-item" href="index.php?id=userProfile">Profile</a> <a class="dropdown-item" href="logout.php">Logout</a> </div>
						</div>
				</div>
			</section>
			<!--------------------------------- Sideber -------------------------------->
			<section id="sideber" class="sideber">
				<ul class="sideber__ber">
					<h3 class="sideber__panel">CITE | ONE</h3>
					<li id="left" class="sideber__item<?php if ('dashboard' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=dashboard"><i id="left" class="fas fa-bars"></i>Dashboard</a> </li>
					<li id="left" class="sideber__item<?php if ('EmployeeLoad' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=EmployeeLoad"><i id="left" class="fas fa-users"></i>Employee Load</a> </li>
					<?php if ('admin' == $sessionRole)
    { ?>
						<!-- Only For Admin -->
						<li id="left" class="sideber__item sideber__item--modify<?php if ('addEmployee' == $id)
        {
            echo " active ";
        } ?>"> <a href="index.php?id=addEmployee"><i id="left" class="fas fa-user-plus"></i></i>Add Employee</a> </li>
						<?php
    } ?>
							<li id="left" class="sideber__item<?php if ('allEmployee' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=allEmployee"><i id="left" class="fas fa-users"></i>All Employee</a> </li>
							<?php if ('admin' == $sessionRole)
    { ?>
								<!-- For Admin, Manager -->
								<li id="left" class="sideber__item sideber__item--modify<?php if ('addCourse' == $id)
        {
            echo " active ";
        } ?>"> <a href="index.php?id=addCourse"><i id="left" class="fas fa-folder-plus"></i></i>Add
                        Course</a> </li>
								<?php
    } ?>
									<li id="left" class="sideber__item<?php if ('allCourse' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=allCourse"><i id="left" class="fas fa-folder"></i>All Course</a> </li>
									<li id="left" class="sideber__item sideber__item--modify<?php if ('addSection' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=addSection"><i id="left" class="fas fa-folder-plus"></i></i>Add
                        Section</a> </li>
									<li id="left" class="sideber__item<?php if ('allSection' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=allSection"><i id="left" class="fas fa-folder"></i>All Section</a> </li>
									<li id="left" class="sideber__item sideber__item--modify<?php if ('addSubject' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=addSubject"><i id="left" class="fas fa-folder-plus"></i></i>Add
                        Subject</a> </li>
									<li id="left" class="sideber__item<?php if ('allSubject' == $id)
    {
        echo " active ";
    } ?>"> <a href="index.php?id=allSubject"><i id="left" class="fas fa-folder"></i>All Subject</a> </li>
				</ul>
			</section>
			<!--------------------------------- #Sideber -------------------------------->
			<!--------------------------------- Main section -------------------------------->
			<section class="main">
				<div class="container">
					<!-- ---------------------- DashBoard ------------------------ -->
					<?php if ('dashboard' == $id)
    { ?>
						<?php
        $con = mysqli_connect("localhost", "root", "", "dbenlist");
        $count = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED'"));
        $count2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='PENDING'"));
        $count4 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED' AND Course='BSIT'"));
        $count5 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM formrequest WHERE Status='APPROVED' AND Course='BSCE'"));

?>
							<main>
								<div class="main__container">
									<!-- MAIN TITLE STARTS HERE -->
									<div class="main__title"> <img src="assets/img/hello.svg" alt="" />
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
												<p class="text-primary-p">Total Approved
													<br>Today</p> <span class="font-bold text-title">1</span> </div>
										</div>
										<div class="card">
											<div class="card_inner">
												<p class="text-primary-p">Total Approved</p> <span class="font-bold text-title"><?php echo $count[0]; ?></span> </div>
										</div>
										<div class="card">
											<div class="card_inner">
												<p class="text-primary-p">Total Pending</p> <span class="font-bold text-title"><?php echo $count2[0]; ?></span> </div>
										</div>
										<br>
										<br>
										<div class="card">
											<div class="card_inner">
												<p class="text-primary-p">Total Approved BSIT</p> <span class="font-bold text-title"><?php echo $count4[0]; ?></span> </div>
										</div>
										<div class="card">
											<div class="card_inner">
												<p class="text-primary-p">Total Approved BSCE</p> <span class="font-bold text-title"><?php echo $count5[0]; ?></span> </div>
										</div>
									</div>
									<!-- MAIN CARDS ENDS HERE -->
								</div>
							</main>
							<?php
    } ?>
								<!-- ---------------------- DashBoard ------------------------ -->
								<!-- ---------------------- Employee Load ------------------------ -->
								<div class="">
									<?php if ('EmployeeLoad' == $id)
    { ?>
										<div class="allCourse">
											<?php
        if (!empty($_GET['status']))
        {
            switch ($_GET['status'])
            {
                case 'succ':
                    $statusType = 'alert-success';
                    $statusMsg = 'Members data has been imported successfully.';
                break;
                case 'err':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Some problem occurred, please try again.';
                break;
                case 'invalid_file':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Please upload a valid CSV file.';
                break;
                default:
                    $statusType = '';
                    $statusMsg = '';
            }
        }
?>
												<!-- Display status message -->
												<?php if (!empty($statusMsg))
        { ?>
													<div class="col-xs-12">
														<div class="alert <?php echo $statusType; ?>">
															<?php echo $statusMsg; ?>
														</div>
													</div>
													<?php
        } ?>
														<div class="row">
															<!-- Import link -->
															<div class="col-md-10 head" style="padding-left: 15px;">
																<div class="float-right"> <a href="javascript:void(0);" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" onclick="formToggle('importFrm');"><i class="plus"></i>Open file</a> </div>
															</div>
															<!-- CSV file upload form -->
															<div class="col-md-10" id="importFrm" style="display: none;">
																<div class="float-right" style="padding-top: 10px;">
																	<form action="importCSV/importData.php" method="post" enctype="multipart/form-data">
																		<input type="file" name="file" />
																		<input type="submit" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" name="importload" value="Import"> </form>
																</div>
															</div>
															<div class="main__table2">
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
																			<th scope="col" rowspan=2 width="20px">Edit</th>
																			<th scope="col" rowspan=2 width="20px">Delete</th>
																		</tr>
																		<tr style="background-color: #153e90; color: white; ">
																			<td>LEC</td>
																			<td>LAB</td>
																			<td>TOTAL</td>
																			<td>LEC</td>
																			<td>LAB</td>
																			<td>TOTAL</td>
																			<td>LEC</td>
																			<td>LAB</td>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
        $getload = "SELECT subject.subjectID, section.sectionID, subject.SubjectCode, subject.SubjectName, subject.Course, subject.LecUnits, subject.LabUnits, (LecUnits+LabUnits) AS TotalUnits, subject.lecHours, subject.labHours, (lecHours+labHours) AS TotalHours, subject.NoOfSection, subject.lecFaculty, subject.labFaculty, subject.Time, subject.Semester, subject.Days, subject.Section, section.Section, section.Room, section.YearLevel, section.SchoolYear, section.NoOfStudent FROM section,subject WHERE subject.Section=section.Section GROUP BY sectionID";
        $result = mysqli_query($connection, $getload);

        while ($load = mysqli_fetch_assoc($result))
        { ?>
																			<tr>
																				
																				<td>
																					<?php printf("%s", $load['SubjectCode']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['SubjectName']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Course']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['LecUnits']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['LabUnits']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['TotalUnits']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['lecHours']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['labHours']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['TotalHours']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['NoOfStudent']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['NoOfSection']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['lecFaculty']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['labFaculty']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Time']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Days']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Room']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Section']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['YearLevel']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['Semester']); ?>
																				</td>
																				<td>
																					<?php printf("%s", $load['SchoolYear']); ?>
																				</td>
																				<td>
																					<?php printf("<a href='index.php?action=editLoad&id=%s&id2=%s'><i class='fas fa-edit'></i></a>", $load['sectionID'],$load['subjectID']) ?></td>
																				<td>
																					<?php printf("<a class='delete' href='index.php?action=deleteLoad&id=%s&id2=%s'><i class='fas fa-trash'></i></a>", $load['sectionID'],$load['subjectID']) ?></td>
																			</tr>
																			<?php
        } ?>
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
															function formToggle(ID) {
																var element = document.getElementById(ID);
																if(element.style.display === "none") {
																	element.style.display = "block";
																} else {
																	element.style.display = "none";
																}
															}
															</script>
															<?php
    } ?>
																<?php if ('editLoad' == $action)
    {
        $loadID = $_REQUEST['id'];
		$loadID2 = $_REQUEST['id2'];
        $selectLoad = "SELECT * FROM section,subject WHERE section.sectionID='{$loadID}' AND subject.subjectID='{$loadID2}'";
        $result = mysqli_query($connection, $selectLoad);

        $load = mysqli_fetch_assoc($result); ?>
																	<div class="addCourse">
																		<div class="main__form">
																			<div class="main__form--title text-center">Update Employee Loading</div>
																			<form action="add.php" method="POST">
																				<div class="form-row">
																					<div class="col col-12">
																						<input type="text" name="id2" value="<?php echo $load['subjectID']; ?>">
																						<input type="text" name="id1" value="<?php echo $load['sectionID']; ?>">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="SubjectCode" placeholder="Subject Code" value="<?php echo $load['SubjectCode']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="SubjectName" placeholder="Subject Descriptive" value="<?php echo $load['SubjectName']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Course" placeholder="Course" value="<?php echo $load['Course']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="LecUnits" placeholder="Lecture Units" value="<?php echo $load['LecUnits']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="LabUnits" placeholder="Laboratory Units" value="<?php echo $load['LabUnits']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="lecHours" placeholder="Lecture Hours" value="<?php echo $load['lecHours']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="labHours" placeholder="Laboratory Hours" value="<?php echo $load['labHours']; ?>" required> </label>
																					</div>
																					
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="NoOfSection" placeholder="Number of Section" value="<?php echo $load['NoOfSection']; ?>" required> </ <div class="col col-12">
																							<label class="input"> <i id="left" class="fas fa-folder"></i>
																								<input type="text" name="lecFaculty" placeholder="Lecture Faculty" value="<?php echo $load['lecFaculty']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="labFaculty" placeholder="Laboratory Faculty" value="<?php echo $load['labFaculty']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Time" placeholder="Time" value="<?php echo $load['Time']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Days" placeholder="Day" value="<?php echo $load['Days']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Room" placeholder="Room" value="<?php echo $load['Room']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Section" placeholder="Section" value="<?php echo $load['Section']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="YearLevel" placeholder="Year Level" value="<?php echo $load['YearLevel']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="Semester" placeholder="Semester" value="<?php echo $load['Semester']; ?>" required> </label>
																					</div>
																					<div class="col col-12">
																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																							<input type="text" name="SchoolYear" placeholder="School Year" value="<?php echo $load['SchoolYear']; ?>" required> </label>
																					</div>
																					<input type="hidden" name="action" value="editLoad"></input>
																					<div class="col col-12">
																						<input type="submit" value="Update"> </div>
																				</div>
																			</form>
																		</div>
																	</div>
																	<?php
    } ?>
	<?php if ('deleteLoad' == $action)
    {
        $loadID1 = $_REQUEST['id'];
		$loadID2 = $_REQUEST['id2'];
        
        $deleteLoad1 = "DELETE FROM section WHERE sectionID ='{$loadID1}' ";
		  if (mysqli_query($connection, $deleteLoad1))
		{
			$deleteLoad2 = "DELETE FROM subject WHERE subjectID ='{$loadID2}' ";
			$result2 = mysqli_query($connection, $deleteLoad2);
			
			header("location:index.php?id=EmployeeLoad");
		}
		else
		{
				echo"<script>alert('Student enlistment form has been declined.')</script>";
		}
		
		
    
        
        header("location:index.php?id=EmployeeLoad");
    } ?>
																			<!-- ---------------------- Employee ------------------------ -->
																			<div class="employee">
																				<?php if ('allEmployee' == $id)
    { ?>
																					<div class="allEmployee">
																						<?php
        if (!empty($_GET['status']))
        {
            switch ($_GET['status'])
            {
                case 'succ':
                    $statusType = 'alert-success';
                    $statusMsg = 'Members data has been imported successfully.';
                break;
                case 'err':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Some problem occurred, please try again.';
                break;
                case 'invalid_file':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Please upload a valid CSV file.';
                break;
                default:
                    $statusType = '';
                    $statusMsg = '';
            }
        }
?>
																							<!-- Display status message -->
																							<?php if (!empty($statusMsg))
        { ?>
																								<div class="col-xs-12">
																									<div class="alert <?php echo $statusType; ?>">
																										<?php echo $statusMsg; ?>
																									</div>
																								</div>
																								<?php
        } ?>
																									<div class="row">
																										<!-- Import link -->
																										<div class="col-md-11 head">
																											<div class="float-right"> <a href="javascript:void(0);" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" onclick="formToggle('importFrm');"><i class="plus"></i>Open file</a> </div>
																										</div>
																										<!-- CSV file upload form -->
																										<div class="col-md-11" id="importFrm" style="display: none;">
																											<div class="float-right" style="padding-top: 10px;">
																												<form action="importCSV/importData.php" method="post" enctype="multipart/form-data">
																													<input type="file" name="file" />
																													<input type="submit" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" name="importEmployee" value="Import"> </form>
																											</div>
																										</div>
																										<div class="main__table">
																											<table class="table" id="tableId2">
																												<thead>
																													<tr>
																														<th scope="col">Avatar</th>
																														<th scope="col">Name</th>
																														<th scope="col">Email</th>
																														<th scope="col">Phone</th>
																														<th scope="col">Department</th>
																														<?php if ('admin' == $sessionRole)
        { ?>
																															<!-- Only For Admin -->
																															<th scope="col">Delete</th>
																															<?php
        } ?>
																													</tr>
																												</thead>
																												<tbody>
																													<?php
        // Get member rows
        $result = $db->query("SELECT * FROM employee ORDER BY employeeID DESC");
        if ($result->num_rows > 0)
        {
            while ($employee = $result->fetch_assoc())
            {
?>
																														<tr>
																															<td>
																																<center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $employee['avatar']?>" alt=""></center>
																															</td>
																															<td>
																																<?php printf("%s", $employee['Name']); ?>
																															</td>
																															<td>
																																<?php printf("%s", $employee['Email']); ?>
																															</td>
																															<td>
																																<?php printf("%s", $employee['ContactNo']); ?>
																															</td>
																															<td>
																																<?php printf("%s", $employee['Department']); ?>
																															</td>
																															<?php if ('admin' == $sessionRole)
                { ?>
																																<!-- Only For Admin -->
																																<td>
																																	<?php printf("<a class='delete' href='index.php?action=deleteEmployee&id=%s'><i class='fas fa-trash'></i></a>", $employee['employeeID']) ?></td>
																																<?php
                } ?>
																														</tr>
																														<?php
            }
        }
        else
        { ?>
																															<tr>
																																<td colspan="5">No member(s) found...</td>
																															</tr>
																															<?php
        } ?>
																												</tbody>
																											</table>
																										</div>
																										<div>
																											<!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
																											<form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
																												<div class="form-group">
																													<div class="col-md-4 col-md-offset-12" style="padding-left: 70px">
																														<input type="submit" name="ExportEmployee" class="btn btn-default" style="width: 120px; background-color: #153e90; color: white;" value="Export to csv" /> </div>
																												</div>
																											</form>
																										</div>
																										<!-- Show/hide CSV upload form -->
																										<script>
																										function formToggle(ID) {
																											var element = document.getElementById(ID);
																											if(element.style.display === "none") {
																												element.style.display = "block";
																											} else {
																												element.style.display = "none";
																											}
																										}
																										</script>
																									</div>
																									<?php
    } ?>
																										<?php if ('addEmployee' == $id)
    { ?>
																											<div class="addEmployee">
																												<div class="main__form">
																													<div class="main__form--title text-center">Add New Employee</div>
																													<form action="add.php" method="POST">
																														<div class="form-row">
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-user-circle"></i>
																																	<input type="text" name="Name" placeholder="Name" required> </label>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-calendar"></i>
																																	<input type="date" name="DateofBirth" placeholder="Date of Birth" required> </label>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-phone-alt"></i>
																																	<input type="number" name="ContactNo" placeholder="Contact No" required> </label>
																															</div>
																															<div class="col col-12">
																																<div class="input"> <i id="left" class="fas fa-user"></i>
																																	<select name="Department">
																																		<option class="option" value="title">Department</option>
																																		<option class="option" value="IT">IT</option>
																																		<option class="option" value="C">CE</option>
																																	</select> <span class="select-btn">
											<i class="zmdi zmdi-chevron-down"></i>
									  </span> </div>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-home"></i>
																																	<input type="text" name="Address" placeholder="Address" required> </label>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-envelope"></i>
																																	<input type="email" name="Email" placeholder="Email" required> </label>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-user"></i>
																																	<input type="text" name="Username" placeholder="Username" required> </label>
																															</div>
																															<div class="col col-12">
																																<label class="input"> <i id="left" class="fas fa-key"></i>
																																	<input id="pwdinput" type="password" name="password" placeholder="Password" required> <i id="pwd" class="fas fa-eye right"></i> </label>
																															</div>
																															<input type="hidden" name="action" value="addEmployee">
																															<div class="col col-12">
																																<input type="submit" value="Submit"> </div>
																														</div>
																													</form>
																												</div>
																											</div>
																											<?php
    } ?>
																												<?php if ('deleteEmployee' == $action)
    {
        $employeeId = $_REQUEST['id'];
        $deleteEmployee = "DELETE FROM employee WHERE employeeID ='{$employeeId}'";
        $result = mysqli_query($connection, $deleteEmployee);
        header("location:index.php?id=allEmployee");
    } ?>
																					</div>
																					<!-- ---------------------- Employee ------------------------ -->
																					<!-- ---------------------- Course ------------------------ -->
																					<div class="">
																						<?php if ('allCourse' == $id)
    { ?>
																							<div class="allCourse">
																								<?php
        if (!empty($_GET['status']))
        {
            switch ($_GET['status'])
            {
                case 'succ':
                    $statusType = 'alert-success';
                    $statusMsg = 'Members data has been imported successfully.';
                break;
                case 'err':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Some problem occurred, please try again.';
                break;
                case 'invalid_file':
                    $statusType = 'alert-danger';
                    $statusMsg = 'Please upload a valid CSV file.';
                break;
                default:
                    $statusType = '';
                    $statusMsg = '';
            }
        }
?>
																									<!-- Display status message -->
																									<?php if (!empty($statusMsg))
        { ?>
																										<div class="col-xs-12">
																											<div class="alert <?php echo $statusType; ?>">
																												<?php echo $statusMsg; ?>
																											</div>
																										</div>
																										<?php
        } ?>
																											<div class="row">
																												<!-- Import link -->
																												<div class="col-md-10 head" style="padding-left: 15px;">
																													<div class="float-right"> <a href="javascript:void(0);" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" onclick="formToggle('importFrm');"><i class="plus"></i>Open file</a> </div>
																												</div>
																												<!-- CSV file upload form -->
																												<div class="col-md-10" id="importFrm" style="display: none;">
																													<div class="float-right" style="padding-top: 10px;">
																														<form action="importCSV/importData.php" method="post" enctype="multipart/form-data">
																															<input type="file" name="file" />
																															<input type="submit" class="btn btn-default" style="width: 100px; background-color: #153e90; color: white;" name="importCourse" value="Import"> </form>
																													</div>
																												</div>
																												<div class="aligntbl" style="margin-left: auto; margin-right: auto;">
																													<div class="main__table">
																														<!-- Data list table -->
																														<table class="table" id="tableId">
																															<thead>
																																<tr>
																																	<th scope="col">CourseID</th>
																																	<th scope="col">Course Name</th>
																																	<?php if ('admin' == $sessionRole)
        { ?>
																																		<!-- For Admin, Manager -->
																																		<th scope="col">Edit</th>
																																		<th scope="col">Delete</th>
																																		<?php
        } ?>
																																</tr>
																															</thead>
																															<tbody>
																																<?php
        $getCourse = "SELECT * FROM course";
        $result = mysqli_query($connection, $getCourse);

        while ($course = mysqli_fetch_assoc($result))
        { ?>
																																	<tr>
																																		<td>
																																			<?php printf("%s", $course['CourseID']); ?>
																																		</td>
																																		<td>
																																			<?php printf("%s", $course['CourseName']); ?>
																																		</td>
																																		<?php if ('admin' == $sessionRole)
            { ?>
																																			<!-- For Admin, Manager -->
																																			<td>
																																				<?php printf("<a href='index.php?action=editCourse&id=%s'><i class='fas fa-edit'></i></a>", $course['id']) ?></td>
																																			<td>
																																				<?php printf("<a class='delete' href='index.php?action=deleteCourse&id=%s'><i class='fas fa-trash'></i></a>", $course['id']) ?></td>
																																			<?php
            } ?>
																																	</tr>
																																	<?php
        } ?>
																															</tbody>
																														</table>
																													</div>
																													<div>
																														<!-- YUNG ACTION KUNG IMPLEMENT TO SA IBA GAWA KA NG BAGONG EXPORT FILE -->
																														<form class="form-horizontal" action="exportData/functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
																															<div class="form-group">
																																<div class="col-md-4 col-md-offset-4" style="padding-left: 70px">
																																	<input type="submit" name="ExportCourse" class="btn btn-default" style="width: 120px; background-color: #153e90; color: white;" value="Export to csv" /> </div>
																															</div>
																														</form>
																													</div>
																													<!-- Show/hide CSV upload form -->
																													<script>
																													function formToggle(ID) {
																														var element = document.getElementById(ID);
																														if(element.style.display === "none") {
																															element.style.display = "block";
																														} else {
																															element.style.display = "none";
																														}
																													}
																													</script>
																													<?php
    } ?>
																														<?php if ('addCourse' == $id)
    { ?>
																															<div class="addCourse">
																																<div class="main__form">
																																	<div class="main__form--title text-center">Add New Course</div>
																																	<form action="add.php" method="POST">
																																		<div class="form-row">
																																			<div class="col col-12">
																																				<label class="input"> <i id="left" class="fas fa-folder"></i>
																																					<input type="text" name="CourseID" placeholder="Course ID" required> </label>
																																			</div>
																																			<div class="col col-12">
																																				<label class="input"> <i id="left" class="fas fa-folder"></i>
																																					<input type="text" name="CourseName" placeholder="Course Name" required> </label>
																																			</div>
																																			<input type="hidden" name="action" value="addCourse">
																																			<div class="col col-12">
																																				<input type="submit" value="Submit"> </div>
																																		</div>
																																	</form>
																																</div>
																															</div>
																															<?php
    } ?>
																																<?php if ('editCourse' == $action)
    {
        $CourseID = $_REQUEST['id'];
        $selectCourse = "SELECT * FROM course WHERE id='{$id}'";
        $result = mysqli_query($connection, $selectCourse);

        $course = mysqli_fetch_assoc($result); ?>
																																	<div class="addCourse">
																																		<div class="main__form">
																																			<div class="main__form--title text-center">Update Course</div>
																																			<form action="add.php" method="POST">
																																				<div class="form-row">
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="CourseID" placeholder="Course ID" value="<?php echo $course['CourseID']; ?>" required> </label>
																																					</div>
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="CourseName" placeholder="Course Name" value="<?php echo $course['CourseName']; ?>" required> </label>
																																					</div>
																																					<input type="hidden" name="action" value="updateCourse">
																																					<input type="hidden" name="id" value="<?php echo $CourseID; ?>">
																																					<div class="col col-12">
																																						<input type="submit" value="Update"> </div>
																																				</div>
																																			</form>
																																		</div>
																																	</div>
																																	<?php
    } ?>
																																		<?php if ('deleteCourse' == $action)
    {
        $CourseID = $_REQUEST['id'];
        $deleteCourse = "DELETE FROM course WHERE id ='{$CourseID}'";
        $result = mysqli_query($connection, $deleteCourse);
        header("location:index.php?id=allCourse");
    } ?>
																												</div>
																												<!-- ---------------------- Course ------------------------ -->
																												<!-- ---------------------- Section ------------------------ -->
																												<div class="section">
																													<?php if ('allSection' == $id)
    { ?>
																														<div class="allSection">
																															<div class="main__table">
																																<!-- Data list table -->
																																<table class="table" id="tableId">
																																	<thead>
																																		<tr>
																																			<th scope="col">Section</th>
																																			<th scope="col">Room</th>
																																			<th scope="col">YearLevel</th>
																																			<th scope="col">Number Of Students</th>
																																			<th scope="col">School Year</th>
																																			
																																			<th scope="col">S.Y</th>
																																			<th scope="col">Edit</th>
																																			<th scope="col">Delete</th>
		
																																		</tr>
																																	</thead>
																																	<tbody>
																																		<?php
        // Get member rows
        $result = $db->query("SELECT * FROM section");
				
				
        if ($result->num_rows > 0)
        {
            while ($section = $result->fetch_assoc())
            {
?>
																																			<tr>
																																				<td>
																																					<?php printf("%s", $section['Section']); ?>
																																				</td>
																																				<td>
																																					<?php printf("%s", $section['Room']); ?>
																																				</td>
																																				<td>
																																					<?php printf("%s", $section['YearLevel']); ?>
																																				</td>
																																				<td>
																																					<?php printf("%s", $section['NoOfStudent']); ?>
																																				</td>
																																				<td>
																																					<?php printf("%s", $section['SchoolYear']); ?>
																																				</td>
																																	
																																				<td>
																																					<?php printf("%s", $section['SchoolYear']); ?>
																																				</td>
																																			
																																					<td><?php printf( "<a href='index.php?action=editSection&id=%s'><i class='fas fa-edit'></i></a>", $section['sectionID'] )?></td>
																																					<td><?php printf( "<a class='delete' href='index.php?action=deleteSection&id=%s'><i class='fas fa-trash'></i></a>", $section['sectionID'] )?></td>
               
																																			
			
																																			</tr>
																																			<?php
            }
        }
        else
        { ?>
																																				<tr>
																																					<td colspan="5">No Section(s) found...</td>
																																				</tr>
																																				<?php
        } ?>
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

																												<br>
																												<br>
																																												<!-- Show/hide CSV upload form -->
																															<script>
																															function formToggle(ID) {
																																var element = document.getElementById(ID);
																																if(element.style.display === "none") {
																																	element.style.display = "block";
																																} else {
																																	element.style.display = "none";
																																}
																															}
																															</script>
																														</div>
																														<?php
    } ?>
																															<?php if ('addSection' == $id)
    { ?>
																																<div class="addSection">
																																	<div class="main__form">
																																		<div class="main__form--title text-center">Add New Section</div>
																																		<form action="add.php" method="POST">
																																			<div class="form-row">
																																				<div class="col col-12">
																																					<label class="input"> <i id="left" class="fas fa-users"></i>
																																						<input type="text" name="Section" placeholder="Section" required> </label>
																																				</div>
																																				<div class="col col-12">
																																					<label class="input"> <i id="left" class="fas fa-folder"></i>
																																						<input type="text" name="Room" placeholder="Room" required> </label>
																																				</div>
																																				<div class="col col-12">
																																					<div class="input"> <i id="left" class="fas fa-user"></i>
																																						<select name="YearLevel">
																																							<option class="option" value="title">Year Level</option>
																																							<option class="option" value="1st Year">1st year</option>
																																							<option class="option" value="2nd Year">2nd Year</option>
																																							<option class="option" value="3rd Year">3rd Year</option>
																																							<option class="option" value="4th Year">4th year</option>
																																						</select> <span class="select-btn">
																																				<i class="zmdi zmdi-chevron-down"></i>
																																				</span> </div>
																																				</div>
																																				<div class="col col-12">
																																					<label class="input"> <i id="left" class="fas fa-clock"></i>
																																						<input type="text" name="SchoolYear" placeholder="School Year" required> </label>
																																				</div>
															
																																				
																																				
																																				<input type="hidden" name="action" value="addSection">
																																				<div class="col col-12">
																																					<input type="submit" value="Submit"> </div>
																																			</div>
																																		</form>
																																	</div>
																																</div>
																																<?php
    } ?>
																																	<?php if ('editSection' == $action)
    {
        $sectionID = $_REQUEST['id'];
        $selectSection = "SELECT * FROM section WHERE sectionID='{$sectionID}'";
        $result = mysqli_query($connection, $selectSection);

        $section = mysqli_fetch_assoc($result); ?>
																																		<div class="addSection">
																																			<div class="main__form">
																																				<div class="main__form--title text-center">Update Section</div>
																																				<form action="add.php" method="POST">
																																					<div class="form-row">
																																						<input type="hidden" name="section" value="<?php echo $sectionID; ?>">
																																						<div class="col col-12">
																																							<label class="input"> <i id="left" class="fas fa-users"></i>
																																								<input type="text" name="Section" placeholder="Section" value="<?php echo $section['Section']; ?>" required> </label>
																																						</div>
																																						<div class="col col-12">
																																							<label class="input"> <i id="left" class="fas fa-folder"></i>
																																								<input type="text" name="Room" placeholder="Room" value="<?php echo $section['Room']; ?>" required> </label>
																																						</div>
																																						<div class="input"> 
																																						<i id="left" class="fas fa-user"></i>
																																							<select name="YearLevel">
																																											<option class="option" value="" disabled selected>Year Level</option>
																																											<option class="option" value="1st Year">1st year</option>
																																											<option class="option" value="2nd Year">2nd Year</option>
																																											<option class="option" value="3rd Year">3rd Year</option>
																																											<option class="option" value="4th Year">4th year</option>
																																										</select> <span class="select-btn"> </span> 
																																						<i class="zmdi zmdi-chevron-down"></i>
																																					</div>	
																																						<div class="col col-12">
																																							<label class="input"> <i id="left" class="fas fa-clock"></i>
																																								<input type="text" name="SchoolYear" placeholder="School Year" value="<?php echo $section['SchoolYear']; ?>" required> </label>
																																						</div>
																																						<input type="hidden" name="action" value="Section">
																																	
																																						<div class="col col-12">
																																							<input type="submit" value="Update"> </div>
																																					</div>
																																				</form>
																																			</div>
																																		</div>
																																		<?php
    } ?>

																												</div>
				<?php if ('deleteSection' == $action)
    {
        $section = $_REQUEST['id'];
        $deleteSection = "DELETE FROM section WHERE sectionID ='{$section}'";
        $result = mysqli_query($connection, $deleteSection);
        header("location:index.php?id=allSection");
    } ?>
																												<!-- ---------------------- Section ------------------------ -->
																												<!-- ---------------------- Ssubject ------------------------ -->
																												<div class="subject">
																													<?php if ('allSubject' == $id)
    { ?>
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
																																				
																																				<th rowspan="2" scope="col">Edit</th>
																																				<th rowspan="2" scope="col">Delete</th>
																																			

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
        if ($result->num_rows > 0)
        {
            while ($subject = $result->fetch_assoc())
            {
?>
																																				<tr>
																																					<td>
																																						<?php printf("%s", $subject['SubjectCode']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['SubjectName']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['Course']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['LecUnits']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['LabUnits']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['TotalUnits']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['lecHours']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['labHours']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['TotalHours']); ?>
																																					</td>
																																					
																																					<td>
																																						<?php printf("%s", $subject['NoOfSection']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['lecFaculty']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['labFaculty']); ?>
																																					</td>
																																																																										<td>
																																						<?php printf("%s", $subject['Section']); ?>
																																					</td>
																																																																										<td>
																																						<?php printf("%s", $subject['Days']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['Time']); ?>
																																					</td>
																																					<td>
																																						<?php printf("%s", $subject['Semester']); ?>
																																					</td>
																																					<td><?php printf( "<a href='index.php?action=editSubject&id=%s'><i class='fas fa-edit'></i></a>", $subject['subjectID'] )?></td>
																																					<td><?php printf( "<a class='delete' href='index.php?action=deleteSubject&id=%s'><i class='fas fa-trash'></i></a>", $subject['subjectID'] )?></td>
																																				</tr>
																																				<?php
            }
        }
        else
        { ?>
																																					<tr>
																																						<td colspan="5">No member(s) found...</td>
																																					</tr>
																																					<?php
        } ?>
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
																															function formToggle(ID) {
																																var element = document.getElementById(ID);
																																if(element.style.display === "none") {
																																	element.style.display = "block";
																																} else {
																																	element.style.display = "none";
																																}
																															}
																															</script>
																															<?php
    } ?>
																																<?php if ('addSubject' == $id)
    { ?>
																																	<div class="addSubject">
																																		<div class="main__form">
																																			<div class="main__form--title text-center">Add New Subject</div>
																																			<form action="add.php" method="POST">
																																				<div class="form-row">
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="SubjectCode" placeholder="Subject Code" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="SubjectName" placeholder="Subject Name" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="Course" placeholder="Course" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="LecUnits" placeholder="Lecture Units" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-folder"></i>
																																							<input type="text" name="LabUnits" placeholder="Laboratory Units" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-clock"></i>
																																							<input type="text" name="lecHours" placeholder="Lecture Hours" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-clock"></i>
																																							<input type="text" name="labHours" placeholder="Laboratory Hours" required> </label>
																																					</div>
																															
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-users"></i>
																																							<input type="text" name="NoOfSection" placeholder="Number of Section" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-user"></i>
																																							<input type="text" name="lecFaculty" placeholder="Lecture Faculty" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-user"></i>
																																							<input type="text" name="labFaculty" placeholder="Laboratory Faculty" required> </label>
																																					</div>
																																					
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-user"></i>
																																							<input type="text" name="Section" placeholder="Section" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-calendar-alt"></i>
																																							<input type="text" name="Days" placeholder="Days" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-clock"></i>
																																							<input type="text" name="Time" placeholder="Time" required> </label>
																																					</div>
																																					<div class="col col-6">
																																						<label class="input"> <i id="left" class="fas fa-calendar-alt"></i>
																																							<input type="text" name="Semester" placeholder="Semester" required> </label>
																																					</div>
																																					<input type="hidden" name="action" value="addSubject">
																																					<div class="col col-12">
																																						<input type="submit" value="Submit"> </div>
																																				</div>
																																			</form>
																																		</div>
																																	</div>
																																	<?php
    } ?>
																																		<?php if ('editSubject' == $action)
    {
        $SubjectID = $_REQUEST['id'];
        $selectSubject = "SELECT * FROM subject WHERE subjectID='{$SubjectID}'";
        $result = mysqli_query($connection, $selectSubject);

        $subject = mysqli_fetch_assoc($result); ?>
																																			<div class="addSubject">
																																				<div class="main__form">
																																					<div class="main__form--title text-center">Update Subject</div>
																																					<form action="add.php" method="POST">
																																						<div class="form-row">
																																						<input type="hidden" name="subject" value="<?php echo $SubjectID; ?>">
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="SubjectCode" placeholder="SubjectCode" value="<?php echo $subject['SubjectCode']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="SubjectName" placeholder="Subject Name" value="<?php echo $subject['SubjectName']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="Course" placeholder="Course" value="<?php echo $subject['Course']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="LecUnits" placeholder="Lecture Units" value="<?php echo $subject['LecUnits']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="LabUnits" placeholder="Laboratory Units" value="<?php echo $subject['LabUnits']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="lecHours" placeholder="Lecture Hours" value="<?php echo $subject['lecHours']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="labHours" placeholder="Laboratory Hours" value="<?php echo $subject['labHours']; ?>" required> </label>
																																							</div>
																																							
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="NoOfSection" placeholder="Number of Section" value="<?php echo $subject['NoOfSection']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																							
																																									<label class="input"> <i id="left" class="fas fa-folder"></i>
																																										<input type="text" name="lecFaculty" placeholder="Lecture Faculty" value="<?php echo $subject['lecFaculty']; ?>" required> </label>
																																							</div>
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-folder"></i>
																																									<input type="text" name="labFaculty" placeholder="Laboratory Faculty" value="<?php echo $subject['labFaculty']; ?>" required> </label>
																																							</div>
																																							
																																							
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-user"></i>
																																									<input type="text" name="Section" placeholder="Section" value="<?php echo $subject['Section']; ?>" required> </label>
																																							</div>
																																							
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-calendar-alt"></i>
																																									<input type="text" name="Days" placeholder="Days" value="<?php echo $subject['Days']; ?>" required> </label>
																																							</div>
																																							
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-clock"></i>
																																									<input type="text" name="Time" placeholder="Time" value="<?php echo $subject['Time']; ?>" required> </label>
																																							</div>
																																							
																																							
																																							
																																							<div class="col col-6">
																																								<label class="input"> <i id="left" class="fas fa-calendar-alt"></i>
																																									<input type="text" name="Semester" placeholder="Semester" value="<?php echo $subject['Semester']; ?>" required> </label>
																																							</div>
																																							<input type="hidden" name="action" value="Subject">
																																							
																																							<div class="col col-12">
																																								<input type="submit" value="Update"> </div>
																																						</div>
																																					</form>
																																				</div>
																																			</div>
																																			<?php
    } ?>
					<?php if ('deleteSubject' == $action)
    {
        $subject = $_REQUEST['id'];
        $deleteSubject = "DELETE FROM subject WHERE subjectID ='{$subject}'";
        $result = mysqli_query($connection, $deleteSubject);
        header("location:index.php?id=allSubject");
    } ?>

																														</div>
																														<!-- ---------------------- Subject ------------------------ -->
																														<!-- ---------------------- User Profile ------------------------ -->
																														<?php if ('userProfile' == $id)
    {
        $query = "SELECT * FROM {$sessionRole} WHERE id='$sessionId'";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($result)
?>
																															<div class="userProfile">
																																<div class="main__form myProfile">
																																	<form action="index.php">
																																		<div class="main__form--title myProfile__title text-center">My Profile</div>
																																		<div class="form-row text-center">
																																			<div class="col col-12 text-center pb-3"> <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt=""> </div>
																																			<div class="col col-12">
																																				<h4><b>Name : </b><?php printf("%s", $data['Name']); ?></h4> </div>
																																			<div class="col col-12">
																																				<h4><b>Username : </b><?php printf("%s", $data['Username']); ?></h4> </div>
																																			<input type="hidden" name="id" value="userProfileEdit">
																																			<div class="col col-12">
																																				<input class="updateMyProfile" type="submit" value="Update Profile"> </div>
																																		</div>
																																	</form>
																																</div>
																															</div>
																															<?php
    } ?>
																																<?php if ('userProfileEdit' == $id)
    {
        $query = "SELECT * FROM {$sessionRole} WHERE id='$sessionId'";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($result)

?>
																																	<div class="userProfileEdit">
																																		<div class="main__form">
																																			<div class="main__form--title text-center">Update My Profile</div>
																																			<form enctype="multipart/form-data" action="add.php" method="POST">
																																				<div class="form-row">
																																					<div class="col col-12 text-center pb-3"> <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt=""> <i class="fas fa-pen pimgedit"></i>
																																						<input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar"> </div>
																																					<div class="col col-12">
																																						<?php if (isset($_REQUEST['avatarError']))
        {
            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
        } ?>
																																					</div>
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-user-circle"></i>
																																							<input type="text" name="Name" placeholder="Name" value="<?php echo $data['Name']; ?>" required> </label>
																																					</div>
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-user-circle"></i>
																																							<input type="text" name="Username" placeholder="Username" value="<?php echo $data['Username']; ?>" required> </label>
																																					</div>
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-key"></i>
																																							<input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password" required> <i id="pwd" class="fas fa-eye right"></i> </label>
																																					</div>
																																					<div class="col col-12">
																																						<label class="input"> <i id="left" class="fas fa-key"></i>
																																							<input id="pwdinput2" type="password" name="newPassword" placeholder="New Password" required>
																																							<p>Type Old Password if you don't want to change</p> <i id="pwd2" class="fas fa-eye right"></i> </label>
																																					</div>
																																					<input type="hidden" name="action" value="updateProfile">
																																					<div class="col col-12">
																																						<input type="submit" value="Update"> </div>
																																				</div>
																																			</form>
																																		</div>
																																	</div>
																																	
																																	<?php
    } ?>
																																		<!-- ---------------------- User Profile ------------------------ -->
																												</div>
			</section>
			<!--------------------------------- #Main section -------------------------------->
			<!-- Optional JavaScript -->
			<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
			<script src="assets/js/popper.min.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			<!-- Custom Js -->
			<script src="./assets/js/app.js"></script>
			<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
			<script>
			$(function() {
				$('#tableId').DataTable();
			});
			$('#tableId').dataTable({
				"ordering": false
			});
			$(function() {
				$('#tableId2').DataTable();
			});
			var oTable = $('#tableId2').DataTable({
				"order": [
					[2, "asc"]
				],
				'columnDefs': [{
					"targets": [0, 3, 4],
					"orderable": false
				}]
			});
			</script>
		</body>

		</html>
		<?php
} ?>
			<?php if ('employee' == $sessionRole)
{

    header("location:employee.php");
}

?>
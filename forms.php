<?php
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="files/images/favicon.png" type="image/png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="files/css/style.css">
		<!-- Script -->
		<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src='bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>
		<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
		<title>CITE Online Enlistment</title>
	</head>
	<style>
	#view {
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
	
	#view:hover {
		background-color: #2b3aab;
		color: white;
	}
	
	@media screen {
		#printSection {
			display: none;
		}
	}
	
	@media print {
		body * {
			visibility: hidden;
		}
		#printSection,
		#printSection * {
			visibility: visible;
			font-size: 20px;
		}
		#printSection {
			position: absolute;
			left: 0;
			top: 0;
			font-size: 20px;
		}
	}
	</style>

	<body>
		<header> <a href="index.php" class="logo">CITE | ONE</a>
			<div class="toggle" onclick="toggleMenu();"></div>
			<ul class="menu">
				<li><a href="index.php" onclick="toggleMenu();">Home</a></li>
				<li><a href="forms.php" onclick="toggleMenu();">Approved Forms</a></li>
			</ul>
		</header>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="bg" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(0.7, 0, 0, 0.3)), url('files/images/bg.jpg');
position: relative;
min-height: 100vh;
background-blend-mode: multiply;
  background-size: cover;
  background-position: right;
">
			<div class="cover">
				<div class="main__table" style="background-color: white">
					<table class="table" id="tableId">
						<thead>
							<tr>
								<th scope="col">Student Number</th>
								<th scope="col">Name</th>
								<th scope="col">Approved By</th>
								<th scope="col">View</th>
							</tr>
						</thead>
						<tbody>
							<?php 
           $getApproved = "SELECT approvedforms.formID, approvedforms.ApprovedBy, 
            formrequest.Name, formrequest.StudentNumber
            FROM approvedforms,formrequest
            WHERE approvedforms.formID = formrequest.formID;";
                                $result = mysqli_query($connection,$getApproved);
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['formID'];
                                    $name = $row['Name'];
                                    $ApprovedBy = $row['ApprovedBy'];
                                    $StudentNumber = $row['StudentNumber'];
                                    
                                    
                                    echo "<tr>";
                                    echo "<td>".$StudentNumber."</td>";
                                    echo "<td>".$name."</td>";
                                    echo "<td>".$ApprovedBy."</td>";
                                    
                                    echo "<td><button data-id='".$id."' class='userform' id='view'>View</button></td>";
                                    echo "</tr>";
                                }
        ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- ---------------------- Modal ------------------------ -->
		<div class="modal fade" id="empModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content" style="width: 800px; height: auto; position: absolute; left: 50%; top: 50%; transform: translate(-50%, 0%);">
					<div class="modal-header">
						<h4 class="modal-title">Student Enlistment Form</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div id="printThis" class="modal-body"> </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="Print">Print</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<script type='text/javascript'>
		$(document).ready(function() {
			$('.userform').click(function() {
				var userid = $(this).data('id');
				// AJAX request
				$.ajax({
					url: 'ajaxfile.php',
					type: 'post',
					data: {
						userid: userid
					},
					success: function(response) {
						// Add response in Modal body
						$('.modal-body').html(response);
						// Display Modal
						$('#empModal').modal('show');
					}
				});
			});
		});
		</script>
		<script>
		document.getElementById("Print").onclick = function() {
			printElement(document.getElementById("printThis"));
		};

		function printElement(elem) {
			var domClone = elem.cloneNode(true);
			var $printSection = document.getElementById("printSection");
			if(!$printSection) {
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
		<div class="copyright"> Copyright 2021 © CITE. All Rights Reserved </div>
		<script type="text/javascript">
		window.addEventListener('scroll', function() {
			var header = document.querySelector('header');
			header.classList.toggle('sticky', window.scrollY > 0);
		});

		function toggleMenu() {
			var menutoggle = document.querySelector('.toggle');
			var menu = document.querySelector('.menu');
			menutoggle.classList.toggle('active');
			menu.classList.toggle('active')
		}
		</script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script>
		$(function() {
			$('#tableId').DataTable();
		});
		$('#tableId').dataTable({
			"ordering": false
		});
		</script>
	</body>

	</html>
<?php

include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

$id = $_GET['id'];
$contact = $_GET['contact'];

$select = "select * FROM formrequest WHERE formID =".$id."";
$go = mysqli_query($connection,$select);
while( $result = mysqli_fetch_array($go) )
{
				$class = $result['Class'];
				$course = $result['Course'];
				$yearLevel = $result['YearLevel'];
				$contactNumber = $result['ContactNumber'];
				$address = $result['Address'];
				$birthday = $result['Birthday'];
				$name = $result['Name'];
				$number = $result['StudentNumber'];
				$email = $result['Email'];
				$parent = $result['Parent'];
				$parentcontact = $result['ParentContact'];
				$section = $result['Section'];

}  
$subjectSelect = "SELECT * FROM studentsubject WHERE StudentNumber='".$number."' AND Section='".$section."' ";
						$getSubject = mysqli_query($connection,$subjectSelect) or die( mysqli_error($connection)) ;
						while( $result2 = mysqli_fetch_array($getSubject) )
						{
										$Section = $result2['Section'];
										$number1 = $result2['StudentNumber'];

						}    



$deleteform = "DELETE FROM formrequest WHERE formID='".$id."'";				
				
				if(mysqli_query( $connection, $deleteform)) 
				{

						$deleteform2 = "DELETE FROM studentsubject WHERE Section='".$Section."' AND StudentNumber='".$number1."'   ";				
						
						if(mysqli_query( $connection, $deleteform2)) 
						{
							
							
			
					require_once __DIR__ . '/../vendor/autoload.php';

					$basic  = new \Vonage\Client\Credentials\Basic("3849c4f6", "EeB9Vpk99zXpaVGc");
					$client = new \Vonage\Client($basic);

					$response = $client->sms()->send(
						new \Vonage\SMS\Message\SMS($contact, "CITE ONE", 'Good day! Your enlistment form has been declined. Kindly inquire with your adviser. Thank you!')
					);

					$message = $response->current();

					if ($message->getStatus() == 0) {
						echo "The message was sent successfully\n";
					} else {
						echo "The message failed with status: " . $message->getStatus() . "\n";
					}
							
							
							
							
							
							echo"<script>alert('Student enlistment form has been declined.')</script>";
							echo"<script>window.location='./employee.php?id=form'</script>";
						}

						else
						{
							echo"<script>alert('Declining form failed.')</script>";
							echo"<script>window.location='./employee.php?id=form'</script>";
			
						} 		
					
					
					
					
					
					
					
				}

				else
				{
					echo"<script>alert('Declining form failed.')</script>";
					echo"<script>window.location='./employee.php?id=form'</script>";
    
				}
		
?>

<p>testing <?php echo $id ?></p>
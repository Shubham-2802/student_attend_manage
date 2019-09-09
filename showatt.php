<?php
$id="";
require_once("includes/databaseconnect.php");
require_once("includes/php_script.php");

for ($i=1; $i<=$_POST["reg$i"]; $i++)
{
echo($_POST["reg$i"]);

}	

if(!isset($_SESSION['sid']))
{
	echo $id;
}
	


if(isset($_POST['logout']))
{
	session_unset();
	session_destroy(); 
	header("Location: ../Attendance_Management"); 
}

?>
<html>

<head>
	<title>Student</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="bootstrap/js/jquery.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="includes/java_script.js"></script>
</head>

<body>


	<div class="container" style="padding: 50px;"> 
		<h1 align="center">Registeration Number <font color="red"><?php echo $id;?></font> Logged In </h1>
		<form method="post" style="float:right;">
			<button type="submit" name="logout" value="logout" class="btn btn-info">Logout</button>
		</form><br><br><br><br><br>
		<h3>View Attendance From Courses</h3><br>

		<?php
		$regno = $_SESSION['sid'];
		$q = "SELECT  `course_id` FROM `stud_courses` WHERE regno = '$regno'";
		
		if($result = mysqli_query($connection,$q))
		{

			while($row = mysqli_fetch_assoc($result))
			{
				$cid = $row['course_id'];
				$q1="SELECT  `course_title` FROM `courses` WHERE course_id = '$cid'";
				$result1 = mysqli_query($connection,$q1);
		while($row1 = mysqli_fetch_array($result))
		
				
				{	
				$ct=$row1['course_title'];
				}			
			echo '<div class="panel-group"><div class="panel panel-warning"><div class="panel-heading"><h4 class="panel-title">';
				echo "<a data-toggle='collapse' href='#collapse$cid'>$cid</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ct" ;
				echo "</h4></div><div id='collapse$cid' class='panel-collapse collapse'><div class='panel-body'>";
				$tclass = $tpre = 0;
				$present = array();
				$absent = array();
				$quer = "SELECT * From attendence where course_id = '$cid' ORDER BY `date` DESC;";
				if($result1 = mysqli_query($connection,$quer))
				{
					echo("<table class=table table-striped table-hover table-condensed>");
					echo("<thead>");
					echo"<tr>";
					echo"<th>Date</th>";
					echo"<th>Status</th>";

					echo"</tr>";
					echo"</thead>";
					echo"<tbody>";
					while($row1 = mysqli_fetch_assoc($result1))
					{
						$found = $ispresent = 0;
						$present = explode(",", $row1['present']);
						$absent = explode(",", $row1['absent']);

						if(in_array($regno, $present))
						{
							$tpre ++;
							$tclass ++;
							$found = 1;
							$ispresent = 1;
						}
						elseif(in_array($regno,$absent))
						{
							$tclass ++;
							$found = 1;
						}
						if($found == 1)
						{
							echo("<tr>");
							$d = $row1['date'];
							print_r("<td>".$d."</td>");
							if($ispresent == 1)
								echo("<td><font color='green'><strong>Present</strong></font></td>");
							else
								echo("<td><font color='red'><strong>Absent</strong></font></td></tr>");
							
						}	
					}
					echo"</tbody>";
					echo"</table>";
					echo ("Total Classes:&nbsp".$tclass."<br>");							
					echo ("Classes Preasent:&nbsp&nbsp".$tpre."<br><br><br>");
					if($tclass != 0)
						$centage = ($tpre/$tclass)*100;
					else
						$centage = 0;
					$centage = ceil($centage);
					if($centage > 75){
						echo'<div class="progress">';
						echo"	<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='$centage'";
						echo"aria-valuemin='0' aria-valuemax='100' style='width:$centage%''>";
						echo "$centage'% Attendence";
						echo'</div></div>';
					}
					elseif ($centage > 50) {
						echo'<div class="progress">';
						echo"	<div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='$centage'";
						echo"aria-valuemin='0' aria-valuemax='100' style='width:$centage%''>";
						echo "$centage'% Attendence";
						echo'</div></div>';	
					}
					else
					{
						echo'<div class="progress">';
						echo"<div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='$centage'";
						echo"aria-valuemin='0' aria-valuemax='100' style='width:$centage%''>";
						echo "$centage'% Attendence";
						echo'</div></div>';	
					} 




				}
				echo"</div></div></div></div><br>";
		}
		}
		?>

		<hr><br>
		<?php

		if(isset($_POST['mail']))
		{

			if(!empty($_POST['to']) && !empty($_POST['by'])  && !empty($_POST['message']) )
			{
				$to = $_POST['to'];
				$by = $_POST['by'];			
				$message = $_POST['message'];

				$querr = "INSERT INTO `message`(`message_to`, `message_by`, `message`) VALUES ('$to','$by','$message')";
				if(mysqli_query($connection,$querr))

				{

					print('<div class="alert alert-success" >');
					print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
					print('Message Sent');
					print('</div>');
				}
			}
			else
			{
				print('<div class="alert alert-danger" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('Fill All The Details');
				print('</div>');
			}
		}

		?>

		<form method="post">
			<h3><font color="red">Make Direct Contact</font></h3><br>
			<strong>Send Message To</strong>
			<input type="text" name="to" class="form-control" style = "width: 400px;" placeholder="Enter The ID To Whom You Want To Send The Eamil"><br>


			<input type="hidden" name="by" class="form-control" value = <?php echo($regno); ?> style = "width: 400px;" placeholder="Enter You ID"><br>

			<strong>Message</strong>
			<textarea name="message" class="form-control" placeholder="Enter The Meassage"></textarea><br>

			<button name="mail" value="submit" class="btn btn-info">Send Message</button><br><br><br><br>

		</form>

		<?php


		$qe = "SELECT * FROM message WHERE message_to = '$regno' ORDER BY id DESC";

		if($result = mysqli_query($connection,$qe))
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$m_by = $row['message_by'];
				$mes = $row['message'];
				echo "<h5><strong>Message By:</strong> ".$m_by."</h5>";
				echo "<h5><strong>Message:</strong> ".$mes."</h5>";
				echo "<form method='post'> <button value='$mes' name = 'del' type='submit' class = 'btn btn-danger'>Delete</button></form><hr>";



			}
		}



		?>
	</div>
</body>
</html>

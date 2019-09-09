<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");

if(empty($_SESSION['fid']))
{
	header("Location: ../Attendance_Management");	
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
	<title>Faculty</title>
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
		<h1 align="center">Faculty With The ID <font color="red"><?php echo $_SESSION['fid'];?></font> Logged In </h1>

		<form method="post" style="float: right;">
			<button type="submit" name="logout" value="logout" class="btn btn-info">Logout</button>
		</form><br><br><br><br><br><br>

		<div class="panel-group">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#collapse1">Take Attendance</a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
						<form method="post" action="faculty.php">
							<?php
							
							$fac = $_SESSION['fid'];
							$q = "SELECT * FROM student_teacher WHERE fac_id = '$fac'";
							if($result = mysqli_query($connection,$q))
							{
								echo("<table class=table table-striped table-hover table-condensed>");
								echo("<thead>");
								echo"<tr>";
								echo"<th>Student Name</th>";
								echo"<th>Registration Number</th>";
								echo"<th>Present</th>";
								echo"<th>Absent</th>";
								echo"</tr>";
								echo"</thead>";
								echo"<tbody>";
								$i=1;
								while($row = mysqli_fetch_assoc($result))
								{
									$i++;
									$regid = $row['regno'];

									$q1 = "SELECT stud_name FROM student WHERE regno = '$regid';";
									$result1 = mysqli_query($connection,$q1);
									$row1 = mysqli_fetch_assoc($result1);
									$na = $row1['stud_name'];
									$present = "<input type = 'checkbox' value = '$regid' name = present[]";
									$absent = "<input type = 'checkbox' value = '$regid' name = absent[]";
									echo"<tr>";
									print_r("<td>".$na."</td>");
									print_r("<td>".$regid."</td>");
									print_r("<td>".$present."</td>");
									print_r("<td>".$absent."</td>");
									//print_r("<td><input type=text name=reg$i id=reg$i value=$regid></button></a></td>");
								//	print_r("<td><a href=showatt.php><input type=submit name=re id=re value=view></button></a></td>");
									echo"</tr>";
									

							    }
							
								echo"</tbody>";
								echo"</table>";
								echo "<input type='hidden' name='hidden' value='$fac'>";
								echo "<input type='date' name='date' class='form-control'><br><br>";
							}
							
							?>
							<button type="submit" name="mark" value="submit" class="btn btn-warning">Mark</button>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#collapse2">Edit Attendance</a>
					</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						
						<form method="post">

							<strong>Course Id:</strong>
							<input type="text" name="cid" class="form-control" placeholder="Enter The Course For Which You Want To Change"><br>

							<strong>Student Id:</strong>
							<input type="text" name="sid" class="form-control" placeholder="Enter The Student Id"><br>

							<strong>Date:</strong> 
							<input type="date" name="date" class="form-control" placeholder="The Date For Which You Want To Change"><br>
							<input type="hidden" name="fid" value=<?php echo($fac) ?>>

							<strong>Absent:</strong>
							<input type="radio" name="markk" value="1">

							<strong>Present:</strong>
							<input type="radio" name="markk" value="2"><br><br>

							<button name="upad" value="submit" class="btn btn-danger">Change</button>
						</form>
					</div>
				</div>
			</div>
		</div>

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
			<input type="text" name="to" class="form-control" style = "width: 400px;" placeholder="Enter The ID To Whom You Want To Send The Email"><br>
			
			<input type="hidden" name="by" class="form-control" value = <?php  echo($fac);  ?> style = "width: 400px;" placeholder="Enter Your ID">

			<strong>Message</strong>
			<textarea name="message" class="form-control" placeholder="Enter The Message"></textarea><br>

			<button name="mail" value="submit" class="btn btn-info">Send Message</button><br><br><br><br>

		</form>


		<?php


		$qe = "SELECT * FROM message WHERE message_to = '$fac' ORDER BY id DESC";

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

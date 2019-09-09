<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");
//include("back.css");
if(!isset($_SESSION['aid']))
{
	header("Location: ../Attendance_Management");
}

if(isset($_POST['logout']))
{
	session_unset();
	session_destroy(); 
	header("Location: ../Attendance_Management/admin.php"); 
}
?>

<html>
	<head>
		<title>Attendance</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="bootstrap/js/jquery.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/jquery.js"></script>
		<script src="includes/java_script.js"></script>
		<style>p.thick{font-weight:bold;}</style>
		<style>li.thick{font-weight:bold;}</style>
		<style>strong.thick{font-weight:bold;}</style>
		<style>h1.thick{font-weight:bold;}
		       h1 {
               text-shadow: 3px 2px white;
               }</style>
	</head>

	<body style="padding:5px;">
	    <style>body {background-image: url("attend224.jpg");
		             background-size:100%}</style>
		<h1 align="center"><font color=blue>Admin Panel</font></h1>
		<br><br>
		<form method="post" style="float:right;">
			<button type="submit" name="logout" value="logout" class="btn btn-info">Logout</button>
		</form>

<div class="container" style="border-radius:10px; padding:10px;">

<ul class="nav nav-tabs">

<li class="active thick"><a data-toggle="tab" href="#menu2">Student Sign-Up</a></li>
<li class="thick"><a data-toggle="tab" href="#menu3">Faculty Sign-Up</a></li>
<li class="thick"><a data-toggle="tab" href="#menu4">Student List</a></li>
<div class="tab-content">
<br><br>
<div id="menu2" class="tab-pane fade in active">
<br>
<form method="post">
<strong class="thick">Name</strong><br>
<input type="text" name="name" class="form-control" placeholder="Student Name"><br><br>
<strong class="thick">Registration Number</strong><br>
<input type="text" name="regno" class="form-control" placeholder="Registration Number"><br><br>
<strong class="thick">Password</strong><br>
<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>

<div style="padding:30px;border: 2px solid black;height: 500px;overflow-y: scroll;border-radius: 10px;">	
	<h1 class="thick">Course Selection</h1>				
	<?php

	$q = "SELECT DISTINCT course_id FROM fac_courses;";
	if($result = mysqli_query($connection,$q))
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$c = $row['course_id'];
			echo "<h3><font color=red>".$c."</font></h3>";
			$q1 = "SELECT fac_name,faculty.fac_id FROM faculty INNER JOIN fac_courses ON fac_courses.fac_id=faculty.fac_id WHERE course_id = '$c'";

			if($result1 = mysqli_query($connection,$q1))
			{
				echo("<table class=table table-striped table-hover table-condensed>");
				echo("<thead>");
				echo"<tr>";
				echo"<th>Faculty</th>";
				echo"<th>Please Select</th>";
				echo"</tr>";
				echo"</thead>";
				echo"<tbody>";
				while($row1 = mysqli_fetch_assoc($result1))
				{
					$f = $row1['fac_name'];
					$fi = $row1['fac_id'];
					$ch = "<input type='checkbox' value = '$c,$fi' name = faculty[]>" ;
					echo"<tr>";
					print_r("<td>".$f."</td>");
					print_r("<td>".$ch."</td>");
					echo"</tr>";
				}
				echo"</tbody>";
				echo"</table>";
			}
		}
	}

	?>
</div><br><br>


<input type="submit" name="ssignup" class="btn btn-danger">
</form>
</div>

<div id="menu3" class="tab-pane fade">

<form method="post">
	<br><br>
	<strong>Name</strong><br>
	<input type="text" name="name" class="form-control" placeholder="Faculty Name"><br><br>
	<strong>Faculty Id</strong><br>
	<input type="text" name="facid" class="form-control" placeholder="Faculty Id"><br><br>
	<strong>Password</strong><br>
	<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
	<strong>Select Course To Teach</strong>
	<?php
	$q = "SELECT * from courses";
	
	echo("<select name='subject' class = 'form-control'");
	echo "<option value = '#'>Choose A Subject</option>";

	if($result = mysqli_query($connection,$q))
		while($row = mysqli_fetch_assoc($result))
		{
			$o = $row['course_title'];
			$id = $row['course_id'];
			echo "<option value='$id'>$o</option>";	
		}
		echo("</select><br><br>");
		?>


		<input type="submit" name="facsignup" class="btn btn-danger">
</form>
</div>

<div id="menu4"class="tab-pane fade">

<form  action="" method="">

	  <table class="table table-striped">
	  
	  <tr>
	  <th>#Serial Number</th><th>Student Name</th><th>USN</th>
	  </tr>
	  
	  <?php $result=mysqli_query($connection,"CALL `getStudents`();");
	  $serialnumber=0;
	  $counter=0;
	  while($row=mysqli_fetch_array($result))
	  {
		  $serialnumber++;
		  
	  ?>
	  
	  <tr>
	  <td> <?php echo $serialnumber; ?> </td>
	  <td> <?php echo $row['stud_name']; ?> </td>
	  <input type="hidden" value="<?php echo $row['stud_name'];?>" name="stud_name[]">
	  <td> <?php echo $row['regno']; ?> </td>
	  <input type="hidden" value="<?php echo $row['regno'];?>" name="regno[]">
	  </tr>
	  
	  <?php
	  $counter++;
	  }
	  ?>
		  
	  
	  </table>
</form>
</div>
				</div>
		</div>
	</body>
</html>
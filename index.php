<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");
//include("back.css");
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
			<style>li.thick{font-weight:bold;}</style>
			<style>h1.thick{font-weight:bold;}</style>
			<style>
				  p.thick{font-weight:bold;}
				  h1 {text-shadow: 3px 2px white;}
			</style>
	</head>

	<body style="padding:5px;">
	<style>body {background-image: url("attend3.jpg");}</style>
	
		<h1 align="center" class="thick"><font color=red>Attendance Management System</font></h1>

		<div class="container" style="border-radius:10px; padding:10px;">

			<ul class="nav nav-tabs">
					<li class="active thick"><a data-toggle="tab" href="#menu1">About</a></li>
					
					<li class="thick"><a data-toggle="tab" href="#menu4">Student Login</a></li>
					<li class="thick"><a data-toggle="tab" href="#menu5">Faculty Login</a></li>
			</ul>

			<div class="tab-content">
				<br>
					<div  id="menu1"  class="tab-pane fade in active" style="padding:20px;border:2px solid black;border-radius:10px;" >
					
					   <div>
						    <p>Student Attendance Management System module for schools and colleges maintains a quick and accurate recording of student’s attendance. This module is used to identify irregularities in the academic interests of the students. The same can be used to assess the student and give individual attention to the causes of absences. This module also helps imposing fines for absences/late comings. You can create complete attendance reports and summary of the student. Based on the presence % students can be allowed to sit in exams. This module is developed in the school management software so that attendance can be easily monitored and track by management and parents.</p><p>This module bridges effective communication between students, teachers, and parents by sending notification about attendance via Email or SMS. Marking of attendance for each student for each class sometimes sounds boring task being all you have to do is paperwork which can consume a lot of time, so according to management need, Student Attendance module has introduced in Advanta Rapid ERP- School Management software which is easy to perform a task and it saves a lot of time. In this, numerous reports related to student attendance can be generated within a single click.</p><br>
						    <p><h3>Benefits of a good Student Attendance Management System Software</h3></p>
							<p>To record or marking of attendance for each and every student is not an easy task and it consumes a lot of time due to which no accuracy of data is maintained. Following are 5 major benefits of student attendance:
							<ul>
							<li>Manual marking of attendance usually takes time, so with this module in school management software that will be overtaken and teachers need not put extra effort to mark attendance.</li>
							<li>Attendance records are kept safe and can be checked easily whenever required.</li>
							<li>This module saves a lot of time and results in accuracy, you just need to mark attendance, rest all the reports are automatically generated.</li>
							<li>The major advantage of this software is that it is very flexible and can be adopted by small and large schools at reasonable pricing.</li>
							<li>This module provides smooth working of schools/or institution and instant alerts can be sent to parents/ students related to the shortage of attendance, monthly attendance reports, etc.</li>
							</ul>
							</p>
					   </div>
					</div>
					
                    
					<div id="menu4" class="tab-pane fade" >
						<form method="post">
							<br><br>
							<strong>Registration No.</strong><br>
							<input type="text" name="reg" class="form-control" placeholder="Registration Number" required><br><br>
							<strong>Password</strong><br>
							<input type="password" name="pass" class="form-control" placeholder="Password" required><br><br>
							<input type="submit" name="slogin" class="btn btn-danger">
						</form>
					</div>

					<div id="menu5" class="tab-pane fade">
						<form method="post">
							<br><br>
							<strong>Faculty Id</strong><br>
							<input type="text" name="reg" class="form-control" placeholder="Faculty Id"><br><br>
							<strong>Password</strong><br>
							<input type="password" name="pass" class="form-control" placeholder="Password"><br><br>
							<input type="submit" name="flogin" class="btn btn-danger">
						</form>
					</div>		
		    </div>
		</div>
	</body>
</html>
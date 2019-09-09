$q = "SELECT  `course_id` FROM `stud_courses` WHERE regno = '$regno'";
		
		if($result = mysqli_query($connection,$q))
		{

			while($row = mysqli_fetch_assoc($result))
			{
				$cid = $row['course_id'];
				$q1="SELECT  `course_title` FROM `courses` WHERE course_id = '$cid'";
				$result1 = mysqli_query($connection,$q1);
		
		
		
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
				}
			}
		}
		
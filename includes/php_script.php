<?php
require("includes/databaseconnect.php");
if(!isset($_SESSION['sid']) && !isset($_SESSION['fid']) && !isset($_SESSION['aid']))
	session_start();


if(isset($_POST['del']))
{
	
	$v = $_POST['del'];

	$quu = "DELETE FROM `message` WHERE message = '$v'";
	if(mysqli_query($connection,$quu))
	{
		echo("<script>");
		echo("alert('Message Deleted')");
		echo("</script>");
	}

}

if(isset($_POST['upad']))
{

	if(isset($_POST['cid']) && isset($_POST['sid']) && isset($_POST['date']) && isset($_POST['markk']))
	{

		$c = $_POST['cid'];
		$s = $_POST['sid'];
		$d = $_POST['date'];
		$m = $_POST['markk'];
		$f = $_POST['fid'];


		$pop = "SELECT `course_id`, `present`, `fac_id`, `absent`, `date` FROM `attendence` WHERE `fac_id` = '$f' AND `date` = '$d'";
		$resp = mysqli_query($connection,$pop);
		$rrooww = mysqli_fetch_assoc($resp);
		$cc = $rrooww['course_id'];
		$pp = $rrooww['present'];
		$ffcc = $rrooww['fac_id'];
		$aa = $rrooww['absent'];
		$dd = $rrooww['date'];



		if($m == '1')
		{
			$aa = $aa."a,".$s; 
			$array = array();

			$array = explode(",", $pp);

			for($i = 0;$i< count($array);$i++)
			{
				if($array[$i] == $s)
				{
					$array[$i] = " ";
				}
			}	

			$pp = implode(",", $array);

		}

		else
		{
			$pp = $pp.",".$s; 

			$array = array();

			$array = explode(",", $aa);

			for($i = 0;$i< count($array);$i++)
			{
				if($array[$i] == $s)
				{
					$array[$i] = " ";
				}
			}	

			$aa = implode(",", $array);


			
		}


		$qp = "UPDATE `attendence` SET `present`='$pp',`absent`='$aa' WHERE `fac_id`='$f' AND `date` = '$dd' " ;

		if(mysqli_query($connection,$qp))
		{
			echo("<script>");
			echo("alert('update Succefull')");
			echo("</script>");
		}

	} 



}





if(isset($_POST['facsignup']))
{
	if(!empty($_POST['name']) && !empty($_POST['facid']) && !empty($_POST['pass']) && !empty($_POST['subject']))
	{
		$n = $_POST['name'];
		$f = $_POST['facid'];
		$p = $_POST['pass'];
		$s = $_POST['subject'];

		$q1 = "INSERT INTO `faculty`(`fac_name`, `fac_id`, `password`) VALUES ('$n','$f','$p');";
		$q2 = "INSERT INTO `fac_courses`(`course_id`, `fac_id`) VALUES ('$s','$f');";

		if(mysqli_query($connection,$q1) && mysqli_query($connection,$q2))
		{
			
			$_SESSION['fid'] = $f;
			$_SESSION['name'] = $n;
			$_SESSION['subject'] = $s;
			header("Location: index2.php");
		}
		else
		{
			print('<div class="alert alert-danger" >');
			print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
			print('Error Ocurred');
			print('</div>');	
		}
	}
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Fill All The Details');
		print('</div>');
	}

}

if(isset($_POST['ssignup']))
{
	$check = 1;

	if(!empty($_POST['name']) && !empty($_POST['regno']) && !empty($_POST['pass']))
	{
		$arr = array();
		$array = array();
		$n = $_POST['name'];
		$r = $_POST['regno'];
		$p = $_POST['pass'];
		$arr = $_POST['faculty'];
		$q = "INSERT INTO `student`(`stud_name`, `regno`, `password`) VALUES ('$n','$r','$p')";
		if(!mysqli_query($connection,$q))
			$check = 0;
		
		$len = count($arr);
		for($i = 0;$i<$len;$i++)
		{
			$array = explode(",", $arr[$i]);
			$q1 = "INSERT INTO `student_teacher`(`fac_id`, `regno`) VALUES ('$array[1]','$r')";
			$q2 = "INSERT INTO `stud_courses`(`regno`, `course_id`) VALUES ('$r','$array[0]')";
			if(!mysqli_query($connection,$q1) || !mysqli_query($connection,$q2))
				$check = 0;
		}
		if($check == 1)
		{
			
			$_SESSION['sid'] = $r;
			$_SESSION['name'] = $n;
			header("Location: index2.php");
		}
		else
		{
			print('<div class="alert alert-danger" >');
			print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
			print('<strong>Error Occured</strong>');
			print('</div>');
		}
	}
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Fill All The Details');
		print('</div>');
	}
}

if(isset($_POST['slogin']))
{
	if(!empty($_POST['reg']) && !empty($_POST['pass']))
	{
		$reg = $_POST['reg'];
		$pass = $_POST['pass'];
		$found = 0;


		$q = "SELECT * from student;";
		if($result = mysqli_query($connection,$q))
		{
			while($row = mysqli_fetch_assoc($result))
			{
				if($row['regno'] == $reg && $row['password'] == $pass)
				{
					$found = 1;
					break;
				}
			}
			if($found == 1)
			{	
				
				$_SESSION['sid'] = $reg;
				header("Location: student.php");			
			}
			else
			{
				print('<div class="alert alert-danger" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('Invalid Email Or Password');
				print('</div>');
			}

		}
	}
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Fill All The Details');
		print('</div>');
	}
}


if(isset($_POST['flogin']))
{
	if(!empty($_POST['reg']) && !empty($_POST['pass']))
	{
		$reg = $_POST['reg'];
		$pass = $_POST['pass'];
		$found = 0;


		$q = "SELECT * from faculty;";
		if($result = mysqli_query($connection,$q))
		{
			while($row = mysqli_fetch_assoc($result))
			{
				if($row['fac_id'] == $reg && $row['password'] == $pass)
				{
					$found = 1;
					break;
				}
			}
			if($found == 1)
			{
				
				$_SESSION['fid'] = $reg;
				header("Location: faculty.php");			
			}
			else
			{
				print('<div class="alert alert-danger" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('Invalid Email Or Password');
				print('</div>');
			}

		}
	}
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Fill All The Details');
		print('</div>');
	}
}

if(isset($_POST['adminlogin']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$found = 0;


		$q = "SELECT * from admin;";
		if($result = mysqli_query($connection,$q))
		{
			while($row = mysqli_fetch_assoc($result))
			{
				if($row['username'] == $user && $row['password'] == $pass)
				{
					$found = 1;
					break;
				}
			}
			if($found == 1)
			{	
				
				$_SESSION['aid'] = $user;
				header("Location: index2.php");			
			}
			else
			{
				print('<div class="alert alert-danger" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('Invalid username Or Password');
				print('</div>');
			}

		}
	}
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Fill All The Details');
		print('</div>');
	}
}

if(isset($_POST['mark']))
{
	
	$r = array();
	if(isset($_POST['present']))
		$pre = implode(",", $_POST['present']);
	else
		$pre = null;
	if(isset($_POST['absent']))
		$ab = implode(",", $_POST['absent']);
	else
		$ab = null;
	$facid = $_SESSION['fid'];

	$query1 = "SELECT * FROM fac_courses WHERE fac_id = '$facid';";

	if($result = mysqli_query($connection,$query1))
		$r = mysqli_fetch_assoc($result);
	else
		echo "error";

	$c = $r['course_id'];
	date_default_timezone_set('Asia/Calcutta'); 
	$date = $_POST['date'];
	
	$q = "INSERT INTO `attendence`(`course_id`, `present`, `fac_id`, `absent`, `date`) VALUES ('$c','$pre','$facid','$ab','$date')";

	if(mysqli_query($connection,$q))
	{
		print('<div class="alert alert-success" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Attendence Taken Succefully');
		print('</div>');
	}

}

?>


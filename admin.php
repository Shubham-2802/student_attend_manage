<?php
require("includes/databaseconnect.php");
require("includes/php_script.php");

?>
<html>
<head>
	  <title> Admin login page</title>
	  <link rel="stylesheet" type="text/css" href="style2.css">
  
</head>
<body>
 <div class="form-container">
	   <div class="user-img"></div>
	        <form method="post">
			   <ul class="list">
				   <li><h2>Admin Login</h2></li>
				   <li><input type="text" name="username" placeholder="UserName" required></li>
				   <li><input type="password" name="password" placeholder="Password" required></li>
				   <li><input type="submit" name="adminlogin" value="Submit"></li>
			   </ul>
			 <form>  
	  </div> 
</body>
</html>
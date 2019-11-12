<?php

/*
	print('<div class="alert alert-danger" >');
	print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
	print('Password Did Not Match');
	print('</div>');
*/


	$dbhost= "localhost";
	$dbuser= "root";
	$dbpass="";
	$dbname="dbms";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno())
	{
		die("CONNECTION FAILED" .
			mysqli_connect_error().
			"(" . mysqli_connect_errno() . ")"
			);
	}

	?>
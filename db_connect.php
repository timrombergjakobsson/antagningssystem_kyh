<?php>

	function db_connect(){
	
	$dbhost = 'reldb4.ad09.agiledev.se';
	$dbuser = 'reldb4';
	$dbpass = 'dbPass04';
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$conn) {
	    die('Could not connect: ' . mysql_error());
	}else{
	echo 'Connected successfully';
	}
	mysql_close($conn);
	
	}
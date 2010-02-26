<?php

function db_connect(){
	
			$dbhost = "localhost";
			$dbuser = "reldb4";
			$dbpass = "dbPass04";
			$dbname = "ad09_reldb4";

			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
			$db_selected = mysql_select_db ($dbname, $conn);
			if (!$conn || !$db_selected) {
	    		die('Could not connect: ' . mysql_error());
				
			}
			return $conn;
		}
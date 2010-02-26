<?php 
		include_once("get_education_id.php");
		include_once("get_education_start_id.php");
		include_once("get_applicant_id.php");
?>
<<??>?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Test</title>
		<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>
	</head>
	<body>
	<h1></h1>
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
				
			}else{
				echo 'Connected successfully';
				
			}
			return $conn;
		}
		
		/* Education_start_id */
		echo "Education_start_id med education id 1 och admission id 66 \n förväntat resultat 3 \n";
		echo get_education_start_id(1,66);
		echo "\n";
		
		echo "Education_start_id med education id 1 och admission id 55\nförväntat resultat NULL\n";
		echo get_education_start_id(1,55);
		echo "\n";
		
		echo "Education_start_id med education id 2 och admission id 66\nförväntat resultat NULL\n";
		echo get_education_start_id(2,66);
		echo "\n";
		
		/* Applicant_id */
		echo "Applicant_id med personal_number '5566677'\nförväntat resultat 2\n";
		echo get_applicant_id('5566677');
		echo "\n";
		
		echo "Applicant_id med personal_number '4488330977'\nförväntat resultat 1\n";
		echo get_applicant_id('4488330977');
		echo "\n";
		
		echo "Applicant_id med personal_number ''\nförväntat resultat NULL\n";
		echo get_applicant_id('');
		echo "\n";
		
		echo "Applicant_id med personal_number '\' OR 1;DROP TABLE Applicant_id'\n"; 
		echo "förväntat resultat NULL (och tabellen kvar)\n";
		echo get_applicant_id('\' OR 1;DROP TABLE Applicant_id');
		echo "\n";
		
		/* Education_id */
		echo "Education_id med stad 'Stockholm' och utbildning 'Agile Developer'\nförväntat resultat 1\n";
		echo get_education_id('Agile Developer','Stockholm');
		echo "\n";
		
		echo "Education_id med stad 'Stockholm  ' och utbildning 'Agile Developer'\nförväntat resultat NULL\n";
		echo get_education_id('Agile Developer','Stockholm   ');
		echo "\n";
		
		echo "Education_id med stad 'Stockholm' och utbildning 'agile developer'\nförväntat resultat NULL\n";
		echo get_education_id('agile developer','Stockholm');
		echo "\n";
	?>
	</body>
</html>

<?php 
		include_once("get_education_id.php");
		include_once("get_education_start_id.php");
		include_once("get_applicant_id.php");
		include_once("store_admission_details.php");
		include_once("handle_mysql_query.php");
		include_once("get_admission_id.php");
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
		
		$conn = db_connect();

		/* get_admission_id */
		$input_adm = Array('year' => '1900','semester' => 'QT');
		echo "Using the input '1900','QT' <br \>";
		echo get_admission_id($input_adm,$conn);
		echo "<br \>";

		/* get_admission_id */
		$input_adm = Array('year' => 2010,'semester' => 'HT');
		echo "Using the input '2010','VT' <br \>";
		echo get_admission_id($input_adm,$conn);
		echo "<br \>";		

		/* store_admission_details */
		$input = Array('last_application_date' => '2010-08-23',
						'last_completion_date' => '2011-08-23',
						'year' => 2010,
						'semester' => 'HT');
		echo "Using the input '2010-08-23,2011-08-23,2010,VT' <br \>";
		echo store_admission_details($input,$conn);
		echo "<br \>";
		echo handle_mysql_query("SELECT * FROM `admission`",$conn);		

		/* Education_start_id */
		echo "Education_start_id med education id 1 och admission id 66 <br \> förväntat resultat 3 <br \>";
		echo get_education_start_id(1,66,$conn);
		echo "<br \>";
		
		echo "Education_start_id med education id 1 och admission id 55<br \>förväntat resultat NULL<br \>";
		echo get_education_start_id(1,55,$conn);
		echo "<br \>";
		
		echo "Education_start_id med education id 2 och admission id 66<br \>förväntat resultat NULL<br \>";
		echo get_education_start_id(2,66,$conn);
		echo "<br \>";
		
		/* Applicant_id */
		echo "Applicant_id med personal_number '5566677'<br \>förväntat resultat 2<br \>";
		echo get_applicant_id('5566677',$conn);
		echo "<br \>";
		
		echo "Applicant_id med personal_number '4488330977'<br \>förväntat resultat 1<br \>";
		echo get_applicant_id('4488330977',$conn);
		echo "<br \>";
		
		echo "Applicant_id med personal_number ''<br \>förväntat resultat NULL<br \>";
		echo get_applicant_id('',$conn);
		echo "<br \>";
		
		echo "Applicant_id med personal_number '\' OR 1;DROP TABLE Applicant_id'<br \>"; 
		echo "förväntat resultat NULL (och tabellen kvar)<br \>";
		echo get_applicant_id('\' OR 1;DROP TABLE Applicant_id',$conn);
		echo "<br \>";
		
		/* Education_id */
		echo "Education_id med stad 'Stockholm' och utbildning 'Agile Developer'<br \>förväntat resultat 1<br \>";
		echo get_education_id('Agile Developer','Stockholm',$conn);
		echo "<br \>";
		
		echo "Education_id med stad 'Stockholm  ' och utbildning 'Agile Developer'<br \>förväntat resultat NULL<br \>";
		echo get_education_id('Agile Developer','Stockholm   ',$conn);
		echo "<br \>";
		
		echo "Education_id med stad 'Stockholm' och utbildning 'agile developer'<br \>förväntat resultat NULL<br \>";
		echo get_education_id('agile developer','Stockholm',$conn);
		echo "<br \>";
	?>
	</body>
</html>

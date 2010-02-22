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
		//	echo 'Connected successfully';

		}
		return $conn;
	}

    function get_education_id($name, $city) {
		$query = "SELECT id 
					FROM education 
					WHERE name =  '$name'
					AND city =  '$city'";
		
		$answer = mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}
	
	/* Funktionens syfte är att lagra en intresseanmälan till ett intag. 
	 * $input skall vara en array med nycklarna 'personal_number', 'admission_id', 'arrival_date'. 
	 * Funktionen returnerar en boolean där true innebär att intresseanmälan gick att lagra.
	*/
	function store_admission_occasion($input) {
		
		$query1 = "INSERT INTO admission_occasion (
					id,
					applicant_personal_number,
					admission_id,
					arrival_date,
					registration_date
					)
				VALUES (
					NULL,
					'{$input['personal_number']}', 
					{$input['admission_id']},
					{$input['arrival_date']},
					CURDATE()
				)";

		$answer = mysql_query($query1, db_connect());
		return $answer;

	}
	
	function get_admission_occasion_id ($input) {
		
		$query = 	"SELECT id 
					FROM admission_occasion
					WHERE applicant_personal_number = '{$input['personal_number']}'
					AND admission_id = '{$input['admission_id']}'";
			
		$answer = mysql_query($query, db_connect()); 
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
				
		
	}
	
	function store_application($application_input, $admission_occasion_input) {	
		/* Istället för att tvinga användaren skriva in education_start_id, låter vi funktionen ta reda på den åt oss.  */

		$query2 = "INSERT INTO application (
					status,
					basic_eligibility,
					priority,
					admission_occasion_id,
					admission_occasion_applicant_personal_number,
					education_start_id,
					education_start_education_id,
					education_start_admission_id
					)
				VALUES (
					'under process',
					{$application_input['basic_eligibility']},
					{$application_input['priority']},
					{LAST_INSERT_ID()},
					{$admission_occasion_input['personal_number']},
					{$application_input['education_start_id']},
					{$application_input['education_id']},
					{$admission_occasion_input['admission_id']},
				)";



		$answer = mysql_query($query2, db_connect());
	    return $answer;
	}
	
    function store_form_entry () {
    
	
        $chosen_educations = array ( 'education_1' => array (
	 														'priority' => 1, 'education' => $_POST['education_1']));
        
        if ($_POST['education_2'] != "Ingen") {
    
            $chosen_educations['education_2'] = array (
														'priority' => 2, 'education' => $_POST['education_2']);
        
        }
        
        if ($_POST['education_3'] != "Ingen") {
        
            $chosen_educations['education_3'] = array (
														'priority' => 3, 'education' => $_POST['education_3']);
            
        }

		$admission_occasion_info['admission_id'] = $_POST['admission_id'];
		$admission_occasion_info['personal_number'] = $_POST['personal_number'];
		$admission_occasion_info['arrival_date'] = $_POST['arrival_date'];
		
		store_admission_occasion ($admission_occasion_info);
		
		$exploded_educations;
		$i = 0;
		foreach($chosen_educations as $looped_education) {
			list($name, $city) = explode("," , $looped_education['education']);
			$exploded_educations[$i]['education_name'] = $name;
			$exploded_educations[$i]['education_city'] = $city;
			$exploded_educations[$i]['education_id'] = get_education_id($name, $city);
			$exploded_educations[$i]['admission_occasion_id'] = get_admission_occasion_id($admission_occasion_info);
			$exploded_educations[$i]['priority'] = $looped_education['priority'];
	
			$i++;
		}
		
		
		foreach ($exploded_educations as $application_to_store) {
			store_application($application_to_store, $admission_occasion_info);
		}
		
		
		
	}
	
	if ($_POST['submit'] = "spara") {
		
		store_form_entry();
	
		
	}
?>
	
	<<??>?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
		"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Ans&ouml;kan</title>
		<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>

	</head>

	<body>

		<h1></h1>
		<div id="Ans&ouml;kaninformation">




		<form action="" method="post">

			<fieldset>
			<legend>Ans&ouml;kan</legend>

				<label for="arrival_date">Ans&ouml;kan ankom</label>
				<input type ="text" id="arrival_date" name="arrival_date" />

				<input type="hidden" id="admission_id" name="admission_id" value="2"/>
				<input type="hidden" id="personal_number" name="personal_number" value="020202-0202"/>
				
				<label for="education_1">Utbildning 1:a prio</label>
				<select name="education_1" id="education_1">
					<option>Agile Developer, Stockholm</option>
					<option>Agile Developer, G&ouml;teborg</option>
					<option>Energy Consultant, Stockholm</option>
					<option>Energy Consultant, Malm&ouml;</option>
					<option>IT Management, Stockholm</option>

				</select>

				<label for="education_2">Utbildning 2:a prio</label>
				<select name="education_2" id="education_2">
					<option>Ingen</option>
					<option>Agile Developer, Stockholm</option>
					<option>Agile Developer, G&ouml;teborg</option>
					<option>Energy Consultant, Stockholm</option>
					<option>Energy Consultant, Malm&ouml;</option>
					<option>IT Management, Stockholm</option>

				</select>

				<label for="education_3">Utbildning 3:e prio</label>
				<select name="education_3" id="education_3">
					<option>Ingen</option>
					<option>Agile Developer, Stockholm</option>
					<option>Agile Developer, G&ouml;teborg</option>
					<option>Energy Consultant, Stockholm</option>
					<option>Energy Consultant, Malm&ouml;</option>
					<option>IT Management, Stockholm</option>

				</select>

				<label for="basic_eligibility">Grundl&auml;ggande beh&ouml;righet</label>
				<select name="basic_eligibility" id="basic_eligibility">
					<option>Ja</option>
					<option>Nej</option>
					<option>Dispens</option>
				</select>

				<input type="submit" name="submit" value="spara" />


		</fieldset>	
		</form>
		</div>
	</body>
	</html>
	

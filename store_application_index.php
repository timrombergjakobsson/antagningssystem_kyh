<?php
	//alla includes inkluderar filer i dokumentet.
	include('./functions/handle_mysql_query.php');
	
	include('./functions/db_connect.php');
	
	include('./functions/get_admission_id.php');
	include('./functions/get_education_id.php');
	include('./functions/get_education_start_id.php');
	include('./functions/get_application_occasion_id.php');

	include('./functions/get_admissions.php');
	include('./functions/get_educations.php');
		
	include('./functions/explode_chosen_educations.php');
	
	include('./functions/save_application.php');
	include('./functions/store_application_occasion.php');
	include('./functions/store_applicant.php');
	
			
	//sparar en connection till databasen i $conn som kan användas i vilken funktion som helst.
	$conn = db_connect();
	
	//if-sats som kollar om formuläret har submittats
	if (isset($_POST['submit_personal_number'])) {
		
		include('./forms/applicant_info_form.php');

	} else if(isset($_POST['submit_applicant'])) {
	
		store_applicant($_POST, $conn);
		include('./forms/application_info_form.php');
		
	} else if (isset($_POST['submit_application'])) {
		
		$personal_number = $_POST['personal_number'];
		$basic_eligibility = $_POST['basic_eligibility'];
		$arrival_date = $_POST['arrival_date'];
		$admission_id = $_POST['admission_id'];
		
		store_application_occasion($_POST['arrival_date'], $personal_number, $admission_id, $conn);
		$application_occasion_id = get_application_occasion_id ($personal_number, $admission_id, $conn);
			
		$education_ids;
		$i = 0;
		foreach ($_POST['education'] as $education_id) {
			if($education_id != 0) {
				$education_ids[$i]['id'] = $education_id;
				$education_ids[$i]['priority'] = $i + 1;
			}
			$i++;
		} 
		
	
		
		/*
		$exploded_educations = explode_chosen_educations();
                                                    
		$education_ids;
		$i = 0;
		foreach ($exploded_educations as $e_e) {

			$name = $e_e['education_name'];
			$city = $e_e['education_city'];
			$priority = $e_e['priority'];
			$id = get_education_id($name, $city, $conn);
			
			$education_ids[$i]['id'] = $id;
			$education_ids[$i]['priority'] = $priority;
			$i++;
		}
		*/

		$education_starts;
		$i=0;
		foreach ($education_ids as $e_i) {
			
			$id = get_education_start_id($e_i['id'], $admission_id, $conn);
			
			$education_starts[$i]['id'] = $id;
			$education_starts[$i]['priority'] = $e_i['priority'];
			$i++;
		}
		
		foreach ($education_starts as $e_s) {
		
			save_application($e_s, $basic_eligibility, $application_occasion_id, $conn);
			
		}
		
		echo "Ans&ouml;kan sparad";
		echo "<a href='index.html'>Till startsida</a>";
	
	} else {
		
		include('./forms/personal_number_form.php');
	
	}
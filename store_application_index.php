<?php
	//alla includes inkluderar filer i dokumentet.
	include('handle_mysql_query.php');
	
	include('db_connect.php');
	
	include('get_admission_id.php');

	include('store_application_occasion.php');
	
	include('get_education_id.php');
	
	include('get_education_start_id.php');
	
	include('explode_chosen_educations.php');
	
	include('get_application_occasion_id.php');
	
	include('save_application.php');
	
	include ('get_educations.php');
	
	include('application_info_form.php');
	

	
	//sparar en connection till databasen i $conn som kan användas i vilken funktion som helst.
	$conn = db_connect();
	
	//dummy-personnummer som finns i databasen.
	$personal_number = "448833-0977";
	
	//if-sats som kollar om formuläret har submittats
	if (isset($_POST['submit_application'])) {
		
		$basic_eligibility = $_POST['basic_eligibility'];
		$arrival_date = $_POST['arrival_date'];
		
		$admission_id = get_admission_id($conn);
		
		store_application_occasion($_POST['arrival_date'], $personal_number, $admission_id, $conn);
		$application_occasion_id = get_application_occasion_id ($personal_number, $admission_id, $conn);
		
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
	
	} else {
	
		echo "Fyll i ans&ouml;kan";
	
	}
	
	
	
	
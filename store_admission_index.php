<?php
	//alla includes inkluderar filer i dokumentet.
	include('handle_mysql_query.php');
	
	include('db_connect.php');
	
	include('admission_info_form.php');
	
	include('get_admission_id.php');
	
	include('store_education_start.php');
	
	include('store_admission.php');


	//sparar en connection till databasen i $conn som kan användas i vilken funktion som helst.
	$conn = db_connect();
	
	//if-sats som kollar om formuläret har submittats
	if (isset($_POST['submit_admission'])) {
		
		$admission_input['last_application_date'] = $_POST['last_application_date'];
		$admission_input['last_completion_date'] 	= $_POST['last_completion_date'];
		$admission_input['year'] 									= $_POST['year'];
		$admission_input['semester'] 							= $_POST['semester'];
		
		store_admission($admission_input,$conn);

		$admission_id = get_admission_id($admission_input,$conn);
		$education_start_input = $_POST['education'];
		store_education_start($education_start_input, $admission_id, $conn);
	}
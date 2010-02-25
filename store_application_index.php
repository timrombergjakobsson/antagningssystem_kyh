<?php

	
	echo "This is the store_application_index";
	
	//dummy-personnummer som finns i databasen.
	$personal_number = "5566677"; 
	
	//alla includes inkluderar filer i dokumentet.
	include('handle_mysql_query.php');
	
	include('db_connect.php');
	
	//sparar en connection till databasen i $conn som kan användas i vilken funktion som helst.
	$conn = db_connect();
	
	include('get_admission_id.php');

	include('store_application_occasion.php');
	
	include('get_education_id.php');
	
	include('get_education_start_id.php');
	
	include('application_info_form.php');
	
	include('explode_chosen_educations.php');
	
	//if-sats som kollar om formuläret har submittats
	if (isset($_POST['submit'])) {
	
		echo "sparat";
	
	} else {
	
		echo "fyll i ansökan";
	
	}
	

	
	
	
	
	
	
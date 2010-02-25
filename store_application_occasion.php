<?php


	//funktionen sparar en application_occasion med arrival_date, applicant_personal_number och admission_id som skickas in som parametrar. Returnerar felmeddelande om det inte lyckas, eller ett 
	function store_application_occasion($arrival_date, $personal_number, $admission_id, $conn) {
	
		$query = 	"INSERT INTO application_occasion 
						(id, arrival_date, applicant_personal_number, 
						registration_date, admission_id ) 
					VALUES 
						(null, '$arrival_date', '$personal_number', CURDATE(), '$admission_id')";
						
		$result = handle_mysql_query($query, $conn);
		
		if ($result) {
			
			return "Successfully stored application occasion";
			
		}
			
	}
						
		
		
	








?>
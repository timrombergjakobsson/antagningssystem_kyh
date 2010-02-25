<?php
	
	explode_store_application_details () {
    
	
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
?>
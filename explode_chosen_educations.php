<?php
	
	function explode_store_application_details () {
    
	
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
		
		$exploded_educations;
		$i = 0;
		foreach($chosen_educations as $looped_education) {
			list($name, $city) = explode("," , $looped_education['education']);
			$exploded_educations[$i]['education_name'] = $name;
			$exploded_educations[$i]['education_city'] = $city;
			$exploded_educations[$i]['priority'] = $looped_education['priority'];
	
			$i++;
		}
		
		return $exploded_educations;
		
		
	}
?>
<?php

	function store_education_start($education_ids, $admission_id, $conn) {
		if(isset($education_ids)) { 
			
			$query = "INSERT IGNORE INTO `education_start`
			(id, education_id, admission_id)
			VALUES ";
		
			foreach($education_ids as $education_id) {
				$query = $query . "(NULL, '$education_id', '$admission_id'),";
			}
	
			$query = substr_replace($query, ' ' , -1);
			$result = handle_mysql_query ($query, $conn);
			
		}
		return false;
	}



?>
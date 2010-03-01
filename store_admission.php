<?php

	function store_admission ($input) {
		
		 $query = "INSERT INTO admission
		`last_application_date` = '{$input["last_application_date"]}',
		`last_completion_date` = '{$input["last_completion_date"]}',
		`year` = '{$input["year"]}',
		`semester` = '{$input["semester"]}'";

		$answer = handle_mysql_query($query);
		    return $answer;
		}
	}


	





?>
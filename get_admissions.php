<?php


	//Hämtar ut id, termin och år för alla intag. Syftet är att skriva ut dem i personnummer/intagsformuläret.
	function get_admissions($conn) {
		
		$query = 	"SELECT id, semester, year
					FROM admission
					SORT BY id";
					
		$answer = handle_mysql_query($query, $conn);
		$result;
		$i = 0;
		while ($row = mysql_fetch_assoc($answer)) {
		
			$result[$i] = $row;
			$i++;
			
		}
		return $result;
	}
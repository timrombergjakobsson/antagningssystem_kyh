<?php


	//H�mtar ut id, termin och �r f�r alla intag. Syftet �r att skriva ut dem i personnummer/intagsformul�ret.
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
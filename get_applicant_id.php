 <?php
 /* H�mtar ut det id som tillh�r en viss ans�kande, genom leta upp den ans�kande p� personnumret i databasen.
  * personal_number �r den ans�kandes personnummer. Den �r unik, s� den g�r att anv�nda f�r att f� tag p� id:et.
  * Funktionen returnerar id:et ifall det finns en ans�kande med det angivna personnumret, annars NULL. 
 */
 function get_applicant_id($personal_number) {
		$query = "SELECT id 
				FROM applicant
				WHERE personal_number = '$personal_number'";
		
		$answer = mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}
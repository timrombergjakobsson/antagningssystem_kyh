 <?php
 /* H�mtar ut det id som tillh�r en viss utbildningsstart, genom att j�mf�ra med fr�mmande-nycklarna till 
  * education och admission  och det som finns i education_start tabellen. 
  * education_id �r id:et som anger vilken utbildning det �r.
  * admission_id �r id:et som anger vilket intag det �r.
  * Funktionen returnerar utbildningsstart id:et ifall det finns en utbildningsstart med det intaget och utbildningen,
  * annars NULL. 
 */
 function get_education_start_id($education_id, $admission_id, $conn) {
		$query = "SELECT id 
				FROM education_start
				WHERE education_id = $education_id
				AND admission_id = $admission_id";
		
		$answer = handle_mysql_query($query, $conn);
		$row = mysql_fetch_assoc($answer);
		$id = $row['id'];
		return $id;
	}
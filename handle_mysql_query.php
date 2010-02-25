<?php
	
	/* funktion som hanterar mysql_query errors och returnerar en resultset på dessa*/
	
	function handle_mysql_query ($query, $conn) {
	        $result = mysql_query($query, $conn);
	        if (mysql_errno()) {
		
	            echo "MySQL error ".mysql_errno().": ".mysql_error().
					 "\n<br>When executing:<br>\n$query\n<br>"; 
			} else {
				return $result;
			}
	        
				
	  }
	
		
	
	
	
	
	
	
	
	
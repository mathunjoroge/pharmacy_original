<?php
   $db = new mysqli('localhost', 'root' ,'', 'sales');
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['term'])) {
			$term = $db->real_escape_string($_POST['term']);
			
			if(strlen($term) >0) {
				$sddsdsd='credit';
				$query = $db->query("SELECT * FROM patients WHERE name  LIKE '%".$term."%' OR number  LIKE '%".$term."%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->invoice_number).'\');">'.$result->name.' - '.$result->invoice_number.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
<?php
   $db = new mysqli('localhost', 'root' ,'', 'winsor');
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {
				$sddsdsd='credit';
				$query = $db->query("SELECT *  FROM products WHERE product_id='$idd'");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->price).'\');">'.$result->name.' - '.$result->price.'</li>';
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
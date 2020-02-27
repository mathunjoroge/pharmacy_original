<?php
   $db = new mysqli('localhost', 'root' ,'', 'pharmacy_db');
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $db->query("SELECT gen_name, product_code FROM products  WHERE gen_name LIKE '$queryString%' OR product_code LIKE '$queryString%' LIMIT 3");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->gen_name).'\');">'.$result->gen_name.'</li>';
	         			echo '<li onClick="fill(\''.addslashes($result->product_code).'\');">'.$result->product_code.'</li>';
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
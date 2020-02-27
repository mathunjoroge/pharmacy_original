<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='INV-'.createRandomPassword();

	include('../connect.php');
	
	$a='0';
	
	//edit qty
	$sql = "UPDATE products 
			SET qty=?,instock=?";
	$q = $db->prepare($sql);
	$q->execute(array($a,$a));

	$sql = "UPDATE batch 
			SET quantity=?";
	$q = $db->prepare($sql);
	$q->execute(array($a));
	header("location: sales.php?id=cash&invoice=<?php echo $finalcode ?>");
?>
<?php
	session_start();
	include('connect.php');
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return ($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['username']);
	$passworda =md5($_POST['password']);
	$password =md5($passworda);
	//Input Validations
	if($login == '') {
		echo "Username missing";
		
	}
	if($password == '') {
		echo "password missing";
	}
	
	//If there are input validations, redirect back to the login form
	if($password == ''|| $login == '') {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create query
	$result = $db->prepare("SELECT * FROM user WHERE username='$login' AND password='$password'");
				$result->execute();
				$rowcount = $result->rowcount();
	
	//Check whether the query was successful or not
		if($rowcount>0) {
	$result = $db->prepare("SELECT * FROM user WHERE username='$login' AND password='$password'");
	$result->execute();
	for($i=0; $member = $result->fetch(); $i++){
			//Login Successful
			session_regenerate_id();			
			$_SESSION['SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['name'];
			$_SESSION['SESS_LAST_NAME'] = $member['position'];
			//$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
			session_write_close();
			header("location: main/index.php");
			exit();
		}
		if($rowcount=0){
			//Login failed
			header("location: index.php");
			exit();
		}
	}else {
		?>
		<font class="alert alert-danger" style="margin-top: 40%;">please use the correct login credentials!</font></br>
		<?php 
		session_write_close();
	

	}
?>
<html>
<head>
<title>
Login
</title>
    <link rel="shortcut icon" href="main/images/pos.jpg">

  <link href="main/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="main/css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="main/css/bootstrap-responsive.css" rel="stylesheet">

<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>
<div id="login">
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	}
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<form action="login.php" method="post">
			<?php
	include('connect.php');
	$result = $db->prepare("SELECT * FROM settings");
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$name=$row['name']; 
	?>
			
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center><?php echo $name; ?></center></font> <?php } ?>
		<br>
		
<div class="input-prepend">
		<span style="height:30px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" Placeholder="Username" autocomplete="off" required/><br>
</div>
<div class="input-prepend">
	<span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password" Placeholder="Password" autocomplete="off" required/><br>
		</div>
		<div class="qwe">
		 <button class="btn btn-large btn-primary btn-block pull-right" href="#" type="submit"><i class="icon-signin icon-large"></i> Login</button>
</div>
		 </form>
</div>
</div>
</div>
</div>
</body>
</html>
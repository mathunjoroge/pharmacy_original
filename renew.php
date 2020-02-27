<!DOCTYPE html>
<html>
<head>
<title>
Pharmacy
</title>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>

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
?>	
</head>
<body>
</ul>                               
          </div><!--/.well -->
        </div><!--/span-->
        <div class="container">

	<div class="contentheader">
			
			</div>
			
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center>Renew this application</center></font>
<div id="mainmain">
<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:red;">Your M&C enterprise suite has expired. please call +254721365661 for renewal</font>

<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</body>

</html>

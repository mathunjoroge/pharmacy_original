<html>
<head>
	<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
  <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
<!-- combosearch box-->
<script src="vendors/jquery-1.7.2.min.js"></script>
    <script src="vendors/bootstrap.js"></script>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<?php
	$Today = date('m/d/20y',time());
	$new = date('m/d/20y', strtotime($Today));
	?>
<head>
<title>Checkout</title>

<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>

<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	border: 1px solid #999;
	background: #EEEEEE;
	padding: 5px 10px;
	box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	margin: 0;
	width: 268px;
	top: 40px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:268px;
	border:1px #CCC solid;
}

</style>	
</head>
<form action="savesales.php" method="post">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Cash</h4></center>
<center><p>cash payment for: <?php echo $_GET['cname']; ?></p></center><hr>
<input type="hidden" name="date" value="<?php echo $new; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="cname" value="<?php echo $_GET['cname']; ?>" />
<input type="hidden" name="amount" value="<?php echo $_GET['amount']; ?>" />
<input type="hidden" name="ptype" value="cash" />
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" />
<input type="number"  value="<?php echo $_GET['amount']; ?>" style="width: 268px; height:30px;  margin-bottom: 15px;" readonly /><br>
<input type="number" name="cash" placeholder="Cash"  style="width: 268px; height:30px;  margin-bottom: 15px;"><br>
<input type="hidden" name="reset" placeholder="Cash" value="1" style="width: 268px; height:30px;  margin-bottom: 15px;"><br>
<button class="btn btn-success btn-block btn-large" id="save" style="width:267px;"><i class="icon icon-save icon-large" ></i> Save</button>

</center>
</div>
</form>
</body>
</html>
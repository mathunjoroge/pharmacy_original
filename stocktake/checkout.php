<html>
<head>
<title>Checkout</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
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
<body onLoad="document.getElementById('country').focus();">
<form action="savesales.php" method="post">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Cash</h4></center><hr>
<input type="hidden" name="date" value="<?php echo date("d/m/20y"); ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="amount" value="<?php echo $_GET['total']; ?>" />

<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" />

<center>
<select name="supp"  class="selectpicker" style="width:265px; height:30px;">
 
    <?php
  include('../connect.php');
  
  $result = $db->prepare("SELECT * FROM supliers");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option></option><option value="<?php echo $row['suplier_name'];?>"><?php echo $row['suplier_name']; ?>  </option>
  <?php
        }
      ?><br>
<input  value="" name="invoicesup" type="text" size="25" class="" autocomplete="off" placeholder="Enter Invoice No" style="width: 268px; height:30px;" required/>
<select  name="ptype" id="country"><option></option><option>Cash</option><option>Credit</option></select>
         
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large" accesskey="s"></i> Save</button>
</center>
</div>
</form>
</body>
</html>
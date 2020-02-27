 <html>
<?php
	require_once('auth.php');
?>
<head>
<title>
bincard
</title>
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


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script><head>
<title>

</title>
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
	left: 30px;
	top: 176px;
	margin: 60px;
	width: 240px;
	
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


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><h4 align="center">Store Card</h4><body align="center" onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>


 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
</head>
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
<body class="container">
<div class="container" >
<?php include('navfixed.php');?>
<div class="container">	
	<div class="contentheader">
			<i class="icon-bar-chart"></i> Stock card
			</div>
			<ul class="breadcrumb">
			<li><p>&nbsp;</p></li> 
			<li class="active">&nbsp;</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>


</div>
<form action="bincard.php" method="get"><span>
	<input type="text" size="25" value="" name="term" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="on" placeholder="Enter drug Name" style="width: 240px; height:30px;" />

     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>
<strong>From : <input type="text" style="width: 150px; padding:14px;" name="d1" class="tcal" value="" /> To: <input type="text" style="width: 150px; padding:14px;" name="d2" class="tcal" value="" /></span>
 <button class="btn btn-info" style="width: 150px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i>Generate</button>
</strong></center>
</form>
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
<center>generated bincard for <?php echo $_GET['term']; ?></div>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">from&nbsp;<?php $date = $_GET['d1'] ;
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?>&nbsp;to&nbsp;<?php $date = $_GET['d2'] ;
                $d112 = strtotime ( $date ) ;
                $d112 = date ( 'j/m/Y' , $d112 );
                echo $d112;  ?>
</center></div>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;width: 80%;">
	<thead>
		<tr>
		
			<th > Date </th>
			<th > Dispensed/Received </th>
			<th >dispensed by</th>
			<th > qty </th>
			<th > balance </th>
		</tr>
	</thead>
	<tbody>
		<tr class="record"> <?php
			include('../connect.php');
			$gen=$_GET['term'];
				$result = $db->prepare("SELECT product_id, qty_sold, date  FROM products WHERE gen_name=:generic OR product_code=:generic");
				$result->bindParam(':generic', $gen);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){ ?>
			<td><?php $date = $row['date']; 
			$d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?></td>
			<td>initial stock</td>
			<td>&nbsp;</td>			
			<td><strong><?php echo''; ?></strong></td>
			<td><?php echo $row['qty_sold']; ?></td> 
			
			</tr><?php
				}
			?>
		
			<?php
				include('../connect.php');
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$gen=$_GET['term'];
				$result = $db->prepare("SELECT *  FROM sales_order WHERE gen_name=:generic OR product_code=:generic AND date  BETWEEN :a AND :b ORDER by transaction_id ASC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->bindParam(':generic', $gen);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			
			
		
	</tbody>
	<tr class="record">
			<td><?php $date = $row['date']; 
			$d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?></td>
			<td><?php echo $row['customer']; ?></td>
			<td><?php echo $row['cashier']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><?php echo $row['balance']; ?></td>
			<?php } ?>
			
			</tr>
			
		
	</tbody>
</table>

</div>
<button  style="float:left;" class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"> Print</button></a>
</div></div>
</div>
</div>
</div>

</body>
<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deletesales.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<?php include('footer.php');?>
</html>
<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'sales';

// Database Connection String
$con = mysql_connect($db_hostname,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_database, $con);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title></title>
    </head>
    <body style="text-transform:capitalize;">
    
        <div class="container">
  
    <!DOCTYPE html>
<html>
<head>
<?php require_once ('auth.php');?>
<title>
Preview Invoice
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
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<?php
include('../connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cname=$row['name'];
$invoice=$row['invoice_number'];
$date=$row['date'];
$cash=$row['due_date'];
$cashier=$row['cashier'];
$pt=$row['type'];
$am=$row['amount'];
if($pt=='cash'){
$cash=$row['due_date'];
$amount=$cash-$am;
}
}
?>
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
$finalcode='RS-'.createRandomPassword();
?>



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
<body style="text-transform:capitalize;">

<?php include('navfixed.php');?>
  
  <div class="container-fluid">
      <div class="row-fluid">
  <div class="span2">
             <div class="well sidebar-nav" style="left:1%;">
                 <ul class="nav nav-list">
              <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
      <li class="active"><a href="sales.php?id=cash&invoice"><i class="icon-shopping-cart icon-2x"></i> Sales</a>  </li>             
      <li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a>                                     </li>
      <li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a>                                    </li>
      <li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a>                                    </li>
      <li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a>                </li>
      <li><a href="sales_inventory.php"><i class="icon-table icon-2x"></i> Product Inventory</a>                </li>
        <br><br><br><br><br><br>    
      <li>
       <div class="hero-unit-clock">
    
      <form name="clock">
      <font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="submit" class="trans" name="face" value="">
      </form>
        </div>
      </li>
        
        </ul>           
          </div><!--/.well -->
        </div><!--/span-->
    
  <div class="span10">
  
  <div></div>

  <div>
     <style type="text/css">.add-on .input-group-btn > .btn {
  border-left-width:0;left:-2px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
/* stop the glowing blue shadow */
.add-on .form-control:focus {
 box-shadow:none;
 -webkit-box-shadow:none; 
 border-color:#cccccc; 
}
.form-control{width:50%}
.navbar-nav > li > a {
  border-right: 1px solid #ddd;
  padding-bottom: 15px;
  padding-top: 15px;
}
.navbar-nav:last-child{ border-right:0}</style>
<div>
  <div class="container">
  <div class="row">
        <div class="container">
  
    <div class="container">
<div class="">
  <form class="navbar-form" role="search" >
    <div class="input-group add-on" style="width:50%;">
      <input class="form-control" placeholder="search customer by name" name="term" id="srch-term" type="text"  >
      <form action="search.php" method="post">
      <div class="input-group-btn">
        <button class="btn btn-default"><i class="btn btn-primary"> search</i></button>
      </div>
    </div>
  </form>
                        
<hr>
  <div class="container">
     <section class="col-xs-12 col-sm-6 col-md-12">

    <article class="search-result row">
    <div class="container">  
  <?php
if (!empty($_REQUEST['term'])) {

$term = mysql_real_escape_string($_REQUEST['term']);
   

$sql = "SELECT * FROM sales WHERE `type` LIKE 'credit' AND  name LIKE '%".$term."%'"; 
?>

<div style=""><?php 
$total_records = mysql_num_rows(mysql_query($sql));
$id=["invoice_number"];

echo "" . number_format($total_records) ?> Results for <font color="blue" style="font:bold 20px 'Aleo';"><?php echo $term;?></font>

      
      </div><div class="container-fluid" >
      <?php $r_query = mysql_query($sql);


while ($row = mysql_fetch_array($r_query)){

echo '<a href="preview.php?invoice='<td>.$row['date'].</td>'<h4>'<td>.$row['invoice_number']. </td>":"<td>. $row['amount'].'</h4></a>';     

}  

}
?>
  
  </div>
  </div>
  
      
      
  
  </div>
  </div>
  
</div>
</div>





</div></div></div>
<hr style="color:blue;"><hr><hr>


    </body>
</html>
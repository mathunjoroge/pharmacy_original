<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>
expenses list
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
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
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
<body>
<?php include('navfixed.php');?>
<div class="container">
      <div class="container">
	
			

	<div class="contentheader">

			<i class="icon-group"></i> expenses list
			</div>
			<div class="container">
			<p>&nbsp;</p> 
			</div>
			
			
			
			
<div style="">
<a  href="expenseslist2.php"><button class="btn btn-success btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a></div>
<div class="container">
			<p>&nbsp;</p> 
			</div>
			<div class="container">
			<p>&nbsp;</p> 
			</div>
			<div class="container">
			<p>&nbsp;</p> 
			</div>

<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Search expense..." autocomplete="off" />
<a rel="facebox" href="addexplist.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Record expense</button></a><br><br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			
			<th width="40%"> expense  </th>
			<th width="20%"> added by  </th>
			<th width="10%"> &nbsp;  </th>
			<th width="10%"> &nbsp; </th>
			
			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$start=0;
				$limit=10;
				if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
else{
	$id=1;
}
				$result = $db->prepare("SELECT * FROM expenselist LIMIT $start, $limit");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
		
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['addedby']; ?></td>
			
			

			<td><a  title="Click To Edit expense" rel="facebox" href="editexplist.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a> </td>
			<td><a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table><div>
<?php

			include('../connect.php');
				$result = $db->prepare("SELECT * FROM expenselist   ORDER BY id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			
//calculate total page number for the given table in the database 
$total=ceil($rowcount123/$limit); ?>
<ul >
<?php if($id>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<button class='btn btn-primary'><a href='?id=".($id-1)."' class='button'>PREVIOUS</a></button>";
}
if($id!=$total)
{
	////Go to previous page to show next 10 items.
	echo "<button class='btn btn-primary'><a href='?id=".($id+1)."' class='button'>NEXT</a></button>";
}
?>

<?php
//show all the page link with page number. When click on these numbers go to particular page. 
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<button class='active'><span class='current'>".$i."</button>"; }
			
			else { echo "<button class='btn btn-primary'><a href='?id=".$i."'>".$i."</a></button>"; }
		}
?></div>
<div class="clearfix"></div>

</div>
</div>
</div>
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
 if(confirm("Are you sure want to delete? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteexp.php",
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
</body>
<?php include('footer.php');?>

</html>
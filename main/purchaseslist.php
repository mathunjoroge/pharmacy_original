<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head><script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt4').value;
			 var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
				}
			
        }
</script>
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
<title>
purchases list
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
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
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
</head>
<body>
<?php include('navfixed.php');?>
	<div class="container">
	

	<div class="contentheader">
			<i class="icon-dashboard"></i> Dashboard
			</div>
			<ul class="breadcrumb">
			<a href="http://localhost/winsor/main/statementslist.php"><li>Dashboard</li></a> /
			<li class="active">Purchases List</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="statementslist.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i><b> Back</b></button></a>
</div><form action="search.php" method="post">
<span><input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Search supplier" name="term" autocomplete="off" /> <button class="btn btn-primary" type="submit">search</button>  </span><br>
  </form>


<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="15%"> Date </th>
			<th width="15%"> supplier </th>
			<th width="15%"> Invoice Number </th>
			<th width="15%"> Purchase Type </th>
			<th width="15%"> Amount </th>
			<th width="15%"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM purchases2 ORDER BY transaction_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['invoicesupp']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['amount']; ?></td>
			<td><a rel="" href="preview2.php?invoice=<?php echo $row['invoice_number']; ?>"> <button class="btn btn-primary btn-mini"><i class="icon-search"></i> View purchase details</button></a> 
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<div class="clearfix"></div>
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
   url: "deletepppp.php",
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

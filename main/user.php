<?php
	require_once('auth.php');
?><html>
<head>
<title>
users
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
</head>
<?php
function createRandomPassword() {
	$chars = "0032321303232023232023456789";
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
<body>
<?php include('navfixed.php');?>
<div class="container">
      <div class="container">
	
			

	<div class="contentheader">
			<i class="icon-group"></i> users
			</div>
			<ul class="breadcrumb">
			<li><a href="admin.php">Dashboard</a></li> /
			<li class="active">users</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="admin.php"><button class="btn btn-success btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM user ORDER BY id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center;">
			Total Number of users: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Search user..." autocomplete="off" />
<a rel="facebox" href="adduser.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add user</button></a><br><br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="17%"> user Name </th>
			<th width="10%"> Contact </th>
			<th width="9%"> position </th>
			<th width="17%"> Id number</th>
			<th width="9%"> edit </th>
			<th width="14%"> delete </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM user ORDER BY id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['contact']; ?></td>
			<td><?php echo $row['position']; ?></td>
			<td><?php echo $row['idno']; ?></td>

			<td><a  title="Click To Edit user" rel="facebox" href="edituser.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a> </td>
			<td><a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
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
   url: "deleteuser.php",
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
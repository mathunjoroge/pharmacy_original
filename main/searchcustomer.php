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
      <hr>
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
      <input class="form-control" placeholder="Generic, Brand name, pharmacological class or manufacturer" name="term" id="srch-term" type="text"  >
      <form action="search.php" method="post">
      <div class="input-group-btn">
        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
   

$sql = "SELECT * FROM sales WHERE name LIKE '%".$term."%'"; 
?>

<div style=""><?php 
$total_records = mysql_num_rows(mysql_query($sql));
$id=["invoice_number"];

echo "" . number_format($total_records) ?> Results for <font color="blue" style="font:bold 20px 'Aleo';"><?php echo $term;?></font>

      
      </div><div class="container-fluid" >
      <?php $r_query = mysql_query($sql);


while ($row = mysql_fetch_array($r_query)){

echo '<a href="preview.php?invoice='.$row['invoice_number'].'"><h4>'.$row['date']. ":". $row['name'].'</h4></a>';     

}  

}
?>


</div></div></div>
<hr style="color:blue;"><hr><hr>


    </body>
</html>
<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveexpenselist.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> add new expense</h4></center>
<hr>
<div id="ac">
</span><input type="hidden" style="width:265px; height:30px;" name="dt" value="<?php $date = date('Y-m-d');
                $d11 = strtotime ( $date ) ;
                $d11 = date ('Y-m-d' , $d11);
                echo $d11; ?>"><br>


<span>expense name </span><input type="text" style="width:265px; height:30px;" name="name" placeholder="expense name" required/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>
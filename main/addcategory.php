<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savecategory.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> add new category</h4></center>
<hr>
<?php
			$leo = date('d/m/20y',mktime());
			$new = date('l, F d, Y', strtotime($leo));
			  


?>
		
<div id="ac">
</span><input type="hidden" style="width:265px; height:30px;" name="dt" value="<?php echo $leo; ?>"><br>


<span>category</span><input type="text" style="width:265px; height:30px;" name="name" placeholder="category name" required/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>
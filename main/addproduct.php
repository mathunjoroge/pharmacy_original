
<form action="saveproduct.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
<hr>
<div id="ac">
<span>Brand Name : </span><input type="text"  name="code" required=""><br>
<span>Generic Name : </span><input type="text"  name="gen" /><br>
<span>buying Price : </span><input type="text"  name="o_price" onkeyup="sum();" Required><br>
<span>retail price: </span><input type="text"   name="retail"  onkeyup="sum();" Required><br>
<span>wholesale price: </span><input type="text" id=""  name="wholesale" placeholder="" onkeyup="sum();" Required><br>
<span>max discount retail:</span><input type="number" id="" placeholder="eg 10"  name="maxr" placeholder="" onkeyup="sum();" Required><br>
<input type="hidden"  name="exdate" value="<?php $today=date('Y-m-d');
    $expdate=date('Y-m-d', strtotime($today. ' + 365 days')); echo $expdate; ?>" ><br>
<span>Quantity : </span><input type="number"  min="1" name="qty" Required/><br>
<span></span><input type="hidden"  id="txt22" name="qty_sold" Required ><br>
<span>Reorder Level : </span><input type="text" id="txt2"  name="level"><br>
<div>
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>

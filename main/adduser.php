<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveuser.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add user</h4></center>
<hr>
<div id="ac">
<span>Username : </span><input type="text" style="width:265px; height:30px;" name="name" placeholder="Full Name" Required/><br>

<span>password : </span><input type="password"  style="width:265px; height:30px;" name="pass" placeholder="password"/><br>
<span>Contact : </span><input type="text" style="width:265px; height:30px;" name="cont" placeholder="contact"/><br>
<span></span><input type="hidden" style="width:265px; height:30px;" name="other" placeholder="other names"/><br>
<span>position </span><select type="text" style="width:265px; height:30px;" name="pos"><option>cashier</option><option>pharmacist</option><option>admin</option></select><br>
<span>Id number </span><input type="text" style="width:265px; height:30px;" name="idno" placeholder="Id Number"/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>
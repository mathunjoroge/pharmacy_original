

<center><h5>please order the following </h5></center>
<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="12%"> Brand Name </th>
			<th width="14%"> Generic Name </th>
			<th width="7%"> Supplier </th>
			
			<th width="6%"> buying Price </th>
			<th width="6%"> Selling Price </th>
			<th width="6%"> opening stock </th>
			<th width="5%"> Qty Left </th>
			<th width="5%"> Reorder Level </th>
			<th width="8%"> Value </th>
			
		</tr>
	</thead>
	<tbody>
		
			<?php
			function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				include('../connect.php');
				$result = $db->prepare("SELECT *, o_price * qty as total FROM products where qty < level ORDER BY product_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['total'];
				$reorder=$row['level'];
				$availableqty=$row['qty'];
				if ($availableqty<$reorder) {				
			?>
		

			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>
			
					<td><?php echo $row['supplier']; ?></td>
			
			<td><?php
			$oprice=$row['o_price'];
			echo formatMoney($oprice, true);
			?></td>
			<td><?php
			$pprice=$row['price'];
			echo formatMoney($pprice, true);
			?></td>
			<td><?php echo $row['instock']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><?php echo $row['level']; ?></td>			
			<td>
			<?php
			$total=$row['total'];
			echo formatMoney($total, true);
			?>
			
			</tr><?php } } ?>
		
		
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
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteproduct.php",
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


</html>

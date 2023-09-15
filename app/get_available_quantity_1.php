<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$product_id = $_REQUEST['product_id'];
if(!empty($product_id)) {
	
	                $return_qty = 0;
	                $sales_qty = 0;
	                $overall_qty = 0;
	                $sales_return_qty = 0;
	                $initial_quantity = 0;
					
					$qury_rate="select Mrp_Rate,Quantity from tbl_product where Id='$product_id' AND Status='Active'";
					$qury_exe_rate=mysqli_query($con,$qury_rate);
					$fetch_rate=mysqli_fetch_array($qury_exe_rate);
					$rate = $fetch_rate['Mrp_Rate'];
					$initial_quantity = $fetch_rate['Quantity'];
					
	                $qury="select SUM(Quantity) as qty from tbl_purchase where Product_Id='$product_id' AND Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					$fetch=mysqli_fetch_array($qury_exe);
					$overall_qty = $fetch['qty'];
					
					$qury_sales="select SUM(Quantity) as qty from tbl_sales where Product_Id='$product_id' AND Status='Active'";
					$qury_exe_sales=mysqli_query($con,$qury_sales);
					$fetch_sales=mysqli_fetch_array($qury_exe_sales);
					$sales_qty = $fetch_sales['qty'];
					
					$qury_return="select SUM(Quantity) as qty from tbl_purchase_return where Product_Id='$product_id' AND Status='Active'";
					$qury_exe_return=mysqli_query($con,$qury_return);
					$fetch_return=mysqli_fetch_array($qury_exe_return);
					$return_qty = $fetch_return['qty'];
					
					$qury_sales_return="select SUM(Quantity) as qty from tbl_sales_return where Product_Id='$product_id' AND Status='Active'";
					$qury_exe_return_sales=mysqli_query($con,$qury_sales_return);
					$fetch_return_sales=mysqli_fetch_array($qury_exe_return_sales);
					$sales_return_qty = $fetch_return_sales['qty'];
	
					$available_qty = $overall_qty - $sales_qty - $return_qty + $sales_return_qty + $initial_quantity;
	
	?>
	 <div class="form-group col-sm-4">
						   <label for="inputName" class="col-sm-4 control-label">Rate</label>
						   <div class="col-sm-8">
							<input type="text" maxlength="15" value="<?php echo $rate; ?>" id="rate" class="form-control limited" maxlength="15" name="rate">
							</div>
							</div>
							<input type="button" VALUE="+" id="BTNSUBMIT" onclick="addrow()"/>
	  </div>
		<div class="form-group col-sm-4">        
					   <label for="inputName" class="col-sm-4 control-label">Available Quantity<font color="red"></label>
						<div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo $available_qty; ?>"  name="avail_qty" id="avail_qty" readonly>
						  </div>
	 </div>
<?php 
  
}

?>

	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $supplier = $_REQUEST['supplier'];
if(!empty($supplier)) {
	
	?>
		 <div class="row">
						 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >GRN No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="grn" id="grn" data-live-search="true">
						 <option value="">Select GRN No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_grn WHERE Status='Active' AND Supplier_Name='$supplier'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Grn_No=$fetch_GrpQry['Grn_No'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>"><?php echo $Grn_No; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						 </div>
						
						 
						 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Purchase Order No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="grn" id="grn" onchange="get_purchase_order_purchase(this.value);" data-live-search="true">
						 <option value="">Select Purchase Order No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_purchase_order WHERE Status='Active' AND Supplier_Name='$supplier' group by Order_No");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$ord_No=$fetch_GrpQry['Order_No'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $ord_No;?>"><?php echo $ord_No; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						 </div>
						
						 </div>
						  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
						  
						  
<?php 
  
} 
 $order_id = $_REQUEST['order_id'];
if(!empty($order_id)) {
?>

 <a href="purchase_order_clearance.php?id=<?php echo $order_id; ?> " class="btn btn-success" target="_blank">Go Purchase Order</a> 

<?php

}
?>
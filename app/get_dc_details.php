
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $supplier = $_REQUEST['customer_id'];
if(!empty($supplier)) {
	
	?>
		 <div class="row">
						 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Dc No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="dc_no" id="dc_no" data-live-search="true">
						 <option value="">Select Dc No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_dc WHERE Status='Active' AND Customer_Id='$supplier'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Grn_No=$fetch_GrpQry['Dc_No'];
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
						<label for="inputName" class="col-sm-4 control-label" >Indent No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="indent_no" id="indent_no" onchange="get_purchase_order_purchase(this.value);" data-live-search="true">
						 <option value="">Select Sale Order No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_sales_order WHERE Status='Active' AND Customer_Id='$supplier' group by Order_No");
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
						 
						  <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Target No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="target_no" id="target_no" onchange="get_target(this.value);" data-live-search="true">
						 <option value="">Select Target No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_sales_target WHERE Status='Active' AND Customer_Id='$supplier' group by Sales_Target_No");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$ord_No=$fetch_GrpQry['Sales_Target_No'];
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

 <a href="sales_order_clearance.php?id=<?php echo $order_id; ?> " class="btn btn-success" target="_blank">Go Sales Order</a> 

<?php

}
?>
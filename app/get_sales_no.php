
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
  $supplier = $_REQUEST['product_id'];
 $invoice_no = $_REQUEST['invoice_no'];
if(!empty($supplier)) {
	
	?>
		 <div class="row">
						
						
						 
						 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Sales Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="sales_invoice_no" id="sales_invoice_no" onchange="get_indent_order_purchase(this.value);" data-live-search="true" required>
						 <option value="">Select Sale Invoice No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_sales WHERE Status='Active' AND Customer_Id='$supplier' group by Invoice_No");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$ord_No=$fetch_GrpQry['Invoice_No'];
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
						
						  
						  
<?php 
  
} 
if(!empty($invoice_no)) {
    
    $select_mid=mysqli_query($con,"select  Quantity from tbl_sales WHERE Status='Active' AND Invoice_No='$invoice_no'");
							$fetch_mid=mysqli_fetch_array($select_mid);
							$mid=$fetch_mid['Quantity'];
?>

<div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Sales Quantity<font color="red">&nbsp;*&nbsp;</font></label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="sale_quantity" value="<?php echo $mid; ?>" class="limited" style="width:80%;" maxlength="15" name="sale_quantity" readonly>
							
							
							</div>
							
							
							</div>	

<?php } ?>
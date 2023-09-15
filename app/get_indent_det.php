
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $supplier = $_REQUEST['customer_id'];
 $Order_No = $_REQUEST['order_id'];
if(!empty($supplier)) {
	
	?>
		 <div class="row">
						
						
						 
						 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Indent No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="indent_no" id="indent_no" onchange="get_indent_order_purchase(this.value);" data-live-search="true">
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
						 
						 
						
						 </div>
						
						  
						  
<?php 
  
} 

if(!empty($Order_No)) {
?>

 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							
            <th style="width: 100px;">S.No</th>
            <th style="width: 100px;">Product Name</th>
            <th style="width: 100px;">Target Quantity</th>
            <th style="width: 100px;">Indent Placed</th>
            <th style="width: 100px;">Quantity</th>
            
        
						</thead>
						<tbody>
						<?php 
						  $qury="select p.*,t.Name as prod_name,t.Id as tid,p.Id as pid,t.Sgst as prod_sgst,t.Cgst as prod_cgst from tbl_sales_order p left join tbl_product t on t.Id=p.Product_Id where p.Order_No='$Order_No' AND p.Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					
						$i=1;		
						$opening_qty_target=0;
						while($fetch=mysqli_fetch_array($qury_exe))
							{
							
								$product_Name = $fetch['prod_name'];
								$Quantity_1 = $fetch['Quantity'];
								$Customer_Id = $fetch['Customer_Id'];
								$tid = $fetch['tid'];
								$order_no = $fetch['Order_No'];
								$order_id = $fetch['pid'];
								$Product_Id = $fetch['Product_Id'];
								
								
								$qury_opn="select SUM(Quantity) as qty from tbl_sales_order where Product_Id='$tid' AND Status='Active' AND Id='$order_id'";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty = $fetch_opn['qty'];
								
								$from = date('01-m-Y');
 	                            $to =date('d-m-Y');
								
								$qury_opn="select SUM(Quantity) as qty from tbl_sales_target where Product_Id='$Product_Id' AND Status='Active' AND Customer_Id='$Customer_Id' AND STR_TO_DATE(`Start_Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty_target = $fetch_opn['qty'];
								
								
								$qury="select SUM(Quantity) as qty from tbl_sales where Product_Id='$tid' AND Status='Active' AND Sales_Order_No='$order_no'";
								$qury_exe=mysqli_query($con,$qury);
								$fetch=mysqli_fetch_array($qury_exe);
								$overall_qty = $fetch['qty'];
								if($overall_qty==''){
								    $overall_qty_1 = 0;
								}else {
								    $overall_qty_1 = $overall_qty;
								}
								
								$qury_can="select SUM(Quantity) as qty from tbl_cancel_sales_order where Product_Id='$tid' AND Status='Active' AND Order_Id='$order_no'";
								$qury_exe_can=mysqli_query($con,$qury_can);
								$fetch_can=mysqli_fetch_array($qury_exe_can);
								$overall_can = $fetch_can['qty'];
								if($overall_can==''){
								    $overall_can_1 = 0;
								}else {
								    $overall_can_1 = $overall_can;
								}
								
				
								$Quantity = $opening_qty - $overall_qty_1 - $overall_can_1;
								
								 if($i==1) { 
							?>
							<tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_1" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_6_1" value="<?php echo $tid; ?>" readonly></td>
							    <td><input type="text" name="tar_quantity[]" id="quantity_6_1_6_tar" value="<?php echo $opening_qty_target; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="quantity[]" id="quantity_6_1_6" value="<?php echo $Quantity; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="quantity_s[]" onKeyUp="addrow6_1(this.value);" id="quantity_6" style="width: 100px;"></td>
								
						
							</tr>
								 <?php 
								 }
								  if($i==2) { 
								 ?>
								 <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_2" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_6_2" value="<?php echo $tid; ?>" ></td>
								<td><input type="text" name="tar_quantity[]" id="quantity_6_2_6_tar" value="<?php echo $opening_qty_target; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="quantity_s[]" id="quantity_6_2" onchange="addrow6_2(this.value);" style="width: 100px;"></td>
								<td><input type="text" name="quantity[]" id="quantity_6_1_1" value="<?php echo $Quantity; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								  <?php } if($i==3) { ?>
								   <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_3" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_6_3" value="<?php echo $tid; ?>"></td>
								<td><input type="text" name="tar_quantity[]" id="quantity_6_3_6_tar" value="<?php echo $opening_qty_target; ?>" style="width: 100px;" readonly></td>
								<td ><input type="text" name="quantity_s[]" style="width: 100px;" onchange="addrow6_3(this.value);" id="quantity_6_3" style="width: 100px;"></td>
								<td><input type="text" name="quantity[]" id="quantity_6_1_2" value="<?php echo $Quantity; ?>" style="width: 100px;" readonly></td>
						
							</tr>
							<?php
								  }
								  $i++;
							}
						?>
						</tbody>
						
					</table>
					
					<table class="i_tbl" style="float:right;">
					<style>
					.i_tbl tr {    border-bottom: 0px solid #dedede; }
						.i_tbl td, th {
							padding: 10px 8px; 
						}
					</style>
						  <link rel="stylesheet" href="dist/css/bootstrap-select.css">


<?php   } ?>
<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $invoice_id = $_REQUEST['invoice_no'];
 $select_GrpQry=mysqli_query($con,"select d.Name as dist_name,s.Sales_Order_No from tbl_sales s LEFT JOIN tbl_coordinator d on s.Customer_Id=d.Id WHERE s.Id='$invoice_id'");
 $fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
 $Name=$fetch_GrpQry['dist_name'];
 $Indent_No=$fetch_GrpQry['Sales_Order_No'];
 $coordinator_name=$fetch_GrpQry['coordinator_name'];
if(!empty($invoice_id)) {
   
	?>
		
						<div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >District Coordinator</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
							<input type="text" id="co_ordi"  class="form-control limited" value="<?php echo $Name; ?>" name="co_ordi" readonly>
						 </div>
					 </div>
				 
						  <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Indent No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
							<input type="text" id="indent_no"  class="form-control limited" value="<?php echo $Indent_No; ?>" name="indent_no" readonly>
						 </div>
					 </div>
					 
					
 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							
            <th style="width: 100px;">S.No</th>
            <th style="width: 100px;">Shop Name</th>
            <th style="width: 100px;">Product Name</th>
            <th style="width: 100px;">Available Quantity</th>
            <th style="width: 100px;">Quantity</th>
            
        
						</thead>
						<tbody>
						<?php 
						  $qury="select p.*,t.Name as prod_name,t.Id as tid,p.Id as pid,t.Sgst as prod_sgst,t.Cgst as prod_cgst,s.Name as shop_name,s.Id as sid from tbl_sales p left join tbl_product t on t.Id=p.Product_Id left join tbl_shop s on s.Id=p.Shop_Id where p.Invoice_No='$invoice_id' AND p.Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					
						$i=1;		
						$opening_qty=0;
						while($fetch=mysqli_fetch_array($qury_exe))
							{
							
								$product_Name = $fetch['prod_name'];
								$Quantity_1 = $fetch['Quantity'];
								$Customer_Id = $fetch['Customer_Id'];
								$tid = $fetch['tid'];
								$order_no = $fetch['Order_No'];
								$order_id = $fetch['pid'];
								$Product_Id = $fetch['Product_Id'];
								$shop_name = $fetch['shop_name'];
								$sid = $fetch['sid'];
								
								 $qury_opn="select SUM(Quantity) as qty from tbl_sales_return where Status='Active' AND Sales_Invoice_No='$invoice_id'";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty = $fetch_opn['qty'];
								
								$available_qty = $Quantity_1 - $opening_qty;
							
							?>
							<tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td style="width: 100px;"><input type="text" id="shop_name" value="<?php echo $shop_name; ?>" readonly><input type="hidden" name="shop[]"  id="shop_name" value="<?php echo $sid; ?>" readonly><input type="hidden" name="indent_no[]"  id="indent_no" value="<?php echo $Order_No; ?>" readonly></td>
								<td style="width: 100px;"><input type="text" id="product_name" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_name" value="<?php echo $Product_Id; ?>" readonly></td>
							
								<td style="width: 100px;"><input type="text"  id="qty" value="<?php echo $available_qty; ?>" readonly></td>
							 	<td style="width: 100px;"><input type="text" name="quantity_s[]" id="avail_qty"></td>
						
							</tr>
								 <?php
								  $i++;
							}
						?>
						</tbody>
						
					</table> </br></br></br>
					 
<?php 
} 
?>
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $supplier = $_REQUEST['customer_id'];
 $Order_No = $_REQUEST['invoice_no'];
 
 if(!empty($Order_No)) {
?>
</br></br>
<h4><b>Invoice No Details</b></h4>
 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							
            <th style="width: 100px;">S.No</th>
            <th style="width: 100px;">Shop Name</th>
            <th style="width: 100px;">Product Name</th>
            <th style="width: 100px;">Saled Quantity</th>
            <th style="width: 100px;">Quantity</th>
            
        
						</thead>
						<tbody>
						<?php 
						  $qury="select p.*,t.Name as prod_name,t.Id as tid,p.Id as pid,t.Sgst as prod_sgst,t.Cgst as prod_cgst,s.Name as shop_name,s.Id as sid from tbl_sales p left join tbl_product t on t.Id=p.Product_Id left join tbl_shop s on s.Id=p.Shop_Id where p.Order_No='$Order_No' AND p.Status='Active'";
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
								
							
							?>
							<tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td style="width: 100px;"><input type="text" id="shop_name" value="<?php echo $shop_name; ?>" readonly><input type="hidden" name="shop[]"  id="shop_name" value="<?php echo $sid; ?>" readonly><input type="hidden" name="indent_no[]"  id="indent_no" value="<?php echo $Order_No; ?>" readonly></td>
								<td style="width: 100px;"><input type="text" id="product_name" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_name" value="<?php echo $Product_Id; ?>" readonly></td>
								<td style="width: 100px;"><input type="text"  id="avail_qty" value="<?php echo $available_qty; ?>" readonly></td>
								<td style="width: 100px;"><input type="text" name="quantity_s[]" id="qty" value="<?php echo $Quantity_1; ?>"></td>
							 
						
							</tr>
								 <?php
								  $i++;
							}
						?>
						</tbody>
						
					</table> </br></br></br>
 <?php } ?>
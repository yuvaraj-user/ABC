
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $order = $_REQUEST['purchase_id1'];
if(!empty($order)) {
$qury_opn="select * from tbl_sales_order where Status='Active' AND Order_No='$order'";
$qury_exe_opn=mysqli_query($con,$qury_opn);
$fetch_opn=mysqli_fetch_array($qury_exe_opn);
 $Supplier_Name = $fetch_opn['Customer_Id'];
 $Order_No = $fetch_opn['Order_No'];
	
	?>
		 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							
            <th>S.No</th>
            <th>Product Name</th>
            <th style="width: 100px;">Quantity</th>
            <th style="width: 100px;">Rate</th>
            <th style="width: 100px;">Amount</th>
            <th style="width: 100px;">CGST</th>
            <th style="width: 100px;">SGST</th>
            <th style="width: 100px;">IGST</th>
            <th style="width: 100px;">Net Amount</th>
        
						</thead>
						<tbody>
						<?php 
						  $qury="select p.*,t.Name as prod_name,t.Id as tid,p.Id as pid,t.Sgst as prod_sgst,t.Cgst as prod_cgst from tbl_sales_order p left join tbl_product t on t.Id=p.Product_Id where p.Order_No='$Order_No' AND p.Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					
						$i=1;					
						while($fetch=mysqli_fetch_array($qury_exe))
							{
							
								 $product_Name = $fetch['prod_name'];
								$Quantity_1 = $fetch['Quantity'];
								$Rate = $fetch['Rate'];
								$Amount = $fetch['Amount'];
								$Cgst = $fetch['Cgst'];
								$Sgst = $fetch['Sgst'];
								$Igst = $fetch['Igst'];
								$Net_Amount = $fetch['Net_Amount'];
								$Net_Total = $fetch['Net_Total'];
								$Total = $fetch['Total'];
								$Discount = $fetch['Discount'];
								 $tid = $fetch['tid'];
								$order_no = $fetch['Order_No'];
								$order_id = $fetch['pid'];
								$prod_cgst = $fetch['prod_cgst'];
								$prod_sgst = $fetch['prod_sgst'];
								
								
									$qury_opn="select SUM(Quantity) as qty from tbl_sales_order where Product_Id='$tid' AND Status='Active' AND Id='$order_id'";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty = $fetch_opn['qty'];
								
								
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
								<td><input type="text" name="product[]" id="product_1" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_5" value="<?php echo $tid; ?>" readonly></td>
								<td><input type="text" name="quantity_s[]" onchange="addrow(this.value);" id="quantity_1" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td><input type="text" name="rate_s[]" id="rate_1" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td><input type="text" name="amount_s[]" id="amount_1" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td><input type="text" name="cgst_s[]" id="cgst_1" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="cgst[]" id="prod_cgst_1" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="sgst_s[]" id="sgst_1" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="sgst[]" id="prod_sgst_1" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="igst_s[]" id="igst_1" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="netamount_s[]" id="netamount_1" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								 <?php 
								 }
								  if($i==2) { 
								 ?>
								 <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" name="product[]" id="product_2" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_5" value="<?php echo $tid; ?>" ></td>
								<td style="width: 100px;"><input type="text" name="quantity_s[]" id="quantity_2" onchange="addrow2(this.value);" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s[]" id="rate_2" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s[]" id="amount_2" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s[]" id="cgst_2" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_2" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s[]" id="sgst_2" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_2" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s[]" id="igst_2" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s[]" id="netamount_2" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								  <?php } if($i==3) { ?>
								   <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" name="product[]" id="product_3" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s[]" id="product_5" value="<?php echo $tid; ?>"></td>
								<td ><input type="text" name="quantity_s[]" style="width: 100px;" onchange="addrow3(this.value);" id="quantity_3" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s[]" id="rate_3" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s[]" id="amount_3" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s[]" id="cgst_3" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_3" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s[]" id="sgst_3" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_3" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s[]" id="igst_3" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s[]" id="netamount_3" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
							<?php
								  }
								  $i++;
							}
						?>
						</tbody>
						
					</table>
					<script>
					window.onload = addrow;
						function addrow()
							{
						       
								var rate = parseFloat(document.getElementById("rate_1").value);
								var quantity = parseFloat(document.getElementById("quantity_1").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_1").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_1").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_1").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_1').val(net_amount);
								$('#amount_1').val(amount);
								$('#cgst_1').val(cgst_1);
								$('#sgst_1').val(sgst_1);
								
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr').val(netamount_ovrall_ovr);
								$('#net_total').val(netamount_ovrall_ovr);
							}
							
							
							function addrow2()
							{
						       
								var rate = parseFloat(document.getElementById("rate_2").value);
								
								var quantity = parseFloat(document.getElementById("quantity_2").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_2").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_2").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_2").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_2').val(net_amount);
								$('#amount_2').val(amount);
								$('#cgst_2').val(cgst_1);
								$('#sgst_2').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr').val(netamount_ovrall_ovr);
								$('#net_total').val(netamount_ovrall_ovr);
							}
							
							function addrow3()
							{
						       
								var rate = parseFloat(document.getElementById("rate_3").value);
								
								var quantity = parseFloat(document.getElementById("quantity_3").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_3").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_3").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_3").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_3').val(net_amount);
								$('#amount_3').val(amount);
								$('#cgst_3').val(cgst_1);
								$('#sgst_3').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr').val(netamount_ovrall_ovr);
								$('#net_total').val(netamount_ovrall_ovr);
							}
						</script>
					<table class="i_tbl" style="float:right;">
					<style>
					.i_tbl tr {    border-bottom: 0px solid #dedede; }
						.i_tbl td, th {
							padding: 10px 8px; 
						}
					</style>
					<tr>
								<td colspan='7'><b>Total</b></td>
								
								<td><input type="text" name="netamount_s[]" id="netamount_ovr" value="<?php echo $Total; ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Discount</b></td>
								
								<td><input type="text" name="discount_s[]" id="discount_s" value="<?php echo $Discount ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Net Total</b></td>
								
								<td><input type="text" name="net_total[]" id="net_total" value="<?php echo $Net_Total ?>" readonly></td>
						
							</tr>
							</table>
				
	
	 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Sale Order No </label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="grn" id="grn" onchange="get_purchase_order1(this.value);" data-live-search="true">
						 <option value="">Select Sale Order No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_sales_order WHERE Status='Active' AND Customer_Id='$Supplier_Name' group by Order_No");
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
						  
						  
<?php 
  
} 

$purchase_id2 = $_REQUEST['purchase_id2'];
if(!empty($purchase_id2)) {
	$qury_opn="select * from tbl_purchase_order where Status='Active' AND Order_No='$purchase_id2'";
$qury_exe_opn=mysqli_query($con,$qury_opn);
$fetch_opn=mysqli_fetch_array($qury_exe_opn);
 $Supplier_Name = $fetch_opn['Supplier_Name'];
 $Order_No = $fetch_opn['Order_No'];
	
	?>
		 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							
            <th>S.No</th>
            <th>Product Name</th>
            <th style="width: 100px;">Quantity</th>
            <th style="width: 100px;">Rate</th>
            <th style="width: 100px;">Amount</th>
            <th style="width: 100px;">CGST</th>
            <th style="width: 100px;">SGST</th>
            <th style="width: 100px;">IGST</th>
            <th style="width: 100px;">Net Amount</th>
        
						</thead>
						<tbody>
						<?php 
						  $qury="select p.*,t.Name as prod_name,t.Id as tid,t.Sgst as prod_sgst,t.Cgst as prod_cgst from tbl_purchase_order p left join tbl_product t on t.Id=p.Product_Id where p.Order_No='$purchase_id2' AND p.Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					
						$i=1;					
						while($fetch=mysqli_fetch_array($qury_exe))
							{
							
								$product_Name = $fetch['prod_name'];
								$Quantity = $fetch['Quantity'];
								$Rate = $fetch['Rate'];
								$Amount = $fetch['Amount'];
								$Cgst = $fetch['Cgst'];
								$Sgst = $fetch['Sgst'];
								$Igst = $fetch['Igst'];
								$Net_Amount = $fetch['Net_Amount'];
								$Net_Total = $fetch['Net_Total'];
								$Total = $fetch['Total'];
								$Discount = $fetch['Discount'];
								$tid = $fetch['tid'];
								$prod_cgst = $fetch['prod_cgst'];
								$prod_sgst = $fetch['prod_sgst'];
								 if($i==1) { 
							?>
							<tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_2_1" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_2[]" id="product_5" value="<?php echo $tid; ?>" readonly></td>
								<td><input type="text" name="quantity_s_2[]" onchange="addrow2_1(this.value);" id="quantity_2_1" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td><input type="text" name="rate_s_2[]" id="rate_2_1" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td><input type="text" name="amount_s_2[]" id="amount_2_1" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td><input type="text" name="cgst_s_2[]" id="cgst_2_1" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="cgst_2[]" id="prod_cgst_2_1" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="sgst_s_2[]" id="sgst_2_1" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="sgst_2[]" id="prod_sgst_2_1" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="igst_s_2[]" id="igst_2_1" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="netamount_s_2[]" id="netamount_2_1" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								 <?php 
								 }
								  if($i==2) { 
								 ?>
								 <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_2_2" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_2[]" id="product_5" value="<?php echo $tid; ?>" ></td>
								<td style="width: 100px;"><input type="text" name="quantity_s_2[]" id="quantity_2_2" onchange="addrow2_2(this.value);" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s_2[]" id="rate_2_2" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s_2[]" id="amount_2_2" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s_2[]" id="cgst_2_2" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_2" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s_2[]" id="sgst_2_2" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_2" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s_2[]" id="igst_2_2" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s_2[]" id="netamount_2_2" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								  <?php } if($i==3) { ?>
								   <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_2_3" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_2[]" id="product_5" value="<?php echo $tid; ?>"></td>
								<td ><input type="text" name="quantity_s_2[]" style="width: 100px;" onchange="addrow2_3(this.value);" id="quantity_2_3" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s_2[]" id="rate_2_3" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s_2[]" id="amount_2_3" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s_2[]" id="cgst_2_3" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_3" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s_2[]" id="sgst_2_3" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_3" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s_2[]" id="igst_2_3" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s_2[]" id="netamount_2_3" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
							<?php
								  }
								  $i++;
							}
						?>
						</tbody>
						
					</table>
					<script>
						function addrow2_1()
							{
						       
								var rate = parseFloat(document.getElementById("rate_2_1").value);
								var quantity = parseFloat(document.getElementById("quantity_2_1").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_2_1").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_2_1").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_2").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_2_1").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_2_1').val(net_amount);
								$('#amount_2_1').val(amount);
								$('#cgst_2_1').val(cgst_1);
								$('#sgst_2_1').val(sgst_1);
								
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_2').val(netamount_ovrall_ovr);
								$('#net_total_2').val(netamount_ovrall_ovr);
							}
							
							
							function addrow2_2()
							{
						       
								var rate = parseFloat(document.getElementById("rate_2_2").value);
								
								var quantity = parseFloat(document.getElementById("quantity_2_2").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_2_2").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_2_2").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_2").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_2_2").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_2_2').val(net_amount);
								$('#amount_2_2').val(amount);
								$('#cgst_2_2').val(cgst_1);
								$('#sgst_2_2').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_2').val(netamount_ovrall_ovr);
								$('#net_total_2').val(netamount_ovrall_ovr);
							}
							
							function addrow2_3()
							{
						       
								var rate = parseFloat(document.getElementById("rate_2_3").value);
								
								var quantity = parseFloat(document.getElementById("quantity_2_3").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_2_3").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_2_3").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_2").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_2_3").value);
								var units = "";
								if(units == ""){
								var ori_quantity = quantity;
								var amount = ori_quantity * rate;
								} else {
								var ori_quantity = (quantity * units).toFixed(2);
								var amount = (ori_quantity * rate).toFixed(2);
								}
								
								var cgst_1 = parseFloat(amount *(cgst/100)).toFixed(2);
								var sgst_1 = parseFloat(amount *(sgst/100)).toFixed(2);
								
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
								$('#netamount_2_3').val(net_amount);
								$('#amount_2_3').val(amount);
								$('#cgst_2_3').val(cgst_1);
								$('#sgst_2_3').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_2').val(netamount_ovrall_ovr);
								$('#net_total_2').val(netamount_ovrall_ovr);
							}
						</script>
					<table class="i_tbl" style="float:right;">
					<style>
					.i_tbl tr {    border-bottom: 0px solid #dedede; }
						.i_tbl td, th {
							padding: 10px 8px; 
						}
					</style>
					<tr>
								<td colspan='7'><b>Total</b></td>
								
								<td><input type="text" name="netamount_s_2[]" id="netamount_ovr_2" value="<?php echo $Total; ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Discount</b></td>
								
								<td><input type="text" name="discount_s_2[]" id="discount_s" value="<?php echo $Discount ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Net Total</b></td>
								
								<td><input type="text" name="net_total_2[]" id="net_total_2" value="<?php echo $Net_Total ?>" readonly></td>
						
							</tr>
							</table>
				
	
	<div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Purchase Order No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="order_no_3" id="grn" onchange="get_purchase_order2(this.value);" data-live-search="true">
						 <option value="">Select Purchase Order No</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_purchase_order WHERE Status='Active' AND Supplier_Name='$Supplier_Name' group by Order_No");
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
						  
						  
<?php 
  
} 

?>
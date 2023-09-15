<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$product_id = $_REQUEST['product_id'];
$product_id_det = $_REQUEST['product_id_det'];

if(!empty($product_id_det)) {
	
	                $qury="select SUM(Quantity) as purchase_quantity from tbl_purchase where Status='Active' AND Product_Id='$product_id_det' group by Invoice_No";
					$qury_exe=mysqli_query($con,$qury);
					$fetch=mysqli_fetch_array($qury_exe);
					$purchase_quantity = $fetch['purchase_quantity'];
	
	                $qury_pend="select SUM(Quantity) as sales_quantity from tbl_sales where Status='Active' AND Product_Id='$product_id_det' group by Invoice_No";
					$qury_pend=mysqli_query($con,$qury_pend);
					$fetch_pend=mysqli_fetch_array($qury_pend);
					$sales_quantity = $fetch_pend['sales_quantity'];
					
					if($sales_quantity=='') {
						$quantity_pend =0;
					} else {
						$quantity_pend  =$sales_quantity;
					}
					 $quantity = $purchase_quantity - $quantity_pend;
	
	?>
		<div class="form-group col-sm-4">        
					   <label for="inputName" class="col-sm-4 control-label">Available Count<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo $quantity;?>"  name="pend" id="pend"  required>
						  </div>
	 </div>
<?php 
  
}
if(!empty($supplier_id))
{
	?>


<div class="col-sm-12" >	
    <table id="mytable" border="1">
       <thead>
	  <tr>
            <th>Invoice No</th>
            <th>Total Amount</th>
            <th>Already Paid Amount</th>
            <th>Pending Amount</th>
            <th>Payment Amount</th>
        </tr>
		  </thead>
		 <tbody>
					<?php 
				    $qury="select * from tbl_purchase where Supplier_Name='$supplier_id' group by Invoice_No";
					$qury_exe=mysqli_query($con,$qury);
					$i=1;
					$pending_received_amount=0;
					$paid_amount=0;
					while($fetch=mysqli_fetch_array($qury_exe))
					{	
				
				    $Invoice_No=$fetch['Invoice_No'];
				    $Net_Total=$fetch['Net_Total'];
				    $Product_Id=$fetch['Product_Id'];
					
					$qurydelct="select SUM(Purchase_Wise_Amount) as paid_amount from tbl_payment where Status='Active' AND Invoice_No_Purchase='$Invoice_No'";
					$qury_det=mysqli_query($con,$qurydelct);
					$fetch_det=mysqli_fetch_array($qury_det);
					$paid_amount_1 = $fetch_det['paid_amount'];
					
					if($paid_amount_1=='') {
						$paid_amount =0;
					} else {
						$paid_amount  =$paid_amount_1;
					}
					 $pending_amount = $Net_Total - $paid_amount;
			
			       // $rec_amount_1 = $rec_amount - $Net_Total;
					
					if($pending_received_amount ==0) {
						if($rec_amount==$pending_amount) {
							$rec_amount_1 = $pending_amount;
							$pending_received_amount = -1;
							$payment_status = "Yes";
						} else if($rec_amount > $pending_amount) {
							$rec_amount_1 = $pending_amount;
							$payment_status = "Yes";
							$pending_received_amount = $rec_amount - $rec_amount_1;
						} else if($rec_amount < $pending_amount){
							$rec_amount_1 = $rec_amount;
							$pending_received_amount = -1;
							$payment_status = "No";
						} 
						} else if($pending_received_amount > 0){
							if($pending_received_amount==$pending_amount) {
							$rec_amount_1 = $pending_amount;
							$payment_status = "Yes";
							$pending_received_amount = 0;
							} 
							else if($pending_received_amount > $pending_amount) {
							$rec_amount_1 = $pending_amount;
							$payment_status = "Yes";
							$pending_received_amount = $rec_amount - $rec_amount_1;
						} else if($pending_received_amount < $pending_amount){
							$rec_amount_1 = $pending_received_amount;
							$pending_received_amount = -1;
							$payment_status = "No";
						} 
						} else {
							$rec_amount_1 =0;
							$pending_received_amount =0;
							$payment_status = "No";
						}
						if($pending_amount !=0) {
					?>
					
            <tr>
			<td> <input type="text" value="<?php echo $Invoice_No; ?>"  name="invoice_no_purchase[]" readonly></td>
			<td><input type="text" value="<?php echo $Net_Total; ?>" id="Amount" name="Amount" readonly></td>
			<td><input type="text" value="<?php echo $paid_amount; ?>" id="paid_amount" name="paid_amount" readonly></td>
			<td><input type="text" value="<?php echo $pending_amount; ?>" id="pending_amount" name="pending_amount" readonly></td>
			<td><input type="text"value="<?php echo $rec_amount_1; ?>" id="rec_amount_1" name="rec_amount_1[]">
			<input type="hidden" value="<?php echo $payment_status; ?>" id="payment_status" name="payment_status[]" readonly></td>
			</tr>
			<?php
						}
			$i++;
			} ?>
			 </tbody>
    </table>
	
	
	</div>
<?php } ?>
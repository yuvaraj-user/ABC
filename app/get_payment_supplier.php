<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$supplier_id = $_REQUEST['supplier_id'];
$supplier_id_det = $_REQUEST['supplier_id_det'];
$rec_amount = $_REQUEST['rec_amount'];
$invoice_no = $_REQUEST['invoice_no'];
$invoice_no_sup = $_REQUEST['invoice_no_sup'];

$Amount = $_REQUEST['Amount'];

if(!empty($supplier_id_det)) {
	
	?>
		<div class="form-group col-sm-4">        
					   <label for="inputName" class="col-sm-4 control-label">Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="invoice_no" id="invoice_no" onchange="get_pending_invoice(this.value);" data-live-search="true"  required >
						 <option value="">Select Invoice No</option>
						 <option value="on_account">On Account</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_purchase WHERE Status='Active' AND Supplier_Name='$supplier_id_det' GROUP BY Invoice_No");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Invoice_No=$fetch_GrpQry['Invoice_No'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Invoice_No;?>"><?php echo $Invoice_No; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
	 </div>
	 	
	 
<?php 
  
} if(!empty($invoice_no)) {

	                $qury="select SUM(Net_Amount) as need_amt from tbl_purchase where Invoice_No='$invoice_no'";
					$qury_exe=mysqli_query($con,$qury);
					$fetch=mysqli_fetch_array($qury_exe);
					$need_amt = $fetch['need_amt'];
	
	                $qury_pend="select SUM(Purchase_Wise_Amount) as paid_amount from tbl_payment where Status='Active' AND Invoice_No_Purchase='$invoice_no'";
					$qury_pend=mysqli_query($con,$qury_pend);
					$fetch_pend=mysqli_fetch_array($qury_pend);
					$paid_amount_1_pend = $fetch_pend['paid_amount'];
					
					if($paid_amount_1_pend=='') {
						$paid_amount_pend =0;
					} else {
						$paid_amount_pend  =$paid_amount_1_pend;
					}
					 $pending_amount_pend = $need_amt - $paid_amount_pend;

?>

<div class="row">
		<div class="form-group col-sm-4">        
			   <label for="inputName" class="col-sm-4 control-label">Pending Amount</label>
				<div class="col-sm-8">
				<input class="form-control dp"  value="<?php echo $pending_amount_pend;?>"  name="pend" id="pend"  required>
				  </div>
	 </div>
 <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Payment Amount<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8">
							<input type="text" placeholder="Payment_Amount" maxlength="15" id="Amount" class="form-control limited" onchange="get_supplier(this.value);"  name="Payment_Amount" required>
						</div>
						</div>
						 <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Voucher No</label>
						 <div class="col-sm-8">
							<input type="text" id="voucher_no" class="form-control limited" name="voucher_no">
						</div>
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
				    $qury="select * from tbl_purchase where Invoice_No='$invoice_no_sup' and Status='Active' GROUP BY Invoice_No";
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
							$rec_amount_1=0;
							$pending_received_amount=-1;
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
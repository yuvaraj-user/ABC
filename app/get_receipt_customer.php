<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$customer_id = $_REQUEST['customer_id'];
$customer_id_det = $_REQUEST['customer_id_det'];
$invoice_no_cus = $_REQUEST['invoice_no_cus'];
$rec_amount = $_REQUEST['rec_amount'];
 $invoice_no = $_REQUEST['invoice_no'];
if(!empty($customer_id_det)) {

             

?>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<div class="form-group col-sm-4">        
  <label for="inputName" class="col-sm-4 control-label">Sale Order No<font color="red">&nbsp;*&nbsp;</font></label>
<div class="col-sm-8" style="margin-left: 0px;">	
<select class="form-control selectpicker" name="Invoice_No" id="Invoice_No" onchange="get_pending_invoice(this.value);" data-live-search="true"  required >
<option value="">Select Sale Order No</option>
<?php 
$select_GrpQry=mysqli_query($con,"select s.* from tbl_sales_order s left join tbl_lead l on s.Lead_Id=l.Id WHERE s.Status='Active' AND l.Customer_Id='$customer_id_det'");
while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
{
$Invoice_No=$fetch_GrpQry['Sale_Order_No'];
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

     $qurydelct_lead_id="select Lead_Id from tbl_sales_order where Status='Active' AND Sale_Order_No='$invoice_no'";
     $qury_det_lead_id=mysqli_query($con,$qurydelct_lead_id);
     $fetch_det_lead_id=mysqli_fetch_array($qury_det_lead_id);
     $lead_id = $fetch_det_lead_id['Lead_Id'];

            $select_paid = mysqli_query($con, "select SUM(Total_Amount) as sid from tbl_receipts WHERE Status='Active' AND Lead_Id='$lead_id'");
            $fetch_sid = mysqli_fetch_array($select_paid);
            $paid = $fetch_sid['sid'];
			
			$select_pend = mysqli_query($con, "select SUM(Rate) as sid from tbl_lead_products WHERE Status='Active' AND Lead_Id='$lead_id'");
            $select_pend = mysqli_fetch_array($select_pend);
            $tot_amt = $select_pend['sid'];

if($paid=='') {
$paid_amount_pend =0;
} else {
$paid_amount_pend  =$paid;
}
$pending_amount_pend = $tot_amt - $paid_amount_pend;

?>

<div class="row">
<div class="form-group col-sm-4">        
  <label for="inputName" class="col-sm-4 control-label">Pending Amount</label>
<div class="col-sm-8">
<input class="form-control dp"  value="<?php echo $pending_amount_pend;?>"  name="pend" id="pend"  readonly>
<input type="hidden" class="form-control dp"  value="<?php echo $lead_id;?>"  name="lead_id" id="lead_id"  readonly>
 </div>
</div>

  <div class="form-group col-sm-4">
<label for="inputName" class="col-sm-4 control-label">Receipt Amount<font color="red">&nbsp;*&nbsp;</font></label>
<div class="col-sm-8">
<input type="text" placeholder="Payment_Amount" maxlength="15" id="Payment_Amount" class="form-control limited" onchange="get_supplier(this.value);"  name="Payment_Amount" required>
</div>
 </div>
 <div class="form-group col-sm-4">
<label for="inputName" class="col-sm-4 control-label">Voucher No</label>
<div class="col-sm-8">
<input type="text" placeholder="Voucher No" id="voucher_no" class="form-control limited"  name="voucher_no">
</div>
 </div>
</div>

<?php

}
if(!empty($customer_id))
{
?>


<div class="col-sm-12" >	
    <table id="mytable" border="1">
       <thead>
 <tr>
          <tr>
            <th>Invoice No</th>
            <th>Total Amount</th>
            <th>Already Paid Amount</th>
            <th>Pending Amount</th>
            <th>Receipt Amount</th>
        </tr>
        </tr>
 </thead>
<tbody>
<?php 
   $qurydelct_lead_id1="select Lead_Id from tbl_sales_order where Status='Active' AND Sale_Order_No='$invoice_no_cus'";
    $qury_det_lead_id1=mysqli_query($con,$qurydelct_lead_id1);
    $fetch_det_lead_id1=mysqli_fetch_array($qury_det_lead_id1);
    $lead_id_2 = $fetch_det_lead_id1['Lead_Id'];

   $qury="select * from tbl_sales_order where Sale_Order_No='$invoice_no_cus' AND Status='Active'";
$qury_exe=mysqli_query($con,$qury);
$i=1;
$pending_received_amount=0;
while($fetch=mysqli_fetch_array($qury_exe))
{	

 
			
			$select_pend = mysqli_query($con, "select SUM(Rate) as sid from tbl_lead_products WHERE Status='Active' AND Lead_Id='$lead_id_2'");
            $select_pend = mysqli_fetch_array($select_pend);
             $Net_Total = $select_pend['sid'];

$qurydelct="select SUM(Total_Amount) as sid from tbl_receipts WHERE Status='Active' AND Lead_Id='$lead_id_2'";
$qury_det=mysqli_query($con,$qurydelct);
$fetch_det=mysqli_fetch_array($qury_det);
$paid_amount_1 = $fetch_det['sid'];

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
?>

            <tr>
<td> <input type="text" value="<?php echo $Invoice_No; ?>"  name="invoice_no_purchase[]" readonly></td>
<td><input type="text" value="<?php echo $Net_Total; ?>" id="Amount" name="Amount" readonly></td>
<td><input type="text" value="<?php echo $paid_amount; ?>" id="paid_amount" name="paid_amount" readonly></td>
<td><input type="text" value="<?php echo $pending_amount; ?>" id="pending_amount" name="pending_amount" readonly></td>
<td><input type="text"value="<?php echo $rec_amount_1; ?>" id="rec_amount_1" name="rec_amount_1[]">
<input type="hidden" value="<?php echo $payment_status; ?>" id="payment_status" name="payment_status[]" readonly></td>
</tr>
<?php $i++; } ?>
</tbody>
    </table>


</div>
<?php } ?>
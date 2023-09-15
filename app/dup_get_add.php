<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
 $(document).on('click', 'button.deletebtn', function () {
     $(this).closest('tr').remove();
     return false;
 });
});
</script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$cust_id = $_REQUEST['cust_id'];
$inv_no = $_REQUEST['inv_no'];
if(!empty($cust_id)) {

	?>
<div class="form-group col-sm-4">
    <label for="inputName" class="col-sm-4 control-label">Invoice No</label>
    <div class="col-sm-8" style="margin-left: 0px;">
        <select name="inv_no" id="inv_no"  class="form-control selectpicker" data-live-search="true" required >
			<option value="">Invoice No</option>
			<?php 
			$select_GrpQry=mysqli_query($con,"SELECT Invoice_No from tbl_sales WHERE Status='Active' AND  Customer_Id ='$cust_id' GROUP BY Invoice_No");
			while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
			{
				$Name=$fetch_GrpQry['Invoice_No'];
			?>
			<option value="<?php echo $Name;?>"><?php echo $Name; ?></option>
		<?php 
			}
			?>
			</select>
    </div>
</div>
<div class="form-group col-sm-4">
    <input type="button" VALUE="+" id="BTNSUBMIT" onclick="get_products_detail(this.value);"/>
</div>
<?php } 
if(!empty($inv_no)) { ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <?php $d = 1;
        $sql2 = mysqli_query($con,"SELECT e.Id As enq_id,e.Product_Id As stock_name,p.Name as prod_name,e.Quantity,e.Rate,e.Net_Amount,(e.Cgst + e.Sgst) As gst,e.Date,e.Invoice_No from tbl_sales e left join tbl_product p ON e.Product_Id=p.Id where e.Invoice_No='$inv_no' And e.Status='Active'");
        while($row2 = mysqli_fetch_array($sql2)){	
		?>
    <script type="text/javascript">
        $(document).ready(function(){
        var markup = "<tr><td><input type='hidden' name='e_id[]' value='<?php echo $row2['enq_id']; ?>' id='e_id<?php echo $d; ?>' readonly/><input type='hidden' name='p_id[]' value='<?php echo $row2['stock_name']; ?>' id='p_id<?php echo $d; ?>' readonly/><input type='text' name='item<?php echo $d; ?>' value='<?php echo $row2['prod_name']; ?>' id='item<?php echo $d; ?>' readonly/></td><td><input type='text' name='quty[]' value='<?php echo $row2['Quantity']; ?>' id='quty<?php echo $d; ?>'  style='width: 60px' readonly/></td><td><input type='text' name='sell[]' value='<?php echo $row2['Rate']; ?>'  id='sell<?php echo $d; ?>' style='width: 80px' readonly/></td><td><input type='text' name='gst_amt[]' value='<?php echo $row2['gst']; ?>' id='gst_amt<?php echo $d; ?>' class='receiveamt' style='width: 100px' readonly/></td><td><input type='text' name='n_amt[]' value='<?php echo $row2['Net_Amount']; ?>' id='n_amt<?php echo $d; ?>' class='receiveamt' style='width: 100px' readonly/></td><td><input type='text' name='dat[]' value='<?php echo $row2['Date']; ?>'  id='dat<?php echo $d; ?>'  style='width: 100px' readonly/></td><td><input type='text' name='inv[]' value='<?php echo $row2['Invoice_No']; ?>' id='inv<?php echo $d; ?>' style='width: 90px' readonly/></td><td><input type='text' name='remark[]' id='remark<?php echo $d; ?>' style='width: 90px' required/></td><td><button type='button' class='deletebtn' title='Remove row'>Remove</button></td></tr>";
        $("table tbody").append(markup);
    });
</script> 
<?php $d++; } ?>
<?php } ?>
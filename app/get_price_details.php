<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$product_id = $_REQUEST['product_id'];
if(!empty($product_id)) {
	
    $return_qty = 0;
    $sales_qty = 0;
    $overall_qty = 0;
    $sales_return_qty = 0;
    
    $qury_rate="select Selling_Rate from tbl_product where Id='$product_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
	?>
	 <div class="form-group col-sm-3">
        <label for="inputName" class="col-sm-4 control-label">Rate</label>
            <div class="col-sm-8">
            <input type="text" maxlength="15" value="<?php echo $rate; ?>" id="rate" class="form-control limited" name="rate">
            </div>
        </div>
	 <div class="form-group col-sm-3">
        <label for="inputName" class="col-sm-3 control-label">Dis.Amt</label>
            <div class="col-sm-5">
                <input type="text" maxlength="15" value="0" id="dis_amt" class="form-control limited" name="dis_amt">
            </div>
            <div class="col-sm-4">
                <input type="button" VALUE="+" id="BTNSUBMIT" onclick="addrow()"/>
            </div>
        </div>
<?php } ?>
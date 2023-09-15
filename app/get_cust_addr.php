<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$cust_id = $_REQUEST['cust_id'];
if(!empty($cust_id)) {

    $qury_rate="select Address_Line1,Address_Line2,Address_Line3,Address_Line4 from tbl_customer where Id='$cust_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $adress = $fetch_rate['Address_Line1'].' , '.$fetch_rate['Address_Line2'].' , '.$fetch_rate['Address_Line3'].' , '.$fetch_rate['Address_Line4'];
	?>
	<div class="form-group col-sm-4">
	<label for="inputName" class="col-sm-4 control-label">Address</label>
		<div class="col-sm-8">
			<textarea type="text"  class="form-control limited" readonly><?php echo $adress; ?></textarea>
		</div>
	</div>
<?php } ?>
<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);
$Emp_tbl_Id=$fetchlevel['Emp_tbl_Id'];


if(isset($_REQUEST['submit']))
{
	$customer = $_REQUEST['customer'];
	$enq_date = strtotime($_REQUEST['enq_date']);
	$enq_dates = date('Y-m-d',$enq_date);
	$load_amt = $_REQUEST['load_amt'];
	$frieght_amt = $_REQUEST['frieght_amt'];
	$createdby = $_REQUEST['created_by'];
	$net_total = $_REQUEST['net_total'];
	$total = $_REQUEST['total'];
	$follow_by = $_REQUEST['follow_by'];
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	// $createdby=$_SESSION['usersessionid'];
	
	
	$product_s = array();
	$quantity_s = array();
	$rate_s = array();
	$amount_s = array();
	$cgst_s = array();
	$sgst_s = array();
	$igst_s = array();
	$netamount_s = array();
	
	
	$product_s = $_REQUEST['product_s'];
	$quantity_s = $_REQUEST['quantity_s'];
	$rate_s = $_REQUEST['rate_s'];
	$amount_s = $_REQUEST['amount_s'];
	$dis_amt_s = $_REQUEST['dis_amt_s'];
	$cgst_s = $_REQUEST['cgst_s'];
	$sgst_s = $_REQUEST['sgst_s'];
	$igst_s = $_REQUEST['igst_s'];
	$netamount_s = $_REQUEST['netamount_s'];
	
	$selectlevel = mysqli_query($con,"select Max(Enquiry_No) As Enqu_id from tbl_equiry");
	$fetchlevel = mysqli_fetch_array($selectlevel);
	$enquiry_no = $fetchlevel['Enqu_id'] + 1;
	for($i=0;$i<sizeof($product_s);$i++){
		$product_sd = $product_s[$i];
		$quantity_sd = $quantity_s[$i];
		$rate_sd = $rate_s[$i];
		$amount_sd = $amount_s[$i];
		$dis_amt_sd = $dis_amt_s[$i];
		$cgst_sd = $cgst_s[$i];
		$sgst_sd = $sgst_s[$i];
		$igst_sd = $igst_s[$i];
		$netamount_sd = $netamount_s[$i];
		if($netamount_sd !=0) {
			$insert_details = mysqli_query($con,"INSERT INTO `tbl_equiry`(`Customer_Id`,`Enquiry_No`, `Date`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount_amt`, `load_unload_amt`, `Frieght_Amt`,`Net_Total`, `Created_By`, `Status`,`Follow_By`,`count1`) VALUES ('$customer','$enquiry_no','$enq_dates','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','$igst_sd','$netamount_sd','$total','$dis_amt_sd','$load_amt','$frieght_amt','$net_total','$createdby','$status','$follow_by','$i')");
		$j++;
		}
	}
	if($insert_details){
		echo '<script type="text/javascript">
			window.location.replace("view_enquiry.php?step=suces");
			</script>';
		}else{
		 echo '<script type="text/javascript">
					window.location.replace("view_enquiry.php?step=fail");
				</script>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Billing </title>
<meta name="author" content="">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script>
	function get_available_quantity(val) {
		var product = val;
		var product_1 = product.split("/");
		var product_id = parseFloat(product_1[0]);
			$.ajax 
			({  
				type: "POST",
				url: "get_price_details.php",
				data:'product_id='+product_id,			 
				success: function(data){
				$("#product_id").html(data); 
				}
			});
			} 
	function get_cust_detail(val) {
			$.ajax 
			({  
				type: "POST",
				url: "get_cust_addr.php",
				data:'cust_id='+val,			 
				success: function(data){
				$("#cust_addr").html(data); 
				}
			});
			}
</script>
        <style>
            .content-wrapper
            {
                padding: 0px 10px !important;
            }
            .panel-header, .panel-body {
                border : none !important;
            }
            .panel-body {
                overflow-x: inherit !important;
                min-height : 420px;
                padding: 34px 10px !important;

            }
            .row.panel.panel-primary {
                background: transparent !important;
                padding-top: 9px;
                min-width: 71px!important;
            }
            .panel-heading{
                margin-bottom : 0px !important;
            }
            .nav-tabs {
                font-size: 15px;
            }
            .modal-dialog {
                color: #000000 !important;
            }
            .panel.panel-warning {
                border: 1px solid #fcf8e3;
            }
            tr{
                border-bottom: 1px solid #dedede;
            }
            .nav-tabs-custom {
                background : transparent;
            }
            .panel-primary>.panel-heading {
                color: #000;
                background-color: #cccccc;
                border-color: #cccccc;
                font-weight: 500;
                font-style: inherit;
            }
            .panel-body
            {
                font-size : 16px !important;
                color: #333;
            }
            ul.dropdown-menu.inner {
                max-height: 159px !important;
            }
            .panel-heading.lead {
                padding-right: 23px;
                padding-left: 23px;
            }


        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'header.php'; ?>
            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="row panel panel-primary">

<div class="panel-heading lead ">
	<div class="row">
		<div class="col-lg-8 col-md-8"><b>Add Enquiry</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_enquiry.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Enquiry</a>
				</div>
			</div>
	</div>
</div>
</div>
<div class="panel-body"> 
	<form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	<div class="row">
		<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Customer</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select name="customer" id="customer"  class="form-control selectpicker" onchange="get_cust_detail(this.value);" data-live-search="true" required >
			<option value="">Select Customer</option>
			<?php 
			$select_GrpQry=mysqli_query($con,"select * from tbl_customer WHERE Status='Active'");
			while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
			{
				$Name=$fetch_GrpQry['Name'];
				$Id=$fetch_GrpQry['Id'];
			?>
			<option value="<?php echo $Id;?>"><?php echo $Name; ?></option>
		<?php 
			}
			?>
			</select>
			</div>
		</div>
			<div id="cust_addr">
			</div>
	<div class="form-group col-sm-4">        
		<label for="inputName" class="col-sm-4 control-label">Enquiry Date</label>
		<div class="col-sm-8">
			<input class="form-control dp"  value="<?php echo date('d-m-Y');?>" name="enq_date" id="acctopendate" required readonly>
			</div>
		</div>
		<div class="form-group col-sm-4">
			<script>
				$(document).ready(function () {
				$('.dp').datepicker({
					format: "dd-mm-yyyy",
					endDate: '+0d',
					autoclose: true
				});
				$('.dp').on('change', function () {
					$('.datepicker').hide();
				});
					$("#discount").val(0);
					$("#other_charge").val(0);
				});
		</script>					
	</div>
</div>
	<div class="row">    
	<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Product</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select class="form-control selectpicker" name="product" id="product" data-live-search="true" onchange="get_available_quantity(this.value);" required>
			<option value="">Select Product</option>
			<?php 
			$select_GrpQry=mysqli_query($con,"SELECT t.Id as tid,t.Name,t.Cgst,t.Sgst,t.Igst from  tbl_product t  WHERE t.Status='Active'");
			while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
			{
				$Name=$fetch_GrpQry['Name'];
				$tid=$fetch_GrpQry['tid'];
				$Cgst=$fetch_GrpQry['Cgst'];
				$Sgst=$fetch_GrpQry['Sgst'];
				$Igst=$fetch_GrpQry['Igst'];
			?>
			<option value="<?php echo $tid."/".$Cgst."/".$Sgst."/".$Igst."/".$Name; ?>"><?php echo $Name; ?></option>
		<?php 
			}
			?>
			</select>
			</div>
		</div> 
		<div class="form-group col-sm-3">
			<label for="inputName" class="col-sm-4 control-label">Quantity</label>
			<div class="col-sm-8" style="margin-left: 0px;">
				<input type="text" maxlength="15" id="quantity" onKeyUp="avail_check(this.value);" class="form-control limited" maxlength="15" name="quantity">
			</div>
		</div>
			<div id="product_id"> </div>
		</div>
			<script>
			function addrow()
			{
				var quantity = document.getElementById("quantity").value;
				var product = document.getElementById("product").value;
				var product_1 = product.split("/");
				var cgst = parseFloat(product_1[1]);
				var sgst = parseFloat(product_1[2]);
				var igst = parseFloat(product_1[3]);
				var rate = parseFloat(document.getElementById("rate").value);
				var dis_amt = parseFloat(document.getElementById("dis_amt").value);
				var amount  = quantity * rate;
				var gst_amt = (rate * (cgst / 100));
				var total_amt = quantity * gst_amt;
				var cgst = total_amt;
				var sgst = total_amt;
				var igst = cgst + sgst;
				var net_amount = amount + cgst + sgst - dis_amt;
				var table = document.getElementById("mytable");
				var row = table.insertRow(1);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				var cell7 = row.insertCell(6);
				var cell8 = row.insertCell(7);
				var cell9 = row.insertCell(8);
				cell1.innerHTML = product_1[4];
				cell2.innerHTML = quantity;
				cell3.innerHTML = rate;
				cell4.innerHTML = amount;
				cell5.innerHTML = dis_amt;
				cell6.innerHTML = cgst;
				cell7.innerHTML = sgst;
				cell8.innerHTML = igst;
				cell9.innerHTML = net_amount;
								
				var i_value = document.getElementById("i_value").value;
				
				if(i_value =='') {
					i_value = 1;
				} else {
					i_value = parseFloat(i_value)+1;
				}
				$("#i_value").val(i_value);
				
				if(i_value ==1) {
					$("#product_1").val(product_1[0]);
					$("#quantity_1").val(quantity);
					$("#rate_1").val(rate);
					$("#amount_1").val(amount);
					$("#cgst_1").val(cgst);
					$("#sgst_1").val(sgst);
					$("#igst_1").val(igst);
					$("#netamount_1").val(net_amount);
					$("#dis_amt_1").val(dis_amt);
				} else if(i_value ==2) {
					$("#product_2").val(product_1[0]);
					$("#quantity_2").val(quantity);
					$("#rate_2").val(rate);
					$("#amount_2").val(amount);
					$("#cgst_2").val(cgst);	
					$("#sgst_2").val(sgst);
					$("#igst_2").val(igst);
					$("#netamount_2").val(net_amount);
					$("#dis_amt_2").val(dis_amt);
				} else if(i_value ==3) {
					$("#product_3").val(product_1[0]);
					$("#quantity_3").val(quantity);
					$("#rate_3").val(rate);
					$("#amount_3").val(amount);
					$("#cgst_3").val(cgst);	
					$("#sgst_3").val(sgst);
					$("#igst_3").val(igst);
					$("#netamount_3").val(net_amount);
					$("#dis_amt_3").val(dis_amt);
				} else if(i_value ==4) {
					$("#product_4").val(product_1[0]);
					$("#quantity_4").val(quantity);
					$("#rate_4").val(rate);
					$("#amount_4").val(amount);
					$("#cgst_4").val(cgst);	
					$("#sgst_4").val(sgst);
					$("#igst_4").val(igst);
					$("#netamount_4").val(net_amount);
					$("#dis_amt_4").val(dis_amt);
				} else if(i_value ==5) {
					$("#product_5").val(product_1[0]);
					$("#quantity_5").val(quantity);
					$("#rate_5").val(rate);
					$("#amount_5").val(amount);
					$("#cgst_5").val(cgst);	
					$("#sgst_5").val(sgst);
					$("#igst_5").val(igst);
					$("#netamount_5").val(net_amount);
					$("#dis_amt_5").val(dis_amt);	
				} else if(i_value ==6) {
					$("#product_6").val(product_1[0]);
					$("#quantity_6").val(quantity);
					$("#rate_6").val(rate);
					$("#amount_6").val(amount);
					$("#cgst_6").val(cgst);	
					$("#sgst_6").val(sgst);
					$("#igst_6").val(igst);
					$("#netamount_6").val(net_amount);
					$("#dis_amt_6").val(dis_amt);
				} else if(i_value ==7) {
					$("#product_7").val(product_1[0]);
					$("#quantity_7").val(quantity);
					$("#rate_7").val(rate);
					$("#amount_7").val(amount);
					$("#cgst_7").val(cgst);	
					$("#sgst_7").val(sgst);
					$("#igst_7").val(igst);
					$("#netamount_7").val(net_amount);
					$("#dis_amt_7").val(dis_amt);
				} else if(i_value ==8) {
					$("#product_8").val(product_1[0]);
					$("#quantity_8").val(quantity);
					$("#rate_8").val(rate);
					$("#amount_8").val(amount);
					$("#cgst_8").val(cgst);	
					$("#sgst_8").val(sgst);
					$("#igst_8").val(igst);
					$("#netamount_8").val(net_amount);
					$("#dis_amt_8").val(dis_amt);
				} else if(i_value ==9) {
					$("#product_9").val(product_1[0]);
					$("#quantity_9").val(quantity);
					$("#rate_9").val(rate);
					$("#amount_9").val(amount);
					$("#cgst_9").val(cgst);	
					$("#sgst_9").val(sgst);
					$("#igst_9").val(igst);
					$("#netamount_9").val(net_amount);
					$("#dis_amt_9").val(dis_amt);
				} else if(i_value ==10) {
					$("#product_10").val(product_1[0]);
					$("#quantity_10").val(quantity);
					$("#rate_10").val(rate);
					$("#amount_10").val(amount);
					$("#cgst_10").val(cgst);	
					$("#sgst_10").val(sgst);
					$("#igst_10").val(igst);
					$("#netamount_10").val(net_amount);
					$("#dis_amt_10").val(dis_amt);
				} else if(i_value ==11) {
					$("#product_11").val(product_1[0]);
					$("#quantity_11").val(quantity);
					$("#rate_11").val(rate);
					$("#amount_11").val(amount);
					$("#cgst_11").val(cgst);	
					$("#sgst_11").val(sgst);
					$("#igst_11").val(igst);
					$("#netamount_11").val(net_amount);
					$("#dis_amt_11").val(dis_amt);
				} else if(i_value ==12) {
					$("#product_12").val(product_1[0]);
					$("#quantity_12").val(quantity);
					$("#rate_12").val(rate);
					$("#amount_12").val(amount);
					$("#cgst_12").val(cgst);	
					$("#sgst_12").val(sgst);
					$("#igst_12").val(igst);
					$("#netamount_12").val(net_amount);
					$("#dis_amt_12").val(dis_amt);
				} else if(i_value ==13) {
					$("#product_13").val(product_1[0]);
					$("#quantity_13").val(quantity);
					$("#rate_13").val(rate);
					$("#amount_13").val(amount);
					$("#cgst_13").val(cgst);	
					$("#sgst_13").val(sgst);
					$("#igst_13").val(igst);
					$("#netamount_13").val(net_amount);
					$("#dis_amt_13").val(dis_amt);
				} else if(i_value ==14) {
					$("#product_14").val(product_1[0]);
					$("#quantity_14").val(quantity);
					$("#rate_14").val(rate);
					$("#amount_14").val(amount);
					$("#cgst_14").val(cgst);	
					$("#sgst_14").val(sgst);
					$("#igst_14").val(igst);
					$("#netamount_14").val(net_amount);
					$("#dis_amt_14").val(dis_amt);
				} else if(i_value ==15) {
					$("#product_15").val(product_1[0]);
					$("#quantity_15").val(quantity);
					$("#rate_15").val(rate);
					$("#amount_15").val(amount);
					$("#cgst_15").val(cgst);	
					$("#sgst_15").val(sgst);
					$("#igst_15").val(igst);
					$("#netamount_15").val(net_amount);
					$("#dis_amt_15").val(dis_amt);
				} else if(i_value ==16) {
					$("#product_16").val(product_1[0]);
					$("#quantity_16").val(quantity);
					$("#rate_16").val(rate);
					$("#amount_16").val(amount);
					$("#cgst_16").val(cgst);	
					$("#sgst_16").val(sgst);
					$("#igst_16").val(igst);
					$("#netamount_16").val(net_amount);
					$("#dis_amt_16").val(dis_amt);
				} else if(i_value ==17) {
					$("#product_17").val(product_1[0]);
					$("#quantity_17").val(quantity);
					$("#rate_17").val(rate);
					$("#amount_17").val(amount);
					$("#cgst_17").val(cgst);	
					$("#sgst_17").val(sgst);
					$("#igst_17").val(igst);
					$("#netamount_17").val(net_amount);
					$("#dis_amt_17").val(dis_amt);
				} else if(i_value ==18) {
					$("#product_18").val(product_1[0]);
					$("#quantity_18").val(quantity);
					$("#rate_18").val(rate);
					$("#amount_18").val(amount);
					$("#cgst_18").val(cgst);	
					$("#sgst_18").val(sgst);
					$("#igst_18").val(igst);
					$("#netamount_18").val(net_amount);
					$("#dis_amt_18").val(dis_amt);
				} else if(i_value ==19) {
					$("#product_19").val(product_1[0]);
					$("#quantity_19").val(quantity);
					$("#rate_19").val(rate);
					$("#amount_19").val(amount);
					$("#cgst_19").val(cgst);	
					$("#sgst_19").val(sgst);
					$("#igst_19").val(igst);
					$("#netamount_19").val(net_amount);
					$("#dis_amt_19").val(dis_amt);
				} else if(i_value ==20) {
					$("#product_20").val(product_1[0]);
					$("#quantity_20").val(quantity);
					$("#rate_20").val(rate);
					$("#amount_20").val(amount);
					$("#cgst_20").val(cgst);	
					$("#sgst_20").val(sgst);
					$("#igst_20").val(igst);
					$("#netamount_20").val(net_amount);
					$("#dis_amt_20").val(dis_amt);
				} else if(i_value ==21) {
					$("#product_21").val(product_1[0]);
					$("#quantity_21").val(quantity);
					$("#rate_21").val(rate);
					$("#amount_21").val(amount);
					$("#cgst_21").val(cgst);	
					$("#sgst_21").val(sgst);
					$("#igst_21").val(igst);
					$("#netamount_21").val(net_amount);
					$("#dis_amt_21").val(dis_amt);
				} else if(i_value ==22) {
					$("#product_22").val(product_1[0]);
					$("#quantity_22").val(quantity);
					$("#rate_22").val(rate);
					$("#amount_22").val(amount);
					$("#cgst_22").val(cgst);	
					$("#sgst_22").val(sgst);
					$("#igst_22").val(igst);
					$("#netamount_22").val(net_amount);
					$("#dis_amt_22").val(dis_amt);
				} else if(i_value ==23) {
					$("#product_23").val(product_1[0]);
					$("#quantity_23").val(quantity);
					$("#rate_23").val(rate);
					$("#amount_23").val(amount);
					$("#cgst_23").val(cgst);	
					$("#sgst_23").val(sgst);
					$("#igst_23").val(igst);
					$("#netamount_23").val(net_amount);
					$("#dis_amt_23").val(dis_amt);
				} else if(i_value ==24) {
					$("#product_24").val(product_1[0]);
					$("#quantity_24").val(quantity);
					$("#rate_24").val(rate);
					$("#amount_24").val(amount);
					$("#cgst_24").val(cgst);	
					$("#sgst_24").val(sgst);
					$("#igst_24").val(igst);
					$("#netamount_24").val(net_amount);
					$("#dis_amt_24").val(dis_amt);
				} else if(i_value ==25) {
					$("#product_25").val(product_1[0]);
					$("#quantity_25").val(quantity);
					$("#rate_25").val(rate);
					$("#amount_25").val(amount);
					$("#cgst_25").val(cgst);	
					$("#sgst_25").val(sgst);
					$("#igst_25").val(igst);
					$("#netamount_25").val(net_amount);
					$("#dis_amt_25").val(dis_amt);
				} else if(i_value ==26) {
					$("#product_26").val(product_1[0]);
					$("#quantity_26").val(quantity);
					$("#rate_26").val(rate);
					$("#amount_26").val(amount);
					$("#cgst_26").val(cgst);	
					$("#sgst_26").val(sgst);
					$("#igst_26").val(igst);
					$("#netamount_26").val(net_amount);
					$("#dis_amt_26").val(dis_amt);
				} else if(i_value ==27) {
					$("#product_27").val(product_1[0]);
					$("#quantity_27").val(quantity);
					$("#rate_27").val(rate);
					$("#amount_27").val(amount);
					$("#cgst_27").val(cgst);	
					$("#sgst_27").val(sgst);
					$("#igst_27").val(igst);
					$("#netamount_27").val(net_amount);
					$("#dis_amt_27").val(dis_amt);
				} else if(i_value ==28) {
					$("#product_28").val(product_1[0]);
					$("#quantity_28").val(quantity);
					$("#rate_28").val(rate);
					$("#amount_28").val(amount);
					$("#cgst_28").val(cgst);	
					$("#sgst_28").val(sgst);
					$("#igst_28").val(igst);
					$("#netamount_28").val(net_amount);
					$("#dis_amt_28").val(dis_amt);
				} else if(i_value ==29) {
					$("#product_29").val(product_1[0]);
					$("#quantity_29").val(quantity);
					$("#rate_29").val(rate);
					$("#amount_29").val(amount);
					$("#cgst_29").val(cgst);	
					$("#sgst_29").val(sgst);
					$("#igst_29").val(igst);
					$("#netamount_29").val(net_amount);
					$("#dis_amt_29").val(dis_amt);
				} else if(i_value ==30) {
					$("#product_30").val(product_1[0]);
					$("#quantity_30").val(quantity);
					$("#rate_30").val(rate);
					$("#amount_30").val(amount);
					$("#cgst_30").val(cgst);	
					$("#sgst_30").val(sgst);
					$("#igst_30").val(igst);
					$("#netamount_30").val(net_amount);
					$("#dis_amt_30").val(dis_amt);
				} else if(i_value ==31) {
					$("#product_31").val(product_1[0]);
					$("#quantity_31").val(quantity);
					$("#rate_31").val(rate);
					$("#amount_31").val(amount);
					$("#cgst_31").val(cgst);	
					$("#sgst_31").val(sgst);
					$("#igst_31").val(igst);
					$("#netamount_31").val(net_amount);
					$("#dis_amt_31").val(dis_amt);
				} else if(i_value ==32) {
					$("#product_32").val(product_1[0]);
					$("#quantity_32").val(quantity);
					$("#rate_32").val(rate);
					$("#amount_32").val(amount);
					$("#cgst_32").val(cgst);	
					$("#sgst_32").val(sgst);
					$("#igst_32").val(igst);
					$("#netamount_32").val(net_amount);
					$("#dis_amt_32").val(dis_amt);
				} else if(i_value ==33) {
					$("#product_33").val(product_1[0]);
					$("#quantity_33").val(quantity);
					$("#rate_33").val(rate);
					$("#amount_33").val(amount);
					$("#cgst_33").val(cgst);	
					$("#sgst_33").val(sgst);
					$("#igst_33").val(igst);
					$("#netamount_33").val(net_amount);
					$("#dis_amt_33").val(dis_amt);
				} else if(i_value ==34) {
					$("#product_34").val(product_1[0]);
					$("#quantity_34").val(quantity);
					$("#rate_34").val(rate);
					$("#amount_34").val(amount);
					$("#cgst_34").val(cgst);	
					$("#sgst_34").val(sgst);
					$("#igst_34").val(igst);
					$("#netamount_34").val(net_amount);
					$("#dis_amt_34").val(dis_amt);
				} else if(i_value ==35) {
					$("#product_35").val(product_1[0]);
					$("#quantity_35").val(quantity);
					$("#rate_35").val(rate);
					$("#amount_35").val(amount);
					$("#cgst_35").val(cgst);	
					$("#sgst_35").val(sgst);
					$("#igst_35").val(igst);
					$("#netamount_35").val(net_amount);
					$("#dis_amt_35").val(dis_amt);
				} else if(i_value ==36) {
					$("#product_36").val(product_1[0]);
					$("#quantity_36").val(quantity);
					$("#rate_36").val(rate);
					$("#amount_36").val(amount);
					$("#cgst_36").val(cgst);	
					$("#sgst_36").val(sgst);
					$("#igst_36").val(igst);
					$("#netamount_36").val(net_amount);
					$("#dis_amt_36").val(dis_amt);
				} else if(i_value ==37) {
					$("#product_37").val(product_1[0]);
					$("#quantity_37").val(quantity);
					$("#rate_37").val(rate);
					$("#amount_37").val(amount);
					$("#cgst_37").val(cgst);	
					$("#sgst_37").val(sgst);
					$("#igst_37").val(igst);
					$("#netamount_37").val(net_amount);
					$("#dis_amt_37").val(dis_amt);
				} else if(i_value ==38) {
					$("#product_38").val(product_1[0]);
					$("#quantity_38").val(quantity);
					$("#rate_38").val(rate);
					$("#amount_38").val(amount);
					$("#cgst_38").val(cgst);	
					$("#sgst_38").val(sgst);
					$("#igst_38").val(igst);
					$("#netamount_38").val(net_amount);
					$("#dis_amt_38").val(dis_amt);
				} else if(i_value ==39) {
					$("#product_39").val(product_1[0]);
					$("#quantity_39").val(quantity);
					$("#rate_39").val(rate);
					$("#amount_39").val(amount);
					$("#cgst_39").val(cgst);	
					$("#sgst_39").val(sgst);
					$("#igst_39").val(igst);
					$("#netamount_39").val(net_amount);
					$("#dis_amt_39").val(dis_amt);
				} else if(i_value ==40) {
					$("#product_40").val(product_1[0]);
					$("#quantity_40").val(quantity);
					$("#rate_40").val(rate);
					$("#amount_40").val(amount);
					$("#cgst_40").val(cgst);	
					$("#sgst_40").val(sgst);
					$("#igst_40").val(igst);
					$("#netamount_40").val(net_amount);
					$("#dis_amt_40").val(dis_amt);
				} else if(i_value ==41) {
					$("#product_41").val(product_1[0]);
					$("#quantity_41").val(quantity);
					$("#rate_41").val(rate);
					$("#amount_41").val(amount);
					$("#cgst_41").val(cgst);	
					$("#sgst_41").val(sgst);
					$("#igst_41").val(igst);
					$("#netamount_41").val(net_amount);
					$("#dis_amt_41").val(dis_amt);
				} else if(i_value ==42) {
					$("#product_42").val(product_1[0]);
					$("#quantity_42").val(quantity);
					$("#rate_42").val(rate);
					$("#amount_42").val(amount);
					$("#cgst_42").val(cgst);	
					$("#sgst_42").val(sgst);
					$("#igst_42").val(igst);
					$("#netamount_42").val(net_amount);
					$("#dis_amt_42").val(dis_amt);
				} else if(i_value ==43) {
					$("#product_43").val(product_1[0]);
					$("#quantity_43").val(quantity);
					$("#rate_43").val(rate);
					$("#amount_43").val(amount);
					$("#cgst_43").val(cgst);	
					$("#sgst_43").val(sgst);
					$("#igst_43").val(igst);
					$("#netamount_43").val(net_amount);
					$("#dis_amt_43").val(dis_amt);
				} else if(i_value ==44) {
					$("#product_44").val(product_1[0]);
					$("#quantity_44").val(quantity);
					$("#rate_44").val(rate);
					$("#amount_44").val(amount);
					$("#cgst_44").val(cgst);	
					$("#sgst_44").val(sgst);
					$("#igst_44").val(igst);
					$("#netamount_44").val(net_amount);
					$("#dis_amt_44").val(dis_amt);
				} else if(i_value ==45) {
					$("#product_45").val(product_1[0]);
					$("#quantity_45").val(quantity);
					$("#rate_45").val(rate);
					$("#amount_45").val(amount);
					$("#cgst_45").val(cgst);	
					$("#sgst_45").val(sgst);
					$("#igst_45").val(igst);
					$("#netamount_45").val(net_amount);
					$("#dis_amt_45").val(dis_amt);
				} else if(i_value ==46) {
					$("#product_46").val(product_1[0]);
					$("#quantity_46").val(quantity);
					$("#rate_46").val(rate);
					$("#amount_46").val(amount);
					$("#cgst_46").val(cgst);	
					$("#sgst_46").val(sgst);
					$("#igst_46").val(igst);
					$("#netamount_46").val(net_amount);
					$("#dis_amt_46").val(dis_amt);
				} else if(i_value ==47) {
					$("#product_47").val(product_1[0]);
					$("#quantity_47").val(quantity);
					$("#rate_47").val(rate);
					$("#amount_47").val(amount);
					$("#cgst_47").val(cgst);	
					$("#sgst_47").val(sgst);
					$("#igst_47").val(igst);
					$("#netamount_47").val(net_amount);
					$("#dis_amt_47").val(dis_amt);
				} else if(i_value ==48) {
					$("#product_48").val(product_1[0]);
					$("#quantity_48").val(quantity);
					$("#rate_48").val(rate);
					$("#amount_48").val(amount);
					$("#cgst_48").val(cgst);	
					$("#sgst_48").val(sgst);
					$("#igst_48").val(igst);
					$("#netamount_48").val(net_amount);
					$("#dis_amt_48").val(dis_amt);
				} else if(i_value ==49) {
					$("#product_49").val(product_1[0]);
					$("#quantity_49").val(quantity);
					$("#rate_49").val(rate);
					$("#amount_49").val(amount);
					$("#cgst_49").val(cgst);	
					$("#sgst_49").val(sgst);
					$("#igst_49").val(igst);
					$("#netamount_49").val(net_amount);
					$("#dis_amt_49").val(dis_amt);
				} else if(i_value ==50) {
					$("#product_50").val(product_1[0]);
					$("#quantity_50").val(quantity);
					$("#rate_50").val(rate);
					$("#amount_50").val(amount);
					$("#cgst_50").val(cgst);	
					$("#sgst_50").val(sgst);
					$("#igst_50").val(igst);
					$("#netamount_50").val(net_amount);
					$("#dis_amt_50").val(dis_amt);
				} else if(i_value ==51) {
					$("#product_51").val(product_1[0]);
					$("#quantity_51").val(quantity);
					$("#rate_51").val(rate);
					$("#amount_51").val(amount);
					$("#cgst_51").val(cgst);	
					$("#sgst_51").val(sgst);
					$("#igst_51").val(igst);
					$("#netamount_51").val(net_amount);
					$("#dis_amt_51").val(dis_amt);
				} else if(i_value ==52) {
					$("#product_52").val(product_1[0]);
					$("#quantity_52").val(quantity);
					$("#rate_52").val(rate);
					$("#amount_52").val(amount);
					$("#cgst_52").val(cgst);	
					$("#sgst_52").val(sgst);
					$("#igst_52").val(igst);
					$("#netamount_52").val(net_amount);
					$("#dis_amt_52").val(dis_amt);
				} else if(i_value ==53) {
					$("#product_53").val(product_1[0]);
					$("#quantity_53").val(quantity);
					$("#rate_53").val(rate);
					$("#amount_53").val(amount);
					$("#cgst_53").val(cgst);	
					$("#sgst_53").val(sgst);
					$("#igst_53").val(igst);
					$("#netamount_53").val(net_amount);
					$("#dis_amt_53").val(dis_amt);
				} else if(i_value ==54) {
					$("#product_54").val(product_1[0]);
					$("#quantity_54").val(quantity);
					$("#rate_54").val(rate);
					$("#amount_54").val(amount);
					$("#cgst_54").val(cgst);	
					$("#sgst_54").val(sgst);
					$("#igst_54").val(igst);
					$("#netamount_54").val(net_amount);
					$("#dis_amt_54").val(dis_amt);
				} else if(i_value ==55) {
					$("#product_55").val(product_1[0]);
					$("#quantity_55").val(quantity);
					$("#rate_55").val(rate);
					$("#amount_55").val(amount);
					$("#cgst_55").val(cgst);	
					$("#sgst_55").val(sgst);
					$("#igst_55").val(igst);
					$("#netamount_55").val(net_amount);
					$("#dis_amt_55").val(dis_amt);
				} else if(i_value ==56) {
					$("#product_56").val(product_1[0]);
					$("#quantity_56").val(quantity);
					$("#rate_56").val(rate);
					$("#amount_56").val(amount);
					$("#cgst_56").val(cgst);	
					$("#sgst_56").val(sgst);
					$("#igst_56").val(igst);
					$("#netamount_56").val(net_amount);
					$("#dis_amt_56").val(dis_amt);
				} else if(i_value ==57) {
					$("#product_57").val(product_1[0]);
					$("#quantity_57").val(quantity);
					$("#rate_57").val(rate);
					$("#amount_57").val(amount);
					$("#cgst_57").val(cgst);	
					$("#sgst_57").val(sgst);
					$("#igst_57").val(igst);
					$("#netamount_57").val(net_amount);
					$("#dis_amt_57").val(dis_amt);
				} else if(i_value ==58) {
					$("#product_58").val(product_1[0]);
					$("#quantity_58").val(quantity);
					$("#rate_58").val(rate);
					$("#amount_58").val(amount);
					$("#cgst_58").val(cgst);	
					$("#sgst_58").val(sgst);
					$("#igst_58").val(igst);
					$("#netamount_58").val(net_amount);
					$("#dis_amt_58").val(dis_amt);
				} else if(i_value ==59) {
					$("#product_59").val(product_1[0]);
					$("#quantity_59").val(quantity);
					$("#rate_59").val(rate);
					$("#amount_59").val(amount);
					$("#cgst_59").val(cgst);	
					$("#sgst_59").val(sgst);
					$("#igst_59").val(igst);
					$("#netamount_59").val(net_amount);
					$("#dis_amt_59").val(dis_amt);
				} else if(i_value ==60) {
					$("#product_60").val(product_1[0]);
					$("#quantity_60").val(quantity);
					$("#rate_60").val(rate);
					$("#amount_60").val(amount);
					$("#cgst_60").val(cgst);	
					$("#sgst_60").val(sgst);
					$("#igst_60").val(igst);
					$("#netamount_60").val(net_amount);
					$("#dis_amt_60").val(dis_amt);
				} else {
				}
				
				var total =  document.getElementById("total").value;
				if(total <=0) {
					total_1 =0;
				} else {
					total_1 = total
				}
				var total_value = parseFloat(total_1) + parseFloat(net_amount);
				$("#total").val(total_value);
				var load_amt	 = document.getElementById("load_amt").value;
				var frieght_amt  = document.getElementById("frieght_amt").value;
				if(load_amt > 0)
				{
					load_amt_1 = 0;
				} else {
					load_amt_1 = load_amt;
				}
				var net_total_value_1 = parseFloat(total_value) - parseFloat(load_amt_1) + parseFloat(frieght_amt);
				$("#net_total").val(net_total_value_1);
			}
	</script>
	<div class="col-sm-12" >	
    <table id="mytable" border="1">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Dis.Amt</th>
            <th>CGST Amt</th>
            <th>SGST Amt</th>
            <th>IGST Amt</th>
            <th>Net Amount</th>
        </tr>
		<tr>
          <th colspan="8" class="text-right">Total</th>
          <th><input type="text" id="total" name="total" readonly></th>
        </tr>
		<script>
			function get_loading(){
				var net_total	 = document.getElementById("total").value;
				var load_amt	 = document.getElementById("load_amt").value;
				var frieght_amt  = document.getElementById("frieght_amt").value;
				var dis_net_total =  parseFloat(net_total) + parseFloat(load_amt) + parseFloat(frieght_amt);
				$("#net_total").val(dis_net_total);
			}
		</script>
		<tr>
          <th colspan="8" class="text-right">Loading / Unloading Charges</th>
          <th><input type="text" id="load_amt" onkeyup="get_loading();" name="load_amt" value="0"></th>
        </tr>
		<tr>
          <th colspan="8" class="text-right">Frieght</th>
          <th><input type="text" id="frieght_amt" onkeyup="get_loading();" name="frieght_amt" value="0"></th>
        </tr>
		<tr>
          <th colspan="8" class="text-right">Net Total</th>
          <th><input type="text" id="net_total" name="net_total" readonly></th>
        </tr>

    </table>

	<input type="hidden" id="i_value">
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_1">
	<input type="hidden" name="quantity_s[]" id="quantity_1">
	<input type="hidden" name="rate_s[]" id="rate_1">
	<input type="hidden" name="amount_s[]" id="amount_1">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_1">
	<input type="hidden" name="cgst_s[]" id="cgst_1">
	<input type="hidden" name="sgst_s[]" id="sgst_1">
	<input type="hidden" name="igst_s[]" id="igst_1">
	<input type="hidden" name="netamount_s[]" id="netamount_1">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_2">
	<input type="hidden" name="quantity_s[]" id="quantity_2">
	<input type="hidden" name="rate_s[]" id="rate_2">
	<input type="hidden" name="amount_s[]" id="amount_2">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_2">
	<input type="hidden" name="cgst_s[]" id="cgst_2">
	<input type="hidden" name="sgst_s[]" id="sgst_2">
	<input type="hidden" name="igst_s[]" id="igst_2">
	<input type="hidden" name="netamount_s[]" id="netamount_2">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_3">
	<input type="hidden" name="quantity_s[]" id="quantity_3">
	<input type="hidden" name="rate_s[]" id="rate_3">
	<input type="hidden" name="amount_s[]" id="amount_3">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_3">
	<input type="hidden" name="cgst_s[]" id="cgst_3">
	<input type="hidden" name="sgst_s[]" id="sgst_3">
	<input type="hidden" name="igst_s[]" id="igst_3">
	<input type="hidden" name="netamount_s[]" id="netamount_3">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_4">
	<input type="hidden" name="quantity_s[]" id="quantity_4">
	<input type="hidden" name="rate_s[]" id="rate_4">
	<input type="hidden" name="amount_s[]" id="amount_4">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_4">
	<input type="hidden" name="cgst_s[]" id="cgst_4">
	<input type="hidden" name="sgst_s[]" id="sgst_4">
	<input type="hidden" name="igst_s[]" id="igst_4">
	<input type="hidden" name="netamount_s[]" id="netamount_4">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_5">
	<input type="hidden" name="quantity_s[]" id="quantity_5">
	<input type="hidden" name="rate_s[]" id="rate_5">
	<input type="hidden" name="amount_s[]" id="amount_5">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_5">
	<input type="hidden" name="cgst_s[]" id="cgst_5">
	<input type="hidden" name="sgst_s[]" id="sgst_5">
	<input type="hidden" name="igst_s[]" id="igst_5">
	<input type="hidden" name="netamount_s[]" id="netamount_5">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_6">
	<input type="hidden" name="quantity_s[]" id="quantity_6">
	<input type="hidden" name="rate_s[]" id="rate_6">
	<input type="hidden" name="amount_s[]" id="amount_6">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_6">
	<input type="hidden" name="cgst_s[]" id="cgst_6">
	<input type="hidden" name="sgst_s[]" id="sgst_6">
	<input type="hidden" name="igst_s[]" id="igst_6">
	<input type="hidden" name="netamount_s[]" id="netamount_6">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_7">
	<input type="hidden" name="quantity_s[]" id="quantity_7">
	<input type="hidden" name="rate_s[]" id="rate_7">
	<input type="hidden" name="amount_s[]" id="amount_7">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_7">
	<input type="hidden" name="cgst_s[]" id="cgst_7">
	<input type="hidden" name="sgst_s[]" id="sgst_7">
	<input type="hidden" name="igst_s[]" id="igst_7">
	<input type="hidden" name="netamount_s[]" id="netamount_7">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_8">
	<input type="hidden" name="quantity_s[]" id="quantity_8">
	<input type="hidden" name="rate_s[]" id="rate_8">
	<input type="hidden" name="amount_s[]" id="amount_8">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_8">
	<input type="hidden" name="cgst_s[]" id="cgst_8">
	<input type="hidden" name="sgst_s[]" id="sgst_8">
	<input type="hidden" name="igst_s[]" id="igst_8">
	<input type="hidden" name="netamount_s[]" id="netamount_8">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_9">
	<input type="hidden" name="quantity_s[]" id="quantity_9">
	<input type="hidden" name="rate_s[]" id="rate_9">
	<input type="hidden" name="amount_s[]" id="amount_9">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_9">
	<input type="hidden" name="cgst_s[]" id="cgst_9">
	<input type="hidden" name="sgst_s[]" id="sgst_9">
	<input type="hidden" name="igst_s[]" id="igst_9">
	<input type="hidden" name="netamount_s[]" id="netamount_9">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_10">
	<input type="hidden" name="quantity_s[]" id="quantity_10">
	<input type="hidden" name="rate_s[]" id="rate_10">
	<input type="hidden" name="amount_s[]" id="amount_10">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_10">
	<input type="hidden" name="cgst_s[]" id="cgst_10">
	<input type="hidden" name="sgst_s[]" id="sgst_10">
	<input type="hidden" name="igst_s[]" id="igst_10">
	<input type="hidden" name="netamount_s[]" id="netamount_10">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_11">
		<input type="hidden" name="quantity_s[]" id="quantity_11">
		<input type="hidden" name="rate_s[]" id="rate_11">
		<input type="hidden" name="amount_s[]" id="amount_11">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_11">
		<input type="hidden" name="cgst_s[]" id="cgst_11">
		<input type="hidden" name="sgst_s[]" id="sgst_11">
		<input type="hidden" name="igst_s[]" id="igst_11">
		<input type="hidden" name="netamount_s[]" id="netamount_11">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_12">
		<input type="hidden" name="quantity_s[]" id="quantity_12">
		<input type="hidden" name="rate_s[]" id="rate_12">
		<input type="hidden" name="amount_s[]" id="amount_12">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_12">
		<input type="hidden" name="cgst_s[]" id="cgst_12">
		<input type="hidden" name="sgst_s[]" id="sgst_12">
		<input type="hidden" name="igst_s[]" id="igst_12">
		<input type="hidden" name="netamount_s[]" id="netamount_12">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_13">
		<input type="hidden" name="quantity_s[]" id="quantity_13">
		<input type="hidden" name="rate_s[]" id="rate_13">
		<input type="hidden" name="amount_s[]" id="amount_13">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_13">
		<input type="hidden" name="cgst_s[]" id="cgst_13">
		<input type="hidden" name="sgst_s[]" id="sgst_13">
		<input type="hidden" name="igst_s[]" id="igst_13">
		<input type="hidden" name="netamount_s[]" id="netamount_13">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_14">
		<input type="hidden" name="quantity_s[]" id="quantity_14">
		<input type="hidden" name="rate_s[]" id="rate_14">
		<input type="hidden" name="amount_s[]" id="amount_14">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_14">
		<input type="hidden" name="cgst_s[]" id="cgst_14">
		<input type="hidden" name="sgst_s[]" id="sgst_14">
		<input type="hidden" name="igst_s[]" id="igst_14">
		<input type="hidden" name="netamount_s[]" id="netamount_14">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_15">
		<input type="hidden" name="quantity_s[]" id="quantity_15">
		<input type="hidden" name="rate_s[]" id="rate_15">
		<input type="hidden" name="amount_s[]" id="amount_15">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_15">
		<input type="hidden" name="cgst_s[]" id="cgst_15">
		<input type="hidden" name="sgst_s[]" id="sgst_15">
		<input type="hidden" name="igst_s[]" id="igst_15">
		<input type="hidden" name="netamount_s[]" id="netamount_15">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_16">
		<input type="hidden" name="quantity_s[]" id="quantity_16">
		<input type="hidden" name="rate_s[]" id="rate_16">
		<input type="hidden" name="amount_s[]" id="amount_16">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_16">
		<input type="hidden" name="cgst_s[]" id="cgst_16">
		<input type="hidden" name="sgst_s[]" id="sgst_16">
		<input type="hidden" name="igst_s[]" id="igst_16">
		<input type="hidden" name="netamount_s[]" id="netamount_16">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_17">
		<input type="hidden" name="quantity_s[]" id="quantity_17">
		<input type="hidden" name="rate_s[]" id="rate_17">
		<input type="hidden" name="amount_s[]" id="amount_17">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_17">
		<input type="hidden" name="cgst_s[]" id="cgst_17">
		<input type="hidden" name="sgst_s[]" id="sgst_17">
		<input type="hidden" name="igst_s[]" id="igst_17">
		<input type="hidden" name="netamount_s[]" id="netamount_17">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_18">
		<input type="hidden" name="quantity_s[]" id="quantity_18">
		<input type="hidden" name="rate_s[]" id="rate_18">
		<input type="hidden" name="amount_s[]" id="amount_18">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_18">
		<input type="hidden" name="cgst_s[]" id="cgst_18">
		<input type="hidden" name="sgst_s[]" id="sgst_18">
		<input type="hidden" name="igst_s[]" id="igst_18">
		<input type="hidden" name="netamount_s[]" id="netamount_18">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_19">
		<input type="hidden" name="quantity_s[]" id="quantity_19">
		<input type="hidden" name="rate_s[]" id="rate_19">
		<input type="hidden" name="amount_s[]" id="amount_19">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_19">
		<input type="hidden" name="cgst_s[]" id="cgst_19">
		<input type="hidden" name="sgst_s[]" id="sgst_19">
		<input type="hidden" name="igst_s[]" id="igst_19">
		<input type="hidden" name="netamount_s[]" id="netamount_19">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_20">
		<input type="hidden" name="quantity_s[]" id="quantity_20">
		<input type="hidden" name="rate_s[]" id="rate_20">
		<input type="hidden" name="amount_s[]" id="amount_20">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_20">
		<input type="hidden" name="cgst_s[]" id="cgst_20">
		<input type="hidden" name="sgst_s[]" id="sgst_20">
		<input type="hidden" name="igst_s[]" id="igst_20">
		<input type="hidden" name="netamount_s[]" id="netamount_20">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_21">
		<input type="hidden" name="quantity_s[]" id="quantity_21">
		<input type="hidden" name="rate_s[]" id="rate_21">
		<input type="hidden" name="amount_s[]" id="amount_21">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_21">
		<input type="hidden" name="cgst_s[]" id="cgst_21">
		<input type="hidden" name="sgst_s[]" id="sgst_21">
		<input type="hidden" name="igst_s[]" id="igst_21">
		<input type="hidden" name="netamount_s[]" id="netamount_21">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_22">
		<input type="hidden" name="quantity_s[]" id="quantity_22">
		<input type="hidden" name="rate_s[]" id="rate_22">
		<input type="hidden" name="amount_s[]" id="amount_22">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_22">
		<input type="hidden" name="cgst_s[]" id="cgst_22">
		<input type="hidden" name="sgst_s[]" id="sgst_22">
		<input type="hidden" name="igst_s[]" id="igst_22">
		<input type="hidden" name="netamount_s[]" id="netamount_22">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_23">
		<input type="hidden" name="quantity_s[]" id="quantity_23">
		<input type="hidden" name="rate_s[]" id="rate_23">
		<input type="hidden" name="amount_s[]" id="amount_23">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_23">
		<input type="hidden" name="cgst_s[]" id="cgst_23">
		<input type="hidden" name="sgst_s[]" id="sgst_23">
		<input type="hidden" name="igst_s[]" id="igst_23">
		<input type="hidden" name="netamount_s[]" id="netamount_23">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_24">
		<input type="hidden" name="quantity_s[]" id="quantity_24">
		<input type="hidden" name="rate_s[]" id="rate_24">
		<input type="hidden" name="amount_s[]" id="amount_24">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_24">
		<input type="hidden" name="cgst_s[]" id="cgst_24">
		<input type="hidden" name="sgst_s[]" id="sgst_24">
		<input type="hidden" name="igst_s[]" id="igst_24">
		<input type="hidden" name="netamount_s[]" id="netamount_24">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_25">
		<input type="hidden" name="quantity_s[]" id="quantity_25">
		<input type="hidden" name="rate_s[]" id="rate_25">
		<input type="hidden" name="amount_s[]" id="amount_25">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_25">
		<input type="hidden" name="cgst_s[]" id="cgst_25">
		<input type="hidden" name="sgst_s[]" id="sgst_25">
		<input type="hidden" name="igst_s[]" id="igst_25">
		<input type="hidden" name="netamount_s[]" id="netamount_25">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_26">
		<input type="hidden" name="quantity_s[]" id="quantity_26">
		<input type="hidden" name="rate_s[]" id="rate_26">
		<input type="hidden" name="amount_s[]" id="amount_26">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_26">
		<input type="hidden" name="cgst_s[]" id="cgst_26">
		<input type="hidden" name="sgst_s[]" id="sgst_26">
		<input type="hidden" name="igst_s[]" id="igst_26">
		<input type="hidden" name="netamount_s[]" id="netamount_26">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_27">
		<input type="hidden" name="quantity_s[]" id="quantity_27">
		<input type="hidden" name="rate_s[]" id="rate_27">
		<input type="hidden" name="amount_s[]" id="amount_27">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_27">
		<input type="hidden" name="cgst_s[]" id="cgst_27">
		<input type="hidden" name="sgst_s[]" id="sgst_27">
		<input type="hidden" name="igst_s[]" id="igst_27">
		<input type="hidden" name="netamount_s[]" id="netamount_27">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_28">
		<input type="hidden" name="quantity_s[]" id="quantity_28">
		<input type="hidden" name="rate_s[]" id="rate_28">
		<input type="hidden" name="amount_s[]" id="amount_28">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_28">
		<input type="hidden" name="cgst_s[]" id="cgst_28">
		<input type="hidden" name="sgst_s[]" id="sgst_28">
		<input type="hidden" name="igst_s[]" id="igst_28">
		<input type="hidden" name="netamount_s[]" id="netamount_28">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_29">
		<input type="hidden" name="quantity_s[]" id="quantity_29">
		<input type="hidden" name="rate_s[]" id="rate_29">
		<input type="hidden" name="amount_s[]" id="amount_29">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_29">
		<input type="hidden" name="cgst_s[]" id="cgst_29">
		<input type="hidden" name="sgst_s[]" id="sgst_29">
		<input type="hidden" name="igst_s[]" id="igst_29">
		<input type="hidden" name="netamount_s[]" id="netamount_29">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_30">
		<input type="hidden" name="quantity_s[]" id="quantity_30">
		<input type="hidden" name="rate_s[]" id="rate_30">
		<input type="hidden" name="amount_s[]" id="amount_30">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_30">
		<input type="hidden" name="cgst_s[]" id="cgst_30">
		<input type="hidden" name="sgst_s[]" id="sgst_30">
		<input type="hidden" name="igst_s[]" id="igst_30">
		<input type="hidden" name="netamount_s[]" id="netamount_30">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_31">
		<input type="hidden" name="quantity_s[]" id="quantity_31">
		<input type="hidden" name="rate_s[]" id="rate_31">
		<input type="hidden" name="amount_s[]" id="amount_31">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_31">
		<input type="hidden" name="cgst_s[]" id="cgst_31">
		<input type="hidden" name="sgst_s[]" id="sgst_31">
		<input type="hidden" name="igst_s[]" id="igst_31">
		<input type="hidden" name="netamount_s[]" id="netamount_31">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_32">
		<input type="hidden" name="quantity_s[]" id="quantity_32">
		<input type="hidden" name="rate_s[]" id="rate_32">
		<input type="hidden" name="amount_s[]" id="amount_32">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_32">
		<input type="hidden" name="cgst_s[]" id="cgst_32">
		<input type="hidden" name="sgst_s[]" id="sgst_32">
		<input type="hidden" name="igst_s[]" id="igst_32">
		<input type="hidden" name="netamount_s[]" id="netamount_32">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_33">
		<input type="hidden" name="quantity_s[]" id="quantity_33">
		<input type="hidden" name="rate_s[]" id="rate_33">
		<input type="hidden" name="amount_s[]" id="amount_33">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_33">
		<input type="hidden" name="cgst_s[]" id="cgst_33">
		<input type="hidden" name="sgst_s[]" id="sgst_33">
		<input type="hidden" name="igst_s[]" id="igst_33">
		<input type="hidden" name="netamount_s[]" id="netamount_33">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_34">
		<input type="hidden" name="quantity_s[]" id="quantity_34">
		<input type="hidden" name="rate_s[]" id="rate_34">
		<input type="hidden" name="amount_s[]" id="amount_34">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_34">
		<input type="hidden" name="cgst_s[]" id="cgst_34">
		<input type="hidden" name="sgst_s[]" id="sgst_34">
		<input type="hidden" name="igst_s[]" id="igst_34">
		<input type="hidden" name="netamount_s[]" id="netamount_34">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_35">
		<input type="hidden" name="quantity_s[]" id="quantity_35">
		<input type="hidden" name="rate_s[]" id="rate_35">
		<input type="hidden" name="amount_s[]" id="amount_35">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_35">
		<input type="hidden" name="cgst_s[]" id="cgst_35">
		<input type="hidden" name="sgst_s[]" id="sgst_35">
		<input type="hidden" name="igst_s[]" id="igst_35">
		<input type="hidden" name="netamount_s[]" id="netamount_35">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_36">
		<input type="hidden" name="quantity_s[]" id="quantity_36">
		<input type="hidden" name="rate_s[]" id="rate_36">
		<input type="hidden" name="amount_s[]" id="amount_36">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_36">
		<input type="hidden" name="cgst_s[]" id="cgst_36">
		<input type="hidden" name="sgst_s[]" id="sgst_36">
		<input type="hidden" name="igst_s[]" id="igst_36">
		<input type="hidden" name="netamount_s[]" id="netamount_36">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_37">
		<input type="hidden" name="quantity_s[]" id="quantity_37">
		<input type="hidden" name="rate_s[]" id="rate_37">
		<input type="hidden" name="amount_s[]" id="amount_37">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_37">
		<input type="hidden" name="cgst_s[]" id="cgst_37">
		<input type="hidden" name="sgst_s[]" id="sgst_37">
		<input type="hidden" name="igst_s[]" id="igst_37">
		<input type="hidden" name="netamount_s[]" id="netamount_37">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_38">
		<input type="hidden" name="quantity_s[]" id="quantity_38">
		<input type="hidden" name="rate_s[]" id="rate_38">
		<input type="hidden" name="amount_s[]" id="amount_38">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_38">
		<input type="hidden" name="cgst_s[]" id="cgst_38">
		<input type="hidden" name="sgst_s[]" id="sgst_38">
		<input type="hidden" name="igst_s[]" id="igst_38">
		<input type="hidden" name="netamount_s[]" id="netamount_38">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_39">
		<input type="hidden" name="quantity_s[]" id="quantity_39">
		<input type="hidden" name="rate_s[]" id="rate_39">
		<input type="hidden" name="amount_s[]" id="amount_39">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_39">
		<input type="hidden" name="cgst_s[]" id="cgst_39">
		<input type="hidden" name="sgst_s[]" id="sgst_39">
		<input type="hidden" name="igst_s[]" id="igst_39">
		<input type="hidden" name="netamount_s[]" id="netamount_39">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_40">
		<input type="hidden" name="quantity_s[]" id="quantity_40">
		<input type="hidden" name="rate_s[]" id="rate_40">
		<input type="hidden" name="amount_s[]" id="amount_40">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_40">
		<input type="hidden" name="cgst_s[]" id="cgst_40">
		<input type="hidden" name="sgst_s[]" id="sgst_40">
		<input type="hidden" name="igst_s[]" id="igst_40">
		<input type="hidden" name="netamount_s[]" id="netamount_40">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_41">
		<input type="hidden" name="quantity_s[]" id="quantity_41">
		<input type="hidden" name="rate_s[]" id="rate_41">
		<input type="hidden" name="amount_s[]" id="amount_41">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_41">
		<input type="hidden" name="cgst_s[]" id="cgst_41">
		<input type="hidden" name="sgst_s[]" id="sgst_41">
		<input type="hidden" name="igst_s[]" id="igst_41">
		<input type="hidden" name="netamount_s[]" id="netamount_41">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_42">
		<input type="hidden" name="quantity_s[]" id="quantity_42">
		<input type="hidden" name="rate_s[]" id="rate_42">
		<input type="hidden" name="amount_s[]" id="amount_42">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_42">
		<input type="hidden" name="cgst_s[]" id="cgst_42">
		<input type="hidden" name="sgst_s[]" id="sgst_42">
		<input type="hidden" name="igst_s[]" id="igst_42">
		<input type="hidden" name="netamount_s[]" id="netamount_42">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_43">
		<input type="hidden" name="quantity_s[]" id="quantity_43">
		<input type="hidden" name="rate_s[]" id="rate_43">
		<input type="hidden" name="amount_s[]" id="amount_43">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_43">
		<input type="hidden" name="cgst_s[]" id="cgst_43">
		<input type="hidden" name="sgst_s[]" id="sgst_43">
		<input type="hidden" name="igst_s[]" id="igst_43">
		<input type="hidden" name="netamount_s[]" id="netamount_43">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_44">
		<input type="hidden" name="quantity_s[]" id="quantity_44">
		<input type="hidden" name="rate_s[]" id="rate_44">
		<input type="hidden" name="amount_s[]" id="amount_44">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_44">
		<input type="hidden" name="cgst_s[]" id="cgst_44">
		<input type="hidden" name="sgst_s[]" id="sgst_44">
		<input type="hidden" name="igst_s[]" id="igst_44">
		<input type="hidden" name="netamount_s[]" id="netamount_44">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_45">
		<input type="hidden" name="quantity_s[]" id="quantity_45">
		<input type="hidden" name="rate_s[]" id="rate_45">
		<input type="hidden" name="amount_s[]" id="amount_45">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_45">
		<input type="hidden" name="cgst_s[]" id="cgst_45">
		<input type="hidden" name="sgst_s[]" id="sgst_45">
		<input type="hidden" name="igst_s[]" id="igst_45">
		<input type="hidden" name="netamount_s[]" id="netamount_45">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_46">
		<input type="hidden" name="quantity_s[]" id="quantity_46">
		<input type="hidden" name="rate_s[]" id="rate_46">
		<input type="hidden" name="amount_s[]" id="amount_46">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_46">
		<input type="hidden" name="cgst_s[]" id="cgst_46">
		<input type="hidden" name="sgst_s[]" id="sgst_46">
		<input type="hidden" name="igst_s[]" id="igst_46">
		<input type="hidden" name="netamount_s[]" id="netamount_46">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_47">
		<input type="hidden" name="quantity_s[]" id="quantity_47">
		<input type="hidden" name="rate_s[]" id="rate_47">
		<input type="hidden" name="amount_s[]" id="amount_47">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_47">
		<input type="hidden" name="cgst_s[]" id="cgst_47">
		<input type="hidden" name="sgst_s[]" id="sgst_47">
		<input type="hidden" name="igst_s[]" id="igst_47">
		<input type="hidden" name="netamount_s[]" id="netamount_47">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_48">
		<input type="hidden" name="quantity_s[]" id="quantity_48">
		<input type="hidden" name="rate_s[]" id="rate_48">
		<input type="hidden" name="amount_s[]" id="amount_48">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_48">
		<input type="hidden" name="cgst_s[]" id="cgst_48">
		<input type="hidden" name="sgst_s[]" id="sgst_48">
		<input type="hidden" name="igst_s[]" id="igst_48">
		<input type="hidden" name="netamount_s[]" id="netamount_48">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_49">
		<input type="hidden" name="quantity_s[]" id="quantity_49">
		<input type="hidden" name="rate_s[]" id="rate_49">
		<input type="hidden" name="amount_s[]" id="amount_49">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_49">
		<input type="hidden" name="cgst_s[]" id="cgst_49">
		<input type="hidden" name="sgst_s[]" id="sgst_49">
		<input type="hidden" name="igst_s[]" id="igst_49">
		<input type="hidden" name="netamount_s[]" id="netamount_49">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_50">
		<input type="hidden" name="quantity_s[]" id="quantity_50">
		<input type="hidden" name="rate_s[]" id="rate_50">
		<input type="hidden" name="amount_s[]" id="amount_50">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_50">
		<input type="hidden" name="cgst_s[]" id="cgst_50">
		<input type="hidden" name="sgst_s[]" id="sgst_50">
		<input type="hidden" name="igst_s[]" id="igst_50">
		<input type="hidden" name="netamount_s[]" id="netamount_50">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_51">
		<input type="hidden" name="quantity_s[]" id="quantity_51">
		<input type="hidden" name="rate_s[]" id="rate_51">
		<input type="hidden" name="amount_s[]" id="amount_51">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_51">
		<input type="hidden" name="cgst_s[]" id="cgst_51">
		<input type="hidden" name="sgst_s[]" id="sgst_51">
		<input type="hidden" name="igst_s[]" id="igst_51">
		<input type="hidden" name="netamount_s[]" id="netamount_51">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_52">
		<input type="hidden" name="quantity_s[]" id="quantity_52">
		<input type="hidden" name="rate_s[]" id="rate_52">
		<input type="hidden" name="amount_s[]" id="amount_52">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_52">
		<input type="hidden" name="cgst_s[]" id="cgst_52">
		<input type="hidden" name="sgst_s[]" id="sgst_52">
		<input type="hidden" name="igst_s[]" id="igst_52">
		<input type="hidden" name="netamount_s[]" id="netamount_52">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_53">
		<input type="hidden" name="quantity_s[]" id="quantity_53">
		<input type="hidden" name="rate_s[]" id="rate_53">
		<input type="hidden" name="amount_s[]" id="amount_53">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_53">
		<input type="hidden" name="cgst_s[]" id="cgst_53">
		<input type="hidden" name="sgst_s[]" id="sgst_53">
		<input type="hidden" name="igst_s[]" id="igst_53">
		<input type="hidden" name="netamount_s[]" id="netamount_53">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_54">
		<input type="hidden" name="quantity_s[]" id="quantity_54">
		<input type="hidden" name="rate_s[]" id="rate_54">
		<input type="hidden" name="amount_s[]" id="amount_54">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_54">
		<input type="hidden" name="cgst_s[]" id="cgst_54">
		<input type="hidden" name="sgst_s[]" id="sgst_54">
		<input type="hidden" name="igst_s[]" id="igst_54">
		<input type="hidden" name="netamount_s[]" id="netamount_54">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_55">
		<input type="hidden" name="quantity_s[]" id="quantity_55">
		<input type="hidden" name="rate_s[]" id="rate_55">
		<input type="hidden" name="amount_s[]" id="amount_55">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_55">
		<input type="hidden" name="cgst_s[]" id="cgst_55">
		<input type="hidden" name="sgst_s[]" id="sgst_55">
		<input type="hidden" name="igst_s[]" id="igst_55">
		<input type="hidden" name="netamount_s[]" id="netamount_55">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_56">
		<input type="hidden" name="quantity_s[]" id="quantity_56">
		<input type="hidden" name="rate_s[]" id="rate_56">
		<input type="hidden" name="amount_s[]" id="amount_56">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_56">
		<input type="hidden" name="cgst_s[]" id="cgst_56">
		<input type="hidden" name="sgst_s[]" id="sgst_56">
		<input type="hidden" name="igst_s[]" id="igst_56">
		<input type="hidden" name="netamount_s[]" id="netamount_56">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_57">
		<input type="hidden" name="quantity_s[]" id="quantity_57">
		<input type="hidden" name="rate_s[]" id="rate_57">
		<input type="hidden" name="amount_s[]" id="amount_57">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_57">
		<input type="hidden" name="cgst_s[]" id="cgst_57">
		<input type="hidden" name="sgst_s[]" id="sgst_57">
		<input type="hidden" name="igst_s[]" id="igst_57">
		<input type="hidden" name="netamount_s[]" id="netamount_57">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_58">
		<input type="hidden" name="quantity_s[]" id="quantity_58">
		<input type="hidden" name="rate_s[]" id="rate_58">
		<input type="hidden" name="amount_s[]" id="amount_58">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_58">
		<input type="hidden" name="cgst_s[]" id="cgst_58">
		<input type="hidden" name="sgst_s[]" id="sgst_58">
		<input type="hidden" name="igst_s[]" id="igst_58">
		<input type="hidden" name="netamount_s[]" id="netamount_58">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_59">
		<input type="hidden" name="quantity_s[]" id="quantity_59">
		<input type="hidden" name="rate_s[]" id="rate_59">
		<input type="hidden" name="amount_s[]" id="amount_59">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_59">
		<input type="hidden" name="cgst_s[]" id="cgst_59">
		<input type="hidden" name="sgst_s[]" id="sgst_59">
		<input type="hidden" name="igst_s[]" id="igst_59">
		<input type="hidden" name="netamount_s[]" id="netamount_59">
	</div>
	<div class="col-sm-12">     
		<input type="hidden" name="product_s[]" id="product_60">
		<input type="hidden" name="quantity_s[]" id="quantity_60">
		<input type="hidden" name="rate_s[]" id="rate_60">
		<input type="hidden" name="amount_s[]" id="amount_60">
		<input type="hidden" name="dis_amt_s[]" id="dis_amt_60">
		<input type="hidden" name="cgst_s[]" id="cgst_60">
		<input type="hidden" name="sgst_s[]" id="sgst_60">
		<input type="hidden" name="igst_s[]" id="igst_60">
		<input type="hidden" name="netamount_s[]" id="netamount_60">
	</div>
	</div>
	<div class="row">
	<div class="form-group col-sm-6">
	<label for="inputName" class="col-sm-4 control-label" >Created By</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
		<select class="form-control selectpicker" name="created_by" id="created_by" data-live-search="true" required>
			<option value="">Select</option>
			<?php 
				$select_GrpQry=mysqli_query($con,"select t.Id as tid,t.Name from tbl_employee t WHERE t.Status='Active'");
				while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
				{
					$Name	=	$fetch_GrpQry['Name'];
					$tid	=	$fetch_GrpQry['tid'];
			?>
			<option value="<?php echo $tid; ?>" <?php if($Emp_tbl_Id == $tid) echo 'selected'; ?> ><?php echo $Name; ?></option>
		<?php 	}	?>
			</select>
			</div>
		</div>
	<div class="form-group col-sm-6">
	<label for="inputName" class="col-sm-4 control-label" >Followed By</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
		<select class="form-control selectpicker" name="follow_by" id="follow_by" data-live-search="true" required>
			<option value="">Select</option>
			<?php 
				$select_GrpQry=mysqli_query($con,"select t.Id as tid,t.Name from tbl_employee t WHERE t.Status='Active'");
				while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
				{
					$Name	=	$fetch_GrpQry['Name'];
					$tid	=	$fetch_GrpQry['tid'];
			?>
			<option value="<?php echo $tid; ?>"><?php echo $Name; ?></option>
		<?php 	}	?>
			</select>
			</div>
		</div>
	</div>
		<div class="col-sm-12">                        
		  </br>
			<div class="col-sm-6">
			<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
			</div>
			<div class="col-sm-6">				
			<button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
			</div>			  
		</div>
		</form>
			</div>	
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<div class="control-sidebar-bg"></div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


</body>
</html>

<?php mysqli_close($con); ?>

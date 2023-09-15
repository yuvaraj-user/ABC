<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $Name=$_REQUEST['Name'];
	 $Address_Line1=$_REQUEST['Address_Line1'];
	 $Address_Line2=$_REQUEST['Address_Line2'];
	 $Address_Line3=$_REQUEST['Address_Line3'];
	 $Address_Line4=$_REQUEST['Address_Line4'];
	 $State=$_REQUEST['State'];
	 $Country=$_REQUEST['Country'];
	 $Mobile_No1=$_REQUEST['Mobile_No1'];
	 $Mobile_No2=$_REQUEST['Mobile_No2'];
	 $Email_Id1=$_REQUEST['Email_Id1'];
	 $Email_Id2=$_REQUEST['Email_Id2'];
	 $LandLine_No1=$_REQUEST['LandLine_No1'];
	 $LandLine_No2=$_REQUEST['LandLine_No2'];
	 $Gst_No=$_REQUEST['Gst_No'];
	 $Gst_Type=$_REQUEST['Gst_Type'];
	 $Pan_No=$_REQUEST['Pan_No'];
	 $ref_no=$_REQUEST['ref_no'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	$customer_1 = $_REQUEST['customer'];
		$order_no_6 = $_REQUEST['order_no_6'];
	$acctdate = $_REQUEST['acctdate'];
	$discount = $_REQUEST['discount'];
	$other_charge = $_REQUEST['other_charge'];
	$invoice_no = $_REQUEST['invoice_no'];
	$net_total = $_REQUEST['net_total'];
	$total = $_REQUEST['total'];
	$dc_no = $_REQUEST['dc_no'];
	 $mycheckbox = $_REQUEST['mycheckbox']; 
	$cash_amount = $_REQUEST['cash_amount'];
	$card_amount = $_REQUEST['card_amount'];
	$card_no_1 = $_REQUEST['card_no_1'];
	$card_bank_name = $_REQUEST['card_bank_name'];
	$cheque_amount = $_REQUEST['cheque_amount'];
	$cheque_date = $_REQUEST['cheque_date'];
	$cheque_no = $_REQUEST['cheque_no'];
	$cheque_bank_name = $_REQUEST['cheque_bank_name'];
	$paytm_amount = $_REQUEST['paytm_amount'];
	$googlepay_amount = $_REQUEST['googlepay_amount'];
	$received_amount = $_REQUEST['received_amount'];
	$bill_value = $_REQUEST['bill_value'];
	$paid_amount = $_REQUEST['paid_amount'];
	$discount_percent = $_REQUEST['discount_percent'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	if($customer_1=='new'){
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_customer`(`Name`, `Address_Line1`, `Address_Line2`, `Address_Line3`, `Address_Line4`, `State`,`Country`, `Mobile_No1`, `Mobile_No2`,`Email_Id1`, `Email_Id2`, `LandLine_No1`,`LandLine_No2`,`Gst_No`, `Gst_Type`, `Pan_No`,`Created_On`,`Created_By`, `Status`) VALUES ('$Name','$Address_Line1','$Address_Line2','$Address_Line3','$Address_Line4','$State','$Country','$Mobile_No1','$Mobile_No2','$Email_Id1','$Email_Id2','$LandLine_No1','$LandLine_No2','$Gst_No','$Gst_Type','$Pan_No','$createdon','$createdby','$status')");
		
		$qry_cus = mysqli_query($con,"SELECT Max(Id) as mid FROM `tbl_customer` WHERE Status='Active'");
		$fetch_cus = mysqli_fetch_array($qry_cus);
		$customer = $fetch_cus['mid']; 
	} else {
		
		$customer = $customer_1;
	}
	
	$product_s_6 = array();
	$quantity_s_6 = array();
	$rate_s_6 = array();
	$amount_s_6 = array();
	$cgst_s_6 = array();
	$sgst_s_6 = array();
	$igst_s_6 = array();
	$netamount_s_6 = array();
	$ori_rate_s_6 = array();
	$prod_discount_s_6 = array();
	
	
	$product_s_6 = $_REQUEST['product_s_6'];
	$quantity_s_6 = $_REQUEST['quantity_s_6'];
	$rate_s_6 = $_REQUEST['rate_s_6'];
	$amount_s_6 = $_REQUEST['amount_s_6'];
	$cgst_s_6 = $_REQUEST['cgst_s_6'];
	$sgst_s_6 = $_REQUEST['sgst_s_6'];
	$igst_s_6 = $_REQUEST['igst_s_6'];
	$netamount_s_6 = $_REQUEST['netamount_s_6'];
	$ori_rate_s_6 = $_REQUEST['ori_rate_s_6'];
	$prod_discount_s_6 = $_REQUEST['prod_discount_s_6'];
	
	for($i=0;$i<sizeof($product_s_6);$i++){
		
		$product_sd_6 = $product_s_6[$i];
		$quantity_sd_6 = $quantity_s_6[$i];
		$rate_sd_6 = $rate_s_6[$i];
		$amount_sd_6 = $amount_s_6[$i];
		$cgst_sd_6 = $cgst_s_6[$i];
		$sgst_sd_6 = $sgst_s_6[$i];
		$igst_sd_6 = $igst_s_6[$i];
		$netamount_sd_6 = $netamount_s_6[$i];
		$prod_discount_sd_6 = $prod_discount_s_6[$i];
		$ori_rate_sd_6 = $ori_rate_s[$i];
		if($netamount_sd_6 !=0) {
			if($received_amount >= $net_total) {
			$Payment_Pending = "Yes"; 
		} else {
			$Payment_Pending = "No"; 
		}
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_sales`(`Customer_Id`, `Date`, `Invoice_No`,`Dc_No`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount`, `Other_Charges`, `Net_Total`, `Created_On`, `Created_By`, `Status`,`Payment_Pending`,`Discount_Percent`,`Original_Product_Rate`,`Product_Discount`,Sales_Order_No) VALUES ('$customer','$acctdate','$invoice_no','$dc_no','$product_sd_6','$quantity_sd_6','$rate_sd_6','$amount_sd_6','$cgst_sd_6','$sgst_sd_6','0','$netamount_sd_6','$total_6','$discount','$other_charge','$net_total_6','$createdon','$createdby','$status','$Payment_Pending','$discount_percent','$ori_rate_sd','$prod_discount_sd','$order_no_6')");
		
		
	}
	}
	
	$product_s = array();
	$quantity_s = array();
	$rate_s = array();
	$amount_s = array();
	$cgst_s = array();
	$sgst_s = array();
	$igst_s = array();
	$netamount_s = array();
	$ori_rate_s = array();
	$prod_discount_s = array();
	
	
	$product_s = $_REQUEST['product_s'];
	$quantity_s = $_REQUEST['quantity_s'];
	$rate_s = $_REQUEST['rate_s'];
	$amount_s = $_REQUEST['amount_s'];
	$cgst_s = $_REQUEST['cgst_s'];
	$sgst_s = $_REQUEST['sgst_s'];
	$igst_s = $_REQUEST['igst_s'];
	$netamount_s = $_REQUEST['netamount_s'];
	$ori_rate_s = $_REQUEST['ori_rate_s'];
	$prod_discount_s = $_REQUEST['prod_discount_s'];
	
	for($i=0;$i<sizeof($product_s);$i++){
		
		$product_sd = $product_s[$i];
		$quantity_sd = $quantity_s[$i];
		$rate_sd = $rate_s[$i];
		$amount_sd = $amount_s[$i];
		$cgst_sd = $cgst_s[$i];
		$sgst_sd = $sgst_s[$i];
		$igst_sd = $igst_s[$i];
		$netamount_sd = $netamount_s[$i];
		$prod_discount_sd = $prod_discount_s[$i];
		$ori_rate_sd = $ori_rate_s[$i];
		if($netamount_sd !=0) {
			if($received_amount >= $net_total) {
			$Payment_Pending = "Yes"; 
		} else {
			$Payment_Pending = "No"; 
		}
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_sales`(`Customer_Id`, `Date`, `Invoice_No`,`Dc_No`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount`, `Other_Charges`, `Net_Total`, `Created_On`, `Created_By`, `Status`,`Payment_Pending`,`Discount_Percent`,`Original_Product_Rate`,`Product_Discount`) VALUES ('$customer','$acctdate','$invoice_no','$dc_no','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','0','$netamount_sd','$total','$discount','$other_charge','$net_total','$createdon','$createdby','$status','$Payment_Pending','$discount_percent','$ori_rate_sd','$prod_discount_sd')");
		
		
	}
	}
	
	if($insert_details){
		if($mycheckbox=="Yes") {
		
			$insert_detail_receipt = mysqli_query($con,"INSERT INTO `tbl_receipts`(`Customer_Name`, `Date`, `Payment_Amount`,`Invoice_No_Purchase`,`Amount`,`Purchase_Wise_Amount`,`Mode_Of_Payment`,`Cash_Amount`, `Cheque_Amount`, `Card_Amount`, `Paytm_Amount`, `Googlepay_Amount`, `Card_No`, `Card_Bank_Name`, `Cheque_Bank_Name`,`Cheque_No`,`Cheque_Date`,`Created_On`,`Created_By`,`Status`, `Total_Received`, `Bill_Value`, `Paid_Amount`,`Reference_No`) VALUES ('$customer','$acctdate','$received_amount','$invoice_no','$Amount','$received_amount','$Mode_Of_Payment','$cash_amount','$cheque_amount','$card_amount','$paytm_amount','$googlepay_amount','$card_no_1','$card_bank_name','$cheque_bank_name','$cheque_no','$cheque_date','$createdon','$createdby','$status','$received_amount','$bill_value','$paid_amount','$ref_no')");
		}
			
			 echo '<script type="text/javascript">
										window.open("receipt_print_sales.php?inv_no='.$invoice_no.'");
							</script>';		
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("report_sales.php?step=fail");
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
        <meta name="author" content="Manoj">
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
             $("#quantity").val('');
	            $.ajax 
				({  
				type: "POST",
				url: "get_available_quantity.php",
				data:'product_id='+product_id,			 
				success: function(data){
				$("#product_id").html(data); 
				}
				});
                } 
                
        function get_dc_details(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_dc_details.php",
				data:'customer_id='+val,			 
				success: function(data){
				$("#dc_det").html(data); 
				}
				});
                } 
				
				
			function avail_check(val) {
			   var available_qty = $("#avail_qty").val();
			   
			   if(parseFloat(val) > parseFloat(available_qty)) {
				   alert("It's greater than the available quantity");
				   $("#BTNSUBMIT").show();
			   } else {
				    $("#BTNSUBMIT").show();
			   }
             } 
			 
		    function new_customer(val) {
			   
			   if(val=='new'){
				   $("#new_customer").show();
			   } else {
				    $("#new_customer").hide();
			   }
             }
            function get_purchase_order_purchase(val) {
	            $.ajax 
				({  
				type: "POST",
				url: "get_dc_details.php",
				data:'order_id='+val,			 
				success: function(data){
				$("#order_id").html(data); 
				}
				});
                } 
        function get_purchase_order(val) {
			$("#quantity").val('');
	            $.ajax 
				({  
				type: "POST",
				url: "get_sales_order_multiple.php",
				data:'purchase_id1='+val,			 
				success: function(data){
				$("#purchase_id1").html(data); 
				}
				});
                } 
        function get_purchase_order1(val) {
			$("#quantity").val('');
	            $.ajax 
				({  
				type: "POST",
				url: "get_purchase_order_multiple.php",
				data:'purchase_id2='+val,			 
				success: function(data){
				$("#purchase_id2").html(data); 
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
		<div class="col-lg-8 col-md-8"><b>Sales</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="report_sales.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Sales</a>
				</div>
			</div>
	</div>
</div>
</div>
<?php

   $order = $_REQUEST['id'];
$qury_opn="select * from tbl_sales_order where Status='Active' AND Order_No='$order'";
$qury_exe_opn=mysqli_query($con,$qury_opn);
$fetch_opn=mysqli_fetch_array($qury_exe_opn);
 $Supplier_Name = $fetch_opn['Customer_Id'];
 $Order_No = $fetch_opn['Order_No'];
?>
                <div class="panel-body"> 
                  <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
				  <div class="row">
	                 <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Customer<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="customer" id="customer" onchange="new_customer(this.value);get_dc_details(this.value);" data-live-search="true" required>
						 
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select * from tbl_customer WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
						<option value="<?php echo $Id;?>"<?php if($Id == $Supplier_Name) echo 'selected';?>><?php echo $Name;?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					 </div>
					 
				<div class="form-group col-sm-4">        
                   <label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                    <div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>
			 
                      </div>
				   </div>
				   <div class="form-group col-sm-4">
						 
						 <label for="inputName" class="col-sm-4 control-label">Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8">
							<input type="text" placeholder="Invoice No" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="invoice_no" required>
						</div>
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
		
				<div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Order No<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8">
							<input type="text" maxlength="150" id="order_no" value="<?php echo $Order_No; ?>" class="form-control limited" maxlength="15" name="order_no" required>
						</div>
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
					});
					
				
				  </script>
						</div>
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
								<td><input type="text" id="product_1" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_6[]" id="product_6_1" value="<?php echo $tid; ?>" readonly></td>
								<td><input type="text" name="quantity_s_6[]" onchange="addrow6_1(this.value);" id="quantity_6" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td><input type="text" name="rate_s_6[]" id="rate_6_1" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td><input type="text" name="amount_s_6[]" id="amount_6_1" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td><input type="text" name="cgst_s_6[]" id="cgst_6_1" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="cgst_6[]" id="prod_cgst_6_1" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="sgst_s_6[]" id="sgst_6_1" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly>
								<input type="hidden" name="sgst_6[]" id="prod_sgst_6_1" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="igst_s_6[]" id="igst_6_1" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td><input type="text" name="netamount_s_6[]" id="netamount_6_1" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								 <?php 
								 }
								  if($i==2) { 
								 ?>
								 <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_2" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_6[]" id="product_6_2" value="<?php echo $tid; ?>" ></td>
								<td style="width: 100px;"><input type="text" name="quantity_s_6[]" id="quantity_6_2" onchange="addrow6_2(this.value);" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s_6[]" id="rate_6_2" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s_6[]" id="amount_6_2" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s_6[]" id="cgst_6_2" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_2" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s_6[]" id="sgst_6_2" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_2" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s_6[]" id="igst_6_2" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s_6[]" id="netamount_6_2" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
								  <?php } if($i==3) { ?>
								   <tr>
							
								<td style="width: 100px;"><?php echo $i;?></td>
								<td><input type="text" id="product_3" value="<?php echo $product_Name; ?>" readonly><input type="hidden" name="product_s_6[]" id="product_6_3" value="<?php echo $tid; ?>"></td>
								<td ><input type="text" name="quantity_s_6[]" style="width: 100px;" onchange="addrow6_3(this.value);" id="quantity_6_3" value="<?php echo $Quantity; ?>" style="width: 100px;"></td>
								<td style="width: 100px;"><input type="text" name="rate_s_6[]" id="rate_6_3" value="<?php echo $Rate; ?>" style="width: 100px;"></td>
							    <td style="width: 100px;"><input type="text" name="amount_s_6[]" id="amount_6_3" value="<?php echo $Amount; ?>" style="width: 100px;" readonly></td>
							    <td style="width: 100px;"><input type="text" name="cgst_s_6[]" id="cgst_6_3" value="<?php echo $Cgst; ?>" style="width: 100px;" readonly><input type="hidden" name="cgst[]" id="prod_cgst_3" value="<?php echo $prod_cgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="sgst_s_6[]" id="sgst_6_3" value="<?php echo $Sgst; ?>" style="width: 100px;" readonly><input type="hidden" name="sgst[]" id="prod_sgst_3" value="<?php echo $prod_sgst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="igst_s_6[]" id="igst_6_3" value="<?php echo $Igst; ?>" style="width: 100px;" readonly></td>
								<td style="width: 100px;"><input type="text" name="netamount_s_6[]" id="netamount_6_3" value="<?php echo $Net_Amount; ?>" style="width: 100px;" readonly></td>
						
							</tr>
							<?php
								  }
								  $i++;
							}
						?>
						</tbody>
						
					</table>
					<script>
					window.onload = addrow1;
						function addrow6_1()
							{
						       
								var rate = parseFloat(document.getElementById("rate_6_1").value);
								var quantity = parseFloat(document.getElementById("quantity_6_1").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_6_1").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_6_1").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_6").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_6_1").value);
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
								
								$('#netamount_6_1').val(net_amount);
								$('#amount_6_1').val(amount);
								$('#cgst_6_1').val(cgst_1);
								$('#sgst_6_1').val(sgst_1);
								
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_6').val(netamount_ovrall_ovr);
								$('#net_total_6').val(netamount_ovrall_ovr);
							}
							
							
							function addrow6_2()
							{
						       
								var rate = parseFloat(document.getElementById("rate_6_2").value);
								
								var quantity = parseFloat(document.getElementById("quantity_6_2").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_6_2").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_6_2").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_6").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_6_2").value);
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
								
								$('#netamount_6_2').val(net_amount);
								$('#amount_6_2').val(amount);
								$('#cgst_6_2').val(cgst_1);
								$('#sgst_6_2').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_6').val(netamount_ovrall_ovr);
								$('#net_total_6').val(netamount_ovrall_ovr);
							}
							
							function addrow6_3()
							{
						       
								var rate = parseFloat(document.getElementById("rate_6_3").value);
								
								var quantity = parseFloat(document.getElementById("quantity_6_3").value);
								var cgst = parseFloat(document.getElementById("prod_sgst_6_3").value);
								var sgst = parseFloat(document.getElementById("prod_cgst_6_3").value);
								var netamount_ovr = parseFloat(document.getElementById("netamount_ovr_6").value);
								
								var netamount_1 = parseFloat(document.getElementById("netamount_6_3").value);
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
								
								$('#netamount_6_3').val(net_amount);
								$('#amount_6_3').val(amount);
								$('#cgst_6_3').val(cgst_1);
								$('#sgst_6_3').val(sgst_1);
								
								var netamount_ovrall = parseFloat(netamount_ovr) - parseFloat(netamount_1);
								
								var netamount_ovrall_ovr = (parseFloat(netamount_ovrall) + parseFloat(net_amount)).toFixed(2);
								
								$('#netamount_ovr_6').val(netamount_ovrall_ovr);
								$('#net_total_6').val(netamount_ovrall_ovr);
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
								
								<td><input type="text" name="netamount_s_6[]" id="netamount_ovr_6" value="<?php echo $Total; ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Discount</b></td>
								
								<td><input type="text" name="discount_s_6[]" id="discount_s_6" value="<?php echo $Discount ?>" readonly></td>
						
							</tr>
							<tr>
								<td colspan='7'><b>Net Total</b></td>
								
								<td><input type="text" name="net_total_6[]" id="net_total_6" value="<?php echo $Net_Total ?>" readonly></td>
						
							</tr>
							</table>
							 <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Sale Order No</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="grn" id="grn" onchange="get_purchase_order(this.value);" data-live-search="true">
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
						 <div id="purchase_id1"> </div>
						 <div id="purchase_id2"> </div>
						 <div id="purchase_id3"> </div>
						 <div id="purchase_id4"> </div>
						<br><br><br><br><br><br><br>
						<div class="row">    
				   <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Product<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="product" id="product" data-live-search="true" onchange="get_available_quantity(this.value);" required>
						 <option value="">Select Product</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_product WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$tid=$fetch_GrpQry['Id'];
							$Cgst=$fetch_GrpQry['Cgst'];
							$Sgst=$fetch_GrpQry['Sgst'];
							$Igst=$fetch_GrpQry['Igst'];
							$Hsn_Code=$fetch_GrpQry['Hsn_Code'];
							?>
							<option value="<?php echo $tid."/".$Cgst."/".$Sgst."/".$Igst."/".$Name."/".$Hsn_Code; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						</div> 
					  <div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Quantity<font color="red">&nbsp;*&nbsp;</font></label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="quantity" onKeyUp="avail_check(this.value);" class="limited" style="width:80%;" maxlength="15" name="quantity">
							<b style="width:18%;">KG</b>
							
							</div>
							
							
							</div>
<div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Original Quantity</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="quantity_original" class="limited" style="width:80%;" maxlength="15" name="quantity_original">
							<b style="width:18%;">KG</b>
							
							</div>
							
							
							</div>
						 
						  
						   <div id="product_id"> </div>
						   
						   

							 <div class="form-group col-sm-4">
						  <label for="inputName" class="col-sm-4 control-label">Product Discount</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" id="prod_dis" class="form-control limited" name="prod_dis">
							</div>
							</div> 
							 <div class="form-group col-sm-4">
						  <label for="inputName" class="col-sm-4 control-label">Rate</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" id="original_rate" class="form-control limited" name="original_rate">
							</div>
							</div>
						   </div>
						 
						    
						    <script>
						   function addrow()
							{
								//var quantity = document.getElementById("quantity").value;
								var product = document.getElementById("product").value;
								var prod_dis_1 = document.getElementById("prod_dis").value;
								var original_rate = document.getElementById("original_rate").value;
								var i_value= document.getElementById("i_value").value;
								var quantity_original = document.getElementById("quantity_original").value;
								if(i_value =='') {
									i_value = 1;
								} else {
									i_value = parseFloat(i_value)+1;
								}
								$("#i_value").val(i_value);
								
								if(quantity_original!='') {
								    	var quantity = quantity_original;
								} else {
								    	var quantity = document.getElementById("quantity").value;
								}
								
								if(original_rate == "") {
								if(prod_dis_1 ==''){
								var product_1 = product.split("/");
								var cgst = parseFloat(product_1[1]);
								var sgst = parseFloat(product_1[2]);
								var cgst_sgst = parseFloat(cgst+sgst);
								var cgst_sgst_total = parseFloat(100+cgst_sgst);
								var igst = 0;
								var rate = parseFloat(document.getElementById("rate").value);
								
								
								var ori_rate = (rate * 100)/cgst_sgst_total;
								var ori_rate_1 = ori_rate.toFixed(2);
								var amount = (quantity * ori_rate).toFixed(2);
								
								var gst_ori_amt = rate - ori_rate;
								var cgst_ori_amt = (gst_ori_amt/2).toFixed(2);
								var sgst_ori_amt = (gst_ori_amt/2).toFixed(2);
								
								var cgst_1 = (cgst_ori_amt * quantity).toFixed(2);
								var sgst_1 = (sgst_ori_amt * quantity).toFixed(2);
								
								var rate_1 = (amount/quantity).toFixed(2);
								var prod_dis =0;
								} else {
									
								var prod_dis_percent = prod_dis_1;
								var product_1 = product.split("/");
								var cgst = parseFloat(product_1[1]);
								var sgst = parseFloat(product_1[2]);
								var cgst_sgst = parseFloat(cgst+sgst);
								
								var cgst_sgst_total = parseFloat(100+cgst_sgst);
								
								var igst = 0;
								var rate = parseFloat(document.getElementById("rate").value);
								
								var ori_rate_1 = ((rate * 100)/cgst_sgst_total).toFixed(2);
								
								var prod_dis_individual = (ori_rate_1*prod_dis_percent)/100;
								var prod_dis = (ori_rate_1*prod_dis_percent)/100 * quantity;
								var ori_rate = (parseFloat(ori_rate_1-prod_dis_individual));
								
								var amount = (quantity * ori_rate).toFixed(2);
								
								var gst_ori_amt = (ori_rate*cgst_sgst_total)/100;
								var gst_disc = (gst_ori_amt-ori_rate);
								var cgst_ori_amt = gst_disc/2;
								var sgst_ori_amt = gst_disc/2;
								
								var cgst_1 = cgst_ori_amt * quantity;
								var sgst_1 = sgst_ori_amt * quantity;
								
								var rate_1 = (amount/quantity).toFixed(2);
								}
								} else {
								if(prod_dis_1 ==''){
								var product_1 = product.split("/");
								var cgst = parseFloat(product_1[1]);
								var sgst = parseFloat(product_1[2]);
								var cgst_sgst = parseFloat(cgst+sgst);
								//var cgst_sgst_total = parseFloat(100+cgst_sgst);
								var igst = 0;
								var rate = parseFloat(document.getElementById("original_rate").value);
								
								var gst = (rate * cgst_sgst)/100;
								var ori_rate = rate;
								var ori_rate_1 = ori_rate.toFixed(2);
								var amount = (quantity * ori_rate).toFixed(2);
								
								var gst_ori_amt = gst;
								var cgst_ori_amt = gst_ori_amt/2;
								var sgst_ori_amt = gst_ori_amt/2;
								
								var cgst_1 = (cgst_ori_amt * quantity);
								var sgst_1 = (sgst_ori_amt * quantity);
								
								var rate_1 = (amount/quantity).toFixed(2);
								var prod_dis =0;
								} else {
									
								var prod_dis_percent = prod_dis_1;
								var product_1 = product.split("/");
								var cgst = parseFloat(product_1[1]);
								var sgst = parseFloat(product_1[2]);
								var cgst_sgst = parseFloat(cgst+sgst);
								
								//var cgst_sgst_total = parseFloat(100+cgst_sgst);
								
								var igst = 0;
								var rate = parseFloat(document.getElementById("original_rate").value);
								
								var gst = (rate * cgst_sgst)/100;
								var ori_rate = rate;
								var ori_rate_1 = ori_rate.toFixed(2);
								
								var prod_dis_individual = (ori_rate_1*prod_dis_percent)/100;
								var prod_dis = (ori_rate_1*prod_dis_percent)/100 * quantity;
								var ori_rate = (parseFloat(ori_rate_1-prod_dis_individual));
								
								var amount = (quantity * ori_rate).toFixed(2);
								
								var gst_ori_amt = (ori_rate*cgst_sgst)/100;
								var gst_disc = gst_ori_amt-ori_rate;
								var cgst_ori_amt = gst_ori_amt/2;
								var sgst_ori_amt = gst_ori_amt/2;
								
								var cgst_1 = cgst_ori_amt * quantity;
								var sgst_1 = sgst_ori_amt * quantity;
								
								var rate_1 = (amount/quantity).toFixed(2);
								}	
								}
								
							    var btn = document.createElement('input');
								btn.type = "button";
								btn.className = "btn";
								btn.value="Delete";
								btn.setAttribute("onclick", "deleteRow(this);");
    
								var net_amount = (parseFloat(amount) + parseFloat(cgst_1) + parseFloat(sgst_1)).toFixed(2);
								
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
								var cell10 = row.insertCell(9);
								var cell11 = row.insertCell(10);
								var cell12 = row.insertCell(11);
								
								cell1.innerHTML = i_value;
								cell2.innerHTML = product_1[4];
								cell3.innerHTML = product_1[5];
								cell4.innerHTML = quantity;
								cell5.innerHTML = ori_rate_1;
								cell6.innerHTML = rate_1;
								cell7.innerHTML = amount;
								cell8.innerHTML = cgst_1;
								cell9.innerHTML = sgst_1;
								cell10.innerHTML = 0;
								cell11.innerHTML = prod_dis;
							    cell12.appendChild(btn);
								
								if(i_value ==1) {
								$("#product_1").val(product_1[0]);
								$("#quantity_1").val(quantity);
								$("#rate_1").val(rate);
								$("#ori_rate_1").val(ori_rate_1);
								$("#amount_1").val(amount);
								$("#cgst_1").val(cgst_1);
								$("#sgst_1").val(sgst_1);
								$("#igst_1").val(product_1[3]);
								$("#netamount_1").val(net_amount);
								$("#prod_dis_1").val(prod_dis);
								$("#i_val_1").val(i_value);
								
								
								} else if(i_value ==2) {
								$("#product_2").val(product_1[0]);
								$("#quantity_2").val(quantity);
								$("#rate_2").val(rate);
								$("#ori_rate_2").val(ori_rate_1);
								$("#amount_2").val(amount);
								$("#cgst_2").val(cgst_1);	
								$("#sgst_2").val(sgst_1);
								$("#igst_2").val(product_1[3]);
								$("#netamount_2").val(net_amount);
								$("#prod_dis_2").val(prod_dis);
								$("#i_val_2").val(i_value);
									
								} else if(i_value ==3) {
								$("#product_3").val(product_1[0]);
								$("#ori_rate_3").val(ori_rate_1);
								$("#quantity_3").val(quantity);
								$("#rate_3").val(rate);
								$("#amount_3").val(amount);
								$("#cgst_3").val(cgst_1);	
								$("#sgst_3").val(sgst_1);
								$("#igst_3").val(product_1[3]);
								$("#netamount_3").val(net_amount);
								$("#prod_dis_3").val(prod_dis);
								$("#i_val_3").val(i_value);
									
								} else if(i_value ==4) {
								$("#product_4").val(product_1[0]);
								$("#quantity_4").val(quantity);
								$("#rate_4").val(rate);
								$("#ori_rate_4").val(ori_rate_1);
								$("#amount_4").val(amount);
								$("#cgst_4").val(cgst_1);	
								$("#sgst_4").val(sgst_1);
								$("#igst_4").val(product_1[3]);
								$("#netamount_4").val(net_amount);
								$("#prod_dis_4").val(prod_dis);
								$("#i_val_4").val(i_value);
									
								} else if(i_value ==5) {
								$("#product_5").val(product_1[0]);
								$("#quantity_5").val(quantity);
								$("#rate_5").val(rate);
								$("#ori_rate_5").val(ori_rate_1);
								$("#amount_5").val(amount);
								$("#cgst_5").val(cgst_1);	
								$("#sgst_5").val(sgst_1);
								$("#igst_5").val(product_1[3]);
								$("#netamount_5").val(net_amount);
								$("#prod_dis_5").val(prod_dis);
								$("#i_val_5").val(i_value);
									
								} else if(i_value ==6) {
								$("#product_6").val(product_1[0]);
								$("#quantity_6").val(quantity);
								$("#rate_6").val(rate);
								$("#amount_6").val(amount);
								$("#ori_rate_6").val(ori_rate_1);
								$("#cgst_6").val(cgst_1);	
								$("#sgst_6").val(sgst_1);
								$("#igst_6").val(product_1[3]);
								$("#netamount_6").val(net_amount);
								$("#prod_dis_6").val(prod_dis);
								$("#i_val_6").val(i_value);
									
								} else if(i_value ==7) {
								$("#product_7").val(product_1[0]);
								$("#quantity_7").val(quantity);
								$("#rate_7").val(rate);
								$("#ori_rate_7").val(ori_rate_1);
								$("#amount_7").val(amount);
								$("#cgst_7").val(cgst_1);	
								$("#sgst_7").val(sgst_1);
								$("#igst_7").val(product_1[3]);
								$("#netamount_7").val(net_amount);
								$("#prod_dis_7").val(prod_dis);
								$("#i_val_7").val(i_value);
									
								} else if(i_value ==8) {
								$("#product_8").val(product_1[0]);
								$("#quantity_8").val(quantity);
								$("#rate_8").val(rate);
								$("#amount_8").val(amount);
								$("#ori_rate_8").val(ori_rate_1);
								$("#cgst_8").val(cgst_1);	
								$("#sgst_8").val(sgst_1);
								$("#igst_8").val(product_1[3]);
								$("#netamount_8").val(net_amount);
								$("#prod_dis_8").val(prod_dis);
								$("#i_val_8").val(i_value);
									
								} else if(i_value ==9) {
								$("#product_9").val(product_1[0]);
								$("#quantity_9").val(quantity);
								$("#rate_9").val(rate);
								$("#amount_9").val(amount);
								$("#cgst_9").val(cgst_1);	
								$("#ori_rate_9").val(ori_rate_1);
								$("#sgst_9").val(sgst_1);
								$("#igst_9").val(product_1[3]);
								$("#netamount_9").val(net_amount);
								$("#prod_dis_9").val(prod_dis);
								$("#i_val_9").val(i_value);
									
								} else if(i_value ==10) {
								$("#product_10").val(product_1[0]);
								$("#quantity_10").val(quantity);
								$("#rate_10").val(rate);
								$("#amount_10").val(amount);
								$("#cgst_10").val(cgst_1);	
								$("#sgst_10").val(sgst_1);
								$("#ori_rate_10").val(ori_rate_1);
								$("#igst_10").val(product_1[3]);
								$("#netamount_10").val(net_amount);
								$("#prod_dis_10").val(prod_dis);
								$("#i_val_10").val(i_value);
									
								} else if(i_value ==11) {
								$("#product_11").val(product_1[0]);
								$("#quantity_11").val(quantity);
								$("#rate_11").val(rate);
								$("#amount_11").val(amount);
								$("#cgst_11").val(cgst_1);	
								$("#ori_rate_11").val(ori_rate_1);
								$("#sgst_11").val(sgst_1);
								$("#igst_11").val(product_1[3]);
								$("#netamount_11").val(net_amount);
								$("#prod_dis_11").val(prod_dis);
									
								}
								else if(i_value ==12) {
								$("#product_12").val(product_1[0]);
								$("#quantity_12").val(quantity);
								$("#rate_12").val(rate);
								$("#amount_12").val(amount);
								$("#cgst_12").val(cgst_1);	
								$("#ori_rate_12").val(ori_rate_1);
								$("#sgst_12").val(sgst_1);
								$("#igst_12").val(product_1[3]);
								$("#netamount_12").val(net_amount);
								$("#prod_dis_12").val(prod_dis);
									
								}
								else if(i_value ==13) {
								$("#product_13").val(product_1[0]);
								$("#quantity_13").val(quantity);
								$("#rate_13").val(rate);
								$("#amount_13").val(amount);
								$("#cgst_13").val(cgst_1);	
								$("#ori_rate_13").val(ori_rate_1);
								$("#sgst_13").val(sgst_1);
								$("#igst_13").val(product_1[3]);
								$("#netamount_13").val(net_amount);
								$("#prod_dis_13").val(prod_dis);
									
								}
								else if(i_value ==14) {
								$("#product_14").val(product_1[0]);
								$("#quantity_14").val(quantity);
								$("#rate_14").val(rate);
								$("#amount_14").val(amount);
								$("#cgst_14").val(cgst_1);	
								$("#ori_rate_14").val(ori_rate_1);
								$("#sgst_14").val(sgst_1);
								$("#igst_14").val(product_1[3]);
								$("#netamount_14").val(net_amount);
								$("#prod_dis_14").val(prod_dis);
									
								} else if(i_value ==15) {
								$("#product_15").val(product_1[0]);
								$("#quantity_15").val(quantity);
								$("#rate_15").val(rate);
								$("#amount_15").val(amount);
								$("#cgst_15").val(cgst_1);	
								$("#sgst_15").val(sgst_1);
								$("#ori_rate_15").val(ori_rate_1);
								$("#igst_15").val(product_1[3]);
								$("#netamount_15").val(net_amount);
								$("#prod_dis_15").val(prod_dis);
									
								} else if(i_value ==16) {
								$("#product_16").val(product_1[0]);
								$("#quantity_16").val(quantity);
								$("#rate_16").val(rate);
								$("#amount_16").val(amount);
								$("#cgst_16").val(cgst_1);	
								$("#ori_rate_16").val(ori_rate_1);
								$("#sgst_16").val(sgst_1);
								$("#igst_16").val(product_1[3]);
								$("#netamount_16").val(net_amount);
								$("#prod_dis_16").val(prod_dis);
									
								} else if(i_value ==17) {
								$("#product_17").val(product_1[0]);
								$("#quantity_17").val(quantity);
								$("#rate_17").val(rate);
								$("#amount_17").val(amount);
								$("#cgst_17").val(cgst_1);	
								$("#sgst_17").val(sgst_1);
								$("#ori_rate_17").val(ori_rate_1);
								$("#igst_17").val(product_1[3]);
								$("#netamount_17").val(net_amount);
								$("#prod_dis_17").val(prod_dis);
									
								} else if(i_value ==18) {
								$("#product_18").val(product_1[0]);
								$("#quantity_18").val(quantity);
								$("#rate_18").val(rate);
								$("#amount_18").val(amount);
								$("#cgst_18").val(cgst_1);	
								$("#sgst_18").val(sgst_1);
								$("#ori_rate_18").val(ori_rate_1);
								$("#igst_18").val(product_1[3]);
								$("#netamount_18").val(net_amount);
								$("#prod_dis_18").val(prod_dis);
									
								}
								else if(i_value ==19) {
								$("#product_19").val(product_1[0]);
								$("#quantity_19").val(quantity);
								$("#rate_19").val(rate);
								$("#amount_19").val(amount);
								$("#cgst_19").val(cgst_1);	
								$("#sgst_19").val(sgst_1);
								$("#ori_rate_19").val(ori_rate_1);
								$("#igst_19").val(product_1[3]);
								$("#netamount_19").val(net_amount);
								$("#prod_dis_19").val(prod_dis);
									
								}
								else if(i_value ==20) {
								$("#product_20").val(product_1[0]);
								$("#quantity_20").val(quantity);
								$("#rate_20").val(rate);
								$("#amount_20").val(amount);
								$("#cgst_20").val(cgst_1);	
								$("#ori_rate_20").val(ori_rate_1);
								$("#sgst_20").val(sgst_1);
								$("#igst_20").val(product_1[3]);
								$("#netamount_20").val(net_amount);
								$("#prod_dis_20").val(prod_dis);
									
								}
								else if(i_value ==21) {
								$("#product_21").val(product_1[0]);
								$("#quantity_21").val(quantity);
								$("#rate_21").val(rate);
								$("#amount_21").val(amount);
								$("#cgst_21").val(cgst_1);	
								$("#ori_rate_21").val(ori_rate_1);
								$("#sgst_21").val(sgst_1);
								$("#igst_21").val(product_1[3]);
								$("#netamount_21").val(net_amount);
								$("#prod_dis_21").val(prod_dis);
									
								}
								else if(i_value ==22) {
								$("#product_22").val(product_1[0]);
								$("#quantity_22").val(quantity);
								$("#rate_22").val(rate);
								$("#amount_22").val(amount);
								$("#cgst_22").val(cgst_1);	
								$("#ori_rate_22").val(ori_rate_1);
								$("#sgst_22").val(sgst_1);
								$("#igst_22").val(product_1[3]);
								$("#netamount_22").val(net_amount);
								$("#prod_dis_22").val(prod_dis);
									
								}
								else if(i_value ==23) {
								$("#product_23").val(product_1[0]);
								$("#quantity_23").val(quantity);
								$("#rate_23").val(rate);
								$("#amount_23").val(amount);
								$("#cgst_23").val(cgst_1);	
								$("#ori_rate_23").val(ori_rate_1);
								$("#sgst_23").val(sgst_1);
								$("#igst_23").val(product_1[3]);
								$("#netamount_23").val(net_amount);
								$("#prod_dis_23").val(prod_dis);
									
								} else if(i_value ==24) {
								$("#product_24").val(product_1[0]);
								$("#quantity_24").val(quantity);
								$("#rate_24").val(rate);
								$("#amount_24").val(amount);
								$("#cgst_24").val(cgst_1);	
								$("#sgst_24").val(sgst_1);
								$("#ori_rate_24").val(ori_rate_1);
								$("#igst_24").val(product_1[3]);
								$("#netamount_24").val(net_amount);
								$("#prod_dis_24").val(prod_dis);
									
								} else if(i_value ==25) {
								$("#product_25").val(product_1[0]);
								$("#quantity_25").val(quantity);
								$("#rate_25").val(rate);
								$("#amount_25").val(amount);
								$("#cgst_25").val(cgst_1);	
								$("#sgst_25").val(sgst_1);
								$("#ori_rate_25").val(ori_rate_1);
								$("#igst_25").val(product_1[3]);
								$("#netamount_25").val(net_amount);
								$("#prod_dis_25").val(prod_dis);
									
								}	
								else if(i_value ==26) {
								$("#product_26").val(product_1[0]);
								$("#quantity_26").val(quantity);
								$("#rate_26").val(rate);
								$("#amount_26").val(amount);
								$("#cgst_26").val(cgst_1);	
								$("#sgst_26").val(sgst_1);
								$("#ori_rate_26").val(ori_rate_1);
								$("#igst_26").val(product_1[3]);
								$("#netamount_26").val(net_amount);
								$("#prod_dis_26").val(prod_dis);
									
								}	
								else if(i_value ==27) {
								$("#product_27").val(product_1[0]);
								$("#quantity_27").val(quantity);
								$("#rate_27").val(rate);
								$("#amount_27").val(amount);
								$("#cgst_27").val(cgst_1);	
								$("#sgst_27").val(sgst_1);
								$("#ori_rate_27").val(ori_rate_1);
								$("#igst_27").val(product_1[3]);
								$("#netamount_27").val(net_amount);
								$("#prod_dis_27").val(prod_dis);
									
								}	
								else if(i_value ==28) {
								$("#product_28").val(product_1[0]);
								$("#quantity_28").val(quantity);
								$("#rate_28").val(rate);
								$("#amount_28").val(amount);
								$("#cgst_28").val(cgst_1);	
								$("#sgst_28").val(sgst_1);
								$("#igst_28").val(product_1[3]);
								$("#ori_rate_28").val(ori_rate_1);
								$("#netamount_28").val(net_amount);
								$("#prod_dis_28").val(prod_dis);
									
								}	
								else if(i_value ==29) {
								$("#product_29").val(product_1[0]);
								$("#quantity_29").val(quantity);
								$("#rate_29").val(rate);
								$("#amount_29").val(amount);
								$("#cgst_29").val(cgst_1);	
								$("#sgst_29").val(sgst_1);
								$("#igst_29").val(product_1[3]);
								$("#netamount_29").val(net_amount);
								$("#ori_rate_29").val(ori_rate_1);	
								$("#prod_dis_29").val(prod_dis);
								}	
								else if(i_value ==30) {
								$("#product_30").val(product_1[0]);
								$("#quantity_30").val(quantity);
								$("#rate_30").val(rate);
								$("#amount_30").val(amount);
								$("#cgst_30").val(cgst_1);	
								$("#sgst_30").val(sgst_1);
								$("#igst_30").val(product_1[3]);
								$("#netamount_30").val(net_amount);
								$("#ori_rate_30").val(ori_rate_1);	
								$("#prod_dis_30").val(prod_dis);
								}	
								else if(i_value ==31) {
								$("#product_31").val(product_1[0]);
								$("#quantity_31").val(quantity);
								$("#rate_31").val(rate);
								$("#amount_31").val(amount);
								$("#cgst_31").val(cgst_1);	
								$("#sgst_31").val(sgst_1);
								$("#igst_31").val(product_1[3]);
								$("#netamount_31").val(net_amount);
								$("#ori_rate_31").val(ori_rate_1);	
								$("#prod_dis_31").val(prod_dis);
								}		
								else if(i_value ==32) {
								$("#product_32").val(product_1[0]);
								$("#quantity_32").val(quantity);
								$("#rate_32").val(rate);
								$("#amount_32").val(amount);
								$("#cgst_32").val(cgst_1);	
								$("#sgst_32").val(sgst_1);
								$("#igst_32").val(product_1[3]);
								$("#netamount_32").val(net_amount);
								$("#ori_rate_32").val(ori_rate_1);	
                                $("#prod_dis_32").val(prod_dis);								
								}		
								else if(i_value ==33) {
								$("#product_33").val(product_1[0]);
								$("#quantity_33").val(quantity);
								$("#rate_33").val(rate);
								$("#amount_33").val(amount);
								$("#cgst_33").val(cgst_1);	
								$("#sgst_33").val(sgst_1);
								$("#igst_33").val(product_1[3]);
								$("#netamount_33").val(net_amount);
								$("#ori_rate_33").val(ori_rate_1);	
                                $("#prod_dis_33").val(prod_dis);								
								}		else if(i_value ==34) {
								$("#product_34").val(product_1[0]);
								$("#quantity_34").val(quantity);
								$("#rate_34").val(rate);
								$("#amount_34").val(amount);
								$("#cgst_34").val(cgst_1);	
								$("#sgst_34").val(sgst_1);
								$("#igst_34").val(product_1[3]);
								$("#netamount_34").val(net_amount);
								$("#ori_rate_34").val(ori_rate_1);	
                                $("#prod_dis_34").val(prod_dis);								
								}		
								else if(i_value ==35) {
								$("#product_35").val(product_1[0]);
								$("#quantity_35").val(quantity);
								$("#rate_35").val(rate);
								$("#amount_35").val(amount);
								$("#cgst_35").val(cgst_1);	
								$("#sgst_35").val(sgst_1);
								$("#igst_35").val(product_1[3]);
								$("#netamount_35").val(net_amount);
								$("#ori_rate_35").val(ori_rate_1);	
                                $("#prod_dis_35").val(prod_dis);								
								}
								else if(i_value ==36) {
								$("#product_36").val(product_1[0]);
								$("#quantity_36").val(quantity);
								$("#rate_36").val(rate);
								$("#amount_36").val(amount);
								$("#cgst_36").val(cgst_1);	
								$("#sgst_36").val(sgst_1);
								$("#igst_36").val(product_1[3]);
								$("#netamount_36").val(net_amount);
								$("#ori_rate_36").val(ori_rate_1);
                                $("#prod_dis_36").val(prod_dis);								
								}
								else if(i_value ==37) {
								$("#product_37").val(product_1[0]);
								$("#quantity_37").val(quantity);
								$("#rate_37").val(rate);
								$("#amount_37").val(amount);
								$("#cgst_37").val(cgst_1);	
								$("#sgst_37").val(sgst_1);
								$("#igst_37").val(product_1[3]);
								$("#netamount_37").val(net_amount);
								$("#ori_rate_37").val(ori_rate_1);		
								$("#prod_dis_37").val(prod_dis);
								}
								else if(i_value ==38) {
								$("#product_38").val(product_1[0]);
								$("#quantity_38").val(quantity);
								$("#rate_38").val(rate);
								$("#amount_38").val(amount);
								$("#cgst_38").val(cgst_1);	
								$("#sgst_38").val(sgst_1);
								$("#igst_38").val(product_1[3]);
								$("#netamount_38").val(net_amount);
								$("#ori_rate_38").val(ori_rate_1);		
								$("#prod_dis_38").val(prod_dis);
								}
								else if(i_value ==39) {
								$("#product_39").val(product_1[0]);
								$("#quantity_39").val(quantity);
								$("#rate_39").val(rate);
								$("#amount_39").val(amount);
								$("#cgst_39").val(cgst_1);	
								$("#sgst_39").val(sgst_1);
								$("#igst_39").val(product_1[3]);
								$("#netamount_39").val(net_amount);
								$("#ori_rate_39").val(ori_rate_1);		
								$("#prod_dis_39").val(prod_dis);
								}	
								else if(i_value ==40) {
								$("#product_40").val(product_1[0]);
								$("#quantity_40").val(quantity);
								$("#rate_40").val(rate);
								$("#amount_40").val(amount);
								$("#cgst_40").val(cgst_1);	
								$("#sgst_40").val(sgst_1);
								$("#igst_40").val(product_1[3]);
								$("#netamount_40").val(net_amount);
								$("#ori_rate_40").val(ori_rate_1);		
								$("#prod_dis_40").val(prod_dis);
								}
								else if(i_value ==41) {
								$("#product_41").val(product_1[0]);
								$("#quantity_41").val(quantity);
								$("#rate_41").val(rate);
								$("#amount_41").val(amount);
								$("#cgst_41").val(cgst_1);	
								$("#sgst_41").val(sgst_1);
								$("#igst_41").val(product_1[3]);
								$("#netamount_41").val(net_amount);
									
								}
								else if(i_value ==42) {
								$("#product_42").val(product_1[0]);
								$("#quantity_42").val(quantity);
								$("#rate_42").val(rate);
								$("#amount_42").val(amount);
								$("#cgst_42").val(cgst_1);	
								$("#sgst_42").val(sgst_1);
								$("#igst_42").val(product_1[3]);
								$("#netamount_42").val(net_amount);
									
								}
								else if(i_value ==43) {
								$("#product_43").val(product_1[0]);
								$("#quantity_43").val(quantity);
								$("#rate_43").val(rate);
								$("#amount_43").val(amount);
								$("#cgst_43").val(cgst_1);	
								$("#sgst_43").val(sgst_1);
								$("#igst_43").val(product_1[3]);
								$("#netamount_43").val(net_amount);
									
								}
								else if(i_value ==44) {
								$("#product_44").val(product_1[0]);
								$("#quantity_44").val(quantity);
								$("#rate_44").val(rate);
								$("#amount_44").val(amount);
								$("#cgst_44").val(cgst_1);	
								$("#sgst_44").val(sgst_1);
								$("#igst_44").val(product_1[3]);
								$("#netamount_44").val(net_amount);
									
								}
								else if(i_value ==45) {
								$("#product_45").val(product_1[0]);
								$("#quantity_45").val(quantity);
								$("#rate_45").val(rate);
								$("#amount_45").val(amount);
								$("#cgst_45").val(cgst_1);	
								$("#sgst_45").val(sgst_1);
								$("#igst_45").val(product_1[3]);
								$("#netamount_45").val(net_amount);
									
								}
								else if(i_value ==46) {
								$("#product_46").val(product_1[0]);
								$("#quantity_46").val(quantity);
								$("#rate_46").val(rate);
								$("#amount_46").val(amount);
								$("#cgst_46").val(cgst_1);	
								$("#sgst_46").val(sgst_1);
								$("#igst_46").val(product_1[3]);
								$("#netamount_46").val(net_amount);
									
								}
								else if(i_value ==47) {
								$("#product_47").val(product_1[0]);
								$("#quantity_47").val(quantity);
								$("#rate_47").val(rate);
								$("#amount_47").val(amount);
								$("#cgst_47").val(cgst_1);	
								$("#sgst_47").val(sgst_1);
								$("#igst_47").val(product_1[3]);
								$("#netamount_47").val(net_amount);
									
								}
								else if(i_value ==48) {
								$("#product_48").val(product_1[0]);
								$("#quantity_48").val(quantity);
								$("#rate_48").val(rate);
								$("#amount_48").val(amount);
								$("#cgst_48").val(cgst_1);	
								$("#sgst_48").val(sgst_1);
								$("#igst_48").val(product_1[3]);
								$("#netamount_48").val(net_amount);
									
								}
								else if(i_value ==49) {
								$("#product_49").val(product_1[0]);
								$("#quantity_49").val(quantity);
								$("#rate_49").val(rate);
								$("#amount_49").val(amount);
								$("#cgst_49").val(cgst_1);	
								$("#sgst_49").val(sgst_1);
								$("#igst_49").val(product_1[3]);
								$("#netamount_49").val(net_amount);
									
								}
								else if(i_value ==50) {
								$("#product_50").val(product_1[0]);
								$("#quantity_50").val(quantity);
								$("#rate_50").val(rate);
								$("#amount_50").val(amount);
								$("#cgst_50").val(cgst_1);	
								$("#sgst_50").val(sgst_1);
								$("#igst_50").val(product_1[3]);
								$("#netamount_50").val(net_amount);
									
								}
								else if(i_value ==51) {
								$("#product_51").val(product_1[0]);
								$("#quantity_51").val(quantity);
								$("#rate_51").val(rate);
								$("#amount_51").val(amount);
								$("#cgst_51").val(cgst_1);	
								$("#sgst_51").val(sgst_1);
								$("#igst_51").val(product_1[3]);
								$("#netamount_51").val(net_amount);
									
								}
								else if(i_value ==52) {
								$("#product_52").val(product_1[0]);
								$("#quantity_52").val(quantity);
								$("#rate_52").val(rate);
								$("#amount_52").val(amount);
								$("#cgst_52").val(cgst_1);	
								$("#sgst_52").val(sgst_1);
								$("#igst_52").val(product_1[3]);
								$("#netamount_52").val(net_amount);
									
								}
								else if(i_value ==53) {
								$("#product_53").val(product_1[0]);
								$("#quantity_53").val(quantity);
								$("#rate_53").val(rate);
								$("#amount_53").val(amount);
								$("#cgst_53").val(cgst_1);	
								$("#sgst_53").val(sgst_1);
								$("#igst_53").val(product_1[3]);
								$("#netamount_53").val(net_amount);
									
								}
								else if(i_value ==54) {
								$("#product_54").val(product_1[0]);
								$("#quantity_54").val(quantity);
								$("#rate_54").val(rate);
								$("#amount_54").val(amount);
								$("#cgst_54").val(cgst_1);	
								$("#sgst_54").val(sgst_1);
								$("#igst_54").val(product_1[3]);
								$("#netamount_54").val(net_amount);
									
								}
								else if(i_value ==55) {
								$("#product_55").val(product_1[0]);
								$("#quantity_55").val(quantity);
								$("#rate_55").val(rate);
								$("#amount_55").val(amount);
								$("#cgst_55").val(cgst_1);	
								$("#sgst_55").val(sgst_1);
								$("#igst_55").val(product_1[3]);
								$("#netamount_55").val(net_amount);
									
								}
								else if(i_value ==56) {
								$("#product_56").val(product_1[0]);
								$("#quantity_56").val(quantity);
								$("#rate_56").val(rate);
								$("#amount_56").val(amount);
								$("#cgst_56").val(cgst_1);	
								$("#sgst_56").val(sgst_1);
								$("#igst_56").val(product_1[3]);
								$("#netamount_56").val(net_amount);
									
								}
								else if(i_value ==57) {
								$("#product_57").val(product_1[0]);
								$("#quantity_57").val(quantity);
								$("#rate_57").val(rate);
								$("#amount_57").val(amount);
								$("#cgst_57").val(cgst_1);	
								$("#sgst_57").val(sgst_1);
								$("#igst_57").val(product_1[3]);
								$("#netamount_57").val(net_amount);
									
								}
								else if(i_value ==58) {
								$("#product_58").val(product_1[0]);
								$("#quantity_58").val(quantity);
								$("#rate_58").val(rate);
								$("#amount_58").val(amount);
								$("#cgst_58").val(cgst_1);	
								$("#sgst_58").val(sgst_1);
								$("#igst_58").val(product_1[3]);
								$("#netamount_58").val(net_amount);
									
								}
								else if(i_value ==59) {
								$("#product_59").val(product_1[0]);
								$("#quantity_59").val(quantity);
								$("#rate_59").val(rate);
								$("#amount_59").val(amount);
								$("#cgst_59").val(cgst_1);	
								$("#sgst_59").val(sgst_1);
								$("#igst_59").val(product_1[3]);
								$("#netamount_59").val(net_amount);
									
								}
								else if(i_value ==60) {
								$("#product_60").val(product_1[0]);
								$("#quantity_60").val(quantity);
								$("#rate_60").val(rate);
								$("#amount_60").val(amount);
								$("#cgst_60").val(cgst_1);	
								$("#sgst_60").val(sgst_1);
								$("#igst_60").val(product_1[3]);
								$("#netamount_60").val(net_amount);
									
								}
								else if(i_value ==61) {
								$("#product_61").val(product_1[0]);
								$("#quantity_61").val(quantity);
								$("#rate_61").val(rate);
								$("#amount_61").val(amount);
								$("#cgst_61").val(cgst_1);	
								$("#sgst_61").val(sgst_1);
								$("#igst_61").val(product_1[3]);
								$("#netamount_61").val(net_amount);
									
								}
								else if(i_value ==62) {
								$("#product_62").val(product_1[0]);
								$("#quantity_62").val(quantity);
								$("#rate_62").val(rate);
								$("#amount_62").val(amount);
								$("#cgst_62").val(cgst_1);	
								$("#sgst_62").val(sgst_1);
								$("#igst_62").val(product_1[3]);
								$("#netamount_62").val(net_amount);
									
								}
								else if(i_value ==63) {
								$("#product_63").val(product_1[0]);
								$("#quantity_63").val(quantity);
								$("#rate_63").val(rate);
								$("#amount_63").val(amount);
								$("#cgst_63").val(cgst_1);	
								$("#sgst_63").val(sgst_1);
								$("#igst_63").val(product_1[3]);
								$("#netamount_63").val(net_amount);
									
								}
								else if(i_value ==64) {
								$("#product_64").val(product_1[0]);
								$("#quantity_64").val(quantity);
								$("#rate_64").val(rate);
								$("#amount_64").val(amount);
								$("#cgst_64").val(cgst_1);	
								$("#sgst_64").val(sgst_1);
								$("#igst_64").val(product_1[3]);
								$("#netamount_64").val(net_amount);
									
								}
								else if(i_value ==65) {
								$("#product_65").val(product_1[0]);
								$("#quantity_65").val(quantity);
								$("#rate_65").val(rate);
								$("#amount_65").val(amount);
								$("#cgst_65").val(cgst_1);	
								$("#sgst_65").val(sgst_1);
								$("#igst_65").val(product_1[3]);
								$("#netamount_65").val(net_amount);
									
								}
								else if(i_value ==66) {
								$("#product_66").val(product_1[0]);
								$("#quantity_66").val(quantity);
								$("#rate_66").val(rate);
								$("#amount_66").val(amount);
								$("#cgst_66").val(cgst_1);	
								$("#sgst_66").val(sgst_1);
								$("#igst_66").val(product_1[3]);
								$("#netamount_66").val(net_amount);
									
								}
								else if(i_value ==67) {
								$("#product_67").val(product_1[0]);
								$("#quantity_67").val(quantity);
								$("#rate_67").val(rate);
								$("#amount_67").val(amount);
								$("#cgst_67").val(cgst_1);	
								$("#sgst_67").val(sgst_1);
								$("#igst_67").val(product_1[3]);
								$("#netamount_67").val(net_amount);
									
								}
								else if(i_value ==68) {
								$("#product_68").val(product_1[0]);
								$("#quantity_68").val(quantity);
								$("#rate_68").val(rate);
								$("#amount_68").val(amount);
								$("#cgst_68").val(cgst_1);	
								$("#sgst_68").val(sgst_1);
								$("#igst_68").val(product_1[3]);
								$("#netamount_68").val(net_amount);
									
								}
								else if(i_value ==69) {
								$("#product_69").val(product_1[0]);
								$("#quantity_69").val(quantity);
								$("#rate_69").val(rate);
								$("#amount_69").val(amount);
								$("#cgst_69").val(cgst_1);	
								$("#sgst_69").val(sgst_1);
								$("#igst_69").val(product_1[3]);
								$("#netamount_69").val(net_amount);
									
								}
								else if(i_value ==70) {
								$("#product_70").val(product_1[0]);
								$("#quantity_70").val(quantity);
								$("#rate_70").val(rate);
								$("#amount_70").val(amount);
								$("#cgst_70").val(cgst_1);	
								$("#sgst_70").val(sgst_1);
								$("#igst_70").val(product_1[3]);
								$("#netamount_70").val(net_amount);
									
								}
								else {
									
								}
								
								var total =  document.getElementById("total").value;
								if(total <=0) {
									total_1 =0;
								} else {
									total_1 = total
								}
								var net_cgst =  document.getElementById("net_cgst").value;
								if(net_cgst <=0) {
									net_cgst_1 =0;
								} else {
									net_cgst_1 = net_cgst;
								}
								var net_sgst =  document.getElementById("net_sgst").value;
								if(net_sgst <=0) {
									net_sgst_1 =0;
								} else {
									net_sgst_1 = net_sgst;
								}
								var net_igst =  document.getElementById("net_igst").value;
								if(net_igst <=0) {
									net_igst_1 =0;
								} else {
									net_igst_1 = net_igst;
								}
								var net_total_amt =  document.getElementById("net_total_amt").value;
								if(net_total_amt <=0) {
									net_total_amt_1 =0;
								} else {
									net_total_amt_1 = net_total_amt;
								}
								
								var total_value = Math.round(parseFloat(total_1) + parseFloat(net_amount));
								$("#total").val(total_value);
								var total_net_cgst = (parseFloat(net_cgst_1) + parseFloat(cgst_1)).toFixed(2);
								$("#net_cgst").val(total_net_cgst);
								var total_net_sgst = (parseFloat(net_sgst_1) + parseFloat(sgst_1)).toFixed(2);
								$("#net_sgst").val(total_net_sgst);
								var total_net_igst = (parseFloat(net_igst_1) + parseFloat(igst_1)).toFixed(2);
								$("#net_igst").val(0);
								var total_net_total_amt = (parseFloat(net_total_amt_1) + parseFloat(amount));
								$("#net_total_amt").val(total_net_total_amt);
								
								var discount = document.getElementById("discount").value;
								var other_charge = document.getElementById("other_charge").value;
								if(discount > 0)
								{
									discount_1 = 0;
								} else {
									discount_1 = discount;
								}
								var net_total_value_1 = Math.round(parseFloat(total_value) - parseFloat(discount_1) + parseFloat(other_charge));
								$("#net_total").val(net_total_value_1);
							}
					
				  </script>
	<div class="col-sm-12" >	
    <table id="mytable" border="1">
        <tr>
		    <th>s.no</th>
            <th>Product Name</th>
            <th>HSN Code</th>
            <th>Quantity</th>
            <th>Original Product Rate</th>
            <th>Rate (include discount)</th>
            <th>Amount</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>IGST</th>
            <th>Product Discount Amount</th>
            <th>Delete</th>
        </tr>
		<tr>
          <th colspan="5" class="text-right">Total</th>
          <th><input class="form-control" type="text" id="net_total_amt" name="net_total_amt" readonly></th>
          <th><input class="form-control" type="text" id="net_cgst" name="net_cgst" readonly></th>
          <th><input class="form-control" type="text" id="net_sgst" name="net_sgst" readonly></th>
          <th><input class="form-control" type="text" id="net_igst" name="net_igst" readonly>
		  </th>
		   <th><input class="form-control" type="text" id="prod_discount_amt" name="prod_discount_amt" readonly>
		  </th>
          <!-- th><input class="form-control" type="text" id="total" name="total" readonly></th -->
        </tr>
		<tr>
          <th colspan="9" class="text-right">Net Amount</th>
          <th><input class="form-control" type="text" id="total" name="total" readonly></th>
        </tr>
	<script>
function myFunction() {
	var i_val = document.getElementById("i_value").value;
    
	if(i_val==1){
		var amount_1 = document.getElementById("amount_1").value;
		var cgst_1 = document.getElementById("cgst_1").value;
		var sgst_1 = document.getElementById("sgst_1").value;
		var netamount_1 = document.getElementById("netamount_1").value;
		
	} else if(i_val==2) {
		var amount_1 = document.getElementById("amount_2").value;
		var cgst_1 = document.getElementById("cgst_2").value;
		var sgst_1 = document.getElementById("sgst_2").value;
		var netamount_1 = document.getElementById("netamount_2").value;
		
	} else if(i_val==3) {
		var amount_1 = document.getElementById("amount_3").value;
		var cgst_1 = document.getElementById("cgst_3").value;
		var sgst_1 = document.getElementById("sgst_3").value;
		var netamount_1 = document.getElementById("netamount_3").value;
	}
	var net_total_amt = document.getElementById("net_total_amt").value;
	var net_cgst = document.getElementById("net_cgst").value;
	var net_sgst = document.getElementById("net_sgst").value;
	var total = document.getElementById("total").value;
	var net_total = document.getElementById("net_total").value;
	
	var net_total_amt_ori = net_total_amt - Math.round(amount_1);
	var cgst_ori = net_cgst - Math.round(cgst_1);
	var sgst_ori = net_sgst - Math.round(sgst_1);
	var total_ori = total - Math.round(netamount_1);
	var net_total_ori = net_total - Math.round(netamount_1);
	
	$("#net_total_amt").val(net_total_amt_ori);
	$("#net_cgst").val(cgst_ori);
	$("#net_sgst").val(sgst_ori);
	$("#total").val(total_ori);
	$("#net_total").val(net_total_ori);
	
  document.getElementById("mytable").deleteRow(1);
}
</script>
<script>
function deleteRow(r) {

  var i = r.parentNode.parentNode.rowIndex;
  var i_val = document.getElementById("i_value").value;
  
  var ori_1 = i_val-i;
  var ori = ori_1 +1;
  
  if(ori==1){
		var amount_1 = document.getElementById("amount_1").value;
		var cgst_1 = document.getElementById("cgst_1").value;
		var sgst_1 = document.getElementById("sgst_1").value;
		var netamount_1 = document.getElementById("netamount_1").value;
		
	} else if(ori==2) {
		var amount_1 = document.getElementById("amount_2").value;
		var cgst_1 = document.getElementById("cgst_2").value;
		var sgst_1 = document.getElementById("sgst_2").value;
		var netamount_1 = document.getElementById("netamount_2").value;
		
	} else if(ori==3) {
		var amount_1 = document.getElementById("amount_3").value;
		var cgst_1 = document.getElementById("cgst_3").value;
		var sgst_1 = document.getElementById("sgst_3").value;
		var netamount_1 = document.getElementById("netamount_3").value;
	}else if(ori==4) {
		var amount_1 = document.getElementById("amount_4").value;
		var cgst_1 = document.getElementById("cgst_4").value;
		var sgst_1 = document.getElementById("sgst_4").value;
		var netamount_1 = document.getElementById("netamount_4").value;
	}else if(ori==5) {
		var amount_1 = document.getElementById("amount_5").value;
		var cgst_1 = document.getElementById("cgst_5").value;
		var sgst_1 = document.getElementById("sgst_5").value;
		var netamount_1 = document.getElementById("netamount_5").value;
	}else if(ori==6) {
		var amount_1 = document.getElementById("amount_6").value;
		var cgst_1 = document.getElementById("cgst_6").value;
		var sgst_1 = document.getElementById("sgst_6").value;
		var netamount_1 = document.getElementById("netamount_6").value;
	} else {
		
	}
	
	var net_total_amt = document.getElementById("net_total_amt").value;
	var net_cgst = document.getElementById("net_cgst").value;
	var net_sgst = document.getElementById("net_sgst").value;
	var total = document.getElementById("total").value;
	var net_total = document.getElementById("net_total").value;
	
	var net_total_amt_ori = (parseFloat(net_total_amt) - parseFloat(amount_1)).toFixed(2);
	var cgst_ori = (parseFloat(net_cgst) - parseFloat(cgst_1)).toFixed(2);
	var sgst_ori = (parseFloat(net_sgst) - parseFloat(sgst_1)).toFixed(2);
	var total_ori = Math.round(parseFloat(total) - parseFloat(netamount_1));
	var net_total_ori = Math.round(parseFloat(net_total) - parseFloat(netamount_1));
	
	$("#net_total_amt").val(net_total_amt_ori);
	$("#net_cgst").val(cgst_ori);
	$("#net_sgst").val(sgst_ori);
	$("#total").val(total_ori);
	$("#net_total").val(net_total_ori);
	
	
                                if(ori ==1) {
								$("#product_1").val(0);
								$("#quantity_1").val(0);
								$("#rate_1").val(0);
								$("#ori_rate_1").val(0);
								$("#amount_1").val(0);
								$("#cgst_1").val(0);
								$("#sgst_1").val(0);
								$("#igst_1").val(0);
								$("#netamount_1").val(0);
								$("#prod_dis_1").val(0);
								$("#i_val_1").val(i_value);
								
								
								} else if(i_value ==2) {
								$("#product_2").val(0);
								$("#quantity_2").val(0);
								$("#rate_2").val(0);
								$("#ori_rate_2").val(0);
								$("#amount_2").val(0);
								$("#cgst_2").val(0);	
								$("#sgst_2").val(0);
								$("#igst_2").val(0);
								$("#netamount_2").val(0);
								$("#prod_dis_2").val(0);
								$("#i_val_2").val(i_value);
									
								} else if(i_value ==3) {
								$("#product_3").val(0);
								$("#ori_rate_3").val(0);
								$("#quantity_3").val(0);
								$("#rate_3").val(0);
								$("#amount_3").val(0);
								$("#cgst_3").val(0);	
								$("#sgst_3").val(0);
								$("#igst_3").val(0);
								$("#netamount_3").val(0);
								$("#prod_dis_3").val(0);
								$("#i_val_3").val(i_value);
									
								} else if(i_value ==4) {
								$("#product_4").val(0);
								$("#quantity_4").val(0);
								$("#rate_4").val(0);
								$("#ori_rate_4").val(0);
								$("#amount_4").val(0);
								$("#cgst_4").val(0);	
								$("#sgst_4").val(0);
								$("#igst_4").val(0);
								$("#netamount_4").val(0);
								$("#prod_dis_4").val(0);
								$("#i_val_4").val(i_value);
									
								} else if(i_value ==5) {
								$("#product_5").val(0);
								$("#quantity_5").val(0);
								$("#rate_5").val(0);
								$("#ori_rate_5").val(0);
								$("#amount_5").val(0);
								$("#cgst_5").val(0);	
								$("#sgst_5").val(0);
								$("#igst_5").val(0);
								$("#netamount_5").val(0);
								$("#prod_dis_5").val(0);
								$("#i_val_5").val(i_value);
									
								} else if(i_value ==6) {
								$("#product_6").val(0);
								$("#quantity_6").val(0);
								$("#rate_6").val(0);
								$("#amount_6").val(0);
								$("#ori_rate_6").val(0);
								$("#cgst_6").val(0);	
								$("#sgst_6").val(0);
								$("#igst_6").val(0);
								$("#netamount_6").val(0);
								$("#prod_dis_6").val(0);
								$("#i_val_6").val(i_value);
									
								} else {
									
								}
  
  document.getElementById("mytable").deleteRow(i);
}
</script>


		<script>
		function get_discount(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var total = document.getElementById("total").value;
				var dis_net_total =  parseFloat(total) - parseFloat(val_1);
				$("#net_total").val(dis_net_total);
			}
		</script>
		<script>
		function discount_check(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var net_total_amt = document.getElementById("net_total_amt").value;
                var net_cgst = document.getElementById("net_cgst").value;
                var net_sgst = document.getElementById("net_sgst").value;
                var net_igst = document.getElementById("net_igst").value;
				
				var tot = Math.round((net_total_amt*val_1)/100);
				
			    var tot_amt_val = parseFloat(net_total_amt) - parseFloat(tot);
				var net_tot_amt = Math.round(parseFloat(tot_amt_val) + parseFloat(net_cgst) + parseFloat(net_sgst) + parseFloat(net_igst));
				var tot_amt = parseFloat(net_total_amt) + parseFloat(net_cgst) + parseFloat(net_sgst) + parseFloat(net_igst);
				$("#total").val(tot_amt);
				$("#discount").val(tot);
				$("#net_total").val(net_tot_amt);
			}
		</script>
		<tr>
          <th colspan="9" class="text-right">Discount</th>
          <th><input type="text" id="discount" name="discount" readonly></th>
        </tr>
		<tr>
          <th colspan="9" class="text-right">Other Charges</th>
          <th><input type="text" id="other_charge" onkeyup="get_othercharge(this.value);" name="other_charge"></th>
        </tr>
		<tr>
          <th colspan="9" class="text-right">Net Total</th>
          <th><input type="text" id="net_total" name="net_total" readonly></th>
        </tr>

    </table>

	<input type="hidden" id="i_value">
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_1">
	<input type="hidden" name="quantity_s[]" id="quantity_1">
	<input type="hidden" name="rate_s[]" id="rate_1">
	<input type="hidden" name="amount_s[]" id="amount_1">
	<input type="hidden" name="cgst_s[]" id="cgst_1">
	<input type="hidden" name="sgst_s[]" id="sgst_1">
	<input type="hidden" name="igst_s[]" id="igst_1">
	<input type="hidden" name="netamount_s[]" id="netamount_1">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_1">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_1">
	<input type="hidden" name="i_val[]" id="i_val_1">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_2">
	<input type="hidden" name="quantity_s[]" id="quantity_2">
	<input type="hidden" name="rate_s[]" id="rate_2">
	<input type="hidden" name="amount_s[]" id="amount_2">
	<input type="hidden" name="cgst_s[]" id="cgst_2">
	<input type="hidden" name="sgst_s[]" id="sgst_2">
	<input type="hidden" name="igst_s[]" id="igst_2">
	<input type="hidden" name="netamount_s[]" id="netamount_2">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_2">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_2">
	<input type="hidden" name="i_val[]" id="i_val_2">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_3">
	<input type="hidden" name="quantity_s[]" id="quantity_3">
	<input type="hidden" name="rate_s[]" id="rate_3">
	<input type="hidden" name="amount_s[]" id="amount_3">
	<input type="hidden" name="cgst_s[]" id="cgst_3">
	<input type="hidden" name="sgst_s[]" id="sgst_3">
	<input type="hidden" name="igst_s[]" id="igst_3">
	<input type="hidden" name="netamount_s[]" id="netamount_3">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_3">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_3">
	<input type="hidden" name="i_val[]" id="i_val_3">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_4">
	<input type="hidden" name="quantity_s[]" id="quantity_4">
	<input type="hidden" name="rate_s[]" id="rate_4">
	<input type="hidden" name="amount_s[]" id="amount_4">
	<input type="hidden" name="cgst_s[]" id="cgst_4">
	<input type="hidden" name="sgst_s[]" id="sgst_4">
	<input type="hidden" name="igst_s[]" id="igst_4">
	<input type="hidden" name="netamount_s[]" id="netamount_4">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_4">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_4">
	<input type="hidden" name="i_val[]" id="i_val_4">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_5">
	<input type="hidden" name="quantity_s[]" id="quantity_5">
	<input type="hidden" name="rate_s[]" id="rate_5">
	<input type="hidden" name="amount_s[]" id="amount_5">
	<input type="hidden" name="cgst_s[]" id="cgst_5">
	<input type="hidden" name="sgst_s[]" id="sgst_5">
	<input type="hidden" name="igst_s[]" id="igst_5">
	<input type="hidden" name="netamount_s[]" id="netamount_5">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_5">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_5">
	<input type="hidden" name="i_val[]" id="i_val_5">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_6">
	<input type="hidden" name="quantity_s[]" id="quantity_6">
	<input type="hidden" name="rate_s[]" id="rate_6">
	<input type="hidden" name="amount_s[]" id="amount_6">
	<input type="hidden" name="cgst_s[]" id="cgst_6">
	<input type="hidden" name="sgst_s[]" id="sgst_6">
	<input type="hidden" name="igst_s[]" id="igst_6">
	<input type="hidden" name="netamount_s[]" id="netamount_6">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_6">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_6">
	<input type="hidden" name="i_val[]" id="i_val_6">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_7">
	<input type="hidden" name="quantity_s[]" id="quantity_7">
	<input type="hidden" name="rate_s[]" id="rate_7">
	<input type="hidden" name="amount_s[]" id="amount_7">
	<input type="hidden" name="cgst_s[]" id="cgst_7">
	<input type="hidden" name="sgst_s[]" id="sgst_7">
	<input type="hidden" name="igst_s[]" id="igst_7">
	<input type="hidden" name="netamount_s[]" id="netamount_7">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_7">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_7">
	<input type="hidden" name="i_val[]" id="i_val_7">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_8">
	<input type="hidden" name="quantity_s[]" id="quantity_8">
	<input type="hidden" name="rate_s[]" id="rate_8">
	<input type="hidden" name="amount_s[]" id="amount_8">
	<input type="hidden" name="cgst_s[]" id="cgst_8">
	<input type="hidden" name="sgst_s[]" id="sgst_8">
	<input type="hidden" name="igst_s[]" id="igst_8">
	<input type="hidden" name="netamount_s[]" id="netamount_8">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_8">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_8">
	<input type="hidden" name="i_val[]" id="i_val_8">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_9">
	<input type="hidden" name="quantity_s[]" id="quantity_9">
	<input type="hidden" name="rate_s[]" id="rate_9">
	<input type="hidden" name="amount_s[]" id="amount_9">
	<input type="hidden" name="cgst_s[]" id="cgst_9">
	<input type="hidden" name="sgst_s[]" id="sgst_9">
	<input type="hidden" name="igst_s[]" id="igst_9">
	<input type="hidden" name="netamount_s[]" id="netamount_9">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_9">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_9">
	<input type="hidden" name="i_val[]" id="i_val_9">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_10">
	<input type="hidden" name="quantity_s[]" id="quantity_10">
	<input type="hidden" name="rate_s[]" id="rate_10">
	<input type="hidden" name="amount_s[]" id="amount_10">
	<input type="hidden" name="cgst_s[]" id="cgst_10">
	<input type="hidden" name="sgst_s[]" id="sgst_10">
	<input type="hidden" name="igst_s[]" id="igst_10">
	<input type="hidden" name="netamount_s[]" id="netamount_10">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_10">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_10">
	<input type="hidden" name="i_val[]" id="i_val_10">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_11">
	<input type="hidden" name="quantity_s[]" id="quantity_11">
	<input type="hidden" name="rate_s[]" id="rate_11">
	<input type="hidden" name="amount_s[]" id="amount_11">
	<input type="hidden" name="cgst_s[]" id="cgst_11">
	<input type="hidden" name="sgst_s[]" id="sgst_11">
	<input type="hidden" name="igst_s[]" id="igst_11">
	<input type="hidden" name="netamount_s[]" id="netamount_11">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_11">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_11">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_12">
	<input type="hidden" name="quantity_s[]" id="quantity_12">
	<input type="hidden" name="rate_s[]" id="rate_12">
	<input type="hidden" name="amount_s[]" id="amount_12">
	<input type="hidden" name="cgst_s[]" id="cgst_12">
	<input type="hidden" name="sgst_s[]" id="sgst_12">
	<input type="hidden" name="igst_s[]" id="igst_12">
	<input type="hidden" name="netamount_s[]" id="netamount_12">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_12">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_12">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_13">
	<input type="hidden" name="quantity_s[]" id="quantity_13">
	<input type="hidden" name="rate_s[]" id="rate_13">
	<input type="hidden" name="amount_s[]" id="amount_13">
	<input type="hidden" name="cgst_s[]" id="cgst_13">
	<input type="hidden" name="sgst_s[]" id="sgst_13">
	<input type="hidden" name="igst_s[]" id="igst_13">
	<input type="hidden" name="netamount_s[]" id="netamount_13">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_13">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_13">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_14">
	<input type="hidden" name="quantity_s[]" id="quantity_14">
	<input type="hidden" name="rate_s[]" id="rate_14">
	<input type="hidden" name="amount_s[]" id="amount_14">
	<input type="hidden" name="cgst_s[]" id="cgst_14">
	<input type="hidden" name="sgst_s[]" id="sgst_14">
	<input type="hidden" name="igst_s[]" id="igst_14">
	<input type="hidden" name="netamount_s[]" id="netamount_14">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_14">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_14">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_15">
	<input type="hidden" name="quantity_s[]" id="quantity_15">
	<input type="hidden" name="rate_s[]" id="rate_15">
	<input type="hidden" name="amount_s[]" id="amount_15">
	<input type="hidden" name="cgst_s[]" id="cgst_15">
	<input type="hidden" name="sgst_s[]" id="sgst_15">
	<input type="hidden" name="igst_s[]" id="igst_15">
	<input type="hidden" name="netamount_s[]" id="netamount_15">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_15">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_15">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_16">
	<input type="hidden" name="quantity_s[]" id="quantity_16">
	<input type="hidden" name="rate_s[]" id="rate_16">
	<input type="hidden" name="amount_s[]" id="amount_16">
	<input type="hidden" name="cgst_s[]" id="cgst_16">
	<input type="hidden" name="sgst_s[]" id="sgst_16">
	<input type="hidden" name="igst_s[]" id="igst_16">
	<input type="hidden" name="netamount_s[]" id="netamount_16">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_16">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_16">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_17">
	<input type="hidden" name="quantity_s[]" id="quantity_17">
	<input type="hidden" name="rate_s[]" id="rate_17">
	<input type="hidden" name="amount_s[]" id="amount_17">
	<input type="hidden" name="cgst_s[]" id="cgst_17">
	<input type="hidden" name="sgst_s[]" id="sgst_17">
	<input type="hidden" name="igst_s[]" id="igst_17">
	<input type="hidden" name="netamount_s[]" id="netamount_17">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_17">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_17">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_18">
	<input type="hidden" name="quantity_s[]" id="quantity_18">
	<input type="hidden" name="rate_s[]" id="rate_18">
	<input type="hidden" name="amount_s[]" id="amount_18">
	<input type="hidden" name="cgst_s[]" id="cgst_18">
	<input type="hidden" name="sgst_s[]" id="sgst_18">
	<input type="hidden" name="igst_s[]" id="igst_18">
	<input type="hidden" name="netamount_s[]" id="netamount_18">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_18">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_18">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_19">
	<input type="hidden" name="quantity_s[]" id="quantity_19">
	<input type="hidden" name="rate_s[]" id="rate_19">
	<input type="hidden" name="amount_s[]" id="amount_19">
	<input type="hidden" name="cgst_s[]" id="cgst_19">
	<input type="hidden" name="sgst_s[]" id="sgst_19">
	<input type="hidden" name="igst_s[]" id="igst_19">
	<input type="hidden" name="netamount_s[]" id="netamount_19">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_19">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_19">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_20">
	<input type="hidden" name="quantity_s[]" id="quantity_20">
	<input type="hidden" name="rate_s[]" id="rate_20">
	<input type="hidden" name="amount_s[]" id="amount_20">
	<input type="hidden" name="cgst_s[]" id="cgst_20">
	<input type="hidden" name="sgst_s[]" id="sgst_20">
	<input type="hidden" name="igst_s[]" id="igst_20">
	<input type="hidden" name="netamount_s[]" id="netamount_20">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_20">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_20">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_21">
	<input type="hidden" name="quantity_s[]" id="quantity_21">
	<input type="hidden" name="rate_s[]" id="rate_21">
	<input type="hidden" name="amount_s[]" id="amount_21">
	<input type="hidden" name="cgst_s[]" id="cgst_21">
	<input type="hidden" name="sgst_s[]" id="sgst_21">
	<input type="hidden" name="igst_s[]" id="igst_21">
	<input type="hidden" name="netamount_s[]" id="netamount_21">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_21">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_21">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_22">
	<input type="hidden" name="quantity_s[]" id="quantity_22">
	<input type="hidden" name="rate_s[]" id="rate_22">
	<input type="hidden" name="amount_s[]" id="amount_22">
	<input type="hidden" name="cgst_s[]" id="cgst_22">
	<input type="hidden" name="sgst_s[]" id="sgst_22">
	<input type="hidden" name="igst_s[]" id="igst_22">
	<input type="hidden" name="netamount_s[]" id="netamount_22">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_22">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_22">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_23">
	<input type="hidden" name="quantity_s[]" id="quantity_23">
	<input type="hidden" name="rate_s[]" id="rate_23">
	<input type="hidden" name="amount_s[]" id="amount_23">
	<input type="hidden" name="cgst_s[]" id="cgst_23">
	<input type="hidden" name="sgst_s[]" id="sgst_23">
	<input type="hidden" name="igst_s[]" id="igst_23">
	<input type="hidden" name="netamount_s[]" id="netamount_23">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_23">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_23">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_24">
	<input type="hidden" name="quantity_s[]" id="quantity_24">
	<input type="hidden" name="rate_s[]" id="rate_24">
	<input type="hidden" name="amount_s[]" id="amount_24">
	<input type="hidden" name="cgst_s[]" id="cgst_24">
	<input type="hidden" name="sgst_s[]" id="sgst_24">
	<input type="hidden" name="igst_s[]" id="igst_24">
	<input type="hidden" name="netamount_s[]" id="netamount_24">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_24">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_24">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_25">
	<input type="hidden" name="quantity_s[]" id="quantity_25">
	<input type="hidden" name="rate_s[]" id="rate_25">
	<input type="hidden" name="amount_s[]" id="amount_25">
	<input type="hidden" name="cgst_s[]" id="cgst_25">
	<input type="hidden" name="sgst_s[]" id="sgst_25">
	<input type="hidden" name="igst_s[]" id="igst_25">
	<input type="hidden" name="netamount_s[]" id="netamount_25">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_25">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_25">
	</div>
						 <div class="col-sm-12">                        
		  <br>
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

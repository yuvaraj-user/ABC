<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	$supplier = $_REQUEST['supplier'];
	$acctdate = $_REQUEST['acctdate'];
	$invoice_no = $_REQUEST['invoice_no'];
	$discount = $_REQUEST['discount'];
	$other_charge = $_REQUEST['other_charge'];
	$net_total = $_REQUEST['net_total'];
	$total = $_REQUEST['total'];
	$grn_no = $_REQUEST['grn_no'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	
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
	$cgst_s = $_REQUEST['cgst_s'];
	$sgst_s = $_REQUEST['sgst_s'];
	$igst_s = $_REQUEST['igst_s'];
	$netamount_s = $_REQUEST['netamount_s'];
	
	for($i=0;$i<sizeof($product_s);$i++){
		
		$product_sd = $product_s[$i];
		$quantity_sd = $quantity_s[$i];
		$rate_sd = $rate_s[$i];
		$amount_sd = $amount_s[$i];
		$cgst_sd = $cgst_s[$i];
		$sgst_sd = $sgst_s[$i];
		$igst_sd = $igst_s[$i];
		$netamount_sd = $netamount_s[$i];
		if($netamount_sd !=0) {
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_grn`(`Supplier_Name`, `Date`, `Invoice_No`,`Grn_No`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount`, `Other_Charges`, `Net_Total`, `Created_On`, `Created_By`, `Status`) VALUES ('$supplier','$acctdate','$invoice_no','$grn_no','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','$igst_sd','$netamount_sd','$total','$discount','$other_charge','$net_total','$createdon','$createdby','$status')");
	}
	}
	if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_grn.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_grn.php?step=fail");
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
		<div class="col-lg-8 col-md-8"><b>Add GRN</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_grn.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View GRN</a>
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                  <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
				  <div class="row">
	                 <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Supplier</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="supplier" id="supplier" data-live-search="true" required>
						 <option value="">Select Supplier</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_supplier WHERE Status='Active'");
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
				<div class="form-group col-sm-4">        
                   <label for="inputName" class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo date('d-m-Y');?>" name="acctdate" id="acctopendate" required>
			 
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
		
				<div class="row">
	                 
				   <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">GRN No</label>
						 <div class="col-sm-8">
							<input type="text" placeholder="GRN No" maxlength="150" id="grn_no"  class="form-control limited" maxlength="15" name="grn_no">
						</div>
						</div>
						</div>
				   <div class="row">    
				   <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Product</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="product" id="product" data-live-search="true" onchange="get_available_quantity(this.value);" required>
						 <option value="">Select Product</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_product WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							$Cgst=$fetch_GrpQry['Cgst'];
							$Sgst=$fetch_GrpQry['Sgst'];
							$Igst=$fetch_GrpQry['Igst'];
							?>
							<option value="<?php echo $Id."/".$Cgst."/".$Sgst."/".$Igst."/".$Name; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						</div> 
					  <div class="form-group col-sm-4">
						  <label for="inputName" class="col-sm-4 control-label">Quantity</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="quantity" class="form-control limited" maxlength="15" name="quantity">
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
								var amount = quantity * rate;
								var net_amount = amount + cgst + sgst + igst;
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
								cell1.innerHTML = product_1[4];
								cell2.innerHTML = quantity;
								cell3.innerHTML = rate;
								cell4.innerHTML = amount;
								cell5.innerHTML = product_1[1];
								cell6.innerHTML = product_1[2];
								cell7.innerHTML =0;
								cell8.innerHTML = net_amount;
								
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
								$("#cgst_1").val(product_1[1]);
								$("#sgst_1").val(product_1[2]);
								$("#igst_1").val(product_1[3]);
								$("#netamount_1").val(net_amount);
								
								
								} else if(i_value ==2) {
								$("#product_2").val(product_1[0]);
								$("#quantity_2").val(quantity);
								$("#rate_2").val(rate);
								$("#amount_2").val(amount);
								$("#cgst_2").val(product_1[1]);	
								$("#sgst_2").val(product_1[2]);
								$("#igst_2").val(product_1[3]);
								$("#netamount_2").val(net_amount);
									
								} else if(i_value ==3) {
								$("#product_3").val(product_1[0]);
								$("#quantity_3").val(quantity);
								$("#rate_3").val(rate);
								$("#amount_3").val(amount);
								$("#cgst_3").val(product_1[1]);	
								$("#sgst_3").val(product_1[2]);
								$("#igst_3").val(product_1[3]);
								$("#netamount_3").val(net_amount);
									
								} else if(i_value ==4) {
								$("#product_4").val(product_1[0]);
								$("#quantity_4").val(quantity);
								$("#rate_4").val(rate);
								$("#amount_4").val(amount);
								$("#cgst_4").val(product_1[1]);	
								$("#sgst_4").val(product_1[2]);
								$("#igst_4").val(product_1[3]);
								$("#netamount_4").val(net_amount);
									
								} else if(i_value ==5) {
								$("#product_5").val(product_1[0]);
								$("#quantity_5").val(quantity);
								$("#rate_5").val(rate);
								$("#amount_5").val(amount);
								$("#cgst_5").val(product_1[1]);	
								$("#sgst_5").val(product_1[2]);
								$("#igst_5").val(product_1[3]);
								$("#netamount_5").val(net_amount);
									
								} else if(i_value ==6) {
								$("#product_6").val(product_1[0]);
								$("#quantity_6").val(quantity);
								$("#rate_6").val(rate);
								$("#amount_6").val(amount);
								$("#cgst_6").val(product_1[1]);	
								$("#sgst_6").val(product_1[2]);
								$("#igst_6").val(product_1[3]);
								$("#netamount_6").val(net_amount);
									
								} else if(i_value ==7) {
								$("#product_7").val(product_1[0]);
								$("#quantity_7").val(quantity);
								$("#rate_7").val(rate);
								$("#amount_7").val(amount);
								$("#cgst_7").val(product_1[1]);	
								$("#sgst_7").val(product_1[2]);
								$("#igst_7").val(product_1[3]);
								$("#netamount_7").val(net_amount);
									
								} else if(i_value ==8) {
								$("#product_8").val(product_1[0]);
								$("#quantity_8").val(quantity);
								$("#rate_8").val(rate);
								$("#amount_8").val(amount);
								$("#cgst_8").val(product_1[1]);	
								$("#sgst_8").val(product_1[2]);
								$("#igst_8").val(product_1[3]);
								$("#netamount_8").val(net_amount);
									
								} else if(i_value ==9) {
								$("#product_9").val(product_1[0]);
								$("#quantity_9").val(quantity);
								$("#rate_9").val(rate);
								$("#amount_9").val(amount);
								$("#cgst_9").val(product_1[1]);	
								$("#sgst_9").val(product_1[2]);
								$("#igst_9").val(product_1[3]);
								$("#netamount_9").val(net_amount);
									
								} else if(i_value ==10) {
								$("#product_10").val(product_1[0]);
								$("#quantity_10").val(quantity);
								$("#rate_10").val(rate);
								$("#amount_10").val(amount);
								$("#cgst_10").val(product_1[1]);	
								$("#sgst_10").val(product_1[2]);
								$("#igst_10").val(product_1[3]);
								$("#netamount_10").val(net_amount);
									
								} else if(i_value ==11) {
								$("#product_11").val(product_1[0]);
								$("#quantity_11").val(quantity);
								$("#rate_11").val(rate);
								$("#amount_11").val(amount);
								$("#cgst_11").val(product_1[1]);	
								$("#sgst_11").val(product_1[2]);
								$("#igst_11").val(product_1[3]);
								$("#netamount_11").val(net_amount);
									
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
								var discount = document.getElementById("discount").value;
								var other_charge = document.getElementById("other_charge").value;
								if(discount > 0)
								{
									discount_1 = 0;
								} else {
									discount_1 = discount;
								}
								var net_total_value_1 = parseFloat(total_value) - parseFloat(discount_1) + parseFloat(other_charge);
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
            <th>CGST</th>
            <th>SGST</th>
            <th>IGST</th>
            <th>Net Amount</th>
        </tr>
		<tr>
          <th colspan="7" class="text-right">Total</th>
          <th><input type="text" id="total" name="total" readonly></th>
        </tr>
		<script>
		function get_discount(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var net_total = document.getElementById("net_total").value;
                var oth_chg = document.getElementById("other_charge").value;
				var dis_net_total =  parseFloat(net_total) - parseFloat(val_1);
				$("#net_total").val(dis_net_total);
			}
		</script>
		<tr>
          <th colspan="7" class="text-right">Discount</th>
          <th><input type="text" id="discount" onkeyup="get_discount(this.value);" name="discount"></th>
        </tr>
		<tr>
          <th colspan="7" class="text-right">Other Charges</th>
          <th><input type="text" id="other_charge" onkeyup="get_othercharge(this.value);" name="other_charge"></th>
        </tr>
		<tr>
          <th colspan="7" class="text-right">Net Total</th>
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
	</div>
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

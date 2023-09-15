<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {
	$customer_1 = $_REQUEST['customer'];
	$source = $_REQUEST['source'];
	$employee = $_REQUEST['employee'];
	$date = $_REQUEST['acctdate'];
		$acctdate = $_REQUEST['acctdate_1'];
	$lead_id = $_REQUEST['lead_id'];
	$employee_transfer = $_REQUEST['employee_transfer'];
	$remark_cus = $_REQUEST['remark_cus'];
    $lead_type = $_REQUEST['lead_type'];
    $export_type = $_REQUEST['export_type'];
    $remarks = $_REQUEST['remarks'];
    $company_name = $_REQUEST['company_name'];
    $address = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $mobile_no = $_REQUEST['mobile_no'];
    $gst_no = $_REQUEST['gst_no'];
    $state = $_REQUEST['state'];
    $district = $_REQUEST['district'];
    $city = $_REQUEST['city'];
    $pincode = $_REQUEST['pincode'];
   
	$status = "Active";
	$createdon = date("d-m-Y H:i:s A");
	$createdby = $_SESSION['usersessionid'];


	if ($customer_1 == 'new') {
		$insert_details = mysqli_query($con, "INSERT INTO `tbl_customer`(`Company_Name`, `Company_Address`, `State`, `District`, `City`, `Pincode`, `Mobile_No`, `Email_Id`, `Gst`,  `Created_On`, `Created_By`, `Status`) VALUES ('$company_name','$address','$state','$district','$city','$pincode','$mobile_no','$email','$gst_no','$createdon','$createdby','Active')");

		$qry_cus = mysqli_query($con, "SELECT Max(Id) as mid FROM `tbl_customer` WHERE Status='Active'");
		$fetch_cus = mysqli_fetch_array($qry_cus);
		$customer = $fetch_cus['mid'];
		
		
		$contact_person = array();
	    $contact_mobile = array();
	    $contact_email = array();
		
		$contact_person = $_REQUEST['contact_name'];
	    $contact_mobile = $_REQUEST['contact_mobile'];
	    $contact_email = $_REQUEST['contact_email'];
		
		for ($i = 0; $i < sizeof($contact_person); $i++) {

		$contact_person_sd = $contact_person[$i];
		$contact_mobile_sd = $contact_mobile[$i];
		$contact_email_sd = $contact_email[$i];
		
		$insert_details_cus = mysqli_query($con, "INSERT INTO `tbl_contact_person`( `Customer_Id`, `Name`, `Mobile_No`, `Email`) VALUES ('$customer','$contact_person_sd','$contact_mobile_sd','$contact_email_sd')");
		}
		
	} else {

		$customer = $customer_1;
	}

        $insert_details_lead = mysqli_query($con, "INSERT INTO `tbl_lead`(`Lead_No`, `Customer_Id`, `Source_Id`, `Employee_Id`, `Date`, `Followup_Employee`, `Followup_Status`, `Created_On`, `Created_By`, `Status`,Lead_Type,Remarks,Remark_2) VALUES ('$lead_id','$customer','$source','$employee','$date','$employee_transfer','follow','$createdon','$createdby','Active','$lead_type','$remarks','$remark_cus')");
		
		$qry_lead = mysqli_query($con, "SELECT Max(Id) as mid FROM `tbl_lead` WHERE Status='Active'");
		$fetch_lead = mysqli_fetch_array($qry_lead);
		$lead = $fetch_lead['mid'];
	
    if($insert_details_lead){
        
             $insert_details = mysqli_query($con, "INSERT INTO `tbl_followup`(`Lead_Id`, `Entry_Date`, `Followup_Date`, `Status`) VALUES ('$lead','$date','$acctdate','Active')");
        
        
		$product = array();
	    $quantity = array();
	    $rate = array();
		
		$product = $_REQUEST['product'];
	    $quantity = $_REQUEST['quantity'];
	    $rate = $_REQUEST['rate'];
		
		for ($i = 0; $i < sizeof($product); $i++) {

		$product_sd = $product[$i];
	$quantity_sd = $quantity[$i]; 
		$rate_sd = $rate[$i];
		if($quantity_sd > '0'){
		    
		$insert_details_cus = mysqli_query($con, "INSERT INTO `tbl_lead_products`( `Lead_Id`, `Product_Id`, `Quantity`, `Rate`, `Status`, `Order_Date`) VALUES ('$lead','$product_sd','$quantity_sd','$rate_sd','Active','$date')");
		}
		
		}
		
		echo '<script type="text/javascript">
										window.open("add_lead.php?step=suces");
							</script>';
	} else {
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
			$.ajax({
				type: "POST",
				url: "get_available_quantity.php",
				data: 'product_id=' + product_id,
				success: function(data) {
					$("#product_id").html(data);
				}
			});
		}


		function avail_check(val) {
			var available_qty = $("#avail_qty").val();

			if (parseFloat(val) > parseFloat(available_qty)) {
				alert("It's greater than the available quantity");
				$("#BTNSUBMIT").show();
			} else {
				$("#BTNSUBMIT").show();
			}
		}

		function new_customer(val) {

			if (val == 'new') {
				$("#new_customer").show();
			} else {
				$("#new_customer").hide();
			}
		}

		function getdistrict(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'state_id=' + val,
				success: function(data) {
					$("#district-list").html(data);
					$('#groupNameTemp').selectpicker({});
				}
			});
		}

		function getcity(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'district_id=' + val,
				success: function(data) {
					$("#city-list").html(data);
					$('#branchcity').selectpicker({});
				}
			});
		}

		function getpin(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'pin_id=' + val,
				success: function(data) {
					$("#pin-list").html(data);
					$('#groupNameTemp').selectpicker({});
				}
			});
		}

		(function($) {
			// always strict mode on
			// cannot use undefined vars on strict mode
			"use strict";

			$(document).ready(function() {

				$(document).on('click', '#datagrid .add', function() {

					var row = $(this).closest('tr');
					var clone = row.clone();
					var tr = clone.closest('tr');
					tr.find('input[type=text]').val('');
					$(this).closest('tr').after(clone);
					var $span = $("#datagrid tr");
					$span.attr('id', function(index) {
						return 'row' + index;

					});

				});


				$(document).on('click', '#datagrid .removeRow', function() {
					if ($('#datagrid .add').length > 1) {
						$(this).closest('tr').remove();
					}

				});

			});

			var dropDown = "#dropdnw";
			var empName = ".name";

			$(document).on("change", (dropDown), function(e) {

				var value = $.trim($(this).val());

				//Change this line:
				//$(empName).val(value);
				//To:
				// $(this).closest('tr').find(empName).val(value);

			});

		})(jQuery);
		
		
		(function($) {
			// always strict mode on
			// cannot use undefined vars on strict mode
			"use strict";

			$(document).ready(function() {

				$(document).on('click', '#datagrid1 .add1', function() {

					var row = $(this).closest('tr');
					var clone = row.clone();
					var tr = clone.closest('tr');
					tr.find('input[type=text]').val('');
					$(this).closest('tr').after(clone);
					var $span = $("#datagrid1 tr");
					$span.attr('id', function(index) {
						return 'row' + index;

					});

				});


				$(document).on('click', '#datagrid1 .removeRow1', function() {
					if ($('#datagrid1 .add1').length > 1) {
						$(this).closest('tr').remove();
					}

				});

			});

			
		})(jQuery);
	</script>


	<style>
		.content-wrapper {
			padding: 0px 10px !important;
		}

		.panel-header,
		.panel-body {
			border: none !important;
		}

		.panel-body {
			overflow-x: inherit !important;
			min-height: 420px;
			padding: 34px 10px !important;

		}

		.row.panel.panel-primary {
			background: transparent !important;
			padding-top: 9px;
			min-width: 71px !important;
		}

		.panel-heading {
			margin-bottom: 0px !important;
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

		tr {
			border-bottom: 1px solid #dedede;
		}

		.nav-tabs-custom {
			background: transparent;
		}

		.panel-primary>.panel-heading {
			color: #000;
			background-color: #cccccc;
			border-color: #cccccc;
			font-weight: 500;
			font-style: inherit;
		}

		.panel-body {
			font-size: 16px !important;
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
					<div class="row mx-0">
						<div class="col-lg-8 col-md-8"><b>Leads</b></div>
						<div class="col-lg-4 col-md-4 text-right">
							<div class="btn-group text-center">
								<a href="lead_report.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Lead</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data">
					<div class="row mx-0">
						<div class="form-group col-sm-4">
							<label for="inputName" class="col-sm-4 control-label">Customer<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-8" style="margin-left: 0px;">
								<select class="form-control selectpicker" name="customer" id="customer" onchange="new_customer(this.value);" data-live-search="true" required>
									<option value="">Select Customer</option>
									<option value="new">New Customer</option>
									<?php
									$select_GrpQry = mysqli_query($con, "select * from tbl_customer WHERE Status='Active'");
									while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
										$Name = $fetch_GrpQry['Company_Name'];
										$Id = $fetch_GrpQry['Id'];
									?>
										<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div id="new_customer" style="display: none;">
							<div class="form-group col-sm-12">
								<label for="inputName" class="col-sm-2 control-label">Company Name</label>
								<div class="col-sm-4">
									<input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="company_name">
								</div>

								<label for="inputName" class="col-sm-2 control-label">Company Address</label>
								<div class="col-md-4">
									<textarea class="form-control" rows="2" name="address" id="comment"></textarea>
								</div>
							</div>
							<div class="form-group col-sm-12">
								<label for="inputName" class="col-sm-2 control-label">State<font color="red">&nbsp;*&nbsp;</font></label>
								<div class="col-md-4">
									<select class="form-control selectpicker" name="state" id="state" onChange="getdistrict(this.value);" data-live-search="true" required>
										<option value="">Select State</option>
										<?php
										$select_GrpQry = mysqli_query($con, "select * from state");
										while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
											$state_name = $fetch_GrpQry['StateName'];
										?>
											<option value="<?php echo $state_name; ?>"><?php echo $state_name; ?></option>
										<?php
										}
										?>
									</select>
								</div>

								<div id="district-list"></div>
							</div>
							<div class="form-group col-sm-12">
								<div id="city-list"></div>
								<div id="pin-list"></div>
							</div>

							<div class="form-group col-sm-12">


								<label for="inputName" class="col-sm-2 control-label">Mobile Number<font color="red">&nbsp;*&nbsp;</font></label>
								<div class="col-sm-4">
									<input type="text" name="mobile_no" class="form-control" placeholder="Mobile Number" required>
								</div>
								<label for="inputName" class="col-sm-2 control-label">GST No </label>
								<div class="col-sm-4">
									<input type="text" name="gst_no" class="form-control" placeholder="GST No">
								</div>
							</div>
							<label for="inputName" class="col-sm-2 control-label">Email Id</label>
							<div class="col-sm-4">
								<input type="text" name="email" class="form-control" placeholder="Email Id">
							</div>
						
							<div class="form-group col-sm-12">
								<h4><b>Contact Person</b></h4>
							</div>

							<table id="datagrid" class="display table1" style="border-collapse: separate;">
								<thead>
									<tr>
										<th> Name</th>
										<th style="padding:0 10px;">Mobile</th>
										<th> Designation</th>
										
										<th>Email</th>
									</tr>
								</thead>

								<tbody id="dataTable">

									<tr id="row1">
										<td width="35%">
											<input type='text' name="contact_name[]" size="20" class="form-control name" value="" required/>

										</td>

										<td style="padding:0 10px;" width="30%">
											<input type='text' name="contact_mobile[]" size="20" class="form-control name" value="" required/>
										</td>
										<td style="padding:0 10px;" width="25%">
											<input type='text' name="contact_designation[]" size="20" class="form-control name" value="" />
										</td>
										<td width="25%">
											<input type='text' name="contact_email[]" size="20" class="form-control discount" value="" />
										</td>
										<td>
											<input type="button" name="addRow" class="btn btn-success add" style="margin:0 10px;" value='Add More' />
										</td>
										<td>
											<input type="button" name="removeRow" class="btn btn-danger removeRow" value='Delete' />
										</td>

									</tr>


								</tbody>

							</table>
							
						</div>
					
								<div class="form-group col-sm-4">
									<label for="inputName" class="col-sm-4 control-label">Created Executive<font color="red">&nbsp;*&nbsp;</font></label>
									<div class="col-sm-8" style="margin-left: 0px;">
										<select class="form-control selectpicker" name="employee" id="employee" data-live-search="true" required>
											<option value="">Select Executive</option>

											<?php
											$select_GrpQry = mysqli_query($con, "select * from tbl_employee WHERE Status='Active'");
											while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
												$Name = $fetch_GrpQry['Name'];
												$Id = $fetch_GrpQry['Id'];
											?>
												<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
                                	<div class="form-group col-sm-4">
									<label for="inputName" class="col-sm-4 control-label">Lead Type<font color="red">&nbsp;*&nbsp;</font></label>
									<div class="col-sm-8" style="margin-left: 0px;">
										<select class="form-control selectpicker" name="lead_type" id="lead_type" data-live-search="true" required>
											<option value="">Select Type</option>
                                            <option value="1">Hot</option>
                                            <option value="2">Warm</option>
                                            <option value="3">Cold</option>
										
										</select>
									</div>
								</div>
                                
                                
								<div class="form-group col-sm-4">
									<label for="inputName" class="col-sm-4 control-label">Source<font color="red">&nbsp;*&nbsp;</font></label>
									<div class="col-sm-8" style="margin-left: 0px;">
										<select class="form-control selectpicker" name="source" id="source" data-live-search="true" required>
											<option value="">Select Source</option>

											<?php
											$select_GrpQry = mysqli_query($con, "select * from tbl_source WHERE Status='Active'");
											while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
												$Name = $fetch_GrpQry['Name'];
												$Id = $fetch_GrpQry['Id'];
											?>
												<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
						
						<div class="form-group col-sm-4">
							<label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-8">
								<input class="form-control dp" value="<?php echo date('d-m-Y') . $acctopendate; ?>" placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>

							</div>
						</div>
						
						<?php
                            $select_mid = mysqli_query($con, "select MAX(Id) as mid from tbl_lead WHERE Status='Active'");
                            $fetch_mid = mysqli_fetch_array($select_mid);
                            $mid = $fetch_mid['mid'];

                            $select_inv_no = mysqli_query($con, "select Lead_No from tbl_lead WHERE Id='$mid'");
                            $fetch_inv_no = mysqli_fetch_array($select_inv_no);
                            $inv_no = $fetch_inv_no['Lead_No'];

                            if ($inv_no == '' || $inv_no == 'NULL' || $inv_no == '0') {
                                $inv_no_1 = 1;
                            } else {
                                $inv_no_1 = $inv_no + 1;
                            }
                            ?>
						<div class="form-group col-sm-4">

							<label for="inputName" class="col-sm-4 control-label">Lead No<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-8">
								<input type="text" value="<?php echo $inv_no_1; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="lead_id" readonly>
							</div>
							<script>
								$(document).ready(function() {
									$('.dp').datepicker({
										format: "dd-mm-yyyy",
										endDate: '+0d',
										autoclose: true
									});

									$('.dp').on('change', function() {
										$('.datepicker').hide();
									});
									$("#discount").val(0);
									$("#other_charge").val(0);
								});
							</script>

						</div>


						
							<div class="form-group col-sm-4">
								<label for="inputName" class="col-sm-4 control-label"> Transferred To<font color="red">&nbsp;*&nbsp;</font></label>
								<div class="col-sm-8" style="margin-left: 0px;">
									<select class="form-control selectpicker" name="employee_transfer" id="employee_transfer" data-live-search="true" required>
										<option value="">Select Executive</option>

										<?php
										$select_GrpQry = mysqli_query($con, "select * from tbl_employee WHERE Status='Active'");
										while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
											$Name = $fetch_GrpQry['Name'];
											$Id = $fetch_GrpQry['Id'];
										?>
											<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group col-sm-4">

								<label for="inputName" class="col-sm-4 control-label">Current Outstanding</label>
								<div class="col-sm-8">
									<input type="text" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15">
								</div>

							</div>
							<div class="form-group col-sm-4">
									<label for="inputName" class="col-sm-4 control-label">Export Type<font color="red">&nbsp;*&nbsp;</font></label>
									<div class="col-sm-8" style="margin-left: 0px;">
										<select class="form-control selectpicker" name="export_type" id="export_type" data-live-search="true" required>
											<option value="">Select Type</option>
                                            <option value="1">India</option>
                                            <option value="2">Export</option>
                                           
										</select>
									</div>
								</div>
									<div class="form-group col-sm-4">
									<label for="inputName" class="col-sm-4 control-label">Remark 2<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">
									<select class="form-control selectpicker" name="remark_cus" id="remark" data-live-search="true" required>
										<option value="">Select Remark</option>
										<?php
										$select_GrpQry = mysqli_query($con, "select * from tbl_remark");
										while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
											$state_name = $fetch_GrpQry['Remark'];
											$rem_id = $fetch_GrpQry['Id'];
										?>
											<option value="<?php echo $rem_id; ?>"><?php echo $state_name; ?></option>
										<?php
										}
										?>
									</select>
								</div> 	</div>
								</div>
								 <div class="form-group col-sm-4">

								<label for="inputName" class="col-sm-4 control-label">Remarks<font color="red">&nbsp;*&nbsp;</font></label>
								<div class="col-sm-8">
									<textarea id="form-field-1" class="form-control limited" name='remarks' required> </textarea>
								</div>
                               
							</div>
							<div class="col-sm-4">
<label for="inputName" class="col-sm-4 control-label">Followup Date<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-8">
								<input class="form-control dp" value="<?php echo date('d-m-Y') . $acctopendate; ?>" placeholder="Pick the Date  dd-mm-yyyy" name="acctdate_1" id="acctopendate" required>

							</div>
						
						<script>
								$(document).ready(function() {
									$('.dp').datepicker({
										format: "dd-mm-yyyy",
										StartDate: '+0d',
										autoclose: true
									});

									$('.dp').on('change', function() {
										$('.datepicker').hide();
									});
									$("#discount").val(0);
									$("#other_charge").val(0);
								});
							</script>
							<div class="form-group col-sm-12" style="margin-left:60px">
								<h4><b>Product Details</b></h4>
							</div>

							<table id="datagrid1" class="display table1" style="border-collapse: separate;margin-left:100px" width="80%">
								<thead>
									<tr>
										<th>Products</th>
										<th style="padding:0 10px;">QTY</th>
										<th>Rate</th>
									</tr>
								</thead>

								<tbody id="dataTable">

									<tr id="row1">
										 <td width="25%">
                                        <select name="product[]" class="form-control  dropdn" id="dropdnw" data-live-search="true" required>
                                            <option value="">Select Product</option>
                                            <?php
                                            $select_GrpQry = mysqli_query($con, "select * from tbl_stock_item WHERE Status='Active'");
                                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                $Name = $fetch_GrpQry['Name'];
                                                $Id = $fetch_GrpQry['Id'];
                                            ?>
                                                <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </td>
										<td style="padding:0 10px;" width="35%">
											<input type='text' name="quantity[]" size="20" class="form-control name" value="" required/>
										</td>
										<td width="35%">
											<input type='text' name="rate[]" size="20" class="form-control discount" value="" required/>
										</td>
										<td>
											<input type="button" name="addRow" class="btn btn-success add1" style="margin:0 10px;" value='Add More' />
										</td>
										<td>
											<input type="button" name="removeRow" class="btn btn-danger removeRow1" value='Delete' />
										</td>

									</tr>


								</tbody>

							</table>
						
             
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
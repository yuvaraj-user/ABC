<?php

session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {
	$company_name = $_REQUEST['company_name'];
	$address = $_REQUEST['address'];
	$state = $_REQUEST['state'];
	$district = $_REQUEST['district'];
	$city = $_REQUEST['city'];
	$pincode = $_REQUEST['pincode'];
	$owner_name = $_REQUEST['owner_name'];
	$mobile_no = $_REQUEST['mobile_no'];
	$email = $_REQUEST['email'];
	$gst = $_REQUEST['gst'];
	$pan = $_REQUEST['pan'];
	$tin = $_REQUEST['tin'];
	$ac_no = $_REQUEST['ac_no'];
	$ac_name = $_REQUEST['ac_name'];
	$type = $_REQUEST['type'];
	$bank_name = $_REQUEST['bank_name'];
	$bank_branch = $_REQUEST['bank_branch'];
	$ifsc = $_REQUEST['ifsc'];
	

	$status = "Active";
	$createdon = date("d-m-Y H:i:s A");
	$createdby = $_SESSION['usersessionid'];


	$insert_details = mysqli_query($con, "INSERT INTO `tbl_customer`(`Company_Name`, `Company_Address`, `State`, `District`, `City`, `Pincode`, `Owner_Name`, `Mobile_No`, `Email_Id`, `Gst`, `Pan`, `Tin`, `Ac_No`, `Ac_Name`, `Type`, `Bank_Name`, `Bank_Branch`, `Ifsc`, `Created_On`, `Created_By`, `Status`) VALUES ('$company_name','$address','$state','$district','$city','$pincode','$owner_name','$mobile_no','$email','$gst','$pan','$tin','$ac_no','$ac_name','$type','$bank_name','$bank_branch','$ifsc','$createdon','$createdby','Active')");
	
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
	if ($insert_details) {
		echo '<script type="text/javascript">
					window.location.replace("view_customer.php?step=suces");
					</script>';
	} else {
		echo '<script type="text/javascript">
					window.location.replace("view_customer.php?step=fail");
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
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

	<!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

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
	 <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script>
           (function($) {
	// always strict mode on
	// cannot use undefined vars on strict mode
	"use strict";

	$(document).ready(function () {
		
		$(document).on('click','#datagrid .add',function () {
	
			   var row=$(this).closest('tr');
			   var clone = row.clone();
			   var tr= clone.closest('tr');
			   tr.find('input[type=text]').val('');
			   $(this).closest('tr').after(clone);
			   var $span=$("#datagrid tr");
			   $span.attr('id',function (index) {
			   return 'row' + index;
		   
			});
			
		});
		
		
		$(document).on('click','#datagrid .removeRow',function () {
			if ($('#datagrid .add').length > 1) {
				$(this).closest('tr').remove();
			}
			
		});
		
	}); 

	var dropDown = "#dropdnw";
	var empName = ".name";
	
    $(document).on("change",(dropDown),function(e){
		
		var value = $.trim($(this).val());
		
    //Change this line:
	//$(empName).val(value);
    //To:
   // $(this).closest('tr').find(empName).val(value);
		
	}); 
	
})(jQuery);
        </script>
	<script>
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
	</script>
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
						<div class="col-lg-8 col-md-8"><b>Add Customer</b></div>
						<div class="col-lg-4 col-md-4 text-right">
							<div class="btn-group text-center">
								<a href="view_customer.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Customer</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" name="add_customer" action="" method="post" enctype="multipart/form-data">
<div class="form-group col-sm-12"><h4><b>Company Details</b></h4> </div>
					<div class="form-group col-sm-12">
						<label for="inputName" class="col-sm-2 control-label">Company Name<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="company_name" required>
						</div>

						
					</div>
					

					<div class="form-group col-sm-12">
						<label for="inputName" class="col-sm-2 control-label">Company Address</label>
						<div class="col-md-4">
							<textarea class="form-control" rows="2" name="address" id="comment"></textarea>
						</div>

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
						<div id="city-list"></div>
						<div id="pin-list"></div>
						<label for="inputName" class="col-sm-2 control-label">Owner Name<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="owner_name" required>
						</div>
						<label for="inputName" class="col-sm-2 control-label">Mobile Number <font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-4">
							<input type="text" name="mobile_no" class="form-control" maxlength="10" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" placeholder="Mobile Number" required>
						</div>

						<label for="inputName" class="col-sm-2 control-label">Email Id</label>
						<div class="col-sm-4">
							<input type="text" name="email" class="form-control" placeholder="Email Id">
						</div>

					

						<label for="inputName" class="col-sm-2 control-label">GST No</label>
						<div class="col-sm-4">
							<input type="text" name="gst" class="form-control" placeholder="GST No">
						</div>
						<label for="inputName" class="col-sm-2 control-label">PAN No</label>
						<div class="col-sm-4">
							<input type="text" name="pan" class="form-control" placeholder="PAN No">
						</div>
						<label for="inputName" class="col-sm-2 control-label">TIN No</label>
						<div class="col-sm-4">
							<input type="text" name="tin" class="form-control" placeholder="TIN No">
						</div>
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
						<div class="form-group col-sm-12"><h4><b>Contact Person</b></h4> </div>
                  
<table id="datagrid" class="display table1" style="border-collapse: separate;">
<thead>
  <tr>
      <th> Name</th>
      <th style="padding:0 10px;">Mobile</th>
      <th>Email</th>
  </tr>
</thead>

<tbody id="dataTable">

    <tr id="row1">
        <td width="35%"> 
         <input type='text' name="contact_name[]" size="20" class="form-control name" value=""/>
       
        </td>

        <td style="padding:0 10px;" width="35%">
            <input type='text' name="contact_mobile[]" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" size="20" class="form-control name" value="" required />
        </td>
		<td width="35%">
            <input type='text' name="contact_email[]" size="20" class="form-control discount" value=""/>
        </td>
        <td>
            <input type="button" name="addRow" class="btn btn-success add"   style="margin:0 10px;" value='Add More'/>
        </td>
        <td>
            <input type="button" name="removeRow" class="btn btn-danger removeRow" value='Delete'/>
        </td>
        
  </tr>

                
</tbody>

</table>
				<div class="form-group col-sm-12"><h4><b>Bank Details</b></h4> </div>		  
                              <label for="inputName" class="col-sm-2 control-label">A/C No</label>
						<div class="col-sm-4">
							<input type="text" name="ac_no" class="form-control" placeholder="A/C No">
						</div>
						<label for="inputName" class="col-sm-2 control-label">A/C Name</label>
						<div class="col-sm-4">
							<input type="text" name="ac_name" class="form-control" placeholder="A/C Name">
						</div>
						<label for="inputName" class="col-sm-2 control-label">Type</label>
						<div class="col-sm-4">
							<input type="text" name="type" class="form-control" placeholder="Type">
						</div>
						<label for="inputName" class="col-sm-2 control-label">Bank Name</label>
						<div class="col-sm-4">
							<input type="text" name="bank_name" class="form-control" placeholder="Bank Name">
						</div>
						<label for="inputName" class="col-sm-2 control-label">Branch</label>
						<div class="col-sm-4">
							<input type="text" name="bank_branch" class="form-control" placeholder="Branch">
						</div>
						<label for="inputName" class="col-sm-2 control-label">IFSC</label>
						<div class="col-sm-4">
							<input type="text" name="ifsc" class="form-control" placeholder="IFSC">
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
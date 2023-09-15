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
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	function get_invoice(val) {
			$.ajax 
			({  
				type: "POST",
				url: "get_invoice.php",
				data:'cust_id='+val,			 
				success: function(data){
				$("#cust_id").html(data); 
				}
			});
			} 
	function get_products_detail(val) {
		var inv_no = $("#inv_no").val();
			$.ajax 
			({  
				type: "POST",
				url: "get_invoice.php",
				data:'inv_no='+inv_no,			 
				success: function(data){
				$("#prod_details").html(data); 
				// $("#inv_no").html("");
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
		<div class="col-lg-8 col-md-8"><b>Call Register</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="#" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Call Register</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel-body"> 
	<form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	<div class="row">
    <div class="form-group col-sm-4">
        <label for="inputName" class="col-sm-4 control-label">Call No</label>
        <div class="col-sm-8" style="margin-left: 0px;">
            <input type="text" maxlength="15" id="call_no" class="form-control limited" name="call_no" readonly>
        </div>
    </div>
	<div class="form-group col-sm-4">        
		<label for="inputName" class="col-sm-4 control-label">Date</label>
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
				});
		</script>					
	</div>
</div>
	<div class="row">    
	<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Customer</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select name="customer" id="customer"  class="form-control selectpicker" onchange="get_invoice(this.value);" data-live-search="true" required >
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
			<div id="cust_id"> </div>
		</div>
	
	<div class="col-sm-12" >
	
			<div id="prod_details" ></div>	


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

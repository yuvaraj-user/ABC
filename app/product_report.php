<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");

$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$edit=$fetchlevel['Edit'];
$ex_edit = explode(',',$edit);

$delete=$fetchlevel['Delete'];
$ex_del = explode(',',$delete);

$add=$fetchlevel['Role_add'];
$ex_add = explode(',',$add);


$type = $fetchlevel['User_type'];
$e_id = $fetchlevel['Emp_tbl_Id'];
//employee 

$employeelevel=mysqli_query($con,"select * from tbl_employee where Id='$e_id'");
$emplevel=mysqli_fetch_array($employeelevel);

$brn_id = $emplevel['Branch'];

//branch 
$branchlevel=mysqli_query($con,"select * from tbl_branch where Id='$brn_id'");
$brnlevel=mysqli_fetch_array($branchlevel);

$zone_id = $brnlevel['Zone_Id'];

//branch
$zonelevel=mysqli_query($con,"select * from tbl_branch where Zone_Id='$zone_id' AND Status='Active'");

while($znlevel=mysqli_fetch_array($zonelevel))
{
$allbrn = $znlevel['Id'];
$brn_all[]=$allbrn;

}

$all = implode(",",$brn_all);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-conpatible" content="IE=edge">
<title>Billing</title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	
	 <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	
	
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="js/jquery-1.10.2.js"></script>
	

<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">


<!-- Theme style -->

<script src="https://ajax.googleapis.con/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
		 

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
	 min-height : 450px;
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

.dataTables_wrapper .dataTables_paginate .paginate_button{
	padding:0px !important;
}
</style>
<script>
function get_brnch(val) {  
//alert(val);
				$.ajax 
				({
				type: "POST",
				url: "get_daily_coll_report.php",
				data:'brn_name='+val,
				success: function(data){
				$("#grp_cus").html(data); 
				$('#customer').selectpicker({});
				}
				});
				}  
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">Product Report</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						 
					</div>
				</div>
		</div>
	</div>
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
		
				<div class="col-lg-12 col-sm-12"> 
				   
						<label class="control-label col-sm-2">Product</label>
                        <div class="form-group col-sm-4" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="product" id="product" data-live-search="true">
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
							<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						
						</div> 
					
				</div>
		
		<div class="col-sm-12 col-lg-12">
		<br>
			<button name="filter" class="btn btn-primary center-block">Get Report</button>
		</div>
	 </form>  
<?php
								 
								if(isset($_REQUEST['filter']))
								{
												 
								 $product=$_REQUEST['product'];
								
											
											if(empty($product))
				
											{
									             $query_getall2="SELECT * FROM tbl_product WHERE Status='Active'";
											}
											else
											{
												 $query_getall2="SELECT * FROM tbl_product WHERE Status='Active' AND Id='$product'";
											} 											
											
										}
?>	 	

		<div class="col-lg-12 col-sm-12"> 
<br>
					 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							<th>S No</th>
							<th>Product Name</th>
							<th>Opening Quantity</th>
							<th>Purchase Quantity</th>
							<th>Sales Quantity</th>
							<th>Purchase Return Quantity</th>
							<th>Sales Return Quantity</th>
							<th>Available Quantity</th>
						</thead>
						<tbody>
						<?php 
						$qry_receipt=mysqli_query($con,$query_getall2);
						$i=1;			
                        $return_qty = 0;
						$sales_qty = 0;
						$overall_qty = 0;
						$sales_return_qty = 0;						
						while($fetch=mysqli_fetch_array($qry_receipt))
							{
								$product_id = $fetch['Id'];
								$product_name = $fetch['Name'];
								
								
								$qury_opn="select SUM(Quantity) as qty from tbl_product where Id='$product_id' AND Status='Active'";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty = $fetch_opn['qty'];
								
								
								$qury="select SUM(Quantity) as qty from tbl_purchase where Product_Id='$product_id' AND Status='Active'";
								$qury_exe=mysqli_query($con,$qury);
								$fetch=mysqli_fetch_array($qury_exe);
								$overall_qty = $fetch['qty'];
								
								$qury_sales="select SUM(Quantity) as qty from tbl_sales where Product_Id='$product_id' AND Status='Active'";
								$qury_exe_sales=mysqli_query($con,$qury_sales);
								$fetch_sales=mysqli_fetch_array($qury_exe_sales);
								$sales_qty = $fetch_sales['qty'];
								
								$qury_return="select SUM(Quantity) as qty from tbl_purchase_return where Product_Id='$product_id' AND Status='Active'";
								$qury_exe_return=mysqli_query($con,$qury_return);
								$fetch_return=mysqli_fetch_array($qury_exe_return);
								$return_qty = $fetch_return['qty'];
								
								$qury_sales_return="select SUM(Quantity) as qty from tbl_sales_return where Product_Id='$product_id' AND Status='Active'";
								$qury_exe_return_sales=mysqli_query($con,$qury_sales_return);
								$fetch_return_sales=mysqli_fetch_array($qury_exe_return_sales);
								$sales_return_qty = $fetch_return_sales['qty'];
				
								$available_qty = $opening_qty + $overall_qty - $sales_qty - $return_qty + $sales_return_qty;
								
								if($sales_qty=="") {
									$sales_qty_1 = 0;
								} else {
									$sales_qty_1 = $sales_qty;
								}
								
								if($return_qty=="") {
									$return_qty_1 = 0;
								} else {
									$return_qty_1 = $return_qty;
								}
								
								if($sales_return_qty=="") {
									$sales_return_qty_1 = 0;
								} else {
									$sales_return_qty_1 = $sales_return_qty;
								}
								
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $product_name;?></td>
								<td><?php echo $opening_qty;?></td>
								<td><?php echo $overall_qty;?></td>
								<td><?php echo $sales_qty_1;?></td>
								<td><?php echo $return_qty_1;?></td>
								<td><?php echo $sales_return_qty_1;?></td>
								<td><?php echo $available_qty;?></td>
							</tr>
							
							<?php $i++;
							}
						?>
						</tbody>
					</table>
				</div>
	</div>
</div>
	
			<!-- /.col -->
		</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer Section-->
<?php include 'footer.php'; ?>

<!---  Control Sidebar  Section ->
<?php #include 'controlsidebar.php'; ?>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
   <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="js/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
   <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
 <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
	 
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>


<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});
</script>
 <script>
      	  
	  $(document).ready(function() {
    $('#example1').DataTable( {
			
			"scrollX": true,
			"scrollY": 500,
			"scrollCollapse": true,
			  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			   dom: 'Bfrtip',
			   stateSave: true,
			    "buttons": [
			   {
					extend: 'copyHtml5',
					title: 'Product Report' 			
				},
				{
					extend: 'excelHtml5',
					title: 'Product Report' 			
				}, 
				{
					extend: 'colvis',
					text:      '<i class="fa fa-eye" aria-hidden="true"></i>',
					title: 'Product Report' 			
				} 
] 

        		  
			 
    } );
} );
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
<?php mysqli_close($con);?>

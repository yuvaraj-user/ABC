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


if(isset($_REQUEST['submit']))
{
	 $name=$_REQUEST['order_id'];
	 $formal_name=$_REQUEST['product_id'];
	 $decimal=$_REQUEST['cancel_qty'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
		
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_cancel_sales_order`(`Order_Id`, `Product_Id`, `Quantity`, `Created_On`, `Created_By`, `Status`) VALUES ('$name','$formal_name','$decimal','$createdon','$createdby','$status')");
		
		if($insert_details){
		    
			 echo '<script type="text/javascript">
					window.location.replace("purchase_order_outstanding.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("purchase_order_outstanding.php?step=fail");
					</script>';
	}
}
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
			<div class="col-lg-8 col-md-8"> Target vs Achieved</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						 
					</div>
				</div>
		</div>
	</div>
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
		
				<div class="col-lg-12 col-sm-12"> 
				   	<label class="control-label col-sm-2">Date<font color="red">&nbsp;*&nbsp;</font></label>
				<div class="form-group col-sm-4">
					<input type="text" name="date" id="reportrange" class="form-control pull-right" placeholder="pick the date dd-mm-yyy" required>
				</div>
				<?php
				$selectlevel_tst=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
                $fetchlevel_tst=mysqli_fetch_array($selectlevel_tst);
				$type_tst = $fetchlevel_tst['User_type'];
				$emp_id = $fetchlevel_tst['Emp_tbl_Id'];
				 if($type_tst=='Admin') {
				?>
					
	                    <label class="control-label col-sm-2">Coordinator </label>
                        <div class="form-group col-sm-4" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="product" id="product" data-live-search="true">
						 <option value="">Select Coordinator</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_coordinator WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						
						</div>
					 
					<?php } else {  ?> 
					<input type="hidden" name='product' value="<?php echo $emp_id; ?>">
					
					<?php } ?>
				</div>
		
		<div class="col-sm-12 col-lg-12">
		<br>
			<button name="filter" class="btn btn-primary center-block">Get Report</button>
		</div>
	 </form>  
<?php
								 
								if(isset($_REQUEST['filter']))
								{
												 
								 echo $product=$_REQUEST['product'];
								 $pds=$_REQUEST['pds'];
								 $date=$_REQUEST['date'];
								 $ex_date = explode('-',$date);
								 $dfrom = $ex_date[0];			 
								 $from = date("d-m-Y", strtotime($dfrom));
								 $dto = $ex_date[1]; 						
								 $to = date("d-m-Y", strtotime($dto));							 
								
											
											if(empty($product))
				
											{
									             $query_getall2="SELECT p.*,s.Name as sup_name,t.Name as pro_name,g.Name as grp_name,d.Name as dist_Name FROM tbl_sales_target p LEFT JOIN tbl_coordinator s on s.Id=p.Customer_Id LEFT JOIN tbl_product t on t.Id=p.Product_Id LEFT JOIN tbl_group g on g.Id=s.Group_Id LEFT JOIN tbl_district d on d.Id=s.District_Id WHERE p.Status='Active' AND STR_TO_DATE(p.`Start_Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
											}
											else
											{
												  $query_getall2="SELECT p.*,s.Name as sup_name,t.Name as pro_name,g.Name as grp_name,d.Name as dist_Name FROM tbl_sales_target p LEFT JOIN tbl_coordinator s on s.Id=p.Customer_Id LEFT JOIN tbl_product t on t.Id=p.Product_Id LEFT JOIN tbl_group g on g.Id=s.Group_Id LEFT JOIN tbl_district d on d.Id=s.District_Id WHERE p.Status='Active' AND p.Customer_Id='$product' AND STR_TO_DATE(p.`Start_Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
											} 											
											
										}
?>	 	

		<div class="col-lg-12 col-sm-12"> 
<br>
					 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							<th>S.No</th>
							<th>Sector</th>
							<th>Co-Ordinator</th>
							
							<th>District</th>
							<th>Product Name</th>
							<th>Entry Date</th>
							<th>End Date</th>
							<th>Target Quantity</th>
							<th>Indent Quantity</th>
							<th>Supplied Quantity</th>
							<th>Balance from Target</th>
							<th>Achieved in ( % )</th>
						</thead>
						<tbody>
						<?php 
						$qry_receipt=mysqli_query($con,$query_getall2);
						$i=1;			
                        $return_qty = 0;
						$sales_qty = 0;
						$overall_qty = 0;
						$sales_return_qty = 0;	
						$opening_qty_sale = 0;
						$indent_qty=0;
						while($fetch=mysqli_fetch_array($qry_receipt))
							{
								$product_id = $fetch['Product_Id'];
								$order_id = $fetch['Id'];
								$order_no = $fetch['Sales_Target_No'];
								$product_name = $fetch['pro_name'];
								$sup_name = $fetch['sup_name'];
								$Start_Date = $fetch['Start_Date'];
								$End_Date = $fetch['End_Date'];
								$Customer_Id = $fetch['Customer_Id'];
								$grp_name = $fetch['grp_name'];
								$dist_Name = $fetch['dist_Name'];
								
								$qury_opn="select SUM(Quantity) as qty from tbl_sales_target where Product_Id='$product_id' AND Status='Active' AND Customer_Id='$Customer_Id' AND STR_TO_DATE(`Start_Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
								$qury_exe_opn=mysqli_query($con,$qury_opn);
								$fetch_opn=mysqli_fetch_array($qury_exe_opn);
								$opening_qty = $fetch_opn['qty'];
								
								$qury_opn_sale="select SUM(Quantity) as qty from tbl_sales where Product_Id='$product_id' AND Status='Active' AND Customer_Id='$Customer_Id' AND STR_TO_DATE(`Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
								$qury_exe_opn_sale=mysqli_query($con,$qury_opn_sale);
								$fetch_opn_sale=mysqli_fetch_array($qury_exe_opn_sale);
								$opening_qty_sale = $fetch_opn_sale['qty'];
								
								$qury_ind="select SUM(Quantity) as qty from tbl_sales_order where Product_Id='$product_id' AND Status='Active' AND Customer_Id='$Customer_Id' AND STR_TO_DATE(`Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y')";
								$qury_exe_ind=mysqli_query($con,$qury_ind);
								$fetch_ind=mysqli_fetch_array($qury_exe_ind);
								$indent_qty = $fetch_ind['qty'];
								
								
								
								//$qury_exe=mysqli_query($con,$qury);
							//	$fetch=mysqli_fetch_array($qury_exe);
								// $overall_qty = $fetch['qty'];
								//if($overall_qty==''){
								   // $overall_qty_1 = 0;
							//	}else {
								 //   $overall_qty_1 = $overall_qty;
								//}
								
								
								
				
								$available_qty = ($opening_qty - $opening_qty_sale);
								
								$target_percent = ($opening_qty_sale/$opening_qty)*100;
								
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $grp_name;?></td>
								<td><?php echo $sup_name;?></td>
								
								<td><?php echo $dist_Name;?></td>
								<td><?php echo $product_name;?></td>
								<td><?php echo $Start_Date;?></td>
								<td><?php echo $End_Date;?></td>
								<td><?php echo $opening_qty;?></td>
								<td><?php echo $indent_qty;?></td>
								<td><?php echo $opening_qty_sale;?></td>
								<td><?php echo $available_qty;?></td>
								<td><?php echo $target_percent;?></td>
								
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
					title: 'Target vs Achieved Report' 			
				},
				{
					extend: 'excelHtml5',
					title: 'Target vs Achieved Report' 			
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
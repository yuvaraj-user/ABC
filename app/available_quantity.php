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
 <?php
if(isset($_REQUEST['submit']))
{
 	$prod_id = $_REQUEST['prod_id'];
 	$quantity = $_REQUEST['quantity'];
 
	$sql1 = mysqli_query($con,"INSERT INTO `tbl_item_quantity`(`Product_Id`, `Quantity`) VALUES ('$prod_id','$quantity')");

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
			<div class="col-lg-8 col-md-8">Available Quantity Report</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						 
					</div>
				</div>
		</div>
	</div>
	<div class="panel-body"> 
	 						
		<div class="col-lg-12 col-sm-12"> 
<br>
					 <table id="example1" class="table table-responsive table-bordered table-striped">
						<thead>
							<th>S No</th>
							<th>Product Name</th>
							<th>Overall Quantity</th>
							<th>Saled Quantity</th>
							<th>Available Quantity</th>
							<th>Add Quantity</th>
						</thead>
						<tbody>
						<?php 
						$query_getall2="SELECT * FROM tbl_stock_item WHERE Status='Active'";
						$qry_receipt=mysqli_query($con,$query_getall2);
						$i=1;			
                        $return_qty = 0;
						$sales_qty = 0;
						$overall_qty = 0;
						$sales_return_qty = 0;						
						while($fetch=mysqli_fetch_array($qry_receipt))
							{
							    	$product_id = $fetch['Id'];
							    	$Name = $fetch['Name'];
							    
							    	$select_paid = mysqli_query($con, "select SUM(Quantity) as qty from tbl_item_quantity WHERE Product_Id='$product_id'");
                                    $fetch_sid = mysqli_fetch_array($select_paid);
                                    $over_all = $fetch_sid['qty'];
							    
							        $select_pend = mysqli_query($con, "select SUM(t.Quantity) as sid from tbl_work_order w left join tbl_lead l on w.Lead_Id=l.Id left join tbl_lead_products t on t.Lead_Id=l.Id WHERE w.Status='Active' AND t.Product_Id='$product_id'");
                                    $select_pend = mysqli_fetch_array($select_pend);
                                    $tot_amt = $select_pend['sid'];
							
							$avail_qty = $over_all-$tot_amt;
								
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $Name;?></td>
								<td><?php echo $over_all;?></td>
								<td><?php echo $tot_amt;?></td>
								<td><?php echo $avail_qty;?></td>
								<td><button type="submit" class="btn btn-success" data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $i;?>" data-backdrop="static" data-keyboard="false">Add</button> 
								<div class="modal fade" id="myModal1<?php echo $i;?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content"  style="width:70%;margin-left:160px">
        <div class="modal-header">
          <button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Add <?php echo $Name;  ?> Quantity</b> </h4>
        </div>
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body"> 
       
					<input type="hidden" value="<?php echo $product_id; ?>" id="prod_id" name="prod_id" /> 
				
                       <div class="col-sm-12 form-group">
                        <label for="inputEmail" class="col-sm-2 control-label"> Add Quantity</label>
                        <div class="col-sm-7">
						
                         <input type="text" name="quantity" class="form-control" id="remarks">
                        </div>
                      </div>
          
                      </div>
					  
	 <input type="submit" name="submit"  class="btn btn-primary center-block"  value="submit">
		
    
	  </div>
      </form>
    </div>
			</div></td>
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
					title: 'Available Quantity Report' 			
				},
				{
					extend: 'excelHtml5',
					title: 'Available Quantity Report' 			
				}, 
				{
					extend: 'colvis',
					text:      '<i class="fa fa-eye" aria-hidden="true"></i>',
					title: 'Available Quantity Report' 			
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

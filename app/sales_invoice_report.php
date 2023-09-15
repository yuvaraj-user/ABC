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
$do = $_REQUEST['do'];
$id = $_REQUEST['id'];
$branch = $_REQUEST['branch'];

  	if(isset($_REQUEST['submit']))
{
	 $remark = $_REQUEST['remark'];
	 $date = $_REQUEST['date'];
	 $cus_id = $_REQUEST['lead'];
     $entry_date = date('d-m-Y');
     $emp_id = $_REQUEST['emp_id'];
	 
	 $createdon = date("d-m-Y H:i:s A");
	$createdby = $_SESSION['usersessionid'];
	
	 $sql1 = mysqli_query($con,"INSERT INTO `tbl_followup`( `Lead_Id`, `Entry_Date`, `Follow_Up_Date`, `Employee_Id`, `Status`,`Remarks`,`Created_On`, `Created_By`) VALUES ('$cus_id','$entry_date','$date','$emp_id','Active','$remark',,'$createdon','$createdby')");

    
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-conpatible" content="IE=edge">
<title><?php echo $filename; ?>| Report</title>
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
				url: "get_payment_tracking.php",
				data:'brn_name='+val,
				success: function(data){
				$("#grp_cus").html(data); 
				$('#customer').selectpicker({});
				$('#pay_mode').selectpicker({});
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
 <?php
                $final = $_REQUEST['step'];
                if ($final == "suces") {
                ?>
                    <div class="alert alert_msg alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> Invoice was Added Successfully.
                    </div>

                <?php
                } else if ($final == "edit") {
                ?>
                    <div class="alert alert_msg alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> Invoice was Updated Successfully.
                    </div>

                <?php
                } else if ($final == "dbfail") { ?>
                    <div class="alert alert_msg alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Error!</strong> Server Error.
                    </div>
                <?php } else if ($final == "fail") { ?>
                    <div class="alert alert_msg alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Failed!</strong> This Details Was Already Exist.
                    </div>
                <?php } else if ($final == "delete") { ?>
                    <div class="alert alert_msg alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> Invoice are Removed Successfully.
                    </div>
                <?php } else if ($final == "duplicate") { ?>
                    <div class="alert alert_msg alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Failed!</strong> Duplicate Entry.
                    </div>
                <?php }
                ?>
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">Sales Invoice Report</div>				
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
		
							<label for="inputName" class="col-sm-2 control-label">Customer</label>
							<div class="col-sm-4" style="margin-left: 0px;">
								<select class="form-control selectpicker" name="customer" id="customer" data-live-search="true">
									<option value="">Select Customer</option>
									<?php
									$select_GrpQry = mysqli_query($con, "select * from tbl_customer WHERE Status='Active'");
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
							
		
		
		<div class="col-sm-12 col-lg-12">
		<br>
			<button name="filter" class="btn btn-primary center-block">Get Report</button>
		</div>
	 </form>  
<?php
								 
								if(isset($_REQUEST['filter']))
								{
								 $customer=$_REQUEST['customer'];
								 
								 $date=$_REQUEST['date'];
								 $ex_date = explode('-',$date);
								 $dfrom = $ex_date[0];			 
								 $from = date("d-m-Y", strtotime($dfrom));
								 $dto = $ex_date[1]; 						
								 $to = date("d-m-Y", strtotime($dto));							 
								 
								
											
											
												 $query_getall2.="SELECT wo.*,wo.Date as wo_dt,so.*,so.Date as so_dt,l.*,l.Id as ld_id,e.Name as emp_name,t.Name as cus_name,l.Date as ld_dt,p.*,i.*,c.*,t.* FROM tbl_sales_invoice wo left join tbl_sales_order so on so.Id=wo.Sale_Order_Id left join  tbl_lead l on so.Lead_Id=l.Id LEFT JOIN tbl_lead_products p on l.Id=p.Lead_Id LEFT JOIN tbl_stock_item i on i.Id=p.Product_Id LEFT JOIN tbl_customer c on c.Id=l.Customer_Id LEFT JOIN tbl_contact_Person t on t.Customer_Id=c.Id LEFT JOIN tbl_employee e on l.Followup_Employee=e.Id WHERE wo.Status='Active' AND ";
												$counter=0;
																						
											if(!empty($customer))
											{
											
												$qarr[$counter]="wo.Customer_Id	='$customer'";
												$counter++;
											}
											
											
											if(!empty($date))
											{
												  $qarr[$counter]="STR_TO_DATE(wo.`Date`,'%d-%m-%Y') BETWEEN STR_TO_DATE('$from', '%d-%m-%Y') AND STR_TO_DATE('$to', '%d-%m-%Y') GROUP BY p.Lead_Id";
												  											
												$counter++;
											} 
											$subcounter=0;
											$prefinalquery="";
											
											foreach($qarr as $value)
											{
												if($subcounter==0)
												{
													$prefinalquery.=" ".$value;
													$subcounter++;
												}
												else
												{
													$prefinalquery.=" AND ".$value;											
												
												}
												
											}
											
											
											if(empty($branch) && empty($date)&& empty($customer)&& empty($paymode)&& empty($payfor))
											{
												$semifinalquery=$query_getall2.$prefinalquery;
												$query_getall2=$semifinalquery;
											}
											else
											{
												$semifinalquery=rtrim($query_getall2.$prefinalquery);
												
												 
												$testlastand=substr($semifinalquery, -15);
												if($testlastand=='&nbsp;AND&nbsp;')
												{
													 $query_getall2=substr($semifinalquery, 0, -15);
												}
												else
												{
													 $query_getall2=$semifinalquery;
													
												}
											}											
										}
?>	 	


		<div class="col-lg-12 col-sm-12"> 
<br>
					 <table id="example" class="table table-responsive table-bordered table-striped">
						<thead>
							<th>S No</th>
							<th>Invoice No</th>
							<th>Invoice Date</th>
							<th>Sales Order No</th>
							<th>Sales Order Date</th>
							<th>Lead No</th>
							<th>Lead Date</th>
							<th>Company Name</th>
							<th>Contact Person</th>
							<th>Mobile</th>
							<th>Followup Employee</th>
							<th>Bill Amount</th>
							<th>Products</th>
						</thead>
						<tbody>
						<?php 
						$qry_receipt=mysqli_query($con,$query_getall2);
						$i=1;					
						while($fetch=mysqli_fetch_array($qry_receipt))
							{
								
                              $lead_id_1 = $fetch['ld_id'];
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $fetch['Invoice_No']; ?></td>
								<td><?php echo $fetch['wo_dt'];?></td>
								<td><?php echo $fetch['Sale_Order_No'];?></td>
								<td><?php echo $fetch['so_dt'];?></td>
								<td><?php echo $fetch['Lead_No'];?></td>
								<td><?php echo $fetch['ld_dt'];?></td>
								<td><?php echo $fetch['Company_Name'];?></td>
								<td><?php echo $fetch['Name'];?></td>
								<td><?php echo $fetch['Mobile_No'];?></td>
								<td><?php echo $fetch['emp_name'];?></td>
								<td><?php echo $fetch['Grand_Total'];?></td>
								<td><button type="submit" class="btn btn-success" data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $lead_id_1;?>" data-backdrop="static" data-keyboard="false">Product Details</button><div class="modal fade" id="myModal1<?php echo $lead_id_1; ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content"  style="width:80%;margin-left:100px">
					<div class="modal-header custom-stripped">
						<button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<div class="row">
						<div class="col-sm-6">
						<h4 class="modal-title"><b>Product Details</b> </h4>
						</div>
						</div>
					</div>
					<div class="modal-body">
					  
					 <table class="table table-responsive table-bordered table-striped">
						<thead>
							<th>S.No</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Rate</th>
							<th>Total Amount</th>
						</thead>
						<tbody>
						<?php
														
														$qry_lead = mysqli_query($con, "SELECT l.*,p.Name as prod_name FROM `tbl_lead_products` l left join tbl_stock_item p on l.Product_Id=p.Id WHERE l.Lead_Id='$lead_id_1'");
		                                                while($fetch_lead = mysqli_fetch_array($qry_lead))
														{
		 												?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $fetch_lead['prod_name'];?></td>
								<td><?php echo $fetch_lead['Quantity'];?></td>
								<td><?php echo $fetch_lead['Rate'];?></td>
								<td><?php echo $fetch_lead['Total_Amount'];?></td>
</tr>
								
							
							<?php $i++;
							}
						?>
						
						</tbody>
						
					</table>
						</div>
					</div>
				</div>
			
</div>  </td>
								
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
    $('#example').DataTable( {
			
			"scrollX": true,
			"scrollY": 500,
			"scrollCollapse": true,
			  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			   dom: 'Bfrtip',
			   stateSave: true,
			    "buttons": [
			   {
					extend: 'copyHtml5',
					title: 'Sales invoice Report - <?php echo $bname;?>' 			
				},
				{
					extend: 'pdfHtml5',
					title: 'Sales invoice Report - <?php echo $bname;?>' 			
				}, 
				{
					extend: 'excelHtml5',
					title: 'Sales invoice Report - <?php echo $bname;?>' 			
				}, 
				{
					extend: 'colvis',
					text:      '<i class="fa fa-eye" aria-hidden="true"></i>',
					title: 'Sales invoice report - <?php echo $bname;?>' 			
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

<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
if(isset($_REQUEST['submit']))
{
	
	$customer = $_REQUEST['customer'];
	$employee = $_REQUEST['employee']; 
	$date = $_REQUEST['date']; 
	$z_remark=$_REQUEST['z_remark'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$cmonth=date("m");
    $cyear=date("y");

	
		  
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_customer_mapping`(`Customer_Id`, `Employee_Id`, `Date`,`Remark`, `Created_On`, `Created_By`, `Updated_On`, `Updated_By`, `Status`)  values('$customer','$employee','$date','$z_remark','$createdon','$createdby','$updatedon','$updatedby','$status')");
		
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_customer_mapping.php?step=suces");
					</script>';	
			
		
	}
	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_customer_mapping.php?step=fail");
					</script>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Add Customer Mapping</title>
<meta name="author" content="">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script src="js/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
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
	 min-height : 350px;
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
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>Add Customer Mapping</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
						<a href="view_customer_mapping.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Customer Mapping</a>
					
				</div>
		</div>
	</div>
	
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
                    <div class="col-sm-12 form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Customer</label>
                        <div class="col-sm-4">
                        <!-- <input type="text" name="designation" class="form-control" id="inputName" placeholder="Designation" >---->
						 <select id="designation"  name="customer"  class="form-control  selectpicker" data-live-search="true"   >			
						<option value="">Select Customer Name</option>
						<?php $selectbranch=mysqli_query($con,"select * from tbl_customer where Status='active'");
						while($fetch_branch_array=mysqli_fetch_array($selectbranch))
						{
						 $desinid=$fetch_branch_array['Id'];
						 $designname=$fetch_branch_array['Name'];
						 ?>
						<option value="<?php echo $desinid;?>"><?php echo $designname;?></option>
						<?php } ?>						            						
						</select>
                        </div>
                        <label for="inputEmail" class="col-sm-2 control-label">Employee</label>
                        <div class="col-sm-4">
                        <!-- <input type="text" name="designation" class="form-control" id="inputName" placeholder="Designation" >---->
						 <select id="role"  name="employee"  class="form-control  selectpicker" data-live-search="true"   >			
						<option value="">Select Employee Name</option>
						 <?php 
					   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_employee`");
					   while($viewuser=mysqli_fetch_array($selectzone))
					   {
						   $zid=$viewuser['Id'];
						   $zname=$viewuser['Name'];
						   
						  
					?>
						<option value="<?php echo $zid;?>"><?php echo $zname;?></option>
					<?php }
					   ?>						            						
						</select>
                        </div>
                        </div>
					   <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Applicable Date<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">  
						  <input class="form-control dp"   placeholder="dd-mm-yyyy" id="dob_F" name="date" required readonly>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#dob_F').datepicker({
	
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
						<div class="form-group">
							<label class="col-sm-2 control-label">Remark</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="z_remark" placeholder="Remark"></textarea>
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
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
			"scrollX": true,
			"scrollY": 500,
     "scrollCollapse": true
		});
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
	  
	  
	    </script>
</body> 
<?php mysqli_close($con);?>

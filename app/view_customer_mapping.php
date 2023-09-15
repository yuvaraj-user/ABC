<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
include_once("Enroll_update.php");
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
<title>Bidding | Report</title>
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
                            <strong>Success!</strong> Attendance Details Was Addedd Successfully.
                        </div>

    <?php
} else if ($final == "dbfail") {
    ?>
                        <div class="alert alert_msg alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Error!</strong> Server Error.
                        </div>
<?php
} else if ($final == "fail") {
    ?>
                        <div class="alert alert_msg alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Failed!</strong> This Attendance Was Already Exist.
                        </div>
<?php
} else if ($final == "delete") {
    ?>
                        <div class="alert alert_msg alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> Attendance Details Was Removed Successfully.
                        </div>
<?php
} else if ($final == "update") {
    ?>
                        <div class="alert alert_msg alert-info alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> Attendance Details Was Updated Successfully.
                        </div>
<?php }
?>

	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-7 col-md-7">Attendance Details</div>		
<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="employee_attendance.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;Employee Attendance</a>
					</div>
				</div>
		</div>
	</div>
	
	
	
	
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
		<div class="col-lg-12 col-sm-12"> 
			
                        <label for="inputName" class="col-sm-2 control-label">Date<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">  
						  <input class="form-control dp"   placeholder="dd-mm-yyyy"  onchange="agecalcualte(this.value)" id="dob_F" name="dob_F" required readonly>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#dob_F').datepicker({
	
        format: "dd-mm-yyyy",
        autoclose: true
	 });
    $('.dp').on('change', function () {
        $('.datepicker').hide();
    });

	});
</script>
                      
		  	
                        
	
		</div>
		
		<div class="col-sm-12 col-lg-12">
		<br>
			<button name="filter" class="btn btn-primary center-block">Get Report</button>
		</div>
	 </form>  
<?php
								 
								if(isset($_REQUEST['filter']))
								{
								 $branch=$_REQUEST['branch'];
								 $date=$_REQUEST['dob_F'];
								 $ex_date = explode('-',$date);
								 $dfrom = $ex_date[0];			 
								 $from = date("d-m-Y", strtotime($dfrom));
								 $dto = $ex_date[1]; 						
								 $to = date("d-m-Y", strtotime($dto));	
								
											
												 $query_getall2 ="select c.*,s.Company_Name as sub_name,e.Name as emp_name from tbl_customer_mapping c LEFT JOIN tbl_customer s on s.Id=c.Customer_Id LEFT JOIN tbl_employee e on e.Id=c.Employee_Id where c.Status='Active' AND c.Date='$date'";
											
											} 											
											
											
?>	 		


	<div class="col-lg-12 col-sm-12"> 
<br>
					 <table id="example1" class="table table-responsive table-bordered table-striped">
						 <thead>
                                                <tr>
                                                    <th>SNo</th>
                                                    <th>Customer Name</th> 
                                                    <th>Employee Name</th> 
                                                    <th>Date</th> 
                                                    <th>Actions</th> 
                                                </tr>
                                            </thead>
						  <tbody>
<?php
$qury_exe = mysqli_query($con, $query_getall2);
$i = 1;
while ($fetch = mysqli_fetch_array($qury_exe)) {
   
    
    $emp_id = $fetch['emp_name'];
    $brnch_id = $fetch['sub_name'];
    $date = $fetch['Date'];
 
   
    ?>
                                                    <tr>
                                                        <td align="center"><?php echo $i; ?></td>                       
                                                       
                                                        <td><?php echo $brnch_id; ?></td>
                                                        <td><?php echo $emp_id; ?></td>
                                                        <td><?php echo $date; ?></td>
														 <td>
														 <button type="button" onclick="window.location.href='edit_attendance.php?id=<?php echo $fetch['Id']; ?>'" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <button type="button" onclick="window.location.href = 'remark_attendance.php?do=delete&id=<?php echo $fetch['Id']; ?>'" class="btn btn-danger">Delete&nbsp;</button>
                                                        </td>
                                                    </tr>
    <?php $i++;
} ?>

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
			  
] 


        		  
			 
    } );
} );
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
<?php mysqli_close($con);?>

<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
if(isset($_REQUEST['submit']))
{
	 $from_Date=$_REQUEST['from_Date'];
	 $to_Date=$_REQUEST['to_Date'];
	
	 $name=$_REQUEST['name'];
	 $days=$_REQUEST['days'];
	
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$cmonth=date("m");
    $cyear=date("y");

	
		
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_month_week`( `From_Date`, `To_Date`, `Name`,`Days`) VALUES ('$from_Date','$to_Date','$name','$days')");
		
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_month_week.php?step=suces");
					</script>';	
			
	
	}
	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_month_week.php?step=fail");
					</script>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>HRM</title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
    
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->      
   <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
   <!-- Ionicons -->
    
   <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">	
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	  <script src="js/jquery-1.10.2.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	 <link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	
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
<script>
function getdistrict(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'state_id='+val,
	success: function(data){
		$("#district-list").html(data);
        $('#groupNameTemp').selectpicker({});
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
			<div class="col-lg-8 col-md-8"><label>Add New Month/Week</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="view_month_week.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Month/Week</a>
					</div>
				</div>
		</div>
	</div>
	
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	 
	                 <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">From Date<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
			 <input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="from_Date" id="acctopendate" required readonly>
			 
                      </div>
						
						<label for="inputName" class="col-sm-2 control-label">To Date<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
			 <input class="form-control dp1"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="to_Date" id="acctopendate1" required readonly>
			 
                      </div>
					  <div class="col-sm-12 form-group">
                   <label for="inputName" class="col-sm-2 control-label">Month / Week Name</label>
                        <div class="col-sm-4">
                         <input type="text" name="name" id="age_F" class="form-control" >
                        </div>
						<label for="inputName" class="col-sm-2 control-label">No of Days</label>
                        <div class="col-sm-4">
                         <input type="text" name="days" id="days" class="form-control" >
                        </div>
                        </div>
					  
	 <script>
	$(document).ready(function () {
    $('#acctopendate').datepicker({
        format: "dd-mm-yyyy",
		
        autoclose: true
    });

    $('.dp').on('change', function () {
        $('.datepicker').hide();
    });

    });
	
	$(document).ready(function () {
    $('#acctopendate1').datepicker({
        format: "dd-mm-yyyy",
		
        autoclose: true
    });

    $('.dp1').on('change', function () {
        $('.datepicker').hide();
    });

    });
	
  </script>
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
    <!-- page script -->
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
</html>
<?php mysqli_close($con);?>
<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
if(isset($_REQUEST['submit']))
{
	$name = $_REQUEST['zone_name'];
	$code = $_REQUEST['zone_code']; 
	$z_remark=$_REQUEST['z_remark'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$cmonth=date("m");
    $cyear=date("y");

	$alreadychk = mysqli_query($con,"select * from  tbl_designation
 where Name='$name' and Code='$code' and Status='Active' ");
	$fetchcnt = mysqli_num_rows($alreadychk);
	if($fetchcnt==0)
	{		
		  
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_designation`(`Name`, `Code`, `Remark`, `Created_On`, `Created_By`, `Updated_On`, `Updated_By`, `Status`)  values('$name','$code','$z_remark','$createdon','$createdby','$updatedon','$updatedby','$status')");
		
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("viewdesignation.php?step=suces");
					</script>';	
			
		}
	}
	else{
		 echo '<script type="text/javascript">
					window.location.replace("add_designation.php?step=fail");
					</script>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Chit | Customer</title>
<meta name="author" content="Gayathri.R.KKIT">
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
			<div class="col-lg-8 col-md-8">Add Designation</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="viewdesignation.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Designation</a>
					</div>
				</div>
		</div>
	</div>
	<?php 
	$sno=mysqli_query($con,"SELECT MAX(Id) as Id FROM tbl_designation");
		$s_no_select=mysqli_fetch_array($sno);		
		$curyear=date("y");
		$fetchlastnum=$s_no_select['Id']+1; 
		$max_custid=$s_no_select['Id']; 

	if(!empty($max_custid))
	{
		$curnt_zonid = $max_custid+1;

	
	
	if(strlen($fetchlastnum)=='1')
		{
		$newid="0".$fetchlastnum;	
		}
	else
		{
		$newid=$fetchlastnum;	
		}


		$curnt_zonid="D".$curyear.$newid; 
		}
	else
	{
		$curnt_zonid = 'D'.$curyear."01"; 
	}	
	?>
	<div class="panel-body"> 
	 <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
                      <div class="form-group">
							<label class="col-sm-2 control-label">Designation Name<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-4">
							 <input type="text" class="form-control" id="form-field-1"  placeholder="Designation Name" name="zone_name" required>
						</div>						
							<label class="col-sm-2 control-label">Designation Code<font color="red">&nbsp;*&nbsp;</font></label>							
						<div class="col-sm-4">	
							 <input type="text" class="form-control"   placeholder="Designation Code" value="<?php echo $curnt_zonid;?>" name="zone_code" required readonly>
						</div>
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

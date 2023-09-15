<?php
session_start();
require 'checkagain.php';
date_default_timezone_set("Asia/Kolkata");
include_once 'srdb.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $filename; ?>| City</title>
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
	  <script src="js/jquery-1.10.2.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	 <link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
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
<?php 

if(isset($_REQUEST['update'])){
	
	 $gid=$_REQUEST['id'];
	 $state=$_REQUEST['state'];
	 $district=$_REQUEST['branchdict'];
	 $city=$_REQUEST['city'];
	 $pincode=$_REQUEST['pincode'];
	 $updatedon=date("d-m-Y H:i:s A");
	 $updatedby=$_SESSION['User'];
 
		$qry_update=mysqli_query($con,"UPDATE `tbl_city` SET `City`='$city',`State`='$state',`District`='$district',`Pincode`='$pincode',`Updated_On`='$updatedon',`Updated_By`='$updatedby' WHERE Status='Active' AND Id='$gid'");
		if($qry_update){
			 echo '<script type="text/javascript">
					window.location.replace("view_city.php?step=update");
					</script>';	
			
		}
		
  
}
?>
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>Edit City Details</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="add_city.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add New</a>
						<a href="view_city.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View City Details</a>
					</div>
				</div>
		</div>
	</div>
	<div class="panel-body"> 
                    <form class="form-horizontal" name="addemployee_details" action="" method="post" enctype="multipart/form-data">
					<?php 
			        $gid=$_REQUEST['id'];
				    $qury="SELECT * FROM `tbl_city` WHERE Id='$gid' and Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
				
					$fetch=mysqli_fetch_array($qury_exe);
	 				
	                $city=$fetch['City'];                     
			        $state=$fetch['State'];
				    $pincode=$fetch['Pincode'];
				    $district=$fetch['District'];
					
					?>
					<!--<input type="text" name="edit_id" class="form-control" value="<?php echo $gid; ?>" id="edit_id">-->
					  <div class="form-group col-sm-12">
                      <label for="inputName" class="col-sm-2 control-label">State<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="state" id="state" onChange="getdistrict(this.value);" data-live-search="true" required>
						 <option value="">Select State</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from state");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$state_name=$fetch_GrpQry['StateName'];
							?>
							<option value="<?php echo $state_name;?>"<?php if($state == $state_name) echo 'selected';?>><?php echo $state_name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						 <script>
						$(document).ready(function () {
                             $('#state').on('change', function () {
                                   $('#dict').hide();
                                      });
                           });
	
						
						 </script>
						 
						 </div>
						 
					 <div id="district-list"> </div>
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">City Name<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="City Name" value="<?php echo $city; ?>" id="form-field-1" class="form-control limited"  name="city" required>
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Pincode</label>
							<div class="col-sm-4">
							<input type="text" name="pincode"  onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))"  class="form-control" value="<?php echo $pincode; ?>"  placeholder="Pincode">
						  </div>
						</div>
						
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-10">
							<button type="submit" name="update" class="btn btn-primary">Update</button>
						</div>
					</div>
                    </form>
                  </div><!-- /.tab-pane -->
				  </div><!-- /.tab-content -->
        
       <!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php #include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="dist/js/demo.js"></script>
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  </body>
</html><?php mysqli_close($con);?>

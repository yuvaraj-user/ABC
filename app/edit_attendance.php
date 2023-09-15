<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");

date_default_timezone_set("Asia/Kolkata");
//echo $to; firstname_F.
$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

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

$all = implode(", ",$brn_all);


if(isset($_REQUEST['submit']))	{
 $id = $_REQUEST['d_id'];	
	$cus_brn=$_REQUEST['cus_brn'];
	$colt_emp=$_REQUEST['colt_emp'];
	$dob_F=$_REQUEST['dob_F'];
	$attendance=$_REQUEST['attendance'];
	
	$status="Active";
	$updatedon=date("d-m-Y H:i:s A");
	$updatedby=$_SESSION['User'];
	
	$insert_details = mysqli_query($con,"UPDATE `tbl_attendance` SET `Date`='$dob_F', `Attendance`='$attendance',`Updated_on`='$updatedon', `Updated_by`='$updatedby' WHERE Id='$id'");
	if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_employee_attendance.php?step=suces");
					</script>';	
			
		}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chit | Employee</title>
	<meta name="author" content="Gayathri.R.KKIT">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">  
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		
	<!--<link rel="stylesheet" href="plugins/datepicker/css/datepicker.css">----->
	<!--<link rel="stylesheet" href="plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">--->

	  
	<script src="js/jquery-1.10.2.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->
	<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<script> 
function get_brnch_cus_details(val) {  
				//alert(val);
				$.ajax 
				({
				type: "POST",
				url: "get_lead.php",
				data:'brnch_cust_id='+val,			 
				success: function(data){
				$("#enrl_detail").html(data); 
				$("#emp").selectpicker({});
				}
				});
				}
</script>
<style>	
ul.dropdown-menu.inner {
    max-height: 250px !important;
}
.content-wrapper
{
	padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: inherit !important;
	 min-height : 320px;
	 padding: 34px 10px !important;
	     font-size: 15px !important;
	  
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
</style>	
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
				
    <div class="wrapper">

     <?php include 'header.php'; ?>
     <?php include 'sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">  
		<section class="content"> 
			<div class="nav-tabs-custom"> 
				<div class="box-body">
		
<div class="row panel panel-primary">

	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">Edit Employee Attendance Entry</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="view_employee_attendance.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Attendnace Details</a>
					</div>
				</div>
		</div>
	</div>
			<div class="panel-body">
                <form class="form-horizontal" name="addcustomer_details"  id="addauctionform" method="post" enctype="multipart/form-data" >
		            <div class="tab-content">
					  <div class="active tab-pane" id="timeline">
					 <?php 
					 $id = $_REQUEST['id'];
					           $query_getall2 ="select * from tbl_attendance where Status='Active' AND Id='$id'";
							   $qury_exe = mysqli_query($con, $query_getall2);
                               $fetch = mysqli_fetch_array($qury_exe);
                               $emp_id = $fetch['Emp_Id'];
                               $brnch_id = $fetch['Branch_Id'];
                               $date = $fetch['Date'];
                               $attendnace = $fetch['Attendance'];
	 				 
					 ?>
					
								<div class="col-lg-12 col-md-12"> 	
								<label class="control-label col-sm-2">Employee Name</label>
									<div class="form-group col-sm-10">
											<select  id="emp" name="colt_emp" class="form-control selectpicker" data-live-search="true" disabled>
			<option value="">Select Employee Name / Id / Mobile</option>
				<?php 
					$query_emp="SELECT `Id`, `Name`, `Collection_Agent`, `Employee_type`, `Agent_Type`, `Emp_Code`,`Status` FROM `tbl_employee` WHERE Status='Active'"; 
					$query_emp_exe=mysqli_query($con,$query_emp);
					while($fetch_emp_array=mysqli_fetch_array($query_emp_exe))
					{
					$Emp_tid=$fetch_emp_array['Id']; 
					$Emp_Code=$fetch_emp_array['Emp_Code'];
					$Emp_Name=$fetch_emp_array['Name'];
					$Emp_mobile=$fetch_emp_array['Mobile'];
				?>
			<option value="<?php echo $Emp_tid; ?>" <?php if($Emp_tid==$emp_id) echo "selected"; ?>><?php echo $Emp_Name.'/'.$Emp_Code.'/'.$Emp_mobile;  ?></option>
			<?php } ?>			
		</select>
									</div>	
								</div>	
					   <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Date of birth<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">  
						  <input class="form-control dp" value="<?php echo $date; ?>" placeholder="yyyy-mm-dd"  onchange="agecalcualte(this.value)" id="dob_F" name="dob_F" required readonly>
						
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
					  <div class="col-sm-12 form-group">
					  <label for="inputName" class="col-sm-2 control-label">Attendance<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                           <input type="radio" name="attendance" id="present"  value="present" <?php echo ($attendnace=='present')?'checked':'' ?> required>&nbsp;&nbsp;Present&nbsp;&nbsp;                        
                           <input type="radio" name="attendance" id="absent" value="absent" <?php echo ($attendnace=='absent')?'checked':'' ?>>&nbsp;&nbsp;Absent&nbsp;&nbsp; 
						   <input type="radio" name="attendance" id="weekoff" value="weekoff" <?php echo ($attendnace=='weekoff')?'checked':'' ?>>&nbsp;&nbsp;Week Off&nbsp;&nbsp; 
                        </div>
						<input type="hidden" name="d_id" value="<?php echo $id; ?>">
                      </div>
		 		     <div class="form-group">   
                       <div class="col-sm-offset-5 col-sm-10">
                          <br><br>
						  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
						  <!--<button type="reset" name="reset" id="reset" class="btn btn-warning">Reset</button> -->
                        </div>
					  </div>
				</div> 


			</form>	
                
			</div>
        </div>		
		</div>
		
		</div>
		
         </div>
       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php #include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
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
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="dist/js/demo.js"></script>
	<script src="cusimg/dist/js/bootstrap-imageupload.js"></script>
	<script>
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
        </script>

  </body>
</html>
<?php mysqli_close($con); ?>
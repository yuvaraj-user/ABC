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
        			
	$Brnch_Id=$_REQUEST['cus_brn'];
	$qry_schselectt = mysqli_query($con,"SELECT COUNT(Id) AS Ccnt FROM `tbl_employee` WHERE Status='Active' AND Branch='$Brnch_Id' AND Agent_Type !='Business Agent'");	
	$fetch_schgrpp = mysqli_fetch_array($qry_schselectt);
    $scheme=$fetch_schgrpp['Ccnt'];		
	
    $i=1;	
	for($i;$i<=$scheme;$i++)
	{
		$qry_schselect_11 = mysqli_query($con,"SELECT Id FROM `tbl_employee` WHERE Status='Active' AND Branch='$Brnch_Id' AND Agent_Type !='Business Agent'");	
		while($fetch_schgrp_11 = mysqli_fetch_array($qry_schselect_11))
		{
		$cus_brn=$_REQUEST['cus_brn'];
		$dob_F=$_REQUEST['dob_F']; 
		$attendancee="attendance_".$i;
		$attendance=$_REQUEST[$attendancee];

		$status="Active";
		$createdon=date("d-m-Y H:i:s A");
		$createdby=$_SESSION['User'];
		$updatedon=0;
		$updatedby=0;
		$emp_Id=$fetch_schgrp_11['Id'];	
	
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_attendance`(`Branch_Id`, `Emp_Id`, `Date`, `Attendance`, `Status`, `Created_on`, `Created_by`, `Updated_on`, `Updated_by`) VALUES ('$cus_brn','$emp_Id','$dob_F','$attendance','$status','$createdon','$createdby','$updatedon','$updatedby')");
		$i++;
		}
	}
	
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
				url: "get_employee_atnd.php",
				data:'brnch_cust_id='+val,			 
				success: function(data){
				$("#enrl_detail").html(data); 
				$("#emp").selectpicker({});
				}
				});
				}
</script>
<script>
function validateForm() 
	{
	$(".err-msg").remove();
	var dob_F = $.trim($("#dob_F").val());
		
    if (dob_F == "") 
	{
        $("#dob_F").after('<span class="err-msg">This is Required Field</span>');
		return false;
    }
	
	}
</script>
<style>	
.err-msg{ color:red;}
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
			<div class="col-lg-8 col-md-8">Employee Attendance Entry</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="view_employee_attendance.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Attendnace Details</a>
					</div>
				</div>
		</div>
	</div>
			<div class="panel-body">
<form class="form-horizontal" name="addcustomer_details" onsubmit="return validateForm()" id="addauctionform" method="post" enctype="multipart/form-data" >
		            <div class="tab-content">
					  <div class="active tab-pane" id="timeline">
					 
					 
						
								<!-- <div class="row" id="enrl_detail"> -->
							</div>
					   <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Date<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">  
						  <input class="form-control dp" placeholder="yyyy-mm-dd"  onchange="agecalcualte(this.value)" id="dob_F" name="dob_F" readonly>
                        </div>
						
						<?php

	
	$qry_schselect = mysqli_query($con,"SELECT COUNT(Id) AS Ccnt FROM `tbl_employee` WHERE Status='Active'");	
	$fetch_schgrp = mysqli_fetch_array($qry_schselect);
    $scheme=$fetch_schgrp['Ccnt'];
	
	$qry_schselect_1 = mysqli_query($con,"SELECT Name FROM `tbl_employee` WHERE Status='Active'");	
?>
 <!-- <input type="text" name="atti" id="atti"  value="<?php echo $scheme; ?>" required> -->
 	<div class="col-lg-12 col-md-12"> 	
		<!--<label class="control-label col-sm-4"><?php echo $scheme_1; ?></label> -->
			<div class="col-sm-12">
                                           
			<!--  <input type="radio" name="attendance_<?php echo $i;?>" id="present" value="present" required>&nbsp;&nbsp;Present&nbsp;&nbsp;<input type="radio" name="attendance_<?php echo $i;?>" id="absent" value="absent">&nbsp;&nbsp;Absent&nbsp;&nbsp;
			  <input type="radio" name="attendance_<?php echo $i;?>" id="weekoff" value="weekoff">&nbsp;&nbsp;Week Off&nbsp;&nbsp; -->
			  
			  
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>-->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Employee Name</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Week Off</th>
                </tr>
                </thead>
                <tbody>
<?php
	$i=1;
	for($i;$i<=$scheme;$i++)
	{
		while($fetch_schgrp_1 = mysqli_fetch_array($qry_schselect_1))
		{
			$scheme_1=$fetch_schgrp_1['Name'];
?>

                <tr>
				<td><?php echo $scheme_1; ?></td>
                <td><input type="radio" name="attendance_<?php echo $i;?>" id="present" value="present" required></td>
				<td><input type="radio" name="attendance_<?php echo $i;?>" id="absent" value="absent"></td>
				<td><input type="radio" name="attendance_<?php echo $i;?>" id="weekoff" value="weekoff"></td>
                </tr>
 

<?php
//$insert = mysqli_query($con, "INSERT INTO `tbl_attendance`(`Attendance`) VALUES ('$cus_brn')");
 $i++;  }
		
	}
	?>
	
                </tbody>
              </table>
  
    </div>
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
					  
		 		     <div class="form-group">   
                       <div class="col-sm-offset-5 col-sm-10">
                          <br><br>
						  <input type="submit" name="submit" id="submit" onclick="myIdproof()" class="btn btn-primary"></button>
						  <button type="reset" name="reset" id="reset" class="btn btn-warning">Reset</button>
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
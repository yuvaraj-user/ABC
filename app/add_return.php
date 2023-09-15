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
        			
	     
	$family_no = $_REQUEST['family_no'];
	$order_date = $_REQUEST['order_date'];
	$production_no = $_REQUEST['production_no'];
	$employee = $_REQUEST['employee'];
	$req_date = $_REQUEST['req_date'];
	$customer_name = $_REQUEST['customer_name'];
	$address = $_REQUEST['address'];
	$state = $_REQUEST['state'];
	$contact = $_REQUEST['contact'];
	$machine_id = $_REQUEST['machine_id'];
	$machine_type = $_REQUEST['machine_type'];
	$payment_type = $_REQUEST['payment_type'];
	$quantity = $_REQUEST['quantity'];
	$remark = $_REQUEST['remark'];
	$advance_percentage = $_REQUEST['advance_percentage'];
	$estimation = $_REQUEST['estimation'];
	$projected = $_REQUEST['projected'];
	$accessories = $_REQUEST['accessories'];
	
	

		
			 $query_insert="INSERT INTO `tbl_order_creation`(`family_no`, `order_date`, `production_no`, `employee`, `req_date`, `customer_name`, `address`, `state`, `contact`, `machine_id`, `machine_type`, `payment_type`, `quantity`, `remark`, `advance_percentage`, `estimation`, `projected`,accessories) VALUES ('$family_no','$order_date','$production_no','$employee','$req_date','$customer_name','$address','$state','$contact','$machine_id','$machine_type','$payment_type','$quantity','$remark','$advance_percentage','$estimation','$projected','$accessories')"; 
			 
			 $qury_exe=mysqli_query($con,$query_insert);
			 
			echo '<script type="text/javascript">
					window.location.replace("report_order_creation.php?step=suces");
					</script>';	 
			
			
	
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

function getcity(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'district_id='+val,
	success: function(data){
		$("#city-list").html(data);
        $('#branchcity').selectpicker({});
	}
	});
}

function getpin(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'pin_id='+val,
	success: function(data){
		$("#pin-list").html(data);
        $('#branchcity').selectpicker({});
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
				 <?php 
	$sno=mysqli_query($con,"SELECT MAX(Id) as Id FROM tbl_employee");
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


		$curnt_zonid="Emp".$curyear.$newid; 
		}
	else
	{
		$curnt_zonid = 'Emp'.$curyear."01"; 
	}	
	?>
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
			<div class="col-lg-8 col-md-8">Add Return</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="viewemployee.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Order Creation</a>
					</div>
				</div>
		</div>
	</div>
			<div class="panel-body">
                <form class="form-horizontal" name="addcustomer_details"  id="addauctionform" method="post" enctype="multipart/form-data" >
		            <div class="tab-content">
					  <div class="active tab-pane" id="timeline">
					 
					 
					  
					   <div class="col-sm-12 form-group">					   
							<label for="inputName" class="col-sm-2 control-label">Family No</label>
							<div class="col-sm-4">
								 <input type="text" name="family_no" class="form-control" id="family_no" placeholder="Family No">
							</div>
                        
                        
						
                        <label for="inputName" class="col-sm-2 control-label">Order Date<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                          <input class="form-control dp"   placeholder="dd-mm-yyyy"  onchange="agecalcualte(this.value)" id="order_date" name="order_date" required readonly>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#order_date').datepicker({
	
        format: "yyyy-mm-dd",
		endDate: '+0d',
        autoclose: true
	 });
    $('.dp').on('change', function () {
        $('.datepicker').hide();
    });

	});
</script>
                        </div>
                      				   
							
						
					   
			<div class="col-sm-12 form-group">
					  <label for="inputName" class="col-sm-2 control-label">Production No<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" name="production_no" id="production_no" class="form-control"  maxlength="10" placeholder="Production No" required >
                        </div>
						 <label for="inputEmail" class="col-sm-2 control-label">Executive Name</label>
                        <div class="col-sm-4">
                        <!-- <input type="text" name="designation" class="form-control" id="inputName" placeholder="Designation" >---->
						 <select id="employee"  name="employee"  class="form-control  selectpicker" data-live-search="true"   >			
						<option value="">Select Executive Name</option>
						 <?php 
					   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_employee` WHERE Status='Active'");
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
                        <label for="inputName" class="col-sm-2 control-label">Customer Req Date</label>
                        <div class="col-sm-4">
                          <input class="form-control dp1"   placeholder="dd-mm-yyyy"  onchange="agecalcualte(this.value)" id="req_date" name="req_date" required>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#req_date').datepicker({
	
        format: "yyyy-mm-dd",
		endDate: '+0d',
        autoclose: true
	 });
    $('.dp1').on('change', function () {
        $('.datepicker').hide();
    });

	});
</script>
						<label for="inputName" class="col-sm-2 control-label">Customer Name</label>
                        <div class="col-sm-4">
                          <input type="text" name="customer_name" id="customer_name" class="form-control" style="text-transform:lowercase" placeholder="Customer Name" >
                        </div>
						
                      </div>
					
					  <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                          <textarea name="address" id="address" placeholder="Present Address" class="form-control"></textarea>
                        </div> 
						</div>
                      
					   
					  
					  
                 <div class="form-group col-sm-12">
					  <label for="inputName" class="col-sm-2 control-label">State </label>
                       <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="state" id="state" onChange="getdistrict(this.value);" data-live-search="true">
						<option value="">Select</option>
                   								<?php $query =mysqli_query($con,"SELECT * FROM state");
while($row=mysqli_fetch_array($query))
{ ?>
<option value="<?php echo $row['StateName'];?>"><?php echo $row['StateName'];?></option>
<?php
}
?>
						 </select>
						 </div>
					  <div id="district-list"></div>
					  </div>
					  <div class="form-group" >
					 
					   
						                 
                        <div id="city-list"></div>
						 <div id="pin-list"></div>
                     
					 
					 
		
                      <div class="col-sm-12 form-group">
                        
                         <label for="inputEmail" class="col-sm-2 control-label">Contact</label>
                         <div class="col-sm-4">
                         <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact" >
                         </div>
						 <label for="inputEmail" class="col-sm-2 control-label">Machine Name</label>
                        <div class="col-sm-4">
                         <select id="machine_id"  name="machine_id"  class="form-control  selectpicker" data-live-search="true"   >			
						<option value="">Select Machine Name</option>
						 <?php 
						   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_product` WHERE Status='Active'");
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
                        
                         <label for="inputEmail" class="col-sm-2 control-label">Quantity</label>
                         <div class="col-sm-4">
                         <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity" >
                         </div>
						 <label for="inputEmail" class="col-sm-2 control-label">Accessories Details</label>
                        <div class="col-sm-4">
                         <input type="text" name="accessories" class="form-control" id="accessories" placeholder="Accessories Details" >
                        </div>
                        </div>	
						
					
						<div class="col-sm-12 form-group">
							<label for="inputEmail" class="col-sm-2 control-label">Machine Type</label>
							<div class="col-sm-4">
								<select id="machine_type"  name="machine_type"  class="form-control  selectpicker" data-live-search="true"   >			
									<option value="">Select Machine Type</option>
									<option value="1">Standard</option>
									<option value="2">Standard Heavy</option>
									<option value="3">Customized</option>				
								</select>
							</div>
							 <label for="inputEmail" class="col-sm-2 control-label">Remark</label>
                        <div class="col-sm-4">
                         <input type="text" name="remark" class="form-control" id="remark" placeholder="Remark" >
                        </div>
                        </div>
						
						
					
		 		     <div class="form-group">   
                       <div class="col-sm-offset-5 col-sm-10">
                          <br><br>
						  <input type="submit" name="submit" id="submit" class="btn btn-primary"></button>
						  <button type="reset" name="reset" id="reset" class="btn btn-warning">Reset</button>
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
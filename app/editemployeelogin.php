<?php
/* author:Gayathri.R.KKIT */
session_start();
require 'checkagain.php';
include_once 'srdb.php';

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



if(isset($_REQUEST['employee'])){
	
			$gid = $_REQUEST['gid'];
			$emptabid=$_REQUEST['applicantno'];
			$emptabid=$_REQUEST['employeetabid'];
			$ename = $_REQUEST['ename'];
			$branch_id = $_REQUEST['branch'];
			$empcode = $_REQUEST['empcode'];
			$Designation = $_REQUEST['Designation'];
			$mobile = $_REQUEST['mobile'];	
			$accessid = $_REQUEST['accessid'];
			$loginemailid =$_REQUEST['loginemailid'];
			$password =$_REQUEST['password'];
			$newpwd=hash('sha256', $password);
			$role=$_REQUEST['rolename'];
			$myArray = explode('$', $role);
			$permission = $myArray[0];
			$add = $myArray[1];
			$edit = $myArray[2];
			$delete = $myArray[3];
			$name = $myArray[4];
			$user_type = $_REQUEST['user_type'];

			$level=$_REQUEST['level'];
			$leveltype=$_REQUEST['leveltype'];

			$cmonth=date("m");
			$cyear=date("y");
			$date=date("Y-m-d");
			$status="Active";
			$createdon=date("d-m-Y H:i:s A");
			$createdby=$_SESSION['User'];
			$updatedon=0;
			$updatedby=0;
			if($password!=''){
						$insert_details = mysqli_query($con,"UPDATE `tbl_users` SET `Role`='$name',`Mobile`='$mobile',`Permission`='$permission',`Edit`='$edit',`Role_add`='$add',`Delete`='$delete',`Updated_On`='$updatedon',`Updated_By`='$updatedby',`Status`='Active',`User_type`='$user_type',Password='$newpwd' WHERE Id='$gid'");
			}else{
						$insert_details = mysqli_query($con,"UPDATE `tbl_users` SET `Role`='$name',`Mobile`='$mobile',`Permission`='$permission',`Edit`='$edit',`Role_add`='$add',`Delete`='$delete',`Updated_On`='$updatedon',`Updated_By`='$updatedby',`Status`='Active',`User_type`='$user_type' WHERE Id='$gid'");
			}

	if($insert_details){
	 			echo '<script type="text/javascript">
									window.location.replace("viewemployeelogin.php?step=succes");
							</script>';
		}	
}
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chit | Employee login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
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
	
	<!--<link rel="stylesheet" href="plugins/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">--->
    <link rel="stylesheet" href="plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
  
	<script src="js/jquery-1.10.2.js"></script>
	
	<!--<script src="js/jquery.min.js"></script>-->

<link rel="stylesheet" href="dist/css/bootstrap-select.css">

<script src="dist/js/bootstrap-select.js"></script>

	<script>
	function getemployeelogin(val) {
				//alert(0);	
				$.ajax({
				type: "POST",
				url: "get_employeelogin.php",
				data:'div_doc='+val,
				success: function(data){
				$("#log").html(data);
				}
				});
				}
      $(function() {
				$('input[name="Paymenttype"]').on('click', function() {
				if ($(this).val() == 'Cash') {
				$('#textboxes').show();
				}
				else {
				$('#textboxes').hide();
				}
				});

				$('input[name="Paymenttype"]').on('click', function() {
				if ($(this).val() == 'Cheque') {
				$('#textboxess').show();
				}
				else {
				$('#textboxess').hide();
				}
				});
				});
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
#log_imgid
{
	    margin: -171px 0 !important;
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
			<div class="col-lg-8 col-md-8">Add New Employee Login</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="viewemployeelogin.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Employee Details</a>
					</div>
				</div>
		</div>
	</div>
		 <div class="panel-body">
                <?php if($final==1){ ?>
		<div class="alert alert-block alert-success fade in box">
		<h4 class="alert-heading"><i class="fa fa-check-circle"></i> Success !</h4>
		<p>
		     <?php echo "Your Details are added successfully"; ?>
		</p>
		<p>		
		<button type="button" onclick="window.location.href='viewemployeelogin.php'" class="btn btn-warning">View Employee Login(s)</button>
		<button type="button" onclick="window.location.href='addemployeelogin.php'" class="btn btn-warning">Or Add Another Employee Login </button>		
		</p>
		</div>
		<?php }else if($final==2){ ?>
			
			<div class="alert alert-block alert-danger fade in">
			<h4 class="alert-heading"><i class="fa fa-times-circle"></i> Failed !</h4>
			<p>
		     <?php echo "This employee details is already Added.(Check Email Id or Access Id)"; ?> 
	           </p>
			</div>
			

		<?php }else{
			
		} ?>
     <div class="tab-content">	
	 <?php 
			        $uid=$_REQUEST['id'];
				    $qury="select * from tbl_users  where Id='$uid' and  Status='Active'";
					$qury_exe=mysqli_query($con,$qury); 					
					$fetch=mysqli_fetch_array($qury_exe);			 
             $namedb=$fetch['Name'];
             $branch=$fetch['Branch'];
             $emptbldb=$fetch['Emp_tbl_Id']; 			 
			 $empcodedb=$fetch['Emp_Code']; 
			 $designation=$fetch['Designation']; 
			 $role=$fetch['Role']; 
			 $accessiddb=$fetch['Access_ID']; 
			 $phone=$fetch['Mobile']; 
		 $email=$fetch['Email']; 
			 $photo1=$fetch['Photo'];
			
			 
		 $type = $fetch['User_type'];
			 
			 ?>	
		   <div  class=" active tab-pane" >
                    <form class="form-horizontal" name="addemployee_details" action="" method="post" enctype="multipart/form-data">
				<?php if ($type == "Admin") { ?>
					 <div class="col-sm-12 form-group">					   
							<label for="inputName" class="col-sm-2 control-label">Branch  Name<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-10">
								<select id="branch"  name="branch" class="form-control  selectpicker" data-live-search="true"
								onchange="getAuctionchit(this.value);"  required readonly>						
								<option value="">Select Branch Name / Code</option>
						<?php 
						$query_Applic="SELECT * FROM `tbl_branch` WHERE Status='Active'"; 
						$query_Appc_exe=mysqli_query($con,$query_Applic);
						while($fetch_Appc_array=mysqli_fetch_array($query_Appc_exe))
						{
						$fetch_b_id=$fetch_Appc_array['Id'];
						$fetch_b_name=$fetch_Appc_array['Name']; 
						$fetch_b_code=$fetch_Appc_array['Code']; 
						
						?>
						<option value="<?php echo $fetch_b_id;?>"<?php if($fetch_b_id == $branch) echo "selected"; ?>><?php echo  $fetch_b_name.'/'.$fetch_b_code;?></option>
						<?php } ?>
						</select>
																
								</select>
							</div>							
                        </div>
					<?php } elseif ($type == "Zone") { 
						?>
						 <div class="col-sm-12 form-group">					   
							<label for="inputName" class="col-sm-2 control-label">Branch  Name<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-10">
								<select id="branch"  name="branch" class="form-control  selectpicker" data-live-search="true"
								onchange="getAuctionchit(this.value);"  required readonly>						
								<option value="">Select Branch Name / Code</option>
						<?php 
						$query_Applic="SELECT * FROM `tbl_branch` WHERE Id IN ($all) AND Status='Active'"; 
						$query_Appc_exe=mysqli_query($con,$query_Applic);
						while($fetch_Appc_array=mysqli_fetch_array($query_Appc_exe))
						{
						$fetch_b_id=$fetch_Appc_array['Id'];
						$fetch_b_name=$fetch_Appc_array['Name']; 
						$fetch_b_code=$fetch_Appc_array['Code']; 
						
						?>
						<option value="<?php echo $fetch_b_id;?>"<?php if($fetch_b_id == $branch) echo "selected"; ?>><?php echo  $fetch_b_name.'/'.$fetch_b_code;?></option>
						<?php } ?>
						</select>
																
								</select>
							</div>							
                        </div>
					<?php } else { ?>
                                <input type="hidden" value="<?php echo $brn_id ?>" name="branch" id="getbrnch">
											<?php		}?> 
						
						
                      <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Employee Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-10">
                         <!-- <input type="text" name="ename" class="form-control" id="inputName" placeholder="Name" >---->
				 <select  id="getFname3" name="applicantno" class="form-control selectpicker" data-live-search="true" onchange="getemployeelogin(this.value);"  required readonly>
						<option value="">Select Employee Name </option>
						<?php 
						  $query_Applic="select * from tbl_employee where Status='Active' "; 
				    	 $query_Appc_exe=mysqli_query($con,$query_Applic);
						while($fetch_Appc_array=mysqli_fetch_array($query_Appc_exe))
						{
						$fetch_appc_id=$fetch_Appc_array['Id'];
						$fetch_appc_Name=$fetch_Appc_array['Name'];
						$fetch_appc_Emp_code=$fetch_Appc_array['Emp_Code'];
						?>
						<option value="<?php echo $fetch_appc_id; ?>"<?php if($fetch_appc_id == $emptbldb) echo "selected"; ?>><?php echo $fetch_appc_Name.'/'.$fetch_appc_Emp_code;  ?></option>
                       	                  <?php } ?>			
                   </select>		 
                        </div>
                      </div>
		    
			<div id="log">	  
			<script>
			$(document).ready(function(){ 
			 $('#getFname3').prop('disabled',true);
			 $('#branch').prop('disabled',true);
			});
			</script>
			</div>
			<input type="hidden" value="<?php echo $uid; ?>" name="gid">
			         
			<div class="col-sm-12 form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email Id<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                         <input type="email" name="loginemailid" class="form-control" value="<?php echo $email; ?>" id="inputName" placeholder="Email Id" required readonly>
                        </div>

                        <label for="inputEmail" class="col-sm-2 control-label">Password<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">                        
			 <input type="password" name="password" class="form-control" autocomplete="new-password" id="inputName" placeholder="Password">
                        </div>
                      </div>
					 
			<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">User Type<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-7">
                         <select name="user_type" class="form-control selectpicker"  data-live-search="true" required>
					   <option value="">Select User Type</option>
					   <option <?php if ($type == "Admin" ) echo 'selected' ; ?> value="Admin">Admin</option>
					   <option <?php if ($type == "Zone" ) echo 'selected' ; ?> value="Zone">Zonal</option>
					   <option <?php if ($type == "Employee" ) echo 'selected' ; ?> value="Employee">Branch</option>
                       </select>
                        </div>
                        </div>
					 	 <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">User Role</label>
                        <div class="col-sm-7">
                         <select name="rolename" class="form-control selectpicker" onchange="get_brnch(this.value);" data-live-search="true">
					   <option value="">Select User Role Name</option>
					   <?php 
					   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_user_role`");
					   while($viewuser=mysqli_fetch_array($selectzone))
					   {
						   $zid=$viewuser['Id'];
						   $zname=$viewuser['Role_name'];
						   $permission=$viewuser['Permission']; 
						   $add=$viewuser['Role_add']; 
						   $edit=$viewuser['Role_edit']; 
						   $delete=$viewuser['Role_delete']; 
						  
					?>
						<option value="<?php echo $permission."$".$add."$".$edit."$".$delete."$".$zid;?>"<?php if($role == $zid) echo "selected"; ?>><?php echo $zname?></option>
					<?php }
					   ?>
                       </select>
                        </div>
                        </div>
			
			<script>
			$(function() {
    $('#level').change(function(){
        if($('#level').val() == '1') {
            $('#textboxes').show(); 
        } else {
            $('#textboxes').hide(); 
        } 
    });
});
 </script>			
                      <div class="col-sm-12 form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                          <button type="submit" name="employee" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
				  </div><!-- /.tab-content -->
         </div>
       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php #include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
  <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
   <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
   <script src="plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
  </body>
</html>
<?php mysqli_close($con);?>
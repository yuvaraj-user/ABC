<?php
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
$desg_branch = $_SESSION['Desg_Branch'];
//$desg_branch = "3";
$desg_branch_count = strlen((string)$desg_branch);


if(isset($_REQUEST['employee'])){
	 $emptabid=$_REQUEST['applicantno'];
	// $ename = $_REQUEST['ename'];
	// $empcode = $_REQUEST['empcode'];
	$Designation = $_REQUEST['Designation'];
	$mobile = $_REQUEST['mobile'];	
	$accessid = $_REQUEST['accessid'];
    $loginemailid =$_REQUEST['loginemailid'];
    $password =$_REQUEST['password'];
	$newpwd=hash('sha256', $password);
	$role=$_REQUEST['rolename'];
	$branchname = $_REQUEST['branch'];
	$user_type = $_REQUEST['user_type'];

	//emp name and code
	$sql1 = mysqli_query($con, "select * from tbl_employee where Id = '$emptabid' and Status = 'Active'");
	$fetche = mysqli_fetch_array($sql1);
	$ename = $fetche['Name'];
	$empcode = $fetche['Emp_Code'];
	
	
	// $myString = "9,admin@example.com,8";
    $myArray = explode('$', $role);
	$permission = $myArray[0];
	$add = $myArray[1];
	$edit = $myArray[2];
	$delete = $myArray[3];
    $name = $myArray[4];
	
	if($_FILES["file1"]["tmp_name"]!="")
		{
	   $fileName_2 = $_FILES["file1"]["name"];
       $fileTmpLoc_1 = $_FILES["file1"]["tmp_name"];
      
		
	  $ext1 = pathinfo($fileName_2, PATHINFO_EXTENSION);
      $file_F = basename($fileName_2, ".".$ext1);
      $uniqid= $fetchid->mid+1;
      $path_1 ='./Employee Photo/' . $empcode.'.'.$ext1;
	  move_uploaded_file($_FILES["file1"]["tmp_name"], $path_1);
		}
		else{
			
			$path_1="";
		}
	
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
	
## Check for Previous Entries : Begin ##

## Check Length of Serial Number & Generate Next Appropriate Number : End
	
	
	$alreadychk = mysqli_query($con,"select * from tbl_users where Email='$loginemailid' AND Status='Active'");
	$fetchcnt = mysqli_num_rows($alreadychk);
	
	if($fetchcnt==0){
		
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_users`( `Emp_tbl_Id`,`Emp_Code`,`Branch`, `Name`,`Role`,`Role_add`,`Edit`,`Delete`,`Permission`,`Designation`, `Password`, `Mobile`, `Email`, `Photo`,`Created_By`, `Created_On`, `Updated_By`, `Updated_On`, `Status`,`User_type`) VALUES ('$emptabid','$empcode','$branchname','$ename','$name','$add','$edit','$delete','$permission','$Designation','$newpwd','$mobile','$loginemailid','$path_1','$createdby','$createdon','$updatedby','$updatedon','$status','$user_type')");
										
											
		 $selectid="select Max(Id) as Id from tbl_users where Status='Active'";
		 $select_exe=mysqli_query($con,$selectid);
		 $select_fetch=mysqli_fetch_array($select_exe);
		 $userid=$select_fetch['Id'];
		 
		$insert_details1 = mysqli_query($con,"UPDATE `tbl_employee` SET `User_Id`='$userid' where Id='$emptabid'" );
		
	}
	if($insert_details){
			$final = 1;
		}else{
		$final = 2;	
	}
}else{
	$final = 0 ;
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
				$('#bid_process').hide();
				 $('#submit').show();
				//alert(0);	
				$.ajax({
				type: "POST",
				url: "get_employeelogin.php",
				data:'div_doc='+val,
				success: function(data){
				$("#log").html(data);
				$('#getFname3').selectpicker({});
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
				
				function getAuctionchit(val) {

				 $('#bid_process').hide();
				 $('#submit').show();
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
	 
		   <div  class=" active tab-pane" >
        <form class="form-horizontal" name="addemployee_details" action="" method="post" enctype="multipart/form-data">   
			<div id="log">	  
			<div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Employee Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-10">
                         <!-- <input type="text" name="ename" class="form-control" id="inputName" placeholder="Name" >---->
				 <select  id="getFname3" name="applicantno" class="form-control selectpicker" data-live-search="true"  onchange="getAuctionchit(this.value);" required>
						<option value="">Select Employee Name </option>
						<?php 
						  $query_Applic="select Id,Name from tbl_employee where Status='Active' and on_roll !='yes'"; 
				    	 $query_Appc_exe=mysqli_query($con,$query_Applic);
						while($fetch_Appc_array=mysqli_fetch_array($query_Appc_exe))
						{
						$fetch_appc_id=$fetch_Appc_array['Id'];
						$fetch_appc_Name=$fetch_Appc_array['Name'];
						?>
						<option value="<?php echo $fetch_appc_id; ?>"><?php echo $fetch_appc_Name;  ?></option>
                       	                  <?php } ?>			
                   </select>		 
                        </div>
                      </div>
			</div>
			        
			<div class="col-sm-12 form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Login User Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                         <input type="text" name="loginemailid" class="form-control" id="inputName" placeholder="Email Id" onkeyup="getAuctionchit(this.value);" required>
                        </div>

                        <label for="inputEmail" class="col-sm-2 control-label">Password<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">                        
			 <input type="password" name="password" class="form-control" id="inputName" placeholder="Password" onkeyup="getAuctionchit(this.value);" required>
                        </div>
                      </div>
					  <div class="col-sm-12 form-group">
											<label class="col-sm-2 control-label" for="form-field-3">
												Photo
											</label>
											<div class="col-sm-10">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail"  style="width: 200px; height: 150px;"><img src="dist/img/text.png" alt=""/>
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
													<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span>
													&nbsp;&nbsp;&nbsp;&nbsp;<span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
															<input type="file" id="file1" name="file1">
														</span>
														<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
															<i class="fa fa-times"></i> Remove
														</a>
													</div>
												</div>
											</div>
					  </div>
					  <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">User Type<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-7">
                         <select name="user_type" class="form-control selectpicker"  data-live-search="true" required>
					   <option value="">Select User Type</option>
					   <option value="Admin">Admin</option>
					   <option value="Employee">Employee</option>
                       </select>
                        </div>
                        </div>
					 	  <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">User Role<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-7">
                         <select name="rolename" class="form-control selectpicker" onchange="get_brnch(this.value);" data-live-search="true" required>
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
						<option value="<?php echo $permission."$".$add."$".$edit."$".$delete."$".$zid;?>"><?php echo $zname?></option>
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
                          <button type="submit" id="submit" name="employee" class="btn btn-danger">Submit</button>
                        </div>
						<span id="bid_process" style="display:none;">
								<div class="col-sm-5"></div>	
								<div class="col-sm-5">
									<img src="loading.gif" alt="Loading ..." width="150" height="150">
								</div>		
								<div class="col-sm-5"></div>		
							</span>
                      </div>
					  <script>
$(document).ready(function(){
    $("#submit").click(function(){
        $("#submit").hide();
        $("#bid_process").show();
    });
});
</script>
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
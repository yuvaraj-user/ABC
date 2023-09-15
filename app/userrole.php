<?php  
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>User Access</title>
<meta name="author" content="">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script>
	function get_zone(val) {
		$.ajax({
		type: "POST",
		url: "userrole.php",
		data:'brnch_enrl='+val,
			success: function(data){
				$("#doc_brn").html(data);  
			}
		});
	}
</script>
<script src="js/jquery.min.js"></script>
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
#heading{
	margin:10px 260px 0 0;
}
</style>
	
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  	<?php
if(isset($_REQUEST['submit']))
{
    $name = $_REQUEST['rolename'];
     $permission = implode(",",$_REQUEST['permission']);
	 $add = implode(",",$_REQUEST['add']);
	 $edit = implode(",",$_REQUEST['edit']);
	 $delete = implode(",",$_REQUEST['delete']);
    $createdon=date("d-m-Y H:i:s A");
    $createdby=$_SESSION['User'];
    $updatedon=0;
    $updatedby=0;
	$alreadychk = mysqli_query($con,"select * from tbl_user_role where Role_name='$name' AND Status ='Active'");
	$fetchcnt = mysqli_num_rows($alreadychk);
	if($fetchcnt==0)
	{	 
		$insert_details = mysqli_query($con,"insert into tbl_user_role(`Role_name`,`Permission`,`Role_edit`,`Role_delete`,`Role_add`,`Created_On`, `Created_By`, `Updated_on`, `Updated_By`,`Status`) values('$name','$permission','$edit','$delete','$add','$createdon','$createdby','$updatedon','$updatedby','Active')"); 
        $insert_details_role = mysqli_query($con,"UPDATE tbl_role SET `User_Role_Selection`='yes' WHERE Name='$name'");  		
		}
	if($insert_details){	
	echo '<script type="text/javascript">
					window.location.replace("userrole.php?step=suces");
					</script>';   
}
else{
	echo '<script type="text/javascript">
					window.location.replace("userrole.php?step=fail");
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
  
        <!-- Main content -->
        
		<?php 
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Your Details are Added Successfully.
  </div>

	<?php 
	}
	else if($final == "dbfail")
	{ ?>
		<div class="alert alert_msg alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Error!</strong> Server Error.
	</div>
	<?php }
	else if($final == "fail")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Failed!</strong>Your Details are Already Exist.
	</div>
	<?php }
	else if($final == "delete")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Details Was Removed Successfully.
	</div>
	<?php } 
	else if($final == "update")
	{ ?>
		<div class="alert alert_msg alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Details Was Updated Successfully.
	</div>
	<?php } 
	?>
		<div class="panel-heading lead ">
                <div class="row">
                     <div class="col-lg-8 col-md-8">User Access</div>        
                    <div class="col-lg-4 col-md-4 text-right">
                         <div class="btn-group text-center">
					<a href="userrole_edit.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Edit User Role</a>
				</div>
                    </div>
                </div>
        </div>
    <div class="panel-body"> 
    <div class="col-sm-12 form-group">  
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
                        
                        <div class="form-group col-sm-12 col-md-12">
							<div class="form-group">
								<label for="inputEmail" class="col-sm-2 control-label">User Role<font color="red">&nbsp;*&nbsp;</font></label>
								<div class="col-sm-7">
									 <select name="rolename" class="form-control selectpicker" onchange="get_brnch(this.value);" data-live-search="true" required>
										<option value="">Select User Role Name</option>
										<?php $selectbranch=mysqli_query($con,"select Id,Name from tbl_role where Status='active' AND User_Role_Selection != 'yes'");
										while($fetch_branch_array=mysqli_fetch_array($selectbranch))
										{
										 $desinid=$fetch_branch_array['Id'];
										 $designname=$fetch_branch_array['Name'];
										 ?>
										<option value="<?php echo $designname;?>"><?php echo $designname;?></option>
										<?php } ?>						            						
									</select>
								</div>
							</div>
						</div>
						
						<!-- <div class="form-group col-sm-12 col-md-12"> 
							<div class="container">
								 <div class="panel panel-default"  id="heading">
									 <div class="panel-heading"><h4 style=" text-align: center;">
										<input style=" text-align: center;" type="checkbox" value="h3" class="customer_head" id="customer_head" name="permission[]"/>
										<b>Subscriber Management</b></h4>
									 </div>
								 </div>
							</div>
							<div id="customer_div" class="customer_div form-group" style="display:none">
								<div class="form-group col-sm-12 col-md-12"> 
									<div class="col-sm-3 col-md-3" id="tab8">			
										<input type="checkbox" name="checkAll7" id="checkAll7"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="8" class="child_customer customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Subcriber Details</label>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.1" class="child_customer customer" id="customer_add" name="add[]"/></label>
										<span class="control-label">Add</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.2" class="child_customer customer" id="customer_edit" name="edit[]"/></label>
										<span class="control-label">Edit</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.3" class="child_customer customer" id="customer_delete" name="delete[]"/></label>
										<span class="control-label">Delete</span>
									</div>	
									
									<div class="col-sm-3 col-md-3" id="tab9">	
										<input type="checkbox" name="checkAll8" id="checkAll8"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="9" class="child_enroll customer" id="enroll" name="permission[]"/></label>
										<label class="control-label">Enrollment Details</label>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.1" class="child_enroll customer" id="enroll_add" name="add[]"/></label>
										<span class="control-label">Add</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.2" class="child_enroll customer" id="enroll_edit" name="edit[]"/></label>
										<span class="control-label">Edit</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.3" class="child_enroll customer" id="enroll_delete" name="delete[]"/></label>
										<span class="control-label">Delete</span>
									</div>	
									
									<div class="col-sm-3 col-md-3" id="tab10">	
										<input type="checkbox" name="checkAll9" id="checkAll9"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="10" class="child_document customer" id="document" name="permission[]"/></label>
										<label class="control-label">Document Details</label>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="10.1" class="child_document customer" id="document_add" name="add[]"/></label>
										<span class="control-label">Add</span>
										<br>
									</div>	
									
									<div class="col-sm-3 col-md-3" id="tab11">	
										<input type="checkbox" name="checkAll10" id="checkAll10"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="11" class="child_auction customer" id="auction" name="permission[]"/></label>
										<label class="control-label">Auction Details</label>	
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.1" class="child_auction customer" id="auction_add" name="add[]"/></label>
										<span class="control-label">Add</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.2" class="child_auction customer" id="auction_edit" name="edit[]"/></label>
										<span class="control-label">Edit</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.3" class="child_auction customer" id="auction_delete" name="delete[]"/></label>
										<span class="control-label">Delete</span>
									</div>		
									
									<div class="col-sm-3 col-md-3" id="tab12">	
									   <input type="checkbox" name="checkAll11" id="checkAll11"/>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="12" class="child_collection customer" id="collection" name="permission[]"/></label>
										<label class="control-label">Collection Activity</label>	
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="12.1" class="child_collection customer" id="collection_add" name="add[]"/></label>
										<span class="control-label">Add</span>
										<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" value="12.1" class="child_collection customer" id="collection_delete" name="delete[]"/></label>
										<span class="control-label"></span>
										<br>
									</div>			
								
									<div class="col-sm-3 col-md-3" id="tabr137">			
										<input type="checkbox" name="checkAllr137" id="checkAllr137"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="d13" class="child_fuzzy customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Dummy Subscribers</label>
										<br>
										<br>
									</div>			
									<div class="col-sm-3 col-md-3" id="tabr141">			
										<input type="checkbox" name="checkAllr141" id="checkAllr141"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="r75" class="child_contest customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Subscriber Document Details</label>
										<br>
										<br>
									</div>	
									<div class="col-sm-3 col-md-3" id="tabr142">			
										<input type="checkbox" name="checkAllr142" id="checkAllr142"/></label>
										<label class="control-label">Select All</label>
										<br>
										<input type="checkbox" value="r159" class="child_prize customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Subscriber Merging </label>
										<br>
											<input type="checkbox" value="r179" class="child_prize customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Subscriber Ledger </label>
										<br>
										<br>
										<input type="checkbox" value="r221" class="child_sms_sub customer" id="customer" name="permission[]"/></label>
										<label class="control-label">SMS Subscriber wise </label>
										<br>
									</div>								
								</div>									
							</div>
						</div> -->
						<div class="form-group col-sm-12 col-md-12"> 
							
							<div class="container">
								 <div class="panel panel-default" id="heading">
									 <div class="panel-heading"><h4 style=" text-align: center;"> 
										<input style=" text-align: center;" value="h1" type="checkbox"  class="masters_head" id="masters_head" name="permission[]"/> <b>Masters Management</b></h4>
									 </div>
								 </div>
							</div>
							<div id="masters_div" class="masters_div form-group" style="display:none">
								<div class="col-sm-3 col-md-3" id="tab1">		
								
									<input type="checkbox" value="r1" class="child_zone masters"  id="zone" name="permission[]"/></label>
									<label class="control-label">Customer</label>
									
								</div>	
								
								<div class="col-sm-3" id="tab2">	
									
									<input type="checkbox" value="r3" class="child_branch masters" id="branch" name="permission[]"/></label>
									<label class="control-label">Stock Group</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab3">
														
									<input type="checkbox" value="r4" class="child_scheme masters" id="scheme" name="permission[]"/></label>
									<label class="control-label">Stock Group</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab4">	
									
									<input type="checkbox" value="r5" class="child_group masters" id="group" name="permission[]"/></label>
									<label class="control-label">Stock UOM</label>	
									
								</div>	

								<div class="col-sm-3" style="margin-top:20px" id="tab16">	
								
									<input type="checkbox" value="r14" class="child_config masters" id="child_config" name="permission[]"/></label>
									<label class="control-label">Branch</label>	
									
								</div>			
								
								<div class="col-sm-3" style="margin-top:20px" id="tab20">	
								
									<input type="checkbox" value="r15" class="child_slab masters" id="child_slab" name="permission[]"/></label>
									<label class="control-label">Lead Source</label>	
									
								</div>
								<div class="col-sm-3" style="margin-top:20px" id="tab20">	
								
									<input type="checkbox" value="r16" class="child_slab masters" id="child_slab" name="permission[]"/></label>
									<label class="control-label">Area</label>	
									
								</div>
								<div class="col-sm-3" style="margin-top:20px" id="tab20">	
								
									<input type="checkbox" value="r17" class="child_slab masters" id="child_slab" name="permission[]"/></label>
									<label class="control-label">City</label>	
									
								</div>
							</div>							
						</div> 
						</br></br></br></br></br>
						<div class="form-group col-sm-12 col-md-12">
						    <div class="container">
								<div class="panel panel-default"  id="heading">
									<div class="panel-heading"><h4 style=" text-align: center;">
										<input style=" text-align: center;" type="checkbox" value="r6" class="employee_head" id="employee_head" name="permission[]"/>
										<b>Employee Management</b></h4>
									</div>
								</div>
                            </div>
							<div id="employee_div" class="employee_div form-group" style="display:none">
								
								
								
								<div class="col-sm-3" id="tab2">	
									
									<input type="checkbox" value="r7" class="child_branch masters" id="branch" name="permission[]"/></label>
									<label class="control-label">Profile</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab3">
														
									<input type="checkbox" value="r8" class="child_scheme masters" id="scheme" name="permission[]"/></label>
									<label class="control-label">Attendance</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab4">	
									
									<input type="checkbox" value="r10" class="child_group masters" id="group" name="permission[]"/></label>
									<label class="control-label">User Creation</label>	
									
								</div>	

								<div class="col-sm-3" style="margin-top:20px" id="tab16">	
								
									<input type="checkbox" value="r11" class="child_config masters" id="child_config" name="permission[]"/></label>
									<label class="control-label">Role</label>	
									
								</div>			
								
								<div class="col-sm-3" style="margin-top:20px" id="tab20">	
								
									<input type="checkbox" value="r12" class="child_slab masters" id="child_slab" name="permission[]"/></label>
									<label class="control-label">Designation</label>	
									
								</div>
							</div> 
						</div> <br> <br> <br>
						<div class="form-group col-sm-12 col-md-12"> 
							<div class="container">
								 <div class="panel panel-default"  id="heading">
									<div class="panel-heading"><h4 style="text-align: center;">
										<input style=" text-align: center;" type="checkbox" value="h2" class="trans_head" id="trans_head" name="permission[]"/> <b>Transactions</b></h4>
									</div>
								 </div>
							</div>
					<div id="trans_div" class="trans_div form-group" style="display:none">
				
					<div class="col-sm-3 col-md-3" id="tab1">		
								
									<input type="checkbox" value="r1" class="child_zone masters"  id="zone" name="permission[]"/></label>
									<label class="control-label">Lead Followup</label>
									
								</div>	
								
								<div class="col-sm-3" id="tab2">	
									
									<input type="checkbox" value="r2" class="child_branch masters" id="branch" name="permission[]"/></label>
									<label class="control-label">Sale Order</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab3">
														
									<input type="checkbox" value="3" class="child_scheme masters" id="scheme" name="permission[]"/></label>
									<label class="control-label">Work Order</label>
								
								</div>	
								
								<div class="col-sm-3" id="tab4">	
									
									<input type="checkbox" value="r4" class="child_group masters" id="group" name="permission[]"/></label>
									<label class="control-label">DC</label>	
									
								</div>	

								<div class="col-sm-3" style="margin-top:20px" id="tab16">	
								
									<input type="checkbox" value="r5" class="child_config masters" id="child_config" name="permission[]"/></label>
									<label class="control-label">Receipt</label>	
									
								</div>			
								
							
					</div> 
					

			</div> 
		</div> 
						
						
						
			<div class="form-group col-sm-12 col-md-12"> 
				<div class="container">
						<div class="panel panel-default"  id="heading">
						<div class="panel-heading"><h4 style=" text-align: center;">
							<input style=" text-align: center;" type="checkbox" value="h3" class="report_head" id="report_head" name="permission[]"/> <b>Reports</b></h4>
						</div>
						</div>
				</div>
				<div id="report_div" class="report_div form-group" style="display:none">
					<div class="col-sm-12" id="tab17" >	
						<div class="col-sm-3">
							<div class="container">
								<div class="panel">
									<div class="panel-heading"><h4>
										<input  type="checkbox" value="h3" class="report_head_enrl" id="report_head_enrl" name="permission[]"/> <b>Reports</b></h4>
									</div>
								</div>
							</div>
							<div id="report_div_enrl" class="report_div_enrl form-group" style="display:none">
								<input type="checkbox" value="r21" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Lead Register</span>
								<br>
								<input type="checkbox" value="r22" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Sales Register </span>
								<br>
								<input type="checkbox" value="r23" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Workorder Register </span>
								<br>
								<input type="checkbox" value="r24" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">DC Report </span>
								<br>
								<input type="checkbox" value="r25" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Available Quantity Report </span>
								<br>
								<input type="checkbox" value="r26" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Receipt Report </span>
								<br>
								<input type="checkbox" value="r27" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Receipt Report </span>
								<br>
								<input type="checkbox" value="r28" class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Log Monitoring Report </span>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group col-sm-12" style="margin-top:10px">
				<div class="col-sm-offset-5 col-sm-10">
					<button type="submit" name="submit" class="btn btn-primary" id="submit_chk" onclick ="Check()">Submit</button>
				</div>
			</div>
		</div>
		</form>
                  </div><!-- /.tab-pane -->
		</div>
	</div>
       <!-- /.content -->
       </div><!-- /.content-wrapper -->
	  
      
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php //include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
     <div class="control-sidebar-bg"></div>
</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
  <script>
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>


<script type="text/javascript">
$(document).ready(function(){
$(function () {
    $("#tab1 #checkAll").click(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_zone").change(function(){
    var all = $('.child_zone');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll").prop("checked", true);
    } else {
        $("#checkAll").prop("checked", false);
    }
});


function someFunction(obj,abc) {
    		var class_name=abc;
			
			if ($(.class_name "#checkAll").is(':checked')) {
            $(.class_name "input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $(.class_name "input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
			
    	}


</script>
  </body>
</html><?php mysqli_close($con);?>

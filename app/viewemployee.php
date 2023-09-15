<?php
/*author:Gayathri.R.KKIT */
session_start();
require 'checkagain.php';
include_once 'srdb.php';

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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Chit | Employee</title>
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
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script>
function get_brnch(val) {
				 //alert(val);
				$.ajax({
				type: "POST",
				url: "get_viewemployee.php",
				data:'div_doc='+val,
				success: function(data){
				$("#doc_brn").html(data);  
				//alert(data);
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
	 min-height : 420px;
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
<?php 
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> New Employee Was Added Successfully.
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
    <strong>Failed!</strong> This Details Was Already Exist.
	</div>
	<?php }
	else if($final == "apl")
	{ ?>
		<div class="alert alert_msg alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> This Customer Was Approved Successfully To Enrollment.
	</div>
	<?php }
	else if($final == "decl")
	{ ?>
		<div class="alert alert_msg alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> This Customer Was Dis Approved Successfully.
	</div>
	<?php }
	?>
<div class="row panel panel-primary">
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">View Employee Details</div>				
				<div class="col-lg-4 col-md-4 text-right">
				<?php if(in_array(5.1,$ex_add)) { ?>
					<div class="btn-group text-center">
						<a href="addemployee.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;Add Employee</a>
					</div>
					<?php } ?>
				</div>
		</div>
	</div>
			
		<div class="panel-body"> 
		<div class="row">                               
					<div class="col-lg-12 col-md-12 col-sm-12">				 
						<div class="tab-content">
							<div id="Summery" class="tab-pane fade in active">
								<div class="active tab-pane" id="group">
									<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SNo</th>
						<th>Emp Id</th>
                        <th>Name</th>
                       
						<th>Address</th>
                        <th>State</th>	
                        <th>Mobile</th>
                        <th>Email Id</th>						
                       
                        <th>PAN no</th>		
                        <th>Joining date</th>   
                        <th>Designation</th>
                        <th>Role</th>
                        <th>Branch</th>
                        
                        <th>PF</th>
                        <th>ESI</th>
                        <th>Target for new business</th>	
                        <th>Target for new collection</th>
                        <th>Blood group</th>
                        <th>Nomination details</th>
                        <th>Relationship of nominee</th>
                       <th>Original Submitted</th>
                       <th>Qualification</th>
					
					  <th>Extra qualification</th>	
					  <th>Previous company details</th>	
					  <th>Experience</th>	
					  <th>Resignation date</th>
					 <th>Reason For resignation </th>
					 <th>Verification on call by</th>
					 <th>Security deposit </th> 
					 <?php if((in_array(5.3,$ex_del)) || in_array(5.2,$ex_edit)) { ?> 
						<th>Action</th>
					 <?php } ?>		
				  </tr>
      </thead>
		  <tbody>
					<?php 
				   
									$qury_cus="select * from tbl_employee  where Status='Active'  and on_roll ='yes'"; 
								
					$qury_exe=mysqli_query($con,$qury_cus); 
					$i=1;
					while($fetch=mysqli_fetch_array($qury_exe))
					{
	                 $branchid=$fetch['Branch'];
					 $selectbranch=mysqli_query($con,"select * from tbl_branch where Id='$branchid' and Status='Active'");
					 $brancharray=mysqli_fetch_array($selectbranch);
					 $branchname=$brancharray['Name'];
					 
					  $designid=$fetch['Designation'];
					   $roleid=$fetch['Role'];
					 $selectdesign=mysqli_query($con,"select * from tbl_designation where Id='$designid' and Status='Active'");
					 $designarray=mysqli_fetch_array($selectdesign);
					 $designname=$designarray['Name'];

                                         $selectrole=mysqli_query($con,"select * from tbl_role where Id='$roleid' and Status='Active'");
					 $designarray_role=mysqli_fetch_array($selectrole);
					 $designname_role=$designarray_role['Name'];
					?>
                        <tr>
			<td><?php echo $i; ?></td>
      <td><?php echo  $fetch['Emp_Code']; ?></td> 
			<td  style="text-transform:uppercase"><?php echo $fetch['Name']; ?></td>
			<td><?php echo $fetch['P_City'].",".$fetch['P_District']; ?></td> 
			<td><?php echo $fetch['P_State']; ?></td> 
			<td><?php echo $fetch['Mobile']; ?></td>
			<td><?php echo $fetch['Email_Id']; ?></td>
			<td><?php echo $fetch['Pan_No']; ?></td>
			<td><?php echo $fetch['Joining_Date']; ?></td>
			<td><?php echo $designname; ?></td>
			<td><?php echo $designname_role; ?></td>
			<td><?php echo $branchname; ?></td>
			<td><?php echo $fetch['PF']; ?></td>
			<td><?php echo $fetch['ESI']; ?></td>
			<td><?php echo $fetch['Target_New_Business']; ?></td>
			<td><?php echo $fetch['Target_Collection']; ?></td>
			<td><?php echo $fetch['Blood_Group']; ?></td>
			<td><?php echo $fetch['Nominee_Del']; ?></td>
			<td><?php echo $fetch['Nominee_Relationship']; ?></td>
			<td><?php echo $fetch['Original_Submited']; ?> </td>
			<td><?php echo $fetch['Qualification']; ?></td>
			<td><?php echo $fetch['Extra_Qualification']; ?></td>
			<td><?php echo $fetch['Previous_Cmpy_Del']; ?></td>
			<td><?php echo $fetch['Experience']; ?></td>
			<td><?php echo $fetch['Resignation_Date']; ?></td>
			<td><?php echo $fetch['Reason_For_Resignation']; ?></td>
			<td><?php echo $fetch['Verification_Call_By']; ?></td>
			<td><?php echo $fetch['Security_Deposit']; ?></td>
			 <?php  if((in_array(5.3,$ex_del)) || in_array(5.2,$ex_edit)) { ?> 	
		     <td>
			 <?php if(in_array(5.2,$ex_edit)) {?>
			<button type="button" onclick="window.location.href='editemployee.php?id=<?php echo $fetch['Id']; ?>'" class="btn btn-primary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
			<?php } if(in_array(5.3,$ex_del)) {?>
			<button type="button" onclick="window.location.href='remark_employee.php?do=delete&id=<?php echo $fetch['Id']; ?>'" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
			<?php } ?>
			</td>
					<?php } ?>
                      </tr>
					<?php $i++; }  ?>
								</tbody>
						</table>
					</div>	
				</div>
				</div>
		</div>
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

<!---  Control Sidebar  Section -->
<?php #include 'controlsidebar.php'; ?>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
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
      $(function () {
        $("#example1").DataTable({
			"scrollX": true,
			"scrollY": 300,
     "scrollCollapse": true
		});
      });	  
	  
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
<?php mysqli_close($con);?>

<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';

$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$add=$fetchlevel['Role_add'];
$edit=$fetchlevel['Edit'];
$ex_edit = explode(',',$edit);

$delete=$fetchlevel['Delete'];
$ex_del = explode(',',$delete);

$add=$fetchlevel['Role_add'];
$ex_add = explode(',',$add);
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Billing</title>
<meta name="author" content="">
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
<?php 
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Coordinator is Added Successfully.
  </div>

	<?php 
	}
	else if($final == "edit")
	{ ?>
		<div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success !</strong> Updated Successfully.
	</div>
	<?php }
	else if($final == "fail")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Failed!</strong> This Details Was Already Exist.
	</div>
	<?php }
	else if($final == "delete")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong>  Removed Successfully.
	</div>
	<?php } 
	else if($final == "duplicate")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Failed!</strong> Duplicate Entry.
	</div>
	<?php } 
	?>
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>View Co-ordinator</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
						<a href="add_coordinator.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Co-ordinator</a>
				</div>
		</div>
	</div>
      
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Sector</th>
                        <th>District</th>
						<th>Designation Name</th>	
						<th>Address</th>
						<th>Mobile No</th>
						<th>Email Id</th>
						<th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
			<?php 
				$qury="select e.*,g.Name as grp_name,d.Name as dis_name from tbl_coordinator e left join tbl_group g on g.Id=e.Group_Id left join tbl_district d on d.Id=e.District_Id WHERE e.Status='Active' GROUP BY Name";
				$qury_exe=mysqli_query($con,$qury);
				$i=1;
				while($fetch=mysqli_fetch_array($qury_exe))
				{					
			 $name = $fetch['Name'];
			?>
                        <tr>
			<td align="center"><?php echo $i; ?></td>     
			
			<td><?php echo $fetch['grp_name']; ?></td>
			<td><?php echo $fetch['dis_name']; ?></td>
			<td><?php echo $fetch['Name']; ?></td>
			<td><?php echo $fetch['Address']; ?></td>
			<td><?php echo $fetch['Mobile_No']; ?></td>
			<td><?php echo $fetch['Email_Id']; ?></td>
			
		     <td>
			
				<!-- button type="button" onclick="window.location.href='edit_coordinator.php?id=<?php echo $fetch['Name']; ?>'" class="btn btn-primary">Edit&nbsp;</button -->
				
					<button type="button"  class="btn btn-danger" onclick="window.location.href='delete_coordinator.php?do=delete&id=<?php echo $fetch['Name']; ?>'"><a style=" text-decoration: none; color:#FFF" >Delete&nbsp;</a></button>
		<button type="submit" class="btn btn-info" data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $i; ?>" data-backdrop="static" data-keyboard="false">View</button> 
					<div class="modal fade" id="myModal1<?php echo $i; ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content"  style="width:85%;margin-left:140px">
					<div class="modal-header custom-stripped">
						<button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<div class="row">
						<div class="col-sm-6">
						<h4 class="modal-title"><b>Designation Name :<?php echo $name; ?></b> </b> </h4>
						</div>
						
						</div>
					</div>
					<div class="modal-body">
					  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
						<th>Shops Name</th>	
						
                      </tr>
                    </thead>
                    <tbody>
					<?php 
				    $qurydelct="select Shop_Id from tbl_coordinator where Status='Active' AND Name='$name'";
					$qury_det=mysqli_query($con,$qurydelct);
					$j=1;
				    $fetch_det=mysqli_fetch_array($qury_det);
							
					    $exc_add = explode(',',$fetch_det['Shop_Id']);
					    $cnt_array = count($exc_add);
					    for($j=0;$j<$cnt_array;$j++) {
					         $shop_id_name = $exc_add[$j];
					         
					         $qurydelct_shp="select Name from tbl_shop where Status='Active' AND Id='$exc_add[$j]'";
					         $qury_det_shp=mysqli_query($con,$qurydelct_shp);
					         $fetch_det_shp=mysqli_fetch_array($qury_det_shp);
					         $name_shp =$fetch_det_shp['Name'];
					?>
					<tr>
						<td align="center"><?php echo $j+1; ?></td>                       
						<td><?php echo $name_shp;  ?></td>
						
						</tr>
					<?php 
				
					}
					
					?>
						</tbody>
						</table>
						</div>
					</div>
				</div>
				</div>
			</td>
			
						</tr>
					<?php $i++; } ?>
                   </tbody>   
                    <tfoot>
                    </tfoot>
                  </table>
               
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
	   </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
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
			"scrollY": 300,
     "scrollCollapse": true
		});
      });	  
	  
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
</html>
<?php mysqli_close($con);?>

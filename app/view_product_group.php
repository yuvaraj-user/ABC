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
<title>billing</title>
<meta name="author" content="Manoj">
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
    <strong>Success!</strong> Product Group is Added Successfully.
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
	else if($final == "delete")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Product Group is Removed Successfully.
	</div>
	<?php } 
	?>
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>View Product Group</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
						<a href="add_product_group.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Product GRoup</a>
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
						<th>Name</th>	
						<th>HSN</th>
						<th>Code</th>
						<th>Tax Price</th>
						<th>IGST</th>
						<th>CGST</th>
						<th>SGST</th>
						<th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
				    $qury="select * from tbl_product_group where Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					$i=1;
					while($fetch=mysqli_fetch_array($qury_exe))
					{					
					?>
                        <tr>
			<td align="center"><?php echo $i; ?></td>                       
			<td><?php echo $fetch['Name']; ?></td>
			<td><?php echo $fetch['Hsn']; ?></td>
			<td><?php echo $fetch['Code']; ?></td>
			<td><?php echo $fetch['Tax_Rate']; ?></td>
			<td><?php echo $fetch['Igst']; ?></td>
			<td><?php echo $fetch['Cgst']; ?></td>
			<td><?php echo $fetch['Sgst']; ?></td>
		     <td> 
		
				<button type="button" onclick="window.location.href='edit_product_group.php?id=<?php echo $fetch['Id']; ?>'" class="btn btn-primary">Edit&nbsp;</button>
				
					<button type="button"  class="btn btn-danger" onclick="window.location.href='delete_product_group.php?do=delete&id=<?php echo $fetch['Id']; ?>'"><a style=" text-decoration: none; color:#FFF" >Inactive&nbsp;</a></button>
	
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

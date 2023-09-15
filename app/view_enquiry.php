<?php
session_start();
require "checkagain.php";
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
<!-- Bootstrap 3.3.5 Admin-->
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
.panel-body{
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
    <strong>Success!</strong> Follow is Added Successfully.
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
    <strong>Success!</strong> Follow is Removed Successfully.
	</div>
	<?php } 
	?>
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>View Follow Up</label></div>				
				<div class="col-lg-4 col-md-4 text-right">
						<a href="add_enquiry.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Enquiry</a>
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
				<th>Enquiry No  </th>
				<th>Customer Name</th>	
				<th>Date</th>	
				<th>Net Amount</th>
				<th>Created By</th>
				<th>Follow By</th>
				<th>Last Follow Date</th>
				<th>Last Remark</th>
				<th>Next FollowUp</th>
				<th>Actions</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$type = $fetchlevel['User_type'];
			$e_id = $fetchlevel['Emp_tbl_Id'];
			 if($type != "Admin") { 
				echo $qury="SELECT ef.Name As follow_name,ec.Name As create_name,p.*,s.Name as customer_name from tbl_equiry p left join tbl_customer s on p.Customer_Id=s.Id left join tbl_employee ec on p.Created_By=ec.Id left join tbl_employee ef on p.Follow_By=ef.Id where p.Status='Active' AND p.Follow_Status='Follow' AND Follow_By='$e_id' GROUP BY p.Enquiry_No order by p.Enquiry_No desc";
			}else{
				 $qury="SELECT ef.Name As follow_name,ec.Name As create_name,p.*,s.Name as customer_name from tbl_equiry p left join tbl_customer s on p.Customer_Id=s.Id left join tbl_employee ec on p.Created_By=ec.Id left join tbl_employee ef on p.Follow_By=ef.Id where p.Status='Active' AND p.Follow_Status='Follow' GROUP BY p.Enquiry_No order by p.Enquiry_No desc";
			}
			$qury_exe=mysqli_query($con,$qury);
			$i=1;
			while($fetch=mysqli_fetch_array($qury_exe))
			{	
				$enq_no = $fetch['Enquiry_No'];	
				$enq_dat = $fetch['Date'];	
				$selectlevelss = mysqli_query($con,"SELECT f.Remark,f.Follow_date,e.Name FROM tbl_followup f LEFT JOIN tbl_employee e on f.Follow_by=e.Id WHERE f.Link_Id='$enq_no' ORDER BY f.Id Desc LIMIT 0,1 ");
				$fetchlevelss = mysqli_fetch_array($selectlevelss);
			?>
		<tr>
			<td><?php echo $enq_no; ?></td>                     
			<td><?php echo $fetch['customer_name']; ?></td>
			<td><?php echo $fetch['Date']; ?></td>
			<td><?php echo $fetch['Net_Total']; ?></td>
			<td><?php echo $fetch['follow_name']; ?></td>
			<td><?php echo $fetch['create_name']; ?></td>
			<td><?php echo $fetchlevelss['Follow_date'] ?></td>
			<td><?php echo $fetchlevelss['Remark'] ?></td>
			<td><?php echo $fetch['Nxt_Follow_Date'] ?></td>
			<td>
			<button type="button"  class="btn btn-info" onclick="window.location.href='edit_enquiry.php?id=<?php echo $enq_no; ?>'"><a style=" text-decoration: none; color:#FFF" >Follow&nbsp;</a></button>
			<button type="button"  class="btn btn-danger" onclick="window.location.href='delete_enquiry.php?id=<?php echo $enq_no; ?>'"><a style=" text-decoration: none; color:#FFF" >Inactive&nbsp;</a></button>
			
			<button type="submit" class="btn btn-success" data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $enq_no; ?>" data-backdrop="static" data-keyboard="false">View</button> 
			<div class="modal fade" id="myModal1<?php echo $enq_no; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content"  style="width:95%;margin-left:140px">
					<div class="modal-header custom-stripped">
						<button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<div class="row">
						<div class="col-sm-6">
						<h4 class="modal-title"><b>Date :<?php echo $enq_dat; ?></b> </b> </h4>
						</div>
						
						<div class="col-sm-6 text-right">
						<h4 class="modal-title"><b>Enquiry No :<?php echo $enq_no; ?></b> </h4>
						</div>
						</div>
					</div>
					<div class="modal-body">
					  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
						<th>Product Name</th>	
						<th>Quantity</th>
						<th>Rate </th>
						<th>Amount</th>
						<th>Dis.Amt</th>
						<th>CGST</th>
						<th>SGST</th>
						<th>IGST</th>
						<th>Net_Amount</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
				    $qurydelct="select s.*,t.Name as prod_name from tbl_equiry s left join tbl_product t on t.Id=s.Product_Id where s.Status='Active' AND s.Enquiry_No='$enq_no'";
					$qury_det=mysqli_query($con,$qurydelct);
					$j=1;
					while($fetch_det=mysqli_fetch_array($qury_det))
					{		
					?>
					<tr>
						<td align="center"><?php echo $j; ?></td>                       
						<td><?php echo $fetch_det['prod_name']; ?></td>
						<td><?php echo $fetch_det['Quantity']; ?></td>
						<td><?php echo $fetch_det['Rate']; ?></td>
						<td><?php echo $fetch_det['Amount']; ?></td>
						<td><?php echo $fetch_det['Discount_amt']; ?></td>
						<td><?php echo $fetch_det['Cgst']; ?></td>
						<td><?php echo $fetch_det['Sgst']; ?></td>
						<td><?php echo $fetch_det['Igst']; ?></td>
						<td><?php echo $fetch_det['Net_Amount']; ?></td>
						</tr>
					<?php 
					$j++;
					}
					
					?>
						</tbody>
						</table>
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

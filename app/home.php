<?php
session_start();
require "checkagain.php";
date_default_timezone_set('Asia/Kolkata');
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Billing</title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> 
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>     
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
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
 
.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus{
    color: #fff;
    background-color: #5cb35b !important;
}
.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
    border-top-color: #5cb35b;
}
ul.nav.nav-pills.nav-justified {
    border: 1px solid #088807; 
}
.nav-pills>li>a { 
    font-weight: 900;
}
.row {margin:0;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include 'header.php'; ?>
		<?php include 'sidebar.php'; ?>
			<div class="content-wrapper">
				<div class="panel-body">  
					<table style="overflow-x:auto;" class="table table-bordered table-striped">									
						<tbody>
						
<?php 
	 $today = date('d');
	 if ($desg_branch == '') {
	 $auct_date = "SELECT b.`Id` AS bid, b.`Name` AS bname,g.`Branch_Id`,g. `Name`, g.`no_of_members`,g.`Chit_value` FROM `tbl_groupchit` g LEFT JOIN `tbl_branch` b ON g.Branch_Id = b.`Id` WHERE g.`Auction_Date`='$today' AND g.Group_Status='Not Closed' AND g.`Is_filled`='Yes' AND g.`Status`='Active' GROUP BY b.`Id`";
	
	
}
elseif($desg_branch != '' && $desg_branch != 'NULL' && $desg_branch_count != '1') {
	 $auct_date = "SELECT b.`Id` AS bid, b.`Name` AS bname,g.`Branch_Id`,g. `Name`, g.`no_of_members`,g.`Chit_value` FROM `tbl_groupchit` g LEFT JOIN `tbl_branch` b ON g.Branch_Id = b.`Id` WHERE g.`Auction_Date`='$today' AND g.Group_Status='Not Closed' AND g.`Is_filled`='Yes' AND g.`Status`='Active' AND b.`Id` IN ($desg_branch) GROUP BY b.`Id`";	
	  
}
	elseif ($desg_branch != '' && $desg_branch != 'NULL' && $desg_branch_count == '1') 
	{ 
	 $auct_date = "SELECT b.`Id` AS bid, b.`Name` AS bname,g.`Branch_Id`,g. `Name`, g.`no_of_members`,g.`Chit_value` FROM `tbl_groupchit` g LEFT JOIN `tbl_branch` b ON g.Branch_Id = b.`Id` WHERE g.`Auction_Date`='$today' AND g.Group_Status='Not Closed' AND g.`Is_filled`='Yes' AND g.`Status`='Active' AND b.`Id`='$brn_id'";
	  
}
$auct_dates = mysqli_query($con,$auct_date);
$s_no=1;
while($fetch_auct_date = mysqli_fetch_array($auct_dates))
{
	$bname =  $fetch_auct_date['bname'];   
	$brnid =  $fetch_auct_date['bid']; 
		
	$cnt_auct_date = mysqli_query($con,"SELECT COUNT(Id) AS cnt FROM tbl_groupchit WHERE `Auction_Date`='$today' AND Group_Status='Not Closed' AND `Is_filled`='Yes' AND `Status`='Active' AND Branch_Id='$brnid'");	

	$cnt_auct_dates = mysqli_fetch_array($cnt_auct_date);
	$tkt_cnt = $cnt_auct_dates['cnt'];
?>
								
		<tr>
			<td><?php echo $s_no;?></td>
			<td><?php echo $bname;?></td> 
			<td>
				<button type="button" class="center-block btn btn-success btn-xs" data-toggle="modal" data-target="#auction<?php echo $s_no;?>"><?php echo $tkt_cnt;?></button>
				
				<!-- Modal -->
				<div id="auction<?php echo $s_no;?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">

					<!-- Modal content-->
					
				  </div>
				</div>
			</td> 
		</tr>
		
		
<?php 
$s_no++;
}
?>
								
	</tbody>
</table>



</div> 
</div> 
</div>	
<?php include 'footer.php'; ?>
</div>  
<div class="control-sidebar-bg"></div>
	
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
     
 <script>
      	  
	  $(document).ready(function() {
    $('#example1').DataTable( {
			
			"scrollX": false,
			"scrollY": 500,
			"scrollCollapse": true,
			  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			   dom: 'Bfrtip',
			   stateSave: true,
			    "buttons": [
			   {
					extend: 'copyHtml5',
					title: 'Receipt Report' 			
				},
				{
					extend: 'excelHtml5',
					title: 'Receipt Report' 			
				}, 
				{
					extend: 'colvis',
					text:      '<i class="fa fa-eye" aria-hidden="true"></i>',
					title: 'Receipt Report' 			
				} 
] 

        		  
			 
    } );
} );
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
</html>
<?php mysqli_close($con);?>

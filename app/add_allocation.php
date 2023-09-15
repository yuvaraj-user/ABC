<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';
date_default_timezone_set("Asia/Kolkata");
$sessionuserid = $_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);
$Emp_tbl_Id=$fetchlevel['Emp_tbl_Id'];
$id = $_REQUEST['id'];
$enq_no = $_REQUEST['id'];

if(isset($_REQUEST['submit']))
{
	$Call_No  = $_REQUEST['id'];
	$follow_status  = $_REQUEST['follow_status'];
	$status         = "Active";
	$createdon      = date("d-m-Y H:i:s A");
	$createdby		= $Emp_tbl_Id;
	
	$c_ids  	= array();
	$add_remark = array();
	
	$c_idsd   		= $_REQUEST['c_id'];
	$add_remarksd  	= $_REQUEST['add_remark'];
	for($i=0;$i<sizeof($c_idsd);$i++){
		$cal_pri_id 	= $c_idsd[$i];
		$add_remarked 	= $add_remarksd[$i];
		if($add_remark != '') {
			$insert_detailssssss = mysqli_query($con,"INSERT INTO `tbl_call_register_remark`(`call_regis_id`,`Call_No`,`remark`,`Created_By`) VALUES ('$cal_pri_id','$Call_No','$add_remarked','$createdby')");
		}
	}
			$query_update_enable=mysqli_query($con,"UPDATE `tbl_call_register` set Work_status='$follow_status' WHERE Call_No='$Call_No' And Status='Active'");
	if(($insert_detailssssss) && ($query_update_enable)){
		echo '<script type="text/javascript">
			window.location.replace("view_add.php?step=update");
			</script>';
		}else{
		 echo '<script type="text/javascript">
					window.location.replace("view_add.php?step=fail");
				</script>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Billing </title>
<meta name="author" content="">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script>
	function get_available_quantity(val) {
		var product = val;
		var product_1 = product.split("/");
		var product_id = parseFloat(product_1[0]);
			$.ajax 
			({  
				type: "POST",
				url: "get_price_details.php",
				data:'product_id='+product_id,			 
				success: function(data){
				$("#product_id").html(data); 
				}
			});
			} 
	function get_cust_detail(val) {
			$.ajax 
			({  
				type: "POST",
				url: "get_cust_addr.php",
				data:'cust_id='+val,			 
				success: function(data){
				$("#cust_addr").html(data); 
				}
			});
			}
</script>

<Style>
.none {
	pointer-events:none;
}
</style>
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
            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="row panel panel-primary">

<div class="panel-heading lead ">
	<div class="row">
		<div class="col-lg-8 col-md-8"><b> Allocation Call Register</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_add.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Call Register</a>
				</div>
			</div>
	</div>
</div>
</div>
<?php 
    $select_edit_enq=mysqli_query($con,"SELECT eq.Customer_Id,eq.Date,eq.Follow_By,c.Address_Line1,c.Address_Line2,c.Address_Line3,c.Address_Line4 from tbl_call_register eq Left join tbl_customer c ON eq.Customer_Id=c.Id  WHERE eq.Status='Active' And eq.Call_No='$id'");
    $fetch_edit_enq = mysqli_fetch_array($select_edit_enq);
    $Customer_Id    = $fetch_edit_enq['Customer_Id'];	
    $Follow_By    = $fetch_edit_enq['Follow_By'];	
    $adress    = $fetch_edit_enq['Address_Line1'].' , '.$fetch_edit_enq['Address_Line2'].' , '.$fetch_edit_enq['Address_Line3'].' , '.$fetch_edit_enq['Address_Line4'];	
    $Date   = strtotime($fetch_edit_enq['Date']);	
    $date   = date('d-m-Y', $Date);
?>
<div class="panel-body"> 
	<form class="form-horizontal row" name="" action="" method="post" enctype="multipart/form-data" >
	<div class="row">
	<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label">Call No</label>
			<div class="col-sm-8">
				<input type="text"  class="form-control"  value="<?php echo $enq_no; ?>" name="enq_no" id="call_no" readonly>
			</div>
		</div>
		</div>
		<style>
			.none{
				pointer-events: none;
			}
		</style>
	<div class="row">
		<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Customer</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select name="customer" id="customer"  class="form-control selectpicker none"  data-live-search="true" required readonly>
			<option value="">Select Customer</option>
			<?php 
			$select_GrpQry=mysqli_query($con,"select * from tbl_customer WHERE Status='Active'");
			while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
			{
				$Name=$fetch_GrpQry['Name'];
				$Id=$fetch_GrpQry['Id'];
			?>
			<option value="<?php echo $Id;?>" <?php if($Id == $Customer_Id) echo 'selected';?>><?php echo $Name; ?></option>
		<?php 
			}
			?>
			</select>
			</div>
		</div>
			<div id="cust_addr">
            <div class="form-group col-sm-4">
                <label for="inputName" class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <textarea type="text"  class="form-control limited" readonly><?php echo $adress; ?></textarea>
                    </div>
                </div>
			</div>
	<div class="form-group col-sm-4">        
		<label for="inputName" class="col-sm-4 control-label">Call Date</label>
		<div class="col-sm-8">
			<input class="form-control"  value="<?php echo $date; ?>" name="enq_date" id="" required readonly>
			</div>
		</div>
		<div class="form-group col-sm-4">
			<script>
				$(document).ready(function () {
				$('.dp').datepicker({
					format: "dd-mm-yyyy",
					endDate: '+0d',
					autoclose: true
				});
				$('.dp').on('change', function () {
					$('.datepicker').hide();
				});
					$("#discount").val(0);
					$("#other_charge").val(0);
				});
		</script>					
	</div>
</div>
<script type="text/javascript">
function get_loading(){
	var net_totals	 = document.getElementById("total").value;
	var load_amt	 = document.getElementById("load_amt").value;
	var frieght_amt  = document.getElementById("frieght_amt").value;
	if(load_amt == ''){ load_amt = 0; }
	if(frieght_amt == ''){ frieght_amt = 0; } 
	var dis_net_total =  parseFloat(net_totals) + parseFloat(load_amt) + parseFloat(frieght_amt);
	$("#net_total").val(dis_net_total);
}
</script>
	<div class="col-sm-12" >
<?php
	$sql = mysqli_query($con,"select Id,Net_Total from tbl_call_register where Call_No='$enq_no' And Status='Active'");
	$ng 	= mysqli_num_rows($sql);
	$row 	= mysqli_fetch_array($sql);	
	$Net_Total 	= $row['Net_Total'];
	$nng 		= $ng;
?>
    <table id="mytable" border="1" width="100%">
        <tr>
            <th style="width:205px" >Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Inv Date</th>
            <th>Inv No</th>
            <th>last Remark</th>
            <th>Add Remark</th>
        </tr>
        <?php   
			$d = 1; $gg = 0; $d1 = 100 - $nng; while($d<=$nng){
			$sql2 = mysqli_query($con,"SELECT e.Id As enq_id,e.Product_Id As stock_name,e.Quantity,e.Rate,e.Amount,e.Discount_amt,e.inv_date,e.inv_no,e.Cgst,e.Sgst,e.Igst,e.Net_Amount from tbl_call_register e left join tbl_product p ON e.Product_Id=p.Id where e.Call_No='$enq_no' AND e.count1='$gg' And e.Status='Active'");
			$row2 = mysqli_fetch_array($sql2); 	
			$callP_id	=	$row2['enq_id'];

			$cal_prd=mysqli_query($con,"SELECT remark FROM `tbl_call_register_remark` WHERE Status='Active' And Call_No='$enq_no' AND call_regis_id='$callP_id' ORDER bY Id desc");
			$fetch_cal_prd = mysqli_fetch_array($cal_prd);
		?>
        <tr>
        <td>
			<input type="hidden" name="c_id[]" value="<?php echo $row2['enq_id']; ?>" id="e_id<?php echo $d; ?>" readonly/>
			<select class="form-control selectpicker" name="item<?php echo $d; ?>" id="item<?php echo $d; ?>" data-live-search="true" style="width:150px" onchange="get_details_product<?php echo $d; ?>(this.value);" disabled>
				<option value="">Select Product</option>
				<?php 
				$select_prd=mysqli_query($con,"select t.Id as tid,t.Name,t.Cgst,t.Sgst,t.Igst from tbl_purchase p left join tbl_product t on t.Id=p.Product_Id WHERE p.Status='Active'");
				while($fetch_prd=mysqli_fetch_array($select_prd))
				{
					$Name	=	$fetch_prd['Name'];
					$tid	=	$fetch_prd['tid'];
					$Cgst	=	$fetch_prd['Cgst'];
					$Sgst	=	$fetch_prd['Sgst'];
					$Igst	=	$fetch_prd['Igst'];
				?>
				<option value="<?php echo $tid."/".$Cgst."/".$Sgst."/".$Igst; ?>"  <?php if($row2['stock_name'] == $tid) echo 'selected';?>><?php echo $Name; ?></option>
			<?php }	?>
		</select>
		</td>
            <td><?php echo $row2['Quantity']; ?></td>
            <td><?php echo $row2['Rate']; ?></td>
            <td><?php echo $row2['Net_Amount']; ?></td>
            <td><?php echo $row2['inv_date']; ?></td>
            <td><?php echo $row2['inv_no']; ?></td>
            <td><?php echo $fetch_cal_prd['remark']; ?></td>
            <td><input style="width:255px" type="text" name="add_remark[]" id="add_remark<?php echo $d; ?>" class="round default-width-input " style="width: 90px" required/></td>
        </tr>    
        <?php $gg++; $d++; } $d = $nng + 1; while($d<100){ ?>
        <?php $d++; } ?>
    </table>
	<div class="row">
	<div class="col-sm-12" >
    <div class="form-group col-sm-6">
	<label for="inputName" class="col-sm-4 control-label" ></label>
	<div class="col-sm-8" style="margin-left: 0px;">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> FollowUp History </button>
	<!-- The Modal -->
	<div class="modal" id="myModal">
		<div class="modal-dialog">
		<div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">FollowUp History</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>Remark</th>	
			<th>Followup Date </th>
			<th>Followed By </th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$qurydelct="SELECT f.remark,f.created_on,e.Name from tbl_call_register_remark f LEFT JOIN tbl_employee e ON f.Created_By=e.Id  where f.Status='Active' AND f.Call_No='$enq_no' ORDER BY f.Id Desc";
			$qury_det=mysqli_query($con,$qurydelct);
			while($fetch_det=mysqli_fetch_array($qury_det))
			{		
		?>
			<tr>                      
				<td><?php echo $fetch_det['remark']; ?></td>
				<td><?php echo $fetch_det['created_on']; ?></td>
				<td><?php echo $fetch_det['Name']; ?></td>
			</tr>
			<?php $j++;	} ?>
		</tbody>
		</table>
	</div>
	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	</div>
	</div>
	</div>
	</div>	
	</div>
	</div>
    <div class="form-group col-sm-6"> 
    <label for="inputName" class="col-sm-4 control-label" >Status</label>
        <div class="col-sm-8" style="margin-left: 0px;">						
            <select class="form-control selectpicker" name="follow_status" id="follow_status" data-live-search="true">
                <option value="WIP">Work In Process</option>
                <option value="Reconfirm">Reconfirm</option>
                <option value="Reject">Reject</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-12" >
<div class="form-group col-sm-3"> 
</div>
<div class="form-group col-sm-6"> 
</br>
	<table border="1" Width="100%" align="center">
	<thead>
		<tr>
			<th colspan="3"> <center> </br>Worked Time Log </center></th>	
		</tr>
		</thead>
		<?php 
			$selectlog	=	mysqli_query($con,"SELECT Work_Status from tbl_call_register_log where Call_No='$enq_no' ORDER BY Id Desc Limit 0,1");
			$fetchlog	=	mysqli_fetch_array($selectlog);
			$Work_Status_log	=	$fetchlog['Work_Status'];
			if(!empty($Work_Status_log)){
			if($Work_Status_log == "Start"){
		?>
			<tr><td><center><button class="Sub_start_Chk btn btn-primary" Disabled> Start </button></center></td>
			<td><center><button class="Sub_stop_Chk btn btn-primary" onClick="this.disabled=true; this.value='Sending…';" > Stop </button></center></td>
			<td><center><button class="Sub_end_Chk btn btn-primary" onClick="this.disabled=true; this.value='Sending…';"> End </button></center></td></tr>
		<?php 	}elseif($Work_Status_log == "Stop"){ ?>
			<tr><td><center><button class="Sub_start_Chk btn btn-primary" onClick="this.disabled=true; this.value='Sending…';"> Start </button></center></td>
			<td><center><button class="Sub_stop_Chk btn btn-primary" Disabled> Stop </button></center></td>
			<td><center><button class="Sub_end_Chk btn btn-primary" Disabled> End </button></center></td></tr>
		<?php 
		} 
		}else{ ?>
			<tr>
			<td><center><button class="Sub_start_Chk btn btn-primary" onClick="this.disabled=true; this.value='Sending…';"> Start </button></center></td>
			<td><center><button class="Sub_stop_Chk btn btn-primary" Disabled> Stop </button></center></td>
			<td><center><button class="Sub_end_Chk btn btn-primary" Disabled> End </button></center></td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="3"><center>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> Log History </button></center>
		<!-- The Modal -->
	<div class="modal" id="myModal1">
		<div class="modal-dialog">
		<div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Time Log History</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th> Start Time </th>	
				<th> End Time </th>	
				<th> Total hrs </th>	
			</tr>
		</thead>
		<tbody>
		<?php 
			$qurydelct="SELECT f.Start_Time,f.End_Time,TIMEDIFF(f.End_Time, f.Start_Time) As timedifferent from tbl_call_register_log f LEFT JOIN tbl_employee e ON f.Emp_Id=e.Id  where f.Status='Active' AND f.Call_No='$enq_no' ORDER BY f.Id Asc";
			$qury_det=mysqli_query($con,$qurydelct);
			$times = array();

			while($fetch_det=mysqli_fetch_array($qury_det))
			{		
				$date1 = $fetch_det['Start_Time'];
				$date2 = $fetch_det['End_Time'];
				$timedifferent = $fetch_det['timedifferent'];
		?>
			<tr>                      
				<td><?php echo $date1; ?></td>
				<td><?php if($date2 != "0000-00-00 00:00:00" ){ echo $date2; }?></td>
				<td><?php if($date2 != "0000-00-00 00:00:00"){ $times[] = $timedifferent; echo $timedifferent; }
				 ?></td>
			</tr>
			<?php $j++;	} ?>
			<tr>                      
				<td></td>
				<td><b>Total Worked Hours </b></td>
				<td><?php echo AddPlayTime($times);
				
				function AddPlayTime($times) {
					$minutes = 0; //declare minutes either it gives Notice: Undefined variable
					// loop throught all the times
					foreach ($times as $time) {
						list($hour, $minute) = explode(':', $time);
						$minutes += $hour * 60;
						$minutes += $minute;
					}
				
					$hours = floor($minutes / 60);
					$minutes -= $hours * 60;
				
					// returns the time already formatted
					return sprintf('%02d hours, %02d Minutes ', $hours, $minutes);
				}
				
				?></td>
			</tr>
		</tbody>
		</table>
	</div>
	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	</div>
	</div>
	</div>
	</div>
			
			
			</td>
		</tr>
	</table>
</div>
</div>
</div>
<div class="row">
</br></br>
    <div class="col-sm-12">                        
        <div class="col-sm-6">
            <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Update</button>
        </div>
        <div class="col-sm-6">				
            <button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
        </div>			  
    </div>
	</div>
  </form>
</div>	
</div>
</div>
</div>
<?php include 'footer.php'; ?>
<div class="control-sidebar-bg"></div>
</div>

<script type="text/javascript">
// For Subcriber
	$(".Sub_start_Chk").click(function () {
		var sub_add = "Start";
		var call_no = $("#call_no").val();
			$.ajax
			({
				type: "POST",
				url: "ajax_sms_update_block.php",
				data:'sub_add='+sub_add+'&call_no='+call_no,
				success: function (data) {
					alert("Your time has been Started Successfully");
				}
			});
	});
	$(".Sub_stop_Chk").click(function () {
		var sub_stop = "Stop";
		var call_no = $("#call_no").val();
			$.ajax
			({
				type: "POST",
				url: "ajax_sms_update_block.php",
				data:'sub_stop='+sub_stop+'&call_no='+call_no,
				success: function () {
					alert("Your time has been Hold Successfully");
            }
			});
	});
	$(".Sub_end_Chk").click(function () {
		var sub_end = "End";
		var call_no = $("#call_no").val();
			$.ajax
			({
				type: "POST",
				url: "ajax_sms_update_block.php",
				data:'sub_end='+sub_end+'&call_no='+call_no,
				success: function (data) {
					alert("Job has been Completed Successfully");
				}
			});
	});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
</body>
</html>
<?php mysqli_close($con); ?>

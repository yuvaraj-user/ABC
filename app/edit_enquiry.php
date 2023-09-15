<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);
$Emp_tbl_Id=$fetchlevel['Emp_tbl_Id'];
$id = $_REQUEST['id'];
$enq_no = $_REQUEST['id'];

if(isset($_REQUEST['submit']))
{
	$customer       = $_REQUEST['customer'];
	$enq_date       = strtotime($_REQUEST['enq_date']);
	$enq_dates      = date('Y-m-d',$enq_date);
	$load_amt       = $_REQUEST['load_amt'];
	$frieght_amt    = $_REQUEST['frieght_amt'];
	// $createdby      = $_REQUEST['created_by'];
	$net_total      = $_REQUEST['net_total'];
	$total          = $_REQUEST['total'];
	$remarks      = $_REQUEST['remarks'];
	$trans_to	    = $_REQUEST['trans_to'];
	if($trans_to ==''){
		$follow_by      = $_REQUEST['follow_by'];
	}else{
		$follow_by	    = $_REQUEST['trans_to'];
		
	}
	$nxt_f_date     = $_REQUEST['nxt_f_date'];
	$nxt_t_date     = $_REQUEST['nxt_t_date'];
	$follow_status  = $_REQUEST['follow_status'];
	$status         = "Active";
	$createdon      = date("d-m-Y H:i:s A");
	$Updated_On      = date("Y-m-d H:i:s");
	$createdby=$_SESSION['usersessionid'];
	
	$product_s  = array();
	$quantity_s = array();
	$rate_s     = array();
	$amount_s   = array();
	$dis_amt_s  = array();
	$cgst_s     = array();
	$sgst_s     = array();
	$igst_s     = array();
	$netamount_s= array();
	
	$product_s   = $_REQUEST['product_s'];
	$quantity_s  = $_REQUEST['quantity_s'];
	$rate_s      = $_REQUEST['rate_s'];
	$amount_s    = $_REQUEST['amount_s'];
	$dis_amt_s   = $_REQUEST['dis_amt_s'];
	$cgst_s      = $_REQUEST['cgst_s'];
	$sgst_s      = $_REQUEST['sgst_s'];
	$igst_s      = $_REQUEST['igst_s'];
	$netamount_s = $_REQUEST['netamount_s'];
	$selectlevel = mysqli_query($con,"SELECT Count(Id) As count_ids from tbl_equiry Where Status='Active' And Enquiry_No='$enq_no'");
	$fetchlevel = mysqli_fetch_array($selectlevel);
	$count_ids = $fetchlevel['count_ids'];
	$total_item_count = 0;
	for($i=1;$i<=$count_ids;$i++)
	{  
		 $e_ids 	= "e_id".$i."";   $enq_p_id	=	$_POST[$e_ids];
		 $itt 		= "item".$i."";   $name1	=	$_POST[$itt];
	if($name1 != NULL) {
			$qtt  = "quty".$i."";     $quantity=$_POST[$qtt];
			$ratt = "sell".$i."";	  $rate=$_POST[$ratt];
			$amt  = "amt".$i."";      $amt=$_POST[$amt];
			$diss = "diss".$i."";     $diss=$_POST[$diss];
			$cgtt = "cgst".$i."";	  $cgst1=$_POST[$cgtt];
			$sgtt = "sgst".$i."";	  $sgst1=$_POST[$sgtt];
			$igtt = "igst".$i."";	 $igst1=$_POST[$igtt];
			$tyyt = "n_amt".$i."";   $total_net=$_POST[$tyyt];
			$query_update_enable="UPDATE `tbl_equiry` set Customer_Id='$customer',Enquiry_No='$enq_no',Date='$enq_dates',Product_Id='$name1',Quantity='$quantity',Rate='$rate',Amount='$amt',Cgst='$cgst1',Sgst='$sgst1',Igst='$igst1',Net_Amount='$total_net',Total='$total',Discount_amt='$dis_amt_sd',load_unload_amt='$load_amt',Frieght_Amt='$frieght_amt',Net_Total='$net_total',Updated_By='$createdby',Updated_On='$Updated_On',Nxt_Follow_Date='$nxt_f_date',Nxt_Follow_Time='$nxt_t_date',Follow_By='$follow_by',Follow_Status='$follow_status' WHERE Id='$enq_p_id' And Status='Active'";
			$passquery_update_enable=mysqli_query($con,$query_update_enable);
		}
		$total_item_count++;	
	}

	for($i=0;$i<sizeof($product_s);$i++){
		$product_sd 	= $product_s[$i];
		$quantity_sd 	= $quantity_s[$i];
		$rate_sd 		= $rate_s[$i];
		$amount_sd 	= $amount_s[$i];
		$dis_amt_sd = $dis_amt_s[$i];
		$cgst_sd = $cgst_s[$i];
		$sgst_sd = $sgst_s[$i];
		$igst_sd = $igst_s[$i];
		$netamount_sd = $netamount_s[$i];
		if($netamount_sd !=0) {
			$insert_details = mysqli_query($con,"INSERT INTO `tbl_equiry`(`Customer_Id`,`Enquiry_No`, `Date`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount_amt`, `load_unload_amt`, `Frieght_Amt`,`Net_Total`, `Created_By`, `Status`,`Follow_By`,`count1`,`Nxt_Follow_Date`,`Nxt_Follow_Time`,`Follow_Status`) VALUES ('$customer','$enq_no','$enq_dates','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','$igst_sd','$netamount_sd','$total','$dis_amt_sd','$load_amt','$frieght_amt','$net_total','$createdby','$status','$follow_by','$total_item_count','$nxt_f_date','$nxt_t_date','$follow_status')");
		}
		$total_item_count++;
	}
	$follow_inste = mysqli_query($con,"INSERT INTO `tbl_followup`(`Follow_type`,`link_Id`, `Remark`, `Follow_date`,`Follow_time`, `Follow_by`, `Created_By`) VALUES ('Enquiry','$enq_no','$remarks','$nxt_f_date','$nxt_t_date','$follow_by','$createdby')");

	if((($insert_details) || ($passquery_update_enable)) && ($follow_inste)) {
		echo '<script type="text/javascript">
			window.location.replace("view_enquiry.php?step=suces");
			</script>';
		}else{
		 echo '<script type="text/javascript">
					window.location.replace("view_enquiry.php?step=fail");
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
		<div class="col-lg-8 col-md-8"><b>Enquiry Follow</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_enquiry.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Enquiry</a>
				</div>
			</div>
	</div>
</div>
</div>
<?php 
    $select_edit_enq=mysqli_query($con,"select eq.Customer_Id,eq.Date,eq.Follow_By,c.Address_Line1,c.Address_Line2,c.Address_Line3,c.Address_Line4 from tbl_equiry eq Left join tbl_customer c ON eq.Customer_Id=c.Id  WHERE eq.Status='Active' And eq.Enquiry_No='$id'");
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
		<label for="inputName" class="col-sm-4 control-label">Enquiry No</label>
			<div class="col-sm-8">
				<input type="text"  class="form-control"  value="<?php echo $enq_no; ?>" name="enq_no" id="enq_no" readonly>
			</div>
		</div>
		</div>
	<div class="row">
		<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Customer</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select name="customer" id="customer"  class="form-control selectpicker" onchange="get_cust_detail(this.value);" data-live-search="true" required >
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
		<label for="inputName" class="col-sm-4 control-label">Enquiry Date</label>
		<div class="col-sm-8">
			<input class="form-control dp"  value="<?php echo $date; ?>" name="enq_date" id="acctopendate" required readonly>
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
	<div class="row">    
	<div class="form-group col-sm-4">
		<label for="inputName" class="col-sm-4 control-label" >Product</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
			<select class="form-control selectpicker" name="product" id="product" data-live-search="true" onchange="get_available_quantity(this.value);">
			<option value="">Select Product</option>
			<?php 
			$select_GrpQry=mysqli_query($con,"select t.Id as tid,t.Name,t.Cgst,t.Sgst,t.Igst from tbl_purchase p left join tbl_product t on t.Id=p.Product_Id WHERE p.Status='Active'");
			while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
			{
				$Name=$fetch_GrpQry['Name'];
				$tid=$fetch_GrpQry['tid'];
				$Cgst=$fetch_GrpQry['Cgst'];
				$Sgst=$fetch_GrpQry['Sgst'];
				$Igst=$fetch_GrpQry['Igst'];
			?>
			<option value="<?php echo $tid."/".$Cgst."/".$Sgst."/".$Igst."/".$Name; ?>"><?php echo $Name; ?></option>
		<?php 
			}
			?>
			</select>
			</div>
		</div> 
		<div class="form-group col-sm-3">
			<label for="inputName" class="col-sm-4 control-label">Quantity</label>
			<div class="col-sm-8" style="margin-left: 0px;">
				<input type="text" maxlength="15" id="quantity" onKeyUp="avail_check(this.value);" class="form-control limited" maxlength="15" name="quantity">
			</div>
		</div>
			<div id="product_id"> </div>
		</div>
			<script>
			function addrow()
			{
				var quantity = document.getElementById("quantity").value;
				var product = document.getElementById("product").value;
				var product_1 = product.split("/");
				var cgst = parseFloat(product_1[1]);
				var sgst = parseFloat(product_1[2]);
				var igst = parseFloat(product_1[3]);
				var rate = parseFloat(document.getElementById("rate").value);
				var dis_amt = parseFloat(document.getElementById("dis_amt").value);
				var amount  = quantity * rate;
				var gst_amt = (rate * (cgst / 100));
				var total_amt = quantity * gst_amt;
				var cgst = total_amt;
				var sgst = total_amt;
				var igst = cgst + sgst;
				var net_amount = amount + cgst + sgst - dis_amt;
				var table = document.getElementById("mytable");
				var row = table.insertRow(1);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				var cell7 = row.insertCell(6);
				var cell8 = row.insertCell(7);
				var cell9 = row.insertCell(8);
				cell1.innerHTML = product_1[4];
				cell2.innerHTML = quantity;
				cell3.innerHTML = rate;
				cell4.innerHTML = amount;
				cell5.innerHTML = dis_amt;
				cell6.innerHTML = cgst;
				cell7.innerHTML = sgst;
				cell8.innerHTML = igst;
				cell9.innerHTML = net_amount;
								
				var i_value = document.getElementById("i_value").value;
				
				if(i_value =='') {
					i_value = 1;
				} else {
					i_value = parseFloat(i_value)+1;
				}
				$("#i_value").val(i_value);
				
				if(i_value ==1) {
					$("#product_1").val(product_1[0]);
					$("#quantity_1").val(quantity);
					$("#rate_1").val(rate);
					$("#amount_1").val(amount);
					$("#cgst_1").val(cgst);
					$("#sgst_1").val(sgst);
					$("#igst_1").val(igst);
					$("#netamount_1").val(net_amount);
					$("#dis_amt_1").val(dis_amt);
				} else if(i_value ==2) {
					$("#product_2").val(product_1[0]);
					$("#quantity_2").val(quantity);
					$("#rate_2").val(rate);
					$("#amount_2").val(amount);
					$("#cgst_2").val(cgst);	
					$("#sgst_2").val(sgst);
					$("#igst_2").val(igst);
					$("#netamount_2").val(net_amount);
					$("#dis_amt_2").val(dis_amt);
				} else if(i_value ==3) {
					$("#product_3").val(product_1[0]);
					$("#quantity_3").val(quantity);
					$("#rate_3").val(rate);
					$("#amount_3").val(amount);
					$("#cgst_3").val(cgst);	
					$("#sgst_3").val(sgst);
					$("#igst_3").val(igst);
					$("#netamount_3").val(net_amount);
					$("#dis_amt_3").val(dis_amt);
				} else if(i_value ==4) {
					$("#product_4").val(product_1[0]);
					$("#quantity_4").val(quantity);
					$("#rate_4").val(rate);
					$("#amount_4").val(amount);
					$("#cgst_4").val(cgst);	
					$("#sgst_4").val(sgst);
					$("#igst_4").val(igst);
					$("#netamount_4").val(net_amount);
					$("#dis_amt_4").val(dis_amt);
				} else if(i_value ==5) {
					$("#product_5").val(product_1[0]);
					$("#quantity_5").val(quantity);
					$("#rate_5").val(rate);
					$("#amount_5").val(amount);
					$("#cgst_5").val(cgst);	
					$("#sgst_5").val(sgst);
					$("#igst_5").val(igst);
					$("#netamount_5").val(net_amount);
					$("#dis_amt_5").val(dis_amt);	
				} else if(i_value ==6) {
					$("#product_6").val(product_1[0]);
					$("#quantity_6").val(quantity);
					$("#rate_6").val(rate);
					$("#amount_6").val(amount);
					$("#cgst_6").val(cgst);	
					$("#sgst_6").val(sgst);
					$("#igst_6").val(igst);
					$("#netamount_6").val(net_amount);
					$("#dis_amt_6").val(dis_amt);
				} else if(i_value ==7) {
					$("#product_7").val(product_1[0]);
					$("#quantity_7").val(quantity);
					$("#rate_7").val(rate);
					$("#amount_7").val(amount);
					$("#cgst_7").val(cgst);	
					$("#sgst_7").val(sgst);
					$("#igst_7").val(igst);
					$("#netamount_7").val(net_amount);
					$("#dis_amt_7").val(dis_amt);
				} else if(i_value ==8) {
					$("#product_8").val(product_1[0]);
					$("#quantity_8").val(quantity);
					$("#rate_8").val(rate);
					$("#amount_8").val(amount);
					$("#cgst_8").val(cgst);	
					$("#sgst_8").val(sgst);
					$("#igst_8").val(igst);
					$("#netamount_8").val(net_amount);
					$("#dis_amt_8").val(dis_amt);
				} else if(i_value ==9) {
					$("#product_9").val(product_1[0]);
					$("#quantity_9").val(quantity);
					$("#rate_9").val(rate);
					$("#amount_9").val(amount);
					$("#cgst_9").val(cgst);	
					$("#sgst_9").val(sgst);
					$("#igst_9").val(igst);
					$("#netamount_9").val(net_amount);
					$("#dis_amt_9").val(dis_amt);
				} else if(i_value ==10) {
					$("#product_10").val(product_1[0]);
					$("#quantity_10").val(quantity);
					$("#rate_10").val(rate);
					$("#amount_10").val(amount);
					$("#cgst_10").val(cgst);	
					$("#sgst_10").val(sgst);
					$("#igst_10").val(igst);
					$("#netamount_10").val(net_amount);
					$("#dis_amt_10").val(dis_amt);
				} else if(i_value ==11) {
					$("#product_11").val(product_1[0]);
					$("#quantity_11").val(quantity);
					$("#rate_11").val(rate);
					$("#amount_11").val(amount);
					$("#cgst_11").val(cgst);	
					$("#sgst_11").val(sgst);
					$("#igst_11").val(igst);
					$("#netamount_11").val(net_amount);
					$("#dis_amt_11").val(dis_amt);
				} else {
					
				}
				
				var total =  document.getElementById("total").value;
				if(total <=0) {
					total_1 =0;
				} else {
					total_1 = total
				}
				var total_value = parseFloat(total_1) + parseFloat(net_amount);
				$("#total").val(total_value);
				var load_amt	 = document.getElementById("load_amt").value;
				var frieght_amt  = document.getElementById("frieght_amt").value;
				if(load_amt > 0)
				{
					load_amt_1 = 0;
				} else {
					load_amt_1 = load_amt;
				}
				var net_total_value_1 = parseFloat(total_value) - parseFloat(load_amt_1) + parseFloat(frieght_amt);
				$("#net_total").val(net_total_value_1);
			}
	</script>
<script type="text/javascript">
function get_details_product1(val){
	var pro_details = val.split("/");
	var sel_id = 1;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id1").html(data); 
			}
		});
		$("#quty1").val('');
		$("#amt1").val('0');
		$("#diss1").val('0');
		$("#cgst1").val('0');
		$("#sgst1").val('0');
		$("#igst1").val('0');
		$("#n_amt1").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty1(val){
	var quty = val;
	var sell1 = document.getElementById("sell1").value;
	var item1 = document.getElementById("item1").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt1").val(amount);
	$("#cgst1").val(total_amt);
	$("#sgst1").val(total_amt);
	$("#igst1").val(igst);
	$("#n_amt1").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc1(val){
	var tot_amt 	= document.getElementById("amt1").value;
	var igst_tot 	= document.getElementById("igst1").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt1").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
//////////////

function get_details_product2(val){
	var pro_details = val.split("/");
	var sel_id = 2;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id2").html(data); 
			}
		});
		$("#quty2").val('');
		$("#amt2").val('0');
		$("#diss2").val('0');
		$("#cgst2").val('0');
		$("#sgst2").val('0');
		$("#igst2").val('0');
		$("#n_amt2").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty2(val){
	var quty = val;
	var sell1 = document.getElementById("sell2").value;
	var item1 = document.getElementById("item2").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt2").val(amount);
	$("#cgst2").val(total_amt);
	$("#sgst2").val(total_amt);
	$("#igst2").val(igst);
	$("#n_amt2").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc2(val){
	var tot_amt 	= document.getElementById("amt2").value;
	var igst_tot 	= document.getElementById("igst2").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt2").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
/////////////////

function get_details_product3(val){
	var pro_details = val.split("/");
	var sel_id = 3;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id3").html(data); 
			}
		});
		$("#quty3").val('');
		$("#amt3").val('0');
		$("#diss3").val('0');
		$("#cgst3").val('0');
		$("#sgst3").val('0');
		$("#igst3").val('0');
		$("#n_amt3").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty3(val){
	var quty = val;
	var sell1 = document.getElementById("sell3").value;
	var item1 = document.getElementById("item3").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt3").val(amount);
	$("#cgst3").val(total_amt);
	$("#sgst3").val(total_amt);
	$("#igst3").val(igst);
	$("#n_amt3").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc3(val){
	var tot_amt 	= document.getElementById("amt3").value;
	var igst_tot 	= document.getElementById("igst3").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt3").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}

//////////////////////

function get_details_product4(val){
	var pro_details = val.split("/");
	var sel_id = 4;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id4").html(data); 
			}
		});
		$("#quty4").val('');
		$("#amt4").val('0');
		$("#diss4").val('0');
		$("#cgst4").val('0');
		$("#sgst4").val('0');
		$("#igst4").val('0');
		$("#n_amt4").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty4(val){
	var quty = val;
	var sell1 = document.getElementById("sell4").value;
	var item1 = document.getElementById("item4").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt4").val(amount);
	$("#cgst4").val(total_amt);
	$("#sgst4").val(total_amt);
	$("#igst4").val(igst);
	$("#n_amt4").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc4(val){
	var tot_amt 	= document.getElementById("amt4").value;
	var igst_tot 	= document.getElementById("igst4").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt4").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
//////////////////

function get_details_product5(val){
	var pro_details = val.split("/");
	var sel_id = 5;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id5").html(data); 
			}
		});
		$("#quty5").val('');
		$("#amt5").val('0');
		$("#diss5").val('0');
		$("#cgst5").val('0');
		$("#sgst5").val('0');
		$("#igst5").val('0');
		$("#n_amt5").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty5(val){
	var quty = val;
	var sell1 = document.getElementById("sell5").value;
	var item1 = document.getElementById("item5").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt5").val(amount);
	$("#cgst5").val(total_amt);
	$("#sgst5").val(total_amt);
	$("#igst5").val(igst);
	$("#n_amt5").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc5(val){
	var tot_amt 	= document.getElementById("amt5").value;
	var igst_tot 	= document.getElementById("igst5").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt5").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
//////////////////

function get_details_product6(val){
	var pro_details = val.split("/");
	var sel_id = 6;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id4").html(data); 
			}
		});
		$("#quty6").val('');
		$("#amt6").val('0');
		$("#diss6").val('0');
		$("#cgst6").val('0');
		$("#sgst6").val('0');
		$("#igst6").val('0');
		$("#n_amt6").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty6(val){
	var quty = val;
	var sell1 = document.getElementById("sell6").value;
	var item1 = document.getElementById("item6").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt6").val(amount);
	$("#cgst6").val(total_amt);
	$("#sgst6").val(total_amt);
	$("#igst6").val(igst);
	$("#n_amt6").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc6(val){
	var tot_amt 	= document.getElementById("amt6").value;
	var igst_tot 	= document.getElementById("igst6").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt6").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
//////////////////

function get_details_product7(val){
	var pro_details = val.split("/");
	var sel_id = 7;
	var pro_id = parseFloat(pro_details[0]);
		$.ajax 
		({  
			type: "POST",
			url: "get_edit_price_details.php",
			data:'pro_id='+pro_id+'&sel='+sel_id,			 
			success: function(data){
				$("#pro_id4").html(data); 
			}
		});
		$("#quty7").val('');
		$("#amt7").val('0');
		$("#diss7").val('0');
		$("#cgst7").val('0');
		$("#sgst7").val('0');
		$("#igst7").val('0');
		$("#n_amt7").val('0');
	////
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
} 
function get_quty7(val){
	var quty = val;
	var sell1 = document.getElementById("sell7").value;
	var item1 = document.getElementById("item7").value;
	var item_det1 = item1.split("/");
	var pro_id = parseFloat(item_det1[0]);
	var cgst = parseFloat(item_det1[1]);
	var sgst = parseFloat(item_det1[2]);
	var igst = parseFloat(item_det1[3]);
	var amount = quty * sell1;
	
	var gst_amt = (sell1 * (cgst / 100));
	var total_amt = quty * gst_amt;
	var igst = total_amt + total_amt;
	var n_amt = amount + igst;
	$("#amt7").val(amount);
	$("#cgst7").val(total_amt);
	$("#sgst7").val(total_amt);
	$("#igst7").val(igst);
	$("#n_amt7").val(n_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
function get_disc7(val){
	var tot_amt 	= document.getElementById("amt7").value;
	var igst_tot 	= document.getElementById("igst7").value;
	var net_amt = parseFloat(tot_amt) + parseFloat(igst_tot) - parseFloat(val);
	$("#n_amt7").val(net_amt);
	var sum = 0;	
	$(".receiveamt").each(function(){
        sum += +$(this).val();
		$(".tamt").val(sum);
    });
	get_loading();
}
//////////////////

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
        $sql = mysqli_query($con,"select Id,load_unload_amt,Frieght_Amt,Total,Net_Total from tbl_equiry where Enquiry_No='$enq_no' And Status='Active'");
        $ng 	= mysqli_num_rows($sql);
		$row 	= mysqli_fetch_array($sql);	
		$load_unload = $row['load_unload_amt'];
		$Frieght_Amt = $row['Frieght_Amt'];
		$Total 		= $row['Total'];
		$Net_Total 	= $row['Net_Total'];
        $nng 		= $ng;
    ?>
    <table id="mytable" border="1">
        <tr>
            <th style="width:205px" >Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Dis.Amt</th>
            <th>CGST Amt</th>
            <th>SGST Amt</th>
            <th>IGST Amt</th>
            <th>Net Amount</th>
        </tr>
        <?php   
			$d = 1; $gg = 0; $d1 = 100 - $nng; while($d<=$nng){
			$sql2 = mysqli_query($con,"SELECT e.Id As enq_id,e.Product_Id As stock_name,e.Quantity,e.Rate,e.Amount,e.Discount_amt,e.Cgst,e.Sgst,e.Igst,e.Net_Amount from tbl_equiry e left join tbl_product p ON e.Product_Id=p.Id where e.Enquiry_No='$enq_no' AND e.count1='$gg' And e.Status='Active'");
			$row2 = mysqli_fetch_array($sql2); 	
		?>
        <tr>
        <td>
			<input type="hidden" name="e_id<?php echo $d; ?>" value="<?php echo $row2['enq_id']; ?>" id="e_id<?php echo $d; ?>" readonly/>
			<select class="form-control selectpicker" name="item<?php echo $d; ?>" id="item<?php echo $d; ?>" data-live-search="true" style="width:150px" onchange="get_details_product<?php echo $d; ?>(this.value);" required>
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
            <td><input type="text" name="quty<?php echo $d; ?>" value="<?php echo $row2['Quantity']; ?>"  id="quty<?php echo $d; ?>"  class="round default-width-input" style="width: 60px" onkeyup="get_quty<?php echo $d; ?>(this.value);"/></td>
            <td>
			<div id="pro_id<?php echo $d; ?>">
				<input type="text" name="sell<?php echo $d; ?>" value="<?php echo $row2['Rate']; ?>"  id="sell<?php echo $d; ?>" class="round default-width-input " style="width: 80px" readonly/>
			</div>
			</td>
            <td><input type="text" name="amt<?php echo $d; ?>" value="<?php echo $row2['Amount']; ?>"  id="amt<?php echo $d; ?>"  class="round default-width-input " style="width: 100px" readonly/></td>
            <td><input type="text" name="diss<?php echo $d; ?>" value="<?php echo $row2['Discount_amt']; ?>" id="diss<?php echo $d; ?>" class="round default-width-input " style="width: 90px" onkeyup="get_disc<?php echo $d; ?>(this.value);" /></td>
            <td><input type="text" name="cgst<?php echo $d; ?>" value="<?php echo $row2['Cgst']; ?>"  id="cgst<?php echo $d; ?>" class="round default-width-input " style="width: 90px" readonly/></td>
            <td><input type="text" name="sgst<?php echo $d; ?>" value="<?php echo $row2['Sgst']; ?>"  id="sgst<?php echo $d; ?>" class="round default-width-input " style="width: 90px" readonly/></td>
            <td><input type="text" name="igst<?php echo $d; ?>" value="<?php echo $row2['Igst']; ?>"  id="igst<?php echo $d; ?>" class="round default-width-input " style="width: 90px" readonly/></td>
            <td><input type="text" name="n_amt<?php echo $d; ?>" value="<?php echo $row2['Net_Amount']; ?>" id="n_amt<?php echo $d; ?>" 
			class="receiveamt" style="width: 100px" readonly/></td>
        </tr>    
        <?php $gg++; $d++; } $d = $nng + 1; while($d<100){ ?>
        <?php $d++; } ?>
        <tr>
          <th colspan="8" class="text-right">Total</th>
          <th><input type="text" id="total" class="tamt" style="width: 100px" name="total" value="<?php echo $Total; ?>" readonly></th>
        </tr>
		<script>

		</script>
		<tr>
          <th colspan="8" class="text-right">Loading / Unloading Charges</th>
          <th><input type="text" id="load_amt" style="width: 100px" onkeyup="get_loading();" name="load_amt" value="<?php echo $load_unload; ?>"></th>
        </tr>
		<tr>
          <th colspan="8" class="text-right">Frieght</th>
          <th><input type="text" id="frieght_amt" style="width: 100px" onkeyup="get_loading();" name="frieght_amt" value="<?php echo $Frieght_Amt; ?>"></th>
        </tr>
		<tr>
          <th colspan="8" class="text-right">Net Total</th>
          <th><input type="text" id="net_total" style="width: 100px" name="net_total" value="<?php echo $Net_Total; ?>" readonly></th>
        </tr>
		
    </table>
	<div id="prod_id"> </div>

	<input type="hidden" id="i_value">
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_1">
	<input type="hidden" name="quantity_s[]" id="quantity_1">
	<input type="hidden" name="rate_s[]" id="rate_1">
	<input type="hidden" name="amount_s[]" id="amount_1">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_1">
	<input type="hidden" name="cgst_s[]" id="cgst_1">
	<input type="hidden" name="sgst_s[]" id="sgst_1">
	<input type="hidden" name="igst_s[]" id="igst_1">
	<input type="hidden" name="netamount_s[]" id="netamount_1">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_2">
	<input type="hidden" name="quantity_s[]" id="quantity_2">
	<input type="hidden" name="rate_s[]" id="rate_2">
	<input type="hidden" name="amount_s[]" id="amount_2">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_2">
	<input type="hidden" name="cgst_s[]" id="cgst_2">
	<input type="hidden" name="sgst_s[]" id="sgst_2">
	<input type="hidden" name="igst_s[]" id="igst_2">
	<input type="hidden" name="netamount_s[]" id="netamount_2">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_3">
	<input type="hidden" name="quantity_s[]" id="quantity_3">
	<input type="hidden" name="rate_s[]" id="rate_3">
	<input type="hidden" name="amount_s[]" id="amount_3">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_3">
	<input type="hidden" name="cgst_s[]" id="cgst_3">
	<input type="hidden" name="sgst_s[]" id="sgst_3">
	<input type="hidden" name="igst_s[]" id="igst_3">
	<input type="hidden" name="netamount_s[]" id="netamount_3">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_4">
	<input type="hidden" name="quantity_s[]" id="quantity_4">
	<input type="hidden" name="rate_s[]" id="rate_4">
	<input type="hidden" name="amount_s[]" id="amount_4">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_4">
	<input type="hidden" name="cgst_s[]" id="cgst_4">
	<input type="hidden" name="sgst_s[]" id="sgst_4">
	<input type="hidden" name="igst_s[]" id="igst_4">
	<input type="hidden" name="netamount_s[]" id="netamount_4">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_5">
	<input type="hidden" name="quantity_s[]" id="quantity_5">
	<input type="hidden" name="rate_s[]" id="rate_5">
	<input type="hidden" name="amount_s[]" id="amount_5">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_5">
	<input type="hidden" name="cgst_s[]" id="cgst_5">
	<input type="hidden" name="sgst_s[]" id="sgst_5">
	<input type="hidden" name="igst_s[]" id="igst_5">
	<input type="hidden" name="netamount_s[]" id="netamount_5">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_6">
	<input type="hidden" name="quantity_s[]" id="quantity_6">
	<input type="hidden" name="rate_s[]" id="rate_6">
	<input type="hidden" name="amount_s[]" id="amount_6">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_6">
	<input type="hidden" name="cgst_s[]" id="cgst_6">
	<input type="hidden" name="sgst_s[]" id="sgst_6">
	<input type="hidden" name="igst_s[]" id="igst_6">
	<input type="hidden" name="netamount_s[]" id="netamount_6">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_7">
	<input type="hidden" name="quantity_s[]" id="quantity_7">
	<input type="hidden" name="rate_s[]" id="rate_7">
	<input type="hidden" name="amount_s[]" id="amount_7">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_7">
	<input type="hidden" name="cgst_s[]" id="cgst_7">
	<input type="hidden" name="sgst_s[]" id="sgst_7">
	<input type="hidden" name="igst_s[]" id="igst_7">
	<input type="hidden" name="netamount_s[]" id="netamount_7">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_8">
	<input type="hidden" name="quantity_s[]" id="quantity_8">
	<input type="hidden" name="rate_s[]" id="rate_8">
	<input type="hidden" name="amount_s[]" id="amount_8">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_8">
	<input type="hidden" name="cgst_s[]" id="cgst_8">
	<input type="hidden" name="sgst_s[]" id="sgst_8">
	<input type="hidden" name="igst_s[]" id="igst_8">
	<input type="hidden" name="netamount_s[]" id="netamount_8">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_9">
	<input type="hidden" name="quantity_s[]" id="quantity_9">
	<input type="hidden" name="rate_s[]" id="rate_9">
	<input type="hidden" name="amount_s[]" id="amount_9">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_9">
	<input type="hidden" name="cgst_s[]" id="cgst_9">
	<input type="hidden" name="sgst_s[]" id="sgst_9">
	<input type="hidden" name="igst_s[]" id="igst_9">
	<input type="hidden" name="netamount_s[]" id="netamount_9">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_10">
	<input type="hidden" name="quantity_s[]" id="quantity_10">
	<input type="hidden" name="rate_s[]" id="rate_10">
	<input type="hidden" name="amount_s[]" id="amount_10">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_10">
	<input type="hidden" name="cgst_s[]" id="cgst_10">
	<input type="hidden" name="sgst_s[]" id="sgst_10">
	<input type="hidden" name="igst_s[]" id="igst_10">
	<input type="hidden" name="netamount_s[]" id="netamount_10">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_11">
	<input type="hidden" name="quantity_s[]" id="quantity_11">
	<input type="hidden" name="rate_s[]" id="rate_11">
	<input type="hidden" name="amount_s[]" id="amount_11">
	<input type="hidden" name="dis_amt_s[]" id="dis_amt_11">
	<input type="hidden" name="cgst_s[]" id="cgst_11">
	<input type="hidden" name="sgst_s[]" id="sgst_11">
	<input type="hidden" name="igst_s[]" id="igst_11">
	<input type="hidden" name="netamount_s[]" id="netamount_11">
	</div>
	</div>
	<div class="row">
	<div class="form-group col-sm-6">
	<label for="inputName" class="col-sm-4 control-label" >Remark</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
            <textarea name="remarks" class="form-control" id="remarks" placeholder=" Remarks" required></textarea>
		</div>
	</div>
	<div class="form-group col-sm-6">
	<label for="inputName" class="col-sm-4 control-label" >Followed By</label>
		<div class="col-sm-8" style="margin-left: 0px;">						
		<select class="form-control selectpicker none" name="follow_by" id="follow_by" data-live-search="true" readonly>
			<option value="">Select</option>
			<?php 
				$select_GrpQry=mysqli_query($con,"select t.Id as tid,t.Name from tbl_employee t WHERE t.Status='Active'");
				while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
				{
					$Name	=	$fetch_GrpQry['Name'];
					$tid	=	$fetch_GrpQry['tid'];
			?>
			<option value="<?php echo $tid; ?>" <?php if($tid == $Follow_By) echo 'selected';?>><?php echo $Name; ?></option>
		<?php 	}	?>
			</select>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="form-group col-sm-6">
        <label for="inputName" class="col-sm-4 control-label" >Next FollowUp Date</label>
            <div class="col-sm-5" style="margin-left: 0px;">						
                <input type="date" id="nxt_f_date"  class="form-control limited" required name="nxt_f_date">
            </div>
            <div class="col-sm-3" style="margin-left: 0px;">						
                <input type="time" id="nxt_t_date"  class="form-control limited" required name="nxt_t_date">
            </div>
        </div>
        <div class="form-group col-sm-6">
        <label for="inputName" class="col-sm-4 control-label" >Transfer To</label>
            <div class="col-sm-8" style="margin-left: 0px;">						
            <select class="form-control selectpicker" name="trans_to" id="trans_to" data-live-search="true">
                <option value="">Select</option>
                <?php 
                    $select_GrpQry=mysqli_query($con,"select t.Id as tid,t.Name from tbl_employee t WHERE t.Status='Active'");
                    while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
                    {
                        $Name	=	$fetch_GrpQry['Name'];
                        $tid	=	$fetch_GrpQry['tid'];
                ?>
                <option value="<?php echo $tid; ?>"><?php echo $Name; ?></option>
            <?php 	}	?>
                </select>
                </div>
            </div>
	</div>
	<div class="row">
    <div class="form-group col-sm-6">
     <label for="inputName" class="col-sm-4 control-label" ></label>
        <div class="col-sm-8" style="margin-left: 0px;">
            <button type="submit" class="btn btn-success" data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $enq_no; ?>" data-backdrop="static" data-keyboard="false">FollowUp History</button> 
			<div class="modal fade" id="myModal1<?php echo $enq_no; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content"  style="width:95%;margin-left:140px">
					<div class="modal-header custom-stripped">
						<button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
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
				    $qurydelct="SELECT f.Remark,f.Follow_date,e.Name from tbl_followup f LEFT JOIN tbl_employee e ON f.Follow_by=e.Id  where f.Status='Active' AND f.Follow_type='Enquiry' AND f.link_Id='$enq_no' ORDER BY f.Id Desc";
					$qury_det=mysqli_query($con,$qurydelct);
					while($fetch_det=mysqli_fetch_array($qury_det))
					{		
			?>
					<tr>                      
						<td><?php echo $fetch_det['Remark']; ?></td>
						<td><?php echo $fetch_det['Follow_date']; ?></td>
						<td><?php echo $fetch_det['Name']; ?></td>
					</tr>
			    <?php $j++;	} ?>
            </tbody>
            </table>
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
                <option value="Follow">Follow</option>
                <option value="Drop">Drop</option>
                <option value="Won">Won</option>
            </select>
        </div>
    </div>
</div>
    <div class="col-sm-12">                        
        <div class="col-sm-6">
            <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Update</button>
        </div>
        <div class="col-sm-6">				
            <button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
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

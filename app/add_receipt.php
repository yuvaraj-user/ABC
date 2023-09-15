<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	$customer=$_REQUEST['customer'];
	$lead_id=$_REQUEST['lead_id'];
	$Date=$_REQUEST['Date'];
	$Payment_Amount=$_REQUEST['Payment_Amount'];
	$Mode_Of_Payment=$_REQUEST['Mode_Of_Payment'];

	$cash_amount = $_REQUEST['cash_amount'];
	$card_amount = $_REQUEST['card_amount'];
	$card_no_1 = $_REQUEST['card_no_1'];
	$card_bank_name = $_REQUEST['card_bank_name'];
	$cheque_amount = $_REQUEST['cheque_amount'];
	$cheque_date = $_REQUEST['cheque_date'];
	$cheque_no = $_REQUEST['cheque_no'];
	$cheque_bank_name = $_REQUEST['cheque_bank_name'];
	$paytm_amount = $_REQUEST['paytm_amount'];
	$googlepay_amount = $_REQUEST['googlepay_amount'];
	$received_amount = $_REQUEST['received_amount'];
	$bill_value = $_REQUEST['bill_value'];
	$paid_amount = $_REQUEST['paid_amount'];
	$voucher_no = $_REQUEST['voucher_no'];
	 
	 
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	$invoice_no_purchase = array();
	$Amount = array();
	$rec_amount_1 = array();
	$payment_status = array();
	
	$invoice_no_purchase = $_REQUEST['invoice_no_purchase'];
	$Amount = $_REQUEST['Amount'];
	$rec_amount_1 = $_REQUEST['rec_amount_1'];
	$payment_status = $_REQUEST['payment_status'];
	
	for($i=0;$i<sizeof($invoice_no_purchase);$i++){
		$invoice_no_purchase_sd = $invoice_no_purchase[$i];
		$Amount = $Amount[$i];
		$rec_amount_1_sd = $rec_amount_1[$i];
		$payment_status_sd = $payment_status[$i];
        if($rec_amount_1_sd !=0) {
          
		$insert_details = mysqli_query($con, "INSERT INTO `tbl_receipts`(`Lead_Id`,`Customer_Id`, `Total_Amount`, `Payment_Mode`, `Cheque_No`, `Cheque_Date`, `Created_By`, `Created_On`, `Status`, `Date`, `Module`, `Remark`,Voucher_No) VALUES ('$lead_id','$customer','$Payment_Amount','$mode','$cheque_no','$cheque_date','$createdby','$createdon','Active','$Date','Receipt','$remark','$voucher_no')");
        
           
        }
		$update_details = mysqli_query($con,"UPDATE tbl_sales SET Payment_Pending='$payment_status_sd' WHERE Invoice_No='$invoice_no_purchase_sd' AND Status='Active'");
	}
		if($insert_details){
		
			 echo '<script type="text/javascript">
					window.location.replace("report_receipt.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("report_receipt.php?step=fail");
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
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	
	
<script>
function get_supplier(val) {
	
	var pend = $("#pend").val();
	if(parseFloat(pend) < parseFloat(val)) {
		alert("Receipt Amount is Greater than the Pending Amount");
		$("#submit").hide();
	} else {
		$("#submit").show();
	var customer_id = $("#customer").val();
	var Invoice_No = $("#Invoice_No").val();
	$.ajax 
				({  
				type: "POST",
				url: "get_receipt_customer.php",
				data:'customer_id='+customer_id+'&rec_amount='+val+'&invoice_no_cus='+Invoice_No,			 
				success: function(data){
				$("#customer_table").html(data); 
				}
				});
	}
}

function get_pending(val) {
	// alert(val);
	$.ajax 
				({  
				type: "POST",
				url: "get_receipt_customer.php",
				data:'customer_id_det='+val,			 
				success: function(data){
				$("#customer_pending").html(data); 
				}
				});
}

function get_pending_invoice(val) {
	// alert(val);
	$.ajax 
				({  
				type: "POST",
				url: "get_receipt_customer.php",
				data:'invoice_no='+val,			 
				success: function(data){
				$("#customer_pending_invoice").html(data); 
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
            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="row panel panel-primary">

<div class="panel-heading lead ">
	<div class="row">
		<div class="col-lg-8 col-md-8"><b>Add Receipt</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="report_receipt.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Receipt</a>
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                    
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
						<div class="row">
					  <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Customer Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="customer" id="customer" onchange="get_pending(this.value);" data-live-search="true"  required >
						 <option value="">Select Customer</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_customer WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Company_Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						  </div>
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

					});
					
				
					
				  </script>
					<div class="form-group col-sm-4">        
					   <label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="Date" id="acctopendate"  required>
						  </div>
					</div>
					<div id="customer_pending">	
	</div>	
					 
					   </div>
						<div style="clear:both;"></div>
						<div id="customer_pending_invoice"> </div>
	      
	<div id="customer_table">	
	</div>


	<div class="row">
	                <label for="inputName" class="col-sm-3 control-label">Payment Mode  <input type="checkbox" name="mycheckbox" value="Yes" id="mycheckbox" value="0" /></label>  
					</div>
  <div class="row" id="pay_mode_1" style="display:none">
				   <label for="inputName" class="col-sm-1 control-label"></label>  
						 <label for="inputName" class="col-sm-1 control-label">Cash</label>
						 <div class="col-sm-2">
							<input type="text" placeholder="Amount" id="cash_amount" onKeyUp="total_amount(this.value);" class="form-control limited" name="cash_amount">
						</div>
						
						
						 <label for="inputName" class="col-sm-1 control-label">Card</label>
						 <div class="col-sm-2">
							<input type="text" placeholder="Amount" id="card_amount" onKeyUp="total_amount(this.value);" class="form-control limited" name="card_amount">
						</div>
						<div class="col-sm-2">
							<input type="text" placeholder="Card No" id="card_no_1" class="form-control limited" name="card_no_1">
						</div>
						<div class="col-sm-2">
							<input type="text" placeholder="Bank Name" id="card_bank_name" class="form-control limited" name="card_bank_name">
						</div>
						</div>
						
	<div class="row" id="pay_mode_2" style="display:none">
	                 <label for="inputName" class="col-sm-1 control-label"></label>  
						 <label for="inputName" class="col-sm-1 control-label">Cheque</label>
						 <div class="col-sm-2">
							<input type="text" placeholder="Amount" id="cheque_amount" onKeyUp="total_amount(this.value);" class="form-control limited" name="cheque_amount">
						</div>
						 <div class="col-sm-2">
							<input type="text" placeholder="Cheque No" id="cheque_no"  class="form-control limited" name="cheque_no">
						</div>
						<div class="col-sm-2">
							<input type="text" placeholder="Cheque Date" id="cheque_date" class="form-control limited" name="cheque_date">
						</div>
						<div class="col-sm-2">
							<input type="text" placeholder="Bank Name" id="cheque_bank_name" class="form-control limited" name="cheque_bank_name">
						</div>
						</div>
	<div class="row" id="pay_mode_3" style="display:none">
	                 <label for="inputName" class="col-sm-1 control-label"></label>  
						 <label for="inputName" class="col-sm-1 control-label">Paytm</label>
						 <div class="col-sm-2">
							<input type="text" placeholder="Amount" id="paytm_amount" onKeyUp="total_amount(this.value);" class="form-control limited" name="paytm_amount">
						</div>
						 <label for="inputName" class="col-sm-1 control-label">GooglePay</label>
						 <div class="col-sm-2">
							<input type="text" placeholder="Amount" id="googlepay_amount" onKeyUp="total_amount(this.value);" class="form-control limited" name="googlepay_amount">
						</div>
						</div>
						<script>
		function total_amount(val)
			 {
			
                var cash_amount_1 = document.getElementById("cash_amount").value;
                var card_amount_1 = document.getElementById("card_amount").value;
                var cheque_amount_1 = document.getElementById("cheque_amount").value;
                var paytm_amount_1 = document.getElementById("paytm_amount").value;
                var googlepay_amount_1 = document.getElementById("googlepay_amount").value;
                var net_total = document.getElementById("net_total").value;
				
				
				if(cash_amount_1==''){
					var cash_amount = 0;
				} else {
					var cash_amount = parseFloat(cash_amount_1);
				}
			
				if(card_amount_1==''){
				
					var card_amount = 0;
				} else {
					var card_amount = parseFloat(card_amount_1);
				}
				
				if(cheque_amount_1==''){
					var cheque_amount = 0;
				} else {
					var cheque_amount = parseFloat(cheque_amount_1);
				}
				
				if(paytm_amount_1==''){
					var paytm_amount = 0;
				} else {
					var paytm_amount = parseFloat(paytm_amount_1);
				}
				
				if(googlepay_amount_1==''){
					var googlepay_amount = 0;
				} else {
					var googlepay_amount = parseFloat(googlepay_amount_1);
				}
				
				var total_paid_amount = cash_amount + cheque_amount + card_amount + paytm_amount + googlepay_amount;
				
				$("#received_amount").val(total_paid_amount);
				$("#bill_value").val(net_total);
				
				var balance = net_total - total_paid_amount;
				$("#balance").val(balance);
			}
		</script>
		
		<div class="row" id="pay_mode_4" style="display:none">
	                
						 <label for="inputName" class="col-sm-2 control-label">Total Received</label>
						 <div class="col-sm-2">
							<input type="text" id="received_amount" class="form-control limited" name="received_amount" readonly>
						</div>
						
						
						 <label for="inputName" class="col-sm-2 control-label">Bill Value</label>
						 <div class="col-sm-2">
							<input type="text" id="bill_value" class="form-control limited" name="bill_value" readonly>
						</div>
						 <label for="inputName" class="col-sm-2 control-label">Balance</label>
						 <div class="col-sm-2">
							<input type="text" id="balance" class="form-control limited" name="balance" readonly>
						</div>
						 <label for="inputName" class="col-sm-2 control-label">Paid Amount</label>
						 <div class="col-sm-2">
							<input type="text" id="paid_amount" class="form-control limited" name="paid_amount">
						</div>
						 <label for="inputName" class="col-sm-2 control-label">Net Value</label>
						 <div class="col-sm-2">
							<input type="text" id="net_paid" class="form-control limited" name="net_paid" readonly>
						</div>
						</div>
						<script type="text/javascript">
$('#mycheckbox').change(function() {
    $('#pay_mode_1').toggle();
    $('#pay_mode_2').toggle();
    $('#pay_mode_3').toggle();
    $('#pay_mode_4').toggle();
});
</script>
	
	<div class="col-sm-12" id="submit">                        
		  <br>
			  <div class="col-sm-6">
				<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
			  </div>
			  <div class="col-sm-6">				
				<button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
			  </div>			  
          </div>
					 </form>
				

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
document.getElementById('s_pay').addEventListener('change', function () {
    var style = this.value == 1 ? 'block' : 'none';
    document.getElementById('hidden_div').style.display = style;
});
</script>
	</div>
	
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

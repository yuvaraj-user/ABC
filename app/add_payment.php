<?php

session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $Supplier_Name=$_REQUEST['Supplier_Name'];
	 $Date=$_REQUEST['Date'];
	 $Payment_Amount=$_REQUEST['Payment_Amount'];
	 $Mode_Of_Payment=$_REQUEST['Mode_Of_Payment'];
	 $Cheque_No=$_REQUEST['Cheque_No'];
	 $Cheque_Date=$_REQUEST['Cheque_Date'];
	 $voucher_no=$_REQUEST['voucher_no'];
	 
	 
	 $bank_name=$_REQUEST['bank_name'];
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
		 $insert_details = mysqli_query($con,"INSERT INTO `tbl_payment`(`Supplier_Name`, `Date`, `Payment_Amount`,`Invoice_No_Purchase`,`Amount`,`Purchase_Wise_Amount`,`Mode_Of_Payment`,`Cheque_No`,`Cheque_Date`,`Cheque_Bank`,`Created_On`,`Created_By`,`Status`,`Voucher_No`) VALUES ('$Supplier_Name','$Date','$Payment_Amount','$invoice_no_purchase_sd','$Amount','$rec_amount_1_sd','$Mode_Of_Payment','$Cheque_No','$Cheque_Date','$bank_name','$createdon','$createdby','$status','$voucher_no')");
        
        }
		$update_details = mysqli_query($con,"UPDATE tbl_purchase SET Payment_Pending='$payment_status_sd' WHERE Invoice_No='$invoice_no_purchase_sd' AND Status='Active'");
	}
		if($insert_details){
			
			 echo '<script type="text/javascript">
					window.location.replace("report_payment.php?step=suces");
					</script>';	
		}
		else{
			 echo '<script type="text/javascript">
						window.location.replace("report_payment.php?step=fail");
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
		alert("Payment Amount is Greater than the Pending Amount");
		$("#submit").hide();
	} else {
		$("#submit").show();
	var supplier_id = $("#Supplier_Name").val();
		var invoice_no_sup = $("#invoice_no").val();
	$.ajax 
				({  
				type: "POST",
				url: "get_payment_supplier.php",
				data:'supplier_id='+supplier_id+'&rec_amount='+val+'&invoice_no_sup='+invoice_no_sup,			 
				success: function(data){
				$("#supplier_table").html(data); 
				}
				});
	}
}
function get_pending(val) {
	// alert(val);
	$.ajax 
				({  
				type: "POST",
				url: "get_payment_supplier.php",
				data:'supplier_id_det='+val,			 
				success: function(data){
				$("#supplier_pending").html(data); 
				}
				});
}
function get_pending_invoice(val) {
	// alert(val);
	$.ajax 
				({  
				type: "POST",
				url: "get_payment_supplier.php",
				data:'invoice_no='+val,			 
				success: function(data){
				$("#supplier_pending_invoice").html(data); 
				}
				});
}
</script>
</script>


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
		<div class="col-lg-8 col-md-8"><b>Add Payment</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="report_payment.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Payment</a>
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                    
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
					
					

						<div class="row">
					  <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label" >Supplier Name <font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="Supplier_Name" id="Supplier_Name" onchange="get_pending(this.value) ;" data-live-search="true"  required >
						 <option value="">Select Supplier</option>
						 
						 
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_supplier WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							echo $Invoice_No;
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
					   		
	<div id="supplier_pending">	
	</div>	
  </div>
					  	<div style="clear:both;"></div>
						<div id="supplier_pending_invoice"> </div>
					   
					   
				
				<div class="row">
			 
			  <div class="form-group col-sm-4">
				<label for="inputName" class="col-sm-4 control-label">Mode Of Payment</label>
				<select id="s_pay" name="Mode_Of_Payment" class="col-sm-8">
				   <option value="0">Cash</option>
				   <option value ="1" onClick="showDiv()">Bank</option>
				</select>
				
				</div>
				<div id="hidden_div" style="display: none;">
				<div class="form-group col-sm-4">
				<label for="inputName" class="col-sm-6 control-label">Cheque Number</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="Cheque_No">
					</div>
				</div>
				<div class="form-group col-sm-4">
				<label for="inputName" class="col-sm-6 control-label">Cheque Date</label>
				<div class="col-sm-6">
						<input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="Cheque_Date" id="acctopendate" >
					</div>
				</div>
			<div class="form-group col-sm-4">
				<label for="inputName" class="col-sm-6 control-label">Bank Name</label>
				<div class="col-sm-6">
						<input class="form-control dp" placeholder="Bank Name" name="bank_name" id="bank_name" >
					</div>
				</div>
				</div>
				</div>
				
				
				
		
	<div id="supplier_table">	
	</div>
	
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

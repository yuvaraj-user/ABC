<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $Name=$_REQUEST['Name'];
	 $Address_Line1=$_REQUEST['Address_Line1'];
	 $Address_Line2=$_REQUEST['Address_Line2'];
	 $Address_Line3=$_REQUEST['Address_Line3'];
	 $Address_Line4=$_REQUEST['Address_Line4'];
	 $State=$_REQUEST['State'];
	 $Country=$_REQUEST['Country'];
	 $Mobile_No1=$_REQUEST['Mobile_No1'];
	 $Mobile_No2=$_REQUEST['Mobile_No2'];
	 $Email_Id1=$_REQUEST['Email_Id1'];
	 $Email_Id2=$_REQUEST['Email_Id2'];
	 $LandLine_No1=$_REQUEST['LandLine_No1'];
	 $LandLine_No2=$_REQUEST['LandLine_No2'];
	 $Gst_No=$_REQUEST['Gst_No'];
	 $Gst_Type=$_REQUEST['Gst_Type'];
	 $Pan_No=$_REQUEST['Pan_No'];
	 $ref_no=$_REQUEST['ref_no'];
	 $target_no=$_REQUEST['target_no'];
	 $indent_no=$_REQUEST['indent_no'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	$customer_1 = $_REQUEST['customer'];
	$acctdate = $_REQUEST['acctdate'];
	$discount = $_REQUEST['discount'];
	$other_charge = $_REQUEST['other_charge'];
	$invoice_no = $_REQUEST['invoice_no'];
	$net_total = $_REQUEST['net_total'];
	$total = $_REQUEST['total'];
	$dc_no = $_REQUEST['dc_no'];
	 $mycheckbox = $_REQUEST['mycheckbox']; 
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
	$discount_percent = $_REQUEST['discount_percent'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	
	
	$product_s = array();
	$quantity_s = array();
$indent_no = array();
$shop = array();
	
	
	$product_s = $_REQUEST['product_s'];
	$quantity_s = $_REQUEST['quantity_s'];
	$indent_no = $_REQUEST['indent_no'];
	$shop = $_REQUEST['shop'];
	
	
	for($i=0;$i<sizeof($product_s);$i++){
		
		$product_sd = $product_s[$i];
		$quantity_sd = $quantity_s[$i];
		$indent_nos = $indent_no[$i];
		$shop_nos = $shop[$i];
	
		if($quantity_sd !=0)	{
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_sales`(`Customer_Id`, `Date`, `Invoice_No`,`Dc_No`, `Product_Id`, `Quantity`, `Created_On`, `Created_By`, `Status`,Sales_Order_No,Shop_Id) VALUES ('$customer_1','$acctdate','$invoice_no','$dc_no','$product_sd','$quantity_sd','$createdon','$createdby','$status','$indent_nos','$shop_nos')");
		
		}
	
	}
	
	if($insert_details){
	
			 echo '<script type="text/javascript">
									window.location.replace("add_sales.php?inv_no='.$invoice_no.'");
							</script>';		
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("add_sales.php?step=fail");
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
        <meta name="author" content="Manoj">
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
             $("#quantity").val('');
	            $.ajax 
				({  
				type: "POST",
				url: "get_available_quantity.php",
				data:'product_id='+product_id,			 
				success: function(data){
				$("#product_id").html(data); 
				}
				});
                } 
                
        function get_dc_details(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_indent_det.php",
				data:'customer_id='+val,			 
				success: function(data){
				$("#dc_det").html(data); 
				}
				});
                } 
				
				
			function avail_check(val) {
			   var available_qty = $("#avail_qty").val();
			   
			   if(parseFloat(val) > parseFloat(available_qty)) {
				   alert("It's greater than the available quantity");
				   $("#BTNSUBMIT").show();
			   } else {
				    $("#BTNSUBMIT").show();
			   }
             } 
             
             function addrow6_1(val) {
                
			   var available_qty = $("#quantity_6_1_6").val();
			   var quantity_6 = $("#quantity_6").val();
			  
			   if(parseFloat(quantity_6) > parseFloat(available_qty)) {
				   alert("It's greater than the available quantity");
				    $("#subid").hide();
			   } else {
				     $("#subid").show();
			   }
             } 
			 
		    function new_customer(val) {
			   
			   if(val=='new'){
				   $("#new_customer").show();
			   } else {
				    $("#new_customer").hide();
			   }
             }
             	function get_indent_order_purchase(val) {
             	   
	            $.ajax 
				({  
				type: "POST",
				url: "get_indent_det.php",
				data:'order_id='+val,			 
				success: function(data){
				$("#order_id").html(data); 
				}
				});
                } 
                
                function get_indent_sale_det(val) {
             	   
	            $.ajax 
				({  
				type: "POST",
				url: "get_indent_sale_det.php",
				data:'order_id='+val,			 
				success: function(data){
				$("#order_id").html(data); 
				}
				});
                } 
                function get_district(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_district_1.php",
				data:'group_id='+val,			 
				success: function(data){
				$("#dis_det").html(data); 
				}
				});
                } 
                
                function get_pds(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_district_1.php",
				data:'dist_id='+val,			 
				success: function(data){
				$("#pds_det").html(data); 
				}
				});
                }
                 
            function get_indent_coordi(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_indent.php",
				data:'dist_id='+val,			 
				success: function(data){
				$("#indt_det").html(data); 
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
		<div class="col-lg-8 col-md-8"><b>Sales</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                  <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
                      <div class="row">
	                 <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Coordinator<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="customer" onchange="get_indent_coordi(this.value);" id="customer" data-live-search="true" required>
						 <option value="">Select Coordinator</option>
						 
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select * from tbl_coordinator WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					 </div>
					 <div id="indt_det"></div>
			</div>
				  <div class="row">
	                  <div id="pds_det"> </div>
				<div class="form-group col-sm-4">        
                   <label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                    <div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>
			 
                      </div>
				   </div>
				   <div class="form-group col-sm-4">
						 	<?php 
						    $select_mid=mysqli_query($con,"select MAX(Id) as mid from tbl_sales_return WHERE Status='Active'");
							$fetch_mid=mysqli_fetch_array($select_mid);
							$mid=$fetch_mid['mid'];
							
							$select_inv_no=mysqli_query($con,"select Invoice_No from tbl_sales_return WHERE Id='$mid'");
							$fetch_inv_no=mysqli_fetch_array($select_inv_no);
							$inv_no=$fetch_inv_no['Invoice_No'] +1;
						 
						       if($inv_no=='1' || $inv_no=='NULL'){
						           $inv_no_1 =1;
						       } else {
						           $inv_no_1 = $inv_no;
						       }
						 ?>
						 <label for="inputName" class="col-sm-4 control-label">Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8">
							<input type="text" placeholder="Invoice No" maxlength="150" id="form-field-1" value="<?php echo $inv_no_1; ?>" class="form-control limited" maxlength="15" name="invoice_no" required>
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
                     $("#discount").val(0);
                     $("#other_charge").val(0);
					});
					
				
				  </script>
						
						</div>
						</div>
		
				<div id="dc_det">
	                 
				   
						</div>
							<div id="order_id">
						</div>
						<br><br>
				  
						 <div class="col-sm-12" id="subid">                        
		  <br>
			  <div class="col-sm-6">
				<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
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


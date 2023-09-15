<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	$supplier = $_REQUEST['supplier'];
	$acctdate = $_REQUEST['acctdate'];
	$invoice_no = $_REQUEST['invoice_no'];
	$discount = $_REQUEST['discount'];
	$other_charge = $_REQUEST['other_charge'];
	$net_total = $_REQUEST['net_total'];
	$total = $_REQUEST['total'];
	$grn_no = $_REQUEST['grn_no'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	
	$product_s = array();
	$quantity_s = array();
	$rate_s = array();
	$amount_s = array();
	$cgst_s = array();
	$sgst_s = array();
	$igst_s = array();
	$netamount_s = array();
	
	
	$product_s = $_REQUEST['product_s'];
	$quantity_s = $_REQUEST['quantity_s'];
	$rate_s = $_REQUEST['rate_s'];
	$amount_s = $_REQUEST['amount_s'];
	$cgst_s = $_REQUEST['cgst_s'];
	$sgst_s = $_REQUEST['sgst_s'];
	$igst_s = $_REQUEST['igst_s'];
	$netamount_s = $_REQUEST['netamount_s'];
	
	for($i=0;$i<sizeof($product_s);$i++){
		
		$product_sd = $product_s[$i];
		$quantity_sd = $quantity_s[$i];
		$rate_sd = $rate_s[$i];
		$amount_sd = $amount_s[$i];
		$cgst_sd = $cgst_s[$i];
		$sgst_sd = $sgst_s[$i];
		$igst_sd = $igst_s[$i];
		$netamount_sd = $netamount_s[$i];
		if($netamount_sd !=0) {
		// $insert_details = mysqli_query($con,"INSERT INTO `tbl_purchase`(`Supplier_Name`, `Date`, `Invoice_No`,`Grn_No`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount`, `Other_Charges`, `Net_Total`, `Created_On`, `Created_By`, `Status`) VALUES ('$supplier','$acctdate','$invoice_no','$grn_no','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','$igst_sd','$netamount_sd','$total','$discount','$other_charge','$net_total','$createdon','$createdby','$status')");
	}
	}
	if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_purchase.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_purchase.php?step=fail");
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
				
		function get_grn_details(val) {
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_grn_details.php",
				data:'supplier='+val,			 
				success: function(data){
				$("#grn_id").html(data); 
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
		<div class="col-lg-8 col-md-8"><b>Add Purchase</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_purchase.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Purchase</a>
				</div>
			</div>
	</div>
</div>
</div>
                    <?php
					$id=$_REQUEST['id'];
					
					$query_rec_id="select Invoice_No from tbl_purchase where Id='$id'"; 
					$query_rec_exe=mysqli_query($con,$query_rec_id);
					$fetch_rec_array=mysqli_fetch_array($query_rec_exe);	
					$Invoice_No=$fetch_rec_array['Invoice_No'];
					
                    $qury="select p.*,s.Name as supplier_name from tbl_purchase p left join tbl_supplier s on p.Supplier_Name=s.Id where p.Status='Active' AND Invoice_No='$Invoice_No'";
					$qury_exe=mysqli_query($con,$qury);
					$i=1;
					$fetch=mysqli_fetch_array($qury_exe);
				     $inv_no = $fetch['Invoice_No'];
				     $supplier_name = $fetch['supplier_name'];
				     $date = $fetch['Date'];
					 ?>
                <div class="panel-body"> 
                  <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
				  <div class="row">
	                 <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Supplier</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						<input type="text" value="<?php echo $supplier_name; ?>" id="supplier"  class="form-control limited" name="supplier" required readonly>
						 </div>
					 </div>
				<div class="form-group col-sm-4">        
                   <label for="inputName" class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo $date;?>" name="acctdate" id="acctopendate" required>
			 
                      </div>
					  
					  
						 
				   </div>
				   <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-8">
							<input type="text" id="form-field-1"  class="form-control limited" value="<?php echo $inv_no; ?>" name="invoice_no" required>
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
		
				<div id="grn_id">
						</div>
				   
						    
	<div class="col-sm-12" >	
    <table id="mytable" border="1">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>IGST</th>
            <th>Net Amount</th>
        </tr>
		<?php
		  $qurydelct="select p.*,p.Id as pid,t.Name as product_name from tbl_purchase p left join tbl_product t on p.Product_Id=t.Id where p.Status='Active' AND p.Invoice_No='$inv_no'";
		  $qury_det=mysqli_query($con,$qurydelct);
		  $j=1;
		   while($fetch_det=mysqli_fetch_array($qury_det))
			{		
				$product_name = $fetch_det['product_name'];
				$Quantity = $fetch_det['Quantity'];
				$Rate = $fetch_det['Rate'];
				$Amount = $fetch_det['Amount'];
				$Cgst = $fetch_det['Cgst'];
				$Sgst = $fetch_det['Sgst'];
				$Igst = $fetch_det['Igst'];
				$Net_Amount = $fetch_det['Net_Amount'];
				$pid = $fetch_det['pid'];
		?>
		<tr>
		
			<td>
			<?php echo $product_name; ?>
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Quantity; ?>" name="quantity_s[]" id="quantity_s">
			<input type="hidden" class="form-control" value="<?php echo $pid; ?>" name="pid" id="pid">
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Rate; ?>" onkeyup="get_rate(this.value);" name="rate_s" id="rate_s">
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Amount; ?>" name="amount_s" id="amount_s" readonly>
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Cgst; ?>" name="cgst_s" id="cgst_s" readonly>
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Sgst; ?>" name="sgst_s" id="sgst_s" readonly>
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Igst; ?>" name="igst_s" id="igst_s" readonly>
			</td>
			<td>
			<input type="text" class="form-control" value="<?php echo $Net_Amount; ?>" name="netamount_s" id="netamount_s" readonly>
			</td>
		</tr>
		<?php 
		 $j++;
			}
		?>
		<tr>
          <th colspan="7" class="text-right">Total</th>
          <th><input type="text" id="total" name="total" readonly></th>
        </tr>
		<script>
		function get_discount(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var net_total = document.getElementById("net_total").value;
                var oth_chg = document.getElementById("other_charge").value;
				var dis_net_total =  parseFloat(net_total) - parseFloat(val_1);
				$("#net_total").val(dis_net_total);
			}
		</script>
		<tr>
          <th colspan="7" class="text-right">Discount</th>
          <th><input type="text" id="discount" onkeyup="get_discount(this.value);" name="discount"></th>
        </tr>
		<tr>
          <th colspan="7" class="text-right">Other Charges</th>
          <th><input type="text" id="other_charge" onkeyup="get_othercharge(this.value);" name="other_charge"></th>
        </tr>
		<tr>
          <th colspan="7" class="text-right">Net Total</th>
          <th><input type="text" id="net_total" name="net_total" readonly></th>
        </tr>

    </table>


	
	</div>
	</div>
						 <div class="col-sm-12">                        
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

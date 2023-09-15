<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';
include("phpmailer/class.phpmailer.php");
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
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
	$customer_1 = $_REQUEST['customer'];
	$acctdate = $_REQUEST['acctdate'];
	$discount = $_REQUEST['discount'];
	$other_charge = $_REQUEST['other_charge'];
	$invoice_no = $_REQUEST['sale_order_no'];
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
    $shop = array();
	
	
	$product_s = $_REQUEST['product_s'];
	$quantity_s = $_REQUEST['quantity_s'];
	 $shop = $_REQUEST['shop'];
	
	
	for($i=0;$i<sizeof($product_s);$i++){
		
		$product_sd = $product_s[$i];
		 $quantity_sd = $quantity_s[$i];
	     $shop_sd = $shop[$i]; 
	    
		if($quantity_sd!=0){
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_sales_order`(`Customer_Id`, `Date`, `Order_No`,`Dc_No`, `Product_Id`, `Quantity`, `Created_On`, `Created_By`, `Status`,`Shop_Id`) VALUES ('$customer_1','$acctdate','$invoice_no','$dc_no','$product_sd','$quantity_sd','$createdon','$createdby','$status','$shop_sd')");
	    if($insert_details){
	      $fetchlevel_cus=mysqli_query($con,"select * from tbl_coordinator where Id='$customer_1'");
                $fetchlevel_tst_cus=mysqli_fetch_array($fetchlevel_cus);
				$customer_name = $fetchlevel_tst_cus['Name'];
				
				$fetchlevel_shop=mysqli_query($con,"select * from tbl_shop where Id='$shop_sd'");
                $fetchlevel_tst_shop=mysqli_fetch_array($fetchlevel_shop);
				$shop_name = $fetchlevel_tst_shop['Name'];
				
				$fetchlevel_prd=mysqli_query($con,"select * from tbl_shop where Id='$product_sd'");
                $fetchlevel_tst_prd=mysqli_fetch_array($fetchlevel_prd);
				$product_name = $fetchlevel_tst_prd['Name'];
				
					$name 		= 	"manoj_p@mazenetsolution.com";
        		$pass		=	"kuttymanoj";
        		$to		    =	"ootytea@gmail.com";
        // 		$fromdept	=	$name_f;
                	$message ="A new entry has been made! You co-ordinator $customer_name belonging to the $shop_name has added $quantity_sd-$product_name on $acctdate";
                	
        	$mail = new PHPMailer();
            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = $name;
            $mail->Password = $pass;
        	$mail->SMTPSecure = "ssl"; // SSL FROM DATABASE
            $mail->Host = 	    "smtp.gmail.com";// Host FROM DATABASE
            $mail->Port = 		"465";// Port FROM DATABASE
            $mail->setFrom($name);
            $mail->AddAddress($to);
            $mail->AddAttachment($sourcePath, $tmpFilePath);

            // $mail->addCC('ashokraj@mazenetsolution.com');
            $mail->Subject  = 'Apply For '.$designation;
            $mail->IsHTML(true);
            $mail->Body    = $message;
        	$mail->Send();
		}
		}
		      	
				
		
        	
	}
	
	
	if($insert_details){

			
			 echo '<script type="text/javascript">
										window.location.replace("add_sales_order.php?step=suces");
							</script>';		
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("add_sales_order.php?step=fail");
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
				url: "get_slaes_shop.php",
				data:'coordi_id='+val,			 
				success: function(data){
				$("#shop_id").html(data); 
				$("#shop").selectpicker(); 
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
			 
		    function new_customer(val) {
			   
			   if(val=='new'){
				   $("#new_customer").show();
			   } else {
				    $("#new_customer").hide();
			   }
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
<?php 
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Success!</strong> Indent is Added Successfully.
  </div>

	<?php 
	}
	else if($final == "edit")
	{ ?>
		<div class="alert alert_msg alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Success !</strong> Updated Successfully.
	</div>
	<?php }
	else if($final == "fail")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Failed!</strong> This Details Was Already Exist.
	</div>
	<?php }
	else if($final == "delete")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Success!</strong>  Removed Successfully.
	</div>
	<?php } 
	?>
<div class="panel-heading lead ">
	<div class="row">
		<div class="col-lg-8 col-md-8"><b>Indent</b></div>				
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
				      	<?php
				$selectlevel_tst=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
                $fetchlevel_tst=mysqli_fetch_array($selectlevel_tst);
				$type_tst = $fetchlevel_tst['User_type'];
				$emp_id = $fetchlevel_tst['Emp_tbl_Id'];
				 if($type_tst=='Admin') {
				?>
	                <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Coordinator<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="customer" onchange="get_dc_details(this.value);" id="customer" data-live-search="true" required>
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
					 <?php } else { ?>
					 <input type="hidden" name='customer' value="<?php echo $emp_id; ?>">
					 <?php } ?>
					 <div id="new_customer" style="display: none;"> 
					 <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Name</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="Name">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Address Line 1</label>
							<div class="col-sm-4">
							<input type="text" name="Address_Line1" class="form-control"  placeholder="Address Line 1">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Address Line 2</label>
						 <div class="col-sm-4">
							<input type="text" name="Address_Line2" class="form-control"  placeholder="Address Line 2">
						</div>
							<label for="inputName" class="col-sm-2 control-label">State</label>
							<div class="col-sm-4">
							<input type="text" name="State" class="form-control"  placeholder="State">
						  </div>
							
						</div>
						
						
						<div class="form-group col-sm-12">
						 
						
							<label for="inputName" class="col-sm-2 control-label">Mobile Number 1</label>
							<div class="col-sm-4">
							<input type="text" name="Mobile_No1" class="form-control"  placeholder="Mobile Number 1">
						  </div>
						  <label for="inputName" class="col-sm-2 control-label">GST No </label>
							<div class="col-sm-4">
							<input type="text" name="Gst_No" class="form-control"  placeholder="GST No">
						  </div>
						</div>
						
						
						<div class="form-group col-sm-12">
						 
						
							<label for="inputName" class="col-sm-2 control-label">Email Id 1</label>
							<div class="col-sm-4">
							<input type="text" name="Email_Id1" class="form-control"  placeholder="Email Id 1">
						  </div>
						</div></div>
				<div class="form-group col-sm-4">        
                   <label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                    <div class="col-sm-8">
						<input class="form-control dp"  value="<?php echo date('d-m-Y').$acctopendate;?>"  placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>
			 
                      </div>
				   </div>
				   <script>
					$(document).ready(function () {
					$('.dp').datepicker({
						format: "dd-mm-yyyy",
						autoclose: true
					});

					$('.dp').on('change', function () {
						$('.datepicker').hide();
					});
                     $("#discount").val(0);
                     $("#other_charge").val(0);
					});
					
				
				  </script>
				   	<?php 
						    $select_mid=mysqli_query($con,"select MAX(Id) as mid from tbl_sales_order WHERE Status='Active'");
							$fetch_mid=mysqli_fetch_array($select_mid);
							$mid=$fetch_mid['mid'];
							
							$select_inv_no=mysqli_query($con,"select Order_No from tbl_sales_order WHERE Id='$mid'");
							$fetch_inv_no=mysqli_fetch_array($select_inv_no);
							$inv_no=$fetch_inv_no['Order_No'] +1;
						 
						       if($inv_no=='1' || $inv_no=='NULL'){
						           $inv_no_1 =1;
						       } else {
						           $inv_no_1 = $inv_no;
						       }
						 ?>
				     <div class="form-group col-sm-4">
						 <label for="inputName" class="col-sm-4 control-label">Indent No</label>
						 <div class="col-sm-8">
							<input type="text" id="sale_order_no" value="<?php echo $inv_no_1; ?>" class="form-control limited" name="sale_order_no" readonly>
						</div>
						</div>
						</div>
		
					<br><br>
				<div id="shop_id"></div>
				  <div class="row">    
				  	
				   <div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Product<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="product" id="product" data-live-search="true" required>
						 <option value="">Select Product</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_product WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$tid=$fetch_GrpQry['Id'];
							$Cgst=$fetch_GrpQry['Cgst'];
							$Sgst=$fetch_GrpQry['Sgst'];
							$Igst=$fetch_GrpQry['Igst'];
							$Hsn_Code=$fetch_GrpQry['Hsn_Code'];
							?>
							<option value="<?php echo $tid."/".$Cgst."/".$Sgst."/".$Igst."/".$Name."/".$Hsn_Code; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						</div> 
					  <div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Quantity<font color="red">&nbsp;*&nbsp;</font></label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="quantity" onKeyUp="avail_check(this.value);" class="limited" style="width:80%;" maxlength="15" name="quantity">
							
							
							</div>
							
							
							</div>

						 
						  
						   <div id="product_id"> </div>
						   
						   

							
							
							<input type="button" VALUE="+" id="BTNSUBMIT" onclick="addrow()"/>
							
						   </div>
						 
						    
						    <script>
						   function addrow()
							{
								var quantity = document.getElementById("quantity").value;
								var product = document.getElementById("product").value;
								var shop = document.getElementById("shop").value;
								if(quantity!=''){
								var i_value= document.getElementById("i_value").value;
								if(i_value =='') {
									i_value = 1;
								} else {
									i_value = parseFloat(i_value)+1;
								}
								$("#i_value").val(i_value);
								var product_1 = product.split("/");
								var cgst = parseFloat(product_1[1]);
								var sgst = parseFloat(product_1[2]);
								
								var shop_1 = shop.split("/");
								var shop_id = parseFloat(shop_1[0]);
								var shop_name = shop_1[1];
								
								
								var btn = document.createElement('input');
								btn.type = "button";
								btn.className = "btn";
								btn.value="Delete";
								btn.setAttribute("onclick", "deleteRow(this);");
								
								var table = document.getElementById("mytable");
								var row = table.insertRow(1);
								var cell1 = row.insertCell(0);
								var cell2 = row.insertCell(1);
								var cell3 = row.insertCell(2);
								var cell4 = row.insertCell(3);
								
								cell1.innerHTML = i_value;
								cell2.innerHTML = shop_name;
								cell3.innerHTML = product_1[4];
								cell4.innerHTML = quantity;
							    
									
								if(i_value ==1) {
								$("#product_1").val(product_1[0]);
								$("#quantity_1").val(quantity);
								$("#shop_1").val(shop_1[0]);
								$("#rate_1").val(rate);
								$("#ori_rate_1").val(ori_rate_1);
								$("#amount_1").val(amount);
								$("#cgst_1").val(cgst_1);
								$("#sgst_1").val(sgst_1);
								$("#igst_1").val(product_1[3]);
								$("#netamount_1").val(net_amount);
								$("#prod_dis_1").val(prod_dis);
								$("#i_val_1").val(i_value);
								
							
								
								} else if(i_value ==2) {
								$("#product_2").val(product_1[0]);
								$("#quantity_2").val(quantity);
								$("#shop_2").val(shop_1[0]);
								$("#rate_2").val(rate);
								$("#ori_rate_2").val(ori_rate_1);
								$("#amount_2").val(amount);
								$("#cgst_2").val(cgst_1);	
								$("#sgst_2").val(sgst_1);
								$("#igst_2").val(product_1[3]);
								$("#netamount_2").val(net_amount);
								$("#prod_dis_2").val(prod_dis);
								$("#i_val_2").val(i_value);
								
									
								} else if(i_value ==3) {
								$("#product_3").val(product_1[0]);
								$("#ori_rate_3").val(ori_rate_1);
								$("#shop_3").val(shop_1[0]);
								$("#quantity_3").val(quantity);
								$("#rate_3").val(rate);
								$("#amount_3").val(amount);
								$("#cgst_3").val(cgst_1);	
								$("#sgst_3").val(sgst_1);
								$("#igst_3").val(product_1[3]);
								$("#netamount_3").val(net_amount);
								$("#prod_dis_3").val(prod_dis);
								$("#i_val_3").val(i_value);
								
									
								} else if(i_value ==4) {
								$("#product_4").val(product_1[0]);
								$("#quantity_4").val(quantity);
								$("#shop_4").val(shop_1[0]);
								$("#rate_4").val(rate);
								$("#ori_rate_4").val(ori_rate_1);
								$("#amount_4").val(amount);
								$("#cgst_4").val(cgst_1);	
								$("#sgst_4").val(sgst_1);
								$("#igst_4").val(product_1[3]);
								$("#netamount_4").val(net_amount);
								$("#prod_dis_4").val(prod_dis);
								$("#i_val_4").val(i_value);
							
									
								} else if(i_value ==5) {
								$("#product_5").val(product_1[0]);
								$("#quantity_5").val(quantity);
								$("#shop_5").val(shop_1[0]);
								$("#rate_5").val(rate);
								$("#ori_rate_5").val(ori_rate_1);
								$("#amount_5").val(amount);
								$("#cgst_5").val(cgst_1);	
								$("#sgst_5").val(sgst_1);
								$("#igst_5").val(product_1[3]);
								$("#netamount_5").val(net_amount);
								$("#prod_dis_5").val(prod_dis);
								$("#i_val_5").val(i_value);
								
									
								} else if(i_value ==6) {
								$("#product_6").val(product_1[0]);
								$("#quantity_6").val(quantity);
								$("#shop_6").val(shop_1[0]);
								$("#rate_6").val(rate);
								$("#amount_6").val(amount);
								$("#ori_rate_6").val(ori_rate_1);
								$("#cgst_6").val(cgst_1);	
								$("#sgst_6").val(sgst_1);
								$("#igst_6").val(product_1[3]);
								$("#netamount_6").val(net_amount);
								$("#prod_dis_6").val(prod_dis);
								$("#i_val_6").val(i_value);
								
									
								} else if(i_value ==7) {
								$("#product_7").val(product_1[0]);
								$("#quantity_7").val(quantity);
								$("#shop_7").val(shop_1[0]);
								$("#rate_7").val(rate);
								$("#ori_rate_7").val(ori_rate_1);
								$("#amount_7").val(amount);
								$("#cgst_7").val(cgst_1);	
								$("#sgst_7").val(sgst_1);
								$("#igst_7").val(product_1[3]);
								$("#netamount_7").val(net_amount);
								$("#prod_dis_7").val(prod_dis);
								$("#i_val_7").val(i_value);
								
									
								} else if(i_value ==8) {
								$("#product_8").val(product_1[0]);
								$("#quantity_8").val(quantity);
								$("#shop_8").val(shop_1[0]);
								$("#rate_8").val(rate);
								$("#amount_8").val(amount);
								$("#ori_rate_8").val(ori_rate_1);
								$("#cgst_8").val(cgst_1);	
								$("#sgst_8").val(sgst_1);
								$("#igst_8").val(product_1[3]);
								$("#netamount_8").val(net_amount);
								$("#prod_dis_8").val(prod_dis);
								$("#i_val_8").val(i_value);
								
									
								} else if(i_value ==9) {
								$("#product_9").val(product_1[0]);
								$("#quantity_9").val(quantity);
								$("#shop_9").val(shop_1[0]);
								$("#rate_9").val(rate);
								$("#amount_9").val(amount);
								$("#cgst_9").val(cgst_1);	
								$("#ori_rate_9").val(ori_rate_1);
								$("#sgst_9").val(sgst_1);
								$("#igst_9").val(product_1[3]);
								$("#netamount_9").val(net_amount);
								$("#prod_dis_9").val(prod_dis);
								$("#i_val_9").val(i_value);
							
									
								} else if(i_value ==10) {
								$("#product_10").val(product_1[0]);
								$("#quantity_10").val(quantity);
								$("#shop_10").val(shop_1[0]);
								$("#rate_10").val(rate);
								$("#amount_10").val(amount);
								$("#cgst_10").val(cgst_1);	
								$("#sgst_10").val(sgst_1);
								$("#ori_rate_10").val(ori_rate_1);
								$("#igst_10").val(product_1[3]);
								$("#netamount_10").val(net_amount);
								$("#prod_dis_10").val(prod_dis);
								$("#i_val_10").val(i_value);
								
									
								} else if(i_value ==11) {
								$("#product_11").val(product_1[0]);
								$("#quantity_11").val(quantity);
								$("#rate_11").val(rate);
								$("#amount_11").val(amount);
								$("#cgst_11").val(cgst_1);	
								$("#ori_rate_11").val(ori_rate_1);
								$("#sgst_11").val(sgst_1);
								$("#igst_11").val(product_1[3]);
								$("#netamount_11").val(net_amount);
								$("#prod_dis_11").val(prod_dis);
									
								}
								else if(i_value ==12) {
								$("#product_12").val(product_1[0]);
								$("#quantity_12").val(quantity);
								$("#rate_12").val(rate);
								$("#amount_12").val(amount);
								$("#cgst_12").val(cgst_1);	
								$("#ori_rate_12").val(ori_rate_1);
								$("#sgst_12").val(sgst_1);
								$("#igst_12").val(product_1[3]);
								$("#netamount_12").val(net_amount);
								$("#prod_dis_12").val(prod_dis);
									
								}
								else if(i_value ==13) {
								$("#product_13").val(product_1[0]);
								$("#quantity_13").val(quantity);
								$("#rate_13").val(rate);
								$("#amount_13").val(amount);
								$("#cgst_13").val(cgst_1);	
								$("#ori_rate_13").val(ori_rate_1);
								$("#sgst_13").val(sgst_1);
								$("#igst_13").val(product_1[3]);
								$("#netamount_13").val(net_amount);
								$("#prod_dis_13").val(prod_dis);
									
								}
								else if(i_value ==14) {
								$("#product_14").val(product_1[0]);
								$("#quantity_14").val(quantity);
								$("#rate_14").val(rate);
								$("#amount_14").val(amount);
								$("#cgst_14").val(cgst_1);	
								$("#ori_rate_14").val(ori_rate_1);
								$("#sgst_14").val(sgst_1);
								$("#igst_14").val(product_1[3]);
								$("#netamount_14").val(net_amount);
								$("#prod_dis_14").val(prod_dis);
									
								} else if(i_value ==15) {
								$("#product_15").val(product_1[0]);
								$("#quantity_15").val(quantity);
								$("#rate_15").val(rate);
								$("#amount_15").val(amount);
								$("#cgst_15").val(cgst_1);	
								$("#sgst_15").val(sgst_1);
								$("#ori_rate_15").val(ori_rate_1);
								$("#igst_15").val(product_1[3]);
								$("#netamount_15").val(net_amount);
								$("#prod_dis_15").val(prod_dis);
									
								} else if(i_value ==16) {
								$("#product_16").val(product_1[0]);
								$("#quantity_16").val(quantity);
								$("#rate_16").val(rate);
								$("#amount_16").val(amount);
								$("#cgst_16").val(cgst_1);	
								$("#ori_rate_16").val(ori_rate_1);
								$("#sgst_16").val(sgst_1);
								$("#igst_16").val(product_1[3]);
								$("#netamount_16").val(net_amount);
								$("#prod_dis_16").val(prod_dis);
									
								} else if(i_value ==17) {
								$("#product_17").val(product_1[0]);
								$("#quantity_17").val(quantity);
								$("#rate_17").val(rate);
								$("#amount_17").val(amount);
								$("#cgst_17").val(cgst_1);	
								$("#sgst_17").val(sgst_1);
								$("#ori_rate_17").val(ori_rate_1);
								$("#igst_17").val(product_1[3]);
								$("#netamount_17").val(net_amount);
								$("#prod_dis_17").val(prod_dis);
									
								} else if(i_value ==18) {
								$("#product_18").val(product_1[0]);
								$("#quantity_18").val(quantity);
								$("#rate_18").val(rate);
								$("#amount_18").val(amount);
								$("#cgst_18").val(cgst_1);	
								$("#sgst_18").val(sgst_1);
								$("#ori_rate_18").val(ori_rate_1);
								$("#igst_18").val(product_1[3]);
								$("#netamount_18").val(net_amount);
								$("#prod_dis_18").val(prod_dis);
									
								}
								else if(i_value ==19) {
								$("#product_19").val(product_1[0]);
								$("#quantity_19").val(quantity);
								$("#rate_19").val(rate);
								$("#amount_19").val(amount);
								$("#cgst_19").val(cgst_1);	
								$("#sgst_19").val(sgst_1);
								$("#ori_rate_19").val(ori_rate_1);
								$("#igst_19").val(product_1[3]);
								$("#netamount_19").val(net_amount);
								$("#prod_dis_19").val(prod_dis);
									
								}
								else if(i_value ==20) {
								$("#product_20").val(product_1[0]);
								$("#quantity_20").val(quantity);
								$("#rate_20").val(rate);
								$("#amount_20").val(amount);
								$("#cgst_20").val(cgst_1);	
								$("#ori_rate_20").val(ori_rate_1);
								$("#sgst_20").val(sgst_1);
								$("#igst_20").val(product_1[3]);
								$("#netamount_20").val(net_amount);
								$("#prod_dis_20").val(prod_dis);
									
								}
								else if(i_value ==21) {
								$("#product_21").val(product_1[0]);
								$("#quantity_21").val(quantity);
								$("#rate_21").val(rate);
								$("#amount_21").val(amount);
								$("#cgst_21").val(cgst_1);	
								$("#ori_rate_21").val(ori_rate_1);
								$("#sgst_21").val(sgst_1);
								$("#igst_21").val(product_1[3]);
								$("#netamount_21").val(net_amount);
								$("#prod_dis_21").val(prod_dis);
									
								}
								else if(i_value ==22) {
								$("#product_22").val(product_1[0]);
								$("#quantity_22").val(quantity);
								$("#rate_22").val(rate);
								$("#amount_22").val(amount);
								$("#cgst_22").val(cgst_1);	
								$("#ori_rate_22").val(ori_rate_1);
								$("#sgst_22").val(sgst_1);
								$("#igst_22").val(product_1[3]);
								$("#netamount_22").val(net_amount);
								$("#prod_dis_22").val(prod_dis);
									
								}
								else if(i_value ==23) {
								$("#product_23").val(product_1[0]);
								$("#quantity_23").val(quantity);
								$("#rate_23").val(rate);
								$("#amount_23").val(amount);
								$("#cgst_23").val(cgst_1);	
								$("#ori_rate_23").val(ori_rate_1);
								$("#sgst_23").val(sgst_1);
								$("#igst_23").val(product_1[3]);
								$("#netamount_23").val(net_amount);
								$("#prod_dis_23").val(prod_dis);
									
								} else if(i_value ==24) {
								$("#product_24").val(product_1[0]);
								$("#quantity_24").val(quantity);
								$("#rate_24").val(rate);
								$("#amount_24").val(amount);
								$("#cgst_24").val(cgst_1);	
								$("#sgst_24").val(sgst_1);
								$("#ori_rate_24").val(ori_rate_1);
								$("#igst_24").val(product_1[3]);
								$("#netamount_24").val(net_amount);
								$("#prod_dis_24").val(prod_dis);
									
								} else if(i_value ==25) {
								$("#product_25").val(product_1[0]);
								$("#quantity_25").val(quantity);
								$("#rate_25").val(rate);
								$("#amount_25").val(amount);
								$("#cgst_25").val(cgst_1);	
								$("#sgst_25").val(sgst_1);
								$("#ori_rate_25").val(ori_rate_1);
								$("#igst_25").val(product_1[3]);
								$("#netamount_25").val(net_amount);
								$("#prod_dis_25").val(prod_dis);
									
								}	
								else if(i_value ==26) {
								$("#product_26").val(product_1[0]);
								$("#quantity_26").val(quantity);
								$("#rate_26").val(rate);
								$("#amount_26").val(amount);
								$("#cgst_26").val(cgst_1);	
								$("#sgst_26").val(sgst_1);
								$("#ori_rate_26").val(ori_rate_1);
								$("#igst_26").val(product_1[3]);
								$("#netamount_26").val(net_amount);
								$("#prod_dis_26").val(prod_dis);
									
								}	
								else if(i_value ==27) {
								$("#product_27").val(product_1[0]);
								$("#quantity_27").val(quantity);
								$("#rate_27").val(rate);
								$("#amount_27").val(amount);
								$("#cgst_27").val(cgst_1);	
								$("#sgst_27").val(sgst_1);
								$("#ori_rate_27").val(ori_rate_1);
								$("#igst_27").val(product_1[3]);
								$("#netamount_27").val(net_amount);
								$("#prod_dis_27").val(prod_dis);
									
								}	
								else if(i_value ==28) {
								$("#product_28").val(product_1[0]);
								$("#quantity_28").val(quantity);
								$("#rate_28").val(rate);
								$("#amount_28").val(amount);
								$("#cgst_28").val(cgst_1);	
								$("#sgst_28").val(sgst_1);
								$("#igst_28").val(product_1[3]);
								$("#ori_rate_28").val(ori_rate_1);
								$("#netamount_28").val(net_amount);
								$("#prod_dis_28").val(prod_dis);
									
								}	
								else if(i_value ==29) {
								$("#product_29").val(product_1[0]);
								$("#quantity_29").val(quantity);
								$("#rate_29").val(rate);
								$("#amount_29").val(amount);
								$("#cgst_29").val(cgst_1);	
								$("#sgst_29").val(sgst_1);
								$("#igst_29").val(product_1[3]);
								$("#netamount_29").val(net_amount);
								$("#ori_rate_29").val(ori_rate_1);	
								$("#prod_dis_29").val(prod_dis);
								}	
								else if(i_value ==30) {
								$("#product_30").val(product_1[0]);
								$("#quantity_30").val(quantity);
								$("#rate_30").val(rate);
								$("#amount_30").val(amount);
								$("#cgst_30").val(cgst_1);	
								$("#sgst_30").val(sgst_1);
								$("#igst_30").val(product_1[3]);
								$("#netamount_30").val(net_amount);
								$("#ori_rate_30").val(ori_rate_1);	
								$("#prod_dis_30").val(prod_dis);
								}	
								else if(i_value ==31) {
								$("#product_31").val(product_1[0]);
								$("#quantity_31").val(quantity);
								$("#rate_31").val(rate);
								$("#amount_31").val(amount);
								$("#cgst_31").val(cgst_1);	
								$("#sgst_31").val(sgst_1);
								$("#igst_31").val(product_1[3]);
								$("#netamount_31").val(net_amount);
								$("#ori_rate_31").val(ori_rate_1);	
								$("#prod_dis_31").val(prod_dis);
								}		
								else if(i_value ==32) {
								$("#product_32").val(product_1[0]);
								$("#quantity_32").val(quantity);
								$("#rate_32").val(rate);
								$("#amount_32").val(amount);
								$("#cgst_32").val(cgst_1);	
								$("#sgst_32").val(sgst_1);
								$("#igst_32").val(product_1[3]);
								$("#netamount_32").val(net_amount);
								$("#ori_rate_32").val(ori_rate_1);	
                                $("#prod_dis_32").val(prod_dis);								
								}		
								else if(i_value ==33) {
								$("#product_33").val(product_1[0]);
								$("#quantity_33").val(quantity);
								$("#rate_33").val(rate);
								$("#amount_33").val(amount);
								$("#cgst_33").val(cgst_1);	
								$("#sgst_33").val(sgst_1);
								$("#igst_33").val(product_1[3]);
								$("#netamount_33").val(net_amount);
								$("#ori_rate_33").val(ori_rate_1);	
                                $("#prod_dis_33").val(prod_dis);								
								}		else if(i_value ==34) {
								$("#product_34").val(product_1[0]);
								$("#quantity_34").val(quantity);
								$("#rate_34").val(rate);
								$("#amount_34").val(amount);
								$("#cgst_34").val(cgst_1);	
								$("#sgst_34").val(sgst_1);
								$("#igst_34").val(product_1[3]);
								$("#netamount_34").val(net_amount);
								$("#ori_rate_34").val(ori_rate_1);	
                                $("#prod_dis_34").val(prod_dis);								
								}		
								else if(i_value ==35) {
								$("#product_35").val(product_1[0]);
								$("#quantity_35").val(quantity);
								$("#rate_35").val(rate);
								$("#amount_35").val(amount);
								$("#cgst_35").val(cgst_1);	
								$("#sgst_35").val(sgst_1);
								$("#igst_35").val(product_1[3]);
								$("#netamount_35").val(net_amount);
								$("#ori_rate_35").val(ori_rate_1);	
                                $("#prod_dis_35").val(prod_dis);								
								}
								else if(i_value ==36) {
								$("#product_36").val(product_1[0]);
								$("#quantity_36").val(quantity);
								$("#rate_36").val(rate);
								$("#amount_36").val(amount);
								$("#cgst_36").val(cgst_1);	
								$("#sgst_36").val(sgst_1);
								$("#igst_36").val(product_1[3]);
								$("#netamount_36").val(net_amount);
								$("#ori_rate_36").val(ori_rate_1);
                                $("#prod_dis_36").val(prod_dis);								
								}
								else if(i_value ==37) {
								$("#product_37").val(product_1[0]);
								$("#quantity_37").val(quantity);
								$("#rate_37").val(rate);
								$("#amount_37").val(amount);
								$("#cgst_37").val(cgst_1);	
								$("#sgst_37").val(sgst_1);
								$("#igst_37").val(product_1[3]);
								$("#netamount_37").val(net_amount);
								$("#ori_rate_37").val(ori_rate_1);		
								$("#prod_dis_37").val(prod_dis);
								}
								else if(i_value ==38) {
								$("#product_38").val(product_1[0]);
								$("#quantity_38").val(quantity);
								$("#rate_38").val(rate);
								$("#amount_38").val(amount);
								$("#cgst_38").val(cgst_1);	
								$("#sgst_38").val(sgst_1);
								$("#igst_38").val(product_1[3]);
								$("#netamount_38").val(net_amount);
								$("#ori_rate_38").val(ori_rate_1);		
								$("#prod_dis_38").val(prod_dis);
								}
								else if(i_value ==39) {
								$("#product_39").val(product_1[0]);
								$("#quantity_39").val(quantity);
								$("#rate_39").val(rate);
								$("#amount_39").val(amount);
								$("#cgst_39").val(cgst_1);	
								$("#sgst_39").val(sgst_1);
								$("#igst_39").val(product_1[3]);
								$("#netamount_39").val(net_amount);
								$("#ori_rate_39").val(ori_rate_1);		
								$("#prod_dis_39").val(prod_dis);
								}	
								else if(i_value ==40) {
								$("#product_40").val(product_1[0]);
								$("#quantity_40").val(quantity);
								$("#rate_40").val(rate);
								$("#amount_40").val(amount);
								$("#cgst_40").val(cgst_1);	
								$("#sgst_40").val(sgst_1);
								$("#igst_40").val(product_1[3]);
								$("#netamount_40").val(net_amount);
								$("#ori_rate_40").val(ori_rate_1);		
								$("#prod_dis_40").val(prod_dis);
								}
								else if(i_value ==41) {
								$("#product_41").val(product_1[0]);
								$("#quantity_41").val(quantity);
								$("#rate_41").val(rate);
								$("#amount_41").val(amount);
								$("#cgst_41").val(cgst_1);	
								$("#sgst_41").val(sgst_1);
								$("#igst_41").val(product_1[3]);
								$("#netamount_41").val(net_amount);
									
								}
								else if(i_value ==42) {
								$("#product_42").val(product_1[0]);
								$("#quantity_42").val(quantity);
								$("#rate_42").val(rate);
								$("#amount_42").val(amount);
								$("#cgst_42").val(cgst_1);	
								$("#sgst_42").val(sgst_1);
								$("#igst_42").val(product_1[3]);
								$("#netamount_42").val(net_amount);
									
								}
								else if(i_value ==43) {
								$("#product_43").val(product_1[0]);
								$("#quantity_43").val(quantity);
								$("#rate_43").val(rate);
								$("#amount_43").val(amount);
								$("#cgst_43").val(cgst_1);	
								$("#sgst_43").val(sgst_1);
								$("#igst_43").val(product_1[3]);
								$("#netamount_43").val(net_amount);
									
								}
								else if(i_value ==44) {
								$("#product_44").val(product_1[0]);
								$("#quantity_44").val(quantity);
								$("#rate_44").val(rate);
								$("#amount_44").val(amount);
								$("#cgst_44").val(cgst_1);	
								$("#sgst_44").val(sgst_1);
								$("#igst_44").val(product_1[3]);
								$("#netamount_44").val(net_amount);
									
								}
								else if(i_value ==45) {
								$("#product_45").val(product_1[0]);
								$("#quantity_45").val(quantity);
								$("#rate_45").val(rate);
								$("#amount_45").val(amount);
								$("#cgst_45").val(cgst_1);	
								$("#sgst_45").val(sgst_1);
								$("#igst_45").val(product_1[3]);
								$("#netamount_45").val(net_amount);
									
								}
								else if(i_value ==46) {
								$("#product_46").val(product_1[0]);
								$("#quantity_46").val(quantity);
								$("#rate_46").val(rate);
								$("#amount_46").val(amount);
								$("#cgst_46").val(cgst_1);	
								$("#sgst_46").val(sgst_1);
								$("#igst_46").val(product_1[3]);
								$("#netamount_46").val(net_amount);
									
								}
								else if(i_value ==47) {
								$("#product_47").val(product_1[0]);
								$("#quantity_47").val(quantity);
								$("#rate_47").val(rate);
								$("#amount_47").val(amount);
								$("#cgst_47").val(cgst_1);	
								$("#sgst_47").val(sgst_1);
								$("#igst_47").val(product_1[3]);
								$("#netamount_47").val(net_amount);
									
								}
								else if(i_value ==48) {
								$("#product_48").val(product_1[0]);
								$("#quantity_48").val(quantity);
								$("#rate_48").val(rate);
								$("#amount_48").val(amount);
								$("#cgst_48").val(cgst_1);	
								$("#sgst_48").val(sgst_1);
								$("#igst_48").val(product_1[3]);
								$("#netamount_48").val(net_amount);
									
								}
								else if(i_value ==49) {
								$("#product_49").val(product_1[0]);
								$("#quantity_49").val(quantity);
								$("#rate_49").val(rate);
								$("#amount_49").val(amount);
								$("#cgst_49").val(cgst_1);	
								$("#sgst_49").val(sgst_1);
								$("#igst_49").val(product_1[3]);
								$("#netamount_49").val(net_amount);
									
								}
								else if(i_value ==50) {
								$("#product_50").val(product_1[0]);
								$("#quantity_50").val(quantity);
								$("#rate_50").val(rate);
								$("#amount_50").val(amount);
								$("#cgst_50").val(cgst_1);	
								$("#sgst_50").val(sgst_1);
								$("#igst_50").val(product_1[3]);
								$("#netamount_50").val(net_amount);
									
								}
								else if(i_value ==51) {
								$("#product_51").val(product_1[0]);
								$("#quantity_51").val(quantity);
								$("#rate_51").val(rate);
								$("#amount_51").val(amount);
								$("#cgst_51").val(cgst_1);	
								$("#sgst_51").val(sgst_1);
								$("#igst_51").val(product_1[3]);
								$("#netamount_51").val(net_amount);
									
								}
								else if(i_value ==52) {
								$("#product_52").val(product_1[0]);
								$("#quantity_52").val(quantity);
								$("#rate_52").val(rate);
								$("#amount_52").val(amount);
								$("#cgst_52").val(cgst_1);	
								$("#sgst_52").val(sgst_1);
								$("#igst_52").val(product_1[3]);
								$("#netamount_52").val(net_amount);
									
								}
								else if(i_value ==53) {
								$("#product_53").val(product_1[0]);
								$("#quantity_53").val(quantity);
								$("#rate_53").val(rate);
								$("#amount_53").val(amount);
								$("#cgst_53").val(cgst_1);	
								$("#sgst_53").val(sgst_1);
								$("#igst_53").val(product_1[3]);
								$("#netamount_53").val(net_amount);
									
								}
								else if(i_value ==54) {
								$("#product_54").val(product_1[0]);
								$("#quantity_54").val(quantity);
								$("#rate_54").val(rate);
								$("#amount_54").val(amount);
								$("#cgst_54").val(cgst_1);	
								$("#sgst_54").val(sgst_1);
								$("#igst_54").val(product_1[3]);
								$("#netamount_54").val(net_amount);
									
								}
								else if(i_value ==55) {
								$("#product_55").val(product_1[0]);
								$("#quantity_55").val(quantity);
								$("#rate_55").val(rate);
								$("#amount_55").val(amount);
								$("#cgst_55").val(cgst_1);	
								$("#sgst_55").val(sgst_1);
								$("#igst_55").val(product_1[3]);
								$("#netamount_55").val(net_amount);
									
								}
								else if(i_value ==56) {
								$("#product_56").val(product_1[0]);
								$("#quantity_56").val(quantity);
								$("#rate_56").val(rate);
								$("#amount_56").val(amount);
								$("#cgst_56").val(cgst_1);	
								$("#sgst_56").val(sgst_1);
								$("#igst_56").val(product_1[3]);
								$("#netamount_56").val(net_amount);
									
								}
								else if(i_value ==57) {
								$("#product_57").val(product_1[0]);
								$("#quantity_57").val(quantity);
								$("#rate_57").val(rate);
								$("#amount_57").val(amount);
								$("#cgst_57").val(cgst_1);	
								$("#sgst_57").val(sgst_1);
								$("#igst_57").val(product_1[3]);
								$("#netamount_57").val(net_amount);
									
								}
								else if(i_value ==58) {
								$("#product_58").val(product_1[0]);
								$("#quantity_58").val(quantity);
								$("#rate_58").val(rate);
								$("#amount_58").val(amount);
								$("#cgst_58").val(cgst_1);	
								$("#sgst_58").val(sgst_1);
								$("#igst_58").val(product_1[3]);
								$("#netamount_58").val(net_amount);
									
								}
								else if(i_value ==59) {
								$("#product_59").val(product_1[0]);
								$("#quantity_59").val(quantity);
								$("#rate_59").val(rate);
								$("#amount_59").val(amount);
								$("#cgst_59").val(cgst_1);	
								$("#sgst_59").val(sgst_1);
								$("#igst_59").val(product_1[3]);
								$("#netamount_59").val(net_amount);
									
								}
								else if(i_value ==60) {
								$("#product_60").val(product_1[0]);
								$("#quantity_60").val(quantity);
								$("#rate_60").val(rate);
								$("#amount_60").val(amount);
								$("#cgst_60").val(cgst_1);	
								$("#sgst_60").val(sgst_1);
								$("#igst_60").val(product_1[3]);
								$("#netamount_60").val(net_amount);
									
								}
								else if(i_value ==61) {
								$("#product_61").val(product_1[0]);
								$("#quantity_61").val(quantity);
								$("#rate_61").val(rate);
								$("#amount_61").val(amount);
								$("#cgst_61").val(cgst_1);	
								$("#sgst_61").val(sgst_1);
								$("#igst_61").val(product_1[3]);
								$("#netamount_61").val(net_amount);
									
								}
								else if(i_value ==62) {
								$("#product_62").val(product_1[0]);
								$("#quantity_62").val(quantity);
								$("#rate_62").val(rate);
								$("#amount_62").val(amount);
								$("#cgst_62").val(cgst_1);	
								$("#sgst_62").val(sgst_1);
								$("#igst_62").val(product_1[3]);
								$("#netamount_62").val(net_amount);
									
								}
								else if(i_value ==63) {
								$("#product_63").val(product_1[0]);
								$("#quantity_63").val(quantity);
								$("#rate_63").val(rate);
								$("#amount_63").val(amount);
								$("#cgst_63").val(cgst_1);	
								$("#sgst_63").val(sgst_1);
								$("#igst_63").val(product_1[3]);
								$("#netamount_63").val(net_amount);
									
								}
								else if(i_value ==64) {
								$("#product_64").val(product_1[0]);
								$("#quantity_64").val(quantity);
								$("#rate_64").val(rate);
								$("#amount_64").val(amount);
								$("#cgst_64").val(cgst_1);	
								$("#sgst_64").val(sgst_1);
								$("#igst_64").val(product_1[3]);
								$("#netamount_64").val(net_amount);
									
								}
								else if(i_value ==65) {
								$("#product_65").val(product_1[0]);
								$("#quantity_65").val(quantity);
								$("#rate_65").val(rate);
								$("#amount_65").val(amount);
								$("#cgst_65").val(cgst_1);	
								$("#sgst_65").val(sgst_1);
								$("#igst_65").val(product_1[3]);
								$("#netamount_65").val(net_amount);
									
								}
								else if(i_value ==66) {
								$("#product_66").val(product_1[0]);
								$("#quantity_66").val(quantity);
								$("#rate_66").val(rate);
								$("#amount_66").val(amount);
								$("#cgst_66").val(cgst_1);	
								$("#sgst_66").val(sgst_1);
								$("#igst_66").val(product_1[3]);
								$("#netamount_66").val(net_amount);
									
								}
								else if(i_value ==67) {
								$("#product_67").val(product_1[0]);
								$("#quantity_67").val(quantity);
								$("#rate_67").val(rate);
								$("#amount_67").val(amount);
								$("#cgst_67").val(cgst_1);	
								$("#sgst_67").val(sgst_1);
								$("#igst_67").val(product_1[3]);
								$("#netamount_67").val(net_amount);
									
								}
								else if(i_value ==68) {
								$("#product_68").val(product_1[0]);
								$("#quantity_68").val(quantity);
								$("#rate_68").val(rate);
								$("#amount_68").val(amount);
								$("#cgst_68").val(cgst_1);	
								$("#sgst_68").val(sgst_1);
								$("#igst_68").val(product_1[3]);
								$("#netamount_68").val(net_amount);
									
								}
								else if(i_value ==69) {
								$("#product_69").val(product_1[0]);
								$("#quantity_69").val(quantity);
								$("#rate_69").val(rate);
								$("#amount_69").val(amount);
								$("#cgst_69").val(cgst_1);	
								$("#sgst_69").val(sgst_1);
								$("#igst_69").val(product_1[3]);
								$("#netamount_69").val(net_amount);
									
								}
								else if(i_value ==70) {
								$("#product_70").val(product_1[0]);
								$("#quantity_70").val(quantity);
								$("#rate_70").val(rate);
								$("#amount_70").val(amount);
								$("#cgst_70").val(cgst_1);	
								$("#sgst_70").val(sgst_1);
								$("#igst_70").val(product_1[3]);
								$("#netamount_70").val(net_amount);
									
								}
								else {
									
								}
								
								var total =  document.getElementById("total").value;
								if(total <=0) {
									total_1 =0;
								} else {
									total_1 = total
								}
								var net_cgst =  document.getElementById("net_cgst").value;
								if(net_cgst <=0) {
									net_cgst_1 =0;
								} else {
									net_cgst_1 = net_cgst;
								}
								var net_sgst =  document.getElementById("net_sgst").value;
								if(net_sgst <=0) {
									net_sgst_1 =0;
								} else {
									net_sgst_1 = net_sgst;
								}
								var net_igst =  document.getElementById("net_igst").value;
								if(net_igst <=0) {
									net_igst_1 =0;
								} else {
									net_igst_1 = net_igst;
								}
								var net_total_amt =  document.getElementById("net_total_amt").value;
								if(net_total_amt <=0) {
									net_total_amt_1 =0;
								} else {
									net_total_amt_1 = net_total_amt;
								}
								
								var total_value = Math.round(parseFloat(total_1) + parseFloat(net_amount));
								$("#total").val(total_value);
								var total_net_cgst = (parseFloat(net_cgst_1) + parseFloat(cgst_1)).toFixed(2);
								$("#net_cgst").val(total_net_cgst);
								var total_net_sgst = (parseFloat(net_sgst_1) + parseFloat(sgst_1)).toFixed(2);
								$("#net_sgst").val(total_net_sgst);
								var total_net_igst = (parseFloat(net_igst_1) + parseFloat(igst_1)).toFixed(2);
								$("#net_igst").val(0);
								var total_net_total_amt = (parseFloat(net_total_amt_1) + parseFloat(amount));
								$("#net_total_amt").val(total_net_total_amt);
								
								var discount = document.getElementById("discount").value;
								var other_charge = document.getElementById("other_charge").value;
								if(discount > 0)
								{
									
									discount_1 = discount;
								} else {
									discount_1 = 0;
								}
								
								var net_total_value_1 = Math.round(parseFloat(total_value) - parseFloat(discount_1));
								$("#net_total").val(net_total_value_1);
							}
							else {
							    alert("Please add the quantity");
							    
							}
							}
					
				  </script>
	<div class="col-sm-12" >	
    <table id="mytable" border="1">
        <tr>
		    <th>s.no</th>
		    <th>Shop Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            
        </tr>
		
		
	
<script>
function deleteRow(r) {

  var i = r.parentNode.parentNode.rowIndex;
  var i_val = document.getElementById("i_value").value;
  
  var ori_1 = i_val-i;
  var ori = ori_1 +1;
  
  if(ori==1){
		var amount_1 = document.getElementById("amount_1").value;
		var cgst_1 = document.getElementById("cgst_1").value;
		var sgst_1 = document.getElementById("sgst_1").value;
		var netamount_1 = document.getElementById("netamount_1").value;
		
	} else if(ori==2) {
		var amount_1 = document.getElementById("amount_2").value;
		var cgst_1 = document.getElementById("cgst_2").value;
		var sgst_1 = document.getElementById("sgst_2").value;
		var netamount_1 = document.getElementById("netamount_2").value;
		
	} else if(ori==3) {
		var amount_1 = document.getElementById("amount_3").value;
		var cgst_1 = document.getElementById("cgst_3").value;
		var sgst_1 = document.getElementById("sgst_3").value;
		var netamount_1 = document.getElementById("netamount_3").value;
	}else if(ori==4) {
		var amount_1 = document.getElementById("amount_4").value;
		var cgst_1 = document.getElementById("cgst_4").value;
		var sgst_1 = document.getElementById("sgst_4").value;
		var netamount_1 = document.getElementById("netamount_4").value;
	}else if(ori==5) {
		var amount_1 = document.getElementById("amount_5").value;
		var cgst_1 = document.getElementById("cgst_5").value;
		var sgst_1 = document.getElementById("sgst_5").value;
		var netamount_1 = document.getElementById("netamount_5").value;
	}else if(ori==6) {
		var amount_1 = document.getElementById("amount_6").value;
		var cgst_1 = document.getElementById("cgst_6").value;
		var sgst_1 = document.getElementById("sgst_6").value;
		var netamount_1 = document.getElementById("netamount_6").value;
	} else {
		
	}
	
	var net_total_amt = document.getElementById("net_total_amt").value;
	var net_cgst = document.getElementById("net_cgst").value;
	var net_sgst = document.getElementById("net_sgst").value;
	var total = document.getElementById("total").value;
	var net_total = document.getElementById("net_total").value;
	
	var net_total_amt_ori = (parseFloat(net_total_amt) - parseFloat(amount_1)).toFixed(2);
	var cgst_ori = (parseFloat(net_cgst) - parseFloat(cgst_1)).toFixed(2);
	var sgst_ori = (parseFloat(net_sgst) - parseFloat(sgst_1)).toFixed(2);
	var total_ori = Math.round(parseFloat(total) - parseFloat(netamount_1));
	var net_total_ori = Math.round(parseFloat(net_total) - parseFloat(netamount_1));
	
	$("#net_total_amt").val(net_total_amt_ori);
	$("#net_cgst").val(cgst_ori);
	$("#net_sgst").val(sgst_ori);
	$("#total").val(total_ori);
	$("#net_total").val(net_total_ori);
	
	
                                if(ori ==1) {
								$("#product_1").val(0);
								$("#quantity_1").val(0);
								$("#rate_1").val(0);
								$("#ori_rate_1").val(0);
								$("#amount_1").val(0);
								$("#cgst_1").val(0);
								$("#sgst_1").val(0);
								$("#igst_1").val(0);
								$("#netamount_1").val(0);
								$("#prod_dis_1").val(0);
								$("#i_val_1").val(i_value);
								
								
								} else if(i_value ==2) {
								$("#product_2").val(0);
								$("#quantity_2").val(0);
								$("#rate_2").val(0);
								$("#ori_rate_2").val(0);
								$("#amount_2").val(0);
								$("#cgst_2").val(0);	
								$("#sgst_2").val(0);
								$("#igst_2").val(0);
								$("#netamount_2").val(0);
								$("#prod_dis_2").val(0);
								$("#i_val_2").val(i_value);
									
								} else if(i_value ==3) {
								$("#product_3").val(0);
								$("#ori_rate_3").val(0);
								$("#quantity_3").val(0);
								$("#rate_3").val(0);
								$("#amount_3").val(0);
								$("#cgst_3").val(0);	
								$("#sgst_3").val(0);
								$("#igst_3").val(0);
								$("#netamount_3").val(0);
								$("#prod_dis_3").val(0);
								$("#i_val_3").val(i_value);
									
								} else if(i_value ==4) {
								$("#product_4").val(0);
								$("#quantity_4").val(0);
								$("#rate_4").val(0);
								$("#ori_rate_4").val(0);
								$("#amount_4").val(0);
								$("#cgst_4").val(0);	
								$("#sgst_4").val(0);
								$("#igst_4").val(0);
								$("#netamount_4").val(0);
								$("#prod_dis_4").val(0);
								$("#i_val_4").val(i_value);
									
								} else if(i_value ==5) {
								$("#product_5").val(0);
								$("#quantity_5").val(0);
								$("#rate_5").val(0);
								$("#ori_rate_5").val(0);
								$("#amount_5").val(0);
								$("#cgst_5").val(0);	
								$("#sgst_5").val(0);
								$("#igst_5").val(0);
								$("#netamount_5").val(0);
								$("#prod_dis_5").val(0);
								$("#i_val_5").val(i_value);
									
								} else if(i_value ==6) {
								$("#product_6").val(0);
								$("#quantity_6").val(0);
								$("#rate_6").val(0);
								$("#amount_6").val(0);
								$("#ori_rate_6").val(0);
								$("#cgst_6").val(0);	
								$("#sgst_6").val(0);
								$("#igst_6").val(0);
								$("#netamount_6").val(0);
								$("#prod_dis_6").val(0);
								$("#i_val_6").val(i_value);
									
								} else {
									
								}
  
  document.getElementById("mytable").deleteRow(i);
}
</script>


		<script>
		function get_discount(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var total = document.getElementById("total").value;
				var dis_net_total =  parseFloat(total) - parseFloat(val_1);
				$("#net_total").val(dis_net_total);
			}
		</script>
		<script>
		function discount_check(val)
			 {
				 if(val==""){
					 val_1 = 0;
				 } else {
					 val_1 = val;
				 }
                var net_total_amt = document.getElementById("net_total_amt").value;
                var net_cgst = document.getElementById("net_cgst").value;
                var net_sgst = document.getElementById("net_sgst").value;
                var net_igst = document.getElementById("net_igst").value;
				
				var tot = Math.round((net_total_amt*val_1)/100);
				
			    var tot_amt_val = parseFloat(net_total_amt) - parseFloat(tot);
				var net_tot_amt = Math.round(parseFloat(tot_amt_val) + parseFloat(net_cgst) + parseFloat(net_sgst) + parseFloat(net_igst));
				var tot_amt = parseFloat(net_total_amt) + parseFloat(net_cgst) + parseFloat(net_sgst) + parseFloat(net_igst);
				$("#total").val(tot_amt);
				$("#discount").val(tot);
				$("#net_total").val(net_tot_amt);
			}
		</script>
		

    </table>

	<input type="hidden" id="i_value">
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_1">
	<input type="hidden" name="quantity_s[]" id="quantity_1">
	<input type="hidden" name="shop[]" id="shop_1">
	<input type="hidden" name="rate_s[]" id="rate_1">
	<input type="hidden" name="amount_s[]" id="amount_1">
	<input type="hidden" name="cgst_s[]" id="cgst_1">
	<input type="hidden" name="sgst_s[]" id="sgst_1">
	<input type="hidden" name="igst_s[]" id="igst_1">
	<input type="hidden" name="netamount_s[]" id="netamount_1">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_1">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_1">
	<input type="hidden" name="i_val[]" id="i_val_1">
	
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_2">
	<input type="hidden" name="quantity_s[]" id="quantity_2">
	<input type="hidden" name="shop[]" id="shop_1">
	<input type="hidden" name="rate_s[]" id="rate_2">
	<input type="hidden" name="amount_s[]" id="amount_2">
	<input type="hidden" name="cgst_s[]" id="cgst_2">
	<input type="hidden" name="sgst_s[]" id="sgst_2">
	<input type="hidden" name="igst_s[]" id="igst_2">
	<input type="hidden" name="netamount_s[]" id="netamount_2">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_2">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_2">
	<input type="hidden" name="i_val[]" id="i_val_2">
	</div>
	
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_3">
	<input type="hidden" name="quantity_s[]" id="quantity_3">
	<input type="hidden" name="rate_s[]" id="rate_3">
	<input type="hidden" name="amount_s[]" id="amount_3">
	<input type="hidden" name="cgst_s[]" id="cgst_3">
	<input type="hidden" name="sgst_s[]" id="sgst_3">
	<input type="hidden" name="igst_s[]" id="igst_3">
	<input type="hidden" name="netamount_s[]" id="netamount_3">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_3">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_3">
	<input type="hidden" name="i_val[]" id="i_val_3">
	<input type="hidden" name="shop[]" id="shop_3">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_4">
	<input type="hidden" name="quantity_s[]" id="quantity_4">
	<input type="hidden" name="rate_s[]" id="rate_4">
	<input type="hidden" name="amount_s[]" id="amount_4">
	<input type="hidden" name="cgst_s[]" id="cgst_4">
	<input type="hidden" name="sgst_s[]" id="sgst_4">
	<input type="hidden" name="igst_s[]" id="igst_4">
	<input type="hidden" name="netamount_s[]" id="netamount_4">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_4">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_4">
	<input type="hidden" name="i_val[]" id="i_val_4">
	<input type="hidden" name="shop[]" id="shop_4">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_5">
	<input type="hidden" name="quantity_s[]" id="quantity_5">
	<input type="hidden" name="rate_s[]" id="rate_5">
	<input type="hidden" name="amount_s[]" id="amount_5">
	<input type="hidden" name="cgst_s[]" id="cgst_5">
	<input type="hidden" name="sgst_s[]" id="sgst_5">
	<input type="hidden" name="igst_s[]" id="igst_5">
	<input type="hidden" name="netamount_s[]" id="netamount_5">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_5">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_5">
	<input type="hidden" name="i_val[]" id="i_val_5">
	<input type="hidden" name="shop[]" id="shop_5">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_6">
	<input type="hidden" name="quantity_s[]" id="quantity_6">
	<input type="hidden" name="rate_s[]" id="rate_6">
	<input type="hidden" name="amount_s[]" id="amount_6">
	<input type="hidden" name="cgst_s[]" id="cgst_6">
	<input type="hidden" name="sgst_s[]" id="sgst_6">
	<input type="hidden" name="igst_s[]" id="igst_6">
	<input type="hidden" name="netamount_s[]" id="netamount_6">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_6">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_6">
	<input type="hidden" name="i_val[]" id="i_val_6">
	<input type="hidden" name="shop[]" id="shop_6">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_7">
	<input type="hidden" name="quantity_s[]" id="quantity_7">
	<input type="hidden" name="rate_s[]" id="rate_7">
	<input type="hidden" name="amount_s[]" id="amount_7">
	<input type="hidden" name="cgst_s[]" id="cgst_7">
	<input type="hidden" name="sgst_s[]" id="sgst_7">
	<input type="hidden" name="igst_s[]" id="igst_7">
	<input type="hidden" name="netamount_s[]" id="netamount_7">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_7">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_7">
	<input type="hidden" name="i_val[]" id="i_val_7">
	<input type="hidden" name="shop[]" id="shop_7">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_8">
	<input type="hidden" name="quantity_s[]" id="quantity_8">
	<input type="hidden" name="rate_s[]" id="rate_8">
	<input type="hidden" name="amount_s[]" id="amount_8">
	<input type="hidden" name="cgst_s[]" id="cgst_8">
	<input type="hidden" name="sgst_s[]" id="sgst_8">
	<input type="hidden" name="igst_s[]" id="igst_8">
	<input type="hidden" name="netamount_s[]" id="netamount_8">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_8">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_8">
	<input type="hidden" name="i_val[]" id="i_val_8">
	<input type="hidden" name="shop[]" id="shop_8">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_9">
	<input type="hidden" name="quantity_s[]" id="quantity_9">
	<input type="hidden" name="rate_s[]" id="rate_9">
	<input type="hidden" name="amount_s[]" id="amount_9">
	<input type="hidden" name="cgst_s[]" id="cgst_9">
	<input type="hidden" name="sgst_s[]" id="sgst_9">
	<input type="hidden" name="igst_s[]" id="igst_9">
	<input type="hidden" name="netamount_s[]" id="netamount_9">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_9">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_9">
	<input type="hidden" name="i_val[]" id="i_val_9">
	<input type="hidden" name="shop[]" id="shop_9">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_10">
	<input type="hidden" name="quantity_s[]" id="quantity_10">
	<input type="hidden" name="rate_s[]" id="rate_10">
	<input type="hidden" name="amount_s[]" id="amount_10">
	<input type="hidden" name="cgst_s[]" id="cgst_10">
	<input type="hidden" name="sgst_s[]" id="sgst_10">
	<input type="hidden" name="igst_s[]" id="igst_10">
	<input type="hidden" name="netamount_s[]" id="netamount_10">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_10">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_10">
	<input type="hidden" name="i_val[]" id="i_val_10">
	<input type="hidden" name="shop[]" id="shop_10">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_11">
	<input type="hidden" name="quantity_s[]" id="quantity_11">
	<input type="hidden" name="rate_s[]" id="rate_11">
	<input type="hidden" name="amount_s[]" id="amount_11">
	<input type="hidden" name="cgst_s[]" id="cgst_11">
	<input type="hidden" name="sgst_s[]" id="sgst_11">
	<input type="hidden" name="igst_s[]" id="igst_11">
	<input type="hidden" name="netamount_s[]" id="netamount_11">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_11">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_11">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_12">
	<input type="hidden" name="quantity_s[]" id="quantity_12">
	<input type="hidden" name="rate_s[]" id="rate_12">
	<input type="hidden" name="amount_s[]" id="amount_12">
	<input type="hidden" name="cgst_s[]" id="cgst_12">
	<input type="hidden" name="sgst_s[]" id="sgst_12">
	<input type="hidden" name="igst_s[]" id="igst_12">
	<input type="hidden" name="netamount_s[]" id="netamount_12">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_12">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_12">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_13">
	<input type="hidden" name="quantity_s[]" id="quantity_13">
	<input type="hidden" name="rate_s[]" id="rate_13">
	<input type="hidden" name="amount_s[]" id="amount_13">
	<input type="hidden" name="cgst_s[]" id="cgst_13">
	<input type="hidden" name="sgst_s[]" id="sgst_13">
	<input type="hidden" name="igst_s[]" id="igst_13">
	<input type="hidden" name="netamount_s[]" id="netamount_13">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_13">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_13">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_14">
	<input type="hidden" name="quantity_s[]" id="quantity_14">
	<input type="hidden" name="rate_s[]" id="rate_14">
	<input type="hidden" name="amount_s[]" id="amount_14">
	<input type="hidden" name="cgst_s[]" id="cgst_14">
	<input type="hidden" name="sgst_s[]" id="sgst_14">
	<input type="hidden" name="igst_s[]" id="igst_14">
	<input type="hidden" name="netamount_s[]" id="netamount_14">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_14">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_14">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_15">
	<input type="hidden" name="quantity_s[]" id="quantity_15">
	<input type="hidden" name="rate_s[]" id="rate_15">
	<input type="hidden" name="amount_s[]" id="amount_15">
	<input type="hidden" name="cgst_s[]" id="cgst_15">
	<input type="hidden" name="sgst_s[]" id="sgst_15">
	<input type="hidden" name="igst_s[]" id="igst_15">
	<input type="hidden" name="netamount_s[]" id="netamount_15">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_15">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_15">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_16">
	<input type="hidden" name="quantity_s[]" id="quantity_16">
	<input type="hidden" name="rate_s[]" id="rate_16">
	<input type="hidden" name="amount_s[]" id="amount_16">
	<input type="hidden" name="cgst_s[]" id="cgst_16">
	<input type="hidden" name="sgst_s[]" id="sgst_16">
	<input type="hidden" name="igst_s[]" id="igst_16">
	<input type="hidden" name="netamount_s[]" id="netamount_16">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_16">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_16">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_17">
	<input type="hidden" name="quantity_s[]" id="quantity_17">
	<input type="hidden" name="rate_s[]" id="rate_17">
	<input type="hidden" name="amount_s[]" id="amount_17">
	<input type="hidden" name="cgst_s[]" id="cgst_17">
	<input type="hidden" name="sgst_s[]" id="sgst_17">
	<input type="hidden" name="igst_s[]" id="igst_17">
	<input type="hidden" name="netamount_s[]" id="netamount_17">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_17">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_17">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_18">
	<input type="hidden" name="quantity_s[]" id="quantity_18">
	<input type="hidden" name="rate_s[]" id="rate_18">
	<input type="hidden" name="amount_s[]" id="amount_18">
	<input type="hidden" name="cgst_s[]" id="cgst_18">
	<input type="hidden" name="sgst_s[]" id="sgst_18">
	<input type="hidden" name="igst_s[]" id="igst_18">
	<input type="hidden" name="netamount_s[]" id="netamount_18">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_18">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_18">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_19">
	<input type="hidden" name="quantity_s[]" id="quantity_19">
	<input type="hidden" name="rate_s[]" id="rate_19">
	<input type="hidden" name="amount_s[]" id="amount_19">
	<input type="hidden" name="cgst_s[]" id="cgst_19">
	<input type="hidden" name="sgst_s[]" id="sgst_19">
	<input type="hidden" name="igst_s[]" id="igst_19">
	<input type="hidden" name="netamount_s[]" id="netamount_19">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_19">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_19">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_20">
	<input type="hidden" name="quantity_s[]" id="quantity_20">
	<input type="hidden" name="rate_s[]" id="rate_20">
	<input type="hidden" name="amount_s[]" id="amount_20">
	<input type="hidden" name="cgst_s[]" id="cgst_20">
	<input type="hidden" name="sgst_s[]" id="sgst_20">
	<input type="hidden" name="igst_s[]" id="igst_20">
	<input type="hidden" name="netamount_s[]" id="netamount_20">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_20">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_20">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_21">
	<input type="hidden" name="quantity_s[]" id="quantity_21">
	<input type="hidden" name="rate_s[]" id="rate_21">
	<input type="hidden" name="amount_s[]" id="amount_21">
	<input type="hidden" name="cgst_s[]" id="cgst_21">
	<input type="hidden" name="sgst_s[]" id="sgst_21">
	<input type="hidden" name="igst_s[]" id="igst_21">
	<input type="hidden" name="netamount_s[]" id="netamount_21">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_21">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_21">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_22">
	<input type="hidden" name="quantity_s[]" id="quantity_22">
	<input type="hidden" name="rate_s[]" id="rate_22">
	<input type="hidden" name="amount_s[]" id="amount_22">
	<input type="hidden" name="cgst_s[]" id="cgst_22">
	<input type="hidden" name="sgst_s[]" id="sgst_22">
	<input type="hidden" name="igst_s[]" id="igst_22">
	<input type="hidden" name="netamount_s[]" id="netamount_22">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_22">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_22">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_23">
	<input type="hidden" name="quantity_s[]" id="quantity_23">
	<input type="hidden" name="rate_s[]" id="rate_23">
	<input type="hidden" name="amount_s[]" id="amount_23">
	<input type="hidden" name="cgst_s[]" id="cgst_23">
	<input type="hidden" name="sgst_s[]" id="sgst_23">
	<input type="hidden" name="igst_s[]" id="igst_23">
	<input type="hidden" name="netamount_s[]" id="netamount_23">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_23">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_23">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_24">
	<input type="hidden" name="quantity_s[]" id="quantity_24">
	<input type="hidden" name="rate_s[]" id="rate_24">
	<input type="hidden" name="amount_s[]" id="amount_24">
	<input type="hidden" name="cgst_s[]" id="cgst_24">
	<input type="hidden" name="sgst_s[]" id="sgst_24">
	<input type="hidden" name="igst_s[]" id="igst_24">
	<input type="hidden" name="netamount_s[]" id="netamount_24">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_24">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_24">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_25">
	<input type="hidden" name="quantity_s[]" id="quantity_25">
	<input type="hidden" name="rate_s[]" id="rate_25">
	<input type="hidden" name="amount_s[]" id="amount_25">
	<input type="hidden" name="cgst_s[]" id="cgst_25">
	<input type="hidden" name="sgst_s[]" id="sgst_25">
	<input type="hidden" name="igst_s[]" id="igst_25">
	<input type="hidden" name="netamount_s[]" id="netamount_25">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_25">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_25">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_26">
	<input type="hidden" name="quantity_s[]" id="quantity_26">
	<input type="hidden" name="rate_s[]" id="rate_26">
	<input type="hidden" name="amount_s[]" id="amount_26">
	<input type="hidden" name="cgst_s[]" id="cgst_26">
	<input type="hidden" name="sgst_s[]" id="sgst_26">
	<input type="hidden" name="igst_s[]" id="igst_26">
	<input type="hidden" name="netamount_s[]" id="netamount_26">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_26">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_26">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_27">
	<input type="hidden" name="quantity_s[]" id="quantity_27">
	<input type="hidden" name="rate_s[]" id="rate_27">
	<input type="hidden" name="amount_s[]" id="amount_27">
	<input type="hidden" name="cgst_s[]" id="cgst_27">
	<input type="hidden" name="sgst_s[]" id="sgst_27">
	<input type="hidden" name="igst_s[]" id="igst_27">
	<input type="hidden" name="netamount_s[]" id="netamount_27">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_27">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_27">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_28">
	<input type="hidden" name="quantity_s[]" id="quantity_28">
	<input type="hidden" name="rate_s[]" id="rate_28">
	<input type="hidden" name="amount_s[]" id="amount_28">
	<input type="hidden" name="cgst_s[]" id="cgst_28">
	<input type="hidden" name="sgst_s[]" id="sgst_28">
	<input type="hidden" name="igst_s[]" id="igst_28">
	<input type="hidden" name="netamount_s[]" id="netamount_28">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_28">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_28">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_29">
	<input type="hidden" name="quantity_s[]" id="quantity_29">
	<input type="hidden" name="rate_s[]" id="rate_29">
	<input type="hidden" name="amount_s[]" id="amount_29">
	<input type="hidden" name="cgst_s[]" id="cgst_29">
	<input type="hidden" name="sgst_s[]" id="sgst_29">
	<input type="hidden" name="igst_s[]" id="igst_29">
	<input type="hidden" name="netamount_s[]" id="netamount_29">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_29">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_29">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_30">
	<input type="hidden" name="quantity_s[]" id="quantity_30">
	<input type="hidden" name="rate_s[]" id="rate_30">
	<input type="hidden" name="amount_s[]" id="amount_30">
	<input type="hidden" name="cgst_s[]" id="cgst_30">
	<input type="hidden" name="sgst_s[]" id="sgst_30">
	<input type="hidden" name="igst_s[]" id="igst_30">
	<input type="hidden" name="netamount_s[]" id="netamount_30">
	<input type="hidden" name="ori_rate_s[]" id="ori_rate_30">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_30">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_31">
	<input type="hidden" name="quantity_s[]" id="quantity_31">
	<input type="hidden" name="rate_s[]" id="rate_31">
	<input type="hidden" name="amount_s[]" id="amount_31">
	<input type="hidden" name="cgst_s[]" id="cgst_31">
	<input type="hidden" name="sgst_s[]" id="sgst_31">
	<input type="hidden" name="igst_s[]" id="igst_31">
	<input type="hidden" name="netamount_s[]" id="netamount_31">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_31">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_32">
	<input type="hidden" name="quantity_s[]" id="quantity_32">
	<input type="hidden" name="rate_s[]" id="rate_32">
	<input type="hidden" name="amount_s[]" id="amount_32">
	<input type="hidden" name="cgst_s[]" id="cgst_32">
	<input type="hidden" name="sgst_s[]" id="sgst_32">
	<input type="hidden" name="igst_s[]" id="igst_32">
	<input type="hidden" name="netamount_s[]" id="netamount_32">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_32">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_33">
	<input type="hidden" name="quantity_s[]" id="quantity_33">
	<input type="hidden" name="rate_s[]" id="rate_33">
	<input type="hidden" name="amount_s[]" id="amount_33">
	<input type="hidden" name="cgst_s[]" id="cgst_33">
	<input type="hidden" name="sgst_s[]" id="sgst_33">
	<input type="hidden" name="igst_s[]" id="igst_33">
	<input type="hidden" name="netamount_s[]" id="netamount_33">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_33">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_34">
	<input type="hidden" name="quantity_s[]" id="quantity_34">
	<input type="hidden" name="rate_s[]" id="rate_34">
	<input type="hidden" name="amount_s[]" id="amount_34">
	<input type="hidden" name="cgst_s[]" id="cgst_34">
	<input type="hidden" name="sgst_s[]" id="sgst_34">
	<input type="hidden" name="igst_s[]" id="igst_34">
	<input type="hidden" name="netamount_s[]" id="netamount_34">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_34">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_35">
	<input type="hidden" name="quantity_s[]" id="quantity_35">
	<input type="hidden" name="rate_s[]" id="rate_35">
	<input type="hidden" name="amount_s[]" id="amount_35">
	<input type="hidden" name="cgst_s[]" id="cgst_35">
	<input type="hidden" name="sgst_s[]" id="sgst_35">
	<input type="hidden" name="igst_s[]" id="igst_35">
	<input type="hidden" name="netamount_s[]" id="netamount_35">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_35">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_36">
	<input type="hidden" name="quantity_s[]" id="quantity_36">
	<input type="hidden" name="rate_s[]" id="rate_36">
	<input type="hidden" name="amount_s[]" id="amount_36">
	<input type="hidden" name="cgst_s[]" id="cgst_36">
	<input type="hidden" name="sgst_s[]" id="sgst_36">
	<input type="hidden" name="igst_s[]" id="igst_36">
	<input type="hidden" name="netamount_s[]" id="netamount_36">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_36">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_37">
	<input type="hidden" name="quantity_s[]" id="quantity_37">
	<input type="hidden" name="rate_s[]" id="rate_37">
	<input type="hidden" name="amount_s[]" id="amount_37">
	<input type="hidden" name="cgst_s[]" id="cgst_37">
	<input type="hidden" name="sgst_s[]" id="sgst_37">
	<input type="hidden" name="igst_s[]" id="igst_37">
	<input type="hidden" name="netamount_s[]" id="netamount_37">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_37">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_38">
	<input type="hidden" name="quantity_s[]" id="quantity_38">
	<input type="hidden" name="rate_s[]" id="rate_38">
	<input type="hidden" name="amount_s[]" id="amount_38">
	<input type="hidden" name="cgst_s[]" id="cgst_38">
	<input type="hidden" name="sgst_s[]" id="sgst_38">
	<input type="hidden" name="igst_s[]" id="igst_38">
	<input type="hidden" name="netamount_s[]" id="netamount_38">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_38">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_39">
	<input type="hidden" name="quantity_s[]" id="quantity_39">
	<input type="hidden" name="rate_s[]" id="rate_39">
	<input type="hidden" name="amount_s[]" id="amount_39">
	<input type="hidden" name="cgst_s[]" id="cgst_39">
	<input type="hidden" name="sgst_s[]" id="sgst_39">
	<input type="hidden" name="igst_s[]" id="igst_39">
	<input type="hidden" name="netamount_s[]" id="netamount_39">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_39">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_40">
	<input type="hidden" name="quantity_s[]" id="quantity_40">
	<input type="hidden" name="rate_s[]" id="rate_40">
	<input type="hidden" name="amount_s[]" id="amount_40">
	<input type="hidden" name="cgst_s[]" id="cgst_40">
	<input type="hidden" name="sgst_s[]" id="sgst_40">
	<input type="hidden" name="igst_s[]" id="igst_40">
	<input type="hidden" name="netamount_s[]" id="netamount_40">
	<input type="hidden" name="prod_discount_s[]" id="prod_dis_40">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_41">
	<input type="hidden" name="quantity_s[]" id="quantity_41">
	<input type="hidden" name="rate_s[]" id="rate_41">
	<input type="hidden" name="amount_s[]" id="amount_41">
	<input type="hidden" name="cgst_s[]" id="cgst_41">
	<input type="hidden" name="sgst_s[]" id="sgst_41">
	<input type="hidden" name="igst_s[]" id="igst_41">
	<input type="hidden" name="netamount_s[]" id="netamount_41">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_42">
	<input type="hidden" name="quantity_s[]" id="quantity_42">
	<input type="hidden" name="rate_s[]" id="rate_42">
	<input type="hidden" name="amount_s[]" id="amount_42">
	<input type="hidden" name="cgst_s[]" id="cgst_42">
	<input type="hidden" name="sgst_s[]" id="sgst_42">
	<input type="hidden" name="igst_s[]" id="igst_42">
	<input type="hidden" name="netamount_s[]" id="netamount_42">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_43">
	<input type="hidden" name="quantity_s[]" id="quantity_43">
	<input type="hidden" name="rate_s[]" id="rate_43">
	<input type="hidden" name="amount_s[]" id="amount_43">
	<input type="hidden" name="cgst_s[]" id="cgst_43">
	<input type="hidden" name="sgst_s[]" id="sgst_43">
	<input type="hidden" name="igst_s[]" id="igst_43">
	<input type="hidden" name="netamount_s[]" id="netamount_43">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_44">
	<input type="hidden" name="quantity_s[]" id="quantity_44">
	<input type="hidden" name="rate_s[]" id="rate_44">
	<input type="hidden" name="amount_s[]" id="amount_44">
	<input type="hidden" name="cgst_s[]" id="cgst_44">
	<input type="hidden" name="sgst_s[]" id="sgst_44">
	<input type="hidden" name="igst_s[]" id="igst_44">
	<input type="hidden" name="netamount_s[]" id="netamount_44">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_45">
	<input type="hidden" name="quantity_s[]" id="quantity_45">
	<input type="hidden" name="rate_s[]" id="rate_45">
	<input type="hidden" name="amount_s[]" id="amount_45">
	<input type="hidden" name="cgst_s[]" id="cgst_45">
	<input type="hidden" name="sgst_s[]" id="sgst_45">
	<input type="hidden" name="igst_s[]" id="igst_45">
	<input type="hidden" name="netamount_s[]" id="netamount_45">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_46">
	<input type="hidden" name="quantity_s[]" id="quantity_46">
	<input type="hidden" name="rate_s[]" id="rate_46">
	<input type="hidden" name="amount_s[]" id="amount_46">
	<input type="hidden" name="cgst_s[]" id="cgst_46">
	<input type="hidden" name="sgst_s[]" id="sgst_46">
	<input type="hidden" name="igst_s[]" id="igst_46">
	<input type="hidden" name="netamount_s[]" id="netamount_46">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_47">
	<input type="hidden" name="quantity_s[]" id="quantity_47">
	<input type="hidden" name="rate_s[]" id="rate_47">
	<input type="hidden" name="amount_s[]" id="amount_47">
	<input type="hidden" name="cgst_s[]" id="cgst_47">
	<input type="hidden" name="sgst_s[]" id="sgst_47">
	<input type="hidden" name="igst_s[]" id="igst_47">
	<input type="hidden" name="netamount_s[]" id="netamount_47">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_48">
	<input type="hidden" name="quantity_s[]" id="quantity_48">
	<input type="hidden" name="rate_s[]" id="rate_48">
	<input type="hidden" name="amount_s[]" id="amount_48">
	<input type="hidden" name="cgst_s[]" id="cgst_48">
	<input type="hidden" name="sgst_s[]" id="sgst_48">
	<input type="hidden" name="igst_s[]" id="igst_48">
	<input type="hidden" name="netamount_s[]" id="netamount_48">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_49">
	<input type="hidden" name="quantity_s[]" id="quantity_49">
	<input type="hidden" name="rate_s[]" id="rate_49">
	<input type="hidden" name="amount_s[]" id="amount_49">
	<input type="hidden" name="cgst_s[]" id="cgst_49">
	<input type="hidden" name="sgst_s[]" id="sgst_49">
	<input type="hidden" name="igst_s[]" id="igst_49">
	<input type="hidden" name="netamount_s[]" id="netamount_49">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_50">
	<input type="hidden" name="quantity_s[]" id="quantity_50">
	<input type="hidden" name="rate_s[]" id="rate_50">
	<input type="hidden" name="amount_s[]" id="amount_50">
	<input type="hidden" name="cgst_s[]" id="cgst_50">
	<input type="hidden" name="sgst_s[]" id="sgst_50">
	<input type="hidden" name="igst_s[]" id="igst_50">
	<input type="hidden" name="netamount_s[]" id="netamount_50">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_51">
	<input type="hidden" name="quantity_s[]" id="quantity_51">
	<input type="hidden" name="rate_s[]" id="rate_51">
	<input type="hidden" name="amount_s[]" id="amount_51">
	<input type="hidden" name="cgst_s[]" id="cgst_51">
	<input type="hidden" name="sgst_s[]" id="sgst_51">
	<input type="hidden" name="igst_s[]" id="igst_51">
	<input type="hidden" name="netamount_s[]" id="netamount_51">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_52">
	<input type="hidden" name="quantity_s[]" id="quantity_52">
	<input type="hidden" name="rate_s[]" id="rate_52">
	<input type="hidden" name="amount_s[]" id="amount_52">
	<input type="hidden" name="cgst_s[]" id="cgst_52">
	<input type="hidden" name="sgst_s[]" id="sgst_52">
	<input type="hidden" name="igst_s[]" id="igst_52">
	<input type="hidden" name="netamount_s[]" id="netamount_52">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_53">
	<input type="hidden" name="quantity_s[]" id="quantity_53">
	<input type="hidden" name="rate_s[]" id="rate_53">
	<input type="hidden" name="amount_s[]" id="amount_53">
	<input type="hidden" name="cgst_s[]" id="cgst_53">
	<input type="hidden" name="sgst_s[]" id="sgst_53">
	<input type="hidden" name="igst_s[]" id="igst_53">
	<input type="hidden" name="netamount_s[]" id="netamount_53">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_54">
	<input type="hidden" name="quantity_s[]" id="quantity_54">
	<input type="hidden" name="rate_s[]" id="rate_54">
	<input type="hidden" name="amount_s[]" id="amount_54">
	<input type="hidden" name="cgst_s[]" id="cgst_54">
	<input type="hidden" name="sgst_s[]" id="sgst_54">
	<input type="hidden" name="igst_s[]" id="igst_54">
	<input type="hidden" name="netamount_s[]" id="netamount_54">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_55">
	<input type="hidden" name="quantity_s[]" id="quantity_55">
	<input type="hidden" name="rate_s[]" id="rate_55">
	<input type="hidden" name="amount_s[]" id="amount_55">
	<input type="hidden" name="cgst_s[]" id="cgst_55">
	<input type="hidden" name="sgst_s[]" id="sgst_55">
	<input type="hidden" name="igst_s[]" id="igst_55">
	<input type="hidden" name="netamount_s[]" id="netamount_55">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_56">
	<input type="hidden" name="quantity_s[]" id="quantity_56">
	<input type="hidden" name="rate_s[]" id="rate_56">
	<input type="hidden" name="amount_s[]" id="amount_56">
	<input type="hidden" name="cgst_s[]" id="cgst_56">
	<input type="hidden" name="sgst_s[]" id="sgst_56">
	<input type="hidden" name="igst_s[]" id="igst_56">
	<input type="hidden" name="netamount_s[]" id="netamount_56">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_57">
	<input type="hidden" name="quantity_s[]" id="quantity_57">
	<input type="hidden" name="rate_s[]" id="rate_57">
	<input type="hidden" name="amount_s[]" id="amount_57">
	<input type="hidden" name="cgst_s[]" id="cgst_57">
	<input type="hidden" name="sgst_s[]" id="sgst_57">
	<input type="hidden" name="igst_s[]" id="igst_57">
	<input type="hidden" name="netamount_s[]" id="netamount_57">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_58">
	<input type="hidden" name="quantity_s[]" id="quantity_58">
	<input type="hidden" name="rate_s[]" id="rate_58">
	<input type="hidden" name="amount_s[]" id="amount_58">
	<input type="hidden" name="cgst_s[]" id="cgst_58">
	<input type="hidden" name="sgst_s[]" id="sgst_58">
	<input type="hidden" name="igst_s[]" id="igst_58">
	<input type="hidden" name="netamount_s[]" id="netamount_58">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_59">
	<input type="hidden" name="quantity_s[]" id="quantity_59">
	<input type="hidden" name="rate_s[]" id="rate_59">
	<input type="hidden" name="amount_s[]" id="amount_59">
	<input type="hidden" name="cgst_s[]" id="cgst_59">
	<input type="hidden" name="sgst_s[]" id="sgst_59">
	<input type="hidden" name="igst_s[]" id="igst_59">
	<input type="hidden" name="netamount_s[]" id="netamount_59">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_60">
	<input type="hidden" name="quantity_s[]" id="quantity_60">
	<input type="hidden" name="rate_s[]" id="rate_60">
	<input type="hidden" name="amount_s[]" id="amount_60">
	<input type="hidden" name="cgst_s[]" id="cgst_60">
	<input type="hidden" name="sgst_s[]" id="sgst_60">
	<input type="hidden" name="igst_s[]" id="igst_60">
	<input type="hidden" name="netamount_s[]" id="netamount_60">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_61">
	<input type="hidden" name="quantity_s[]" id="quantity_61">
	<input type="hidden" name="rate_s[]" id="rate_61">
	<input type="hidden" name="amount_s[]" id="amount_61">
	<input type="hidden" name="cgst_s[]" id="cgst_61">
	<input type="hidden" name="sgst_s[]" id="sgst_61">
	<input type="hidden" name="igst_s[]" id="igst_61">
	<input type="hidden" name="netamount_s[]" id="netamount_61">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_62">
	<input type="hidden" name="quantity_s[]" id="quantity_62">
	<input type="hidden" name="rate_s[]" id="rate_62">
	<input type="hidden" name="amount_s[]" id="amount_62">
	<input type="hidden" name="cgst_s[]" id="cgst_62">
	<input type="hidden" name="sgst_s[]" id="sgst_62">
	<input type="hidden" name="igst_s[]" id="igst_62">
	<input type="hidden" name="netamount_s[]" id="netamount_62">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_63">
	<input type="hidden" name="quantity_s[]" id="quantity_63">
	<input type="hidden" name="rate_s[]" id="rate_63">
	<input type="hidden" name="amount_s[]" id="amount_63">
	<input type="hidden" name="cgst_s[]" id="cgst_63">
	<input type="hidden" name="sgst_s[]" id="sgst_63">
	<input type="hidden" name="igst_s[]" id="igst_63">
	<input type="hidden" name="netamount_s[]" id="netamount_63">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_64">
	<input type="hidden" name="quantity_s[]" id="quantity_64">
	<input type="hidden" name="rate_s[]" id="rate_64">
	<input type="hidden" name="amount_s[]" id="amount_64">
	<input type="hidden" name="cgst_s[]" id="cgst_64">
	<input type="hidden" name="sgst_s[]" id="sgst_64">
	<input type="hidden" name="igst_s[]" id="igst_64">
	<input type="hidden" name="netamount_s[]" id="netamount_64">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_65">
	<input type="hidden" name="quantity_s[]" id="quantity_65">
	<input type="hidden" name="rate_s[]" id="rate_65">
	<input type="hidden" name="amount_s[]" id="amount_65">
	<input type="hidden" name="cgst_s[]" id="cgst_65">
	<input type="hidden" name="sgst_s[]" id="sgst_65">
	<input type="hidden" name="igst_s[]" id="igst_65">
	<input type="hidden" name="netamount_s[]" id="netamount_65">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_66">
	<input type="hidden" name="quantity_s[]" id="quantity_66">
	<input type="hidden" name="rate_s[]" id="rate_66">
	<input type="hidden" name="amount_s[]" id="amount_66">
	<input type="hidden" name="cgst_s[]" id="cgst_66">
	<input type="hidden" name="sgst_s[]" id="sgst_66">
	<input type="hidden" name="igst_s[]" id="igst_66">
	<input type="hidden" name="netamount_s[]" id="netamount_66">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_67">
	<input type="hidden" name="quantity_s[]" id="quantity_67">
	<input type="hidden" name="rate_s[]" id="rate_67">
	<input type="hidden" name="amount_s[]" id="amount_67">
	<input type="hidden" name="cgst_s[]" id="cgst_67">
	<input type="hidden" name="sgst_s[]" id="sgst_67">
	<input type="hidden" name="igst_s[]" id="igst_67">
	<input type="hidden" name="netamount_s[]" id="netamount_67">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_68">
	<input type="hidden" name="quantity_s[]" id="quantity_68">
	<input type="hidden" name="rate_s[]" id="rate_68">
	<input type="hidden" name="amount_s[]" id="amount_68">
	<input type="hidden" name="cgst_s[]" id="cgst_68">
	<input type="hidden" name="sgst_s[]" id="sgst_68">
	<input type="hidden" name="igst_s[]" id="igst_68">
	<input type="hidden" name="netamount_s[]" id="netamount_68">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_69">
	<input type="hidden" name="quantity_s[]" id="quantity_69">
	<input type="hidden" name="rate_s[]" id="rate_69">
	<input type="hidden" name="amount_s[]" id="amount_69">
	<input type="hidden" name="cgst_s[]" id="cgst_69">
	<input type="hidden" name="sgst_s[]" id="sgst_69">
	<input type="hidden" name="igst_s[]" id="igst_69">
	<input type="hidden" name="netamount_s[]" id="netamount_69">
	</div>
	<div class="col-sm-12">     
	<input type="hidden" name="product_s[]" id="product_70">
	<input type="hidden" name="quantity_s[]" id="quantity_70">
	<input type="hidden" name="rate_s[]" id="rate_70">
	<input type="hidden" name="amount_s[]" id="amount_70">
	<input type="hidden" name="cgst_s[]" id="cgst_70">
	<input type="hidden" name="sgst_s[]" id="sgst_70">
	<input type="hidden" name="igst_s[]" id="igst_70">
	<input type="hidden" name="netamount_s[]" id="netamount_70">
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

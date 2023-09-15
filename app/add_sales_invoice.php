<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {
    $sale_order_no = $_REQUEST['sale_order_no'];
    $invoice_no = $_REQUEST['invoice_no'];
    $dc_no = $_REQUEST['dc_no'];
    $lead_id = $_REQUEST['lead_id'];
    $acctdate = $_REQUEST['acctdate'];
    $address = $_REQUEST['address'];
    $state = $_REQUEST['state'];
    $district = $_REQUEST['district'];
    $city = $_REQUEST['city'];
    $pincode = $_REQUEST['pincode'];
    $bill_amount = $_REQUEST['bill_amount'];
    $remark = $_REQUEST['remark'];
    $customer = $_REQUEST['customer'];
	$advance = $_REQUEST['advance'];
    $mode = $_REQUEST['mode'];
    $cheque_no = $_REQUEST['cheque_no'];
    $cheque_date = $_REQUEST['cheque_date'];
    
    

    $createdon = date("d-m-Y H:i:s A");
     $createdby = $_SESSION['usersessionid'];
    

        $insert_details = mysqli_query($con, "INSERT INTO `tbl_sales_invoice`(`Invoice_No`,`Dc_No`,`Sale_Order_Id`, `Lead_Id`, `Date`,  `Bill_Amount`, `Created_By`, `Created_On`,`Status`, `Remark`,`Customer_Id`) VALUES ('$invoice_no','$dc_no','$sale_order_no','$lead_id','$acctdate','$bill_amount','$createdby','$createdon','Active','$remark','$customer')");
		
		if($advance!='' || $advance!='0'){
			
			$insert_details = mysqli_query($con, "INSERT INTO `tbl_receipts`(`Lead_Id`, `Total_Amount`, `Payment_Mode`, `Cheque_No`, `Cheque_Date`, `Created_By`, `Created_On`, `Status`, `Date`, `Module`, `Remark`) VALUES ('$lead_id','$advance','$mode','$cheque_no','$cheque_date','$createdby','$createdon','Active','$acctdate','dc','$remark')");
			
		}

        if ($insert_details) {
            echo '<script type="text/javascript">
					window.location.replace("sales_invoice_report.php?step=suces");
					</script>';
        } else {
            echo '<script type="text/javascript">
					window.location.replace("sales_invoice_report.php?step=fail");
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
    <meta name="author" content="Gayathri.R.KKIT">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <style>
        .content-wrapper {
            padding: 0px 10px !important;
        }

        .panel-header,
        .panel-body {
            border: none !important;
        }

        .panel-body {
            overflow-x: inherit !important;
            min-height: 420px;
            padding: 34px 10px !important;

        }

        .row.panel.panel-primary {
            background: transparent !important;
            padding-top: 9px;
            min-width: 71px !important;
        }

        .panel-heading {
            margin-bottom: 0px !important;
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

        tr {
            border-bottom: 1px solid #dedede;
        }

        .nav-tabs-custom {
            background: transparent;
        }

        .panel-primary>.panel-heading {
            color: #000;
            background-color: #cccccc;
            border-color: #cccccc;
            font-weight: 500;
            font-style: inherit;
        }

        .panel-body {
            font-size: 16px !important;
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
	<script>
	
	function getdistrict(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'state_id=' + val,
				success: function(data) {
					$("#district-list").html(data);
					$('#groupNameTemp').selectpicker({});
				}
			});
		}

		function getcity(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'district_id=' + val,
				success: function(data) {
					$("#city-list").html(data);
					$('#branchcity').selectpicker({});
				}
			});
		}

		function getpin(val) {
			// alert(val);
			$.ajax({
				type: "POST",
				url: "get_district.php",
				data: 'pin_id=' + val,
				success: function(data) {
					$("#pin-list").html(data);
					$('#groupNameTemp').selectpicker({});
				}
			});
		}
		
		function get_sales(val) {
			 //alert(val);
			$.ajax({
				type: "POST",
				url: "get_sales_invoice.php",
				data: 'lead_id=' + val,
				success: function(data) {
					$("#sale-order").html(data);
					$('#state').selectpicker({});
					
				}
			});
		}
	
	</script>
	
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
                        <div class="col-lg-8 col-md-8"><b>Add Sales Invoice</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_sales_order.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Sales Invoice</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">
				<?php
                            $select_mid = mysqli_query($con, "select MAX(Id) as mid from tbl_sales_invoice WHERE Status='Active'");
                            $fetch_mid = mysqli_fetch_array($select_mid);
                            $mid = $fetch_mid['mid'];

                            $select_inv_no = mysqli_query($con, "select Invoice_No from tbl_sales_invoice WHERE Id='$mid'");
                            $fetch_inv_no = mysqli_fetch_array($select_inv_no);
                            $inv_no = $fetch_inv_no['Invoice_No'];

                            if ($inv_no == '' || $inv_no == 'NULL' || $inv_no == '0') {
                                $inv_no_1 = 1;
                            } else {
                                $inv_no_1 = $inv_no + 1;
                            }
                            ?>
                      <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Sales Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4"> 
                            <input type="text" id="form-field-1" value="<?php echo $inv_no_1; ?>" class="form-control limited" name="invoice_no" required>
                        </div>
                        </div>
                    <div class="form-group col-sm-12">
                      <label for="inputName" class="col-sm-2 control-label">Work Order No<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-md-4">
							<select class="form-control selectpicker" name="sale_order_no" id="sale_order_no" onChange="get_sales(this.value);" data-live-search="true" required>
								<option value="">Select lead no</option>
								<?php
								$select_GrpQry = mysqli_query($con, "select * from tbl_work_order where Status='Active'");
								while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
									$Lead_No = $fetch_GrpQry['Work_Order_No'];
									$id = $fetch_GrpQry['Id'];
								?>
									<option value="<?php echo $id; ?>"><?php echo $Lead_No; ?></option>
								<?php
								}
								?>
							</select>
						</div>
                        </div>
						<div id="sale-order"> </div>
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
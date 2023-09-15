<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {
    $Name = $_REQUEST['Name'];
    $Address_Line1 = $_REQUEST['Address_Line1'];
    $Address_Line2 = $_REQUEST['Address_Line2'];
    $Address_Line3 = $_REQUEST['Address_Line3'];
    $Address_Line4 = $_REQUEST['Address_Line4'];
    $State = $_REQUEST['State'];
    $Country = $_REQUEST['Country'];
    $Mobile_No1 = $_REQUEST['Mobile_No1'];
    $Mobile_No2 = $_REQUEST['Mobile_No2'];
    $Email_Id1 = $_REQUEST['Email_Id1'];
    $Email_Id2 = $_REQUEST['Email_Id2'];
    $LandLine_No1 = $_REQUEST['LandLine_No1'];
    $LandLine_No2 = $_REQUEST['LandLine_No2'];
    $Gst_No = $_REQUEST['Gst_No'];
    $Gst_Type = $_REQUEST['Gst_Type'];
    $Pan_No = $_REQUEST['Pan_No'];
    $ref_no = $_REQUEST['ref_no'];
    $unit_tag = $_REQUEST['unit_tag'];

    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];

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

    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];

    if ($customer_1 == 'new') {
        $insert_details = mysqli_query($con, "INSERT INTO `tbl_customer`(`Name`, `Address_Line1`, `Address_Line2`, `Address_Line3`, `Address_Line4`, `State`,`Country`, `Mobile_No1`, `Mobile_No2`,`Email_Id1`, `Email_Id2`, `LandLine_No1`,`LandLine_No2`,`Gst_No`, `Gst_Type`, `Pan_No`,`Created_On`,`Created_By`, `Status`) VALUES ('$Name','$Address_Line1','$Address_Line2','$Address_Line3','$Address_Line4','$State','$Country','$Mobile_No1','$Mobile_No2','$Email_Id1','$Email_Id2','$LandLine_No1','$LandLine_No2','$Gst_No','$Gst_Type','$Pan_No','$createdon','$createdby','$status')");

        $qry_cus = mysqli_query($con, "SELECT Max(Id) as mid FROM `tbl_customer` WHERE Status='Active'");
        $fetch_cus = mysqli_fetch_array($qry_cus);
        $customer = $fetch_cus['mid'];
    } else {

        $customer = $customer_1;
    }

    $product_s = array();
    $quantity_s = array();
    $rate_s = array();
    $amount_s = array();
    $cgst_s = array();
    $sgst_s = array();
    $igst_s = array();
    $netamount_s = array();
    $ori_rate_s = array();
    $prod_discount_s = array();
    $unit_bag = array();


    $product_s = $_REQUEST['product_s'];
    $quantity_s = $_REQUEST['quantity_s'];
    $rate_s = $_REQUEST['rate_s'];
    $amount_s = $_REQUEST['amount_s'];
    $cgst_s = $_REQUEST['cgst_s'];
    $sgst_s = $_REQUEST['sgst_s'];
    $igst_s = $_REQUEST['igst_s'];
    $netamount_s = $_REQUEST['netamount_s'];
    $ori_rate_s = $_REQUEST['ori_rate_s'];
    $prod_discount_s = $_REQUEST['prod_discount_s'];
    $unit_bag = $_REQUEST['unit_bag'];

    for ($i = 0; $i < sizeof($product_s); $i++) {

        $product_sd = $product_s[$i];
        $quantity_sd = $quantity_s[$i];
        $rate_sd = $rate_s[$i];
        $amount_sd = $amount_s[$i];
        $cgst_sd = $cgst_s[$i];
        $sgst_sd = $sgst_s[$i];
        $igst_sd = $igst_s[$i];
        $netamount_sd = $netamount_s[$i];
        $prod_discount_sd = $prod_discount_s[$i];
        $ori_rate_sd = $ori_rate_s[$i];

        $unit_bag_sd = $unit_bag[$i];
        if ($netamount_sd != 0) {
            if ($received_amount >= $net_total) {
                $Payment_Pending = "Yes";
            } else {
                $Payment_Pending = "No";
            }

            $insert_details = mysqli_query($con, "INSERT INTO `tbl_sales`(`Customer_Id`, `Date`, `Invoice_No`,`Dc_No`, `Product_Id`, `Quantity`, `Rate`, `Amount`, `Cgst`, `Sgst`, `Igst`, `Net_Amount`, `Total`, `Discount`, `Other_Charges`, `Net_Total`, `Created_On`, `Created_By`, `Status`,`Payment_Pending`,`Discount_Percent`,`Original_Product_Rate`,`Product_Discount`,`Unit_Bag`,`Unit_Tag`) VALUES ('$customer','$acctdate','$invoice_no','$dc_no','$product_sd','$quantity_sd','$rate_sd','$amount_sd','$cgst_sd','$sgst_sd','0','$netamount_sd','$total','$discount','$other_charge','$net_total','$createdon','$createdby','$status','$Payment_Pending','$discount_percent','$ori_rate_sd','$prod_discount_sd','$unit_bag_sd','$unit_tag')");
        }
    }

    if ($insert_details) {
        if ($mycheckbox == "Yes") {

            $insert_detail_receipt = mysqli_query($con, "INSERT INTO `tbl_receipts`(`Customer_Name`, `Date`, `Payment_Amount`,`Invoice_No_Purchase`,`Amount`,`Purchase_Wise_Amount`,`Mode_Of_Payment`,`Cash_Amount`, `Cheque_Amount`, `Card_Amount`, `Paytm_Amount`, `Googlepay_Amount`, `Card_No`, `Card_Bank_Name`, `Cheque_Bank_Name`,`Cheque_No`,`Cheque_Date`,`Created_On`,`Created_By`,`Status`, `Total_Received`, `Bill_Value`, `Paid_Amount`,`Reference_No`) VALUES ('$customer','$acctdate','$received_amount','$invoice_no','$Amount','$received_amount','$Mode_Of_Payment','$cash_amount','$cheque_amount','$card_amount','$paytm_amount','$googlepay_amount','$card_no_1','$card_bank_name','$cheque_bank_name','$cheque_no','$cheque_date','$createdon','$createdby','$status','$received_amount','$bill_value','$paid_amount','$ref_no')");
        }

        echo '<script type="text/javascript">
										window.open("receipt_print_sales2.php?inv_no=' . $invoice_no . '");
							</script>';
    } else {
        echo '<script type="text/javascript">
					window.location.replace("report_sales.php?step=fail");
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
            $.ajax({
                type: "POST",
                url: "get_available_quantity.php",
                data: 'product_id=' + product_id,
                success: function(data) {
                    $("#product_id").html(data);
                }
            });
        }


        function avail_check(val) {
            var available_qty = $("#avail_qty").val();

            if (parseFloat(val) > parseFloat(available_qty)) {
                alert("It's greater than the available quantity");
                $("#BTNSUBMIT").show();
            } else {
                $("#BTNSUBMIT").show();
            }
        }

        function new_customer(val) {

            if (val == 'new') {
                $("#new_customer").show();
            } else {
                $("#new_customer").hide();
            }
        }

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

        (function($) {
            // always strict mode on
            // cannot use undefined vars on strict mode
            "use strict";

            $(document).ready(function() {

                $(document).on('click', '#datagrid .add', function() {

                    var row = $(this).closest('tr');
                    var clone = row.clone();
                    var tr = clone.closest('tr');
                    tr.find('input[type=text]').val('');
                    $(this).closest('tr').after(clone);
                    var $span = $("#datagrid tr");
                    $span.attr('id', function(index) {
                        return 'row' + index;

                    });

                });


                $(document).on('click', '#datagrid .removeRow', function() {
                    if ($('#datagrid .add').length > 1) {
                        $(this).closest('tr').remove();
                    }

                });

            });

            var dropDown = "#dropdnw";
            var empName = ".name";

            $(document).on("change", (dropDown), function(e) {

                var value = $.trim($(this).val());

                //Change this line:
                //$(empName).val(value);
                //To:
                // $(this).closest('tr').find(empName).val(value);

            });

        })(jQuery);
    </script>


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
                                <a href="report_sales.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Sales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="inputName" class="col-sm-4 control-label">Customer<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-8" style="margin-left: 0px;">
                                <select class="form-control selectpicker" name="customer" id="customer" onchange="new_customer(this.value);" data-live-search="true" required>
                                    <option value="">Select Customer</option>
                                    <option value="new">New Customer</option>
                                    <?php
                                    $select_GrpQry = mysqli_query($con, "select * from tbl_customer WHERE Status='Active'");
                                    while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                        $Name = $fetch_GrpQry['Name'];
                                        $Id = $fetch_GrpQry['Id'];
                                    ?>
                                        <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="new_customer" style="display: none;">
                            <div class="form-group col-sm-12">
                                <label for="inputName" class="col-sm-2 control-label">Company Name</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Name">
                                </div>

                                <label for="inputName" class="col-sm-2 control-label">Company Address<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-md-4">
                                    <textarea class="form-control" rows="2" name="address" id="comment" required></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="inputName" class="col-sm-2 control-label">State<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-md-4">
                                    <select class="form-control selectpicker" name="state" id="state" onChange="getdistrict(this.value);" data-live-search="true" required>
                                        <option value="">Select State</option>
                                        <?php
                                        $select_GrpQry = mysqli_query($con, "select * from state");
                                        while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                            $state_name = $fetch_GrpQry['StateName'];
                                        ?>
                                            <option value="<?php echo $state_name; ?>"><?php echo $state_name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div id="district-list"></div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div id="city-list"></div>
                                <div id="pin-list"></div>
                            </div>

                            <div class="form-group col-sm-12">


                                <label for="inputName" class="col-sm-2 control-label">Mobile Number</label>
                                <div class="col-sm-4">
                                    <input type="text" name="Mobile_No1" class="form-control" placeholder="Mobile Number">
                                </div>
                                <label for="inputName" class="col-sm-2 control-label">GST No </label>
                                <div class="col-sm-4">
                                    <input type="text" name="Gst_No" class="form-control" placeholder="GST No">
                                </div>
                            </div>


                            <div class="form-group col-sm-12">


                                <label for="inputName" class="col-sm-2 control-label">Email Id</label>
                                <div class="col-sm-4">
                                    <input type="text" name="Email_Id1" class="form-control" placeholder="Email Id">
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <h4><b>Contact Person</b></h4>
                            </div>

                            <table id="datagrid" class="display table1" style="border-collapse: separate;">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th style="padding:0 10px;">Mobile</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <tbody id="dataTable">

                                    <tr id="row1">
                                        <td width="35%">
                                            <input type='text' name="contact_name[]" size="20" class="form-control name" value="" />

                                        </td>

                                        <td style="padding:0 10px;" width="35%">
                                            <input type='text' name="contact_mobile[]" size="20" class="form-control name" value="" />
                                        </td>
                                        <td width="35%">
                                            <input type='text' name="contact_email[]" size="20" class="form-control discount" value="" />
                                        </td>
                                        <td>
                                            <input type="button" name="addRow" class="btn btn-success add" style="margin:0 10px;" value='Add More' />
                                        </td>
                                        <td>
                                            <input type="button" name="removeRow" class="btn btn-danger removeRow" value='Delete' />
                                        </td>

                                    </tr>


                                </tbody>

                            </table>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="inputName" class="col-sm-4 control-label">Created Employee<font color="red">&nbsp;*&nbsp;</font></label>
                                    <div class="col-sm-8" style="margin-left: 0px;">
                                        <select class="form-control selectpicker" name="employee" id="employee" data-live-search="true" required>
                                            <option value="">Select Employee</option>

                                            <?php
                                            $select_GrpQry = mysqli_query($con, "select * from tbl_employee WHERE Status='Active'");
                                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                $Name = $fetch_GrpQry['Name'];
                                                $Id = $fetch_GrpQry['Id'];
                                            ?>
                                                <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="inputName" class="col-sm-4 control-label">Source<font color="red">&nbsp;*&nbsp;</font></label>
                                    <div class="col-sm-8" style="margin-left: 0px;">
                                        <select class="form-control selectpicker" name="source" id="source" data-live-search="true" required>
                                            <option value="">Select Source</option>

                                            <?php
                                            $select_GrpQry = mysqli_query($con, "select * from tbl_source WHERE Status='Active'");
                                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                $Name = $fetch_GrpQry['Name'];
                                                $Id = $fetch_GrpQry['Id'];
                                            ?>
                                                <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="inputName" class="col-sm-4 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-8">
                                <input class="form-control dp" value="<?php echo date('d-m-Y') . $acctopendate; ?>" placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>

                            </div>
                        </div>
                        <div class="form-group col-sm-4">

                            <label for="inputName" class="col-sm-4 control-label">Lead Id<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Lead Id" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="invoice_no" required>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.dp').datepicker({
                                        format: "dd-mm-yyyy",
                                        endDate: '+0d',
                                        autoclose: true
                                    });

                                    $('.dp').on('change', function() {
                                        $('.datepicker').hide();
                                    });
                                    $("#discount").val(0);
                                    $("#other_charge").val(0);
                                });
                            </script>

                        </div>


                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="inputName" class="col-sm-4 control-label"> Transferred To<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-sm-8" style="margin-left: 0px;">
                                    <select class="form-control selectpicker" name="employee_transfer" id="employee_transfer" data-live-search="true" required>
                                        <option value="">Select Employee</option>

                                        <?php
                                        $select_GrpQry = mysqli_query($con, "select * from tbl_employee WHERE Status='Active'");
                                        while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                            $Name = $fetch_GrpQry['Name'];
                                            $Id = $fetch_GrpQry['Id'];
                                        ?>
                                            <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-4">

                                <label for="inputName" class="col-sm-4 control-label">Current Outstanding</label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15">
                                </div>

                            </div>
                            <div class="col-md-12">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-striped" style="border:1px;">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <th>QTY</th>
                                                                <th>Rate</th>
                                                                <th>action</th>
                                                            </tr>
                                                            <tr>
                                                                <td><select class="form-control selectpicker" name="employee_transfer" id="employee_transfer" data-live-search="true" required>
                                                                        <option value="">Select Product</option>

                                                                        <?php
                                                                        $select_GrpQry = mysqli_query($con, "select * from tbl_customer_lead WHERE Status='Active'");
                                                                        while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                                            $Name = $fetch_GrpQry['Name'];
                                                                            $Id = $fetch_GrpQry['Id'];
                                                                        ?>
                                                                            <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select></td>
                                                                <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $Name; ?>" name="Igst" style="width:58%;"></td>
                                                                <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $Name; ?>" name="Cgst" style="width:58%;"></td>
                                                                <td>

                                                                    <button type="button" onclick="window.location.href='add_lead.php?id=<?php echo $fetch['id']; ?>'" class="btn btn-primary">Add More&nbsp;</button>

                                                                    <button type="button" class="btn btn-danger" onclick="window.location.href='add_lead.php?do=delete&id=<?php echo $fetch['id']; ?>'"><a style=" text-decoration: none; color:#FFF">Delete&nbsp;</a></button>

                                                                </td>

                                                            </tr>
                                                        </thead>
                                                    </table>

                                                </div><!-- /.row -->
                                </section><!-- /.content -->
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
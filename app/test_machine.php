<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {

    $customer = $_REQUEST['customer'];
    $invoice_no = $_REQUEST['invoice_no'];

    $gst_type = $_REQUEST['gst_type'];
    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];
    $date = date("d-m-Y");

    $e_id_qry = mysqli_query($con, "select * from tbl_users where Id='$sessionuserid'");
    $fetcheid = mysqli_fetch_array($e_id_qry);
    $type12 = $fetcheid['User_type'];
    $emp_id = $fetcheid['Emp_tbl_Id'];

    $machine_id = array();
    $quantity = array();
    $discount = array();

    $machine_id = $_REQUEST['empid'];
    $quantity = $_REQUEST['name'];
    $discount = $_REQUEST['discount'];
    $quantity_s = 0;
    for ($i = 0; $i < sizeof($machine_id); $i++) {

        $machine_id_s = $machine_id[$i];
        $quantity_s = $quantity[$i];
        $discount_s = $discount[$i];
        if ($quantity_s != 0) {
            $insert_details = mysqli_query($con, "INSERT INTO `tbl_invoice`(`Motor_Id`, `Motor_Quantity`, `Created_By`, `Created_On`, `Status`,`Date`,Employee_Id,Customer_Id,Invoice_No,`Motor_Discount`,`Gst_Type`) VALUES ('$machine_id_s','$quantity_s','$createdby','$createdon','$status','$date','$emp_id','$customer','$invoice_no','$discount_s','$gst_type')");
        }
    }
    if ($insert_details) {
        echo '<script type="text/javascript">
					window.location.replace("receipt_sales.php?inv_no=' . $invoice_no . '");
					</script>';
    } else {
        echo '<script type="text/javascript">
					window.location.replace("receipt_sales.php?inv_no=' . $invoice_no . '");
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
    <script>
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
            min-height: 800px;
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
                        <div class="col-lg-8 col-md-8"><b>Invoice Information</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="invoice_report.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Invoice Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                    <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="inputName" class="col-sm-5 control-label">Customer Name<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-sm-7" style="margin-left: 0px;">
                                    <select class="form-control selectpicker" name="customer" id="customer" data-live-search="true" required>
                                        <option value="">Select Customer</option>
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
                            <?php
                            $select_mid = mysqli_query($con, "select MAX(Id) as mid from tbl_invoice WHERE Status='Active'");
                            $fetch_mid = mysqli_fetch_array($select_mid);
                            $mid = $fetch_mid['mid'];

                            $select_inv_no = mysqli_query($con, "select Invoice_No from tbl_invoice WHERE Id='$mid'");
                            $fetch_inv_no = mysqli_fetch_array($select_inv_no);
                            $inv_no = $fetch_inv_no['Invoice_No'] + 1;

                            if ($inv_no == '' || $inv_no == 'NULL' || $inv_no == '1') {
                                $inv_no_1 = 5001;
                            } else {
                                $inv_no_1 = $inv_no;
                            }
                            ?>

                            <div class="form-group col-sm-6">
                                <label for="inputName" class="col-sm-4 control-label">Invoice No<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-sm-8" style="margin-left: 0px;">
                                    <input type="text" id="invoice_no" class="form-control limited" name="invoice_no" value="<?php echo $inv_no_1; ?>" required>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <table id="datagrid" class="display table1" style="border-collapse: separate;">
                            <thead>
                                <tr>
                                    <th>Machine Name</th>
                                    <th style="padding:0 10px;">Quantity</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>

                            <tbody id="dataTable">

                                <tr id="row1">
                                    <td width="40%">
                                        <select name="empid[]" class="form-control  dropdn" id="dropdnw" data-live-search="true">
                                            <option value="">Select machine</option>
                                            <?php
                                            $select_GrpQry = mysqli_query($con, "select * from tbl_machine WHERE Status='Active'");
                                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                $Name = $fetch_GrpQry['Name'];
                                                $Id = $fetch_GrpQry['Id'];
                                            ?>
                                                <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </td>

                                    <td style="padding:0 10px;">
                                        <input type='text' name="name[]" size="20" class="form-control name" value="" />
                                    </td>
                                    <td>
                                        <input type='text' name="discount[]" size="20" class="form-control discount" value="" />
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
                        </br>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputName" class="col-sm-2 control-label">GST Type<font color="red">&nbsp;*&nbsp;</font></label>
                                <div class="col-sm-6" style="margin-left: 0px;">
                                    <select class="form-control selectpicker" name="gst_type" id="gst_type" data-live-search="true" required>
                                        <option value="">Select GST Type</option>
                                        <option value="cgst"> CGST / SGST</option>
                                        <option value="igst">IGST</option>
                                        <option value="others">Others/None</option>
                                    </select>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>

                        </div>
                        <br>
                        <div class="col-sm-12">

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
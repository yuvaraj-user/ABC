<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {

    $Customer_Name = $_REQUEST['Customer_Name'];
    $Cont_Person = $_REQUEST['Cont_Person'];
    $Con_Number = $_REQUEST['Con_Number'];
    $Followup_Status = $_REQUEST['Followup_Status'];
    $Product_Name = $_REQUEST['Product_Name'];
    $Followup_Qty = $_REQUEST['Followup_Qty'];
    $Folowup_Rate = $_REQUEST['Folowup_Rate'];
    $Pro_Name = $_REQUEST['Pro_Name'];
    $Qty = $_REQUEST['Qty'];
    $Rate = $_REQUEST['Rate'];
    $GST = $_REQUEST['GST'];
    $GST_Amount = $_REQUEST['GST_Amount'];
    $NET_Amount = $_REQUEST['NET_Amount'];
    $Current_Outstanding = $_REQUEST['Current_Outstanding'];
    $Transfer_Lead = $_REQUEST['Transfer_Lead'];
    $Remarks = $_REQUEST['Remarks'];
    $id = $_REQUEST['Id'];

    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];

    $insert_details = mysqli_query($con, "UPDATE `tbl_followup` SET `Customer_Name`='$Customer_Name',`Cont_Person`='$Cont_Person', `Con_Number`='$Con_Number', `Followup_Status`='$Followup_Status', `Product_Name`='$Product_Name', `Followup_Qty`='$Followup_Qty', `Followup_Qty`='$Followup_Qty', `Folowup_Rate`='$Folowup_Rate', `Pro_Name`='$Pro_Name', `Qty`='$Qty', `Rate`='$Rate', `Amount`='$Amount', `GST`='$GST', `GST_Amount`='$GST_Amount', `NET_Amount`='$NET_Amount', `Current_Outstanding`='$Current_Outstanding', `Transfer_Lead`='$Transfer_Lead', `Remarks`='$Remarks' WHERE Id='$id'");

    if ($insert_details) {
        echo '<script type="text/javascript">
					window.location.replace("view_followup.php?step=edit");
					</script>';
    } else {
        echo '<script type="text/javascript">
					window.location.replace("view_followup.php?step=fail");
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
                        <div class="col-lg-8 col-md-8"><b>Edit Followup</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_followup.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Followup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Customer Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Customer Name" value="<?php echo $fetch['Customer_Name']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Customer_Name" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Cont Person<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Cont Person" value="<?php echo $fetch['Cont_Person']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Cont_Person" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Con Number<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Con Number" value="<?php echo $fetch['Con_Number']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Con_Number" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Followup Status<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" value="<?php echo $fetch['Followup_Status']; ?>" name="Followup_Status" id="customer" onchange="new_customer(this.value);" data-live-search="true" required>
                                <option value="">Won</option>
                                <option value="">Drop</option>
                                <option value="">Follow</option>
                                <!-- <?php
                                        $select_GrpQry = mysqli_query($con, "select * from tbl_followup WHERE Status='Active'");
                                        while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                            $Name = $fetch_GrpQry['Name'];
                                            $Id = $fetch_GrpQry['Id'];
                                        ?>
                                    <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                <?php
                                        }
                                ?> -->
                            </select>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Remarks<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" value="<?php echo $fetch['Remarks']; ?>" name="Remarks" id="comment" required></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group col-sm-12">
                        <h4><b>Product Name</b></h4>
                    </div> -->

                    <table id="datagrid" class="display table1" style="border-collapse: separate;">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th style="padding:0 10px;">Qty</th>
                                <th>Rate</th>
                            </tr>
                        </thead>

                        <tbody id="dataTable">

                            <tr id="row1">
                                <td style="padding:0 10px;" width="35%">
                                    <input type='text' name="Product_Name" value="<?php echo $fetch['Product_Name']; ?>" size="20" class="form-control name" />
                                </td>
                                <td width="35%">
                                    <input type='text' name="Followup_Qty" value="<?php echo $fetch['Followup_Qty']; ?>" size="20" class="form-control discount" />
                                </td>
                                <td width="35%">
                                    <input type='text' name="Folowup_Rate" value="<?php echo $fetch['Folowup_Rate']; ?>" size="20" class="form-control discount" />
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
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <th>GST</th>
                                                        <th>GST Amount</th>
                                                        <th>NET Amount</th>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['Pro_Name']; ?>" placeholder="Pro Nme" class="form-control limited" name="Pro_Name" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['Qty']; ?>" placeholder="Qty" class="form-control limited" name="Qty" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['Rate']; ?>" placeholder="Rate" class="form-control limited" name="Rate" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['Amount']; ?>" placeholder="Amount" class="form-control limited" name="Amount" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['GST	']; ?>" placeholder="GST" class="form-control limited" name="GST" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['GST_Amount']; ?>" placeholder="GST Amt" class="form-control limited" name="GST_Amount" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch['NET_Amount']; ?>" placeholder="NET Amt" class="form-control limited" name="NET_Amount" style="width:58%;"></td>
                                                    </tr>
                                                </thead>
                                            </table>

                                        </div><!-- /.row -->
                        </section><!-- /.content -->
                    </div>
                    <label for="inputName" class="col-sm-2 control-label">Current Outstanding<font color="red">&nbsp;*&nbsp;</font></label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Current_Outstanding" value="<?php echo $fetch['Current_Outstanding']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Current_Outstanding" required>
                    </div>
                    <label for="inputName" class="col-sm-2 control-label">Transfer Lead<font color="red">&nbsp;*&nbsp;</font></label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Transfer Lead" value="<?php echo $fetch['Transfer_Lead']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Transfer_Lead" required>
                    </div>

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
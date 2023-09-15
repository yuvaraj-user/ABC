<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {
    $Name = $_REQUEST['Name'];
    $Parent = $_REQUEST['Parent'];
    $Code = $_REQUEST['Code'];
    $Gst_App_Date = $_REQUEST['Gst_App_Date'];
    $Igst = $_REQUEST['Igst'];
    $Cgst = $_REQUEST['Cgst'];
    $Sgst = $_REQUEST['Sgst'];
    $Hsn_Code = $_REQUEST['Hsn_Code'];
    $Cost_App_Date = $_REQUEST['Cost_App_Date'];
    $Rate = $_REQUEST['Rate'];
    $Remarks = $_REQUEST['Remarks'];

    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];
    $query_aadh = "SELECT COUNT(Id) as Id FROM stock_item WHERE  Status='Active'";
    $query_aadh_res = mysqli_query($con, $query_aadh);
    $fetch_cnt = mysqli_fetch_array($query_aadh_res);

    if ($fetch_cnt['Id'] == 0) {

        $insert_details = mysqli_query($con, "INSERT INTO `stock_item`(`Name`, `Parent`, `Code`, `Gst_App_Date`, `Igst`, `Cgst`, `Sgst`, `Hsn_Code`,`Created_On`, `Created_By`, `Cost_App_Date`, `Rate`, `Remarks`, `Status`) VALUES ('$Name','$Parent', '$Code', '$Gst_App_Date', '$Igst', '$Cgst', '$Sgst', '$Hsn_Code', '$createdon','$createdby', '$Cost_App_Date', '$Rate', '$Remarks', 'Active')");

        if ($insert_details) {
            echo '<script type="text/javascript">
					window.location.replace("view_stock_item.php?step=suces");
					</script>';
        } else {
            echo '<script type="text/javascript">
					window.location.replace("view_stock_item.php?step=fail");
					</script>';
        }
    } else {
        echo '<script type="text/javascript">
					window.location.replace("view_stock_item.php?step=duplicate");
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
                        <div class="col-lg-8 col-md-8"><b>Add Stock Items</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_stock_item.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View lead Source</a>
                            </div>
                        </div>
                    </div>
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
                                                            <th>Source Name</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" name="Source_Name" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" name="Description" style="width:58%;"></td>
                                                        </tr>
                                                    </thead>
                                                </table>

                                            </div><!-- /.row -->
                            </section><!-- /.content -->
                        </div>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Name" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Description<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Description" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Code" required>
                        </div>
                        <div class="col-sm-12">
                        <br>
                        <div class="col-sm-6">
                            <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
                        </div>
                       
                    </div>
                       <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Name" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">City<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="City" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Code" required>
                        </div>
                        <div class="col-sm-12">
                        <br>
                        <div class="col-sm-6">
                            <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
                        </div>
                        
                    </div>
                        <label for="inputName" class="col-sm-2 control-label">City Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Name" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Name" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">City Pincode<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="City Pincode" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Code" required>
                        </div>
                        <div class="col-sm-12">
                        <br>
                        <div class="col-sm-6">
                            <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
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
                                                            <th>Name</th>
                                                            <th>Pincode</th>
															
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" name="Name" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" name="Pincode" style="width:58%;"></td>
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
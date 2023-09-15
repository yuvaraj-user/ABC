<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if (isset($_REQUEST['submit'])) {

    $Name = $_REQUEST['Name'];
    $parent = $_REQUEST['Parent'];
    $Code = $_REQUEST['Code'];
    $Gst_App_Date = $_REQUEST['Gst_App_Date'];
    $Igst = $_REQUEST['Igst'];
    $Cgst = $_REQUEST['Cgst'];
    $Sgst = $_REQUEST['Sgst'];
    $Hsn_Code = $_REQUEST['Hsn_Code'];
    $Cost_App_Date = $_REQUEST['Cost_App_Date'];
    $Rate = $_REQUEST['Rate'];
    $Remarks = $_REQUEST['Remarks'];
    $id = $_REQUEST['Id'];
    $category = $_REQUEST['category'];
    $status = "Active";
    $createdon = date("d-m-Y H:i:s A");
    $createdby = $_SESSION['usersessionid'];

    $insert_details = mysqli_query($con, "UPDATE `tbl_stock_item` SET `Name`='$Name',`Parent`='$parent', `Code`='$Code', `Gst_App_Date`='$Gst_App_Date', `Igst`='$Igst', `Cgst`='$Cgst', `Hsn_Code`='$Hsn_Code', `Cost_App_Date`='$Cost_App_Date', `Rate`='$Rate', `Remarks`='$Remarks',Category= $category' WHERE Id='$id'");

    if ($insert_details) {
        echo '<script type="text/javascript">
					window.location.replace("view_stock_item.php?step=edit");
					</script>';
    } else {
        echo '<script type="text/javascript">
					window.location.replace("view_stock_item.php?step=fail");
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
                        <div class="col-lg-8 col-md-8"><b>Edit Stock Item</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_stock_item.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;Stock Items View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $id = $_REQUEST['Id'];
            $qury = "SELECT * FROM `tbl_stock_item` WHERE Id='$id'";
            $qury_exe = mysqli_query($con, $qury);
            $fetch = mysqli_fetch_array($qury_exe);
            ?>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Name" maxlength="150" value="<?php echo $fetch['Name']; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="Name" required>
                        </div>
                          <label for="inputName" class="col-sm-2 control-label">Category<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" name="category" id="category" data-live-search="true" required>
								<option value="">Select Category</option>
								<option value="1" <?php echo ($fetch['Category']==1)?'selected':'' ?>>Standard</option>
								<option value="2" <?php echo ($fetch['Category']==2)?'selected':'' ?>>Non-Standard</option>
							</select>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Stock Group<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" name="parent" id="parent" data-live-search="true" required>
								<option value="">Select Stock Group</option>
								<?php
								$select_GrpQry = mysqli_query($con, "select * from tbl_stock_group");
								while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
									$state_name = $fetch_GrpQry['Name'];
									$id = $fetch_GrpQry['Id'];
								?>
									<option value="<?php echo $state_name; ?>" <?php echo ($state_name==$fetch['Parent'])?'selected':'' ?>><?php echo $state_name; ?></option>
								<?php
								}
								?>
							</select>
                        </div>
                        </div>
						<div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Code<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Code" maxlength="150" value="<?php echo $fetch['Code']; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="Code" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Remarks<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Remarks" maxlength="150" id="form-field-1" value="<?php echo $fetch['Remarks']; ?>" class="form-control limited" maxlength="15" name="Remarks" required>
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
                                                            <th>Gst_App_Date</th>
                                                            <th>IGST</th>
                                                            <th>CGST</th>
                                                            <th>SGST</th>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="date" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Gst_App_Date']; ?>" name="Gst_App_Date" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Igst']; ?>" name="Igst" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Cgst']; ?>" name="Cgst" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Sgst']; ?>" name="Sgst" style="width:58%;"></td>
                                                        </tr>
                                                    </thead>
                                                </table>

                                            </div><!-- /.row -->
                            </section><!-- /.content -->
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Hsn Code<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Hsn Code" maxlength="150" id="form-field-1" value="<?php echo $fetch['Hsn_Code']; ?>" class="form-control limited" maxlength="15" name="Hsn_Code" required>
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
                                                            <th>Cost App Date</th>
                                                            <th>Rate</th>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="date" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Gst_Rate']; ?>" name="Gst_Rate" style="width:58%;"></td>
                                                            <td><input type="text" id="form-field-1" class="form-control limited" value="<?php echo $fetch['Rate']; ?>" name="Rate" style="width:58%;"></td>
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
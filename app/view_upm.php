<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

$selectlevel = mysqli_query($con, "select * from tbl_users where Id='$sessionuserid'");
$fetchlevel = mysqli_fetch_array($selectlevel);

$add = $fetchlevel['Role_add'];
$edit = $fetchlevel['Edit'];
$ex_edit = explode(',', $edit);

$delete = $fetchlevel['Delete'];
$ex_del = explode(',', $delete);

$add = $fetchlevel['Role_add'];
$ex_add = explode(',', $add);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Billing</title>
  <meta name="author" content="Gayathri.R.KKIT">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script src="js/jquery-1.10.2.js"></script>


  <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">


  <!-- Theme style -->

  <script src="https://ajax.googleapis.con/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
      min-height: 350px;
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
    <?php include  'sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="row panel panel-primary">
        <?php
        $final = $_REQUEST['step'];
        if ($final == "suces") {
        ?>
          <div class="alert alert_msg alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Success!</strong> UOM are Added Successfully.
          </div>

        <?php
        } else if ($final == "edit") { ?>
          <div class="alert alert_msg alert-info alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Success !</strong> Updated Successfully.
          </div>
        <?php } else if ($final == "dbfail") { ?>
          <div class="alert alert_msg alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Error!</strong> Server Error.
          </div>
        <?php } else if ($final == "fail") { ?>
          <div class="alert alert_msg alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Failed!</strong> This Details Was Already Exist.
          </div>
        <?php } else if ($final == "delete") { ?>
          <div class="alert alert_msg alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Success!</strong> UOM are Removed Successfully.
          </div>
        <?php } else if ($final == "duplicate") { ?>
          <div class="alert alert_msg alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Failed!</strong> Duplicate Entry.
          </div>
        <?php }
        ?>
        <div class="panel-heading lead ">
          <div class="row">
            <div class="col-lg-8 col-md-8"><label>View UOM</label></div>
            <div class="col-lg-4 col-md-4 text-right">
              <a href="add_upm.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add UOM</a>
            </div>
          </div>
        </div>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>

                        <th>Decimal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $qury = "select * from tbl_uom where Status='Active'";
                      $qury_exe = mysqli_query($con, $qury);
                      $i = 1;
                      while ($fetch = mysqli_fetch_array($qury_exe)) {
                      ?>
                        <tr>
                          <td align="center"><?php echo $i; ?></td>
                          <td><?php echo $fetch['Name']; ?></td>

                          <td><?php echo $fetch['Decimal_UOM']; ?></td>
                          <td>

                            <button type="button" onclick="window.location.href='edit_upm.php?id=<?php echo $fetch['Id']; ?>'" class="btn btn-primary">Edit&nbsp;</button>

                            <button type="button" class="btn btn-danger" onclick="window.location.href='delete_upm.php?do=delete&id=<?php echo $fetch['Id']; ?>'"><a style=" text-decoration: none; color:#FFF">Delete&nbsp;</a></button>

                          </td>

                        </tr>
                      <?php $i++;
                      } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>

                </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  <!-- /.content-wrapper -->
  <!-- Footer Section-->
  <?php include 'footer.php'; ?>

  <!---  Control Sidebar  Section ->
<?php #include 'controlsidebar.php'; 
?>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- Bootstrap 3.3.5 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="plugins/input-mask/jquery.inputmask.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date-range-picker -->
  <script src="js/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.min.js"></script>
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example1').DataTable({

        "scrollX": true,
        "scrollY": 500,
        "scrollCollapse": true,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        stateSave: true,
        "buttons": [{
            extend: 'copyHtml5',
            title: 'UOM Report'
          },
          {
            extend: 'excelHtml5',
            title: 'UOM Report'
          },
          {
            extend: 'colvis',
            text: '<i class="fa fa-eye" aria-hidden="true"></i>',
            title: 'UOM Report'
          }
        ]



      });
    });
    $(document).ready(function() {
      setTimeout(function() {
        $(".alert_msg").hide();
      }, 3000);
    });
  </script>
</body>

</html>
<?php mysqli_close($con); ?>
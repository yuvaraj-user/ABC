<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Billing</title>
    <meta name="author" content="Manoj">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <script src="js/jquery-1.10.2.js"></script>
    <!--<script src="js/jquery.min.js"></script>-->
</head>
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

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content-wrapper">
            <?php
            $readrequest = $_REQUEST['do'];
            $readid = $_REQUEST['id'];

            if (isset($_REQUEST['remark'])) {

                $id = $_REQUEST['id'];
                $machine_status = $_REQUEST['machine_status'];
                $completed_date = $_REQUEST['completed_date'];
                $delay_reason = $_REQUEST['delay_reason'];
                $remark = $_REQUEST['remark'];
              
                $query_update_enable = "INSERT INTO `tbl_machine_status`(`order_id`, `completion_date`, `late_remark`, `delay_reason`, `remark`) VALUES ('$id','$completed_date','$remark','$delay_reason','$remark')"; 
                $passquery_update_enable = mysqli_query($con, $query_update_enable);
				
				$query_update_order = "update `tbl_order_creation` set machine_status='$machine_status' WHERE id='$readid'"; 
                $passquery_update_order = mysqli_query($con, $query_update_order);
                if ($passquery_update_enable) {
                    echo '<script type="text/javascript">
					window.location.replace("machine_status.php?step=suces");
					</script>';
                } else {
                    echo '<script type="text/javascript">
					window.location.replace("machine_status.php?step=fail");
					</script>';
                }
            }
            ?>

            <!-- Content Wrapper. Contains page content -->

            <div class="row panel panel-primary">
                <div class="panel-heading lead ">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">Status Updation</div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="report_order_creation.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;Machine Status Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                       <div class="col-sm-12 form-group">
                        
                         
						 <label for="inputEmail" class="col-sm-2 control-label">Machine Name</label>
                        <div class="col-sm-4">
                        <input type="text" name="accholdname" class="form-control" id="inputName" placeholder="Machine Code" disabled>
                        </div>
						<label for="inputEmail" class="col-sm-2 control-label">Machine Code</label>
                        <div class="col-sm-4">
                         <input type="text" name="accholdname" class="form-control" id="inputName" placeholder="Machine Code" disabled>
                        </div>
                        </div>	
						
						
					
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">PDN Points</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="PDN Points" name="PF_number" id="PF_number" disabled>
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Target Date</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Target Date" name="PF_number" id="PF_number" disabled>
                        </div> 
                        </div>
						
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Accessories</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Accessories" name="PF_number" id="PF_number" disabled>
                        </div> 
						
                        </div>
						
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Completed Status</label>
                        <div class="col-sm-4">
                          <select id="machine_status"  name="machine_status"  class="form-control  selectpicker" data-live-search="true">			
						<option value="">Select Completed</option>
						 
						<option value="1">Not Yet Start</option>
						<option value="2">On Going</option>
						<option value="3">Completed</option>
						<option value="4">Return</option>					            						
						</select>
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Completed Date</label>
                        
                         <div class="col-sm-4">
                          <input class="form-control dp1"   placeholder="dd-mm-yyyy"  onchange="agecalcualte(this.value)" id="dob_F" name="completed_date" required>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#dob_F').datepicker({
	
        format: "yyyy-mm-dd",
		endDate: '+0d',
        autoclose: true
	 });
    $('.dp1').on('change', function () {
        $('.datepicker').hide();
    });

	});
</script>
						
                        </div>

                       

						<div class="col-sm-12 form-group">
						<label for="inputName" class="col-sm-2 control-label">Reason for Delay</label>
                        <div class="col-sm-4">
                         <input type="text" class="form-control "   placeholder="" name="delay_reason" id="PF_number">
                        </div>
						 <label for="inputName" class="col-sm-2 control-label">Remark</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="" name="remark" id="PF_number">
                        </div> 

                        </div>

						
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="submit" name="remark" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->


            <!-- /.content -->
        </div><!-- /.content-wrapper -->
    </div>
    <!-- start footer ----->

    <?php include 'footer.php'; ?>

    <!--footer End ------------>

    <!--- start control sidebar ->
<?php #include 'controlsidebar.php'; 
?>

<!-- control siderbar End ---->
    <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
</body>

</html><?php mysqli_close($con); ?>
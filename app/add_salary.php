<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
if (isset($_REQUEST['submit'])) {
    $employee   = $_REQUEST['employee'];
    $date       = $_REQUEST['date'];
    $attendance = $_REQUEST['attendance'];
    $salary     = $_REQUEST['salary'];
    $incentive  = $_REQUEST['incentive'];
    $esi        = $_REQUEST['esi'];
    $pf         = $_REQUEST['pf'];
    $attendance_type  = $_REQUEST['attendance_type'];
	$ot_wages  = $_REQUEST['ot_wages'];
	$ot_tot_hours = $_REQUEST['ot_tot_hours']; 
	$present_days = $_REQUEST['present_days']; 

    $alreadychk = mysqli_query($con, "select * from  tbl_salary where employee = '$employee' and date='$date'");
    $fetchcnt = mysqli_num_rows($alreadychk);
    if ($fetchcnt == 0) {

        $insert_details = mysqli_query($con, "INSERT INTO `tbl_salary`(`employee`,`date`,`attendance`,`salary`,`incentive`,`esi`,`pf`,`attendence_type`,`ot_wages`,`ot_total_hours`,`present_days`,`status`) values ('$employee','$date','$attendance','$salary','$incentive','$esi','$pf','$attendance_type',$ot_wages,'$ot_tot_hours','$present_days','Active')");
        if ($insert_details) {
            echo '<script type="text/javascript">
					window.location.replace("view_salary.php?step=suces");
					</script>';
        }
    } else {
        echo '<script type="text/javascript">
					window.location.replace("add_salary.php?step=fail");
					</script>';
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Role</title>
    <meta name="author" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap-select.css">

    <script src="dist/js/bootstrap-select.js"></script>
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
                <div class="panel-heading lead ">
                    <div class="row">
                        <div class="col-lg-8 col-md-8"><label>Add Salary Details</label></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_salary.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Salary</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="ot_tot_hours" id="ot_tot_hours">
                        <div class="col-sm-12 form-group">
                            <label for="inputName" class="col-sm-2 control-label">Employee Name<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-10">
                                <!-- <input type="text" name="ename" class="form-control" id="inputName" placeholder="Name" >---->
                                <select id="employee" name="employee" class="form-control selectpicker" data-live-search="true" onchange="getAuctionchit(this.value);" required>
                                    <option value="">Select Employee Name </option>
                                    <?php
                                    $query_Applic = "select Id,Name,Essl_Id from tbl_employee where Status='Active' and on_roll ='yes'";
                                    $query_Appc_exe = mysqli_query($con, $query_Applic);
                                    while ($fetch_Appc_array = mysqli_fetch_array($query_Appc_exe)) {
                                        $fetch_appc_id = $fetch_Appc_array['Id'];
                                        $fetch_appc_Name = $fetch_Appc_array['Name'];
										$fetch_appc_emp_id = $fetch_Appc_array['Essl_Id']
                                    ?>
                                        <option data-emp-id="<?php echo $fetch_appc_emp_id; ?>" value="<?php echo $fetch_appc_emp_id; ?>"><?php echo $fetch_appc_Name;  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
						
						<div class="col-sm-12 form-group">
                            <label for="inputName" class="col-sm-2 control-label">Attendance Type<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-10">
                                <!-- <input type="text" name="ename" class="form-control" id="inputName" placeholder="Name" >---->
                                <select id="attendance" name="attendance_type" class="form-control selectpicker" required>
                                    <option value="">Select Attendance detail</option>
                                    <?php
                                    $attendance_details = mysqli_query($con, "select * from  tbl_month_week");
                                    while ($fetch_attend_array = mysqli_fetch_array($attendance_details)) {
                                        $fetch_attend_id = $fetch_attend_array['Id'];
                                        $fetch_attend_Name = $fetch_attend_array['Name'];
										$fetch_attend_from = $fetch_attend_array['From_Date'];
										$fetch_attend_to = $fetch_attend_array['To_Date'];
										$fetch_attend_days = $fetch_attend_array['days'];
                                    ?>
                                        <option class="attendance_opt" data-days="<?php echo $fetch_attend_days; ?>" data-from="<?php echo $fetch_attend_from; ?>" data-to="<?php echo $fetch_attend_to; ?>" value="<?php echo $fetch_attend_id; ?>"><?php echo $fetch_attend_Name;  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <input type="text" class="form-control" id="form-field-1" placeholder="employee Name" name="employee" required> -->
                        <!-- </div> -->
                        <!-- <label class="col-sm-2 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input class="form-control dp" placeholder="yyyy-mm-dd" onchange="agecalcualte(this.value)" id="dob_F" name="date" required readonly>
                            </div> -->
                        <!-- </div> -->

                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input class="form-control dp" placeholder="yyyy-mm-dd" onchange="agecalcualte(this.value)" id="dob_F" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
                            </div>
                            <label class="col-sm-2 control-label">Attendance ( % )<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="attendance_percent" class="form-control" placeholder="Attendance" name="attendance" readonly>
                            </div>
                        </div>
						
						<div class="col-sm-12 form-group">
                            
                            <label class="col-sm-2 control-label">Present Days<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="present_days" class="form-control" placeholder="Present Days" name="present_days" readonly>
                            </div>
                        </div>
						
<h4 class="mt-3"> Salary Calculation </h4>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Salary<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="basic_pay" class="form-control" placeholder="Salary" name="salary" required readonly>
                            </div>
                            <label class="col-sm-2 control-label">Incentive<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="incentive" class="form-control" placeholder="Incentive" name="incentive" value="0" required>
                            </div>
                        </div>
						
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">ESI<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="esi" class="form-control" placeholder="ESI" name="esi" required readonly>
                            </div>
                            <label class="col-sm-2 control-label">PF<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="pf" class="form-control" placeholder="PF" name="pf" required readonly>
                            </div>
                        </div>
						
						 <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">OT Wages<font color="red">&nbsp;*&nbsp;</font></label>
                            <div class="col-sm-4">
                                <input type="text" id="ot" class="form-control" placeholder="OT WAGES" name="ot_wages" required readonly>
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

            <!-- /.col -->
        </div>
        <!-- /.content -->
    </div>
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
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function() {
            $('#dob_F').datepicker({
                format: "yyyy-mm-dd",
                endDate: '+0d',
                autoclose: true
            });
            $('.dp').on('change', function() {
                $('.datepicker').hide();
            });
        });
		$('#attendance').on('change',function(){
			from_Date = $(this).find(':Selected').attr('data-from');
			to_Date   = $(this).find(':Selected').attr('data-to');
		    emp_id    = $('#employee').find(':Selected').attr('data-emp-id');
			$.ajax({
				url: 'ajax/add_salary.php',
				type: 'POST',
				dataType: 'json',
				data: { emp_id:emp_id,from_Date : from_Date,to_Date : to_Date,data_for : 'load_details' },
				success:function(res) {
					//var a = $.parseJson(res);
					//console.log(res.attendance_percent);
					$('#basic_pay').val(Number(Math.round(res.salary)));
					$('#attendance_percent').val(parseFloat(res.attendance_percent).toFixed(2));
					//console.log(res.PF);
					$('#pf').val(Number(Math.round(res.PF)));
					$('#esi').val(Number(Math.round(res.ESI)));
					$('#ot').val(Number(Math.round(res.ot_wages)));
					$('#ot_tot_hours').val(res.ot_tot_hours);
					$('#present_days').val(res.present_days);
				}
			});
		});
    </script>
</body>
<?php mysqli_close($con); ?>
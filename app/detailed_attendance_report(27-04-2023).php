<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';
require_once '../PHPExcel-1.8/Classes/PHPExcel.php';

$sessionuserid = $_SESSION['usersessionid'];

$selectlevel = mysqli_query($con, "select * from tbl_purchase where Id='$sessionuserid'");
$fetchlevel = mysqli_fetch_array($selectlevel);

$add = $fetchlevel['Role_add'];
$edit = $fetchlevel['Edit'];
$ex_edit = explode(',', $edit);

$delete = $fetchlevel['Delete'];
$ex_del = explode(',', $delete);

$add = $fetchlevel['Role_add'];
$ex_add = explode(',', $add);

if (isset($_REQUEST['submit'])) {

    $attendance_type_id = $_POST['attendance_type'];
    $attendance_date    = mysqli_query($con, "select * from tbl_month_week where Id = '$attendance_type_id' and Status = 'Active'");

    $fetch_date         = mysqli_fetch_assoc($attendance_date);
    $from_date          = strtotime($fetch_date['From_Date']);
    $to_date            = strtotime($fetch_date['To_Date']);
    $diff_days          = round(($to_date - $from_date) / (60 * 60 * 24));
    // echo $data['diff_days'];die();
    $static_from        = date('Y-m-d', strtotime($fetch_date['From_Date']));
    $static_to          = date('Y-m-d', strtotime($fetch_date['To_Date']));

    // $paid_Attendance = mysqli_fetch_assoc(mysqli_query($con, "select count(*) as paid_days from paid_attendance where date BETWEEN '$static_from' AND '$static_to' and employee_id = '$emp_id' and status = 'Present';"));

    // $attendanceHour = mysqli_fetch_assoc(mysqli_query($con, "select a.Emp_Id,em.Name,GROUP_CONCAT(a.time_in) as present_days from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$static_from' AND '$static_to' and Attendance = 'Present' and em.on_roll != '' GROUP BY a.Emp_Id"));

    // $objPHPExcel = new PHPExcel();
    // $objPHPExcel->getActiveSheet()->setShowGridlines(false);

    // $getEmployee = mysqli_query($con, "select * from tbl_employee where on_roll != 'yes'");

    // $merging_column_attendance = ($diff_days == 6) ? 'H' : 'AB';

    // // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:'.$merging_column_attendance.'');
    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:H1');
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Attendance Hours');

    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I1:N1');
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'OT Hours');
    // $objPHPExcel->getActiveSheet()->getStyle('C1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Sno');
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', 'Employee Name');

    // $col   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $attend_index = 2;
    // $ot_index = 8;
    // for ($i = 0; $i <= $diff_days; $i++) {
    //     $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
    //     $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
    //     if ($day != 'Sun') {
    //         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$attend_index] . "2", $date . "\n" . $day);
    //         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$ot_index] . "2", $date . "\n" . $day);
    //         $objPHPExcel->getActiveSheet()->getStyle($col[$attend_index] . "2")->getAlignment()->setWrapText(true);
    //         $objPHPExcel->getActiveSheet()->getStyle($col[$ot_index] . "2")->getAlignment()->setWrapText(true);

    //         $attend_index++;
    //         $ot_index++;
    //     }
    // }
    // $objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    // $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);


    // $sno = 1;
    // $data_index = 3;
    // while ($rowEmp = mysqli_fetch_array($getEmployee)) {
    //     $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A" . $data_index, $sno);
    //     $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B" . $data_index, $rowEmp['Name']);
    //     $objPHPExcel->getActiveSheet()->getStyle("A" . $data_index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle("B" . $data_index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //     $a_index = 2;
    //     $over_index = 8;
    //     for ($i = 0; $i <= $diff_days; $i++) {
    //         $present = 0;
    //         $ot_hours  = 0;
    //         $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

    //         $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

    //         $paid_Attendance = mysqli_fetch_assoc(mysqli_query($con, "select * from paid_attendance where employee_id =" . $rowEmp['Essl_Id'] . " and status = 'Present' and date= '$date'"));

    //         $Attendance = mysqli_fetch_assoc(mysqli_query($con, "select * from tbl_attendance where Emp_Id =" . $rowEmp['Essl_Id'] . " and Attendance = 'Present' and DATE_FORMAT(time_in,'%d-%m-%Y') = '$date'"));

    //         if (!empty($Attendance)) {
    //             if (date('H:i', strtotime($Attendance['time_in'])) >= '14:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
    //                 $present = 0.5;
    //             } else if (date('H:i', strtotime($Attendance['time_out'])) <= '14:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
    //                 $present = 0.5;
    //             } else if (date('H:i', strtotime($Attendance['time_in'])) >= '17:30' && date('H:i', strtotime($Attendance['time_out'])) <= '22:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
    //                 $present = 0.5;
    //             } else if (date('H:i', strtotime($Attendance['time_in'])) >= '21:30' && date('H:i', strtotime($Attendance['time_in'])) <= '22:00') {
    //                 $present = 0.5;
    //             } else {
    //                 $present = 1;
    //             }
    //         }

    //         if (!empty($paid_Attendance)) {
    //             $present = 1;
    //         }


    //         $ot_fetch = mysqli_fetch_assoc(mysqli_query($con, "select a.time_out,a.time_in,em.Essl_id,em.E_basic from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE_FORMAT(a.time_in,'%d-%m-%Y')  = '$date' and a.Emp_Id =" . $rowEmp['Essl_Id'] . " and Attendance = 'Present'"));

    //         $time_out         = strtotime($ot_fetch['time_out']);
    //         $time_in_date  = date('Y-m-d', strtotime($ot_fetch['time_in']));
    //         $office_time   = strtotime($time_in_date . "05:30 PM");
    //         $time_in       = date('H:i', strtotime($ot_fetch['time_in']));

    //         //evening shift check 		
    //         if (($time_in >= "17:15" && $time_in <= "18:00") || ($time_in >= "21:30" && $time_in <= "22:00")) {
    //             $time_out_date = date('Y-m-d', strtotime($ot_fetch['time_out']));
    //             $office_time   = strtotime($time_out_date . "02:00 AM");
    //         }
    //         //evening shift check end	

    //         if ($time_out > $office_time) {
    //             $diff_time         = ($time_out - $office_time) / 3600;
    //             $ot_hours         = round($diff_time);
    //         }

    //         if ($day != 'Sun') {
    //             $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$a_index] . $data_index, $present);
    //             $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$over_index] . $data_index, $ot_hours);
    //             $objPHPExcel->getActiveSheet()->getStyle($col[$a_index] . $data_index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //             $objPHPExcel->getActiveSheet()->getStyle($col[$over_index] . $data_index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //             $a_index++;
    //             $over_index++;
    //         }
    //     }
    //     $sno++;
    //     $data_index++;
    // }

    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // ob_end_clean();
    // header('Content-Type: application/vnd.ms-excel');
    // header('Content-Disposition: attachment;filename="' . $filename . date('d-m-y') . '.xlsx"');
    // header('Cache-Control: max-age=0');

    // $objWriter->save('php://output');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Billing</title>
    <meta name="author" content="">
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
            font-size: 11px;
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
                        <div class="col-lg-8 col-md-8"><label>Detailed Attendance</label></div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <form action="detailed_attendance_report.php" method="POST">
                                        <div class="col-sm-10 form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Attendance Type<font color="red">&nbsp;*&nbsp;</font></label>
                                            <div class="col-sm-10">
                                                <select id="attendance" name="attendance_type" class="form-control selectpicker" required>
                                                    <option value="">Select Attendance detail</option>
                                                    <?php
                                                    $attendance_details = mysqli_query($con, "select * from  tbl_month_week");
                                                    while ($fetch_attend_array = mysqli_fetch_array($attendance_details)) {
                                                        $fetch_attend_id = $fetch_attend_array['Id'];
                                                        $fetch_attend_Name = $fetch_attend_array['Name'];
                                                    ?>
                                                        <option class="attendance_opt" value="<?php echo $fetch_attend_id;  ?>" <?php if ($attendance_type_id == $fetch_attend_id) echo "selected"; ?>><?php echo $fetch_attend_Name;  ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <button class="btn btn-info" type="submit" name="submit"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;View Report</button>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                    </form>


                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Employee Name</th>
                                                <!----- attendance hours head------->
                                                <?php
                                                for ($i = 0; $i <= $diff_days; $i++) {
                                                    $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
                                                    $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
                                                ?>
                                                    <?php if ($day != 'Sun') { ?>
                                                        <th class="text-center"><?php echo "Attendance hours<br>" . $date . "<br>(" . $day . ")"; ?></th>
                                                <?php
                                                    }
                                                }
                                                ?>

                                                <!----- ot hours head------->
                                                <?php
                                                for ($i = 0; $i <= $diff_days; $i++) {
                                                    $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
                                                    $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));
                                                ?>
                                                    <?php if ($day != 'Sun') { ?>
                                                        <th class="text-center bg-primary text-white"><?php echo "OT hours<br>" . $date . "<br>(" . $day . ")"; ?></th>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            $getEmployee = mysqli_query($con, "select * from tbl_employee where on_roll = 'yes'");
                                            $sno = 1;
                                            while ($rowEmp = mysqli_fetch_array($getEmployee)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td><?php echo $rowEmp['Name']; ?> </td>
                                                    <?php
                                                    for ($i = 0; $i <= $diff_days; $i++) {
                                                        $present = 0;
                                                        $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

                                                        $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

                                                        $paid_Attendance = mysqli_fetch_assoc(mysqli_query($con, "select * from paid_attendance where employee_id =" . $rowEmp['Essl_Id'] . " and status = 'Present' and date= '$date'"));

                                                        $Attendance = mysqli_fetch_assoc(mysqli_query($con, "select * from tbl_attendance where Emp_Id =" . $rowEmp['Essl_Id'] . " and Attendance = 'Present' and DATE_FORMAT(time_in,'%d-%m-%Y') = '$date'"));

                                                        if (!empty($Attendance)) {
                                                            if (date('H:i', strtotime($Attendance['time_in'])) >= '14:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
                                                                $present = 0.5;
                                                            } else if (date('H:i', strtotime($Attendance['time_out'])) <= '14:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
                                                                $present = 0.5;
                                                            } else if (date('H:i', strtotime($Attendance['time_in'])) >= '17:30' && date('H:i', strtotime($Attendance['time_out'])) <= '22:00' && date('Y-m-d', strtotime($Attendance['time_in'])) == date('Y-m-d', strtotime($Attendance['time_out']))) {
                                                                $present = 0.5;
                                                            } else if (date('H:i', strtotime($Attendance['time_in'])) >= '21:30' && date('H:i', strtotime($Attendance['time_in'])) <= '22:00') {
                                                                $present = 0.5;
                                                            } else {
                                                                $present = 1;
                                                            }
                                                        }

                                                        if (!empty($paid_Attendance)) {
                                                            $present = 1;
                                                        }

                                                    ?>
                                                        <?php if ($day != 'Sun') { ?>
                                                            <td class="text-center"><?php echo $present; ?></td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>


                                                    <?php
                                                    for ($i = 0; $i <= $diff_days; $i++) {
                                                        $ot_hours  = 0;
                                                        $date = date('d-m-Y', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

                                                        $day = date('D', strtotime($fetch_date['From_Date'] . '+' . $i . 'day'));

                                                        $ot_fetch = mysqli_fetch_assoc(mysqli_query($con, "select a.time_out,a.time_in,em.Essl_id,em.E_basic from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE_FORMAT(a.time_in,'%d-%m-%Y')  = '$date' and a.Emp_Id =" . $rowEmp['Essl_Id'] . " and Attendance = 'Present'"));


                                                        $time_out         = strtotime($ot_fetch['time_out']);
                                                        $time_in_date  = date('Y-m-d', strtotime($ot_fetch['time_in']));
                                                        $office_time   = strtotime($time_in_date . "05:30 PM");
                                                        $time_in       = date('H:i', strtotime($ot_fetch['time_in']));



                                                        //evening shift check 		
                                                        if (($time_in >= "17:15" && $time_in <= "18:00") || ($time_in >= "21:30" && $time_in <= "22:00")) {
                                                            $time_out_date = date('Y-m-d', strtotime($ot_fetch['time_out']));
                                                            $office_time   = strtotime($time_out_date . "02:00 AM");
                                                        }
                                                        //evening shift check end	

                                                        if ($time_out > $office_time) {
                                                            $diff_time         = ($time_out - $office_time) / 3600;
                                                            $ot_hours         = round($diff_time);
                                                        }


                                                    ?>
                                                        <?php if ($day != 'Sun') { ?>
                                                            <td class="text-center bg-info text-white"><?php echo $ot_hours; ?></td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </tr>
                                            <?php
                                                $sno++;
                                            }

                                            ?>
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
    <script src="../js/datatables.buttons.min.js"></script>
    <script src="../js/jszip.min.js"></script>
    <script src="../js/pdfmake.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
    <script src="../js/buttons.html5.min.js"></script>
    <script src="../js/buttons.colVis.min.js"></script>
    <script>
        function setdate() {

            if (startDate != "") {
                var startDate = $("#startDate").val();
                var endDate = $("#endDate").val();
                var today = new Date(startDate);
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();

                if (dd < 10) {
                    dd = '0' + dd;
                }

                if (mm < 10) {
                    mm = '0' + mm;
                }

                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("endDate").setAttribute("min", today);

            }
            if (endDate != "") {
                var etoday = new Date(endDate);
                var edd = etoday.getDate();
                var emm = etoday.getMonth() + 1; //January is 0!
                var eyyyy = etoday.getFullYear();

                if (edd < 10) {
                    edd = '0' + edd;
                }

                if (emm < 10) {
                    emm = '0' + emm;
                }

                etoday = eyyyy + '-' + emm + '-' + edd;
                document.getElementById("startDate").setAttribute("max", etoday);
            }
        }

        $(document).ready(function() {
            setTimeout(function() {
                $(".alert_msg").hide();
            }, 3000);
        });
    </script>
</body>

</html>
<?php mysqli_close($con); ?>
<?php
session_start();
include_once("../../srdb.php");

if (isset($_POST['data_for']) && $_POST['data_for'] == "load_details") {
	$static_from = $_POST['from_Date'];
	$static_to   = $_POST['to_Date'];
	$from   	 = date('Y-m-d', strtotime($_POST['from_Date']));
	$to     	 = date('Y-m-d', strtotime($_POST['to_Date']));
	$from_date = strtotime($from);
	$to_date = strtotime($to);
	$date_diff  = $to_date - $from_date;
	$total_days = round($date_diff) / (60 * 60 * 24);
	$emp_id = $_POST['emp_id'];

	$ot_data = mysqli_query($con, "select a.time_out,a.time_in,em.Essl_id,em.E_basic from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present'");

	$paid_Attendance = mysqli_fetch_assoc(mysqli_query($con, "select count(*) as paid_days from paid_attendance where date BETWEEN '$static_from' AND '$static_to' and employee_id = '$emp_id' and status = 'Present';"));

	$attendanceHour = mysqli_query($con, "select Emp_Id, Date, time_in, time_out  from tbl_attendance a 
left join tbl_employee em ON em.Essl_Id = a.Emp_Id 
where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present'");

	$total_present_check = 0;
	while ($row = mysqli_fetch_assoc($attendanceHour)) {
		if (date('H:i', strtotime($row['time_in'])) >= '14:00' && date('Y-m-d', strtotime($row['time_in'])) == date('Y-m-d', strtotime($row['time_out']))) {
			$total_present_check = $total_present_check + 0.5;
		} else if (date('H:i', strtotime($row['time_out'])) <= '14:00' && date('Y-m-d', strtotime($row['time_in'])) == date('Y-m-d', strtotime($row['time_out']))) {
			$total_present_check = $total_present_check + 0.5;
		} else if(date('H:i', strtotime($row['time_in'])) >= '17:30' && date('H:i', strtotime($row['time_out'])) <= '22:00' && date('Y-m-d', strtotime($row['time_in'])) == date( 'Y-m-d', strtotime($row['time_out'])) ) {
			$total_present_check = $total_present_check + 0.5;
		} else if(date('H:i', strtotime($row['time_in'])) >= '21:30' && date('H:i', strtotime($row['time_in'])) <= '22:00') {
			$total_present_check = $total_present_check + 0.5;
		}  else {
			$total_present_check = $total_present_check + 1;
		}
	}


	$attendance = mysqli_query($con, "select count(*) as present, em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present'");
	$fetchdata = mysqli_fetch_assoc($attendance);

	$total_present = $total_present_check + $paid_Attendance['paid_days'];

	$attendance = mysqli_query($con, "select count(*) as present, em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present'");
	$fetchdata = mysqli_fetch_assoc($attendance);
	$data = [];
	$pf = 0;
	$esi = 0;
	$salary = 0;

	$actSalary = $fetchdata['E_basic'];
	$perDaySalary = $actSalary / 26;
	$salary = ($perDaySalary * $total_present);

	if ($fetchdata['esi'] == 'yes' && $fetchdata['E_basic'] <= 21000) {
		$esi = ($salary * 0.75) / 100;
	}

	if ($fetchdata['pf'] == 'yes') {
		$bpf = ($salary * 45) / 100;
		if ($bpf <= 15000) {
			$epf = ($bpf * 12) / 100;
		} else {
			$epf = 1800;
		}
	}


	//$perDaySalary = $actSalary / 26;

	$salary = ($salary) - ($esi + $epf);

	$data['ESI'] = $esi;
	$data['total_present'] = $total_present;
	$data['PF'] = $epf;
	$data['salary'] = $salary;
	$data['present_days'] = $total_present;
	$data['attendance_percent'] = ($total_present / $total_days) * 100;

	$ot_wages = 0;
	$ot_tot_hours = 0;
	while ($ot_fetch = mysqli_fetch_assoc($ot_data)) {
		$time_out 	    = strtotime($ot_fetch['time_out']);
		$time_in_date  = date('Y-m-d', strtotime($ot_fetch['time_in']));
		$office_time   = strtotime($time_in_date . "05:30 PM");
		
		//evening shift check 		
		if (($time_in >= "17:30" && $time_in <= "18:00")  || ($time_in >= "21:30" && $time_in <= "22:00")) {
			$time_out_date = date('Y-m-d', strtotime($ot_fetch['time_out']));
			$office_time   = strtotime($time_out_date . "02:00 AM");
		}
		//evening shift check end	
		
		if ($time_out > $office_time) {
			$diff_time 		= ($time_out - $office_time) / 3600;
			$ot_per_hour_wages = $perDaySalary / 8;
			$ot_hours 			= (int) $diff_time;
			if ($ot_hours >= 1) {
				$ot_wages += $ot_hours * $ot_per_hour_wages;
				$ot_tot_hours += $ot_hours;
			}
		}
	}
	$data['ot_tot_hours'] = $ot_tot_hours;
	$data['ot_wages'] = $ot_wages;
	echo json_encode($data);
	die();
}

<?php 
session_start();
include_once("../../srdb.php");

if(isset($_POST['data_for']) && $_POST['data_for'] == "load_details") {
	 $from   	 = date('Y-m-d', strtotime($_POST['from_Date']));
	 $to     	 = date('Y-m-d', strtotime($_POST['to_Date']));
	 $from_date = strtotime($from);  
	 $to_date = strtotime($to);
	 $date_diff  = $to_date - $from_date;
	 $total_days = round($date_diff)/(60*60*24);
	 //echo $total_days;die();
	 $emp_id = $_POST['emp_id'];
	 
	 //echo "select a.*,em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where  DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present';" ;
	 
	// echo "select count(*) as present, em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present' group by Essl_id, Essl_id, E_basic, esi, pf;";
	 
	  $attendance = mysqli_query($con, "select count(*) as present, em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present' group by Essl_id, Essl_id, E_basic, esi, pf;");
	  $fetchdata = mysqli_fetch_assoc($attendance);
	 // $attendance = mysqli_query($con, "select a.*,em.Essl_id,em.Essl_id,em.E_basic,em.esi,em.pf from tbl_attendance a left join tbl_employee em ON em.Essl_Id = a.Emp_Id where  DATE(a.time_in) BETWEEN '$from' AND '$to' and a.Emp_Id = '$emp_id' and Attendance = 'Present';");
	 $total_present = $fetchdata['present'];
	 
	
	$data = [];
	$pf = 0;
	$esi = 0;
	$salary = 0;
	// while($fetchdata = mysqli_fetch_array($attendance)) {
		$row  = $fetchdata;
		$actSalary = $fetchdata['E_basic'];
		$perDaySalary = $actSalary / 26;
		$salary = ( $perDaySalary * $total_present );
		
		if($fetchdata['esi'] == 'yes' && $fetchdata['E_basic'] <= 21000 ){
			$esi = ( $salary * 0.75 ) / 100;
		}
		
		if($fetchdata['pf'] == 'yes'){
			$bpf = ( $salary * 45 ) / 100;
			if($bpf <= 15000){
				$epf = ( $bpf * 12 ) / 100;
			} else {
				$epf = 1800;
			}
		}
		
		
	// }
	
	$perDaySalary = $actSalary / 26;
	
	$salary = ( $salary ) - ( $esi + $epf );
	
	$data['ESI'] = $esi;
	$data['total_present'] = $total_present;
	$data['PF'] = $epf;
	$data['salary'] = $salary;
	$data['attendance_percent'] = ($total_present/$total_days) * 100;
	//header('Content-type: application/json');
	echo json_encode($data);die();
}


?>
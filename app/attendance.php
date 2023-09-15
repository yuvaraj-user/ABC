<?php
session_start();
include_once("srdb.php");

$sql_server_name = "ACER2";
$conenction_info = array("Database"=>"etimetracklite1","UID"=>"essl","PWD"=>"essl");
$connection =sqlsrv_connect($sql_server_name,$conenction_info);

if(!$connection){
	echo "Not Connected"; die(print_r(sqlsrv_errors(),true)); 
} else {
	
	
}
//$del_query = mysqli_query($con,"DELETE FROM tbl_attendance");
$max_log_my_query = mysqli_query($con,"SELECT last_log_id FROM tbl_last_log order by last_log_id desc limit 1");
$max_fetch_my_query = mysqli_fetch_array($max_log_my_query);
$last_log_id = $max_fetch_my_query['last_log_id'];


$get_query=sqlsrv_query($connection,"SELECT * FROM [etimetracklite1].[dbo].[AttendanceLogs] where AttendanceLogId > '$last_log_id' Order by AttendanceLogId desc");


while($fetch_query=sqlsrv_fetch_array($get_query))
{
$id =$fetch_query['AttendanceLogId']; 
$EmployeeId =$fetch_query['EmployeeId']; 
$Atdate =$fetch_query['AttendanceDate']->format('y-m-d'); 
$Status =$fetch_query['Status']; 
$InTime =$fetch_query['InTime']; 
$OutTime =$fetch_query['OutTime']; 

// echo "INSERT INTO `tbl_attendance`(`Emp_Id`, `Date`, `attendence_time`, `Attendance`, `Status`) VALUES ('$EmployeeId','$AttendanceDate','$InTime','$Status','Active')"; die();
$insert_attendance = mysqli_query($con,"INSERT INTO `tbl_attendance`(`Emp_Id`, `Date`, `time_in`,`time_out`, `Attendance`, `Status`,Log_Id) VALUES ('$EmployeeId','$Atdate','$InTime','$OutTime','$Status','Active','$id')");
//echo "<pre>";print_r($con);
}
//exit;
$max_log_query = mysqli_query($con,"SELECT max(Log_Id) as mid FROM tbl_attendance");
$max_fetch_query = mysqli_fetch_array($max_log_query);
$max_log_id = $max_fetch_query['mid'];

$max_log_update = mysqli_query($con,"INSERT INTO `tbl_last_log`(`last_log_id`) VALUES ('$max_log_id')");

echo '<script type="text/javascript">
					window.location.replace("report_attendance.php?step=suces");
					</script>';	 
?>
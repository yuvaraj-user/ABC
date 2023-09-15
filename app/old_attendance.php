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
$del_query = mysqli_query($con,"DELETE FROM tbl_attendance");
$get_query=sqlsrv_query($connection,"SELECT TOP 500 * FROM [etimetracklite1].[dbo].[AttendanceLogs] order by AttendanceLogId desc");
while($fetch_query=sqlsrv_fetch_array($get_query))
{
$id =$fetch_query['AttendanceLogId']; 
$EmployeeId =$fetch_query['EmployeeId']; 
echo $Atdate =$fetch_query['AttendanceDate'];  die();
$Status =$fetch_query['Status']; 
$InTime =$fetch_query['InTime']; 
$OutTime =$fetch_query['OutTime']; 
// echo "INSERT INTO `tbl_attendance`(`Emp_Id`, `Date`, `attendence_time`, `Attendance`, `Status`) VALUES ('$EmployeeId','$AttendanceDate','$InTime','$Status','Active')"; die();
$insert_attendance = mysqli_query($con,"INSERT INTO `tbl_attendance`(`Emp_Id`, `Date`, `time_in`,`time_out`, `Attendance`, `Status`) VALUES ('$EmployeeId','$AttendanceDate','$InTime','$OutTime','$Status','Active')");
echo '<script type="text/javascript">
					window.location.replace("report_attendance.php?step=suces");
					</script>';	 
}
?>
<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
$sessionuserid = $_SESSION['usersessionid'];
$selectlevel = mysqli_query($con, "select * from tbl_users where Id='$sessionuserid'");
$fetchlevel = mysqli_fetch_array($selectlevel);
$type = $fetchlevel['User_type'];
$e_id = $fetchlevel['Emp_tbl_Id'];
//employee 

$employeelevel = mysqli_query($con, "select * from tbl_employee where Id='$e_id'");
$emplevel = mysqli_fetch_array($employeelevel);
$brn_id = $emplevel['Branch'];
//branch 

$call_no_st		=	$_REQUEST['call_no'];    // Primary call NO
$Sub_add_st		=	$_REQUEST['sub_add'];    // Start
$sub_stop_st	=	$_REQUEST['sub_stop'];  // Stop
$sub_end_st		=	$_REQUEST['sub_end'];  // End
$start_time		=	date("Y-m-d H:i:s");
if(!empty($Sub_add_st)){
	$insert_detail = mysqli_query($con,"INSERT INTO `tbl_call_register_log`(`Start_Time`,`Status`,`Work_Status`,`Emp_Id`,`Call_No`) VALUES ('$start_time','Active','Start','$e_id','$call_no_st')");
}
if(!empty($sub_stop_st)){
    $insert_details = mysqli_query($con, "UPDATE tbl_call_register_log SET  End_Time='$start_time',Work_Status='Stop' WHERE Work_Status='Start' AND Emp_Id='$e_id' AND Call_No='$call_no_st' ORDER BY Id Desc LIMIt 1");	
}
if(!empty($sub_end_st)){
    $insert_details = mysqli_query($con, "UPDATE tbl_call_register_log SET  End_Time='$start_time',Work_Status='End' WHERE Work_Status='Start' AND Emp_Id='$e_id' AND Call_No='$call_no_st' ORDER BY Id Desc LIMIt 1");	
}
?>
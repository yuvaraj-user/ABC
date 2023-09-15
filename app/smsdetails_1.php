<?php
session_start();
smscallwithnum("917418470181", 'Dear Karthick, Daily/Chit Collection commented as Test by Karthick . R. For Complaints call 7358825424.', "Checking", "1", "1", "35200", "3");
function smscallwithnum($receiver,$msg,$msgtype,$cusid,$empid,$enrollid,$branchs)
{
		include("srdb.php");
		date_default_timezone_set("Asia/Kolkata");

	// Authorisation details.
	$username = "enquiry@mpvchitfunds.com";
	$hash = "05326da6c2558746181d4ff494bc922ae78a7ff2a52d69bc11197e7c2d361699";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "MPVCHT"; // This is who the message appears to be from.
	$numbers = $receiver; // A single number or a comma-seperated list of numbers
	$message = $msg;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 echo $result = curl_exec($ch); // This is the result from the API
	curl_close($ch);
	
	
	$dataObject = json_decode($result, true);
		$msg_status = $dataObject['status'];
		$curdat = date('Y-m-d h:i:sa');
		$insqry = mysqli_query($con,"INSERT INTO `tbl_msgstatus`(`Cus_Id`,`Msg_Type`,`Msg`,`Sent_Date`,`Status`,`Response`,`Emp_Id`,`Enrl_Id`) values('$cusid','$msgtype','$msg','$curdat','$msg_status','$result','$empid','$enrollid')");
		mysqli_close($con);	
}
?>
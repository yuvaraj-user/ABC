<?php
session_start();
//require 'checkagain.php';
require_once "srdb.php";
error_reporting(0);


?>

<?php

if(!empty($_POST["resetpasswordemail"])) {  

$forgotemailid=$_POST['resetpasswordemail'];
$forgot="select * from tbl_users where Email='$forgotemailid' and Status='Active'"; 
$passforgot=mysqli_query($con,$forgot);
$fetchforgot=mysqli_fetch_array($passforgot);
$fetchnoofrows=mysqli_num_rows($passforgot);
$userid=$fetchforgot['Id'];
$to = $fetchforgot['Email'];
if($fetchnoofrows==0)
{
echo "This Email Id is not registered.";
}

if($fetchnoofrows>0)
{	


	/* 
	require 'PHPMailer/PHPMailerAutoload.php';
	require 'PHPMailer/class.phpmailer.php';
	require 'addemailaddress.php';
	 
	$mail = new PHPMailer;
	 
	$mail->isSMTP();
	$mail->Host = 'tls://smtp.gmail.com:587';
	$mail->SMTPAuth = true;
	$mail->Username = $useremailid;
	$mail->Password = $Password;
	$mail->SMTPSecure = 'tls';
	//$mail->Port = 587;
	 
	$mail->From = $From;
	$mail->FromName = $FromName;
	$mail->addAddress($to);
	 
	$mail->WordWrap = 50;
	$mail->isHTML(true);

	$mail->Subject = 'Please reset your SGJ chitfund password';
	$mail->Body    ="<html>
	<body>
	<p><h2>Please reset your password</h2></p>
	<p><b>Hello</b></p><br/>
	<p><b>We have send this message because you requested that your chitfund password be reset.<br/>To get back into your chitfund Account you will create a new password.</b><br/>------------------------------------------------------------------------<br/>Here is how do that:<br/>1.Click the link below to open a secure browser window.<br/>2.Enter the requested information and follow the instructions to reset your password. <br/><br/>Reset your password now:<a href='http://localhost/cf/addresetpassword.php?asdf=$userid'>Reset Password</a></p>
	</body>
	</html>";
	 
	 //echo "12121";

	 
	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	} 
	else {
		echo "Send sucessfully";
	} */

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <sgj_info@sgjcf.in>' . "\r\n";
	$subject = 'Please reset your SGJ chitfund password';
	$message   ="<html>
	<body>
	<p><h2>Please reset your password</h2></p>
	<p><b>Hello</b></p><br/>
	<p><b>We have send this message because you requested that your chitfund password be reset.<br/>To get back into your chitfund Account you will create a new password.</b><br/>------------------------------------------------------------------------<br/>Here is how do that:<br/>1.Click the link below to open a secure browser window.<br/>2.Enter the requested information and follow the instructions to reset your password. <br/><br/>Reset your password now:<a href='http://fortisapps.com/test/cf/addresetpassword.php?asdf=$userid'>Reset Password</a></p>
	</body>
	</html>";
	if(mail($to,$subject,$message,$headers))
	{
		echo "Sent sucessfully";
		
	}else{
		echo 'Message could not be sent.';
	}
	
}
}
?>
					  
 
                               



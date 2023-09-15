<?php 
session_start();
//require 'checkagain.php';
include 'srdb.php';
if(isset($_REQUEST['login'])){

$userid = $_REQUEST['asdf'];
	
$newpwd = $_REQUEST['newpwd'];
$confirmpwd = $_REQUEST['confirmpwd'];
$comp = strcasecmp($newpwd,$confirmpwd);
if($comp==0){
	
 $pwd=hash('sha256', $newpwd);
 $usrpwd = mysqli_query($con,"update tbl_users set Password='$pwd' where Id=$userid");
	 if($usrpwd){
		 $finalstatus = "Password Changed Successfully";
		 $selemail = mysqli_query($con,"select Email from tbl_users where Id=$userid");
		 $emailfetch = mysqli_fetch_array($selemail);
		 $to = $emailfetch['Email'];
		 
			
			/* require 'PHPMailer/PHPMailerAutoload.php';
			require 'PHPMailer/class.phpmailer.php';
			require 'addemailaddress.php';
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'tls://smtp.gmail.com:587';
			//$mail->Host = 'http://sgjcf.in/';
			$mail->SMTPAuth = true;
			$mail->Username = $useremailid;
			$mail->Password = $Password;
			$mail->SMTPSecure = 'tls';
			
			//$mail->SMTPSecure = 'ssl';
			//$mail->Port = 587;
			 
			$mail->From = $From;
			$mail->FromName = $FromName;
			$mail->addAddress($to);
			 
			$mail->WordWrap = 50;
			$mail->isHTML(true);
			$mail->Subject = 'Your SGJ chitfund password';
			$mail->Body    ="<html>
			<body>
			<p><h2>Your password</h2></p>
			<p><b>Hi,</b></p>
			<p>We have send this message because you ceated the chitfund new password.
			<br/>Your new Password : $newpwd<br/></p>
			</body>
			</html>";
			 
			 //echo "12121";

			 
			if(!$mail->send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			} 
			else {
				//echo "Send sucessfully";
			} */
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <sgj_info@sgjcf.in>' . "\r\n";
			$subject = 'Your SGJ chitfund password';
			$message ="<html>
			<body>
			<p><h2>Your password</h2></p>
			<p><b>Hi,</b></p>
			<p>We have send this message because you ceated the chitfund new password.
			<br/>Your new Password : $newpwd<br/></p>
			</body>
			</html>";
			if(mail($to,$subject,$message,$headers))
			{
				//echo "Sent sucessfully";
				
			}else{
				echo 'Message could not be sent.';
			}
	 } 
 
}else{
	$finalstatus = "Password Mismatch";
}

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SGJ | Reset Password </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
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
   
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    
	<script src="js/jquery-1.10.2.js"></script>
	  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->
	<script>
	 $(function() {
				$('input[name="original"]').on('click', function() {
				if ($(this).val() == 'Yes') {
				$('#originaldoc').show();
				}
				else {
				$('#originaldoc').hide();
				}
				});
				
				});
	    </script>
	   
   
  </head>
  <body class="hold-transition login-page" style="background: url(img1.jpg);
    background-size: 1360px 700px;
    background-repeat: no-repeat;">
    <div class="login-box">
      <div class="login-logo">
      </div>
			<div id="box">
			<div class="box-login">

        <div class="login-box-body">
        <p class="login-box-msg">Change my password</p>
		<div id="msg" style="color:#228B22;"><?php echo $finalstatus; ?></div></br>
		
        <form name="addloginform" method="post">
          <div class="form-group has-feedback">
		  <label for="current_password" class="control-label">New Password</label>
            <input type="password" class="form-control" name="newpwd" placeholder="New Password" autocomplete="on" id="newpwd" required >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
		  <label for="current_password" class="control-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmpwd" placeholder="Confirm Password" autocomplete="on" id="confirmpwd" required >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
      </form>
	 
      </div>
  </div>
  </div>
  </div>
 
  

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
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
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  </body>
</html>

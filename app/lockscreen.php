<?php
session_start();
//require "checkagain.php";
include_once 'srdb.php';
$getsessuser=$_SESSION['User'];
session_destroy();
echo "<script>window.location='../app/index.php';</script>";
// Get Photo - Begin
//$getuser=$_SESSION['UserID'];
$getuser=$_REQUEST['getuser'];
$q=mysqli_query($con,"select * from tbl_users where Email='$getuser'");
$getarr=mysqli_fetch_array($q);
$getphoto=$getarr['Photo'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChitFund | LockScreen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
   <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
   <!-- Ionicons -->
  <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">	
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

   
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
       <b>DNC CHIT FUNDS PVT. LTD.</b>
      </div>
	  <?php
	if(!isset($_SESSION['Lock']))
	{
	$_SESSION['Lock']="Yes";
	}
	?>
		<div class="main-ls">
		
		<?php
		if(isset($_REQUEST['Notification']))
		{
		
		$getnotification=$_REQUEST['Notification'];
		
			if($getnotification=='Timeout')
			{
				?>
				<div class="alert alert-block alert-info fade in">
				<button data-dismiss="alert" class="close" type="button">
				&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-check-circle"></i> Time Out !</h4>
				<p>
				Hello, <?php echo $_SESSION['User']; ?> ! Your Account Has Been Locked for Security Purposes. Enter Your Password to Unlock<b><?php //echo $getproductname; ?></b>
				</p>

				</div>
				<?php
			}
		
		}
		?>
	
	
		<?php
		if(isset($_REQUEST['lock']))
		{
			//echo $getuser=$_SESSION['UserID'];
			$getuser=$_REQUEST['getuser'];
			$getpass=$_REQUEST['pass'];
			# $getnewpass=md5($getpass);
			$getnewpass=hash('sha256', $getpass);
			$q="select * from tbl_users where Email='$getuser' and Password='$getnewpass'";
			$pass=mysqli_query($con,$q);
			$count=mysqli_num_rows($pass);
			
			
			
			if($count>0)
			{
				unset($_SESSION['Lock']);
				echo "<script>window.location='dashboard.php';</script>";
				
			}
			else
			{
				?>
				<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
				&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-check-circle"></i> Error !</h4>
				<p>
				Invalid Login ! Verify Your Login Details and Try Again <b></b>
				</p>
				</div>
				<?php
			}
		}
		?>
      <!-- User name -->
      <div class="lockscreen-name"><?php echo $_SESSION['User']; ?></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="./<?php if(!empty($getphoto)) { echo $getphoto; } else { echo "dist/img/default.png"; } ?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="POST">
          <div class="input-group">
            <input type="password" name="pass" class="form-control" placeholder="password">
            <div class="input-group-btn">
              <button class="btn" name="lock"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Enter your password to retrieve your session
      </div>
      <div class="text-center">
        <a href="logout.php" >Or sign in as a different user</a>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright &copy; 2015-2017 <b><a href="http://www.mazenetsolution.com/">MAZENET SOLUTION</a>.</b><br>
        All rights reserved
      </div>
    </div><!-- /.center -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html><?php mysqli_close($con);?>

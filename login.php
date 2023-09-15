<?php
session_start();
require "srdb.php";

if((!isset($_REQUEST['cat'])))
{
	if(!isset($_REQUEST['Info']))
	{
		if(!isset($_REQUEST['login']))
		{
		header('Location: index.php');
		}
	}

}
else
{
	$readcat=$_REQUEST['cat'];
	if($readcat=='chitfund')
	{
	$_SESSION['Section']=$readcat;	
	}
	
	/*else
	{
	header('Location: index.php');
	}*/
	
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Chitfund | Log in</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/iCheck/square/blue.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo"> 
	<!-- <a href="index2.html"><b>Admin</b>LTE</a>--> 
</div>
<!-- /.login-logo --> 
<!-- start: LOGIN BOX -->
<div id="box">
<div class="box-login">
	<?php
if(isset($_REQUEST['Info']))
{
$readinfo=$_REQUEST['Info'];


if(isset($_REQUEST['User']))
{
$readsessuser=$_REQUEST['User'];
}

if($readinfo=='Invalid')
{
?>
	<div class="alert alert-block alert-danger fade in">
		<button data-dismiss="alert" class="close" type="button"> &times; </button>
		<h4 class="alert-heading"><i class="fa fa-times-circle"></i> Error !</h4>
		<p> Incorrect Username and/or Password. Try Again. </p>
		<!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> --> 
	</div>
	<?php
}
if($readinfo=='Login_First')
{
?>
	<div class="alert alert-block alert-warning fade in">
		<button data-dismiss="alert" class="close" type="button"> &times; </button>
		<h4 class="alert-heading"><i class="fa fa-warning"></i> Protected Page !</h4>
		<p> You are Trying to View a Protected Page, Which Requires Authentication. Kindly Login First. </p>
		<!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> --> 
	</div>
	<?php
}

if($readinfo=='Logged_Out')
{

?>
	<div class="alert alert-block alert-info fade in">
		<button data-dismiss="alert" class="close" type="button"> &times; </button>
		<h4 class="alert-heading"><i class="fa fa-sign-out"></i> Logged Out !</h4>
		<p> Hello, <?php echo $readsessuser; ?> ! You Have Been Logged Out Successfully. </p>
		<!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> --> 
	</div>
	<?php
}

}
?>
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<form action="" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="username" placeholder="Username" id="username" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="on" id="password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox">
							Remember Me </label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col --> 
			</div>
		</form>
	</div>
	<!-- /.login-box-body --> 
</div>
<!-- /.login-box -->
<?php
if(isset($_REQUEST['login']))
{
 $userid=$_REQUEST['username'];
 $password=$_REQUEST['password'];
# $newpassword=md5($password);

$newpwd=hash('sha256', $password);

$q="select * from tbl_users where Email='$userid' and Password='$newpwd'";
$passq=mysqli_query($con,$q);
$count=mysqli_num_rows($passq);

$getsection=$_SESSION['Section'];
	


if($count>0)
{

	$getarr=mysqli_fetch_array($passq);
	$username=$getarr['Name'];

 $_SESSION['User']=$username;
 $_SESSION['UserID']=$userid;
  $q="select * from tbl_users where Email='$userid'"; 
					$passq=mysqli_query($con,$q);
					$fetch=mysqli_fetch_array($passq);
					$_SESSION['permission']=$fetch['Permission'];
					$level=$fetch['Level'];
					$permissions=substr_replace($permission ,"",-1);
					$permissionlist = explode(',', $permissions);
	
	
	
	
	
	foreach($permissionlist as $value)
	{
		echo $value."<br>";
	}
	
	
	
	/*if($getsection=='marketing')
	{
		echo "<script>window.location='marketing/dashboard.php';</script>";
	}
	*/
	
	
if($level==1)
{
echo "<script>window.location='executedashboard.php';</script>";
}
else if($level==2)
{
	echo "<script>window.location='dashboard.php';</script>";
}
}
else
{
echo "<script>window.location='login.php?Info=Invalid';</script>";
}
}
?>

<!-- jQuery 2.1.4 --> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<!-- Bootstrap 3.3.5 --> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<!-- iCheck --> 
<script src="plugins/iCheck/icheck.min.js"></script> 
<script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
</body>
</html>

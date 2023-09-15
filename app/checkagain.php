<?php
#session_start();
$getuser=$_SESSION['UserID'];
?>
<html>
<head>
<META http-equiv="refresh" content="6000;URL=lockscreen.php?Notification=Timeout&getuser=<?php echo $getuser; ?>">
</head>
<body>
<?php
if(!isset($_SESSION['User']) && !isset($_SESSION['UserID']))
{
echo "<script>window.location='../index.php?Info=Login_First';</script>";	
}
if(isset($_SESSION['Lock']))
{
	?>
<script>window.location='lockscreen.php?getuser=<?php echo $getuser;?>';</script>
<?php
}
?>
</body>
</html>
<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';
$getsessuser=$_SESSION['User'];
session_destroy();
# unset($_SESSION['userid']);
# unset($_SESSION['username']);
echo "<script type='text/javascript'>window.location='../index.php?Info=Logged_Out&User=".$getsessuser."&cat=chitfund';</script>";
?>
<?php mysqli_close($con);?>
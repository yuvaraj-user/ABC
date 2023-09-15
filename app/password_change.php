<?php
/* author:Gayathri.R.KKIT */
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

 $type = $fetchlevel['User_type'];
$e_id = $fetchlevel['Emp_tbl_Id'];
//employee 

$employeelevel=mysqli_query($con,"select * from tbl_employee where Id='$e_id'");
$emplevel=mysqli_fetch_array($employeelevel);

$brn_id = $emplevel['Branch'];

//branch 
$branchlevel=mysqli_query($con,"select * from tbl_branch where Id='$brn_id'");
$brnlevel=mysqli_fetch_array($branchlevel);

$zone_id = $brnlevel['Zone_Id'];

//branch
$zonelevel=mysqli_query($con,"select * from tbl_branch where Zone_Id='$zone_id' AND Status='Active'");

while($znlevel=mysqli_fetch_array($zonelevel))
{
$allbrn = $znlevel['Id'];
$brn_all[]=$allbrn;

}

$all = implode(", ",$brn_all);


if(isset($_REQUEST['submit']))
{
    $uid=$_REQUEST['id'];
	$old_passwordd=$_REQUEST['old_password'];
	$old_password=hash('sha256', $old_passwordd);
	$sql ="SELECT * FROM tbl_users WHERE Password='$old_password' AND Id='$uid' AND Status='Active'";
	$result = mysqli_query($con, $sql);	
	
if(mysqli_num_rows($result)>0)
{
$new_passwordd=$_REQUEST['new_password'];
$new_password=hash('sha256', $new_passwordd);	
$sql1 = "UPDATE tbl_users SET Password='$new_password' WHERE Password='$old_password' AND Id='$uid' AND Status='Active'";
mysqli_query($con, $sql1);

echo "<script>alert('Password Changed successfully');
</script>";
echo "<script>window.location.href='logout.php';
</script>";
}
else
{
echo "<script>alert('Old password is incorrect');
</script>";	
}
}
?> 

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Chit | Employee login</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">  
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="plugins/bootstrap-fileupload/bootstrap-fileupload.min.css"> 
<script src="js/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script> 
<script>
function validateForm() 
{
	$(".err-msg").remove();
	var old_password = $("#old_password").val();
	var new_password = $("#new_password").val();
	var con_password = $("#con_password").val();
		
    if(old_password == "") 
	{
        $("#old_password").after('<span class="err-msg">This is Required Field</span>');
		return false;
    }
	
	if(new_password == "") 
	{
        $("#new_password").after('<span class="err-msg">This is Required Field</span>');
		return false;
    }
	else if(new_password != con_password)
	{
		$("#con_password").after('<span class="err-msg">New Password And Confirm Password Should be Same</span>');
		return false;
	}
	
	if(con_password == "")
	{
		$("#con_password").after('<span class="err-msg">This is Required Field<</span>');
		return false;
		
	}
}
</script>
   
<style>	
.aligntext{text-align: left !important;}
.err-msg{color:red;} 
ul.dropdown-menu.inner {
    max-height: 250px !important;
}
.content-wrapper
{
	padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: inherit !important;
	 min-height : 320px;
	 padding: 34px 10px !important;
	     font-size: 15px !important;
	  
}
.row.panel.panel-primary {
    background: transparent !important;
    padding-top: 9px;
	    min-width: 71px!important;
}
.panel-heading{
	margin-bottom : 0px !important;
}
.nav-tabs {
    font-size: 15px;
}
.modal-dialog {
    color: #000000 !important;
}
.panel.panel-warning {
    border: 1px solid #fcf8e3;
}
tr{
	border-bottom: 1px solid #dedede;
}
.nav-tabs-custom {
	background : transparent;
}
.panel-primary>.panel-heading {
    color: #000;
    background-color: #cccccc;
    border-color: #cccccc;
    font-weight: 500;
    font-style: inherit;
} 
#log_imgid
{
	    margin: -171px 0 !important;
}
</style>	
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

     <?php include 'header.php'; ?>
     <?php include 'sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">  
		<section class="content"> 
			<div class="nav-tabs-custom"> 
				<div class="box-body">
		
<div class="row panel panel-primary">
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">Change Password</div>	
               <div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<!-- <a href="viewemployeelogin.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Employee Details</a> -->
					<a href="home.php" class="btn btn-success">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
				</div> 
			</div>
		</div>
	</div>
	
	
<div class="panel-body">
     <div class="tab-content">	
		   <div  class=" active tab-pane" >
                    <form class="form-horizontal" action="" onsubmit="return validateForm()" method="post" enctype="multipart/form-data"> 
			        <div class="form-group">
                        <div class="col-sm-12">
                        <label for="inputEmail" class="col-sm-2 control-label aligntext">Old Password<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-6">                        
			            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" value="">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                        <label for="inputEmail" class="col-sm-2 control-label aligntext">New Password<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-6">                        
			            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                        </div>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-sm-12">
                        <label for="inputEmail" class="col-sm-2 control-label aligntext">Confirm Password<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-6">                        
			            <input type="password" name="con_password" id="con_password" class="form-control" placeholder="Confirm Password">
                        </div>
                        </div>
                    </div>
                      <div class="col-sm-12 form-group">
					   <br>
                        <div class="col-sm-offset-4 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
				  </div><!-- /.tab-content -->
         </div>
		 </div>
		 </div>
		 </div>
       </section>
	   <!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
<!-- start footer ----->
 <?php include 'footer.php'; ?>
<!--footer End ------------>
<div class="control-sidebar-bg"></div>
</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/chartjs/Chart.min.js"></script>
<script src="dist/js/pages/dashboard2.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
</body>
</html>
<?php mysqli_close($con);?>

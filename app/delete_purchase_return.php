<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Billing</title>
	<meta name="author" content="Manoj">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	
	<script src="js/jquery-1.10.2.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->
  </head>
  <style>
.content-wrapper
{
  padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: inherit !important;
   min-height : 350px;
   padding: 34px 10px !important;
    
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
.panel-body
{
  font-size : 16px !important;
  color: #333;
}
ul.dropdown-menu.inner {
    max-height: 159px !important;
}
.panel-heading.lead {
    padding-right: 23px;
    padding-left: 23px;
}
</style>
  <body class="hold-transition skin-blue sidebar-mini">   
    <div class="wrapper">

     <?php include 'header.php'; ?>
     <?php include 'sidebar.php'; ?>
      <div class="content-wrapper">
      <?php
	  $readrequest=$_REQUEST['do'];
$readid=$_REQUEST['id'];

if(isset($_REQUEST['remark']))
{
 
								$id=$_REQUEST['id'];
								$remarks=$_REQUEST['remarks'];
									$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
								$query_update_enable="update `tbl_purchase_return` set Remark='$remarks',Status='Inactive',Updated_By='$createdby',Updated_On='$createdon' WHERE Id='$id'";
									$passquery_update_enable=mysqli_query($con,$query_update_enable);
									if($passquery_update_enable)
									{
echo '<script type="text/javascript">
					window.location.replace("report_sales_return.php?step=delete");
					</script>';										
									}
									else
									{ 
								echo '<script type="text/javascript">
					window.location.replace("report_sales_return.php?step=fail");
					</script>';		
									}
									
							 
}
								?>
                
    <!-- Content Wrapper. Contains page content -->
    
<div class="row panel panel-primary"> 
  <div class="panel-heading lead ">
    <div class="row">
      <div class="col-lg-8 col-md-8">Add Remark Details</div>        
        <div class="col-lg-4 col-md-4 text-right">
          <div class="btn-group text-center">
            <a href="add_purchase_return.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Purchase Return</a>
            <a href="view_purchase_return.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Purchase Return</a>
          </div>
        </div>
    </div>
  </div>
  <div class="panel-body"> 
                    <form class="form-horizontal" name="addemployee_details" action="" method="post" enctype="multipart/form-data">
			
					  <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Remarks<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-10">
                         <input type="hidden" class="form-control" name="id" value="<?php echo $readid;?>">
						 <textarea name="remarks" class="form-control" id="remarks" placeholder=" Remarks" required></textarea>
                        </div>
                      </div>
			
                      <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                          <button type="submit" name="remark" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
				  </div><!-- /.tab-content -->
         

       <!-- /.content -->
      </div><!-- /.content-wrapper -->
	  </div>
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php #include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
    <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
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
    <script src="dist/js/demo.js"></script>
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  </body>
</html><?php mysqli_close($con);?>

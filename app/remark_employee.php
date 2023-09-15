<?php
/* author:Gayathri.R.KKIT */
session_start();

include_once 'srdb.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chit | Employee remark</title>
	<meta name="author" content="Gayathri.R.KKIT">
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">	
	<script src="js/jquery-1.10.2.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->   
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

     <?php include 'header.php'; ?>
     <?php include 'sidebar.php'; ?>
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Remark details(Employee)          
          </h1>         
        </section>

     

        <!-- Main content -->
        <section class="content">
		 <div class="box-header with-border">
                  <h3 class="box-title">Add Remark details</h3>
                </div><!-- /.box-header -->
		 <div class="box-body">
      <?php
if(isset($_REQUEST['remark']))
{
$readrequest=$_REQUEST['do'];
$readid=$_REQUEST['id'];
if($readrequest=='delete')
								{
								$remarks=$_REQUEST['remarks'];
								$query_update_enable="update `tbl_employee` set Remark='$remarks',Status='Deleted' WHERE Id='$readid'";
									$passquery_update_enable=mysqli_query($con,$query_update_enable);
									if($passquery_update_enable)
									{
                    echo '<script type="text/javascript">
                            window.location.replace("viewauctioncustomer.php?step=deleted");
                    </script>';   
									}
									else
									{
									?>
									<div class="alert alert-danger">
									<button data-dismiss="alert" class="close">
									&times;
									</button>
									<i class="fa fa-times-circle"></i>
									  <strong>Error !</strong>&nbsp;&nbsp;The Selected Component Could Not be Deleted. Please Try Again. If This Error Persists, Contact Administrator.
									</div>	
									<?php	
									}
									
								}
}
								?>
     <div class="tab-content">	
	 
		   <div  class=" active tab-pane" >
                    <form class="form-horizontal" name="addemployee_details" action="<?php echo remark_employee.php; ?>" method="post" enctype="multipart/form-data">
			
			  <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label"> Remarks</label>
                        <div class="col-sm-7">
                         <textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks"></textarea>
                        </div>
                      </div>
			
                      <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                          <button type="submit" name="remark" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
				  </div><!-- /.tab-content -->
         </div>
       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>


      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
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
</html><?php mysqli_close($con);?>

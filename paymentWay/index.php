<?php 
/* author:Gayathri.R.KKIT */
include_once("srdb.php");
include_once("paypalUrl.php");
date_default_timezone_set("Asia/Kolkata"); 
?> 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChitFund | PayPal</title>
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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<style>
body {
    background-image: url("images/1.png");
}   
.demo-2 .main h1 {
	margin: 1em 0 0.5em 0;
	font-weight: 600;
	font-family: 'Titillium Web', sans-serif;
	position: relative;  
	font-size: 36px;
	line-height: 40px;
	padding: 15px 15px 15px 15%;
	color: #355681;
	box-shadow: 
	inset 0 0 0 1px rgba(53,86,129, 0.4), 
	inset 0 0 5px rgba(53,86,129, 0.5),
	inset -285px 0 35px white;
	border-radius: 0 10px 0 10px;
	background: #fff url(images/bartoszkosowski.jpg) no-repeat center left;
}
</style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
		
            <div style="margin: 1em 0 0.5em 0;
	font-weight: 600;
	font-family: 'Titillium Web', sans-serif;
	position: relative;  
	font-size: 36px;
	line-height: 40px;
	padding: 15px 15px 15px 15%;
	color: #355681;
	box-shadow: 
		inset 0 0 0 1px rgba(53,86,129, 0.4), 
		inset 0 0 5px rgba(53,86,129, 0.5),
		inset -285px 0 35px white;
	border-radius: 0 10px 0 10px;
	background: #fff url(images/bartoszkosowski.jpg) no-repeat center left;
	"><font style="padding-left:280px">PayPal Online Payment</font></div>
       
         
        </section>

        <!-- Main content -->
        <section class="content">
		<div class="box-header with-border">
           
        </div>
		<div class="box-body">
		
		<div class="tab-pane">
                   
				
														
														<!--<input type="hidden" name="business" value="<?php echo $paypal_id; ?>">---->
														
														
													   <?php
 
														//fetch products from the database
														$results = mysqli_query($con,"SELECT * FROM tbl_chit_product where Status='Active'");
														while($row = mysqli_fetch_array($results))
														{
														?>
														<form class="form-horizontal" action="https://www.paypal.com/cgi-bin/webscr" method="post" 	target="_top" >
														<input type="hidden" name="cmd" value="_s-xclick">
														<div class="form-group" align="center">
														<input type="hidden" name="hosted_button_id" value="<?php echo $row['Button_Val']; ?>">
														<img src="<?php echo $row['Image']; ?>"  /><br/>
														<center><b>Chit Value: <?php echo $row['Chit_Format']; ?></b></center>
														</div> 
														<!-- Specify URLs -->
														<input type='hidden' name='cancel_return' value='http://localhost/cf/paymentWay/cancel.php'>
														<input type='hidden' name='return' value='http://localhost/cf/paymentWay/success.php'>
														<!-- Display the payment button. -->
														<div class="form-group" align="center">
													   <input type="image" name="submit" border="0"
														src="images/payBut.png" alt="PayPal - The safer, easier way to pay online">
														<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
														 </div>  							
														   </form>												
														<?php
														} 
														?>
														 	
					
					  
					  
                  </div><!-- /.tab-pane -->
		</div>
	
       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php //include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
      
      
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
  </body>
</html>
<?php mysqli_close($con);?>

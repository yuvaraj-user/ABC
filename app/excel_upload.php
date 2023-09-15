<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Billing</title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
    
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->      
   <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
   <!-- Ionicons -->
    
   <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">	
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	  <script src="js/jquery-1.10.2.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	 <link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	 
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
.down_x {
    background: #2576fd;
    width: 212px;
    margin-left: 2px;
    text-align: center;
    border-radius: 4px;
    padding: 7px 0;
    font-size: 18px;
    float: right;
    box-shadow: 1px 3px 13px rgba(0,0,0,.5); 
	transition: 0.5s;
}
.down_x a {color:#fff;}
.down_x:hover {
    background: #616161; 
    transition: 0.5s;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 
<?php
	include ("srdb.php");
	
	if(isset($_POST["submit"]))
	{
		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		if(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{ 
			
			 $name=$filesop[0]; 
			 $code=$filesop[1]; 
			 $igst=$filesop[2]; 
			 $sgst=$filesop[3]; 
			 $cgst=$filesop[4]; 
			 $hsn=$filesop[5]; 
			 $group=$filesop[6]; 
			 $uom=$filesop[7];
			 $mrp_rate=$filesop[8]; 
			 $tax_rate=$filesop[9];
			 $quantity=$filesop[10];
			 $rate=$filesop[11]; 
			 $amount=$filesop[12]; 
			 $selling_rate=$filesop[13]; 
			
				if($name = "Product_Name" && $code == "Code" && $igst == "IGST" && $sgst == "SGST" && $cgst == "CGST" && $hsn == "HSN" && $group == "Group" && $uom == "UOM" && $mrp_rate == "MRP_Rate" && $tax_rate == "TAX_Rate" && $quantity == "Quantity" && $rate == "Rate" && $amount == "Amount" && $selling_rate == "Selling_Rate"){
					
					$insert  = TRUE;
				}
				else{
					$insert  = False;;
				}
				
		}	
		
		///////////////////////////////
	if($insert == 1){
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			 $name=$filesop[0];
			 $code=$filesop[1];
			 $igst=$filesop[2];
			 $sgst=$filesop[3];
			 $cgst=$filesop[4];
			 $hsn=$filesop[5];
			 $group=$filesop[6];
			 $uom=$filesop[7];
			 $mrp_rate=$filesop[8];
			 $tax_rate=$filesop[9];
			 $quantity=$filesop[10];
			 $rate=$filesop[11];
			 $amount=$filesop[12];
			 $selling_rate=$filesop[13];	
				$createdon=date("d-m-Y H:i:s A");
				$createdby=$_SESSION['User'];
				$updatedon=0;
				$updatedby=0;
			
			if($c==0){				
				 $sql = mysqli_query($con,"INSERT INTO `tbl_product`(`Name`, `Code`, `Group`, `Uom`, `Mrp_Rate`, `Tax_Rate`, `Igst`, `Sgst`, `Cgst`, `Hsn_Code`, `Quantity`, `Rate`, `Amount`, `Created_On`, `Created_By`, `Status`,`Selling_Rate`) VALUES ('$name','$code','$group','$uom','$mrp_rate','$tax_rate','$igst','$sgst','$cgst','$hsn','$quantity','$rate','$amount','$createdon','$createdby','Active','$selling_rate')");
			}
			else{
				
				$sql = mysqli_query($con,"INSERT INTO `tbl_product`(`Name`, `Code`, `Group`, `Uom`, `Mrp_Rate`, `Tax_Rate`, `Igst`, `Sgst`, `Cgst`, `Hsn_Code`, `Quantity`, `Rate`, `Amount`, `Created_On`, `Created_By`, `Status`,`Selling_Rate`) VALUES ('$name','$code','$group','$uom','$mrp_rate','$tax_rate','$igst','$sgst','$cgst','$hsn','$quantity','$rate','$amount','$createdon','$createdby','Active','$selling_rate')");
				
			}	
			$c = $c + 1;
			$cz[]=$c;
		}
	}
	else{
				echo '<script type="text/javascript">
					window.location.replace("excel_upload.php?step=fail");
					</script>';	 
	}
		if($sql){
				echo '<script type="text/javascript">
					window.location.replace("excel_upload.php?step=suces");
					</script>';	 
		}else{			
		}

	}
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			<strong>Successfully !</strong> You database has imported successfully. You have inserted <?php echo $cz;?>recoreds.
		</div>
	<?php 
	}
	else if($final == "fail")
	{ ?>
	<div class="alert alert_msg alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		<strong>Sorry!</strong> There is some problem. Insert the recors in correct record formats.
	</div>
	<?php }
?>
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8"><label>Upload Data</label></div>				
				<div class="col-lg-4 col-md-4 text-right down_x">
						<a href="tbl_product.csv">Example Format <i class="fa fa-download" aria-hidden="true"></i></a>
				</div>
		</div>
	</div>
	 
		<div class="panel-body"> 
			<form name="import" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label">Upload File (.csv)<font color="red">&nbsp;*&nbsp;</font></label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="file" required>
						</div>	
				</div> 
				<br><br>
				<div class="col-sm-12">                        
					<div class="col-sm-6">
						<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
					</div>
					<div class="col-sm-6">				
						
					</div>			  
				</div>
				
			</form>
		</div>
	</div>
	</div>	
</div>
<?php include 'footer.php'; ?>      
	<div class="control-sidebar-bg"></div>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
  </body>
</html>
<?php mysqli_close($con);?>
<?php

session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $Name=$_REQUEST['name'];
	 $Address_Line1=$_REQUEST['Address_Line1'];
	 $Address_Line2=$_REQUEST['Address_Line2'];
	 $Address_Line3=$_REQUEST['Address_Line3'];
	 $Address_Line4=$_REQUEST['Address_Line4'];
	 $State=$_REQUEST['State'];
	 $Country=$_REQUEST['Country'];
	 $Mobile_No1=$_REQUEST['Mobile_No1'];
	 $Mobile_No2=$_REQUEST['Mobile_No2'];
	 $Email_Id1=$_REQUEST['Email_Id1'];
	 $Email_Id2=$_REQUEST['Email_Id2'];
	 $LandLine_No1=$_REQUEST['LandLine_No1'];
	 $LandLine_No2=$_REQUEST['LandLine_No2'];
	 $Gst_No=$_REQUEST['Gst_No'];
	 $Gst_Type=$_REQUEST['Gst_Type'];
	 $Pan_No=$_REQUEST['Pan_No'];
	 $id = $_REQUEST['id'];
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$updatedby=$_SESSION['usersessionid'];
	
	
		
		$insert_details = mysqli_query($con,"UPDATE tbl_supplier SET Name='$Name',Address_Line1='$Address_Line1',Address_Line2='$Address_Line2',Address_Line3='$Address_Line3',Address_Line4='$Address_Line4',State='$State',
		Country='$Country',Mobile_No1='$Mobile_No1',Mobile_No2='$Mobile_No2',Email_Id1='$Email_Id1',
		Email_Id2='$Email_Id2',LandLine_No1='$LandLine_No1',LandLine_No2='$LandLine_No2',Gst_No='$Gst_No',Gst_Type='$Gst_Type',Pan_No='$Pan_No',Updated_By='$updatedby',Updated_On='$createdon' WHERE id='$id'");
		
		
		
		
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_supplier.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_supplier.php?step=fail");
					</script>';
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Billing </title>
        <meta name="author" content="">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

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
                min-height : 420px;
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
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'header.php'; ?>
            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="row panel panel-primary">

<div class="panel-heading lead ">
	<div class="row">
		<div class="col-lg-8 col-md-8"><b>Edit Supplier</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_supplier.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Supplier</a>
				</div>
			</div>
	</div>
</div>
</div>
<?php
            $id = $_REQUEST['id'];
            $qury="SELECT * FROM `tbl_supplier` WHERE Id='$id' and Status='Active'";
			$qury_exe=mysqli_query($con,$qury);
			$fetch=mysqli_fetch_array($qury_exe);        

?>
                <div class="panel-body"> 
                    
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	 
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="name" 
							value="<?php echo $fetch['Name']; ?>" required>
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Address Line 1</label>
							<div class="col-sm-4">
							<input type="text" name="Address_Line1" class="form-control" value="<?php echo $fetch['Address_Line1']; ?>"  placeholder="Address Line 1">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Address Line 2</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Address Line 2"  value="<?php echo $fetch['Address_Line2']; ?>" id="Address_Line2" class="form-control limited"  name="Address_Line2" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">Address Line 3</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Address Line 2"  value="<?php echo $fetch['Address_Line3']; ?>" id="Address_Line3" class="form-control limited"  name="Address_Line3" >
						</div>
						</div>
						
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Address Line 4</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Address Line 2"  value="<?php echo $fetch['Address_Line4']; ?>" id="Address_Line4" class="form-control limited"  name="Address_Line4" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">State</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="State"  value="<?php echo $fetch['State']; ?>" id="State" class="form-control limited"  name="State" >
						</div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Country</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Country"  value="<?php echo $fetch['Country']; ?>" id="Country" class="form-control limited"  name="Country" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">Mobile No 1</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Mobile No 1"  value="<?php echo $fetch['Mobile_No1']; ?>" id="Mobile_No1" class="form-control limited"  name="Mobile_No1" >
						</div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Mobile No 2</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Mobile No 2"  value="<?php echo $fetch['Mobile_No2']; ?>" id="Mobile_No2" class="form-control limited"  name="Mobile_No2" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">Email Id 1</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Email Id 1"  value="<?php echo $fetch['Email_Id1']; ?>" id="Email_Id1" class="form-control limited"  name="Email_Id1" >
						</div>
						</div>
						
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Email Id 2</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Email Id 2"  value="<?php echo $fetch['Email_Id1']; ?>" id="Email_Id1" class="form-control limited"  name="Email_Id1" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">LandLine No 1</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="LandLine No 1"  value="<?php echo $fetch['LandLine_No1']; ?>" id="LandLine_No1" class="form-control limited"  name="LandLine_No1" >
						</div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">LandLine No 2</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="LandLine No 2"  value="<?php echo $fetch['LandLine_No2']; ?>" id="LandLine_No2" class="form-control limited"  name="LandLine_No2" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">GST No 1</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="GST No 1"  value="<?php echo $fetch['Gst_No']; ?>" id="Gst_No" class="form-control limited"  name="Gst_No" >
						</div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">GST Type </label>
						 <div class="col-sm-4">
							<input type="text" placeholder="GST Type"  value="<?php echo $fetch['Gst_Type']; ?>" id="Gst_Type" class="form-control limited"  name="Gst_Type" >
						</div>
						<label for="inputName" class="col-sm-2 control-label">Pan No </label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Pan No"  value="<?php echo $fetch['Pan_No']; ?>" id="Pan_No" class="form-control limited"  name="Pan_No" >
						</div>
						</div>
                   
					 <div class="col-sm-12">                        
		      <br>
			  <div class="col-sm-6">
				<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
			  </div>
			  <div class="col-sm-6">				
				<button type="reset" name="" class="pull-left btn btn-danger">Cancel</button>
			  </div>			  
          </div>
					 </form>
                </div>	
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <div class="control-sidebar-bg"></div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


</body>
</html>

<?php mysqli_close($con); ?>

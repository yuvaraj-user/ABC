<?php

session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $Name=$_REQUEST['Name'];
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
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
		
		$insert_details = mysqli_query($con,"INSERT INTO `tbl_supplier`(`Name`, `Address_Line1`, `Address_Line2`, `Address_Line3`, `Address_Line4`, `State`,`Country`, `Mobile_No1`, `Mobile_No2`,`Email_Id1`, `Email_Id2`, `LandLine_No1`,`LandLine_No2`,`Gst_No`, `Gst_Type`, `Pan_No`,`Created_On`,`Created_By`, `Status`) VALUES ('$Name','$Address_Line1','$Address_Line2','$Address_Line3','$Address_Line4','$State','$Country','$Mobile_No1','$Mobile_No2','$Email_Id1','$Email_Id2','$LandLine_No1','$LandLine_No2','$Gst_No','$Gst_Type','$Pan_No','$createdon','$createdby','$status')");
		
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
        <meta name="author" content="Gayathri.R.KKIT">
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
		<div class="col-lg-8 col-md-8"><b>Add Supplier</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_supplier.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Supplier</a>
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                    
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	 
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="Name" required>
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Address Line 1</label>
							<div class="col-sm-4">
							<input type="text" name="Address_Line1" class="form-control"  placeholder="Address Line 1">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Address Line 2</label>
						 <div class="col-sm-4">
							<input type="text" name="Address_Line2" class="form-control"  placeholder="Address Line 2">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Address Line 3</label>
							<div class="col-sm-4">
							<input type="text" name="Address_Line3" class="form-control"  placeholder="Address Line 3">
						  </div>
						</div>
						
							<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Address Line 4</label>
						 <div class="col-sm-4">
							<input type="text" name="Address_Line4" class="form-control"  placeholder="Address Line 4">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">State</label>
							<div class="col-sm-4">
							<input type="text" name="State" class="form-control"  placeholder="State">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Country</label>
						 <div class="col-sm-4">
							<input type="text" name="Country" class="form-control"  placeholder="Country">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Mobile Number 1</label>
							<div class="col-sm-4">
							<input type="text" name="Mobile_No1" class="form-control"  placeholder="Mobile Number 1">
						  </div>
						</div>
						
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Mobile Number 2</label>
						 <div class="col-sm-4">
							<input type="text" name="Mobile_No2" class="form-control"  placeholder="Mobile Number 2">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Email Id 1</label>
							<div class="col-sm-4">
							<input type="text" name="Email_Id1" class="form-control"  placeholder="Email Id 1">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Email Id 1</label>
						 <div class="col-sm-4">
							<input type="text" name="Email_Id2" class="form-control"  placeholder="Email Id 1">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">LandLine No 1</label>
							<div class="col-sm-4">
							<input type="text" name="LandLine_No1" class="form-control"  placeholder="LandLine No 1">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">LandLine No 2</label>
						 <div class="col-sm-4">
							<input type="text" name="LandLine_No2" class="form-control"  placeholder="LandLine No 2">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">GST No </label>
							<div class="col-sm-4">
							<input type="text" name="Gst_No" class="form-control"  placeholder="GST No">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">GST Type</label>
						 <div class="col-sm-4" >
							<select class="form-control" name="Gst_Type" >
							  <option value="Regular">Regular</option>
							  <option value="Un Register">Un Register</option>
							  <option value="Customer">Customer</option>
							</select>
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Pan No </label>
							<div class="col-sm-4">
							<input type="text" name="Pan_No" class="form-control"  placeholder="Pan No">
						  </div>
						</div>
                   
					 <div class="col-sm-12">                        
		  <br>
			  <div class="col-sm-6">
				<button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
			  </div>
			  <div class="col-sm-6">				
				<button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
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

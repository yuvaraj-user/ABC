<?php
session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $name=$_REQUEST['name'];
	 $igst=$_REQUEST['igst'];
	 $sgst=$_REQUEST['sgst'];
	 $cgst=$_REQUEST['cgst'];
	 $hsn=$_REQUEST['hsn'];
	 $tax_rate=$_REQUEST['tax_rate'];
	 $id=$_REQUEST['id'];
	 $code=$_REQUEST['code'];
	
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['usersessionid'];
	
		
		$insert_details = mysqli_query($con,"UPDATE `tbl_product_group` SET `Name`='$name', `Hsn`='$hsn', Code='$code',`Tax_Rate`='$tax_rate', `Igst`='$igst', `SgSt`='$sgst', `Cgst`='$cgst', `Updated_On`='$createdon', `Updated_By`='$createdby' WHERE Id='$id'");
		
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_product_group.php?step=suces");
					</script>';	
			
		}

	else{
		 echo '<script type="text/javascript">
					window.location.replace("view_product_group.php?step=fail");
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
		<div class="col-lg-8 col-md-8"><b>Edit Product Group</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_product_group.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;View Product Group</a>
				</div>
			</div>
	</div>
</div>
</div>
                <div class="panel-body"> 
                  <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
				  
				  <?php
				  
				    $id = $_REQUEST['id'];
					$qury="SELECT * FROM `tbl_product_group` WHERE Id='$id' and Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
					$fetch=mysqli_fetch_array($qury_exe);        

				  
				  ?>
	 
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Name<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Name" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" value="<?php echo $fetch['Name']; ?>" name="name" required>
						</div>
						
						<label for="inputName" class="col-sm-2 control-label">Code</label>
							<div class="col-sm-4">
							<input type="text" name="code" value="<?php echo $fetch['Code']; ?>" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))"  class="form-control"  placeholder="Code">
						  </div>
							
						</div>
						
						
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Tax Rate<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Tax Rate" value="<?php echo $fetch['Tax_Rate']; ?>" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="tax_rate" required>
						</div>
						<label for="inputName" class="col-sm-2 control-label">HSN code</label>
							<div class="col-sm-4">
							<input type="text" name="hsn" value="<?php echo $fetch['Hsn']; ?>"  onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))"  class="form-control"  placeholder="HSN">
						  </div>
						</div>
						
						<div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label"></font></label>
						 <div class="col-sm-4">
						  <label for="inputName" class="col-sm-3 control-label">CGST</label>
						   <div class="col-sm-8">
							<input type="text" placeholder="cgst" value="<?php echo $fetch['Cgst']; ?>" maxlength="15" id="state_code" class="form-control limited" maxlength="15" name="cgst" required>
							
						</div>
						</div>
						 <div class="col-sm-3">
						  <label for="inputName" class="col-sm-3 control-label">SGST</label>
						   <div class="col-sm-8">
							<input type="text" placeholder="sgst" value="<?php echo $fetch['Sgst']; ?>" maxlength="15" id="state_code" class="form-control limited" maxlength="15" name="sgst" required>
							
						</div>
						</div>
						 <div class="col-sm-3">
						  <label for="inputName" class="col-sm-3 control-label">IGST</label>
						   <div class="col-sm-8">
							<input type="text" placeholder="igst" value="<?php echo $fetch['Igst']; ?>" maxlength="15" id="state_code" class="form-control limited" maxlength="15" name="igst" required>
							
						</div>
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

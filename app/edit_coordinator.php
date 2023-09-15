<?php

session_start();
require 'checkagain.php';
include_once '../srdb.php';

$sessionuserid = $_SESSION['usersessionid'];

if(isset($_REQUEST['submit']))
{
	 $ids = $_REQUEST['id'];
     $shop = array();
	 $Name=$_REQUEST['Name'];
	 $Address=$_REQUEST['Address'];
	 $Mobile_No=$_REQUEST['Mobile_No'];
	 $website=$_REQUEST['website'];
	 $group=$_REQUEST['group'];
	 $district=$_REQUEST['district'];
	 $shop=$_REQUEST['shop'];
	 $shop_id = implode(',', $shop);
	 $contact_person=$_REQUEST['contact_person'];
	 $Email_Id=$_REQUEST['Email_Id'];
	 $status="Active";
	 $createdon=date("d-m-Y H:i:s A");
	 $createdby=$_SESSION['usersessionid'];
	 
	
	    
		$insert_details = mysqli_query($con,"UPDATE `tbl_coordinator` SET `Name`='$Name', `Address`='$Address', `Mobile_No`='$Mobile_No',`Email_Id`='$Email_Id',`Created_On`='$createdon',`Created_By`='$createdby', `Group_Id`='$group',`District_Id`='$district',`Shop_Id`='$shop_id' WHERE Name='$ids'");
		
	
		if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("view_coordinator.php?step=suces");
					</script>';	
		}else{
		 echo '<script type="text/javascript">
					window.location.replace("view_coordinator.php?step=fail");
					</script>';
	}
}
?>
<?php
            $id = $_REQUEST['id'];
            $qury="SELECT * FROM `tbl_coordinator` WHERE Name='$id' and Status='Active'";
			$qury_exe=mysqli_query($con,$qury);
			$fetch_shop=mysqli_fetch_array($qury_exe);        
			$grp_id = $fetch_shop["Group_Id"];
			$District_Id = $fetch_shop["District_Id"];
			$Name = $fetch_shop["Name"];
			$Id_de = $fetch_shop["Id"];
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
	<script src="dist/js/bootstrap-select.js"></script>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script>
          function get_district(val) {
			var district_id = $('#district').val();
			
	            $.ajax 
				({  
				type: "POST",
				url: "get_shop_select.php",
				data:'group_id='+<?php echo $Id_de; ?>+'&district_id='+<?php echo $District_Id; ?>,			 
				success: function(data){
				$("#dis_shop").html(data); 
				$('#shop').selectpicker({});
				}
				});
                } 
				
				window.onload = get_district;
  </script>
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
		<div class="col-lg-8 col-md-8"><b>Edit Coordinator</b></div>				
			<div class="col-lg-4 col-md-4 text-right">
				<div class="btn-group text-center">
					<a href="view_coordinator.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Coordinator</a>
				</div>
			</div>
	</div>
</div>
</div>

                <div class="panel-body"> 
                    
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
	
					  <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Designation Name<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Name" value="<?php echo $fetch_shop['Name']; ?>" maxlength="150" id="form-field-1"  class="form-control limited" maxlength="15" name="Name" required>
						</div>
						
							
						</div>
						 <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">District<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
							<select class="form-control selectpicker" name="district" id="district" data-live-search="true" required>
						 <option value="">Select District</option>
						  
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Name,Id from tbl_district WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>" <?php if($fetch_shop['District_Id'] == $Id) echo 'selected';?>><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						  </div>
							<label for="inputName" class="col-sm-2 control-label">Sector<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
							<select class="form-control selectpicker" name="group" onchange="get_district(this.value);" id="group" data-live-search="true" required>
						 <option value="">Select Sector</option>
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Name,Id from tbl_group WHERE Status='Active'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>" <?php if($fetch_shop['Group_Id'] == $Id) echo 'selected';?>><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						  </div>
						</div>
						<div class="form-group col-sm-12" id="dis_shop"> 
							
						  </div>
						<div class="form-group col-sm-12">
						
							<label for="inputName" class="col-sm-2 control-label">Contact No</label>
							<div class="col-sm-4">
							<input type="text" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\=?;.:,'<>\{\}\[\]\\\/]/gi, ''))"  maxlength="10" name="Mobile_No" value="<?php echo $fetch_shop['Mobile_No']; ?>" class="form-control">
						  </div>
						  
						<label for="inputName" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-4">
							<textarea name="Address" class="form-control"><?php echo $fetch_shop['Address']; ?></textarea>
						  </div>
						</div>
						
						
						<div class="form-group col-sm-12">
						
						 <label for="inputName" class="col-sm-2 control-label">Email Id</label>
						 <div class="col-sm-4">
							<input type="email" name="Email_Id" value="<?php echo $fetch_shop['Email_Id']; ?>" class="form-control" >
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
	<script src="dist/js/bootstrap-select.js"></script>

</body>
</html>

<?php mysqli_close($con); ?>

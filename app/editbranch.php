<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';
if(isset($_REQUEST['group'])){
	
	$gid=$_REQUEST['id'];
	$branchname = $_REQUEST['branchname'];
	$branchcode = $_REQUEST['branchcode'];	
	$branchmobileno=$_REQUEST['branchmobileno'];
	$branchemailid=$_REQUEST['branchemailid'];
	$branchzone=$_REQUEST['zonename'];
  $branchadd=$_REQUEST['branchadd'];
  $branchcity=$_REQUEST['branchcity'];
  $branchdict=$_REQUEST['branchdict'];
  $branchstate=$_REQUEST['branchstate'];
  $branchpin=$_REQUEST['branchpin'];
  $branch_start = $_REQUEST['branch_age'];
  $age = $_REQUEST['age'];
  $bonus = $_REQUEST['bonus'];
  $non_prize = $_REQUEST['non_prize'];
  $prize = $_REQUEST['prize'];
  $bonus_percentage = $_REQUEST['bonus_percentage'];
  $no_penality = $_REQUEST['no_penality'];
	$status="Active";
	$fd_month = $_REQUEST['fd_month'];

	$alreadychk = mysqli_query($con,"select * from tbl_branch where Name='$branchname' and Status='Active' AND Id!='$gid'");
	$fetchcnt = mysqli_num_rows($alreadychk);
	if($fetchcnt==0)
	{	
	
	$insert_details=mysqli_query($con,"UPDATE `tbl_branch` SET `Name`='$branchname',`Zone_Id`='$branchzone' ,`Code`='$branchcode',
	Branch_Phone='$branchmobileno',Branch_Email='$branchemailid',`Address`='$branchadd',`City`='$branchcity',
	`State`='$branchstate',`District`='$branchdict',`Pincode`='$branchpin',`Updated_On`='$updatedon',
	`Updated_By`='$updatedby',`Status`='$status' ,`Start_date`='$branch_start',`Age`='$age',`Fd_Month`='$fd_month',`Bonus`='$bonus',`Bonus_per`='$bonus_percentage',
	`Prize`='$prize',`Non_prize`='$non_prize',`Nonpenalty`='$no_penality' WHERE Id='$gid'");
    
	
		if($insert_details){
			echo '<script type="text/javascript">
					window.location.replace("viewbranch.php?step=edit");
					</script>';	
		}
	}	
		
	else{
		echo '<script type="text/javascript">
					window.location.replace("editbranch.php?id='.$gid.'&step=exit");
					</script>';	
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $filename; ?> Chits | Branch Edit </title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="js/jquery-1.10.2.js"></script>
    	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
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
</style>
 <script>
     $(document).ready(function() {
		var table = $('#example1') .DataTable( {
		dom:            "Cfrtip",
		scrollY:        "300px",
		scrollX:        true,
		scrollCollapse: true,
		paging:         true,   
		} );
	  }
    );
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <?php
      $readid=$_REQUEST['id'];
      $chitType=$_REQUEST['chitType'];
    //  echo $selectChit="select * from tbl_chit_structure where Status='Active' and Id='$readid'";
     // $chitType='Auction';
	if($chitType=='Commitment')
	{
		   $selectChit="select * from tbl_chit_structure where Status='Active' and Id='$readid'";
	}
   else if($chitType=='Auction')
   {
        $selectChit="select * from tbl_auction_structure where Status='Active' and Id='$readid'";
   }
    $selectChit;
    $queryExe=mysqli_query($con,$selectChit);
    $fetchdb=mysqli_fetch_array($queryExe);
    $schemeFormatdb=$fetchdb['Scheme_Format'];
	$monthdb=$fetchdb['Month'];
    $memberdb=$fetchdb['Member'];
    $regfeesdb=$fetchdb['Reg_Fees'];
	$monthlyDue=$fetchdb['Monthly_Amt'];
    if($chitType=='Commitment')
	{
    $chitvaldb=$fetchdb['Chit_value'];
	$shorttermdb=$fetchdb['Short_Term'];
    }
 if($chitType=='Auction')
   {
    $chitvaldb=$fetchdb['Chit_Value'];
    $shorttermdb=$fetchdb['Short_Terms'];
   } 
    ?>
<div class="row panel panel-primary"> 
<?php 
	$final=$_REQUEST['step'];
	if($final == "exit")
	{
	?>
	  <div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Failed!</strong> This Details Was Already Exist.
	</div>

	<?php 
	}?>
	  <div class="panel-heading lead ">
  <div class="row">
    <div class="col-lg-8 col-md-8"><label>Edit Branch Details</label></div>        
      <div class="col-lg-4 col-md-4 text-right">
        <div class="btn-group text-center">
          <a href="viewbranch.php" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Branch</a>
          <a href="viewbranch.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Branch</a>
        </div>
      </div>
  </div>
</div>
	<div class="panel-body"> 
		<div class="col-sm-12 form-group">  
		 <form class="form-horizontal" name="editbranch_details" action="" method="post" enctype="multipart/form-data">
					<?php 
			        $gid=$_REQUEST['id'];
				    $qury="SELECT * FROM `tbl_branch` WHERE Id='$gid' and Status='Active'";
					$qury_exe=mysqli_query($con,$qury);
				
					$fetch=mysqli_fetch_array($qury_exe);
					
	                $gpname=$fetch['Name'];                     
	                $gpzid=$fetch['Zone_Id'];                     
			        $gpnum=$fetch['Code']; 
					$gpmobile=$fetch['Branch_Phone'];
					$gpemail=$fetch['Branch_Email'];
                    $branchadd=$fetch['Address'];
                    $branchcity=$fetch['City'];
                    $branchdict=$fetch['District'];
                    $branchstate=$fetch['State'];
                    $branchpin=$fetch['Pincode']; 
                    $startdate = $fetch['Start_date']; 
                    $age = $fetch['Age']; 
                    $non_prize = $fetch['Non_prize']; 
                    $prize = $fetch['Prize']; 
                    $non_penalty = $fetch['Nonpenalty']; 
                    $bonus = $fetch['Bonus']; 
                    $bonus_per = $fetch['Bonus_per']; 
                    $fd_month = $fetch['Fd_Month']; 
                   
					?>
                                         
                        
                      
					   <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Branch Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                       <input type="text" name="branchname" class="form-control"  value="<?php echo $gpname; ?>" id="branchname" placeholder="Branch Name" required>
                        </div>
                      
                        <label for="inputEmail" class="col-sm-2 control-label">Contact Person<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                         <input type="text" class=" form-control"  value="<?php echo $gpnum; ?>"  name="branchcode"  id="branchcode" placeholder="Branch Code" required>
                      </div>
                      </div>
					  
						<div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Phone No<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">
                         <input type="text" placeholder="Branch Phone"   id="form-field-1" class="form-control limited" maxlength="12"  name="branchmobileno" value="<?php echo $gpmobile; ?>" required>
                        </div>
                      
                        <label for="inputName" class="col-sm-2 control-label">Email Id</label>
                        <div class="col-sm-4">
                          <input type="email" name="branchemailid" class="form-control"  placeholder="Branch Email Id" value="<?php echo $gpemail; ?>" >
                        </div>
                      </div>
                      <div class="col-sm-12 form-group">
                        <label for="inputName" class="col-sm-2 control-label">Address<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-10">
                         <textarea name="branchadd" placeholder="Address" id="companyname_F" class="form-control"> <?php echo $branchadd;  ?> </textarea>
                        </div>
          </div>
                    <div class="form-group col-sm-12">
                       <label for="inputName" class="col-sm-2 control-label">City<font color="red">&nbsp;*&nbsp;</font> </label>
                       <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="branchcity"  onchange="getpin(this.value);" id="branchcity" data-live-search="true">
						 <option value="">Select Cities</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select City from tbl_city");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							
							$CityName=$fetch_GrpQry['City'];
							?>
							<option value="<?php echo $CityName;?>"<?php echo ($branchcity==$CityName)?'selected':'' ?>><?php echo $CityName; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					
                      
                        <label for="inputName" class="col-sm-2 control-label">District<font color="red">&nbsp;*&nbsp;</font> </label>
                         <div class="col-sm-4">
                        <select class="form-control selectpicker" name="branchdict" id="branchdict" data-live-search="true">
						 <option value="">Select District</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from district");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$grpName=$fetch_GrpQry['DistrictName'];
							?>
							<option value="<?php echo $grpName;?>"<?php echo ($grpName==$branchdict)?'selected':'' ?>><?php echo $grpName; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">State<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="branchstate" id="branchstate" data-live-search="true">
						 <option value="">Select States</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from state");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$StateName=$fetch_GrpQry['StateName'];
							?>
							<option value="<?php echo $StateName;?>"<?php echo ($StateName==$branchstate)?'selected':'' ?>><?php echo $StateName; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
                      
                        <label for="inputName" class="col-sm-2 control-label">Pincode<font color="red">&nbsp;*&nbsp;</font> </label>
                        <div class="col-sm-4">
                          <input type="text" name="branchpin" class="form-control" maxlength="6" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))"  placeholder="Branch Pincode" value="<?php echo $branchpin; ?>"  required>
                        </div>
                      </div>
	 
                      <div class="form-group col-sm-12">
                        <div class="col-sm-offset-5 col-sm-10">
                          <button type="submit" name="group" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
				</div>
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
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="dist/js/demo.js"></script>
<script>
        
	  $(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
</html>
<?php mysqli_close($con);?>

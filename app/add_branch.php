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
<title><?php echo $filename; ?>Chits | Branch Add</title>
<meta name="author" content="Gayathri.R.KKIT">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<script src="js/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
		
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
  <script>
             function get_zone(val) {
         //alert(val);
        $.ajax({
        type: "POST",
        url: "addbranch.php",
        data:'brnch_enrl='+val,
        success: function(data){
        $("#doc_brn").html(data);  
        //alert(data);
        }
        });
        }
		 
function getdistrict(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'state_id='+val,
	success: function(data){
		$("#district-list").html(data);
        $('#groupNameTemp').selectpicker({});
	}
	});
}

function getcity(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_city.php",
	data:'city_id='+val,
	success: function(data){
		$("#city-list").html(data);
        $('#branchcity').selectpicker({});
	}
	});
}

function getpin(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'pin_id='+val,
	success: function(data){
		$("#pin-list").html(data);
        $('#branchcity').selectpicker({});
	}
	});
}

// function selectCountry(val) {
// $("#search-box").val(val);
// $("#suggesstion-box").hide();
// }
	
	
  </script>
	<!--<script src="js/jquery.min.js"></script>-->
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
   min-height : 450px;
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
  	<?php
  	if(isset($_REQUEST['submit']))
{
	$account = $_REQUEST['branch'];
	$acountcode = $_REQUEST['branchcode'];
    $branchmobileno=$_REQUEST['branchmobileno'];
	$branchemailid=$_REQUEST['branchemailid'];
	$branchzone=$_REQUEST['zonename'];
	$branchadd=$_REQUEST['branchadd'];
    $branchcity=$_REQUEST['branchcity'];
    $branchdict=$_REQUEST['branchdict'];
    $branchstate=$_REQUEST['branchstate'];
    $branchpin=$_REQUEST['branchpin'];
    $branchremark=$_REQUEST['branchremark'];
    $bonus = $_REQUEST['bonus'];
    $bonus_per=$_REQUEST['bonus_percentage'];
	$fd_month = $_REQUEST['fd_month'];
	$gst_no = $_REQUEST['gst_no'];
	
	$no_penality=$_REQUEST['no_penality'];
	$prize=$_REQUEST['prize'];
    $non_prize=$_REQUEST['non_prize'];
    $branch_age=$_REQUEST['age_F'];
    $start_date=$_REQUEST['dob_F'];
	$newDate = date("d-m-Y", strtotime($start_date));
	$status="Active";
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$cmonth=date("m");
    $cyear=date("y");

	$alreadychk = mysqli_query($con,"select * from tbl_branch where Name='$account' and Status='Active' ");
	$fetchcnt = mysqli_num_rows($alreadychk);
	if($fetchcnt==0)
	{	 
		$insert_details = mysqli_query($con,"insert into tbl_branch(`Name`,`Code`,`Branch_Phone`,`Branch_Email`,`Zone_Id`,`Address`,`City`,`State`,`District`,`Pincode`,`Remark`,`Created_On`, `Created_By`, `Updated_on`, `Updated_By`,`Status`,`Bonus`,`Bonus_per`,`Nonpenalty`,`Prize`,`Non_prize`,`Start_date`,`Age`,`Fd_Month`,`GST_No`)
		values('$account','$acountcode','$branchmobileno','$branchemailid','$branchzone','$branchadd','$branchcity','$branchstate','$branchdict','$branchpin','$branchremark','$createdon','$createdby','$updatedon','$updatedby', '$status','$bonus','$bonus_per','$no_penality','$prize','$non_prize','$newDate','$branch_age','$fd_month','$gst_no')");  
   if($insert_details){
			 echo '<script type="text/javascript">
					window.location.replace("viewbranch.php?step=suces");
					</script>';	
			
		}
		 
	}
	else{
		 echo '<script type="text/javascript">
					window.location.replace("viewbranch.php?step=exit");
					</script>';
	}
	 
}
?>
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <div class="col-lg-8 col-md-8"><label>Add Branch Details</label></div>        
      <div class="col-lg-4 col-md-4 text-right">
        <div class="btn-group text-center">
          <a href="viewbranch.php" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Branch</a>
        </div>
      </div>
  </div>
</div>
<?php 
	$sno=mysqli_query($con,"SELECT MAX(Id) as Id FROM tbl_branch");
		$s_no_select=mysqli_fetch_array($sno);		
		$curyear=date("y");
		$fetchlastnum=$s_no_select['Id']+1; 
		$max_custid=$s_no_select['Id']; 

	if(!empty($max_custid))
	{
		$curnt_brnid = $max_custid+1;

	
	
	if(strlen($fetchlastnum)=='1')
		{
		$newid="0".$fetchlastnum;	
		}
	else
		{
		$newid=$fetchlastnum;	
		}


		$curnt_brnid="B".$curyear.$newid; 
		}
	else
	{
		$curnt_brnid = 'B'.$curyear."01"; 
	}	
	?>
    <div class="panel-body"> 
    <div class="col-sm-12 form-group">  
                    <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
                      
                          <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Name of Branch<font color="red">&nbsp;*&nbsp;</font></label>
						 <div class="col-sm-4">
							<input type="text" name="branch" class="form-control" onKeyUp="$(this).val($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" placeholder="Branch" required>
						</div>
					
							<label for="inputName" class="col-sm-2 control-label">Contact Person<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
							<input type="text" name="branchcode" class="form-control"  placeholder="Contact Person" required>
						</div>
						</div>
						
						 <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">Phone No</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="Phone No" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" maxlength="12" id="form-field-1" class="form-control limited" pattern=".{10,10}" name="branchmobileno">
						</div>
						
							<label for="inputName" class="col-sm-2 control-label">Email Id</label>
							<div class="col-sm-4">
							<input type="email" name="branchemailid" class="form-control"  placeholder="Branch Email Id">
						  </div>
						</div>
						 
          <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label" >Address<font color="red">&nbsp;*&nbsp;</font></label>
            <div class="col-sm-10">
              <textarea class="form-control" name="branchadd" placeholder="Address" required></textarea>
            </div>
                      </div>

                        <label for="inputName" class="col-sm-2 control-label">State<font color="red">&nbsp;*&nbsp;</font> </label>
                       <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="branchstate" id="branchstate" onChange="getdistrict(this.value);" data-live-search="true">
						<option value="">Select</option>
                   								<?php $query =mysqli_query($con,"SELECT * FROM state");
while($row=mysqli_fetch_array($query))
{ ?>
<option value="<?php echo $row['StateName'];?>"><?php echo $row['StateName'];?></option>
<?php
}
?>
						 </select>
						 </div>
                      
						 <div id="district-list"></div>
						                     <div class="form-group col-sm-12">
                        <div id="city-list"></div>
						 <div id="pin-list"></div>
                      </div>
                       <div class="form-group col-sm-12">
						 <label for="inputName" class="col-sm-2 control-label">GST No</label>
						 <div class="col-sm-4">
							<input type="text" placeholder="GST No" id="form-field-1" class="form-control limited" name="gst_no">
						</div>
						
						</div>
                  
                      <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label" >Remark</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="branchremark" placeholder="Remark"></textarea>
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
                  </div><!-- /.tab-pane -->
		</div>
	</div>
       <!-- /.content -->
       </div><!-- /.content-wrapper -->
	  </div>
      
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

<!--- start control sidebar ->
<?php //include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
      <div class="control-sidebar-bg"></div>

   <!-- ./wrapper -->
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
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>
</html>
<?php mysqli_close($con);?>

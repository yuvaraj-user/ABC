
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $group_id = $_REQUEST['group_id'];
 $dist_id = $_REQUEST['dist_id'];
 
if(!empty($group_id)) {
	
	?>
		
						   <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >District<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="district" id="district" onchange="get_pds(this.value);" data-live-search="true" required>
						  <option value="">Select District</option>
						  
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Name,Id from tbl_district WHERE Status='Active' AND Group_Id='$group_id'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							
							?>
							<option value="<?php echo $Id;?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					 </div>
						  
<?php 
  
} 
if(!empty($dist_id)) {
?>

<div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >PDS<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="customer" id="customer" onchange="get_dc_details(this.value);" data-live-search="true" required>
						 <option value="">Select PDS</option>
						 
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select * from tbl_employee WHERE Status='Active' AND District_Id='$dist_id'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $Id;?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					 </div>
<?php } ?>
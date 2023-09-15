
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $group_id = $_REQUEST['group_id'];
 $district_id = $_REQUEST['district_id'];
 
if(!empty($group_id)) {
   
	
	?>
		 <label for="inputName" class="col-sm-2 control-label">Shop<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
							<select class="form-control multiselect" multiple data-actions-box="true" name="shop[]" id="shop" data-live-search="true" required>
						
						  
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Name,Id from tbl_shop WHERE Status='Active' AND Group_Id='$group_id' AND District_Id='$district_id'");
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
						  
						  
<?php 
  
} 

?>

	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
  $row_id = $_REQUEST['group_id'];
 $district_id = $_REQUEST['district_id'];

						
						 $qury="SELECT * FROM `tbl_coordinator` WHERE Id='$row_id' and Status='Active'";
			                $qury_exe=mysqli_query($con,$qury);
			                $fetch_shop=mysqli_fetch_array($qury_exe);        
			                $shp_id = $fetch_shop["Shop_Id"]; 
							
if(!empty($district_id)) {
   
	
	?>
		 <label for="inputName" class="col-sm-2 control-label">Shop<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
							<select class="form-control multiselect" multiple data-actions-box="true" name="shop[]" id="shop" data-live-search="true" required>
						
						  
							
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Name,Id from tbl_shop WHERE Status='Active' AND District_Id='$district_id'");
							$i=0;
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
								  
                            $shp_id_exct = explode(',',$shp_id);
							$Name=$fetch_GrpQry['Name'];
							$Id=$fetch_GrpQry['Id'];
							
							
							?>
							<option value="<?php echo $Id;?>"<?php if($shp_id_exct[$i] == $Id) echo 'selected';?>><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						  </div>
						  
						  
<?php 
  
} 

?>
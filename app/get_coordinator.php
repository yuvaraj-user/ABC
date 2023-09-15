<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $shop_id = $_REQUEST['group_id'];
 $select_GrpQry=mysqli_query($con,"select d.Name as dist_name,t.Name as coordinator_name from tbl_shop s LEFT JOIN tbl_district d on s.District_Id=d.Id LEFT JOIN tbl_coordinator t on s.Coordinator_Id=t.Id WHERE s.Id='$shop_id'");
 $fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
 $Name=$fetch_GrpQry['dist_name'];
 $coordinator_name=$fetch_GrpQry['coordinator_name'];
if(!empty($shop_id)) {
   
	?>
		<div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >District</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
							<input type="text" id="district"  class="form-control limited" value="<?php echo $Name; ?>" name="district" readonly>
						 </div>
					 </div>
					 
						<div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >District Coordinator</label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
							<input type="text" id="co_ordi"  class="form-control limited" value="<?php echo $coordinator_name; ?>" name="co_ordi" readonly>
						 </div>
					 </div>
				 
						  
<?php 
} 
?>
<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $coordi_id = $_REQUEST['coordi_id'];
 
if(!empty($coordi_id)) {
   $target = 0;
   $target_sale =0;
   $target_sale_return =0;
  $select_GrpQry=mysqli_query($con,"select SUM(Quantity) as sid from tbl_sales_target WHERE Customer_Id='$coordi_id'");
 $fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
 $target=$fetch_GrpQry['sid'];
 
 $select_GrpQry=mysqli_query($con,"select SUM(Quantity) as sid from tbl_sales_order WHERE Customer_Id='$coordi_id'");
 $fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
 $target_sale=$fetch_GrpQry['sid'];
 
  //$select_GrpQry=mysqli_query($con,"select SUM(Quantity) as sid from tbl_sales_return WHERE Customer_Id='$coordi_id'");
// $fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
 //$target_sale_return=$fetch_GrpQry['sid'];
 
 $bal_sale =$target - $target_sale;
	?>
	<div class="row">   
<div class="form-group col-sm-4">
						<label for="inputName" class="col-sm-4 control-label" >Shop<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="shop" id="shop" data-live-search="true" required>
						 <option value="">Select Product</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_shop WHERE Status='Active' AND Coordinator_Id='$coordi_id'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Name'];
							$tid=$fetch_GrpQry['Id'];
							?>
							<option value="<?php echo $tid."/".$Name; ?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						</div> 
				
		 <div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Target</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" id="target" value="<?php echo $target; ?>" class="limited" style="width:80%;" maxlength="15" readonly>
							
							
							</div>
							
							
							</div>
							
		 <div class="form-group col-sm-4">
					      
						  <label for="inputName" class="col-sm-4 control-label">Balance</label>
						   <div class="col-sm-8" style="margin-left: 0px;">
							<input type="text" maxlength="15" id="target" value="<?php echo $bal_sale; ?>"  class="limited" style="width:80%;" maxlength="15" readonly>
							
							
							</div>
							
							
							</div>	</div>
						<?php 
} 
?>
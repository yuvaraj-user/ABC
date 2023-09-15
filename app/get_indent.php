
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
 $district_id = $_REQUEST['dist_id'];
 
if(!empty($district_id)) {
   
	
	?>
		 <div class="form-group col-sm-4">
	                    <label for="inputName" class="col-sm-4 control-label" >Indent No<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-8" style="margin-left: 0px;">						
						 <select class="form-control selectpicker" name="indent" id="indent" onchange="get_indent_sale_det(this.value);" data-live-search="true" required>
						  <option value="">Select District</option>
						  
						 <?php 
						    $select_GrpQry=mysqli_query($con,"select Order_No,Id from tbl_sales_order WHERE Status='Active' AND Customer_Id='$district_id'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							$Name=$fetch_GrpQry['Order_No'];
							$Id=$fetch_GrpQry['Id'];
							
							?>
							<option value="<?php echo $Name;?>"><?php echo $Name; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
					 </div>
						  
						  
<?php 
  
} 

?>
	<script src="dist/js/bootstrap-select.js"></script>

<?php
require_once "srdb.php";
if(!empty($_REQUEST["state_id"])) 
{
 $state = $_REQUEST["state_id"];
?>
	 
                      <label for="inputName" class="col-sm-2 control-label">District </label>
                        <div class="col-sm-4">
						 
                         <select class="form-control selectpicker" name="district" id="groupNameTemp" onchange="getcity(this.value);" data-live-search="true">
						 
						 
						 <?php 
						$query =mysqli_query($con,"SELECT * FROM district WHERE State_Name = '$state'");
							?>
<option value="">Select District</option>
<?php
while($row=mysqli_fetch_array($query))  
{
?>
<option value="<?php echo $row["DistrictName"]; ?>"><?php echo $row["DistrictName"]; ?></option>
<?php
} ?>
</div>
<?php
}
?>

<?php

if(!empty($_REQUEST["district_id"])) 
{
 $state = $_REQUEST["district_id"];
?>
	 <div class="col-sm-12 form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">City</label>
                       <div class="col-sm-4">						
						 <select class="form-control selectpicker" name="city"  onchange="getpin(this.value);" id="branchcity" data-live-search="true">
						 <option value="">Select Cities</option>
						 <?php 
						 $select_GrpQry=mysqli_query($con,"select * from tbl_city where District='$state'");
							while($fetch_GrpQry=mysqli_fetch_array($select_GrpQry))
							{
							
							$CityName=$fetch_GrpQry['City'];
							?>
							<option value="<?php echo $CityName;?>"><?php echo $CityName; ?></option>
						<?php 
							}
						 ?>
						 </select>
						 </div>
						  </div>
						 <?php
}
?>

<?php

if(!empty($_REQUEST["pin_id"])) 
{
 $pin = $_REQUEST["pin_id"];
?>
	
	  <?php 
						    $select_GrpQry=mysqli_query($con,"select * from tbl_city where city='$pin'");
							$fetch_GrpQry=mysqli_fetch_array($select_GrpQry);
							$pin=$fetch_GrpQry['Pincode'];
							?>
							<label for="inputName" class="col-sm-2 control-label">Pincode </label>
                        <div class="col-sm-4">
                          <input type="text" name="pincode" class="form-control" value="<?php echo $pin; ?>" maxlength="6" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" placeholder="Branch Pincode">
                        </div>
                      
						
						 </div>
						 <?php
}
?>
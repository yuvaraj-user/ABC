
	<script src="dist/js/bootstrap-select.js"></script>
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$tax_id = $_REQUEST['tax_id'];
if(!empty($tax_id)) {
	
	                $qury="select * from tbl_tax where Id='$tax_id'";
					$qury_exe=mysqli_query($con,$qury);
					$fetch=mysqli_fetch_array($qury_exe);
					$cgst = $fetch['Cgst'];
					$sgst = $fetch['Sgst'];
					$igst = $fetch['Igst'];
					$hsn = $fetch['Hsn'];
	                
	
	?>
		 <label for="inputName" class="col-sm-1 control-label">CGST</label>
						   <div class="col-sm-1">
							<input type="text" value="<?php echo $cgst; ?>" placeholder="cgst" id="state_code" class="form-control limited" maxlength="15" name="cgst" required>
							
						</div>
						  <label for="inputName" class="col-sm-1 control-label">SGST</label>
						   <div class="col-sm-1">
							<input type="text" value="<?php echo $sgst; ?>" placeholder="sgst" id="state_code" class="form-control limited" maxlength="15" name="sgst" required>
							
						</div>
						  <label for="inputName" class="col-sm-1 control-label">IGST</label>
						   <div class="col-sm-1">
							<input type="text" placeholder="igst" value="<?php echo $igst; ?>" id="state_code" class="form-control limited" maxlength="15" name="igst" required>
							
						</div>
						<label for="inputName" class="col-sm-1 control-label">HSN code</label>
							<div class="col-sm-2">
							<input type="text" name="hsn" value="<?php echo $hsn; ?>" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))"  class="form-control"  placeholder="HSN">
						  </div>
						  
						  
						  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
<?php 
  
}

?>


<?php  
session_start();
require 'checkagain.php';
include_once("srdb.php");
date_default_timezone_set("Asia/Kolkata");
?>

<?php
if(!empty($_POST["div_doc"])) { 

						
		$permission= $_POST["div_doc"];	
		
		                $permission_Array=array();
		
		
						 $get_Permission= mysqli_query($con,"select * from tbl_user_role where Id='$permission'");

                         $permission_Execute=mysqli_fetch_array($get_Permission);
						 
						 $permission1= $permission_Execute['Permission'];
						 $edit_permission= $permission_Execute['Role_edit'];
						 $delete_permission= $permission_Execute['Role_delete'];
						 $add_permission= $permission_Execute['Role_add'];
						  
                        $permissionlist=explode(',',$permission1);
						$edit_permissionlist=explode(',',$edit_permission);
						$delete_permissionlist=explode(',', $delete_permission);
						$add_permissionlist=explode(',', $add_permission);
						
						 
						foreach($permissionlist as $value){
						 	$permission_Array[] = $value;
							
						}
						foreach($edit_permissionlist as $value1){
						 	$edit_permission_Array[] = $value1;
							
						}
						foreach($delete_permissionlist as $value2){
						 	$delete_permission_Array[] = $value2;
							
						}
						foreach($add_permissionlist as $value3){
						    $add_permission_Array[] = $value3;
							
						}
					// print_r($permission_Array);
						


?>



		
		 
    <div class="panel-body"> 
	<div class="col-sm-12 form-group">  
	<form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
    
                    
						<!-- <div class="form-group col-sm-12 col-md-12"> 
						<div class="container">
                             <div class="panel panel-default"  id="heading">
                             <div class="panel-heading"><h4 style=" text-align: center;">
							 <input style=" text-align: center;" type="checkbox" value="h3" <?php if (in_array(h3,$permission_Array)) { echo "checked"; }?> class="customer_head" id="customer_head" name="permission[]"/>
							 <b>Subscriber Management</b></h4></div>
                             </div>
                             </div>
							 <div id="customer_div" class="customer_div form-group" style="display:none">
							<div class="col-sm-3 col-md-3" id="tab8">			
							    <input type="checkbox" name="checkAll7" id="checkAll7"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="8" class="child_customer customer" id="customer" name="permission[]" <?php if (in_array(8,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Subscriber Details </label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.1" class="child_customer customer" id="customer_add" name="add[]" <?php if (in_array(8.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.2" class="child_customer customer" id="customer_edit" name="edit[]" <?php if (in_array(8.2,$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="8.3" class="child_customer customer" id="customer_delete" name="delete[]" <?php if (in_array(8.3,$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>	
							
							<div class="col-sm-3 col-md-3" id="tab9">	
							    <input type="checkbox" name="checkAll8" id="checkAll8"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="9" class="child_enroll customer" id="enroll" name="permission[]" <?php if (in_array(9,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Enrollment Details</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.1" class="child_enroll customer" id="enroll_add" name="add[]" <?php if (in_array(9.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.2" class="child_enroll customer" id="enroll_edit" name="edit[]" <?php if (in_array(9.2,$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="9.3" class="child_enroll customer" id="enroll_delete" name="delete[]" <?php if (in_array(9.3,$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>	
							
							<div class="col-sm-3 col-md-3" id="tab10">	
							    <input type="checkbox" name="checkAll9" id="checkAll9"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="10" class="child_document customer" id="document" name="permission[]" <?php if (in_array(10,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Document Details</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="10.1" class="child_document customer" id="document_add" name="add[]" <?php if (in_array(10.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
							</div>	
							
							<div class="col-sm-3 col-md-3" id="tab11">	
							    <input type="checkbox" name="checkAll10" id="checkAll10"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="11" class="child_auction customer" id="auction" name="permission[]" <?php if (in_array(11,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Auction Details</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.1" class="child_auction customer" id="auction_add" name="add[]" <?php if (in_array(11.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.2" class="child_auction customer" id="auction_edit" name="edit[]" <?php if (in_array(11.2,$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="11.3" class="child_auction customer" id="auction_delete" name="delete[]" <?php if (in_array(11.3,$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>		
							
                            <div class="col-sm-3 col-md-3" id="tab12">	
							   <input type="checkbox" name="checkAll11" id="checkAll11"/>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="12" class="child_collection customer" id="collection" name="permission[]" <?php if (in_array(12,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Collection Activity</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="12.1" class="child_collection customer" id="collection_add" name="add[]" <?php if (in_array(12.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" value="12.2" class="child_collection customer" id="collection_delete" name="delete[]" <?php if (in_array(12.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label"></span>
								<br>
							</div>	
                           
                            <div class="col-sm-3 col-md-3" id="tab75">	
								<input type="checkbox" value="d13"  <?php if (in_array(d13,$permission_Array)) { echo "checked"; }?> class="child_collection customer" id="collection" name="permission[]"/></label>
								<label class="control-label">Dummy Subscribers </label>	
								<br>
							</div>
							<div class="col-sm-3 col-md-3" id="tab76">	
								<input type="checkbox" value="r75" <?php if (in_array(r75,$permission_Array)) { echo "checked"; }?> class="child_collection customer" id="collection" name="permission[]"/></label>
								<label class="control-label">Subscriber Document details </label>	
								<br>
							</div>		
							<div class="col-sm-3 col-md-3" id="tab77">	
								<input type="checkbox" value="r159" <?php if (in_array(r159,$permission_Array)) { echo "checked"; }?> class="child_collection customer" id="collection" name="permission[]"/></label>
								<label class="control-label">Subscriber Merging </label>	
								<br>
								<br>
											<input type="checkbox" value="r179" <?php if (in_array(r179,$permission_Array)) { echo "checked"; }?> class="child_prize customer" id="customer" name="permission[]"/></label>
										<label class="control-label">Subscriber Ledger </label><br>
										<br>
										<input type="checkbox" value="r221" <?php if (in_array(r221,$permission_Array)) { echo "checked"; }?> class="child_sms_sub customer" id="customer" name="permission[]"/></label>
										<label class="control-label">SMS Subscriber wise </label>
										<br>
							</div>									
						</div> </div>  -->
						
						<div class="form-group col-sm-12 col-md-12">
						
						<div class="container">
                             <div class="panel panel-default" id="heading">
                             <div class="panel-heading"><h4 style=" text-align: center;">
							 <input style=" text-align: center;" value="h1" type="checkbox" <?php if (in_array(h1,$permission_Array)) { echo "checked"; }?>  class="masters_head" id="masters_head" name="permission[]"/> <b>Masters</b></h4></div>
                             </div>
                             </div>
						<div id="masters_div" class="masters_div form-group" style="display:none">
						   <input type="hidden" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $permission; ?>" required>
							<div class="col-sm-3 col-md-3" id="tab1">		
								<input type="checkbox" name="checkAll" id="checkAll"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="hidden" value="" name="id" />
								<input type="checkbox" value="r1" class="child_zone masters" id="zone" name="permission[]" onLoad="myFunction()" <?php if (in_array("r1",$permission_Array)) { echo "checked"; }?> /></label>
								<label class="control-label">Products</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r1.1" class="child_zone masters" onLoad="myFunction()" id="zone_add" name="add[]"  <?php if (in_array("r1.1",$add_permission_Array)) { echo "checked"; }?> /></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r1.2" class="child_zone masters" onLoad="myFunction()" id="zone_edit" name="edit[]"  <?php if (in_array("r1.2",$edit_permission_Array)) { echo "checked"; }?> /></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  value="r1.3" class="child_zone masters" onLoad="myFunction()" id="zone_delete" name="delete[]"  <?php if (in_array("r1.3",$delete_permission_Array)) { echo "checked"; }?> /></label>
								<span class="control-label">Delete</span>
							</div>	
							
							<div class="col-sm-3" id="tab2">	
							    <input type="checkbox" name="checkAll1" id="checkAll1"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r2" class="child_branch" id="branch" name="permission[]"  <?php if (in_array("r2",$permission_Array)) { echo "checked"; }?> /></label>
								<label class="control-label">Product Group</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r2.1" class="child_branch masters " id="branch_add" name="add[]" <?php if (in_array("r2.1",$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r2.2" class="child_branch masters" id="branch_edit" name="edit[]" <?php if (in_array("r2.2",$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r2.3" class="child_branch masters" id="branch_delete" name="delete[]" <?php if (in_array("r2.3",$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>	
							
							<div class="col-sm-3" id="tab3">
                                <input type="checkbox" name="checkAll2" id="checkAll2"/></label>
								<label class="control-label">Select All</label>
								<br>							
								<input type="checkbox" value="r3" class="child_scheme masters" id="scheme" name="permission[]" <?php if (in_array(r3,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Supplier</label>
								<br>
						 		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r3.1" class="child_scheme masters" id="scheme_add" name="add[]" <?php if (in_array("r3.1",$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r3.2" class="child_scheme masters" id="scheme_edit" name="edit[]" <?php if (in_array("r3.2",$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r3.3" class="child_scheme masters" id="scheme_delete" name="delete[]" <?php if (in_array("r3.3",$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>	
							
							<div class="col-sm-3" id="tab4">	
							    <input type="checkbox" name="checkAll3" id="checkAll3"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r4" class="child_group" id="group" name="permission[]" <?php if (in_array("r4",$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Customer</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r4.1" class="child_group masters" id="group_add" name="add[]" <?php if (in_array("r4.1",$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r4.2" class="child_group masters" id="group_edit" name="edit[]" <?php if (in_array("r4.2",$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r4.3" class="child_group masters" id="group_delete" name="delete[]" <?php if (in_array("r4.3",$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>			
							<div class="col-sm-3" style="margin-top:20px" id="tab16">	
							    <input type="checkbox" name="checkAll16" id="checkAll16"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r5" class="child_config masters" <?php if (in_array(r5,$permission_Array)) { echo "checked"; }?> id="child_config masters" name="permission[]"/></label>
								<label class="control-label">UOM</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if (in_array("r5.1",$add_permission_Array)) { echo "checked"; }?> value="r5.1" class="child_config masters" id="child_config masters" name="add[]"/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if (in_array("r5.2",$edit_permission_Array)) { echo "checked"; }?> value="r5.2" class="child_config masters" id="child_config masters" name="edit[]"/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if (in_array("r5.3",$delete_permission_Array)) { echo "checked"; }?> value="r5.3" class="child_config masters" id="child_config masters" name="delete[]"/></label>
								<span class="control-label">Delete</span>
							</div>
									
                            <div class="col-sm-3" style="margin-top:20px" id="tab19">	
							    <input type="checkbox" name="checkAll19" id="checkAll19"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r6" class="child_bank masters" <?php if (in_array(r6,$permission_Array)) { echo "checked"; }?>  id="child_bank" name="permission[]"/></label>
								<label class="control-label">Tax</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r6.1" <?php if (in_array("r6.1",$add_permission_Array)) { echo "checked"; }?> class="child_bank masters" id="child_bank" name="add[]"/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r6.2" <?php if (in_array("r6.2",$edit_permission_Array)) { echo "checked"; }?> class="child_bank masters" id="child_bank" name="edit[]"/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r6.3" <?php if (in_array("r6.3",$delete_permission_Array)) { echo "checked"; }?> class="child_bank masters" id="child_bank" name="delete[]"/></label>
								<span class="control-label">Delete</span>
							</div>
							<div class="col-sm-3" style="margin-top:20px" id="tab20">	
							    <input type="checkbox" name="checkAll20" id="checkAll20"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="23" class="child_slab masters" <?php if (in_array(23,$permission_Array)) { echo "checked"; }?> id="child_slab" name="permission[]"/></label>
								<label class="control-label">Role</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="23.1" <?php if (in_array("23.1",$add_permission_Array)) { echo "checked"; }?> class="child_slab masters" id="child_slab" name="add[]"/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="23.2" <?php if (in_array("23.2",$edit_permission_Array)) { echo "checked"; }?> class="child_slab masters" id="child_slab" name="edit[]"/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="23.3" <?php if (in_array("23.3",$delete_permission_Array)) { echo "checked"; }?> class="child_slab masters" id="child_slab" name="delete[]"/></label>
								<span class="control-label">Delete</span>
							</div>						
						</div>  </div> <br> <br> <br>
						
						<div class="form-group col-sm-12 col-md-12">
						    <div class="container">
                             <div class="panel panel-default"  id="heading">
                             <div class="panel-heading"><h4 style=" text-align: center;">
							 <input style=" text-align: center;" type="checkbox" value="h4" <?php if (in_array(h4,$permission_Array)) { echo "checked"; }?> class="employee_head" id="employee_head" name="permission[]"/>
							 <b>Employee Management</b></h4></div>
                             </div>
                            </div>
							<div id="employee_div" class="employee_div form-group" style="display:none">
							<div class="col-sm-3" id="tab6">	
							    <input type="checkbox" name="checkAll5" id="checkAll5"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="6" class="child_login emply" id="login" name="permission[]" <?php if (in_array(6,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Login Details</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="6.1" class="child_login emply" id="login_add" name="add[]" <?php if (in_array(6.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="6.2" class="child_login emply" id="login_edit" name="edit[]" <?php if (in_array(6.2,$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="6.3" class="child_login emply" id="login_delete" name="delete[]" <?php if (in_array(6.3,$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>	
							<div class="col-sm-3" id="tab5">		
                                <input type="checkbox" name="checkAll4" id="checkAll4"/></label>
								<label class="control-label">Select All</label>
								<br>							
								<input type="checkbox" value="5" class="child_employee emply"  id="employee" name="permission[]" <?php if (in_array(5,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Employee Details</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="5.1" class="child_employee emply" id="emply_add" name="add[]" <?php if (in_array(5.1,$add_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="5.2" class="child_employee emply" id="emply_edit" name="edit[]" <?php if (in_array(5.2,$edit_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Edit</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="5.3" class="child_employee emply" id="emply_delete" name="delete[]" <?php if (in_array(5.3,$delete_permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Delete</span>
							</div>
							
							 
							<div class="col-sm-3" style="margin-top:20px" id="tab200">	
								<br>
								<input type="checkbox" value="u1" <?php if (in_array(u1,$permission_Array)) { echo "checked"; }?> class="child_access emply" id="user_head" name="permission[]"/></label>
								<label class="control-label">User Access</label>	
								<br>
							</div>	
							 
						</div> 
						</div> <br> <br> <br>
						<div class="form-group col-sm-12 col-md-12"> 
						<div class="container">
                             <div class="panel panel-default"  id="heading">
                             <div class="panel-heading"><h4 style=" text-align: center;">
							 <input style=" text-align: center;" type="checkbox" value="h2" <?php if (in_array(h2,$permission_Array)) { echo "checked"; }?> class="trans_head" id="trans_head" name="permission[]"/>
							 <b>Transactions</b></h4></div>
                             </div>
                             </div>
							  <div id="trans_div" class="trans_div form-group" style="display:none">
							<div class="col-sm-4" id="tab14">		
                                <input type="checkbox" name="checkAll13" id="checkAll13"/>
								<label class="control-label">Select All</label>
								<br>							
								<input type="checkbox" value="r31" class="child_recpt trans" id="customer" name="permission[]" <?php if (in_array(r31,$permission_Array)) { echo "checked"; }?>/></label>
								<label class="control-label">Purchase Management </label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r11" class="child_recpt trans" id="recpt_add" name="permission[]" <?php if (in_array(r11,$permission_Array)) { echo "checked"; }?>/></label>
								<span class="control-label">Purchase</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r15" <?php if (in_array(r15,$permission_Array)) { echo "checked"; }?> class="child_advance trans" id="child_advance" name="permission[]"/></label>
								<span class="control-label">Purchase Return </span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r33" class="child_recpt trans" id="recpt_delete" name="permission[]" <?php if (in_array(r33,$permission_Array)) { echo "checked"; }?> /></label>
								<span class="control-label">GRN</span>
									<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r41" <?php if (in_array(r41,$permission_Array)) { echo "checked"; }?> class="child_report trans" id="child_report" name="permission[]"/></label>
						<span class="control-label">Purchase Order</span>
							</div>
							
							<div class="col-sm-4" id="tab31">	
							    <input type="checkbox" name="checkAll31" id="checkAll31"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r32" class="child_cash_entry" <?php if (in_array(r32,$permission_Array)) { echo "checked"; }?> id="child_cash_entry" name="permission[]"/></label>
								<label class="control-label">Sales Management</label>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r12" <?php if (in_array(r12,$permission_Array)) { echo "checked"; }?> class="child_cash_entry trans" id="child_cash_entry" name="permission[]"/></label>
								<span class="control-label">Sales</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r16" <?php if (in_array(r16,$permission_Array)) { echo "checked"; }?> class="child_cash_entry trans" id="child_cash_entry" name="permission[]"/></label>
								<span class="control-label">Sales Return </span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r34" <?php if (in_array(r34,$permission_Array)) { echo "checked"; }?> class="child_cash_entry trans" id="child_cash_entry" name="permission[]"/></label>
								<span class="control-label">DC</span>
								<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r44" <?php if (in_array(r44,$permission_Array)) { echo "checked"; }?> class="child_report trans" id="child_report" name="permission[]"/></label>
						<span class="control-label">Sales Order</span>
							</div>	
							<div class="col-sm-4" id="tab29">	
							    <input type="checkbox" name="checkAll29" id="checkAll29"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r35,r36" class="child_extra_charge trans" <?php if (in_array("r36",$permission_Array)) { echo "checked"; }?> id="child_extra_charge" name="permission[]"/></label>
								<label class="control-label">Enquiry Management
								</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r36.1"  <?php if (in_array("r36.1",$add_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="add[]"/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r36.2" <?php if (in_array("r36.2",$edit_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="edit[]"/></label>
								<span class="control-label">Follow</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r36.3" <?php if (in_array("r36.3",$delete_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="delete[]"/></label>
								<span class="control-label">In Active</span>
							</div>	
							<div class="col-sm-4" id="tab38">	
							    <input type="checkbox" name="checkAll38" id="checkAll38"/></label>
								<label class="control-label">Select All</label>
								<br>
								<input type="checkbox" value="r37,r38" class="child_call_register trans" <?php if (in_array("r38",$permission_Array)) { echo "checked"; }?> id="child_extra_charge" name="permission[]"/></label>
								<label class="control-label">Call Register
								</label>	
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r38.1"  <?php if (in_array("r38.1",$add_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="add[]"/></label>
								<span class="control-label">Add</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r38.2" <?php if (in_array("r38.2",$edit_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="edit[]"/></label>
								<span class="control-label">Allocate</span>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="r38.3" <?php if (in_array("r38.3",$delete_permission_Array)) { echo "checked"; }?> class="child_extra_charge trans" id="child_extra_charge" name="delete[]"/></label>
								<span class="control-label">In Active</span>
							</div>	
							
							<div class="col-sm-4" id="tab50">	
								<input type="checkbox" value="r13" <?php if (in_array(r13,$permission_Array)) { echo "checked"; }?> class="child_penalty trans" id="child_penalty" name="permission[]"/></label>
								<label class="control-label">Payment</label>
								<br>
							</div>	
							<div class="col-sm-4" id="tab51" style="margin-top:20px">	
								<input type="checkbox" value="r14" <?php if (in_array(r14,$permission_Array)) { echo "checked"; }?> class="child_cash_entry trans" id="child_penalty" name="permission[]"/></label>
								<label class="control-label">Receipt</label>
								<br>
							</div>	
						</div> </div>
						</br>
						</br>
						</br>
						</br>
						 <div class="form-group col-sm-12 col-md-12"> 
						<div class="container">
                             <div class="panel panel-default"  id="heading">
                             <div class="panel-heading"><h4 style=" text-align: center;">
							  <input style=" text-align: center;" type="checkbox" value="h3" <?php if (in_array(h3,$permission_Array)) { echo "checked"; }?> class="report_head" id="report_head" name="permission[]"/>
							  <b>Reports</b></h4></div>
                             </div>
                             </div>
							  <div id="report_div" class="report_div form-group" style="display:none">
							<div class="col-sm-12" id="tab17" >	
					<div class="col-sm-3">
                        <div class="container">
                             <div class="panel">
                             <div class="panel-heading"><h4>
							 <input  type="checkbox" value="h3" <?php if (in_array(h3,$permission_Array)) { echo "checked"; }?> class="report_head_out" id="report_head_out" name="permission[]"/> <b>Reports</b></h4></div>
                             </div>
                             </div>
							  <div id="report_div_out" class="report_div_out form-group" style="display:none">
							<input type="checkbox" value="r21" <?php if (in_array(r21,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Purchase Report </span>
								<br>
							<input type="checkbox" value="r22" <?php if (in_array(r22,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Sales Report </span>
								<br>
							<input type="checkbox" value="r23" <?php if (in_array(r23,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Purchase Return Report </span>
								<br>
								<input type="checkbox" value="r24" <?php if (in_array(r24,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Sales Return Report </span>
								<br>
								<input type="checkbox" value="r25" <?php if (in_array(r25,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Product Report </span>
								<br>
								<input type="checkbox" value="r26" <?php if (in_array(r26,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Payment Report </span>
								<br>
								<input type="checkbox" value="r27" <?php if (in_array(r27,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Receipt Report </span>
								<br>
								<input type="checkbox" value="r28" <?php if (in_array(r28,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report " name="permission[]"/></label>
								<span class="control-label">Enquiry Report </span>
								<br>
								<input type="checkbox" value="r42" <?php if (in_array(r42,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Purchase Order Outstanding Report </span>
									<br>
								<input type="checkbox" value="r43" <?php if (in_array(r43,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Sales Order Outstanding Report </span>
								<br>
								<input type="checkbox" value="r29" <?php if (in_array(r29,$permission_Array)) { echo "checked"; }?> class="child_report report" id="child_report" name="permission[]"/></label>
								<span class="control-label">Delete Module Report </span>
								</div>
								</div>
								
							</div>
							</div>
							
						 
						</div>
						<div class="form-group col-sm-12" style="margin-top:10px">
                        <div class="col-sm-offset-5 col-sm-10">
                          <input type="submit" value="Submit" name="submit" class="btn btn-primary" id="submit_chk">
                        </div>
                      </div> 
                    </form>
                  </div><!-- /.tab-pane -->
		</div>
	</div>
       <!-- /.content -->
       </div><!-- /.content-wrapper -->
	  </div>
      
<script type="text/javascript">
$(document).ready(function(){
$(function () {
    $("#tab1 #checkAll").click(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_zone").change(function(){
    var all = $('.child_zone');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll").prop("checked", true);
    } else {
        $("#checkAll").prop("checked", false);
    }
});

$(function () {
    $("#tab2 #checkAll1").click(function () {
        if ($("#tab2 #checkAll1").is(':checked')) {
            $("#tab2 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab2 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_branch").change(function(){
    var all = $('.child_branch');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll1").prop("checked", true);
    } else {
        $("#checkAll1").prop("checked", false);
    }
});

$(function () {
    $("#tab3 #checkAll2").click(function () {
        if ($("#tab3 #checkAll2").is(':checked')) {
            $("#tab3 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab3 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_relation").change(function(){
    var all = $('.child_relation');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr121").prop("checked", true);
    } else {
        $("#checkAllr121").prop("checked", false);
    }
}); 

$(function () {
    $("#tabr122 #checkAllr122").click(function () {
        if ($("#tabr122 #checkAllr122").is(':checked')) {
            $("#tabr122 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tabr122 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_rel_map").change(function(){
    var all = $('.child_rel_map');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr122").prop("checked", true);
    } else {
        $("#checkAllr122").prop("checked", false);
    }
}); 

$(function () {
    $("#tabr129 #checkAllr129").click(function () {
        if ($("#tabr129 #checkAllr129").is(':checked')) {
            $("#tabr129 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tabr129 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_desig").change(function(){
    var all = $('.child_desig');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr129").prop("checked", true);
    } else {
        $("#checkAllr129").prop("checked", false);
    }
}); 

$(function () {
    $("#tabr130 #checkAllr130").click(function () {
        if ($("#tabr130 #checkAllr130").is(':checked')) {
            $("#tabr130 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tabr130 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_hie").change(function(){
    var all = $('.child_hie');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr130").prop("checked", true);
    } else {
        $("#checkAllr130").prop("checked", false);
    }
}); 

$(function () {
    $("#tabr132 #checkAllr132").click(function () {
        if ($("#tabr132 #checkAllr132").is(':checked')) {
            $("#tabr132 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tabr132 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_appro").change(function(){
    var all = $('.child_appro');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr132").prop("checked", true);
    } else {
        $("#checkAllr132").prop("checked", false);
    }
}); 

$(function () {
    $("#tabr140 #checkAllr140").click(function () {
        if ($("#tabr140 #checkAllr140").is(':checked')) {
            $("#tabr140 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tabr140 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_holi").change(function(){
    var all = $('.child_holi');
    if (all.length === all.filter(':checked').length) {
        $("#checkAllr140").prop("checked", true);
    } else {
        $("#checkAllr140").prop("checked", false);
    }
}); 
$(".child_scheme").change(function(){
    var all = $('.child_scheme');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll2").prop("checked", true);
    } else {
        $("#checkAll2").prop("checked", false);
    }
});

$(function () {
    $("#tab4 #checkAll3").click(function () {
        if ($("#tab4 #checkAll3").is(':checked')) {
            $("#tab4 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab4 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_group").change(function(){
    var all = $('.child_group');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll3").prop("checked", true);
    } else {
        $("#checkAll3").prop("checked", false);
    }
});

$(function () {
    $("#tab5 #checkAll4").click(function () {
        if ($("#tab5 #checkAll4").is(':checked')) {
            $("#tab5 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab5 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_employee").change(function(){
    var all = $('.child_employee');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll4").prop("checked", true);
    } else {
        $("#checkAll4").prop("checked", false);
    }
});


$(function () {
    $("#tab6 #checkAll5").click(function () {
        if ($("#tab6 #checkAll5").is(':checked')) {
            $("#tab6 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab6 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_login").change(function(){
    var all = $('.child_login');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll5").prop("checked", true);
    } else {
        $("#checkAll5").prop("checked", false);
    }
});

$(function () {
    $("#tab7 #checkAll6").click(function () {
        if ($("#tab7 #checkAll6").is(':checked')) {
            $("#tab7 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab7 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_agent").change(function(){
    var all = $('.child_agent');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll6").prop("checked", true);
    } else {
        $("#checkAll6").prop("checked", false);
    }
});

$(function () {
    $("#tab8 #checkAll7").click(function () {
        if ($("#tab8 #checkAll7").is(':checked')) {
            $("#tab8 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab8 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_customer").change(function(){
    var all = $('.child_customer');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll7").prop("checked", true);
    } else {
        $("#checkAll7").prop("checked", false);
    }
});


$(function () {
    $("#tab9 #checkAll8").click(function () {
        if ($("#tab9 #checkAll8").is(':checked')) {
            $("#tab9 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab9 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_enroll").change(function(){
    var all = $('.child_enroll');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll8").prop("checked", true);
    } else {
        $("#checkAll8").prop("checked", false);
    }
});

$(function () {
    $("#tab10 #checkAll9").click(function () {
        if ($("#tab10 #checkAll9").is(':checked')) {
            $("#tab10 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab10 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_document").change(function(){
    var all = $('.child_document');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll9").prop("checked", true);
    } else {
        $("#checkAll9").prop("checked", false);
    }
});

$(function () {
    $("#tab17 #checkAll17").click(function () {
        if ($("#tab17 #checkAll17").is(':checked')) {
            $("#tab17 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab17 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_report").change(function(){
    var all = $('.child_report');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll17").prop("checked", true);
    } else {
        $("#checkAll17").prop("checked", false);
    }
});

$(function () {
    $("#tab11 #checkAll10").click(function () {
        if ($("#tab11 #checkAll10").is(':checked')) {
            $("#tab11 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab11 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_auction").change(function(){
    var all = $('.child_auction');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll10").prop("checked", true);
    } else {
        $("#checkAll10").prop("checked", false);
    }
});


$(function () {
    $("#tab12 #checkAll11").click(function () {
        if ($("#tab12 #checkAll11").is(':checked')) {
            $("#tab12 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab12 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_collection").change(function(){
    var all = $('.child_collection');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll11").prop("checked", true);
    } else {
        $("#checkAll11").prop("checked", false);
    }
});


$(function () {
    $("#tab13 #checkAll12").click(function () {
        if ($("#tab13 #checkAll12").is(':checked')) {
            $("#tab13 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab13 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_payment").change(function(){
    var all = $('.child_payment');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll12").prop("checked", true);
    } else {
        $("#checkAll12").prop("checked", false);
    }
});


$(function () {
    $("#tab16 #checkAll16").click(function () {
        if ($("#tab16 #checkAll16").is(':checked')) {
            $("#tab16 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab16 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_config").change(function(){
    var all = $('.child_config');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll16").prop("checked", true);
    } else {
        $("#checkAll16").prop("checked", false);
    }
});

$(function () {
    $("#tab15 #checkAll15").click(function () {
        if ($("#tab15 #checkAll15").is(':checked')) {
            $("#tab15 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab15 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_feedback").change(function(){
    var all = $('.child_feedback');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll15").prop("checked", true);
    } else {
        $("#checkAll15").prop("checked", false);
    }
});



$(function () {
    $("#tab19 #checkAll19").click(function () {
        if ($("#tab19 #checkAll19").is(':checked')) {
            $("#tab19 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab19 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_bank").change(function(){
    var all = $('.child_bank');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll19").prop("checked", true);
    } else {
        $("#checkAll19").prop("checked", false);
    }
});

$(function () {
    $("#tab21 #checkAll21").click(function () {
        if ($("#tab21 #checkAll21").is(':checked')) {
            $("#tab21 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab21 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_area").change(function(){
    var all = $('.child_area');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll21").prop("checked", true);
    } else {
        $("#checkAll21").prop("checked", false);
    }
}); 

$(function () {
    $("#tab22 #checkAll22").click(function () {
        if ($("#tab22 #checkAll22").is(':checked')) {
            $("#tab22 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab22 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_designation").change(function(){
    var all = $('.child_designation');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll22").prop("checked", true);
    } else {
        $("#checkAll22").prop("checked", false);
    }
});

$(function () {
    $("#tab30 #checkAll30").click(function () {
        if ($("#tab30 #checkAll30").is(':checked')) {
            $("#tab30 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab30 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_charge").change(function(){
    var all = $('.child_charge');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll30").prop("checked", true);
    } else {
        $("#checkAll30").prop("checked", false);
    }
});

$(function () {
    $("#tab31 #checkAll31").click(function () {
        if ($("#tab31 #checkAll31").is(':checked')) {
            $("#tab31 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab31 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_cash_entry").change(function(){
    var all = $('.child_cash_entry');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll31").prop("checked", true);
    } else {
        $("#checkAll31").prop("checked", false);
    }
});

$(function () {
    $("#tab32 #checkAll32").click(function () {
        if ($("#tab32 #checkAll32").is(':checked')) {
            $("#tab32 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab32 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_lead").change(function(){
    var all = $('.child_lead');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll32").prop("checked", true);
    } else {
        $("#checkAll32").prop("checked", false);
    }
});

$(function () {
    $("#tab29 #checkAll29").click(function () {
        if ($("#tab29 #checkAll29").is(':checked')) {
            $("#tab29 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab29 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_extra_charge").change(function(){
    var all = $('.child_extra_charge');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll29").prop("checked", true);
    } else {
        $("#checkAll29").prop("checked", false);
    }
});

$(function () {
    $("#tab38 #checkAll38").click(function () {
        if ($("#tab38 #checkAll38").is(':checked')) {
            $("#tab38 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab38 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_call_register").change(function(){
    var all = $('.child_call_register');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll38").prop("checked", true);
    } else {
        $("#checkAll38").prop("checked", false);
    }
});

$(function () {
    $("#tab23 #checkAll23").click(function () {
        if ($("#tab23 #checkAll23").is(':checked')) {
            $("#tab23 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab23 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_role").change(function(){
    var all = $('.child_role');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll23").prop("checked", true);
    } else {
        $("#checkAll23").prop("checked", false);
    }
});

$(function () {
    $("#tab25 #checkAll25").click(function () {
        if ($("#tab25 #checkAll25").is(':checked')) {
            $("#tab25 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab25 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_city").change(function(){
    var all = $('.child_city');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll25").prop("checked", true);
    } else {
        $("#checkAll25").prop("checked", false);
    }
});

$(function () {
    $("#tab20 #checkAll20").click(function () {
        if ($("#tab20 #checkAll20").is(':checked')) {
            $("#tab20 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab20 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_slab").change(function(){
    var all = $('.child_slab');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll20").prop("checked", true);
    } else {
        $("#checkAll20").prop("checked", false);
    }
});

$(function () {
    $("#tab14 #checkAll13").click(function () {
        if ($("#tab14 #checkAll13").is(':checked')) {
            $("#tab14 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab14 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$(".child_recpt").change(function(){
    var all = $('.child_recpt');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll13").prop("checked", true);
    } else {
        $("#checkAll13").prop("checked", false);
    }
});

$(function () {
    $("#tab1 #checkAll").load(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
       
        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});
$("#tab1").load(function(){
    var all = $('.child_zone');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll").prop("checked", true);
    } else {
        $("#checkAll").prop("checked", false);
    }
});


});

$(document).ready(function(){
	var numItems = $('#tab14 .child_recpt:checked').length;
	var numItems1 = $('#tab14 .child_recpt').length;
	if(numItems == numItems1){
	  $("#checkAll13").prop("checked", true);
	  } else {
        $("#checkAll13").prop("checked", false);
    } 

	var numItems2 = $('#tab13 .child_payment:checked').length;
	var numItems3 = $('#tab13 .child_payment').length;
	if(numItems2 == numItems3){
	  $("#checkAll12").prop("checked", true);
	  } else {
        $("#checkAll12").prop("checked", false);
    } 
	
	var numItems4 = $('#tab12 .child_collection:checked').length;
	var numItems5 = $('#tab12 .child_collection').length;
	if(numItems4 == numItems5){
	  $("#checkAll11").prop("checked", true);
	  } else {
        $("#checkAll11").prop("checked", false);
    } 

														
	var numItems6 = $('#tab11 .child_auction:checked').length;
	var numItems7 = $('#tab11 .child_auction').length;
	if(numItems6 == numItems7){
	  $("#checkAll10").prop("checked", true);
	  } else {
        $("#checkAll10").prop("checked", false);
    } 	
    
	var numItems8 = $('#tab10 .child_document:checked').length;
	var numItems9 = $('#tab10 .child_document').length;
	if(numItems8 == numItems9){
	  $("#checkAll9").prop("checked", true);
	  } else {
        $("#checkAll9").prop("checked", false);
    } 
    
	var numItems10= $('#tab9 .child_enroll:checked').length;
	var numItems11 = $('#tab9 .child_enroll').length;
	if(numItems10 == numItems11){
	  $("#checkAll8").prop("checked", true);
	  } else {
        $("#checkAll8").prop("checked", false);
    } 
     
	 var numItems12 = $('#tab8 .child_customer:checked').length;
	var numItems13 = $('#tab8 .child_customer').length;
	if(numItems12 == numItems13){
	  $("#checkAll7").prop("checked", true);
	  } else {
        $("#checkAll7").prop("checked", false);
    } 

     var numItems14 = $('#tab7 .child_agent:checked').length;
	var numItems15 = $('#tab7 .child_agent').length;
	if(numItems14 == numItems15){
	  $("#checkAll6").prop("checked", true);
	  } else {
        $("#checkAll6").prop("checked", false);
    } 
	var numItems16 = $('#tab6 .child_login:checked').length;
	var numItems17 = $('#tab6 .child_login').length;
	if(numItems16 == numItems17){
	  $("#checkAll5").prop("checked", true);
	  } else {
        $("#checkAll5").prop("checked", false);
    } 
	var numItems18 = $('#tab5 .child_employee:checked').length;
	var numItems19 = $('#tab5 .child_employee').length;
	if(numItems18 == numItems19){
	  $("#checkAll4").prop("checked", true);
	  } else {
        $("#checkAll4").prop("checked", false);
    } 
	var numItems20 = $('#tab4 .child_group:checked').length;
	var numItems21 = $('#tab4 .child_group').length;
	if(numItems20 == numItems21){
	  $("#checkAll3").prop("checked", true);
	  } else {
        $("#checkAll3").prop("checked", false);
    } 
	var numItems22 = $('#tab3 .child_scheme:checked').length;
	var numItems23 = $('#tab3 .child_scheme').length;
	if(numItems22 == numItems23){
	  $("#checkAll2").prop("checked", true);
	  } else {
        $("#checkAll2").prop("checked", false);
    } 
	var numItems24 = $('#tab2 .child_branch:checked').length;
	var numItems25 = $('#tab2 .child_branch').length;
	if(numItems24 == numItems25){
	  $("#checkAll1").prop("checked", true);
	  } else {
        $("#checkAll1").prop("checked", false);
    } 
	var numItems26 = $('#tab1 .child_zone:checked').length;
	var numItems27 = $('#tab1 .child_zone').length;
	if(numItems26 == numItems27){
	  $("#checkAll").prop("checked", true);
	  } else {
        $("#checkAll").prop("checked", false);
    } 
   var numItems28 = $('#tab15 .child_feedback:checked').length;
	var numItems29 = $('#tab15 .child_feedback').length;
	if(numItems28 == numItems29){
	  $("#checkAll15").prop("checked", true);
	  } else {
        $("#checkAll15").prop("checked", false);
    } 
	var numItems30 = $('#tab16 .child_config:checked').length;
	var numItems31 = $('#tab16 .child_config').length;
	if(numItems30 == numItems31){
	  $("#checkAll16").prop("checked", true);
	  }
	  else {
        $("#checkAll16").prop("checked", false);
    } 
	var numItems32 = $('#tab17 .child_report:checked').length;
	var numItems33 = $('#tab17 .child_report').length;
	if(numItems32 == numItems33){
	  $("#checkAll17").prop("checked", true);
	  } else {
        $("#checkAll17").prop("checked", false);
    }
	var numItems34 = $('#tab19 .child_bank:checked').length;
	var numItems35 = $('#tab19 .child_bank').length;
	if(numItems34 == numItems35){
	  $("#checkAll19").prop("checked", true);
	  } else {
        $("#checkAll19").prop("checked", false);
    }
	var numItems36 = $('#tab20 .child_slab:checked').length;
	var numItems37 = $('#tab20 .child_slab').length;
	if(numItems36 == numItems37){
	  $("#checkAll20").prop("checked", true);
	  } else {
        $("#checkAll20").prop("checked", false);
    } 
	var numItems38 = $('#tab21 .child_area:checked').length;
	var numItems39 = $('#tab21 .child_area').length;
	if(numItems38 == numItems39){
	  $("#checkAll21").prop("checked", true);
	  } else {
        $("#checkAll21").prop("checked", false);
    } 
	var numItems40 = $('#tab22 .child_designation:checked').length;
	var numItems41 = $('#tab22 .child_designation').length;
	if(numItems40 == numItems41){
	  $("#checkAll22").prop("checked", true);
	  } else {
        $("#checkAll22").prop("checked", false);
    } 
	var numItems42 = $('#tab23 .child_role:checked').length;
	var numItems43 = $('#tab23 .child_role').length;
	if(numItems42 == numItems43){
	  $("#checkAll23").prop("checked", true);
	  } else {
        $("#checkAll23").prop("checked", false);
    } 
	var numItems44 = $('#tab25 .child_city:checked').length;
	var numItems45 = $('#tab25 .child_city').length;
	if(numItems44 == numItems45){
	  $("#checkAll25").prop("checked", true);
	  } else {
        $("#checkAll25").prop("checked", false);
    } 
	var numItems46 = $('#tab30 .child_charge:checked').length;
	var numItems47 = $('#tab30 .child_charge').length;
	if(numItems46 == numItems47){
	  $("#checkAll30").prop("checked", true);
	  } else {
        $("#checkAll30").prop("checked", false);
    } 
	var numItems48 = $('#tab32 .child_lead:checked').length;
	var numItems49 = $('#tab32 .child_lead').length;
	if(numItems48 == numItems49){
	  $("#checkAll32").prop("checked", true);
	  } else {
        $("#checkAll32").prop("checked", false);
    } 
	var numItems50 = $('#tab29 .child_extra_charge:checked').length;
	var numItems51 = $('#tab29 .child_extra_charge').length;
	if(numItems50 == numItems51){
	  $("#checkAll29").prop("checked", true);
	  } else {
        $("#checkAll29").prop("checked", false);
    } 
	var numItemsr38 = $('#tab38 .child_call_register:checked').length;
	var numItemsrr38 = $('#tab38 .child_call_register').length;
	if(numItemsr38 == numItemsrr38){
	  $("#checkAll38").prop("checked", true);
	  } else {
        $("#checkAll38").prop("checked", false);
    } 
	var numItems48 = $('#tab31 .child_cash_entry:checked').length;
	var numItems49 = $('#tab31 .child_cash_entry').length;
	if(numItems48 == numItems49){
	  $("#checkAll31").prop("checked", true);
	  } else {
        $("#checkAll31").prop("checked", false);
    } 
	
});

//submit validation
$(document).ready(function(){
	$("#submit_chk").click(function(){ 
		var mas_id = $("#masters_head");		 
		var masters_id = $(".masters");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".masters").prop("required", false);
				} else { 
					$(".masters").prop("required", true);
				}
		 
		
		}
	});
	
	
	$("#submit_chk").click(function(){ 
		var mas_id = $("#employee_head");		 
		var masters_id = $(".emply");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".emply").prop("required", false);
				} else {
					$(".emply").prop("required", true);
				}
		}
	});
	
	$("#submit_chk").click(function(){ 
		var mas_id = $("#lead_head");		 
		var masters_id = $(".lead");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".lead").prop("required", false);
				} else {
					$(".lead").prop("required", true);
				}
		}
	});
	
	$("#submit_chk").click(function(){ 
		var mas_id = $("#customer_head");		 
		var masters_id = $(".customer");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".customer").prop("required", false);
				} else {
				 
					$(".customer").prop("required", true);
				}
		}

	});
	
	$("#submit_chk").click(function(){ 
		var mas_id = $("#report_head");		 
		var masters_id = $(".report");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".report").prop("required", false);
				} else {
				 
					$(".report").prop("required", true);
				}
		}

	});
	
	$("#submit_chk").click(function(){ 
		var mas_id = $("#trans_head");		 
		var masters_id = $(".trans");	
		
		if (mas_id.is(':checked')) {		 
		
				if (masters_id.is(':checked')) { 
					$(".trans").prop("required", false);
				} else {
				 
					$(".trans").prop("required", true);
				}
		}

	});
	
	
});


$(document).ready(function(){
	var all = $("#masters_head");  
    if (all.length === all.filter(':checked').length) {
         $("#masters_div").show();
    } else {
         $("#masters_div").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#lead_head");  
    if (all.length === all.filter(':checked').length) {
         $("#lead_div").show();
    } else {
         $("#lead_div").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#employee_head");  
    if (all.length === all.filter(':checked').length) {
         $("#employee_div").show();
    } else {
         $("#employee_div").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#customer_head");  
    if (all.length === all.filter(':checked').length) {
         $("#customer_div").show();
    } else {
         $("#customer_div").hide();
    }
 
});


$(document).ready(function(){
	var all = $("#report_head_out");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_out").show();
    } else {
         $("#report_div_out").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#trans_head");  
    if (all.length === all.filter(':checked').length) {
         $("#trans_div").show();
    } else {
         $("#trans_div").hide();
    }
 
});
$(document).ready(function(){
	var all = $("#report_head");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div").show();
    } else {
         $("#report_div").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_auc");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_auc").show();
    } else {
         $("#report_div_auc").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_bid");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_bid").show();
    } else {
         $("#report_div_bid").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_ho");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_ho").show();
    } else {
         $("#report_div_ho").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_rec");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_rec").show();
    } else {
         $("#report_div_rec").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_coll");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_coll").show();
    } else {
         $("#report_div_coll").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_trans");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_trans").show();
    } else {
         $("#report_div_trans").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_recs");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_recs").show();
    } else {
         $("#report_div_recs").hide();
    }
 
});

$(document).ready(function(){
	var all = $("#report_head_enrl");  
    if (all.length === all.filter(':checked').length) {
         $("#report_div_enrl").show();
    } else {
         $("#report_div_enrl").hide();
    }
 
});



</script>
<script>
$(document).ready(function(){
	var mas_id = $("#masters_head");
    $('#masters_head').change(function(){
        if(this.checked)
            $('#masters_div').fadeIn('slow');
        else
            $('#masters_div').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#employee_head");
    $('#employee_head').change(function(){
        if(this.checked)
            $('#employee_div').fadeIn('slow');
        else
            $('#employee_div').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#customer_head");
    $('#customer_head').change(function(){
        if(this.checked)
            $('#customer_div').fadeIn('slow');
        else
            $('#customer_div').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_out");
    $('#report_head_out').change(function(){
        if(this.checked)
            $('#report_div_out').fadeIn('slow');
        else
            $('#report_div_out').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_auc");
    $('#report_head_auc').change(function(){
        if(this.checked)
            $('#report_div_auc').fadeIn('slow');
        else
            $('#report_div_auc').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_bid");
    $('#report_head_bid').change(function(){
        if(this.checked)
            $('#report_div_bid').fadeIn('slow');
        else
            $('#report_div_bid').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_rec");
    $('#report_head_rec').change(function(){
        if(this.checked)
            $('#report_div_rec').fadeIn('slow');
        else
            $('#report_div_rec').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_coll");
    $('#report_head_coll').change(function(){
        if(this.checked)
            $('#report_div_coll').fadeIn('slow');
        else
            $('#report_div_coll').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_trans");
	
    $('#report_head_trans').change(function(){
        if(this.checked)
            $('#report_div_trans').fadeIn('slow');
        else
            $('#report_div_trans').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_recs");
	
    $('#report_head_recs').change(function(){
        if(this.checked)
            $('#report_div_recs').fadeIn('slow');
        else
            $('#report_div_recs').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_enrl");
    $('#report_head_enrl').change(function(){
        if(this.checked)
            $('#report_div_enrl').fadeIn('slow');
        else
            $('#report_div_enrl').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head_ho");
    $('#report_head_ho').change(function(){
        if(this.checked)
            $('#report_div_ho').fadeIn('slow');
        else
            $('#report_div_ho').fadeOut('slow');

    });
});


$(document).ready(function(){
	var mas_id = $("#trans_head");
    $('#trans_head').change(function(){
        if(this.checked)
            $('#trans_div').fadeIn('slow');
        else
            $('#trans_div').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#report_head");
    $('#report_head').change(function(){
        if(this.checked)
            $('#report_div').fadeIn('slow');
        else
            $('#report_div').fadeOut('slow');

    });
});

$(document).ready(function(){
	var mas_id = $("#lead_head");
    $('#lead_head').change(function(){
        if(this.checked)
            $('#lead_div').fadeIn('slow');
        else
            $('#lead_div').fadeOut('slow');

    });
});
	</script>
<?php

}
 
?>
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
    <script src="dist/js/demo.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </body>
</html>
<?php
mysqli_close($con);
?>
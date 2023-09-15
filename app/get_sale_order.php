<script src="dist/js/bootstrap-select.js"></script>

<?php
require_once "srdb.php";
if (!empty($_REQUEST["lead_id"])) {
    $lead_id = $_REQUEST["lead_id"];
	
	$query_lead = "SELECT l.*,c.*,t.*,l.Date as ld_dt,l.Customer_Id as cust_id FROM tbl_lead l left join tbl_customer c on l.Customer_Id=c.Id left join tbl_contact_person t on t.Customer_Id=c.Id WHERE l.Id='$lead_id'";
            $query_aadh_lead = mysqli_query($con, $query_lead);
			$fetch_lead = mysqli_fetch_array($query_aadh_lead);
			$Customer_Id = $fetch_lead['cust_id'];
			$paid = 0;
			$tot_amt = 0;
			
            

            $select_paid = mysqli_query($con, "select SUM(Total_Amount) as sid from tbl_receipts WHERE Status='Active' AND Lead_Id='$lead_id'");
            $fetch_sid = mysqli_fetch_array($select_paid);
            $paid = $fetch_sid['sid'];
			
			$select_pend = mysqli_query($con, "select SUM(Rate) as sid from tbl_lead_products WHERE Status='Active' AND Lead_Id='$lead_id'");
            $select_pend = mysqli_fetch_array($select_pend);
            $tot_amt = $select_pend['sid'];
			
			$pend = $tot_amt - $paid;
?>
<label for="inputName" class="col-sm-2 control-label">Lead Date</label>
                        <div class="col-sm-4"> 
                            <input type="text" value="<?php echo $fetch_lead['ld_dt']; ?>" id="form-field-1" class="form-control limited" name="lead_date" readonly>
							 <input type="hidden" value="<?php echo $Customer_Id; ?>" id="form-field-1" class="form-control limited" name="customer" readonly>
                        </div>
						<label for="inputName" class="col-sm-2 control-label">Customer Name</label>
                        <div class="col-sm-4"> 
                            <input type="text" value="<?php echo $fetch_lead['Company_Name']; ?>" id="form-field-1" class="form-control limited" readonly>
                        </div>
                        </div>
						
				<div class="form-group col-sm-12"><h4><b>Billing Address</b></h4> </div>		
                      <div class="form-group col-sm-12">
                            <div class="form-group col-sm-12">
						<label for="inputName" class="col-sm-2 control-label">Billing Address</label>
						<div class="col-md-4">
							<textarea class="form-control" rows="2" name="address" id="comment" readonly><?php echo $fetch_lead['Address']; ?></textarea>
						</div>

						<label for="inputName" class="col-sm-2 control-label">State</label>
						<div class="col-md-4">
							<input type="text" value="<?php echo $fetch_lead['State']; ?>" id="form-field-1" class="form-control limited" readonly>
						</div>
						<label for="inputName" class="col-sm-2 control-label">District</label>
						<div class="col-md-4">
							<input type="text" value="<?php echo $fetch_lead['District']; ?>" id="form-field-1" class="form-control limited" readonly>
						</div>
						<label for="inputName" class="col-sm-2 control-label">City</label>
						<div class="col-md-4">
							<input type="text" value="<?php echo $fetch_lead['City']; ?>" id="form-field-1" class="form-control limited" readonly>
						</div>
						<label for="inputName" class="col-sm-2 control-label">Pincode</label>
						<div class="col-md-4">
							<input type="text" value="<?php echo $fetch_lead['Pincode']; ?>" id="form-field-1" class="form-control limited" readonly>
						</div>
                        </div>
						
				<div class="form-group col-sm-12"><h4><b>Delivery Address</b></h4> </div>	
				 <div class="form-group col-sm-12">
						<div class="form-group col-sm-12">
						<label for="inputName" class="col-sm-2 control-label">Delivery Address</label>
						<div class="col-md-4">
							<textarea class="form-control" rows="2" name="address" id="comment"></textarea>
						</div>

						<label for="inputName" class="col-sm-2 control-label">State</label>
						<div class="col-md-4">
							<select class="form-control selectpicker" name="state" id="state" onChange="getdistrict(this.value);" data-live-search="true">
								<option value="">Select State</option>
								<?php
								$select_GrpQry = mysqli_query($con, "select * from state");
								while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
									$state_name = $fetch_GrpQry['StateName'];
								?>
									<option value="<?php echo $state_name; ?>"><?php echo $state_name; ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div id="district-list"></div>
						<div id="city-list"></div>
						<div id="pin-list"></div>
                        </div>
					 <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Remarks" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Remarks">
                        </div>
					<div class="form-group col-sm-12"><h4><b>Product Details</b></h4> </div>
                        <div class="form-group col-sm-12">
                        
                                            <table id="example1" class="table table-bordered table-striped" style="border:1px;">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                    </tr>
													   <?php
														
														$qry_lead = mysqli_query($con, "SELECT l.*,p.Name as prod_name FROM `tbl_lead_products` l left join tbl_stock_item p on l.Product_Id=p.Id WHERE l.Lead_Id='$lead_id'");
		                                                while($fetch_lead = mysqli_fetch_array($qry_lead))
														{
		 												?>
                                                    <tr>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['prod_name']; ?>" class="form-control limited" name="Pro_Name" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['Quantity']; ?>" class="form-control limited" name="Qty" style="width:58%;" readonly></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['Rate']; ?>" class="form-control limited" name="Rate" style="width:58%;" readonly></td>
                                                        
                                                    </tr>
													<?php
														}
														?>
														
                                                </thead>
                                            </table>

                                       
                    </div>
				<div class="form-group col-sm-12"><h4><b>Billing Details</b></h4> </div>	
				 <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Current_Outstanding</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $pend; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="Hsn_Code" readonly>
                        </div>
						<label for="inputName" class="col-sm-2 control-label">Billing</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $tot_amt; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="bill_amount" readonly>
                        </div>
						<label for="inputName" class="col-sm-2 control-label">Received</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $paid; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="Hsn_Code" readonly>
                        </div>
						<label for="inputName" class="col-sm-2 control-label">Out Standing</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $pend; ?>" id="form-field-1" class="form-control limited" maxlength="15" name="Hsn_Code" readonly>
                        </div>
						
                        </div> </br></br>
                        <?php 
                        
                            $select_cnt = mysqli_query($con, "select COUNT(Id) as sid from tbl_receipts WHERE Status='Active' AND Lead_Id='$lead_id'");
                            $fetch_cnt = mysqli_fetch_array($select_cnt);
                            $cnt_rec = $fetch_cnt['sid'];
                        if($cnt_rec==0){
                        ?>
				<div class="form-group col-sm-12"><h4><b>Payment Details</b></h4> </div>
				 <div class="form-group col-sm-12">
				     <label for="inputName" class="col-sm-2 control-label">Advance</label>
                        <div class="col-sm-4">
                            <input type="text" id="form-field-1" class="form-control limited" name="advance">
                        </div>
				 
						<label for="inputName" class="col-sm-2 control-label">Date<font color="red">&nbsp;*&nbsp;</font></label>
							<div class="col-sm-4">
								<input class="form-control dp" value="<?php echo date('d-m-Y') . $acctopendate; ?>" placeholder="Pick the Date  dd-mm-yyyy" name="acctdate" id="acctopendate" required>

							</div>
						
						<script>
								$(document).ready(function() {
									$('.dp').datepicker({
										format: "dd-mm-yyyy",
										StartDate: '+0d',
										autoclose: true
									});

									$('.dp').on('change', function() {
										$('.datepicker').hide();
									});
									$("#discount").val(0);
									$("#other_charge").val(0);
								});
							</script>
						<label for="inputName" class="col-sm-2 control-label">Mode</label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" name="mode" id="customer" onchange="new_customer(this.value);" data-live-search="true">
                                <option value="">Cash</option>
                                <option value="">Cheque</option>
                            </select>
                        </div>
						<label for="inputName" class="col-sm-2 control-label">CH No</label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="CH No" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="cheque_no">
                        </div>
						<label for="inputName" class="col-sm-2 control-label">CH Date</label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="CH Date" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="cheque_date">
                        </div>
						<label for="inputName" class="col-sm-2 control-label">Followed By</label>
                        <div class="col-sm-4" style="margin-left: 0px;">
									<select class="form-control selectpicker" name="employee_transfer" id="employee_transfer" data-live-search="true">
										<option value="">Select Employee</option>

										<?php
										$select_GrpQry = mysqli_query($con, "select * from tbl_employee WHERE Status='Active'");
										while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
											$Name = $fetch_GrpQry['Name'];
											$Id = $fetch_GrpQry['Id'];
										?>
											<option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
										<?php
										}
										?>
									</select>
								</div>
                       
                    </div>
					
					<?php
                        }
            }
            ?>
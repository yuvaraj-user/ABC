<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';

$sessionuserid = $_SESSION['usersessionid'];
$id = $_REQUEST['id'];
if (isset($_REQUEST['submit'])) {

    $acctdate = $_REQUEST['acctdate'];
    $followup_status = $_REQUEST['followup_status'];
    $employee_transfer = $_REQUEST['employee_transfer'];
     $remark = $_REQUEST['Remarks'];
     $createdon = date("d-m-Y H:i:s A");
     $createdby = $_SESSION['usersessionid'];
     $date = date("d-m-Y");
  
   $lead_type = $_REQUEST['lead_type'];
$remark_cus = $_REQUEST['remark_cus'];
         $insert_details = mysqli_query($con, "INSERT INTO `tbl_followup`(`Lead_Id`, `Entry_Date`, `Followup_Status`, `Followup_Date`, `Created_By`, `Created_On`, `Status`,`Remark`) VALUES ('$id','$date','$followup_status','$acctdate','$createdby','$createdon','Active','$remark')");
        
        $product = array();
	    $quantity = array();
	    $rate = array();
		
		$product = $_REQUEST['product'];
	    $quantity = $_REQUEST['quantity'];
	    $rate = $_REQUEST['rate'];
	    
	    
	
		$insert_details_cus = mysqli_query($con, "UPDATE tbl_lead SET Followup_Employee='$employee_transfer',Followup_Status='$followup_status',Lead_Type='$lead_type',Remark_2='$remark_cus' WHERE Id='$id'");
	
		
		for ($i = 0; $i < sizeof($product); $i++) {

		$product_sd = $product[$i];
		$quantity_sd = $quantity[$i];
		$rate_sd = $rate[$i];
	if($quantity_sd > '0'){
		$insert_details_cus = mysqli_query($con, "INSERT INTO `tbl_lead_products`( `Lead_Id`, `Product_Id`, `Quantity`, `Rate`, `Status`,Order_Date) VALUES ('$id','$product_sd','$quantity_sd','$rate_sd','Active','$date')");
		}
		}
		
		$product_id = array();
	    $prod_quantity = array();
	    $prod_rate = array();
		
		$product_id = $_REQUEST['prod_id'];
	    $prod_quantity = $_REQUEST['prod_qty'];
	    $prod_rate = $_REQUEST['prod_rate'];
		
		for ($i = 0; $i < sizeof($product_id); $i++) {

		$prod_sd = $product_id[$i];
		$prod_quantity_sd = $prod_quantity[$i];
		$prod_rate_sd = $prod_rate[$i];
		
		$insert_details_cus = mysqli_query($con, "UPDATE `tbl_lead_products` SET `Quantity`='$prod_quantity_sd', `Rate`='$prod_rate_sd' WHERE Id='$prod_sd'");
		}
		
		   
		   
        if ($insert_details) {
            echo '<script type="text/javascript">
					window.location.replace("lead_report.php?step=suces");
					</script>';
        } else {
            echo '<script type="text/javascript">
					window.location.replace("lead_report.php?step=fail");
					</script>';
        }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Billing </title>
    <meta name="author" content="Gayathri.R.KKIT">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <style>
        .content-wrapper {
            padding: 0px 10px !important;
        }

        .panel-header,
        .panel-body {
            border: none !important;
        }

        .panel-body {
            overflow-x: inherit !important;
            min-height: 420px;
            padding: 34px 10px !important;

        }

        .row.panel.panel-primary {
            background: transparent !important;
            padding-top: 9px;
            min-width: 71px !important;
        }

        .panel-heading {
            margin-bottom: 0px !important;
        }

        .nav-tabs {
            font-size: 15px;
        }

        .modal-dialog {
            color: #000000 !important;
        }

        .panel.panel-warning {
            border: 1px solid #fcf8e3;
        }

        tr {
            border-bottom: 1px solid #dedede;
        }

        .nav-tabs-custom {
            background: transparent;
        }

        .panel-primary>.panel-heading {
            color: #000;
            background-color: #cccccc;
            border-color: #cccccc;
            font-weight: 500;
            font-style: inherit;
        }

        .panel-body {
            font-size: 16px !important;
            color: #333;
        }

        ul.dropdown-menu.inner {
            max-height: 159px !important;
        }

        .panel-heading.lead {
            padding-right: 23px;
            padding-left: 23px;
        }
    </style>
    <script>
        (function($) {
            // always strict mode on
            // cannot use undefined vars on strict mode
            "use strict";

            $(document).ready(function() {

                $(document).on('click', '#datagrid .add', function() {

                    var row = $(this).closest('tr');
                    var clone = row.clone();
                    var tr = clone.closest('tr');
                    tr.find('input[type=text]').val('');
                    $(this).closest('tr').after(clone);
                    var $span = $("#datagrid tr");
                    $span.attr('id', function(index) {
                        return 'row' + index;

                    });

                });


                $(document).on('click', '#datagrid .removeRow', function() {
                    if ($('#datagrid .add').length > 1) {
                        $(this).closest('tr').remove();
                    }

                });

            });

            var dropDown = "#dropdnw";
            var empName = ".name";

            $(document).on("change", (dropDown), function(e) {

                var value = $.trim($(this).val());

                //Change this line:
                //$(empName).val(value);
                //To:
                // $(this).closest('tr').find(empName).val(value);

            });

        })(jQuery);
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="row panel panel-primary">

                <div class="panel-heading lead ">
                    <div class="row">
                        <div class="col-lg-8 col-md-8"><b>Add Followup</b></div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <div class="btn-group text-center">
                                <a href="view_followup.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Followup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			
			$query_lead = "SELECT l.*,c.*,t.* FROM tbl_lead l left join tbl_customer c on l.Customer_Id=c.Id left join tbl_contact_person t on t.Customer_Id=c.Id WHERE l.Id='$id'";
            $query_aadh_lead = mysqli_query($con, $query_lead);
			$fetch_lead = mysqli_fetch_array($query_aadh_lead);
			$lead_type_f = $fetch_lead['Lead_Type'];
			$remark_cus_2 = $fetch_lead['Remark_2'];
			?>
            <div class="panel-body">
                <form class="form-horizontal" name="addaccount_details" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group col-sm-12">
                        <label for="inputName" class="col-sm-2 control-label">Customer Name</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $fetch_lead['Company_Name']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Customer_Name" readonly>
							
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Contact Person</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $fetch_lead['Name']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Cont_Person" readonly>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $fetch_lead['Mobile_No']; ?>" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Con_Number" readonly>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Followup Status<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-4">
                            <select class="form-control selectpicker" name="followup_status" id="followup_status" data-live-search="true" required>
                                <option value="Won">Won</option>
                                <option value="Drop">Drop</option>
                                <option value="Follow">Follow</option>
                                
                            </select>
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
                        <label for="inputName" class="col-sm-2 control-label">Remarks<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" name="Remarks" id="comment" required></textarea>
                        </div>
                    </div>

                    <table id="datagrid" class="display table1" style="border-collapse: separate;">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th style="padding:0 10px;">Qty</th>
                                <th>Rate</th>
                            </tr>
                        </thead>

                        <tbody id="dataTable">
						
                            <tr id="row1">
                                
                                    <td width="25%">
                                        <select name="product[]" class="form-control  dropdn" id="dropdnw" data-live-search="true">
                                            <option value="">Select Product</option>
                                            <?php
                                            $select_GrpQry = mysqli_query($con, "select * from tbl_stock_item WHERE Status='Active'");
                                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
                                                $Name = $fetch_GrpQry['Name'];
                                                $Id = $fetch_GrpQry['Id'];
                                            ?>
                                                <option value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </td>
                               
                                <td width="35%">
                                    <input type='text' name="quantity[]" size="20" class="form-control discount" />
                                </td>
                                <td width="35%">
                                    <input type='text' name="rate[]" size="20" class="form-control discount" />
                                </td>
                                <td>
                                    <input type="button" name="addRow" class="btn btn-success add" style="margin:0 10px;" value='Add More' />
                                </td>
                                <td>
                                    <input type="button" name="removeRow" class="btn btn-danger removeRow" value='Delete' />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <section class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-striped" style="border:1px;">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                    </tr>
													    <?php
														
														$qry_lead = mysqli_query($con, "SELECT l.*,p.Name as prod_name FROM `tbl_lead_products` l left join tbl_stock_item p on l.Product_Id=p.Id WHERE l.Lead_Id='$id'");
		                                                while($fetch_lead = mysqli_fetch_array($qry_lead))
														{
		 												?>
                                                    <tr>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['prod_name']; ?>" class="form-control limited" name="prod_name[]" style="width:58%;">
                                                        <input type="hidden" id="form-field-1" value="<?php echo $fetch_lead['Id']; ?>" class="form-control limited" name="prod_id[]" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['Quantity']; ?>" class="form-control limited" name="prod_qty[]" style="width:58%;"></td>
                                                        <td><input type="text" id="form-field-1" value="<?php echo $fetch_lead['Rate']; ?>" class="form-control limited" name="prod_rate[]" style="width:58%;"></td>
                                                        
                                                    </tr>
													<?php
														}
														?>
														
                                                </thead>
                                            </table>

                                        </div><!-- /.row -->
                                        </div><!-- /.row -->
                                        </div><!-- /.row -->
                        </section><!-- /.content -->
                    </div>
                    <label for="inputName" class="col-sm-2 control-label">Current Outstanding</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Current_Outstanding" maxlength="150" id="form-field-1" class="form-control limited" maxlength="15" name="Current_Outstanding">
                    </div>
                    
								<label for="inputName" class="col-sm-2 control-label"> Transferred To</label>
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
							<div class="form-group col-sm-6">
									<label for="inputName" class="col-sm-4 control-label">Lead Type<font color="red">&nbsp;*&nbsp;</font></label>
									<div class="col-sm-6" style="margin-left: 0px;">
										<select class="form-control selectpicker" name="lead_type" id="lead_type" data-live-search="true" required>
											<option value="">Select Type</option>
                                            <option value="1" <?php echo ($lead_type_f=='1')?'checked':'' ?>>Hot</option>
                                            <option value="2" <?php echo ($lead_type_f=='2')?'checked':'' ?>>Warm</option>
                                            <option value="3" <?php echo ($lead_type_f=='3')?'checked':'' ?>>Cold</option>
										
										</select>
									</div>
								</div>
								<label for="inputName" class="col-sm-2 control-label">Remark 2<font color="red">&nbsp;*&nbsp;</font></label>
                        	<div class="form-group col-md-4">
									<select class="form-control selectpicker" name="remark_cus" id="remark" data-live-search="true" required>
										<option value="">Select Remark</option>
										<?php
										$select_GrpQry = mysqli_query($con, "select * from tbl_remark");
										while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {
											$state_name = $fetch_GrpQry['Remark'];
											$rem_id = $fetch_GrpQry['Id'];
										?>
											<option value="<?php echo $rem_id; ?>"<?php if($rem_id == $remark_cus_2) echo 'selected';?>><?php echo $state_name; ?></option>
										<?php
										}
										?>
									</select>
								</div>

            </div>
        
        	
        <div class="col-sm-12">
            <br>
            <div class="col-sm-6">
                <button type="submit" name="submit" class="pull-right center-block btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-6">
                <button type="reset" name="" class="pull-left btn btn-warning">Cancel</button>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>
    <div class="control-sidebar-bg"></div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap-select.css">
    <script src="dist/js/bootstrap-select.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


</body>

</html>

<?php mysqli_close($con); ?>
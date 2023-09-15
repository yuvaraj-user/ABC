<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';


?>
<?php
	if(isset($_REQUEST['submit']))
	{
        $val        = $_POST['name'];
        $permission = implode(",",$_POST['permission']);
        $add    = implode(",",$_POST['add']);
        $edit   = implode(",",$_POST['edit']);
        $delete = implode(",", $_POST['delete']);
        $createdon  =date("d-m-Y H:i:s A");
        $createdby  =$_SESSION['User'];
        $updatedon  =0;
        $updatedby  =0;
        $query  ="UPDATE `tbl_user_role` SET`Permission`='$permission',`Role_add`='$add',`Role_edit`='$edit',`Role_delete`='$delete',`Updated_by`='$updatedby',`Updated_on`='$updatedon'  WHERE `Id`='$val'";
        $query_user ="UPDATE `tbl_users` SET`Permission`='$permission',`Role_add`='$add',`Edit`='$edit',`Delete`='$delete',`Updated_by`='$updatedby',`Updated_on`='$updatedon'  WHERE `Role`='$val'";
        $passquery  =   mysqli_query($con,$query);
        $passquery_user =   mysqli_query($con,$query_user);
        if($passquery){	
            echo '<script type="text/javascript">
                        window.location.replace("userrole.php?step=suces");
                </script>';   
        }else{
            echo '<script type="text/javascript">
                        window.location.replace("userrole.php?step=fail");
                </script>';   
        }
    } 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Role</title>
<meta name="author" content="">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script>
   function get_brnch(val) {
            $.ajax({
            type: "POST",
            url: "get_user_role.php",
            data:'div_doc='+val,
            success: function(data){
             $("#doc_brn").html(data);  
            }
        });
	}
  </script>
	<!--<script src="js/jquery.min.js"></script>-->
  <style>
.cusview_img { margin: -39px 0 0 -135px; }
.content-wrapper
{
  padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: none !important;
   min-height : 320px;
   padding: 34px 10px !important;
    
}
.row.panel.panel-primary {
    background: transparent !important;
    padding-top: 9px;
      min-width: 71px!important;
}
.panel-heading{
  margin-bottom : 0px !important;
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
tr{
  border-bottom: 1px solid #dedede;
}
.nav-tabs-custom {
  background : transparent;
}
.panel-primary>.panel-heading {
    color: #000;
    background-color: #cccccc;
    border-color: #cccccc;
    font-weight: 500;
    font-style: inherit;
}
.panel-body
{
  font-size : 16px !important;
  color: #333;
      min-height: 425;
}
ul.dropdown-menu.inner {
    max-height: 139px !important;
}
.content-wrapper {
    padding-bottom: 1px !important;
  min-height : 537px !important;

  #heading{
	margin:10px 260px 0 0;
}
</style>
	
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary">
  
    

        <!-- Main content -->

     <!--  <?php if($final==1){ ?>
		<div class="alert alert-block alert-success fade in box">
		<h4 class="alert-heading"><i class="fa fa-check-circle"></i> Success !</h4>
		<p>
		     <?php echo "Your Details are added successfully"; ?>
		</p>
		<p>		
		<button type="button" onclick="window.location.href='viewbranch.php'" class="btn btn-warning">View Branch(s)</button>
		<button type="button" onclick="window.location.href='addbranch.php'" class="btn btn-warning">Or Add Another User Role</button>		
		</p>
		</div>
		<?php }else if($final==2){ ?>
			
			<div class="alert alert-block alert-danger fade in">
			<h4 class="alert-heading"><i class="fa fa-times-circle"></i> Failed !</h4>
			<p>
		     <?php echo "This User role is already Added."; ?> 
	         </p>
			</div>
			

		<?php }else{
			
		} ?> -->
  <div class="panel-heading lead ">
  <div class="row">
    <div class="col-lg-8 col-md-8"><label>Edit and View User Role Permissions</label></div>        
      <div class="col-lg-4 col-md-4 text-right">
         <div class="btn-group text-center">
					<a href="userrole.php" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add User Role</a>
				</div>
      </div>
  </div>
</div>
    <div class="panel-body"> 
    <div class="col-sm-12 form-group">  
                    <form class="form-horizontal" name="editbranch_details" action="" method="post" enctype="multipart/form-data">
					
                         <div class="form-group col-sm-12">
                        <label for="inputName" style="margin-top:11px;" class="col-sm-2 control-label">User Role Name<font color="red">&nbsp;*&nbsp;</font></label>
                        <div class="col-sm-10">
                          
                       <select name="zonename" class="form-control selectpicker" onchange="get_brnch(this.value);" data-live-search="true">
					   <option value="">Select User Role Name</option>
					   <?php 
					   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_user_role` WHERE Status = 'Active'");
					   while($viewuser=mysqli_fetch_array($selectzone))
					   {
						   $zid=$viewuser['Id'];
						 $zname=$viewuser['Role_name'];
						  
					?>
						<option value="<?php echo $zid;?>"<?php if($gpzid == $zid) echo 'selected'; ?>><?php echo $zname?></option>
					<?php }
					   ?>
                       </select>
                        </div>
                      </div>
		</div>
		<br><br>
	<div id="doc_brn"></div> 
	</div>
       <!-- /.content -->
       </div><!-- /.content-wrapper -->
	  </div>
      
	  <!-- start footer ----->

<!--footer End ------------>

<!--- start control sidebar ->
<?php //include 'controlsidebar.php'; ?>

<!-- control siderbar End ---->
     <div class="control-sidebar-bg"></div>
</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
  <script>
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>


<script>
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
$(".child_zone").load(function(){
    var all = $('.child_zone');
    if (all.length === all.filter(':checked').length) {
        $("#checkAll").prop("checked", true);
    } else {
        $("#checkAll").prop("checked", false);
    }
});
});

//submit validation
$(document).ready(function(){
	$("#submit").click(function(){ 
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
	
	
	$("#submit").click(function(){ 
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
	

	$("#submit").click(function(){ 
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
	
	$("#submit").click(function(){ 
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
	
	$("#submit").click(function(){ 
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
</script>
<?php mysqli_close($con);?>
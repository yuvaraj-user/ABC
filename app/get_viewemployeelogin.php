<?php
session_start();
require 'checkagain.php';
include_once 'srdb.php';


$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$edit=$fetchlevel['Edit'];
$ex_edit = explode(',',$edit);

$delete=$fetchlevel['Delete'];
$ex_del = explode(',',$delete);

$add=$fetchlevel['Role_add'];
$ex_add = explode(',',$add);

  
?>
<?php
if(!empty($_POST["div_doc"])) 
{ 
  $Brnch_Id=$_POST["div_doc"];
?>
<body class="hold-transition skin-blue sidebar-mini">

		
				<div class="row">                               
					<div class="col-lg-12 col-md-12 col-sm-12">				 
						<div class="tab-content">
							<div id="Summery" class="tab-pane fade in active">
								<div class="active tab-pane" id="group">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SNo</th>
						<th>Name</th>
                        <th>Emp Code</th>
                        <th>Email Id</th>	
                        <th>Photo</th>
                      <?php if((in_array(6.3,$ex_del)) || in_array(6.2,$ex_edit)) { ?> 						
                        <th> Actions </th>
					  <?php } ?>
					
					
                      </tr>
                    </thead>
		
                    <tbody>
					<?php 
				    
					 if($Brnch_Id == "all")
								{
									$qury_cus="select c.*,e.Designation as emp_designation from tbl_users c left join tbl_employee e on c.Emp_tbl_Id=e.Id where c.Status='Active'";
									
								}
								else
								{
									$qury_cus="select c.*,e.Designation as emp_designation from tbl_users c left join tbl_employee e on c.Emp_tbl_Id=e.Id where c.Branch='$Brnch_Id' and c.Status='Active'";
									 
									 
								}	
					$qury_exe=mysqli_query($con,$qury_cus);  
					$i=1;
					while($fetch=mysqli_fetch_array($qury_exe))
					{
					$fetch_desg1=$fetch['emp_designation'];	
					$selectdesign=mysqli_query($con,"select * from tbl_designation where Id='$fetch_desg1' and Status='Active'");
	                $designarray=mysqli_fetch_array($selectdesign);
	                $fetch_desg=$designarray['Name'];	
					?>
                        <tr>
			<td><?php echo $i; ?></td>
            <td><?php echo $fetch['Name']; ?></td> 
			<td><?php echo $fetch['Emp_Code']; ?></td>
			<td><?php echo $fetch['Email']; ?></td>
			<!--<td></td>--->
			<td><img src="<?php echo $fetch['Photo']; ?>" height="50" width="50"></td>
			
           <?php  if((in_array(6.3,$ex_del)) || in_array(6.2,$ex_edit)) { ?> 	
			<td>
				<div class="toggle_button_wrapper">
					<button class="toggle_button btn-sm">
						
					</button>
					<ul class="para" style="display:none;">
			  <?php if(in_array(6.2,$ex_edit)) {?>
						<li>
							<button type="button" onclick="window.location.href='editemployeelogin.php?id=<?php echo $fetch['Id']; ?>'">Edit&nbsp;</button>	
						</li>			
			 <?php } if(in_array(6.3,$ex_del)) {?>
						<li>
							<button type="button" onclick="window.location.href='remark_login.php?do=delete&id=<?php echo $fetch['Id']; ?>'"><a style=" text-decoration: none; color:#FFF" >Delete&nbsp;</a></button>
						</li>
			<?php } ?>
					</ul>
				</div>
			</td>
					<?php  } ?>
			
                      </tr>
			<?php $i++; } ?>
                      </tbody>
		
<?php } ?>
		
                    
                  </table> 
               </div>	
							</div>
						 </div>
					</div>
				
</section>

<?php #include 'controlsidebar.php'; ?>
<div class="control-sidebar-bg"></div>
</div>

    <script>
     $(function () {
        $("#example1").DataTable({ 
			"scrollX": true,
			"scrollY": 350,
			 "pageLength": 5,			
			"lengthMenu": [[5,10, 25, 50, 100,-1], [5,10, 25, 50, 100,"All"]],
     "scrollCollapse": true
		});
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
	
	 
    </script>
</script>
  </body>
</html>
					<?php  mysqli_close($con); ?>
<?php
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
require "checkagain.php";
include_once 'srdb.php';
$userleveltype=$_SESSION['User_Level_Type'];
$levels= $_SESSION['levelstatus'];
$user=$_SESSION['UserID'];
// Get Photo - Begin
$getuser=$_SESSION['UserID'];
$sessionuserid=$_SESSION['usersessionid'];
$q="select * from tbl_users where Email='$getuser'";
$pass=mysqli_query($con,$q);
$getarr=mysqli_fetch_array($pass);
$getphoto=$getarr['Photo'];
$getdesignation=$getarr['Designation'];
$empid=$getarr['Emp_tbl_Id'];
$select1="select * from tbl_employee where Id='$empid' and Status='Active'";
$qury_des=mysqli_query($con,$select1);
$fetch_des=mysqli_fetch_array($qury_des);
$fetch_desg1=$fetch_des['Designation'];

$selectdesign=mysqli_query($con,"select * from tbl_designation where Id='$fetch_desg1' and Status='Active'");
$designarray=mysqli_fetch_array($selectdesign);
$fetch_desg=$designarray['Name'];

$selectlevelbranch=mysqli_query($con,"select u.*,e.*,b.Name as cbranch from tbl_users u left join tbl_employee e on u.Emp_tbl_Id=e.Id left join tbl_branch b on b.Id=e.Branch where u.Id='$sessionuserid' and u.Status='Active'");
$fetchlevelbranch=mysqli_fetch_array($selectlevelbranch);
$tbranchname=$fetchlevelbranch['cbranch'];
			
			
session_start();
require "checkagain.php";
include_once 'srdb.php';	
$path=basename($_SERVER['PHP_SELF']);

$sessionuserid=$_SESSION['usersessionid'];


$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$add=$fetchlevel['Role_add'];
$edit=$fetchlevel['Edit'];
$ex_edit = explode(',',$edit);

$delete=$fetchlevel['Delete'];
$ex_del = explode(',',$delete);

$add=$fetchlevel['Role_add'];
$ex_add = explode(',',$add);

$permission=$fetchlevel['Permission'];
$ex_permission = explode(',',$permission);

 $sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select User_type,Emp_tbl_Id, User_Designation from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$type = $fetchlevel['User_type'];
$e_id = $fetchlevel['Emp_tbl_Id'];
$User_Designation_ID = $fetchlevel['User_Designation'];

$selectlevel_Id=mysqli_query($con,"select Level_Id from designation where Id='$User_Designation_ID'");
$fetchlevel_Id=mysqli_fetch_array($selectlevel_Id);

$User_Designation_emp = $fetchlevel_Id['Level_Id'];

//employee 

$employeelevel=mysqli_query($con,"select Branch from tbl_employee where Id='$e_id'");
$emplevel=mysqli_fetch_array($employeelevel);

  $brn_id = $emplevel['Branch'];

//branch 
$branchlevel=mysqli_query($con,"select Zone_Id from tbl_branch where Id='$brn_id'");
$brnlevel=mysqli_fetch_array($branchlevel);

$zone_id = $brnlevel['Zone_Id'];

//branch
$zonelevel=mysqli_query($con,"select Id from tbl_branch where Zone_Id='$zone_id' AND Status='Active'");

while($znlevel=mysqli_fetch_array($zonelevel))
{
$allbrn = $znlevel['Id'];
$brn_all[]=$allbrn;

}

 $all = implode(", ",$brn_all);

  $all_branch = $_SESSION['Desg_Branch'];
//divisions

//branch
$zonelevel_1 = mysqli_query($con,"select Clust_Name from tbl_zone where Id='$zone_id' AND Status='Active'");
$znlevel_1 = mysqli_fetch_array($zonelevel_1);
$zon_id = $znlevel_1['Clust_Name'];

$zonelevel_2 = mysqli_query($con,"select Id from tbl_zone where Clust_Name='$zon_id' AND Status='Active'");
while($znlevel_2=mysqli_fetch_array($zonelevel_2))
{
$allbrn_1 = $znlevel_2['Id'];

$zonelevel_3=mysqli_query($con,"select Id from tbl_branch where Zone_Id='$allbrn_1' AND Status='Active'");

$znlevel_3=mysqli_fetch_array($zonelevel_3);

$allbrn_3 = $znlevel_3['Id'];
$brn_all_1[]=$allbrn_3;

}

 $all_clu = implode(", ",$brn_all_1);
			
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="<?php echo $path_url;?>css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path_url;?>css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path_url;?>css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path_url;?>css/style.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo $path_url;?>css/dnc_stylesheet.css"> 
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
header {
	text-align: center;
	font-size: 16px;
}
.sub-menu {
	overflow-y: scroll;
	height: 500px;
	text-align: right;
	font-size: 12px;
	font-family: Comic Sans MS;
	background: white;
}
.sub-menu-parent {
	font-style: normal;
	font-size: 12px;
	font-family: Comic Sans MS;
}
nav ul li:hover { }
.sub-menu {
	visibility: hidden; /* hides sub-menu */
	opacity: 0;
	top: 100%;
	left: 0;
	width: 100%;
	transform: translateY(-2em);
	z-index: -1;
	transition: all 0.3s ease-in-out 0s, visibility 0s linear 0.3s, z-index 0s linear 0.01s;
}
#forms:hover .sub-menu {
	visibility: visible;
	opacity: 1;
	z-index: 1;
	transform: translateY(0%);
	transition-delay: 0s, 0s, 0.3s;
	text-align:left;
}
#forms:hover .sub-menu li{
	background-image:url(images/bg.jpg);
}
nav a {
	color: blue;
	display: block;
	padding: 0.4em 0.8em;
	text-decoration: none;
}
nav a:hover { color: black; }
nav ul, nav ul li {
	list-style-type: none;
	padding: 0;
	margin: 0;
}
nav > ul { background: white; }
nav > ul > li {
	display: inline-block;
	border-left: solid 1px #009933;
}
nav > ul > li:first-child { border-left: none; }
 .sub-menu::-webkit-scrollbar {
 display: none;
}
.main-header { background-color:#001138}


.scrollable-menu {
	height: auto;
	max-height: 200px;
	overflow-x: hidden;
}
.navbar-nav>li form{
	margin-bottom:0;	
}
.navbar-nav>li .search_form{
	position:relative;
}
.navbar-nav>li .search_form input[type="search"]{
    border: none;
    padding: 5px 30px 5px 10px;
    border-radius: 5px;
    margin-top: 8px;
}
.navbar-nav>li .search_form button{
	    background: none;
    border: none;
    position: absolute;
    right: 0;
    top: 7px;
    bottom: 0;
    font-size: 16px;
}
.navbar-nav>li .search_form button:after{
	content: "\f002";
	    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}



</style> 
<script type="text/javascript">
	$(function()   {
		$(".notification-toggle").click(function(e) {
			e.preventDefault();
			$('.notification-box').hide();
			$(this).next('.notification-box').show();
			$('.notification-bg').addClass('open');
		});                
		$(".notification-bg").mouseup(function(e) {
			e.preventDefault();
			$('.notification-box').hide();
			$('.notification-bg').removeClass('open');
		});                
	});
</script>
<script type="text/javascript" charset="utf-8">
 
 //document.getElementsByTagName('body').classList.add("hold-transition skin-blue sidebar-mini fixed");
 document.getElementsByTagName('body').classList.add("hold-transition skin-blue sidebar-mini fixed");
  
function addmsg(type, msg){
 
$('#notification_count').html(msg);
$('#notification_count1').html(msg); 
$('#notification_count2').html(msg);
}
 
 function addmsg1(type, msg){	 
 $('#notification_msg').html(msg);
 $('#hidden1').html(msg);
 
 var singleValues = msg;

      $.ajax({
            url: "header.php",
            type: "GET",
            data: {account: singleValues},
            async: false,
		
         });
 
   $("#pp").val(singleValues);
  //window.location.href = "header.php?pp="+singleValues;
 }
 
function waitForMsg(){ 
$.ajax({
type: "GET",
url: "select.php",
 
async: true,
cache: false,
timeout:50000,
 
success: function(data){
addmsg("new", data);
setTimeout(
waitForMsg,
1000
);

},
error: function(XMLHttpRequest, textStatus, errorThrown){
addmsg("error", textStatus + " (" + errorThrown + ")");
setTimeout(
waitForMsg,
15000);
}
});
};
 
function waitForMsg1(){
 
$.ajax({
type: "GET",
url: "selectmsg.php",
 
async: true,
cache: false,
timeout:50000,
 
success: function(data){
addmsg1("new", data);

setTimeout(
waitForMsg1,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){
addmsg1("error", textStatus + " (" + errorThrown + ")");
setTimeout(
waitForMsg1,
15000);
}
});
}; 

$(document).ready(function(){
 
waitForMsg();
waitForMsg1();
 
});

 function call_Form() {
   document.getElementById('form').style.display = "block";
   }


$(document).ready(function () {
          if (!$.browser.webkit) {
              $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
          }
      });   
</script>

  <?php //include 'form.php'; ?>
  
<?php/*
$query_gpct = mysqli_query($con, "SELECT * FROM `tbl_groupchit` WHERE Status='Active'");		
while($fetch = mysqli_fetch_array($query_gpct))
{							
	$Branch_Id = $fetch['Branch_Id'];
	$Group_Name = $fetch['Name'];
	$Group_Id = $fetch['Id'];
	$FD_Renewal_l = $fetch['FD_Renewal'];
	$dateB = date('d-m-Y');
	$Fd_Taken_Date = $fetch['Fd_Taken_Date'];

if((strtotime($FD_Renewal_l) == strtotime($dateB)) && $Fd_Taken_Date == '')
{
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$Approval_Type_l = "Groupchit_not";	
		
	$query_nom_l=mysqli_query($con, "select * from tbl_approval_notify where Group_Id='$Group_Id'");	
	$fetch_l = mysqli_fetch_array($query_nom_l);
	if(mysqli_num_rows($query_nom_l)==0)
	{
		$qry_insert_notify = mysqli_query($con, "insert into tbl_approval_notify(`Approval_Type`, `Group_Id`, `Created_On`, `Created_By`, `Updated_On`, `Updated_By`, `For_Notification`, `Status`)  values ('$Approval_Type_l', '$Group_Id', '$createdon', '$createdby', '$updatedon', '$updatedby', '0', 'UnApproved')");
	}

}
}*/
 ?>
 

</head>
  

<div class="notification-bg"></div>
<a style="display:none;color: #000;" href="javascript:void(0)" class="closebtn overlay_close" onclick="closeNav()">&times;</a>

<header class="main-header">
<!-- Logo --> 
<a href="<?php echo $path_url;?>home.php" class="logo"> 
<!-- mini logo for sidebar mini 50x50 pixels --> 
<span class="logo-mini"><b>User</b></span> 
<!-- logo for regular state and mobile devices --> 
<span class="logo-lg"><b>ABC Agro</b> </span> </a> 

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button--> 
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
<!--<font size='5'><?php echo $tbranchname.'&nbsp;Branch'; ?></font>--> 
<!-- Navbar Right Menu -->

<script>
            function openNav() {
               document.getElementById("mySidenav").style.right = "0";
               document.getElementById("newWrapper").style.marginright = "350px";
           }

           function closeNav() {
               document.getElementById("mySidenav").style.right = "-450px";
               document.getElementById("newWrapper").style.marginright = "0";
           }
            $(function () {
                $('.push_menu').on('click', function () {
                    $(".overlay_close").addClass('active');
                    $("body").css('overflow', 'hidden');
                });

                $('.overlay_close, .closebtn').on('click', function () {
                    $(".overlay_close").removeClass('active');
                    $("body").css('overflow', 'auto');
                });
                $('.notify_close').on('click', function () {
					
                    $(this).parent().hide(300);
                });

            })
        </script>


       <style>
           .sidenav {
height: 100%;
position: fixed;
z-index: 9999999;
top: 0;
right: 0;
width: 400px;
padding: 25px;
right: -450px;
background: #001138;
overflow: hidden;
transition: 0.5s; 
           }
           #mySidenav h3{
color:#fff;
               text-align:center;
margin-top: 0;
margin-bottom: 15px;
           }
           .sidenav_wrapper{
padding: 0 5px 0 0;
height: 85%;
overflow-y: auto;
           }
           .overlay_close.active{
               position: fixed;
               display: block !important;
               background: #0000006b;
               width: 100%;
               height: 100%;
               z-index: 999999;
               left: 0;
           }
           .sidenav a {
               text-decoration: none;
               font-size: 25px;
               color: #818181;
               display: block;
               transition: 0.3s;
           }

           .sidenav a:hover {
               color: #ff0000;
           }

           .sidenav .closebtn, .sidenav .notify_close {
position: absolute;
top: 10px;
right: 10px;
font-size: 36px;
margin-left: 50px;
color: #001138;
line-height: 20px;
           }

           .wrapper {
               transition: margin-left .5s;
           }
           .notify_section{
position: relative;
border: 1px solid #ffffff61;
padding: 10px;
margin-bottom: 5px;
background: #fff;
color: #000;
border-radius: 5px;
           }
           .notify_section h4{
padding-bottom: 5px;
margin-top: 0;
font-weight: 600;
font-size: 15px;
margin-bottom: 2px;
color: #001138;
           }
           .notify_section p{
margin-bottom: 0;
font-size: 15px;
line-height: 22px;
color: #001138;
           }
           .sidenav  a.view_all{
color: #fff;
position: absolute;
background: #337ab7;
bottom: 10px;
left: 0;
right: 0;
margin: auto;
width: 120px;
height: 36px;
line-height: 36px;
padding: 0;
text-align: center;
border-radius: 5px;
text-transform: uppercase;
font-size: 14px;

           }
           .dropdown-submenu span.count_notify{
               position: absolute;
               color: #000;
               font-size: 11px;
               top: 6px;
               background: #f7e8e8;
               padding: 1px 4px;
               border-radius: 50px;
           }
            .notify_section a{
                color:#000;
                transition: 0.5s;
                margin-top: 3px;
                display: block;
                text-decoration: underline;
                font-size: 16px;
            }
             .notify_section a:hover{
                color:#f00;
                transition: 0.5s;
            }
           @media screen and (max-height: 450px) {
               .sidenav a {font-size: 18px;}
           }
       </style>
<div class="navbar-custom-menu" >
	<ul class="nav navbar-nav">
		<?php /*if($levels='1' && $userleveltype=='High') { ?>
		    <li class="dropdown notifications-menu open" id='myDiv'>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning" id="notification_count" ></span>
                </a>
                <ul class="dropdown-menu" style="min-width: 600px;">
                  <li class="header">You have <span id="notification_count1"> </span> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: scroll; width: auto; height: 200px;">
					<ul class="menu" style="overflow: hidden; width: auto; height: 200px;" >
                    
			<form class="form-horizontal" name="dd" id="dd" action="#" method="post" enctype="multipart/form-data">	  
			<input type="hidden" id="pp" name="pp" value="">
			<!--<input type="submit" name='ddf' >-->
			</form>
			<script>
		  $("#myDiv").click(function() {
          $("#dd").submit();
              });
           </script>
		   
		<script type="text/javascript">
       	function getnotification(val) {
				//alert(0);	
				$.ajax({
				type: "POST",
				url: "update.php",
				data:'updateid='+val,
				
				});
				}
        </script> 
		   
		   
		<?php 
		if(isset($_POST['pp']))
		{
	 $gg=rtrim($_POST['pp'],"*");
	
     $notifymsg=explode('*',$gg);
	// $countmsg=count(explode('*',$gg));
	$k=0;
	  foreach($notifymsg as $notify)
	 { 
		 
		 $ss= $notify;
		 $selectnotification="select * from tbl_messagetest where Id='$ss'";
		 $exequery=mysqli_query($con,$selectnotification);
		 $fetchnotification=mysqli_fetch_array($exequery);
		 if($fetchnotification['Status']=='unread')
		 {
			 $msg_notification="<font color='red'>".$fetchnotification['Notification']."-".$fetchnotification['Notification_Time']."</font>";
		 }
		 else 
		 {
			 $msg_notification="<font color='green'>".$fetchnotification['Notification']."-".$fetchnotification['Notification_Time']."</font>";
		 }
		
		?>
		             <li id="note<?php echo $k;?>">
                        <a href="#" id="ff" onclick="getnotification(<?php echo $ss; ?>);" >
                          <i class="fa fa-warning text-yellow"></i><?php echo $msg_notification; ?>
						 <!-- <input type='hidden' name='mesid' value='<?php echo $ss; ?>'>--->
                        </a>
                      </li>
	<?php
	
        $k++;	} 
		}
   
			
			?>	
                    </ul><div class="slimScrollBar" style="width: 6px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0); overflow-y: auto;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51); overflow-y: auto;"></div></div>
                  </li>
                 <!-- <li class="footer"><a href="#">View all</a></li>--->
                </ul>
              </li>
			<?php } */?>
		<!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo $path_url;?><?php if(!empty($getphoto)) { echo $getphoto; } else { echo "dist/img/default1.png"; } ?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $_SESSION['User']; ?></span> </a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header"> <img src="<?php echo $path_url;?><?php if(!empty($getphoto)) { echo $getphoto; } else { echo "dist/img/default1.png"; } ?>" class="img-circle" alt="User Image">
					<p> <?php echo $_SESSION['User']; ?> - <?php echo $fetch_desg; ?> <small><?php echo date('d-m-Y'); ?></small> </p>
				</li>
				<!-- Menu Body --> 
				<!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>---> 
				<!-- Menu Footer-->
				
				<li class="user-footer">
					<div class="pull-left"> <a href="<?php echo $path_url;?>password_change.php?id=<?php echo $sessionuserid; ?>" class="btn btn-primary btn-flat"><i class="fa fa-lock" aria-hidden="true"></i>
 Change Password</a> </div>
					<div class="pull-right"> <a href="<?php echo $path_url;?>logout.php" class="btn btn-primary btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> </div>
				</li>
				<li class="user-footer">
				
				</li>
			</ul>
		</li>
		<!-- Control Sidebar Toggle Button --> 
		<!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>--->
	</ul>
</div>
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<li class="dropdown user user-menu" style="display:none">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-th"style="font-size:19px;" ></i> </a>
<ul class="dropdown-menu ">
	
	<!-- User image -->
	<li class ="row">
		<?php 
				  if($allaccess == 'Highest')
				 {
                     ?>
	<li  class="col-sm-6"> <a href="#"> <i class="glyphicon glyphicon-thumbs-up"style="font-size:50px;"></i>
		<h6>User Rights</h6>
		</a> </li>	
	<?php }  else{   
				   
				foreach($editlist as $value1 )
				{
				if($value1 =='1028')  
				 { ?>
	<li  class="col-sm-6"> <a href="#"> <i class="glyphicon glyphicon-thumbs-up"style="font-size:50px;"></i>
		<h6>User Rights</h6>
		</a> </li>
	<?php } } }?>
	<li class="col-sm-6"> <a href="#"> <i class="fa fa-pencil-square-o"style="font-size:50px;"></i>
		<h6>Payment Entry</h6>
		</a> </li>
	<?php 
				  if($allaccess == 'Highest')
				 {
                     ?>
	<li class="col-sm-6"> <a href="#"> <i class="fa fa-user"style="font-size:50px;"></i>
		<h6>Default Customer</h6>
		</a> </li>
	<li class="col-sm-6"> <a href="#"> <i class="fa fa-minus"style="font-size:50px;"></i>
		<h6>Owner MIS</h6>
		</a> </li>
	<?php } ?>	
	</li>
	</li>
</ul>
</div>
<div class="navbar-custom-menu" >
	<!--<ul class="nav navbar-nav">
		<?php  
		  foreach($editlist as $value1 )
				{
				if($value1 =='10.29'|| $allaccess == 'Highest')  
				 { ?>
		<li class="dropdown user user-menu" id ="forms"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> File </a>
			<ul style="width:10%;" class="dropdown-menu">
				<ul>
					<li class="sub-menu-parent">
						<h4>Forms Lounge</h4>
						<ul class="sub-menu">
							<li><a href="formnoone.php"> <span>form - 1</a></span> </li>
							<li><a href="formnoonea.php"> <span>form - 1 A</a></span> </li>
							<li><a href="formnooneb.php"> <span>form - 1 B</a></span> </li>
							<li> <span><a href="formnotwo.php">form - 2</a></span></li>
							<li><a href="formnothree.php">form - 3</a></li>
							<li><a href="formnofour.php">form -  4</a></li>
							<li><a href="formnofoura.php">form -  4 A</a></li>
							<li><a href="formnofive.php">form - 5</a></li>
							<li><a href="formnosix.php">form - 6</a></li>
							<li><a href="formnoseven.php">form - 7</a></li>
							<li><a href="formnoeight.php">form - 8</a></li>
							<li><a href="formnonine.php"> form - 9</a></li>
							<li><a href="formnoten.php">form - 10</a></li>
							<li><a href="formnolevon.php">form - 11</a></li>
							<li><a href="formnotwl.php">form - 12</a></li>
							<li><a href="formnothirteen.php">form - 13</a></li>
							<li><a href="formnofourteen.php">form - 14</a></li>
							<li><a href="formnofivteen.php">form - 15</a></li>
							<li><a href="formnosixte.php">form - 16</a></li>
							<li><a href="formnoseventee.php">form - 17</a></li>
							<li><a href="formnoeightee.php">form - 18</a></li>
							<li><a href="formnonintee.php">form - 19</a></li>
							<li><a href="formnotwintee.php">form - 20</a></li>
							<li><a href="formnotwentyone.php">form - 21</a></li>
						</ul>
					</li>
				</ul>
				<?php } } ?>
			</ul>
		</li>
	</ul>-->
</div>


<div class="navbar-custom-menu" >
	<ul class="nav navbar-nav">
	    <li class="dropdown-submenu"><a  data-toggle="modal" name="feedback" data-target="#myModal1<?php echo $i; ?>" data-backdrop="static" data-keyboard="false">
	    <!-- img src="../app/images/money.png" class="img-responsive" height="25px" width="25px" alt="icon" -->
	</a></li>
	
		<li class="dropdown-submenu"> <a href="<?php echo $path_url;?>home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
		 <?php if ($User_Designation_emp == "0") { 
		     $query_nom="select COUNT(Id) as CID from tbl_approval_notify where Status='UnApproved'"; 
			 $query_nom_exe=mysqli_query($con,$query_nom);
             $fetch_nom_array=mysqli_fetch_array($query_nom_exe);
			 $notification = $fetch_nom_array['CID'];
		 } elseif ($User_Designation_ID == "-1") {
			 $cur_date_org = date("d-m-Y");
			 $query_nom="select COUNT(Id) as CID from tbl_approval_notify where Branch_Id IN ($all_branch) AND Forward_To='$User_Designation_emp' And SUBSTRING_INDEX(Created_On,' ',1)='$cur_date_org' ORDER BY Id DESC LIMIT 50"; 
			 $query_nom_exe=mysqli_query($con,$query_nom);
             $fetch_nom_array=mysqli_fetch_array($query_nom_exe);
			 $notification = $fetch_nom_array['CID'];
		 } elseif ($User_Designation_emp != "") { 
		     $query_nom="select COUNT(Id) as CID from tbl_approval_notify where Branch_Id IN ($all_branch) And Status='UnApproved' AND Forward_To='$User_Designation_emp'"; 
			 $query_nom_exe=mysqli_query($con,$query_nom);
             $fetch_nom_array=mysqli_fetch_array($query_nom_exe);
			 $notification = $fetch_nom_array['CID'];
			 
		} ?>
 <li class="dropdown-submenu">  

 



			
<li class="dropdown-submenu">

</a> </li> 
               

	</ul>
</div>
</nav>
			

</header>


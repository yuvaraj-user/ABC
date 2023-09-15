<?php

session_start();
require "checkagain.php";
include_once 'srdb.php';

$user=$_SESSION['UserID'];
$sessionuserid=$_SESSION['usersessionid'];
$empuserid=$_SESSION['employeesessionid'];
$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid' and Status='Active'");
$fetchlevel=mysqli_fetch_array($selectlevel);
$Level=$fetchlevel['Level'];
$leveltype=$fetchlevel['Level_Type'];
$emptablid=$fetchlevel['Emp_tbl_Id'];
$allaccess=$fetchlevel['Level_Type_High'];
$path=basename($_SERVER['PHP_SELF']);
$fname="select * from tbl_filename where Status='Active' and File_Name='$path'";
$fsql=mysqli_query($con,$fname);
$fetchtext=mysqli_fetch_array($fsql);
 $textparentid=$fetchtext['parent_id']; 
 $ftext="select * from tbl_filename where Status='Active' and Id='$textparentid'";
$textsql=mysqli_query($con,$ftext);
$textfetch=mysqli_fetch_array($textsql);
$textf=$textfetch['title']; 
$parent_id=$textfetch['parent_id']; 
$ftextt="select * from tbl_filename where Status='Active' and Id='$parent_id'";
$textsqlt=mysqli_query($con,$ftextt);
$textfetcht=mysqli_fetch_array($textsqlt);
$textft=$textfetcht['title']; 
$textmainparent=$textft;
$basename = basename($_SERVER['REQUEST_URI']);
$textf ;
?>
 <html>
 <head> 
  <style>
.tree{
 background-color: black;
}
.tree {
    background-color: black;
    margin-bottom: 10px;
    max-height: 500px;
    min-height: 20px;
    overflow-y: auto; 
    padding: 1px;
    a {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 90%;
    }
    li {
        list-style-type: none;
        margin: 0px 0;
        padding: 4px 0px 0px 2px;
        position: relative;
        &::before, &::after {
            content: '';
            left: -20px;
            position: absolute;
            right: auto;
        }
        &::before {
            border-left: 1px solid @grayLight;
            bottom: 50px;
            height: 100%;
            top: 0;
            width: 1px;
        }
        &::after {
            border-top: 1px solid @grayLight;
            height: 20px;
            top: 13px;
            width: 23px;
			display:block !important;
        }
        span {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border: 1px solid @grayLight;
            border-radius: 5px;
            display: inline-block;
            line-height: 14px;
            padding: 2px 4px;
            text-decoration:none;
        }
         
         
    }
     
}
/*parent*/
.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.link>a
{
	color:white;
	display:block;
}
/*child*/
.skin-blue .treeview-menu>li:hover>a, .skin-blue .treeview-menu>li.active>a,.skin-blue .treeview-menu>li.link>a
{
	color:white;
	display:block;
}
 .tree::-webkit-scrollbar { 
    display: none; 
}


</style>
    <!--<link rel="stylesheet" href="app.js">-->
 </head>
 <body>
      <aside class="main-sidebar">  
        <section class="sidebar">  
          <div class="user-panel"> 
            <div class="pull-left image">
              <img src="./<?php if(!empty($getphoto)) { echo $getphoto; } else { echo "dist/img/default1.png"; } ?>" class="img-circle" alt="User Image">
            </div> 
            <div class="pull-left info">
              <p><?php echo $_SESSION['User']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div> 
			</div>    
			  <div class ="tree well" id= "menux" style="border-top:1px solid #fff; border-radius:0 !important;">  
			<ul class ='sidebar-menu'>
 <?php  $permission=$_SESSION['permission']; 
 
				
 
              $permissionlist=explode(',',$permission); 
				 $refs = array();
                 $list = array(); 
				 $selectfile=mysqli_query($con,"SELECT id as menu_item_id, parent_id as menu_parent_id, title as  text, File_Name,menu_order,icon, level FROM tbl_filename where parent_id= '0' and Status='Active' ORDER BY menu_order Asc "); 
				  while($data=mysqli_fetch_array($selectfile))
				  {
					  if(in_array($data['level'], $permissionlist))
                        {
							?>
							 <li class='<?php if($textmainparent == $data['text'] || $textf == $data['text']){?>active<?php }?> treeview'>
                            <a href="<?php echo $data['File_Name'];?>" class="Main">
                                <i class="fa <?php echo $data['icon']; ?>"></i>
                                <span><?php echo $data['text']; ?></span>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
							
							<?php
					  $sub_id=$data['menu_item_id'];
					  $sub_selectfile=mysqli_query($con,"SELECT id as menu_item_id, parent_id as menu_parent_id, title as  text, File_Name,menu_order,icon, level FROM tbl_filename where parent_id= '$sub_id' and Status='Active' ORDER BY menu_order Asc"); 
					  if (mysqli_num_rows($sub_selectfile) > 0) {
						 
                                ?>
                                <ul class ='active treeview-menu'>
							<?php
					  while($sub_data=mysqli_fetch_array($sub_selectfile))
					  {
						   if(in_array($sub_data['level'], $permissionlist))
                        {
							?>
							<li class='<?php if($textf == $sub_data['text'] || $basename == $sub_data['File_Name']){?>active<?php }?> treeview'>
                            <?php
							$useridval = "";
							if($sub_data['menu_item_id'] == '94'  || $sub_data['menu_item_id'] == '89' || $sub_data['menu_item_id'] == '95' )
							{
								$useridval = "?user_id=".$sessionuserid;
							}?>
							<a href="<?php echo $sub_data['File_Name'].$useridval;?>" class="Sub">
                                <i class="fa fa-angle-double-right<?php echo $sub_data['icon']; ?>"></i>
                                <span><?php echo $sub_data['text']; ?></span>
                              
                            </a>
							
							<?php
						  $super_sub_id=$sub_data['menu_item_id'];
						  $super_sub_selectfile=mysqli_query($con,"SELECT id as menu_item_id, parent_id as menu_parent_id, title as  text, File_Name,menu_order,icon, level FROM tbl_filename where parent_id= '$super_sub_id' and Status='Active' ORDER BY menu_order Asc"); 
						  if (mysqli_num_rows($super_sub_selectfile) > 0) {
                                ?>
                                <ul class ='active treeview-menu'>
								<?php
						  while($super_sub_data=mysqli_fetch_array($super_sub_selectfile))
						  {
									   if(in_array($super_sub_data['level'], $permissionlist))
								{
									?>
							<li class='<?php if($textf == $super_sub_data['text'] || $basename == $super_sub_data['File_Name']){?>active<?php }?> treeview'>
                            <?php
							$useridval = "";
							if($super_sub_data['menu_item_id'] == '94'  || $super_sub_data['menu_item_id'] == '89' || $super_sub_data['menu_item_id'] == '95' )
							{
								$useridval = "?user_id=".$sessionuserid;
							}?>
							<a href="<?php echo $super_sub_data['File_Name'].$useridval;?>" class="SuperSub">
                                <i class="fa fa-angle-double-right <?php echo $super_sub_data['icon']; ?>"></i>
                                <span><?php echo $super_sub_data['text']; ?></span>
                              
                            </a>
							</li>
							<?php
									  // echo $data['text']." <br/>Sub :".$sub_data['text']."<br/>";
								}
						  }
						  ?>
						  </ul>
						  <?php
						  }
						  ?>
						  </li>
						  <?php
						}
					  }
					   ?>
						  </ul>
						  <?php
						  }
						  ?>
						  </li>
						  <?php
						}
				  }
				  ?>
				  </ul>
				  <?php
				  
               
 
 function create_list( $arr ,$urutan,$textf,$path)
    {  
        if($urutan==0){ 
		
             $html = "\n<ul class ='sidebar-menu'>\n";
        }else
        { 
             $html = "\n<ul class ='active treeview-menu' id='m'>\n";
			 } 
        foreach ($arr as $key=>$v)
        {   
            if (array_key_exists('children', $v))
            {  
		//	print_r (array_column($arr,'children'));		
				//echo $textparentid;
				$text;

				 $v['text'];
			
			if ($textf == $v['text'])
			{ 
					//echo "sc1";
				 $html .= "<li class='active treeview'>\n";
			}

			else
			{
				//echo "fail 1";
				 $html .= "<li class='treeview'>\n";
			}				
         
                $html .= '<a href="#">
                                <i class="'.$v['icon'].'"></i>
                                <span>'.$v['text'].'</span>
                                <i class="fa fa-angle-down pull-right"></i>
				        </a>'; 
                $html .= create_list($v['children'],1,$textf,$path);
                $html .= "</li>\n";
            }
		
            else{ 
					/* $emp1=$v['File_Name'];*/
				 //	print_r ($v['menu_parent_id']);
				 
				 if ($path == $v['File_Name'])
			{ 
				//echo "sc 2";
				 $html .= '<li class="active"> <a href="'.$v['File_Name'].'">';
			}

			else
			{	
		//echo "fail 2";
				 $html .= '<li> <a href="'.$v['File_Name'].'">';		
				}
							
				 
				 
                    if($urutan==0)
                    { 
                        $html .=    '<i class="'.$v['icon'].'"></i>';
                    }
                    if($urutan==1)
                    {
						   
                        $html .=  '<i class="fa fa-angle-double-right"></i>';
						
                    }
                    $html .= $v['text']."</a></li>\n";} 
			
			
        }  
	
        $html .= "</ul>\n"; 
        return $html;
		}	 
    echo create_list( $list,0,$textf,$path);
	?> 
	</div>
	</section>
		 </aside>
		 <script> 
		  
		 var AdminLTEOptions = { 
  navbarMenuSlimscroll: true,
  navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
  navbarMenuHeight: "50px", //The height of the inner menu
  sidebarSlimScroll: true,
	//Enable sidebar expand on hover effect for sidebar mini
    //This option is forced to true if both the fixed layout and sidebar mini
    //are used together
    sidebarExpandOnHover: true,
    //BoxRefresh Plugin
    enableBoxRefresh: true,
    //Bootstrap.js tooltip
    enableBSToppltip: true,
	enableControlTreeView: true, 
	sidebarToggleSelector: "[data-toggle='offcanvas']",
  };
   
  $(".search-menu-box").on('input', function() {
	
    var filter = $(this).val();
    $(".sidebar-menu > li").each(function(){
		
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide();
        } else {
		 
            $(this).show();
			
        }
		
    });
	
	 
});




  
</script> 

<script>                    
function Scrolldown()       
{                           
    .tree.scroll(0,1000);       

 }                          
 window.onload = Scrolldown;
</script>                   
</html>                     

  
  
  
		 
		 
		 
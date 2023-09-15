<?php 
session_start();
require 'checkagain.php';
include_once("srdb.php");

date_default_timezone_set("Asia/Kolkata");
//echo $to; firstname_F.
$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

 $type = $fetchlevel['User_type'];
$e_id = $fetchlevel['Emp_tbl_Id'];
//employee 

$employeelevel=mysqli_query($con,"select * from tbl_employee where Id='$e_id'");
$emplevel=mysqli_fetch_array($employeelevel);

$brn_id = $emplevel['Branch'];

//branch 
$branchlevel=mysqli_query($con,"select * from tbl_branch where Id='$brn_id'");
$brnlevel=mysqli_fetch_array($branchlevel);

$zone_id = $brnlevel['Zone_Id'];

//branch
$zonelevel=mysqli_query($con,"select * from tbl_branch where Zone_Id='$zone_id' AND Status='Active'");

while($znlevel=mysqli_fetch_array($zonelevel))
{
$allbrn = $znlevel['Id'];
$brn_all[]=$allbrn;

}

$all = implode(", ",$brn_all);


if(isset($_REQUEST['submit']))	{
        			
	     $Leadid=$_REQUEST['LeadId'];
	     $files=$_REQUEST['files'];
	      
			$cmon = date('m');
			$cyr = date('y');
			
		 $appsql = mysqli_query($con,"SELECT MAX( CONVERT( Application_No, UNSIGNED INTEGER ) ) AS num FROM tbl_customer where Application_No like '$cyr$cmon%'");
		 $appsqlfetch = mysqli_fetch_array($appsql);
		  $numrows = mysqli_num_rows($appsql);
		   $appnosqlchk = $appsqlfetch['num'];
		 if($numrows==0 || $appnosqlchk==""){
				$cnum =0001;
				$cnum = sprintf("%04d", $cnum);
				$finalnum = $cyr.$cmon.$cnum;
		 }else{
			 $appnosql = $appsqlfetch['num'];
		 
			$m1 =  substr($appnosql,2,2);
			$y1 =  substr($appnosql,0,2); 
			$num =  substr($appnosql,-4);
			
 
			if($cmon==$m1 && $cyr==$y1){
				$num = sprintf("%04d", $num+1);
				$finalnum = $y1.$m1.$num;
			}
		 }
		
	$application = $finalnum;
	$customerChitType="Auction";
	$Customer_Id=$_REQUEST['cust_uniqueid'];
	//$application =$_REQUEST['Applicationno'];
	$application = $finalnum;
	$Acc_type = $_REQUEST['Acc_type'];
	$occupation = $_REQUEST['occupation'];
	$vacant_remark = $_REQUEST['vacant_remark'];
	$branchname = $_REQUEST['branch'];	
	$applicationdate=$_REQUEST['applicationdate'];
	$chitaccount_F=$_REQUEST['chitaccount_F'];
	$chitdeposit_F=$_REQUEST['chitdeposit_F'];
	$otherpurpchit_F=$_REQUEST['otherspurpchit'];
	$prefix_F=$_REQUEST['prefix_F'];
        $othersprefix_F=$_REQUEST['othersprefixvalue'];		
	$firstname_F=$_REQUEST['firstname_F'];
	$initial_F=$_REQUEST['initial_F'];	
	$initialfname=$firstname_F." . ".$initial_F;
	
	$getid="select Max(Id) as Id from tbl_customer where Status='Active'";
	$get_exe=mysqli_query($con,$getid);
	$fetchmaxid=mysqli_fetch_array($get_exe);
	$custd=$fetchmaxid['Id'];
	$custid=$custd+1;
	
	$middlename_F=$_REQUEST['middlename_F'];
	$surname_F=$_REQUEST['surname_F'];		
	$nationality_F = $_REQUEST['nationality_F'];	
	$panno_F=$_REQUEST['panno_F'];
	$ration_F=$_REQUEST['ration_F'];
	$father_F=$_REQUEST['father_F'];
	$mother_F=$_REQUEST['mother_F'];
	$wife_F=$_REQUEST['wife_F'];	
	$dob_F=$_REQUEST['dob_F'];	
	$Gender_F=$_REQUEST['Gender_F'];
	$Photo_F=$_REQUEST['Photo_F'];
    $Age_F=$_REQUEST['age_F'];		
	$ageproof_F=$_REQUEST['ageproof_F'];	
    $file_F=$_REQUEST['file_F'];
    $path_F=$REQUEST['path_F'];	
	$mothermaiden_F=$_REQUEST['mothermaiden_F'];	
	$scitizen_F=$_REQUEST['scitizen_F'];	
	//$ageproofdocs_F=$_REQUEST['ageproofdocs_F'];
    $ageproofdocs_F="";	
	$ageproofdoc_F=$_REQUEST['ageproofdoc_F'];	
	$companyname_F=$_REQUEST['companyname_F'];	
	$roadno_F=$_REQUEST['roadno_F'];	
	$landmark_F=$_REQUEST['landmark_F'];	
	$city_F=$_REQUEST['city_F'];	
	$State_F=$_REQUEST['state_F'];	
	$roadno_F=$_REQUEST['roadno_F'];	
	$country_F=$_REQUEST['country_F'];	
	$pincode_F=$_REQUEST['pincode_F'];
	$telr_F=$_REQUEST['telr_F'];	
	$telo_F=$_REQUEST['telo_F'];	
	$Ext_F=$_REQUEST['Ext_F'];
	$aadhar_F=$_REQUEST['aadhar_F'];	
	$email_F=$_REQUEST['email_F'];	
	$mobile_F=$_REQUEST['mobile_F'];	
	$mobile_AF=$_REQUEST['mobile_AF'];	
	$emailreg_F=$_REQUEST['emailreg_F'];
   // $secapplc=$_REQUEST['secapplc'];	
	$Relation_S=$_REQUEST['Relation_S'];
	$prefix_S=$_REQUEST['prefix_S'];
    $othersprefix_S=$_REQUEST['othersprefixvalue_S'];	
	$firstname_S=$_REQUEST['firstname_S'];	
	$initial_S=$_REQUEST['initial_S'];	
	$initialsname=$firstname_S." . ".$initial_S;
	$middlename_S=$_REQUEST['middlename_S'];	
	$surname_S=$_REQUEST['surname_S'];		
	$nationality_S = $_REQUEST['nationality_S'];	
	$panno_S=$_REQUEST['panno_S'];
	$father_S=$_REQUEST['father_S'];
	$mother_S=$_REQUEST['mother_S'];
	$fs_name = $_REQUEST['fsname'];
	$wife_S=$_REQUEST['wife_S'];	
	$dob_S=$_REQUEST['dob_S'];	
	$Gender_S=$_REQUEST['Gender_S'];
    $Age_S=$_REQUEST['Age_S'];	
	$ageproof_S=$_REQUEST['ageproof_S'];	
    $file_S=$_REQUEST['file_S'];	
	$mothermaiden_S=$_REQUEST['mothermaiden_S'];	
	$scitizen_S=$_REQUEST['scitizen_S'];	
	$ageproofdocs_S=$_REQUEST['ageproofdocs_S'];	
	$ageproofdoc_S=$_REQUEST['ageproofdoc_S'];	
	$companyname_S=$_REQUEST['companyname_S'];	
	$roadno_S=$_REQUEST['roadno_S'];	
	$landmark_S=$_REQUEST['landmark_S'];	
	
	$roadno_S=$_REQUEST['roadno_S'];	
	$country_S=$_REQUEST['country_S'];	
	$pincode_S=$_REQUEST['pincode_S'];
	$telr_S=$_REQUEST['telr_S'];	
	$telo_S=$_REQUEST['telo_S'];	
	$Ext_S=$_REQUEST['Ext_S'];	
	
	$companyname_P=$_REQUEST['companyname_P'];
	
   
	$status="Active";
	$flag2=1;
	$flag1=1;
	$flag3=1;
	$flag4=1;
	$flag5=1;
	$createdon=date("d-m-Y H:i:s A");
	$createdby=$_SESSION['User'];
	$updatedon=0;
	$updatedby=0;
	$cmonth=date("m");
    $cyear=date("y");
   

		$Occupation_A=$_REQUEST['Occupation_A'];
		$Occupation_S=$_REQUEST['Occupation_S'];
        $othersOccupation_A=$_REQUEST['othersOccupation_A'];
        $selfemployeddate_A=$_REQUEST['selfemployeddate_A'];
        $natureofbusiness_A=$_REQUEST['natureofbusiness_A'];
        $othernature_A=$_REQUEST['othernature_A'];
        $dateofincorporation_A=$_REQUEST['dateofincorporation_A'];
		$typeofcompanyfirm_A=$_REQUEST['typeofcompanyfirm_A'];
        $salariedempwith_A=$_REQUEST['salariedempwith_A'];
        $othersalaried_A=$_REQUEST['othersalaried_A'];
        $selfempprofessional_A=$_REQUEST['selfempprofessional_A'];
        $othersselfemplyedProff_A=$_REQUEST['othersselfemplyedProff_A'];
        
        
		$grossannualincome_A=$_REQUEST['grossannualincome_A'];
        $sal_basic=$_REQUEST['sal_basic'];
        $sal_hra=$_REQUEST['sal_hra'];
        $sal_da=$_REQUEST['sal_da'];
        $sal_duct=$_REQUEST['sal_duct'];
        $sal_oths=$_REQUEST['sal_oths'];
        
		$residencetype_A=$_REQUEST['residencetype_A'];
		
	$schemecategory =$_REQUEST['schemecategory'];	
	$otherscheme=$_REQUEST['otherscheme'];
	$paymenttypereg=$_REQUEST['paymenttypereg'];
	$regfees=$_REQUEST['regfees'];
	$othersregfees=$_REQUEST['othersregfees'];
    $sourceremark="";
	// $agentType=$_REQUEST['Agent_Type'];
	$Dc_No=$_REQUEST['Dc_No'];	 	
	$execu_map=$_REQUEST['execu_map'];

	/////////////////////////
	$Gender_N=$_REQUEST['Gender_N'];
	$dob_N=$_REQUEST['dob_N'];
	$Emp_Code=$_REQUEST['Emp_Code'];	
	$Referal_By=$_REQUEST['Agent_Type'];	
	$Pan_No=$_REQUEST['Pan_No'];	
	$targetbusiness=$_REQUEST['targetbusiness'];	
	$designation=$_REQUEST['designation'];	
	$role=$_REQUEST['role'];	
	$esi=$_REQUEST['esi'];	
	$targetcollection=$_REQUEST['targetcollection'];	
	$bloodgroup=$_REQUEST['bloodgroup'];	
	$nominee=$_REQUEST['nominee'];	
	$nomineerel=$_REQUEST['nomineerel'];	
	$original=$_REQUEST['original'];	
	$document1=$_REQUEST['document1'];	
	$Doc_1=$_REQUEST['Doc_1'];	
	$qualification=$_REQUEST['qualification'];	
	$extraqualification=$_REQUEST['extraqualification'];	
	$pcmpydel=$_REQUEST['pcmpydel'];	
	$experience=$_REQUEST['experience'];	
	$reasonresign=$_REQUEST['reasonresign'];	
	$resigndate=$_REQUEST['resigndate'];	
	$verificationcall=$_REQUEST['verificationcall'];	
	$secdeposit=$_REQUEST['secdeposit'];	
	$accholdname=$_REQUEST['accholdname'];	
	$bankbranch=$_REQUEST['bankbranch'];	
	$ifsccode=$_REQUEST['ifsccode'];	
	$city_F=$_REQUEST['branchcity'];
	$city_P=$_REQUEST['city_P'];	   	
	$district_P=$_REQUEST['district_P'];	
	$district_F=$_REQUEST['branchdict'];	
	$state_P=$_REQUEST['state_P'];	
	 $state_F=$_REQUEST['branchstate'];	
	$pincode_P=$_REQUEST['pincode_P'];	
	$pincode_F=$_REQUEST['branchpin'];	
	$bankname=$_REQUEST['bankname'];	
	$sal = $_REQUEST['sal'];
	$accno=$_REQUEST['accno'];
	/////////////////////////////////	
	
    // if($agentType=="Customer")
	// {
		// $Introducername=$_REQUEST['introCustomer'];;
		// $Introducerid=$_REQUEST['introCustomerId'];
	// }
	// else if($agentType=="Employee")
	// {
    // $Introducername=$_REQUEST['Introducername'];	
	// $Introducerid=$_REQUEST['Introducerid'];
	// }
	
	$ret_year=$_REQUEST['ret_year'];	
	$PF_number=$_REQUEST['PF_number'];	
	$acctopendate=$_REQUEST['acctopendate'];	
    $acctdate=$_REQUEST['acctdate'];
    $collectionarea=$_REQUEST['collectionareas'];	
	$collectionareapin=$_REQUEST['collectionareaspin'];	
    $dateofcollection=$_REQUEST['dateofcollection'];
    $dayofcollection=$_REQUEST['dayofcollection'];
	$commitmentmonth=$_REQUEST['commitmentmonth'];
	$isschemecat=$_REQUEST['isscheme'];
	$isschemeopeningcat=$_REQUEST['isschemeopening'];
	if($isschemecat=='Yes')
	{
		$isschemecat=$isschemecat;
	}
	else{
		$isschemecat='No';
	}
	if($isschemeopeningcat=='Yes')
	{
		$isschemeopeningcat=$isschemeopeningcat;
	}
	else{
		$isschemeopeningcat='No';
	}
	
	$cashreceived=$_REQUEST['cashreceived'];
		if($_FILES["file_F"]["tmp_name"]!="")
		{
	   $fileName_F = $_FILES["file_F"]["name"]; 
       $fileTmpLoc_F = $_FILES["file_F"]["tmp_name"];
       $pathAndName_F = "./Proof/".$fileName_F;
		
		
	  $ext = pathinfo($fileName_F, PATHINFO_EXTENSION);
      $file_F = basename($fileName_F, ".".$ext);
      $uniqid= $fetchid->mid+1;
      $path_F ='./Proof/' . $application .'first.'.$ext;
	  move_uploaded_file($_FILES["file_F"]["tmp_name"], $path_F);
		}
		else{
			
			$path_F="";
		}
	  if($_FILES["file_S"]["tmp_name"]!="")
		{
	   $fileName_S = $_FILES["file_S"]["name"]; 
       $fileTmpLoc_S = $_FILES["file_S"]["tmp_name"];
       $pathAndName_S = "./Proof/".$fileName_S;		
	  $ext = pathinfo($fileName_S, PATHINFO_EXTENSION);
      $file_S = basename($fileName_S, ".".$ext);
      $uniqid= $fetchid->mid+1;
      $path_S ='./Proof/' . $application .'second.'.$ext;
	  move_uploaded_file($_FILES["file_S"]["tmp_name"], $path_S);
		
		}
		else{
			$path_S="";
		}
	//

    $alreadychk = mysqli_query($con,"select * from tbl_customer where First_Name_F='$initialfname' AND Mobile_F='$mobile_F' ");
	$fetchcnt = mysqli_num_rows($alreadychk);

	if($fetchcnt>0)
	{
		
	$final=2;
	}
	if($fetchcnt==0)
	{ 
		
	

	
	  $sno=mysqli_query($con,"SELECT MAX(Id) as Id FROM tbl_customer");
		$s_no_select=mysqli_fetch_array($sno);
		
		$curmonth=date("m");
		$curyear=date("y");
		$c_year=date("Y");
		$fetchlastnum=$s_no_select['Id']+1; 
		$max_custid=$s_no_select['Id']; 

			if(!empty($max_custid))
	{
		$curnt_cusid = $max_custid+1;

	
	
	if(strlen($fetchlastnum)=='1')
		{
		$newid="000".$fetchlastnum;	
		}
		elseif(strlen($fetchlastnum)=='2')
		{
		$newid="00".$fetchlastnum;	
		}
		elseif(strlen($fetchlastnum)=='3')
		{
		$newid="0".$fetchlastnum;	
		}
		else
		{
		$newid=$fetchlastnum;	
		}


		$curnt_cusid="DNC".$curyear.$newid; 
		}
	else
	{
		$curnt_cusid = 'DNC'.$curyear."001"; 
	}	
		
	
	if($fs_name	== 'FatherName')
		{
	 if(is_array($_FILES)) {
		
		if(is_uploaded_file($_FILES['files']['tmp_name'])) {
			$sourcePath = $_FILES['files']['tmp_name'];
			$targetPath = "cusimg/images/".$_FILES['files']['name'];
			if(move_uploaded_file($sourcePath,$targetPath)) {

		
			 $query_insert="INSERT INTO `tbl_employee`(`prefix_F`,`Name`, `Branch`, `Employee_type`, `Agent_Type`, `Emp_Code`, `Address`, `Mobile`, 
			 `Mobile_AF`,`Email_Id`,`Pan_No`,`ration_F`,`aadhar_F`, `Joining_Date`, `Designation`, `Role`, `PF`, `ESI`, `Target_New_Business`,
			 `Target_Collection`, `Blood_Group`, `Nominee_Del`, `Nominee_Relationship`, `Original_Submited`, `Original_Filename`, `Original_Path`, 
			 `Qualification`, `Extra_Qualification`, `Previous_Cmpy_Del`, `Experience`, `Resignation_Date`, `Reason_For_Resignation`, `Verification_Call_By`, 
			 `Security_Deposit`, `User_Id`, `Remark`, `Holder_Name`, `Account_No`, `Bank_Name`, `Branch_Name`, `IFSC_Code`, `Created_On`, 
			 `Created_By`, `Accesscard_Id`, `Status`, `DOB`, `Photo_E`, `Gender`, `P_City`, `P_District`, `P_State`, `P_Pincode`, `C_City`, 
			 `C_District`, `C_State`, `C_Pincode`, `N_Gender`, `N_DOB`, `E_basic`, `E_hra`, `E_da`, `E_deduct`, `E_other`,`P_Address`,`Father_Spouse`,`Father_Spouse_Name`,`Gross_Annual_Income`) 
			 VALUES ('$prefix_F','$initialfname','$branchname','Employee','','$Emp_Code','$companyname_F','$mobile_F','$mobile_AF','$email_F',
			 '$Pan_No','$ration_F','$aadhar_F','$acctdate','$designation','$role','$PF_number','$esi','$targetbusiness','$targetcollection',
			 '$bloodgroup','$nominee','$nomineerel','$original','$document1','$Doc_1','$qualification','$extraqualification','$pcmpydel','$experience',
			 '$resigndate','$reasonresign','$verificationcall','$secdeposit','','','$accholdname','$accno','$bankname','$bankbranch','$ifsccode','$createdon',
			 '$createdby','','Active','$dob_F','$targetPath','$Gender_F','$city_F','$district_F','$state_F','$pincode_F','$city_P','$district_P','$state_P',
			 '$pincode_P','$Gender_N','$dob_N','$sal_basic','$sal_hra','$sal_da','$sal_duct','$sal_oths','$companyname_P','$fs_name','$father_F','$grossannualincome_A')"; 
			 
			 
			
			}
		}
		else{
			
			
		$query_insert="INSERT INTO `tbl_employee`(`prefix_F`,`Name`, `Branch`, `Employee_type`, `Agent_Type`, `Emp_Code`, `Address`, `Mobile`, 
			 `Mobile_AF`,`Email_Id`, `Pan_No`,`ration_F`,`aadhar_F`, `Joining_Date`, `Designation`, `Role`, `PF`, `ESI`, `Target_New_Business`,
			 `Target_Collection`, `Blood_Group`, `Nominee_Del`, `Nominee_Relationship`, `Original_Submited`, `Original_Filename`, `Original_Path`, 
			 `Qualification`, `Extra_Qualification`, `Previous_Cmpy_Del`, `Experience`, `Resignation_Date`, `Reason_For_Resignation`, `Verification_Call_By`, 
			 `Security_Deposit`, `User_Id`, `Remark`, `Holder_Name`, `Account_No`, `Bank_Name`, `Branch_Name`, `IFSC_Code`, `Created_On`, 
			 `Created_By`, `Accesscard_Id`, `Status`, `DOB`, `Photo_E`, `Gender`, `P_City`, `P_District`, `P_State`, `P_Pincode`, `C_City`, 
			 `C_District`, `C_State`, `C_Pincode`, `N_Gender`, `N_DOB`, `E_basic`, `E_hra`, `E_da`, `E_deduct`, `E_other`,`P_Address`,`Father_Spouse`,`Father_Spouse_Name`,`Gross_Annual_Income`) 
			 VALUES ('$prefix_F','$initialfname','$branchname','Employee','','$Emp_Code','$companyname_F','$mobile_F','$mobile_AF','$email_F',
			 '$Pan_No','$ration_F','$aadhar_F','$acctdate','$designation','$role','$PF_number','$esi','$targetbusiness','$targetcollection',
			 '$bloodgroup','$nominee','$nomineerel','$original','$document1','$Doc_1','$qualification','$extraqualification','$pcmpydel','$experience',
			 '$resigndate','$reasonresign','$verificationcall','$secdeposit','','','$accholdname','$accno','$bankname','$bankbranch','$ifsccode','$createdon',
			 '$createdby','','Active','$dob_F','','$Gender_F','$city_F','$district_F','$state_F','$pincode_F','$city_P','$district_P','$state_P',
			 '$pincode_P','$Gender_N','$dob_N','$sal_basic','$sal_hra','$sal_da','$sal_duct','$sal_oths','$companyname_P','$fs_name','$father_F','$grossannualincome_A')"; 
					}

}
		}
		else
		{
			if(is_array($_FILES)) {
		
		if(is_uploaded_file($_FILES['files']['tmp_name'])) {
			$sourcePath = $_FILES['files']['tmp_name'];
			$targetPath = "cusimg/images/".$_FILES['files']['name'];
			if(move_uploaded_file($sourcePath,$targetPath)) {

		
			 $query_insert="INSERT INTO `tbl_employee`(`prefix_F`,`Name`, `Branch`, `Employee_type`, `Agent_Type`, `Emp_Code`, `Address`, `Mobile`, 
			 `Mobile_AF`,`Email_Id`,`Pan_No`,`ration_F`,`aadhar_F`, `Joining_Date`, `Designation`, `Role`, `PF`, `ESI`, `Target_New_Business`,
			 `Target_Collection`, `Blood_Group`, `Nominee_Del`, `Nominee_Relationship`, `Original_Submited`, `Original_Filename`, `Original_Path`, 
			 `Qualification`, `Extra_Qualification`, `Previous_Cmpy_Del`, `Experience`, `Resignation_Date`, `Reason_For_Resignation`, `Verification_Call_By`, 
			 `Security_Deposit`, `User_Id`, `Remark`, `Holder_Name`, `Account_No`, `Bank_Name`, `Branch_Name`, `IFSC_Code`, `Created_On`, 
			 `Created_By`, `Accesscard_Id`, `Status`, `DOB`, `Photo_E`, `Gender`, `P_City`, `P_District`, `P_State`, `P_Pincode`, `C_City`, 
			 `C_District`, `C_State`, `C_Pincode`, `N_Gender`, `N_DOB`, `E_basic`, `E_hra`, `E_da`, `E_deduct`, `E_other`,`P_Address`,`Father_Spouse`,`Father_Spouse_Name`,`Gross_Annual_Income`) 
			 VALUES ('$prefix_F','$initialfname','$branchname','Employee','','$Emp_Code','$companyname_F','$mobile_F','$mobile_AF','$email_F',
			 '$Pan_No','$ration_F','$aadhar_F','$acctdate','$designation','$role','$PF_number','$esi','$targetbusiness','$targetcollection',
			 '$bloodgroup','$nominee','$nomineerel','$original','$document1','$Doc_1','$qualification','$extraqualification','$pcmpydel','$experience',
			 '$resigndate','$reasonresign','$verificationcall','$secdeposit','','','$accholdname','$accno','$bankname','$bankbranch','$ifsccode','$createdon',
			 '$createdby','','Active','$dob_F','$targetPath','$Gender_F','$city_F','$district_F','$state_F','$pincode_F','$city_P','$district_P','$state_P',
			 '$pincode_P','$Gender_N','$dob_N','$sal_basic','$sal_hra','$sal_da','$sal_duct','$sal_oths','$companyname_P','$fs_name','$wife_F','$grossannualincome_A')"; 
			 
			 
			
			}
		}
		else{
			
			
		$query_insert="INSERT INTO `tbl_employee`(`prefix_F`,`Name`, `Branch`, `Employee_type`, `Agent_Type`, `Emp_Code`, `Address`, `Mobile`, 
			 `Mobile_AF`,`Email_Id`, `Pan_No`,`ration_F`,`aadhar_F`, `Joining_Date`, `Designation`, `Role`, `PF`, `ESI`, `Target_New_Business`,
			 `Target_Collection`, `Blood_Group`, `Nominee_Del`, `Nominee_Relationship`, `Original_Submited`, `Original_Filename`, `Original_Path`, 
			 `Qualification`, `Extra_Qualification`, `Previous_Cmpy_Del`, `Experience`, `Resignation_Date`, `Reason_For_Resignation`, `Verification_Call_By`, 
			 `Security_Deposit`, `User_Id`, `Remark`, `Holder_Name`, `Account_No`, `Bank_Name`, `Branch_Name`, `IFSC_Code`, `Created_On`, 
			 `Created_By`, `Accesscard_Id`, `Status`, `DOB`, `Photo_E`, `Gender`, `P_City`, `P_District`, `P_State`, `P_Pincode`, `C_City`, 
			 `C_District`, `C_State`, `C_Pincode`, `N_Gender`, `N_DOB`, `E_basic`, `E_hra`, `E_da`, `E_deduct`, `E_other`,`P_Address`,`Father_Spouse`,`Father_Spouse_Name`,`Gross_Annual_Income`) 
			 VALUES ('$prefix_F','$initialfname','$branchname','Employee','','$Emp_Code','$companyname_F','$mobile_F','$mobile_AF','$email_F',
			 '$Pan_No','$ration_F','$aadhar_F','$acctdate','$designation','$role','$PF_number','$esi','$targetbusiness','$targetcollection',
			 '$bloodgroup','$nominee','$nomineerel','$original','$document1','$Doc_1','$qualification','$extraqualification','$pcmpydel','$experience',
			 '$resigndate','$reasonresign','$verificationcall','$secdeposit','','','$accholdname','$accno','$bankname','$bankbranch','$ifsccode','$createdon',
			 '$createdby','','Active','$dob_F','','$Gender_F','$city_F','$district_F','$state_F','$pincode_F','$city_P','$district_P','$state_P',
			 '$pincode_P','$Gender_N','$dob_N','$sal_basic','$sal_hra','$sal_da','$sal_duct','$sal_oths','$companyname_P','$fs_name','$wife_F','$grossannualincome_A')"; 
					}

}
		
	}

	$query_exe=mysqli_query($con,$query_insert);
	
if($query_exe){	
	 echo '<script type="text/javascript">
					window.location.replace("viewemployee.php?step=suces");
					</script>';    
}
else{
		  echo '<script type="text/javascript">
					window.location.replace("viewemployee.php?step=dbfail");
					</script>';	 
	}
	}
	else
	{
		  echo '<script type="text/javascript">
					window.location.replace("viewemployee.php?step=fail");
					</script>';	
	}
	
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chit | Employee</title>
	<meta name="author" content="Gayathri.R.KKIT">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">  
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		
	<!--<link rel="stylesheet" href="plugins/datepicker/css/datepicker.css">----->
	<!--<link rel="stylesheet" href="plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">--->

	  
	<script src="js/jquery-1.10.2.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->
	<link rel="stylesheet" href="dist/css/bootstrap-select.css">
	<script src="dist/js/bootstrap-select.js"></script>
	<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
<script>
function admSelectCheck12(nameSelect)
    {
    console.log(nameSelect);
    if(nameSelect){
        admOptionValue1 = document.getElementById("otherprefxs").value;
        if(admOptionValue1 == nameSelect.value){
            document.getElementById("otherprefixs").style.display = "block";
        }
        else{
            document.getElementById("otherprefixs").style.display = "none";
        }
    }
    else{
        document.getElementById("otherprefixs").style.display = "none";
    }
}			 
function agecalcualte(val)
{
//alert(val);
var dob = val; 
    var str=dob.split('-');    
    var firstdate=new Date(str[0],str[1],str[2]);
    var today = new Date();        
    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
    var age = parseInt(dayDiff); 
	$("#age_F").val(age);
}
function getdistrict(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'state_id='+val,
	success: function(data){
		$("#district-list").html(data);
        $('#groupNameTemp').selectpicker({});
	}
	});
}

function getcity(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'district_id='+val,
	success: function(data){
		$("#city-list").html(data);
        $('#branchcity').selectpicker({});
	}
	});
}

function getpin(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "get_district.php",
	data:'pin_id='+val,
	success: function(data){
		$("#pin-list").html(data);
        $('#branchcity').selectpicker({});
	}
	});
}

</script>
<style>	
ul.dropdown-menu.inner {
    max-height: 250px !important;
}
.content-wrapper
{
	padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: inherit !important;
	 min-height : 320px;
	 padding: 34px 10px !important;
	     font-size: 15px !important;
	  
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
</style>	
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
				 <?php 
	$sno=mysqli_query($con,"SELECT MAX(Id) as Id FROM tbl_employee");
		$s_no_select=mysqli_fetch_array($sno);		
		$curyear=date("y");
		$fetchlastnum=$s_no_select['Id']+1; 
		$max_custid=$s_no_select['Id']; 

	if(!empty($max_custid))
	{
		$curnt_zonid = $max_custid+1;

	
	
	if(strlen($fetchlastnum)=='1')
		{
		$newid="0".$fetchlastnum;	
		}
	else
		{
		$newid=$fetchlastnum;	
		}


		$curnt_zonid="Emp".$curyear.$newid; 
		}
	else
	{
		$curnt_zonid = 'Emp'.$curyear."01"; 
	}	
	?>
    <div class="wrapper">

     <?php include 'header.php'; ?>
     <?php include 'sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">  
		<section class="content"> 
			<div class="nav-tabs-custom"> 
				<div class="box-body">
		
<div class="row panel panel-primary">
	<div class="panel-heading lead ">
		<div class="row">
			<div class="col-lg-8 col-md-8">Add Machine Status</div>				
				<div class="col-lg-4 col-md-4 text-right">
					<div class="btn-group text-center">
						<a href="viewemployee.php" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View Machine Status</a>
					</div>
				</div>
		</div>
	</div>
			<div class="panel-body">
                <form class="form-horizontal" name="addcustomer_details"  id="addauctionform" method="post" enctype="multipart/form-data" >
		            <div class="tab-content">
					  <div class="active tab-pane" id="timeline">
					 
					 
					  
					   
                      				   
							
						
					   
			
					  			
					  
					 
					  
                
		
                      <div class="col-sm-12 form-group">
                        
                         
						 <label for="inputEmail" class="col-sm-2 control-label">Machine Name</label>
                        <div class="col-sm-4">
                         <select id="role"  name="role"  class="form-control  selectpicker" data-live-search="true">			
						<option value="">Select Machine Name</option>
						 <?php 
						   $selectzone=mysqli_query($con,"SELECT * FROM `tbl_product` WHERE Status='Active'");
						   while($viewuser=mysqli_fetch_array($selectzone))
						   {
							   $zid=$viewuser['Id'];
							   $zname=$viewuser['Name'];
							  
							  
						?>
						<option value="<?php echo $zid;?>"><?php echo $zname;?></option>
						<?php }
						   ?>						            						
						</select>
                        </div>
						<label for="inputEmail" class="col-sm-2 control-label">Machine Code</label>
                        <div class="col-sm-4">
                         <input type="text" name="accholdname" class="form-control" id="inputName" placeholder="Machine Code" disabled>
                        </div>
                        </div>	
						
						
					
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">PDN Points</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="PDN Points" name="PF_number" id="PF_number" disabled>
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Target Date</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Target Date" name="PF_number" id="PF_number" disabled>
                        </div> 
                        </div>
						
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Accessories</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Accessories" name="PF_number" id="PF_number" disabled>
                        </div> 
						
                        </div>
						
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Completed Status</label>
                        <div class="col-sm-4">
                          <select id="role"  name="role"  class="form-control  selectpicker" data-live-search="true">			
						<option value="">Select Completed</option>
						 
						<option value="">Not Yet Start</option>
						<option value="">On Going</option>
						<option value="">Completed</option>
											            						
						</select>
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Completed Date</label>
                        
                         <div class="col-sm-4">
                          <input class="form-control dp1"   placeholder="dd-mm-yyyy"  onchange="agecalcualte(this.value)" id="dob_F" name="dob_F" required>
						
                        </div>

                      
<script>
	$(document).ready(function () {
    $('#dob_F').datepicker({
	
        format: "yyyy-mm-dd",
		endDate: '+0d',
        autoclose: true
	 });
    $('.dp1').on('change', function () {
        $('.datepicker').hide();
    });

	});
</script>
						
                        </div>

                        </div>

						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Remark</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Remark" name="PF_number" id="PF_number">
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Reason for Delay</label>
                        <div class="col-sm-4">
                         <input type="text" class="form-control "   placeholder="Alloted" name="PF_number" id="PF_number">
						
                        </div>

                        </div>

						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">WTP</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="WTP" name="PF_number" id="PF_number">
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Yet to Start</label>
                        <div class="col-sm-4">
                         <input type="text" class="form-control "   placeholder="Yet to Start" name="PF_number" id="PF_number">
						
                        </div>

                        </div>

						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Return</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Return" name="PF_number" id="PF_number">
                        </div> 
						
						<label for="inputName" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                         <input type="text" class="form-control "   placeholder="Status" name="PF_number" id="PF_number">
						
                        </div>

                        </div>
					
						<div class="col-sm-12 form-group">
							
							 <label for="inputName" class="col-sm-2 control-label">Remark</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control "   placeholder="Remark" name="PF_number" id="PF_number">
                        </div> 
						
						
                        </div>
						
					
		 		     <div class="form-group">   
                       <div class="col-sm-offset-5 col-sm-10">
                          <br><br>
						  <input type="submit" name="submit" id="submit" class="btn btn-primary"></button>
						  <button type="reset" name="reset" id="reset" class="btn btn-warning">Reset</button>
                        </div>
					  </div>
				
<script> 
$(document).ready(function () {
	 $('#sal_basic').keyup(function () {
		var basc = $('#sal_basic').val();
		var hra = $('#sal_hra').val();
		var da = $('#sal_da').val();
		var duct = $('#sal_duct').val();
		var oths = $('#sal_oths').val();

		
		var len_basc= $('#sal_basic').val().length;
		var len_hra = $('#sal_hra').val().length;
		var len_da = $('#sal_da').val().length;
		var len_duct = $('#sal_duct').val().length;
		var len_oths = $('#sal_oths').val().length;
		
				if (len_basc == 0 ){	
					var val_basc = '0'; 
				}
				else{
					var val_basc = basc; 
				}
				if (len_hra == 0 ){
					var val_hra = '0'; 
				}
				else{
					var val_hra = hra; 
				}
				if (len_da == 0 ){
					var val_da = '0'; 
				}
				else{
					var val_da = da; 
				}
				if (len_duct == 0 ){
					var val_duct = '0'; 
				}
				else{
					var val_duct = duct; 
				}
				if (len_oths == 0 ){
					var val_oths = '0'; 
				}
				else{
					var val_oths = oths; 
				}
		var netsal = parseFloat(val_basc)+parseFloat(val_hra)+parseFloat(val_da)-parseFloat(val_duct)+parseFloat(val_oths) ; 
		$("#grossannualincome_A").val(netsal);
	});
  $('#sal_hra').keyup(function () {
		var basc = $('#sal_basic').val();
		var hra = $('#sal_hra').val();
		var da = $('#sal_da').val();
		var duct = $('#sal_duct').val();
		var oths = $('#sal_oths').val();

		
		var len_basc= $('#sal_basic').val().length;
		var len_hra = $('#sal_hra').val().length;
		var len_da = $('#sal_da').val().length;
		var len_duct = $('#sal_duct').val().length;
		var len_oths = $('#sal_oths').val().length;
		
				if (len_basc == 0 ){	
					var val_basc = '0'; 
				}
				else{
					var val_basc = basc; 
				}
				if (len_hra == 0 ){
					var val_hra = '0'; 
				}
				else{
					var val_hra = hra; 
				}
				if (len_da == 0 ){
					var val_da = '0'; 
				}
				else{
					var val_da = da; 
				}
				if (len_duct == 0 ){
					var val_duct = '0'; 
				}
				else{
					var val_duct = duct; 
				}
				if (len_oths == 0 ){
					var val_oths = '0'; 
				}
				else{
					var val_oths = oths; 
				}
		var netsal = parseFloat(val_basc)+parseFloat(val_hra)+parseFloat(val_da)-parseFloat(val_duct)+parseFloat(val_oths) ; 
		$("#grossannualincome_A").val(netsal);
	});
  $('#sal_da').keyup(function () {
		var basc = $('#sal_basic').val();
		var hra = $('#sal_hra').val();
		var da = $('#sal_da').val();
		var duct = $('#sal_duct').val();
		var oths = $('#sal_oths').val();

		
		var len_basc= $('#sal_basic').val().length;
		var len_hra = $('#sal_hra').val().length;
		var len_da = $('#sal_da').val().length;
		var len_duct = $('#sal_duct').val().length;
		var len_oths = $('#sal_oths').val().length;
		
				if (len_basc == 0 ){	
					var val_basc = '0'; 
				}
				else{
					var val_basc = basc; 
				}
				if (len_hra == 0 ){
					var val_hra = '0'; 
				}
				else{
					var val_hra = hra; 
				}
				if (len_da == 0 ){
					var val_da = '0'; 
				}
				else{
					var val_da = da; 
				}
				if (len_duct == 0 ){
					var val_duct = '0'; 
				}
				else{
					var val_duct = duct; 
				}
				if (len_oths == 0 ){
					var val_oths = '0'; 
				}
				else{
					var val_oths = oths; 
				}
		var netsal = parseFloat(val_basc)+parseFloat(val_hra)+parseFloat(val_da)-parseFloat(val_duct)+parseFloat(val_oths) ; 
		$("#grossannualincome_A").val(netsal);
	});
  $('#sal_duct').keyup(function () {
		var basc = $('#sal_basic').val();
		var hra = $('#sal_hra').val();
		var da = $('#sal_da').val();
		var duct = $('#sal_duct').val();
		var oths = $('#sal_oths').val();

		
		var len_basc= $('#sal_basic').val().length;
		var len_hra = $('#sal_hra').val().length;
		var len_da = $('#sal_da').val().length;
		var len_duct = $('#sal_duct').val().length;
		var len_oths = $('#sal_oths').val().length;
		
				if (len_basc == 0 ){	
					var val_basc = '0'; 
				}
				else{
					var val_basc = basc; 
				}
				if (len_hra == 0 ){
					var val_hra = '0'; 
				}
				else{
					var val_hra = hra; 
				}
				if (len_da == 0 ){
					var val_da = '0'; 
				}
				else{
					var val_da = da; 
				}
				if (len_duct == 0 ){
					var val_duct = '0'; 
				}
				else{
					var val_duct = duct; 
				}
				if (len_oths == 0 ){
					var val_oths = '0'; 
				}
				else{
					var val_oths = oths; 
				}
		var netsal = parseFloat(val_basc)+parseFloat(val_hra)+parseFloat(val_da)-parseFloat(val_duct)+parseFloat(val_oths) ; 
		$("#grossannualincome_A").val(netsal);
	});
  $('#sal_oths').keyup(function () {
		var basc = $('#sal_basic').val();
		var hra = $('#sal_hra').val();
		var da = $('#sal_da').val();
		var duct = $('#sal_duct').val();
		var oths = $('#sal_oths').val();

		
		var len_basc= $('#sal_basic').val().length;
		var len_hra = $('#sal_hra').val().length;
		var len_da = $('#sal_da').val().length;
		var len_duct = $('#sal_duct').val().length;
		var len_oths = $('#sal_oths').val().length;
		
				if (len_basc == 0 ){	
					var val_basc = '0'; 
				}
				else{
					var val_basc = basc; 
				}
				if (len_hra == 0 ){
					var val_hra = '0'; 
				}
				else{
					var val_hra = hra; 
				}
				if (len_da == 0 ){
					var val_da = '0'; 
				}
				else{
					var val_da = da; 
				}
				if (len_duct == 0 ){
					var val_duct = '0'; 
				}
				else{
					var val_duct = duct; 
				}
				if (len_oths == 0 ){
					var val_oths = '0'; 
				}
				else{
					var val_oths = oths; 
				}
		var netsal = parseFloat(val_basc)+parseFloat(val_hra)+parseFloat(val_da)-parseFloat(val_duct)+parseFloat(val_oths) ; 
		$("#grossannualincome_A").val(netsal);
	});
  
});
</script>


<script>
	
	function FillBilling(f) {
  if(f.billingtoo.checked == true) {
	  f.companyname_P.value = f.companyname_F.value;
     
	f.city_P.value = f.branchcity.value;
	f.district_P.value = f.branchdict.value;
	f.state_P.value=f.branchstate.value;
	 
	f.pincode_P.value=f.branchpin.value;
  }
  else{
	  
	 f.companyname_P.value =  "";	  
	 f.city_P.value ="";
	 f.district_P.value ="";
	 f.state_P.value="";	 
	 f.pincode_P.value="";
  }
}
	 
	function getCustomer(val) {
		
		
   var branchname = $('#branchname').val();
   var prefix_F = $('#prefix_F').val();
   var otherprefix_F = $('#othersprefixvalue').val();
   var custname = $('#custname').val();
   var middlename_F = $('#middlename_F').val();
   
   var mobile_F = $('#mobile_F').val(); 
   
   var Gender_F = $('#Gender_F').val();
   
   var Occupation_A = $('#Occupation_A').val();
   var acctopendate = $('#acctopendate').val();
   
   var nationality_F = $('#nationality_F').val();
   var father_F = $('#father_F').val();
   var mother_F = $('#mother_F').val();
   var dob_F = $('#dob_F').val();
  
    var Age_F = $('#Age_F').val();
   var mothermaiden_F = $('#mothermaiden_F').val();
   var scitizen_F = $('#scitizen_F').val();
   var companyname_F = $('#companyname_F').val();
   var roadno_F = $('#roadno_F').val();
   var landmark_F = $('#landmark_F').val();
   var city_F = $('#city_F').val();
   var State_F = $('#State_F').val();
   var country_F = $('#country_F').val();
   var pincode_F = $('#pincode_F').val();
   var mobile_F = $('#mobile_F').val();
   var companyname_P = $('#companyname_P').val();
   var roadno_P = $('#roadno_P').val();
   
   var landmark_P = $('#landmark_P').val();
   var city_P = $('#city_P').val();
   var State_P = $('#State_P').val();
   var country_P = $('#country_P').val();
   var pincode_P = $('#pincode_P').val(); 
   var emailf = $('#email_F').val();
   var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
   
   
   
   
 
 
   if(branchname == ""){
	alert("Branch name is required");
    return false;            
  
 }
 
 else if(prefix_F == ""){
	alert(" Prefix is required");
    return false;            
  
 }else if(prefix_F == "Others" && otherprefix_F == ""){
	 
	alert("Others (Prefix is required)");
    return false;            
	 
 }else if(custname == ""){
	alert("Name is required");
    return false;            
  
 }
 else if(middlename_F == ""){
	alert("Initial is required");
    return false;            
  
 }

 else if(mobile_F == ""){
	alert("Mobile No is required");
    return false;           
  
 }
  else if (!filter.test(emailf)) {
    alert('Enter a valid email address');
    return false;
	
	}
 else if(Gender_F == ""){
	alert("Gender is required");
    return false;           
  
 }
else if($('input[name=fsname]:checked').length<=0)
{
 alert("Father or spouse Name is required")
}
 else if(companyname_F == ""){
	alert("Company name/Flat no./Bldg name is required");
    return false;            
  
 }else if(roadno_F == ""){
	alert("Road No./Name is required");
    return false;            
  
 }else if(landmark_F == ""){
	alert("Landmark is required");
    return false;            
  
 }else if(city_F == ""){
	alert("City is required");
    return false;            
  
 }else if(State_F == ""){
	alert("State is required");
    return false;            
  
 }else if(country_F == ""){
	alert("Country is required");
    return false;            
  
 }
 	else {   
					
				 $('#li1').removeClass("active");
                 $('#li2').addClass("active");	
                 $('#li2').show();				 
			     $('#activity').addClass("active");
				 $('#timeline').removeClass("active");
				 return true;
				} 
				 
		}
	</script> 
			</form>	
                
			</div>
        </div>		
		</div>
		
		</div>
		
         </div>
       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
	  <!-- start footer ----->

 <?php include 'footer.php'; ?>

<!--footer End ------------>

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
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="dist/js/demo.js"></script>
	<script src="cusimg/dist/js/bootstrap-imageupload.js"></script>
	<script>
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
        </script>

  </body>
</html>
<?php mysqli_close($con); ?>
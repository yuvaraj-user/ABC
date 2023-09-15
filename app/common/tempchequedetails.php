<?php
date_default_timezone_set("Asia/Kolkata");
$dateofjoining = $Date_Introducer;

$sqlchit = mysqli_query($con,"select * from tbl_chit_structure where Scheme_Format='$Scheme_Format'");
$chit_fetch = mysqli_fetch_array($sqlchit);

$totalamount=$paidamount;
$name1 = $name."-".$userid."-".$appno;
$date = date("d-m-Y");
$datime=date("d-m-Y H:i:s A");
$amount	=$paidamount;
$doj = $Date_Introducer;	
$sendsms = "Yes";
//echo $paymentdel;
//echo $empid;

	$cusname = $name;
	$Customerid = $userid;
	$appid = $appno;
	$tempno = date('dmYHis');
	$select1=mysqli_query($con,"SELECT c.Id,c.Mobile_F,d.Payment_Type FROM `tbl_customer` c left join `tbl_chit_details` d on c.Id=d.Cust_Id where c.Application_No='$appid'");
	$fetch1=mysqli_fetch_array($select1);
	$cid=$fetch1['Id'];	
	$mobile=$fetch1['Mobile_F'];
	$Payment_type=$fetch1['Payment_Type'];
	//echo "select Branch from tbl_employee where Id='$empid' and Status='Active'";
	$empoyeebranch=mysqli_query($con,"select Branch from tbl_employee where Id='$empid' and Status='Active'");
	$fetchemployee=mysqli_fetch_array($empoyeebranch);
	$emp_branch=$fetchemployee['Branch'];
	
	if($paymentdel=='Cheque')
	{
	
	/*<!--<script>window.location.href='Salesreceiptcheque.php?name=<?php echo $cname; ?>&billname=<?php echo $billno; ?>&date=<?php echo $date; ?>&amount1=<?php echo $amount; ?>&chequeno=<?php echo $chequeno; ?>&bankname=<?php echo $bankname; ?>&bankbranch=<?php echo $bankbranch; ?>&accountname=<?php echo $accountname; ?>&checkdate=<?php echo $chdate; ?>&sessionuser=<?php echo  $createdby; ?>&ctabid=<?php echo  $ctabid; ?>&empid=<?php echo  $employeetableid; ?>&mobile=<?php echo $mobile_F; ?>&chitvalue=<?php echo $chitvalue; ?>&doj=<?php echo $doj; ?>&sendsms=<?php echo $sendsms; ?>&chequephoto=<?php echo $chequephoto; ?>&chequeprocess=<?php echo 'Unclear'; ?>';</script>--->*/
	
	  $sql = "INSERT INTO `tbl_customer_cheque`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`,`Photo`,`Cheque_Process`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$chequeno','$chequedate','$bankname','$branchname','$path_2','Unclear')";
				$result23 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
		if($result23)
	      {
			  $mobile=$mobile_F;
			  $cid=$cid;
		$sms = "Dear $cusname, We have received the Cheque for Rs:".$amount.". Further Cheque clearing process will be intimated." ;
				$msgtype = "Receipt";
				smscall($mobile,$sms,$msgtype,$cid);	  
			  
	      }
		  
	}
?>

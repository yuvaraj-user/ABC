<?php
include 'tallyurl.php';
date_default_timezone_set("Asia/Kolkata");
$dateofjoining = $Date_Introducer;

$sqlchit = mysqli_query($con,"select * from tbl_auction_structure where Scheme_Format='$Scheme_Format'");
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
	
	$select1=mysqli_query($con,"SELECT c.Id,c.Mobile_F,d.Payment_Type,d.Scheme_Under_Category,ab.Monthly_Amt,ab.Chit_value,ab.Month,ab.Member,ab.Id as schemeId FROM `tbl_customer` c left join `tbl_chit_details` d on c.Id=d.Cust_Id left join tbl_auction_structure ab on d.Scheme_Under_Category=ab.Scheme_Format where c.Application_No='$appid'");
	$fetch1=mysqli_fetch_array($select1);
	 $cid	=	$fetch1['Id'];	
	 $mobile	=	$fetch1['Mobile_F'];
	 $Payment_type	=	$fetch1['Payment_Type'];
	 $monthDue	=	$fetch1['Monthly_Amt'];
	 $scheme	=	$fetch1['Scheme_Under_Category'];
	 $Chit_value	=	$fetch1['Chit_value'];
	 $m	=	$fetch1['Month'];
	 $scheme_noofperson  =  $fetch1['Member'];
	 $scheme_Id=$fetch1['schemeId'];
	
	//echo "select Branch from tbl_employee where Id='$empid' and Status='Active'";	
	$empoyeebranch=mysqli_query($con,"select Branch from tbl_employee where Id='$empid' and Status='Active'");
	$fetchemployee=mysqli_fetch_array($empoyeebranch);
	$emp_branch=$fetchemployee['Branch'];
	
	function sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel,$monthDue,$Chit_value,$m,$scheme_noofperson,$scheme_Id,$accountname)
	{
		
		require_once 'tallyurl.php';
		include('srdb.php');
		require_once 'smsdetails.php';
		
		$M_First_Sec_Amt = $monthDue;
	    $M_Second_Sec_Amt = $monthDue;
						$date = new DateTime($doj);
						$dateofjoining = $date->format('d-m-Y');
						$Month = $m;
						
							//$curdate = date('m/d/Y');
							$to2=date('m/d/Y');
							$curdate =$to2;
							$arr = explode('-', $dateofjoining);
							$dojDate = $arr[1].'/'.$arr[0].'/'.$arr[2];
							$date1 = new DateTime($curdate);
							$date2 = new DateTime($dojDate);
							$interval = $date1->diff($date2);
							$years=$interval->y;
							$months =$interval->m;
							$days=$interval->d;
					//$days = $days+1;
							if($years>0)
							{
								$tempmont = $years*12;
								$months = $months+$tempmont;
							}
									
							$noofbills= 0;
							if($months>0)
							{
								$noofbills = $months;
							}
							if($days>0){
								$noofbills = $noofbills+1;
							}

							if($curdate==$dojDate && $noofbills==0){
								$noofbills=1;
							}
							
							$totaltopaid = 0;
							
							if($noofbills<2){ 
							
								$totaltopaid = $totaltopaid + ($noofbills*$M_First_Sec_Amt);			
								$tpaid=$totaltopaid;
							}else{
								$totaltopaid = $totaltopaid + (2*$M_First_Sec_Amt);			
								if($noofbills>$Month)
								{
									$noofbills =$Month;
								}
								$tempnoofbills = $noofbills-2;
								if($tempnoofbills >0)
								{
									$totaltopaid = $totaltopaid + ($tempnoofbills*$M_Second_Sec_Amt);			
								}
								$tpaid=$totaltopaid;
							}
							
		$sql2 = "SELECT SUM( REPLACE( Total_Amount,  ',',  '' ) ) AS repval FROM `tbl_receipt_transaction` WHERE Cust_Id = '$cid' ";
				$result2 = mysqli_query($con, $sql2) or die("Error in Selecting 1 " . mysqli_error($con));
				$result2fetch =mysqli_fetch_array($result2);
				$totalpaid =$result2fetch['repval'];
				//echo $tpaid;
				//echo ("dsfsdf");
				$CLOSINGBALANCE = $tpaid-$totalpaid;
		
		
		if($paymentdel == "Cheque")
				{
				if($CLOSINGBALANCE!=0&&strncmp($CLOSINGBALANCE, $check , strlen($check )))
				{
				$smsrec = "$companynamedel Dear $cusname, We received the Cheque for Rs:$amount for chit $appid".$chitvalue.". You need to clear total due of Rs:".$CLOSINGBALANCE." with in ".$to1.". As on date paid Rs:".$totalpaid.".";

				}else
				{
				$smsrec = "$companynamedel Dear $cusname, We received the Cheque for Rs:$amount for chit $appid".$chitvalue.". As on date paid Rs:".$totalpaid.". ";
				}
				
				} else	{		
		
				if($CLOSINGBALANCE!=0&&strncmp($CLOSINGBALANCE, $check , strlen($check )))
				{
				$smsrec = "$companynamedel Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". You need to clear total due of Rs:".$CLOSINGBALANCE." with in ".$to1.". As on date paid Rs:".$totalpaid;

				}else
				{
				$smsrec = "$companynamedel Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". As on date paid Rs:".$totalpaid;

				}
				
				}
	
				$msgtype = "Receipt";
				if($paymentdel == "Transfer")
				{
					
				}else{
				smscallwithnum($mobile,$smsrec,$msgtype,$cid,$empid);
				}
		
		
		 
		
	if($amount>=$monthDue)
	{
		
		   for($count=1;$count<=50000;$count++)
   {
		$groupcatname='Group'.$Chit_value.'('.$m.'M)-'.$count;
		$selectgroup=mysqli_query($con,"select * from tbl_auction_group_details where Group_Name='$groupcatname' and Status='Active'");
		$groupcount=mysqli_num_rows($selectgroup);
	   if($groupcount<$scheme_noofperson)
	   {
		 $createdon=date("d-m-Y H:i:s A");
		 $createdby=$accountname;
		 $updatedon=0;
		 $updatedby=0;
		 $status="Active";
		 $grpdate=date('d-m-Y');
		 $ticketcnt=$groupcount+2;
		 
		 if(strlen($ticketcnt)==1)
		 {
			$ticketname='DCPL'.$groupcatname.'-'.'0'.$ticketcnt; 
		 }
		 else{
			$ticketname='DCPL'.$groupcatname.'-'.$ticketcnt; 
		 }
		 
		
		
		$grpdel=mysqli_query($con,"INSERT INTO `tbl_auction_group_details`(`Cust_Id`, `Scheme_Id`, `Group_Name`,`Group_Ticket_Name`,`Group_Date`, `Created_On`, `Created_By`, `Updated_On`, `Updated_By`, `Status`) VALUES 
		('$cid','$scheme_Id','$groupcatname','$ticketname','$grpdate','$createdon','$createdby','$updatedon','$updatedby','$status')"); 
		
		$selectgroup1=mysqli_query($con,"select * from tbl_auction_group_details where Group_Name='$groupcatname' and Status='Active'");
		$groupcount2=mysqli_num_rows($selectgroup1);
		
		if($groupcount2==$scheme_noofperson)
	   {
		
			$body = ' 
				<html>
				<body>
				<p><h2>Customer Group Details</h2></p>
				<table border="1" style="width:100%">
				  <tr>
					<th width="30">SNo</th><th>Customer Id</th>
					<th>Application No</th> 
					<th>Customer Name</th>
					<th>Scheme Category</th>
					<th>Group Name</th>
					<th>Ticket Name </th>
					<th>Group Date</th>
				  </tr>';
				  
			$body2='
				</table>
				</body>
				</html>';

			 $qurygrp="select * from tbl_auction_group_details where Group_Name='$groupcatname' and Status='Active'";
						$qury_exegrp=mysqli_query($con,$qurygrp);
						$i=1;
					while($fetchgrp=mysqli_fetch_array($qury_exegrp))
					{
						$gpcustid=$fetchgrp['Cust_Id'];
						$gpschemeid=$fetchgrp['Scheme_Id'];
						$gpticketname=$fetchgrp['Group_Ticket_Name'];
						$gpgroupdate=$fetchgrp['Group_Date'];
							
						$qurycustget="select c.Customer_Id,c.Application_No,c.First_Name_F,h.Scheme_Under_Category from tbl_customer c left join tbl_chit_details h on c.Id=h.Cust_Id where c.Id='$gpcustid' and c.Status='Active'";
						$qury_exe_get=mysqli_query($con,$qurycustget);
						$fetch_custget=mysqli_fetch_array($qury_exe_get);
						$grpcustomeruid=$fetch_custget['Customer_Id'];
						$grpappno=$fetch_custget['Application_No'];
						$grpfirstname=$fetch_custget['First_Name_F'];
						$grpschemecate=$fetch_custget['Scheme_Under_Category'];
	 
						$body1=$body1.'
						<tr>
						<td>'.$i.'</td>   
						<td>'.$grpcustomeruid.'</td>
						<td>'.$grpappno.'</td>
						<td>'.$grpfirstname.'</td>
						<td>'.$grpschemecate.'</td>
						<td>'.$groupcatname.'</td>
						<td>'.$gpticketname.'</td>
						<td>'.$gpgroupdate. '</td>	
						</tr>';
		
						$i++;  
					} 
		
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: <'.$fromemail.'>' . "\r\n";
					$subject = 'DCPL Group Details';
					$headers .= 'Cc: $cc1\r\n';
					$message   =$body."".$body1."".$body2;

				}
 
			
		break;
		}
	} 
	}
	}
	

		$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Type_Of_Coll`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$paymentdel','$chequeno','$chequedate','$bankname','$branchname')";
				$result = mysqli_query($con, $sql) or die("Error in Selecting 2 " . mysqli_error($con));

		/* die(curl_error($ch));
		curl_close($ch); */ 
		if($sendsms =="Yes")
	{
		sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel,$monthDue,$Chit_value,$m,$scheme_noofperson,$scheme_Id,$accountname);	
	}
	 
	
?>

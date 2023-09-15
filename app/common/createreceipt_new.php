<?php

include 'tallyurl.php';

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
	
	
	function sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel)
	{
		
		require_once 'tallyurl.php';
		include('srdb.php');
		require_once 'smsdetails.php';
		
		      $d1=strtotime("+1 month");
				$d2=strtotime("-1 days");
     			$from1 =date("01-m-Y");
				//$to1 = date('01-m-Y',$d1);
				
				
				$app=explode('-',$doj);
				$doj1 = $app[0];
				$doj2 = $app[1];
				$doj3 = $app[2];
				$dtest = date("d");
				$dtest2 = date("m");
				$dtest3 = date("Y");
				$to2='';
				if($doj1>=$dtest)
				{
					$to1 =date("$doj1-m-Y");
					$arrr = explode('-', $to1);
					$to2 = $arrr[1].'/'.$arrr[0].'/'.$arrr[2];
							
				
				}else{
					$to1 =date("$doj1-m-Y",$d1);
					$arrr = explode('-', $to1);
					$to2 = $arrr[1].'/'.$arrr[0].'/'.$arrr[2];
					
				}
				
				$select3=mysqli_query($con,"SELECT Scheme_Under_Category,Payment_Type,Date_Introducer,Is_Scheme,Is_Scheme_Opening FROM `tbl_chit_details` where Cust_Id='$cid'");
				$fetch3=mysqli_fetch_array($select3);
				 $scheme=$fetch3['Scheme_Under_Category'];
				$payment_type=$fetch3['Payment_Type'];
				$Date_Introducer=$fetch3['Date_Introducer'];
				 $isscheme=$fetch3['Is_Scheme'];				
				 $Is_Scheme_Opening=$fetch3['Is_Scheme_Opening'];
				
				$sqlchit = mysqli_query($con,"select * from tbl_chit_structure where Scheme_Format='$scheme'");
				$chit_fetch = mysqli_fetch_array($sqlchit);
				$tpaid = 0;
				
				
				
	$tmpchitvalue='';
	$chitvalue1='';
				 if ($scheme == "50,000(10 M)") {
                    $tmpchitvalue = "(50T_10M)";
					
                } else if ($scheme=="50,000(20 M)") {
                    $tmpchitvalue = "(50T_20M)";
					
                } else if ($scheme=="100,000(20 M)") {
                    $tmpchitvalue = "(1L_20M)";
					
                } else if ($scheme=="100,000(10 M)") {
                    $tmpchitvalue = "(1L_10M)";
					
                } else if ($scheme=="200,000(20 M)") {
                    $tmpchitvalue = "(2L_20M)";
					
                } else if ($scheme=="200,000(10 M)") {
                    $tmpchitvalue = "(2L_10M)";
					
                } else if ($scheme=="300,000(20 M)") {
                    $tmpchitvalue = "(3L_20M)";
					
                } else if ($scheme=="300,000(10 M)") {
                    $tmpchitvalue = "(3L_10M)";
					
                } else if ($scheme=="500,000(20 M)") {
                    $tmpchitvalue = "(5L_20M)";
					
                } else if ($scheme=="500,000(25 M)") {
                    $tmpchitvalue = "(5L_25M)";
					
                } else if ($scheme=="500,000(40 M)") {
                    $tmpchitvalue = "(5L_40M)";
					
                } else if ($scheme=="1,000,000(20 M)") {
                    $tmpchitvalue = "(10L_20M)";
					
                } else if ($scheme=="1,000,000(25 M)") {
                    $tmpchitvalue = "(10L_25M)";
					

                } else if ($scheme=="1,000,000(40 M)") {
                    $tmpchitvalue = "(10L_40M)";
					
                } else {
                    $tmpchitvalue = " ";
					
                }
				$chitvalue = $tmpchitvalue;
				
					if($isscheme=="Yes"){
	
	$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
	$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
	$Month = $chit_fetch['Month'];
	$date = new DateTime($Date_Introducer);
	$dateofjoining = $date->format('d-m-Y');
	$chitvalue1= $chit_fetch['Customer_Payment_Scheme'];
	
		//$curdate = date('m/d/Y');
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
		
		if($noofbills<=1){ 
		
			$totaltopaid = $totaltopaid + ($noofbills*$M_First_Sec_Amt);			
			$tpaid=$totaltopaid;
		}else if($noofbills ==2)
		{
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt);
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt/2);			
			$tpaid=$totaltopaid;
		}else{
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt);
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt/2);			
			if($noofbills>$Month)
			{
				$noofbills =$Month;
			}
			$tempnoofbills = $noofbills-2;
			
			if($tempnoofbills >0)
			{
				if($Month == $noofbills)
				{
					$totaltopaid = $totaltopaid + (($tempnoofbills-1)*$M_Second_Sec_Amt);
					$totaltopaid = $totaltopaid + ($M_Second_Sec_Amt/2);

				}else{
				
				$totaltopaid = $totaltopaid + ($tempnoofbills*$M_Second_Sec_Amt);			

				}
			}
			 $tpaid=$totaltopaid;
			
		}
		
		
		
		
}


if($Is_Scheme_Opening=="Yes"){
	
	$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
	$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
	$M_scheme_Amt= $chit_fetch['M_scheme_Amt'];
	
	$Month = $chit_fetch['Month'];
	$date = new DateTime($Date_Introducer);
	$dateofjoining = $date->format('d-m-Y');
	$chitvalue1= $chit_fetch['Customer_Payment_Sch_2'];
	
		//$curdate = date('m/d/Y');
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
		
		if($noofbills<=1){ 
		
			$totaltopaid = $totaltopaid + ($noofbills*$M_First_Sec_Amt);			
			$tpaid=$totaltopaid;
		}else if($noofbills >=2&&$noofbills<=5)
		{
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt);
			$totaltopaid = $totaltopaid + ($M_scheme_Amt*($noofbills-1));			
			$tpaid=$totaltopaid;
		}else
		{
			$totaltopaid = $totaltopaid + ($M_First_Sec_Amt);
			$totaltopaid = $totaltopaid + ($M_scheme_Amt*4);			
			if($noofbills>$Month)
			{
				$noofbills =$Month;
			}
			$tempnoofbills = $noofbills-5;
			
			if($tempnoofbills >0)
			{
				$totaltopaid = $totaltopaid + ($tempnoofbills*$M_Second_Sec_Amt);			
			}
			 $tpaid=$totaltopaid;
		}
		
		
		
		
}


if($isscheme=="No"&&$Is_Scheme_Opening=="No"){
							
						$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
						$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
						$date = new DateTime($Date_Introducer);
						$dateofjoining = $date->format('d-m-Y');
						$Month = $chit_fetch['Month'];
						$chitvalue1= $chit_fetch['Customer_Payment'];
							//$curdate = date('m/d/Y');
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
							
							
					}
					
					

if($doj1==$dtest && $doj2==$dtest2 && $doj3==$dtest3)
{
	$tpaid=$chit_fetch['M_First_Sec_Amt'];
	$to1 =date("$doj1-m-Y",$d1);
}

						
				
				$sql2 = "SELECT SUM( REPLACE( Total_Amount,  ',',  '' ) ) AS repval FROM `tbl_receipt_transaction` WHERE Cust_Id = '$cid' ";
				$result2 = mysqli_query($con, $sql2) or die("Error in Selecting 1 " . mysqli_error($con));
				$result2fetch =mysqli_fetch_array($result2);
				$totalpaid =$result2fetch['repval'];
				//echo $tpaid;
				//echo ("dsfsdf");
				$CLOSINGBALANCE = $tpaid-$totalpaid;
				$motn = substr($chitvalue,-4,-2);
				$app1=explode('-',$doj);
				$do1 = $app1[0];
				$mo1 = $app1[1];
				$yo1 = $app1[2];
				$t=$do1."-".$mo1."-".$yo1;
				$EOC =date( "d-m-Y", strtotime( $t." +".$motn. "month" ) );
				
				$check = "-";
		
				if($paymentdel == "Cheque")
				{
				if($CLOSINGBALANCE!=0&&strncmp($CLOSINGBALANCE, $check , strlen($check )))
				{
				$smsrec = "$companynamedel Dear $cusname, We received the Cheque for Rs:$amount for chit $appid".$chitvalue.". You need to clear total due of Rs:".$CLOSINGBALANCE." with in ".$to1.". As on date paid Rs:".$totalpaid.".And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";

				}else
				{
				$smsrec = "$companynamedel Dear $cusname, We received the Cheque for Rs:$amount for chit $appid".$chitvalue.". As on date paid Rs:".$totalpaid.". And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";
				}
				
				} else	{		
		
				if($CLOSINGBALANCE!=0&&strncmp($CLOSINGBALANCE, $check , strlen($check )))
				{
				$smsrec = "$companynamedel Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". You need to clear total due of Rs:".$CLOSINGBALANCE." with in ".$to1.". As on date paid Rs:".$totalpaid.".And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";

				}else
				{
				$smsrec = "$companynamedel Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". As on date paid Rs:".$totalpaid.". And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";

				}
				
				}
	
				$msgtype = "Receipt";
				if($paymentdel == "Transfer")
				{
					
				}else{
				smscallwithnum($mobile,$smsrec,$msgtype,$cid,$empid);
				}
				
				$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
				$curdate = date("01-04-2016");
				$curdate2 =$doj;
				$date1 = strtotime($curdate);
				$date2 = strtotime($curdate2);
				
				$checkcust=mysqli_query($con,"select * from `tbl_group_details_new` where Cust_Id='$cid' and Status='Active'");
				$checkselect=mysqli_num_rows($checkcust);
				if($checkselect==0)
				{
			
				if($totalpaid>=$M_Second_Sec_Amt && $date1 < $date2)
				{
		
		$chitstructuresql =mysqli_query($con,"select Id,Chit_value,Scheme_Format,Month,M_Second_Sec_Amt,Member from  tbl_chit_structure where Scheme_Format='$scheme'");
		$fetchschemefetch=mysqli_fetch_array($chitstructuresql);
		$Chit_value = $fetchschemefetch['Chit_value'];
		$Scheme_Format = $fetchschemefetch['Scheme_Format'];
		$m = $fetchschemefetch['Month'];
		$M_Second_Sec_Amt =  $fetchschemefetch['M_Second_Sec_Amt']; 
		$scheme_noofperson  =  $fetchschemefetch['Member'];
		$scheme_Id=  $fetchschemefetch['Id'];
      for($count=1;$count<=50000;$count++)
       {
		$groupcatname='Group'.$Chit_value.'('.$m.'M)-'.$count;
		$selectgroup=mysqli_query($con,"select * from tbl_group_details_new where Group_Name='$groupcatname' and Status='Active'");
		$groupcount=mysqli_num_rows($selectgroup);
	   if($groupcount<$scheme_noofperson)
	   {
		 $createdon=date("d-m-Y H:i:s A");
		 $createdby=$_SESSION['User'];
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
		 
		
		
		$grpdel=mysqli_query($con,"INSERT INTO `tbl_group_details_new`(`Cust_Id`, `Scheme_Id`, `Group_Name`,`Group_Ticket_Name`,`Group_Date`, `Created_On`, `Created_By`, `Updated_On`, `Updated_By`, `Status`) VALUES 
		('$cid','$scheme_Id','$groupcatname','$ticketname','$grpdate','$createdon','$createdby','$updatedon','$updatedby','$status')"); 
		$selectgroup1=mysqli_query($con,"select * from tbl_group_details_new where Group_Name='$groupcatname' and Status='Active'");
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

			 $qurygrp="select * from tbl_group_details_new where Group_Name='$groupcatname' and Status='Active'";
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
		
	}
	
	
$XPost = "<ENVELOPE>
 <HEADER>
	<TALLYREQUEST>Import Data</TALLYREQUEST>
	
 </HEADER>
 <BODY>
  <IMPORTDATA>
   <REQUESTDESC>
    <REPORTNAME>Vouchers</REPORTNAME>
    <STATICVARIABLES>
     <SVCURRENTCOMPANY>$compname</SVCURRENTCOMPANY>
    </STATICVARIABLES>
   </REQUESTDESC>
   <REQUESTDATA>
    <TALLYMESSAGE xmlns:UDF='TallyUDF'>
     <VOUCHER VCHTYPE='Receipt' ACTION='Create' OBJVIEW='Accounting Voucher View'>
      <DATE>$date</DATE>

      <VOUCHERTYPENAME>Receipt</VOUCHERTYPENAME>
       <PARTYLEDGERNAME>$name1</PARTYLEDGERNAME>
      <PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
      <ENTEREDBY>$accountname</ENTEREDBY>
      <ISOPTIONAL>No</ISOPTIONAL>
      <EFFECTIVEDATE>$date</EFFECTIVEDATE>
 
      <ALLLEDGERENTRIES.LIST>
       <LEDGERNAME>$name1</LEDGERNAME>
       <ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
       <AMOUNT>$amount</AMOUNT>
       <BILLALLOCATIONS.LIST>
	   <NAME>$appid-$tempno</NAME>
        <BILLTYPE>New Ref</BILLTYPE>
        <AMOUNT>$amount</AMOUNT>
       </BILLALLOCATIONS.LIST>
       </ALLLEDGERENTRIES.LIST>
      <ALLLEDGERENTRIES.LIST>
      <LEDGERNAME>$accountname _collection</LEDGERNAME>
      <ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
      <AMOUNT>-$amount</AMOUNT>
      </ALLLEDGERENTRIES.LIST>
     </VOUCHER>
    </TALLYMESSAGE>
   </REQUESTDATA>
  </IMPORTDATA>
 </BODY>
</ENVELOPE>";

	

	$ch = curl_init(); 

	curl_setopt($ch, CURLOPT_VERBOSE, 1); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 40); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
	curl_setopt($ch, CURLOPT_POST, 1);


	$result = curl_exec($ch); 

	if (empty($result)) 
	{
		$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Type_Of_Coll`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$paymentdel','$chequeno','$chequedate','$bankname','$branchname')";
				$result = mysqli_query($con, $sql) or die("Error in Selecting 2 " . mysqli_error($con));

		die(curl_error($ch));
		curl_close($ch); 
		if($sendsms =="Yes")
	{
		sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel);	
	}
	} else 
	{
		$info = curl_getinfo($ch);
		curl_close($ch); 
		if (empty($info['http_code'])) 
		{
			$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Type_Of_Coll`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$paymentdel','$chequeno','$chequedate','$bankname','$branchname')";
				$result = mysqli_query($con, $sql) or die("Error in Selecting 3 " . mysqli_error($con));

			if($sendsms =="Yes")
	{
		sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel);	
	}	
			die("No HTTP code was returned");
		} else 
		{
			//echo($result);
			
			$dom1 = new DOMDocument;
			$dom1->loadXML($result);
			$books1 = $dom1->getElementsByTagName('CREATED');
			foreach ($books1 as $book1) {
				$uniname1 =  $book1->nodeValue;
			}
						
			if($uniname1 == 1)
			{
				$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Type_Of_Coll`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`) 
				VALUES ('$name1','$amount','$amount',
				'$date','Yes','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$paymentdel','$chequeno','$chequedate','$bankname','$branchname')";

				$result2 = mysqli_query($con, $sql) or die("Error in Selecting 4 " . mysqli_error($con));
	if($sendsms =="Yes")
	{
		sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel);	
		
		
	}
				
				
				
			}else
			{
				$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`,`Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`,`Type_Of_Coll`,`Cheque_No`,`Cheque_Date`,`Bank_Name`,`Branch_Name`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$datime','0','0','Active','$empid','$emp_branch','$cid','$str_collectiointype','$paymentdel','$chequeno','$chequedate','$bankname','$branchname')";

				$result2 = mysqli_query($con, $sql) or die("Error in Selecting 6" . mysqli_error($con));

if($sendsms =="Yes")
	{
		sendmessage($mobile,$appid,$doj,$cid,$amount,$cusname,$empid,$paymentdel);	
	}
								
			}
						
						
		}
	} 
?>

<?php
include 'tallyurl.php';
$dateofjoining = $Date_Introducer;

$sqlchit = mysqli_query($con,"select * from tbl_chit_structure where Scheme_Format='$Scheme_Format'");
$chit_fetch = mysqli_fetch_array($sqlchit);

$totalamount=$paidamount;
$name1 = $name."-".$userid."-".$appno;
$date = date("d-m-Y");
$amount	=$paidamount;
$doj = $Date_Introducer;	
$sendsms = "Yes";
	$cusname = $name;
	$Customerid = $userid;
	$appid = $appno;
	$tempno = date('dmYHis');
	$select1=mysqli_query($con,"SELECT c.Id,c.Mobile_F,d.Payment_Type FROM `tbl_customer` c left join `tbl_chit_details` d on c.Id=d.Cust_Id where c.Application_No='$appid'");
	$fetch1=mysqli_fetch_array($select1);
	$cid=$fetch1['Id'];	
	$mobile=$fetch1['Mobile_F'];
	$Payment_type=$fetch1['Payment_Type'];
	$empoyeebranch=mysqli_query($con,"select Branch from tbl_employee where Id='$empid' and Status='Active'");
	$fetchemployee=mysqli_fetch_array($empoyeebranch);
	$emp_branch=$fetchemployee['Branch'];
	
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
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$date','0','0','Active','$empid','$emp_branch','$cid','$Payment_type')";
				$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

		die(curl_error($ch));
		curl_close($ch); 
	} else 
	{
		$info = curl_getinfo($ch);
		curl_close($ch); 
		if (empty($info['http_code'])) 
		{
			$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`, `Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$date','0','0','Active','$empid','$emp_branch','$cid','$Payment_type')";
				$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

				
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
				(`Customer_Name`, `Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`) 
				VALUES ('$name1','$amount','$amount',
				'$date','Yes','$accountname','$date','0','0','Active','$empid','$emp_branch','$cid','$Payment_type')";
				
				$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
if($sendsms =="Yes")
	{
		
	$scheme = $str_schema;
	$tmpchitvalue='';
	$chitvalue1='';
				 if ($scheme == "50,000(10 M)") {
                    $tmpchitvalue = "(50T_10M)";
					$chitvalue1="42,000";
                } else if ($scheme=="50,000(20 M)") {
                    $tmpchitvalue = "(50T_20M)";
					$chitvalue1="41,000";
                } else if ($scheme=="100,000(20 M)") {
                    $tmpchitvalue = "(1L_20M)";
					$chitvalue1="82,000";
                } else if ($scheme=="100,000(10 M)") {
                    $tmpchitvalue = "(1L_10M)";
					$chitvalue1="84,000";
                } else if ($scheme=="200,000(20 M)") {
                    $tmpchitvalue = "(2L_20M)";
					$chitvalue1="164,000";
                } else if ($scheme=="200,000(10 M)") {
                    $tmpchitvalue = "(2L_10M)";
					$chitvalue1="168,000";
                } else if ($scheme=="300,000(20 M)") {
                    $tmpchitvalue = "(3L_20M)";
					$chitvalue1="246,000";
                } else if ($scheme=="300,000(10 M)") {
                    $tmpchitvalue = "(3L_10M)";
					$chitvalue1="252,000";
                } else if ($scheme=="500,000(20 M)") {
                    $tmpchitvalue = "(5L_20M)";
					$chitvalue1="410,000";
                } else if ($scheme=="500,000(25 M)") {
                    $tmpchitvalue = "(5L_25M)";
					$chitvalue1="419,500";
                } else if ($scheme=="500,000(40 M)") {
                    $tmpchitvalue = "(5L_40M)";
					$chitvalue1="405,000";
                } else if ($scheme=="1,000,000(20 M)") {
                    $tmpchitvalue = "(10L_20M)";
					$chitvalue1="820,000";
                } else if ($scheme=="1,000,000(25 M)") {
                    $tmpchitvalue = "(10L_25M)";
					$chitvalue1="839,000";

                } else if ($scheme=="1,000,000(40 M)") {
                    $tmpchitvalue = "(10L_40M)";
					$chitvalue1="810,000";
                } else {
                    $tmpchitvalue = " ";
					$chitvalue1="";
                }
				$chitvalue = $tmpchitvalue;
							
				$d1=strtotime("+1 month");
				$d2=strtotime("-1 days");
				
				
				
				$d1=strtotime("+1 month");
				$d2=strtotime("-1 days");
     			$from1 =date("01-m-Y");
				//$to1 = date('01-m-Y',$d1);
				
				
				$app=explode('-',$doj);
				$doj1 = $app[0];
				$dtest = date("d");
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
				
				$select3=mysqli_query($con,"SELECT Scheme_Under_Category,Payment_Type,Date_Introducer FROM `tbl_chit_details` where Cust_Id='$cid'");
				$fetch3=mysqli_fetch_array($select3);
				$scheme=$fetch3['Scheme_Under_Category'];
				$payment_type=$fetch3['Payment_Type'];
				$Date_Introducer=$fetch3['Date_Introducer'];
				

				$sqlchit = mysqli_query($con,"select * from tbl_chit_structure where Scheme_Format='$scheme'");
				$chit_fetch = mysqli_fetch_array($sqlchit);
				$tpaid = 0;
					if($payment_type=='Monthly'){
							
						$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
						$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
						$date = new DateTime($Date_Introducer);
						$dateofjoining = $date->format('d-m-Y');
						$Month = $chit_fetch['Month'];
						
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


					if($payment_type=='Weekly'){
						
						
						$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
						$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
						$weeklyamt = $chit_fetch['W_First_Sec_Amt'];
						$weeklyamt2 = $chit_fetch['W_Second_Sec_Amt'];
						$date = new DateTime($Date_Introducer);
						$dateofjoining = $date->format('d-m-Y');
						$Month = $chit_fetch['Month'];
						
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
							$week1=0;
							if($days>0){
								$week1 = floor($days/7);
								
								if($week1>=4)
								{
									$week1=4;
								}else{
									$days2 = $days%7;
									if($days2 != 0)
									{
										$week1 = $week1+1;
									}
								}
							}
							
							if($curdate==$dojDate && $noofbills==0&& $week1==0){
								$week1=1;
							}
							
							$totaltopaid = 0;
							
							if($noofbills<2){ 
							
								$totaltopaid = $totaltopaid + ($noofbills*$M_First_Sec_Amt);			
								
								$t1 = $week1 * $weeklyamt;
								$totaltopaid = $totaltopaid+$t1;
								$tpaid=$totaltopaid;
								
								
							}else{
								$totaltopaid = $totaltopaid + (2*$M_First_Sec_Amt);			
								if($noofbills>$Month)
								{
									$noofbills =$Month;
									$week1=0;
								}
								$tempnoofbills = $noofbills-2;
								if($tempnoofbills >0||$week1>0)
								{
									$totaltopaid = $totaltopaid + ($tempnoofbills*$M_Second_Sec_Amt);			
									$t1 = $week1 * $weeklyamt2;
								$totaltopaid = $totaltopaid+$t1;
								}
								$tpaid=$totaltopaid;
							}
							
							
					}

					if($payment_type=='Daily'){
						
						$M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
						$M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
						$daiyamt = $chit_fetch['Daily_Amt'];
						$date = new DateTime($Date_Introducer);
						$dateofjoining = $date->format('d-m-Y');
						$Month = $chit_fetch['Month'];
						
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
							$days1=0;
							if($days>0){
								$days1 = $days;
								
								
							}
							
							if($curdate==$dojDate && $noofbills==0&& $days1==0){
								$days1=1;
							}
							
							$totaltopaid = 0;
							
							if($noofbills<2){ 
							
								$totaltopaid = $totaltopaid + ($noofbills*$M_First_Sec_Amt);			
								
								$t1 = $days1 * $daiyamt;
								if($t1>=$M_First_Sec_Amt)
								{
									$t1 = $M_First_Sec_Amt;
								}
								$totaltopaid = $totaltopaid+$t1;
								
								$tpaid=$totaltopaid;
								
								
							}else{
								$totaltopaid = $totaltopaid + (2*$M_First_Sec_Amt);			
								if($noofbills>$Month)
								{
									$noofbills =$Month;
									$days1=0;
								}
								$tempnoofbills = $noofbills-2;
								if($tempnoofbills >0||$days1>0)
								{
									$totaltopaid = $totaltopaid + ($tempnoofbills*$M_Second_Sec_Amt);			
									$t1 = $days1 * $daiyamt;
									
									if($t1>=$M_Second_Sec_Amt)
								{
									$t1 = $M_Second_Sec_Amt;
								}
								
								$totaltopaid = $totaltopaid+$t1;
								}
								
								$tpaid=$totaltopaid;
								
								
							}
							
							
					}
				
				$sql2 = "SELECT SUM( REPLACE( Total_Amount,  ',',  '' ) ) AS repval FROM `tbl_receipt_transaction` WHERE Cust_Id = '$cid' ";
				$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($con));
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
		
				if($CLOSINGBALANCE!=0&&strncmp($CLOSINGBALANCE, $check , strlen($check )))
				{
				$sms = "$companynamedel  Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". You need to clear total due of Rs:".$CLOSINGBALANCE." with in ".$to1.". As on date paid Rs:".$totalpaid.".And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";

				}else
				{
				$sms = "$companynamedel Dear $cusname, We received collection amount Rs:$amount for chit $appid".$chitvalue.". As on date paid Rs:".$totalpaid.". And need to pay a Total amount of ".$chitvalue1."(".$EOC.")";

				}
				
				
	
				$msgtype = "Receipt";
				smscall($mobile,$sms,$msgtype,$cid);
	}
				
				//echo($result);
				
			}else
			{
				$sql = "INSERT INTO `tbl_receipt_transaction`
				(`Customer_Name`, `Amount`,
				`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Emp_Branch`,`Cust_Id`,`Payment_Type`) 
				VALUES ('$name1','$amount','$amount',
				'$date','No','$accountname','$date','0','0','Active','$empid','$emp_branch','$cid','$Payment_type')";
				$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));


				//echo($result);				
			}
						
						
		}
	} 
?>

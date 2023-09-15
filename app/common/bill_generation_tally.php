<?php 
//bill_generation_tally.php
include 'tallyurl.php';

//include 'config.php';

/*  $Scheme_Format = $_REQUEST['Scheme_Format'];
$payment_type = $_REQUEST['payment_type'];
$dateofjoining = $_REQUEST['dateofjoining'];
$name = $_REQUEST['name'];
$userid = $_REQUEST['userid'];
$appno = $_REQUEST['appno']; */

//$dateofjoining="12-03-2016";


$sqlchit = mysqli_query($con,"select * from tbl_chit_structure where Scheme_Format='$Scheme_Format'");
$chit_fetch = mysqli_fetch_array($sqlchit);
 
 //// Daily Process
 
 if($payment_type=='Daily'){
	 
	 $daiyamt = $chit_fetch['Daily_Amt'];
	 $D_First_Sec_Bill = $chit_fetch['D_First_Sec_Bill'];
	 $D_Second_Sec_Bill = $chit_fetch['D_Second_Sec_Bill'];
	 $D_Bill = $chit_fetch['D_Bills'];
	 $D_Last_Bill_Amt = $chit_fetch['D_Last_Bill_Amt'];
	 $Month = $chit_fetch['Month'];
	 $Chit_value = $chit_fetch['Chit_value'];
	 $Customer_Payment = $chit_fetch['Customer_Payment'];
	 
	 //$dateofjoining  =date_create($dateofjoining);
	 //$dateofjoining = date_format($dateofjoining,"d-m-Y");
	 
	 $date = new DateTime($dateofjoining);
	 $dateofjoining = $date->format('d-m-Y');
	$enddate = $dateofjoining;
	$initialjoin = $dateofjoining;
	 $initialjoin_1 = $dateofjoining;
	 
	 $amount = $daiyamt;
	 $vouc2 ="";
	 $testtest="";
		 
	 if($Chit_value!=500000 && $Month!=40 || $Chit_value!=1000000 && $Month!=40){
		 /// First secment bill generation///
		 
		for($i=1;$i<=$D_First_Sec_Bill;$i++)
		{
			
			$vouc1 = "<VOUCHER VCHTYPE='Journal' ACTION='Create' OBJVIEW='Accounting Voucher View'>
					<DATE>$dateofjoining</DATE>
					<VOUCHERTYPENAME>Journal</VOUCHERTYPENAME>
					<PARTYLEDGERNAME>$name-$userid-$appno</PARTYLEDGERNAME>
					<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
					<PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
					<ENTEREDBY>a</ENTEREDBY>
					<ISOPTIONAL>No</ISOPTIONAL>
					<EFFECTIVEDATE>$dateofjoining</EFFECTIVEDATE>
					<NARRATION></NARRATION>
					<COSTCENTRENAME></COSTCENTRENAME>  
					<ISCOSTCENTRE>No</ISCOSTCENTRE>
					<ALLLEDGERENTRIES.LIST>
					<LEDGERNAME>
					$name-$userid-$appno
					</LEDGERNAME><ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
					<AMOUNT>- $amount</AMOUNT>";
					
					$vouc3 = "
					</ALLLEDGERENTRIES.LIST>
					<ALLLEDGERENTRIES.LIST><LEDGERNAME>
					Grpincome
					</LEDGERNAME>
					<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
					<AMOUNT>$amount</AMOUNT>
					</ALLLEDGERENTRIES.LIST></VOUCHER>";
					
					$vouc4 = "
					<BILLALLOCATIONS.LIST>
					<NAME>$userid-$appno-$i</NAME>
					<BILLCREDITPERIOD>2 Days</BILLCREDITPERIOD>
					<BILLTYPE>New Ref</BILLTYPE>
					<AMOUNT>-$amount</AMOUNT>
					</BILLALLOCATIONS.LIST>
					";
											
											
							$vouc2 = $vouc2.$vouc4;
							$testtesttest = $vouc1.$vouc2.$vouc3;
							$testtest = $testtest.$testtesttest;
							$vouc2="";
								
				
				$date = new DateTime($dateofjoining);
				$dateofjoining = $date->format('d-m-Y'); 
				$dateofjoining = date('d-m-Y', strtotime('+1 day', strtotime($dateofjoining))); 
			
		}
		
		
	   $date2 = new DateTime($initialjoin);
	   $initialjoin = $date2->format('d-m-Y');
	   $dateofjoining = date('d-m-Y', strtotime('+3 month', strtotime($initialjoin))); 
	   $dateofjoining_3m = $dateofjoining;
	}
	else{
		$p=1;
		for($i=1;$i<=$D_First_Sec_Bill;$i++)
		{
			
			$vouc1 = "<VOUCHER VCHTYPE='Journal' ACTION='Create' OBJVIEW='Accounting Voucher View'>
					<DATE>$dateofjoining</DATE>
					<VOUCHERTYPENAME>Journal</VOUCHERTYPENAME>
					<PARTYLEDGERNAME>$name-$userid-$appno</PARTYLEDGERNAME>
					<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
					<PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
					<ENTEREDBY>a</ENTEREDBY>
					<ISOPTIONAL>No</ISOPTIONAL>
					<EFFECTIVEDATE>$dateofjoining</EFFECTIVEDATE>
					<NARRATION></NARRATION>
					<COSTCENTRENAME></COSTCENTRENAME>  
					<ISCOSTCENTRE>No</ISCOSTCENTRE>
					<ALLLEDGERENTRIES.LIST>
					<LEDGERNAME>
					$name-$userid-$appno
					</LEDGERNAME><ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
					<AMOUNT>- $amount</AMOUNT>";
					
					$vouc3 = "
					</ALLLEDGERENTRIES.LIST>
					<ALLLEDGERENTRIES.LIST><LEDGERNAME>
					Grpincome
					</LEDGERNAME>
					<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
					<AMOUNT>$amount</AMOUNT>
					</ALLLEDGERENTRIES.LIST></VOUCHER>";
					
					$vouc4 = "
					<BILLALLOCATIONS.LIST>
					<NAME>$userid-$appno-$i</NAME>
					<BILLCREDITPERIOD>2 Days</BILLCREDITPERIOD>
					<BILLTYPE>New Ref</BILLTYPE>
					<AMOUNT>-$amount</AMOUNT>
					</BILLALLOCATIONS.LIST>
					";
											
											
							$vouc2 = $vouc2.$vouc4;
							$testtesttest = $vouc1.$vouc2.$vouc3;
							$testtest = $testtest.$testtesttest;
							$vouc2="";
								
								if($p==25){
									$date2 = new DateTime($initialjoin_1);
								   $initialjoin_1 = $date2->format('d-m-Y');
								   $dateofjoining = date('d-m-Y', strtotime('+1 month', strtotime($initialjoin_1)));
								   $initialjoin_1 =  $dateofjoining;
									$p=1;
								}else{
									$date = new DateTime($dateofjoining);
									$dateofjoining = $date->format('d-m-Y'); 
									$dateofjoining = date('d-m-Y', strtotime('+1 day', strtotime($dateofjoining))); 
									$p++;
									
								}
								#echo $p; echo "</br>";
								#echo $dateofjoining;  echo "</br>";
		}
		
		
	   $date2 = new DateTime($initialjoin);
	   $initialjoin = $date2->format('d-m-Y');
	   $dateofjoining = date('d-m-Y', strtotime('+2 month', strtotime($initialjoin))); echo "</br>";
	   $dateofjoining_3m = $dateofjoining;
		
		
	}
	
	$remainingbills = $D_Bill-$D_First_Sec_Bill;
	
	 $vouc12 ="";
	 $testtest1="";
	 $k=1;
	for($j=1;$j<=$remainingbills;$j++)
	{
		
		
		if($remainingbills==$j){
			$totbilamt = $daiyamt*$D_Bill;
			#echo $totcalamt = ($daiyamt*$D_First_Sec_Bill)+($daiyamt*$remainingbills); echo "</br>";
			if($totbilamt>$Customer_Payment){
				$amount = $totbilamt-$Customer_Payment;				
			}
		}
		
		$secbill = $D_First_Sec_Bill+$j;
		
		$vouc11 = "<VOUCHER VCHTYPE='Journal' ACTION='Create' OBJVIEW='Accounting Voucher View'>
				<DATE>$dateofjoining</DATE>
				<VOUCHERTYPENAME>Journal</VOUCHERTYPENAME>
				<PARTYLEDGERNAME>$name-$userid-$appno</PARTYLEDGERNAME>
				<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
				<PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
				<ENTEREDBY>a</ENTEREDBY>
				<ISOPTIONAL>No</ISOPTIONAL>
				<EFFECTIVEDATE>$dateofjoining</EFFECTIVEDATE>
				<NARRATION></NARRATION>
				<COSTCENTRENAME></COSTCENTRENAME>  
				<ISCOSTCENTRE>No</ISCOSTCENTRE>
				<ALLLEDGERENTRIES.LIST>
				<LEDGERNAME>
				$name-$userid-$appno
				</LEDGERNAME><ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
				<AMOUNT>- $amount</AMOUNT>";
				
				$vouc13 = "
				</ALLLEDGERENTRIES.LIST>
				<ALLLEDGERENTRIES.LIST><LEDGERNAME>
				Grpincome
				</LEDGERNAME>
				<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
				<AMOUNT>$amount</AMOUNT>
				</ALLLEDGERENTRIES.LIST></VOUCHER>";
				
				$vouc14 = "
				<BILLALLOCATIONS.LIST>
				<NAME>$userid-$appno-$secbill</NAME>
				<BILLCREDITPERIOD>2 Days</BILLCREDITPERIOD>
				<BILLTYPE>New Ref</BILLTYPE>
				<AMOUNT>-$amount</AMOUNT>
				</BILLALLOCATIONS.LIST>
				";
										
										
						$vouc12 = $vouc12.$vouc14;
						$testtesttest1 = $vouc11.$vouc12.$vouc13;
						$testtest1 = $testtest1.$testtesttest1;
						$vouc12="";
												
						if($k==$D_Second_Sec_Bill){
							
							$date = new DateTime($dateofjoining_3m);
							$dateofjoining_3m = $date->format('d-m-Y');
							$dateofjoining = date('d-m-Y', strtotime('1 month', strtotime($dateofjoining_3m)));
						    $dateofjoining_3m = $dateofjoining;
							
							
							$k=1;
						}else{							
														
							$date = new DateTime($dateofjoining);
							$dateofjoining = $date->format('d-m-Y');
							$dateofjoining = date('d-m-Y', strtotime('+1 day', strtotime($dateofjoining)));
		
		
							$k++;							
						}
				
		
	}
	$testtest=$testtest.$testtest1;
	$XPost = "
				<ENVELOPE>
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
									$testtest
										</TALLYMESSAGE>
									</REQUESTDATA>
								</IMPORTDATA>
							</BODY>
						</ENVELOPE>";
						
	    $ch = curl_init(); 

				curl_setopt($ch, CURLOPT_VERBOSE, 1); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, 40000); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);


				$result = curl_exec($ch); 

			if (empty($result)) 
			{
				die(curl_error($ch));
				curl_close($ch); 
			} else 
			{
				$info = curl_getinfo($ch);
				curl_close($ch); 
				if (empty($info['http_code'])) 
				{
					die("No HTTP code was returned");
				} else 
				{
					//echo($result);
					echo $result;
				}
			} 
	 
 }

/////// Weekly ////////////// 
 if($payment_type=='Weekly'){

	 
	 $weeklyamt = $chit_fetch['W_First_Sec_Amt'];
	 $weeklyamt2 = $chit_fetch['W_Second_Sec_Amt'];
	 $W_Bills = $chit_fetch['W_Bills'];
	 $W_Last_Bill_Amt = $chit_fetch['W_Last_Bill_Amt'];
	 $Month = $chit_fetch['Month'];
	 $Chit_value = $chit_fetch['Chit_value'];
	 $Customer_Payment = $chit_fetch['Customer_Payment'];
	 
	 //$dateofjoining  =date_create($dateofjoining);
	 //$dateofjoining = date_format($dateofjoining,"d-m-Y");
	 
	 $date = new DateTime($dateofjoining);
	 $dateofjoining = $date->format('d-m-Y');
	 #$enddate = $dateofjoining;
	 
	 $amount = $weeklyamt;
	 $vouc2 ="";
	 $testtest="";
	 $totweek = 0;
	 for($i=1;$i<=$W_Bills;$i++)
	{
		if($i>8)
		{
			$amount1 = $weeklyamt2;
		}else{
			$amount1 = $weeklyamt;
		}
		
		$totweek = $totweek+$amount1;
		
		if($W_Bills==$i){
			if($totweek>$Customer_Payment){
				$amount1 = $totweek-$Customer_Payment;				
			}
		}

		$vouc1 = "<VOUCHER VCHTYPE='Journal' ACTION='Create' OBJVIEW='Accounting Voucher View'>
				<DATE>$dateofjoining</DATE>
				<VOUCHERTYPENAME>Journal</VOUCHERTYPENAME>
				<PARTYLEDGERNAME>$name-$userid-$appno</PARTYLEDGERNAME>
				<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
				<PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
				<ENTEREDBY>a</ENTEREDBY>
				<ISOPTIONAL>No</ISOPTIONAL>
				<EFFECTIVEDATE>$dateofjoining</EFFECTIVEDATE>
				<NARRATION></NARRATION>
				<COSTCENTRENAME></COSTCENTRENAME>  
				<ISCOSTCENTRE>No</ISCOSTCENTRE>
				<ALLLEDGERENTRIES.LIST>
				<LEDGERNAME>
				$name-$userid-$appno
				</LEDGERNAME><ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
				<AMOUNT>- $amount1</AMOUNT>";
				
				$vouc3 = "
				</ALLLEDGERENTRIES.LIST>
				<ALLLEDGERENTRIES.LIST><LEDGERNAME>
				Grpincome
				</LEDGERNAME>
				<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
				<AMOUNT>$amount1</AMOUNT>
				</ALLLEDGERENTRIES.LIST></VOUCHER>";
				
				$vouc4 = "
				<BILLALLOCATIONS.LIST>
				<NAME>$userid-$appno-$i</NAME>
				<BILLCREDITPERIOD>6 Days</BILLCREDITPERIOD>
				<BILLTYPE>New Ref</BILLTYPE>
				<AMOUNT>-$amount1</AMOUNT>
				</BILLALLOCATIONS.LIST>
				";
				
				$vouc2 = $vouc2.$vouc4;
				$testtesttest = $vouc1.$vouc2.$vouc3;
				$testtest = $testtest.$testtesttest;
				$vouc2="";
					
/* echo $i; echo "</br>";
echo $amount1; echo "</br>";
echo $dateofjoining; */	
			
				$date = new DateTime($dateofjoining);
				$dateofjoining = $date->format('d-m-Y'); 
				$dateofjoining = date('d-m-Y', strtotime('+7 day', strtotime($dateofjoining))); 
	}
	
				$XPost = "
				<ENVELOPE>
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
									$testtest
										</TALLYMESSAGE>
									</REQUESTDATA>
								</IMPORTDATA>
							</BODY>
						</ENVELOPE>";
						
				$ch = curl_init(); 

				curl_setopt($ch, CURLOPT_VERBOSE, 1); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, 40000); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);


				$result = curl_exec($ch); 

			if (empty($result)) 
			{
				die(curl_error($ch));
				curl_close($ch); 
			} else 
			{
				$info = curl_getinfo($ch);
				curl_close($ch); 
				if (empty($info['http_code'])) 
				{
					die("No HTTP code was returned");
				} else 
				{
					//echo($result);
					echo $result;
				}
			}
 }
/////// Monthly ////////////// 
 if($payment_type=='Monthly'){

	 $monthlyamt = $chit_fetch['M_First_Sec_Amt'];
	 $monthlyamt2 = $chit_fetch['M_Second_Sec_Amt'];
	 $M_Bills = $chit_fetch['M_Bills'];
	 $M_Last_Bill_Amt = $chit_fetch['M_Last_Bill_Amt'];
	 $Month = $chit_fetch['Month'];
	 $Chit_value = $chit_fetch['Chit_value'];
	 $Customer_Payment = $chit_fetch['Customer_Payment'];
	
	 
	 $date = new DateTime($dateofjoining);
	 $dateofjoining = $date->format('d-m-Y');
	 
	 
	 $vouc2 ="";
	 $testtest="";
	 for($i=1;$i<=$M_Bills;$i++)
	{
		if($i>2)
		{
			$amount1 = $monthlyamt2;
		}else{
			$amount1 = $monthlyamt;
		}

		#echo $amount1; echo "</br>"; echo $dateofjoining;
		
		$vouc1 = "<VOUCHER VCHTYPE='Journal' ACTION='Create' OBJVIEW='Accounting Voucher View'>
				<DATE>$dateofjoining</DATE>
				<VOUCHERTYPENAME>Journal</VOUCHERTYPENAME>
				<PARTYLEDGERNAME>$name-$userid-$appno</PARTYLEDGERNAME>
				<FBTPAYMENTTYPE>Default</FBTPAYMENTTYPE>
				<PERSISTEDVIEW>Accounting Voucher View</PERSISTEDVIEW>
				<ENTEREDBY>a</ENTEREDBY>
				<ISOPTIONAL>No</ISOPTIONAL>
				<EFFECTIVEDATE>$dateofjoining</EFFECTIVEDATE>
				<NARRATION></NARRATION>
				<COSTCENTRENAME></COSTCENTRENAME>  
				<ISCOSTCENTRE>No</ISCOSTCENTRE>
				<ALLLEDGERENTRIES.LIST>
				<LEDGERNAME>
				$name-$userid-$appno
				</LEDGERNAME><ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
				<AMOUNT>- $amount1</AMOUNT>";
				
				$vouc3 = "
				</ALLLEDGERENTRIES.LIST>
				<ALLLEDGERENTRIES.LIST><LEDGERNAME>
				Grpincome
				</LEDGERNAME>
				<ISDEEMEDPOSITIVE>No</ISDEEMEDPOSITIVE>
				<AMOUNT>$amount1</AMOUNT>
				</ALLLEDGERENTRIES.LIST></VOUCHER>";
				
				$vouc4 = "
				<BILLALLOCATIONS.LIST>
				<NAME>$userid-$appno-$i</NAME>
				<BILLCREDITPERIOD>30 Days</BILLCREDITPERIOD>
				<BILLTYPE>New Ref</BILLTYPE>
				<AMOUNT>-$amount1</AMOUNT>
				</BILLALLOCATIONS.LIST>
				";
				
				$date = new DateTime($dateofjoining);
				$dateofjoining = $date->format('d-m-Y'); 
				$dateofjoining = date('d-m-Y', strtotime('+1 month', strtotime($dateofjoining))); 
				
				$vouc2 = $vouc2.$vouc4;
				$testtesttest = $vouc1.$vouc2.$vouc3;
				$testtest = $testtest.$testtesttest;
				$vouc2="";
					
			}
				
				
				$XPost = "
				<ENVELOPE>
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
									$testtest
										</TALLYMESSAGE>
									</REQUESTDATA>
								</IMPORTDATA>
							</BODY>
						</ENVELOPE>";
						
				$ch = curl_init(); 

				curl_setopt($ch, CURLOPT_VERBOSE, 1); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, 40000); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);


				$result = curl_exec($ch); 

			if (empty($result)) 
			{
				die(curl_error($ch));
				curl_close($ch); 
			} else 
			{
				$info = curl_getinfo($ch);
				curl_close($ch); 
				if (empty($info['http_code'])) 
				{
					die("No HTTP code was returned");
				} else 
				{
					//echo($result);
					//echo $result;
				}
			} 
 }
?>
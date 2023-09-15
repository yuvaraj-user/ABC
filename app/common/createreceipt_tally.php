<?php

//createreceipt_tally.php
//include '../tallyurl.php';

#include 'tallyurl.php';

/**/
$Scheme_Format = $_REQUEST['Scheme_Format'];
$payment_type = $_REQUEST['payment_type']; 
$dateofjoining = $_REQUEST['dateofjoining']; // d-m-Y
$name = $_REQUEST['name'];
$userid = $_REQUEST['userid'];
$appno = $_REQUEST['appno']; 
$paidamount = $_REQUEST['paidamount'];
$accountname = $_REQUEST['accountname'];
$empid= $_REQUEST['empid'];
$cid= $_REQUEST['cid']; 

//$dateofjoining = $Date_Introducer;
#echo $Scheme_Format;

echo "select * from tbl_chit_structure where Scheme_Format='$Scheme_Format'";

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
	 
	 $curdate = date('m/d/Y');
	 $arr = explode('-', $dateofjoining);
	 $dojDate = $arr[1].'/'.$arr[0].'/'.$arr[2];
	 $diff = abs(strtotime($curdate) - strtotime($dojDate));
	 $years = floor($diff / (365*60*60*24));
	 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	 if($paidamount>0){
		 		 
		$tillnowdays = (strtotime($curdate) - strtotime($dojDate)) / (60 * 60 * 24);
		$tillnowpaidbills = floor($paidamount/$daiyamt);
		$tillnowpaidbillsremaining = $paidamount%$daiyamt;
		
		if($tillnowpaidbillsremaining!=0){
			$tillnowpaidbills = $tillnowpaidbills+1;
		}
		
		
		$tillnowdays = $tillnowdays+1;
		if($years>0)
		{
			$tempmont = $years*12;
			$months = $months+$tempmont;
		}
			  
		  if($Chit_value!=500000 && $Month!=40 || $Chit_value!=1000000 && $Month!=40){
		  
			  if($months>=3){
				  
				  $remaingmon = $months-3;
				  $sec_bil = $remaingmon*$D_Second_Sec_Bill;
				 // $tobil1 = $D_First_Sec_Bill+$sec_bil+$days;
				 $tobil1 = $D_First_Sec_Bill+$sec_bil+$days;
				 				 
				  
			  }else{
				  $tobil1 = $tillnowdays;
			  }
			  
		  }else{

			if($months>=2){
				  
				  $remaingmon = $months-2;
				  $sec_bil = $remaingmon*$D_Second_Sec_Bill;
				  $tobil1 = $D_First_Sec_Bill+$sec_bil+$days;
				  //$tobil1 = $D_First_Sec_Bill+$sec_bil;
				  
			  }else{
				  $tobil1 = $tillnowdays;
			  }
			  
		  }	
		  ///////////
		  $totalnoofbills = $tillnowpaidbills;
		  $noofbills = $tobil1;
		  $amount = $daiyamt;
		  $totalamountpaid=$paidamount;
		  $remainingbillamount = ($totalnoofbills*$amount)-$totalamountpaid;
		  $totalnoofbillspaid = $D_Bill;
		  $totalamount ='';
		  $bill ='';
		  $excessamount = $D_Last_Bill_Amt;
		  $date = date('d-m-Y');
		  $billname='';
		  $name1 = $name."-".$userid."-".$appno;
		  
		  echo $totalnoofbills; echo "A"; echo $noofbills;
		  if($totalnoofbills<=$noofbills)
				{
					for($ite = 1;$ite<=$totalnoofbills;$ite++)
					{
						$tempamount = $amount;
						if($remainingbillamount != 0 &&$ite==$totalnoofbills)
						{
							$tempamount = $remainingbillamount;
						}else{
							$tempamount = $amount;
						}
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}
						if($billname!='')
						{
						$billname = $billname.','.$userid.'-'.$appno.'-'.$ite;
						}else{
							$billname = $userid.'-'.$appno.'-'.$ite;
						}
					}
				}else{
					$excessbills = $totalnoofbills-$noofbills;
					
					//echo $noofbills; echo "</br>";
					for($ite = 1;$ite<=$noofbills;$ite++)
					{
						$tempamount = $amount;
						
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}
						if($billname!='')
						{
						$billname = $billname.','.$userid.'-'.$appno.'-'.$ite;
						}else{
							$billname = $userid.'-'.$appno.'-'.$ite;
						}
					}
					
					if($excessamount == 0)
					{
						for($ite =$totalnoofbillspaid;$ite>=$excessbills;$ite--)
						{
							$tempamount = $amount;
							if($remainingbillamount != 0 &&$ite==$noofbills)
							{
								$tempamount = $remainingbillamount;
							}else{
								$tempamount = $amount;
							}
							
							if($paidamount>$totalamount){
						
								$remainingbillamount=$paidamount-$totalamount;
								 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
									 $tempamount = $remainingbillamount;
								 }
							$billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							   $totalamount = $totalamount+$tempamount;
							$bill=$bill.$billtemp;
							}
							if($billname!='')
							{
							$billname = $billname.','.$userid.'-'.$appno.'-'.$ite;
							}else{
								$billname = $userid.'-'.$appno.'-'.$ite;
							}
						}
					}else{
						
						$it = $totalnoofbillspaid;
						
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						$billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$it</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$excessamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							$totalamount = $totalamount+$excessamount;
							$bill=$bill.$billtemp;
						}	
							
							if($billname!='')
							{
							$billname = $billname.','.$userid.'-'.$appno.'-'.$it;
							}else{
								$billname = $userid.'-'.$appno.'-'.$it;
							} 
							
							#echo $tillnowdays; echo "A"; echo $tillnowpaidbills; echo "B";
							
							$temptotal = $totalamountpaid - $totalamount;
							$tempexcess = floor($temptotal/$amount);
							$tempremainingbillamount =$temptotal%$amount;
							$excessbills1 = $totalnoofbillspaid-$tempexcess;
							
							
							 #echo "</br>"; echo $totalamount;  echo "</br>"; echo $tempremainingbillamount;
							 
							$excessamt = $paidamount-$totalamount;
							$excessbills = floor($excessamt/$amount);
							
							$tempexcesbil = $excessamt%$amount;
							
							if($tempexcesbil!=0){
								$excessbills1 = $excessbills1-1;
							} 
							
							if($tempremainingbillamount != 0)
							{
								$excessbills1 = $excessbills1-1;
							}
							
				
														
						for($ite =$totalnoofbillspaid-1;$ite>$excessbills1-1;$ite--)
						{
							
														
							$tempamount = $amount;
							if($tempremainingbillamount != 0 &&$ite==$excessbills1)
							{
								$tempamount = $tempremainingbillamount;
							}else if($ite==$totalnoofbillspaid){
								$tempamount = $excessamount;
								
							}else{
								$tempamount = $amount;
							}
							
							if($paidamount>$totalamount){
						
							$remainingbillamount=$paidamount-$totalamount;
							 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
								 $tempamount = $remainingbillamount;
							 }
							$billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							$totalamount = $totalamount+$tempamount;
							$bill=$bill.$billtemp;
							}
							if($billname!='')
							{
							$billname = $billname.','.$userid.'-'.$appno.'-'.$ite;
							}else{
								$billname = $userid.'-'.$appno.'-'.$ite;
							}
						}
					}
					
				}
	
	#echo $billname; echo "</br>"; echo $totalamount; echo "</br>";
	
	#echo count(explode(',',$billname));
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
						   <AMOUNT>$totalamount</AMOUNT>
						   $bill
						   </ALLLEDGERENTRIES.LIST>
						  <ALLLEDGERENTRIES.LIST>
						  <LEDGERNAME>$accountname _collection</LEDGERNAME>
						  <ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
						  <AMOUNT>-$totalamount</AMOUNT>
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
				curl_setopt($ch, CURLOPT_TIMEOUT, 40); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);
	
	
				$result = curl_exec($ch); 
	
				if (empty($result)) 
				{
					$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
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
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
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
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
							$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
							#echo($result);
							
						}else
						{
							$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
							$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
	
							#echo($result);				
						}
									
									
					}
				} 
					
	 }	 
	 
 }
 
 //// Weekly //////// 
 
  if($payment_type=='Weekly'){
	 $weeklyamt = $chit_fetch['Weekly_Amt'];
	 $W_First_Sec_Amt = $chit_fetch['W_First_Sec_Amt'];
	 $W_Second_Sec_Amt = $chit_fetch['W_Second_Sec_Amt'];
	 $W_Bills = $chit_fetch['W_Bills'];
	 $W_Last_Bill_Amt = $chit_fetch['W_Last_Bill_Amt'];
	 $Month = $chit_fetch['Month'];
	 $Chit_value = $chit_fetch['Chit_value'];
	 $Customer_Payment = $chit_fetch['Customer_Payment'];
	 
	 $curdate = date('m/d/Y');
	 $arr = explode('-', $dateofjoining);
	 $dojDate = $arr[1].'/'.$arr[0].'/'.$arr[2];
	 $diff = abs(strtotime($curdate) - strtotime($dojDate));
	 $years = floor($diff / (365*60*60*24));
	 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	 if($paidamount>0){
		 		 
		#echo $tillnowdays = (strtotime($curdate) - strtotime($dojDate)) / (60 * 60 * 24);
		
		if($years>0)
				{
					$tempmont = $years*12;
					$months = $months+$tempmont;
				}
				
				$noofbills= 0;
				if($months>0)
				{
					$noofbills = $months*4;
				}
				$days1=0;
				if($days>0)
				{
					$days1 = floor($days/7);
				}
				$noofbills = $noofbills +$days1;
		
		///////////
		
		$amount2 = $W_First_Sec_Amt;
		$amount = $W_Second_Sec_Amt;
		$totalamount ='';
		$bill ='';
		$date = date('d-m-Y');
		$billname='';
		$name1 = $name."-".$userid."-".$appno;
		  
		if($noofbills>=8){
			
			$amt = $W_First_Sec_Amt*8;
			$remainingbill = $noofbills-8;
			$amt1 = $remainingbill*$W_Second_Sec_Amt; //echo "PAY";
			$tillnowrequiredpay = $amt+$amt1; // echo "PAID"; echo $paidamount;
			
				
			if($tillnowrequiredpay>=$paidamount){
				$remainingbillamount = $tillnowrequiredpay- $paidamount;
				
				#$excessamt = $paidamount-$tillnowrequiredpay;
				#$excessbills = floor($remainingbillamount/$amount);
				
				for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=8)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						
						#echo $totalamount; echo "AAa0"; echo $paidamount; echo "</br>";
						#echo $paidamount; echo "</br>"; //echo "TEST"; echo $totalamount; 
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						 
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount; echo "</br>";
						   $bill=$bill.$billtemp;
					}else{
						
						  /* echo $remainingbillamount=$paidamount-$totalamount; echo "DFDFDF";
							if($remainingbillamount!=0)
							$tempamount = $remainingbillamount;*/
						
					}
					}
			
			}else{
				$excessamt = $paidamount-$tillnowrequiredpay; //echo "EXCESS";
				$excessbills = floor($excessamt/$amount);
				#$excessbills = $totalnoofbills-$noofbills;
				
					
					for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=8)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						if($paidamount>$totalamount){
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}else{
						
						$remainingbillamount=$paidamount-$totalamount;
							if($remainingbillamount!=0)
							$tempamount = $remainingbillamount;
						
					}
					}
					
					if($excessbills != 0)
					{
						
						$totalnoofbillspaid = $W_Bills; 
						for($ite =$totalnoofbillspaid;$ite>=$excessbills;$ite--)
						{
							$tempamount = $amount;
							if($paidamount>$totalamount){						
							  $billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							  $totalamount = $totalamount+$tempamount;
							  $bill=$bill.$billtemp;
							}
						}
					}
			}
		}else{
			$tillnowrequiredpay = $noofbills*$W_First_Sec_Amt;
			
			#echo $noofbills; echo "LESS THAN 8 BILLS";
				
			if($tillnowrequiredpay>=$paidamount){
				$remainingbillamount = $tillnowrequiredpay- $paidamount;
				for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=8)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						
						#echo $paidamount; echo "ASDASD"; echo $totalamount; echo "</br>";
						
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						 
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount; echo "</br>";
						   $bill=$bill.$billtemp;
					}
					}
			
			}else{
				$excessamt = $paidamount-$tillnowrequiredpay;
				$excessbills = floor($excessamt/$amount);
				#$excessbills = $totalnoofbills-$noofbills;
				
					
					for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=8)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}
					}
					
					if($excessbills != 0)
					{
						
						$totalnoofbillspaid = $W_Bills;
						for($ite =$totalnoofbillspaid;$ite>=$excessbills;$ite--)
						{
							$tempamount = $amount;
							
							if($paidamount>$totalamount){
						
							 $remainingbillamount=$paidamount-$totalamount;
							 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
								 $tempamount = $remainingbillamount;
							 }
							$billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							   $totalamount = $totalamount+$tempamount;
							$bill=$bill.$billtemp;
							}
						}
					}
			}

			
		}
		
		#echo $totalamount; echo "A"; echo $name; echo "B"; 
		
		 
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
						   <AMOUNT>$totalamount</AMOUNT>
						   $bill
						   </ALLLEDGERENTRIES.LIST>
						  <ALLLEDGERENTRIES.LIST>
						  <LEDGERNAME>$accountname _collection</LEDGERNAME>
						  <ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
						  <AMOUNT>-$totalamount</AMOUNT>
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
				curl_setopt($ch, CURLOPT_TIMEOUT, 40); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);
	
	
				$result = curl_exec($ch); 
				if (empty($result)) 
				{
					$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
							$result1 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
							
	
					die(curl_error($ch));
					curl_close($ch); 
				}else 
				{
					$info = curl_getinfo($ch);
					curl_close($ch); 
					if (empty($info['http_code'])) 
					{
						$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
							$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
							
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
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
							$result3 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
							#echo($result);
							
						}else
						{
							$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
							$result4 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
	
							#echo($result);				
						}
									
									
					}
				} 
	 }
  }	
  
  
   //// MONTHLy //////// 
 
  if($payment_type=='Monthly'){
	  
	  $monthlyamt = $chit_fetch['Monthly_Amt'];
	 $M_First_Sec_Amt = $chit_fetch['M_First_Sec_Amt'];
	 $M_Second_Sec_Amt = $chit_fetch['M_Second_Sec_Amt'];
	 $M_Bills = $chit_fetch['M_Bills'];
	 $M_Last_Bill_Amt = $chit_fetch['M_Last_Bill_Amt'];
	 $Month = $chit_fetch['Month'];
	 $Chit_value = $chit_fetch['Chit_value'];
	 $Customer_Payment = $chit_fetch['Customer_Payment'];
	 
	 $curdate = date('m/d/Y');
	 $arr = explode('-', $dateofjoining);
	 $dojDate = $arr[1].'/'.$arr[0].'/'.$arr[2];
	 $diff = abs(strtotime($curdate) - strtotime($dojDate));
	 $years = floor($diff / (365*60*60*24));
	 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	 if($paidamount>0){
		 		 
		#echo $tillnowdays = (strtotime($curdate) - strtotime($dojDate)) / (60 * 60 * 24);
		
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
				$noofbills = $noofbills;
				
				///////////
		
		$amount2 = $M_First_Sec_Amt;
		$amount = $M_Second_Sec_Amt;
		$totalamount ='';
		$bill ='';
		$date = date('d-m-Y');
		$billname='';
		$name1 = $name."-".$userid."-".$appno;
		  
		if($noofbills>=2){
			
			$amt = $M_First_Sec_Amt*2;
			$remainingbill = $noofbills-2;
			$amt1 = $remainingbill*$M_Second_Sec_Amt; //echo "PAY";
			$tillnowrequiredpay = $amt+$amt1; // echo "PAID"; echo $paidamount;
			
				
			if($tillnowrequiredpay>=$paidamount){
				$remainingbillamount = $tillnowrequiredpay- $paidamount;
				
				#$excessamt = $paidamount-$tillnowrequiredpay;
				#$excessbills = floor($remainingbillamount/$amount);
				
				for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=2)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						
						#echo $totalamount; echo "AAa0"; echo $paidamount; echo "</br>";
						#echo $paidamount; echo "</br>"; //echo "TEST"; echo $totalamount; 
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						 
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount; 
						   $bill=$bill.$billtemp;
					}else{
						
						  
						
					}
					}
			
			}else{
				$excessamt = $paidamount-$tillnowrequiredpay; //echo "EXCESS";
				$excessbills = floor($excessamt/$amount);
				
								
				if($amount>$excessamt){
					$noofbills = $noofbills +1;
				}
					
					for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=2)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						if($paidamount>$totalamount){
							
						$remainingbillamount=$paidamount-$totalamount;
						if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							$tempamount = $remainingbillamount;
						}
						 
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}else{
						
						$remainingbillamount=$paidamount-$totalamount;
							if($remainingbillamount!=0)
							$tempamount = $remainingbillamount;
						
					}
					}
					
					if($excessbills != 0)
					{
						
						$totalnoofbillspaid = $M_Bills;
						for($ite =$totalnoofbillspaid;$ite>=$excessbills;$ite--)
						{
							$tempamount = $amount;
							if($paidamount>$totalamount){	

							$remainingbillamount=$paidamount-$totalamount;
							if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
								$tempamount = $remainingbillamount;
							}
							
							  $billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							  $totalamount = $totalamount+$tempamount;
							  $bill=$bill.$billtemp;
							}
						}
					}
			}
		}else{
			$tillnowrequiredpay = $noofbills*$M_First_Sec_Amt;
			
			#echo $noofbills; echo "LESS THAN 2 BILLS";
				
			if($tillnowrequiredpay>=$paidamount){
				$remainingbillamount = $tillnowrequiredpay- $paidamount;
				for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=2)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						
						#echo $paidamount; echo "ASDASD"; echo $totalamount; echo "</br>";
						
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						 
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount; // echo "</br>";
						   $bill=$bill.$billtemp;
					}
					}
			
			}else{
				
				$amount = $M_First_Sec_Amt; 
				$excessamt = $paidamount-$tillnowrequiredpay;
				$excessbills = floor($excessamt/$amount);
				
				if($amount>$excessamt){
					$noofbills = $noofbills +1;
				}
				
				
					for($ite = 1;$ite<=$noofbills;$ite++)
					{
						if($ite<=2)
						{
							$tempamount = $amount2;
						}else{
							$tempamount = $amount;
						}
						if($paidamount>$totalamount){
						
						$remainingbillamount=$paidamount-$totalamount;
						 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
							 $tempamount = $remainingbillamount;
						 }
						$billtemp = "<BILLALLOCATIONS.LIST>
							<NAME>$userid-$appno-$ite</NAME>
							<BILLTYPE>Agst Ref</BILLTYPE>
							<AMOUNT>$tempamount</AMOUNT>
						   </BILLALLOCATIONS.LIST>";
						   $totalamount = $totalamount+$tempamount;
						$bill=$bill.$billtemp;
						}
					}
					
					if($excessbills != 0)
					{
						
						$totalnoofbillspaid = $M_Bills;
						for($ite =$totalnoofbillspaid;$ite>=$excessbills;$ite--)
						{
							$tempamount = $amount;
							
							if($paidamount>$totalamount){
						
							 $remainingbillamount=$paidamount-$totalamount;
							 if($remainingbillamount!=0 && $tempamount>$remainingbillamount){
								 $tempamount = $remainingbillamount;
							 }
							$billtemp = "<BILLALLOCATIONS.LIST>
								<NAME>$userid-$appno-$ite</NAME>
								<BILLTYPE>Agst Ref</BILLTYPE>
								<AMOUNT>$tempamount</AMOUNT>
							   </BILLALLOCATIONS.LIST>";
							   $totalamount = $totalamount+$tempamount;
							$bill=$bill.$billtemp;
							}
						}
					}
			}

			
		}
		
		#echo $totalamount; echo "A"; echo $name; echo "B"; 
		
		 
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
						   <AMOUNT>$totalamount</AMOUNT>
						   $bill
						   </ALLLEDGERENTRIES.LIST>
						  <ALLLEDGERENTRIES.LIST>
						  <LEDGERNAME>$accountname _collection</LEDGERNAME>
						  <ISDEEMEDPOSITIVE>Yes</ISDEEMEDPOSITIVE>
						  <AMOUNT>-$totalamount</AMOUNT>
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
				curl_setopt($ch, CURLOPT_TIMEOUT, 40); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost); 
				curl_setopt($ch, CURLOPT_POST, 1);
	
	
				echo $result = curl_exec($ch); 
				if (empty($result)) 
				{
					$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
							$result1 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
							
	
					die(curl_error($ch));
					curl_close($ch); 
				}else 
				{
					$info = curl_getinfo($ch);
					curl_close($ch); 
					if (empty($info['http_code'])) 
					{
						$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
							$result2 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
							
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
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','Yes','$accountname','$date','0','0','Active','$empid','$cid')";
							$result3 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
							#echo($result);
							
						}else
						{
							$sql = "INSERT INTO `tbl_receipt_transaction`
							(`Customer_Name`, `Bill_Name`, `Amount`,
							`Total_Amount`, `Date`, `Is_Posted`, `Created_By`,`Created_On`,`Updated_By`, `Updated_On`,`Status`,`Emp_Id`,`Cust_Id`) 
							VALUES ('$name','$billname','$amount','$totalamount',
							'$date','No','$accountname','$date','0','0','Active','$empid','$cid')";
							$result4 = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
	
	
							#echo($result);				
						}
									
									
					}
				} 
	 }
	
  }
?>

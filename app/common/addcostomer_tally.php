<?php 
//addcostomer_tally.php
//Add Customers Tally in

include 'tallyurl.php';

/* $name
$userid
$appno */


$post1 = "<ENVELOPE>
					<HEADER>
						<TALLYREQUEST>Import Data</TALLYREQUEST>
					</HEADER>
					<BODY>
						<IMPORTDATA>
							<REQUESTDESC>
								<REPORTNAME>All Masters</REPORTNAME>
								<STATICVARIABLES>
									<SVCURRENTCOMPANY>$company</SVCURRENTCOMPANY>
								</STATICVARIABLES>
							</REQUESTDESC>
							<REQUESTDATA>
								<TALLYMESSAGE xmlns:UDF='TallyUDF'>";
		$post3 = "</TALLYMESSAGE>
			</REQUESTDATA>
		</IMPORTDATA>
	</BODY>
</ENVELOPE>";	

$post2 = "";
	$posttemp ="<GROUP NAME='$name-$userid' ACTION='Create'>
						<NAME.LIST>
							<NAME>$name-$userid</NAME>
						</NAME.LIST>
						<PARENT>Sundry Debtors</PARENT>
				</GROUP>
				<LEDGER NAME='$name-$userid-$appno' ACTION='Create'>
						<MAILINGNAME.LIST>
							<MAILINGNAME>$name</MAILINGNAME>
						</MAILINGNAME.LIST> 
						<NAME.LIST>
							<NAME>$name-$userid-$appno</NAME>
						</NAME.LIST>
						<PARENT>$name-$userid</PARENT>
						<ISBILLWISEON>Yes</ISBILLWISEON> 
				</LEDGER>
				<LEDGER NAME='$name-$userid-$appno-loan' ACTION='Create'>
						<MAILINGNAME.LIST>
							<MAILINGNAME>$name</MAILINGNAME>
						</MAILINGNAME.LIST> 
						<NAME.LIST>
							<NAME>$name-$userid-$appno-loan</NAME>
						</NAME.LIST>
						<PARENT>$name-$userid</PARENT>
						<ISBILLWISEON>Yes</ISBILLWISEON> 
				</LEDGER>"
				;
$post2 = $post2.$posttemp;
$XPost = $post1.$post2.$post3;
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 40); 
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
			/// Update to ERP Customer Table 
			
			if($cusid!=''){
				$sqlupdate = mysqli_query($con,"update tbl_customer set Customer_Id='$userid', Application_No='$appno', Tally_Update ='Yes' where Id=$cusid");
				
				$select2=mysqli_query($con,"SELECT Emp_Id FROM `tbl_executive_mapping` where Cust_Id='$cusid'");
		
				if(mysqli_fetch_array($select2)==0 && $loginemp_id!='')
				{
					$createdon=date("d-m-Y H:i:s A");
					
					$sql_map = mysqli_query($con,"INSERT INTO tbl_executive_mapping(Emp_Id, Cust_Id,Created_On, Created_By, Updated_On, 	Updated_By, Status) VALUES ('$loginemp_id','$cusid','$createdon','Admin','0','0','Active')"); 
				}
			}		
			
		}
	}


?>

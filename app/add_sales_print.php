<?php
include_once 'srdb.php';  // Use session variable on this page. This function must put on the top of page.
if(isset($_GET['inv_no']))
	{
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Print</title>
<style type="text/css" media="print">
.hide{display:none}

tr.noBorder td {
  border: 0;
}
</style>
<link rel="shortcut icon" href="images/favicon.ico">
<script type="text/javascript">
window.onload=function(){self.print();setTimeout("window.close()", 10);}

    window.onfocus = function() { window.close(); }
	 $(function(){ 
   setTimeout(function(){
      $('form').print();
    },100);
});
</script>

<style type="text/css">
<!--
.style1 {font-size: 10px}
-->
.ps{
	padding-top:10px;
}
tr.border_bottom td {
  border-bottom:1pt solid black;
}
.p{
	padding-top:0px;
}
tr.border_bottom td {
  border-bottom:1pt solid black;
}
.pp{
	padding-top:0px;
}
tr.border_top td {
  border-top:1pt solid black;
}
p.hidden {border-style: hidden;}
.tdone{
	border:0px solid white; 
}
.td1{
border: 1px solid black;
border-color:black;
}
table{
border-color:black;
}
.bt{
border-right: 0px  ;
}
.btt{
border-top: 0px  ;
}
.bb
{ 
	border-bottom:0pt; 
}
.footer{
	font-weight:bold;
}
</style>
</head>
<body onload="self.print()" onfocus="window.close()">
<?php
function convert_digit_to_words($no)  
	{   
	
	//creating array  of word for each digit
	 $words = array('0'=> 'Zero' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fourteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Forty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
	 //$words = array('0'=> '0' ,'1'=> '1' ,'2'=> '2' ,'3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','30' => '30','40' => '40','50' => '50','60' => '60','70' => '70','80' => '80','90' => '90','100' => '100','1000' => '1000','100000' => '100000','10000000' => '10000000');
	 
	 
	 //for decimal number taking decimal part
	 
	$cash=(int)$no;  //take number wihout decimal
	$decpart = $no - $cash; //get decimal part of number
	
	$decpart=sprintf("%01.2f",$decpart); //take only two digit after decimal
	
	$decpart1=substr($decpart,2,1); //take first digit after decimal
	$decpart2=substr($decpart,3,1);   //take second digit after decimal  
	
	$decimalstr='';
	
	//if given no. is decimal than  preparing string for decimal digit's word
	
	if($decpart>0)
	{
	 $decimalstr.="".$numbers[$decpart1]." ".$numbers[$decpart2];
	}
	 
	    if($no == 0)
	        return ' ';
	    else {
	    $novalue='';
	    $highno=$no;
	    $remainno=0;
	    $value=100;
	    $value1=1000;       
	            while($no>=100)    {
	                if(($value <= $no) &&($no  < $value1))    {
	                $novalue=$words["$value"];
	                $highno = (int)($no/$value);
	                $remainno = $no % $value;
	                break;
	                }
	                $value= $value1;
	                $value1 = $value * 100;
	            }       
	          if(array_key_exists("$highno",$words))  //check if $high value is in $words array
	              return $words["$highno"]." ".$novalue." ".convert_digit_to_words($remainno).$decimalstr;  //recursion
	          else {
	             $unit=$highno%10;
	             $ten =(int)($highno/10)*10;
	             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".convert_digit_to_words($remainno
	             ).$decimalstr; //recursion
	           }
	    }
	}
?>
  
  
<?php
			$sid=$_GET['sid'];
			$line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid='$sid' ");

			$vbvbq=$line->customer_id; 
			$vbvb=$line->billnumber; 
			$vbv=$line->mode ; 

			$porder=$line->porder ; 
			$rc=$line->rc ; 
			$plc=$line->plc ; 
			$sa1=$line->sa1 ; 
			$sa2=$line->sa2 ; 
			$sa3=$line->sa3 ; 
			$sa4=$line->sa4; 
			$tax=$line->tax ; 
			$description=$line->description ; 
			$tax_dis=$line->tax_dis ; 

			$ddate1 = $line->date;
			$pdate = $line->pdate;

			$selected_date=strtotime($ddate1);
			$selected_date=date("d-m-Y",$selected_date);
			$pdatee=strtotime($pdate);
			$pdatee=date("d-m-Y",$pdatee);

			$qry3 =mysql_query("select * from customer_details where customer_name='$vbvbq'");
			$row3 = mysql_fetch_array($qry3);
			$qry37 =mysql_query("select * from bill_details where id='1'");
			$row3787 = mysql_fetch_array($qry37);
 ?> 
<table width="100%" border="0" cellspacing="0" class="bb" cellpadding="0">
		<tr>
			<td width="10%" align="center" rowspan='2'><img src="logo/logo.png" alt="Logo" height="70px" width="90%"></td>
			<td width="90%" align="center">&nbsp;<font size="7px"><strong>OM SALES CORPORATION</font></td></strong>
		</tr>
		<tr>
			<td width="90%" align="center">&nbsp;<font size="3px"><strong>	Personnel Protective & Road Safety Equipments</font></td></strong>
		</tr>
</table>
</br>
<table width="100%" border="1" cellspacing="0" class="bb" cellpadding="0">
		<tr>
			<td width="100%" align="center">&nbsp;<font size="5.0"><strong>	Tax Invoice</font></td></strong>
		</tr>
</table>
		
<table width="100%" border="1" cellspacing="0" class="bb" cellpadding="0">
<tr><td width="50%" colspan="3">&nbsp;Invoice No&nbsp;&nbsp;:&nbsp;<?php echo $vbvb; ?>
</td>

<td width="50%">&nbsp;Purchase Order :<?php echo  $porder; ?></td>
</tr>
<tr><td width="50%" colspan="3">&nbsp;Invoice Date&nbsp;:<?php echo  $selected_date;?>
</td><td width="50%">&nbsp;Purchase Order Date:<?php echo  $pdatee; ?></td>
</tr>
<tr><td width="40%" colspan="2">&nbsp;Reverse Charge (Y/N):&nbsp;<?php echo $rc; ?></td>
<td width="10%">&nbsp;
</td>
<td width="50%">&nbsp;Date of Supply:&nbsp;<?php echo  $selected_date;?></td>
</tr>

<tr><td width="30%">&nbsp;<font align="left">State:&nbsp;<?php echo "Tamilnadu";?>
</td>
<td width="10%">&nbsp;Code
</td>
<td width="10%">&nbsp;<?php echo  "641024";?>
</td>
 <td width="50%">&nbsp;Place of Supply:&nbsp;<?php echo $plc;?></td>
</tr>
<tr>
<td COLSPAN="4" width="100%">&nbsp;</td>
</tr>

</table>
		

<table width="100%" border="1" cellspacing="0" class="bb" cellpadding="0">
<tr>
 <?php 
		$qry3 =mysql_query("select * from customer_details where customer_name='$vbvbq'");
		$row3 = mysql_fetch_array($qry3);
 ?> 
 </tr>

<?php if($sa1 == NULL) {?>

 
<tr class="btt">
<td align="center" width="50%" colspan="3"><b>BILL TO PARTY</b></td>
<td align="center" width="50%" colspan="3"><b>SHIP TO PARTY</b></td>
</tr>

<tr>
<td align="" width="50%" colspan="3">&nbsp;<b>Name:&nbsp;<?php echo $row3['customer_name']; ?></b></td>
<td align="" width="50%" colspan="3">&nbsp;<b>Name:&nbsp;<?php echo $row3['customer_name']; ?></b></td>
</tr>


<tr >
<td   align="" width="50%" colspan="3">&nbsp;Address:&nbsp;<?php echo $row3['customer_address'];?>&nbsp;<?php echo $row3['address2'];  ?>&nbsp;<?php echo $row3['address3'];  ?>-<?php echo $row3['pin'];  ?>&nbsp;</br><br></td>
<td   align="" width="50%" colspan="3">&nbsp;Address:&nbsp;<?php echo $row3['customer_address'];?>&nbsp;<?php echo $row3['address2'];  ?>&nbsp;<?php echo $row3['address3'];  ?>-<?php echo $row3['pin'];  ?>&nbsp;</br><br></td>
</tr>


<tr>
<td align="" width="50%" colspan="3">&nbsp;GSTIN: <?php echo $row3['gst']; ?></td>
<td align="" width="50%" colspan="3">&nbsp;GSTIN: <?php echo $row3['gst']; ?></td>
</tr>

<tr>
<td align="" width="30%">&nbsp;State:&nbsp;<?php echo $row3['state']; ?></td> <td align="" width="10%">&nbsp;Code </td> <td align="" width="10%">&nbsp;<?php echo $row3['code'];?></td>
<td align="" width="30%">&nbsp;State:&nbsp;<?php echo $row3['state'];?></td> <td align="" width="10%">&nbsp;Code </td> <td align="" width="10%">&nbsp;<?php echo  $row3['code'];?></td>
</tr><tr>
<td align="" width="1000%" colspan="6">&nbsp;</td>
</tr>
		<?php } else{ ?>
		<tr>
<td align="center" width="50%" colspan="3"><b>BILL TO PARTY</b></td>
<td align="center" width="50%" colspan="3"><b>SHIP TO PARTY</b></td>
</tr>

<tr>
<td align="" width="50%" colspan="3">&nbsp;<b>Name:&nbsp;<?php echo $row3['customer_name']; ?></b></td>
<td align="" width="50%" colspan="3">&nbsp;<b>Name:&nbsp;<?php echo $row3['customer_name']; ?></b></td>
</tr>


<tr >
<td   align="" width="50%" colspan="3">&nbsp;Address:&nbsp;<?php echo $row3['customer_address'];?>&nbsp;<?php echo $row3['address2'];  ?>&nbsp;<?php echo $row3['address2'];  ?>&nbsp;</br><br></td>
<td   align="" width="50%" colspan="3">&nbsp;Address:&nbsp;<?php echo $sa1;?>&nbsp;<?php echo $sa2;  ?> &nbsp;</br><br></td>
</tr>


<tr>
<td align="" width="50%" colspan="3">&nbsp;GSTIN: <?php echo $row3['gst']; ?></td>
<td align="" width="50%" colspan="3">&nbsp;GSTIN: <?php echo $row3['gst']; ?></td>
</tr>

<tr>
<td align="" width="30%">&nbsp;State:&nbsp;<?php echo $row3['state']; ?></td> <td align="" width="10%">&nbsp;Code </td> <td align="" width="10%">&nbsp;<?php echo $row3['code'];?></td>
<td align="" width="30%">&nbsp;State:&nbsp;<?php echo $sa3;?></td> <td align="" width="10%">&nbsp;Code </td> <td align="" width="10%">&nbsp;<?php echo  $sa4;?></td>
		</tr>
		<tr>
<td align="" width="100%" colspan="6">&nbsp;</td>
</tr>
		<?php }?>
</table>

     
	<?php 
		 $db->query("SELECT * FROM stock_sales where transactionid='$sid'");
		 while ($line37 = $db->fetchNextObject()) {
 $sname = $line37->stock_name;
  $qty = $line37->quantity; $tqty = 0; $po = ""; $cqty = 0; $ttqty = 0;
 $qry301 =mysql_query("select sum(quantity) from stock_entries where stock_name='$sname' and stock_supplier_name='$ccid'");
 $row301 = mysql_fetch_array($qry301);
 $pqty = $row301[0];
 $qry3012 =mysql_query("select sum(quantity) from stock_sales where stock_name='$sname' and customer_id='$ccid'");
 $row3012 = mysql_fetch_array($qry3012);
 $sqty = $row3012[0];
 $ccqty = $sqty - $qty;
 $ssqty = $sqty;
 $cqty = abs($ccqty); 
 $qry303 =mysql_query("select * from stock_entries where stock_name='$sname' and stock_supplier_name='$ccid'");
 while($row303 = mysql_fetch_array($qry303))
 {
	 $aqty = $row303['quantity']; 
	 $ppo = $row303['billnumber'];
	 $tqty = $tqty + $aqty; 
	 $ttqty = $ttqty + $aqty;
	 if($cqty < $ttqty) {
		 if(($ssqty != 0)) {
		 $po = $po.",".$ppo;   
	 } } $ssqty = $sqty - $aqty;
 }
   }
 ?> 
 <table  cellpadding="3" border="1" rules="cols" cellspacing="0" width="100%" >
	<tr align="center" class="border_bottom">
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">S No </th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Product Description</th>
		<th  rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">HSN Code</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">UOM</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Qty</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Rate</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Amount</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Dist</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Taxable value</th>
		<th colspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">CGST</th>
		<th colspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">SGST</th>
		<th rowspan="2" bgcolor="#CCCCCC"><font face="Times New Roman" size="2">Total</th>
    </tr>
		  
		  
		  <tr class="border_bottom">
		  
            
            <th  class="p" bgcolor="#CCCCCC"><font face="Times New Roman" size="1">Rate</th>
            <th class="p"  bgcolor="#CCCCCC"><font face="Times New Roman" size="1">Amt</th>
         <th  class="p" bgcolor="#CCCCCC"><font face="Times New Roman" size="1">Rate</th>
            <th  class="p"  bgcolor="#CCCCCC"><font face="Times New Roman" size="1">Amt</th>
		 </tr>
		 
<?php $sno = 0;
		  $i=1; $sgs=0;
		 $db->query("SELECT * FROM stock_sales where transactionid='$sid'");
		 while ($line3 = $db->fetchNextObject()) {
 $rtr = $line3->discount;
 $sname = $line3->stock_name;
  $rtr3 = $line3->dis_amount;
$rtt = $line3->tax_dis; $sno++;
 $qry32 =mysql_query("select * from stock_details where stock_name='$sname'");
 $row33 = mysql_fetch_array($qry32); ?>
     
 <tr style="font-weight:bold"><font face="Times New Roman" size="1">
            <td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $sno; ?></font></td>
            <td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->stock_name; ?></font></td>
            <td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->hsn; ?></font></td>
            <td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->uom; ?></font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo round($line3->quantity,0); ?>&nbsp;</font></td>
            <td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo number_format(ceil($line3->selling_price*100)/100,2); ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->tott; ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->diss; ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->tott; ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->cgst ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->cgsta ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line->sgst; ?>&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="1"><?php echo $line3->cgsta; ?>&nbsp;</font></td>
			
			<td class="td1" align="right"><font face="Times New Roman" size="1"><?php echo $line3->amount; ?>&nbsp;</font></td>
			
          </tr>
		  
		  <?php 
		  
	$i++;	
		$subtotal=$line3->subtotal;  
	$grand_total=$line3->grand_total;  
	$tranamt=$line3->tranamt;  
	$description=$line3->description;  
					$tott1= $tott1 + $line3->tott; 
					$quantity1= $quantity1 + $line3->quantity; 
					$diss= $diss + $line3->diss; 

			$cgsta1= $cgsta1 + $line3->cgsta; 
		$sgsta1= $sgsta1 + $line3->sgsta; 
		
		$tax =$cgsta1 + $sgsta1; 
	$tqty=$line3->tqty;  
	$payment=$line3->payment;
	$balance=$line3->balance;
	$tott=$line3->tott;
	$date=$line->due;
        $discount= $line3->dis_amount;
		 $customer1= $line3->customer_id;
		 $desc= $line3->description;
	
} $ff = 8;
		  while($i < $ff) { ?>
			  <tr class="row">
		<td class="td1">&nbsp;</td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
		<td  class="td1"></td>
	</tr>
	<?php $i++; } ?>      
		  

		   
<tr style="font-weight:bold"  class="border_top"><font face="Times New Roman" size="1">
		      <td class="" align="left" colspan="2"><font face="Times New Roman" size="1"><b>E&OE </b></font></td>
		      <td class="td1" align="center" colspan="2"><font face="Times New Roman" size="2"><b>Total</b></font></td>

			<td class="td1" align="center"><font face="Times New Roman" size="2"><?php echo $quantity1; ?>&nbsp;</font></td>
            <td class="td1" align="center" ><font face="Times New Roman" size="2">&nbsp;</font></td>
			<td class="td1" align="center"><font face="Times New Roman" size="2"><?php echo number_format((float)$tott1, 2, '.', ''); ?>&nbsp;</font></td>
			<td class="td1" align="center" ><font face="Times New Roman" size="2"><?php echo number_format((float)$diss, 2, '.', ''); ?>&nbsp;</font></td>
			<td class="td1" align="center" ><font face="Times New Roman" size="2"><?php echo number_format((float)$tott1, 2, '.', ''); ?>&nbsp;</font></td>
			<td class="td1" align="right"><font face="Times New Roman" size="1">&nbsp;</font></td>
			<td class="td1" align="right"><font face="Times New Roman" size="2"><?php echo number_format((float)$sgsta1, 2, '.', '') ; ?>&nbsp;</font></td>		
			<td class="td1" align="right"><font face="Times New Roman" size="1">&nbsp;</font></td>
			<td class="td1" align="right"><font face="Times New Roman" size="2"><?php echo number_format((float)$cgsta1, 2, '.', ''); ?>&nbsp;</font></td>
			<td class="td1" align="right" ><font face="Times New Roman" size="2"><b><?php echo number_format((float)$subtotal, 2, '.', ''); ?></b>&nbsp;</font></td>
			
          </tr> </table>

<table width="67%" style="height:150px;" border="1" class="bt bb" cellspacing="0" cellpadding="2" align="left">
<tr class="btt" >
					
					<td colspan="2"  width="67%"><font face="Times New Roman" size="1.5" align="left"></font>
						<?php 
		$ss=number_format(round((float)($subtotal*100)/100), 2, '.', '');
		
	?>
						<font face="Times New Roman" size="2">&nbsp;&nbsp;
						<?php echo convert_digit_to_words($ss); echo " Rupees Only."; ?></font>
					</td></tr>
					<tr>
					<td colspan="2"  height="125px"><font face="Times New Roman" size="3.0">Terms & Conditions</font>
					<font face="Times New Roman" size="2.5"><br>
					1.Make all cheque payable to OM SALES CORPORATION
					<br>2.Please include the invoice number on your cheque
					<br>3.Goods Sold Will Not Be Taken Back
					<br>4.Disputes Are Subject to Coimbatore Jurisdiction	
					<br>5.Our Risk Responsibility Ceases After Goods Leave Our Godown </font>
					</td></tr>
					
					<?php
					$qry22 =mysql_query("select * from mybank where bname='$description'");
                    $row22 = mysql_fetch_array($qry22);
					 $bname=$row22['bname'];
					 $bbranch=$row22['bbranch'];
					 $bac=$row22['bac'];
					 $bifsc=$row22['bifsc'];
					 ?>
					<?php $sbb= round(($subtotal*100)/100,0);?></font>
					
					</table>
					
					<table width="33%" style="height:150px;" border="1" cellspacing="0" class="bb"  align="right">
					<tr class=" btt">

					
						<td WIDTH="60%"><font face="Times New Roman" size="2.0" align="left">Total Amount before Tax</font>
						<td  WIDTH="40%" align="right"><font face="Times New Roman" size="3"><?php echo number_format((float)$tott1, 2, '.', ''); ?>&nbsp;
					</td></tr>
					<tr>

					
						<td   ><font face="Times New Roman" size="2.0" align="left">Add CGST</font>
						<td  align="right"><font face="Times New Roman" size="3"><?php echo number_format((float)$cgsta1, 2, '.', ''); ?>&nbsp;
					</td></tr>
					<tr>

					
						<td   ><font face="Times New Roman" size="2.0" align="left">Add SGST</font>
						<td  align="right"><font face="Times New Roman" size="3"><?php echo number_format((float)$sgsta1, 2, '.', ''); ?>&nbsp;
					</td></tr>
					<tr>

					
						<td  ><font face="Times New Roman" size="2.0" align="left">Total Tax Amount</font>
						<td align="right"><font face="Times New Roman" size="3"><?php echo number_format((float)$tax, 2, '.', ''); ?>&nbsp;
					</td></tr>
					<tr>

					
						<td  ><font face="Times New Roman" size="2.0" align="left">Round Off</font>
						<td  align="right"><font face="Times New Roman" size="3"><?php  $r=$sbb-($tott1+$tax); echo number_format((float)$r, 2, '.', '') ?>&nbsp;
					</td></tr>
					<tr>

					
						<td  ><font face="Times New Roman" size="2.0" align="left">Transport Charge</font>
						<td  align="right"><font face="Times New Roman" size="3"><?php   $trr= number_format((float)$tranamt, 2, '.', ''); echo $trr; ?>&nbsp;
					</td></tr>
					
					<tr>

					
						<td ><font face="Times New Roman" size="2.2" align="left">Total Amount after Tax</font>
						<td  align="right"><font face="Times New Roman" size="3"><strong><?php  $subb= $sbb+$trr; echo number_format((float)$subb, 2, '.', '');  ?>&nbsp;</strong>
					</td></tr>
					
					</table>
					
					<table width="100%" border="1" cellspacing="0" class="td1" cellpadding="0">
					<tr>

						<td width="40%"><font size="3.0"  face="Times New Roman" ><b>Bank Details</b></font><br><font size="2.0">
					&nbsp; Bank : <?php echo $bname;?><br>
					&nbsp; Branch : <?php echo $bbranch;?><br>
					&nbsp; Bank A/C : <?php echo $bac;?><br>
					&nbsp; Bank IFSC : <?php echo $bifsc;?></td>
					
						<td style="vertical-align:bottom;" width="27%"><center><font face="Times New Roman" size="1.5">Receiver's Signature with Seal</font></center></td>
					
						<td width="33%" ></td></tr>
</table>
</br>
<table width="100%" size="3.0" border="2" rules="cols" cellspacing="0" class="footer" cellpadding="2">
	<tr>
		<td width="100%" align="center"><font face="Times New Roman" size="2.5">Old No 4/11B, New No 61, G.K Square Street, Kurichi, Sundarapuram, Coimbatore - 641024.</font></td>
	</tr>
	<tr>
		<td width="100%" align="center"><font face="Times New Roman" size="2.5">Contact: +91 97900 11477  Mail : omsalescbe@gmail.com Website : www.Omsalescorporation.com</font></td>
	</tr>
	<tr>
		<td width="100%" align="center"><font face="Times New Roman" size="2.5">GST No. 33AXDPK2243D1Z3 TIN No. 33691805658 CST No.1089057 Dt. 20.01.2018 Area Code 0/9/5</font></td>
	</tr>
</table>
</br>
<center class="bb">Thank You For Your Business!</center>
</body>
</html>
<?php
}

?>

<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';

$sessionuserid=$_SESSION['usersessionid'];

$selectlevel=mysqli_query($con,"select * from tbl_users where Id='$sessionuserid'");
$fetchlevel=mysqli_fetch_array($selectlevel);

$add=$fetchlevel['Role_add'];
$edit=$fetchlevel['Edit'];
$ex_edit = explode(',',$edit);

$delete=$fetchlevel['Delete'];
$ex_del = explode(',',$delete);

$add=$fetchlevel['Role_add'];
$ex_add = explode(',',$add);
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>billing</title>
<meta name="author" content="Manoj">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <script src="js/jquery-1.10.2.js"></script>
	<link rel="shortcut icon" href="images/favicon.ico">

<style>
.content-wrapper
{
	padding: 0px 10px !important;
}
.panel-header, .panel-body {
    border : none !important;
}
.panel-body {
     overflow-x: inherit !important;
	 min-height : 350px;
	 padding: 34px 10px !important;
	  
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
.panel-body
{
	font-size : 16px !important;
	color: #333;
}
ul.dropdown-menu.inner {
    max-height: 159px !important;
}
.panel-heading.lead {
    padding-right: 23px;
    padding-left: 23px;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 7px;
    font-size: 14px;
}
table{
    margin:0 auto;
}
            
</style>
<script type="text/javascript">
window.onload=function(){self.print();setTimeout("window.close()", 10);}

    window.onfocus = function() { window.close(); }
	 $(function(){ 
   setTimeout(function(){
      $('form').print();
    },100);
});
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="self.print()" onfocus="window.close()">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 
<?php 
	$final=$_REQUEST['step'];
	if($final == "suces")
	{
	?>
	  <div class="alert alert_msg alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Tax are Added Successfully.
  </div>

	<?php 
	}
	else if($final == "dbfail")
	{ ?>
		<div class="alert alert_msg alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Error!</strong> Server Error.
	</div>
	<?php }
	else if($final == "fail")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Failed!</strong> This Details Was Already Exist.
	</div>
	<?php }
	else if($final == "delete")
	{ ?>
		<div class="alert alert_msg alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> Tax are Removed Successfully.
	</div>
	<?php } 
	?>
	
      
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table>
         
         <?php  
					 $inv_no=$_REQUEST['inv_no'];
					 
				 $qurydelct_total="SELECT r.Invoice_No,r.Date,c.Name as cus_name,c.Gst_No,c.Id as cid,c.Mobile_No1,c.Address_Line1,c.Address_Line2,c.Address_Line3,c.Address_Line4 FROM `tbl_sales` r left join tbl_customer c on r.Customer_Id=c.Id WHERE r.Invoice_No='$inv_no' AND r.Status='Active'";
					$qury_det_total=mysqli_query($con,$qurydelct_total);
					$fetch_det_total=mysqli_fetch_array($qury_det_total);
					$Date = $fetch_det_total['Date'];	
					$cus_name = $fetch_det_total['cus_name'];	
					$cid = $fetch_det_total['cid'];
					$Gst_No = $fetch_det_total['Gst_No'];
					$Mobile_No1 = $fetch_det_total['Mobile_No1'];
					$Address_Line1 = $fetch_det_total['Address_Line1'];
					$Address_Line2 = $fetch_det_total['Address_Line2'];
					$Address_Line3 = $fetch_det_total['Address_Line3'];	
					$Address_Line4 = $fetch_det_total['Address_Line4'];	 
					$Invoice_No_full = $fetch_det_total['Invoice_No'];
								 ?>
         <tr class="text-center"> 
                <td colspan="9"><b>TAX INVOICE<br>
                SARASWATHY TRADERS</b>
                <p>378,Rangai Gowder Street,Coimbatore-641001<br>
                Phone: 9751103304 | 0422-2392359
                </p>
                <b>GST NO:33AAOFS0019B1ZQ</b>
                </td> 
                
        </tr> 
         <tr> 
            <td  rowspan="2" colspan="6">
                <b><?php echo $cus_name; ?></b> <br>	
                <?php echo $Address_Line1.','.$Address_Line2; ?><br>
                <?php echo $Address_Line3.','.$Address_Line4; ?><br>
                Phone: <?php echo $Mobile_No1; ?><br>
                GSTIN: <?php echo $Gst_No; ?>
            </td> 
            <td><b>Invoice No:</b></td>
            <td colspan="2"><?php echo $Invoice_No_full; ?></td>
        </tr> 
        <tr>
            <td><b>Invoice Date:</b></td>
            <td colspan="2"><?php echo $Date; ?></td>
        </tr>
         <tr> 
             <th>Sno</th> 
             <th>Item </th> 
             <th>HSN</th> 
             <th>Qty</th> 
             <th>Rate</th> 
             <th colspan="2">Amount</th> 
             <th>Discount</th> 
             <th>Total</th> 
        </tr> 
        <?php
                    $qurydelct="select s.*,t.Name as prod_name,t.Hsn_Code from tbl_sales s left join tbl_product t on t.Id=s.Product_Id where s.Status='Active' AND s.Invoice_No='$inv_no'";
					$qury_det=mysqli_query($con,$qurydelct);
					$j=1;
					while($fetch_det=mysqli_fetch_array($qury_det))
					{		
					$product_name = $fetch_det['prod_name'];
					$Quantity = $fetch_det['Quantity'];
					$Hsn_Code = $fetch_det['Hsn_Code'];
					$Rate = $fetch_det['Original_Product_Rate'];
					$Amount = $fetch_det['Amount'];
					$Net_Amount = $fetch_det['Net_Amount'];
					$ori_rt = $fetch_det['Rate'];
					$Product_Discount = $fetch_det['Product_Discount'];
					$sinlge_prod_dis = $Product_Discount/$Quantity;
                    $Discount = $fetch_det['Discount'];  
                    $Cgst = $fetch_det['Cgst'];  
                    $Sgst = $fetch_det['Sgst']; 
                    $gst = $Cgst + $Sgst;
                    $Net_Total = $fetch_det['Net_Total'];  
                    $amount_ori =   $Quantity*$Rate;
                    
                    $tot_amt = $amount_ori - $Product_Discount;
                      ?>
       <tr> 
            <td><?php echo $j; ?></td> 
            <td><?php echo $product_name; ?> </td> 
            <td><?php echo $Hsn_Code; ?></td> 
            <td><?php echo $Quantity; ?></td> 
            <td><?php echo $Rate; ?></td> 
            <td colspan="2"><?php echo $amount_ori; ?></td> 
            <td><?php echo $Product_Discount; ?></td> 
            <td><?php echo $tot_amt; ?></td> 
        </tr> 
         <?php 
         $j++;
         $overal_paid[] = $tot_amt;
         $overal_gst[] = $gst;
					    
					}
         
         
         $sumpend=0;
		for ($i = 0; $i <  count($overal_paid); $i++) {
		$keypend=key($overal_paid);
		$valpend=$overal_paid[$keypend];
		if ($valpend<> ' ') {
			 $amtpend = $valpend ."<br>";											
			$sumpend = $sumpend+$amtpend;
		   }
		   
		 next($overal_paid);
		}	
		
		$sumpend_gst=0;
		for ($i = 0; $i <  count($overal_gst); $i++) {
		$keypend=key($overal_gst);
		$valpend=$overal_gst[$keypend];
		if ($valpend<> ' ') {
			 $amtpend = $valpend ."<br>";											
			$sumpend_gst = $sumpend_gst+$amtpend;
		   }
		   
		 next($overal_gst);
		}	
         ?>
        <tr> 
            <td align="right" colspan="8"><b>Sub Total</b></td> 
            <td><?php echo $sumpend; ?></td> 
        </tr> 
         <tr> 
            <td align="right" colspan="8"><b>Discount</b></td> 
            <td><?php echo $Discount; ?></td> 
        </tr>
         <tr> 
            <td align="right" colspan="8"><b>GST</b></td> 
            <td><?php echo $sumpend_gst; ?></td> 
        </tr>
         
         <tr> 
            <td align="right" colspan="8"><b>Net Amount</b></td> 
            <td><?php echo $sumpend+$sumpend_gst; ?></td> 
        </tr>
        <tr> 
            <td align="right" colspan="8"><b>Round off</b></td> 
            <td>0</td> 
        </tr>
         <tr> 
            <td align="right" colspan="8"><b>Grand Total</b></td> 
            <td><?php echo $Net_Total; ?></td> 
        </tr>
        <tr> 
            <td align="left" colspan="9"><b>Amount Chargeable in Words:</b><br>
            Rupees Sixty Thousand Only
            </td> 
        </tr>
        
        <tr> 
            <td rowspan="2"><b>HSN Code</b></td> 
            <td rowspan="2"><b>Taxable Amount</b> </td>
            <td colspan="2"><b>CGST</b></td>
            <td colspan="2"><b>SGST</b></td>
            <td colspan="2"><b>IGST</b></td>
            <td rowspan="2"><b>Total</b></td>
        </tr>
       <tr> 
            <td><b>TAX %</b></td>
            <td><b>AMT</b></td>
            <td><b>TAX %</b></td>
            <td><b>AMT</b></td>
            <td><b>TAX %</b></td>
            <td><b>AMT</b></td>
        </tr>
        <?php
        $qurygst="select p.Hsn_Code,SUM(s.Original_Product_Rate) as ori_prod_rate,p.Sgst as psgst,p.Cgst as pcgst,SUM(s.Cgst) as cgst_amt,SUM(s.Sgst) as sgst_amt from tbl_sales s left join tbl_product p on p.Id=s.Product_Id where s.Status='Active' AND s.Invoice_No='$inv_no' GROUP BY p.Hsn_Code";
		$qury_dgst=mysqli_query($con,$qurygst);
		$i=1;
		while($fetch_gst=mysqli_fetch_array($qury_dgst))
		{	
        $Hsn_Code = $fetch_gst['Hsn_Code'];
        $ori_prod_rate = $fetch_gst['ori_prod_rate'];
        $psgst = $fetch_gst['psgst'];
        $pcgst = $fetch_gst['pcgst'];
        $cgst_amt = $fetch_gst['cgst_amt'];
        $sgst_amt = $fetch_gst['sgst_amt'];
        
        $gst_amt = $cgst_amt+$sgst_amt;
        ?>
        <tr> 
            <td><?php echo $Hsn_Code; ?></td>
            <td><?php echo $ori_prod_rate; ?></td>
            <td><?php echo $pcgst; ?></td>
            <td><?php echo $cgst_amt; ?></td>
            <td><?php echo $psgst; ?></td>
            <td><?php echo $sgst_amt; ?></td>
             <td>0</td>
             <td>0</td>
            <td><?php echo $gst_amt; ?></td>
        </tr>
         <?php
         
         $i++;
		}
		?>
         <tr> 
         
            <td align="right" colspan="9">For Saraswathi Traders<br>
            Authorized Signatory
            </td> 
        </tr>
         
        
        </table>
               
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
	   </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
<!-- /.content-wrapper -->
<!-- Footer Section-->


<!---  Control Sidebar  Section ->
<?php #include 'controlsidebar.php'; ?>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
			"scrollX": true,
			"scrollY": 300,
     "scrollCollapse": true
		});
      });	  
	  
$(document).ready(function(){
     setTimeout(function() { $(".alert_msg").hide(); }, 3000);
}); 
</script>
</body> 
</html>
<?php mysqli_close($con);?>

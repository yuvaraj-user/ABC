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
<title><?php echo $filename; ?>|| Receipt</title>
<meta name="author" content="Gayathri.R.KKIT">
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
	 <script src="https://docraptor.com/docraptor-1.0.0.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<style>  
        table {  
            font-family: arial, sans-serif;  
            border-collapse: collapse;  
            width: 100%;  
        }  
  
        td, th {  
            border: 1px solid #000000;  
            text-align: left;  
            padding: 8px; 
        }  
    
    </style> 

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'header.php'; ?>
<?php include  'sidebar.php'; ?>


<!-- Content Wrapper. Contains page


<button type="button" onclick="window.location.href='receipt_print.php?id=<?php echo $fetch['Id']; ?>'" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Receipt Print</button>


 content -->
<div class="content-wrapper">
<div class="row panel panel-primary"> 


      
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body print">
	            <div class="panel-heading lead "> 
		  <?php  
					 $inv_no=$_REQUEST['inv_no'];
					 
				    $qurydelct_total="SELECT Date,c.Name as cus_name FROM `tbl_sales_return` r left join tbl_customer c on r.Customer_Id=c.Id WHERE r.Invoice_No='$inv_no' AND r.Status='Active'";
					$qury_det_total=mysqli_query($con,$qurydelct_total);
					$fetch_det_total=mysqli_fetch_array($qury_det_total);
					$Date = $fetch_det_total['Date'];	
					$cus_name = $fetch_det_total['cus_name'];	
								 
						
	
		$my_html.="<div class='invoice-box col-sm-12 form-group'> 
									<table width='100%' cellspacing='9'>	
									<tr>
									<td>
									<table style='border:1px solid #000'; width='100%'>			 
										<thead>					
											<tr>
												<td style='border:1px solid #000; text-align:center;'>
													<img src='maze.jpg' width='90px'>
												</td>
												<td style='text-align:center;margin-left:60px;border:1px solid #000'>
													<div style='font-size:16px'><address><b>AKR TEXTILES </b><br/>No. 133/1, 11th Cross,<br/>Malleswaram,<br/>
														Bangalore-560003<br/>
														GST NO:29ALKPK1089N1ZE</address></div>
													
												</td>
											</tr>
										</thead>
									</table>";
									
									
			
						
						$my_html.=" <table style='border:1px solid #000;border-radius: 10px 0 0 0;'; width='100%'>		 
										<thead>		
										<tr >
           <th colspan='4' class='text-center'>Tax Invoice </th>
        </tr>	
										<tr>
          <td> <b>Invoice No</b> </td>
          <td>$inv_no</td>
          <td> <b>Date</b></td>
          <td>$Date</td>
        </tr>	
	<tr>
          <td><b>Customer Name</b></td>
          <td colspan='3'>$cus_name</td>
        </tr>												
											  <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Amount</th>
        </tr> </thead>";
	
				    $qurydelct="select s.*,t.Name as prod_name from tbl_sales_return s left join tbl_product t on t.Id=s.Product_Id where s.Status='Active' AND s.Invoice_No='$inv_no'";
					$qury_det=mysqli_query($con,$qurydelct);
					$j=1;
					while($fetch_det=mysqli_fetch_array($qury_det))
					{		
					$product_name = $fetch_det['prod_name'];
					$Quantity = $fetch_det['Quantity'];
					$Rate = $fetch_det['Rate'];
					$Amount = $fetch_det['Amount'];
					$Net_Amount = $fetch_det['Net_Total'];
					$my_html.=" <tr>
					<td>  $product_name </td> 
					<td>  $Quantity </td> 
					<td>  $Rate </td> 
					<td>  $Amount </td> ";
					$overal_paid[] = $Amount;
					$j++;
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
		
		            $qurydelct_gst="SELECT SUM(Cgst) as cgst_amt,SUM(Cgst) as sgst FROM `tbl_sales_return` WHERE Invoice_No='$inv_no' AND Status='Active'";
					$qury_det_gst=mysqli_query($con,$qurydelct_gst);
					$fetch_det_gst=mysqli_fetch_array($qury_det_gst);
					$cgst_amt = $fetch_det_gst['cgst_amt'];
					$sgst = $fetch_det_gst['sgst'];
					
					$qurydelct_total="SELECT Net_Total FROM `tbl_sales_return` WHERE Invoice_No='$inv_no' AND Status='Active'";
					$qury_det_total=mysqli_query($con,$qurydelct_total);
					$fetch_det_total=mysqli_fetch_array($qury_det_total);
					$Net_Amount = $fetch_det_total['Net_Total'];
					
					$my_html.="<tr>
          <th colspan='3' class='text-right'>Total</th>
          <th>$sumpend</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='3' class='text-right'>CGST</th>
          <th>$cgst_amt</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='3' class='text-right'>SGST</th>
          <th>$sgst</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='3' class='text-right'>Discount</th>
          <th>0</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='3' class='text-right'>Grand Total</th>
          <th>$Net_Amount</th></tr>";
					
					
										$my_html.="
										<tr style='height: 88px !important;'>
										<td  colspan='2' style='text-align:center;padding-top: 32px !important;border:1px solid #000'><b>Authorized</br> Signature</b></td> 
										<td  colspan='2' style='text-align:center;padding-top: 32px !important;border:1px solid #000'><b>Customer Signature</b></td>
									</tr>
									</table></td></td>
									</table>";
						$my_html.="</div>";
		


						
 echo $html=$my_html;
  $dat1 = date('d-m-Y H:m:s');
   $dat2 = date('h:m:s');
   $html=$my_html;
    include("mpdf60/mpdf.php");
	$excel_filename ="custstatement/".$customeruid.'_'.$customer_name.'_'.$dat1.'_'.$dat2.'.pdf';
	//$excel_filename='samplemm.pdf';
	$mpdf=new mPDF('c','A5','8','',1,1,3,3,0,0,'P'); 
	$mpdf->AddPage('P'); // Adds a new page in Landscape orientation
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	
	// LOAD a stylesheet
	$stylesheet = file_get_contents('mpdfstyletables.css');
	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
	
	$mpdf->WriteHTML($html,2);
	
	$mpdf->Output($excel_filename,'F');
	?>
	
	
	
						 
							  
							   </div>
</div> 
<a href="<?php echo $excel_filename; ?>" >	<button class="btn btn-success center-block">Print</button></a>  <!-- /.row -->
         
          </div>
          
        </section><!-- /.content -->
      </div>
	  </div>
	  </div>
	   </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
<!-- /.content-wrapper -->
<!-- Footer Section-->
<?php include 'footer.php'; ?>

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
  	
</body>
</html> 
<?php mysqli_close($con);?>

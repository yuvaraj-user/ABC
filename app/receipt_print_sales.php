<?php
session_start();
require "checkagain.php";
include_once 'srdb.php';

 include("phpmailer/class.phpmailer.php");
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

<?php
if(isset($_REQUEST['submit']))
{
$voucher = $_REQUEST['voucher'];
$cid = $_REQUEST['cid'];
					    $select_mid=mysqli_query($con,"select MAX(Id) as mid from tbl_mail_receipt WHERE Cust_Id='$cid'");
							$fetch_mid=mysqli_fetch_array($select_mid);
							$mid=$fetch_mid['mid'];
							
							$select_inv_no=mysqli_query($con,"select Path from tbl_mail_receipt WHERE Id='$mid'");
							$fetch_inv_no=mysqli_fetch_array($select_inv_no);
							$Path=$fetch_inv_no['Path'];
							
							$select_inv_no=mysqli_query($con,"select Email_Id1 from tbl_customer WHERE Id='$cid'");
							$fetch_inv_no=mysqli_fetch_array($select_inv_no);
							$Email_Id1=$fetch_inv_no['Email_Id1'];
						 
						 
$name 		= 	"gowri@mazenetsolution.com";
        		$pass		=	"gowri@123";
        		$to		    =	$Email_Id1;
        // 		$fromdept	=	$name_f;
                	$message ="http://mazenettech.net/saraswathi/app/$Path";
                	
        	$mail = new PHPMailer();
            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = $name;
            $mail->Password = $pass;
        	$mail->SMTPSecure = "ssl"; // SSL FROM DATABASE
            $mail->Host = 	    "smtp.gmail.com";// Host FROM DATABASE
            $mail->Port = 		"465";// Port FROM DATABASE
            $mail->setFrom($name);
            $mail->AddAddress($to);
            $mail->AddAttachment($sourcePath, $tmpFilePath);

            // $mail->addCC('ashokraj@mazenetsolution.com');
            $mail->Subject  = 'Apply For '.$designation;
            $mail->IsHTML(true);
            $mail->Body    = $message;
        	if($mail->Send())
        	{
                 echo '<script type="text/javascript">
					window.location.replace("receipt_print_sales.php?inv_no=$voucher");
					</script>';	
        	}
        	else
        	{
        		 echo '<script type="text/javascript">
					window.location.replace("receipt_print_sales.php?inv_no=$voucher");
					</script>';	
        	} 
}

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
	<link rel="stylesheet" href="app/css/style.css">
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
					 
				 $qurydelct_total="SELECT Date,c.Name as cus_name,c.Gst_No,c.Id as cid FROM `tbl_sales` r left join tbl_customer c on r.Customer_Id=c.Id WHERE r.Invoice_No='$inv_no' AND r.Status='Active'";
					$qury_det_total=mysqli_query($con,$qurydelct_total);
					$fetch_det_total=mysqli_fetch_array($qury_det_total);
					$Date = $fetch_det_total['Date'];	
					$cus_name = $fetch_det_total['cus_name'];	
						$cid = $fetch_det_total['cid'];
						$Gst_No = $fetch_det_total['Gst_No'];
								 
						
	
		$my_html.="<div class='invoice-box col-sm-12 form-group'> 
									<table width='100%' cellspacing='9'>	
									<tr>
									<td>
									<table style='border:1px solid #000'; width='100%'>			 
										<thead>					
											<tr>
												
												<td style='text-align:center;margin-left:60px;border:1px solid #000'>
													<div style='font-size:16px'><address style='font-size:14px;'><b style='font-size:17px;'>Saraswathi Traders </b><br/>378,Rangai Gowder Street,<br/>
														Coimbatore-641001<br/>
														<span style='font-size:13px'>GST NO:33AAOFS0019B1ZQ</span><br/>
														<span style='padding:4px 5px;'>Ph: </span> 0422-2392359 | <span style='padding:4px 5px;'>Mbl: </span> 97511 03304 <br/>
														</address></div>
													
												</td>
											</tr>
										</thead>
									</table>";
									
			
						
						$my_html.=" <table style='border:1px solid #000;border-radius: 10px 0 0 0;'; width='100%'>		 
										<thead>		
										<tr >
           <th colspan='7' class='text-center' style='border-bottom:1px solid #000;'>Tax Invoice </th>
        </tr>	
										<tr >
          <td> <b>Invoice No :</b> </td>
          <td colspan='3'>$inv_no</td>
          <td> <b>Date :</b></td>
          <td colspan='3'>$Date</td>
        </tr>	
	<tr>
          <td style='border-bottom:1px solid #000;'><b>Customer Name :</b></td>
          <td colspan='3' style='border-bottom:1px solid #000;'>$cus_name</td> 
          <td style='border-bottom:1px solid #000;'><b>Customer GST No :</b></td>
          <td colspan='3' style='border-bottom:1px solid #000;'>$Gst_No</td>
        </tr>												
											  <tr>
            <th style='border-right:1px solid #000;'>Product Name</th>
            <th style='border-right:1px solid #000;'>HSN Code</th>
            <th style='border-right:1px solid #000;'>Qty</th>
            <th style='border-right:1px solid #000;'>Rate (MRP)</th>
            <th style='border-right:1px solid #000;'>Rate</th>
            <th style='border-right:1px solid #000;'>Product Discount</th>
            <th style='border-right:1px solid #000;'>Amount</th>
        </tr> </thead>";
	
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
					$my_html.=" <tr>
					<td style='border-right:1px solid #000;'>  $product_name </td> 
					<td style='border-right:1px solid #000;'>  $Hsn_Code </td> 
					<td style='border-right:1px solid #000;'>  $Quantity </td> 
					<td style='border-right:1px solid #000;'>  $ori_rt </td>
					<td style='border-right:1px solid #000;'>  $Rate </td> 
					<td style='border-right:1px solid #000;'>  $sinlge_prod_dis </td>
					<td style='border-right:1px solid #000;'>  $Amount </td> ";
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
		
		            $qurydelct_gst="SELECT SUM(Cgst) as cgst_amt,SUM(Cgst) as sgst FROM `tbl_sales` WHERE Invoice_No='$inv_no' AND Status='Active'";
					$qury_det_gst=mysqli_query($con,$qurydelct_gst);
					$fetch_det_gst=mysqli_fetch_array($qury_det_gst);
					$cgst_amt = $fetch_det_gst['cgst_amt'];
					$sgst = $fetch_det_gst['sgst'];
					
					$qurydelct_total="SELECT Net_Total FROM `tbl_sales` WHERE Invoice_No='$inv_no' AND Status='Active'";
					$qury_det_total=mysqli_query($con,$qurydelct_total);
					$fetch_det_total=mysqli_fetch_array($qury_det_total);
					$Net_Amount = $fetch_det_total['Net_Total'];
					
					$my_html.="<tr>
          <th colspan='6' class='text-right border-bottom' style='border-top:1px solid #000;border-right:1px solid #000;'>Total</th>
          <th style='border-top:1px solid #000;border-right:1px solid #000;'>$sumpend</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='6' class='text-right border-bottom' style='border-top:1px solid #000;border-right:1px solid #000;'>CGST(2.5%)</th>
          <th style='border-top:1px solid #000;border-right:1px solid #000;'>$cgst_amt</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='6' class='text-right border-bottom' style='border-top:1px solid #000;border-right:1px solid #000;'>SGST(2.5%)</th>
          <th style='border-top:1px solid #000;border-right:1px solid #000;'>$sgst</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='6' class='text-right border-bottom' style='border-top:1px solid #000;border-right:1px solid #000;'>Discount</th>
          <th style='border-top:1px solid #000;border-right:1px solid #000;'>0</th>
        </tr>";
		$my_html.="<tr>
          <th colspan='6' class='text-right' style='border-top:1px solid #000;border-right:1px solid #000;'>Grand Total</th>
          <th style='border-top:1px solid #000;border-right:1px solid #000;'>$Net_Amount</th></tr>";
					
					
										$my_html.="
										<tr style='height: 88px !important;'>
										<td  colspan='3' style='text-align:center;padding-top: 32px !important;border:1px solid #000'><b>Authorized</br> Signature</b></td> 
										<td  colspan='4' style='text-align:center;padding-top: 32px !important;border:1px solid #000'><b>Customer Signature</b></td>
									</tr>
									</table></td></td>
									</table>";
						$my_html.="</div>";
		


						
 echo $html=$my_html;
  $dat1 = date('d-m-Y');
   $dat2 = date('h:m:s');
   $html=$my_html;
    include("mpdf60/mpdf.php");
	$excel_filename ="custstatement/".$cid.'_'.$dat1.'_'.$dat2.'.pdf';
	//$excel_filename='samplemm.pdf';
	$mpdf=new mPDF('c','A5','8','',1,1,3,3,0,0,'P'); 
	$mpdf->AddPage('P'); // Adds a new page in Landscape orientation
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	
$insert_details = mysqli_query($con,"INSERT INTO `tbl_mail_receipt`(Cust_Id,Path,Created_On) VALUES ('$cid','$excel_filename','$dat1')");
			
	
	// LOAD a stylesheet
	$stylesheet = file_get_contents('mpdfstyletables.css');
	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
	
	$mpdf->WriteHTML($html,2);
	
	$mpdf->Output($excel_filename,'F');
	?>
	
	
	
						 
							  
							   </div>
</div> 
  <div class="row">
    <div class="col-md-6 text-right">
     <a href="<?php echo $excel_filename; ?>" >	<button class="btn btn-success">Print</button></a>  <!-- /.row -->  
    </div>
    
        <div class="col-md-6 text-left">
     <form class="form-horizontal row" name="addaccount_details" action="" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="voucher" value="<?php echo $_REQUEST['inv_no']; ?>">
    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
             	
			<a class="btn btn-success" data-toggle="modal" name="feedback" data-target="#myModal2" data-backdrop="static" data-keyboard="false"> Send Email</a> 
				<div class="modal fade" id="myModal2" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content"  style="width:85%;margin-left:140px">
					<div class="modal-header custom-stripped">
					    
						<button id="m_close" type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<div class="row">
						<div class="col-sm-6">
						<h4 class="modal-title"><b>Are you sure you want to send this invoice through email?</b> </b> </h4>
						</div>
						</div>
					</div>
					<div class="modal-body">
					    <div class="row yes-no">
					       <div class="col-md-6">
					           <h4><input type="submit" value="Yes" class="form-control" name="submit" /></h4>
					       </div> 
					       <div class="col-md-6">
					           <h4><input type="submit" value="No" class="form-control" name="cancel" id="m_close"
					           type="button" style="background: #d20000;" class="close" data-dismiss="modal" /></h4>
					       </div> 
					        
					    </div>
					    
						</div>
					</div>
				</div>
		
         	 </form>  
    </div>
</div>


         	 
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

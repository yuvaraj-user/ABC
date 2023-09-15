<?php
include_once 'srdb.php';

//Store transaction information from PayPal
$item_name=$_GET['item_name'];
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];

$payment_date=$_GET['payment_date'];
$first_name=$_GET['first_name'];
$last_name=$_GET['last_name'];
$address=$_GET['address_name'].','.$_GET['address_street'].','.$_GET['address_city'].','.$_GET['address_state'].','.$_GET['address_country'].','.$_GET['address_zip'];
$payer_email=$_GET['payer_email'];

$current_date=date('d-m-Y');
$current_time=date('H:i:s A');


if(!empty($txn_id) && !empty($payment_gross)){
	
	
	//Check if payment data exists with the same TXN ID.
    $prevPaymentResult = $con->query("SELECT payment_id FROM tbl_payments WHERE txn_id = '".$txn_id."'");

    if($prevPaymentResult->num_rows > 0){
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $last_insert_id = $paymentRow['payment_id'];
    }else{
        //Insert tansaction data into the database		
		
        $insert = $con->query("INSERT INTO tbl_payments(item_number,txn_id,payment_gross,currency_code,payment_status,Date,Time,item_name,payment_date,first_name,last_name,address,payer_email) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."','".$current_date."','".$current_time."','".$item_name."','".$payment_date."','".$first_name."','".$last_name."','".$address."','".$payer_email."')");
        $last_insert_id = $con->insert_id;
    }
?>
	<h1>Your payment has been successful.</h1>
    <h1>Your Payment ID - <?php echo $last_insert_id; ?>.</h1>
<?php
}else{
?>
	<h1>Your payment has failed.</h1>
<?php
}
 mysqli_close($con);
?>

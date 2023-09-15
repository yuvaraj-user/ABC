
<?php
session_start();
require 'checkagain.php';
include_once("srdb.php");
$pro_id = $_REQUEST['pro_id'];
$sel = $_REQUEST['sel'];
?>

<?php  if((!empty($pro_id)) && $sel == '1') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell1" value="<?php echo $rate; ?>"  id="sell1" class="round default-width-input" style="width: 80px"/>
<?php } ?>

<?php  if((!empty($pro_id)) && $sel == '2') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell2" value="<?php echo $rate; ?>"  id="sell2" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '3') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell3" value="<?php echo $rate; ?>"  id="sell3" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '4') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell4" value="<?php echo $rate; ?>"  id="sell4" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '5') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell5" value="<?php echo $rate; ?>"  id="sell5" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '6') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell6" value="<?php echo $rate; ?>"  id="sell6" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '7') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell7" value="<?php echo $rate; ?>"  id="sell7" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '8') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell8" value="<?php echo $rate; ?>"  id="sell8" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '9') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell9" value="<?php echo $rate; ?>"  id="sell9" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php  if((!empty($pro_id)) && $sel == '10') {
    $qury_rate="select Selling_Rate from tbl_product where Id='$pro_id' AND Status='Active'";
    $qury_exe_rate=mysqli_query($con,$qury_rate);
    $fetch_rate=mysqli_fetch_array($qury_exe_rate);
    $rate = $fetch_rate['Selling_Rate'];
?>
    <input type="text" readonly name="sell10" value="<?php echo $rate; ?>"  id="sell10" class="round default-width-input" style="width: 80px"/>
<?php } ?>
<?php
include('config.php');
\Stripe\Stripe::setApiKey("sk_test_51OSj0WGlQkVmVwGJxvV5xScmacCfSBAgXXgt5j4CLSGrsS4mYRfhSM3Fx4AfUVaDVO1jx6vYDFE66jeN283Cztog00s3xQzrAy");
// POST request se card details receive karein
$token = $_POST['stripeToken'];
$amount = 20000; // Payment amount in cents
\stripe\stripe::setVerifySslCerts(false);
// Payment charge create karein
$charge = \Stripe\Charge::create([
  'amount' => $amount,
  'currency' => 'inr',
  'source' => $token,
  'description' => 'Pay To EzShope',
]);
$orderno = $_GET['orderno'];
$orderid= $_GET['orderid'];
$oderdata = $conn->query("SELECT * FROM orders WHERE id	='".$_GET['orderid']."' ")->fetch_assoc();
$onlinepay = $conn->query("INSERT INTO `onlinepay`(`order_id`,`payment_id`, `amount`, `payment_status`, `date`) VALUES ('" .$orderid."','" . $charge['id'] . "','" . $oderdata['grand_total'] . "','" . $charge['status'] . "','" . date('Y-m-d') . "')");
if ($onlinepay) {
  $update = $conn->query("UPDATE `orders` SET `order_no`='".$orderno."' , `order_status`=1 WHERE id = '".$orderid."' ");
  $conn->query("delete from  card where card.user_id= '" . $_SESSION['login_user_id'] . "'");
  
  unset($_SESSION['cupncode']);
  header("location:" . SITEURL . 'orderdetials.php?orderor=' . $orderno);
} else {
  header("location:" . SITEURL . "checkout.php");
}

?>
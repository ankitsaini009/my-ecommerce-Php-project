<?php
include('config.php');
$pagename = "myoder";

if (isset($_GET['address'])) {
  $address = $_GET['address'];
  $paytype = $_GET['paytype'];

  $addresh = $conn->query("SELECT * FROM user_address where ld = '" . $_GET['address'] . "' ")->fetch_assoc();

  $inorder = $conn->query("INSERT INTO `orders`(`f_name`, `l_name`, `address`, `country`, `state`, `city`, `phon_no`, `pincode`,`user_id`, `payment_type`,`shipping_date`,`created_at`, `updated_at`) VALUES ('" . $addresh['fname'] . "','" . $addresh['lname'] . "','" . $addresh['address'] . "','" . $addresh['country_id'] . "','" . $addresh['state_id'] . "','" . $addresh['city_id'] . "','" . $addresh['phone'] . "','" . $addresh['pincode'] . "','" . $_SESSION['login_user_id'] . "','" . $_GET['paytype'] . "','" . date('Y-m-d') . "','" . date('Y-m-d') . "','" . date('Y-m-d') . "')");

  $orderid = $conn->insert_id;
  $cartdata = $conn->query("SELECT  card.*,prdoucts.price,prdoucts.`name` FROM card INNER JOIN prdoucts ON card.product_id=prdoucts.id WHERE card.user_id= '" . $_SESSION['login_user_id'] . "'");
  $subtotal = 0;
  $totalqty = 0;
  while ($singlecartdata = $cartdata->fetch_assoc()) {
    $totalqty += $singlecartdata['qty'];
    $subtotal += $singlecartdata['qty'] * $singlecartdata['price'];
    ///entry in orderproducts
    $orderproducts = $conn->query("INSERT INTO `order_products`(`order_id`, `product_id`, `name`, `price`, `qty`) VALUES ('" . $orderid . "','" . $singlecartdata['product_id'] . "','" . $singlecartdata['name'] . "','" . $singlecartdata['price'] . "','" . $totalqty . "')");
  }
  $discountamot = 0;
  if (isset($_SESSION['cupncode'])) {
    $cpndata = $conn->query("select * from coupons where coupan_code= '" . $_SESSION['cupncode'] . "' && status=1 ")->fetch_assoc();
    if (isset($_SESSION['cupncode']) && $cpndata['type'] == 1) {
      $discountamot = ($subtotal * $cpndata['amount']) / 100;
    } else {
      $discountamot = $cpndata['amount'];
      if ($subtotal < $discountamot) {
        $discountamot = $subtotal;
      }
    }
    //Order discount
    $odcupn = $conn->query("INSERT INTO `order_coupons`(`order_id`, `coupon_no`, `created_at`) VALUES ('" . $orderid . "','" . $cpndata['coupan_code'] . "','" . date('Y-m-d') . "')");
  }
  $cipingcharge = CIPINGCHARGE * $totalqty;
  $grand_total = $subtotal + ($cipingcharge) - $discountamot;
  $orderno = 'ORD' . $orderid;
  if ($_GET['paytype'] == 1) {
    $rderupdate = $conn->query("UPDATE `orders` SET `sub_total`='" . $subtotal . "',`coupon_amt`='" . $discountamot . "',`shipping_amt`='" . $cipingcharge . "',`grand_total`='" . $grand_total . "' , order_no='" . $orderno . "', order_status=1 WHERE id='" . $orderid . "'");

    $conn->query("delete from  card where card.user_id= '" . $_SESSION['login_user_id'] . "'");
    unset($_SESSION['cupncode']);
    header("location:" . SITEURL . 'orderdetials.php?orderor=' . $orderno);
  } else {
    $rderupdate = $conn->query("UPDATE `orders` SET `sub_total`='" . $subtotal . "',`coupon_amt`='" . $discountamot . "',`shipping_amt`='" . $cipingcharge . "',`grand_total`='" . $grand_total . "' , order_no='" . $orderno . "', order_status=1 WHERE id='" . $orderid . "'");
    header("location:" . SITEURL . 'pay.php?order=' . $orderno . '&orderid=' . $orderid);
  }
} else {
  header("location:" . SITEURL . "checkout.php");
}

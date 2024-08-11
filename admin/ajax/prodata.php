<?php
include('../../config.php');
$proid = $_POST['productid'];
$userid = $_SESSION['login_user_id'];

$getproduct = $conn->query("select * from prdoucts where id='" . $proid . "'")->fetch_assoc();

if ($getproduct['product_type'] == 2) {
  $size_id = $_POST['size_id'];
  $color_id = $_POST['color_id'];

  $getproduct = $conn->query("select * from card where product_id='" . $proid . "' && color_id='" . $color_id . "' &&  size_id='" . $size_id . "' && user_id='" . $userid . "'");

  if ($getproduct->num_rows > 0) {
    $getoldcartdata = $getproduct->fetch_assoc();
    $conn->query("update card set qty='" . ($getoldcartdata['qty'] + 1) . "' where id='" . $getoldcartdata['id'] . "'");
  } else {
    $insert = $conn->query("INSERT INTO `card`( `color_id`, `size_id`,`product_id`,`user_id`) VALUES ('$color_id', '$size_id','$proid','$userid')");
  }
} else {
  $chekpro = $conn->query("select * from card where product_id='" . $proid . "' && user_id='" . $userid . "'");
  if($chekpro->num_rows>0){
    $getpro = $chekpro->fetch_assoc();
    $conn->query("update card set qty = '".($getpro['qty'] + 1)."' where id='".$getpro['id']."'");
  }else{
    $insert = $conn->query("INSERT INTO `card`(`product_id`,`user_id`) VALUES ('$proid','$userid')");
  }
}
$getcartdata = $conn->query("select card.*, prdoucts.name, price ,main_image from card left join prdoucts on prdoucts.id=card.product_id where user_id='" . $userid . "'");

$totalqty = 0;
$totalamount = 0;
$html = '<div class="shopping__cart__table">
<div class="">
    <div class="product-table-header">
        <div class="product-table-header-inner">
            <div class="pro-header basis-50"><h3>Product</h3></div>
            <div class="total-header basis-20"><h3>Total</h3></div>
        </div>
    </div>
    <div class="product-table-body">
        
   ';
while ($cartrow = $getcartdata->fetch_assoc()) {
  $producttotal = $cartrow['price'] * $cartrow['qty'];
  $totalqty += $cartrow['qty'];
  $totalamount += $producttotal;
  $html .= '<div class="product-table-body-inner">
  <div class="product__cart__item d-flex align-items-center basis-50">
      <div class="product__cart__item__pic">
          <img src="' . SITEURL . 'uploads/banners/' . $cartrow['main_image'] . '">
      </div>
      <div class="product__cart__item__text">
          <h6>' . $cartrow['name'] . '</h6>
          <h5>' . price($cartrow['price']) . ' X ' . $cartrow['qty'] . '</h5>
      </div>
  </div>
  
  <div class="cart__price basis-20">
      <span>' . price($producttotal) . '</span>                                               
  </div>
  
</div>';
}
$html .= ' </div>
</div>
</div>';


echo json_encode(['status' => true, 'html' => $html, 'totalqty' => $totalqty, 'totalamount' => price($totalamount)]);
exit;

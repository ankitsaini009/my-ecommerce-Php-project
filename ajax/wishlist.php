<?php
include('../config.php');

if (isset($_SESSION['login_user_id'])) {
  $chekwishlist = $conn->query("SELECT * FROM `wishlist` WHERE user_id = '" . $_POST['userid'] . "' && product_id = '" . $_POST['productid'] . "'");
  if($chekwishlist->num_rows>0){
    echo "Already added";
  }else{
    $wishlist = $conn->query("INSERT INTO `wishlist`(`user_id`, `product_id`, `size_id`, `color_id`) VALUES ('" . $_POST['userid'] . "','" . $_POST['productid'] . "','" . $_POST['size_id'] . "','" . $_POST['color_id'] . "')");
  }
} else {
  echo "not_login";
}

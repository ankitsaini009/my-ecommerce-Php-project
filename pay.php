<?php
require('config.php');

$publishableKey = "pk_test_51OSj0WGlQkVmVwGJcOZF3bLDIdp8ZYjK7XIZksiCp5h6zWXC3EVvSuzzrUuiQImShGkVXZyp0aGrhl71YOcxyEXc00x6VSnEY2";
$oderdata = $conn->query("SELECT * FROM orders WHERE id	='".$_GET['orderid']."' ")->fetch_assoc();
?>
<style>
  .stripe-button-el{
    display: none!important;
  }
</style>
<form action="paymentsuccess.php?orderno=<?php echo $_GET['order'];?>&orderid=<?php echo $_GET['orderid'];?>" method="post">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $publishableKey ?>" data-amount="<?php echo $oderdata['grand_total'];?>" data-name="EzShope" data-description="Pay To EzShope" data-image="uploads/banners/icon_1703920066_46927.png" data-currency="inr" data-email="saini@gmail.com">
  </script>
  <script>
    $(function() {
        $('.stripe-button-el').click();
    }); 
  </script>
</form>
<?php
include('config.php');
$pagename = "oderdetials";
$myoder = $conn->query("SELECT * FROM `orders` WHERE order_no = '" . $_GET['orderor'] . "' ")->fetch_assoc();
$oderpro = $conn->query("SELECT order_products.*, prdoucts.name as proname,prdoucts.price as proprice,prdoucts.qty as proqty, prdoucts.main_image as proimage FROM order_products INNER JOIN prdoucts ON order_products.product_id = prdoucts.id WHERE order_id = '" . $myoder['id'] . "' ");

$odercupn = $conn->query("SELECT * FROM `order_coupons`")->fetch_assoc();

$data = $conn->query("SELECT  orders.*,country.country_name as countriesname, 
        state.state_name as statename, 
        city.city_name as cityname FROM orders 
        INNER JOIN country ON orders.country = country . id
        INNER JOIN state ON orders.state= state . id  
        INNER JOIN city ON orders.city = city . id
         WHERE orders.user_id= '" . $_SESSION['login_user_id'] . "' && order_no = '" . $_GET['orderor'] . "' ")->fetch_assoc();
$orderdata = $conn->query("SELECT * FROM `orders` where order_no = '" . $_GET['orderor'] . "'")->fetch_assoc();
$sub_total = $orderdata['sub_total'];
$discountamot = $orderdata['coupon_amt'];
$cipingcharge = $orderdata['shipping_amt'];
$grandtotal = $orderdata['grand_total'];
include('includes/header.php');
?>
<div class="content">
  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-option">
    <ul class="circles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb__text">
            <h4>Check Out</h4>
            <div class="breadcrumb__links">
              <a href="./index.html">Home</a>
              <a href="./shop.html">Shop</a>
              <span>Check Out</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>[;]
<!-- Breadcrumb Section End -->
<section class="my-account spad-70">
  <div class="container">
    <div class="row">
      <?php include('sidebar.php') ?>
      <div class="col-sm-12 mt-4 mt-md-0 col-md-12 col-lg-9">
        <div class="tab-content account-tabs" id="v-pills-tabContent">
          <div class="tab-pane fade show active order-details-section" id="v-pills-profile">
            <div class="heading-box text-left">
              <h5>My Orders</h5>
            </div>
            <section id="allOrder">
              <div class="current-order-wrapper">
                <div class="current-order-header">
                  <div class="current-order-header-wrap d-flex">
                    <div class="order-left d-flex justify-content-between">
                      <div class="col-md-12">
                        <div class="card-body" style="font:bold;">
                          <div><span class="order-heading">
                              <h5>*Address</h5>
                              </Address>
                            </span></div>
                          Country Name :
                          Name :
                          <?php echo $orderdata['f_name'];
                          ?>
                          <?php echo $orderdata['l_name'];
                          ?><br>
                          Mobile No :
                          <?php echo $orderdata['phon_no']; ?><br>
                          <?php echo $data['countriesname']; ?><br>
                          State Name :
                          <?php echo $data['statename']; ?><br>
                          City Name :
                          <?php echo $data['cityname']; ?><br>
                          Home Address :
                          <?php echo $data['address']; ?><br>
                          Pincode :
                          <?php echo $data['pincode']; ?><br></h5>
                        </div>
                      </div>
                    </div>
                    <div class="order-left d-flex justify-content-between" style="margin-left: 100px;">
                      <div>
                        <div class="card-body" style="font:bold;">
                          <div><span class="order-heading">
                              <h5>*Order Details</h5>
                              </Address>
                            </span></div>
                          Order No :
                          <?php echo $orderdata['order_no']; ?><br>
                          Sub Total :
                          <?php echo price($sub_total) ?><br>
                          Discount Amot :
                          <?php echo price($discountamot) ?><br>
                          Sipingcharge :
                          <?php echo price($cipingcharge) ?><br>
                          Grand Total :
                          <?php echo price($grandtotal) ?><br></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php while ($myproducts = $oderpro->fetch_assoc()) { ?>
                <div class="order-details-wrapper">
                  <div class="d-flex flex-wrap justify-content-between">
                    <div class="order-item-details p-0">
                      <div class="order-item-details-wrap d-flex">
                        <div class="product-table-body-inner">
                          <a href="products.php?id=<?php echo $myproducts['product_id']; ?>" class="order-item-img">
                            <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $myproducts['proimage']; ?>">
                          </a>
                          <div class=" order-item-desc d-flex flex-column" style="margin-left: 100px;">
                            <a href="#">
                              <?php echo price($myproducts['proprice']) ?> X <?php echo $myproducts['proqty'] ?> </a>

                          </div>
                          <div class="order-item-desc d-flex flex-column" style="margin-left:150px;">
                            <a href="#">
                              <?php echo $myproducts['proname'] ?></a>
                            <div class="buy-again">
                              <a href="<?php echo SITEURL ?>"><span>Buy it again</span></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>
?>
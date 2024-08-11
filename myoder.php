<?php
include('config.php');
$pagename = 'pleshoder';
$myoder = $conn->query("SELECT * FROM `orders`")->fetch_assoc();
$indata = $conn->query("SELECT  card.*,prdoucts.main_image,prdoucts.price,prdoucts.`name`FROM card INNER JOIN prdoucts ON card.product_id=prdoucts.id WHERE card.user_id= '" . $_SESSION['login_user_id'] . "'");
include('includes/header.php')
?>
<section class="register-page spad-70">
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
                      <div>
                        <div><span class="order-heading ">ORDER PLACED</span></div>
                        <div><span class="order-desc text-danger">18 November 2022</span></div>
                      </div>
                      <div>
                        <div><span class="order-heading ">SHIP TO</span></div>
                        <div class="tooltip-ship-to"><span class="order-desc text-danger"><?php echo $myoder['f_name'] . $myoder['l_name'] ?></span></div>
                      </div>
                      <div>
                        <div><span class="order-heading">PLACED BY</span></div>
                        <div class="tooltip-placed-by"><span class="order-desc text-danger"><?php echo $myoder['f_name'] . $myoder['l_name'] ?></span></div>
                      </div>
                    </div>
                    <div class="order-right d-flex justify-content-end">
                      <div>
                        <div><span class="order-heading">Total</span></div>
                        <div><span class="order-desc text-danger "><?php echo price($myoder['grand_total']); ?></span></div>
                      </div>
                      <div>
                        <div><span class="order-heading">ORDER # 405-6062816-6477924</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php while ($oderdata = $indata->fetch_assoc()) { ?>
                  <div class="order-details-wrapper">
                    <h4 class="order-status text-left">Delivered : <?php echo $myoder['delivery_date'] ?></h4>
                    <div class="d-flex flex-wrap justify-content-between">
                      <div class="order-item-details p-0">
                        <div class="order-item-details-wrap d-flex">
                          <div class="order-item-img"><img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $oderdata['main_image']; ?>">
                          </div>
                          <div class="order-item-desc d-flex flex-column">
                            <a href="#"><?php echo $oderdata['name']; ?></a>
                            <div class="buy-again">
                              <a href="<?php echo SITEURL ?>"><span>Buy it again</span></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="order-items-btn p-0">
                        <div class="order-items-btn-wrap">
                          <div class="d-flex justify-content-center"><a class="order-btn" href=""><span>Track
                                order</span></a></div>
                          <div class="d-flex justify-content-center"><a class="order-btn" href=""><span>View order details</span></a></div>
                          <div class="d-flex justify-content-center"><a class="order-btn" href=""><span>Cancel
                                order</span></a></div>
                          <div class="d-flex justify-content-center"><a class="order-btn" href=""><span>Download
                                invoice</span></a></div>
                          <div class="d-flex justify-content-center"><a class="order-btn" href=""><span>Write a
                                review</span></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('includes/footer.php') ?>
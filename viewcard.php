  <?php
    include('config.php');
    if (isset($_POST['cupn'])) {
        //prd($_SESSION);
        if (empty($_POST['cupn'])) {
            $cupnerr = "*Plese Inter Coupons Code.";
        } else {
            $userid = [0, $_SESSION['login_user_id']];
            $chekcupn = $conn->query('SELECT * FROM `coupons` WHERE coupan_code =  "' . $_POST['cupn'] . '" AND user_id in(' . implode(',', $userid) . ') AND start_date<="' . date('Y-m-d') . '" AND end_date>="' . date('Y-m-d') . '" AND status=1 AND dstatus=0 ');
            $cupndata = $chekcupn->fetch_assoc();
            if ($chekcupn->num_rows > 0) {
                $_SESSION['cupncode'] = $cupndata['coupan_code'];
                $successmsg = "Coupon Applied Successfully.";
            } else {
                $cupnerr = "This coupon expiered or not valid.";
            }
        }
    }
    if (isset($_POST["ankit"])) {

        foreach ($_POST['qty'] as $crid => $qty) {
            $conn->query("UPDATE `card` SET`qty`='$qty' WHERE `id`= $crid ");
        }
    }
    if (isset($_SESSION['login_user_id'])) {
        $indata = $conn->query("SELECT  card.*,prdoucts.main_image,prdoucts.price,prdoucts.`name`FROM card INNER JOIN prdoucts ON card.product_id=prdoucts.id WHERE card.user_id= '" . $_SESSION['login_user_id'] . "'");
    }
    include('includes/header.php')
    ?>
  <div class="content">
      <section class="breadcrumb-option">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="breadcrumb__text">
                          <h4>Shopping Cart</h4>
                          <div class="breadcrumb__links">
                              <a href="index-2.html">Home</a>
                              <a href="shop.html">Shop</a>
                              <span>Shopping Cart</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </section>
      <section class="shopping-cart spad pb-70">
          <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="ankit" value="ankitqty">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8">
                          <div class="shopping__cart__table">
                              <div class="">
                                  <div class="product-table-header">
                                      <div class="product-table-header-inner">
                                          <div class="pro-header basis-50">
                                              <h3>Product</h3>
                                          </div>
                                          <div class="qty-header basis-20">
                                              <h3>Quantity</h3>
                                          </div>
                                          <div class="total-header basis-20">
                                              <h3>Total</h3>
                                          </div>
                                          <div class="empty-head basis-10">
                                              <h3></h3>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="product-table-body">
                                      <?php
                                        $grandtotalprice = 0;
                                        $qty = 0;
                                        while ($getdata = $indata->fetch_assoc()) {
                                            $totalprice = $getdata['price'] * $getdata['qty'];
                                            $grandtotalprice += $totalprice;
                                            $qty += $getdata['qty'];
                                        ?>
                                          <div class="product-table-body-inner" id="card_<?php echo $getdata['id'] ?>">
                                              <div class="product__cart__item d-flex align-items-center basis-50">
                                                  <div class="product__cart__item__pic">
                                                      <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $getdata['main_image']; ?>">
                                                  </div>
                                                  <div class="product__cart__item__text">
                                                      <h6><?php echo $getdata['name']; ?></h6>
                                                      <h5><?php echo price($getdata['price']) ?></h5>
                                                  </div>
                                              </div>
                                              <div class="quantity__item basis-20">
                                                  <div class="quantity">
                                                      <div class="pro-qty-2"><span class="fa fa-angle-left dec qtybtn"></span>
                                                          <input type="text" name="qty['<?php echo $getdata['id'] ?>']" value="<?php echo $getdata['qty'] ?>" readonly="readonly">

                                                          <span class="fa fa-angle-right inc qtybtn"></span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="cart__price basis-20">
                                                  <span><?php echo price($totalprice) ?></span>
                                              </div>
                                              <div class="cart__close remove_fron_cart_btn basis-10" onclick="carddelet(<?php echo $getdata['id'] ?>)">
                                                  <i class="fa fa-close"></i>
                                              </div>
                                          </div>
                                      <?php } ?>
                                  </div>
                              </div>

                          </div>
                          <div class="row align-items-center">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="continue__btn">
                                      <a href="<?php echo SITEURL; ?>">Continue Shopping</a>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="continue__btn update__btn">
                                      <button class="btn-product btn--animated" type="submit" href=""><i class="fa fa-spinner"></i>
                                          Update cart</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="cart__discount">
                              <h6>Discount codes</h6>
                              <div class="row">
                                  <input type="text" name="cupn" placeholder="Coupon code" id="cupn" style="margin-left: 69px;;"><br>
                                  <button type="submit" class="btn btn-dark" onclick="return mycoupons() ">Apply</button>
                                  <p class="text-danger" id="cupnerr" style="margin-left: 69px;;"><?php echo isset($cupnerr) ? $cupnerr : '' ?></p>
                              </div>
                          </div>
          </form>
          <form action="" method="post">
              <div class="cart__total">
                  <h6>Cart total</h6>
                  <ul>
                      <?php
                        $discountamot = 0;
                        $cipingcharge = CIPINGCHARGE;
                        if (isset($_SESSION['cupncode'])) {
                            $cpndata = $conn->query("select * from coupons where coupan_code= '" . $_SESSION['cupncode'] . "' && status=1 ")->fetch_assoc();
                            if (isset($_SESSION['cupncode']) && $cpndata['type'] == 1) {
                                $discountamot = ($grandtotalprice * $cpndata['amount']) / 100;
                            } else {
                                $discountamot = $cpndata['amount'];
                                if ($grandtotalprice < $discountamot) {
                                    $discountamot = $grandtotalprice;
                                }
                            }
                        }
                        ?>
                      <li>Subtotal <span><?php echo price($grandtotalprice) ?></span></li>
                      <?php if (!empty($discountamot)) { ?>

                          <li>Coupon ( <?php echo $_SESSION['cupncode']; ?> ) <a href="javascript:void(0);" onclick="deletcupn(<?php echo $cpndata['id'] ?>)" class="text-danger">X</a><span><?php echo price($discountamot) ?></span></li>
                      <?php } ?>
                      <li>Shipping Charges<span> + <?php echo price($qty * $cipingcharge) ?></span></li>
                      <li>Total <span><?php echo price($grandtotalprice + ($qty * $cipingcharge) - $discountamot) ?></span></li>
                  </ul>
                  <a href="<?php echo SITEURL; ?>checkout.php" class="primary-btn btn-product btn--animated">Proceed to
                      checkout</a>
              </div>
          </form>
  </div>
  </div>

  </div>
  </section>
  <!-- Shopping Cart Section End -->
  </div>
  <!-- Search Begin -->
  <?php include('includes/footer.php') ?>
  <script>
      function mycoupons() {
          coupons = document.getElementById('cupn').value;
          if (coupons == '') {
              document.getElementById('cupnerr').innerHTML = "*Plese Inter Coupons Code.";
              document.getElementById('cupn').focus();
              return false;
          } else {
              document.getElementById('cupnerr').innerHTML = "";
          }
      }
  </script>
  <script>
      function carddelet(cardid) {
          bootbox.confirm({
              message: 'Are You Sure To Delete This Products  ?',
              buttons: {
                  confirm: {
                      label: 'Confirm',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'Cancel',
                      className: 'btn-danger'
                  }
              },
              callback: function(result) {
                  if (result) {
                      $.ajax({
                          type: "GET",
                          url: "<?php echo SITEURL; ?>ajax/removecard.php",
                          data: {
                              id: cardid
                          },
                          success: function(data) {
                              window.location.reload();
                          }
                      });
                  }
              }
          });
      }

      function deletcupn() {
          bootbox.confirm({
              message: 'Are You Sure To Delete This Cupons?',
              buttons: {
                  confirm: {
                      label: 'Confirm',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'Cancel',
                      className: 'btn-danger'
                  }
              },
              callback: function(result) {
                  if (result) {
                      $.ajax({
                          type: "GET",
                          url: "<?php echo SITEURL; ?>ajax/removecupn.php",
                          success: function(data) {
                              window.location.reload();
                          }
                      });
                  }
              }
          });
      }
  </script>
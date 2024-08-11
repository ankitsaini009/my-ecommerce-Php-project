<footer class="footer" style="background-color: #ed1e79">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php $sitset = $conn->query("select * from settings ");
        while ($sitlogo = $sitset->fetch_assoc()) { ?>
          <div class="footer__logo text-center site-logo">
            <a href="<?php echo SITEURL; ?>" class="js-logo-clone"><img onerror="" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $sitlogo['site_fav_icon'] ?>" style="height: 130px;"  /></a>
          </div>
        <?php } ?>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer__widget">
          <h6>CUSTOMER SERVICE</h6>
          <div class="addresFooterOption">
            <div class="addressFooterInner">
              <i class="fa fa-clock-o"></i>
              <p>MON-FRI - 10.00 AM TO 7.00 PM (IST)</p>
            </div>

            <div class="addressFooterInner">
              <i class="fa fa-phone"></i>
              <p><a href="tel:(+91)%209314966969">(+91) 9876543210</a></p>
            </div>

            <div class="addressFooterInner">
              <i class="fa fa-map-marker"></i>
              <p>
                G/13, Sitapura Industrial Area, India Gate, Jaipur,
                Rajasthan 302029
              </p>
            </div>
            <div class="addressFooterInner">
              <i class="fa fa-envelope"></i>

              <p>
                <a href="mailto:customercare@jaipurkurti.com">customercare@vinaika.com</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="footer__widget">
          <h6>INFORMATION</h6>
          <ul>
            <li><a href="new-help.html">HELP</a></li>
            <li><a href="my-account.html">MY ACCOUNT</a></li>
            <li><a href="login.html">TRACK ORDER</a></li>
            <li><a href="new-privacy-policy.html">PRIVACY POLICY</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="footer__widget">
          <h6>DISCOVER</h6>
          <ul>
            <li><a href="new-blog.html">BLOG</a></li>
            <li><a href="new-about.html">ABOUT US</a></li>
            <li><a href="#">MEET THE FOUNDER</a></li>
            <li><a href="#">OUR MATERIALS</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer__widget">
          <h6>STAY CONNECTED</h6>
          <div class="footer__newslatter">
            <form action="#">
              <input type="text" placeholder="Your email" />
              <button type="submit">
                <span class="icon_mail_alt"></span>
              </button>
            </form>
            <ul class="social-icon">
              <li>
                <a href="#">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-pinterest" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-linkedin" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-youtube" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="footer__copyright__text">
          <p>
            All Rights Reserved - 2022, VINAIKA | Powered
            <i class="fa fa-heart-o" aria-hidden="true"></i> by
            <a href="https://dzoneindia.co.in/" target="_blank">Dzone India</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
  <div class="h-100 d-flex align-items-center justify-content-center">
    <div class="search-close-switch">+</div>
    <form class="search-model-form">
      <input type="text" id="search-input" placeholder="Search here....." />
    </form>
  </div>
</div>
<!-- Search End -->

<!-- signup form popup -->
<div class="sign__popup__form">
  <div class="signin-overlay"></div>
  <div class="offcanvas-menu-wrapper2">
    <div class="offcanvas__option2">
      <div class="text-right d-flex align-items-center justify-content-sm-between">
        <h5>My Account</h5>
        <div class="js_close-btn close__icon">+</div>
      </div>

      <form id="loginform">
        <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA" />
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password" />
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn product__btn signin_btn">
          Login
        </button>
        <div class="mb-20 mt-10 text-center">
          <a href="forgot.html" class="forgot_password">Forgot Your Password?</a>
        </div>
        <div class="text-center mb-20">
          <span>OR</span>
        </div>
        <button class="loginBtn loginBtn--facebook">
          Login with Facebook
        </button>

        <button class="loginBtn loginBtn--google mb-20">
          Login with Google@
        </button>
        <a href="new-register.html" class="btn product__btn signin_btn">Sign up Now!</a>
      </form>
    </div>
  </div>
</div>
<!-- Cart popup -->
<div class="wrap-header-cart js-panel-cart">
  <div class="header-cart flex-col-l p-l-20 p-r-20">
    <div class="header-cart-title flex-w flex-sb-m p-b-8">
      <h5>Your Cart</h5>
      <div class="js-hide-cart close__icon">+</div>
    </div>

    <div class="header-cart-content flex-w js-pscroll">
      <div class="shopping__cart__table">

        <?php 
        if(isset($_SESSION['login_user_id'])){
          $indata = $conn->query("SELECT  card.*,prdoucts.main_image,prdoucts.price,prdoucts.`name`FROM card INNER JOIN prdoucts ON card.product_id=prdoucts.id WHERE card.user_id= '".$_SESSION['login_user_id']."'");
        $totalamount = 0;
        while ($getdata = $indata->fetch_assoc()) {
          $producttotal = $getdata['price'] * $getdata['qty']; 
            $totalamount += $producttotal;
            ?>
          <div class="product-table-body-inner">
            <div class="product__cart__item d-flex align-items-center basis-50">
              <div class="product__cart__item__pic">
                <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $getdata['main_image']; ?>">
              </div>
              <div class="product__cart__item__text">
                <h6><?php echo $getdata['name']; ?></h6>
                <h5><?php echo price($getdata['price']) ?>X<?php echo $getdata['qty'] ?></h5>
              </div>
            </div>
            <div class="quantity__item basis-20">
            </div>
            <div class="cart__close remove_fron_cart_btn basis-10">
            </div>
          </div>
        <?php } ?>
        <div class="w-full">
          <div class="header-cart-total w-full p-tb-40">
            Total: <span class="total_cart"><?php echo $totalamount ?></span>
          </div>

          <div class="header-cart-buttons flex-w w-full" style="width:103%;">
            <a href="<?php echo SITEURL; ?>viewcard.php" class="btn-product btn--animated size-107 m-r-8" >
              View Cart
            </a>
            <a href="<?php echo SITEURL;?>checkout.php" class="btn-product btn--animated size-107">
              Check Out
            </a>
          </div>
        </div>
        <?php }else{?>
          <P>Login to view cart</P>
          <?php } ?>
      </div>
    </div>
  </div>
</div>


<!-- Js Plugins -->
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/bootstrap.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/lib/wow/wow.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery.nice-select.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery.countdown.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/jquery.slicknav.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/mixitup.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/owl.carousel.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/js/main.js"></script>
<script src="<?php echo SITEURL; ?>assets/bootbox.all.min.js"></script>
<script src="<?php echo SITEURL; ?>assetss/frontend/html/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>


<!-- Swiper Slider Init -->

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
    },
  });
</script>
<script>
  var swiper = new Swiper(".blogSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    clickable: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
    },
  });
<?php if(isset($successmsg) && !empty($successmsg)){ ?>
  Swal.fire({
        title: "Success",
        text: "<?php echo $successmsg;?>",
        icon: "success"
      }); 
<?php }?>

</script>

<script>
  $(".search-icon").click(function() {
    $(".search-wrapper").toggleClass("open");
    $("body").toggleClass("search-wrapper-open");
  });
  $(".search-cancel").click(function() {
    $(".search-wrapper").removeClass("open");
    $("body").removeClass("search-wrapper-open");
  });
  
</script>
<script>
  // Initiate the wowjs
  new WOW().init();
</script>
</body>

</html>
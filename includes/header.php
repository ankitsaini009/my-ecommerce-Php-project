<?php

$getcategory = $conn->query("select * from category where dstatus=0 && display_menu=1 order by id desc limit 0,6 ");
$sitset = $conn->query("select * from settings ");
if(isset($_SESSION['login_user_id'])){
$sumdata = $conn->query("SELECT SUM(qty) AS total_qty FROM card WHERE user_id='".$_SESSION['login_user_id']."' ");
$getsum = $sumdata->fetch_assoc();
$wishlis = $conn->query("SELECT * FROM `wishlist` WHERE user_id='".$_SESSION['login_user_id']."' ");
$totlelike = $wishlis->num_rows;
$carttotle = $getsum['total_qty'] ;
}else{
  $carttotle = 0;
}

//prd(("select * from settings"));
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Vinaika Template" />
  <meta name="keywords" content="Vinaika, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA" />
  <title>Vinaika Jaipur</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com/" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="html/fonts/icomoon/style.css" />
  <!-- Css Styles -->
  <link href="lib/animate/animate.min.html" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/magnific-popup.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/lib/perfect-scrollbar/perfect-scrollbar.css" type="text/css">
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assetss/frontend/html/css/custom.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <a id="button"></a>
  <div id="myModalsubscribe" class="modal fade subscribe">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="close2" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <div class="modal-body">
          <div class="row m-0">
            <div class="col-md-6 p-0 position-relative">
              <div class="newslettermodal-img">
                <img onerror="" src="<?php echo SITEURL; ?>assetss/frontend/html/img/popup-img.jpg" alt="" title="" class="img-fluid" />
              </div>
            </div>
            <div class="col-md-6 p-0">
              <div class="newslettermodal-content">
                <div class="text-center">
                  <img onerror="" src="<?php echo SITEURL; ?>assetss/frontend/html/img/logo.png" alt="" title="" />
                </div>
                <h4 class="modal-title">Sign up our newsletter</h4>
                <p>
                  Enter Your email address to sign up to receive our latest
                  news and offers
                </p>
                <form action="https://vinaikajaipur.com/" method="post" id="homeForm" onSubmit="return ajaxmailhome();" class="newslettermodal-content-form">
                  <div class="form-group">
                    <input type="email" name="homemail" id="homemail" class="form-control" placeholder="Enter Your e-mail address" />
                  </div>
                  <button type="button" class="btn-product btn--animated w-100" onClick="return ajaxmailhome();">
                    Subscribe
                  </button>
                </form>
                <ul>
                  <li>
                    <a href="#" class="icoRss" title=""><i class="fa fa-rss"></i></a>
                  </li>
                  <li>
                    <a href="#" class="icoFacebook" title=""><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                    <a href="#" class="icoTwitter" title=""><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#" class="icoGoogle" title=""><i class="fa fa-google-plus"></i></a>
                  </li>
                  <li>
                    <a href="#" class="icoLinkedin" title=""><i class="fa fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-7">
              <div class="header__top__left">
                <p>
                  <marquee width="100%" direction="left" scrollamount="3" height="20px">
                    Get up to 60% Off | Addl. 10% Off on your first purchase,
                    min order ₹999; Use Code: JKNEW10 | Addl. 10% on prepaid
                    orders | Free shipping on orders above ₹599
                  </marquee>
                </p>
              </div>
            </div>
            <div class="col-lg-6 col-md-5">
              <div class="header__top__right">
                <div class="header__top__links">
                  <?php if (!empty($_SESSION['login_user_id'])) { ?>
                    <a href="<?php echo SITEURL; ?>profile.php" class="">My Acount</a>
                  <?php } else { ?>
                    <a href="<?php echo SITEURL; ?>login.php" class="">Sign in</a>
                  <?php } ?>
                </div>
                <div class="header__top__currency">
                  <select>
                    <option value="">₹ INR</option>
                    <option value="">$ USD</option>
                    <option value="">$ SGD</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-navbar-top">
        <div class="container-fluid">
          <div class="row align-items-center">
            <?php while ($sitlogo = $sitset->fetch_assoc()) { ?>
              <div class="col-4 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <div class="site-logo">
                  <a href="<?php echo SITEURL; ?>" class=""><img onerror="" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $sitlogo['site_logo'] ?>" style="height: 130px;" alt="Vinaika" /></a>
                </div>
              </div>
            <?php } ?>
            <div class="col-8 col-md-8 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <!-- <li><a href="#"><span class="icon icon-person"></span></a></li> -->
                  <li>
                    <a href="javascript:void(0)" class="search-icon">
                      <i class="fa-brands fa-searchengin fa-beat fa-lg"></i> </a>
                  </li>
                  <li>
                    <a href="<?php echo SITEURL;?>wishlist.php" class="site-cart js-show-cart">
                    <i class="fa-solid fa-heart fa-bounce fa-xl"></i></span>
                    <span class="count"><?php echo isset($totlelike)?$totlelike:0?></span>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="site-cart js-show-cart">
                      <i class="fa-solid fa-cart-shopping fa-beat fa-xl"></i>
                      <span class="count"><?php echo isset($carttotle)?$carttotle:0?></span>
                    </a>
                  </li>
                  <a href="#" class="site-menu-toggle js-menu-toggle">
                    <li class="d-inline-block d-md-none ml-md-0"></span>
                  </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="search-wrapper">
            <div class="container">
              <div class="search_flex">
                <form action="#" class="site-block-top-search">
                  <span class="icon icon-search2"></span>
                  <input type="text" class="form-control border-0" placeholder="Search" />
                </form>
                <a href="javascript:void(0);" class="search-cancel"><span class="icon icon-cancel"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="site-navigation text-right text-md-center sticky-top" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="<?php echo SITEURL; ?>">Home</a></li>
            <?php while ($categorys = $getcategory->fetch_assoc()) { ?>
              <li><a href="category.php?id=<?php echo $categorys['id']; ?>"><?php echo $categorys['name'] ?></a></li>
            <?php } ?>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>
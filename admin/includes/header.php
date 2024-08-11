<?php
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header("location:" . SITEADMIN . "dashboard.php");
}

$chackemail = $conn->query("select * from users where id = '" . $_SESSION['id'] . "' ");
$olddata = $chackemail->fetch_assoc();
//prd($olddata);
$profile = $olddata['profile_pic'];
$username = $olddata['name'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo SITENAME; ?> | Dashboard</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/admin/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo SITEURL; ?>assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->



        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?php echo SITEURL; ?>assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Commerce</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img style="width: 70px;" src="<?php echo SITEURL."uploads/banners/".$profile ?>" class="img-circle elevation-2" alt="<?php echo $username ?>">
          </div>
          <div class="info">
            <a href="" class="d-block">Ez-Shope</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>dashboard.php" class="nav-link <?php echo $pagename == 'Dashboard' ? 'active' : '' ?> ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>banners" class="nav-link <?php echo $pagename == 'Banners' ? 'active' : '' ?>  ">
                <i class="nav-icon far fa-image"></i>
                <p>Banners</p>
              </a>
            </li>
           <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>category" class="nav-link" <?php echo $pagename=='Ecommerce'?'active':'' ?> >
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Ecommerce
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo SITEADMIN;?>category" class="nav-link <?php echo $pagename=='Category'?'active':'' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo SITEADMIN;?>sub_category" class="nav-link <?Php echo $pagename== 'Sub Category'?'active':'' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sub Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo SITEADMIN;?>brands" class="nav-link <?php echo $pagename=='Brands'?'active':''?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brands</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>prdoucts" class="nav-link <?php echo $pagename == 'Prdoucts'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>colors" class="nav-link <?php echo $pagename == 'Colors'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Colors</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>size" class="nav-link <?php echo $pagename == 'Size'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Size</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>country" class="nav-link <?php echo $pagename == 'Supply country'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Country</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>State" class="nav-link <?php echo $pagename == 'stata'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>State</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo SITEADMIN;?>city" class="nav-link <?php echo $pagename == 'city'?'active':'' ?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>City</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo SITEADMIN;?>coupons" class="nav-link <?php echo $pagename == 'coupons'?'active':''?> ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Coupons</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo SITEADMIN?>orders" class="nav-link <?php echo $pagename == 'orders'?'active':''?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Orders</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>pages" class="nav-link <?php echo ($pagename =='Pages')?'active':'' ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>Pages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>profile" class="nav-link <?php echo $pagename == 'Profile' ? 'active' : '' ?>  ">
                <i class="nav-icon fas fa-book"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>settings" class="nav-link <?php echo $pagename == 'Site Settings' ? 'active' : '' ?>  ">
                <i class="nav-icon fas fa-book"></i>
                <p>Site Sattings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>password.php" class="nav-link <?php echo $pagename == 'Password' ? 'active' : '' ?>  ">
                <i class="nav-icon fas fa-book"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo SITEADMIN; ?>logout.php
                " class="nav-link <?php echo $pagename == 'Logout' ? 'active' : '' ?> ">
                <i class="nav-icon fas fa-book"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
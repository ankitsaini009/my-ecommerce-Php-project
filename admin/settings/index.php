<?php
include('../../config.php');
$pagename = 'Site Settings';
$settingsdata = $conn->query("select * from settings ");
$data = $settingsdata->fetch_assoc();
//prd($data);die;


include('../includes/header.php')
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $pagename; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?></li>
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>settings/edit.php">Edit Sites</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="card col-12">
      <div class="row g-0">
        <div class="col-md-4  text-center " style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
          <h3 class="mt-5">Site Logo</h3>
          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $data['site_logo']; ?>" class="img-circle elevation-2" style="width: 100px;" alt="Avatar" class="myprofile img-fluid" />

          <h3 class="mt-5">Site Fav-Icon</h3>
          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $data['site_fav_icon']; ?>" class="img-circle elevation-2" style="width: 100px;" alt="Avatar" class="myprofile img-fluid" />
        </div>
        <div class="col-md-8">
          <div class="card-body p-4">
            <a style="text-decoration: none;" class="editicon" href="<?php echo SITEADMIN; ?>settings/edit.php?id=<?php echo $data['id'] ?>">
            </a>
            <h3>Information</h3>
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
              <div class="col-6 mb-3">
                <h4>Site Name</h4>
                <p class="text-muted"><?php echo $data['site_name'] ?></p>
              </div>
              <div class="col-6 mb-3">
                <h4>Site Email</h4>
                <p class="text-muted"><?php echo $data['site_email'] ?></p>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-6 mb-3">
                <h4>Site Contact</h4>
                <p class="text-muted"><?php echo $data['site_contact'] ?></p>
              </div>
              <div class="col-6 mb-3">
                <h4>Site Address</h4>
                <p class="text-muted"><?php echo $data['site_address'] ?></p>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-6 mb-3">
                <h4>Header-Code</h4>
                <p class="text-muted"><?php echo $data['header_code'] ?></p>
              </div>
              <div class="col-6 mb-3">
                <h4>Footer-Code</h4>
                <p class="text-muted"><?php echo $data['footer_code'] ?></p>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-12 mb-3">
                <h4>Social Media Handels</h4>
                <div class="d-flex">
                  <p><a href="<?php echo $data['facebook_url'] ?>"class="h3" target="_blank"><i class="fa-brands fa-facebook col-2 "></i></i></a></p>
                    <a href="<?php echo $data['insta_url'] ?>" class="h3" target="_blank"><i class="fa-brands fa-instagram col-2"></i></a></p>
                  </p>
                  <p><a href="<?php echo $data['twitter_url'] ?>"class="h3" target="_blank"><i class="fa-brands fa-twitter col-2"></i></i></a></p>
                  <p><a href="<?php echo $data['youtub_url'] ?>" class="h3" target="_blank"><i class="fa-brands fa-youtube col-2"></i></i></a></p>
                  <p><a href="<?php echo $data['linkdin_url'] ?>" class="h3" target="_blank"><i class="fa-brands fa-linkedin col-2"></i></i></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include('../includes/footer.php')
  ?>
<?php
include('../../config.php');
$pagename = 'Profile';
$profiledata = $conn->query("select * from users where id = '".$_SESSION['id']."' ");
$data = $profiledata->fetch_assoc();
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>profile/edit.php">Edit Profile</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="card col-12">
      <div class="row g-0">
        <div class="col-md-4  text-center " style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
          <h3 class="mt-5">Profile image</h3>
          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $data['profile_pic']; ?>"  class="img-circle elevation-2" style="width: 170px;" alt="Avatar" class="myprofile img-fluid" />
        </div>
        <div class="col-md-8">
          <div class="card-body p-4">
            <a style="text-decoration: none;" class="editicon" href="<?php echo SITEADMIN; ?>profile/edit.php?id=<?php echo $data['id'] ?>">
            </a>
            <h3>Information</h3>
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
              <div class="col-6 mb-3">
                <h4>Name</h4>
                <p class="text-muted"><?php echo $data['name'] ?></p>
              </div>
              <div class="col-6 mb-3">
                <h4>Email</h4>
                <p class="text-muted"><?php echo $data['email'] ?></p>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-6 mb-3">
                <h4>User Type</h4>
                <p class="text-muted"><?php echo $data['user_type'] ?></p>
              </div>
              <div class="col-6 mb-3">
                <h4>Phone No.</h4>
                <p class="text-muted"><?php echo $data['mobile_no'] ?></p>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-12 mb-3">
                <h4>Social Media Handels</h4>
                <div class="d-flex">
                  <p><a href=""class="h3" target="_blank"><i class="fa-brands fa-facebook col-2"></i></i></a></p>
                    <a href="" class="h3" target="_blank"><i class="fa-brands fa-instagram col-2 "></i></a></p>
                  </p>
                  <p><a href=""class="h3" target="_blank"><i class="fa-brands fa-twitter col-2 "></i></i></a></p>
                  <p><a href="" class="h3" target="_blank"><i class="fa-brands fa-youtube col-2 "></i></i></a></p>
                  <p><a href="" class="h3" target="_blank"><i class="fa-brands fa-linkedin col-2 "></i></i></a></p>
                </div>
              </div>
            </div>
      </div>
    </div>

  </div>
  <?php include('../includes/footer.php')
  ?>
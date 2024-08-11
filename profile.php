<?php
include('config.php');

$pagename = 'profile';

$userdata = $conn->query('select * from users where id = "' . $_SESSION['login_user_id'] . '" && user_type = "frontend" && status = "1"');
$mydata = $userdata->fetch_assoc();
$name = $mydata['name'];
$email = $mydata['email'];
$pass = $mydata['password'];
$phone = $mydata['mobile_no'];
$pic = $mydata['profile_pic'];

if (isset($_POST['name'])) {
  $image = $_POST['oldimage'];
  if (!empty($_FILES['image']['name'])) {
    $saininame = $_FILES['image']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "image" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/banners/' . $newfilename)) {
      $image = $newfilename;
      unlink('uploads/banners/' . $_POST['oldimage']);
    }
  }
  $update = $conn->query("update users set name = '" . $_POST['name'] . "', email = '" . $_POST['email'] . "', mobile_no = '" . $_POST['phone'] . "', profile_pic = '" . $image . "' where id = '" . $_SESSION['login_user_id'] . "'  ");
  if ($conn->query($update) == true) {
    header("location:" . SITEURL . "profile.php");
  }
}
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
            <h4>Account</h4>
            <div class="breadcrumb__links">
              <a href="">Home</a>
              <span>Account</span>
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
      <div class="col-sm-12 mt-4 mt-md-0 col-md-7 col-lg-9">
        <div class="tab-content account-tabs dashboard" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="page-title title title1 title-effect">
              <h2>My Dashboard</h2>
            </div>
            <div class="profile-edit-form">
              <div class="welcome-msg">
                <h6 class="font-light">Hello, <span><?php echo $name ?></span></h6>
                <p class="font-light">
                  From your My Account Dashboard you have the ability to
                  view a snapshot of your recent account activity and
                  update your account information. Select a link below
                  to view or edit information.
                </p>
              </div>
              <div class="order-box-contain my-4">
                <div class="row g-4">
                  <div class="col-lg-4 col-sm-12 mb-3 mb-lg-0">
                    <div class="order-box">
                      <div class="order-box-image">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                      </div>
                      <div class="order-box-contain">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                        <div>
                          <h5 class="font-light">total order</h5>
                          <h3>49</h3>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-sm-12 mb-3 mb-lg-0">
                    <div class="order-box">
                      <div class="order-box-image">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                      </div>
                      <div class="order-box-contain">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                        <div>
                          <h5 class="font-light">completed orders</h5>
                          <h3>40</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                      <div class="order-box-image">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                      </div>
                      <div class="order-box-contain">
                        <img src="https://d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg" class="img-fluid blur-up lazyloaded" alt="" />
                        <div>
                          <h5 class="font-light">wishlist</h5>
                          <h3 id="wishlistCount">1034</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-head">
                <h3>Account Information</h3>
              </div>
              <form class="userDetailForm" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="Po7bCwav9SrVH8NkmmNrMwbHGtweAbHwXPwj7eYq" />
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label>Name</label>
                    <input type="name" class="form-control" placeholder="Name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $name ?>" />
                  </div>
                  <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label>Your Email Address </label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email ?>" />
                  </div>
                  <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label>Phone No.</label>
                    <input type="number" class="form-control" placeholder="Enter Phone_No" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $phone ?>" />
                    <span class="error"></span>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <label>Profile_Pic</label>
                    <input name="image" type="file" class="form-control" placeholder="Enter Phone_No" />
                    <input name="oldimage" type="hidden" class="form-control" value="<?php echo $pic ?>">
                    <span class="error"></span>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                      <img src="<?php echo SITEURL ?>uploads/banners/<?php echo $pic ?>" alt="" width="200px">
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <button type="submit" class="btn product__btn signin_btn">
                      Update
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

<?php include('includes/footer.php'); ?>
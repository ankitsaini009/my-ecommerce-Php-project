<?php

$userdata = $conn->query('select * from users where id = "' . $_SESSION['login_user_id'] . '" && user_type = "frontend" && status = "1"');
$mydata = $userdata->fetch_assoc();
$pic = $mydata['profile_pic'];
$name = $mydata['name'];

?>
<div class="col-sm-12 col-md-12 col-lg-3">
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <div class="profile-tabs">
      <a href="<?php echo SITEURL; ?>profile.php">
        <img src="<?php echo SITEURL ?>uploads/banners/<?php echo $pic ?>" alt="profile-img" />
        <h2><?php echo $name ?></h2>
      </a>
    </div>
    <a class="nav-link <?php echo $pagename == 'profile' ? 'active' : '' ?>" id="v-pills-home-tab" href="<?php echo SITEURL; ?>profile.php" role="tab">
      My Profile</a>
    <a class="nav-link <?php echo $pagename == 'pleshoder' ? 'active' : '' ?>" id="v-pills-profile-tab" href="<?php echo SITEURL; ?>myoder.php">My Order</a>
    <!--  <a class=" nav-link" id="v-pills-messages-tab" href="cancel-order.html">Cancel Order</a> -->
    <a class="nav-link <?php echo $pagename == 'wishlist' ? 'active' : '' ?>" id="v-pills-wishlist-tab" href="<?php echo SITEURL; ?>wishlist.php">My Wishlist</a>
    <a class="nav-link <?php echo $pagename == 'cpass' ? 'active' : '' ?>" id="v-pills-wishlist-tab" href="<?php echo SITEURL; ?>cpass.php">Change Password</a>
    <a class="nav-link" id="v-pills-logout-tab" href="<?php echo SITEURL; ?>logout.php">Log Out</a>
  </div>
</div>
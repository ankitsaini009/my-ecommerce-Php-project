<?php
include('../../config.php');
$pagename = 'Edit Site';

$fetchdata = $conn->query("select * from settings")->fetch_assoc();
//prd($fetchdata);
$SiteName = $fetchdata['site_name'];
$email = $fetchdata['site_email'];
$contact = $fetchdata['site_contact'];
$address = $fetchdata['site_address'];
$favicon = $fetchdata['site_fav_icon'];
$logoimg = $fetchdata['site_logo'];
$hcode = $fetchdata['header_code'];
$fcode = $fetchdata['footer_code'];
$furl = $fetchdata['facebook_url'];
$iurl = $fetchdata['insta_url'];
$turl = $fetchdata['twitter_url'];
$yurl = $fetchdata['youtub_url'];
$lurl = $fetchdata['linkdin_url'];

if (isset($_POST['site_name'])) {

  $sitelogo = $_POST['oldlogo'];
  if (!empty($_FILES['sitelogo']['name'])) {
    $saininame = $_FILES['sitelogo']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "logo_" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['sitelogo']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
      $sitelogo = $newfilename;
      unlink('../../uploads/banners/' . $_POST['oldlogo']);
    }
  }
  $siteicon = $_POST['oldicon'];
  if (!empty($_FILES['favicon']['name'])) {
    $saininame = $_FILES['favicon']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "icon_" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['favicon']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
      $siteicon = $newfilename;
      unlink('../../uploads/banners/' . $_POST['oldicon']);
    }
  }
  $siteupdate = "update settings set site_name = '" . $_POST['site_name'] . "', site_email = '" . $_POST['site_email'] . "',site_contact = '" . $_POST['site_contact'] . "',site_address = '" . $_POST['site_address'] . "',site_fav_icon = '" . $siteicon . "',site_logo = '" . $sitelogo . "',header_code = '" . $_POST['header_code'] . "',footer_code = '" . $_POST['footer_code'] . "',facebook_url = '" . $_POST['facebook_url'] . "',insta_url = '" . $_POST['insta_url'] . "',twitter_url = '" . $_POST['twitter_url'] . "',youtub_url = '" . $_POST['youtub_url'] . "',linkdin_url = '" . $_POST['linkdin_url'] . "',updated_at = '" . date('Y-m-d H:i:s') . "' ";
  //prd($siteupdate); 
  if ($conn->query($siteupdate) == true) {
    $_SESSION['success_msg'] = "Sittings edit successfully ";
    header("location:" . SITEADMIN . "settings");
  }
}
include('../includes/header.php')
?>
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $pagename; ?> </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>settings">Site Settings</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $pagename; ?> Edit </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Site Name</label>
                      <input name="site_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $SiteName ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Site Email</label>
                      <input name="site_email" type="email" class="form-control" id="subject" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $email ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">site Contact</label>
                      <input name="site_contact" type="text" class="form-control" id="subject" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $email ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Site Address</label>
                      <input name="site_address" class="form-control" id="description" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $address ?>"></input>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Header Code</label>
                      <textarea name="header_code" type="number" class="form-control" id="button_txt"><?php echo isset($_POST['name']) ? $_POST['name'] : $hcode ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Footer Code</label>
                      <textarea name="footer_code" type="number" class="form-control" id="button_txt"><?php echo isset($_POST['name']) ? $_POST['name'] : $fcode ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Facebook url</label>
                      <input name="facebook_url" type="url" class="form-control" id="button_txt" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $furl ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Insta url</label>
                      <input name="insta_url" type="url" class="form-control" id="button_txt" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $iurl ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Twitter url</label>
                      <input name="twitter_url" type="url" class="form-control" id="button_txt" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $turl ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Youtub url</label>
                      <input name="youtub_url" type="url" class="form-control" id="button_txt" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $yurl ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Linkdin url</label>
                      <input name="linkdin_url" type="url" class="form-control" id="button_txt" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $lurl ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Site Logo</label>
                          <input name="sitelogo" type="file" class="form-control" id="button_txt">
                          <input name="oldlogo" type="hidden" class="form-control" value="<?php echo $logoimg ?>">
                          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $logoimg ?>" width="100px">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Site Fav Icon</label>
                          <input name="favicon" type="file" class="form-control" id="button_txt">
                          <input name="oldicon" type="hidden" class="form-control" value="<?php echo $favicon ?>">
                          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $favicon ?>" width="100px">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../includes/footer.php'); ?>
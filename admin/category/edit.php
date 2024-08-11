<?php
require('../../config.php');
$pagename = "Category";
//prd(("SELECT * from banners where id = '".($_GET["id"])."' "));
$getdata = $conn->query("SELECT * from Category where id = '" . ($_GET["id"]) . "' ");
$olddata = $getdata->fetch_assoc();
$title = $olddata['name'];
$imgage = $olddata['image'];
$status = $olddata['status'];
$dmanu = $olddata['display_menu'];
$dhome = $olddata['display_home'];


if (isset($_POST['name'])) {
  $isvalid = 1;
  if (empty($_POST['name'])) {
    $isvalid = 0;
    $titleerr = "Plese enter name";
  }

  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if ($isvalid == 1) {


    $profilepic = $_POST['oldimgprofile'];
    if (!empty($_FILES['img']['name'])) {
      $saininame = $_FILES['img']['name'];
      $ext = pathinfo($saininame, PATHINFO_EXTENSION);
      $newfilename = "img" . time() . "_" . rand(00000, 99999) . "." . $ext;
      if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
        $profilepic = $newfilename;
        unlink('../../uploads/banners/' . $_POST['oldimgprofile']);
      }
    }
    $updatdata = " update Category set name = '" . $_POST['name'] . "', status = '" . $_POST['status'] . "',display_menu = '" . $_POST['dmanu'] . "',display_home = '" . $_POST['dhome'] . "', image='" . $profilepic . "', updated_at='" . date('Y-m-d H:i:s') . "' where id='" . $_GET["id"] . "' ";
    //prd( $updatdata);
    if ($conn->query($updatdata) === true) {

      $_SESSION['success_msg'] = "Category Edit Successfully";
      header("location:" . SITEADMIN . "category");
    }
  }
}

include('../includes/header.php');
?>

<!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>Category">Category List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Edit</li>
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
              <h3 class="card-title"><?php echo $pagename; ?> Add</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $title ?>">
                      <p class="text-danger"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          $sel = ($status == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Display Menu</label>
                      <select name="dmanu" class="form-control" id="Featured">
                        <option value="">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          $asl = ($dmanu == $stkey)?'selected':'';
                          echo '<option value="' . $stkey . '"'.$asl.'>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Display Home</label>
                      <select name="dhome" class="form-control" id="Featured">
                        <option value="">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          $asl = ($dhome == $stkey)?'selected':'';
                          echo '<option value="' . $stkey . '"'.$asl .'>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Category Image</label>
                          <input name="img" type="file" class="form-control" id="button_txt">
                          <input name="oldimgprofile" type="hidden" value="<?php echo $imgage ?>">
                          <img src="<?php echo SITEURL ?>uploads/banners/<?php echo $imgage ?>" width="100">
                        </div>
                      </div>
                      <p class="text-danger"><?php echo isset($imgerr) ? $imgerr : '' ?></p>
                    </div>
                  </div>

                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> Edit </button>
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

<?php require('../includes/footer.php'); ?>
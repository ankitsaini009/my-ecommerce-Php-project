<?php
require('../../config.php');
$pagename = "Banners";
//prd(("SELECT * from banners where id = '".($_GET["id"])."' "));
$getdata = $conn->query("SELECT * from banners where id = '" . ($_GET["id"]) . "' ");
$olddata = $getdata->fetch_assoc();
//prd($olddata);

$title = $olddata['title'];
$subject = $olddata['subject'];
$description = $olddata['description'];
$imgage = $olddata['imgage'];
$url = $olddata['url'];
$button_txt = $olddata['button_txt'];
$status = $olddata['status'];

if (isset($_POST['title'])) {
  $isvalid = 1;
  if (empty($_POST['title'])) {
    $isvalid = 0;
    $titleerr = "Plese enter title";
  }

  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if($isvalid == 1){
   

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
    $updatdata = " update banners set title = '" . $_POST['title'] . "', subject = '" . $_POST['subject'] . "',  description = '" . $_POST['description'] . "',  url = '" . $_POST['url'] . "',  button_txt = '" . $_POST['button_txt'] . "',  status = '" . $_POST['status'] . "', imgage='" . $profilepic . "', updated_at='".date('Y-m-d H:i:s')."' where id='".$_GET["id"]."' ";
    if ($conn->query($updatdata) === true) {
     
      $_SESSION['success_msg'] = "Banner Edit Successfully";
      header("location:" . SITEADMIN . "banners");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>banners">Banner List</a></li>
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
              <h3 class="card-title"><?php echo $pagename; ?> Edit</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $title ?>">
                      <p class="text-danger"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Sub Title</label>
                      <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter Sub Title" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : $subject ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea name="description" class="form-control" id="description" placeholder=" Enter Description"><?php echo isset($_POST['description']) ? $_POST['description'] : $description ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Url</label>
                      <input name="url" type="url" class="form-control" id="exampleInputPassword1" placeholder=" Enter  Url" value="<?php echo isset($_POST['url']) ? $_POST['url'] : $url ?> ">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Button Text</label>
                      <input name="button_txt" type="text" class="form-control" id="button_txt" placeholder=" Enter Button Text" value="<?php echo isset($_POST['button_txt']) ? $_POST['button_txt'] : $button_txt ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue  ) {
                          $sel= ($status==$stkey)?'selected':'';
                          echo '<option value="' . $stkey . '" '. $sel.'>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Banner Image</label>
                          <input name="img" type="file" class="form-control" id="button_txt" >
                          <input name="oldimgprofile" type="hidden" value="<?php echo $imgage ?>">
                          <img src="<?php echo SITEURL?>uploads/banners/<?php echo $imgage?>" width="100">
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

<?php require('../includes/footer.php');?>
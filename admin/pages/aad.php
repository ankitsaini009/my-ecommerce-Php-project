<?php
include('../../config.php');
$pagename = 'Pages';

if (isset($_POST['title'])) {
  $isvalid = 1;

  if (empty($_POST['title'])) {
    $isvalid = 0;

    $titleerror = 'Plese enter title';
  }
  if (empty($_POST['description'])) {
    $isvalid = 0;

    $descriptionerror = 'Plese enter description';
  }
  if ($isvalid == 1) {
 
    
    $profilename = '';
    $saininame = $_FILES['img']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "img_" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/'. $newfilename)) {
      $profilename = $newfilename;
    }

    $insertdata = "insert into pages (`title`,`description`,`status`,`banner`,`created_at`,`updated_at`) values ( '".$_POST['title']."','".$_POST['description']."','".$_POST['status']."','".$profilename."','". date('Y-m-d H:i:s') ."','". date('Y-m-d H:i:s') ."' ) ";
    //prd($insertdata);
    if($conn->query($insertdata)==true){
      $_SESSION['success_msg'] = 'Pages aad successfully';
      header("location:".SITEADMIN."pages");
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
          <h1 class="m-0">Your <?php echo $pagename; ?> </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>pages">Pages</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Add</li>
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
              <h3 class="card-title"><?php echo $pagename; ?> Add </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                      <p class="text-danger"><?php echo isset($titleerror) ? $titleerror : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea name="description" type="text" class="form-control" id="subject" placeholder="Enter description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : '' ?>"></textarea>
                      <p class="text-danger"><?php echo isset($descriptionerror) ? $descriptionerror : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          $ankit = ($status == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '"' . $ankit . ' >' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Pages Img</label>
                          <input name="img" type="file" class="form-control" id="button_txt">
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
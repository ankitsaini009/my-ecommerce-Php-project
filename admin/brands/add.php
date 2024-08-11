<?php require('../../config.php');
//prd($_POST);die;
$pagename = "Brands";
//prd($_POST);
if (isset($_POST['name'])) {
  //prd($_FILES);die;
  $isvalid = 1;
  if (empty($_POST['name'])) {
    $isvalid = 0;
    $titleerr = "Plese enter name";
  }
  if (empty($_FILES['img']['name'])) {
    $isvalid = 0;
    $imgerr = "Select Banner imag";
  }
  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if ($isvalid == 1) {

    $profilename = '';
    $saininame = $_FILES['img']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "banners_" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
      $profilename = $newfilename;
    }
    $dataentry = "insert into brands ( `name`,`image`,`status`, `created_at`, `updated_at`) VALUES ('" . $_POST['name'] . "','" . $profilename . "','" . $_POST['status'] . "','" . date('Y-m-d H:i:s') . "' , '" . date('Y-m-d H:i:s') . "')";

    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "Brand added successfully.";
      header("location:" . SITEADMIN . "Brands");
    }
  }
}
require('../includes/header.php');
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>Brands">Brands List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?>Add</li>
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
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter Your name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                      <p class="text-danger" id="nameerr"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          echo '<option value="' . $stkey . '">' . $stvalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="statuserr"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Banner Image</label>
                          <input name="img" type="file" class="form-control" id="image" placeholder=" Enter Your Button Text">
                        </div>
                      </div>
                      <p class="text-danger" id="imageerr"><?php echo isset($imgerr) ? $imgerr : '' ?></p>
                    </div>
                  </div>   
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return avelidation()">Submit</button>
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
<script>
  function avelidation() {
    pname = document.getElementById('name').value;
    if (pname == '') {
      document.getElementById('nameerr').innerHTML = "*Plese Enter Brand Name";
      document.getElementById('name').focus();
      return false;
    } else {
      document.getElementById('nameerr').innerHTML = "";
    }
    mystatus = document.getElementById('status').value;
    if (mystatus == '') {
      document.getElementById('statuserr').innerHTML = "*Plese select your Status";
      document.getElementById('status').focus();
      return false;
    } else {
      document.getElementById('statuserr').innerHTML = "";
    }

    myimage = document.getElementById('image').value;
    if (myimage == '') {
      console.log('This is empty')
      document.getElementById('imageerr').innerHTML = "*Pleser select Brand image";
      document.getElementById('image').focus();
      return false;
    } else {
      document.getElementById('imageerr').innerHTML = "";
    }
  }
</script>
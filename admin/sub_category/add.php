<?php require('../../config.php');
$pagename = "Sub Category";
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
    $imgerr = "Select imag";
  }
  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if (empty($_POST['category_id'])) {
    $isvalid = 0;
    $categoryerror = "Select category";
  }
  if ($isvalid == 1) {
    $profilename = '';
    $name = $_FILES['img']['name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $newfilename = "subcategory" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
      $profilename = $newfilename;
    }
    $dataentry = "INSERT INTO`Sub_category`(`name`, `image`,`status`, `category_id`, `created_at`, `updated_at`) VALUES ('" . $_POST['name'] . "','" . $profilename . "','" . $_POST['status'] . "','" . $_POST['category_id'] . "','" . date('Y-m-d H:i:s') . "' , '" . date('Y-m-d H:i:s') . "')";
    //prd($dataentry);die;
    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "subcategory added successfully.";
      header("location:" . SITEADMIN . "sub_category");
    }
  }
}
$getcategory = $conn->query("select * from category where dstatus=0 && status=1 order by name asc");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>sub_category">Sub Category List</a></li>
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
                      <p class="text-danger" id="nameerr"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select Category</label>
                      <select name="category_id" class="form-control" id="categoryid">
                        <option value="">Select Category</option>
                        <?php while ($singlecategory = $getcategory->fetch_assoc()) { ?>
                          <option value="<?php echo $singlecategory['id']; ?>"><?php echo ucfirst($singlecategory['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger" id="categoryiderr"><?php echo isset($categoryerror) ? $categoryerror : '' ?></p>
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
                  </div <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Banner Image</label>
                    <input name="img" type="file" class="form-control" id="img" placeholder=" Enter Your Button Text">
                    <p class="text-danger" id="imgerr"><?php echo isset($imgerr) ? $imgerr : '' ?></p>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" onclick="return avalidetion()">Submit</button>
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
  function avalidetion() {
    name = document.getElementById('name').value;
    if (name == '') {
      document.getElementById('nameerr').innerHTML = '*Plese enter your name';
      document.getElementById('name').focus();
      return false;
    } else {
      document.getElementById('nameerr').innerHTML = '';
    }
    categoryid = document.getElementById('categoryid').value;
    if (categoryid == '') {
      document.getElementById('categoryiderr').innerHTML = '*Plese select categoryid';
      document.getElementById('categoryid').focus();
      return false;
    } else {
      document.getElementById('categoryiderr').innerHTML = '';
    }
    status = document.getElementById('status').value;
    if (status == '') {
      document.getElementById('statuserr').innerHTML = '*Plese select status';
      document.getElementById('status').focus();
      return false;
    } else {
      document.getElementById('statuserr').innerHTML = '';
    }
    img = document.getElementById('img').value;
    if (img == '') {
      document.getElementById('imgerr').innerHTML = '*Plese select img';
      document.getElementById('img').focus();
      return false;
    } else {
      document.getElementById('imgerr').innerHTML = '';
    }
  }
</script>
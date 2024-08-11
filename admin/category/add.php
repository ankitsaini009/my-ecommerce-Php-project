<?php require('../../config.php');
//prd($_POST);die;
$pagename = "Category";
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
    $dataentry = "insert into Category ( `name`,`image`,`status`,`display_menu`,`display_home`,`created_at`, `updated_at`) VALUES ('" . $_POST['name'] . "','" . $profilename . "','" . $_POST['status'] . "','" . $_POST['dmanu'] . "','" . $_POST['dhome'] . "','" . date('Y-m-d H:i:s'). "' , '" . date('Y-m-d H:i:s') . "')";
    //prd($dataentry);
    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "Category added successfully.";
      header("location:" . SITEADMIN . "category");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>category">Category List</a></li>
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
                    </div>
                    <p class="text-danger" id="statuserr"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Display Menu</label>
                      <select name="dmanu" class="form-control" id="dmanu">
                        <option value="">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          echo '<option value="' . $stkey . '">' . $stvalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="dmanuerr"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Display Home</label>
                      <select name="dhome" class="form-control" id="dhome">
                        <option value="">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          echo '<option value="' . $stkey . '">' . $stvalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="dhomeerr"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Category Image</label>
                          <input name="img" type="file" class="form-control" id="img">
                        </div>
                      </div>
                      <p class="text-danger" id="imgerr"><?php echo isset($imgerr) ? $imgerr : '' ?></p>
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
  function avalidetion(){
    name = document.getElementById('name').value;
    if(name==""){
      document.getElementById('nameerr').innerHTML = '*Plese enter name';
      document.getElementById('name').focus();
      return false;
    }else{
      document.getElementById('nameerr').innerHTML = '';
    }
    status = document.getElementById('status').value;
    if(status==""){
      document.getElementById('statuserr').innerHTML = '*Plese select status';
      document.getElementById('status').focus();
      return false;
    }else{
      document.getElementById('statuserr').innerHTML = '';
    }
    dmanu = document.getElementById('dmanu').value;
    if(dmanu==""){
      document.getElementById('dmanuerr').innerHTML = '*Plese select dmanu';
      document.getElementById('dmanu').focus();
      return false;
    }else{
      document.getElementById('dmanuerr').innerHTML = '';
    }
    dhome = document.getElementById('dhome').value;
    if(dhome==""){
      document.getElementById('dhomeerr').innerHTML = '*Plese enter dhome';
      document.getElementById('dhome').focus();
      return false;
    }else{
      document.getElementById('dhomeerr').innerHTML = '';
    }
    img = document.getElementById('img').value;
    if(img==""){
      document.getElementById('imgerr').innerHTML = '*Plese select img';
      document.getElementById('img').focus();
      return false;
    }else{
      document.getElementById('imgerr').innerHTML = '';
    }
  }
</script>
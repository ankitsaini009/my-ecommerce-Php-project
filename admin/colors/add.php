<?php require('../../config.php');
//prd($_POST);die;
$pagename = "Color";
//prd($_POST);
if (isset($_POST['name'])) {
  //prd($_FILES);die;
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
    $dataentry = "insert into color ( `name`,`status`, `hex_value`) VALUES ('" . $_POST['name'] . "','" . $_POST['status'] . "','" . $_POST['value'] . "')";
    //prd( $dataentry);
    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "color added successfully.";
      header("location:" . SITEADMIN . "colors");
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
                      <label for="exampleInputEmail1">Color Name</label>
                      <input name="name" type="name" class="form-control" id="name" placeholder="Enter Your name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                      <p class="text-danger" id="nameerr"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Color Value</label>
                      <input name="value" type="color" class="form-control" id="colval" placeholder="Enter Your name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                      <p class="text-danger" id="colvalerr"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Your Status</label>
                    <select name="status" class="form-control" id="status">
                      <option value="">Select Status</option>
                      <?php foreach ($statusarray as $stkey => $stvalue) {
                        echo '<option value="' . $stkey . '">' . $stvalue . '</option>';
                      } ?>
                    </select>
                  </div>
                  <p class="text-danger" id="statuserr"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return validetion()">Submit</button>
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
  function validetion() {
    name = document.getElementById('name').value;
    if (name == '') {
      document.getElementById('nameerr').innerHTML = '*Plese enter color name ';
      document.getElementById('name').focus();
      return false;
    }else{
      document.getElementById('nameerr').innerHTML = '';

    }
    colval = document.getElementById('colval').value;
    if (colval == '') {
      document.getElementById('colvalerr').innerHTML = '*Plese select color value ';
      document.getElementById('colval').focus();
      return false;
    }else{
      document.getElementById('colvalerr').innerHTML = '';

    }
    status = document.getElementById('status').value;
    if (status == '') {
      document.getElementById('statuserr').innerHTML = '*Plese select color status ';
      document.getElementById('status').focus();
      return false;
    }else{
      document.getElementById('statuserr').innerHTML = '';

    }
  }
</script>
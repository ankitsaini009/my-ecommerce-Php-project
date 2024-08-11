<?php require('../../config.php');
//prd($_POST);die;
$pagename = "Banners";
//prd($_POST);
if (isset($_POST['title'])) {
  //prd($_FILES);die;
  $isvalid = 1;
  if (empty($_POST['title'])) {
    $isvalid = 0;
    $titleerr = "Plese enter title";
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
    $dataentry = "insert into banners ( `title`, `subject`, `description`, `imgage`, `url`, `button_txt`, `status`, `created_at`, `updated_at`) VALUES ('" . $_POST['title'] . "','" . $_POST['subject'] . "','" . $_POST['description'] . "','" . $profilename . "','" . $_POST['url'] . "','" . $_POST['button_txt'] . "','" . $_POST['status'] . "','" . date('Y-m-d H:i:s') . "' , '" . date('Y-m-d H:i:s') . "')";

    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "Banner added successfully.";
      header("location:" . SITEADMIN . "banners");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>banners">Banner List</a></li>
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
                      <label for="exampleInputEmail1">Title</label>
                      <input name="title" type="text" class="form-control" id="title" placeholder="Enter Your Title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                      <p class="text-danger" id="titleerr"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Sub Title</label>
                      <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter Your Sub Title" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : '' ?>">
                      <p class="text-danger" id="subjecterr"></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea name="description" class="form-control" id="description" placeholder=" Enter Your Description"><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                      <p class="text-danger" id="descriptionerr"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Url</label>
                      <input name="url" type="url" class="form-control" id="url" placeholder=" Enter Your Url" value="<?php echo isset($_POST['url']) ? $_POST['url'] : '' ?>">
                      <p class="text-danger" id="urlerr"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Button Text</label>
                      <input name="button_txt" type="text" class="form-control" id="buttontxt" placeholder=" Enter Your Button Text" value="<?php echo isset($_POST['button_txt']) ? $_POST['button_txt'] : '' ?>">
                      <p class="text-danger" id="buttontxterr"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status" value="">
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
    atitle = document.getElementById('title').value;
    if(atitle== ''){
      document.getElementById('titleerr').innerHTML = '*Plese enter title';
      document.getElementById('title').focus();
      return false;
    }else{
      document.getElementById('titleerr').innerHTML = '';
    }
    subject = document.getElementById('subject').value;
    if(subject== ''){
      document.getElementById('subjecterr').innerHTML = '*Plese enter subject';
      document.getElementById('subject').focus();
      return false;
    }else{
      document.getElementById('subjecterr').innerHTML = '';
    }

    description = document.getElementById('description').value;
    if(description== ''){
      document.getElementById('descriptionerr').innerHTML = '*Plese enter description';
      document.getElementById('description').focus();
      return false;
    }else{
      document.getElementById('descriptionerr').innerHTML = '';
    }

    url = document.getElementById('url').value;
    if(url== ''){
      document.getElementById('urlerr').innerHTML = '*Plese enter url';
      document.getElementById('url').focus();
      return false;
    }else{
      document.getElementById('urlerr').innerHTML = '';
    }

    buttontxt = document.getElementById('buttontxt').value;
    if(buttontxt== ''){
      document.getElementById('buttontxterr').innerHTML = '*Plese enter buttontxt';
      document.getElementById('buttontxt').focus();
      return false;
    }else{
      document.getElementById('buttontxterr').innerHTML = '';
    }

    status = document.getElementById('status').value;
    if(status== ''){
      document.getElementById('statuserr').innerHTML = '*Plese select status';
      document.getElementById('status').focus();
      return false;
    }else{
      document.getElementById('statuserr').innerHTML = '';
    }

    image = document.getElementById('image').value;
    if(image== ''){
      document.getElementById('imageerr').innerHTML = '*Plese select image';
      document.getElementById('image').focus();
      return false;
    }else{
      document.getElementById('imageerr').innerHTML = '';
    }


  }
</script>
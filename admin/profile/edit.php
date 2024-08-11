<?php include('../../config.php');
$pagename = 'Profile';
//prd(("select * from users where id = '".$_SESSION['id']."' && dstatus=0 "));
$data = $conn->query("select * from users where id = '" . $_SESSION['id'] . "' && dstatus=0 ");
$newdata = $data->fetch_assoc();
//prd($newdata);
$name = $newdata['name'];
$email = $newdata['email'];
$password = $newdata['password'];
$user_type = $newdata['user_type'];
$mobile_no = $newdata['mobile_no'];
$profile_pic = $newdata['profile_pic'];
$status = $newdata['status'];

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

    $image = $_POST['oldimage'];
    if (!empty($_FILES['image']['name'])) {
      $saininame = $_FILES['image']['name'];
      $ext = pathinfo($saininame, PATHINFO_EXTENSION);
      $newfilename = "image" . time() . "_" . rand(00000, 99999) . "." . $ext;
      if (move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
        $image = $newfilename;
        unlink('../../uploads/banners/' . $_POST['oldimage']);
      }
    }

    $updataedata = "update users set name = '" . $_POST['name'] . "' ,  email = '" . $_POST['email'] . "' ,  password = '" . $_POST['password'] . "', user_type = '" . $_POST['type'] . "' , mobile_no = '" . $_POST['phoneno'] . "' , profile_pic = '" . $image . "' , status = '" . $_POST['status'] . "' WHERE id = '" . $_SESSION['id'] . "'  ";
    //prd($updataedata);
    if ($conn->query($updataedata) == true) {
      $_SESSION['success_msg'] = "Profile update successfully";
      header("location:" . SITEADMIN . "profile");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>profile">Profile</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?>Edit</li>
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
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter  name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $name ?>">
                      <p class="text-danger"><?php echo isset($nameerror) ? $nameerror : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input name="email" type="email" class="form-control" id="subject" placeholder="Enter  email" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $email ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input name="password" class="form-control" id="description" placeholder=" Enter password" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $password ?>"></input>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">User Type</label>
                      <select name="type" class="form-control" id="status">
                        <option value="">Select Usertype</option>
                        <?php foreach ($usertype as $userkey => $uservalue) {
                          $asp = ($user_type == $uservalue)? 'selected' : '';
                          echo '<option value="' . $userkey . '"' . $asp . ' >' . $uservalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($tupeerror) ? $tupeerror : '' ?></p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Phone No</label>
                      <input name="phoneno" type="number" class="form-control" id="button_txt" placeholder=" Enter Phone No" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $mobile_no ?>">
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
                      <p class="text-danger"><?php echo isset($statuserror) ? $statuserror : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Profile</label>
                          <input name="image" type="file" class="form-control" id="button_txt">
                          <input name="oldimage" type="hidden" class="form-control" value="<?php echo $profile_pic ?>">
                          <img src="<?php echo SITEURL; ?>uploads/banners/<?php echo $profile_pic ?>" width="100px">
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
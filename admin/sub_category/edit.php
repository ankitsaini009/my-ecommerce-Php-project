<?php
require('../../config.php');
$pagename = "Sub Category";
//prd(("SELECT * from banners where id = '".($_GET["id"])."' "));
$getdata = $conn->query("SELECT * from sub_category where id = '" . ($_GET["id"])."'");
$olddata = $getdata->fetch_assoc();
//prd($olddata);

$name = $olddata['name'];
$imgage = $olddata['image'];
$category = $olddata['category_id'];
//prd($category);
$status = $olddata['status'];

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
  if($isvalid == 1){
   

    $profilepic = $_POST['oldimgprofile'];
    if (!empty($_FILES['img']['name'])) {
        $saininame = $_FILES['img']['name'];
        $ext = pathinfo($saininame, PATHINFO_EXTENSION);
        $newfilename = "img" . time() . "_" . rand(00000, 99999) . "." . $ext;
        if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
          $profilepic = $newfilename;
          @unlink('../../uploads/banners/' . $_POST['oldimgprofile']);
        }
    }
    $updatdata = " update sub_category set name = '" . $_POST['name'] . "',category_id = '" . $_POST['category_id'] . "', status = '" . $_POST['status'] . "', image='" . $profilepic . "', updated_at='".date('Y-m-d H:i:s')."' where id='".$_GET["id"]."' ";
    //prd($updatdata);die;
    if ($conn->query($updatdata) === true) {
      $_SESSION['success_msg'] = "Banner Edit Successfully";
      header("location:" . SITEADMIN . "Sub_category");
    }
  }
}
$getcategory = $conn->query("select * from category where dstatus=0 && status=1 order by name asc");
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
                      <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Your name" value="<?php echo isset($_POST['name'])?$_POST['name']:$name?>"
                      <p class="text-danger"><?php echo isset($nameerr) ? $nameerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select Category</label>
                      <select name="category_id" class="form-control" id="category_id">
                          <option value="">Select Category</option>
                          <?php while($singlecategory = $getcategory->fetch_assoc()){?>
                            <?php $selected = ''; 
                            if($singlecategory['id'] == $category){
                              $selected = 'selected';
                            }

                            ?>

                            <option value="<?php echo $singlecategory['id'];?>"<?php echo $selected ?>><?php echo ucfirst($singlecategory['name']);?></option>
                          <?php } ?>
                      </select>
                   
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
                  </div
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="exampleInputPassword1">Banner Image</label>
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

<?php require('../includes/footer.php');?>
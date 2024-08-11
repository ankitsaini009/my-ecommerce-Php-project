<?php require('../../config.php');
$pagename = "Prdoucts";

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
} //echo 11;die;
$per_page_recode = 6;
$offset = ($pageno - 1) * $per_page_recode;


$sarchkey = '';
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
  $sarchkey .= ' && prdoucts.name Like "%' . trim($_GET['keyword']) . '%"';
}
if (isset($_GET['prdoucts status']) && !empty($_GET['status'])) {
  $sarchkey .= ' && prdoucts.status = "' . $_GET['status'] . '"';
}
$recordcount = $conn->query("SELECT prdoucts.*, category.name as categoryname ,sub_category.name as subcategoryname,brands.name as brandsname FROM `prdoucts` left join category on prdoucts.category_id=category.id left join sub_category on prdoucts.subcategory_id=sub_category.id left join brands on prdoucts.brand_id=brands.id WHERE prdoucts.dstatus=0" . $sarchkey);


$total_rows = $recordcount->num_rows;

$total_pages = ceil($total_rows / $per_page_recode);


$getdata = $conn->query("SELECT prdoucts.*, category.name as categoryname ,sub_category.name as subcategory,brands.name as brands FROM `prdoucts` left join category on prdoucts.category_id=category.id left join sub_category on prdoucts.subcategory_id=sub_category.id left join brands on prdoucts.brand_id=brands.id WHERE prdoucts.dstatus=0" . $sarchkey . " order by id desc LIMIT " . $offset . "," . $per_page_recode);
require('../includes/header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $pagename; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?></li>
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
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                  <h3 class="card-title"><?php echo $pagename; ?> List</h3>
                </div>
                <div class="col-md-4 text-right">
                  <a href="<?php echo SITEADMIN; ?>prdoucts/add.php" class="btn btn-success ">Add More</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" name="keyword" placeholder="Enter to Search" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] :''?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          $sel = (isset($_GET['status']) && $_GET['status'] == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button class="btn btn-success">Search</button>
                      <a href="<?php echo SITEADMIN; ?>banners" class="btn btn-danger">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">NO.</th>
                    <th>Name</th>
                    <th>category</th>
                    <th>subcategory</th>
                    <th>brands</th>
                    <th>Img</th>
                    <th>status</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $startno = ($pageno - 1) * $per_page_recode;
                  while ($data = $getdata->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo ++$startno; ?></td>
                      <td><?php echo $data['name']; ?></td>
                      <td><?php echo $data['categoryname']; ?></td>
                      <td><?php echo $data['subcategory']; ?></td>
                      <td><?php echo $data['brands']; ?></td>
                      <td><img src="<?php echo SITEURL . 'uploads/banners/' . $data['main_image']; ?>" width="70"></td>
                      <td><?php echo $data['status'] == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?></td>
                      <td style="width: 180px;">
                        <?php if($data['product_type']==2){?>
                          <a href="<?php echo SITEADMIN; ?>prdoucts/edit.php?id=<?php echo $data['id'] ?>" class="btn-sm btn-success">Edit</a>
                          <a href="javascript:void(0);" onclick="detleterecord('Are You Delete This Banner','<?php echo SITEADMIN; ?>prdoucts/delete.php?id=<?php echo $data['id'] ?>')" class="btn-sm btn-danger">Delete</a>
                        <a href="<?php echo SITEADMIN; ?>prdoucts/color.php?id=<?php echo $data['id'] ?>" class="btn-sm btn-info">Color</a>
                        <?php }else{?>
                          <a href="<?php echo SITEADMIN; ?>prdoucts/edit.php?id=<?php echo $data['id'] ?>" class="btn-sm btn-success" style="margin-left:10px;">Edit</a>
                        <a href="javascript:void(0);" onclick="detleterecord('Are You Delete This Banner','<?php echo SITEADMIN; ?>prdoucts/delete.php?id=<?php echo $data['id'] ?>')" class="btn-sm btn-danger" style="margin-left:25px;">Delete</a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-body -->
            <div class="card-footer clearfix">

              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                <li class="page-item <?php if ($pageno <= 1) {
                                        echo 'disabled';
                                      } ?>">

                  <a class="page-link" href="<?php if ($pageno <= 1) {
                                                echo '#';
                                              } else {
                                                echo "?pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>

                </li>
                <li class="page-item <?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                      } ?>">
                  <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                echo '#';
                                              } else {
                                                echo "?pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                </li>

                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
              </ul>
            </div>
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
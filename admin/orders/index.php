<?php require('../../config.php');
$pagename = "orders";

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
} //echo 11;die;
$no_of_records_per_page = 6;
$offset = ($pageno - 1) * $no_of_records_per_page;

$addsearch = '';
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
  $addsearch .= 'order_no Like "%' .($_GET['keyword']) . '%"';
}
$countrecord = $conn->query("SELECT * FROM `orders`");
$total_rows = $countrecord->num_rows;
$total_pages = ceil($total_rows / $no_of_records_per_page);
$getdata = $conn->query("SELECT * FROM `orders`" . $addsearch);
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
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="" method="GET">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="keyword" placeholder="Enter to Search" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <button class="btn btn-success">Search</button>
                          <a href="<?php echo SITEADMIN; ?>orders" class="btn btn-danger">Reset</a>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">Sr.NO.</th>
                    <th>Order No</th>
                    <th>Placed By</th>
                    <th>Placed On</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $startno = ($pageno - 1) * $no_of_records_per_page;
                  while ($data = $getdata->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo ++$startno; ?></td>
                      <td><?php echo $data['order_no']; ?></td>
                      <td><?php echo $data['f_name'] . $data['l_name']; ?></td>
                      <td><?php echo $data['shipping_date']; ?></td>
                      <td style="width:170px;">
                        <a href="<?php echo SITEADMIN; ?>orders/edit.php?id=<?php echo $data['id'] ?>" class="btn-sm btn-success">Update</a>
                        <a href="<?php echo SITEADMIN; ?>orders/view.php?id=<?php echo $data['id'] ?>" class="btn-sm btn-warning">view</a>
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
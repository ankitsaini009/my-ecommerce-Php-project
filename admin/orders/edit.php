<?php
require('../../config.php');
$pagename = "orders";
$getdata = $conn->query("SELECT * from orders where id = '" . ($_GET["id"]) . "' ");
$olddata = $getdata->fetch_assoc();

$order_no = $olddata['order_no'];
$orderstatus = $olddata['order_status'];
$shippingstatus = $olddata['shipping_status'];

if (isset($_POST['shippingdate'])) {

  $updateoder = $conn->query(" UPDATE `orders` SET `order_status`='" . $_POST['orderstatus'] . "',`shipping_status`='" . $_POST['deliverystatus'] . "',`shipping_date`='" . $_POST['shippingdate'] . "',`delivery_date`='" . $_POST['deliveryDate'] . "' WHERE id = '".$_GET['id']."' ");

    header("location:".SITEADMIN."orders");
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
          <h1 class="m-0"><?php echo $pagename; ?> </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>orders">Orders List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Edit</li>
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
              <h3 class="card-title"><?php echo $pagename; ?> Edit</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Give Shipping Date:</label>
                      <input autocomplete="off" name="shippingdate" type="text" class="form-control" id="shippingDate" placeholder="Select Shipping Date" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Give Delivery Date:</label>
                      <input name="deliveryDate" type="text" autocomplete="off" class="form-control" id="deliveryDate" placeholder="Select Delivery Date " value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Order Status</label>
                      <select name="orderstatus" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($shipping as $stkey => $stvalue) {
                          $sel = ($orderstatus == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Delivery Status</label>
                      <select name="deliverystatus" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($order as $stkey => $stvalue) {
                          $sel = ($shippingstatus == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success"> UPDATE </button>
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
  $(document).ready(function() {
    var startDateInput = $('#shippingDate');
    var endDateInput = $('#deliveryDate');

    startDateInput.datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      startDate: '0',
    });

    endDateInput.datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true
    }).on('show', function(event) {
      var startDate = startDateInput.datepicker('getDate');
      if (startDate !== null) {
        $(this).datepicker('setStartDate', startDate);
      }
    });
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
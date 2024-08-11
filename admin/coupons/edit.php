<?php
require('../../config.php');
$pagename = "coupons";
//prd(("SELECT * from banners where id = '".($_GET["id"])."' "));
$getdata = $conn->query("SELECT * from coupons where id = '" . ($_GET["id"]) . "' ");
$olddata = $getdata->fetch_assoc();
//prd($olddata);

$code = $olddata['coupan_code'];
$user = $olddata['user_id'];
$type = $olddata['type'];
$amount = $olddata['amount'];
$sdate = $olddata['start_date'];
$edate = $olddata['end_date'];

if (isset($_POST['code'])) {
  $isvalid = 1;
  if (empty($_POST['code'])) {
    $isvalid = 0;
    $titleerr = "Plese enter code";
  }

  if (empty($_POST['type'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if ($isvalid == 1) {
   
    $updatdata = " update coupons set `coupan_code` = '" . $_POST['code'] . "', user_id = '" . $_POST['user'] . "',type = '" . $_POST['type'] . "', amount = '" . $_POST['amount'] . "',start_date='" . date('Y-m-d') . "',end_date='" . date('Y-m-d') . "',created_at='" . date('Y-m-d H:i:s') . "', updated_at='" . date('Y-m-d H:i:s') . "' where id='" . $_GET["id"] . "' ";
   // prd($updatdata);
    if ($conn->query($updatdata) === true) {

      $_SESSION['success_msg'] = "coupons Edit Successfully";
      header("location:" . SITEADMIN . "coupons");
    }
  }
}
$getusers =$conn->query("select * from users where status=1");
 

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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>coupons">coupons List</a></li>
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
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Coupan Code</label>
                      <input name="code" type="number" class="form-control" id="code" placeholder="Enter Your name" value="<?php echo isset($_POST['code']) ? $_POST['code'] : $code ?>">
                      <p class="text-danger" id="codeerr"><?php echo isset($codeerr) ? $codeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Users Name</label>
                      <select name="user" class="form-control" id="user">
                        <option value="">Select User</option>
                        <?php while ($singdata = $getusers->fetch_assoc()) { 
                          $sel = '';
                          if($user==$singdata['id']){
                            $sel = 'selected';
                          }
                          ?>
                          <option value="<?php echo $singdata['id'] ?>"<?php echo $sel;?>><?php echo $singdata['name'] ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger" id="usererr"><?php echo isset($usererr) ? $usererr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Product Type</label>
                      <select name="type" class="form-control" id="type">
                        <option value="">Select Type</option>
                        <?php foreach ($protype as $prokey => $proname) {
                          $sel=($type== $prokey)?'selected':'';
                          echo '<option value="' . $prokey . '"'.$sel.'>' . $proname . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="typeerr"><?php echo isset($typeerr) ? $typeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">Amount</label>
                      <input type="number" name="amount" id="amount" class="form-control" placeholder="Plese Enter Amount" value="<?php echo isset($_POST['number']) ? $_POST['number'] : $amount ?>">
                      <p class="text-danger" id="amounterr"><?php echo isset($amounterr) ? $amounterr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">Start Date</label>
                      <input type="text" name="sdate" id="startDate" class="form-control" placeholder="Plese Select Start Date" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] :  $sdate ?>">
                      <p class="text-danger" id="sdateerr"><?php echo isset($sdateerr) ? $sdateerr :'' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">End Date</label>
                      <input type="text" name="edate" id="endDate" class="form-control" placeholder="Plese Select End Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] :  $edate ?>">
                      <p class="text-danger" id="edateerr"><?php echo isset($edateerr) ? $edateerr : '' ?></p>
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
<?php require('../includes/footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function(){
    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');

    startDateInput.datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
      startDate:'0',
    });

    endDateInput.datepicker({
      format: 'dd-mm-yyyy',
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

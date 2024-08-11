<?php require('../../config.php');
//prd($_POST);die;
$pagename = "coupons";
if (isset($_POST['code'])) {
  //prd($_POST);
  $isvalid = 1;
  if (empty($_POST['code'])) {
    $isvalid = 0;
    $codeerr = "*Plese enter code";
  } else {
    $chekcode = $conn->query("select * from coupons where coupan_code = '" . $_POST['code'] . "' ");
    if ($chekcode->num_rows > 0) {
      $isvalid = 0;
      $codeerr = "*This code is allready taken. ";
    }
  }
  if (empty($_POST['user'])) {
    $isvalid = 0;
    $usererr = "*Select users";
  }
  if (empty($_POST['type'])) {
    $isvalid = 0;
    $typeerr = "*Select product type";
  }
  if (empty($_POST['amount'])) {
    $isvalid = 0;
    $amounterr = "*Enter amount";
  } else {
    if ($_POST['type']==1) {
      if ($_POST['amount'] > 100) {
        $isvalid = 0;
        $amounterr = "*Please enter a valid percentage (not exceeding 100)";
      }
    }
  }
  if ($isvalid == 1) {

    $dataentry = "insert into coupons ( `coupan_code`,`user_id`,`type`,`amount`,`start_date`,`end_date`, `created_at`, `updated_at`) VALUES ('" . $_POST['code'] . "','" . $_POST['user'] . "','" . $_POST['type'] . "','" . $_POST['amount'] . "','" .$_POST['sdate']. "','" .$_POST['edate'] . "','" . date('Y-m-d H:i:s') . "' , '" . date('Y-m-d H:i:s') . "')";
    if ($conn->query($dataentry) === TRUE) {
      $_SESSION['success_msg'] = "Coupons added successfully.";
      header("location:" . SITEADMIN . "coupons");
    }
  }
}
$userdata = $conn->query("select * from users where user_type = 'frontend'");
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
            <li class="breadcrumb-item active"><?php echo $pagename; ?>Add</li>
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
                      <label for="exampleInputEmail1">Coupan Code</label>
                      <input name="code" type="number" class="form-control" id="code" placeholder="Enter Your name" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>">
                      <p class="text-danger" id="codeerr"><?php echo isset($codeerr) ? $codeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Users Name</label>
                      <select name="user" class="form-control" id="user">
                        <option value="">Select User</option>
                        <?php while ($singdata = $userdata->fetch_assoc()) { ?>
                          <option value="<?php echo $singdata['id'] ?>"><?php echo $singdata['name'] ?></option>
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
                          echo '<option value="' . $prokey . '">' . $proname . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="typeerr"><?php echo isset($typeerr) ? $typeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">Amount</label>
                      <input type="number" name="amount" id="amount" class="form-control" placeholder="Plese Enter Amount" value="<?php echo isset($_POST['number']) ? $_POST['number'] : '' ?>">
                      <p class="text-danger" id="amounterr"><?php echo isset($amounterr) ? $amounterr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">Start Date</label>
                      <input type="text" name="sdate" id="startDate" class="form-control" placeholder="Select Start Date" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>">
                      <p class="text-danger" id="sdateerr"><?php echo isset($sdateerr) ? $sdateerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="from-group">
                      <label for="">End Date</label>
                      <input type="text" name="edate" id="endDate" class="form-control" placeholder="Select End Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
                      <p class="text-danger" id="edateerr"><?php echo isset($edateerr) ? $edateerr : '' ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return avelidation()">SUBMIT</button>
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
  $(document).ready(function() {
    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');

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

<script>
  function avelidation() {
    code = document.getElementById('code').value;
    if (code == '') {
      document.getElementById('codeerr').innerHTML = "*Plese Enter code ";
      document.getElementById('code').focus();
      return false;
    } else {
      document.getElementById('codeerr').innerHTML = "";
    }
    user = document.getElementById('user').value;
    if (user == '') {
      document.getElementById('usererr').innerHTML = "*Plese Select User";
      document.getElementById('user').focus();
      return false;
    } else {
      document.getElementById('usererr').innerHTML = "";
    }
    type = document.getElementById('type').value;
    if (type == '') {
      document.getElementById('typeerr').innerHTML = "*Pleser select Product Type";
      document.getElementById('type').focus();
      return false;
    } else {
      document.getElementById('typeerr').innerHTML = "";
    }
    amount = document.getElementById('amount').value;
    if (amount == '') {
      document.getElementById('amounterr').innerHTML = "*Pleser Enter Amount";
      document.getElementById('amount').focus();
      return false;
    } else {
      document.getElementById('amounterr').innerHTML = "";
    }

  }
</script>
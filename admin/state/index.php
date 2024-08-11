<?php
include('../../config.php');
$pagename = 'stata';
if (isset($_POST['state'])) {
  $isvelid = 1;
  if (empty($_POST['state'])) {
    $isvelid = 0;
    $countryerr = "*Plese select Your state.";
  }
  if ($isvelid == 1) {
    $insert = $conn->query("INSERT INTO `state`(`state_name`,`country_id`, `created_at`, `updated_at`) VALUES ('" . $_POST['state'] . "','" . $_POST['country'] . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')");
    if ($conn->query($insert) == true) {
      header("location:" . SITEADMIN . "state");
    }
  }
}
$selcountry = $conn->query("select * from country");
$selconname = $conn->query("SELECT state.*, country.country_name as cuountryname FROM state left join country on state.country_id=country.id ");
include('../includes/header.php');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">Control State</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <form method="post" action="">
    <section class="content">
      <div class="container-fluid">
        <div class="append">
          <div class="mainrow row">
            <div class="form-group col-4 offset-1">
              <label for="exampleInputPassword1">Select Country</label>
              <select name="country" class="form-control" id="country">
                <option value="">Select Country</option>
                <?php while ($singlecontry = $selcountry->fetch_assoc()) { ?>
                  <option value="<?php echo $singlecontry['id']; ?>"><?php echo ucfirst($singlecontry['country_name']); ?></option>
                <?php } ?>
              </select>
              <P class="text-danger" id="stateerr"><?php echo isset($countryerr) ? $countryerr : '' ?></P>
            </div>
            <div class="form-group col-4 offset-1">
              <label for="exampleInputFile">State Name</label>
              <div class="input-group">
                <input type="text" class="form-control" name="state" placeholder="Plese Enter state Name" id="state">
              </div>
              <P class="text-danger" id="stateerr"><?php echo isset($countryerr) ? $countryerr : '' ?></P>
            </div>
            <div class="form-group col-2">
              <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
              <button type="submit" class="btn btn-success rounded-pill addmorecountry ankit">Add More</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="errorsection">
      <p class="errordata col-6 offset-4"></p>
    </div>
    <div class="row">
    </div>
  </form>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Sr.No.</th>
          <th>State Name</th>
          <th>Country name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $srno = 0;
        while ($getdata = $selconname->fetch_assoc()) { ?>
          <tr>
            <td><?php echo ++$srno; ?></td>
            <td><?php echo $getdata['state_name']; ?></td>
            <td><?php echo $getdata['cuountryname']; ?></td>
            <td>
              <a href="javascript:void(0);" onclick="detleterecord('Are You Delete This State','<?php echo SITEADMIN; ?>state/delete.php?id=<?php echo $getdata['id'] ?>')" countryid="" class="btn btn-outline-danger">Delete</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">


      <li class="page-item"><a class="page-link" href=""></a></li>


      <li class="page-item"><a class="page-link" href="">next-></a></li>
    </ul>
  </div>
  <?php include('../includes/footer.php'); ?>
  <script>
    $(document).ready(function() {
      $(document).on("click", ".ankit", function() {
        country = document.getElementById("state").value;
        if (country == "") {
          document.getElementById("stateerr").innerHTML = "*Plese select Your state.";
          document.getElementById("state").focus();
          return false;
        } else {
          document.getElementById("stateerr").innerHTML = "";
        }
      });
    });
  </script>
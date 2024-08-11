<?php
include('../../config.php');
$pagename = 'Supply country';
if (isset($_POST['country'])) {
  $isvelid = 1;
  if (empty($_POST['country'])) {
    $isvelid = 0;
    $countryerr = "*Plese select Your country.";
  }
  if ($isvelid == 1) {
    $insert = $conn->query("INSERT INTO `country`(`country_name`, `created_at`, `updated_at`) VALUES ('" . $_POST['country'] . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')");
    if ($conn->query($insert) == true) {
      header("location:" . SITEADMIN . "country");
    }
  }
}
$seletdata = $conn->query("select * from country");
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN;?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">Control Countries</li>
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
            <div class="form-group col-4 offset-4">
              <label for="exampleInputFile">Country Name</label>
              <div class="input-group">
                <input type="text" class="form-control" name="country" placeholder="Plese Enter Countery Name" id="mycountry">
              </div>
              <P class="text-danger" id="mycountryerr"><?php echo isset($countryerr) ? $countryerr : '' ?></P>
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
          <th>Country Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $srno = 0;
        while ($getdata = $seletdata->fetch_assoc()){?>
          <tr>
            <td><?php echo ++$srno; ?></td>
            <td><?php echo $getdata['country_name'];?></td>
            <td>
              <a href="javascript:void(0);" onclick="detleterecord('Are You Delete This Country','<?php echo SITEADMIN;?>country/delete.php?id=<?php echo$getdata['id'] ?>')" countryid="" class="btn btn-outline-danger" >Delete</a>
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
        country = document.getElementById("mycountry").value;
        if (country == "") {
          document.getElementById("mycountryerr").innerHTML = "*Plese select Your country.";
          document.getElementById("mycountry").focus();
          return false;
        } else {
          document.getElementById("mycountryerr").innerHTML = "";
        }
      });
    });
  </script>
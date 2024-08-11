<?php
include('../../config.php');
$pagename = "View";
$data = $conn->query("SELECT  orders.*,country.country_name as countriesname, 
        state.state_name as statename, 
        city.city_name as cityname FROM orders 
        INNER JOIN country ON orders.country = country . id
        INNER JOIN state ON orders.state= state . id  
        INNER JOIN city ON orders.city = city . id
         WHERE orders.id = '" . $_GET['id'] . "' ")->fetch_assoc();

$orderdata = $conn->query("SELECT * FROM `orders` where id = '" . $_GET['id'] . "'")->fetch_assoc();
$sub_total = $orderdata['sub_total'];
$discountamot = $orderdata['coupon_amt'];
$cipingcharge = $orderdata['shipping_amt'];
$grandtotal = $orderdata['grand_total'];
include('../includes/header.php');
?>
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
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $pagename; ?> Details</h3>
            </div>
            <div class="tab-content account-tabs" id="v-pills-tabContent">
              <div class="tab-pane fade show active order-details-section" id="v-pills-profile">
                <section id="allOrder">
                  <div class="current-order-wrapper">
                    <div class="current-order-header">
                      <div class="current-order-header-wrap d-flex">
                        <div class="order-left d-flex justify-content-between">
                          <div class="col-md-12">
                            <div class="card-body" style="font:bold;">
                              <div><span class="order-heading">
                                  <h5>*Address</h5>
                                  </Address>
                                </span></div>
                              Country Name :
                              Name :
                              <?php echo $orderdata['f_name'];
                              ?>
                              <?php echo $orderdata['l_name'];
                              ?><br>
                              Mobile No :
                              <?php echo $orderdata['phon_no']; ?><br>
                              <?php echo $data['countriesname']; ?><br>
                              State Name :
                              <?php echo $data['statename']; ?><br>
                              City Name :
                              <?php echo $data['cityname']; ?><br>
                              Home Address :
                              <?php echo $data['address']; ?><br>
                              Pincode :
                              <?php echo $data['pincode']; ?><br></h5>
                            </div>
                          </div>
                        </div>
                        <div class="order-left d-flex justify-content-between" style="margin-left: 100px;">
                          <div>
                            <div class="card-body" style="font:bold;">
                              <div><span class="order-heading">
                                  <h5>*Order Details</h5>
                                  </Address>
                                </span></div>
                              Order No :
                              <?php echo $orderdata['order_no']; ?><br>
                              Sub Total :
                              <?php echo price($sub_total) ?><br>
                              Discount Amot :
                              <?php echo price($discountamot) ?><br>
                              Sipingcharge :
                              <?php echo price($cipingcharge) ?><br>
                              Grand Total :
                              <?php echo price($grandtotal) ?><br></h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <h1  class="fa-solid fa-cart-shopping fa-beat fa-xl" style="margin-left: 250px;">𝓣𝓱𝓪𝓷𝓴𝓼 𝓕𝓸𝓻 𝓢𝓱𝓸𝓹𝓲𝓷𝓰..🛍️</h1>
        </div>
      </div>
      <?php include('../includes/footer.php'); ?>
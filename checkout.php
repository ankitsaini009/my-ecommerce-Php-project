<?php include('config.php');
if (isset($_POST['fname'])) {
  $backdata = array();
  $backdata['status'] = 1;
  $backdata['message'] = '';
  $myerr = array();
  $isvalid = 1;
  if (empty($_POST['fname'])) {
    $isvalid = 0;
    $myerr['fname'] = "*plese Enter First Name";
  }
  if (empty($_POST['lname'])) {
    $isvalid = 0;
    $myerr['lname'] = "*plese Enter Last Name";
  }
  if (empty($_POST['countryid'])) {
    $isvalid = 0;
    $myerr['countryid'] = "*plese Select Country";
  }
  if (empty($_POST['address'])) {
    $isvalid = 0;
    $myerr['address'] = "*plese Enter Address";
  }
  if (empty($_POST['stateid'])) {
    $isvalid = 0;
    $myerr['stateid'] = "*plese Select State";
  }
  if (empty($_POST['city'])) {
    $isvalid = 0;
    $myerr['city'] = "*plese Select City";
  }
  if (empty($_POST['pincode'])) {
    $isvalid = 0;
    $myerr['pincode'] = "*plese Enter Pincode";
  }
  if (empty($_POST['phone'])) {
    $isvalid = 0;
    $myerr['phone'] = "*plese Enter Phone_no";
  }
  if (empty($_POST['email'])) {
    $isvalid = 0;
    $myerr['email'] = "*plese Enter Email Address";
  }
  if ($isvalid == 1) {
    if ($_POST['address_id'] > 0) {

      $updatedata = $conn->query("UPDATE `user_address` SET`fname`='" . $_POST['fname'] . "',`lname`='" . $_POST['lname'] . "',`country_id`='" . $_POST['countryid'] . "',`address`='" . $_POST['address'] . "',`state_id`='" . $_POST['stateid'] . "',`city_id`='" . $_POST['city'] . "',`pincode`='" . $_POST['pincode'] . "',`phone`='" . $_POST['phone'] . "',`email`='" . $_POST['email'] . "' WHERE ld= '" . $_POST['address_id'] . "' ");
    } else {
      $userdata = $conn->query("INSERT INTO `user_address`(`fname`, `lname`, `country_id`, `address`, `state_id`, `city_id`, `pincode`, `phone`, `email`, `user_id`,`created_at`, `updated_at`) VALUES ('" . $_POST['fname'] . "','" . $_POST['lname'] . "','" . $_POST['countryid'] . "','" . $_POST['address'] . "','" . $_POST['stateid'] . "','" . $_POST['city'] . "','" . $_POST['pincode'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "','" . $_SESSION['login_user_id'] . "','" . date('Y-m-d') . "','" . date('Y-m-d') . "')");
    }
    $backdata['status'] = 1;
    $backdata['redirecturl'] = SITEURL . "checkout.php";
    $backdata['message'] = 'Checkout SuccessFully';
    echo json_encode($backdata);
    exit;
  } else {
    $backdata['status'] = 0;
    $backdata['message'] = $myerr;
    echo json_encode($backdata);
    exit;
  }
}
$country = $conn->query("SELECT * FROM `country`");
$state = $conn->query("SELECT * FROM `state`");
$city = $conn->query("SELECT * FROM `city`");
$useradd = $conn->query("SELECT * FROM `user_address`")->fetch_assoc();

$getadderass = $conn->query("SELECT  user_address.*,country.country_name as countriesname, state.state_name as statename, city.city_name as cityname FROM user_address 
        INNER JOIN country ON user_address.country_id = country . id
        INNER JOIN state ON user_address.state_id = state . id
        INNER JOIN city ON user_address.city_id = city . id
         WHERE user_address.user_id= '" . $_SESSION['login_user_id'] . "'");

$getdata = $conn->query("SELECT  card.*,prdoucts.main_image,prdoucts.price,prdoucts.`name`FROM card INNER JOIN prdoucts ON card.product_id=prdoucts.id WHERE card.user_id= '" . $_SESSION['login_user_id'] . "'");
include('includes/header.php');

?>
<div class="content">
  <section class="breadcrumb-option">
    <ul class="circles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb__text">
            <h4>Check Out</h4>
            <div class="breadcrumb__links">
              <a href="./index.html">Home</a>
              <a href="./shop.html">Shop</a>
              <span>Check Out</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->
  <!-- Checkout Section Begin -->
  <section class="checkout spad-70">
    <div class="container">
      <div class="checkout__form">
        <?php
        $grandtotalprice = 0;
        $qty = 0;
        while ($indatato = $getdata->fetch_assoc()) {
          $totalprice = $indatato['price'] * $indatato['qty'];
          $grandtotalprice += $totalprice;
          $qty += $indatato['qty'];
        }

        ?>
        <div class="row">
          <div class="col-lg-8 col-md-6">
            <input type="hidden" name="_token" value="Po7bCwav9SrVH8NkmmNrMwbHGtweAbHwXPwj7eYq">
            <input type="hidden" name="txnid" id="txnid" value="txn_ord_1671509847">
            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code</h6>
            <?php while ($data = $getadderass->fetch_assoc()) { ?>
              <div class="card">
                <div class="card-header">
                  <input type="radio" name="ankit" class="myaadid" isaadid='<?php echo $data['ld'] ?>' value="<?php echo $data['ld'] ?>">
                  <?php echo $data['fname'] . $data['lname'] ?>
                  <a href="javascript:void(0);" onclick="deletadd(<?php echo $data['ld'] ?>)" class="btn btn-outline-danger" style="margin-left: 520px; margin-bottom: -62px;">Delet</a>
                  <a href="javascript:void(0);" onclick="editadd(<?php echo $data['ld'] ?>)" class="btn btn-outline-info" style="margin-left: 540px;">Edit</a>
                </div>
                <div class="card-body">
                  Country Name : <?php echo $data['countriesname']; ?><br>
                  State Name : <?php echo $data['statename']; ?><br>
                  City Name : <?php echo $data['cityname']; ?><br>
                  Home Address : <?php echo $useradd['address']; ?><br>
                  Pincode : <?php echo $useradd['pincode']; ?><br></h5>
                </div>
              </div>
            <?php } ?>
            <form action="" id="checkoutForm" method="post" onsubmit="return submitdata()">
              <input type="hidden" name="address_id" id="address_id" value="0">
              <h6 class="checkout__title" style="padding-top:20px;">Billing Details</h6>
              <div style="display: block;">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <lable>Fist Name<span>*</span></lable>
                      <input type="text" class="form-control" name="fname" placeholder="Plese Enter Your First Name" id="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                      <p class="text-danger" id="fnameerr"><?php echo isset($myerr['fname']) ? $myerr['fname'] : '' ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <lable>Last Name<span>*</span></lable>
                      <input type="text" class="form-control" name="lname" placeholder="Plese Enter Your Last Name" id="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                      <p class="text-danger" id="lnameerr"><?php echo isset($myerr['lname']) ? $myerr['lname'] : '' ?></p>

                    </div>
                  </div>
                </div>
                <div class="checkout__input">
                  <lable>Address<span>*</span></lable>
                  <input type="text" placeholder="Street Address" class="checkout__input__add" name="address" id="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>">
                  <p class="text-danger" id="addresserr"><?php echo isset($myerr['address']) ? $myerr['address'] : '' ?></p>
                </div>
                <div class="checkout__input">
                  <lable>Country<span>*</span></lable>
                  <select class="form-select custome-form-select countrySelect" id="country" name="countryid" onchange="mystate(this.value)">
                    <option selected="" disabled="" value="">Choose...</option>
                    <?php while ($cuntryname = $country->fetch_assoc()) { ?>
                      <option value="<?php echo $cuntryname['id'] ?>"><?php echo $cuntryname['country_name']; ?></option>
                    <?php } ?>
                    <p class="text-danger" id="countryerr"><?php echo isset($myerr['countryid']) ? $myerr['countryid'] : '' ?></p>
                  </select>
                </div>
                <div class="checkout__input ">
                  <lable>Country/State<span>*</span></lable>
                  <div class="stateSelectDiv stateSelect">
                    <select class="form-select custome-form-select stateSelect" id="state" name="stateid" onchange="mycity(this.value)">
                      <option selected="" value="">Choose...</option>
                      <?php while ($statename = $state->fetch_assoc()) { ?>
                        <option value="<?php echo $statename['id'] ?>"><?php echo $statename['state_name'] ?></option>
                      <?php } ?>
                    </select>
                    <p class="text-danger" id="stateerr"><?php echo isset($myerr['stateid']) ? $myerr['stateid'] : '' ?></p>
                  </div>
                </div>
                <div class="checkout__input">
                  <lable>Town/City<span>*</span></lable>
                  <div class="citySelectDiv citySelect">
                    <select class="form-select custome-form-select citySelect" name="city" id="city">
                      <option selected="" disabled="" value="">Choose...</option>
                      <?php while ($cityname = $city->fetch_assoc()) { ?>
                        <option value="<?php echo $cityname['id'] ?>"><?php echo $cityname['city_name'] ?></option>
                      <?php } ?>
                    </select>
                    <p class="text-danger" id="cityerr"><?php echo isset($myerr['city']) ? $myerr['city'] : '' ?></p>
                  </div>
                </div>
                <div class="checkout__input">
                  <lable>PinCode<span>*</span></lable>
                  <input type="text" class="form-control" name="pincode" placeholder="Plese Enter Pincode" id="pincode" value="<?php echo isset($_POST['pincode']) ? $_POST['pincode'] : '' ?>">
                  <p class="text-danger" id="pincodeerr"><?php echo isset($myerr['pincode']) ? $myerr['pincode'] : '' ?></p>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <lable>Phone<span>*</span></lable>
                      <input type="text" class="form-control" name="phone" placeholder="Plese Enter Phone Number" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                      <p class="text-danger" id="phoneerr"><?php echo isset($myerr['phone']) ? $myerr['phone'] : '' ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="checkout__input">
                      <lable>Email<span>*</span></lable>
                      <input type="text" class="form-control" name="email" placeholder="Plese Enter Email Address" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                      <p class="text-danger" id="emailerr"><?php echo isset($myerr['email']) ? $myerr['email
                      '] : '' ?></p>
                    </div>
                  </div>
                </div>
                <div class="checkout__input__checkbox">
                  <label for="saveAdress">
                    Save this information for next time
                    <input type="checkbox" id="saveAdress" name="by_default" value="1">
                    <span class="checkmark check-small"></span>
                  </label>
                </div>
                <button type="submit" class="btn btn-outline-info ">SUBMIT</button>
              </div>
            </form>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
              <h4 class="order__title">Your order</h4>
              <div class="checkout__order__products">Product <span>Total</span></div>
              <ul class="checkout__total__all">
                <?php
                $discountamot = 0;
                $cipingcharge = CIPINGCHARGE;
                if (isset($_SESSION['cupncode'])) {
                  $cpndata = $conn->query("select * from coupons where coupan_code= '" . $_SESSION['cupncode'] . "' && status=1 ")->fetch_assoc();
                  if (isset($_SESSION['cupncode']) && $cpndata['type'] == 1) {
                    $discountamot = ($grandtotalprice * $cpndata['amount']) / 100;
                  } else {
                    $discountamot = $cpndata['amount'];
                  }
                }
                ?>
                <li>Subtotal <span><?php echo price($grandtotalprice) ?></span></li>
                <?php if (!empty($discountamot)) { ?>

                  <li>Coupon ( <?php echo $_SESSION['cupncode']; ?> ) <a href="javascript:void(0);" onclick="deletcupn(<?php echo $cpndata['id'] ?>)" class="text-danger">X</a><span> - <?php echo price($discountamot) ?></span></li>
                <?php } ?>
                <li>Shipping Charges<span> + <?php echo price($qty * $cipingcharge) ?></span></li>
                <li>Total <span><?php echo price($grandtotalprice + ($qty * $cipingcharge) - $discountamot) ?></span></li>
                <div class="checkout__order">
                  <h4 class="order__title">Payment Type</h4>
                  <li><input type="radio" class="paytype" value="1" name="paytype"> COD<span></span></li>
                  <li><input type="radio" class="paytype" value="2" name="paytype">Pay Online<span></span></li>
                </div>
              </ul>
              <form action="<?php echo SITEURL; ?>pleshoder.php" method="GET" id="addform">
                <input type="hidden" name='address' id="aadaddress">
                <input type="hidden" name='paytype' id="paytype">
              </form>
              <p class="text-danger adderr "></p>
              <a href="javascript:void(0);" class="primary-btn btn-product btn--animated  myselerr" onclick="return myaadsel()">Proceed to
                checkout</a>
              <form id="checkout-form" action="https://vinaikajaipur.com/payment-razor" method="POST">
                <input type="hidden" name="_token" value="Po7bCwav9SrVH8NkmmNrMwbHGtweAbHwXPwj7eYq"> <input type="hidden" name="booking_id" value="" id="booking_id">
                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="" data-amount="0" data-buttontext="Place Order" data-name="vinaikajaipur.com" data-description="Vanaika" data-image="https://www.yiiframework.com/image/design/logo/yii3_sign.png" data-prefill.name="name" data-prefill.email="email" data-theme.color="#7367F0"></script>
              </form>
            </div>
            </ul>
            <form id="checkout-form" action="https://vinaikajaipur.com/payment-razor" method="POST">
              <input type="hidden" name="_token" value="Po7bCwav9SrVH8NkmmNrMwbHGtweAbHwXPwj7eYq"> <input type="hidden" name="booking_id" value="" id="booking_id">
              <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="" data-amount="0" data-buttontext="Place Order" data-name="vinaikajaipur.com" data-description="Vanaika" data-image="https://www.yiiframework.com/image/design/logo/yii3_sign.png" data-prefill.name="name" data-prefill.email="email" data-theme.color="#7367F0"></script>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
<!-- Checkout Section End -->
</div>
<?php include('includes/footer.php');
?>
<script>
  function myaadsel() {
    if ($('.myaadid:checked').length < 1) {
      $('.adderr').text('*Please Select Delivery Address');
      return false;
    }
    if ($('.paytype:checked').length < 1) {
      $('.adderr').text('*Please Select Payment Option');
      return false;
    } else {
      id = $('input[name=ankit]:checked').val();
      cod = $('input[name=paytype]:checked').val();
      $('#aadaddress').val(id);
      $('#paytype').val(cod);
      $('#addform').submit();

    }
  }

  function editadd(myid) {
    $.ajax({
      url: '<?php echo SITEURL; ?>ajax/edit.php',
      type: 'POST',
      dataType: 'json',
      data: {
        aadid: myid,
      },
      success: function(data) {
        $('#address_id').val(data.edit.ld);
        $('#fname').val(data.edit.fname);
        $('#lname').val(data.edit.lname);
        $('#address').val(data.edit.address);
        $('#pincode').val(data.edit.pincode);
        $('#phone').val(data.edit.phone);
        $('#email').val(data.edit.email);

        $('.countrySelect').html(data.options.country_id);
        $('select').niceSelect('update');

        $('.stateSelect').html(data.options.state_id);
        $('select').niceSelect('update');

        $('.citySelect').html(data.options.city_id);
        $('select').niceSelect('update');
      }
    });
  };

  function mystate(countryid) {
    $.ajax({
      url: '<?php echo SITEURL; ?>ajax/state.php',
      type: 'POST',
      data: {
        cantid: countryid,
      },
      success: function(data) {
        $(".stateSelect").html(data);
      }
    });
  }

  function mycity(cityid) {
    $.ajax({
      url: '<?php echo SITEURL; ?>ajax/city.php',
      type: 'POST',
      data: {
        city: cityid,
      },
      success: function(data) {
        $(".citySelect").html(data);
      }
    });
  }

  function submitdata() {
    $('.text-danger').text('');
    $.ajax({
      url: 'checkout.php',
      method: "POST",
      dataType: 'json',
      data: $('#checkoutForm').serialize(),
      success: function(data) {
        if (data.status == 0) {
          jQuery.each(data.message, function(index, item) {
            $('#' + index + 'err').text(item);
          });
        } else {
          window.location.href = data.redirecturl;
        }
      }
    });
    return false;
  }
</script>
<script>
  function deletcupn() {
    bootbox.confirm({
      message: 'Are You Sure To Delete This Cupons?',
      buttons: {
        confirm: {
          label: 'Confirm',
          className: 'btn-success'
        },
        cancel: {
          label: 'Cancel',
          className: 'btn-danger'
        }
      },
      callback: function(result) {
        if (result) {
          $.ajax({
            type: "GET",
            url: "<?php echo SITEURL; ?>ajax/removecupn.php",
            success: function(data) {
              window.location.reload();
            }
          });
        }
      }
    });
  }

  function deletadd(myid) {
    bootbox.confirm({
      message: 'Are You Sure To Delete This Address?',
      buttons: {
        confirm: {
          label: 'Confirm',
          className: 'btn-success'
        },
        cancel: {
          label: 'Cancel',
          className: 'btn-danger'
        }
      },
      callback: function(result) {
        if (result) {
          $.ajax({
            type: "GET",
            url: "<?php echo SITEURL; ?>ajax/deletadd.php",
            data: {
              id: myid
            },
            success: function(data) {
              window.location.reload();
            }
          });
        }
      }
    });
  }
</script>
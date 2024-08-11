<?php
include('config.php');
$products = $conn->query("select * from prdoucts where dstatus=0 && status=1 && id = '" . $_GET['id'] . "' ");
$datapro = $products->fetch_assoc();
$resubcat = $datapro['subcategory_id'];
$releproducts = $conn->query("select * from prdoucts where subcategory_id = '" . $resubcat . "' && id !='" . $datapro['id'] . "' ");
$geimags = $conn->query("select * from galleryimg where product_id = '" . $_GET['id'] . "'");
$ankita = $conn->query("select * from galleryimg where product_id = '" . $_GET['id'] . "'");
if ($datapro['product_type'] == 2) {
    $size = $conn->query("SELECT DISTINCT(`size_id`) FROM `configration` WHERE `product_id`= '" . $_GET['id'] . "'");
    $prosize = [0];
    while ($singlesize = $size->fetch_assoc()) {
        $prosize[] = $singlesize['size_id'];
    }
    $myzise = $conn->query('SELECT * FROM `size` WHERE `size_id` IN (' . implode(',', $prosize) . ')');

    $color = $conn->query("SELECT DISTINCT(`color_id`) FROM `configration` WHERE `product_id`= '" . $_GET['id'] . "' ");
    $procolor = [0];
    while ($singlecolor = $color->fetch_assoc()) {
        $procolor[] = $singlecolor['color_id'];
    }
    $mycolor = $conn->query('SELECT * FROM `color` WHERE `color_id` in (' . implode(',', $procolor) . ') ');
}
//prd($sglimge);
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
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="index.html">Home</a>
                            <a href="shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 ankitimg">
                        <div class="product__single__item_details">
                            <ul class="nav nav-tabs img-thumb-wrapper" role="tablist">
                                <?php
                                $statkey = 0;
                                while ($sglimge = $geimags->fetch_assoc()) {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link img-thumb <?php echo $statkey == 0 ? 'active' : '' ?>" data-toggle="tab" href="#gallery-<?php echo $sglimge['gallery_id'] ?>" role="tab">
                                            <div class="product__thumb__pic set-bg" data-setbg="<?php echo SITEURL; ?>uploads/banners/<?php echo $sglimge['name'] ?>">
                                            </div>
                                        </a>
                                    </li>
                                <?php $statkey++;
                                } ?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-14" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <a class="grouped_elements" href="<?php echo SITEURL; ?>uploads/banners/<?php echo $datapro['main_image'] ?>">
                                            <img onerror="" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $datapro['main_image'] ?>" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product__details__text">
                            <h4 class="text-left"><?php echo $datapro['name'] ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 0 Reviews</span>
                                <span class="toggle-wishlist wishlist" data-product-id="<?php echo $datapro['id']; ?>">
                                    <img class="heart-icon" style="width: 25px; height: 25px;" src="<?php echo SITEURL; ?>assetss/frontend/html/img/icon/heart.png" alt="" />
                                    <span>Wishlist</span>
                                </span>
                            </div>
                            <h3 class="text-left"><?php echo price($datapro['price']) ?><span><?php echo price($datapro['mrp_price']) ?></span></h3>
                            <p>
                            <p><?php echo $datapro['description']; ?></p>
                            </p>
                            <div class="product__details__option">
                                <?php if ($datapro['product_type'] == 2) { ?>
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        <?php $i = 0;
                                        $sizeid = 0;
                                        while ($singsize = $myzise->fetch_assoc()) { ?>
                                            <label class="active-size <?php echo $i == 0 ? 'active' : '' ?>" for="<?php echo $singsize['size_name'] ?>" size_id="<?php echo $singsize['size_id'] ?>" onclick="activsize()">
                                                <?php echo $singsize['size_name'] ?>
                                                <input type="radio" id="<?php echo $singsize['size_id'] ?>" id="csize" require />
                                                <p class="text-danger" id="csizeerr"></p>
                                            </label>
                                            <?php
                                            if ($i == 0) {
                                                $sizeid = $singsize['size_id'];
                                            }
                                            ?>
                                        <?php $i++;
                                        } ?>
                                        <p class="sizeerr text-danger"></p>
                                    </div>
                                    <br>
                                    <div class="product__details__option__color colordata">
                                        <span>Color:</span>
                                        <?PHP
                                        $color = $conn->query("SELECT DISTINCT(`color_id`) FROM `configration` WHERE `product_id`= '" . $_GET['id'] . "' && size_id='" . $sizeid . "'  ");
                                        $procolor = [0];
                                        while ($singlecolor = $color->fetch_assoc()) {
                                            $procolor[] = $singlecolor['color_id'];
                                        }
                                        $mycolor = $conn->query('SELECT * FROM `color` WHERE `color_id` in (' . implode(',', $procolor) . ') ');
                                        ?>
                                        <?php while ($singcolor = $mycolor->fetch_assoc()) { ?>
                                            <label style="background:<?php echo $singcolor['hex_value']; ?> !important" class="colorids" colorid="<?php echo $singcolor['color_id'] ?>">
                                                <input type="radio" id="<?php echo $singcolor['color_id'] ?>" value="<?php echo $singcolor['hex_value']; ?>" />
                                            </label>
                                        <?php } ?>
                                    </div>
                                    <p class="colorerr text-danger"></p>
                                <?php } ?>
                            </div>
                            <?php if (isset($_SESSION['login_user_id']) && !empty($_SESSION['login_user_id'])) { ?>
                                <a href="javascript:Void(0);" class="primary-btn btn-product btn--animated shake add_to_cart_btn ankit " product_id="178">add to cart</a>
                            <?php } else { ?>
                                <a href="<?php echo SITEURL; ?>login.php?redirect=<?php echo SITEURL; ?>products.php?id=<?php echo $_GET['id']; ?>" class="primary-btn btn-product btn--animated shake add_to_cart_btn" product_id="178">Login to Buy</a>
                            <?php } ?>

                            <input type="hidden" id="slectedsizeid" value="0">
                            <input type="hidden" id="slectedcolorid" value="0">
                            <input type="hidden" id="isrunning" value="0">
                        </div>
                        <div class="product__details__btns__option">

                        </div>
                        <div class="product__details__last__option">
                            <div class="safe-checkout">
                                <img src="<?php echo SITEURL; ?>assetss/frontend/html/img/icon/cart.png" />
                            </div>
                            <ul style="padding-top:0px">
                                <li><span>SKU:</span> M500</li>
                                <li><span>Categories:</span> Plus Size</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="product__details__content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product_description_area">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <p>
                            <p><?php echo $datapro['description']; ?></p>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>Dummy Details</p>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row total_rate">
                                        <div class="col-6">
                                            <div class="box_total">
                                                <h5>Overall</h5>
                                                <h4>0</h4>
                                                <h6>(0 Reviews)</h6>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="rating_list">
                                                <h3>Based on 0 Reviews</h3>


                                                <ul class="list">
                                                    <li>
                                                        <a href="#">5 Star
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_list">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_box">
                                        <h4>Add a Review</h4>
                                        <p>Your Rating:</p>
                                        <ul class="list">
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                        </ul>
                                        <p>Outstanding</p>
                                        <form class="row contact_form" action="https://vinaikajaipur.com/product/contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button type="submit" value="submit" class="primary-btn btn-product btn--animated">Submit
                                                    Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Shop Details Section End -->
<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="product__filter wow fadeInUp" data-wow-delay="0.1s">

            <?php while ($mypro = $releproducts->fetch_assoc()) { ?>
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <a class="pro-img" href="<?php echo SITEURL; ?>">
                                        <img onerror="" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $mypro['main_image'] ?>" style="width: 21%; height: 20% " alt="">
                                    </a>
                                    <span class="label">New</span>
                                    <ul class="product__hover">
                                        <li class="toggle-whishlist" data-product-id="346">
                                            <img onerror="" src="<?php echo SITEURL; ?>assetss/frontend/html/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                        </li>
                                        <li>
                                            <a class="add-cart" href="#"><img src="<?php echo SITEURL; ?>assetss/frontend/html/img/icon/cart.png" alt="" />
                                                <span>Cart</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text d-flex flex-column">
                                    <a href="javascript:void(0)">
                                        <span><?php echo $mypro['name'] ?></span>
                                    </a>
                                    <span>₹<?php echo $mypro['price'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Related Section End -->
</div>

<?php include('includes/footer.php'); ?>
<script>
    const toggleButtons = document.querySelectorAll('.toggle-wishlist');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action of the button

            // Toggle the 'active' class on click
            this.classList.toggle('active');

            // Change the heart icon/src based on active state
            const heartIcon = this.querySelector('.heart-icon');
            if (this.classList.contains('active')) {
                heartIcon.src = '<?php echo SITEURL; ?>assetss/frontend/html/img/icon/heartfill.png'; // Replace 'active_heart.png' with your active heart icon
            } else {
                heartIcon.src = '<?php echo SITEURL; ?>assetss/frontend/html/img/icon/heart.png'; // Replace 'heart.png' with your default heart icon
            }
        });
    });
</script>
<script>
    $(document).on('click', '.colorids', function() {
        coorid = $(this).attr('colorid');
        $('#slectedcolorid').val(coorid);
        $.ajax({
            url: '<?php echo SITEURL; ?>ajax/colorimg.php',
            method: 'POST',
            data: {
                colorid: coorid,
                proid: <?php echo $_GET['id']; ?>
            },
            success: function(data) {
                $(".ankitimg").html(data);
            }
        });
    });

    $(document).on('click', '.active-size', function() {
        size_id = $(this).attr('size_id');
        $('#slectedsizeid').val(size_id);
        $.ajax({
            url: '<?php echo SITEADMIN ?>ajax/colorsizedata.php',
            method: 'POST',
            data: {
                sizeid: size_id,
                productid: <?php echo $_GET['id']; ?>
            },
            success: function(data) {
                $(".colordata").html(data);
            }
        });
    });



    $(document).on('click', '.wishlist', function() {
        mcolorid = $('#slectedcolorid').val();
        msizeid = $('#slectedsizeid').val();
        $.ajax({
            url: '<?php echo SITEURL; ?>ajax/wishlist.php',
            type: 'post',
            data: {
                color_id: mcolorid,
                size_id: msizeid,
                productid: '<?php echo $_GET['id']; ?>',
                userid: '<?php echo $_SESSION['login_user_id']; ?>',
            },
            success: function(data) {
                if (data == 'not_login') {
                    window.location.href = "login.php";
                }
            }
        });
    });





    $(document).on('click', '.ankit', function() {
        <?php if ($datapro['product_type'] == 2) { ?>
            mcolorid = $('#slectedcolorid').val();
            msizeid = $('#slectedsizeid').val();
            isrunning = $('#isrunning').val();
            $('.sizeerr').text('');
            $('.colorerr').text('');
            var isvalid = 1;
            if (mcolorid == 0) {
                isvalid = 0;
                $('.colorerr').text('Please select color.');
            }
            if (msizeid == 0) {
                isvalid = 0;
                $('.sizeerr').text('Please select size.');
            }
            if (isvalid == 1 && isrunning == 0) {
                $('#isrunning').val(1);
                $.ajax({
                    url: '<?php echo SITEADMIN; ?>ajax/prodata.php',
                    method: "POST",
                    dataType: "json",
                    data: {
                        color_id: mcolorid,
                        size_id: msizeid,
                        productid: '<?php echo $_GET['id']; ?>',
                        userid: '<?php echo $_SESSION['login_user_id']; ?>',
                    },
                    success: function(data) {
                        $('#isrunning').val(0);
                        $('.count').text(data.totalqty);
                        $('.shopping__cart__table').html(data.html);
                        $('.total_cart').html(data.totalamount);
                        $('.js-panel-cart').addClass('show-header-cart');
                        Swal.fire({
                            title: "Cart",
                            text: "Product added in Cart successfully.",
                            icon: "success"
                        });
                    }

                });
            }
        <?php } else { ?>
            $.ajax({
                url: '<?php echo SITEADMIN; ?>ajax/prodata.php',
                method: "POST",
                data: {
                    productid: '<?php echo $_GET['id']; ?>',
                    userid: '<?php echo $_SESSION['login_user_id']; ?>',
                },
                success: function(data) {
                    $('#isrunning').val(0);
                    $('.count').text(data.totalqty);
                    $('.shopping__cart__table').html(data.html);
                    $('.total_cart').html(data.totalamount);
                    $('.js-panel-cart').addClass('show-header-cart');
                    Swal.fire({
                        title: "Cart",
                        text: "Product added in Cart successfully.",
                        icon: "success"
                    });
                }
            });
        <?php } ?>
    });
</script>
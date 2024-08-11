<?php
include('config.php');
$datacategory = $conn->query("select * from category where display_home=1 && dstatus=0 limit 0,3");
$getbanner = $conn->query("select * from banners where dstatus=0");
$getproduct = $conn->query("select * from prdoucts where dstatus=0");
$getpages = $conn->query("select * from pages where dstatus=0 limit 0,1");
//prd(("select * from pages where dstatus=0"));

include('includes/header.php');
?>
<style>
  .hero__items {
    height: 285px;
    padding-top: 230px;
  }
</style>
<div class="content">
  <section class="hero">
    <div class="hero__slider owl-carousel">
      <?php while ($bannerimg = $getbanner->fetch_assoc()) { ?>
        <div class="hero__items set-bg" data-setbg="<?php echo SITEURL ?>uploads/banners/<?php echo $bannerimg['imgage'] ?>">
          <div class="container">
            <div class="row">
              <div class="col-xl-5 col-lg-7 col-md-8"></div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
  &nbsp;
  <section class="section section-cat pt-0 animTop shop-by-category">
    <div class="container">
      <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
        <h3>Categorys</h3>
        <p>A beautiful rendition of modern pieces to elevate your look</p>
      </div>
      <div class="row justify-content-center">
        <?php while ($getimg = $datacategory->fetch_assoc()) { ?>
          <div class="col-xs-12 col-md-4 mb-4 mb-md-0 col-lg-4 catList">
            <a href="category/kurta.html" class="catBox">
              <div class="imgBox">
                <img style="height:350px;" src="<?php SITEURL; ?>uploads/banners/<?php echo $getimg['image'] ?>" alt="" />
              </div>
              <h3><?php echo $getimg['name'] ?></h3>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <section class="product spad">
    <div class="container">
      <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
        <h3>Latest Products</h3>
        <p>A beautiful rendition of modern pieces to elevate your look</p>
      </div>
      <div class="product__filter">
        <div class="mix new-arrivals">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <?php while ($pimg = $getproduct->fetch_assoc()){ ?>
                <div class="swiper-slide">
                  <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product__item__pic set-bg">
                      <a class="pro-img" href="<?php echo SITEURL ?>products.php?id=<?php echo $pimg['id'] ?>">
                        <img onerror=""  style="width:300px; height:320px;" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $pimg['main_image'] ?>" alt="" />
                      </a>
                      <span class="label">New</span>
                      <ul class="product__hover">
                        <li>
                          <a href="#"><img onerror="" src="<?php echo SITEURL; ?>assetss/frontend/html/img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                        </li>
                        <li>
                          <a class="add-cart" href="#"><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/cart.png" alt="" />
                            <span>Cart</span></a>
                        </li>
                      </ul>
                    </div>

                    <div class="product__item__text">
                      <a href="Vinaika-women-white-printed-sf-shrug-with-kurta.html">
                      </a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="spad about-us about-us-vinaika spacing-top">
    <?php while ($pagesimg = $getpages->fetch_assoc()) { ?>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about__text">
              <h4><?php echo $pagesimg['title'] ?></h4>
              <p>
                <?php echo $pagesimg['description'] ?>
              </p>
            </div>
          </div>
          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="about__img">
              <img onerror="" src="<?php echo SITEURL ?>uploads/banners/<?php echo $pagesimg['banner'] ?>" alt="image" />
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
  <section class="spad client_reviews">
    <div class="container">
      <div class="heading-box">
        <h3>REVIEWS</h3>
        <p>A beautiful rendition of modern pieces to elevate your look</p>
      </div>
      <div class="customers-testimonials owl-carousel owl-loaded owl-drag">
        <div class="item">
          <div class="product-collection-wrap">
            <div class="product-collection-summery">
              <p class="testimonialText">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe voluptas voluptatem ipsa commodi quibusdam numquam pariatur.
              </p>
              <hr />
              <p class="testimonialHeading">Shubham Bhowmik</p>
              <div class="rating_star">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="product-collection-wrap">
            <div class="product-collection-summery">
              <p class="testimonialText">
                NICE FABRIC AND COMFORT FEEL AFTER WEAR THE KURTI. I
                RECOMMAND TO ALL MUST BUY MYAZA KURTIS and FABRIC.
              </p>
              <hr />
              <p class="testimonialHeading">SWETA DAS</p>
              <div class="rating_star">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="product-collection-wrap">
            <div class="product-collection-summery">
              <p class="testimonialText">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident ipsa laboriosam recusandae fugiat nesciunt nobis, tempore!
              </p>
              <hr />
              <p class="testimonialHeading">Swani Rai</p>
              <div class="rating_star">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Latest Blog Section Begin -->
  <section class="latest spad blog-section">
    <div class="container">
      <div class="heading-box">
        <h3>news & blog</h3>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry.
        </p>
      </div>
      <div class="swiper blogSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="blog__item">
              <div class="blog__item__pic">
                <a href="javascript:void(0)">
                  <img onerror="" class="blog__item__pic_blog" src="<?php echo SITEURL ?>assetss/frontend/html/img/about/testimonial-pic.jpg" />
                </a>
                <div class="blog-description">
                  <span><img onerror="" src="<?php echo SITEURL ?>assetss/frontend/html/img/icon/calendar.png" alt="" />
                    13-09-2022 11:53:22</span>
                  <h5 class="text-left">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Ullam nisi nostrum debitis,
                  </h5>
                  <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                    More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <style>
    img,
    svg {
      vertical-align: middle;
    }
  </style>
  <!-- Latest Blog Section End -->
</div>
<?php include('includes/footer.php'); ?>
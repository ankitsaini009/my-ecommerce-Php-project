
"use strict";

(function ($) {

                var siteMenuClone = function() {

        $('<div class="site-mobile-menu"></div>').prependTo('.site-wrap');

        $('<div class="site-mobile-menu-header"></div>').prependTo('.site-mobile-menu');
        $('<div class="site-mobile-menu-close "></div>').prependTo('.site-mobile-menu-header');
        $('<div class="site-mobile-menu-logo"></div>').prependTo('.site-mobile-menu-header');

        $('<div class="site-mobile-menu-body"></div>').appendTo('.site-mobile-menu');

        

        $('.js-logo-clone').clone().appendTo('.site-mobile-menu-logo');

        $('<span class="icon icon-cancel js-menu-toggle"></div>').prependTo('.site-mobile-menu-close');
        

        $('.js-clone-nav').each(function() {
            var $this = $(this);
            $this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
        });


        setTimeout(function() {
            
            var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);
        
        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

        $('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();  
      
    });

        $(window).resize(function() {
            var $this = $(this),
                w = $this.width();

            if ( w > 768 ) {
                if ( $('body').hasClass('offcanvas-menu') ) {
                    $('body').removeClass('offcanvas-menu');
                }
            }
        })

        $('body').on('click', '.js-menu-toggle', function(e) {
            var $this = $(this);
            e.preventDefault();

            if ( $('body').hasClass('offcanvas-menu') ) {
                $('body').removeClass('offcanvas-menu');
                $this.removeClass('active');
            } else {
                $('body').addClass('offcanvas-menu');
                $this.addClass('active');
            }
        }) 

        // click outisde offcanvas
        $(document).mouseup(function(e) {
        var container = $(".site-mobile-menu");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
          if ( $('body').hasClass('offcanvas-menu') ) {
                    $('body').removeClass('offcanvas-menu');
                }
        }
        });
    }; 
    siteMenuClone();
    /*------------------
        Preloader
    --------------------*/
    $(document).ready( function () {
        // $(".loader").fadeOut();
        $("#preloder").delay(1000).fadeOut("");
        /*------------------
            Gallery filter
        --------------------*/
        $(".filter__controls li").on("click", function () {
            $(".filter__controls li").removeClass("active");
            $(this).addClass("active");
        });
        if ($(".product__filter").length > 0) {
            var containerEl = document.querySelector(".product__filter");
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });


    //Search Switch
    $(".search-switch").on("click", function () {
        $(".search-model").fadeIn(400);
    });

    $(".search-close-switch").on("click", function () {
        $(".search-model").fadeOut(400, function () {
            $("#search-input").val("");
        });
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: "#mobile-menu-wrap",
        allowParentLinks: true,
    });

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".sticky-top").addClass("shadow-sm").css("top", "0px");
        } else {
            $(".sticky-top").removeClass("shadow-sm").css("top", "-100px");
        }
    });

    var btn = $("#button");

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });

    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "300");
    });

    /*------------------
        Accordin Active
    --------------------*/
    $(".collapse").on("shown.bs.collapse", function () {
        $(this).prev().addClass("active");
    });

    $(".collapse").on("hidden.bs.collapse", function () {
        $(this).prev().removeClass("active");
    });

    //Canvas Menu
    $(".canvas__open").on("click", function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on("click", function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });



    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1000,
        autoHeight: false,
        autoplay: true,
    });

    $(".Jewellery__slider").owlCarousel({
        loop: true,
        margin: 30,
        items: 4,
        dots: false,
        nav: false,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1000,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1170: {
                items: 4,
            },
        },
    });
    $(".Jewellery__slider2").owlCarousel({
        loop: true,
        margin: 30,
        items: 4,
        dots: false,
        nav: false,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1000,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1170: {
                items: 4,
            },
        },
    });

    jQuery(document).ready(function ($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $(".customers-testimonials").owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: true,
            nav: false,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1170: {
                    items: 3,
                },
            },
        });
    });

   
    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
        Radio Btn
    --------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on("click", function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass("active");
        $(this).addClass("active");
    });

    /*-------------------
        Scroll
    --------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false,
    });


        //Canvas Menu
    $(".js-signup-button").on("click", function () {
        $(".offcanvas-menu-wrapper2").addClass("active");
        $(".signin-overlay").addClass("active");
    });

    $(".signin-overlay").on("click", function () {
        $(".offcanvas-menu-wrapper2").removeClass("active");
        $(".signin-overlay").removeClass("active");
    });
    $(".js_close-btn").on("click", function () {
        $(".offcanvas-menu-wrapper2").removeClass("active");
        $(".signin-overlay").removeClass("active");
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
    var yyyy = today.getFullYear();

    if (mm == 12) {
        mm = "01";
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, "0");
    }
    var timerdate = mm + "/" + dd + "/" + yyyy;
    // For demo preview end

    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(
            event.strftime(
                "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
                    "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" +
                    "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" +
                    "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"
            )
        );
    });

    /*------------------
        Magnific
    --------------------*/
    $(".video-popup").magnificPopup({
        type: "iframe",
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.on("click", ".qtybtn", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    var proQty = $(".pro-qty-2");
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on("click", ".qtybtn", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $(".cn_num").each(function () {
        $(this)
            .prop("Counter", 0)
            .animate(
                {
                    Counter: $(this).text(),
                },
                {
                    duration: 4000,
                    easing: "swing",
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    },
                }
            );
    });


/*==================================================================
    [ Track ]*/
// $(document).ready(function () {
//                 $(".track_toggle").click(function () {
//                     $(".track_orders").toggle();
//                 });
//             });



})(jQuery);




/*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });








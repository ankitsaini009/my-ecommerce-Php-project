// First Script
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        // start_loader();
        var isValid = true;
        if ($('#InputEmail1').val().trim() == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Notice',
                text: 'Username is Required',
                footer: '<a href="">Why do I have this issue?</a>'
            })
            isValid = false;
        }
        if ($('#InputPassword1').val().trim() == '') {
            isValid = false;
            Swal.fire({
                icon: 'warning',
                title: 'Notice',
                text: 'Password is Required',
                footer: '<a href="">Why do I have this issue?</a>'
            })
        }
        if (isValid) {
            var formData = new FormData($("#loginform")[0]);
            let _token = 'psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
            $.ajax({
                url: "https://vinaikajaipur.com/checklogin",
                type: "POST",
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data)
                    // stop_loader();
                    if (data.status == 'success') {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Successfully Login',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'ok',

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location = data.redirect;
                            }
                        })
                    } else if (data.status == 'fail') {
                        $('input[name=username]').css('border', '2px solid red');
                        $('input[name=password]').css('border', '2px solid red');
                        swal.fire({
                            title: "Notice",
                            text: data.msg,
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok",
                            cancelButtonText: false,
                            closeOnConfirm: false,
                            closeOnCancel: false,
                            dangerMode: true,
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })

                    }


                },
                error: function() {
                    // window.location.reload();
                }

            });
            return false;
        }
        // your code here
    });
})


// Second Script


var default_avatar =
    '../d3rmug8w64gkex.cloudfront.net/media/catalog/product/cache/20e68cdecc310a480bda7999995ffa78/d/e/demo.jpg';

function handleError(image) {
    image.src = default_avatar;
}

$(document).ready(function() {
    if (localStorage.getItem('IsModalShown').toString() != 'true') {
        $("#myModalsubscribe").modal('show');
        localStorage.setItem('IsModalShown', true);
    }

    $('[data-toggle="tooltip"]').tooltip();

    mark_fav();
});

$(document).on('click', '.toggle-whishlist', function(e) {

    let current_li = $(this);

    let src = current_li.find('img').attr('src');

    let heart = "html/img/icon/heart.png";
    let heartfill = "html/img/icon/heartfill.png";

    current_li.find('img').attr('src', src.includes('heartfill') ? heart : heartfill)

    let wishlist_array = JSON.parse(localStorage.getItem("wishlist")) ?? []

    let product_id = current_li.attr('data-product-id');
    if (inArray(product_id, wishlist_array)) {
        wishlist_array = wishlist_array.filter(item => item != product_id);
    } else {
        wishlist_array.push(parseInt(product_id));
    }

    wishlist_array = unique(wishlist_array)

    localStorage.setItem('wishlist', JSON.stringify(wishlist_array))

    console.log({
        wishlist_array
    });

});

function mark_fav() {

    let wishlist_array = JSON.parse(localStorage.getItem("wishlist")) ?? [];

    $(document).find('.toggle-whishlist').each(function() {

        let element = $(this);

        let heart = "html/img/icon/heart.png";
        let heartfill = "html/img/icon/heartfill.png";

        let product_id = element.attr('data-product-id');

        if (inArray(product_id, wishlist_array)) {
            element.find('img').attr('src', heartfill);
        } else {
            element.find('img').attr('src', heart);
        }



    });

}

function add_to_cart_items(product_id, qty_type, type, qty, view_type) {
    //  alert(product_id);
    var routeName = "add-to-cart.html";
    var token = "psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA";
    var size_id = $('.active_size').attr('size_id');
    var color_id = $('.active_color').attr('id');
    $.ajax({
        type: 'POST',
        url: routeName,
        data: {
            product_id: product_id,
            _token: token,
            qty: qty,
            size_id: size_id,
            color_id: color_id,
            type: type,
            qty_type: qty_type
        },
        dataType: "text",
        success: function(resultData) {
            resultData = JSON.parse(resultData);
            console.log(resultData.status);

            if (resultData.status == 'success') {
                $('.shopping__cart__table').html(resultData.html);
                $('.count').html(resultData.item_count);
                //  $('.sub_total_price').html("$" + resultData.total_price);
                $('.total_cart').html(resultData.total_price);
                if(type == 'remove'){
                    title = 'Item Removed Successfully...';
                }else{
                    title = 'Item Added Successfully...';
                }
                Swal.fire({
                    icon:'success',
                    title: title,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    console.log(view_type);
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed && view_type == 'main') {
                        window.location.reload()
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Something went wrong try again later....'
                })
            }

        },
        error: function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Something went wrong',
            })
        }
    });
}

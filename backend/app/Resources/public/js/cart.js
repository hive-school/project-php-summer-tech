/**
 * Created by sania on 18.12.14.
 */

$('.add-to-cart').on('click', function(){
    console.log('add-to-cart');
    $.ajax({
        method: 'GET',
        url: $('.add-to-cart').attr('data-url')
    }).success(function(){
        $('.message').fadeIn().text('Product was added to cart');
        setTimeout(function(){
            $('.message').fadeOut();
        }, 10000)
    });
});

$('.remove-from-cart').on('click', function(){
    console.log('remove-from-cart');
    $.ajax({
        method: 'GET',
        url: $('.remove-from-cart').attr('data-url')
    }).success(function () {
        window.location.reload();
    });
});
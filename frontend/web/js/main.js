jQuery(function($) {
    $('.modalButton').click(function () {
        var $size = $('[name="BuyProductForm[size]"]').val();
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value')+"&size="+$size);
        return false;
    });

    $('.modalAnchor').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('href'));
        return false;
    });

    $('.product-add-size').on('change', function (e) {
        $('#product-price-val').html($(this).val());
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });

    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
});
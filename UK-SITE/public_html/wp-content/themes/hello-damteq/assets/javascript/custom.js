(function ($) {
    
    $(document).ready(function () {
        $('.woocommerce-product-gallery__image > a').on("click", function (e) {
            $(this).removeAttr("href");
            e.preventDefault();
        });

    });
})(jQuery);
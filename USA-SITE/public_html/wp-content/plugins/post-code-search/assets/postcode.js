(function ($) {
   /* $(function () {
        $('form#postcode-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '../components/insert.php',
                type: "POST",
                data: $('input[name="postcode"]').serialize(),
                success: function (data) {
                    console.log(data);

                    if ( typeof data.title !== 'undefined' && data.title != '') {
                        title = data.title;
                    } else {
                        title = '';
                    }
                    html = '';
                    $.each(data.suppliers, function (key, value) {
                        html += '<a href="'+value.link+'"><div class="postcode-card"><strong>'+value.name+'</strong><span>'+value.tel+'</span><span>'+value.email+'</span></div></a>';
                    });
                    $('.postcode-container-title').html(title);
                    $('.postcode-card-container').html(html);
                }
            });
        });
    });*/
})(jQuery);
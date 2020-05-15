<?php
/**
 * Template Name: Post Code Test
 * Date: 01/10/2019
 */

get_header();

require_once 'components/class.Postcode.php';
//include('ajax.php');
?>

    <script>
        (function ($) {
            $(function () {
                $('form#postcode-form').on('submit', function (e) {

                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo get_template_directory_uri() . "/ajax.php" ?>',
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
            });

        })(jQuery);
    </script>

    <div id="postcode-container" class="container">
        <?php if (have_rows('form')): ?>
            <?php while (have_rows('form')): the_row();
                $title = get_sub_field('title');
                $label = get_sub_field('label');
                $button = get_sub_field('button');
                ?>
                <h2 class="title"><?php echo $title; ?> </h2>
                <form action="" method="post" id="postcode-form">
                    <div class="field">
                        <label class="label"><?php echo $label; ?></label>
                        <div class="control">
                            <input class="input" type="text" placeholder="e.g. SE1 9SG" name="postcode">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary" type="submit">
                                <?php echo $button; ?>
                            </button>
                        </div>
                    </div>
                </form>
            <?php endwhile; ?>
        <?php endif; ?>

        <div class="postcode-container-title"></div>
        <div class="postcode-card-container">

        </div>

    </div>
<?php get_footer();
<?php
/**
 * Theme functions and definitions
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!isset($content_width)) {
    $content_width = 800; // pixels
}

/*
 * Set up theme support
 */
if (!function_exists('damteq_theme_setup')) {
    function damteq_theme_setup()
    {
        if (apply_filters('damteq_theme_load_textdomain', true)) {
            load_theme_textdomain('damteq-theme', get_template_directory() . '/languages');
        }

        if (apply_filters('damteq_theme_register_menus', true)) {
            register_nav_menus(array('menu-1' => __('Primary', 'damteq')));
        }

        if (apply_filters('damteq_theme_add_theme_support', true)) {
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support('custom-logo');
            add_theme_support('html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ));
            add_theme_support('custom-logo', array(
                'height' => 100,
                'width' => 350,
                'flex-height' => true,
                'flex-width' => true,
            ));

            /*
             * Editor Style
             */
            add_editor_style('editor-style.css');

            /*
             * WooCommerce
             */
            if (apply_filters('damteq_theme_add_woocommerce_support', true)) {
                // WooCommerce in general:
                add_theme_support('woocommerce');
                // Enabling WooCommerce product gallery features (are off by default since WC 3.0.0):
                // zoom:
                add_theme_support('wc-product-gallery-zoom');
                // lightbox:
                //add_theme_support('wc-product-gallery-lightbox');
                remove_theme_support('wc-product-gallery-lightbox');
                // swipe:
                add_theme_support('wc-product-gallery-slider');
            }
        }
    }
}
add_action('after_setup_theme', 'damteq_theme_setup');

/*
 * Theme Scripts & Styles
 */
if (!function_exists('damteq_theme_scripts_styles')) {
    function damteq_theme_scripts_styles()
    {
        $min_suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        if (apply_filters('damteq_theme_enqueue_style', true)) {
            wp_enqueue_style('damteq_theme-style', get_stylesheet_uri());
            wp_enqueue_style('damteq-styles', get_template_directory_uri() . '/assets/scss/style' . $min_suffix . '.css');
            wp_enqueue_style('theme-styles', get_template_directory_uri() . '/theme' . $min_suffix . '.css');

            wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', '3.3.1', true);
            wp_enqueue_script('damteq-js', get_template_directory_uri() . '/assets/javascript/custom' . $min_suffix . '.js');
        }
    }
}
add_action('wp_enqueue_scripts', 'damteq_theme_scripts_styles');

/*
 * Register damteq Locations
 */
if (!function_exists('damteq_theme_register_damteq_locations')) {
    function damteq_theme_register_damteq_locations($damteq_theme_manager)
    {
        if (apply_filters('damteq_theme_register_damteq_locations', true)) {
            $damteq_theme_manager->register_all_core_location();
        }
    }
}
add_action('damteq/theme/register_locations', 'damteq_theme_register_damteq_locations');

/**
 * Adds acf theme options.
 *
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'icon_url' => 'dashicons-art',
        'position' => 3
    ));
}

/**
 * Acf theme options enqueue to wp_head()
 *
 */
function damteq_theme_head_script()
{ ?>
    <?php if (get_field('tracking_id', 'options')) : ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
            src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('tracking_id', 'options'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '<?php the_field('tracking_id', 'options'); ?>'<?php if (get_field('google_optimise', 'options') ) : ?>, {'optimize_id': '<?php the_field('gtm_id', 'options'); ?>'}<?php endif; ?>);
    </script>
    <!-- End Global site tag (gtag.js) - Google Analytics -->
<?php endif; ?>

    <?php if (get_field('adwords_id', 'options')) : ?>
    <!-- Global site tag (gtag.js) - Google Ads -->
    <script async
            src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('adwords_id', 'options'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '<?php the_field('adwords_id', 'options'); ?>');
    </script>
    <!-- End Global site tag (gtag.js) - Google Ads -->
<?php endif; ?>

    <?php if (get_field('gtm_id', 'options')) : ?>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '<?php the_field('gtm_id', 'options'); ?>');
    </script>
    <!-- End Google Tag Manager -->
<?php endif; ?>
    <!-- Google Phone Tracking -->
    <?php if (get_field('google_phone_conversion_id', 'options')) : ?>
    <script>
        gtag('config', '<?php the_field('adwords_id', 'options'); ?>/<?php the_field('google_phone_conversion_id', 'options'); ?>', {
            'phone_conversion_number': '<?php the_field('google_phone_conversion_number', 'options'); ?>'
        });
    </script>
    <!-- End Google Phone Tracking -->
<?php endif; ?>

    <!-- Header Script-->
    <?php
    the_field('header_scripts', 'options');
}

add_action('wp_head', 'damteq_theme_head_script');

/**
 * Acf theme options enqueue to wp_footer()
 *
 */
function damteq_theme_footer_script()
{
    the_field('footer_scripts', 'options');
}

add_action('wp_footer', 'damteq_theme_footer_script');

/**
 * Add Scripts to Elementor body (full width layout)
 *
 * @since 0.4.0
 */
function damteq_elementor_body_scripts()
{
    if (get_field('gtm_id', 'options')) :
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php the_field('gtm_id', 'options') ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php
    endif;

    the_field('conversion_tracking');
}

add_action('elementor/page_templates/header-footer/before_content', 'damteq_elementor_body_scripts', 0);

/**
 * Add Scripts to Elementor body (canvas width layout)
 *
 * @since 0.4.1
 */
function damteq_elementorcanvas_body_scripts()
{
    if (get_field('gtm_id', 'options')) :
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php the_field('gtm_id', 'options') ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php
    endif;

    the_field('conversion_tracking');
}

add_action('elementor/page_templates/canvas/before_content', 'damteq_elementorcanvas_body_scripts', 0);


/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

    $tabs['description']['title'] = __( 'Delivery' );		// Rename the description tab
    return $tabs;

}

/**
 * Reorder product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {

    $tabs['description']['priority'] = 5;
    $tabs['reviews']['priority'] = 10;

    return $tabs;
}
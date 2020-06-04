<?php
/**
 * Plugin Name: Post Code Search
 * Plugin URI: https://www.damteq.co.uk
 * Description: Find your nearest LoftZone Installer
 * Version: 1.0.0
 * Author: Damteq®
 * Author URI: https://www.damteq.co.uk
 */

add_action('init', 'require_acf');
function require_acf()
{
    if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('advanced-custom-fields-pro/acf.php')) :
        add_action('admin_notices', 'require_acf_notice');
        deactivate_plugins(plugin_basename(__FILE__));
        if (isset($_GET['activate'])) :
            unset($_GET['activate']);
        endif;
    endif;
}

function require_acf_notice()
{ ?>
    <div class="error">
        <p>Sorry, but we require the Advanced Custom Fields Pro plugin to be installed and active.</p>
    </div>
    <?php
}

/**
 * Adds dashboard side tab.
 *
 * @since 1.0.0
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Post Code Search',
        'menu_title' => 'Post Code Search',
        'icon_url' => 'dashicons-location',
        'position' => 4
    ));
}

/**
 * Post Code Search PHP fields
 *
 * @since 1.0.0
 */
if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_5d94527db5068',
        'title' => 'Postcodes',
        'fields' => array(
            array(
                'key' => 'field_5d94cb216c8d1',
                'label' => 'Installers',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_5d945b0252245',
                'label' => 'Installers',
                'name' => 'array_repeater',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'row',
                'button_label' => 'Add Installer',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5d94529c52242',
                        'label' => 'Installer Name',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d945ae452243',
                        'label' => 'Installer Url',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_5d945af152244',
                        'label' => 'Installer Acronym',
                        'name' => 'acronym',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d94859a90da9',
                        'label' => 'Installer Telephone',
                        'name' => 'telephone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d9485b890daa',
                        'label' => 'Installer Email',
                        'name' => 'email',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d945b3352246',
                        'label' => 'Postcodes',
                        'name' => 'postcodes',
                        'type' => 'text',
                        'instructions' => 'Ensure there is a space between each postcode area.',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_5d94cb2c6c8d2',
                'label' => 'Form',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_5d94cad16c8ce',
                'label' => 'Form',
                'name' => 'form',
                'type' => 'group',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'row',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5d94c9c96c8cd',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Find your nearest installer',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d94caeb6c8cf',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Enter your postcode',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d94cb036c8d0',
                        'label' => 'Button',
                        'name' => 'button',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Find your nearest installer',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_5d94cb936c8d4',
                'label' => 'Error Message',
                'name' => 'error_message',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'We\'re sorry, we don\'t currently cover your area.',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5d95cbf0752ba',
                'label' => 'Areas Not Covered',
                'name' => 'not_covered',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-post-code-search',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;

/**
 * Adds widget: Post Code Search
 *
 * @since 1.0
 */
class Postcodesearch_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'postcodesearch_widget',
            esc_html__('Post Code Search', 'textdomain')
        );
    }

    private $widget_fields = array();

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        require_once 'components/class.Postcode.php'; ?>

        <script>
            (function ($) {
                $(function () {
                    $('form#postcode-form').on('submit', function (e) {
                        e.preventDefault();
                        $.ajax({
                            url: '<?php echo plugins_url() . "/post-code-search/components/insert.php" ?>',
                            type: "POST",
                            data: $('#postcode-container input[name="postcode"]').serialize(),
                            success: function (data) {
                                console.log(data);
                                var gogtag = data.tracking;
                                var script = document.createElement('script');
                                script.onload = function () {
                                    window.dataLayer = window.dataLayer || [];

                                    function gtag() {
                                        dataLayer.push(arguments);
                                    }

                                    gtag('js', new Date());
                                    gtag('config', gogtag);
                                    gtag('event', 'conversion', {'send_to': gogtag + '/xtxsCNiz1rQBEIf1z9oD'});
                                };
                                script.src = 'https://www.googletagmanager.com/gtag/js?id=' + gogtag;
                                document.head.appendChild(script);


                                if (typeof data.title !== 'undefined' && data.title != '') {
                                    title = data.title;
                                } else {
                                    title = '';
                                }
                                html = '';
                                $.each(data.suppliers, function (key, value) {
                                    html += '<a href="' + value.url + '" target="_blank" id="' + value.acronym + '"><div class="postcode-card"><strong>' + value.name + '</strong></div></a>';
                                    /*<span>' + value.tel + '</span><span>' + value.email + '</span>*/
                                    console.log(value.name);
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
            <?php if (have_rows('form', 'options')): ?>
                <?php while (have_rows('form', 'options')): the_row();
                    $title = get_sub_field('title');
                    $label = get_sub_field('label');
                    $button = get_sub_field('button');
                    ?>
                    <!--<h2 class="title"><?php /*echo $title; */ ?></h2>-->
                    <form action="" method="post" id="postcode-form">
                        <div class="field">
                            <!--<label class="label"><?php /*echo $label; */ ?></label>-->
                            <div class="control">
                                <input class="input postcode" type="text" placeholder="e.g. SE1 9SG" name="postcode">
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
            <div class="postcode-card-container"></div>

        </div>
        <?php echo $args['after_widget'];
    }

    public function field_generator($instance)
    {
        $output = '';
        foreach ($this->widget_fields as $widget_field) {
            $default = '';
            if (isset($widget_field['default'])) {
                $default = $widget_field['default'];
            }
            $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'textdomain');
            switch ($widget_field['type']) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'textdomain') . ':</label> ';
                    $output .= '<input class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }

    public function form($instance)
    {
        $this->field_generator($instance);
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        foreach ($this->widget_fields as $widget_field) {
            switch ($widget_field['type']) {
                default:
                    $instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? strip_tags($new_instance[$widget_field['id']]) : '';
            }
        }
        return $instance;
    }
}

function register_postcodesearch_widget()
{
    register_widget('Postcodesearch_Widget');
}

add_action('widgets_init', 'register_postcodesearch_widget');

add_shortcode('damteq_hs', 'create_damteqhs_shortcode');

/**
 * Styles & scripts.
 *
 * @since 1.0.0
 */
function postcode_styles()
{
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', '', '3.4.1', true);
    //wp_register_script('postcode_js', plugins_url('assets/postcode.min.js', __FILE__));
    //wp_enqueue_script('postcode_js');
    wp_register_style('postcode_style_css', plugins_url('assets/scss/style.min.css', __FILE__));
    wp_enqueue_style('postcode_style_css');
}

add_action('wp_enqueue_scripts', 'postcode_styles');
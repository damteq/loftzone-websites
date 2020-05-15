<?php

/**
 * Plugin Name: Square Footage Calc
 * Plugin URI: https://www.damteq.co.uk
 * Description: Tiny lightweight plugin to calculate square footage.
 * Version: 1.0.0
 * Author: Damteq®
 * Author URI: https://www.damteq.co.uk
 */

/**
 * Square Footage Calc
 *
 * @since 1.0.0
 */
class Squarefootagecalc_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'squarefootagecalc_widget',
            esc_html__('Square Footage Calc', 'damteq')
        );
    }

    private $widget_fields = array();

    public function widget($args, $instance)
    {
        echo $args['before_widget']; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <div id="container-damteq_calculator">
            <h4 class="is-4 title"><?php echo get_field('calc_title', 'option'); ?></h4>
            <p><?php echo get_field('calc_instruction', 'option'); ?></p>

            <form action="" id="damteq_calculator">
                <div class="surface">
                    <div class="field">
                        <label class="label"><?php _e('Distance along joists', 'damteq'); ?></label>
                        <div class="control">
                            <input class="input" id="damteq_joists" type="number" placeholder="Enter measurement"
                                   name="width" min="0" step="1.2">
                            <span>Metres</span>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label"><?php _e('Distance along cross-beams', 'damteq'); ?></label>
                        <div class="control">
                            <input class="input" id="damteq_crossbeams" type="number"
                                   placeholder="Enter measurement" name="length" min="0" step="1.2">
                            <span>Metres</span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="damteq_totals">
                <h5 class="is-5 title"><?php _e('The number of parts you require are shown below:', 'damteq') ?></h5>
            </div>
            <div class="damteq_totals crossbeams"><?php _e('1.2m Cross-Beams:', 'damteq'); ?> <span></span></div>
            <div class="damteq_totals trisupports"><?php _e('Tri-Supports:', 'damteq'); ?> <span></span></div>
            <div class="damteq_totals unisupports"><?php _e('Uni-Supports:', 'damteq'); ?> <span></span></div>

            <!--<div class="damteq_totals againstone"><?php /*_e('Or if deck goes right up against 1 wall:', 'damteq'); */
            ?> <span></span></div>-->

            <!--<div class="damteq_totals againsttwo"><?php /*_e('Or if deck goes right up against 2 walls:', 'damteq'); */
            ?> <span></span></div>-->

            <!--<div class="damteq_totals bigloftboards"><?php /*_e('Big LoftBoards:', 'damteq'); */
            ?> <span></span></div>-->

            <div class="damteq_totals smallloftboards"><?php _e('1.2m LoftBoards:', 'damteq'); ?> <span></span></div>

            <!--<div class="damteq_totals smallloftboardpacks"><?php /*_e('No. of packs of small loft boards:', 'damteq'); */
            ?> <span></span></div>-->

        </div>
        <!--<div class="damteq_totalareasq"><?php /*_e('With 10% for cuts and wastage:', 'damteq'); */
        ?> <span></span></div>-->
        <script>
            $(document).ready(function () {
                $('.damteq_totals').hide();

                    let a = parseFloat($('#damteq_joists').val(), 10),
                        b = parseFloat($('#damteq_crossbeams').val(), 10),
                        c = a / 0.6,
                        d = c + 1,
                        e = b / 1.2,
                        f = e + 1,
                        g = e - 1,
                        both = a + b,
                        uni = Math.ceil(d * e / 2),
                        //big = Math.ceil(a / 2.4 * b / 0.6),
                        small = Math.ceil(a / 1.2 * b / 0.325);
                    //packs = Math.ceil(small/3);

                    console.log(a);
                    console.log(Math.round(a / 10) * 2.4);
                    console.log(Math.round(b / 10) * 10);

                    if (!isNaN(both)) {
                        $('.damteq_totals').delay(300).show(500);
                        $('.damteq_totals.crossbeams span').html(Math.ceil(d * e));
                        $('.damteq_totals.trisupports span').html(Math.ceil(d * f));
                        $('.damteq_totals.unisupports span').html(Math.ceil(uni));
                        //$('.damteq_totals.againstone span').html(Math.ceil(uni + a / 0.6 + 1));
                        //$('.damteq_totals.againsttwo span').html(Math.ceil(uni + 2 * a / 0.6 + 2));
                        //$('.damteq_totals.bigloftboards span').html(Math.ceil(big));
                        $('.damteq_totals.smallloftboards span').html(Math.ceil(small));
                        //$('.damteq_totals.smallloftboardpacks span').html(Math.ceil(packs));
                    }

                $(document).on('change, mouseup, keyup', updateArea);
            })
        </script>

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
            $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'damteq');
            switch ($widget_field['type']) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'damteq') . ':</label> ';
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

function register_squarefootagecalc_widget()
{
    register_widget('Squarefootagecalc_Widget');
}

add_action('widgets_init', 'register_squarefootagecalc_widget');

/**
 * Styles & scripts.
 *
 * @since 1.0.0
 */
function sqft_styles()
{
    wp_register_style('sqft_style_css', plugins_url('assets/scss/style.css', __FILE__));
    wp_enqueue_style('sqft_style_css');
}

add_action('wp_enqueue_scripts', 'sqft_styles');
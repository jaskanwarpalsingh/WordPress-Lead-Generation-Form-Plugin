<?php
/**
 * Registers main scripts and styles
 */
add_action(
    'wp_enqueue_scripts',
    function () {
        $assets = array();
        $assets = wp_parse_args($assets, array(
            'src' => slgf_plugin_url('includes/js/script.js'),
            'version' => SLGF_VERSION,
            'in_footer' => ('header' !== slgf_load_js()),
        ));
        wp_register_script(
            'simple-lead-gen-form',
            $assets['src'],
            $assets['version'],
            $assets['in_footer']
        );
        wp_register_script(
            'jquery',
            'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'
        );
        wp_register_script(
            'jquery-validate',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js'
        );
        if (slgf_load_js()) {
            slgf_enqueue_scripts();
        }
        wp_register_style(
            'simple-lead-gen-form',
            slgf_plugin_url('includes/css/styles.css'),
            array(),
            SLGF_VERSION,
            'all'
        );
        if (slgf_load_css()) {
            slgf_enqueue_styles();
        }
        $ajax_array = array(
            'ajax_url' => admin_url('admin-ajax.php'),
        );
        wp_localize_script('simple-lead-gen-form', 'slgf_object', $ajax_array);
    },
    10, 0
);

/**
 * Enqueues scripts
 */
function slgf_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-validate');
    wp_enqueue_script('simple-lead-gen-form');
    do_action('slgf_enqueue_scripts');
}

/**
 * Enqueues styles
 */
function slgf_enqueue_styles()
{
    wp_enqueue_style('simple-lead-gen-form');
    do_action('slgf_enqueue_styles');
}

<?php
require_once SLGF_PLUGIN_DIR . '/includes/functions.php';
require_once SLGF_PLUGIN_DIR . '/includes/submission.php';
require_once SLGF_PLUGIN_DIR . '/includes/lead-form.php';
require_once SLGF_PLUGIN_DIR . '/includes/lead-form-functions.php';

if (is_admin()) {
    require_once SLGF_PLUGIN_DIR . '/admin/admin.php';
} else {
    require_once SLGF_PLUGIN_DIR . '/includes/controller.php';
}

/**
 * Registers WordPress shortcode
 */
function slgf()
{
    add_shortcode('simple-lead-gen-form', 'slgf_lead_form_tag_func');
}
add_action('plugins_loaded', 'slgf', 10, 0);

/**
 * Registers post type for lead form
 */
function slgf_init()
{
    slgf_register_post_type();
    do_action('slgf_init');
}
add_action('init', 'slgf_init', 10, 0);

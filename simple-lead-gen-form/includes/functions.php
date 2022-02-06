<?php

/**
 * Returns path to a plugin file
 * 
 * slgf_plugin_url
 *
 * @param string $path File path relative to the plugin root directory.
 * @return string Absolute file path.
 */
function slgf_plugin_url($path = '')
{
    return path_join(SLGF_PLUGIN_DIR_URL . SLGF_PLUGIN_NAME . '/', trim($path, '/'));
}

/**
 * Registers post types used for this plugin
 * 
 * slgf_register_post_type
 *
 * @return void
 */
function slgf_register_post_type()
{
    if (class_exists('SLGF_LeadForm')) {
        SLGF_LeadForm::register_post_type();
        SLGF_LeadForm::register_taxonomy();
        SLGF_LeadForm::register_tags();
        return true;
    } else {
        return false;
    }
}

/**
 * Returns a formatted string of HTML attributes
 * 
 * slgf_format_atts
 *
 * @param array $atts Associative array of attribute name and value pairs.
 * @return string Formatted HTML attributes.
 */
function slgf_format_atts($atts)
{
    $html = '';
    $prioritized_atts = array('type', 'name', 'value');
    foreach ($prioritized_atts as $att) {
        if (isset($atts[$att])) {
            $value = trim($atts[$att]);
            $html .= sprintf(' %s="%s"', $att, esc_attr($value));
            unset($atts[$att]);
        }
    }
    foreach ($atts as $key => $value) {
        $key = strtolower(trim($key));
        if (!preg_match('/^[a-z_:][a-z_:.0-9-]*$/', $key)) {
            continue;
        }
        $value = trim($value);
        if ('' !== $value) {
            $html .= sprintf(' %s="%s"', $key, esc_attr($value));
        }
    }
    $html = trim($html);
    return $html;
}

/**
 * Returns true if JavaScript for this plugin is loaded
 * 
 * slgf_load_js
 *
 * @return void
 */
function slgf_load_js()
{
    return apply_filters('slgf_load_js', SLGF_LOAD_JS);
}

/**
 * Returns true if CSS for this plugin is loaded.
 * 
 * slgf_load_css
 *
 * @return void
 */
function slgf_load_css()
{
    return apply_filters('slgf_load_css', SLGF_LOAD_CSS);
}

<?php

/**
 * Register meta box
 *
 * slgf_register_meta_boxes
 * 
 * @return void
 */
function slgf_register_meta_boxes()
{
    add_meta_box('customer-details', __('Customer Details', 'slgf-cd'), 'slgf_display_callback', 'slgf_customers');
}
add_action('add_meta_boxes', 'slgf_register_meta_boxes');

/**
 * Meta box display callback
 * 
 * slgf_display_callback
 *
 * @param  mixed $post
 * @return void
 */
function slgf_display_callback($post)
{
    include SLGF_PLUGIN_DIR . './admin/meta-box.php';
}

/**
 * Save meta box content
 * 
 * slgf_save_meta_box
 *
 * @param  mixed $post_id
 * @return void
 */
function slgf_save_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }
    $fields = [
        'slgf_phone',
        'slgf_email',
        'slgf_budget',
        'slgf_message',
    ];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'slgf_save_meta_box');

/**
 * Add columns on the 'custom post type' listing screen 
 * 
 * my_columns
 *
 * @param  mixed $columns
 * @return void
 */
function my_columns($columns)
{
    $columns['slgf_phone'] = 'Phone';
    $columns['slgf_email'] = 'Email';
    $columns['slgf_budget'] = 'Budget';
    return $columns;
}
add_filter('manage_edit-slgf_customers_columns', 'my_columns');

/**
 * Display the values under the new columns of custom post type
 * 
 * slgf_customers_custom_columns
 *
 * @param  mixed $column
 * @return void
 */
function slgf_customers_custom_columns($column)
{
    global $post;
    switch ($column) {
        case "slgf_phone":
            echo esc_attr(get_post_meta($post->ID, 'slgf_phone', true));
            break;
        case "slgf_email":
            echo esc_attr(get_post_meta($post->ID, 'slgf_email', true));
            break;
        case "slgf_budget":
            echo esc_attr(get_post_meta($post->ID, 'slgf_budget', true));
            break;
    }
}
add_action("manage_slgf_customers_posts_custom_column", "slgf_customers_custom_columns");

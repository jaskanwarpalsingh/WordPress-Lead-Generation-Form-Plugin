<?php

add_action('wp_ajax_form_submission', 'form_submission');
add_action('wp_ajax_nopriv_form_submission', 'form_submission');

/**
 * Fetch submitted form data
 * 
 * form_submission
 *
 * @return void
 */
function form_submission()
{
    $params = array();
    parse_str($_POST['formData'], $params);
    if (wp_verify_nonce($params['_wpnonce'], 'slgf_nonce')) {
        echo save_post_data($params);
    }
    die;
}

/**
 * Save the form data in custom post type
 * 
 * save_post_data
 *
 * @param  mixed $params
 * @return void
 */
function save_post_data($params)
{
    extract($params);
    $new_customer = array(
        'post_title' => sanitize_title($name),
        'post_status' => 'publish',
        'post_type' => 'slgf_customers',
    );
    $pid = wp_insert_post($new_customer);
    add_post_meta($pid, 'slgf_phone', sanitize_text_field($phone));
    add_post_meta($pid, 'slgf_email', sanitize_email($email));
    add_post_meta($pid, 'slgf_budget', sanitize_text_field($budget));
    add_post_meta($pid, 'slgf_message', sanitize_textarea_field($message));
    add_post_meta($pid, 'slgf_date', $_slgf_date);
    add_post_meta($pid, 'slgf_time', $_slgf_time);
    if ($pid) {
        return SUCCESS_MSG;
    }
    return ERROR_MSG;
}

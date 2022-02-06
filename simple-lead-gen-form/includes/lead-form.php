<?php

/**
 * SLGF_LeadForm
 */
class SLGF_LeadForm
{
    const post_type = 'slgf_customers';
    private $shortcode_atts = array();
    private $responses_count = 0;

    /**
     * Register the post type for lead gen form.
     *
     * register_post_type
     *
     * @return void
     */
    public static function register_post_type()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name' => _x('Customers', ''),
            'singular_name' => _x('Customer', ''),
            'menu_name' => __('Customers', ''),
            'parent_item_colon' => __('Parent Customer', ''),
            'all_items' => __('All Customers', ''),
            'view_item' => __('View Customer', ''),
            'add_new_item' => __('Add New Customer', ''),
            'add_new' => __('Add New', ''),
            'edit_item' => __('Edit Customer', ''),
            'update_item' => __('Update Customer', ''),
            'search_items' => __('Search Customer', ''),
            'not_found' => __('Not Found', ''),
            'not_found_in_trash' => __('Not found in Trash', ''),
        );
        // Set other options for Custom Post Type
        $args = array(
            'label' => __('customers', ''),
            'description' => __('Customer', ''),
            'labels' => $labels,
            'supports' => array('title', 'revisions'),
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-universal-access',
            'capability_type' => 'post',
            'show_in_rest' => true
        );
        register_post_type(self::post_type, $args);
    }

    /**
     * Register a new taxonomy
     *
     * register_taxonomy
     *
     * @return void
     */
    public static function register_taxonomy()
    {
        $labels = array(
            'name' => _x('Customer Categories', 'taxonomy general name'),
            'singular_name' => _x('Category', 'taxonomy singular name'),
            'search_items' => __('Search Customer Categories'),
            'all_items' => __('All Customer Categories'),
            'parent_item' => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item' => __('Edit Category'),
            'update_item' => __('Update Category'),
            'add_new_item' => __('Add New Category'),
            'new_item_name' => __('New Category Name'),
            'menu_name' => __('Customer Categories'),
        );

        // Now register the taxonomy
        register_taxonomy('customer_category', array(self::post_type), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'customer_category'),
        ));
    }

    /**
     * Register a custom tags
     *
     * register_tags
     *
     * @return void
     */
    public static function register_tags()
    {
        $labels = array(
            'name' => _x('Customer Tags', 'taxonomy general name'),
            'singular_name' => _x('Tag', 'taxonomy singular name'),
            'search_items' => __('Search Customer Tags'),
            'all_items' => __('All Customer Tags'),
            'parent_item' => __('Parent Tag'),
            'parent_item_colon' => __('Parent Tag:'),
            'edit_item' => __('Edit Tag'),
            'update_item' => __('Update Tag'),
            'add_new_item' => __('Add New Tag'),
            'new_item_name' => __('New Tag Name'),
            'menu_name' => __('Customer Tags'),
        );

        // Now register the taxonomy
        register_taxonomy('customer_tag', array(self::post_type), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'customer_tag'),
        ));
    }

    /**
     * Fetch date and time from third party api (worldtime api)
     *
     * get_date_time
     *
     * @return void
     */
    public function get_date_time()
    {
        $current_timezone = date_default_timezone_get();
        if ($current_timezone == 'UTC') {
            $current_timezone = 'Asia/Kolkata';
        }
        $url = WORLDTIMEAPI . $current_timezone;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        $response = json_decode($data, true);
        $dt = new DateTime($response['datetime']);
        $date = $dt->format('Y-m-d');
        $time = $dt->format('H:i:s');
        curl_close($curl);
        return array('date' => $date, 'time' => $time);
    }

    /**
     * Generates HTML that represents a form
     *
     * form_html
     *
     * @param string|array $args Optional. Form options.
     * @return string HTML output.
     */
    public function form_html($args = '')
    {
        $this->shortcode_atts = $args;
        $atts = array(
            'action' => '',
            'method' => 'post',
            'class' => 'slgf-form',
            'enctype' => 'multipart/form-data',
            'autocomplete' => 'off',
            'novalidate' => '',
            'id' => 'lead-gen-form',
        );
        $atts = slgf_format_atts($atts);
        $html = '<div class="form-container"><h3>Simple Lead Generation Form</h3>';
        $html .= sprintf('<form %s>', $atts) . "\n";
        $html .= $this->form_hidden_fields();
        $html .= $this->form_elements();
        $html .= wp_nonce_field('slgf_nonce');
        $html .= '<div class="success_msg notices" style="display: none"></div>';
        $html .= '<div class="error_msg notices" style="display: none"></div>';
        $html .= '</form></div>';
        return $html;
    }

    /**
     * Returns a set of hidden fields
     *
     * form_hidden_fields
     *
     * @return void
     */
    private function form_hidden_fields()
    {
        $content = '';
        $date_time = $this->get_date_time();
        $hidden_fields = array(
            '_slgf_date' => $date_time['date'],
            '_slgf_time' => $date_time['time'],
        );
        foreach ($hidden_fields as $name => $value) {
            $content .= sprintf(
                '<input type="hidden" name="%1$s" value="%2$s" />',
                esc_attr($name),
                esc_attr($value)
            ) . "\n";
        }
        return '<div class="hidden-fields" style="display: none;">' . "\n" . $content . '</div>' . "\n";
    }

    /**
     * Returns a set of form fields
     *
     * form_elements
     *
     * @return void
     */
    public function form_elements()
    {
        $form_fields = array(
            'name' => 'text',
            'phone' => 'number',
            'email' => 'email',
            'budget' => 'number',
            'message' => 'textarea',
            'submit' => 'button',
        );
        $content = '<div class="row">';
        $inc = 0;
        foreach ($form_fields as $name => $value) {
            $class_name = 'responsive';
            if ($inc % 2 == 0) {
                $class_name = 'right-margin';
            }
            if ($inc == 2) {
                $content .= '</div><div class="row">';
                $inc = 0;
            }
            switch ($value) {
                case 'text':
                    $content .= sprintf(
                        '<div class="col-2 inline-block ' . $class_name . '"><div class="label lb-%1$s">%2$s <span id="%1$s-info" class="info"></span></div><input type="text" class="input-field %1$s" name="%1$s" maxlength="%3$s" /></div>',
                        esc_attr($name),
                        esc_attr($this->shortcode_atts[$name . '_label']),
                        esc_attr($this->shortcode_atts[$name . '_maxlen'])
                    ) . "\n";
                    break;
                case 'email':
                    $content .= sprintf(
                        '<div class="col-2 inline-block ' . $class_name . '"><div class="label lb-%1$s">%2$s <span id="%1$s-info" class="info"></span></div><input type="email" class="input-field %1$s" name="%1$s" maxlength="%3$s" /></div>',
                        esc_attr($name),
                        esc_attr($this->shortcode_atts[$name . '_label']),
                        esc_attr($this->shortcode_atts[$name . '_maxlen'])
                    ) . "\n";
                    break;
                case 'number':
                    $content .= sprintf(
                        '<div class="col-2 inline-block ' . $class_name . '"><div class="label lb-%1$s">%2$s <span id="%1$s-info" class="info"></span></div><input class="input-field %1$s" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==%3$s) return false;" name="%1$s" /></div>',
                        esc_attr($name),
                        esc_attr($this->shortcode_atts[$name . '_label']),
                        esc_attr($this->shortcode_atts[$name . '_maxlen'])
                    ) . "\n";
                    break;
                case 'textarea':
                    $content .= sprintf(
                        '<div class="col-1 inline-block responsive"><div class="label lb-%1$s">%2$s <span id="%1$s-info" class="info"></span></div><textarea class="input-field %1$s" name="%1$s" maxlength="%3$s" rows="%4$s" cols="%5$s" /></textarea></div>',
                        esc_attr($name),
                        esc_attr($this->shortcode_atts[$name . '_label']),
                        esc_attr($this->shortcode_atts[$name . '_maxlen']),
                        esc_attr($this->shortcode_atts[$name . '_rows']),
                        esc_attr($this->shortcode_atts[$name . '_cols'])
                    ) . "\n";
                    $content .= '</div><div class="row">';
                    $i = 0;
                    break;
                case 'button':
                    $content .= sprintf(
                        '<button class="btn-submit" type="submit" name="%1$s" />%2$s</button>',
                        esc_attr($name),
                        esc_attr($this->shortcode_atts[$name . '_label'])
                    ) . "\n";
                    break;
            }
            $inc++;
        }
        $content .= '</div>';
        return '<div class="form-elements">' . "\n" . $content . '</div>' . "\n";
    }
}

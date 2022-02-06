<?php

/**
 * Create instance of a class and call the html generation method
 * 
 * slgf_lead_form_html
 *
 * @param  mixed $atts
 * @return void
 */
function slgf_lead_form_html($atts)
{
    $slgf_obj = new SLGF_LeadForm;
    return $slgf_obj->form_html($atts);
}

/**
 * Defauly values for the shortcode
 * 
 * slgf_lead_form_tag_func
 *
 * @param  mixed $atts
 * @return void
 */
function slgf_lead_form_tag_func($atts)
{
    $atts = shortcode_atts(
        array(
            // default labels
            'name_label' => 'Name',
            'phone_label' => 'Phone Number',
            'email_label' => 'Email Address',
            'budget_label' => 'Desired Budget',
            'message_label' => 'Message',
            'submit_label' => 'Submit',
            // default max lengths
            'name_maxlen' => '25',
            'phone_maxlen' => '10',
            'email_maxlen' => '25',
            'budget_maxlen' => '10',
            'message_maxlen' => '200',
            // default rows and cols
            'message_rows' => '3',
            'message_cols' => '10',
        ),
        $atts, 'slgf'
    );
    return slgf_lead_form_html($atts);
}

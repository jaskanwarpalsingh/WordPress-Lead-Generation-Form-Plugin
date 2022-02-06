<?php
/**
 * Plugin Name: Simple Lead Generation Form
 * Description: Simple Lead Generation Form Plugin
 * Version: 1.0
 * Author: Jaskanwarpal Singh
 **/

/**
 * Constants defined
 */
define('SLGF_VERSION', '1.0');
define('SLGF_TEXT_DOMAIN', 'simple-lead-gen-form');
define('SLGF_PLUGIN', __FILE__);
define('SLGF_PLUGIN_BASENAME', plugin_basename(SLGF_PLUGIN));
define('SLGF_PLUGIN_NAME', trim(dirname(SLGF_PLUGIN_BASENAME), '/'));
define('SLGF_PLUGIN_DIR', untrailingslashit(dirname(SLGF_PLUGIN)));
define('SLGF_PLUGIN_DIR_URL', plugin_dir_url(__DIR__));

if (!defined('SLGF_LOAD_JS')) {
    define('SLGF_LOAD_JS', true);
}

if (!defined('SLGF_LOAD_CSS')) {
    define('SLGF_LOAD_CSS', true);
}

define('WORLDTIMEAPI', 'http://worldtimeapi.org/api/timezone/');
define('ERROR_MSG', 'There was an error trying to submit your details. Please try again later.');
define('SUCCESS_MSG', 'Details Submitted Successfully');

require_once SLGF_PLUGIN_DIR . '/load.php';

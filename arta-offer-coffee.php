<?php
/*
Plugin Name: Arta Offer Coffee
Description:  enables the user to order their custom coffee combination
Version: 1.1
Author: Artacode
Author URI: http://artacode.net
License: A "Slug" license name e.g. GPL2
*/

if (!defined('ARTAOFFERCOFFEE_PLUGIN_DIR')) {
    define('ARTAOFFERCOFFEE_PLUGIN_FILE', __FILE__);
    define('ARTAOFFERCOFFEE_PLUGIN_DIR', untrailingslashit(dirname(ARTAOFFERCOFFEE_PLUGIN_FILE)));
}

require_once ARTAOFFERCOFFEE_PLUGIN_DIR . '/includes/main.php';

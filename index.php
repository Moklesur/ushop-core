<?php
/*
Plugin Name: Ushop Core
Plugin URI: https://themetim.com/
Description: Ushop core contains all the functionality of ushop theme.
Author: themetim
Author URI: https://themetim.com
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'USHOP_VERSION', '1.0.0' );
define( 'USHOP_PLUG_DIR', dirname(__FILE__).'/' );
define('USHOP_PLUG_URL', plugin_dir_url(__FILE__));

function ushop_framework_init_check() {
    require_once USHOP_PLUG_DIR .'includes/index.php';
    if ( class_exists( 'SiteOrigin_Widget' ) ) {

        require USHOP_PLUG_DIR . 'includes/custom-widget/widget-services.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/widget-treading-products.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/widget-category-filter.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/widget-category-list.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/widget-recent-blog.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/widgets.php';
        require USHOP_PLUG_DIR . 'includes/custom-widget/so-widget.php';

    }
}
add_action( 'plugins_loaded', 'ushop_framework_init_check' );

?>
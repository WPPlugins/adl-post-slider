<?php
/**
 * @package ADL Post Slider
 */
/*
Plugin Name: ADL Post Slider
Plugin URI: http://adlplugins.com/adl-post-slider
Description: This excellent plugin allows you to display your posts with a very beautiful slider without coding knowledge.
Version: 1.2
Author: ADL Plugins
Author URI: http://adlplugins.com
License: GPLv2 or later
Domain Path: /languages/
Text Domain: adl-post-slider
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright  ADL Plugins.
*/


/**
 * Deny direct access
 */

if ( !defined('ABSPATH') ) die( 'Sorry! This is not your place!' );

// check for required php version and deactivate the plugin if php version is less.
if ( version_compare( PHP_VERSION, '5.4', '<' )) {
    add_action( 'admin_notices', 'aps_notice' );
    function aps_notice() { ?>
        <div class="error notice is-dismissible"> <p>
                <?php
                echo 'ADL Post Slider requires minimum PHP 5.4 to function properly. Please upgrade PHP version. The Plugin has been auto-deactivated.. You have PHP version '.PHP_VERSION;
                ?>
            </p></div>
        <?php
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }

    // deactivate the plugin because required php version is less.
    add_action( 'admin_init', 'aps_deactivate_self' );
    function aps_deactivate_self() {
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }
    return;
}



/*
 * All Constants
 */
if (!defined('APS_VERSION')) define( 'APS_VERSION', '1.0.0' );
if (!defined('APS_BASENAME')) define( 'APS_BASENAME', plugin_basename(__FILE__) );
if (!defined('APS_MINIMUM_WP_VERSION')) define( 'APS_MINIMUM_WP_VERSION', '3.5' );
if (!defined('APS_PLUGIN_DIR')) define( 'APS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if (!defined('APS_PLUGIN_URI')) define( 'APS_PLUGIN_URI', plugins_url('', __FILE__) );
if (!defined('APS_TEXTDOMAIN')) define( 'APS_TEXTDOMAIN', 'adl-post-slider' );
if (!defined('APS_DEFAULT_IMG')) define( 'APS_DEFAULT_IMG', APS_PLUGIN_URI .'/img/featured_image_placeholder.jpg' );
if (!defined('APS_ALERT_MSG')) define( 'APS_ALERT_MSG', __( 'Sorry! This is not your place!', APS_TEXTDOMAIN ) );

// All includes

require_once APS_PLUGIN_DIR . 'includes/aps-helper.php';
require_once APS_PLUGIN_DIR . 'includes/aps-cpt.php';
require_once APS_PLUGIN_DIR . 'includes/aps-cpt-columns.php';
require_once APS_PLUGIN_DIR . 'includes/aps-featured-post.php';
require_once APS_PLUGIN_DIR . 'includes/aps-popular-post.php';
require_once APS_PLUGIN_DIR . 'includes/aps-image-resizer.php';
require_once APS_PLUGIN_DIR . 'includes/aps-metabox.php';
require_once APS_PLUGIN_DIR . 'includes/aps-metabox-save.php';
require_once APS_PLUGIN_DIR . 'includes/aps-shortcode.php';
require_once APS_PLUGIN_DIR . 'includes/upgrade-support.php';

// warn if unsupported WordPress Version. This function should be called after including helper.php
if ( aps_check_min_wp_version(APS_MINIMUM_WP_VERSION) ) {
    add_action('admin_notices', 'aps_warn_if_unsupported_wp');
    add_action( 'admin_init', 'aps_deactivate_self' );
    function aps_deactivate_self() {
        deactivate_plugins( APS_BASENAME );
    }
}
// Registering all styles and scripts
function aps_enqueue_styles() {
    //styles
    wp_register_style('owl-carousel-min-style', APS_PLUGIN_URI. '/css/owl.carousel.css',false, APS_VERSION);
    wp_register_style('aps-frontend', APS_PLUGIN_URI. '/css/aps-frontend.css',false, APS_VERSION);
    wp_register_style('fontello-style', APS_PLUGIN_URI. '/css/fontello.css',false, APS_VERSION);
    wp_register_style('owl-theme-default-min-style', APS_PLUGIN_URI. '/css/owl.theme.default.min.css',array('owl-carousel-min-style'), APS_VERSION);

    //scripts
    wp_register_script('owl-carousel-min-script', APS_PLUGIN_URI. '/js/owl.carousel.min.js', array('jquery'), APS_VERSION, true);
    wp_register_script('aps-front-end-script', APS_PLUGIN_URI. '/js/aps-front-end.js', array('jquery'), APS_VERSION, true);
}
add_action('wp_enqueue_scripts', 'aps_enqueue_styles');

function aps_enqueue_admin_scripts_and_styles( ){
global $typenow;
    if ( 'adlpostslider' === $typenow ) {
        wp_enqueue_style('cmb2-style', APS_PLUGIN_URI. '/css/cmb2.min.css',false, APS_VERSION);
        wp_enqueue_script('admin-script', APS_PLUGIN_URI. '/js/aps-admin.js',array('jquery', 'wp-color-picker'), APS_VERSION, true);
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_media();

    }
    if ( 'adlpostslider' === $typenow || 'post' === $typenow) {
        wp_enqueue_style('admin-style', APS_PLUGIN_URI. '/css/aps-admin.css',false, APS_VERSION);
    }





}
add_action('admin_enqueue_scripts', 'aps_enqueue_admin_scripts_and_styles');



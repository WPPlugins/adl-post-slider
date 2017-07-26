<?php

/**
 * Enables shortcode for Widget
 */
add_filter('widget_text', 'do_shortcode');

/*
 * Load Text domain after plugin has been loaded
 * */
add_action('plugins_loaded', 'aps_load_textdomain');
function aps_load_textdomain(){
    load_plugin_textdomain(APS_TEXTDOMAIN, false, plugin_basename( dirname( __FILE__ ) ) . '/languages/');
}
/**
 * Pro Version link
 */

function aps_pro_version_link( $links ) {
    $links[] = '<a href="http://adlplugins.com/plugin/adl-post-slider-pro" title="Upgrade to PRO version for Priority SUPPORT and Many Amazing Features." target="_blank">Get Pro Version</a>';
    return $links;
}
add_filter( 'plugin_action_links_' . APS_BASENAME, 'aps_pro_version_link' );

/**
 * Upgrade submenu page
 */
function aps_upgrade_submenu_page() {
    add_submenu_page( 'edit.php?post_type=adlpostslider', __('Upgrade to Pro', APS_TEXTDOMAIN), __('Upgrade', APS_TEXTDOMAIN), 'manage_options', 'upgrade', 'aps_upgrade_callback' );
}
add_action('admin_menu', 'aps_upgrade_submenu_page');

function aps_upgrade_callback() {
    include('aps-upgrade.php');
}


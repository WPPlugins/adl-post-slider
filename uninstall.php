<?php

// If uninstall is not called from WordPress or access directly then, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
// exit if current user does not have permission to delete plugin
if ( ! current_user_can( 'delete_plugins' ) )
    wp_die('You do not have permission to delete plugins.');


// get all posts added by the plugin
$aps_args = array(
    'numberposts' => -1,
    'post_type'   => 'adlpostslider',
    'post_status' => 'any',
);

$aps_sliders = get_posts( $aps_args );
foreach ($aps_sliders as $slider){
    // delete all meta data related to the slider
    delete_post_meta($slider->ID, 'aps_display_header');
    delete_post_meta($slider->ID, 'aps_select_theme');
    delete_post_meta($slider->ID, 'aps_display_navigation_arrows');
    delete_post_meta($slider->ID, 'aps_title');
    delete_post_meta($slider->ID, 'aps_total_posts');
    delete_post_meta($slider->ID, 'aps_posts_type');
    delete_post_meta($slider->ID, 'aps_posts_bycategory');
    delete_post_meta($slider->ID, 'aps_posts_byID');
    delete_post_meta($slider->ID, 'aps_posts_byTag');
    delete_post_meta($slider->ID, 'aps_posts_by_year');
    delete_post_meta($slider->ID, 'aps_posts_from_month');
    delete_post_meta($slider->ID, 'aps_posts_from_month_year');
    delete_post_meta($slider->ID, 'aps_crop_image_height');

    delete_post_meta($slider->ID, 'aps_auto_play');
    delete_post_meta($slider->ID, 'aps_stop_on_hover');
    delete_post_meta($slider->ID, 'aps_slide_speed');
    delete_post_meta($slider->ID, 'aps_item_on_desktop');
    delete_post_meta($slider->ID, 'aps_item_on_tablet');
    delete_post_meta($slider->ID, 'aps_item_on_mobile');
    delete_post_meta($slider->ID, 'aps_pagination');

    delete_post_meta($slider->ID, 'aps_display_placeholder_img');
    delete_post_meta($slider->ID, 'aps_default_feat_img');
    delete_post_meta($slider->ID, 'aps_display_img');
    delete_post_meta($slider->ID, 'aps_header_title_font_size');
    delete_post_meta($slider->ID, 'aps_header_title_font_color');
    delete_post_meta($slider->ID, 'aps_nav_arrow_color');
    delete_post_meta($slider->ID, 'aps_nav_arrow_bg_color');
    delete_post_meta($slider->ID, 'aps_nav_arrow_hover_color');
    delete_post_meta($slider->ID, 'aps_nav_arrow_bg_hover_color');
    delete_post_meta($slider->ID, 'aps_border_color');
    delete_post_meta($slider->ID, 'aps_border_hover_color');
    delete_post_meta($slider->ID, 'aps_title_font_size');
    delete_post_meta($slider->ID, 'aps_title_font_color');
    delete_post_meta($slider->ID, 'aps_title_hover_font_color');

    wp_delete_post( $slider->ID, true); // delete each post
}


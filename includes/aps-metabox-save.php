<?php

/**
 * Save meta values of the adl post slider when adlpostslider type is saved
 * @param object $post_id Current post being saved
 */
function aps_meta_save( $post_id, $post ) {
    // the following line is needed because we will hook into edit_post hook, so that we can set default value of checkbox.
    if ($post->post_type != 'adlpostslider') {return;}
    // Perform checking for before saving
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['aps_meta_save_nounce']) && wp_verify_nonce( $_POST['aps_meta_save_nounce'], 'aps_meta_save' )? 'true': 'false');

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post_id )) return;


    // get all data to save
    // General Settings
    $aps_display_header = (isset($_POST['aps_display_header']))? sanitize_text_field( $_POST["aps_display_header"] ): 'no';
    $aps_display_navigation_arrows = (isset($_POST['aps_display_navigation_arrows']))? sanitize_text_field( $_POST["aps_display_navigation_arrows"] ): 'no';
    $aps_title = (isset($_POST['aps_title']))? sanitize_text_field( $_POST["aps_title"] ): '';
    $aps_total_posts = (isset($_POST['aps_total_posts']))? sanitize_text_field( $_POST["aps_total_posts"] ): 0 ;
    $aps_select_theme = (isset($_POST['aps_select_theme']))? sanitize_text_field( $_POST["aps_select_theme"] ): 0 ;
    $aps_posts_type = (isset($_POST['aps_posts_type']))? sanitize_text_field( $_POST["aps_posts_type"] ): 0 ;
    $aps_posts_bycategory = (isset($_POST['aps_posts_bycategory']))? sanitize_text_field( $_POST["aps_posts_bycategory"] ): '' ;
    $aps_posts_byID = (isset($_POST['aps_posts_byID']))? sanitize_text_field( $_POST["aps_posts_byID"] ): 0 ;
    $aps_posts_byTag = (isset($_POST['aps_posts_byTag']))? sanitize_text_field( $_POST["aps_posts_byTag"] ): '' ;
    $aps_posts_by_year = (isset($_POST['aps_posts_by_year']))? sanitize_text_field( $_POST["aps_posts_by_year"] ): 0 ;
    $aps_posts_from_month = (isset($_POST['aps_posts_from_month']))? sanitize_text_field( $_POST["aps_posts_from_month"] ): 0 ;
    $aps_posts_from_month_year = (isset($_POST['aps_posts_from_month_year']))? sanitize_text_field( $_POST["aps_posts_from_month_year"] ): 0 ;

    $aps_display_placeholder_img = (isset($_POST['aps_display_placeholder_img']))? sanitize_text_field( $_POST["aps_display_placeholder_img"] ): 'no' ;
    $aps_default_feat_img = (isset($_POST['aps_default_feat_img']))? sanitize_text_field( $_POST["aps_default_feat_img"] ): '' ;
    $aps_display_img = (isset($_POST['aps_display_img']))? sanitize_text_field( $_POST["aps_display_img"] ): 'no' ;
    $aps_image_crop = (isset($_POST['aps_image_crop']))? sanitize_text_field( $_POST["aps_image_crop"] ): 'no' ;
    $aps_crop_image_width = (isset($_POST['aps_crop_image_width']))? sanitize_text_field( $_POST["aps_crop_image_width"] ): 0 ;
    $aps_crop_image_height = (isset($_POST['aps_crop_image_height']))? sanitize_text_field( $_POST["aps_crop_image_height"] ): 0 ;
    $aps_display_post_title = (isset($_POST['aps_display_post_title']))? sanitize_text_field( $_POST["aps_display_post_title"] ): 'no' ;
    $aps_display_post_date = (isset($_POST['aps_display_post_date']))? sanitize_text_field( $_POST["aps_display_post_date"] ): 'no' ;
    $aps_display_excerpt = (isset($_POST['aps_display_excerpt']))? sanitize_text_field( $_POST["aps_display_excerpt"] ): 'no' ;
    $aps_excerpt_length = (isset($_POST['aps_excerpt_length']))? sanitize_text_field( $_POST["aps_excerpt_length"] ): 0 ;
    // Slider Settings

    $aps_auto_play = (isset($_POST['aps_auto_play']))? sanitize_text_field( $_POST["aps_auto_play"] ): 'no' ;
    $aps_stop_on_hover = (isset($_POST['aps_stop_on_hover']))? sanitize_text_field( $_POST["aps_stop_on_hover"] ): 'no' ;
    $aps_slide_speed = (isset($_POST['aps_slide_speed']))? sanitize_text_field( $_POST["aps_slide_speed"] ): 0 ;
    $aps_item_on_desktop = (isset($_POST['aps_item_on_desktop']))? sanitize_text_field( $_POST["aps_item_on_desktop"] ): 0 ;
    $aps_item_on_tablet = (isset($_POST['aps_item_on_tablet']))? sanitize_text_field( $_POST["aps_item_on_tablet"] ): 0 ;
    $aps_item_on_mobile = (isset($_POST['aps_item_on_mobile']))? sanitize_text_field( $_POST["aps_item_on_mobile"] ): 0 ;
    $aps_pagination = (isset($_POST['aps_pagination']))? sanitize_text_field( $_POST["aps_pagination"] ): 'no' ;

    $aps_header_title_font_size = (isset($_POST['aps_header_title_font_size']))? sanitize_text_field( $_POST["aps_header_title_font_size"] ): '' ;
    $aps_header_title_font_color = (isset($_POST['aps_header_title_font_color']))? sanitize_text_field( $_POST["aps_header_title_font_color"] ): '' ;
    $aps_nav_arrow_color = (isset($_POST['aps_nav_arrow_color']))? sanitize_text_field( $_POST["aps_nav_arrow_color"] ): '' ;
    $aps_nav_arrow_bg_color = (isset($_POST['aps_nav_arrow_bg_color']))? sanitize_text_field( $_POST["aps_nav_arrow_bg_color"] ): '' ;
    $aps_nav_arrow_hover_color = (isset($_POST['aps_nav_arrow_hover_color']))? sanitize_text_field( $_POST["aps_nav_arrow_hover_color"] ): '' ;
    $aps_nav_arrow_bg_hover_color = (isset($_POST['aps_nav_arrow_bg_hover_color']))? sanitize_text_field( $_POST["aps_nav_arrow_bg_hover_color"] ): '' ;
    $aps_border_color = (isset($_POST['aps_border_color']))? sanitize_text_field( $_POST["aps_border_color"] ): '' ;
    $aps_border_hover_color = (isset($_POST['aps_border_hover_color']))? sanitize_text_field( $_POST["aps_border_hover_color"] ): '' ;
    $aps_title_font_size = (isset($_POST['aps_title_font_size']))? sanitize_text_field( $_POST["aps_title_font_size"] ): '' ;
    $aps_title_font_color = (isset($_POST['aps_title_font_color']))? sanitize_text_field( $_POST["aps_title_font_color"] ): '' ;
    $aps_title_hover_font_color = (isset($_POST['aps_title_hover_font_color']))? sanitize_text_field( $_POST["aps_title_hover_font_color"] ): '' ;






    // Save Meta data to the db
    //General Settings
    update_post_meta($post_id, "aps_display_header", $aps_display_header);
    //update_post_meta($post_id, "aps_display_navigation_arrows", $aps_display_navigation_arrows);
    update_post_meta($post_id, "aps_title", $aps_title);
    update_post_meta($post_id, "aps_total_posts", $aps_total_posts);

    update_post_meta($post_id, "aps_select_theme", $aps_select_theme);
    update_post_meta($post_id, "aps_posts_type", $aps_posts_type);
    update_post_meta($post_id, "aps_posts_bycategory", $aps_posts_bycategory);
    update_post_meta($post_id, "aps_posts_byID", $aps_posts_byID);
    update_post_meta($post_id, "aps_posts_byTag", $aps_posts_byTag);
    update_post_meta($post_id, "aps_posts_by_year", $aps_posts_by_year);
    update_post_meta($post_id, "aps_posts_from_month", $aps_posts_from_month);
    update_post_meta($post_id, "aps_posts_from_month_year", $aps_posts_from_month_year);


    update_post_meta($post_id, "aps_image_crop", $aps_image_crop);
    update_post_meta($post_id, "aps_crop_image_width", $aps_crop_image_width);
    update_post_meta($post_id, "aps_crop_image_height", $aps_crop_image_height);
    update_post_meta($post_id, "aps_display_post_title", $aps_display_post_title);
    update_post_meta($post_id, "aps_display_post_date", $aps_display_post_date);
    update_post_meta($post_id, "aps_display_excerpt", $aps_display_excerpt);
    update_post_meta($post_id, "aps_excerpt_length", $aps_excerpt_length);

    // Slider Settings
    update_post_meta($post_id, "aps_auto_play", $aps_auto_play);
    update_post_meta($post_id, "aps_stop_on_hover", $aps_stop_on_hover);
    update_post_meta($post_id, "aps_slide_speed", $aps_slide_speed);
    update_post_meta($post_id, "aps_item_on_desktop", $aps_item_on_desktop);
    update_post_meta($post_id, "aps_item_on_tablet", $aps_item_on_tablet);
    update_post_meta($post_id, "aps_item_on_mobile", $aps_item_on_mobile);
    update_post_meta($post_id, "aps_pagination", $aps_pagination);

    update_post_meta($post_id, "aps_display_placeholder_img", $aps_display_placeholder_img);
    update_post_meta($post_id, "aps_default_feat_img", $aps_default_feat_img);
    update_post_meta($post_id, "aps_display_img", $aps_display_img);
    update_post_meta($post_id, "aps_header_title_font_size", $aps_header_title_font_size);
    update_post_meta($post_id, "aps_header_title_font_color", $aps_header_title_font_color);
    update_post_meta($post_id, "aps_nav_arrow_color", $aps_nav_arrow_color);
    update_post_meta($post_id, "aps_nav_arrow_bg_color", $aps_nav_arrow_bg_color);
    update_post_meta($post_id, "aps_nav_arrow_hover_color", $aps_nav_arrow_hover_color);
    update_post_meta($post_id, "aps_nav_arrow_bg_hover_color", $aps_nav_arrow_bg_hover_color);
    update_post_meta($post_id, "aps_border_color", $aps_border_color);
    update_post_meta($post_id, "aps_border_hover_color", $aps_border_hover_color);
    update_post_meta($post_id, "aps_title_font_size", $aps_title_font_size);
    update_post_meta($post_id, "aps_title_font_color", $aps_title_font_color);
    update_post_meta($post_id, "aps_title_hover_font_color", $aps_title_hover_font_color);




}

// save only when adl post slider post is saved
//add_action( 'save_post_adlpostslider', 'aps_meta_save');
// using edit_post hook so that update function does not run when post is created. so that we can set default value of checkbox easily.
add_action( 'edit_post', 'aps_meta_save', 10, 2);
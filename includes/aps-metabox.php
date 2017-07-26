<?php

/**
 * Adds a box to the ADL Post Slider post type edit screens.
 */
function aps_add_meta_box() {
    add_meta_box(
        'aps_metabox',
        __( 'Slider Settings & Shortcode Generator', APS_TEXTDOMAIN ),
        'aps_metabox_cb',
        'adlpostslider',
        'normal'
    );
}
add_action( 'add_meta_boxes', 'aps_add_meta_box' );


/**
 * Display metabox content
 * @param Object $post | The current post object.
 */
function aps_metabox_cb( $post ) {


    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'aps_meta_save', 'aps_meta_save_nounce' );

    // temp vars
    $aps_display_header = get_post_meta( $post->ID, 'aps_display_header', true );
    $aps_select_theme = get_post_meta( $post->ID, 'aps_select_theme', true );
    $aps_display_navigation_arrows = get_post_meta( $post->ID, 'aps_display_navigation_arrows', true );
    $aps_title = get_post_meta( $post->ID, 'aps_title', true );
    $aps_total_posts = get_post_meta( $post->ID, 'aps_total_posts', true );
    //query type
    $aps_posts_type = get_post_meta( $post->ID, 'aps_posts_type', true );
    $aps_posts_bycategory = get_post_meta( $post->ID, 'aps_posts_bycategory', true );
    $aps_posts_byID = get_post_meta( $post->ID, 'aps_posts_byID', true );
    $aps_posts_byTag = get_post_meta( $post->ID, 'aps_posts_byTag', true );
    $aps_posts_by_year = get_post_meta( $post->ID, 'aps_posts_by_year', true );
    $aps_posts_from_month = get_post_meta( $post->ID, 'aps_posts_from_month', true );
    $aps_posts_from_month_year = get_post_meta( $post->ID, 'aps_posts_from_month_year', true );


    $aps_display_placeholder_img = get_post_meta( $post->ID, 'aps_display_placeholder_img', true );
    $aps_default_feat_img = get_post_meta( $post->ID, 'aps_default_feat_img', true );
    $aps_display_img = get_post_meta( $post->ID, 'aps_display_img', true );


    $aps_image_crop = get_post_meta( $post->ID, 'aps_image_crop', true );
    $aps_crop_image_width = get_post_meta( $post->ID, 'aps_crop_image_width', true );
    $aps_crop_image_height = get_post_meta( $post->ID, 'aps_crop_image_height', true );
    $aps_display_post_title = get_post_meta( $post->ID, 'aps_display_post_title', true );
    $aps_display_post_date = get_post_meta( $post->ID, 'aps_display_post_date', true );

    $aps_display_excerpt = get_post_meta( $post->ID, 'aps_display_excerpt', true );
    $aps_excerpt_length = get_post_meta( $post->ID, 'aps_excerpt_length', true );

    $aps_auto_play = get_post_meta( $post->ID, 'aps_auto_play', true );
    $aps_stop_on_hover = get_post_meta( $post->ID, 'aps_stop_on_hover', true );
    $aps_slide_speed = get_post_meta( $post->ID, 'aps_slide_speed', true );
    $aps_item_on_desktop = get_post_meta( $post->ID, 'aps_item_on_desktop', true );
    $aps_item_on_tablet = get_post_meta( $post->ID, 'aps_item_on_tablet', true );
    $aps_item_on_mobile = get_post_meta( $post->ID, 'aps_item_on_mobile', true );
    $aps_pagination = get_post_meta( $post->ID, 'aps_pagination', true );

    $aps_header_title_font_size = get_post_meta( $post->ID, 'aps_header_title_font_size', true );
    $aps_header_title_font_color = get_post_meta( $post->ID, 'aps_header_title_font_color', true );
    $aps_nav_arrow_color = get_post_meta( $post->ID, 'aps_nav_arrow_color', true );
    $aps_nav_arrow_bg_color = get_post_meta( $post->ID, 'aps_nav_arrow_bg_color', true );
    $aps_nav_arrow_hover_color = get_post_meta( $post->ID, 'aps_nav_arrow_hover_color', true );
    $aps_nav_arrow_bg_hover_color = get_post_meta( $post->ID, 'aps_nav_arrow_bg_hover_color', true );

    $aps_border_color = get_post_meta( $post->ID, 'aps_border_color', true );
    $aps_border_hover_color = get_post_meta( $post->ID, 'aps_border_hover_color', true );

    $aps_title_font_size = get_post_meta( $post->ID, 'aps_title_font_size', true );
    $aps_title_font_color = get_post_meta( $post->ID, 'aps_title_font_color', true );
    $aps_title_hover_font_color = get_post_meta( $post->ID, 'aps_title_hover_font_color', true );


    // sanitaized vars

    $aps_display_header = (!empty($aps_display_header)) ? esc_attr($aps_display_header) : '';
    $aps_select_theme = (!empty($aps_select_theme)) ? esc_attr($aps_select_theme) : '';
    $aps_display_navigation_arrows = (!empty($aps_display_navigation_arrows)) ? esc_attr($aps_display_navigation_arrows) : '';
    $aps_title = (!empty($aps_title)) ? esc_attr($aps_title) : '';
    $aps_total_posts = (!empty($aps_total_posts)) ? esc_attr($aps_total_posts) : '' ;
    //query type
    $aps_posts_type = (!empty($aps_posts_type)) ? esc_attr($aps_posts_type) : '';
    $aps_posts_bycategory = (!empty($aps_posts_bycategory)) ? esc_attr($aps_posts_bycategory) : '';
    $aps_posts_byID = (!empty($aps_posts_byID)) ? esc_attr($aps_posts_byID) : '';
    $aps_posts_byTag = (!empty($aps_posts_byTag)) ? esc_attr($aps_posts_byTag) : '';
    $aps_posts_by_year = (!empty($aps_posts_by_year)) ? esc_attr($aps_posts_by_year) : '';
    $aps_posts_from_month = (!empty($aps_posts_from_month)) ? esc_attr($aps_posts_from_month) : '';
    $aps_posts_from_month_year = (!empty($aps_posts_from_month_year)) ? esc_attr($aps_posts_from_month_year) : '';


    $aps_display_placeholder_img = (!empty($aps_display_placeholder_img)) ? esc_attr($aps_display_placeholder_img) : '';
    $aps_default_feat_img = (!empty($aps_default_feat_img)) ? esc_attr($aps_default_feat_img) : '';
    $aps_display_img = (!empty($aps_display_img)) ? esc_attr($aps_display_img) : '';
    $aps_image_crop = (!empty($aps_image_crop)) ? esc_attr($aps_image_crop) : '';
    $aps_crop_image_width = (!empty($aps_crop_image_width)) ? esc_attr($aps_crop_image_width) : '';
    $aps_crop_image_height = (!empty($aps_crop_image_height)) ? esc_attr($aps_crop_image_height) : '';
    $aps_auto_play = (!empty($aps_auto_play)) ? esc_attr($aps_auto_play) : '';
    $aps_stop_on_hover = (!empty($aps_stop_on_hover)) ? esc_attr($aps_stop_on_hover) : '';
    $aps_slide_speed = (!empty($aps_slide_speed)) ? esc_attr($aps_slide_speed) : 5000;
    $aps_item_on_desktop = (!empty($aps_item_on_desktop)) ? absint(esc_attr($aps_item_on_desktop)) : 4;
    $aps_item_on_tablet = (!empty($aps_item_on_tablet)) ? absint(esc_attr($aps_item_on_tablet)) : 3;
    $aps_item_on_mobile = (!empty($aps_item_on_mobile)) ? absint(esc_attr($aps_item_on_mobile)) : 2;
    $aps_pagination = (!empty($aps_pagination)) ? esc_attr($aps_pagination) : '';


    $aps_header_title_font_size = (!empty($aps_header_title_font_size)) ? esc_attr($aps_header_title_font_size) : '';
    $aps_header_title_font_color = (!empty($aps_header_title_font_color)) ? esc_attr($aps_header_title_font_color) : '';
    $aps_nav_arrow_color = (!empty($aps_nav_arrow_color)) ? esc_attr($aps_nav_arrow_color) : '';
    $aps_nav_arrow_bg_color = (!empty($aps_nav_arrow_bg_color)) ? esc_attr($aps_nav_arrow_bg_color) : '';
    $aps_nav_arrow_hover_color = (!empty($aps_nav_arrow_hover_color)) ? esc_attr($aps_nav_arrow_hover_color) : '';
    $aps_nav_arrow_bg_hover_color = (!empty($aps_nav_arrow_bg_hover_color)) ? esc_attr($aps_nav_arrow_bg_hover_color) : '';
    $aps_border_color = (!empty($aps_border_color)) ? esc_attr($aps_border_color) : '';
    $aps_border_hover_color = (!empty($aps_border_hover_color)) ? esc_attr($aps_border_hover_color) : '';
    $aps_title_font_size = (!empty($aps_title_font_size)) ? esc_attr($aps_title_font_size) : '';
    $aps_title_font_color = (!empty($aps_title_font_color)) ? esc_attr($aps_title_font_color) : '';
    $aps_title_hover_font_color = (!empty($aps_title_hover_font_color)) ? esc_attr($aps_title_hover_font_color) : '';






    ?>
    <div id="tabs-container">

        <ul class="tabs-menu">
            <li class="current"><a href="#tab-1"><?php _e('General Settings', APS_TEXTDOMAIN); ?></a></li>
            <li><a href="#tab-2"><?php _e('Slider Settings', APS_TEXTDOMAIN); ?></a></li>
            <li><a href="#tab-3"><?php _e('Style Settings', APS_TEXTDOMAIN); ?></a></li>
        </ul>

        <div class="tab">

            <div id="tab-1" class="tab-content">
                <div class="cmb2-wrap form-table">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">

                        <!--Display Header ? -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_header"><?php _e('Display Header', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_header" id="aps_display_header"  value="yes" <?php if ($aps_display_header != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>

                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Display slider header or not', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-select">
                            <div class="cmb-th">
                                <label for="aps_select_theme"><?php _e('Select a Theme', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><input type="radio" class="cmb2-option" name="aps_select_theme" id="aps_themea" value="themea" <?php if($aps_select_theme == "themea") {echo "checked"; } else { echo "checked"; } ?>> <label for="aps_themea"><?php _e('Theme A', APS_TEXTDOMAIN); ?></label></li>
                                    <li><input type="radio" class="cmb2-option" name="aps_select_theme" id="aps_themeb" value="themeb" <?php checked($aps_select_theme, 'themeb'); ?>> <label for="aps_themeb"><?php _e('Theme B', APS_TEXTDOMAIN); ?></label></li>
                                    <!-- Upgrade to PRO Notice -->
                                    <p style="font-size: 14px; margin: 13px 0 5px 0; font-style: italic;"> The Following Themes are available in <a href="http://adlplugins.com/plugin/adl-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a>:</p>

                                    <li><input disabled type="radio" class="cmb2-option" name="aps_select_theme" id="aps_themec" value="themec" <?php checked($aps_select_theme, 'themec'); ?>> <label class="aps-disabled" for="aps_themec"><?php _e('Theme C', APS_TEXTDOMAIN); ?></label></li>
                                    <li><input disabled type="radio" class="cmb2-option" name="aps_select_theme" id="aps_themed" value="themed" <?php checked($aps_select_theme, 'themed'); ?>> <label class="aps-disabled" for="aps_themed"><?php _e('Theme D', APS_TEXTDOMAIN); ?></label></li>
                                </ul>

                            </div>
                        </div>

                        <!--Title Above Slider-->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_title"><?php _e('Title Above Slider', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-medium" name="aps_title" id="aps_title" value="<?php if(empty($aps_title)) { _e('Latest Posts', APS_TEXTDOMAIN); } else { echo $aps_title; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Slider title', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <!--Total posts to display -->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_total_posts"><?php _e('Total Posts', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="aps_total_posts" id="aps_total_posts" value="<?php if(empty($aps_total_posts)) { echo 12; } else { echo $aps_total_posts; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('How many posts to display in the slider', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-multicheck">
                            <div class="cmb-th">
                                <label for="aps_posts_type"><?php _e('Posts Query Type', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><input type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type1" value="latest" <?php if($aps_posts_type == "latest") {echo "checked"; } else { echo "checked"; } ?>> <label for="aps_posts_type1"><?php _e('Latest Posts', APS_TEXTDOMAIN); ?></label></li>

                                    <li><input type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type2" value="older" <?php if($aps_posts_type == "older") {echo "checked"; } else { echo ""; } ?>> <label for="aps_posts_type2"><?php _e('Older Posts', APS_TEXTDOMAIN); ?></label></li>

                                    <li><input  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type3" value="featured" <?php if($aps_posts_type == "featured") {echo "checked"; } else { echo ""; } ?>> <label for="aps_posts_type3"><?php _e('Featured Posts', APS_TEXTDOMAIN); ?></label></li>

                                    <li><input  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type9" value="popular_post" <?php if($aps_posts_type == "popular_post") {echo "checked"; } else { echo ""; } ?>> <label for="aps_posts_type9"><?php _e('Popular Posts', APS_TEXTDOMAIN); ?></label></li>

                                    <!-- Upgrade to PRO Notice -->

                                    <p style="font-size: 14px; margin: 13px 0 5px 0; font-style: italic;"> The Following Options are available in <a href="http://adlplugins.com/plugin/adl-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a>:</p>

                                    <li><input disabled  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type4" value="category" <?php if($aps_posts_type == "category") {echo "checked"; } else { echo ""; } ?>> <label class="aps-disabled" for="aps_posts_type4"><?php _e('Posts by Category', APS_TEXTDOMAIN); ?></label></li>
                                    <input disabled type="text" class="cmb2-text-medium" name="aps_posts_bycategory" id="aps_posts_bycategory" value="<?php if(!empty($aps_posts_bycategory)) { echo $aps_posts_bycategory; } else { echo ''; } ?>" placeholder="e.g. wordpress, php, news">

                                    <li class="postsbyidw"><input disabled  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type5" value="postsbyid" <?php if($aps_posts_type == "postsbyid") {echo "checked"; } else { echo ""; } ?>> <label class="aps-disabled" for="aps_posts_type5"><?php _e('Posts by ID', APS_TEXTDOMAIN); ?></label></li>
                                    <input disabled type="text" class="cmb2-text-medium" name="aps_posts_byID" id="aps_posts_byID" value="<?php if(!empty($aps_posts_byID)) { echo $aps_posts_byID; } else { echo ''; } ?>" placeholder="e.g. 1, 5, 10">



                                    <li><input disabled  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type6" value="postsbytag" <?php if($aps_posts_type == "postsbytag") {echo "checked"; } else { echo ""; } ?>> <label class="aps-disabled" for="aps_posts_type6"><?php _e('Posts by Tags', APS_TEXTDOMAIN); ?></label></li>
                                    <input disabled type="text" class="cmb2-text-medium" name="aps_posts_byTag" id="aps_posts_byTag" value="<?php if(!empty($aps_posts_byTag)) { echo $aps_posts_byTag; } else { echo ''; } ?>" placeholder="e.g. food, tree, water">

                                    <li><input disabled  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type7" value="postsbyyear" <?php if($aps_posts_type == "postsbyyear") {echo "checked"; } else { echo ""; } ?>> <label class="aps-disabled" for="aps_posts_type7"><?php _e('Posts by Year', APS_TEXTDOMAIN); ?></label></li>
                                    <input disabled type="text" class="cmb2-text-medium" name="aps_posts_by_year" id="aps_posts_by_year" value="<?php if(!empty($aps_posts_by_year)) { echo $aps_posts_by_year; } else { echo ''; } ?>" placeholder="e.g. 2016">

                                    <li><input disabled  type="radio" class="cmb2-option" name="aps_posts_type" id="aps_posts_type8" value="postsbymonth" <?php if($aps_posts_type == "postsbymonth") {echo "checked"; } else { echo ""; } ?>> <label class="aps-disabled" for="aps_posts_type8"><?php _e('Posts by Month', APS_TEXTDOMAIN); ?></label></li>
                                    <input disabled type="text" class="cmb2-text-small lfm" name="aps_posts_from_month" id="aps_posts_from_month" value="<?php if(!empty($aps_posts_from_month)) { echo $aps_posts_from_month; } else { echo ''; } ?>" placeholder="e.g. 0-11">
                                    <input disabled type="text" class="cmb2-text-small lfm" name="aps_posts_from_month_year" id="aps_posts_from_month_year" value="<?php if(!empty($aps_posts_from_month_year)) { echo $aps_posts_from_month_year; } else { echo ''; } ?>"placeholder="2016">
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Select how you like to display post', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>


                        <!--Show featured image -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_img"><?php _e('Show featured image', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_img" id="aps_display_img"  value="yes" <?php if ($aps_display_img != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Display featured image of the post. If featured image is not found then the first image from the post content will be used.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>

                        <!--Show featured image placeholder-->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_placeholder_img"><?php _e('Use Placeholder image', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_placeholder_img" id="aps_display_placeholder_img"  value="yes" <?php if ($aps_display_placeholder_img != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Display a featured image placeholder if a post has no featured image ?', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>

                        <!--Upload featured image placeholder-->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_default_feat_img"><?php _e('Upload Placeholder image', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li>
                                        <input type="text" name="aps_default_feat_img" id="aps_default_feat_img" class="regular-text" value="<?php echo (!empty($aps_default_feat_img))? $aps_default_feat_img : APS_DEFAULT_IMG; ?>">
                                        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Upload a featured image placeholder. Otherwise, plugin\'s default image will be used', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>





                        <!--Crop image ? -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_image_crop"><?php _e('Auto Crop and Resize Image', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_image_crop" id="aps_image_crop"  value="yes" <?php if ($aps_image_crop != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Enable cropping and resizing image automatically. If you use this feature, then you can not use default placeholder that comes with this plugin. You need to upload your own default placeholder image if you want to use.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>

                        <!--Image Widht-->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_crop_image_width"><?php _e('Image Width', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="aps_crop_image_width" id="aps_crop_image_width" placeholder="eg. 300" value="<?php echo (!empty($aps_crop_image_width)) ? $aps_crop_image_width : 300;  ?>">
                                <p class="cmb2-metabox-description"><?php _e('Image width value in pixel.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>

                        <!--Image Height-->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_crop_image_height"><?php _e('Image Height', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="aps_crop_image_height" id="aps_crop_image_height" placeholder="eg. 200" value="<?php echo (!empty($aps_crop_image_height)) ? $aps_crop_image_height : 250;  ?>">
                                <p class="cmb2-metabox-description"><?php _e('Image height value in pixel.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <!--Display Post Title ? -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_post_title"><?php _e('Display Post Title', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_post_title" id="aps_display_post_title"  value="yes" <?php if ($aps_display_post_title != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Enable it to show the Post Title.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>



                        <!--Display Date ? -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_post_date"><?php _e('Display Post Date', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_post_date" id="aps_display_post_date"  value="yes" <?php if ($aps_display_post_date != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Enable it to show the Post Date under the title.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>



                        <!--Show Excerpt ? -->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_excerpt"><?php _e('Display Excerpt', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input type="checkbox" name="aps_display_excerpt" id="aps_display_excerpt"  value="yes" <?php if ($aps_display_excerpt != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Enable it to show the Post Excerpt.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>


                        <!--Excerpt Length-->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_excerpt_length"><?php _e('Excerpt Length', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input type="text" class="cmb2-text-small" name="aps_excerpt_length" id="aps_excerpt_length" placeholder="eg. 50" value="<?php echo (!empty($aps_excerpt_length)) ? $aps_excerpt_length : 50;  ?>">
                                <p class="cmb2-metabox-description"><?php _e('Insert the number of words you would like to show as Excerpt.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>







                    </div>
                </div>
            </div>


            <div id="tab-2" class="tab-content">
                <!-- Upgrade to PRO Notice -->

                <div class="cmb-row cmb-type-text-medium">
                    <div class="aps-upgrade-notice"> The Following Options are available in <a href="http://adlplugins.com/plugin/aps-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a> only. Upgrade to <a href="http://adlplugins.com/plugin/aps-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a>  for more features and for supporting us. Thanks.</div>
                </div>

                <div class="cmb2-wrap form-table aps-disabled">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">

                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_auto_play"><?php _e('Auto Play', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input disabled type="checkbox" name="aps_auto_play" id="aps_auto_play"  value="yes" <?php if ($aps_auto_play != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Play slider\'s slide automatically ? ', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <!--Stop on Hover-->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_stop_on_hover"><?php _e('Stop on Hover', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input disabled type="checkbox" name="aps_stop_on_hover" id="aps_stop_on_hover"  value="yes" <?php if ($aps_stop_on_hover != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Stop slider\'s slide autoplay on mouse hover ?', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <!--Display Navigation Arrows-->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_display_header"><?php _e('Display Navigation Arrows', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input disabled type="checkbox" name="aps_display_navigation_arrows" id="aps_display_navigation_arrows"  value="yes" <?php if ($aps_display_navigation_arrows != 'no') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Display slider Navigation Arrow or not', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>

                        <!--Show Dots Pagination-->
                        <div class="cmb-row cmb-type-radio">
                            <div class="cmb-th">
                                <label for="aps_pagination"><?php _e('Show Dots Pagination', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <ul class="cmb2-radio-list cmb2-list">
                                    <li><label class="checkbox">
                                            <input disabled type="checkbox" name="aps_pagination" id="aps_pagination"  value="yes" <?php if ($aps_pagination == 'yes') { echo 'checked'; }?> class="checkbox__input" />
                                            <div class="checkbox__switch"></div>
                                        </label>
                                    </li>
                                </ul>
                                <p class="cmb2-metabox-description"><?php _e('Show dots pagination below the slider?', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_slide_speed"><?php _e('Slide Speed', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_slide_speed" id="aps_slide_speed" placeholder="1000 =1 Sec" value="<?php if(!empty($aps_slide_speed)) { echo $aps_slide_speed; } else { echo 5000; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('1000 means 1 second.', APS_TEXTDOMAIN); ?></p>

                            </div>
                        </div>

                        <!--Posts on Desktop-->
                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_item_on_desktop"><?php _e('Show Posts on Desktop', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_item_on_desktop" id="aps_item_on_desktop" value="<?php if(!empty($aps_item_on_desktop)) { echo $aps_item_on_desktop; } else { echo 4; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Maximum amount of posts to display at a time on Desktop or Large Screen Devices.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <!--Posts on Tablet-->

                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_item_on_tablet"><?php _e('Show Posts on Tablet', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_item_on_tablet" id="aps_item_on_tablet" value="<?php if(!empty($aps_item_on_tablet)) { echo $aps_item_on_tablet; } else { echo 2; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Maximum amount of posts to display at a time on Tablet Screen.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>

                        <!--Posts on Mobile-->

                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_item_on_mobile"><?php _e('Show Posts on Mobile', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_item_on_mobile" id="aps_item_on_mobile" value="<?php if(!empty($aps_item_on_mobile)) { echo $aps_item_on_mobile; } else { echo 2; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Maximum amount of posts to display at a time on Mobile Screen.', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>




            <div id="tab-3" class="tab-content">
                <!-- Upgrade to PRO Notice -->

                <div class="cmb-row cmb-type-text-medium">
                    <div class="aps-upgrade-notice"> The Following Options are available in <a href="http://adlplugins.com/plugin/aps-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a> only. Upgrade to <a href="http://adlplugins.com/plugin/aps-post-slider-pro" target="_blank" title="Upgrade to pro">Pro Version</a>  for more features and for supporting us.Thanks.</div>
                </div>
                <div class="cmb2-wrap form-table aps-disabled">
                    <div id="cmb2-metabox" class="cmb2-metabox cmb-field-list">

                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_header_title_font_size"><?php _e('Slider Title Font Size', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_header_title_font_size" id="aps_header_title_font_size" value="<?php if(!empty($aps_header_title_font_size)) { echo $aps_header_title_font_size; } else { echo "20px"; } ?>" placeholder="e.g. 20px">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_header_title_font_color"><?php _e('Slider Title Font Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_header_title_font_color" id="aps_header_title_font_color" value="<?php if(!empty($aps_header_title_font_color)) { echo $aps_header_title_font_color; } else { echo "#303030"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_nav_arrow_color"><?php _e('Navigational Arrow Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_nav_arrow_color" id="aps_nav_arrow_color" value="<?php if(!empty($aps_nav_arrow_color)) { echo $aps_nav_arrow_color; } else { echo "#FFFFFF"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_nav_arrow_bg_color"><?php _e('Navigational Arrow Background Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_nav_arrow_bg_color" id="aps_nav_arrow_bg_color" value="<?php echo (!empty($aps_nav_arrow_bg_color)) ? $aps_nav_arrow_bg_color : "#686868"; ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_nav_arrow_hover_color"><?php _e('Navigational Arrow Hover Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_nav_arrow_hover_color" id="aps_nav_arrow_hover_color" value="<?php if(!empty($aps_nav_arrow_hover_color)) { echo $aps_nav_arrow_hover_color; } else { echo "#FFFFFF"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_nav_arrow_bg_hover_color"><?php _e('Navigational Arrow Background Hover Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_nav_arrow_bg_hover_color" id="aps_nav_arrow_bg_hover_color" value="<?php if(!empty($aps_nav_arrow_bg_hover_color)) { echo $aps_nav_arrow_bg_hover_color; } else { echo "#474747"; } ?>">
                            </div>
                        </div>

                        <!--Border color for theme B and D-->
                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_border_color"><?php _e('Slider Border Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_border_color" id="aps_border_color" value="<?php if(!empty($aps_border_color)) { echo $aps_border_color; } else { echo "#f7f7f7"; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Border Color if you use "THEME B" or "THEME D" ', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>

                        <!--Border Hover color for theme B and D-->
                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_border_hover_color"><?php _e('Slider Border Hover Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_border_hover_color" id="aps_border_hover_color" value="<?php if(!empty($aps_border_hover_color)) { echo $aps_border_hover_color; } else { echo "#ececec"; } ?>">
                                <p class="cmb2-metabox-description"><?php _e('Border Hover Color if you use "THEME B" or "THEME D" ', APS_TEXTDOMAIN); ?></p>
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-text-medium">
                            <div class="cmb-th">
                                <label for="aps_title_font_size"><?php _e('Post Title Font Size', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_title_font_size"
                                       placeholder="eg. 16px"
                                       id="aps_title_font_size"
                                       value="<?php if(!empty($aps_title_font_size)) { echo $aps_title_font_size; } else { echo "16px"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_title_font_color"><?php _e('Post Title Font Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_title_font_color" id="aps_title_font_color" value="<?php if(!empty($aps_title_font_color)) { echo $aps_title_font_color; } else { echo "#303030"; } ?>">
                            </div>
                        </div>


                        <div class="cmb-row cmb-type-colorpicker">
                            <div class="cmb-th">
                                <label for="aps_title_hover_font_color"><?php _e('Post Title Hover Font Color', APS_TEXTDOMAIN); ?></label>
                            </div>
                            <div class="cmb-td">
                                <input disabled type="text" class="cmb2-text-small" name="aps_title_hover_font_color" id="aps_title_hover_font_color" value="<?php if(!empty($aps_title_hover_font_color)) { echo $aps_title_hover_font_color; } else { echo "#000"; } ?>">
                            </div>
                        </div>





                    </div>
                </div>
            </div>


        </div> <!-- end tab -->
    </div> <!-- end tabs-container -->

    <div class="aps_shortcode">
        <h2><?php _e('Shortcode', APS_TEXTDOMAIN); ?> </h2>
        <p><?php _e('Use following shortcode to display the Post Slider anywhere:', APS_TEXTDOMAIN); ?></p>
        <textarea cols="25" rows="1" onClick="this.select();" >[adl-post-slider <?php echo 'id="'.$post->ID.'"';?>]</textarea> <br />

        <p><?php _e('If you need to put the shortcode inside php code/template file, use this:', APS_TEXTDOMAIN); ?></p>
        <textarea cols="54" rows="1" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[adl-post-slider id='; echo "'".$post->ID."']"; echo '"); ?>'; ?></textarea> </p>
    </div>
<?php }

<?php
/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function aps_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( ' ...read more → ', APS_TEXTDOMAIN )
    );
}
add_filter( 'excerpt_more', 'aps_excerpt_more' );


/**
 * Prints the limited excerpts of the post
 * @param int $limit | Limit excerpt by a number of word. Default is 50.
 *
 * @return array|mixed|string
 */
function aps_get_limited_excerpts($limit = 50) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $moreText = apply_filters('excerpt_more', '...');
        $excerpt = implode(" ",$excerpt).$moreText;
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return '<p>'.$excerpt.'</p>';
}

/**
 * Prints the shortcode for the posts slider
 * @param $atts
 * @param null $content
 *
 * @return null|string
 */
function aps_shortcode_output($atts, $content = null) {
    ob_start();
    // get shortcode atts
    $atts = shortcode_atts(
        array(
            'id' => "",
        ), $atts);
    // enqueue styles and scripts for this shortcode
    wp_enqueue_style('aps-frontend');
    wp_enqueue_style('fontello-style');
    wp_enqueue_style('owl-carousel-min-style');
    wp_enqueue_style('owl-theme-default-min-style');
    wp_enqueue_script('owl-carousel-min-script');
    wp_enqueue_script('aps-front-end-script');

    $shorcode_id = $atts['id'];
    $random_aps_wrapper_id = rand();
    $random_button_id = rand();
    $nextButton = "aps-next-{$random_button_id}";
    $prevButton = "aps-prev-{$random_button_id}";


// temp vars
    $aps_display_header = get_post_meta( $shorcode_id, 'aps_display_header', true );
    $aps_select_theme = get_post_meta( $shorcode_id, 'aps_select_theme', true );
    $aps_display_navigation_arrows = get_post_meta( $shorcode_id, 'aps_display_navigation_arrows', true );
    $aps_title = get_post_meta( $shorcode_id, 'aps_title', true );
    $aps_total_posts = get_post_meta( $shorcode_id, 'aps_total_posts', true );
    //query type
    $aps_posts_type = get_post_meta( $shorcode_id, 'aps_posts_type', true );
    $aps_posts_bycategory = get_post_meta( $shorcode_id, 'aps_posts_bycategory', true );
    $aps_posts_byID = get_post_meta( $shorcode_id, 'aps_posts_byID', true );
    $aps_posts_byTag = get_post_meta( $shorcode_id, 'aps_posts_byTag', true );
    $aps_posts_by_year = get_post_meta( $shorcode_id, 'aps_posts_by_year', true );
    $aps_posts_from_month = get_post_meta( $shorcode_id, 'aps_posts_from_month', true );
    $aps_posts_from_month_year = get_post_meta( $shorcode_id, 'aps_posts_from_month_year', true );


    $aps_display_placeholder_img = get_post_meta( $shorcode_id, 'aps_display_placeholder_img', true );
    $aps_default_feat_img = get_post_meta( $shorcode_id, 'aps_default_feat_img', true );
    $aps_display_img = get_post_meta( $shorcode_id, 'aps_display_img', true );


    $aps_image_crop = get_post_meta( $shorcode_id, 'aps_image_crop', true );
    $aps_crop_image_width = get_post_meta( $shorcode_id, 'aps_crop_image_width', true );
    $aps_crop_image_height = get_post_meta( $shorcode_id, 'aps_crop_image_height', true );
    $aps_display_post_title = get_post_meta( $shorcode_id, 'aps_display_post_title', true );
    $aps_display_post_date = get_post_meta( $shorcode_id, 'aps_display_post_date', true );
    $aps_display_excerpt = get_post_meta( $shorcode_id, 'aps_display_excerpt', true );
    $aps_excerpt_length = get_post_meta( $shorcode_id, 'aps_excerpt_length', true );

    $aps_auto_play = get_post_meta( $shorcode_id, 'aps_auto_play', true );
    $aps_auto_play = $aps_auto_play === 'no' ? false : $aps_auto_play;
    $aps_stop_on_hover = get_post_meta( $shorcode_id, 'aps_stop_on_hover', true );
    $aps_slide_speed = get_post_meta( $shorcode_id, 'aps_slide_speed', true );
    $aps_item_on_desktop = get_post_meta( $shorcode_id, 'aps_item_on_desktop', true );
    $aps_item_on_tablet = get_post_meta( $shorcode_id, 'aps_item_on_tablet', true );
    $aps_item_on_mobile = get_post_meta( $shorcode_id, 'aps_item_on_mobile', true );
    $aps_pagination = get_post_meta( $shorcode_id, 'aps_pagination', true );

    $aps_header_title_font_size = get_post_meta( $shorcode_id, 'aps_header_title_font_size', true );
    $aps_header_title_font_color = get_post_meta( $shorcode_id, 'aps_header_title_font_color', true );
    $aps_nav_arrow_color = get_post_meta( $shorcode_id, 'aps_nav_arrow_color', true );
    $aps_nav_arrow_bg_color = get_post_meta( $shorcode_id, 'aps_nav_arrow_bg_color', true );
    $aps_nav_arrow_hover_color = get_post_meta( $shorcode_id, 'aps_nav_arrow_hover_color', true );
    $aps_nav_arrow_bg_hover_color = get_post_meta( $shorcode_id, 'aps_nav_arrow_bg_hover_color', true );

    $aps_border_color = get_post_meta( $shorcode_id, 'aps_border_color', true );
    $aps_border_hover_color = get_post_meta( $shorcode_id, 'aps_border_hover_color', true );

    $aps_title_font_size = get_post_meta( $shorcode_id, 'aps_title_font_size', true );
    $aps_title_font_color = get_post_meta( $shorcode_id, 'aps_title_font_color', true );
    $aps_title_hover_font_color = get_post_meta( $shorcode_id, 'aps_title_hover_font_color', true );


    // sanitaized vars
    $aps_display_header = (!empty($aps_display_header)) ? esc_attr($aps_display_header) : '';
    $aps_select_theme = (!empty($aps_select_theme)) ? esc_attr($aps_select_theme) : '';
    $aps_display_navigation_arrows = (!empty($aps_display_navigation_arrows)) ? esc_attr($aps_display_navigation_arrows) : '';
    $aps_title = (!empty($aps_title)) ? esc_attr($aps_title) : '';
    $aps_total_posts = (!empty($aps_total_posts)) ? esc_attr($aps_total_posts) : 12 ;
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
    $aps_crop_image_width = (!empty($aps_crop_image_width)) ? absint(esc_attr($aps_crop_image_width)) : '';
    $aps_crop_image_height = (!empty($aps_crop_image_height)) ? absint(esc_attr($aps_crop_image_height)) : '';
    $aps_display_post_title = (!empty($aps_display_post_title)) ? esc_attr($aps_display_post_title) : '';
    $aps_display_post_date = (!empty($aps_display_post_date)) ? esc_attr($aps_display_post_date) : '';
    $aps_display_excerpt = (!empty($aps_display_excerpt)) ? esc_attr($aps_display_excerpt) : '';
    $aps_excerpt_length = (!empty($aps_excerpt_length)) ? absint(esc_attr($aps_excerpt_length)) : '';
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




//    Build the args for query.
    $args = [];
    $common_args = [
        'post_type' => 'post',
        'posts_per_page'=> (!empty($aps_total_posts) ?  absint($aps_total_posts) : 10),
        'status' => 'published',
        'no_found_rows'=> true, // remove if pagination needed

    ];
    // for testing, setting this equal
    if ( 'latest' == $aps_posts_type ) {
        $args = $common_args;
    }
    elseif ('older' == $aps_posts_type) {
        $older_args = [
            'orderby'   => 'date',
            'order'     => 'ASC',
        ];
        $args = array_merge($common_args, $older_args);
    } elseif ('featured' == $aps_posts_type){
        $featured_posts_args = [
            'meta_query' => [
                [
                    'key' => '_is_featured',
                    'value' => 'yes',
                ]
            ]];
        $args = array_merge($common_args, $featured_posts_args);
    } elseif ('popular_post' == $aps_posts_type){
        $popular_posts_args = [
            'meta_key' => '_aps_post_views_count',
            'orderby'   => 'meta_value_num',
            'order'     => 'DESC',
            'ignore_sticky_posts' => true,
            ];
        $args = array_merge($common_args, $popular_posts_args);
    }

     else {
        $args = $common_args;
    }




    // LOOP FOR POSTS CUSTOM POST INITIATED
    $loop = new WP_Query( $args );
    // fix repeat post problem if post count is less than post to display by slider
    $post_found_count = $loop->post_count;
    $aps_item_on_desktop = ($post_found_count >= $aps_item_on_desktop) ? $aps_item_on_desktop : $post_found_count;
    $aps_item_on_tablet = ($post_found_count >= $aps_item_on_tablet) ? $aps_item_on_tablet : $post_found_count;
    $aps_item_on_mobile = ($post_found_count >= $aps_item_on_mobile) ? $aps_item_on_mobile : $post_found_count;

    if( $loop->have_posts()):
        ?>
        <!--STYLES FOR posts -->
        <?php include ('aps-style.php'); ?>
        <div class='header-<?php echo $random_aps_wrapper_id; ?>'>
            <!--have to apply a header style option for title because it is from shortcode generator-->
            <?php if ( 'yes' == $aps_display_header ) echo "<h1 class='aps-title'>{$aps_title}</h1>";


            ?>
        </div> <!-- ends header -->

        <!--outer_wrap to position nav arrows-->
        <div class="outer_wrap-<?php echo $random_aps_wrapper_id; ?>">
        <!--show navigation arrows-->
        <?php
            if ('no' != $aps_display_navigation_arrows ){
                echo '<button class="'.$prevButton.'">  <i class="icon-left-open-big"></i> </button>
                      <button class="'.$nextButton.'"> <i class="icon-right-open-big"></i> </button>';
        }
        ?>

        <!--Main wrapper for the slider STARTS-->
            <div id="aps-slider-wrapper-<?php echo $random_aps_wrapper_id; ?>"class="owl-theme owl-carousel aps-slider-wrapper-class aps-<?php echo $random_aps_wrapper_id; ?>">

        <?php

            //include shortcode content
            include ('aps-shortcode-content.php');
            wp_reset_postdata();
        ?>
            <script>
                jQuery(document).ready(function($){
                var postSlider = $(".aps-<?php echo $random_aps_wrapper_id; ?>");
                    postSlider.owlCarousel({
                        margin:20,
                        loop:true,
                        autoWidth:false,
                        responsiveClass:true,
                        dots:false,
                        autoplay:<?php var_export($aps_auto_play); ?>,

                        autoplayTimeout: <?php echo $aps_slide_speed; ?>,
                        autoplayHoverPause: false,
                        //dotData:true,
                        //dotsEach:true,
                        slideBy:1,

                        responsive:{
                            0 : {
                                items:1,
                            },
                            500: {
                                items:<?php echo $aps_item_on_mobile;?>,
                            },
                            600 : {

                                items:<?php echo ($aps_item_on_tablet > 1) ? $aps_item_on_tablet- 1 : $aps_item_on_tablet  ;?>,

                            },
                            768:{
                                items:<?php echo $aps_item_on_tablet;?>,

                            },
                            1199:{
                                items:<?php echo $aps_item_on_desktop;?>,

                            }
                        }
                    });

                    // custom navigation button for slider
                    // Go to the next item
                    $('.aps-next-<?php echo $random_button_id;?>').click(function() {
                        postSlider.trigger('next.owl.carousel');
                    });
                        // Go to the previous item
                    $('.aps-prev-<?php echo $random_button_id;?>').click(function() {
                        // With optional speed parameter
                        // Parameters has to be in square bracket '[]'
                        postSlider.trigger('prev.owl.carousel');
                    });

                    // stop on hover but play after hover out
                    <?php if(!empty($aps_stop_on_hover)){ ?>
                        postSlider.hover(
                            function(){
                                postSlider.trigger('stop.owl.autoplay');
                            },
                            function(){
                                postSlider.trigger('play.owl.autoplay');
                            }
                        );
                    <?php } ?>


                });
            </script>
        </div> <!--    ends div.outer_wrap -->
    <?php else:
        _e('No Post Found.', APS_TEXTDOMAIN);
    endif; // if($loop->have_posts() ends
    ?>



    <?php
    $content = ob_get_clean();
    return $content;
}

add_shortcode('adl-post-slider', 'aps_shortcode_output');
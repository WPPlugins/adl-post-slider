<div class="aps-themeb">
    <?php
    // show image if it is allowed
    if ( 'yes' === $aps_display_img ) {
        // get featured image, if not, get first image, if not get default image
        $image_url = '';
        if ( has_post_thumbnail() ) {
            //$image_url  =  get_the_post_thumbnail_url();
            $thumb = get_post_thumbnail_id();
            $image_url = wp_get_attachment_url( $thumb , 'full'); //get img URL, and this function recieve only 1 arg. wp-includes/posts.php @5005 line
        }else{
            // get first image from the content
            $first_image = aps_first_image_or_default();
            if (!empty($first_image)){ $image_url = $first_image; } else {
                // get default image if it is allowed to use default image
                if ( ( !empty($aps_display_placeholder_img) && $aps_display_placeholder_img == 'yes' ) ) {
                    $image_url = (!empty($aps_default_feat_img)) ? $aps_default_feat_img : '';

                }
            }
        } // ends has_post_thumbnail() condition


        // crop the image if it is enabled
        if ( !empty($image_url) && !empty($aps_image_crop) && $aps_image_crop === 'yes') {
            $image_url = aq_resize( $image_url, $aps_crop_image_width, $aps_crop_image_height, true, true, true ); //resize & crop img

        }



        // show the image if image found
        if(!empty($image_url)) { ?>
            <a class="adl-featured-img-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>"><?php echo '<img src="'. esc_url($image_url) .'" />'; ?></a>
        <?php } // ends !empty($image_url)

    }  // ends show image if it is allowed
    ?>

    <?php if ( $aps_display_post_title === 'yes' ) { ?>
        <h1 class="aps-post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <?php if ( $aps_display_post_date === 'yes' ) { ?>
            <div class="aps-meta-info">
                <span class="aps-entry-date entry-date">Posted on <?php echo get_the_date(); ?></span>
            </div>
        <?php }
    } ?>

    <?php if ( $aps_display_excerpt === 'yes' ) { echo aps_get_limited_excerpts($aps_excerpt_length); } ?>
</div>


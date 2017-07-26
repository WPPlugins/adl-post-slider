<?php

/**
 * Get the first image from the content of a post
 * @return string Return Image url or an empty string
 */
function aps_first_image_or_default() {
    global $post;
    $first_img = '';
    ob_start();
    ob_end_clean();
    // it is good to use do_shortcode() to get image from content added by shortocde in a post.
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', do_shortcode($post->post_content), $matches);
    // array containing empty value could not be checked by empty(), so first empty value should be removed, then checked
    //http://stackoverflow.com/questions/2216052/how-to-tell-if-a-php-array-is-empty
    // remove all empty value or array from $matches variable. otherwise, Notice: Undefined offset: 0 is shown.
    foreach ($matches as $key => $value) {
        if (empty($value)) {
            unset($matches[$key]);
        }
    }
    if ( !empty($matches) ) {
        $first_img = $matches[1][0];
    }


    //if(empty($first_img)) {
    //    $first_img =  APS_PLUGIN_URI .'/img/featured_image_placeholder.jpg';
    //}
    return $first_img;
}


/**
 * Check if required version of WordPress is installed or not
 * @param $required_version Required WordPress version
 *
 * @return boolean true or false
 */
function aps_check_min_wp_version($required_version) {
    include( ABSPATH . WPINC . '/version.php' ); // get an unmodified $wp_version
    return ( version_compare( $wp_version, $required_version, '<' ) );
}

/**
 *  Show warning to the user if unsupported wp version is used
 * @param $min_wp_version | Minimum required wp version.
 *
 */
function aps_warn_if_unsupported_wp() {
        $wp_ver = ! empty( $GLOBALS['wp_version'] ) ? $GLOBALS['wp_version'] : '(undefined)';
?>
        <div class="error notice is-dismissible"><p>
            <?php
                echo 'ADL Post Slider requires WordPress version ' .APS_MINIMUM_WP_VERSION. ' or newer. It appears that you are running '.esc_html( $wp_ver ).' The plugin has been auto deactivated. Please <a href="https://wordpress.org/download/" target="_blank" title="download latest version of WordPress">upgrade</a> your WordPress Version';
                ?>
        </p></div>
<?php


}


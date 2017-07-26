<?php

function aps_set_post_views($postID) {
    $count_key = '_aps_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if('' == $count){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// remove adjacent_posts_rel_link_wp_head for accurate post views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function aps_track_post_views ($postID) {
    // vail if user is logged in or if the post is not single.
    if ( !is_single() || is_user_logged_in() ) return;

    if ( empty ( $postID) ) {
        global $post;
        $postID = $post->ID;
    }
    aps_set_post_views($postID);
}
add_action( 'wp_head', 'aps_track_post_views');


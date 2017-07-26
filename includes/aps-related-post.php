<?php
// get related post based on tags or categories
function aps_get_related_posts() {
    global $post;
   // get all tags assigned to current post
    $tags = wp_get_post_tags($post->ID);
    $args = [];
    // set args to get related posts based on tags
    if (!empty($tags)) {
        $tag_ids = [];
        foreach($tags as $tag) $tag_ids[] = $tag->term_id;
        $args=[
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'ignore_sticky_posts' => true,
            'posts_per_page'=>5,
            'orderby'=>'rand',
        ];
    }
    else {
        // get all cats assigned to current post
        $cats = get_the_category($post->ID);
        // set the args to get all related posts based on category.
        if ($cats) {
            $cat_ids = [];
            foreach($cats as $cat) $cat_ids[] = $cat->term_id;
            $args=[
                'category__in' => $cat_ids,
                'post__not_in' => array($post->ID),
                'ignore_sticky_posts' => true,
                'posts_per_page'=>5,
                'orderby'=>'rand',
            ];
        }
    }
    if(!empty($args)){
        // build the markup and return
        $rp_loop = new WP_Query($args);
        $aps_rp = '<h2>Related Post</h2><ul>';
        if( $rp_loop->have_posts() ) {
            while ($rp_loop->have_posts()) : $rp_loop->the_post();
                $aps_rp .='<li><a href="'.get_the_permalink().'" rel="bookmark" >'.get_the_title().'</a></li>';
            endwhile;
        }
        $aps_rp .= '</ul>';
        wp_reset_query();
        return $aps_rp;
    }
    return null;
}


function aps_related_post_insert($content){
    return (is_singular()) ? $content.'&nbsp;[aps_rp]': $content;
}
add_filter( 'the_content', 'aps_related_post_insert', 5 );


function aps_related_post($atts) {
    extract(shortcode_atts(array(
    ), $atts));
    // show related post on single post
    return (is_singular()) ? aps_get_related_posts() : '';

}
add_shortcode('aps_rp', 'aps_related_post');
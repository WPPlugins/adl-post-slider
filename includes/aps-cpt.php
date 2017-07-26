<?php

/**
 * Deny direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( APS_ALERT_MSG );

/**
 * Registers ADL Post Slider post type.
 */

function aps_init() {
    $post_type = 'adlpostslider';
    $singular_name = 'Post Slider';
    $plural_name = 'Post Sliders';
    $slug = 'adlpostslider';
    $labels = array(
        'name'               => _x( $plural_name, 'post type general name', APS_TEXTDOMAIN ),
        'singular_name'      => _x( $singular_name, 'post type singular name', APS_TEXTDOMAIN ),
        'menu_name'          => _x( $singular_name, 'admin menu name', APS_TEXTDOMAIN ),
        'name_admin_bar'     => _x( $singular_name, 'add new name on admin bar', APS_TEXTDOMAIN ),
        'add_new'            => _x( 'Add New', 'add new text', APS_TEXTDOMAIN ),
        'add_new_item'       => __( 'Add New '.$singular_name, APS_TEXTDOMAIN ),
        'new_item'           => __( 'New '.$singular_name, APS_TEXTDOMAIN ),
        'edit_item'          => __( 'Edit '.$singular_name, APS_TEXTDOMAIN ),
        'view_item'          => __( 'View '.$singular_name, APS_TEXTDOMAIN ),
        'all_items'          => __( 'All '.$plural_name, APS_TEXTDOMAIN ),
        'search_items'       => __( 'Search '.$plural_name, APS_TEXTDOMAIN ),
        'parent_item_colon'  => __( 'Parent '.$plural_name.':', APS_TEXTDOMAIN ),
        'not_found'          => __( 'No sliders found.', APS_TEXTDOMAIN ),
        'not_found_in_trash' => __( 'No books found in Trash.', APS_TEXTDOMAIN )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', APS_TEXTDOMAIN ),
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => $slug ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),
        'menu_icon'           => 'dashicons-images-alt2'


    );

    register_post_type( $post_type, $args );
}

add_action( 'init', 'aps_init');



/**
 * Change the placeholder of title input box
 * @param string $title Name of the book
 *
 * @return string
 */
function aps_change_title_text( $title ){
    $screen = get_current_screen();
    if  ( 'adlpostslider' == $screen->post_type ) {
        $title = 'Enter a slider title';
    }
    return $title;
}

add_filter( 'enter_title_here', 'aps_change_title_text' );
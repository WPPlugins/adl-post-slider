<?php

/**
 * Change the columns names for our slider
 * @param $columns
 *
 * @return array
 */
function aps_add_new_columns($new_columns){
    $new_columns = [];
    $new_columns['cb']   = '<input type="checkbox" />';
    $new_columns['title']   = __('Slider Name', APS_TEXTDOMAIN);
    $new_columns['shortcode']   = __('Slider Shortcode', APS_TEXTDOMAIN);
    $new_columns['shortcode_2']   = __('Shortcode For Template File', APS_TEXTDOMAIN);
    $new_columns['date']   = __('Created at', APS_TEXTDOMAIN);
    return $new_columns;
}
add_filter('manage_adlpostslider_posts_columns', 'aps_add_new_columns');

function aps_manage_custom_columns( $column_name, $post_id ) {

    switch($column_name){
        case 'shortcode': ?>
            <textarea style="resize: none; background-color: #2e85de; color: #fff;" cols="23" rows="1" onClick="this.select();" >[adl-post-slider <?php echo 'id="'.$post_id.'"';?>]</textarea>
        <?php
        break;
        case 'shortcode_2':
            ?>
                    <textarea style="resize: none; background-color: #2e85de; color: #fff;" cols="54" rows="1" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[adl-post-slider id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea>
            <?php
            break;

        default:
            break;

    }
}



add_action('manage_adlpostslider_posts_custom_column', 'aps_manage_custom_columns', 10, 2);




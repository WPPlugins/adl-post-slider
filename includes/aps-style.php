<style type="text/css">
    .owl-item .item:hover {
        cursor: pointer;
    }
    /*
     General style for the slider
    */
    .outer_wrap-<?php echo $random_aps_wrapper_id; ?>{
        position: relative;
        margin-bottom: 25px;
    }
    .header-<?php echo $random_aps_wrapper_id; ?>{
        position: relative;
    }

    /*SLider title */
    .header-<?php echo $random_aps_wrapper_id; ?> h1.aps-title{
        text-align: center;
        margin: 5px 0 0;
        color: <?php echo $aps_header_title_font_color;?>;
        font-size: <?php echo $aps_header_title_font_size;?>;
    }
    /*post title*/
    .aps-themea h1.aps-post-title, .aps-themeb h1.aps-post-title {
        font-size:<?php echo $aps_title_font_size;?>;
    }
    .outer_wrap-<?php echo $random_aps_wrapper_id; ?> h1.aps-post-title a {
        font-size:<?php echo $aps_title_font_size;?>;
        color: <?php echo $aps_title_font_color;?>;
    }
    /*
    NAVIGATION BUTTONS
    */
    .<?php echo $prevButton;?>,
    .<?php echo $nextButton;?>
     {
        position: absolute;
        top: 40%;
        background: <?php echo $aps_nav_arrow_bg_color;?>;
        z-index: 9999;
        width: 45px;
        height: 42px;
        line-height: 42px;
        padding: 0;
        border-radius: 50%;
        color: <?php echo $aps_nav_arrow_color;?>;
        outline: none;
        border: none;
        webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }
    .<?php echo $nextButton;?> {
        right: -1.8%;
    }
    .<?php echo $prevButton;?> {
        left: -1.8%;
    }

    .<?php echo $prevButton; ?>:hover,
    .<?php echo $nextButton; ?>:hover {
        background: <?php echo $aps_nav_arrow_bg_hover_color;?>;
        color: <?php echo $aps_nav_arrow_hover_color;?>;
    }
    .<?php echo $prevButton;?> > i.icon-left-open-big,
    .<?php echo $nextButton;?> > i.icon-right-open-big {
        font-size: 20px;
    }





</style>


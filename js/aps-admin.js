jQuery(document).ready(function($) {

    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

//    COLOR PICKER

    //$('#aps_header_title_font_color, #aps_nav_arrow_color, #aps_nav_arrow_bg_color').wpColorPicker();
    $('#aps_header_title_font_color, #aps_title_font_color, #aps_title_hover_font_color, #aps_nav_arrow_color, #aps_nav_arrow_bg_color, #aps_nav_arrow_hover_color, #aps_nav_arrow_bg_hover_color, #aps_border_color, #aps_border_hover_color').wpColorPicker();

    // Post Query Type. all all extra input field by default
    $('#aps_posts_bycategory, #aps_posts_byID, #aps_posts_byTag, #aps_posts_by_year, #aps_posts_from_month, #aps_posts_from_month_year, .specific-categories').hide();

    $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'aps_posts_type4') {
            $('#aps_posts_bycategory, .specific-categories.category').fadeIn();
        }
        else {
            $('#aps_posts_bycategory, .specific-categories.category').hide();
        }
    });
    $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'aps_posts_type5') {
            $('#aps_posts_byID').fadeIn();
        }
        else {
            $('#aps_posts_byID').hide();
        }
    });
    $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'aps_posts_type6') {
            $('#aps_posts_byTag').fadeIn();
        }
        else {
            $('#aps_posts_byTag').hide();
        }
    });
    $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'aps_posts_type7') {
            $('#aps_posts_by_year').fadeIn();
        }
        else {
            $('#aps_posts_by_year').hide();
        }
    });
    $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'aps_posts_type8') {
            $('#aps_posts_from_month, #aps_posts_from_month_year').fadeIn();
        }
        else {
            $('#aps_posts_from_month, #aps_posts_from_month_year').hide();
        }
    });


// show if it is checked
    if( $('input[id=aps_posts_type1]').is(':checked') ) {
        $('#aps_latest_posts_bycategory, .specific-categories.latest').fadeIn();
    }
    if( $('input[id=aps_posts_type2]').is(':checked') ) {
        $('#aps_oldest_posts_bycategory, .specific-categories.oldest').fadeIn();
    }
    if( $('input[id=aps_posts_type4]').is(':checked') ) {
        $('#aps_posts_bycategory, .specific-categories.category').fadeIn();
    }
    if( $('input[id=aps_posts_type5]').is(':checked') ) {
        $('#aps_posts_byID').fadeIn();
    }
    if( $('input[id=aps_posts_type6]').is(':checked') ) {
        $('#aps_posts_byTag').fadeIn();
    }
    if( $('input[id=aps_posts_type7]').is(':checked') ) {
        $('#aps_posts_by_year').fadeIn();
    }
    if( $('input[id=aps_posts_type8]').is(':checked') ) {
        $('#aps_posts_from_month, #aps_posts_from_month_year').fadeIn();
    }


    // image uploader
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Select or Upload Default Featured Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).open()
            .on('select', function(){
                // This will return the selected image from the Media Uploader, the result is an object,
                var uploaded_image = image.state().get('selection').first().toJSON();
                // Let's assign the url value to the input field
                $('#aps_default_feat_img').val(uploaded_image.url);
            });
    });


});


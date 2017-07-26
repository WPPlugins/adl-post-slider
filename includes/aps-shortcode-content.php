<!--  loop Starts -->
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="item">
        <?php ( !empty($aps_select_theme) ) ?
                include APS_PLUGIN_DIR .'/themes/'.$aps_select_theme .'.php'
                :
                include APS_PLUGIN_DIR .'/themes/themea.php';
        ?>

    </div>
<?php endwhile; ?>
<!--Loop Ends-->
</div> <!-- ends aps-slider-wrapper -->









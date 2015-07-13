<?php get_header(); ?>
    <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
    <div class="col-md-8 left-side clearfix">

           <?php echo do_shortcode('[contact-form-7 id="77" title="Contact form 1"]'); ?>

    </div><!-- left-side -->

    <?php get_sidebar(); ?>

</div><!-- body-content -->

<?php get_footer(); ?>
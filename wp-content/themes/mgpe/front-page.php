<?php get_header(); ?>
            <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
			<div class="hidden">
                <?php while(have_posts()):the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile ?>
			</div>
            <div class="col-md-8 left-side">
                <?php echo do_shortcode('[slider]'); ?>
				
                    
                <?php echo do_shortcode('[latestConfess]'); ?>
				
                <?php echo do_shortcode('[blogs]'); ?>
                    
            </div><!-- left-side -->
			<?php get_sidebar(); ?>
        </div><!-- body-content -->

<?php get_footer(); ?>
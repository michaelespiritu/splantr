<?php 
/*
*
* Template name: Thank You 
*
*/
get_header(); ?>
    <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
    <div class="col-md-8 left-side">
        <?php while(have_posts()):the_post(); ?>
            <div class="content-post clearfix text-center">  
				<?php
					$email = $_GET['email'];
				?>
				<h1>Thank you for Sharing your Story</h1>
				<p>we will email you using this address <strong><?= $email ?></strong> once your confession has been approved.</p>
				
                <?php the_content() ?>
            </div>
        <?php endwhile; ?>
    </div><!-- left-side -->

    <?php get_sidebar(); ?>

</div><!-- body-content -->

<?php get_footer(); ?>
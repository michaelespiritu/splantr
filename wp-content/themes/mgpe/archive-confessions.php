<?php get_header(); ?>
    <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
    <div class="col-md-8 left-side clearfix">
			<h1 class="text-center">Confessions</h1>
			<hr>
            <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
                <div class="entry-blog clearfix animate">
                        <a href="<?php the_permalink(); ?>">
                            <div class="col-md-12">
                                
                                <?php /* ?><div class="col-md-4">
                                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail', array('class' => 'col-md-12 col-xs-12 thumbnail')); } ?>
                                </div><?php */ ?>

                                <div class="col-md-12">

                                    <h3><?php the_title(); ?></h3>  
                                   
                                    <div><?php the_excerpt(); ?></div>
                                    <hr>
                                    <div class="col-md-12 text-right no-padding">
                                        <a href="<?php the_permalink() ?>" class="btn btn-default">
                                            Read More
                                       </a>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                &nbsp;
            <?php endwhile; ?>
			<?php else: ?>
                    <h2 class="text-center">Sorry, no posts yet.</h2>
            <?php endif; ?>
	</div><!-- left-side -->
    <?php get_sidebar(); ?>

</div><!-- body-content -->

<?php get_footer(); ?>
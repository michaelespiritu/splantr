<?php get_header(); ?>
    <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
    <div class="col-md-8 left-side clearfix">

            <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
                <div class="entry-blog clearfix animate">
                        <a href="<?php the_permalink(); ?>">
                            <div class="col-md-12 no-padding">
                                
                                <div class="col-md-4 col-sm-4">
                                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail', array('class' => 'col-md-12 col-xs-12 thumbnail')); } ?>
                                </div>

                                <div class="col-md-8 col-sm-8">

                                    <h3><?php the_title(); ?></h3>  
                                    <p class="col-md-6 col-sm-6 col-xs-6 no-padding"><small>Posted: <?php echo get_the_date( 'M d,y' ); ?></small></p>
                                    <p class="col-md-6 col-sm-6 col-xs-6 no-padding text-right"><small><?php echo the_tags(); ?></small></p>
                                   
                                    <div><?php the_excerpt(); ?></div>
                                    <hr>
                                    <div class="col-md-12 col-sm-12 text-right no-padding">
                                        <a href="<?php the_permalink() ?>" class="btn btn-default">
                                            Read More
                                       </a>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                &nbsp;
            <?php endwhile; else: ?>
                    <h2 class="text-center">Sorry, no posts yet.</h2>
            <?php endif; ?>
    </div><!-- left-side -->

    <?php get_sidebar(); ?>

</div><!-- body-content -->

<?php get_footer(); ?>
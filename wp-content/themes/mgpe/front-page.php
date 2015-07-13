<?php get_header(); ?>
            <div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">
			<div class="hidden">
                <?php while(have_posts()):the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile ?>
			</div>
            <div class="upper-head row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 clearfix no-padding">

                    <?php echo do_shortcode('[featuredblogs]'); ?>
                    
                    <?php echo do_shortcode('[featured_company]'); ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 clearfix no-padding">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 no-padding subscribe sidebar-front">            
                            <h3>Subscribe to get the latest news</h3>           
                            <?php echo do_shortcode('[gravityform id="1" name="Subscribe Form" ajax="true"]'); ?>     
                        </div>     
                        <div class="clearfix col-lg-12 col-md-6 col-sm-12 col-xs-12 no-padding sidebar-front fb-like">         
                            <h3>Like us on Facebook!</h3>                
                                        
                            <div class="facebook-like">
                                <iframe class="facebook-like" src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FSplantr%2F439228982883303&amp;width=300&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=461097557366578" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:35px;" allowTransparency="true"></iframe>
                            </div>  
                        </div>  
                </div>
                
            </div>
            <div class="col-md-12">
                <?php echo do_shortcode('[blogs]'); ?>
                    
            </div><!-- left-side -->
			<?php //get_sidebar(); ?>
        </div><!-- body-content -->

<?php get_footer(); ?>
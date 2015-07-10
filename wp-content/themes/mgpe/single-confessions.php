<?php get_header(); ?>    
	<div class="row body-content <?php echo (is_user_logged_in()) ? '' : 'margin-top' ;?>">   
		 <div class="col-md-8 left-side">        
			<?php while(have_posts()):the_post(); ?>       
			<img src="/wp-content/uploads/lips.jpg" class="col-md-12 thumbnail hidden" width="150" height="150">
		 <div class="clearfix">                
			 <h1><?php the_title(); ?>
			 </h1>				
			 <br>
			 <?php echo do_shortcode('[ssba]'); ?>       
			<div class="col-md-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
					<p class="prev-post-link"><?php previous_post_link('%link', '<span class="glyphicon glyphicon-arrow-left"></span>  Back'); ?> </p>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6 text-right no-padding">
					<p class="next-post-link"><?php next_post_link( '%link', 'Next  <span class="glyphicon glyphicon-arrow-right"></span>'); ?></p>
				</div>
			</div>
		 </div>           
		 <div class="content">                 
			 <?php the_content() ?>				 
			 <hr>
			 <p>Do you also have a secret that keeps on hunting you? a story that you can't keep inside? <a href="/share-story/" target="_blank"><strong>Click here to share it with us</strong></a>!</p>
			 <p>Don't forget to like our official facebook page at <a href="https://www.facebook.com/pages/Splantr/439228982883303" target="_blank"><strong>Splantr Facebook</strong></a>!</p>
			 <div class="hidden"><h2>Confession</h2></div>
			 <?php echo do_shortcode('[ssba]'); ?> 
				<div class="col-md-12 no-padding">
					<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
						<p class="prev-post-link"><?php previous_post_link('%link', '<span class="glyphicon glyphicon-arrow-left"></span>  Back'); ?> </p>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 text-right no-padding">
						<p class="next-post-link"><?php next_post_link( '%link', 'Next  <span class="glyphicon glyphicon-arrow-right"></span>'); ?></p>
					</div>
				</div>
		 </div>        
		 <?php endwhile; ?>       
		 <!--<div class="comment-part clearfix">         
			 <hr>           
			 <h3>Comment:</h3>		
			 &nbsp;          
			 &nbsp;          
			 <div class="fb-comments" data-href="http://mgpe.org" data-width="697" data-numposts="100" data-colorscheme="light">
			 </div>      
		 </div>   -->
		 </div><!-- left-side --> 
		 <?php get_sidebar(); ?>
	</div><!-- body-content -->
<?php get_footer(); ?>
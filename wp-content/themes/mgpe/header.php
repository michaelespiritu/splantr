<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" dir="ltr" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#"><![endif]--> 
<!--[if IE 7]><html id="ie7" dir="ltr" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 8]><html id="ie8" dir="ltr" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ]><!--><html class="no-js" dir="ltr" <?php language_attributes(); ?>><!--<![endif]--> 

<head>

<!-- start of static tags -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php bloginfo( 'url' ); ?>/favicon.png" type="image/x-icon" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'url' ); ?>/favicon.png"/>
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'url' ); ?>/favicon.png"/>

<meta name="revisit-after" content="<?php echo get_field('header_meta_revisit_after', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="rating" content="<?php echo get_field('header_meta_rating', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="author" content="<?php echo get_field('header_meta_author', mgpe_get_page_id_slug('home')); ?>"/>
<link rel="home" title="<?php bloginfo( 'name' ); ?>" href="/"/>
<link rel="profile" href="//gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

<meta name="geo.region" content="<?php echo get_field('header_meta_georegion', mgpe_get_page_id_slug('home')); ?>" />
<meta name="geo.country" content="<?php echo get_field('header_meta_geocountry', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="geo.placename" content="<?php echo get_field('header_meta_geoplacename', mgpe_get_page_id_slug('home')); ?>" />
<meta name="geo.position" content="<?php echo get_field('header_meta_geoposition', mgpe_get_page_id_slug('home')); ?>" />
<meta name="ICBM" content="<?php echo get_field('header_meta_icbm', mgpe_get_page_id_slug('home')); ?>" />

<meta name="dcterms.contributor" content="<?php echo get_field('header_meta_dctermscontributor', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="dcterms.coverage" content="<?php echo get_field('header_meta_dctermscoverage', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="dcterms.creator" content="<?php echo get_field('header_meta_dctermscreator', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="dcterms.format" content="text/html"/>
<meta name="dcterms.identifier" content="<?php bloginfo( 'url' ); ?>"/>
<meta name="dcterms.publisher" content="<?php echo get_field('header_meta_dctermspublisher', mgpe_get_page_id_slug('home')); ?>"/>
<meta name="dcterms.subject" content="<?php echo mgpe_get_yoastseo_page_fields('metakeywords'); ?>"/>
<meta name="dcterms.title" content="<?php echo mgpe_get_yoastseo_page_fields('title'); ?>"/>
<meta name="dcterms.description" content="<?php echo mgpe_get_yoastseo_page_fields('metadesc'); ?>"/>
<meta name="dcterms.type" content="Text"/>

<!-- end of static tags -->

<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56030574-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body class="mceContentBody">
    <?php //Facebook Comment Section Integration ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=461097557366578&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
       
	<div class="row header">
		<div class="navbar navbar-default  <?php echo (is_user_logged_in()) ? 'navbar-static-top' :  'navbar-fixed-top'; ?>" role="navigation">
		  <div class="container">
			<div class="navbar-header navbar-right">
			<form class="form-inline search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			 <div class="form-group search-form"> <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
				</div>
				 <div class="form-group"> <a class="navbar-brand" href="/">Splantr</a></div>
				  <div class="form-group">
					<input type="text" class="form-control search-input"  placeholder="Search" value="<?php echo get_search_query() ?>" name="s" >
				  </div>
				  <div class="form-group button-search">
					<button class="btn btn-default search-submit"><i class="glyphicon glyphicon-search"></i></button>
				  </div>
				</form>
				
			</form>
				
			</div>
			<div class="navbar-collapse collapse">
			  <?php wp_nav_menu( array('menu' => 'main-menu' )); ?>
			</div><!--/.nav-collapse -->
		  </div>
		</div>
	</div><!-- header -->
		
	<div class="container-fluid">
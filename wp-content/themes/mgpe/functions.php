<?php

/**
 * MGPE functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */



/***************************************************** start of mgpe theme standard functions ********************************************************************/



/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) )

	$content_width = 960;





/**
 * Tell WordPress to run mgpe_setup() when the 'after_setup_theme' hook is run.
 */

add_action( 'after_setup_theme', 'mgpe_setup' );



if ( ! function_exists( 'mgpe_setup' ) ):

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override mgpe_setup() in a child theme, add your own mgpe_setup to your child theme's
 * functions.php file.
 *
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses load theme widgets
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */

function mgpe_setup() {



	// This theme styles the visual editor with editor-style.css to match the theme style.

	add_editor_style();

  

 // This theme uses wp_nav_menu() in one location.

  register_nav_menu( 'first', __( 'First Menu', 'mgpe' ) );

  register_nav_menu( 'second', __( 'Second Menu', 'mgpe' ) );

  register_nav_menu( 'four-zero-four', __( '404 Menu', 'mgpe' ) );

  

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images

	add_theme_support( 'post-thumbnails' );

  

  // The height and width of your custom header.

	// Add a filter to mgpe_header_image_width and mgpe_header_image_height to change these values.

//	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'mgpe_header_image_width', 940 ) );

//	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'mgpe_header_image_height', 349 ) );

//  set_post_thumbnail_size(HEADER_IMAGE_WIDTH,HEADER_IMAGE_HEIGHT);

  

	// Grab theme widgets.

	require( get_template_directory() . '/inc/widgets.php' );

}

endif; // mgpe_setup



function mgpe_javascripts() {

  wp_enqueue_script("bootstrapjs", get_template_directory_uri()."/js/bootstrap.js",array("jquery"),false,true);

  wp_enqueue_script("site-js", get_template_directory_uri()."/js/site.js",array("jquery"),false,true);

}    

add_action('wp_enqueue_scripts', 'mgpe_javascripts');



function mgpe_stylesheets() {

  wp_enqueue_style("bootstrap", get_template_directory_uri()."/css/bootstrap.min.css");

  wp_enqueue_style("normalize", "//normalize-css.googlecode.com/svn/trunk/normalize.css");

  wp_enqueue_style("stylecss", get_stylesheet_uri());

}    

add_action('wp_enqueue_scripts', 'mgpe_stylesheets');



/**
 * Register our sidebars and widgetized areas. Also register the default widget.
 *
 * @since MGPE
 */

function mgpe_widgets_init() {



  register_widget( 'mgpe_Nav_Menu_Widget' );

  register_widget( 'mgpe_Quicklink_Widget' );

  register_widget( 'mgpe_nggWidget_Quicklink' );

  register_widget( 'mgpe_Admin_Menu_Widget' );

  

  register_sidebar( array(

      'name' => __( 'Newsletter', 'mgpe' ),

      'id' => 'newsletter-sidebar',

      'before_widget' => '',

      'after_widget' => '',

      'before_title' => '',

      'after_title' => '',

      'hide_readmore' => false,

      'show_image' => false,

    ) );





}

add_action( 'widgets_init', 'mgpe_widgets_init' );



/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since mgpe
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */

function mgpe_wp_title( $title, $sep ) {

	global $paged, $page;



	if ( is_feed() )

		return $title;



	// Add the site name.

	$title .= get_bloginfo( 'name' );



	// Add the site description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		$title = "$title $sep $site_description";



	// Add a page number if necessary.

	if ( $paged >= 2 || $page >= 2 )

		$title = "$title $sep " . sprintf( __( 'Page %s', 'mgpe' ), max( $paged, $page ) );



	return $title;

}

add_filter( 'wp_title', 'mgpe_wp_title', 10, 2 );







/* add media id column on Media Library page */

function mgpe_media_columns($posts_columns) {

    $cb_value = array_shift($posts_columns);

    $posts_columns = array_merge(array('cb' => $cb_value, 'id' => __('ID')), $posts_columns);

    

    return $posts_columns;

}

add_filter( 'manage_media_columns', 'mgpe_media_columns');





function mgpe_media_column_row($columnName, $columnID){

    if($columnName == 'id'){

       echo $columnID;

    }

}

add_filter( 'manage_media_custom_column', 'mgpe_media_column_row', 10, 2 );

/* end add media id column on Media Library page */



/** Hide the login page error feedback

 * http://www.hongkiat.com/blog/hardening-wordpress-security/

 */

add_filter('login_errors',create_function('$a', "return null;"));



/**
 * Hide Wordpress version number
 * <meta content="WordPress 3.5.1" name="generator">
 * http://wpcandy.com/teaches/security-tips/#.Ua711tJkOSo
 */

remove_action('wp_head','wp_generator');





/**
 * Render the shortcodes entered in text (Arbitrary text or HTML) widget
 */

add_filter('widget_text', 'do_shortcode');



/**
 * Get page id by slug
 * 
 * 
 */

function mgpe_get_page_id_slug($slug)

{

  $page = get_page_by_path($slug);

  return $page->ID;

}



/***************************************************** end of mgpe theme standard functions ********************************************************************/









/***************************************** Codes for default header meta fields using Advanced Custom Fields plugin **************************************************/



/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */ 



// Add-ons 

// include_once('add-ons/acf-repeater/acf-repeater.php');

// include_once('add-ons/acf-gallery/acf-gallery.php');

// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');

// include_once( 'add-ons/acf-options-page/acf-options-page.php' );





/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */



if(function_exists("register_field_group"))

{

	register_field_group(array (

		'id' => 'acf_header-meta-tags',

		'title' => 'Header Meta Tags',

		'fields' => array (

			array (

				'key' => 'field_5271aa75e34d9',

				'label' => 'Revisit After',

				'name' => 'header_meta_revisit_after',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="revisit-after" content="7 days"/&gt;"',

				'required' => 1,

				'default_value' => '7 days',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271ac93a8799',

				'label' => 'Rating',

				'name' => 'header_meta_rating',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="rating" content="general"/&gt;"',

				'required' => 1,

				'default_value' => 'general',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271ad257cbe6',

				'label' => 'Author',

				'name' => 'header_meta_author',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="author" content="MGPE"/&gt;"',

				'required' => 1,

				'default_value' => 'MGPE',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271adec0d54f',

				'label' => 'Geo Region',

				'name' => 'header_meta_georegion',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="geo.region" content="PH-WA"/&gt;"',

				'required' => 1,

				'default_value' => 'PH',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271af3df0cc9',

				'label' => 'Geo Country',

				'name' => 'header_meta_geocountry',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="geo.country" content="PH"/&gt;"',

				'required' => 1,

				'default_value' => 'PH',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271af71f0cca',

				'label' => 'Geo Placename',

				'name' => 'header_meta_geoplacename',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="geo.placename" content="PH"/&gt;"',

				'required' => 1,

				'default_value' => 'PH',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271afe2d9800',

				'label' => 'Geo Position',

				'name' => 'header_meta_geoposition',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="geo.position" content="-31.943663;115.845045"/&gt;"',

				'required' => 1,

				'default_value' => '-31.943663;115.845045',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271af45a2721',

				'label' => 'ICBM',

				'name' => 'header_meta_icbm',

				'type' => 'text',

				'instructions' => 'Enter content value for ICBM: "&lt;meta name="ICBM" content="-31.823784, 115.741724"/&gt;"',

				'required' => 1,

				'default_value' => '-31.823784, 115.741724',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271f8de168cb',

				'label' => 'DCTerms Contributor',

				'name' => 'header_meta_dctermscontributor',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="dcterms.contributor" content="MGPE"/&gt;"',

				'required' => 1,

				'default_value' => 'MGPE',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271f94a168cc',

				'label' => 'DCTerms Coverage',

				'name' => 'header_meta_dctermscoverage',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="dcterms.coverage" content="Australia"/&gt;"',

				'required' => 1,

				'default_value' => 'Philippines',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271f9af3be45',

				'label' => 'DCTerms Creator',

				'name' => 'header_meta_dctermscreator',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="dcterms.creator" content="MGPE"/&gt;"',

				'required' => 1,

				'default_value' => 'MGPE',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

			array (

				'key' => 'field_5271fcff3be46',

				'label' => 'DCTerms Publisher',

				'name' => 'header_meta_dctermspublisher',

				'type' => 'text',

				'instructions' => 'Enter content value for tag: "&lt;meta name="dcterms.publisher" content="MGPE"/&gt;"',

				'required' => 1,

				'default_value' => 'MGPE',

				'placeholder' => '',

				'prepend' => '',

				'append' => '',

				'formatting' => 'none',

				'maxlength' => 100,

			),

		),

		'location' => array (

			array (

				array (

					'param' => 'page',

					'operator' => '==',

					'value' => '6',

					'order_no' => 0,

					'group_no' => 0,

				),

			),

		),

		'options' => array (

			'position' => 'normal',

			'layout' => 'default',

			'hide_on_screen' => array (

			),

		),

		'menu_order' => 0,

	));

}

/***************************************** End of Codes for default header meta fields using Advanced Custom Fields plugin **************************************************/







/***************************************************** add project custom functions below this line *****************************************************************/



/* start of codes to meet master template */ 

// Add viewport meta tag to head

function mgpe_viewport_meta() { 

    ?>

        <meta name="viewport" content="width=device-width"/>

    <?php

}

add_filter('wp_head', 'mgpe_viewport_meta');



// set meta og:locale content to en_GB'

function mgpe_override_og_locale($locale)

{

    return 'en_GB';

}

add_filter('wpseo_locale', 'mgpe_override_og_locale');



// set meta og:tpe to 'website'

function mgpe_override_og_type($locale)

{

    return 'website';

}

add_filter('wpseo_opengraph_type', 'mgpe_override_og_type');



// get page Yoast SEO page fields

function mgpe_get_yoastseo_page_fields($fieldid)

{

	global $post;

	$metakeywords = WPSEO_Meta::get_value($fieldid, $post->ID);

	

	return $metakeywords;

}

/* end of codes to meet master template */ 



/*

*  mgpe_acf_shortcode()

*

*  This function is used to add basic shortcode support for the ACF plugin

*

*  @type	function

*  @since	1.1.1

*  @date	29/01/13

*

*  @param	array	$atts: an array holding the shortcode options

*			string	+ field: the field name

*			mixed	+ post_id: the post_id to load from

*

*  @return	string	$value: the value found by get_field

*/



function mgpe_acf_shortcode( $atts )

{

	// extract attributs

	extract( shortcode_atts( array(

		'field' => "",

		'post_id' => false,

	), $atts ) );

	

	// $field is requird

	if( !$field || $field == "" )

	{

		return "";

	}

	

	

	// get value and return it

	$value = get_field( $field, $post_id );

	

  switch($field)

  {

    default:

      return $value;

  }

	

	if( is_array($value) )

	{

		$value = @implode( ', ',$value );

	}

	



}

add_shortcode( 'mgpe_acf', 'mgpe_acf_shortcode' );





function my_theme_add_editor_styles() {

    add_editor_style( 'editor-style.css' );

}

add_action( 'init', 'my_theme_add_editor_styles' );






/**
* 
* Remove feed links
*
* @since MGPE 1.0
*/

add_action('init', 'remove_feed_links');

function remove_feed_links() {

remove_action('wp_head', 'feed_links', 2);

remove_action('wp_head', 'feed_links_extra', 3);

}



/**
* 
* Remove short links
*
* @since MGPE 1.0
*/

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );/*** Generate Sitemap**/function sitemaps(){		$sitemap = wp_nav_menu(array("menu" => "main-menu", "menu_class" => "nav transition"));return $sitemap;}add_shortcode("getsitemap", "sitemaps");

/**
* 
* Slider Action
*
* @since MGPE 1.0
*/
function slider(){
	$slider = get_field('slider', 8);
     ob_start();?>
       <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <?php $slider = get_field('slider'); ?>
          <ol class="carousel-indicators">
          <?php $x = 1; foreach($slider as $control => $key): ?>
            <?php $x++; ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key['control_data-slide-to'] ?>" class="<?php echo ($x == 2) ? 'active'  :  '' ;?>"></li>
          <?php endforeach; ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php  $x = 1; foreach($slider as $control => $key): ?>
                <?php $x++; ?>
                <?php $image = $key['image']; ?>
                <div class="item <?php echo ($x == 2) ? 'active'  :  '' ;?>">
                  <img src="<?= $image['url'] ?>" alt="<?= $image['title'] ?>">
                </div>
            <?php endforeach; ?>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
    <?php
	$contents = ob_get_contents();
	ob_get_clean();
	return $contents;
 }
 
 add_shortcode("slider", "slider");
/**
* 
* Featured Blogs ONE
*
* @since MGPE 1.0
*/
 function featuredblogs(){
      $featuredblogs = new WP_Query();
      $featuredblogs ->query(array(
          "post_type"=>"post",
          "post_status"=>"publish",
          "orderby" => "date",
          "order" => "DESC",
          "meta_key" => "featured_post",
          "meta_value" => "Yes",
		  "showposts" => 1

          ));
     ob_start();?>
    <?php while($featuredblogs->have_posts()):  $featuredblogs -> the_post(); ?>
    <a href="<?php the_permalink() ?>">
	    <div class="col-md-6 col-sm-6 col-xs-12 no-padding blog-container-featured">
			<div class="row featured-post ">
			  <div class="col-sm-12 col-md-12 thumbnail featured-blog ">
			    <div class="animate featured clearfix">
			      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'col-md-12 col-xs-12 no-padding featured-image-blog')); } ?>
			      <div class="caption-title clearfix">
			        <h3><?php the_title(); ?></h3>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</a>
    <?php endwhile; ?>
	<?php
	$contents = ob_get_contents();
	ob_get_clean();
	return $contents;
 }

 add_shortcode("featuredblogs", "featuredblogs");
/**
* 
* Featured Blogs List
*
* @since MGPE 1.0
*/
 function blogs(){
      $blogs = new WP_Query();
      $blogs ->query(array(
          "post_type"=>"post",
          "post_status"=>"publish",
          "orderby" => "date",
          "order" => "DESC",
          "meta_key" => "featured_post",
          "meta_value" => "No"

          ));
     ob_start();?>
	<div class="clearfix">
	<div class="featured-blog-list">
    <?php while($blogs->have_posts()):  $blogs -> the_post(); ?>
    <a href="<?php the_permalink() ?>">
	    <div class="col-md-4 col-sm-6 col-xs-12 no-padding blog-container-featured">
			<div class="row featured-post ">
			  <div class="col-sm-12 col-md-12 thumbnail featured-blog ">
			    <div class="animate featured clearfix">
			      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'col-md-12 col-xs-12 no-padding featured-image-blog')); } ?>
			      <div class="caption-title clearfix">
			        <h3><?php the_title(); ?></h3>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</a>
    <?php endwhile; ?>
    </div><!-- featured-blog-list -->
	</div>
	<?php
	$contents = ob_get_contents();
	ob_get_clean();
	return $contents;
 }

 add_shortcode("blogs", "blogs");

 /*
 *
 * Custom Post Type for Company
 *
 */
 
 class company {
	
	function company() {
		add_action('init',array($this,'create_post_type_company'));
	}
	
	function create_post_type_company() {
		$labels = array(
		    'name' => 'Company',
		    'singular_name' => 'Company',
		    'add_new' => 'Add New',
		    'all_items' => 'All Company',
		    'add_new_item' => 'Add Company',
		    'edit_item' => 'Edit Company',
		    'new_item' => 'New Company',
		    'view_item' => 'View Company',
		    'search_items' => 'Search Company',
		    'not_found' =>  'No Company',
		    'not_found_in_trash' => 'No Company found in trash',
		    'parent_item_colon' => 'Parent Company:',
		    'menu_name' => 'Company'
		);
		$args = array(
			'labels' => $labels,
                        'description' => "A description for your post type",
                        'public' => true,
                        'exclude_from_search' => true,
                        'publicly_queryable' => true,
                        'show_ui' => true, 
                        'show_in_nav_menus' => true, 
                        'show_in_menu' => true,
                        'show_in_admin_bar' => true,
                        'menu_position' => 20,
                        'menu_icon' => null,
                        'capability_type' => 'post',
                        'hierarchical' => true,
                        'supports' => array('title','editor','author','thumbnail','custom-fields','page-attributes','post-formats', 'excerpt'),
                        'has_archive' => true,
                        'rewrite' => array('slug' => 'company', 'with_front' => false),
                        'query_var' => true,
                        'can_export' => true
		); 
		register_post_type('company',$args);
	}
}
$company = new company();
 
/**
* 
* All Blogs
*
* @since MGPE 1.0
*/
 function featured_company(){
	  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $featured_company = new WP_Query();
      $featured_company ->query(array(
          "post_type"=>"company",
          "post_status"=>"publish",
          "orderby" => "date",
          "order" => "DESC",
          "metakey" => "featured_post",
          "metavalue" => "Yes",
          "order" => "DESC",
		  "showposts" => 1,
		  "paged" => $paged

          ));
     ob_start();?>
	<?php while($featured_company->have_posts()):  $featured_company -> the_post(); ?>
		<a href="<?php echo (!empty(get_field('company_link'))) ? get_field('company_link') : '/'; ?>">
			<div class="col-md-6 no-padding">
	            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 sidebar-front clearfix cta-div no-padding">           
	                <h3>Company of the week!</h3>           
	                <div class="cta">           
	                    <?php the_content(); ?>  
	                </div>  
	            </div>  
	        </div>
	    </a>  
	<?php endwhile; ?>

	<?php
	$contents = ob_get_contents();
	ob_get_clean();
	return $contents;
 }
 
 add_shortcode("featured_company", "featured_company"); 
 /* Remove query strings from static resources */
 function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/* Change ajax loader gravity forms */

add_filter("gform_ajax_spinner_url", "spinner_url", 10, 2);
function spinner_url($image_src, $form){
    return "/wp-content/themes/mgpe/images/nyan-nyan-cat.gif";
}
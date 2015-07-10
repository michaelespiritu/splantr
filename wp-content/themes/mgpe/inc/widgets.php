<?php
/**
 * MPGE Custom Widgets
 *
 *
 * @package MGPE
 * @subpackage MGPE 
 * @since 1.0
 */

/**
 * mgpe Navigation Menu widget class
 *
 * @since 3.0.0
 */
 class mgpe_Nav_Menu_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Use this to add nav_menu->slug as extra class of your widget.') ); 
		parent::__construct( 'mgpe_nav_menu', __('mgpe Custom Menu'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu)
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    $args['before_widget'] = str_replace('nav_menu_slug', $nav_menu->slug, $args['before_widget']);
		echo $args['before_widget']; // remember to add %nav_menu_slug% placeholder

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

    wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );
      
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}
/*** end of mgpe Navigation Menu widget class ***/

/**
 * Makes a custom Widget for displaying quicklinks
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */
class mgpe_Quicklink_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'mgpe_quicklink_widget', // Base ID
			'mgpe Quicklink Widget', // Name
			array( 'description' => __( 'Images with text and link to page', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$title = apply_filters( 'widget_title', $instance['title'] );
    
    $sidebars = wp_get_sidebars_widgets();
    $last_widget_id = array_pop($sidebars[$args['id']]); // get 
    
    if ( ! isset( $instance['quicklink_media_id'] ) )
			$instance['quicklink_media_id'] = '0';
		if ( ! $quicklink_media_id = absint( $instance['quicklink_media_id'] ) )
 			$quicklink_media_id = 0;
    
		if ( ! isset( $instance['quicklink_url'] ) )
			$instance['quicklink_url'] = '';
    $quicklink_url = trim($instance['quicklink_url']);
    
    if ( ! isset( $instance['quicklink_text'] ) )
			$instance['quicklink_text'] = '';
		$quicklink_text = trim($instance['quicklink_text']);
    
      ?>

    <?php echo $before_widget; ?>
    <?php if(!$args['hide_title'] && !empty($title) && !$args['title_bottom']) : ?>
     <?php echo $before_title; ?>
     <?php if(!empty($quicklink_url)) : ?>
        <a href="<?php echo $quicklink_url; ?>" title="Click to view page" <?echo $same_domain ? '' : 'target="_blank"'; ?>>
      <?php endif;?>
          
      <?php echo $title; ?>
          
      <?php if(!empty($quicklink_url)) : ?>
        </a>
      <?php endif;?>
    <?php echo $after_title; ?>
    <?php endif; ?>
    
    <?php if($args['show_image']==true && $quicklink_media_id > 0): ?>
      <?php if(!empty($quicklink_url)) : ?>
        <?php    
        // get host name from URL
        preg_match('@^(?:http://)?([^/]+)@i', $quicklink_url, $results);
        $same_domain = true;
        if(count($results) > 0) :
          $same_domain = ($results[1] == home_url());
        endif;
        ?>    
        <a href="<?php echo $quicklink_url; ?>" title="Click to view page" <?echo $same_domain ? '' : 'target="_blank"'; ?>>
      <?php endif;?>
      <?php 
        echo wp_get_attachment_image( $quicklink_media_id
                ,'full'
                ,false
                ,array('width' => '209', 'height' => '116', 'alt' => $title, 'title' => $title));
      ?>
      <?php if(!empty($quicklink_url)) : ?>
        </a>
      <?php endif;?>
    <?php endif;?>
    
    <?php if(!$args['hide_title'] && !empty($title) && $args['title_bottom']) : ?>
    
    <?php echo $before_title; ?>
     <?php if(!empty($quicklink_url)) : ?>
        <a href="<?php echo $quicklink_url; ?>" title="Click to view page" <?echo $same_domain ? '' : 'target="_blank"'; ?>>
      <?php endif;?>
          
      <?php echo $title; ?>
          
      <?php if(!empty($quicklink_url)) : ?>
        </a>
      <?php endif;?>
    <?php echo $after_title; ?>
    
    <?php endif; ?>

    
    <?php if(!empty($quicklink_text)) : ?>
    <div class="text overlay">
      <p><?php echo $quicklink_text; ?></p>
    </div>
    <?php endif; ?>
      
    <?php if(!$args['hide_readmore'] && !empty($quicklink_url)) : ?>
      <p class="readmore-wrapper">
       <a class="readmore" href="<?php echo $quicklink_url; ?>" title="Click to view page">Read More</a>
      </p>
    <?php endif; ?>

      <?php echo $after_widget; ?>
      


      
      <?php


	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
    $instance['quicklink_url'] = strip_tags($new_instance['quicklink_url']);
		$instance['quicklink_text'] = strip_tags($new_instance['quicklink_text'],'<span><br><strong>');
    $instance['quicklink_media_id'] = (int) $new_instance['quicklink_media_id'];
    
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
    
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
    
    if ( isset( $instance[ 'quicklink_media_id' ] ) ) {
			$quicklink_media_id = $instance[ 'quicklink_media_id' ];
		}
		else {
			$quicklink_media_id = __( '0', 'text_domain' );
		}
    
		if ( isset( $instance[ 'quicklink_url' ] ) ) {
			$quicklink_url = $instance[ 'quicklink_url' ];
		}
		else {
			$quicklink_url = __( '', 'text_domain' );
		}

		if ( isset( $instance[ 'quicklink_text' ] ) ) {
			$quicklink_text = $instance[ 'quicklink_text' ];
		}
		else {
			$quicklink_text = __( '', 'text_domain' );
		}

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
    <p>
		<label for="<?php echo $this->get_field_id( 'quicklink_media_id' ); ?>"><?php _e( 'Media ID:' ); ?></label> 
		<input class="narrowfat" id="<?php echo $this->get_field_id( 'quicklink_media_id' ); ?>" name="<?php echo $this->get_field_name( 'quicklink_media_id' ); ?>" type="text" value="<?php echo esc_attr( $quicklink_media_id ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'quicklink_url' ); ?>"><?php _e( 'URL:' ); ?></label> 
		<input class="narrowfat" id="<?php echo $this->get_field_id( 'quicklink_url' ); ?>" name="<?php echo $this->get_field_name( 'quicklink_url' ); ?>" type="text" value="<?php echo esc_attr( $quicklink_url ); ?>" />
		</p>    
		<p>
		<label for="<?php echo $this->get_field_id( 'quicklink_text' ); ?>"><?php _e( 'Text:' ); ?></label> 
    <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'quicklink_text' ); ?>" name="<?php echo $this->get_field_name( 'quicklink_text' ); ?>" type="text"><?php echo strip_tags($quicklink_text,'<span><br><strong>'); ?></textarea>
		</p>
		<?php 
	}
}

/****** end of mgpe_Quicklink_Widget *****/

/**
 * Makes a custom Widget for displaying NextGen Gallery Quicklink
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */
class mgpe_nggWidget_Quicklink extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'mgpe_ngg_quicklink', // Base ID
			'mgpe NextGEN Gallery Quicklink', // Name
			array( 'description' => __( 'NextGen Gallery preview image with text overlay and link to gallery', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$title = apply_filters( 'widget_title', $instance['title'] );
    
    $sidebars = wp_get_sidebars_widgets();
    $last_widget_id = array_pop($sidebars[$args['id']]); // get 
    $class_last = ($args['widget_id'] == $last_widget_id) ? ' last' : '';
    $before_widget_mod = substr($before_widget, 0, strrpos($before_widget, '">')).$class_last.'">';
    
    if ( ! isset( $instance['quicklink_gallery_id'] ) )
			$instance['quicklink_gallery_id'] = '0';
		if ( ! $quicklink_gallery_id = absint( $instance['quicklink_gallery_id'] ) )
 			$quicklink_gallery_id = 0;
    
    if ( ! isset( $instance['quicklink_text'] ) )
			$instance['quicklink_text'] = '';
		$quicklink_text = trim($instance['quicklink_text']);
    
      ?>

    <?php echo $before_widget_mod; ?>
    <?php if(!$args['hide_title'] && !empty($title)) : ?>
      <?php echo $before_title.$title.$after_title; ?>
    <?php endif; ?>
    
    <?php if($quicklink_gallery_id > 0): ?>
      <?php 
      
      // get image gallery
      $gallery = nggdb::find_gallery($quicklink_gallery_id);

        if($gallery):
          $out = nggCreateAlbum( array($gallery->gid), 'widget'); // dynamically create an album with current gallery
          ?>
            <?php echo $out; ?>
            
            <?php if(!empty($quicklink_text)) : ?>
              <div class="overlay"><p><?php echo $quicklink_text; ?></p></div>
            <?php endif; ?>
              
        <?php
        else :  ?> 
            <strong><?php echo _e('Image gallery not found','mgpe');  ?></strong>
     <?php endif; //$gallery  ?> 
          
     <?php endif;?>

      <?php echo $after_widget; ?>
      
<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['quicklink_text'] = strip_tags($new_instance['quicklink_text'],'<span><br><strong>');
    $instance['quicklink_gallery_id'] = (int) $new_instance['quicklink_gallery_id'];
    
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
    
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
    
    if ( isset( $instance[ 'quicklink_gallery_id' ] ) ) {
			$quicklink_gallery_id = $instance[ 'quicklink_gallery_id' ];
		}
		else {
			$quicklink_gallery_id = __( '0', 'text_domain' );
		}

		if ( isset( $instance[ 'quicklink_text' ] ) ) {
			$quicklink_text = $instance[ 'quicklink_text' ];
		}
		else {
			$quicklink_text = __( '', 'text_domain' );
		}

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
    <p>
		<label for="<?php echo $this->get_field_id( 'quicklink_gallery_id' ); ?>"><?php _e( 'Gallery ID:' ); ?></label> 
		<input class="narrowfat" id="<?php echo $this->get_field_id( 'quicklink_gallery_id' ); ?>" name="<?php echo $this->get_field_name( 'quicklink_gallery_id' ); ?>" type="text" value="<?php echo esc_attr( $quicklink_gallery_id ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'quicklink_text' ); ?>"><?php _e( 'Text:' ); ?></label> 
    <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'quicklink_text' ); ?>" name="<?php echo $this->get_field_name( 'quicklink_text' ); ?>" type="text"><?php echo $quicklink_text; ?></textarea>
		</p>
		<?php 
	}
}

/****** end of mgpe_nggWidget_Quicklink *****/

/**
 * mgpe Admin Menu widget class
 *
 * @since 3.0.0
 */
 class mgpe_Admin_Menu_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Use this widget to display custom menu for admin.') );
		parent::__construct( 'mgpe_admin_menu', __('mgpe Admin Menu'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
    $nav_menu_auth = ! empty( $instance['nav_menu_auth'] ) ? wp_get_nav_menu_object( $instance['nav_menu_auth'] ) : false;

		if ( !$nav_menu_auth)
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    $user = wp_get_current_user();
    if ( is_user_logged_in() && in_array($instance['nav_menu_role'], $user->roles))
    {
		echo $args['before_widget'];
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
      wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu_auth ) );
      
		echo $args['after_widget'];
    }
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
                $instance['nav_menu_auth'] = (int) $new_instance['nav_menu_auth'];
                $instance['nav_menu_role'] = $new_instance['nav_menu_role'];
		return $instance;
	}

	function form( $instance ) {
            global $wp_roles;
            
            $title = isset( $instance['title'] ) ? $instance['title'] : '';
            $nav_menu_auth = isset( $instance['nav_menu_auth'] ) ? $instance['nav_menu_auth'] : '';
            $nav_menu_role = isset( $instance['nav_menu_role'] ) ? $instance['nav_menu_role'] : '';

            // Get menus
            $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
            $roles = $wp_roles->roles;

            // If no menus exists, direct the user to go and create some.
            if ( !$menus ) {
                    echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
                    return;
            }
            ?>
            <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
            </p>
            <p>
                    <label for="<?php echo $this->get_field_id('nav_menu_auth'); ?>"><?php _e('Select Menu (Logged-in):'); ?></label>
                    <select id="<?php echo $this->get_field_id('nav_menu_auth'); ?>" name="<?php echo $this->get_field_name('nav_menu_auth'); ?>">
            <?php
                    foreach ( $menus as $menu ) {
                            $selected = $nav_menu_auth == $menu->term_id ? ' selected="selected"' : '';
                            echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
                    }
            ?>
                    </select>
            </p>
            <p>
                    <label for="<?php echo $this->get_field_id('nav_menu_role'); ?>"><?php _e('Select Role (Logged-in):'); ?></label>
                    <select id="<?php echo $this->get_field_id('nav_menu_role'); ?>" name="<?php echo $this->get_field_name('nav_menu_role'); ?>">
            <?php
                    foreach ( $roles as $key => $role ) {
                            $selected = $nav_menu_role == $key ? ' selected="selected"' : '';
                            echo '<option'. $selected .' value="'. $key .'">'. $role['name'] .'</option>';
                    }
            ?>
                    </select>
            </p>
            <?php
	}
}
/*** end of mgpe Admin Menu widget class ***/
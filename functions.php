<?php
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );


//* We tell the name of our child theme
define( 'SkepticalBlue', __( 'Genesis Child', 'genesischild' ) );
//* We tell the web address of our child theme (More info & demo)
define( 'Child_Theme_Url', 'http://gsquaredstudios.com' );
//* We tell the version of our child theme
define( 'Child_Theme_Version', '1.0' );

//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header
 
add_theme_support( 'genesis-custom-header', array(
 
'width' => 500,
 
'height' => 120
 
) );

function wpstudio_load_scripts_frontpage() {
    wp_enqueue_script( 'mansonry-init',  get_stylesheet_directory_uri() . '/js/init-masonry.min.js', array('jquery'),null, true );
    wp_enqueue_script( 'jquery-masonry', get_stylesheet_directory_uri() . '/js/masonry.pkgd.js', array('jquery'), true );
    wp_enqueue_script( 'jquery-isotope', get_stylesheet_directory_uri() . '/js/jquery/isotope.pkgd.min.js', array('jquery')
    	, true );
    wp_enqueue_script( 'masonry-reload', get_stylesheet_directory_uri() . '/js/masonry-reload.js');
    wp_enqueue_script( 'cursor-at-end', get_stylesheet_directory_uri() . '/js/cursor-at-end.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'wpstudio_load_scripts_frontpage');

// Add custom post class to posts
// add_filter('post_class', 'wpstudio_custom_post_class');
// function wpstudio_custom_post_class($classes) {
//   $new_class = 'brick';
//   $classes[] = esc_attr(sanitize_html_class($new_class));

//   return $classes;
// }

// // Register responsive menu script
// add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );
// /**
//  * Enqueue responsive javascript
//  * @author Ozzy Rodriguez
//  * @todo Change 'prefix' to your theme's prefix
//  */
// function prefix_enqueue_scripts() {
// 	wp_enqueue_script( 'skepticalblue-responsive-menu', get_stylesheet_directory_uri() . '/lib/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true ); // Change 'prefix' to your theme's prefix
// }

// remove_action( 'genesis_header_right', 'genesis_do_nav' );
// add_action( 'genesis_header', 'genesis_do_nav' );


remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'genesis_site_title', 'child_seo_site_title' );
/**
 * Remove title, add img to title.
 *
 */
function child_seo_site_title() { 

	echo '<a href="/"><img id="title-img" src="' . get_stylesheet_directory_uri() . '/img/TSL-eyes.png"><h1 class="site-title">The Skeptical Libertarian</h1></a>';

}






//* Add Font Awesome Support
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
}



/**********************************
 *
 * Enqueue Style and Scripts for Mmenu.
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com
 *
 **********************************/
add_action( 'wp_enqueue_scripts', 'skepticalblue_load_scripts');
function skepticalblue_load_scripts() {
 // CSS
 wp_enqueue_style( 'skepticalblue_mmenu_css' , CHILD_URL . '/css/jquery.mmenu.css' , null );
 // JS
 wp_enqueue_script( 'skepticalblue_mmenu_js' , CHILD_URL . '/js/jquery.mmenu.min.js' , array( 'jquery' ), '4.2.6', FALSE ); // mmenu js
 wp_enqueue_script( 'skepticalblue_headerscript_js' , CHILD_URL . '/js/headerscript.js' , array( 'jquery' ), '1.0', FALSE ); // custom header j
 wp_enqueue_script( 'skepticalblue_headerscript_js' , CHILD_URL . '/js/jquery.mmenu.wordpress.min.js' , array( 'jquery' ), '1.0', FALSE );
 wp_enqueue_script( 'skepticalblue_replacetext_js' , CHILD_URL . '/js/replace-text-threesixty.js' , array( 'jquery' ), '1.0', FALSE ); 
 wp_enqueue_script( 'skepticalblue_masonry_js' , CHILD_URL . '/js/masonry-options.js' , array( 'jquery' ), '1.0', FALSE ); 
}

if (! function_exists('slug_scripts_masonry') ) :
if ( ! is_admin() ) :
function slug_scripts_masonry() {
    wp_enqueue_script('masonry');
    wp_enqueue_style('masonry’, get_template_directory_uri().'/css/’);
}
add_action( 'wp_enqueue_scripts', 'slug_scripts_masonry' );
endif; //! is_admin()
endif; //! slug_scripts_masonry exists

if ( ! function_exists( 'slug_masonry_init' )) :
function slug_masonry_init() { ?>
<script>
    //set the container that Masonry will be inside of in a var
    var container = document.querySelector('#masonry-loop');
    //create empty var msnry
    var msnry;
    // initialize Masonry after all images have loaded
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: '.masonry-entry'
        });
    });
</script>
<?php }
//add to wp_footer
add_action( 'wp_footer', 'slug_masonry_init' );
endif; // ! slug_masonry_init exists

/**********************************
 *
 * Add id="menu" attribute to Primary Navigation
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com
 *
 **********************************/
add_filter( 'genesis_attr_nav-primary', 'skepticalblue_primary_nav_id' );
function skepticalblue_primary_nav_id( $attributes ) {
 $attributes['id'] = 'menu';
 return $attributes;
}


/**********************************
 *
 * Add menu control for Mmenu
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com
 *
 **********************************/
/* Navigation functions */
add_action( 'genesis_before', 'skepticalblue_nav_control', 1 );
function skepticalblue_nav_control() {
 ?>
 <div id="header">
 <a href="#menu">
 <i class="fa fa-bars"></i>
 </a>
 </div>
 <?php
}

//* Enqueue sticky menu script
// add_action( 'wp_enqueue_scripts', 'sp_enqueue_script' );
// function sp_enqueue_script() {
// 	wp_enqueue_script( 'sample-sticky-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-menu.js', array( 'jquery' ), '1.0.0' );
// }
// //* Reposition the secondary navigation menu
// remove_action( 'genesis_after_header', 'genesis_do_subnav' );
// add_action( 'genesis_before', 'genesis_do_subnav' );

add_action( 'wp_enqueue_scripts', 'sp_enqueue_script' );
function sp_enqueue_script() {
	wp_enqueue_script( 'sticky-header', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.sticky.js', array( 'jquery' ), '1.0.0' );
}



/* Add left-side header widget area */

genesis_register_sidebar( array(
    'id'              		=> 'header-left',
    'name'         	 	=> __( 'Header Left', 'wpsitesdotnet' ),
    'description'  	=> __( 'Header left widget area', 'wpsitesdotnet' ),
) );

add_action( 'genesis_header', 'wpsites_left_header_widget', 11 );
	function wpsites_left_header_widget() {
	if (is_active_sidebar( 'header-left' ) ) {
 	genesis_widget_area( 'header-left', array(
       'before' => '<div class="header-left widget-area">',
       'after'	 => '</div>',
		) ); 

  }

}


//* Customize search form input button text
add_filter( 'genesis_search_text', 'wpsites_icon_inside_input' );
function wpsites_icon_inside_input( $text ) {
	return esc_attr( ' ' );
}

add_filter( 'genesis_search_button_text', 'modify_search_button_text' );
function modify_search_button_text( $text ) {
	return esc_attr( 'Search' );
}



//*******************************
//*
//* Add Right Header widget content to the header
//*
//*

add_action( 'genesis_header_right', 'skepticalblue_right_widget', 1);
function skepticalblue_right_widget() {
	?>
	<div id="right-header-widget">
		<a href="http://twitter.com/skepticallibertarian"><span id="social-twitter" class="fa fa-twitter"></span></a>
		<a href="http://facebook.com/skepticallibertarian"><span id="social-facebook" class="fa fa-facebook"></span></a>
		<button id="support-us-button" type="button" data-toggle="modal" data-target="#SupportUs"><span style="text-align:center !important" class="fa fa-heart"></span></button>
	</div>
	<?php 
}

//*******************************
//*
//* Add "Support Us" modal to the page
//*
//*

add_action( 'genesis_before', 'sb_add_modal', 1);
function sb_add_modal() {
	?>
	<!-- Modal -->
		<div id="SupportUs" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">TSL is a Labor of Love. And Coffee. But we repeat ourselves.</h4>
		        <p>If you enjoy what we do and want to help keep us going, please consider buying us a cup of liquid awakeness.</p>
		      </div>
		      <div class="modal-body">
		        <?php
		        	echo do_shortcode('[paypal_button]');
		        	echo do_shortcode('[coinbase_button]');
		        	echo do_shortcode('[amazon_button]');
		        	echo do_shortcode('[swag_button]');
		        ?>
		      </div>
		      <div class="modal-footer">
		      </div>
		    </div>

		  </div>
		</div>
		<?php
	}


// //* Remove the post format image (requires HTML5 theme support)
if (is_home() || is_archive()) {
	remove_action('genesis_entry_header','genesis_do_post_title');
	add_action('genesis_entry_content','genesis_do_post_title');
	remove_action('genesis_entry_header','genesis_post_info',12);
	add_action('genesis_entry_content','genesis_post_info');
}

add_action('genesis_before_entry_content','sb_add_entry_div');
function sb_add_entry_div() {
	echo '<div class="entry-wrap-div"></div>';
}
// add_action('genesis_after_entry_content','sb_close_entry_div');
function sb_close_entry_div() {
	echo '</div>';
}

remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
// add_action( 'genesis_before_entry_content', 'genesis_do_post_image', 8 );


add_filter('genesis_attr_entry', 'sb_add_feat_image');
function sb_add_feat_image($attributes, $context) {
	if (has_post_thumbnail($post->ID) && !is_single()) {
		$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$attributes['style'] = "background: radial-gradient(circle at top left, rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url({$image})";
		return $attributes;
	}

	return $attributes;
}



// add_action('genesis_after_entry', 'sb_add_section_title');
// function sb_add_section_title() {
// 	global $loop_counter;
// 	$loop_counter++;
// 	if(is_home() && $loop_counter == 1) {
// 		echo '<div id="recent-posts-header">
// 				<h1 class="content-header">Recent Posts</h1>
// 				<div class="content-subhead">
// 					<p class="content-desc">Our latest and greatest original posts.</p>
// 					<a href="#"><p class="content-all">View All</p></a>
// 				</div>
// 			  </div>';
// 	}
// }

add_action('genesis_before_loop', 'sb_add_recent_posts');
function sb_add_recent_posts() {
	if( is_home() ) {
		echo '<div id="recent-posts-header">
					<h1 class="content-header">Recent Posts</h1>
						<table class="content-subhead">
							<tr>
								<td>
									<p class="content-desc">Our latest and greatest original posts.</p>
								</td>
								<td>
									<a href="/blog"><p class="content-all">View&nbsp;All</p></a>
								</td>
						</table>
				  </div>';
		}
}


function fb_opengraph() {
    global $post;
 
    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } 
        else {
            $img_src = get_stylesheet_directory_uri() . '/img/TSL-eyes-large.png';
        }
        
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } 
        else {
            $excerpt = get_bloginfo('description');
        }
        $title = get_the_title();
        $link = get_the_permalink();
    }
    elseif (is_home()) {
    	$img_src = get_stylesheet_directory_uri() . '/img/TSL-eyes-large.png';
    	$excerpt = "Free thought. Free people.";
    	$title = "The Skeptical Libertarian | Home";
    	$link = "http://blog.skepticallibertarian.com/";
    }
    else {
    	$img_src = get_stylesheet_directory_uri() . '/img/TSL-eyes-large.png';
    	$excerpt = "Free thought. Free people.";
    	$title = get_the_title();
    	$link = get_the_permalink();
    }
        ?>
 
    <meta property="og:title" content="<?php echo $title ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo $link ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
<?php
}
add_action('wp_head', 'fb_opengraph', 5);

function jeherve_custom_image( $media, $post_id, $args ) {
    if ( $media ) {
        return $media;
    } else {
        $permalink = get_permalink( $post_id );
        $url = apply_filters( 'jetpack_photon_url', get_stylesheet_directory_uri() . '/img/TSL-eyes-large.png' );
     
        return array( array(
            'type'  => 'image',
            'from'  => 'custom_fallback',
            'src'   => esc_url( $url ),
            'href'  => $permalink,
        ) );
    }
}
add_filter( 'jetpack_images_get_images', 'jeherve_custom_image', 10, 3 );
add_filter( 'jetpack_enable_open_graph', '__return_false' );

//* Customize the post meta function
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_meta_filter($post_meta) {
if ( !is_page() ) {
	$post_meta = '[post_tags before="" sep=""]';
	return $post_meta;
}}



//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '[...] <p><a class="more-link" href="' . get_permalink() . '">Read more »</a></p>';
}




// SIDEBARS!!!
//-----------------------

//* Add featured post image size
add_image_size( 'featured-image-hardcrop', 1200, 400, true );

// Register a new sidebar
genesis_register_sidebar( array(
	'id' => 'home-sidebar',
	'name' => 'Home Sidebar',
	'description' => 'This is the home sidebar widget area.'
	));


add_action( 'get_header', 'child_sidebar_logic' );
/**
 * Add Home Sidebar
 * 
 * @author Brian Lis
 * @link http://dev.studiopress.com/add-unique-sidebar-to-home-page.htm
 */
function child_sidebar_logic() {
    
        remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
        add_action( 'genesis_after_content', 'child_get_home_sidebar' );
    
}

/**
 * Retrieve our unique home page sidebar.
 */
function child_get_home_sidebar() {
	if( is_home() ) {
    	get_sidebar( 'home' );
    }
}


// Register a new sidebar
genesis_register_sidebar( array(
	'id' => 'email-sidebar',
	'name' => 'Email Sidebar',
	'description' => 'This is the email sidebar widget area.'
	));


add_action( 'get_header', 'email_sidebar_logic', 10 );
/**
 * Add Home Sidebar
 * 
 * @author Brian Lis
 * @link http://dev.studiopress.com/add-unique-sidebar-to-home-page.htm
 */
function email_sidebar_logic() {
    
        remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
        add_action( 'genesis_after_content', 'child_get_email_sidebar' );
    
}

/**
 * Retrieve our unique home page sidebar.
 */
function child_get_email_sidebar() {
    get_sidebar( 'email' );
}





// Register a new sidebar
genesis_register_sidebar( array(
	'id' => 'threesixty-sidebar',
	'name' => 'ThreeSixty Sidebar',
	'description' => 'This is the blog sidebar widget area.'
	));


add_action( 'get_header', 'threesixty_sidebar_logic' );
/**
 * Add Home Sidebar
 * 
 * @author Brian Lis
 * @link http://dev.studiopress.com/add-unique-sidebar-to-home-page.htm
 */
function threesixty_sidebar_logic() {
    
        remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
        add_action( 'genesis_after_content', 'child_get_threesixty_sidebar' );
    
}

/**
 * Retrieve our unique home page sidebar.
 */
function child_get_threesixty_sidebar() {
	if (is_home()) {
    	get_sidebar( 'threesixty' );
	}
}




/**
 * Register a new sidebar for Swag Area
 */
genesis_register_sidebar( array(
	'id' => 'swag-sidebar',
	'name' => 'Swag Sidebar',
	'description' => 'This is the Swag sidebar widget area.'
	));


add_action( 'get_header', 'swag_sidebar_logic' );
function swag_sidebar_logic() {
    
        remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
        add_action( 'genesis_after_content', 'child_get_swag_sidebar' );
    
}

/**
 * Retrieve our unique home page sidebar.
 */
function child_get_swag_sidebar() {
	if (is_home()){
    	get_sidebar( 'swag' );
    }
}


//* Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'author_box_gravatar_size' );
function author_box_gravatar_size( $size ) {
	return '300';
}

//* Customize the author box title
add_filter( 'genesis_author_box_title', 'custom_author_box_title' );
function custom_author_box_title() {
	return get_the_author();
	
}


/**
 * Remove pagination, add custom "Read More" link
 */
// remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );




include('lib/php/donate_buttons.php');



// Returns list of contributors
function contributors() {
	global $wpdb;
	$args = array();
	$args['fields'] = array( 'ID', 'display_name' );
	$args['meta_key'] = 'contributor';
	$args['meta_value'] = 'yes';
	$authors= get_users( $args );

	echo '<div id="contributors-box-wrapper">';
	echo '<div id="contributors-box">';
	echo '<div id="contributors-title">';
	echo '<h4 id="contributors-header">Contributing Editors</h4>';
	echo '</div>';
	echo '<div id="contributors-content">';
	 
	foreach($authors as $author) {

		echo "<li>";
		echo '<div class="author-img">';
		echo "<a href=\"";
		echo get_author_posts_url($author->ID);
		echo "\">";
		
		if (userphoto_exists($author->ID)) {
			echo userphoto($author);
		}
		elseif (validate_gravatar($author->user_email)) {
			echo get_avatar($author->ID, 200, 'blank');
		}
		
		echo "</a>";
		echo '</div>';
		
		echo '<div>';
		echo "<a href=\"";
		echo get_author_posts_url($author->ID);
		echo "\">";
		echo '<h4 class="contributor-name">';
		the_author_meta('display_name', $author->ID);
		echo '</h4>';
		if( get_the_author_meta('university', $author->ID) != '') {
			echo '<h5>';
			the_author_meta('university', $author->ID);
			echo '</h5>';
		}
		echo "</a>";


		echo "</div>";
		echo "</li>";
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';

}

add_shortcode('contributors', 'contributors');

function editors() {

	global $wpdb;
	$args = array();
	$args['fields'] = array( 'ID', 'display_name' );
	$args['meta_key'] = 'editor';
	$args['meta_value'] = 'yes';
	$editors= get_users($args);

	echo '<div id="editors-box-wrapper">';
	echo '<div id="editors-box">';
	// echo '<div id="editors-title">';
	// echo '<h4 id="editors-header">Senior Editors</h4>';
	// echo '</div>';
	echo '<div id="editors-content">';

	foreach($editors as $editor) {
		echo "<li>";
		echo '<div class="editor-img">';
		echo "<a href=\"";
		echo get_author_posts_url($editor->ID);
		echo "\">";
		if (userphoto_exists($editor->ID)) {
			echo userphoto($editor);
		}
		elseif (validate_gravatar($editor->user_email)) {
			echo get_avatar($editor->ID, 300, 'blank');
		}
		echo "</a>";
		echo '</div>';
		echo '<div>';
		echo '<h2 class="editor-name">';
		echo "<a href=\"";
		echo get_author_posts_url($editor->ID);
		echo "\">";
		the_author_meta('display_name', $editor->ID);
		echo '</h2>';
		if( get_the_author_meta('university', $editor->ID) != '') {
			echo '<h5 class="editor-university">';
			the_author_meta('university', $editor->ID);
			echo '</h5>';
		}
		echo "</a>";
		echo '<div class="contact-links"><ul class="social-links">';
 

		if ( get_the_author_meta( 'twitter', $editor->ID ) != '' ) {
			echo '<li><a href="http://twitter.com/';
			echo get_the_author_meta( 'twitter', $editor->ID ); 
			echo '"><i class="fa fa-twitter"></i></a></li>';
		}

		if ( get_the_author_meta( 'facebook', $editor->ID ) != '' ) {
			echo '<li><a href="http://';
			echo get_the_author_meta( 'facebook', $editor->ID ); 
			echo '"><i class="fa fa-facebook"></i></a></li>';
		}

		if ( get_the_author_meta( 'website', $editor->ID ) != '' ) {
			echo '<li><a href="http://';
			echo get_the_author_meta( 'website', $editor->ID ); 
			echo '"><i class="fa fa-laptop"></i></a></li>';
		}

		if ( get_the_author_meta( 'public_email', $editor->ID ) != '' ) {
			echo '<li><a href="mailto:';
			echo get_the_author_meta( 'public_email', $editor->ID ); 
			echo '"><i class="fa fa-envelope-o"></i></a></li>';
		}

		echo '</ul></div>';
		echo "</div>";
		echo "</li>";
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';

}
add_shortcode('editors', 'editors');


function special_thanks() {

	global $wpdb;
	$args = array();
	$args['fields'] = array( 'ID', 'display_name' );
	$args['meta_key'] = 'special_thanks';
	$args['meta_value'] = 'yes';
	$specials = get_users($args);

	echo '<div id="specialthanks-box-wrapper">';
	echo '<div id="specialthanks-box">';
	echo '<div id="specialthanks-title">';
	echo '<h4 id="specialthanks-header">Special Thanks</h4>';
	echo '</div>';
	echo '<div id="specialthanks-content">';

	foreach($specials as $special) {
		echo "<li>";
		echo '<div class="editor-img">';
		echo "<a href=\"";
		echo get_author_posts_url($special->ID);
		echo "\">";
		if (userphoto_exists($special->ID)) {
			echo userphoto($special);
		}
		elseif (validate_gravatar($special->user_email)) {
			echo get_avatar($special->ID, 120, 'blank');
		}
		echo "</a>";
		echo '</div>';
		echo '<div>';
		echo "<a href=\"";
		echo get_author_posts_url($special->ID);
		echo "\">";
		echo '<h4 class="specialthanks-name">';
		the_author_meta('display_name', $special->ID);
		echo '</h4>';
		echo '<h5>';
		the_author_meta('university', $special->ID);
		echo '</h5>';
		echo "</a>";
		echo '<div id="special-thanks-reason">';
		echo get_the_author_meta('special_thanks_reason', $special->ID);

		echo '</div>';

		echo '<div class="contact-links"><ul class="social-links">';
 

		if ( get_the_author_meta( 'twitter', $special->ID ) != '' ) {
			echo '<li><a href="http://twitter.com/';
			echo get_the_author_meta( 'twitter', $special->ID ); 
			echo '"><i class="fa fa-twitter"></i></a></li>';
		}

		if ( get_the_author_meta( 'facebook', $special->ID ) != '' ) {
			echo '<li><a href="http://';
			echo get_the_author_meta( 'facebook', $special->ID ); 
			echo '"><i class="fa fa-facebook"></i></a></li>';
		}

		if ( get_the_author_meta( 'website', $special->ID ) != '' ) {
			echo '<li><a href="http://';
			echo get_the_author_meta( 'website', $special->ID ); 
			echo '"><i class="fa fa-laptop"></i></a></li>';
		}

		if ( get_the_author_meta( 'email', $special->ID ) != '' ) {
			echo '<li><a href="mailto:';
			echo get_the_author_meta( 'email', $special->ID ); 
			echo '"><i class="fa fa-envelope-o"></i></a></li>';
		}

		echo '</ul></div>';

		echo "</div>";
		echo "</li>";
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';

}
add_shortcode('special_thanks', 'special_thanks');


//* Adding additional social media stuff to the Author box

function sb_modify_user_contact_methods( $user_contact ){
 /* Add user contact methods */
 $user_contact['twitter'] = __( 'Twitter Handle (no @)' );
 $user_contact['facebook'] = __( 'Facebook URL' );
 $user_contact['public_email'] = __( 'Public Email' );

 /* Remove user contact methods */
 unset($user_contact['aim']);
 unset($user_contact['jabber']);
 unset($user_contact['yim']);
 return $user_contact;
 
}
add_filter( 'user_contactmethods', 'sb_modify_user_contact_methods' );


add_action( 'show_user_profile', 'sb_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'sb_show_extra_profile_fields' );

function sb_show_extra_profile_fields( $user ) { ?>

	<h3>Associations & Short Details</h3>

	<table class="form-table">

		<tr>
			<th><label for="university">Univeristy or Employer</label></th>

			<td>
				<input type="text" name="university" id="university" value="<?php echo esc_attr( get_the_author_meta( 'university', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your University or Employer.</span>
			</td>
		</tr>
		<tr>
			<th><label for="specialization">Specialization, Major or Job Title</label></th>

			<td>
				<input type="text" name="specialization" id="specialization" value="<?php echo esc_attr( get_the_author_meta( 'specialization', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Specialization or Major.</span>
			</td>


		</tr>

	</table>

	<h3>Special Thanks & Assorted Meta Settings</h3>

	<table class="form-table">

		<tr>
			<th><label for="special-thanks">Include in Special Thanks?</label></th>

			<td>
				<input type="checkbox" name="special_thanks" id=" special_thanks " value="yes" <?php if (esc_attr( get_the_author_meta( "special_thanks", $user->ID )) == "yes") echo "checked"; ?> /><span class="description"><?php _e("Check box if user should be included in Special Thanks section of Contributors page."); ?></span><br />

			</td>
			<td>
				<input type="text" name="special_thanks_reason" id="special-thanks-reason" value="<?php echo esc_attr( get_the_author_meta( 'special_thanks_reason', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">What for?</span>
			</td>
		</tr>
		<tr>
			<th><label for="contributor">Editor?</label></th>

			<td>
				<input type="checkbox" name="editor" id=" editor " value="yes" <?php if (esc_attr( get_the_author_meta( "editor", $user->ID )) == "yes") echo "checked"; ?> /><span class="description"><?php _e("Check box if user should be included under Senior Editors."); ?></span><br />

			</td>
		</tr>
		<tr>
			<th><label for="contributor">Contributor?</label></th>

			<td>
				<input type="checkbox" name="contributor" id=" contributor " value="yes" <?php if (esc_attr( get_the_author_meta( "contributor", $user->ID )) == "yes") echo "checked"; ?> /><span class="description"><?php _e("Check box if user should be included under Contributors."); ?></span><br />

			</td>
		</tr>
	</table>
	<?php
}

add_action( 'personal_options_update', 'sb_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'sb_save_extra_profile_fields' );

function sb_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'university', $_POST['university'] );
	update_usermeta( $user_id, 'specialization', $_POST['specialization'] );
	update_usermeta( $user_id, 'special_thanks', $_POST['special_thanks'] );
	update_usermeta( $user_id, 'special_thanks_reason', $_POST['special_thanks_reason'] );
	update_usermeta( $user_id, 'contributor', $_POST['contributor'] );
	update_usermeta( $user_id, 'editor', $_POST['editor'] );
}


function validate_gravatar($email) {
	// Craft a potential url and test its headers
	$hash = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
	$headers = @get_headers($uri);
	if (!preg_match("|200|", $headers[0])) {
		$has_valid_avatar = FALSE;
	} else {
		$has_valid_avatar = TRUE;
	}
	return $has_valid_avatar;
}


function validate_gravatar_alt($email) {
	if (get_avatar($email, 96, 404) != null) {
		return TRUE;
	}
	else {
		return FALSE;
	}

}

function sb_alt_author_box() {
	$user = get_the_author_id();
	$email = get_the_author_meta($user_email, $user);
	$attributes = array('class' => 'avatar-400', 'width' => '200');

 ?>
	<div id="author-box-wrapper">
		<div class="author-box">
			<div class="author-box-img"> <?php
				if(userphoto_exists($user))
				    userphoto($user, '', '', $attributes );
				else
				    echo get_avatar($user, 200);
				?></div>
			<div class="about-author">
				<h4><?php echo get_the_author(); ?></h4>
				<?php
				if ( get_the_author_meta('specialization') != '') { ?>
					<h5><?php echo get_the_author_meta('specialization'); echo ', '; echo get_the_author_meta('university'); ?></h5>
					<?php } ?>
				<p><?php echo get_the_author_meta( 'description' ); ?> 
			</div>
			<div class="contact-links">

				<ul class="social-links">
 
				 <?php if ( get_the_author_meta( 'facebook' ) != '' ): ?>
				 <li><a href="<?php echo get_the_author_meta( 'facebook' ); ?>"><i class="fa fa-facebook"></i></a></li>
				 <?php endif; ?>
				 
				 <?php if ( get_the_author_meta( 'twitter' ) != '' ): ?>
				 <li><a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>"><i class="fa fa-twitter"></i></a></li>
				 <?php endif; ?>
				 
				 <?php if ( get_the_author_meta( 'googleplus' ) != '' ): ?>
				 <li><a href="<?php echo get_the_author_meta( 'googleplus' ); ?>"><i class="fa fa-google-plus"></i></a></li>
				 <?php endif; ?>
				 
				 <?php if ( get_the_author_meta( 'github' ) != '' ): ?>
				 <li><a href="<?php echo get_the_author_meta( 'github' ); ?>"><i class="fa fa-github"></i></a></li>
				 <?php endif; ?>
				 
				 <?php if ( get_the_author_meta( 'public_email' ) != '' ): ?>
				 <li><a href="mailto:<?php echo get_the_author_meta( 'public_email' ); ?>"><i class="fa fa-envelope-o"></i></a></li>
				 <?php endif; ?>
				 
				 <?php if ( get_the_author_meta( 'user_url' ) != '' ): ?>
				 <li><a href="<?php echo get_the_author_meta( 'user_url' ); ?>"><i class="fa fa-laptop"></i> </a></li>
				 <?php endif; ?>
				 
				</ul>

				<?php if (is_single()) { ?>
					<a id="view-all-posts" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">View all posts by <?php echo get_the_author(); ?></a> 
				<?php }
				?>

			</div>
		</div>
	</div>
	<?php


}

function sb_alt_author_box_single() {
 if( is_single()) {
 	sb_alt_author_box();
 }
}

function sb_alt_author_box_archive() {
 if( is_archive()) {
 	sb_alt_author_box();
 }
}

remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive' );
add_action( 'genesis_after_content', 'sb_alt_author_box_single' ); //change hook for position
add_action('genesis_before_content', 'sb_alt_author_box_archive');






//* Change the footer text
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; <a href="http://www.skepticallibertarian.com">The Skeptical Libertarian</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a> by <a href="mailto:ellie.bartling@yahoo.com">Ellie Bartling</a>';
	return $creds;
}


function remove_featured_image_archives( $post ) {
  if( !has_post_thumbnail() )
		$post = '';
	return $post;
}
add_filter( 'genesis_pre_get_image', 'remove_featured_image_archives', 10, 3 );



// // Remove Genesis Author Box and load our own
// remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );
// add_action( 'genesis_after_post', 'be_author_box' );

// /**
//  * Load Author Boxes
//  *
//  * @author Bill Erickson
//  * @link http://www.billerickson.net/wordpress-post-multiple-authors/
//  */
// function be_author_box() {

// 	if( !is_single() )
// 		return;

// 	if( function_exists( 'get_coauthors' ) ) {
		
// 		$authors = get_coauthors();
// 		foreach( $authors as $author )
// 			be_do_author_box( $author->data->ID );
			
// 	} else {
// 		be_do_author_box( get_the_author_ID() );	
// 	}
// }

// /**
//  * Display Author Box
//  * Modified from Genesis to use an ID
//  *
//  * @author Bill Erickson
//  * @link http://www.billerickson.net/wordpress-post-multiple-authors/
//  */
// function be_do_author_box( $id = false ) {

// 	if( ! $id ) 
// 		return;
		
// 	$authordata    = get_userdata( $id );
// 	$gravatar_size = apply_filters( 'genesis_author_box_gravatar_size', 70, $context );
// 	$gravatar      = get_avatar( get_the_author_meta( 'email', $id ), $gravatar_size );
// 	$title         = apply_filters( 'genesis_author_box_title', sprintf( '<strong>%s %s</strong>', __( 'About', 'genesis' ), get_the_author_meta( 'display_name', $id ) ), $context );
// 	$description   = wpautop( get_the_author_meta( 'description', $id ) );

// 	/** The author box markup, contextual */
// 	$pattern = $context == 'single' ? '<div class="author-box"><div>%s %s<br />%s</div></div><!-- end .authorbox-->' : '<div class="author-box">%s<h1>%s</h1><div>%s</div></div><!-- end .authorbox-->';

// 	echo apply_filters( 'genesis_author_box', sprintf( $pattern, $gravatar, $title, $description ), $context, $pattern, $gravatar, $title, $description );
	

// }



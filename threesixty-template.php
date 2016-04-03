<?php
/*
 * Template Name: ThreeSixty Template
 */
// load_template(TEMPLATEPATH . '/page_blog.php' );

function skepticalblue_load_masonry() {
    wp_enqueue_script( 'mansonry-init',  get_stylesheet_directory_uri() . '/js/init-masonry.min.js', array('jquery'),null, true );
    wp_enqueue_script( 'jquery-masonry', get_stylesheet_directory_uri() . '/js/masonry.pkgd.js', array('jquery'), true );
    wp_enqueue_script( 'masonry-reload', get_stylesheet_directory_uri() . '/js/masonry-reload.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'skepticalblue_load_masonry');


//* Modify the length of post excerpts
add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 50; // pull first 50 words
}


// // Add custom post class to posts
// add_filter('post_class', 'wpstudio_custom_post_class');
// function wpstudio_custom_post_class($classes) {
//   $new_class = 'brick';
//   $classes[] = esc_attr(sanitize_html_class($new_class));

//   return $classes;
// }

// add_action('genesis_before_loop', 'add_blog_title');
// function add_blog_title() {
// 	echo '<div id="blog-title"><h1>The Skeptical Libertarian: Archive</h1></div>';
// }

// remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
// add_action('genesis_after_loop', 'genesis_posts_nav');




remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_loop' ); // Add custom loop
 
function custom_do_loop() {
 
  // Intro Text (from page content)
	echo '<div class="archive-description">';
	echo '<h1 class="archive-title" style="text-align:center;">TSL360 Archive</h1>';
	echo '</div>';
 
global $post;
 
	// arguments, adjust as needed
	$args = wp_parse_args(
		genesis_get_custom_field( 'query_args' ),
		array(
		'post_type'      => 'post',
		'posts_per_page' => 18,
		'post_status'    => 'publish',
		// 'cat'		 	 => $include,
		'paged'          => get_query_var( 'paged' ) )
	);
 
	global $wp_query;
	$wp_query = new WP_Query( $args );

	echo '<div id="container">';
 
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 
			$time = get_the_date('F j, Y');
			$title_length = strlen(get_the_title());
			$content = get_the_content();
			$format_changed = "2015-11-23";

			if ( get_the_date('Y-m-d') > $format_changed ) {
				$snippet = substr($content, 0, strlen($content) - $title_length);
			}
			else {
				$snippet = substr($content, 0, strlen($content) - ($title_length + 4));
			}
 
			echo '<article class="post type-post status-publish format-standard entry brick masonry-brick teaser one-half">';
				echo '<header class="entry-header"></header>';
				echo '<div class="entry-content">';
				echo '<h2 class="entry-title"> <a href="' . get_permalink() .'"> '. get_the_title() .' </a> </h2>'; // show the title
				echo '<p class="entry-meta"><time class="entry-time" datetime="' . $time . '">' . $time . '</time>';
				// echo ' by ';
				// echo '<span class="entry-author" itemtype="http://schema.org/Person">' . get_the_author() . '</span>';
				echo '<a href="' . get_permalink() .'" title="' . the_title_attribute( 'echo=0' ) . '">'; // Original Grid
				echo '<p>' . $snippet . '</p>';
				echo '<p> <a class="more-link" href="' . get_permalink() .'">Read more »</a></p>';
				echo '</a>';
				echo '</div>';
				echo '<footer class="entry-footer"></footer>';
			echo '</article>';
 
		endwhile;
		echo '</div>';
		do_action( 'genesis_after_endwhile' );
	endif;
	
 
	wp_reset_query();
}

 
genesis();




?>
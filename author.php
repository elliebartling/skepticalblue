<?php

/*
  Template Name: Masonry Grid Scroll
*/

/*
 * @author  Frank Schrijvers
 * @link    https://www.wpstud.io
 */

// Enqueue scripts for masonry and infinite scroll

function skepticalblue_load_masonry() {
    wp_enqueue_script( 'mansonry-init',  get_stylesheet_directory_uri() . '/js/init-masonry.min.js', array('jquery'),null, true );
    wp_enqueue_script( 'jquery-masonry', get_stylesheet_directory_uri() . '/js/masonry.pkgd.js', array('jquery'), true );
    wp_enqueue_script( 'masonry-reload', get_stylesheet_directory_uri() . '/js/masonry-reload.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'skepticalblue_load_masonry');

// Add custom post class to posts
add_filter('post_class', 'wpstudio_custom_post_class');
function wpstudio_custom_post_class($classes) {
  $new_class = 'brick';
  $classes[] = esc_attr(sanitize_html_class($new_class));

  return $classes;
}



function skeptical_add_div() {
  echo '<div id="container" class="skeptical">';
}

function skeptical_close_div() {
  echo '</div>';
}
add_action('genesis_before_loop', 'skeptical_add_div');
add_action('genesis_after_loop', 'skeptical_close_div');


add_action( 'pre_get_posts', 'be_change_author_posts_per_page' );
/**
 * Change Posts Per Page for Event Archive
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function be_change_author_posts_per_page( $query ) {
    if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'author' ) ) {
      $query->set( 'posts_per_page', '20' );
    }
}


function filter_buttons() {
  ?>
  <div class="button-group filters-button-group">
  <button class="button is-checked" data-filter="*">show all</button>
  <button class="button is-checked" data-filter="tag-by-the-numbers">By The Numbers</button>
  </div>
  <?php
}

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action('genesis_after_loop', 'genesis_posts_nav');

genesis();





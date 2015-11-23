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





add_action( 'pre_get_posts', 'be_change_event_posts_per_page' );
/**
 * Change Posts Per Page for Event Archive
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function be_change_event_posts_per_page( $query ) {
    $query->set( 'posts_per_page', '18' );
}



function load_more() {
  if(is_author()){
      $author = get_the_author_meta('ID');
      echo do_shortcode('[ajax_load_more author="'.$author.'" post_type="post" scroll="false" images_loaded="true" button_label="More" css_classes="post content brick wp_rss_retriever_item"]');
  }
  if(is_category()){
      $cur_cat_id = get_cat_id( single_cat_title("",false) ); 
      $category = get_cat_slug($cur_cat_id);  ?>
      <h1><span>Category:</span> <?php echo single_cat_title('', false );?> </h1>
      <?php
      echo do_shortcode('[ajax_load_more category="'.$category.'"post_type="post" scroll="false" images_loaded="true" button_label="More" css_classes="post one-half teaser"]');
  }
  if(is_tag()){ ?>
      <h1><span>Tag:</span> <?php echo single_cat_title('', false );?></h1>
      <?php
      $tag = get_query_var('tag'); 
      echo do_shortcode('[ajax_load_more tag="'.$tag.'"post_type="post" scroll="false" images_loaded="true" button_label="More" css_classes="post one-half teaser"]');
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

// add_action('genesis_before_content', 'filter_buttons');

// add_action('genesis_loop','load_more');
// remove_action('genesis_loop', 'genesis_do_loop');


// remove_action( 'get_header', 'email_sidebar_logic', 10 );
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// add_action( 'pre_get_posts',  'change_number_posts_per_category'  );
// function change_number_posts_per_category( $query ) {

//     if ( is_author() ) {
//         $query->set( 'posts_per_page', 10 );

//     return $query;
// }}

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action('genesis_after_loop', 'genesis_posts_nav');

genesis();





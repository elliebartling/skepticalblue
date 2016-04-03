<?php

function sb_load_scripts_threesixty() {
    wp_enqueue_script( 'embedly-class',  get_stylesheet_directory_uri() . '/js/add-embedly-class.js', array('jquery'),null, true );
    // wp_enqueue_script( 'remove-quotes', get_stylesheet_directory_uri() . '/js/remove-quotemarks.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'sb_load_scripts_threesixty');

// if (coauthors() == "The Skeptical Libertarian") {
// 	remove_action('genesis_after_entry', 'genesis_do_author_box_single', 8);
// }



genesis();
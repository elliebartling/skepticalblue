<?php

function sb_load_scripts_threesixty() {
    wp_enqueue_script( 'embedly-class',  get_stylesheet_directory_uri() . '/js/add-embedly-class.js', array('jquery'),null, true );
}
add_action('wp_enqueue_scripts', 'sb_load_scripts_threesixty');



genesis();
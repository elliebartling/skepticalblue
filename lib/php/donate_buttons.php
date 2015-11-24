<?php

function paypal_button() {
	echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9VBJ2FDVY6FM4" target="_blank" ><button type="button" class="donation-button" id="paypal">donate with<img src="' . get_stylesheet_directory_uri() . '/img/paypal-logo.png"></button></a>';
}

add_shortcode('paypal_button', 'paypal_button');

function coinbase_button() {
	echo '<a href="https://www.coinbase.com/SkepticLiberty" target="_blank"><button type="button" class="donation-button" id="coinbase">donate with<img src="' . get_stylesheet_directory_uri() . '/img/coinbase-logo.png"></button></a>';
}

add_shortcode('coinbase_button', 'coinbase_button');

function swag_button() {
	echo '<a href="http://www.zazzle.com/skepticliberty" target="_blank"><button type="button" class="donation-button" id="swag-store">TSL Swag Store</button></a>';
}
add_shortcode('swag_button', 'swag_button');

function amazon_button() {
	echo '<a href="http://www.amazon.com/?&tag=skepticliberty-20" target="_blank" ><button type="button" class="donation-button" id="amazon">Shop with Amazon<img src="' . get_stylesheet_directory_uri() . '/img/amazon-logo.png"></button></a>';
}
add_shortcode('amazon_button', 'amazon_button');
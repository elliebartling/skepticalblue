<?php 

function set_facebook_meta_tags() {
	
		?>
		<!-- Open Graph Meta Tags for Facebook and LinkedIn Sharing !-->
		<!-- HEY THIS PLUGIN WORKED -->
		<meta property="og:title" content="<?php the_title(); ?>"/>
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail'); ?>
		<?php if ($fb_image) : ?>
			<meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
			<?php endif; ?>
		<meta property="og:type" content="<?php
			if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>"
		/>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
		<!-- End Open Graph Meta Tags !-->
		<?php
	}

add_action('wp_head', 'set_facebook_meta_tags')

?>
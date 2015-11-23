<div id="sidebar-ThreeSixty-blog" class="widget-area">
	<div id="threesixty-posts-header">
		<h1 class="content-header">TSL360</h1>
		<table class="content-subhead">
			<tr>
				<td>
					<p class="content-desc">A continuous stream of news and commentary on stories from around the web.</p>
				</td>
				<td>
					<a href="/360"><p class="content-all">View&nbsp;All</p></a>
				</td>
		</table>
	</div>
    <?php
    genesis_before_sidebar_widget_area();
    add_filter('widget_text', 'do_shortcode');
    dynamic_sidebar( 'ThreeSixty Sidebar' );
    genesis_after_sidebar_widget_area();
    ?>   
</div>
jQuery(document).ready(function($) {

	$('#sidebar-ThreeSixty-blog br').each ( function () {
	    if (this.parentNode.nodeName != "P") {
	        $.each ([this.previousSibling, this.nextSibling], function () {
	            if (this.nodeType === 3) { // 3 == text
	                $(this).wrap ('<p></p>');
	            }
	        } );

	        $(this).remove (); //-- Kill the <br>
	    }
	} );

	// Remove IFTTT's quotation marks around
	// the title of ThreeSixty posts
	$('#sidebar-ThreeSixty-blog a.wp_rss_retriever_title').each( function() {
		var rssTitle = $(this).text();
		rssTitle = rssTitle.slice(1,-1);

		$(this).text(function() {
			return rssTitle;
		});
		
		console.log(rssTitle);

	});
});
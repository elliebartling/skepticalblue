jQuery(document).ready(function() {
  jQuery('.entry-content p:last-of-type').html(jQuery('.entry-content p:last-of-type').html().replace(/"/g,' '));
});
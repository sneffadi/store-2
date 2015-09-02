$(function() {
    var refs = $("#references ol").children();
    var size = refs.size();
    if (size > 5) {
    	refs.slice(5).hide();
    	refs.closest("ol").append("<div class=\"see-more\">See all references [+]</div>");
    };
    if ($(".see-more")) {
    	$(".see-more").on('click', function(event) {
    		$that = $(this);
    		event.preventDefault();
    		refs.fadeIn('400', function() {
    			$that.hide();    				
    		});
    	});
    };
});
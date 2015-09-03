$(window).load(function() {
    if ($("#sticky")) {
        $("#sticky").sticky({
            topSpacing: 50
        });
    };
});

$(function() {
	var heights = [];
	$('#buytable .buy-image').each(function(){
	    $this = $(this);
	    var $height = $this.height();
	    heights.push($height);
	});
	var maxHeight = Math.max.apply(Math, heights);
	$('#buytable .buy-image').height(maxHeight);
});
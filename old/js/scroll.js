$(document).ready(function () {
	windowWidth = $(window).width();
	width = windowWidth - 930;
	width = width / 2;
	$(".contentWrapper").css('padding-left', width);
	$(".contentWrapper").css('padding-right', width);
	$.localScroll.defaults.axis = 'x';
	$.localScroll();
	$('#header li').click(function() {
		$("#header li").removeClass();
		$(this).addClass("active");
	});
});
/*
// article header img parallax on scroll (ahbgimt = article_header_bg_initial_margin_top)
$(function () {
	var ahbgimt = $("header .top").css("background-position");
		ahbgimt = ahbgimt.split(" ");
		ahbgimt = ahbgimt[1].slice(0, -2);
	$(document).on('scroll', function () {
		console.log(ahbgimt);
		console.log($(document).scrollTop());
	});
});
*/
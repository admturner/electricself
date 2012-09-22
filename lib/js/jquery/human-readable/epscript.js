/*!
* epScript v2 // 2012.08.26 // jQuery 1.5.1+
* 
* @author Adam Turner
*/
jQuery(document).ready(function ($) {
	
	// === Slideshow controls === //
	$('#all-sizes div:not(.active)').hide();
	$('.phototoggle li a').click(function(e) {
		e.preventDefault();
		$('.current_page_item').removeClass('current_page_item');
		$(this).addClass('current_page_item');
		var clicked = $(this).attr('href');
		$('#all-sizes .active').hide().removeClass('active');
		$('#all-sizes ' + clicked).fadeIn('medium', 'swing').addClass('active');
	});
});
jQuery(document).ready(function($) {
	$('#tdl-tasks li').click(function(el) {
		$(this).children("div").slideToggle();
	});
})

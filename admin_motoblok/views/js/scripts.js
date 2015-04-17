$(document).ready(function() {
	$('.nav-left').accordion({
		header: 'li.header_li',
		heightStyle: "content",
		animate: 500,
		collapsible: true,
		active: true
	});

	// Выпадающее меню
	$('a.catalog_admin').click(function() {
		$('.categories').slideToggle('500');
  });

	$('textarea').ckeditor();
});
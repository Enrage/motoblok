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

	// Подтверждение удаления
  $('.del').click(function() {
    var res = confirm('Удалить?');
    if(!res) return false;
  });

  // Поля картинок галереи
  var max = 5;
  var min = 1;
  $('#del').attr('disabled', true);
  $('#add').click(function() {
  	var total = $("input[name='galleryimg[]']").length;
  	if(total < max) {
  		$('#btnimg').append('<div><input type="file" name="galleryimg[]"></div>');
  		if(max == total + 1) {
  			$('#add').attr('disabled', true);
  		}
  		$('#del').removeAttr('disabled');
  	}
  });
  $('#del').click(function() {
  	var total = $("input[name='galleryimg[]']").length;
  	if(total > min) {
  		$('#btnimg div:last-child').remove();
  		if(min == total - 1) {
  			$('#del').attr('disabled', true);
  		}
  		$('#add').removeAttr('disabled');
  	}
  });
});
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

  // Удаление картинок
  $('.del_img').on('click', function() {
    var res = confirm('Подтвердите удаление');
    if(!res) return false;
    var img = $(this).attr('alt'); // Имя картинки
    var rel = $(this).attr('rel'); // 0 - базовая картинка, 1 - картинка галереи
    var goods_id = $('#goods_id').text();
    $.ajax({
      url: 'index.php?view=edit_product&goods_id=' + goods_id + '&img=' + img + '&rel=' + rel,
      type: 'get',
      data: {img: img, rel: rel, goods_id: goods_id},
      success: function(res) {
        if(rel == 0) {
          // базовая картинка
          $('.baseimg').fadeOut(500, function() {
            $('.baseimg').empty().fadeIn(500).html(res);
          });
        } else {
          // картинка галереи
          $('.slideimg').find("img[alt='" + img + "']").hide(500);
        }
      },
      error: function() {
        alert('Error');
      }
    });
  });

  var alert_error = $('.success');
  setTimeout(function() {
    alert_error.fadeOut();
  }, 3000);
});
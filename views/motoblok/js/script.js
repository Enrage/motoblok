$(document).ready(function() {
	$("a[rel=group]").fancybox({
    'transitionIn' : 'none',
    'transitionOut' : 'none',
    'titlePosition' : 'over',
    'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
    	return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});

	// Выпадающее меню
	$('#cat_top_menu li').hover(function() {
		//показать подменю
		$('ul', this).stop().slideDown(200);
  }, function () {
		//скрыть подменю
		$('ul', this).stop().slideUp(50);
  });

  // Переключатель вида
	if($.cookie("display") == null) {
      $.cookie("display", "grid");
  }
  $(".grid_list").click(function() {
    var display = $(this).attr("id"); // Получаем значение переключателя вида
    display = (display == "grid") ? "grid" : "list";
    if(display == $.cookie("display")) {
      // Если значение совпадает с кукой - ничего не делаем
      return false;
    } else {
      // Установим куку с новым значением вида
      $.cookie("display", display);
      window.location = "?" + query;
      return false;
    }
  });

  // Сортировка
  $('#param_order').click(function() {
		$('.sort-wrap').fadeToggle("fast", "linear");
  });

  // Форма авторизации
  $('.auth_login').click(function() {
		$('.authform').fadeToggle("slow", "linear");
  });

  // Добавление товаров в корзину без перезагрузки
  var summ = $("#sum").text();
	var col = $("#bought").text();
	if(summ < 1 || col < 1) {
		$('.col').css('display', 'none');
    $('.sum').css('display', 'none');
		$('.oformit').css('display', 'none');
	}
	$(".addtocart").click(function() {
		var url = $(this).attr('href');
		var goods_id = $(this).attr('id');
		var price = $(".price .id_" + goods_id).text();
		summ = Number(summ) + Number(price);
		col++;
		$.ajax({
			url: url,
			type: 'POST',
			data: {col: col, summ: summ, goods_id: goods_id},
			success: function(res) {
				if(res) {
	        $('.empty_cart').css('display', 'none');
	        $('.col').fadeIn();
	        $('.sum').fadeIn();
					$('#bought').text(col); // Запись в нужные места на странице
	        $('#sum').text(summ);
	        $('.oformit').fadeIn();
          $('.alert_cart').fadeIn('slow', 'linear').delay(1200).fadeOut('slow', 'linear');
				}
			},
			error: function() {
				alert('Ошибка добавления в корзину!');
			}
		});
		return false;
	});

	// Авторизация
  $('#auth').click(function(e) {
    e.preventDefault();
    var login = $('#login').val();
    var pass = $('#pass').val();
    var auth = $('#auth').val();
    $.ajax({
      url: './',
      type: 'POST',
      data: {auth: auth, login: login, pass: pass},
      success: function(res) {
        if(res != 'Поля логин/пароль должны быть заполнены!' && res != 'Логин или пароль введены неверно!') {
          $('.authform').hide();
          $('.user_login').fadeIn(500).html(res);
          // Удаляем лишние поля заказа
          $('.notauth').fadeOut(500);
          setTimeout(function() {
              $('.notauth').remove();
          }, 500);
        } else {
          $('.error').remove();
          $('.authform').append('<div class="error"></div>');
          $('.error').hide().fadeIn(500).html(res);
        }
      },
      error: function() {
        alert('Error');
      }
    });
  });
});

function One() {
  // Табы
  document.getElementById('one_tab').className = 'selected_tab';
  document.getElementById('two_tab').className = 'tab';
  document.getElementById('three_tab').className = 'tab';
  document.getElementById('four_tab').className = 'tab';
  // Страницы
  document.getElementById('one').style.display = 'block';
  document.getElementById('one_tab').className = 'selected_tab';
  document.getElementById('two').style.display = 'none';
  document.getElementById('three').style.display = 'none';
  document.getElementById('four').style.display = 'none';
}
function Two() {
  // Табы
  document.getElementById('one_tab').className = 'tab';
  document.getElementById('two_tab').className = 'selected_tab';
  document.getElementById('three_tab').className = 'tab';
  document.getElementById('four_tab').className = 'tab';
  // Страницы
  document.getElementById('one').style.display = 'none';
  document.getElementById('two').style.display = 'block';
  document.getElementById('three').style.display = 'none';
  document.getElementById('four').style.display = 'none';
}
function Three() {
  // Табы
  document.getElementById('one_tab').className = 'tab';
  document.getElementById('two_tab').className = 'tab';
  document.getElementById('three_tab').className = 'selected_tab';
  document.getElementById('four_tab').className = 'tab';
  // Страницы
  document.getElementById('one').style.display = 'none';
  document.getElementById('two').style.display = 'none';
  document.getElementById('three').style.display = 'block';
  document.getElementById('four').style.display = 'none';
}
function Four() {
  // Табы
  document.getElementById('one_tab').className = 'tab';
  document.getElementById('two_tab').className = 'tab';
  document.getElementById('three_tab').className = 'tab';
  document.getElementById('four_tab').className = 'selected_tab';
  // Страницы
  document.getElementById('one').style.display = 'none';
  document.getElementById('two').style.display = 'none';
  document.getElementById('three').style.display = 'none';
  document.getElementById('four').style.display = 'block';
}
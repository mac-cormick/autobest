function funcBefore () {
	$("#content").text ("Отпрака запроса");
}

function funcSuccess () {
	alert("Ok");
}

$(document).ready(function() {

	$(".sf-menu").superfish({
		delay: 200,
		speed: "fast",
		cssArrows: false
	})
	.after("<div id='mobile-menu'>").clone().appendTo("#mobile-menu");
	$("#mobile-menu").find("*").attr("style", "");
	$("#mobile-menu").children("ul").removeClass("sf-menu")
	.parent().mmenu({
		extensions : [ 'widescreen', 'theme-white', 'effect-menu-slide', 'pagedim-black' ],
		navbar: {
			title: "Меню"
		}
	});
	
	$(".toggle-mnu").click(function() {
		$(this).addClass("on");
	});

	var api = $("#mobile-menu").data("mmenu");
	api.bind("closed", function () {
		$(".toggle-mnu").removeClass("on");
	});

	$('.paginator > a').each(function () {
		var location = window.location.href;
		var link = this.href;
		if (location == link) {
			$(this).addClass('active');
		}
	});

	$(".carousel-cars").owlCarousel({
		loop: true,
		nav: true,
		items: 3
	});



	$("#but").bind("click", function() {
		var val = $("#user_code").val();
		$.ajax({
			type: "POST",
			url: "/test.php",
			data: ({vall: val}),
			dataType: "html",
			beforeSend: funcBefore,
			success: funcSuccess
		});
	});


});


function post_query(url, name, data) {

	var str = '';
	$.each(data.split('.'), function(k, v) {
		str += '&' + v + '=' + $('#' + v).val();
	});

	$.ajax(
	{
		url: '/' + url,
		type: 'POST',
		data: name + str,
		cache: false,
		success: function(result) {
			alert(result);
		}
	});
}
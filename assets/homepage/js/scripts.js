$(document).ready(function () {
	$(window).scroll(function () {
		var wScroll = $(this).scrollTop();

		if ($(this).scrollTop() > 800) {
			$('#scroll').fadeIn();
		} else {
			$('#scroll').fadeOut();
		}

		$('.jumbotron h1').css({
			'transform': 'translate(0px,' + wScroll / 3.5 + '%)'
		});

		if (wScroll > $('.working-1').offset().top - 650) {
			$('.working-1').addClass('muncul');
		}
		if (wScroll > $('.working-2').offset().top - 650) {
			$('.working-2').addClass('muncul');
		}
		if (wScroll > $('.working-3').offset().top - 650) {
			$('.working-3').addClass('muncul');
		}

	});
});

$(document).ready(function () {
	// Add scrollspy to <body>
	$('body').scrollspy({
		target: "#menu_makanan",
		offset: 50
	});

	// Add smooth scrolling on all links inside the navbar
	$("#kategori-panel a").on('click', function (event) {
		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
			// Prevent default anchor click behavior
			event.preventDefault();

			// Store hash
			var hash = this.hash;

			// Using jQuery's animate() method to add smooth page scroll
			// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function () {

				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			});
		} // End if
	});
});

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})


$(document).ready(function () {

	$('#scroll').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
});

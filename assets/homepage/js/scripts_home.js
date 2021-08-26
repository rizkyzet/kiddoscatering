$(document).ready(function () {

	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 20,
		autoplay: true,
		autoplayTimeout: 2000,
		nav: false,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 5
			},
			1000: {
				items: 5
			}
		}
	})
})

// related products slider
jQuery(document).ready(function () {
	jQuery(".best-seller").owlCarousel({
		loop: true,
		margin: 10,
		dots: false,
		nav: true,
		navText: [
			"<span class='icon-arw-lt'></span>",
			"<span class='icon-arw-rt'></span>",
		],
		autoplay: false,
		smartSpeed: 1450,
		autoplaySpeed: 2500,
		items: 1,
		responsive: {
			0: {
				items: 2,
			},
			600: {
				items: 3,
				margin: 20,
			},
			1000: {
				items: 4,
			},
		},
	});
});

// mini cart setup
jQuery(function () {
	jQuery(".mini-cart-li").hover(
		function () {
			jQuery(this).find(".mini-cart").first().stop().toggle(200);
		},
		function () {
			jQuery(this).find(".mini-cart").stop().hide(200);
		}
	);
});

// jQuery(".address-slide").owlCarousel({
// 	loop: false,
// 	margin: 10,
// 	items: 1,
// 	dots: true,
// 	nav: false,
// 	autoplay: false,
// 	smartSpeed: 1000,
// 	autoplayTimeout: 2500,
// 	autoplayHoverPause: true,
// });

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function () {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
}

jQuery("a.wc-address-book-delete").on("click", function (e) {
	alert(111);
});

var scrollFloat = function() {
	'use strict';

	var app = {};

	app.init = function init(node) {
		if (!node || node.nodeType !== 1) {
			throw new Error(node + ' is not DOM element');
		}
		handleWindowScroll(node);
	};

	function handleWindowScroll(floatElement) {
		window.onscroll = function() {
			if (window.scrollY > floatElement.offsetTop) {
				if (floatElement.style.position !== 'fixed') {
					floatElement.style.position = 'fixed';
					floatElement.style.top = '0';
			floatElement.style.width = '100%';
			floatElement.style.background = 'rgba(62,62,62, 0.5)';
				}
			} else {
				if (floatElement.style.position === 'fixed') {
					floatElement.style.position = '';
					floatElement.style.top = '';
			floatElement.style.background = 'rgba(62,62,62, 1)';
				}
			}
		};
	}

	return app;
}();

var el = document.getElementById('header');
scrollFloat.init(el);

$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
	autoPlay: 5000,
	navigation : true, // Show next and prev buttons
	slideSpeed : 300,
	paginationSpeed : 400,
	singleItem:true
	// "singleItem:true" is a shortcut for:
	// items : 1, 
	// itemsDesktop : false,
	// itemsDesktopSmall : false,
	// itemsTablet: false,
	// itemsMobile : false
  });
 
});

$('.slider').glide();
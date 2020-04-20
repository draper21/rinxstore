(function ($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});


	// Products Slick
	$('.products-slick').each(function () {
		var $this = $(this),
			$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				},
			]
		});
	});
	// Product Main img Slick
	//$('#product-main-img').slick("unslick");
	$('#product-main-img').slick({
		infinite: true,
		speed: 300,
		dots: true,
		arrows: true,
		fade: false,
		asNavFor: '#product-imgs',
	});
	//$('#product-main-img').slick();
	// Product thumb imgs Slick
	//$('#product-main-img').slick("unslick");
	$('#product-imgs').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
		asNavFor: '#product-main-img',
		responsive: [{
			breakpoint: 991,
			settings: {
				vertical: false,
				arrows: false,
				dots: true,
			}
		}, ]
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function () {
		var $this = $(this),
			$nav = $this.attr('data-nav');

		$this.slick({
			lazyLoad: 'ondemand',
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: true,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});


	//$('#product-imgs').slick();

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	// Input number
	//$('.input-number').each(function () {
	//	var $this = $(this),
	//		$input = $this.find('input[type="number"]'),
	//		up = $this.find('.qty-up'),
	//		down = $this.find('.qty-down');
	//
	//	down.on('click', function () {
	//		var value = parseInt($input.val()) - 1;
	//		value = value < 1 ? 1 : value;
	//		$input.val(value);
	//		$input.change();
	//		updatePriceSlider($this, value)
	//	})
	//
	//	up.on('click', function () {
	//		var value = parseInt($input.val()) + 1;
	//		$input.val(value);
	//		$input.change();
	//		updatePriceSlider($this, value)
	//	})
	//});

	var priceInputMax = document.getElementById('price-max'),
		priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function () {
		updatePriceSlider($(this).parent(), this.value)
	});

	priceInputMin.addEventListener('change', function () {
		updatePriceSlider($(this).parent(), this.value)
	});

	function updatePriceSlider(elem, value) {
		if (elem.hasClass('price-min')) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if (elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}



	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 6000],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 6000
			}
		});

		//send slider data back to store.php
		priceSlider.noUiSlider.on('end', function (values, handle) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
			//	lowslide = priceInputMin.value;
			//	highslide = priceInputMax.value;
			updateProductFilters();
		});
	}


	$("input:checkbox").click(function () {
		//var loc = $('<a>', {
		//	href: window.location
		//})[0];
		//lowslide = $('#price-min').val();
		//highslide = $('#price-max').val();
		updateProductFilters();
		//alert(checkboxValues)
		//$.post('storeContent.php/', checkboxValues);
	});

	function updateProductFilters() {
		var cat = getUrlParameter('id');
		var checkboxValues = new Array();
		$('input[name="chbox[]"]:checked').each(function (i) {
			checkboxValues.push($(this).val());
		});
		//var checkboxValues = $('input[name="chbox[]"]:checked').serialize();
		var lowslide = $('#price-min').val();
		var highslide = $('#price-max').val();
		$.ajax({
			url: "storeContent.php",
			method: "GET",
			data: {
				"lowslide": lowslide,
				"highslide": highslide,
				"cat": cat,
				"chbox[]": checkboxValues
			},
			dataType: 'HTML',
			success: function (data) {
				$('#store').empty().append(data);
				$('#sliderValLow').empty().append(lowslide);
				$('#sliderValHigh').empty().append(highslide);
			}
		});
	}

})(jQuery);

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};
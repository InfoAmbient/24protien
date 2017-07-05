$(document).ready(function(){
    
    'use strict';

	$('.mobile-menu nav').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: '760'
	});

	$('.banner').show().revolution({
		delay:4000,
		startwidth:1140,
		startheight:600,
		hideThumbs:10,
		lazyLoad:'on',
		navigationType:"bullet",
		navigationArrows:"solo",
		navigationStyle:"preview1",

		touchenabled:"on",

		swipe_velocity: 0.7,
		swipe_min_touches: 1,
		swipe_max_touches: 1,
		drag_block_vertical: false,

		parallax:"mouse",
		parallaxBgFreeze:"on",
		parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

		keyboardNavigation:"off",

		navigationHAlign:"center",
		navigationVAlign:"bottom",
		navigationHOffset:0,
		navigationVOffset:20,

		soloArrowLeftHalign:"left",
		soloArrowLeftValign:"center",
		soloArrowLeftHOffset:20,
		soloArrowLeftVOffset:0,

		soloArrowRightHalign:"right",
		soloArrowRightValign:"center",
		soloArrowRightHOffset:20,
		soloArrowRightVOffset:0

	});

	$('#special-offers').lightSlider({
		item: 3,
		auto: true,
		loop: true,
		controls: true,
		pager: false,
		enableDrag: false,
		responsive : [
        {
            breakpoint:600,
            settings: {
                item:2
            }
        },
        {
        	breakpoint:600,
            settings: {
                item:1
            }
        }
        ]
	});

	$('.product-rating').rating({
		showLabel: false,
		color: '#ccc',
	    colorHover: '#f6b800',
	    size: '18px'
	});

	$('.tooltipster').tooltipster();

	$('.dropdown').tooltipster({
		position: 'bottom',
		contentAsHTML: true,
		interactive: true,
		theme: 'tooltipster-theme'
	});

	$('.fancybox').fancybox();
    
    var austDay = new Date(2016, 5-1, 10); //year, month-1, day | Today Date => 26-4 | (2016, 5-1, 10) => 13
    jQuery('#countdown').countdown({
        until: austDay,
        padZeroes: true
    });

});
jQuery(document).ready(function($){

    'use strict';

$('.willhide').hide();

$('.btn-show a').click(function (e){

$(this).text(function(i, v){
   return v === 'المزيد (+)' ? 'الأقل (-)' : 'المزيد (+)'
});

$('.willhide').fadeToggle(200);

e.preventDefault();

});


$('.willhide2').hide();

$('.btn-show2 a').click(function (e){

$(this).text(function(i, v){
   return v === 'المزيد (+)' ? 'الأقل (-)' : 'المزيد (+)'
});

$('.willhide2').fadeToggle(200);

e.preventDefault();

});

$('.willhide3').hide();
$('.btn-show3 a').click(function (e){
$(this).text(function(i, v){
   return v === 'المزيد (+)' ? 'الأقل (-)' : 'المزيد (+)'
});
$('.willhide3').fadeToggle(200);
e.preventDefault();
});

$(".qty-wrapper input").attr({"type":"number","min":"1","style":"width:65px!important"});

$(".sticky,.wrapper-sticky,.sticky-active").css("z-index","99999999999999");
    $('.banner').show().revolution({

		dottedOverlay:"none",

		delay:16000,

		startwidth:1170,

		startheight:400,

		hideThumbs:200,



		thumbWidth:100,

		thumbHeight:50,

		thumbAmount:4,

		

								

		simplifyAll:"off",



		navigationType:"bullet",

		navigationArrows:"solo",

		navigationStyle:"preview3",



		touchenabled:"on",

		onHoverStop:"on",

		nextSlideOnWindowFocus:"off",



		swipe_threshold: 0.7,

		swipe_min_touches: 1,

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

		soloArrowRightVOffset:0,



		shadow:0,

		fullWidth:"on",

		fullScreen:"off",



								spinner:"spinner4",

								

		stopLoop:"off",

		stopAfterLoops:-1,

		stopAtSlide:-1,



		shuffle:"off",



		autoHeight:"off",

		forceFullWidth:"off",

		

		

		hideTimerBar:"on",

		hideThumbsOnMobile:"off",

		hideNavDelayOnMobile:1500,

		hideBulletsOnMobile:"off",

		hideArrowsOnMobile:"off",

		hideThumbsUnderResolution:0,



								hideSliderAtLimit:0,

		hideCaptionAtLimit:0,

		hideAllCaptionAtLilmit:0,

		startWithSlide:0



	});



    // Menu On Mobile

	$('.mobile-menu nav').meanmenu({

		meanMenuContainer: 'body',

		meanScreenWidth: '760'

	});





	// Products Carousel

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



	// Products Rating

	$('.product-rating').rating({

		showLabel: false,

		color: '#ccc',

	    colorHover: '#f6b800',

	    size: '18px'

	});



	// Tooltip

	$('.tooltipster').tooltipster();


	$('.sticky-column').hcSticky({
        offResolutions: -991
    });

	// User Account Tooltip 

	$('.dropdown2').tooltipster({

		position: 'bottom',

		contentAsHTML: true,

		interactive: true,

		theme: 'tooltipster-theme'

	});

	$('.head-user').tooltipster({

		position: 'bottom',

		contentAsHTML: true,

		interactive: true,

		theme: 'tooltipster-theme'

	});

	$('.tsc').tooltipster({
		contentAsHTML: true,
		interactive: true,
		theme: 'tooltipster-theme'
	});


	// Fancybox

	$('.fancybox').fancybox();

    

    // CountDown

    var austDay = new Date(2016, 5-1, 10); //year, month-1, day | Today Date => 26-4 | (2016, 5-1, 10) => 13

    jQuery('#countdown').countdown({

        until: austDay,

        padZeroes: true

    });


var go = $('.back-to-top');
$(window).scroll(function() {
	if ($(this).scrollTop() > 600) {
        go.addClass('active');
    } else {
        go.removeClass('active');
    }
});
go.click(function(e) {
	e.preventDefault();
    $('html,body').animate({
        scrollTop: 0
    }, 600);
});

$('#slider1').bxSlider({
  auto: true,
  pause: 3000,
  pager: false
});

});
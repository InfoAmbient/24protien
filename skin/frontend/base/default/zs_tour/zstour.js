//You should append to this list all URLs on which you DO NOT wish that script will parse for classnames

var blocked_url=[


	'https://www.24protein.com/about-us',


];



var $zs = jQuery.noConflict();

$zs(function () {

var config=[];

autoplay = true;

showtime = 2000;

step = 0;

var parentelement=$zs('body');;

var jezik=$zs('html').attr("lang");

var somevar = blocked_url.indexOf(window.location.href);

if(somevar == -1){

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

        var myObj = JSON.parse(this.responseText);

		var run=false;

		for (i = 0; i < myObj.length; i++) {

			qname = myObj[i][0];

			qbgcolor = myObj[i][1];

			qcolor = myObj[i][2];

			qposition = myObj[i][3];

			qtext = myObj[i][4];

			qtime = myObj[i][5];

			qlanguage = myObj[i][6];

			if(qlanguage==jezik){

			if ($zs(qname).length)run=true;

			config.push({

						"name":qname,

						"bgcolor":qbgcolor,

						"color":qcolor,

						"position":qposition,

						"text":qtext,

						"time":qtime

						});

			}

		}

		if(run){

			total_steps = config.length;

			startTour();

		}

    }

};

xmlhttp.open("GET", "https://www.24protein.com/zombiestudio_tour/tour/rss/", true);


xmlhttp.send();

};



	function startTour() {

		showOverlay();

		nextStep();

	}



	function nextStep() {

		if (step >= total_steps) {

			endTour();

			return false;

		}

		++step;

		showTooltip();

	}



	function prevStep() {

		if (step <= 1)

			return false;

		--step;

		showTooltip();

	}



	function endTour() {

		step = 0;

		clearTimeout(showtime);

		removeTooltip();

		hideOverlay();

	}

	

	$zs("body").on("click",$zs(".endTourButton"),function(){endTour();});

	

	function showTooltip() {

		removeTooltip();



		var step_config = config[step - 1];

		var $elem = $zs(step_config.name);

		parentelement=$elem.parent();

		parentelement.css({'border': '3px solid white','z-index': '100','position': 'absolute','border-radius': '30px'});



		if (autoplay)

			showtime = setTimeout(nextStep, step_config.time);



		var bgcolor = step_config.bgcolor;

		var color = step_config.color;



		var $tooltip = $zs('<div>', {

				id: 'tour_tooltip',

				class: 'tooltip',

				className: 'tooltip',

				html: '<p>' + step_config.text + '</p><button class="endTourButton" style="margin-bottom: 10px;color: black;font-family: monospace;background-color: #ddd;border: 2px solid #888;">End</button><span class="tooltip_arrow"></span>'

			}).css({

				'display': 'none',

				'background-color': bgcolor,

				'color': color

			});



		var properties = {};



		var tip_position = step_config.position;



		$zs('BODY').prepend($tooltip);



		var e_w = $elem.outerWidth();

		var e_h = $elem.outerHeight();

		var e_l = $elem.offset().left;

		var e_t = $elem.offset().top;



		switch (tip_position) {

		case 'TL':

			properties = {

				'left': e_l,

				'top': e_t + e_h + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');

			break;

		case 'TR':

			properties = {

				'left': e_l + e_w - $tooltip.width() + 'px',

				'top': e_t + e_h + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');

			break;

		case 'BL':

			properties = {

				'left': e_l + 'px',

				'top': e_t - $tooltip.height() + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');

			break;

		case 'BR':

			properties = {

				'left': e_l + e_w - $tooltip.width() + 'px',

				'top': e_t - $tooltip.height() + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');

			break;

		case 'LT':

			properties = {

				'left': e_l + e_w + 'px',

				'top': e_t + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');

			break;

		case 'LB':

			properties = {

				'left': e_l + e_w + 'px',

				'top': e_t + e_h - $tooltip.height() + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');

			break;

		case 'RT':

			properties = {

				'left': e_l - $tooltip.width() + 'px',

				'top': e_t + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');

			break;

		case 'RB':

			properties = {

				'left': e_l - $tooltip.width() + 'px',

				'top': e_t + e_h - $tooltip.height() + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');

			break;

		case 'T':

			properties = {

				'left': e_l + e_w / 2 - $tooltip.width() / 2 + 'px',

				'top': e_t + e_h + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');

			break;

		case 'R':

			properties = {

				'left': e_l - $tooltip.width() + 'px',

				'top': e_t + e_h / 2 - $tooltip.height() / 2 + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');

			break;

		case 'B':

			properties = {

				'left': e_l + e_w / 2 - $tooltip.width() / 2 + 'px',

				'top': e_t - $tooltip.height() + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');

			break;

		case 'L':

			properties = {

				'left': e_l + e_w + 'px',

				'top': e_t + e_h / 2 - $tooltip.height() / 2 + 'px'

			};

			$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');

			break;

		}



		var w_t = $zs(window).scrollTop();

		var w_b = $zs(window).scrollTop() + $zs(window).height();

		var b_t = parseFloat(properties.top, 10);



		if (e_t < b_t)

			b_t = e_t;



		var b_b = parseFloat(properties.top, 10) + $tooltip.height();

		if ((e_t + e_h) > b_b)

			b_b = e_t + e_h;



		if ((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)) {

			$zs('html, body').stop()

			.animate({

				scrollTop: b_t

			}, 500, 'easeInOutExpo', function () {

				if (autoplay) {

					clearTimeout(showtime);

					showtime = setTimeout(nextStep, step_config.time);

				}

				$tooltip.css(properties).show();

			});

		} else

			$tooltip.css(properties).show();

	}



	function removeTooltip() {

		$zs('#tour_tooltip').remove();

		parentelement.css({'border': '0px solid white','z-index': '10','position': 'inherit','border-radius': '0px'});

	}



	function showOverlay() {

		var $overlay = '<div id="tour_overlay" class="overlay"></div>';

		$zs('BODY').prepend($overlay);

	}



	function hideOverlay() {

		$zs('#tour_overlay').remove();

	}



});
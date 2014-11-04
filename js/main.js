jQuery(document).ready(function(){
	var slider_delay  = parseInt(l10n_main.mso_slider_delay);

	slider_delay  = slider_delay > 0 ? slider_delay : 5;
	
	// ==============================================================
	// Main slider
	// ==============================================================
	jQuery('.main-slider aside').flexslider({
		animation: "fade",
		slideshowSpeed: slider_delay*1000,
		controlNav: true,
		directionNav: false
	});	
	// ==============================================================
	// Fix text shifting
	// ==============================================================
	jQuery('#menu-main > li > a').each(function(){
		jQuery(this).parent().width(jQuery(this).outerWidth()+5);
	});
	// ==============================================================
	// Boxer
	// ==============================================================
	jQuery(".boxer").boxer();
	// ==============================================================
	// Selecter
	// ==============================================================
	jQuery("select").selecter();
	// ==============================================================
	// Remove field notification
	// ==============================================================
	jQuery('.wpcf7-form-control-wrap').mouseenter(function(){
		if(jQuery(this).find('span.wpcf7-not-valid-tip').length)
		{
			jQuery(this).find('span.wpcf7-not-valid-tip').fadeOut(200);
		}
	});
	// ==============================================================
	// Google map
	// ==============================================================
	if(jQuery('#map-canvas').length)
	{
		var map;
		function initialize() {
			var mapOptions = {
				zoom: 17,
				center: new google.maps.LatLng(50.107428, 14.543827),
				disableDefaultUI: true,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				visibility: "off"
			};
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		}

		google.maps.event.addDomListener(window, 'load', initialize);	
	}
});

/**
 * Testimonial videos nav click
 * @param  object event --- click event
 * @param  object obj --- a object
 */
function showVideoBlock(event, obj)
{
	var videoblock = jQuery(obj).attr('href');
	jQuery('.widget-testimonial-videos nav ul li').each(function(){
		jQuery(this).removeClass('active');
	});

	jQuery('.widget-testimonial-videos .videoblock:not(.hide)').each(function(){
		jQuery(this).addClass('hide');
	});

	jQuery(videoblock).removeClass('hide');
	jQuery(obj).parent().addClass('active');

	event.preventDefault();
}
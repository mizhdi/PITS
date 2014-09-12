seajs.config({
	charset: 'utf-8',
	alias: {
		"jquery": "../lib/jquery/2.1.1/jquery.min.js",
		"cookie": "../plugins/cookie/1.4.1/jquery.cookie.js",
		"pin": "../plugins/pin/1.0.0/jquery.pin.min.js",
		"dropdown": "../plugins/dropdown/3.2.0/dropdown.js",
		"off-canvas": "../app/off-canvas.js",
		"tooltip": "../plugins/tooltip/3.2.0/tooltip.js",
		"pace": "../plugins/pace/0.5.6/pace.min.js",
		"scrollspy": "../plugins/scrollspy/3.2.0/scrollspy.js",
		"lazyloadxt": "../plugins/lazyloadxt/1.0.5/jquery.lazyloadxt.min.js",
		"cycle2": "../plugins/cycle2/2.1.5/jquery.cycle2.js",
		"nicescroll": "../plugins/nicescroll/3.5.4/jquery.nicescroll.min.js"
	}
});

seajs.use('./wp-content/themes/pits/assets/js/app/main', function(main) {
	main.init();
});
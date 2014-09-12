requirejs.config({
   
    paths: {
        "jquery": "lib/jquery",
        "cycle2": "lib/jquery.cycle2",
        "lazyloadxt": "lib/jquery.lazyloadxt",
        "pace": "lib/pace",
        "dropdown": "lib/dropdown",
        "scrollspy": "lib/scrollspy",
        "pin": "lib/pin",
        "nicescroll": "lib/jquery.nicescroll",
        "infinite-scroll": "lib/infinite-scroll",
        "fancybox": "lib/fancybox"
    },

    shim: {
    	"cycle2": {
    		deps: ["jquery"],
    		exports: "cycle2"
    	},
    	"lazyloadxt": { 
    		deps: ["jquery"],
    		exports: "lazyloadxt" 
    	},
    	"pace": {
    		deps: ["jquery"],
    		exports: "pace"
    	},
    	"dropdown": {
    		deps: ["jquery"],
    		exports: "dropdown"
    	},
    	"scrollspy": {
    		deps: ["jquery"],
    		exports: "scrollspy"
    	},
    	"pin": {
    		deps: ["jquery"],
    		exports: "pin"
    	},
    	"nicescroll": {
    		deps: ["jquery"],
    		exports: "nicescroll"
    	},
        "infinite-scroll": {
            deps: ["jquery"],
            exports: "infinite-scroll"
        },
        "fancybox": {
            deps: ["jquery"],
            exports: "fancybox"
        }
    }

});

// Start the main app logic.
requirejs(["jquery", "pace", "cycle2", "scrollspy", "lazyloadxt", "dropdown", "pin", "nicescroll", 
    "infinite-scroll", "fancybox"],
function ($) {

    console.log('my profile');

	(function (html) {
		html.className = html.className.replace(/\bno\-js\b/, 'js');
	})(document.documentElement);

 	$('#slideshow').cycle({
        fx:"scrollHorz",
        slides: "> a, > img",
        log: "false",
        pauseOnHover: "true"
	}); 

	// $.lazyLoadXT.onload.addClass = 'animated bounceIn';

    // $('article img').addClass('animated bounceIn');

	$.extend($.lazyLoadXT, {
		edgeY: 200,
		srcAttr: 'data-src'
	});

	$(".pin").pin({
		minWidth: 940
	});

	$("html").niceScroll();

    $('#content').infinitescroll({
        loading: {
            finished: undefined,
            finishedMsg: "",
            msgText: "",
            img: "data:image/gif;base64,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"
        },
        navSelector: "#navigation",      
        nextSelector: "#navigation a",  
        itemSelector: "article" ,            
        animate: true,                          
        maxPage: 2, 
        errorCallback: function(){
            $(window).lazyLoadXT();
            var linkstr = $('#navigation a').attr('href');
            linkstr = linkstr.replace(/2/gi, '3');
            $('#navigation a').attr('href',linkstr);
            $('#navigation').appendTo('#content').show();
        }
    });

     $('.entry-content a').has('img').addClass('fancybox').fancybox({

     });

      // Go to top
    var goTop = function($) {

        var config = {
            pageWidth       : 1080,
            nodeId          : 'gotop',
            nodeWidth       : 18,
            distanceToBottom: 80,
            distanceToPage  : 20,
            hideRegionHeight: 100
        }

        function getDistanceToRight() {
            var right = parseInt(($(window).width() - config.pageWidth)/2 - config.nodeWidth - config.distanceToPage, 10);
            if (right < 10) {
                right = 10;
            }
            return right;
        }

        function getDistanceToBottom() {
            var bottom = config.distanceToBottom;
            if ($(window).width() <= 480) {
                bottom = 10
            }
            return bottom;
        }

        function insert() {
            $('body').append('<a class="tool" data-toggle="tooltip" data-placement="left" title="返回顶部" href="#" id="' + config.nodeId + '"><span class="iconfont icon-uplist"></span></a>');
            var right = getDistanceToRight();
            var bottom = getDistanceToBottom();
            $('#' + config.nodeId).css({
                'position':  'fixed',
                'display' :  'none',
                'bottom'  :  bottom + 'px',
                'right'   :  right + 'px',
                'zIndex'  :  '999',
                'color'   :  '#333'
            }).on('click', function(e) {
                $('html, body').animate({scrollTop: 0}, 400); 
                e.preventDefault();             
            });
        }

        function resize() {
            var right = getDistanceToRight();
            var bottom = getDistanceToBottom();
            $('#'+config.nodeId).css({
                'right'   :  right + 'px',
                'bottom'  :  bottom + 'px'
            });
        }

        function scroll() {
            var $node = $('#' + config.nodeId);
            if ($(document).scrollTop() <= config.hideRegionHeight) {
                $node.hide();
            } else {
                $node.fadeIn();
            }
        }

        return {
            init: function() {
                insert();
    
                $(window).scroll(function() {
                    scroll();
                });

                $(window).resize(function() {
                    resize();
                });

            }
        }

    }(jQuery);

    goTop.init();


    $('.menu-togggle').on('click', function() {

        $('body').toggleClass('off-canvas-active');
    });


    $(window).resize(function() {

        if ($(window).width() >= 768) {
            $('body').removeClass('off-canvas-active');
        }
    })


    $('.search-form button').on('click', function(e) {

        $('body').toggleClass('off-canvas-logo off-canvas-input');

        var key = $('.search-form input').val();

        // $('#header .search-form').attr('autofocus')

        if (key == '') {
            e.preventDefault();
        }

    });
     

});


define(['pace'], function(pace){
    pace.start({
        document: false
    });
});



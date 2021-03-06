( function( $ ) {

	function removeNoJsClass() {
		$( 'html:first' ).removeClass( 'no-js' );
	}

	/* Superfish the menu drops ---------------------*/
	function superfishSetup() {
		$('.menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
		});

		// Fix Superfish menu if off screen.
		var sfMainWindowWidth = $(window).width();

		$('ul.menu li, div.menu li').mouseover(function() {

			// Checks if second level menu exists.
			var subMenuExist = $(this).find('.sub-menu, ul.children').length;
			if ( subMenuExist > 0 ) {
				var subMenuWidth = $(this).find('.sub-menu, ul.children').width();
				var subMenuOffset = $(this).find('.sub-menu, ul.children').parent().offset().left;

				// If sub menu is off screen, give new position.
				if ( ( subMenuOffset + subMenuWidth) > sfMainWindowWidth ) {
					$(this).find('.sub-menu, ul.children').css({
						right: 0,
						left: 'auto',
					});
				}
			}

			// Checks if third level menu exists.
			var subSubMenuExist = $(this).find('.sub-menu .sub-menu, ul.children ul.children').length;
			if ( subSubMenuExist > 0 ) {
				var subSubMenuWidth = $(this).find('.sub-menu .sub-menu, ul.children ul.children').width();
				var subSubMenuOffset = $(this).find('.sub-menu .sub-menu, ul.children ul.children').parent().offset().left + subSubMenuWidth;

				// If sub menu is off screen, give new position.
				if ( ( subSubMenuOffset + subSubMenuWidth) > sfMainWindowWidth){
					var newSubSubMenuPosition = subSubMenuWidth + 24;
					$(this).find('.sub-menu .sub-menu, ul.children ul.children').css({
						left: -newSubSubMenuPosition,
						right: 'auto',
					});
				}
			}
		});
	}

	/* Flexslider ---------------------*/
	function flexSliderSetup() {
		if( ($).flexslider) {
			var slider = $('.flexslider');
			slider.flexslider({
				slideshowSpeed		: slider.attr('data-speed'),
				animationDuration	: 800,
				animation			: slider.attr('data-transition'),
				video				: false,
				useCSS				: false,
				prevText			: '<i class="fa fa-angle-left"></i>',
				nextText			: '<i class="fa fa-angle-right"></i>',
				touch				: false,
				controlNav			: false,
				animationLoop		: true,
				smoothHeight		: true,
				pauseOnAction		: true,
				pauseOnHover		: false,

				start: function(slider) {
					slider.removeClass('loading');
					$( ".preloader" ).hide();
				}
			});
		}
	}

	/* Masonry ---------------------*/
	function masonrySetup() {
		var $container = $('.portfolio-wrap, .donations-wrap');
		$container.masonry({
			itemSelector : '.single, .half, .third, .fourth'
		});
	}

	/* Equal Height Columns ---------------------*/
	function equalHeight() {
		var currentTallest 	= 0,
			currentRowStart = 0,
			rowDivs 		= new Array(),
			$el,
			topPosition 	= 0;

		$('.featured-pages .content').each(function() {
			$el = $(this);
			$($el).height('auto')
			topPostion = $el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = $el.height();
				rowDivs.push($el);

			} else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}

	function modifyPosts() {

		/* Fit Vids ---------------------*/
		$('.feature-vid, .content').fitVids();

		/* Insert Line Break Before More Links ---------------------*/
		$('<br />').insertBefore('.content .more-link');

		/* Hide Comments When No Comments Activated ---------------------*/
		$('.nocomments').parent().css('display', 'none');

		/* Animate Page Scroll ---------------------*/
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
		});

	}

	$( document )
	.ready( removeNoJsClass )
	.ready( superfishSetup )
	.ready( modifyPosts )
	.on( 'post-load', modifyPosts );

	$( window )
	.load( flexSliderSetup )
	.load( masonrySetup )
	.load( equalHeight )
	.resize( equalHeight )
	.resize( masonrySetup );

})( jQuery );

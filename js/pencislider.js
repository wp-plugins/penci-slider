(function ( $ ) {
	"use strict";
	var PENCISLIDER = PENCISLIDER || {};

	/* Flexslider
	 ---------------------------------------------------------------*/
	PENCISLIDER.flexslider = function () {
		$( window ).load( function () {
			/* Load all slider */
			$( '.penci-slider' ).each( function () {
				var $this = $( this );
				$this.flexslider( {
					namespace     : "penci-",
					animation     : $this.data( 'transition' ),
					slideshow     : $this.data( 'autoplay' ),
					animationLoop : $this.data( 'loop' ),
					slideshowSpeed: 6000,
					animationSpeed: 500,
					controlNav    : $this.data( 'bullet' ),
					directionNav  : $this.data( 'arrow' ),
					prevText      : "",
					nextText      : "",
					start         : function ( slider ) {
						$this.removeClass( 'loading' );
						PENCISLIDER.fixtop();
					}
				} );
			} );
		} );
	}

	/* General js
	 ---------------------------------------------------------------*/
	PENCISLIDER.fixtop = function () {
		$('.penci-slider .pencislider-container' ).each( function(){
			var $this = $(this ),
				parent_slider = $this.closest('.penci-slider' ),
				this_height = $this.height(),
				parent_height = $this.parent().height(),
				w_windown = $(window ).width();
			if( parent_slider.hasClass('fixed-height') && w_windown > 768 ){
				parent_height = parent_slider.data('height');
			}
			var top_this = ( parent_height - this_height )/2;
			$this.css( "top", top_this + 'px' );
		} );
	}

	/* Init functions
	 ---------------------------------------------------------------*/
	$( document ).ready( function () {
		PENCISLIDER.flexslider();
		$( window ).resize(function() {
			PENCISLIDER.fixtop();
		} );
	} );

})( jQuery );	// EOF
(function ( $ ) {
	/**
	 *    Tabs in back-end
	 */
	function pencisliderTab() {
		var anchor = window.location.hash;
		console.log(anchor);
		if ( anchor === '#responsive-design-options' ) {
			$( '.kang-tabs a' ).removeClass( 'nav-tab-active' );
			$( '.kang-tabs a.responsive-design-options' ).addClass( 'nav-tab-active' );
			$( '.kang-tabs-content > div' ).hide();
			$( '.responsive-design-options' ).show();
		}

		$( '.kang-tabs a' ).click( function () {
			var $this = $( this ),
				$tabID = $this.attr( 'href' );

			$tabClass = $tabID.replace( '#', '.' );

			$( '.kang-tabs a' ).removeClass( 'nav-tab-active' );
			$this.addClass( 'nav-tab-active' );
			$( '.kang-tabs-content > div' ).hide();
			$( $tabClass ).show();
		} );
	}

	pencisliderTab();

})( jQuery );
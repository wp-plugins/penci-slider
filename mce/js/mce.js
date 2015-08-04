/* ----------------------------------------------------- */
/* This file for register button insert shortcode to TinyMCE
 /* ----------------------------------------------------- */
(function () {
	tinymce.create( 'tinymce.plugins.pencislider_pre_shortcodes_button', {
		init         : function ( ed, url ) {
			title = 'pencislider_pre_shortcodes_button';
			tinymce.plugins.pencislider_pre_shortcodes_button.theurl = url;
			ed.addButton( 'pencislider_pre_shortcodes_button', {
				title: 'PenciSlider Shortcode',
				icon : 'pencislider_icon',
				type : 'menubutton',
				menu : [

					/* --- PenciSlider Shortcode--- */
					{
						text   : 'PenciSlider Shortcode',
						value  : 'PenciSlider Shortcode',
						onclick: function () {
							ed.windowManager.open( {
								title   : 'PenciSlider Shortcode',
								body    : [
									{ type : 'textbox', name : 'container', label: 'Container Width(numeric value only, unit is pixel)', value: '1000' },
									{ type: 'textbox', name: 'category', label: 'Category Name to filter slides' },
									{ type : 'textbox', name : 'height', label: 'Slider Height(numeric value only, want smooth height let empty it)' },
									{ type : 'listbox', name : 'order', label: 'Slides Order', 'values': [{ text: 'Ascending', value: 'asc' }, { text: 'Descending', value: 'desc' }] },
									{ type    : 'listbox', name    : 'transition', label   : 'Slider Transition', 'values': [{ text: 'Slide', value: 'slide' }, { text: 'Fade', value: 'fade' }] },
									{ type    : 'listbox', name    : 'autoplay', label   : 'Auto Play Slider?', 'values': [{ text: 'Yes', value: 'true' }, { text: 'No', value: 'false' }] },
									{ type    : 'listbox', name    : 'arrow', label   : 'Display Next/Prev Button?', 'values': [{ text: 'Yes', value: 'true' }, { text: 'No', value: 'false' }] },
									{ type    : 'listbox', name    : 'bullet', label   : 'Display Bullet Navigation?', 'values': [{ text: 'Yes', value: 'true' }, { text: 'No', value: 'false' }] },
									{ type    : 'listbox', name    : 'loop', label   : 'Loop Slide?', 'values': [{ text: 'Yes', value: 'true' }, { text: 'No', value: 'false' }] },
								],
								onsubmit: function ( e ) {
									ed.insertContent( '[penci_slider container="' + e.data.container + '" category="' + e.data.category + '" height="' + e.data.height + '" transition="' + e.data.transition + '" autoplay="' + e.data.autoplay + '" arrow="' + e.data.arrow + '" bullet="' + e.data.bullet + '" loop="' + e.data.loop + '" /]' );
								}
							} );
						}
					},
				]
			} );

		},
		createControl: function ( n, cm ) {
			return null;
		}
	} );

	tinymce.PluginManager.add( 'pencislider_pre_shortcodes_button', tinymce.plugins.pencislider_pre_shortcodes_button );

})();
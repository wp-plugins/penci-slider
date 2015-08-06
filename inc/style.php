<?php
/**
 *	Add Custom CSS from all general options
 * I'm not sure, but maybe in new update I'll remove someone options here, and move it to parameters of shortcode
 *
 * @author PenciDesign ( KanG )
 * @since 1.0
 */

/* Get your options */
$options         = get_option( 'penci_slider_options' );

$title_font = isset( $options['title_font'] ) ? $options['title_font'] : 'Default';
$title_font_import = '';
$caption_font_import = '';
$button_font_import = '';
if( $title_font != 'Default' ):
	$title_font_replace = str_replace( ' ', '+', $title_font );
	$title_font_import = '@import url(http://fonts.googleapis.com/css?family='. $title_font_replace .');';
endif;
$caption_font = isset( $options['caption_font'] ) ? $options['caption_font'] : 'Default';
if( $caption_font != 'Default' ):
	$caption_font_replace = str_replace( ' ', '+', $caption_font );
	$caption_font_import = '@import url(http://fonts.googleapis.com/css?family='. $caption_font_replace .');';
endif;
$button_font = isset( $options['button_font'] ) ? $options['button_font'] : 'Default';
if( $button_font != 'Default' ):
	$button_font_replace = str_replace( ' ', '+', $button_font );
	$button_font_import = '@import url(http://fonts.googleapis.com/css?family='. $button_font_replace .');';
endif;

$overlay_opacity = isset( $options['overlay_opacity'] ) ? $options['overlay_opacity'] : '0.4';
if( !in_array( $overlay_opacity, array( '0', '0.05', '0.1', '0.15', '0.2', '0.25', '0.3', '0.35', '0.4', '0.45', '0.5', '0.55', '0.6', '0.65', '0.7', '0.75', '0.8', '0.85', '0.9', '0.95', '1' ) ) ): $overlay_opacity = '0.4'; endif;

$title_off_uppercase = isset( $options['title_off_uppercase'] ) ? $options['title_off_uppercase'] : '0';
if( $title_off_uppercase != '1' ): $title_off_uppercase = '0'; endif;

$title_font_weight = isset( $options['title_font_weight'] ) ? $options['title_font_weight'] : 'normal';
$caption_font_weight = isset( $options['caption_font_weight'] ) ? $options['caption_font_weight'] : 'normal';
$button_font_weight = isset( $options['button_font_weight'] ) ? $options['button_font_weight'] : 'normal';

$title_font_size = isset( $options['title_font_size'] ) ? $options['title_font_size'] : '42';
if( !is_numeric($title_font_size) ): $title_font_size = '42'; endif;
$caption_font_size = isset( $options['caption_font_size'] ) ? $options['caption_font_size'] : '20';
if( !is_numeric($caption_font_size) ): $caption_font_size = '20'; endif;
$button_font_size = isset( $options['button_font_size'] ) ? $options['button_font_size'] : '14';
if( !is_numeric($button_font_size) ): $button_font_size = '14'; endif;
$title_font_size_tablet = isset( $options['title_font_size_tablet'] ) ? $options['title_font_size_tablet'] : '36';
if( !is_numeric($title_font_size_tablet) ): $title_font_size_tablet = '36'; endif;
$caption_font_size_tablet = isset( $options['caption_font_size_tablet'] ) ? $options['caption_font_size_tablet'] : '18';
if( !is_numeric($caption_font_size_tablet) ): $caption_font_size_tablet = '18'; endif;
$button_font_size_tablet = isset( $options['button_font_size_tablet'] ) ? $options['button_font_size_tablet'] : '14';
if( !is_numeric($button_font_size_tablet) ): $button_font_size_tablet = '14'; endif;
$title_font_size_small_tablet = isset( $options['title_font_size_small_tablet'] ) ? $options['title_font_size_small_tablet'] : '28';
if( !is_numeric($title_font_size_small_tablet) ): $title_font_size_small_tablet = '28'; endif;
$caption_font_size_small_tablet = isset( $options['caption_font_size_small_tablet'] ) ? $options['caption_font_size_small_tablet'] : '16';
if( !is_numeric($caption_font_size_small_tablet) ): $caption_font_size_small_tablet = '16'; endif;
$button_font_size_small_tablet = isset( $options['button_font_size_small_tablet'] ) ? $options['button_font_size_small_tablet'] : '14';
if( !is_numeric($button_font_size_small_tablet) ): $button_font_size_small_tablet = '14'; endif;
$title_font_size_mobile = isset( $options['title_font_size_mobile'] ) ? $options['title_font_size_mobile'] : '18';
if( !is_numeric($title_font_size_mobile) ): $title_font_size_mobile = '18'; endif;
$caption_font_size_mobile = isset( $options['caption_font_size_mobile'] ) ? $options['caption_font_size_mobile'] : '20';
if( !is_numeric($caption_font_size_mobile) ): $caption_font_size_mobile = '20'; endif;
$button_font_size_mobile = isset( $options['button_font_size_mobile'] ) ? $options['button_font_size_mobile'] : '12';
if( !is_numeric($button_font_size_mobile) ): $button_font_size_mobile = '12'; endif;

$custom_css = isset( $options['custom_css'] ) ? $options['custom_css'] : '';
?>
<style type="text/css">
	<?php if( !empty($title_font_import) ): ?>
	<?php echo $title_font_import; ?>
	.penci-slider .pencislider-container .pencislider-content .pencislider-title { font-family: '<?php echo $title_font; ?>', sans-serif; }
	<?php endif; ?>
	<?php if( !empty($caption_font_import) ): ?>
	<?php echo $caption_font_import; ?>
	.penci-slider .pencislider-container .pencislider-content .pencislider-caption { font-family: '<?php echo $caption_font; ?>', sans-serif; }
	<?php endif; ?>
	<?php if( !empty($button_font_import) ): ?>
	<?php echo $button_font_import; ?>
	.penci-slider .pencislider-container .pencislider-content .pencislider-button { font-family: '<?php echo $button_font; ?>', sans-serif; }
	<?php endif; ?>

	<?php if( $title_off_uppercase == '1' ): ?>.penci-slider .pencislider-container .pencislider-content .pencislider-title { text-transform: none; }<?php endif; ?>
	.penci-slider ul.slides li:before {  opacity: <?php echo $overlay_opacity; ?>; }
	.penci-slider .pencislider-container .pencislider-content .pencislider-title { font-size: <?php echo $title_font_size; ?>px; font-weight: <?php echo $title_font_weight; ?>; }
	.penci-slider .pencislider-container .pencislider-content .pencislider-caption { font-size: <?php echo $caption_font_size; ?>px; font-weight: <?php echo $caption_font_weight; ?>; }
	.penci-slider .pencislider-container .pencislider-content .pencislider-button { font-size: <?php echo $button_font_size; ?>px; font-weight: <?php echo $button_font_weight; ?>; }
	@media screen and (max-width: 1024px) and (min-width: 769px) {
		.penci-slider .pencislider-container .pencislider-content .pencislider-title { font-size: <?php echo $title_font_size_tablet; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-caption { font-size: <?php echo $caption_font_size_tablet; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-button { font-size: <?php echo $button_font_size_tablet; ?>px; }
	}
	@media screen and (max-width: 768px) and (min-width: 480px) {
		.penci-slider .pencislider-container .pencislider-content .pencislider-title { font-size: <?php echo $title_font_size_small_tablet; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-caption { font-size: <?php echo $caption_font_size_small_tablet; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-button { font-size: <?php echo $button_font_size_small_tablet; ?>px; }
	}
	@media screen and (max-width: 479px) {
		.penci-slider .pencislider-container .pencislider-content .pencislider-title { font-size: <?php echo $title_font_size_mobile; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-caption { font-size: <?php echo $caption_font_size_mobile; ?>px; }
		.penci-slider .pencislider-container .pencislider-content .pencislider-button { font-size: <?php echo $button_font_size_mobile; ?>px; }
	}
</style>
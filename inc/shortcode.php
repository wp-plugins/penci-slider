<?php
/**
 * Add pencislider shortcode
 * You can use shortcode to display pencislider everywhere
 *
 * @since  1.0
 * @author PenciDesign ( http://pencidesign.com/ )
 */

if ( ! function_exists( 'pencislider_func_shortcode' ) ) {
	function pencislider_func_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'container'  => '',
			'category'   => '',
			'height'   	 => '',
			'order'   	 => 'ASC',
			'transition' => 'slide',
			'autoplay'   => 'true',
			'arrow'      => 'true',
			'bullet'     => 'true',
			'loop'       => 'true',
			'parallax'   => 'true',
		), $atts ) );

		/* Set default value when properties is not valid */
		if ( ! is_numeric( $container ) ) : $container = '1000'; endif;
		if ( ! is_numeric( $height ) ) : $height = ''; endif;
		if ( $order != 'DESC' && $order != 'desc' ) : $order = 'ASC'; endif;
		$order = strtoupper($order);
		if ( $transition != 'fade' ) : $transition = 'slide'; endif;
		if ( $autoplay != 'false' ): $autoplay = 'true'; endif;
		if ( $arrow != 'false' ): $arrow = 'true'; endif;
		if ( $bullet != 'false' ): $bullet = 'true'; endif;
		if ( $loop != 'false' ): $loop = 'true'; endif;
		$parallax_class = '';
		if ( $parallax != 'false' ): $parallax_class = ' pencislider-parallax'; endif;
		$rand = rand( 100, 999999 );

		/* Display Portfolio */
		global $wp_query, $post;
		$slider_args = array(
			'post_type' => 'penci_slider',
			'order'   	 => $order,
		);

		$category = trim( $category );
		if ( ! empty( $category ) ) :
			$slider_args['tax_query'] = array(
				array(
					'taxonomy' => 'slider-category',
					'field'    => 'name',
					'terms'    => $category,
				)
			);
		endif;

		$slider_query = new WP_Query( $slider_args );

		if ( ! $slider_query->have_posts() ) {
			return;
		}

		wp_enqueue_script( 'penci-slider-min-js');
		wp_enqueue_script( 'penci-slider-js');

		/* Get data size for heading title, caption and button */
		$options         = get_option( 'penci_slider_options' );
		$title_font_size = isset( $options['title_font_size'] ) ? $options['title_font_size'] : '42';
		$title_font_size = is_numeric( $title_font_size ) ? $title_font_size : '42';
		$caption_font_size = isset( $options['caption_font_size'] ) ? $options['caption_font_size'] : '20';
		$caption_font_size = is_numeric($caption_font_size) ? $caption_font_size : '42';
		$button_font_size = isset( $options['button_font_size'] ) ? $options['button_font_size'] : '14';
		$button_font_size = is_numeric($button_font_size) ? $button_font_size : '42';

		ob_start();
		?>

		<div class="penci-clear"></div>
		<style type="text/css">
			#pencislider-<?php echo $rand; ?> .pencislider-content {max-width: <?php echo $container; ?>px;}
			<?php if( !empty($height) ): ?>
			#pencislider-<?php echo $rand; ?> {height: <?php echo $height; ?>px;}
			@media screen and (max-width: 768px) {#pencislider-<?php echo $rand; ?> {height: auto;}}
			<?php endif; ?>
		</style>
		<div id="pencislider-<?php echo $rand; ?>" class="penci-slider loading<?php if( !empty($height) ): echo ' fixed-height'; endif; ?><?php echo $parallax_class; ?>" data-transition="<?php echo $transition; ?>"<?php if( !empty($height) ): echo ' data-height="'. $height .'"'; endif; ?> data-autoplay="<?php echo $autoplay; ?>" data-arrow="<?php echo $arrow; ?>" data-bullet="<?php echo $bullet; ?>" data-loop="<?php echo $loop; ?>">
			<ul class="slides">
				<?php while ( $slider_query->have_posts() ): $slider_query->the_post();
					/* Get data of this slide */
					$image_url    = get_post_meta( $post->ID, '_penci_slider_image', true ); $image_url    = ! $image_url ? '' : $image_url;
					$slider_title = get_post_meta( $post->ID, '_penci_slider_title', true ); $slider_title = ! $slider_title ? '' : $slider_title;
					$caption      = get_post_meta( $post->ID, '_penci_slider_caption', true ); $caption      = ! $caption ? '' : $caption;
					$button_text  = get_post_meta( $post->ID, '_penci_slider_button', true ); $button_text  = ! $button_text ? '' : $button_text;
					$title_color  = get_post_meta( $post->ID, '_penci_slider_title_color', true ); $title_style  = ! $title_color ? '' : ' style="color: '. $title_color .'"';
					$caption_color  = get_post_meta( $post->ID, '_penci_slider_caption_color', true ); $caption_style  = ! $caption_color ? '' : ' style="color: '. $caption_color .'"';
					$button_bg  = get_post_meta( $post->ID, '_penci_slider_button_bg', true ); $button_bg  = ! $button_bg ? '' : 'background: '. $button_bg.';';
					$button_color  = get_post_meta( $post->ID, '_penci_slider_button_text_color', true ); $button_color  = ! $button_color ? '' : 'color: '. $button_color;
					$animation  = get_post_meta( $post->ID, '_penci_slide_element_animation', true ); $animation  = ! $animation ? 'fadeInUp' : $animation;

					$style_button = '';
					if( !empty( $button_bg ) || !empty( $button_color ) ): $style_button = ' style="'. $button_bg . $button_color .'"'; endif;
					$button_html  = '';

					if ( ! empty( $button_text ) ) {
						$button_html = '<div class="button"><a class="pencislider-button" data-size="'. $button_font_size .'"'.$style_button.'>' . $button_text . '</a></div>';
						$button_url  = get_post_meta( $post->ID, '_penci_slider_button_url', true );
						$button_url  = ! $button_url ? '' : $button_url;
						if ( ! empty( $button_url ) ):
							$button_html = '<div class="button"><a class="pencislider-button"'.$style_button.' data-size="'. $button_font_size .'" href="' . $button_url . '">' . $button_text . '</a></div>';
						endif;
					}
					$slider_align = get_post_meta( $post->ID, '_penci_slide_alignment', true );
					$slider_align = ! $slider_align ? 'left' : $slider_align;

					if( !empty( $image_url ) ):
					?>
					<li class="pencislider-item">
						<img src="<?php echo $image_url; ?>" alt="<?php _e( 'Slider item', 'pencidesign' ); ?>" />
						<div class="pencislider-container penci-<?php echo $animation?> align-<?php echo $slider_align; ?>">
							<div class="pencislider-content">
								<?php if( !empty( $slider_title ) ): ?>
								<h2 class="pencislider-title"<?php echo $title_style; ?> data-size="<?php echo $title_font_size; ?>"><?php echo $slider_title; ?></h2>
								<?php endif; ?>
								<?php if( !empty( $caption ) ): ?>
									<p class="pencislider-caption"<?php echo $caption_style; ?> data-size="<?php echo $caption_font_size; ?>"><?php echo $caption; ?></p>
								<?php endif; ?>
								<?php echo $button_html; ?>
							</div>
						</div>
					</li>
					<?php endif; /* Not display slide if this no image thumbnail */ ?>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</ul>
		</div>

		<?php
		$return = ob_get_clean();

		return $return;
	}

	add_shortcode( 'penci_slider', 'pencislider_func_shortcode' );
}
?>
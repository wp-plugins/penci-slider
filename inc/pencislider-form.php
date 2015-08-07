<div class="wrap">
	<h2><?php _e( 'Penci Slider Options', 'pencidesign' ); ?></h2>
	<!-- Plugin Options Form -->
	<form method="post" action="options.php" enctype="multipart/form-data" novalidate>
		<?php
		wp_enqueue_script( 'pencislider-admin-js');
		settings_fields( 'penci_slider_options' );
		$plugin_options = get_option( 'penci_slider_options' );
		$fonts = pencislider_google_fonts();
		$weights = pencislider_font_weight();
		?>
		<h2 class="nav-tab-wrapper kang-tabs">
			<a href="#general-options" class="nav-tab general-options nav-tab-active"><?php _e( 'General options', 'pencidesign' ); ?></a>
			<a href="#responsive-design-options" class="nav-tab responsive-design-options"><?php _e( 'Responsive Design Options', 'pencidesign' ); ?></a>
		</h2>
		<div class="kang-tabs-content">
			<!-- Plugin Text Options -->
			<div class="general-options">
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Titlte Font:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[title_font]">
							<?php foreach( $fonts as $font ): ?>
							<option value="<?php echo $font; ?>" <?php selected( $plugin_options['title_font'], $font ); ?>><?php echo $font; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label>&nbsp;</label>
					</div>
					<div class="kang-settings-input">
						<input type="checkbox" name="penci_slider_options[title_off_uppercase]" <?php checked( (bool) $plugin_options['title_off_uppercase'], true ); ?> /><span class="penci-more-detail"><?php _e( 'Turn Off Uppercase In Slide Title', 'pencidesign'); ?></span>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Title Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[title_font_size]" value="<?php echo esc_attr( $plugin_options['title_font_size'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide title, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Titlte Font Weight:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[title_font_weight]">
							<?php foreach( $weights as $weight ): ?>
								<option value="<?php echo $weight; ?>" <?php selected( $plugin_options['title_font_weight'], $weight ); ?>><?php echo $weight; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[caption_font]">
							<?php foreach( $fonts as $font ): ?>
								<option value="<?php echo $font; ?>" <?php selected( $plugin_options['caption_font'], $font ); ?>><?php echo $font; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[caption_font_size]" value="<?php echo esc_attr( $plugin_options['caption_font_size'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide caption, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font Weight:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[caption_font_weight]">
							<?php foreach( $weights as $weight ): ?>
								<option value="<?php echo $weight; ?>" <?php selected( $plugin_options['caption_font_weight'], $weight ); ?>><?php echo $weight; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[button_font]">
							<?php foreach( $fonts as $font ): ?>
								<option value="<?php echo $font; ?>" <?php selected( $plugin_options['button_font'], $font ); ?>><?php echo $font; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[button_font_size]" value="<?php echo esc_attr( $plugin_options['button_font_size'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide button, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font Weight:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[button_font_weight]">
							<?php foreach( $weights as $weight ): ?>
								<option value="<?php echo $weight; ?>" <?php selected( $plugin_options['button_font_weight'], $weight ); ?>><?php echo $weight; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Pattern Opacity:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<select name="penci_slider_options[overlay_opacity]">
							<?php
							$opacity = array( '0', '0.05', '0.1', '0.15', '0.2', '0.25', '0.3', '0.35', '0.4', '0.45', '0.5', '0.55', '0.6', '0.65', '0.7', '0.75', '0.8', '0.85', '0.9', '0.95', '1' );
							foreach( $opacity as $opa ): ?>
								<option value="<?php echo $opa; ?>" <?php selected( $plugin_options['overlay_opacity'], $opa ); ?>><?php echo $opa; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Custom CSS:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<textarea rows="8" cols="47" name="penci_slider_options[custom_css]"><?php echo esc_textarea( $plugin_options['custom_css'] ); ?></textarea>
					</div>
				</div>
			</div>
			<div class="responsive-design-options">
				<h3 class="penci-admin-h3"><?php _e( 'Options in This Tab for Tablet, Small Tablet and Mobile Device', 'pencidesign' ); ?></h3>
				<h4 class="penci-admin-h4"><span><?php _e( 'Settings for Tablet Device', 'pencidesign' ); ?></span></h4>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Title Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[title_font_size_tablet]" value="<?php echo esc_attr( $plugin_options['title_font_size_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide title, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[caption_font_size_tablet]" value="<?php echo esc_attr( $plugin_options['caption_font_size_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide caption, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[button_font_size_tablet]" value="<?php echo esc_attr( $plugin_options['button_font_size_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide button, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<h4 class="penci-admin-h4"><span><?php _e( 'Settings for Small Tablet Device', 'pencidesign' ); ?></span></h4>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Title Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[title_font_size_small_tablet]" value="<?php echo esc_attr( $plugin_options['title_font_size_small_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide title, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[caption_font_size_small_tablet]" value="<?php echo esc_attr( $plugin_options['caption_font_size_small_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide caption, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[button_font_size_small_tablet]" value="<?php echo esc_attr( $plugin_options['button_font_size_small_tablet'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide button, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<h4 class="penci-admin-h4"><span><?php _e( 'Settings for Mobile Device', 'pencidesign' ); ?></span></h4>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Title Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[title_font_size_mobile]" value="<?php echo esc_attr( $plugin_options['title_font_size_mobile'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide title, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Caption Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[caption_font_size_mobile]" value="<?php echo esc_attr( $plugin_options['caption_font_size_mobile'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide caption, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
				<div class="kang-settings-field">
					<div class="kang-settings-label">
						<label><?php _e( 'Slide Button Font Size:', 'pencidesign' ); ?></label>
					</div>
					<div class="kang-settings-input">
						<input type="number" style="width: 60px;" class="regular-text" name="penci_slider_options[button_font_size_mobile]" value="<?php echo esc_attr( $plugin_options['button_font_size_mobile'] ); ?>" /><span class="penci-more-detail"> px</span>
						<p class="description"><?php _e( 'Font size for slide button, only numeric value, unit is pixel', 'pencidesign' ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<p class="submit">
			<?php submit_button( __( 'Save', 'pencidesign' ), 'primary', 'submit', false ); ?>
		</p>
	</form>
</div>
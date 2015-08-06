<?php
/*
Plugin Name: Penci Slider
Plugin URI: http://pencidesign.com/
Description: Easy to create a WordPress slider, full responsive, nice element transition and SEO optimized.
Version: 1.0
Author: PenciDesign
Author URI: http://pencidesign.com/
License: GPLv2 or later
Text Domain: pencidesign

Copyright @2015  PenciDesign  ( email: pencidesign@gmail.com or phamanhtuan1208@gmail.com )
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Define
 */
define( 'PENCI_SLIDER_DIR', plugin_dir_path( __FILE__ ) );
define( 'PENCI_SLIDER_URL', plugin_dir_url( __FILE__ ) );

/**
 * Penci_Slider_Main_Class Class
 *
 * This class will run main modules of plugin
 */
if ( ! class_exists( 'Penci_Slider_Main_Class' ) ) :

	class Penci_Slider_Main_Class {

		/**
		 * A reference to an instance of this class.
		 */
		private static $instance;


		/**
		 * Returns an instance of this class.
		 */
		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new Penci_Slider_Main_Class();
			}

			return self::$instance;

		}

		/**
		 * Global plugin version
		 */
		static $version = '1.0';

		/**
		 * Penci_Slider_Main_Class Constructor.
		 *
		 * @access public
		 * @return Penci_Slider_Main_Class
		 * @since  1.0
		 */
		public function __construct() {
			// Include files
			include_once( 'inc/functions.php' );
			include_once( 'inc/shortcode.php' );
			include_once( 'inc/fonts.php' );
			include_once( 'mce/mce.php' );

			// Register PenciSlider Post Type
			add_action( 'init', array( $this, 'register_pencislider_post_type' ) );

			// Register PenciSlider Categories
			add_action( 'init', array( $this, 'register_pencislider_categories' ) );

			// Add pencislider meta
			add_action( 'add_meta_boxes', array( $this, 'pencislider_meta_boxes' ) );

			// Change default column title
			add_filter( 'manage_penci_slider_posts_columns', array( $this, 'penci_slider_modify_table_title' ) );

			// Add columns to manage columns pencislider
			add_filter( 'manage_edit-penci_slider_columns', array( $this, 'add_columns_penci_slider' ) );

			// Custom columns pencislider
			add_action( 'manage_penci_slider_posts_custom_column', array( $this, 'penci_slider_custom_columns' ), 10, 2 );

			// Enqueue media
			add_action( 'admin_print_styles', array( $this, 'enqueue_media' ) );

			// load plugin text domain for translations
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );

			// enqueue main style for front-end
			add_action( 'wp_enqueue_scripts', array( $this, 'front_style' ) );

			// enqueue script and style in back-end
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );

			// add settings link to plugins page
			add_filter( 'plugin_action_links', array( $this, 'add_settings_links' ), 10, 2 );

			// register admin options
			add_action( 'admin_init', array( $this, 'admin_options' ) );

			// add plugin options page
			add_action( 'admin_menu', array( $this, 'add_options_page' ) );

			// add custom options
			add_action( 'wp_head', array( $this, 'custom_options' ) );
		}

		/**
		 * Register PenciSlider Post Type
		 * @since 1.0
		 */
		public function register_pencislider_post_type() {
			$labels = array(
				'name'          => __( 'Slides', 'taxonomy general name', 'pencidesign' ),
				'singular_name' => __( 'Slide', 'pencidesign' ),
				'search_items'  => __( 'Search Slides', 'pencidesign' ),
				'all_items'     => __( 'All Slides', 'pencidesign' ),
				'parent_item'   => __( 'Parent Slide', 'pencidesign' ),
				'edit_item'     => __( 'Edit Slide', 'pencidesign' ),
				'update_item'   => __( 'Update Slide', 'pencidesign' ),
				'add_new_item'  => __( 'Add New Slide', 'pencidesign' ),
				'menu_name'     => __( 'Penci Slider', 'pencidesign' )
			);

			$pencislider_icon = PENCI_SLIDER_URL . '/images/penci-icon.png';

			$args = array(
				'labels'              => $labels,
				'singular_label'      => __( 'Penci Slider', 'pencidesign' ),
				'public'              => false,
				'show_ui'             => true,
				'hierarchical'        => false,
				'menu_position'       => 10,
				'menu_icon'           => $pencislider_icon,
				'exclude_from_search' => true,
				'supports'            => false
			);

			register_post_type( 'penci_slider', $args );
		}

		/**
		 * Register PenciSlider Categories
		 * @since 1.0
		 */
		public function register_pencislider_categories() {
			$slider_locations_labels = array(
				'name'          => __( 'Slider Categories', 'pencidesign' ),
				'singular_name' => __( 'Slider Category', 'pencidesign' ),
				'search_items'  => __( 'Search Slider Categories', 'pencidesign' ),
				'all_items'     => __( 'All Slider Categories', 'pencidesign' ),
				'edit_item'     => __( 'Edit Slider Category', 'pencidesign' ),
				'update_item'   => __( 'Update Slider Category', 'pencidesign' ),
				'add_new_item'  => __( 'Add New Slider Category', 'pencidesign' ),
				'new_item_name' => __( 'New Slider Category', 'pencidesign' ),
				'menu_name'     => __( 'Slider Categories', 'pencidesign' )
			);

			register_taxonomy( 'slider-category', array( 'penci_slider' ), array(
				'hierarchical' => true,
				'labels'       => $slider_locations_labels,
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => array( 'slug' => 'slider-category' )
			) );
		}

		/**
		 * Add pencislider meta boxes
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function pencislider_meta_boxes() {
			$meta_box = array(
				'id'          => 'pencislider-meta',
				'title'       => __( 'Slide Settings', 'pencidesign' ),
				'description' => __( 'Choose image and fill to fields bellow to save all slide settings', 'pencidesign' ),
				'post_type'   => 'penci_slider',
				'context'     => 'normal',
				'priority'    => 'high',
				'fields'      => array(
					array(
						'name' => __( 'Slide Image', 'pencidesign' ),
						'desc' => __( 'The image should be between 1600px - 2000px in width and have a minimum height of 650px for best results. Click the "Upload" button to begin uploading your image', 'pencidesign' ),
						'id'   => '_penci_slider_image',
						'type' => 'file',
						'std'  => ''
					),
					array(
						'name' => __( 'Slide Title', 'pencidesign' ),
						'desc' => __( 'Fill the slide title', 'pencidesign' ),
						'id'   => '_penci_slider_title',
						'type' => 'text',
						'std'  => ''
					),
					array(
						'name' => __( 'Slide Title Color', 'pencidesign' ),
						'desc' => __( 'Color for Slide Title', 'pencidesign' ),
						'id'   => '_penci_slider_title_color',
						'type' => 'color',
						'std'  => '#ffffff'
					),
					array(
						'name' => __( 'Slide Caption', 'pencidesign' ),
						'desc' => __( 'Fill the slide caption', 'pencidesign' ),
						'id'   => '_penci_slider_caption',
						'type' => 'textarea',
						'std'  => ''
					),
					array(
						'name' => __( 'Slide Caption Color', 'pencidesign' ),
						'desc' => __( 'Color for Slide Caption', 'pencidesign' ),
						'id'   => '_penci_slider_caption_color',
						'type' => 'color',
						'std'  => '#ffffff'
					),
					array(
						'name' => __( 'Button Text', 'pencidesign' ),
						'desc' => __( 'If you would like a button to appear below your slide caption, please fill the text for it here.', 'pencidesign' ),
						'id'   => '_penci_slider_button',
						'type' => 'text',
						'std'  => ''
					),
					array(
						'name' => __( 'Button Background Color', 'pencidesign' ),
						'desc' => __( 'Background for Button', 'pencidesign' ),
						'id'   => '_penci_slider_button_bg',
						'type' => 'color',
						'std'  => '#FD544F'
					),
					array(
						'name' => __( 'Button Text Color', 'pencidesign' ),
						'desc' => __( 'Text Color for Button', 'pencidesign' ),
						'id'   => '_penci_slider_button_text_color',
						'type' => 'color',
						'std'  => '#ffffff'
					),
					array(
						'name' => __( 'Button Link', 'pencidesign' ),
						'desc' => __( 'Fill the URL for slide button here.', 'pencidesign' ),
						'id'   => '_penci_slider_button_url',
						'type' => 'text',
						'std'  => ''
					),
					array(
						'name'    => __( 'Slide Alignment', 'pencidesign' ),
						'desc'    => __( 'Select the alignment for your caption and button.', 'pencidesign' ),
						'id'      => '_penci_slide_alignment',
						'type'    => 'select',
						'options' => array(
							'left'   => 'Left',
							'center' => 'Center',
							'right'  => 'Right',
						),
						'std'     => 'left'
					),
					array(
						'name'    => __( 'Elements Animation', 'pencidesign' ),
						'desc'    => __( 'Choose Animation of Slide title, Caption and Button when slide is active', 'pencidesign' ),
						'id'      => '_penci_slide_element_animation',
						'type'    => 'select',
						'options' => array(
							'fadeInUp'    => 'fadeInUp',
							'fadeInDown'  => 'fadeInDown',
							'fadeInLeft'  => 'fadeInLeft',
							'fadeInRight' => 'fadeInRight',
						),
						'std'     => 'fadeInUp'
					)
				)
			);
			$callback = create_function( '$post,$meta_box', 'pencislider_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
		}

		/**
		 * Change title default for Actions
		 *
		 * @access public
		 * @return array new $defaults
		 * @since  1.0
		 */
		public function penci_slider_modify_table_title( $defaults ) {
			$defaults['title'] = 'Actions';

			return $defaults;
		}

		/**
		 * Add thumbnail & caption columns
		 *
		 * @access public
		 * @return array $columns
		 * @since  1.0
		 */
		public function add_columns_penci_slider( $columns ) {
			$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
			$column_caption   = array( 'caption' => 'Caption' );
			$columns          = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
			$columns          = array_slice( $columns, 0, 2, true ) + $column_caption + array_slice( $columns, 2, null, true );

			return $columns;
		}

		/**
		 * Enqueue media to use choose image in a slide
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function penci_slider_custom_columns( $column, $post_id ) {
			switch ( $column ) {
				case 'thumbnail':
					$thumbnail = get_post_meta( $post_id, '_penci_slider_image', true );

					if ( ! empty( $thumbnail ) ) {
						echo '<a href="' . get_admin_url() . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
					}
					else {
						echo '<a href="' . get_admin_url() . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . PENCI_SLIDER_URL . '/images/no-thumb.jpg" /></a>' . '<strong><a class="row-title" href="' . get_admin_url() . 'post.php?post=' . $post_id . '&action=edit">No image added yet</a></strong>';
					}
					break;

				case 'caption':
					$caption = get_post_meta( $post_id, '_penci_slider_caption', true );
					$title   = get_post_meta( $post_id, '_penci_slider_title', true );
					echo '<h2>' . $title . '</h2><p>' . $caption . '</p>';
					break;

				default:
					break;
			}
		}

		/**
		 * Enqueue media to use choose image in a slide
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function enqueue_media() {
			//enqueue the correct media scripts for the media library
			wp_enqueue_script( 'opts-field-upload-js', PENCI_SLIDER_URL . '/js/field_upload.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_media();
		}

		/**
		 * Transition ready
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function load_text_domain() {
			load_plugin_textdomain( 'pencidesign', false, PENCI_SLIDER_DIR . '/languages/' );
		}

		/**
		 * Register style and script and will enqueue when shortcodes used
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function front_style() {
			wp_enqueue_style( 'penci-slider-css', PENCI_SLIDER_URL . '/css/pencislider.css' );
			wp_register_script( 'penci-slider-min-js', PENCI_SLIDER_URL . '/js/script.min.js', array( 'jquery' ), self::$version, true );
			wp_register_script( 'penci-slider-js', PENCI_SLIDER_URL . '/js/pencislider.js', array( 'jquery' ), self::$version, true );
		}

		/**
		 * Enqueue script and style in back-end
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function admin_enqueue() {
			wp_enqueue_style( 'pencislider-admin-css', PENCI_SLIDER_URL . '/css/admin.css' );
			wp_register_script( 'pencislider-admin-js', PENCI_SLIDER_URL . '/js/admin.js', false, self::$version );
		}

		/**
		 * Applied to the list of links to display on the plugins page
		 *
		 * @access public
		 *
		 * @param  array $actions
		 * @param  string $plugin_file
		 * @return array
		 * @since  1.0
		 */
		public function add_settings_links( $actions, $plugin_file ) {

			if ( ! isset( $plugin ) )
				$plugin = plugin_basename( __FILE__ );
			if ( $plugin == $plugin_file ) {

				$settings     = array( 'settings' => '<a style="color: #ff0000;" href="' . admin_url( 'options-general.php?page=penci-slider-options' ) . '">' . __( 'Settings', 'pencidesign' ) . '</a>' );
				$support_link = array( 'support' => '<a style="color: #ff0000;" href="http://support.pencidesign.com/" target="_blank">' . __( 'Support', 'pencidesign' ) . '</a>' );
				$more_link    = array( 'more' => '<a style="color: #ff0000;" href="http://themeforest.net/user/pencidesign/portfolio" target="_blank">' . __( 'Need A Theme', 'pencidesign' ) . '</a>' );

				$actions = array_merge( $settings, $actions );
				$actions = array_merge( $support_link, $actions );
				$actions = array_merge( $more_link, $actions );

			}

			return $actions;
		}

		/**
		 * Whitelist plugin options
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function admin_options() {
			register_setting( 'penci_slider_options', 'penci_slider_options', array( $this, 'validate_options' ) );
		}

		/**
		 * Sanitize and validate options
		 *
		 * @access public
		 *
		 * @param  array $input
		 *
		 * @return array $options default
		 * @since  1.0
		 */
		public function validate_options( $input ) {

			$options  = array();
			$defaults = array(
				'title_font'                     => 'Default',
				'title_off_uppercase'            => '0',
				'title_font_size'                => '42',
				'title_font_weight'              => 'normal',
				'caption_font'                   => 'Open Sans',
				'caption_font_size'              => '20',
				'caption_font_weight'            => 'normal',
				'button_font'                    => 'Default',
				'button_font_size'               => '14',
				'button_font_weight'             => 'normal',
				'overlay_opacity'                => '0.4',
				'title_font_size_tablet'         => '36',
				'caption_font_size_tablet'       => '18',
				'button_font_size_tablet'        => '14',
				'title_font_size_small_tablet'   => '28',
				'caption_font_size_small_tablet' => '16',
				'button_font_size_small_tablet'  => '14',
				'title_font_size_mobile'         => '18',
				'caption_font_size_mobile'       => '14',
				'button_font_size_mobile'        => '12',
				'custom_css'                     => ''
			);

			foreach ( $defaults as $name => $val ) {
				$options[$name] = isset( $input[$name] ) ? $input[$name] : $val;
			}

			return $options;
		}

		/**
		 * Add options page of plugin
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function add_options_page() {
			add_options_page( __( 'Penci Slider General Options', 'pencidesign' ), __( 'Penci Slider Options', 'pencidesign' ), 'manage_options', 'penci-slider-options', array(
				$this,
				'plugin_form'
			) );
		}

		/**
		 * Render the Plugin options form
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function plugin_form() {
			include( 'inc/pencislider-form.php' );
		}

		/**
		 * Add your custom in general to style
		 *
		 * @access public
		 * @return void
		 * @since  1.0
		 */
		public function custom_options() {
			include( 'inc/style.php' );
		}
	}

	add_action( 'plugins_loaded', array( 'Penci_Slider_Main_Class', 'get_instance' ) );

endif; // End Check if Class Not Exists
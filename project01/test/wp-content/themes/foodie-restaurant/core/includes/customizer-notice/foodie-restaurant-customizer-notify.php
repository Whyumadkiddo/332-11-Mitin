<?php

class Foodie_Restaurant_Customizer_Notify {

	private $config = array(); // Declare $config property
	
	private $foodie_restaurant_recommended_actions;
	
	private $recommended_plugins;
	
	private static $instance;
	
	private $foodie_restaurant_recommended_actions_title;
	
	private $foodie_restaurant_recommended_plugins_title;
	
	private $dismiss_button;
	
	private $foodie_restaurant_install_button_label;
	
	private $foodie_restaurant_activate_button_label;
	
	private $foodie_restaurant_deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Foodie_Restaurant_Customizer_Notify ) ) {
			self::$instance = new Foodie_Restaurant_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $foodie_restaurant_customizer_notify_recommended_plugins;
		global $foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions;

		global $foodie_restaurant_install_button_label;
		global $foodie_restaurant_activate_button_label;
		global $foodie_restaurant_deactivate_button_label;

		$this->foodie_restaurant_recommended_actions = isset( $this->config['foodie_restaurant_recommended_actions'] ) ? $this->config['foodie_restaurant_recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->foodie_restaurant_recommended_actions_title = isset( $this->config['foodie_restaurant_recommended_actions_title'] ) ? $this->config['foodie_restaurant_recommended_actions_title'] : '';
		$this->foodie_restaurant_recommended_plugins_title = isset( $this->config['foodie_restaurant_recommended_plugins_title'] ) ? $this->config['foodie_restaurant_recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$foodie_restaurant_customizer_notify_recommended_plugins = array();
		$foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$foodie_restaurant_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->foodie_restaurant_recommended_actions ) ) {
			$foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions = $this->foodie_restaurant_recommended_actions;
		}

		$foodie_restaurant_install_button_label    = isset( $this->config['foodie_restaurant_install_button_label'] ) ? $this->config['foodie_restaurant_install_button_label'] : '';
		$foodie_restaurant_activate_button_label   = isset( $this->config['foodie_restaurant_activate_button_label'] ) ? $this->config['foodie_restaurant_activate_button_label'] : '';
		$foodie_restaurant_deactivate_button_label = isset( $this->config['foodie_restaurant_deactivate_button_label'] ) ? $this->config['foodie_restaurant_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'foodie_restaurant_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'foodie_restaurant_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'foodie_restaurant_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'foodie_restaurant_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function foodie_restaurant_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'foodie-restaurant-customizer-notify-css', get_template_directory_uri() . '/core/includes/customizer-notice/css/foodie-restaurant-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'foodie-restaurant-customizer-notify-js', get_template_directory_uri() . '/core/includes/customizer-notice/js/foodie-restaurant-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'foodie-restaurant-customizer-notify-js', 'foodierestaurantCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'foodie-restaurant' ),
			)
		);

	}

	
	public function foodie_restaurant_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/core/includes/customizer-notice/foodie-restaurant-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Foodie_Restaurant_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Foodie_Restaurant_Customizer_Notify_Section(
				$wp_customize,
				'foodie-restaurant-customizer-notify-section',
				array(
					'title'          => $this->foodie_restaurant_recommended_actions_title,
					'plugin_text'    => $this->foodie_restaurant_recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function foodie_restaurant_customizer_notify_dismiss_recommended_action_callback() {

		global $foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */ 

		if ( ! empty( $action_id ) ) {
			
			if ( get_option( 'foodie_restaurant_customizer_notify_show' ) ) {

				$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions = get_option( 'foodie_restaurant_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'foodie_restaurant_customizer_notify_show', $foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions );

				
			} else {
				$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions = array();
				if ( ! empty( $foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions ) ) {
					foreach ( $foodie_restaurant_customizer_notify_foodie_restaurant_recommended_actions as $foodie_restaurant_lite_customizer_notify_recommended_action ) {
						if ( $foodie_restaurant_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions[ $foodie_restaurant_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions[ $foodie_restaurant_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'foodie_restaurant_customizer_notify_show', $foodie_restaurant_customizer_notify_show_foodie_restaurant_recommended_actions );
				}
			}
		}
		die(); 
	}

	
	public function foodie_restaurant_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {

			$foodie_restaurant_lite_customizer_notify_show_recommended_plugins = get_option( 'foodie_restaurant_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$foodie_restaurant_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$foodie_restaurant_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'foodie_restaurant_customizer_notify_show_recommended_plugins', $foodie_restaurant_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}

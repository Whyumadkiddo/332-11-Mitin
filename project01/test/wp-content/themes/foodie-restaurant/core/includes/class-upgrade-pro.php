<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Foodie_Restaurant_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/core/includes/upgrade-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Foodie_Restaurant_Customize_Section_Pro' );

		$manager->add_section(
			new Foodie_Restaurant_Customize_Section_Pro(
				$manager,
				'foodie_restaurant_upgrade_pro',
				array(
					'title'       => esc_html__( 'Upgrade to Restaurant PRO', 'foodie-restaurant' ),
					'description' => esc_html__( 'Unlock premium features: Multiple Sections, Color Pallete, Typography, Premium Support and much more...', 'foodie-restaurant' ),
					'pro_text'    => esc_html__( 'View Restaurant PRO', 'foodie-restaurant' ),
					'pro_url'     => 'https://www.misbahwp.com/products/fast-food-wordpress-theme',
					'pro_demo_text'    => esc_html__( 'View Demo', 'foodie-restaurant' ),
					'pro_demo_url'     => 'https://demo.misbahwp.com/foodie-restaurant/',
					'priority'    => 1,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'foodie-restaurant-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'foodie-restaurant-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Foodie_Restaurant_Customize::get_instance();

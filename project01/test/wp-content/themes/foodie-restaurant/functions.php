<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function foodie_restaurant_enqueue_google_fonts() {
	wp_enqueue_style( 'google-fonts-lexend', 'https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap' );
}
add_action( 'wp_enqueue_scripts', 'foodie_restaurant_enqueue_google_fonts' );

if (!function_exists('foodie_restaurant_enqueue_scripts')) {

	function foodie_restaurant_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('foodie-restaurant-style', get_stylesheet_uri(), array() );

		wp_style_add_data('foodie-restaurant-style', 'rtl', 'replace');

		wp_enqueue_style(
			'foodie-restaurant-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'foodie-restaurant-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('dashicons');

		wp_enqueue_script(
			'foodie-restaurant-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'foodie-restaurant-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( get_theme_mod( 'foodie_restaurant_animation_enabled', true ) ) {
		        wp_enqueue_script(
		            'foodie-restaurant-wow-script',
		            get_template_directory_uri() . '/js/wow.js',
		            array( 'jquery' ),
		            '1.0',
		            true
		        );

		        wp_enqueue_style(
		            'foodie-restaurant-animate',
		            get_template_directory_uri() . '/css/animate.css',
		            array(),
		            '4.1.1'
		        );
		    }

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$css = '';

		if ( get_header_image() ) :

			$css .=  '
				#site-navigation,.page-template-frontpage #site-navigation{
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'foodie-restaurant-style', $css );

		// Theme Customize CSS.
		require get_template_directory(). '/core/includes/inline.php';
		wp_add_inline_style( 'foodie-restaurant-style',$foodie_restaurant_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'foodie_restaurant_enqueue_scripts' );

}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('foodie_restaurant_after_setup_theme')) {

	function foodie_restaurant_after_setup_theme() {

		load_theme_textdomain( 'foodie-restaurant', get_stylesheet_directory() . '/languages' );

		if ( ! isset( $content_width ) ) $content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'foodie-restaurant' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'ffffff'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
			'flex-width' => true,
			'flex-height' => true,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100,
			'flex-width' => true,
			'flex-height' => true,
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_editor_style( array( '/css/editor-style.css' ) );
	}

	add_action( 'after_setup_theme', 'foodie_restaurant_after_setup_theme', 999 );

}

require get_template_directory() .'/core/includes/customizer-notice/foodie-restaurant-customizer-notify.php';
require get_template_directory() .'/core/includes/main.php';
require get_template_directory() .'/core/includes/theme-breadcrumb.php';
require get_template_directory() .'/core/includes/tgm.php';
require get_template_directory() . '/core/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function foodie_restaurant_logo_resizer() {

    $foodie_restaurant_theme_logo_size_css = '';
    $foodie_restaurant_logo_resizer = get_theme_mod('foodie_restaurant_logo_resizer');

	$foodie_restaurant_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($foodie_restaurant_logo_resizer).'px !important;
			width: '.esc_attr($foodie_restaurant_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'foodie-restaurant-style',$foodie_restaurant_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'foodie_restaurant_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function foodie_restaurant_global_color() {

    $foodie_restaurant_theme_color_css = '';
    $foodie_restaurant_global_color = get_theme_mod('foodie_restaurant_global_color');
    $foodie_restaurant_global_color_2 = get_theme_mod('foodie_restaurant_global_color_2');
    $foodie_restaurant_copyright_bg = get_theme_mod('foodie_restaurant_copyright_bg');

	$foodie_restaurant_theme_color_css = '
		.wp-block-button__link,span.cart-item-box,#main-menu ul.children li a:hover,#main-menu ul.sub-menu li a:hover,.slider,p.slider-button a:hover,.slider button.owl-prev i, .slider button.owl-next i,#popular-food button.tablinks.active,#popular-food .tablinks:hover,#popular-food .box .box-content,#popular-food .box-content a.added_to_cart.wc-forward,#popular-food span.onsale,#popular-food button.owl-dot.active,.scroll-up a,.pagination .nav-links a:hover,.pagination .nav-links a:focus,.pagination .nav-links span.current,.foodie-restaurant-pagination span.current,.foodie-restaurant-pagination span.current:hover,.foodie-restaurant-pagination span.current:focus,.foodie-restaurant-pagination a span:hover,.foodie-restaurant-pagination a span:focus,.comment-respond input#submit,.comment-reply a,.sidebar-area h4.title, .sidebar-area h1.wp-block-heading,.sidebar-area h2.wp-block-heading,.sidebar-area h3.wp-block-heading,.sidebar-area h4.wp-block-heading,.sidebar-area h5.wp-block-heading,.sidebar-area h6.wp-block-heading,.sidebar-area .wp-block-search__label,.sidebar-area .tagcloud a, p.wp-block-tag-cloud a,.searchform input[type=submit], .sidebar-area .wp-block-search__button,nav.woocommerce-MyAccount-navigation ul li,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce a.added_to_cart{
		background: '.esc_attr($foodie_restaurant_global_color).';
		}
		#popular-food button.owl-dot.active{
		background: '.esc_attr($foodie_restaurant_global_color).'!important;
		}
		@media screen and (min-width: 320px) and (max-width: 767px) {
		    .menu-toggle, .dropdown-toggle,button.close-menu {
		        background: '.esc_attr($foodie_restaurant_global_color).';
		    }
		}
		.searchform input[type=submit]:hover,.searchform input[type=submit]:focus{
		background-color: '.esc_attr($foodie_restaurant_global_color).';
		}
		a:hover,a:focus,#main-menu a:hover,#main-menu ul li a:hover,#main-menu li:hover > a,#main-menu a:focus,#main-menu ul li a:focus,#main-menu li.focus > a,#main-menu li:focus > a,#main-menu ul li.current-menu-item > a,#main-menu ul li.current_page_item > a,#main-menu ul li.current-menu-parent > a,#main-menu ul li.current_page_ancestor > a,#main-menu ul li.current-menu-ancestor > a,.post-meta i,.blog_box h2 ,.contact-info i,.bread_crumb a:hover,.bread_crumb span,.woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price{
			color: '.esc_attr($foodie_restaurant_global_color).';
		}
		a.myacunt-url,p.slider-button a,.slider button.owl-prev i:hover, .slider button.owl-next i:hover,.social-info i:hover,#popular-food .box,#popular-food .box .box-content:hover,#popular-food .tab-product:hover span.onsale,#popular-food .product-details,.comment-respond input#submit:hover,.comment-reply a:hover,.sidebar-area .tagcloud a:hover,nav.woocommerce-MyAccount-navigation ul li:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce a.added_to_cart:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale{
			background: '.esc_attr($foodie_restaurant_global_color_2).';
		}
		#popular-food button.owl-dot{
			background: '.esc_attr($foodie_restaurant_global_color_2).'!important;
		}
		h1,h2,h3,h4,h5,h6,.logo a,.logo span,li.menu-item-has-children:after,#main-menu ul.children li a ,#main-menu ul.sub-menu li a,pre,.blog_box,.blog_box h3,#popular-food h2,#popular-food button.tablinks,{
			color: '.esc_attr($foodie_restaurant_global_color_2).';
		}
		.sidebar-area select,.sidebar-area textarea, #comments textarea,.sidebar-area input[type="text"], #comments input[type="text"],.sidebar-area input[type="password"],.sidebar-area input[type="datetime"],.sidebar-area input[type="datetime-local"],.sidebar-area input[type="date"],.sidebar-area input[type="month"],.sidebar-area input[type="time"],.sidebar-area input[type="week"],.sidebar-area input[type="number"],.sidebar-area input[type="email"],.sidebar-area input[type="url"],.sidebar-area input[type="search"],.sidebar-area input[type="tel"],.sidebar-area input[type="color"],.sidebar-area .uneditable-input,#comments input[type="email"],#comments input[type="url"],.sidebar-area h4.title, .sidebar-area h1.wp-block-heading, .sidebar-area h2.wp-block-heading, .sidebar-area h3.wp-block-heading, .sidebar-area h4.wp-block-heading, .sidebar-area h5.wp-block-heading, .sidebar-area h6.wp-block-heading, .sidebar-area .wp-block-search__label{
			border-color: '.esc_attr($foodie_restaurant_global_color_2).';
		}
    	.copyright {
			background: '.esc_attr($foodie_restaurant_copyright_bg).';
		}
	';
    wp_add_inline_style( 'foodie-restaurant-style',$foodie_restaurant_theme_color_css );
    wp_add_inline_style( 'foodie-restaurant-woocommerce-css',$foodie_restaurant_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'foodie_restaurant_global_color' );


/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('foodie_restaurant_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function foodie_restaurant_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'foodie-restaurant');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'foodie-restaurant'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_html__('%1$s at %2$s', 'foodie-restaurant'), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'foodie-restaurant' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'foodie-restaurant'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for foodie_restaurant_comment()

if (!function_exists('foodie_restaurant_widgets_init')) {

	function foodie_restaurant_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','foodie-restaurant'),
			'id'   => 'foodie-restaurant-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'foodie-restaurant'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 2','foodie-restaurant'),
			'id'   => 'foodie-restaurant-sidebar-2',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'foodie-restaurant'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 3','foodie-restaurant'),
			'id'   => 'foodie-restaurant-sidebar-3',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'foodie-restaurant'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','foodie-restaurant'),
			'id'   => 'foodie-restaurant-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'foodie-restaurant'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'foodie_restaurant_widgets_init' );

}

function foodie_restaurant_get_categories_select() {
	$teh_cats = get_categories();
	$results = array();
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
	if (isset($teh_cats[$i]))
  		$results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
	else
  		$count++;
	}
	return $results;
}

function foodie_restaurant_sanitize_select( $input, $setting ) {
	// Ensure input is a slug
	$input = sanitize_key( $input );

	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function foodie_restaurant_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'foodie_restaurant_loop_columns');
if (!function_exists('foodie_restaurant_loop_columns')) {
	function foodie_restaurant_loop_columns() {
		$foodie_restaurant_columns = get_theme_mod( 'foodie_restaurant_per_columns', 3 );
		return $foodie_restaurant_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'foodie_restaurant_per_page', 20 );
function foodie_restaurant_per_page( $foodie_restaurant_cols ) {
  	$foodie_restaurant_cols = get_theme_mod( 'foodie_restaurant_product_per_page', 9 );
	return $foodie_restaurant_cols;
}

// Add filter to modify the number of related products
add_filter( 'woocommerce_output_related_products_args', 'foodie_restaurant_products_args' );
function foodie_restaurant_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}

add_action('after_switch_theme', 'foodie_restaurant_setup_options');
function foodie_restaurant_setup_options () {
    update_option('dismissed-get_started', FALSE );
}

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($foodie_restaurant, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $foodie_restaurant = array_merge(['wow','zoomIn'], $foodie_restaurant);
	    }
	    return $foodie_restaurant;
	},10,3);
}

add_action( 'customize_register', 'foodie_restaurant_remove_setting', 20 );
function foodie_restaurant_remove_setting( $wp_customize ) {
    // Check if the setting or control exists before removing
    if ( $wp_customize->get_setting( 'header_textcolor' ) ) {
        $wp_customize->remove_setting( 'header_textcolor' );
    }

    if ( $wp_customize->get_control( 'header_textcolor' ) ) {
        $wp_customize->remove_control( 'header_textcolor' );
    }
}?>
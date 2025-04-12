<?php

$foodie_restaurant_custom_css = '';


$foodie_restaurant_is_dark_mode_enabled = get_theme_mod( 'foodie_restaurant_is_dark_mode_enabled', false );

if ( $foodie_restaurant_is_dark_mode_enabled ) {

    $foodie_restaurant_custom_css .= 'body,.fixed-header,tr:nth-child(2n+2),.header,.blog_inner_box,#popular-food .tab-product,.contact-info i {';
    $foodie_restaurant_custom_css .= 'background: #000;';
    $foodie_restaurant_custom_css .= '}';

    $foodie_restaurant_custom_css .= '.some {';
    $foodie_restaurant_custom_css .= 'background: #000 !important;';
    $foodie_restaurant_custom_css .= '}';

	$foodie_restaurant_custom_css .= '.sticky .post-content,.contact-info p, .social-info p{';
    $foodie_restaurant_custom_css .= 'color: #000';
    $foodie_restaurant_custom_css .= '}';

	$foodie_restaurant_custom_css .= 'h5.product-text a,#featured-product p.price,.card-header a,.comment-content.card-block p,.post-box.sticky a,.contact-info a{';
    $foodie_restaurant_custom_css .= 'color: #000 !important';
    $foodie_restaurant_custom_css .= '}';

    $foodie_restaurant_custom_css .= '.some{';
    $foodie_restaurant_custom_css .= 'background: #fff;';
    $foodie_restaurant_custom_css .= '}';

    $foodie_restaurant_custom_css .= '.some {';
    $foodie_restaurant_custom_css .= 'background: #fff !important;';
    $foodie_restaurant_custom_css .= '}';
	

    $foodie_restaurant_custom_css .= 'body,h1,h2,h3,h4,h5,p,#main-menu ul li a,.woocommerce .woocommerce-ordering select, .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea,a,li.menu-item-has-children:after{';
    $foodie_restaurant_custom_css .= 'color: #fff;';
    $foodie_restaurant_custom_css .= '}';

    $foodie_restaurant_custom_css .= 'a.wc-block-components-product-name, .wc-block-components-product-name,.wc-block-components-totals-footer-item .wc-block-components-totals-item__value,
.wc-block-components-totals-footer-item .wc-block-components-totals-item__label,
.wc-block-components-totals-item__label,.wc-block-components-totals-item__value,
.wc-block-components-product-metadata .wc-block-components-product-metadata__description>p,
.is-medium table.wc-block-cart-items .wc-block-cart-items__row .wc-block-cart-item__total .wc-block-components-formatted-money-amount,
.wc-block-components-quantity-selector input.wc-block-components-quantity-selector__input,
.wc-block-components-quantity-selector .wc-block-components-quantity-selector__button,
.wc-block-components-quantity-selector,table.wc-block-cart-items .wc-block-cart-items__row .wc-block-cart-item__quantity .wc-block-cart-item__remove-link,
.wc-block-components-product-price__value.is-discounted,del.wc-block-components-product-price__regular,.logo span,.logo a,#popular-food h5 a{';
    $foodie_restaurant_custom_css .= 'color: #fff !important;';
    $foodie_restaurant_custom_css .= '}';

	$foodie_restaurant_custom_css .= '.post-box{';
    $foodie_restaurant_custom_css .= '    border: 1px solid rgb(229 229 229 / 48%)';
    $foodie_restaurant_custom_css .= '}';
}

	/*---------------------------text-transform-------------------*/

	$foodie_restaurant_text_transform = get_theme_mod( 'menu_text_transform_foodie_restaurant','CAPITALISE');
    if($foodie_restaurant_text_transform == 'CAPITALISE'){

		$foodie_restaurant_custom_css .='#main-menu ul li a{';

			$foodie_restaurant_custom_css .='text-transform: capitalize ; font-size:14px;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_text_transform == 'UPPERCASE'){

		$foodie_restaurant_custom_css .='#main-menu ul li a{';

			$foodie_restaurant_custom_css .='text-transform: uppercase ; font-size: 14px;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_text_transform == 'LOWERCASE'){

		$foodie_restaurant_custom_css .='#main-menu ul li a{';

			$foodie_restaurant_custom_css .='text-transform: lowercase ; font-size: 14px;';

		$foodie_restaurant_custom_css .='}';
	}

		/*---------------------------menu-zoom-------------------*/

		$foodie_restaurant_menu_zoom = get_theme_mod( 'foodie_restaurant_menu_zoom','None');

    if($foodie_restaurant_menu_zoom == 'None'){

		$foodie_restaurant_custom_css .='#main-menu ul li a{';

			$foodie_restaurant_custom_css .='';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_menu_zoom == 'Zoominn'){

		$foodie_restaurant_custom_css .='#main-menu ul li a:hover{';

			$foodie_restaurant_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #fdbd2d;';

		$foodie_restaurant_custom_css .='}';
	}

	/*---------------------------Container Width-------------------*/

$foodie_restaurant_container_width = get_theme_mod('foodie_restaurant_container_width');

		$foodie_restaurant_custom_css .='body{';

			$foodie_restaurant_custom_css .='width: '.esc_attr($foodie_restaurant_container_width).'%; margin: auto;';

		$foodie_restaurant_custom_css .='}';

	/*---------------------------Copyright Text alignment-------------------*/

	$foodie_restaurant_copyright_text_alignment = get_theme_mod( 'foodie_restaurant_copyright_text_alignment','LEFT-ALIGN');

	 if($foodie_restaurant_copyright_text_alignment == 'LEFT-ALIGN'){

			$foodie_restaurant_custom_css .='.copy-text p{';

				$foodie_restaurant_custom_css .='text-align:left;';

			$foodie_restaurant_custom_css .='}';


		}else if($foodie_restaurant_copyright_text_alignment == 'CENTER-ALIGN'){

			$foodie_restaurant_custom_css .='.copy-text p{';

				$foodie_restaurant_custom_css .='text-align:center;';

			$foodie_restaurant_custom_css .='}';


		}else if($foodie_restaurant_copyright_text_alignment == 'RIGHT-ALIGN'){

			$foodie_restaurant_custom_css .='.copy-text p{';

				$foodie_restaurant_custom_css .='text-align:right;';

			$foodie_restaurant_custom_css .='}';

		}

		/*---------------------------Slider-content-alignment-------------------*/

$foodie_restaurant_slider_content_alignment = get_theme_mod( 'foodie_restaurant_slider_content_alignment','LEFT-ALIGN');

 if($foodie_restaurant_slider_content_alignment == 'LEFT-ALIGN'){

		$foodie_restaurant_custom_css .='.blog_box{';

			$foodie_restaurant_custom_css .='text-align:left;';

		$foodie_restaurant_custom_css .='}';


	}else if($foodie_restaurant_slider_content_alignment == 'CENTER-ALIGN'){

		$foodie_restaurant_custom_css .='.blog_box{';

			$foodie_restaurant_custom_css .='text-align:center; right:30%; left:30%;';

		$foodie_restaurant_custom_css .='}';


	}else if($foodie_restaurant_slider_content_alignment == 'RIGHT-ALIGN'){

		$foodie_restaurant_custom_css .='.blog_box{';

			$foodie_restaurant_custom_css .='text-align:right; right:20%; left:50%;';

		$foodie_restaurant_custom_css .='}';

	}

	/*---------------------------related Product Settings-------------------*/


$foodie_restaurant_related_product_setting = get_theme_mod('foodie_restaurant_related_product_setting',true);

	if($foodie_restaurant_related_product_setting == false){

		$foodie_restaurant_custom_css .='.related.products, .related h2{';

			$foodie_restaurant_custom_css .='display: none;';

		$foodie_restaurant_custom_css .='}';
	}

		/*---------------------------Pagination Settings-------------------*/


$foodie_restaurant_pagination_setting = get_theme_mod('foodie_restaurant_pagination_setting',true);

	if($foodie_restaurant_pagination_setting == false){

		$foodie_restaurant_custom_css .='.nav-links{';

			$foodie_restaurant_custom_css .='display: none;';

		$foodie_restaurant_custom_css .='}';
	}

	/*---------------------------Scroll to Top Alignment Settings-------------------*/

	$foodie_restaurant_scroll_top_position = get_theme_mod( 'foodie_restaurant_scroll_top_position','Right');

	if($foodie_restaurant_scroll_top_position == 'Right'){

		$foodie_restaurant_custom_css .='.scroll-up{';

			$foodie_restaurant_custom_css .='right: 20px;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_scroll_top_position == 'Left'){

		$foodie_restaurant_custom_css .='.scroll-up{';

			$foodie_restaurant_custom_css .='left: 20px;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_scroll_top_position == 'Center'){

		$foodie_restaurant_custom_css .='.scroll-up{';

			$foodie_restaurant_custom_css .='right: 50%;left: 50%;';

		$foodie_restaurant_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$foodie_restaurant_slider_opacity_color = get_theme_mod( 'foodie_restaurant_slider_opacity_color','0.6');

	if($foodie_restaurant_slider_opacity_color == '0'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.1'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.1';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.2'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.2';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.3'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.3';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.4'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.4';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.5'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.5';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.6'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.6';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.7'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.7';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.8'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.8';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == '0.9'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:0.9';

		$foodie_restaurant_custom_css .='}';

		}else if($foodie_restaurant_slider_opacity_color == 'unset'){

		$foodie_restaurant_custom_css .='.blog_inner_box img{';

			$foodie_restaurant_custom_css .='opacity:unset';

		$foodie_restaurant_custom_css .='}';

		}

	/*---------------------------woocommerce pagination alignment settings-------------------*/

	$foodie_restaurant_woocommerce_pagination_position = get_theme_mod( 'foodie_restaurant_woocommerce_pagination_position','Center');

	if($foodie_restaurant_woocommerce_pagination_position == 'Left'){

		$foodie_restaurant_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$foodie_restaurant_custom_css .='text-align: left;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_woocommerce_pagination_position == 'Center'){

		$foodie_restaurant_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$foodie_restaurant_custom_css .='text-align: center;';

		$foodie_restaurant_custom_css .='}';

	}else if($foodie_restaurant_woocommerce_pagination_position == 'Right'){

		$foodie_restaurant_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$foodie_restaurant_custom_css .='text-align: right;';

		$foodie_restaurant_custom_css .='}';
	}



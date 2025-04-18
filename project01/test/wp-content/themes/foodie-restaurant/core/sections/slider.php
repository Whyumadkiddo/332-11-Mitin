<?php if ( get_theme_mod('foodie_restaurant_blog_box_enable',false) ) : ?>

<?php $foodie_restaurant_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('foodie_restaurant_blog_slide_category'),
  'posts_per_page' => get_theme_mod('foodie_restaurant_blog_slide_number'),
); ?>

<div class="slider">
  <div class="row m-0">
    <div class="col-lg-9 col-md-9 col-sm-9 p-0">
      <div class="owl-carousel">
        <?php $foodie_restaurant_arr_posts = new WP_Query( $foodie_restaurant_args );
        if ( $foodie_restaurant_arr_posts->have_posts() ) :
          while ( $foodie_restaurant_arr_posts->have_posts() ) :
            $foodie_restaurant_arr_posts->the_post();
            ?>
            <div class="blog_inner_box">
              <?php
                if ( has_post_thumbnail() ) :
                  the_post_thumbnail();
                else:
                  ?>
                  <div class="slider-alternate">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
                  </div>
                  <?php
                endif;
              ?>
              <div class="blog_box pt-3 pt-md-0 wow zoomIn">
                <?php if ( get_theme_mod('foodie_restaurant_slider_extra_heading') ) : ?>
                  <h2><?php echo esc_html(get_theme_mod('foodie_restaurant_slider_extra_heading'));?></h2>
                <?php endif; ?>
                <?php if ( get_theme_mod('foodie_restaurant_title_unable_disable',true) ) : ?>
                  <h3 class="my-3"><?php the_title(); ?></h3>
                <?php endif; ?>
                <?php if ( get_theme_mod('foodie_restaurant_button_unable_disable',true) ) : ?>
                  <p class="slider-button mt-4">
                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Know More','foodie-restaurant'); ?></a>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          <?php
        endwhile;
        wp_reset_postdata();
        endif; ?>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 slider-info p-0">
      <div class="contact-info wow zoomIn">
        <?php if ( get_theme_mod('foodie_restaurant_header_phone_number') ) : ?>
          <p><i class="fas fa-phone me-2"></i><?php esc_html_e('Call - ','foodie-restaurant'); ?><a href="callto:<?php echo esc_html(get_theme_mod('foodie_restaurant_header_phone_number','')); ?>"><?php echo esc_html(get_theme_mod('foodie_restaurant_header_phone_number','')); ?></a></p>
        <?php endif; ?>
        <?php if ( get_theme_mod('foodie_restaurant_header_email') ) : ?>
          <p><i class="fas fa-paper-plane me-2"></i><?php esc_html_e('Mail Us - ','foodie-restaurant'); ?><a href="mailto:<?php echo esc_html(get_theme_mod('foodie_restaurant_header_email','')); ?>"><?php echo esc_html(get_theme_mod('foodie_restaurant_header_email','')); ?></a></p>
        <?php endif; ?>
        <?php if ( get_theme_mod('foodie_restaurant_header_location') ) : ?>
          <p><i class="fas fa-map-marker-alt me-2"></i><?php esc_html_e('Address - ','foodie-restaurant'); ?><?php echo esc_html( get_theme_mod('foodie_restaurant_header_location' ) ); ?></p>
        <?php endif; ?>
      </div>
      <div class="social-info wow bounce">
        <?php $foodie_restaurant_settings = get_theme_mod( 'foodie_restaurant_social_links_settings' ); ?>
        <?php if ( is_array($foodie_restaurant_settings) || is_object($foodie_restaurant_settings) ){ ?>
          <p><?php esc_html_e('Follow Us - ','foodie-restaurant'); ?></p>
          <div class="social-links">
            <?php foreach( $foodie_restaurant_settings as $foodie_restaurant_setting ) { ?>
              <a href="<?php echo esc_url( $foodie_restaurant_setting['link_url'] ); ?>">
                <i class="<?php echo esc_attr( $foodie_restaurant_setting['link_text'] ); ?>"></i>
              </a>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

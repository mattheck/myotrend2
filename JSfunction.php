<?php
/*
 * WordPress Sample function and action
 * for loading scripts in themes
 */
 
// Let's hook in our function with the javascript files with the wp_enqueue_scripts hook 
add_action( 'wp_enqueue_scripts', 'wpcandy_load_javascript_files' );
// Register some javascript files, because we love javascript files. Enqueue a couple as well 
function wpcandy_load_javascript_files() {
  wp_register_script( 'info-caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-5.5.0-packed.js', array('jquery'), '5.5.0', true );
  wp_register_script( 'info-carousel-instance', get_template_directory_uri() . '/js/info-carousel-instance.js', array('info-caroufredsel'), '1.0', true );
  wp_register_script( 'jquery.flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '1.7', true );
  wp_register_script( 'home-page-main-flex-slider', get_template_directory_uri().'/js/home-page-main-flex-slider.js', array('jquery.flexslider'), '1.0', true );
  wp_enqueue_script( 'info-carousel-instance' );
  
  if ( is_product() ) {
    wp_enqueue_script('home-page-main-flex-slider');
  }
}
?>
<?php
/* 
*   Load theme's CSS and Scritps
*/

function edc_scripts(){
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', false, '4.5.0');
}
add_action( 'wp_enqueue_scripts', 'edc_scripts' );
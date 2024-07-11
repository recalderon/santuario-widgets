<?php
/*
* Plugin Name: CPT Noticias
* Description: CPT para criação e manipulação de informações de noticias
* Version: 1.0
* Author: Ricardo Calderon
* Text Domain: agems-cpt-noticias

*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function register_santuario_widgets( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/santuario-contact-info.php' );
	$widgets_manager->register( new \SantuarioContactInfo() );
  }
add_action( 'elementor/widgets/register', 'register_santuario_widgets' );

function register_santuario_contact_info_styles() {
	wp_register_style( 'santuario-contact-info-style', plugins_url( 'widgets/assets/santuario-contact-info-style.min.css', __FILE__ ) );
  }
add_action( 'wp_enqueue_scripts', 'register_santuario_contact_info_styles' );
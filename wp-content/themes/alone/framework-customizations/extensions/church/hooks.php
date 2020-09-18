<?php 

if( ! function_exists('_alone_church_enqueue_scripts') ) {
	function _alone_church_enqueue_scripts() {
		wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDOkqN917F-V3B3BdilLSiO8AgmBy4sZaU', false, '' );
	}
	add_action( 'wp_enqueue_scripts', '_alone_church_enqueue_scripts' );
}
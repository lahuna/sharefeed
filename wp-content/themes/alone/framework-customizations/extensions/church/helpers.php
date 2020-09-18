<?php 
// check Visual Composer plugin active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(! is_plugin_active( 'bears-church/bears-church.php' )) return;


function alone_church_render_google_map_by_latlong($lat, $long, $info, $width = '100%', $height = '300px') {
	?>
	<div 
		data-google-map-elem=""
		data-lat="<?php echo esc_attr($lat); ?>"
		data-long="<?php echo esc_attr($long); ?>"
		data-info="<?php echo esc_attr($info); ?>"
		class="google-map-canvas" 
		style="width: <?php echo esc_attr($width); ?>; height: <?php echo esc_attr($height); ?>"></div>
	<?php 
}



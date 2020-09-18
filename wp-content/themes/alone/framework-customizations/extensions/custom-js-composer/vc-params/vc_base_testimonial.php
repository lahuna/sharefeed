<?php
/*
Element Description: VC Post Slider 2
*/

// Element Class
class vcBaseTestimonial extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		global $__VcShadowWPBakeryVisualComposerAbstract;
		add_action( 'init', array( $this, 'vc_base_testimonial_mapping' ) );
		$__VcShadowWPBakeryVisualComposerAbstract->addShortCode( 'vc_base_testimonial', array(
			$this,
			'vc_base_testimonial_html'
		) );
	}

	// Element Mapping
	public function vc_base_testimonial_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map( array(
			'name'        => __( 'Base testimonial', 'alone' ),
			'base'        => 'vc_base_testimonial',
			'description' => __( 'Base OWL testimonial', 'alone' ),
			'category'    => __( 'Theme Elements', 'alone' ),
			'icon'        => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/base-testominal.png',
			'params'      => array(
				/* source */
				array(
					'type'        => 'param_group',
					'heading'     => __( 'Values', 'alone' ),
					'param_name'  => 'values',
					'description' => __( 'Enter value item for slider.', 'alone' ),
					'value'       => urlencode( json_encode( array(
						array(
							'testimonial_layout' => 'default',
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block one. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
							'donated'            => __( '$ 178,456', 'alone' ),
						),
						array(
							'testimonial_layout' => 'default',
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block two. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
							'donated'            => __( '$ 178,456', 'alone' ),
						),
						array(
							'testimonial_layout' => 'default',
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block three. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
							'donated'            => __( '$ 178,456', 'alone' ),
						),
					) ) ),
					'params'      => array(
						array(
							'type'        => 'dropdown',
							'heading'     => __( 'Layout', 'alone' ),
							'param_name'  => 'testimonial_layout',
							'value'       => array(
								__( 'Default', 'alone' ) => 'default',
								__( 'Style 1', 'alone' ) => 'style-1',
								__( 'Style 2', 'alone' ) => 'style-2',
							),
							'std'         => 'default',
							'description' => __( 'Select layout of testimonial.', 'alone' ),
							'group'       => 'Source',
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Name', 'alone' ),
							'param_name'  => 'label',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-1' ),
							),
							'description' => __( 'Enter a name', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Position', 'alone' ),
							'param_name'  => 'manger',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-1' ),
							),
							'description' => __( 'Enter a position', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textarea',
							'heading'     => __( 'Content', 'alone' ),
							'param_name'  => 'content_item',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-1' ),
							),
							'description' => __( 'Enter your content.', 'alone' )
						),
						array(
							'type'       => 'attach_image',
							'heading'    => __( 'Avatar', 'alone' ),
							'param_name' => 'image',
							'dependency' => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-1' ),
							),
							'group'      => 'Source',
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Donated', 'alone' ),
							'param_name'  => 'donated',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'style-1' ),
							),
							'description' => __( 'Enter number donated', 'alone' ),
							'group'       => 'Source',
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Name', 'alone' ),
							'param_name'  => 'label2',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-2' ),
							),
							'description' => __( 'Enter a name', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Date', 'alone' ),
							'param_name'  => 'manger2',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-2' ),
							),
							'description' => __( 'Enter a date', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textarea',
							'heading'     => __( 'Content', 'alone' ),
							'param_name'  => 'content_item2',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-2' ),
							),
							'description' => __( 'Enter your content.', 'alone' )
						),
						array(
							'type'       => 'attach_image',
							'heading'    => __( 'Avatar', 'alone' ),
							'param_name' => 'image2',
							'dependency' => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'default', 'style-2' ),
							),
							'group'      => 'Source',
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Donated', 'alone' ),
							'param_name'  => 'donated2',
							'dependency'  => array(
								'element' => 'testimonial_layout',
								'value'   => array( 'style-2' ),
							),
							'description' => __( 'Enter number donated', 'alone' ),
							'group'       => 'Source',
						),
					),
					'group'       => 'Source',
				),
				array(
					'type'        => 'el_id',
					'heading'     => __( 'Element ID', 'alone' ),
					'param_name'  => 'el_id',
					'description' => __( 'Enter element ID .', 'alone' ),
					'group'       => 'Source',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'alone' ),
					'param_name'  => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
					'group'       => 'Source',
				),
				/*** Slider Options ***/
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Items', 'alone' ),
					'param_name'  => 'items',
					'value'       => '3',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Margin', 'alone' ),
					'param_name'  => 'margin',
					'value'       => '30',
					'admin_label' => false,
					'description' => __( 'margin-right(px) on item.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Loop', 'alone' ),
					'param_name'  => 'loop',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Center', 'alone' ),
					'param_name'  => 'center',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Center item. Works well with even an odd number of items.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'stagePadding', 'alone' ),
					'param_name'  => __( 'stage_padding', 'alone' ),
					'value'       => '0',
					'description' => __( 'Padding left and right on stage (can see neighbours).', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'startPosition', 'alone' ),
					'param_name'  => __( 'start_position', 'alone' ),
					'value'       => '0',
					'description' => __( 'Start position or URL Hash string like `#id`.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Nav', 'alone' ),
					'param_name'  => 'nav',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Show next/prev buttons.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Dots', 'alone' ),
					'param_name'  => 'dots',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Show dots navigation.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'slideBy', 'alone' ),
					'param_name'  => __( 'slide_by', 'alone' ),
					'value'       => 1,
					'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Autoplay', 'alone' ),
					'param_name'  => 'autoplay',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Autoplay.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'autoplayHoverPause', 'alone' ),
					'param_name'  => 'autoplay_hover_pause',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Pause on mouse hover.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'autoplayTimeout', 'alone' ),
					'param_name'  => 'autoplay_timeout',
					'value'       => '5000',
					'description' => __( 'Autoplay interval timeout.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'smartSpeed', 'alone' ),
					'param_name'  => 'smart_speed',
					'value'       => '250',
					'description' => __( 'AutoplaySpeed Calculate. More info to come..', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Table Items', 'alone' ),
					'param_name'  => 'responsive_table_items',
					'value'       => '1',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the table screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Mobile Items', 'alone' ),
					'param_name'  => 'responsive_mobile_items',
					'value'       => '1',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the mobile screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				/* css editor */
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'alone' ),
					'param_name' => 'css_item',
					'group'      => __( 'Design Options items', 'alone' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'alone' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options general', 'alone' ),
				),
			),
		) );
	}

	/**
	 * Parses google_fonts_data and font_container_data to get needed css styles to markup
	 *
	 * @param $el_class
	 * @param $css
	 * @param $atts
	 *
	 * @since 1.0
	 * @return array
	 */
	public function getStyles( $el_class, $css, $atts ) {
		$styles = array();

		/**
		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
		 *
		 * @param string - filter_name
		 * @param string - element_class
		 * @param string - shortcode_name
		 * @param array - shortcode_attributes
		 *
		 * @since 4.3
		 */
		$css_class = apply_filters( 'vc_base_testimonial_filter_class', 'wpb_theme_custom_element wpb_base_testimonial ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles'    => $styles,
		);
	}

	public function getStylesSliderItem( $class, $css, $atts ) {
		$styles = array();

		/**
		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
		 *
		 * @param string - filter_name
		 * @param string - element_class
		 * @param string - shortcode_name
		 * @param array - shortcode_attributes
		 *
		 * @since 4.3
		 */
		$css_class = apply_filters( 'vc_base_testimonial_item_filter_class', $class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class_item' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles_item'    => $styles,
		);
	}

	public function _template( $temp = 'default', $item = array(), $atts = array() ) {
		$variables = array(
			'{layout}'         => fw_akg( 'testimonial_layout', $item ),
			'{name}'           => fw_akg( 'label', $item ),
			'{position}'       => fw_akg( 'manger', $item ),
			'{content_item}'   => do_shortcode( fw_akg( 'content_item', $item ) ),
			'{image}'          => fw_akg( 'image', $item ),
			'{donated}'        => fw_akg( 'donated', $item ),
			'{css_class_item}' => fw_akg( 'css_class_item', $item ),
			'{name2}'           => fw_akg( 'label2', $item ),
			'{position2}'       => fw_akg( 'manger2', $item ),
			'{content_item2}'   => do_shortcode( fw_akg( 'content_item2', $item ) ),
			'{image2}'          => fw_akg( 'image2', $item ),
			'{donated2}'        => fw_akg( 'donated2', $item ),
		);

		$imgid            = $item['image'];
		$image_attributes = wp_get_attachment_image_src( $imgid, 'medium' );
		$imgSrc           = $image_attributes[0];
		$imgid2            = $item['image2'];
		$image_attributes2 = wp_get_attachment_image_src( $imgid2, 'medium' );
		$imgSrc2           = $image_attributes2[0];

		switch ( $temp ) {
			case 'default':
				$output = implode( '', array(
					'<div class="img-bt" style="background-image: url(' . $imgSrc . ');">',
					'</div>',
					'<div class="item-inner {css_class_item}">',
					'<h2 class="title">{name}</h2>',
					'<div class="manger">Manger at <span>{position}</span></div>',
					'<div class="content">{content_item}</div>',
					'</div>',
				) );
				break;
			case 'style-1':
				$output = implode( '', array(
					'<div class="item-inner {css_class_item}">',
					'<svg 
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink"
 width="54px" height="45px">
<path fill-rule="evenodd"  fill="rgb(220, 220, 220)"
 d="M53.520,35.836 C52.008,41.228 47.039,44.996 41.434,44.996 C41.415,44.996 41.397,44.996 41.378,44.995 C36.836,44.818 33.306,43.048 30.887,39.732 C26.563,33.807 27.078,24.392 28.832,18.129 C31.823,7.456 38.909,0.001 46.065,0.001 C46.509,0.001 46.958,0.032 47.398,0.092 C47.802,0.147 48.164,0.375 48.388,0.716 C48.613,1.058 48.678,1.479 48.568,1.872 L47.266,6.523 C47.115,7.060 46.662,7.458 46.110,7.540 C40.149,8.424 37.157,16.278 35.911,20.830 C37.203,20.273 38.869,19.817 40.867,19.817 C42.160,19.817 43.489,20.010 44.819,20.393 C48.060,21.324 50.741,23.426 52.369,26.312 C54.014,29.229 54.423,32.610 53.520,35.836 ZM13.900,44.996 C13.882,44.996 13.863,44.995 13.845,44.994 C9.302,44.818 5.772,43.047 3.353,39.732 C-0.971,33.807 -0.456,24.392 1.299,18.129 C4.290,7.456 11.376,0.001 18.532,0.001 C18.976,0.001 19.424,0.032 19.864,0.092 C20.269,0.147 20.630,0.375 20.855,0.716 C21.080,1.058 21.145,1.479 21.035,1.872 L19.732,6.523 C19.582,7.060 19.129,7.458 18.577,7.540 C12.616,8.424 9.623,16.278 8.378,20.830 C9.670,20.273 11.336,19.817 13.333,19.817 C14.627,19.817 15.956,20.010 17.286,20.393 C20.527,21.324 23.208,23.426 24.836,26.312 C26.481,29.229 26.890,32.610 25.986,35.835 C24.475,41.228 19.505,44.996 13.900,44.996 Z"/>
</svg>',
					'<div class="content">{content_item}</div>',
					'<div class="info-donated">',
					'<div class="avatar" style="background-image: url(' . $imgSrc . ');"></div>',
					'<div class="info-personal">',
					'<div class="personal-name">{name}</div>',
					'<div class="personal-position">{position}</div>',
					'<div class="personal-donated"><span>' . __( 'Donated: ', 'alone' ) . '</span>{donated}</div>',
					'</div>',
					'</div>',
					'</div>',
				) );
				break;
				case 'style-2':
				$output = implode( '', array(
					'<div class="item-inner {css_class_item}">',
						'<div class="col-md-3 text-right">',
							'<h4 class="name">{name2}</h4>',
							'<div class="date">{position2}</div>',
							'<div class="amount"><span>' . __( 'Donated : ', 'alone' ) . '</span> {donated2}</div>',
						'</div>',
						'<div class="col-md-2">',
							'<div class="avatar-meta"><img src="' . $imgSrc2 . '"/></div>',
						'</div>',
						'<div class="col-md-7">',
							'<div class="text-wrap">',
								'<div class="icon-wrap"><i class="fa fa-quote-left"></i></div>',
								'<p class="note-meta">{content_item2}</p>',
							'</div>',
						'</div>',
					'</div>',
				) );
				break;
		}

		return str_replace( array_keys( $variables ), array_values( $variables ), $output );
	}

	// Element HTML
	public function vc_base_testimonial_html( $atts, $content ) {
		$atts['self']    = $this;
		$atts['content'] = $content;

		return fw_render_view( get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_base_testimonial.php', array( 'atts' => $atts ), true );
	}

} // End Element Class


// Element Class Init
new vcBasetestimonial();

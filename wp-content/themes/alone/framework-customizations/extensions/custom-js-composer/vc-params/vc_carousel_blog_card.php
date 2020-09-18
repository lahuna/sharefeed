<?php
/*
Element Description: VC Carousel Blog Card
*/

// Element Class
class vcCarouselBlogCard extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        global $__VcShadowWPBakeryVisualComposerAbstract;
        add_action( 'init', array( $this, 'vc_carousel_blog_card_mapping' ) );
        $__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_carousel_blog_card', array( $this, 'vc_carousel_blog_card_html' ));
    }

    // Element Mapping
    public function vc_carousel_blog_card_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Carousel Blog Card', 'alone'),
            'base' => 'vc_carousel_blog_card',
            'description' => __('Carousel Blog Card', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/carousel-blog-card.png',
            'params' => array(
              /* source */
              array(
          			'type' => 'param_group',
          			'heading' => __( 'Values', 'alone' ),
          			'param_name' => 'values',
          			'description' => __( 'Enter value item for slider.', 'alone' ),
          			'value' => urlencode( json_encode( array(
          				array(
							'image' => __(0, 'alone'),
							'label' => __('Item one', 'alone'),
          					'content_item' => __( 'I am test text block one. Click edit button to change this text.', 'alone' ),
          				),
          				array(
							'image' => __(0, 'alone'),
							'label' => __('Item two', 'alone'),
          					'content_item' => __( 'I am test text block two. Click edit button to change this text.', 'alone' ),
          				),
          				array(
							'image' => __(0, 'alone'),
							'label' => __('Item three', 'alone'),
          					'content_item' => __( 'I am test text block three. Click edit button to change this text.', 'alone' ),
          				),
          			) ) ),
          			'params' => array(
                  array(
					'type' => 'attach_image',
					'heading' => __('Image', 'alone'),
					'param_name' => 'image',
					'dependency' => array(
							'element' => 'graphic',
							'value' => 'image',
						),
					'description' => __('', 'alone'),
					'group' => 'Source',
					'std' => '0',
				  ),
				  array(
                    'type' => 'textfield',
                    'heading' => __( 'Label', 'alone' ),
                    'param_name' => 'label', // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
                    'description' => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'alone' ),
                    'admin_label' => true,
                  ),
                  array(
                    'type' => 'textarea',
                    'heading' => __( 'Content', 'alone' ),
                    'param_name' => 'content_item', // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
                    'description' => __( 'Enter your content.', 'alone' )
                  ),
				  array(
                    'type' => 'textfield',
                    'heading' => __( 'Href', 'alone' ),
                    'param_name' => 'href', // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
                    'description' => __( 'Enter link', 'alone' ),
                    'admin_label' => true,
					'std' => '#',
                  ),
          			),
                'group' => 'Source',
          		),
              array(
          			'type' => 'el_id',
          			'heading' => __( 'Element ID', 'alone' ),
          			'param_name' => 'el_id',
          			'description' => __( 'Enter element ID .', 'alone' ),
                'group' => 'Source',
              ),
          		array(
          			'type' => 'textfield',
          			'heading' => __( 'Extra class name', 'alone' ),
          			'param_name' => 'el_class',
          			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
                'group' => 'Source',
              ),
              /*** Slider Options ***/
              array(
                'type' => 'textfield',
                'heading' => __('Items', 'alone'),
                'param_name' => 'items',
                'value' => '3',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Margin', 'alone'),
                'param_name' => 'margin',
                'value' => '30',
                'admin_label' => false,
                'description' => __('margin-right(px) on item.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Loop', 'alone'),
                'param_name' => 'loop',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Infinity loop. Duplicate last and first items to get loop illusion.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Center', 'alone'),
                'param_name' => 'center',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Center item. Works well with even an odd number of items.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('stagePadding', 'alone'),
                'param_name' => __('stage_padding', 'alone'),
                'value' => '0',
                'description' => __('Padding left and right on stage (can see neighbours).', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('startPosition', 'alone'),
                'param_name' => __('start_position', 'alone'),
                'value' => '0',
                'description' => __('Start position or URL Hash string like `#id`.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Nav', 'alone'),
                'param_name' => 'nav',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show next/prev buttons.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Dots', 'alone'),
                'param_name' => 'dots',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show dots navigation.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('slideBy', 'alone'),
                'param_name' => __('slide_by', 'alone'),
                'value' => 1,
                'description' => __('Navigation slide by x. `page` string can be set to slide by page.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Autoplay', 'alone'),
                'param_name' => 'autoplay',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Autoplay.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('autoplayHoverPause', 'alone'),
                'param_name' => 'autoplay_hover_pause',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Pause on mouse hover.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('autoplayTimeout', 'alone'),
                'param_name' => 'autoplay_timeout',
                'value' => '5000',
                'description' => __('Autoplay interval timeout.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('smartSpeed', 'alone'),
                'param_name' => 'smart_speed',
                'value' => '250',
                'description' => __('AutoplaySpeed Calculate. More info to come..', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Table Items', 'alone'),
                'param_name' => 'responsive_table_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the table screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Mobile Items', 'alone'),
                'param_name' => 'responsive_mobile_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the mobile screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              /* css editor */
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css_item',
                'group' => __( 'Design Options items', 'alone' ),
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design Options general', 'alone' ),
              ),
            ),
          )
        );
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
    public function getStyles($el_class, $css, $atts) {
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
  		$css_class = apply_filters( 'vc_carousel_blog_card_filter_class', 'wpb_theme_custom_element wpb_carousel_blog_card ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function getStylesSliderItem($class, $css, $atts) {
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
  		$css_class = apply_filters( 'vc_carousel_blog_card_item_filter_class', $class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class_item' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles_item' => $styles,
  		);
    }

    public function template($temp = 'default', $params = array()) {

    }

    // Element HTML
    public function vc_carousel_blog_card_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_carousel_blog_card.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcCarouselBlogCard();

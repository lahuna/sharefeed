<?php
/*
Element Description: VC Give Forms Slider
*/

// Element Class
class vcGiveFormsListing extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        global $__VcShadowWPBakeryVisualComposerAbstract;
        add_action( 'init', array( $this, 'vc_give_forms_listing_mapping' ) );
        $__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_give_forms_listing', array( $this, 'vc_give_forms_listing_html' ));
    }

    // Element Mapping
    public function vc_give_forms_listing_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Give Forms Listing', 'alone'),
            'base' => 'vc_give_forms_listing',
            'description' => __('Give forms listing (carousel)', 'alone'),
            'category' => __('Give', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/give-donations-icon.png',
            'params' => array(
              array(
                'type' => 'textfield',
                'heading' => __('Number of Posts to Show', 'alone'),
                'param_name' => 'number_posts_show',
                'value' => '5',
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Data Type', 'alone' ),
                'param_name' => 'data_type',
                'value' => array(
                  __('Recent', 'alone') => 'recent',
                  __('By ID', 'alone') => 'by_id',
                ),
                'std' => 'recent',
                'description' => __( 'Select a post data type', 'alone' ),
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Forms ID', 'alone' ),
                'param_name' => 'forms_id',
                'dependency' => array(
                  'element' => 'data_type',
                  'value' => 'by_id',
                ),
                'value' => '',
                'description' => __('Enter form id you would like show (Ex: 1,2,3).', 'alone'),
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
              /*** Layout Options ***/
              array(
                'type' => 'dropdown',
                'heading' => __('Image Size', 'alone'),
                'param_name' => 'image_size',
                'value' => array(
                  array('value' => 'thumbnail', 'label' => esc_html__('Thumbnail', 'alone')),
                  array('value' => 'medium', 'label' => esc_html__('Medium', 'alone')),
                  array('value' => 'medium_large', 'label' => esc_html__('Medium Large', 'alone')),
                  array('value' => 'large', 'label' => esc_html__('Large', 'alone')),
                  array('value' => 'alone-image-large', 'label' => esc_html__('Large (1228 x 691)', 'alone')),
                  array('value' => 'alone-image-medium', 'label' => esc_html__('Medium (614 x 346)', 'alone')),
                  array('value' => 'alone-image-small', 'label' => esc_html__('Small (295 x 166)', 'alone')),
                  array('value' => 'alone-image-square-800', 'label' => esc_html__('Square (800 x 800)', 'alone')),
                  array('value' => 'alone-image-square-300', 'label' => esc_html__('Square (300 x 300)', 'alone')),
                ),
                'std' => 'alone-image-medium',
                'description' => __('Select a image size', 'alone'),
                'group' => 'Layout',
              ),
              array(
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-default.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design options', 'alone' ),
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
  		$css_class = apply_filters( 'vc_give_forms_listing_filter_class', 'wpb_theme_custom_element wpb_give_forms_listing ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function _variables($form_id = null, $atts = array()) {
      $goal_option = get_post_meta( $form_id, '_give_goal_option', true );
      $form        = new Give_Donate_Form( $form_id );
      $goal        = $form->goal;
      $goal_format = get_post_meta( $form_id, '_give_goal_format', true );
      $income      = $form->get_earnings();
      $color       = get_post_meta( $form_id, '_give_goal_color', true );
		
      // set color if empty
      if(empty($color)) $color = '#01FFCC';
      $progress = ($goal === 0) ? 0 : round( ( $income / $goal ) * 100, 2 );

      if ( $income >= $goal ) { $progress = 100; }

      // Get formatted amount.
      $income = give_human_format_large_amount( give_format_amount( $income ) );
      $goal = give_human_format_large_amount( give_format_amount( $goal ) );
		
      $button_donate = implode('', array(
        '<div class="give-button-donate">',
          do_shortcode('[give_form id="'. $form_id .'" show_title="true" show_goal="false" show_content="none" display_style="button"]'),
        '</div>',
      ));

      $variable = array(
        '{id}' => $form_id,
        '{form_title}' => get_the_title($form_id),
        '{form_link}' => get_permalink($form_id),
        '{form_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{color}' => $color,
        '{author_name}' => get_the_author(),
      	'{date}' => get_the_date(),
        '{donors_count}' => $form->get_sales(),
        '{donors_count}' => $form->get_sales(),
		'{raised_layout4}' => $income ,
		'{goal_layout4}' => $goal ,
		'{pricing_text_layout3}' => sprintf(
          __('Raised: %1$s / Goal: %2$s', 'alone'),
          '<span class="income">' . apply_filters( 'give_goal_amount_raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
        '{pricing_text}' => sprintf(
          __('%1$s of %2$s raised', 'alone'),
          '<span class="income">' . apply_filters( 'give_goal_amount_raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
        '{percentage_text}' => sprintf(
          __( '%s%% funded', 'alone' ),
          '<span class="give-percentage">' . apply_filters( 'give_goal_amount_funded_percentage_output', round( $progress ) ) . '</span>'),

        '{goal_progress_bar_default}' => '',
        '{button_donate}' => $button_donate,
      );
      //Sanity check - ensure form has goal set to output
      if ( empty( $form->ID )
      	|| ( is_singular( 'give_forms' ) && ! give_is_setting_enabled( $goal_option ) )
      	|| ! give_is_setting_enabled( $goal_option )
      	|| $goal == 0
      ) {
      	//

      } else {

        $progressbar_style_default_attr = array(
          'class' => 'give-goal-progress-bar',
          'data-progressbar-svg' => json_encode(array(
            /* source */
            'shape' => 'circle', //'circle',
            'progressValue' => $progress,
            'color' => $color,
            'strokeWidth' => 20,
            'trailColor' => 'rgb(222, 222, 222)',
            'trailWidth' => 3,
            'easing' => 'easeInOut',
            'duration' => 1800,
            'textSetings' => '',
            'animateTransformSettings' => 'show',
            'delay' => 300,
            /* transform */
            'colorTransform' => $color,
            'strokeWidthTransform' => 20,
            /* text */
            'label' => '{percent}%',
            'text_color' => '#fff',
          )),
        );
        $progressbar_style_1_attr = array(
          'class' => 'give-goal-progress-bar',
          'data-progressbar-svg' => json_encode(array(
            /* source */
            'shape' => 'line', //'line',
            'progressValue' => $progress,
            'color' => $color,
            'strokeWidth' => 1,
            'trailColor' => 'rgb(222, 222, 222)',
            'trailWidth' => 1,
            'easing' => 'easeInOut',
            'duration' => 1800,
            'textSetings' => '',
            'animateTransformSettings' => 'show',
            'delay' => 300,
            // 'svgStyleWidth' => '100%',
            // 'svgStyleHeight' => '100%',
            /* transform */
            'colorTransform' => $color,
            'strokeWidthTransform' => 2,
            /* text */
            // 'textSetings' => 'show',
            // 'label' => '{percent}%',
            // 'text_color' => '#fff',
          )),
        );

        $variable['{goal_progress_bar_default}'] = '<div '. html_build_attributes($progressbar_style_default_attr) .'></div>';
        $variable['{goal_progress_bar_style_1}'] = '<div '. html_build_attributes($progressbar_style_1_attr) .'></div>';
      }

      /* check featured image exist */
      if ( has_post_thumbnail($form_id) ) {
        $variable['{form_featured_image}'] = get_the_post_thumbnail_url($form_id, $atts['image_size']);
      }

      return $variable;
    }

    public function _template($temp = 'default', $form_id = null, $atts = array()) {
      $params = $this->_variables($form_id, $atts);

      $output = '';
      $template = array();

      /* layout default */
      $template['default'] = implode('', array(
        '<div class="item-inner give-forms-listing-layout-default">',
          '<div class="entry-content">',
			'<div class="extra-meta">',
              '<div class="meta-item meta-date"><span class="ion-android-calendar"> </span> {date}</div>',
            '</div>',
            '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
			'<div class="give-price-wrap">{pricing_text_layout3}</div>',
		  '</div>',
        '</div>',
      ));


      /* layout blog-image */
      $template['block-image'] = implode('', array(

      ));

      $template = apply_filters('vc_give_forms_listing:template', $template);
	
      return str_replace(array_keys($params), array_values($params), fw_akg($temp, $template));
    }

    // Element HTML
    public function vc_give_forms_listing_html( $atts ) {
      $atts['self'] = $this;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_give_forms_listing.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcGiveFormsListing();

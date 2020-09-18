<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Params extraction
extract(
  shortcode_atts(
    array(
      'self'              => '',
      'content'           => '',
			'values'						=> urlencode( json_encode( array(
				array(
					'image' => __(0, 'alone'),
					'label' => __('Item one', 'alone'),
					'sub' => __('one', 'alone'),
					'content_item' => __( 'I am test text block one. Click edit button to change this text.', 'alone' ),
					'href'	=>__('#', 'alone'),
				),
				array(
					'image' => __(0, 'alone'),
					'label' => __('Item two', 'alone'),
					'sub' => __('two', 'alone'),
					'content_item' => __( 'I am test text block two. Click edit button to change this text.', 'alone' ),
					'href'	=>__('#', 'alone'),
				),
				array(
					'image' => __(0, 'alone'),
					'label' => __('Item three', 'alone'),
					'sub' => __('three', 'alone'),
					'content_item' => __( 'I am test text block three. Click edit button to change this text.', 'alone' ),
					'href'	=>__('#', 'alone'),
				),
			) ) ),
      /* Source */

      /* Slider Options */
      'items'             => 3,
      'margin'            => 30,
      'loop'              => 0,
      'center'            => 0,
      'stage_padding'     => 0,
      'start_position'    => 0,
      'nav'               => 0,
      'dots'              => 0,
      'slide_by'          => 1,
      'autoplay'          => 0,
      'autoplay_hover_pause'=> 0,
      'autoplay_timeout'  => 5000,
      'smart_speed'       => 250,
      'responsive_table_items'  => 1,
      'responsive_mobile_items' => 1,
      /* Style */
      'el_id'             => '',
      'el_class'          => '',
	  'css_item'		  => '',
      'css'               => '',
    ),
    $atts
  )
);
	
        /* $img = wp_get_attachment_image_src($a["image"], "large");

        $imgSrc = $img[0];
		var_dump($imgSrc); */
/** Owl options **/
$owl_options = json_encode(array(
  'items'             => (int)$items,
  'margin'            => (int)$margin,
  'loop'              => (int)$loop,
  'center'            => (int)$center,
  'stagePadding'      => (int)$stage_padding,
  'startPosition'     => (int)$start_position,
  'nav'               => (int)$nav,
  'dots'              => (int)$dots,
  'slideBy'           => (int)$slide_by,
  'autoplay'          => (int)$autoplay,
  'autoplayHoverPause'=> (int)$autoplay_hover_pause,
  'autoplayTimeout'   => (int)$autoplay_timeout,
  'smartSpeed'        => (int)$smart_speed,
  'responsive'        => array(
    0   => array(
      'items' => 1,
      'stagePadding' => 0),
    480 => array(
      'items' => (int)$responsive_mobile_items,
      'stagePadding' => 0),
    768 => array(
      'items' => (int)$responsive_table_items,
      'stagePadding' => 0),
		1000 => array(
			'items' => (int) $items,
      'stagePadding' => (int) $stage_padding ),
  ),
)); 
// echo $owl_options;
// fix visual builder on frontend
$owl_options = base64_encode($owl_options);

/* item slider */
$values = (array) vc_param_group_parse_atts( $values );
//echo'<pre>';var_dump($values);echo'</pre>';
/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

/**
 * @var $css_class_item
 */
extract( $self->getStylesSliderItem( 'slider-item-style', $css_item, $atts ) );

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }
?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
	<div class="vc-custom-inner-wrap">
		<div class="owl-carousel logo-baner" data-bears-owl-carousel='<?php echo esc_attr($owl_options); ?>'>
			<?php if(count($values) > 0) :
				foreach($values as $item) :
				$imgid = isset( $item['image'] ) ? $item['image'] : '' ;
				$image_attributes = wp_get_attachment_image_src( $imgid, 'medium' );
				$imgSrc = $image_attributes[0];
				if (empty($imgSrc)) {
					$imgSrc = get_template_directory_uri() . '/assets/images/image-default-2.jpg';
				}
				//var_dump($imgSrc);
				$label = isset($item['label']) ? $item['label'] : ''; 
				$sub = isset($item['sub']) ? $item['sub'] : '';
				$href = $item['href'];
					echo implode('', array(
						'<div class="item">',
							'<div class="img-bt">',
								'<img src="'.$imgSrc.'" alt="" />',
							'</div>',
							'<div class="item-inner '. $css_class_item .'">',
								'<a href="'.$href.'"><h2 class="title">'. $label .'</h2></a>',
								'<div class="sub-title">'. $sub .'</div>',
								'<div class="content">'.do_shortcode(fw_akg('content_item', $item)).'</div>',
							'</div>',
						'</div>',
					));
				endforeach;
			endif; ?>
		</div>
	</div>
</div>

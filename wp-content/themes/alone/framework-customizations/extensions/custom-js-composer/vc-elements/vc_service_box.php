<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Params extraction
$atts = shortcode_atts(
  array(
    'self'              => '',
    'content'           => '',
    /* Source */
	'tpl' =>  'tpl1',
	'img' => '',
	'icon' => 'fa fa-archive',
	'title' => __('Heading text', 'alone'),
    'desc' => __('I am featured box. Click edit button to change this text.', 'alone'),
	'btn_label' => 'DONATE NOW',
    'btn_link' => '#',
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts);
// echo '<pre>'; print_r($atts); echo '</pre>';
/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }

/* params replace for template */
$template_params = array(
  '{icon_html}' 					=> $icon,
  '{heading_text}' 					=> $title,
  '{content_text}' 					=> $desc,
  '{btn_label}' 					=> $btn_label,
  '{btn_link}' 					=> $btn_link,
  '{img_html}' 					=> wp_get_attachment_image( $img, 'full' ),
  '{content_alignment_class}' => $self->getAlignmentClass($atts),
);

/* template */
$template = implode('', array(
'<div class="bt-service-wrap">',
  '<div class="bt-service clearfix {content_alignment_class}">',
    '{img_html}',
    '<div class="bt-overlay">',
		'<div class="bt-header">',
			'<i class="'.esc_attr($icon).'"></i>',
			'<h6 class="bt-title" >{heading_text}</h6>',
		'</div>',
		'<div class="bt-content">',
			'<p>{content_text}</p>',
			'<a class="bt-btn-link" href="'.esc_attr($btn_link).'">'.esc_attr($btn_label).'</a>',
		'</div>',
    '</div>', 
  '</div>',
'</div>'
));
?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
  <div class="vc-custom-inner-wrap">
    <?php echo str_replace(array_keys($template_params), array_values($template_params), $template); ?>
  </div>
</div>

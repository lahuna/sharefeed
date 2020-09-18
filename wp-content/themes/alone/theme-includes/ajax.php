<?php

if(! function_exists('_alone_search_data_ajax')) :
	/**
	 * _alone_search_data_ajax
	 * @since 0.0.7
	 */
	function _alone_search_data_ajax() {
    $search_data = fw_akg('search_data', $_POST);
    $output = '';
		$the_query = new WP_Query(array(
			's' => $search_data,
			'posts_per_page' => 5,
      'order' => 'DESC'
			)
		);

    $_temp = array(
      'template_wrap' => implode('', array(
        '<p class="text-result">{post_count} '. __('result(s) found for', 'alone') .' <u>{s}</u></p>',
        '<div class="bt-row">',
          '{post_items}',
        '</div>',
      )),
      'template_noresult' => implode('', array(
        '<p class="text-result">'. __('Nothing found!', 'alone') .'</p>',
        '',
      )),
      'item_template_default' => implode('', array(
        '<div class="bt-col-3">',
          '<div class="item-inner item-template-default">',
            '<a href="{post_link}">',
              '<div class="feature-image" style="background: url({featured_img}) center center / cover, #333;">',
                '<span class="post-type">{post_type}</span>',
              '</div>',
            '</a>',
            '<a class="post-link" href="{post_link}">{post_title}</a>',
          '</div>',
        '</div>',
      )),
      'item_template_default_view_all_result' => implode('', array(
        '<div class="bt-col-3">',
          '<div class="item-inner item-template-default-all-result">',
            '<a href="'. get_search_link( $search_data ) .'" class="view-all-result">'. __('See all results', 'alone') .' <span class="ion-ios-arrow-thin-right"></span></a>',
          '</div>',
        '</div>',
      )),
    );

		if ( $the_query->have_posts() ) {
      $post_items = "";

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
        $variables = array(
          '{featured_img}' => '',
          '{post_title}' => get_the_title(),
          '{post_link}' => get_the_permalink(),
          '{post_type}' => get_post_type(),
        );

        /* check featured image exist */
        if ( has_post_thumbnail(get_the_ID()) ) {
          $variables['{featured_img}'] = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
        }

				$post_items .= str_replace(array_keys($variables), array_values($variables), fw_akg('item_template_default', $_temp));
			}

      if($the_query->found_posts > 5) {
        $post_items .= $_temp['item_template_default_view_all_result'];
      }

      $output = str_replace(
        array('{post_count}', '{s}', '{post_items}'),
        array($the_query->found_posts, $search_data, $post_items),
        fw_akg('template_wrap', $_temp)
      );

			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
      $output = $_temp['template_noresult'];
		}

		// print_r($the_query);
		echo json_encode(array(
      's' => $search_data,
			'content' => $output,
		));
		die();
	}
endif;
add_action( 'wp_ajax__alone_search_data_ajax', '_alone_search_data_ajax' );
add_action( 'wp_ajax_nopriv__alone_search_data_ajax', '_alone_search_data_ajax' );

if( ! function_exists('_alone_semon_load_media_template') ) {
	/**
	 * @since 5.0.3
	 */
	function _alone_semon_load_media_template() {
		$demo_content = array(
			'title' => 'This is id: ' . $_POST['pid'],
			'content' => alone_semon_get_media_template($_POST['pid']),
		);
		
		wp_send_json($demo_content);
		exit();
	}
	add_action( 'wp_ajax__alone_semon_load_media_template', '_alone_semon_load_media_template' );
	add_action( 'wp_ajax_nopriv__alone_semon_load_media_template', '_alone_semon_load_media_template' );
}

function alone_semon_get_media_template($id = 0) {
	ob_start();
	$video_sm = get_post_meta($_POST['pid'], '_ctc_sermon_video', true);
	$audio_sm = get_post_meta($_POST['pid'], '_ctc_sermon_audio', true);
	$pdf_sm = get_post_meta($_POST['pid'], '_ctc_sermon_pdf', true);
	$content_post = get_post($_POST['pid']);
	$book_sm = $content_post->post_content;
	//var_dump($content);
	?>
	<div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabvideo<?php echo $_POST['pid']?>" data-toggle="tab"><i class="fa fa-video-camera"></i> Video</a></li>
                        <li><a href="#tabaudio<?php echo $_POST['pid']?>" data-toggle="tab"><i class="fa fa-headphones"></i> Audio</a></li>
                        <li><a href="#tabdown<?php echo $_POST['pid']?>" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a></li>
                        <li><a href="#tabbook<?php echo $_POST['pid']?>" data-toggle="tab"><i class="fa fa-book"></i> Book</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active video" id="tabvideo<?php echo $_POST['pid']?>"><iframe width="100%" height="300" src="<?php echo $video_sm; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
                        <div class="tab-pane fade mp3" id="tabaudio<?php echo $_POST['pid']?>"><audio controls style="width: 100%;"><source src="<?php echo $audio_sm; ?>"></audio></iframe></div>
                        <div class="tab-pane fade down" id="tabdown<?php echo $_POST['pid']?>"><a href="<?php echo $pdf_sm; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Download-PDF-Button.png"></a></div>
                        <div class="tab-pane fade book" id="tabbook<?php echo $_POST['pid']?>"><p><?php echo $book_sm; ?></p></div>
                    </div>
                </div>
            </div>
	<?php
	return ob_get_clean();
}
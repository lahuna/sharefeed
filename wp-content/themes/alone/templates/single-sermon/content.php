<?php
$TBFW = defined( 'FW' );
$alone_post_options = alone_single_post_options( $post->ID );
$alone_related_articles_type = ! empty( $TBFW ) ? fw_get_db_settings_option( 'posts_settings/related_articles/yes/related_type', 'related-articles-1' ) : 'related-articles-1';
$alone_is_builder = alone_fw_ext_page_builder_is_builder_post($post->ID);
$alone_general_posts_options = alone_general_posts_options();
$terms_sm = get_the_terms( $post->ID, 'ctc_sermon_speaker' ); 
	foreach($terms_sm as $term_sm) {
			  $peaker_sm = $term_sm->name;
			}
	$video_sm = get_post_meta($post->ID, '_ctc_sermon_video', true);
	$audio_sm = get_post_meta($post->ID, '_ctc_sermon_audio', true);
	$pdf_sm = get_post_meta($post->ID, '_ctc_sermon_pdf', true);
	$content_post = get_post($post->ID);
	$book_sm = $content_post->post_content;
$image_background_elem = '';
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  $style_inline = "background: url(". get_the_post_thumbnail_url($post->ID, $alone_post_options['image_size']) .") center center;";
  $image_background_elem = "<div class='post-sing-image-background' style='{$style_inline}' data-stellar-background-ratio='0.8'></div>";
}
//var_dump($terms_sm);
$article_classes = array(
	'post',
	'post-details',
	'clearfix',
  'post-single-creative-layout-' . $alone_general_posts_options['blog_type'],
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( implode(' ', $article_classes) ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<div class="col-inner">
		<div class="entry-content clearfix" itemprop="text">
			<div class="row">
				<div class="col-md-12">
					<div class="panel with-nav-tabs panel-primary">
						<div class="panel-heading">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tabvideo<?php echo $post->ID ?>" data-toggle="tab"><i class="fa fa-video-camera"></i> Video</a></li>
								<li><a href="#tabaudio<?php echo $post->ID ?>" data-toggle="tab"><i class="fa fa-headphones"></i> Audio</a></li>
								<li><a href="#tabbook<?php echo $post->ID?>" data-toggle="tab"><i class="fa fa-book"></i> Book</a></li>
								<li><a href="<?php echo $pdf_sm; ?>" target="_blank"><i class="fa fa-cloud-download"></i> Download</a></li>
								
							</ul>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane fade in active video" id="tabvideo<?php echo $post->ID ?>"><iframe width="100%" height="400" src="<?php echo $video_sm; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
								<div class="tab-pane fade mp3" id="tabaudio<?php echo $post->ID ?>"><audio controls style="width: 100%;"><source src="<?php echo $audio_sm; ?>"></audio></iframe></div>
								
								<div class="tab-pane fade book" id="tabbook<?php echo $post->ID ?>"><p><?php echo $book_sm; ?></p></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<?php echo alone_share_post(array('facebook' => true, 'twitter' => true, 'google_plus' => true, 'linkedin' => true, 'pinterest' => false));//echo do_shortcode('[x_share title="'. esc_html__(' ', 'alone') .'" facebook="true" twitter="true" google_plus="true" linkedin="true" pinterest="true"]'); ?>
				</div>
			</div>
		</div>
	</div>
</article>
<?php get_template_part( 'content', 'author' ); ?>
<hr />
<?php get_template_part( 'post', 'navigation' ); ?>
<?php get_template_part( 'templates/related-articles/'.$alone_related_articles_type ); ?>


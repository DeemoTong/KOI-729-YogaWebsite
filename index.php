<?php get_header();
	$page_layout = 'content-full-width';
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";

	$pageid = get_option('page_for_posts');
	if( $pageid > 0 ) {
		$tpl_default_settings = get_post_meta($pageid,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

		$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	} else {
		$page_layout = kriya_option('pageoptions','post-archives-page-layout');
		$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
	}
	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "page-with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "page-with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;
		
		case 'with-both-sidebar':
			$page_layout = "page-with-sidebar with-both-sidebar";
			$show_sidebar = $show_left_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-both-sidebar";
		break;

		case 'content-full-width':
		default:
			$page_layout = "content-full-width";
		break;
	}
	?>
	<section id="primary" class="<?php echo esc_attr( $page_layout ); ?>"><?php

		$post_layout = kriya_option('pageoptions','post-archives-post-layout');
		$post_layout = isset( $post_layout ) ? $post_layout : 'one-column';

		switch($post_layout):
			default:
			case 'one-column':
				$post_class = $show_sidebar ? "column dt-sc-one-column with-sidebar blog-fullwidth" : "column dt-sc-one-column blog-fullwidth";
				$columns = 1;
				$container_class = '';
			break;
			
			case 'one-half-column':
				$post_class = $show_sidebar ? "column dt-sc-one-half with-sidebar" : "column dt-sc-one-half";
				$columns = 2;
				$container_class = "apply-isotope";
			break;
			
			case 'one-third-column':
				$post_class = $show_sidebar ? "column dt-sc-one-third with-sidebar" : "column dt-sc-one-third";
				$columns = 3;
				$container_class = "apply-isotope";
			break;
		endswitch;

		$allow_excerpt = kriya_option('pageoptions','post-archives-enable-excerpt');
		$excerpt = kriya_option('pageoptions','post-archives-excerpt');		

		$show_post_format = kriya_option('pageoptions','post-format-meta'); 
		$show_post_format = isset( $show_post_format )? "" : "hidden";

		$show_author_meta = kriya_option('pageoptions','post-author-meta');
		$show_author_meta = isset( $show_author_meta ) ? "" : "hidden";

		$show_date_meta = kriya_option('pageoptions','post-date-meta');
		$show_date_meta = isset( $show_date_meta ) ? "" : "hidden";	

		$show_comment_meta = kriya_option('pageoptions','post-comment-meta');
		$show_comment_meta = isset( $show_comment_meta ) ? "" : "hidden";

		$show_category_meta = kriya_option('pageoptions','post-category-meta');
		$show_category_meta = isset( $show_category_meta ) ? "" : "hidden";

		$show_tag_meta = kriya_option('pageoptions','post-tag-meta');
		$show_tag_meta = isset( $show_tag_meta ) ? "" : "hidden";

		$allow_read_more = kriya_option('pageoptions','post-archives-enable-readmore');

		$border_style = kriya_option('pageoptions','post-archives-enable-border-style');
		$article_class = ( $show_date_meta == 'hidden' ) ? 'blog-entry entry-date-left entry-date-hidden': 'blog-entry entry-date-left';
		$article_class = isset( $border_style )  ? $article_class.' outer-frame-border': $article_class;

		if( have_posts() ):
			$i = 1;
			echo "<div class='tpl-blog-holder ".esc_attr( $container_class )."'>";

			while( have_posts() ):
				the_post();

				$temp_class = "";
				if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
				if($i == $columns) $i = 1; else $i = $i + 1;

				$format = get_post_format(  get_the_id() );
				$format_link = 	get_post_format_link( $format );
				$link = get_permalink( get_the_id() );
				$link = rawurlencode( $link );

				$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
				$post_meta = is_array($post_meta) ? $post_meta : array();

				$custom_class = "";?>
				<div class="<?php echo esc_attr($temp_class); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class( $article_class ); ?>>
						<!-- Featured Image -->
	                        <?php if( $format == "image" || empty($format) ) :
	                                if( has_post_thumbnail() ) :?>
	                                    <div class="entry-thumb">
	                                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail("full"); ?></a>
	                                    </div><?php
	                                else:
	                                    $custom_class = "has-no-post-thumbnail";
	                                endif;
	                            elseif( $format === "gallery" ) :
	                                if( array_key_exists("items", $post_meta) ) :
	                                    echo '<div class="entry-thumb">';
	                                    echo '	<ul class="entry-gallery-post-slider">';
	                                                foreach ( $post_meta['items'] as $item ) {
	                                                    echo "<li><img src='". esc_url($item)."'/></li>";
	                                                }
	                                    echo '	</ul>';
	                                    echo '</div>';
	                                elseif( has_post_thumbnail() ):?>
	                                    <div class="entry-thumb">
	                                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail("full"); ?></a>
	                                    </div><?php
	                                else:
	                                    $custom_class = "has-no-post-thumbnail";
	                                endif;
	                            elseif( $format === "video" ) :
	                                if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) :
	                                    echo '<div class="entry-thumb">';
	                                    echo'	<div class="dt-video-wrap">';
	                                                if( array_key_exists('oembed-url', $post_meta) && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
	                                                    echo wp_oembed_get($post_meta['oembed-url']);
	                                                elseif( array_key_exists('self-hosted-url', $post_meta) ) :
	                                                    echo wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) );
	                                                endif;
	                                    echo '	</div>';
	                                    echo '</div>';
	                                elseif( has_post_thumbnail() ):?>
	                                    <div class="entry-thumb">
	                                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail("full"); ?></a>
	                                    </div><?php
	                                else:
	                                    $custom_class = "has-no-post-thumbnail";
	                                endif;
	                            elseif( $format === "audio" ) :
	                                if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) :
	                                    echo '<div class="entry-thumb">';
	                                            if( array_key_exists('oembed-url', $post_meta) ) :
	                                                echo wp_oembed_get($post_meta['oembed-url']);
	                                            elseif( array_key_exists('self-hosted-url', $post_meta) ) :
	                                                $custom_class = "self-hosted-audio";
	                                                echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
	                                            endif;
	                                    echo '</div>';
	                                elseif( has_post_thumbnail() ):?>
	                                    <div class="entry-thumb">
	                                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail("full"); ?></a>
	                                    </div><?php
	                                else:
	                                    $custom_class = "has-no-post-thumbnail";
	                                endif;
	                            else:
	                                if( has_post_thumbnail() ) :?>
	                                    <div class="entry-thumb">
	                                        <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'),the_title_attribute('echo=0')); ?>"><?php the_post_thumbnail("full"); ?></a>
	                                    </div><?php
	                                else:
	                                    $custom_class = "has-no-post-thumbnail";
	                                endif;
	                            endif;?>
						<!-- Featured Image -->
						
						<div class="entry-details">

							<?php $tclass = ( ($show_date_meta == "hidden" ) && ($show_comment_meta == "hidden" ) ) ? "hidden" : ""; ?>

                            <div class="entry-date <?php echo esc_attr($tclass); ?>">                            
                                <!-- date -->
                                <div class="<?php echo esc_attr($show_date_meta); ?>">
                                    <span><?php echo get_the_date('d'); ?></span>
                                    <?php echo get_the_date('M'); ?>
                                </div><!-- date -->
                            </div><!-- .entry-date -->

                            <?php $tclass = ( ($show_comment_meta == "hidden") && ($show_author_meta == "hidden" ) && ($show_tag_meta == "hidden" ) && ($show_category_meta == "hidden" ) ) ? "hidden" : ""; ?>
                            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">

                            	<!-- Author, Comment, Category & Tag -->
                                <p class="author <?php echo esc_attr( $show_author_meta ); ?>">
                                	<?php esc_html_e('By','kriya'); ?>
                                	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php esc_attr_e('View all posts by ', 'kriya'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                                </p>

                                <!-- comment -->
                                <p class="<?php echo esc_attr($show_comment_meta); ?>"><?php
                                	comments_popup_link( '<i class="pe-icon pe-chat"> </i>'.esc_html__(' 0 Comment','kriya'),
                                		'<i class="pe-icon pe-chat"> </i>'.esc_html__(' 1 Comment','kriya'),
                                		'<i class="pe-icon pe-chat"> </i>'.esc_html__(' % Comments','kriya'),
                                		'',
                                		'<i class="pe-icon pe-chat"> </i>'.esc_html__(' No Comments','kriya')); ?>
                                </p><!-- comment -->

                                <p class="<?php echo esc_attr( $show_category_meta ); ?> category"><?php esc_html_e('In','kriya'); echo ' '; the_category(', '); ?></p>

                                <?php the_tags("<p class='tags {$show_tag_meta}'>",', ',"</p>"); ?>
                                <!-- Author, Comment, Category & Tag -->
                            </div>

                            <div class="entry-title">
								<h4><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
                            </div>

                            <?php if( isset($allow_excerpt) && isset($excerpt) ):?>
                            	<div class="entry-body">
                            		<?php echo kriya_excerpt($excerpt); ?>
                            	</div><?php
                            endif;

                            if( isset($allow_read_more) ):?>
                            	<!-- Read More Button -->
                            	<div class="vc_btn3-container vc_btn3-inline">
                            		<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s','kriya'), the_title_attribute('echo=0')); ?>" class="vc_general vc_btn3 vc_btn3-size-xs vc_btn3-shape-square vc_btn3-style-classic vc_btn3-color-skincolor"><?php
                            			_e('Continue Reading...','kriya'); ?></a>
                            	</div><!-- Read More Button --><?php
                            endif;?>

							<div class="entry-format <?php echo esc_attr($show_post_format); ?>">
								<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
                            </div>						
						</div>						
					</article>
				</div><?php
			endwhile;
			echo '</div>';
			echo '<div class="pagination blog-pagination">';
			echo kriya_pagination();
			echo '</div>';
		else:
			get_template_part( 'template-parts/content', 'none' );			
		endif;?>
	</section><?php	

	if ( $show_sidebar ):
		if ( $show_left_sidebar ): ?>
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('left'); ?></section><?php
		endif;
	endif;

	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('right'); ?></section><?php
		endif;
	endif;

get_footer(); ?>
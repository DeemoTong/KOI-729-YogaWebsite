<?php get_header();
	$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";

	# Global Page Layout
	if( !is_null( $GLOBALS['enable_global_page_layout'] ) ) {
		$page_layout = $GLOBALS['global_page_layout'];
	}
	# Global Page Layout	
	
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
		if( have_posts() ) :

			while( have_posts() ):

				the_post();

				get_template_part( 'template-parts/content', 'page' );
				
				$page_comment = kriya_option('general','show-pagecomments');
				
				if( isset( $page_comment ) ) {
					
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
			endwhile;
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
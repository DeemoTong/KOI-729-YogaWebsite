<?php
	if( is_page() && !is_front_page() ):
		$post = kriya_global_variables('post');
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		kriya_breadcrumb_section( $page_id, 'page' );
	elseif( is_single() ):
		if( is_attachment() ):
		else:
			$post = kriya_global_variables('post');
			$post_type = get_post_type();

			if( $post_type === 'post' ) {
				kriya_breadcrumb_section( $post->ID, 'post' );
			} elseif( $post_type === 'dt_portfolios' ) {
				kriya_breadcrumb_section( $post->ID, 'dt_portfolios' );
			} elseif( $post_type === "product" ) {
				kriya_breadcrumb_section( $post->ID, '_custom_settings' );
			} elseif( $post_type === "forum" ){
				$title = get_the_title( $post->ID );
				kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-single-forum");
			} elseif( $post_type === "topic" ){
				$title = get_the_title( $post->ID );
				kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-single-topic");
			} elseif( in_array('events-single', get_body_class()) ) {
				$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
				kriya_breadcrumb_section( $page_id, '' );
			} elseif( in_array('single-tribe_venue', get_body_class()) ) {
				$title = kriya_events_title();
				kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-tribe-single-venue");
			} elseif( in_array('single-tribe_organizer', get_body_class()) ) {
				$title = kriya_events_title();
				kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-tribe-single-organizer");
			} else {
				kriya_breadcrumb_section( $post->ID, '' );
            }			
		endif;
	elseif( is_home() && !is_front_page() ):
		$page_id = get_option('page_for_posts');
		kriya_breadcrumb_section( $page_id, 'page' );
	elseif( is_post_type_archive('tribe_events') ):
		$title = kriya_events_title();
		kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-tribe-events-archive");
	elseif( is_post_type_archive('forum') ):
		kriya_breadcrumb_section(  $post->ID , 'page' );
	elseif( is_post_type_archive('product') ):
		kriya_breadcrumb_section(  get_option('woocommerce_shop_page_id') , 'page' );
	elseif( is_tax() ):
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = esc_html__("Archive for Term: ",'kriya').$term->name;
		kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-archive-term");
    elseif( is_category( ) ):
        $title = esc_html__("Archive for Category: ",'kriya');
        $title .= single_cat_title('',FALSE);
		kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-archive-category");
    elseif( is_tag() ):
        $title = esc_html__("Archive for Tag: ",'kriya');
        $title .= single_tag_title('',FALSE);
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-archive-tags");
    elseif( is_month() ):
        $title = esc_html__("Archive for Month: ",'kriya');
        $title .=  get_the_time('F');
		kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-archive-month");
    elseif( is_year() ):
        $title = esc_html__("Archive for Year: ",'kriya');
        $title .=  get_the_time('Y');
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-archive-year");
    elseif(is_day() || is_time()):
    elseif( is_author() ):
        $curauth = get_user_by('slug',get_query_var('author_name')) ;
        $title  = esc_html__("Archive for Author: ",'kriya');
        $title .= $curauth->nickname;
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-archive-author");
	elseif(in_array('events-archive', get_body_class())):
		$title = kriya_events_title();
		kriya_breadcrumb_section_with_class( $title , "dt-breadcrumb-for-tribe-events-archive");
    elseif( is_search() ):
        $title  = esc_html__("Search Result for ",'kriya');
        $title .= get_search_query();
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-search");
    elseif( is_404() ):
        $title  = esc_html__("Lost ",'kriya');
        $title .= esc_html__("Oops Nothing Found",'kriya');
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-404");
	elseif( function_exists('bbp_is_search') && bbp_is_search() ):	
        $title  = esc_html__("Search Forum",'kriya');
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-search");
	elseif( function_exists('bbp_is_reply_edit') && bbp_is_reply_edit() ):	
        $title  = esc_html__("Edit Reply",'kriya');
        kriya_breadcrumb_section_with_class( $title, "dt-breadcrumb-for-search");
	endif;

/* ---------------------------------------------------------------------------
 * Breadcrumb Section
 * --------------------------------------------------------------------------- */
function kriya_breadcrumb_section($id, $post_type ) {

	$bcrumb = kriya_option('layout','show-breadcrumb');
	if( isset($bcrumb) && $bcrumb == 'true' ) :

		$title = get_the_title($id);

		if( $post_type === "post" )
			$settings = '_dt_post_settings';
		elseif( $post_type === "page")
			$settings = '_tpl_default_settings';
		elseif( $post_type === "dt_portfolios" )
			$settings = '_portfolio_settings';
		else
			$settings = '_custom_settings';

		$settings = get_post_meta( $id, $settings, TRUE );
		$settings = is_array($settings) ? $settings : array();
		
		$bg = $opacity = $position = $repeat = $color = '';
		$bg = array_key_exists('sub-title-bg', $settings) ? $settings['sub-title-bg'] : '';
		if(!empty($bg)) :
			$opacity = array_key_exists('sub-title-opacity', $settings) ? $settings['sub-title-opacity'] :'1';
			$position = array_key_exists('sub-title-bg-position', $settings) ? $settings['sub-title-bg-position'] :'center center';
			$repeat = array_key_exists('sub-title-bg-repeat', $settings) ? $settings['sub-title-bg-repeat'] :'repeat';
			$color = !empty($settings['sub-title-bg-color']) ? kriya_hex2rgb($settings['sub-title-bg-color']) : '';
		else:
			$bg = kriya_option('layout','sub-title-bg');
			$opacity = kriya_option('layout','sub-title-opacity');
			$opacity = !empty($opacity) ? $opacity : '1';
			$position = kriya_option('layout','sub-title-bg-position');
			$position = !empty($position) ? $position : 'center center';
			$repeat = kriya_option('layout','sub-title-bg-repeat');
			$repeat = !empty($repeat) ? $repeat : 'repeat';
			$color = kriya_option('layout','sub-title-bg-color');
			$color = !empty($color) ? kriya_hex2rgb($color) : '';
		endif;

		$style = !empty($bg) ? "background:url($bg) $position $repeat;" : "";
		$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : "";

		$bstyle = kriya_option('layout','breadcrumb-style');
		$bstyle .= kriya_option('layout','breadcrumb-darkbg') ? ' dt-sc-dark-bg ' : '';

		echo '<section class="main-title-section-wrapper '.esc_attr($bstyle).'" style="'.esc_attr($style).'">';
		echo '	<div class="container">';
		echo '		<div class="main-title-section">';
		echo 		'<h1>'."{$title}".'</h1>';
		echo '		</div>';
					kriya_breadcrumbs();
		echo '	</div>';
		echo '</section>';
	else:
		$title = get_the_title($id);
		echo '<div class="container">';
			echo '<div class="dt-sc-hr-invisible-medium "> </div><div class="dt-sc-clear"></div>';
			echo '<h1 class="simple-title">'."{$title}".'</h1>';
		echo '</div>';
	endif;
}

function kriya_breadcrumb_section_with_class ( $title , $class ){
	$bcrumb = kriya_option('layout','show-breadcrumb');
	if( isset($bcrumb) && $bcrumb == 'true' ) :

		$bg = kriya_option('layout','sub-title-bg');
		$opacity = kriya_option('layout','sub-title-opacity');
		$opacity = !empty($opacity) ? $opacity : '1';
		$position = kriya_option('layout','sub-title-bg-position');
		$position = !empty($position) ? $position : 'center center';
		$repeat = kriya_option('layout','sub-title-bg-repeat');
		$repeat = !empty($repeat) ? $repeat : 'repeat';
		$color = kriya_option('layout','sub-title-bg-color');
		$color = !empty($color) ? kriya_hex2rgb($color) : '';
		$style = !empty($bg) ? "background:url($bg) $position $repeat;" : "";
		$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : "";

		$bstyle = kriya_option('layout','breadcrumb-style');
		$bstyle .= kriya_option('layout','breadcrumb-darkbg') ? ' dt-sc-dark-bg ' : '';
		$class .= " ".$bstyle;

		echo '<section class="main-title-section-wrapper '.esc_attr($class).'" style="'.esc_attr($style).'">';
		echo '	<div class="container">';
		echo '		<div class="main-title-section">';
		echo '			<h1>'.esc_html($title).'</h1>';
		echo '		</div>';
					if( !is_search() ) {
						kriya_breadcrumbs();
					}
		echo '	</div>';
		echo '</section>';
	else:
		echo '<div class="container">';
		echo '	<div class="dt-sc-hr-invisible-medium "> </div><div class="dt-sc-clear"></div>';
		echo '	<h1 class="simple-title">'.$title.'</h1>';
		echo '</div>';
	endif;
}

function kriya_breadcrumbs(){
	global $post;
	
	$homeLink = esc_url( home_url('/') );
	$separator = '<span class="'.kriya_option('layout','breadcrumb-delimiter').'"></span>';
	
	// plugin of bbPress
	if( function_exists('is_bbpress') && is_bbpress() ){
		bbp_breadcrumb( array(
			'before' 		=> '<div class="breadcrumb">',
			'after' 		=> '</div>',
			'sep' 			=> '<span class="'.kriya_option('layout','breadcrumb-delimiter').'"></span>',
			'crumb_before' 	=> '',
			'crumb_after' 	=> '',
			'home_text' 	=> esc_html__('Home','kriya'),
		) );
		return true;
	}

	$breadcrumbs = array();

	$breadcrumbs[] =  '<a href="'. $homeLink .'">'. esc_html__('Home','kriya') .'</a>';

	// blog -----------------------------------------------
	if( get_post_type() == 'post' ){
		
		$blogID = false;
		if( get_option( 'page_for_posts' ) ){
			$blogID = get_option( 'page_for_posts' );	// settings > reading
		}
		if( $blogID ) $breadcrumbs[] = '<a href="'. get_permalink( $blogID ) .'">'. get_the_title( $blogID ) .'</a>';
	}
	
	if( function_exists('tribe_is_month') && ( tribe_is_event_query() || tribe_is_month() || tribe_is_event() || tribe_is_day() || tribe_is_venue() ) ) {

		if( function_exists('tribe_get_events_link') ){
			$breadcrumbs[] = '<a href="'. tribe_get_events_link() .'">'. tribe_get_events_title() .'</a>';
		}			
	} elseif( is_front_page() ){
		// do nothing
	} elseif( is_tag() ){
		$breadcrumbs[] = '<a href="'. get_tag_link( get_query_var('tag_id') ) .'">' . single_tag_title('', false) . '</a>';
	} elseif( is_category() ){
		$breadcrumbs[] = '<a href="'. get_category_link( get_query_var('cat') ) .'">' . single_cat_title('', false) . '</a>';
	} elseif( is_author() ){
		$breadcrumbs[] = '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">' . get_the_author() . '</a>';
	} elseif( is_day() ){
		$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">'. get_the_time('Y') .'</a>';
		$breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
		$breadcrumbs[] = '<a href="'. get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) .'">'. get_the_time('d') .'</a>';
	} elseif( is_month() ){
		$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a>';
		$breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
	} elseif( is_year() ){
		$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') .'</a>';
	} elseif( is_single() && ! is_attachment() ){

		if( get_post_type() == 'dt_portfolios' ){

			$cat = get_the_term_list(kriya_ID(), 'dt_portfolios_categories', '', '$$$', '');
			$cats = array_filter(explode('$$$', $cat));
			if (!empty($cats))
				$breadcrumbs[] = $cats[0];
			
			$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title().'</a>';
		} elseif( get_post_type() == 'product' ){

			$terms = get_the_terms( $post->ID, 'product_cat' );
			foreach ($terms as $term) {
				$term_link = get_term_link( $term );
				$breadcrumbs[] = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
			}
			$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title().'</a>';
		} elseif( get_post_type() == 'post' ) {

			$cat = get_the_category();
			if( $cat ) {
				$cat = $cat[0];
				$breadcrumbs[] = get_category_parents( $cat, true, $separator );
			}
			$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title() .'</a>';
		} else {
			$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title() .'</a>';
		}

	} elseif( is_page() && $post->post_parent ){

		$parent_id  = $post->post_parent;
		$parents = array();

		while( $parent_id ) {
			$page = get_page( $parent_id );
			$parents[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$parents = array_reverse( $parents );
		$breadcrumbs = array_merge_recursive($breadcrumbs, $parents);

		$breadcrumbs[] = '<span class="current">'. get_the_title( kriya_ID() ) .'</span>';

	} elseif( function_exists( 'is_woocommerce' ) && is_shop() ){

		$breadcrumbs[] = '<span class="current">'. get_the_title( kriya_ID() ) .'</span>';

	} elseif( get_post_taxonomies() ){
		$breadcrumbs[] = '<a href="' . get_category_link( get_query_var('cat') ) . '">' . single_cat_title('', false) . '</a>';
	} else {
		$breadcrumbs[] = '<span class="current">'. get_the_title( kriya_ID() ) .'</span>';
	}

	echo '<div class="breadcrumb">';
		$count = count( $breadcrumbs );
		$i = 1;

		foreach( $breadcrumbs as $bk => $bc ){
			if( !is_object( $bc ) ){
				if( strpos( $bc , $separator ) ) {
					// category parents fix
					echo "{$bc}";
				} else {
					if( $i == $count ) $separator = '';
					echo "{$bc}" . "{$separator}";
				}	
			}
			$i++;
		}
	echo '</div>';
}

function kriya_events_title() {
	
	global $wp_query;
	
	$title = '';
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', 'l, F jS Y' );
	
	if( tribe_is_month() && !is_tax() ) { 
		$title = sprintf( esc_html__( 'Events for %s', 'kriya' ), date_i18n( 'F Y', strtotime( tribe_get_month_view_date() ) ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_week() )  {
		$title = sprintf( esc_html__('Events for week of %s', 'kriya'), date_i18n( $date_format, strtotime( tribe_get_first_week_day($wp_query->get('start_date') ) ) ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_day() ) {
		$title = esc_html__( 'Events for', 'kriya' ) . ' ' . date_i18n( $date_format, strtotime( $wp_query->get('start_date') ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && (tribe_is_map() || tribe_is_photo()) ) {
		if( tribe_is_past() ) {
			$title = esc_html__( 'Past Events', 'kriya' );
		} else {
			$title = esc_html__( 'Upcoming Events', 'kriya' );
		}
	
	} elseif( tribe_is_list_view() )  {
		$title = esc_html__('Upcoming Events', 'kriya');
	} elseif (is_single())  {
		$title = $wp_query->post->post_title;
	} elseif( tribe_is_month() && is_tax() ) {
		$term_slug = $wp_query->query_vars['tribe_events_cat'];
		$term = get_term_by('slug', $term_slug, 'tribe_events_cat');
		$name = $term->name;
		$title = $name;
	} elseif( is_tag() )  {
		$title = esc_html__('Tag Archives','kriya');
	}
	return $title;
}
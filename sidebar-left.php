<?php
wp_reset_postdata();
$post = kriya_global_variables('post');

if( is_page() ):
	$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
	kriya_show_sidebar( 'page', $page_id, 'left');
elseif( is_single() ):
	if( is_singular('post') ) {
		$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		kriya_show_sidebar('post',$id, 'left');
	} elseif( is_singular('dt_portfolios') ) {
		$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		kriya_show_sidebar('dt_portfolios',$id, 'left');
	} elseif( is_singular('product') ) {
		$enable = kriya_option('woo','show-shop-standard-left-sidebar-for-product-layout');
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar') ):
				dynamic_sidebar('shop-everywhere-sidebar');
			endif;
		endif;
		
		if( is_active_sidebar('product-detail-sidebar') ):
			dynamic_sidebar('product-detail-sidebar');
		endif;
	} else {
		kriya_show_sidebar('',$id, 'left');
	}
elseif( class_exists('woocommerce') && is_shop() ):
	$page_id = get_option('woocommerce_shop_page_id');
	kriya_show_sidebar( 'page', $page_id, 'left');
elseif( class_exists('woocommerce') && is_product_category() ):

	if( is_active_sidebar('product-category-sidebar') ):
		dynamic_sidebar('product-category-sidebar');
	endif;

	$enable = kriya_option('woo','show-shop-standard-left-sidebar-for-product-category-layout');
	if( $enable ):
		if( is_active_sidebar('shop-everywhere-sidebar') ):
			dynamic_sidebar('shop-everywhere-sidebar');
		endif;
	endif;	
elseif( class_exists('woocommerce') && is_product_tag() ):

	if( is_active_sidebar('product-tag-sidebar') ):
		dynamic_sidebar('product-tag-sidebar');
	endif;

	$enable = veda_option('woo','show-shop-standard-left-sidebar-for-product-tag-layout');
	if( $enable ):
		if( is_active_sidebar('shop-everywhere-sidebar') ):
			dynamic_sidebar('shop-everywhere-sidebar');
		endif;
	endif;	
elseif( is_tax() ):
	$tax = get_query_var( 'taxonomy' );

	if( $tax == 'dt_portfolios_categories' ) {

		$enable =  kriya_option('pageoptions','show-standard-left-sidebar-for-portfolio-archives');
		if( is_active_sidebar('custom-post-portfolio-archives-sidebar') ):
			dynamic_sidebar('custom-post-portfolio-archives-sidebar');
		endif;
	}

	if( $tax == 'dt_yoga_days' || $tax == 'dt_yoga_classes' || $tax == 'dt_yoga_stages' || $tax == 'dt_yoga_period' ) {

		$enable = kriya_option('pageoptions','show-standard-left-sidebar-for-course-archives');

		if( is_active_sidebar('dt_yoga_courses-archive-sidebar') ):
			dynamic_sidebar('dt_yoga_courses-archive-sidebar');
		endif;
	}

	if( $enable ):
		if( is_active_sidebar('standard-sidebar') ):
			dynamic_sidebar('standard-sidebar');
		endif;
	endif;
elseif( is_archive() || is_search() ):
	if( is_active_sidebar('post-archives-sidebar') ):
		dynamic_sidebar('post-archives-sidebar');
	endif;

	$enable = kriya_option('pageoptions','show-standard-left-sidebar-for-post-archives');
	if($enable):
		if( is_active_sidebar('standard-sidebar') ):
			dynamic_sidebar('standard-sidebar');
		endif;
	endif;
elseif( is_home() ):
	$page_id = get_option('page_for_posts');
	kriya_show_sidebar('page',$page_id, 'left');
	$enable = kriya_option('pageoptions','show-standard-left-sidebar-for-post-archives');
	if($enable):
		if( is_active_sidebar('standard-sidebar') ):
			dynamic_sidebar('standard-sidebar');
		endif;
	endif;
else:
	if( is_active_sidebar('standard-sidebar') ):
		dynamic_sidebar('standard-sidebar');
	endif;
endif;?>
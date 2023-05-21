<?php
/**
 * Kriya util functions
 */
require get_template_directory().'/framework/register-utils.php';

/**
 * Kriya functions
 */
require get_template_directory().'/framework/register-functions.php';

require get_template_directory().'/framework/register-head.php';

/**
 * Mega menu
 */
require get_template_directory().'/framework/register-megamenu.php';

/**
 * Kriya Theme options
 */
require get_template_directory().'/framework/theme-options/init.php';

/**
 * Register Plugins
 */
require get_template_directory().'/framework/register-plugins.php';

/**
 * Woocommerce
 */
if( class_exists('woocommerce') ) {
	require get_template_directory().'/framework/register-woocommerce.php';
}

# Global
$GLOBALS['enable_global_page_layout'] = kriya_option("pageoptions","force-enable-global-page-layout");
$global_page_layout = kriya_option("pageoptions","global-page-layout");
$GLOBALS['global_page_layout'] = !empty($global_page_layout) ? $global_page_layout : 'content-full-width';

$GLOBALS['enable_global_post_layout'] = kriya_option("pageoptions","force-enable-global-post-layout");
$global_post_layout = kriya_option("pageoptions","global-post-layout");
$GLOBALS['global_post_layout'] = !empty($global_post_layout) ? $global_post_layout : 'content-full-width';
	
// Gutenberg ---------------------------------------------------------------------- 
require_once( get_template_directory().'/framework/register-gutenberg-editor.php' ); ?>
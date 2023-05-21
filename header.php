<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php kriya_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>><?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	// loader
	$loader = kriya_option('general','enable-loader');
	if( isset($loader) ) :
		echo '<div class="loader">
				<div class="loader-inner">
					<div></div>
				</div>
			</div>';
	endif; ?>
	<!-- ** Wrapper ** -->
	<div class="wrapper">

		<!-- ** Inner Wrapper ** -->
		<div class="inner-wrapper">

			<!-- ** Header Wrapper ** -->
			<?php $hdarkbg = kriya_option('layout','header-darkbg');
				$class = isset( $hdarkbg ) ? "dt-sc-dark-bg" : ""; ?>
			<div id="header-wrapper" class="<?php echo esc_attr( $class ); ?>">

				<!-- ** Header ** -->
				<header id="header">

					<!-- ** Main Header Wrapper ** -->
					<div id="main-header-wrapper" class="main-header-wrapper">
						<div class="container">

							<!-- ** Main Header ** -->
							<div class="main-header">

								<!-- Logo -->
								<div id="logo"><?php
									if( kriya_option('layout', 'logo') ) :
										$url = kriya_option('layout', 'logo-url');
										$url = !empty( $url ) ? $url : get_template_directory_uri() . "/images/logo.png";

										$retina_url = kriya_option('layout','retina-logo-url');
										$retina_url = !empty($retina_url) ? $retina_url : get_template_directory_uri() ."/images/logo@2x.png";

										$width = kriya_option('layout','retina-logo-width');
										$width = !empty($width) ? $width."px;" : "96px";

										$height = kriya_option('layout','retina-logo-height');
										$height = !empty($height) ? $height."px;" : "81px";?>
										<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('title'); ?>">
											<img class="normal_logo" src="<?php echo esc_url($url); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" />
											<img class="retina_logo" src="<?php echo esc_url($retina_url); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" style="width:<?php echo esc_attr($width); ?>; height:<?php echo esc_attr($height); ?>;"/>
										</a><?php
									else:?>
										<div class="logo-title">
											<h1 id="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
											<h2 id="site-description"><?php bloginfo('description'); ?></h2>
										</div><?php
									endif;?>
								</div><!-- Logo - End -->

								<!-- Menu -->
								<div class="menu-wrapper">
									<div class="dt-menu-toggle" id="dt-menu-toggle">
										<?php esc_html_e('Menu','kriya'); ?>
										<span class="dt-menu-toggle-icon"></span>
									</div><?php

									$htype = kriya_option('layout','header-type');

									switch($htype):
										case 'split-header fullwidth-header':
										case 'split-header boxed-header':
											echo '<nav id="main-menu">';
											kriya_wp_split_menu();
											echo '</nav>';
										break;

										default:
											kriya_menu_fallback();
										break;
									endswitch;?>
								</div><!-- Menu -->
							</div><!-- ** Main Header - End ** -->
						</div>
					</div><!-- ** Main Header Wrapper - End ** -->

					<?php kriya_slider(); ?>

				</header><!-- ** Header - End ** -->
			</div><!-- ** Header Wrapper ** -->

			<!-- ** Main ** -->
			<div id="main">
				<?php require_once get_template_directory().'/breadcrumb.php';?>
                  
				<div class="container">
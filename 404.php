<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php kriya_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head><?php
$bg = kriya_option('pageoptions','notfound-bg');
$opacity = kriya_opts_get('notfound-bg-opacity', '1');
$position = kriya_opts_get('notfound-bg-position', 'center center');
$repeat = kriya_opts_get('notfound-bg-repeat', 'no-repeat');
$color = kriya_option('pageoptions','notfound-bg-color');

$estyle = kriya_option('pageoptions','notfound-bg-style');
$color = !empty($color) ? kriya_hex2rgb($color) : array('f', 'f', 'f');
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class(); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper">
	<div class="center-content-wrapper">
		<div class="center-content"><?php
			$pageid = kriya_option('pageoptions','notfound-pageid');
			if( kriya_option('pageoptions','enable-404message') && !empty($pageid) ):
				$page = get_post( $pageid, ARRAY_A );
				echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
			elseif( kriya_option('pageoptions','enable-404message') ):
				echo '<h2>'.esc_html__('404 - Page Not Found', 'kriya').'</h2><h5>'.esc_html__('The Page you are looking for is not found or does not exist.', 'kriya').'</h5>';
				echo '<a class="dt-sc-button small icon-right with-icon rounded-corner type2" target="_self" href="'.esc_url( home_url('/') ).'">'.esc_html__('Back to Home','kriya').' <span class="fa fa-home"> </span></a>';
			endif; ?>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
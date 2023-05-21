<?php
/* ---------------------------------------------------------------------------
 * Custom CSS from Theme option panel
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit;

# Header Background
$headbg = kriya_option('layout','header-bg');
$bgrepeat = kriya_opts_get('header-bg-repeat', 'no-repeat');
$bgposition = kriya_opts_get('header-bg-position', 'center center');
if( !empty( $headbg) ) {?>
	#header-wrapper::before, .main-header-wrapper { background-image: url('<?php echo "{$headbg}";?>'); background-repeat: <?php echo "{$bgrepeat}";?>; background-position: <?php echo "{$bgposition}";?>; }<?php
}

#Header color
$hcolor = kriya_option('colors','header-bgcolor');
if( isset($hcolor) && ($hcolor != '') ):
	$rgbcolor = kriya_hex2rgb(kriya_opts_get('header-bgcolor', ''));
	$rgbcolor = implode(',', $rgbcolor);
	$opacity = kriya_opts_get('header-bgcolor-opacity', '1');
	echo '#header-wrapper::before, .main-header-wrapper, .split-header.boxed-header #header-wrapper::before, .main-header-wrapper { background-color: rgba('.$rgbcolor.','.$opacity.'); }';
endif;


echo '#logo .logo-title > h1 a, #logo .logo-title h2{ color:'.kriya_opts_get('site-title').'}';


# Menu & Mega Menu
	$mbg = kriya_option('colors','menu-bgcolor');
	if( isset($mbg) ):
		$rgbcolor = kriya_hex2rgb(kriya_opts_get('menu-bgcolor', ''));
		$rgbcolor = implode(',', $rgbcolor);
		$opacity = kriya_opts_get('menu-bgcolor-opacity', '1');
		echo '.menu-wrapper {  background: rgba('.$rgbcolor.','.$opacity.') }';
	endif;

	echo '#main-menu ul.menu > li > a, #main-menu ul.menu > li > span { color:'.kriya_opts_get('menu-linkcolor','#fff').'}';

	$menu_hover_color = kriya_option('colors','menu-hovercolor');
	if( isset( $menu_hover_color ) ):
		echo '#main-menu ul.menu > li > a:hover, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu > li.menu-item-simple-parent:hover > a { color:'.$menu_hover_color.'; }';
		echo '#main-menu ul.menu > li > a::before, #main-menu ul.menu > li > a::after { border-color:'.$menu_hover_color.'; }';
	endif;	

	$menu_active_color = kriya_option('colors','menu-activecolor');
	if( isset( $menu_active_color ) ):
		echo '#main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a {color:'.$menu_active_color.';}';
	
		echo '#main-menu ul.menu > li > a::before, #main-menu ul.menu > li > a::after { border-color:'.$menu_active_color.'; }';
	endif;		

	$applymenuborder = kriya_option('layout','menu-border');
	$applymenuborder = kriya_option('layout','menu-border');
	if( isset( $applymenuborder ) ):
		$borderstyle = kriya_option('layout','menu-border-style');
		$bordercolor = kriya_option('layout','menu-border-color');
	
		$bwtop = kriya_option('layout','menu-border-width-top');
		$bwright = kriya_option('layout','menu-border-width-right');
		$bwbottom = kriya_option('layout','menu-border-width-bottom');
		$bwleft = kriya_option('layout','menu-border-width-left');
	
		$brtop = kriya_option('layout','menu-border-radius-top');
		$brright = kriya_option('layout','menu-border-radius-right');
		$brbottom = kriya_option('layout','menu-border-radius-bottom');
		$brleft = kriya_option('layout','menu-border-radius-left'); ?>

		#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
	    	border-style:<?php echo "{$borderstyle}";?>;
	        border-color:<?php echo "{$bordercolor}";?>;        
			<?php if( isset( $bwtop ) ); ?>
	        	border-top-width:<?php echo "{$bwtop}";?>px;        
			<?php if( isset( $bwright ) ); ?>
	    		border-right-width:<?php echo "{$bwright}";?>px;        
	        <?php if( isset( $bwbottom ) ); ?>
	    		border-bottom-width:<?php echo "{$bwbottom}";?>px;
	        <?php if( isset( $bwleft ) ); ?>
	        	border-left-width:<?php echo "{$bwleft}";?>px;
	        <?php if( isset( $brtop ) ); ?>
	        	border-top-left-radius:<?php echo "{$brtop}";?>px;    
	        <?php if( isset( $brright ) ); ?>
	    		border-top-right-radius:<?php echo "{$brright}";?>px;        
	    	<?php if( isset( $brbottom ) ); ?>
	    		border-bottom-right-radius:<?php echo "{$brbottom}";?>px;        
	    	<?php if( isset( $brleft ) ); ?>
	    		border-bottom-left-radius:<?php echo "{$brleft}";?>px;
		}<?php
	endif;

	# Mega Menu Container BG Color
	$menubgcolor = kriya_option('layout','menu-bg-color');
	if( isset( $menubgcolor ) ):
		echo '#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container { background-color:'.$menubgcolor.'}';
	endif;

	# Mega Menu Container gradient
	$menugrc1 =  kriya_option('layout','menu-gradient-color1');
	$menugrc2 =  kriya_option('layout','menu-gradient-color2');
	if( isset($menugrc1) && isset($menugrc2) ) {
		$p1 = (kriya_option('layout','menu-gradient-percent1') != NULL) ? kriya_option('layout','menu-gradient-percent1') : "0%";
		$p2 = (kriya_option('layout','menu-gradient-percent2') != NULL) ? kriya_option('layout','menu-gradient-percent2') : "100%";?>
		#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
			background: <?php echo "{$menugrc1}"; ?>; /* Old browsers */
			background: -moz-linear-gradient(top, <?php echo ''.$menugrc1.' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* FF3.6-15 */
			background: -webkit-linear-gradient(top, <?php echo ''.$menugrc1.' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom, <?php echo ''.$menugrc1.' '.$p1.', '.$menugrc2.' '.$p2 ?>); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo "{$menugrc1}"; ?>', endColorstr='<?php echo "{$menugrc2}"; ?>',GradientType=0 ); /* IE6-9 */ }<?php
	}

	# Default Menu Title text and hover color
	$titletextdcolor = kriya_option('layout','menu-title-text-dcolor');
	$titletextdhcolor = kriya_option('layout','menu-title-text-dhcolor');


	if( isset( $titletextdcolor) ) :?>
		#main-menu .megamenu-child-container > ul.sub-menu > li > a, #main-menu .megamenu-child-container > ul.sub-menu > li > .nolink-menu { color:<?php echo "{$titletextdcolor}";?>; }<?php
	endif;
	if( isset( $titletextdhcolor) ):?>
		#main-menu .megamenu-child-container > ul.sub-menu > li > a:hover { color:<?php echo "{$titletextdhcolor}";?>; }
		#main-menu .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { color:<?php echo "{$titletextdhcolor}";?>; }<?php
	endif;		

	# Menu Title Background
	if( "true" == kriya_option('layout','menu-title-bg') ) :
		$menutitlebgcolor = kriya_option('layout','menu-title-bg-color');
		$bghovercolor = kriya_option('layout','menu-title-hoverbg-color');
		$menutitletxtcolor = kriya_option('layout','menu-title-text-color');
		$hovertxtcolor = kriya_option('layout','menu-title-hovertext-color');
		$menutitlebr = kriya_option('layout','menu-title-border-radius'); ?>
	    #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
	    	<?php if( isset( $menutitlebgcolor ) ); ?>
	        	background:<?php echo "{$menutitlebgcolor}";?>;
	        <?php if( isset( $menutitlebr ) ); ?>
	        	border-radius:<?php echo "{$menutitlebr}";?>px;        
	    }
	    
	    <?php if( isset($bghovercolor) ) {?>
	    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover { background:<?php echo "{$bghovercolor}";?>;}
			#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { background:<?php echo "{$bghovercolor}";?>; }<?php
		}
		
		if( isset( $menutitletxtcolor ) ) {?>
	    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a .menu-item-description { color:<?php echo "{$menutitletxtcolor}";?>;}<?php
		}
		
		if( isset( $hovertxtcolor ) ) {?>
	    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover .menu-item-description { color:<?php echo "{$hovertxtcolor}";?>;}
			#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a .menu-item-description
	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a .menu-item-description { color:<?php echo "{$hovertxtcolor}";?>; }<?php
		}
	endif;

	#Menu Title With Border
	$mtbwtop = kriya_option('layout','menu-title-border-width-top');
	$mtbwright = kriya_option('layout','menu-title-border-width-right');
	$mtbwbottom = kriya_option('layout','menu-title-border-width-bottom');
	$mtbwleft = kriya_option('layout','menu-title-border-width-left');

	if( isset($mtbwtop) || isset($mtbwright) || isset($mtbwbottom) || isset($mtbwleft) ) :

		$menutitlebrc = kriya_option('layout','menu-title-border-color');
		$menutitlebrs = kriya_option('layout','menu-title-border-style'); ?>
	    #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
	    	<?php if( isset( $mtbwtop ) ) : ?>
	        		 border-top-width:<?php echo "{$mtbwtop}"; ?>px;
	                 padding-top:10px;

	    	<?php endif;
				  if( isset( $mtbwright ) ): ?>
	        		 border-right-width:<?php echo "{$mtbwright}"; ?>px;
	                 padding-right:10px;

	    	<?php endif;
				  if( isset( $mtbwbottom ) ): ?>
	        		 border-bottom-width:<?php echo "{$mtbwbottom}"; ?>px;
	                 padding-bottom:10px;

	    	<?php endif;
				  if( isset( $mtbwleft ) ): ?>
	        		 border-left-width:<?php echo "{$mtbwleft}"; ?>px;
	                 padding-left:10px;       
	    	
	        <?php endif;
			     if( isset( $menutitlebrs ) ); ?>
	        	 	border-style:<?php echo "{$menutitlebrs}";?>;
	        <?php if( isset( $menutitlebrc ) ); ?>
	        		 border-color:<?php echo "{$menutitlebrc}";?>;
	   }<?php	
	endif;

	# Default text and hover color
	$textdcolor = kriya_option('layout','menu-link-text-dcolor');
	$textdhcolor = kriya_option('layout','menu-link-text-dhcolor');

	if( isset( $textdcolor) ) :?>
		#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a { color:<?php echo "{$textdcolor}";?>; }<?php
	endif;

	if( isset( $textdhcolor) ) :?>
		#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover { color:<?php echo "{$textdhcolor}";?>; }
		#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-ancestor > a { color:<?php echo "{$textdhcolor}";?>; }<?php
	endif;

	# Menu Links Background
	if( "true" == kriya_option('layout','menu-links-bg') ) :
		$menulinkbgcolor = kriya_option('layout','menu-link-bg-color');
		$menulinkbghovercolor = kriya_option('layout','menu-link-hoverbg-color');
		$menulinktxtcolor = kriya_option('layout','menu-link-text-color');
		$menulinkhovertxtcolor = kriya_option('layout','menu-link-hovertext-color');
		$menulinkbr = kriya_option('layout','menu-link-border-radius');
		echo "\n";?>    
	    /* Menu Link */   
	    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a {
	    	<?php if( !is_null( $menulinkbgcolor ) || !empty( $menulinkbgcolor ) ):?>
	        		background:<?php echo "{$menulinkbgcolor}";?>;
	        <?php endif;
				if( isset( $menulinkbr ) ); ?>
	        	border-radius:<?php echo "{$menulinkbr}";?>px;
	        <?php if(!is_null($menulinktxtcolor) || !empty( $menulinktxtcolor ) ): ?>
	        	color:<?php echo "{$menulinktxtcolor}";?>;
	        <?php endif; ?>
	    }
	    /* Menu Link Hover */
	    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a:hover {
	    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
	        		background:<?php echo "{$menulinkbghovercolor}";?>;
	        <?php endif;
				if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
	        	color:<?php echo "{$menulinkhovertxtcolor}";?>;
	       <?php endif;?>
	    }
		#main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-ancestor > a {
	    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
	        	background:<?php echo "{$menulinkbghovercolor}";?>;
	        <?php endif;
				if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
	        	color:<?php echo "{$menulinkhovertxtcolor}";?>;
	        <?php endif;?>
	    }<?php
	endif;

	#Menu link hover boder 
	if( "true" == kriya_option('layout','menu-hover-border') ) {
		$mlhcolor = kriya_option('layout','menu-link-hborder-color');
		
		if( isset( $mlhcolor ) ) {?>   
	      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li, #main-menu ul li.menu-item-simple-parent ul > li { width:100%; box-sizing:border-box; } 
	      #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a { padding-left:27px; }
		  #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a:before, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a:before { left:12px; }
	      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a { padding:7px 10px; width:100%; box-sizing:border-box; border:1px solid transparent; }
	      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover {
	        border:1px solid <?php echo "{$mlhcolor}";?>;        
	      }<?php		
		}
	}

	#Menu Links With Border
	if( "true" == kriya_option('layout','menu-links-border') ) :

		$menulinkbrw = kriya_option('layout','menu-link-border-width');
		$menulinkbrc = kriya_option('layout','menu-link-border-color');
		$menulinkbrs = kriya_option('layout','menu-link-border-style'); ?>
	    #main-menu .menu-item-megamenu-parent.menu-links-with-border .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-border ul > li > a {
	    	<?php if( isset( $menulinkbrw ) ); ?>
	        	 border-bottom-width:<?php echo "{$menulinkbrw}";?>px;
	        <?php if( isset( $menulinkbrc ) ); ?>
	        	 border-bottom-style:<?php echo "{$menulinkbrs}";?>;
	        <?php if( isset( $menulinkbrs ) ); ?>
	        	 border-bottom-color:<?php echo "{$menulinkbrc}";?>;
	   }<?php	
	endif;	

# Body Color
	$ccolor = kriya_option('colors','content-text-color');
	if( isset( $ccolor) ):
		echo 'body { color:'.$ccolor.'}';
	endif;

	$ccolor = kriya_option('colors','content-link-color');
	if( isset( $ccolor) ):
		echo 'a { color:'.$ccolor.'}';
	endif;

	$ccolor = kriya_option('colors','content-link-hcolor');
	if( isset( $ccolor) ):
		echo 'a:hover { color:'.$ccolor.'}';
	endif;


	# Headings
	for($i = 1; $i <= 6; $i++):

		$out = '';
		$hcolor = kriya_option("colors","heading-h{$i}-color");
		$out .= isset($hcolor) ? 'color:'.$hcolor.';' : '';

		$hsize = kriya_option("fonts","h{$i}-font-size");
		$out .= isset($hsize) ? 'font-size:'.$hsize.'px;' : '';

		$hweight = kriya_option("fonts","h{$i}-weight");
		$out .= isset($hweight) ? 'font-weight:'.$hweight.';' : '';	

		$hspacing = kriya_option('fonts',"h{$i}-letter-spacing");
		$out .= isset($hspacing) ? 'letter-spacing:'.$hspacing : '';

		if( !empty( $out ) )
			echo "h{$i}{".$out."}";		
	endfor;
	

# Custom CSS
if( ($custom_css = kriya_option('layout','customcss-content')) &&  kriya_option('layout','enable-customcss')){
	echo stripcslashes( $custom_css )."\n";
}

# Footer?>
.footer-widgets {
	background: rgba(<?php
    $rgbcolor = kriya_hex2rgb(kriya_opts_get('footer-bgcolor', '#000000'));
	$rgbcolor = implode(',', $rgbcolor);
	echo "{$rgbcolor}"; ?>, <?php kriya_opts_show('footer-bgcolor-opacity', '1'); ?>) url( <?php kriya_opts_show('footer-bg', ''); ?> ) <?php kriya_opts_show('footer-bg-position', 'center center'); ?> <?php kriya_opts_show('footer-bg-repeat', 'no-repeat'); ?>;
}<?php
$darkbg = kriya_option('layout','footer-darkbg');
if( isset($darkbg) ): ?>
	.footer-widgets.dt-sc-dark-bg { color:<?php kriya_opts_show('footer-text-color', 'rgba(255, 255, 255, 0.6)'); ?>; }
	.footer-widgets.dt-sc-dark-bg a { color:<?php kriya_opts_show('footer-link-color', 'rgba(255, 255, 255, 0.6)'); ?>; }
    .footer-widgets.dt-sc-dark-bg a:hover { color:<?php kriya_opts_show('footer-link-hcolor', 'rgba(255, 255, 255, 0.6)'); ?>; }
	.footer-widgets.dt-sc-dark-bg h3, .footer-widgets.dt-sc-dark-bg h3 a { color:<?php kriya_opts_show('footer-heading-color', '#ffffff'); ?>; }<?php
else: ?>
	.footer-widgets { color:<?php kriya_opts_show('footer-text-color', '#000000'); ?>; }
	.footer-widgets a { color:<?php kriya_opts_show('footer-link-color', '#000000'); ?>; }
    .footer-widgets a:hover { color:<?php kriya_opts_show('footer-link-hcolor', '#000000'); ?>; }
	.footer-widgets h3, .footer-widgets h3 a { color:<?php kriya_opts_show('footer-heading-color', '#000000'); ?>; }<?php
endif;

# Copyright?>
.footer-copyright {
	background: rgba(<?php
    $rgbcolor = kriya_hex2rgb(kriya_opts_get('copyright-bgcolor', '#000000'));
	$rgbcolor = implode(',', $rgbcolor);
	echo "{$rgbcolor}"; ?>, <?php kriya_opts_show('copyright-bgcolor-opacity', '1'); ?>);
}<?php
$darkbg = kriya_option('layout','copyright-darkbg');
if( isset($darkbg) ): ?>
	#footer .footer-copyright.dt-sc-dark-bg { color:<?php kriya_opts_show('copyright-text-color', 'rgba(255, 255, 255, 0.6)'); ?>; }
	#footer .footer-copyright.dt-sc-dark-bg a { color:<?php kriya_opts_show('copyright-link-color', 'rgba(255, 255, 255, 0.6)'); ?>; }
	#footer .footer-copyright.dt-sc-dark-bg a:hover { color:<?php kriya_opts_show('copyright-link-hcolor', 'rgba(255, 255, 255, 0.6)'); ?>; }<?php
else: ?>
	#footer .footer-copyright { color:<?php kriya_opts_show('copyright-text-color', '#000000'); ?>; }
	#footer .footer-copyright a { color:<?php kriya_opts_show('copyright-link-color', '#000000'); ?>; }
	#footer .footer-copyright a:hover { color:<?php kriya_opts_show('copyright-link-hcolor', '#000000'); ?>; }<?php
endif;

#Font
$h1f = kriya_option('fonts','h1-font');
if( isset($h1f) ) {
	echo 'h1 { font-family:'.$h1f.'}';
}

$h2f = kriya_option('fonts','h2-font');
if( isset($h2f) ) {
	echo 'h2 { font-family:'.$h2f.'}';
}

$h3f = kriya_option('fonts','h3-font');
if( isset($h3f) ) {
	echo 'h3 { font-family:'.$h3f.'}';
}

$h4f = kriya_option('fonts','h4-font');
if( isset($h4f) ) {
	echo 'h4 { font-family:'.$h4f.'}';
}

$h5f = kriya_option('fonts','h5-font');
if( isset($h5f) ) {
	echo 'h5 { font-family:'.$h5f.'}';
}

$h6f = kriya_option('fonts','h6-font');
if( isset($h6f) ) {
	echo 'h6 { font-family:'.$h6f.'}';
}

# Body
	$body = kriya_option('fonts','content-font');
	if( isset($body) ) {
		echo 'body { font-family:'.$body.'}';
	}

	$out = '';
	$body_f_s = kriya_option('fonts','content-font-size');
	$body_line_height = kriya_option('fonts','body-line-height');
	$out .= isset($body_f_s) ? 'font-size:'.$body_f_s.'px;' : '';
	$out .= isset($body_line_height) ? 'line-height:'.$body_line_height.'px;' : '';

	if( !empty( $out ) )
		echo "body{".$out."}";

# Menu Font
	$out = '';
	$menu_font = kriya_option('fonts','menu-font');
	$menu_f_s = kriya_option('fonts','menu-font-size');
	$menu_f_w = kriya_option('fonts','menu-weight');
	$menu_line_height = kriya_option('fonts','menu-line-height');
	$menu_letter_spacing = kriya_option('fonts','menu-letter-spacing');

	$out .= isset($menu_font) ? 'font-family:'.$menu_font.';' : '';
	$out .= isset($menu_f_s) ? 'font-size:'.$menu_f_s.'px;' : '';
	$out .= isset($menu_f_w) ? 'font-weight:'.$menu_f_w.';' :'';
	$out .= isset($menu_line_height) ? 'line-height:'.$menu_line_height.'px;' : '';
	$out .= isset($menu_letter_spacing) ? 'letter-spacing:'.$menu_letter_spacing : '';

	if( !empty( $out ) )
		echo "#main-menu ul.menu > li > a, .split-header #main-menu ul.menu > li > a {".$out."}";	

# Page Title Font
$pagetitle_font = kriya_option('fonts','pagetitle-font');
if( isset($pagetitle_font) ) {
	echo '.main-title-section > h1 { font-family:'.$pagetitle_font.' }';
}
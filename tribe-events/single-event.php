<?php get_header();
	$event_id = get_the_ID();
	$tpl_default_settings = get_post_meta($event_id,'_custom_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";
	
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

				$time_format = get_option( 'time_format' );
				$date_format = tribe_get_date_option( 'dateWithoutYearFormat', 'm d' );
				$raw_separator = tribe_get_option( 'dateTimeSeparator', ' @ ' );

				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('type4'); ?>>

					<h2><?php the_title(); ?></h2>
    				<div class="dt-sc-hr-invisible-xsmall"></div>

				    <div class="dt-sc-one-half column first">
						<?php echo tribe_event_featured_image( $event_id, 'event-single-type4', false );
						the_content(); ?>
				    </div>

				    <div class="dt-sc-one-half column">
				    	<div class="data-wrapper">
				        	<p>
				            	<span><?php echo tribe_get_start_date ( $event_id, true, 'd' ); ?></span>
				                <?php echo tribe_get_start_date ( $event_id, true, 'F' ); ?><br />
				                <?php echo tribe_get_start_date ( $event_id, true, 'l' ).$raw_separator; echo '<i>'.tribe_get_start_time ( $event_id, $time_format ). ' - '.tribe_get_end_time ( $event_id, $time_format ).'</i>'; ?>
				            </p>
				        </div>
					    <div class="dt-sc-hr-invisible-xsmall"></div>

						<div class="dt-sc-one-half column first">
				        	<div class="event-details">
				                <h3><?php esc_html_e('Details', 'kriya'); ?></h3>
				                <ul>
				                    <li><dt><?php esc_html_e('Start:', 'kriya'); ?></dt><?php echo tribe_get_start_date ( $event_id, true, $date_format ).$raw_separator .tribe_get_start_time ( $event_id, $time_format ); ?></li>
				                    <li><dt><?php esc_html_e('End:', 'kriya'); ?></dt><?php echo tribe_get_end_date ( $event_id, true, $date_format ).$raw_separator .tribe_get_end_time( $event_id, $time_format ); ?></li>
				                    <?php if ( tribe_get_cost() ) : ?>
				                        <li><dt><?php esc_html_e('Cost:', 'kriya'); ?></dt><?php echo tribe_get_cost( $event_id, true ); ?></li>
				                    <?php endif; ?>
				                    <li><dt class="cat"><?php echo tribe_get_event_categories( $event_id, array( 'before' => '', 'sep' => ', ',  'after' => '', 'label' => '', 'label_before' => esc_html_e('Event Category', 'kriya'),
				                                                                                 'label_after'  => '</dt>', 'wrap_before' => '<div class="cat-wrapper">', 'wrap_after' => '</div>' )); ?></li>
				                    <li><?php echo tribe_meta_event_tags( 'Event Tags:', ', ', false ); ?></li>
				                    <?php
				                    $website = tribe_get_event_website_link();
				                    if(!empty($website)): ?>
				                        <li><dt><?php esc_html_e('Website:', 'kriya'); ?></dt><?php echo apply_filters( 'tribe_get_event_website_link', $website ); ?></li><?php
				                    endif; ?>
				                </ul>
				            </div>
				        </div>
				        
					    <div class="dt-sc-one-half column">
				        	<div class="event-organize">
				                <h3><?php esc_html_e('Organizer', 'kriya'); ?></h3>
				                <h4><?php
				                if(class_exists( 'Tribe__Events__Pro__Main' ))
				                    echo tribe_get_organizer_link ( $event_id, true, false );
				                else
				                    echo tribe_get_organizer(); ?></h4>
				                <ul><?php
				                    $phone = tribe_get_organizer_phone();
				                    if(!empty($phone)): ?>
				                        <li><dt><?php esc_html_e('Phone:', 'kriya'); ?></dt><?php echo esc_html( $phone ); ?></li><?php
				                    endif;
				                    $email = tribe_get_organizer_email();
				                    if(!empty($email)): ?>
				                        <li><dt><?php esc_html_e('Email:', 'kriya'); ?></dt><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo apply_filters( 'tribe_get_organizer_email', $email ); ?></a></li><?php
				                    endif;
				                    $website = tribe_get_organizer_website_link();
				                    if(!empty($website)): ?>
				                        <li><dt><?php esc_html_e('Website:', 'kriya'); ?></dt><?php echo apply_filters( 'tribe_get_organizer_website_link',$website ); ?></li><?php
				                    endif; ?>
				                </ul>
				            </div>        
				        </div>

				        <div class="dt-sc-clear"></div><?php
				        # Google map...
				        $map = tribe_get_embedded_map($event_id, '', 260);
				        if(!empty($map)): ?>
				            <div class="event-google-map">
								<?php echo apply_filters( 'tribe_get_embedded_map', $map ); ?>
				            </div><?php
				        endif; ?>
				        <div class="dt-sc-hr-invisible-small"></div>
				        
				        <div class="event-venue">
				            <h3><?php esc_html_e('Venue', 'kriya'); ?></h3>
				            <h4><?php
				            if(class_exists( 'Tribe__Events__Pro__Main' ))
				                echo tribe_get_venue_link($event_id, true);
				            else
				                echo tribe_get_venue($event_id); ?></h4>

							<div class="dt-sc-one-half column first"><?php
								if ( tribe_address_exists() ) :
									echo '<p class="event-address">'.tribe_get_full_address().'</p>';
									# Google map link...
									if ( tribe_show_google_map_link() ) :
										echo tribe_get_map_link_html();
										echo '<div class="dt-sc-hr-invisible-xsmall"></div>';
									endif;
								endif; ?>
				            </div>
				            <div class="dt-sc-one-half column">
				                <ul><?php
				                    $phone = tribe_get_phone();
				                    if(!empty($phone)): ?>
				                        <li><dt><?php esc_html_e('Phone:', 'kriya'); ?></dt><?php echo esc_html( $phone ); ?></li><?php
				                    endif;
				                    $website = tribe_get_venue_website_link();
				                    if(!empty($website)): ?>
				                        <li><dt><?php esc_html_e('Website:', 'kriya'); ?></dt><?php echo apply_filters( 'tribe_get_venue_website_link', $website ); ?></li><?php
				                    endif; ?>
				                </ul>
				            </div>
				        </div>
				    </div>
				</div><?php

				if ( comments_open() || get_comments_number() ) {
					comments_template();
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
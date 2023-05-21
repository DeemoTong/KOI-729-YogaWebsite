				</div>
			</div><!-- ** Main - End ** -->

			<?php $footer = kriya_option('layout','enable-footer');
				$copyright_section  = kriya_option('layout','enable-copyright');

			if( isset($footer) || isset( $copyright_section) ) :?>
				<!-- ** Footer ** -->
				<footer id="footer">
					<?php if( isset( $footer ) ):
						$darkbg = kriya_option('layout','footer-darkbg');
						$class = isset( $darkbg ) ? " dt-sc-dark-bg" : "";?>
						<div class="footer-widgets<?php echo esc_attr( $class ); ?>">
							<div class="container"><?php
								$columns = kriya_option ('layout','footer-columns');
								kriya_show_footer_widgetarea($columns); ?>
							</div>
						</div><?php
					endif;

					if( isset( $copyright_section) ):
						$darkbg = kriya_option('layout','copyright-darkbg');
						$class = isset( $darkbg ) ? " dt-sc-dark-bg" : "";?>
						<div class="footer-copyright<?php echo esc_attr( $class ); ?>">
							<div class="container"><?php
								$content = kriya_option('layout','copyright-content');
								$content = stripslashes ( $content );
								$content = do_shortcode( $content );						
								echo kriya_wp_kses( $content ); ?>
							</div>
						</div><?php
						endif;?>
				</footer><!-- ** Footer - End ** --><?php
			endif;?>

		</div><!-- ** Inner Wrapper - End ** -->
	</div><!-- ** Wrapper - End ** -->
	<?php wp_footer(); ?>
</body>
</html>
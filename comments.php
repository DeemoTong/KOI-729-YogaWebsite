<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.','kriya'); ?></p>
<?php  return;
	endif;?>
    
    <h3><?php comments_number(esc_html__('No Comments','kriya'), esc_html__('Comment ( 1 )','kriya'), esc_html__('Comments ( % )','kriya') ); ?></h3>
    <?php if ( have_comments() ) : ?>
    
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments','kriya'  ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments','kriya') ); ?></div>
                    </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'kriya_comment_style' ) ); ?>
        </ul>
    
    <?php else: ?>
		<?php if ( ! comments_open() ) : ?>
            <p class="nocomments"><?php esc_html_e( 'Comments are closed.','kriya'); ?></p>
        <?php endif;?>    
    <?php endif; ?>
	
    <!-- Comment Form -->
    <?php if ('open' == $post->comment_status) :
            
            $comment = "<div class='column dt-sc-one-column'><textarea id='comment' name='comment' cols='5' rows='3' placeholder='".esc_attr__("Comment",'kriya')."' ></textarea></div>";
	
            $fields = array(
                'author' => "<p class='column dt-sc-one-third comment-form-author first'><input id='author' name='author' type='text' placeholder='".esc_attr__("Name",'kriya')."' required /></p>",
                'email'  =>  "<p class='column dt-sc-one-third comment-form-email'> <input id='email' name='email' type='text' placeholder='".esc_attr__("Email",'kriya')."' required /> </p>",
                'url'  =>  "<p class='column dt-sc-one-third comment-form-url'> <input id='url' name='url' type='text' placeholder='".esc_attr__("Website",'kriya')."' required /> </p>",
            );
            
            $privacy_cmdfrm = kriya_option('privacy','enable-commentfrm-msg');
            if( isset( $privacy_cmdfrm ) ) {
            
                $content = do_shortcode( kriya_option('privacy', 'commentfrm-msg') );
            
                $fields['comment-form-dt-privatepolicy'] = '<p class="comment-form-dt-privatepolicy">
                    <input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
                    <label for="comment-form-dt-privatepolicy">'.$content.'</label> </p>';
            }
            
            $comments_args = array(
                'title_reply' 		=>	 esc_html__( 'Give a Reply','kriya' ),
                'fields'			=>	 $fields,
                'comment_field'		=>   $comment,
                'comment_notes_before'=> '',
                'comment_notes_after'=>	 '',
                'label_submit'		=>	 esc_html__('Comment','kriya'));

            comment_form($comments_args); 
?>
	<?php endif; ?>
<?php
/* Comments */
global $retro_options;
?>

<section id="comments">
<?php
	if ( post_password_required() ) {
		/** If a password must be entered to view comments */
	} elseif ( have_comments() ) {
?>
	<h2><?php comments_number(); ?></h2>
	
	<?php if ( get_comment_pages_count() > 1 ) { ?>
	<nav class="paginate-comments above"><?php paginate_comments_links(); ?></nav>
	<?php
		}
		
		$comment_args = array(
			'avatar_size' => $retro_options['avatar_size']
		);
		
		wp_list_comments( $comment_args ); 
		
		if ( get_comment_pages_count() > 1 ) {
	?>
	<nav class="paginated-comments below"><?php paginate_comments_links(); ?></nav>
	<?php
		}
	} elseif ( comments_open() ) {
		/** If comments are open but none have been posted */
	} else {
		/** If comments are closed */
		?>
		<p class="nocomments"><?php echo 'Comments are closed.'; ?></p>
		<?php
	}
	
	comment_form();
?>
</section><!-- #comments -->
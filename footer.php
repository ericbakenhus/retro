<?php
/**
* The template for displaying the footer.
*/
global $retro_options;
?>
	</div><!-- .main -->

	<footer class="site-footer sixteen columns row">
		<p>
			<a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> | 
			<?php if ( $retro_options['show_credits'] ) { ?>
			<span class="footer-credits">
				<?php echo 'Powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://interruptedreality.com/themes/retro/">Retro</a> | '; ?>
			</span>
			<?php } ?>
			<a href="<?php bloginfo( 'rss2_url' ); ?>">RSS</a>
		</p>
	</footer><!-- .site-footer -->
</div><!-- .wrap -->

<?php if ( current_user_can( 'edit_themes' ) ) { ?>
	<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds. -->
	<!-- Added by your friendly Retro theme. Only Admins can see this. :) -->
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
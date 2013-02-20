<?php
/**
* This file displays on single posts.
*/
?>

<?php get_header(); ?>
	
	<?php if ( class_exists( 'webcomic' ) && is_a_webcomic() ) { ?>
	<section class="webcomic-section sixteen columns row">
		<?php get_template_part( 'webcomic', 'single' ); ?>
	</section><!-- .webcomic-section -->
	<?php } ?>
	
	<section class="content twelve columns">
				
		<?php /* Loop */ ?>
		<?php while ( have_posts() ) { the_post(); ?>
		
		<?php if ( is_a_webcomic() ) { ?>

			<?php get_template_part( 'content', 'webcomic_post' ); ?>

		<?php } else { ?>

			<nav class="content-nav nav-single">
				<h3 class="assistive-text"><?php echo 'Post navigation'; ?></h3>
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav"><< %title</span>' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '<span class="meta-nav">%title >></span>' ); ?></span>
			</nav><!-- .nav-single -->
			
			<?php get_template_part( 'content', 'single' ); ?>
	
		<?php } ?>
			
		<?php comments_template( '', true ); ?>

		<?php } /* End Loop */ ?>
				
	</section> <!-- .content -->

<?php get_sidebar(); get_footer(); ?>
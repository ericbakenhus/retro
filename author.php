<?php
/**
* 
*/
global $webcomic;
?>

<?php get_header(); ?>
			
	<section class="content twelve columns">
		<?php if ( have_posts() ) { the_post(); ?>

			<header class="page-header">
				<h1 class="page-title author"><?php printf( 'Author Archives: %s', '<span class="vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header>

			<?php rewind_posts(); ?>

			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'retro_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- #author-avatar -->

			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) { ?>

				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
					<?php the_author_meta( 'description' ); ?>
				</div><!-- #author-description	-->

			<?php } ?>

			</div><!-- #entry-author-info -->

		<?php retro_content_nav( 'content-nav-above' ); ?>

		<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) { the_post(); ?>
	
				<?php 
				if ( is_a_webcomic() ) { 

					get_template_part( 'content', 'webcomic_post' );

				} else {

					get_template_part( 'content', get_post_format() );
	
				} 
				?>

			<?php } /* End the Loop */ ?>

		<?php retro_content_nav( 'content-nav-below' ); ?>
	
		<?php } else { ?>
	
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<hgroup>
						<h1 class="entry-title"><?php echo 'Nothing Found'; ?></h1>
					</hgroup>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php echo 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'; ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
	
		<?php } ?>
	</section> <!-- .content -->

<?php get_sidebar(); get_footer(); ?>
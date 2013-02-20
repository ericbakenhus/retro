<?php
/**
* Search.
*/
global $webcomic;
?>

<?php get_header(); ?>
			
	<section class="content twelve columns">

		<header class="page-header">
				<h1 class="page-title"><?php printf( 'Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>

		<?php if ( have_posts() ) { ?>

			<?php retro_content_nav( 'content-nav-above' ); ?>

			<?php while ( have_posts() ) { the_post(); ?>

				<?php if ( is_a_webcomic() ) { ?>
				
					<?php get_template_part( 'content', 'webcomic_post' ); ?>
					
				<?php } else { ?>
				
					<?php get_template_part( 'content', get_post_format() ); ?>
					
				<?php } ?>

			<?php } ?>

			<?php retro_content_nav( 'content-nav-below' ); ?>

		<?php } else { ?>
	
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php echo 'Nothing Found'; ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php echo 'Sorry, but nothing matched your search criteria. Please try again.'; ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php } ?>
	
	</section> <!-- .content -->

<?php get_sidebar(); get_footer(); ?>
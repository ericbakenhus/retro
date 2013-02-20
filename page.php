<?php
/**
* The template for displaying all pages.
*/

get_header(); ?>
		
	<section class="content twelve columns">

		<?php the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>
	
		<?php comments_template( '', true ); ?>

	</section><!-- .content -->

<?php get_sidebar(); get_footer(); ?>
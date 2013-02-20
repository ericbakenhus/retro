<?php
/**
* The template for displaying Archive pages.
*/

get_header(); ?>

	<section class="content twelve columns">

		<header class="page-header">
			<h1 class="page-title">
				<?php if ( is_day() ) { ?>
					<?php printf( 'Daily Archives: %s', '<span>' . get_the_date() . '</span>' ); ?>
				<?php } elseif ( is_month() ) { ?>
					<?php printf( 'Monthly Archives: %s', '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
				<?php } elseif ( is_year() ) { ?>
					<?php printf( 'Yearly Archives: %s', '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
				<?php } elseif ( is_category() ) { ?>
					<?php printf( 'Posts filed under: %s', single_cat_title( '', false ) ); ?>
				<?php } elseif ( is_tag() ) { ?>
					<?php printf( 'Posts tagged with: %s', single_tag_title( '', false ) ); ?>
				<?php } elseif ( is_tax( 'webcomic_collection' ) ) { ?>
					<?php printf( 'Webcomics from: %s', '<span>' . $webcomic->get_webcomic_term_info( 'name', 'webcomic_collection' ) . '</span>' ); ?>
				<?php } elseif ( is_tax( 'webcomic_storyline' ) ) { ?>
					<?php printf( 'Webcomics in: %s', '<span>' . $webcomic->get_webcomic_term_info( 'name', 'webcomic_storyline' ) . '</span>' ); ?>
				<?php } elseif ( is_tax( 'webcomic_character' ) ) { ?>
					<?php webcomic_character_info( 'name' ); ?>
				<?php } elseif ( class_exists( 'webcomic' ) && is_a_webcomic() ) { ?>
					<?php echo 'Webcomic Archives' ?>
				<?php } else { ?>
					<?php echo 'Archives' ?>
				<?php } ?>
			</h1>
		</header>
		
		<?php if ( is_tax( 'webcomic_character' ) && ! is_paged() ) { ?>
			<div class="character-avatar"><?php webcomic_character_info( 'thumb-full' ); ?></div>
			<div class="content"><?php webcomic_character_info( 'description' ); ?></div>
			<nav class="prevnext"><?php previous_webcomic_character_link( '%link', '&laquo; %name' ); next_webcomic_character_link( '%link', '%name &raquo;' ); ?></nav>
			<h2><?php printf( 'Appearances by: %s', '<span>' . $webcomic->get_webcomic_term_info( 'name', 'webcomic_character' ) . '</span>' ); ?></h2>
			<hr />
		<?php } ?>

		<?php retro_content_nav( 'content-nav-above' ); ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) { the_post(); ?>
		
			<?php if ( is_a_webcomic() ) { ?>
			
				<?php get_template_part( 'content', 'webcomic_post' ); ?>
			
			<?php } else { ?>
			
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php } ?>

		<?php } /* End the Loop */ ?>

		<?php retro_content_nav( 'content-nav-below' ); ?>

	</section><!-- .content -->
	
<?php get_sidebar(); get_footer(); ?>
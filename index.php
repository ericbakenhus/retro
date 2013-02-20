<?php
/**
* This file displays on the home page.
*/
global $webcomic;
?>

<?php get_header(); ?>

	<?php /* Webcomic Loop */ ?>
	<?php if ( class_exists( 'webcomic' ) && is_home() && ! is_paged() ) { ?>
	
		<?php
		$webcomic_query_args = array(
			'post_type' => 'webcomic_post',
			'posts_per_page' => 1,
			'order' => 'DESC'
		);

		$q = new WP_Query( $webcomic_query_args ); 
		?>
		
		<?php if ( $q->have_posts() ) { ?>
		
			<section class="webcomic-section sixteen columns row">
				<?php
				while ( $q->have_posts() ) { $q->the_post(); 
					get_template_part( 'webcomic', 'home' ); 
				}
				?>
			</section><!-- .webcomic-section -->
			
		<?php } ?>
		
	<?php } ?>
	<?php /* End Webcomic Loop */ ?>
			
	<section class="content twelve columns">
			
	<?php /* Webcomic Post Loop */ ?>
	<?php if ( class_exists( 'webcomic' ) && is_home() && ! is_paged() && $q->have_posts() ) { ?>
	
		<?php while ( $q->have_posts() ) { $q->the_post(); ?> 
			
			<?php get_template_part( 'content', 'webcomic_post' ); ?>
				
		<?php } ?>
		
	<?php } ?>
	<?php /* End Webcomic Post Loop */ ?>
	
	<?php if ( have_posts() ) { ?>
	
		<?php retro_content_nav( 'content-nav-above' ); ?>
		
		<?php /* Blog Loop */ ?>
		<?php while ( have_posts() ) { the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php } ?>
		<?php /* End Blog Loop */ ?>
		
		<?php retro_content_nav( 'content-nav-below' ); ?>
		
	<?php } else { ?>
	
		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<hgroup>
					<h1 class="entry-title"><?php echo 'This is somewhat embarrassing, isn&rsquo;t it?'; ?></h1>
				</hgroup>
			</header>

			<div class="entry-content">
				<p><?php echo 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.'; ?></p>

				<?php get_search_form(); ?>

			</div><!-- .entry-content -->
		</article><!-- #post-0 -->
	
	<?php } ?>
				
	</section> <!-- .content -->

<?php get_sidebar(); get_footer(); ?>
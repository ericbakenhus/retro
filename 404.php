<?php
/**
* The template for displaying 404 pages (Not Found).
*/

get_header(); ?>

	<section class="content twelve columns">
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
	</section><!-- .content -->

<?php get_sidebar(); get_footer(); ?>
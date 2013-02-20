<?php
/**
* The default template for displaying content
*/
global $webcomic, $retro_options;
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<hgroup>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</hgroup>
		</header><!-- .entry-header -->
		<footer class="entry-meta entry-meta-above">Posted by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> on <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_date(); ?> @ <?php the_time(); ?></a> | <?php comments_popup_link(); if ( $webcomic->webcomic_prints_open() ) { purchase_webcomic_link( ' | %link' ); } edit_post_link( 'Edit', '<span class="edit-link"> | ', '</span>' ); ?></footer>
		
		<?php if ( is_search() || is_archive() ) { ?>
			<?php the_webcomic_object( 'small', 'self' ); ?>
		<?php } ?>

		<?php if ( ( is_search() && $retro_options['show_excerpt_search'] ) || ( is_archive() && $retro_options['show_excerpt_archive'] ) ) { // Only display Excerpts for Search and Archive ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php } else { ?>
		<div class="entry-content clearfix">
			<?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php } /* is_search() */ ?>

		<footer class="entry-meta entry-meta-below">
			<?php $show_sep = false; ?>
			
			<?php if ( ! is_search() ) { // Hide category and tag text for pages on Search ?>
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( ', ' );
				
				if ( $categories_list ) {
				?>
					<span class="cat-links">
						<?php printf( '<span class="%1$s">Posted in</span> %2$s', 'entry-meta-prep entry-meta-prep-cat-links', $categories_list );
						$show_sep = true; ?>
					</span>
				<?php } /* End if categories */ ?>
				
				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', ', ' );
				
				if ( $tags_list ) {
					if ( $show_sep ) { ?>
						<span class="sep"> | </span>
					<?php } // End if $show_sep ?>
					<span class="tag-links">
					<?php printf( '<span class="%1$s">Tagged</span> %2$s', 'entry-meta-prep entry-meta-prep-tag-links', $tags_list );
					$show_sep = true; ?>
				</span>
				<?php } /* End if $tags_list */ ?>
			
				<?php
				if ( $show_sep ) {
					the_webcomic_post_collections( array( 'before' => ' | From ', 'separator' => ', ' ) );
				} else {
					the_webcomic_post_collections( array( 'before' => 'From ', 'separator' => ', ' ) );
				}
				the_webcomic_post_storylines( array( 'before' => ' | Part of ', 'separator' => ', ' ) );
				the_webcomic_post_characters( array( 'before' => ' | Featuring ', 'separator' => ', ' ) );
				?>
			<?php } /* End if ! is_search() */ ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
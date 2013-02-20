<?php /** Displays the full-size webcomic on the home and single-post pages. */ ?>

<div class="<?php retro_webcomic_classes() ?>">
	<nav class="above"><?php first_webcomic_link(); previous_webcomic_link(); random_webcomic_link(); next_webcomic_link(); last_webcomic_link(); ?></nav>
	<?php the_webcomic_object( 'full', retro_comic_link() ); ?>
	<nav class="below"><?php first_webcomic_link(); previous_webcomic_link(); random_webcomic_link(); next_webcomic_link(); last_webcomic_link(); ?></nav>
</div>
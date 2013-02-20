<?php
/* SECTION - Comic */
add_settings_section( 'retro_comic', 'Comic', 'retro_comic_text', 'retro' );

function retro_comic_text() {
	?>
	<p><?php _e( 'Options related to the comic itself.', 'retro' ); ?></p>
	<?php
}

/* Comic Link */
add_settings_field( 'retro_comic_comic_link', 'Comic Link', 'retro_comic_comic_link', 'retro', 'retro_comic' );

function retro_comic_comic_link() {
	$options = get_option( 'retro_options' );
	?>
	<label for="retro_options[webcomic_comic_link]">Comic images should link to </label>
	<select id="webcomic_comic_link" name="retro_options[webcomic_comic_link]">
		<option value="1" <?php selected( $options['webcomic_comic_link'], 1 ) ?>>nothing</option>
		<option value="2" <?php selected( $options['webcomic_comic_link'], 2 ) ?>>the previous comic</option>
		<option value="3" <?php selected( $options['webcomic_comic_link'], 3 ) ?>>the next comic</option>
		<option value="4" <?php selected( $options['webcomic_comic_link'], 4 ) ?>>a random comic</option>
		<option value="5" <?php selected( $options['webcomic_comic_link'], 5 ) ?>>itself</option>
	</select>
	<span class="description"></span>
	<?php
}

/* Dynamic Images */
add_settings_field( 'retro_comic_dynamic_images', 'Dynamic Images', 'retro_comic_dynamic_images', 'retro', 'retro_comic' );

function retro_comic_dynamic_images() {
	$options = get_option( 'retro_options' );
	?>
	<input type="checkbox" name="retro_options[webcomic_dynamic_images]" value="1" <?php checked( $options['webcomic_dynamic_images'], 1 ); ?> />
	<span class="description">Allow the comic image to resize with the layout as screen size shrinks.</span>
	<?php
}
?>
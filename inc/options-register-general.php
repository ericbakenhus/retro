<?php
/* SECTION - Layout */
add_settings_section( 'retro_layout', 'Layout', 'retro_layout_text', 'retro' );

function retro_layout_text() {
	?>
	<p><?php _e( 'Change the basic structure and look of your site.', 'retro' ); ?></p>
	<?php
}

/* Style */
add_settings_field( 'retro_layout_style', 'Style', 'retro_layout_style', 'retro', 'retro_layout' );

function retro_layout_style() {
	$options = get_option( 'retro_options' );
	?>
	<select id="layout" name="retro_options[layout]">
		<option value="1" <?php selected( $options['layout'], 1 ) ?>>Green</option>
		<option value="2" <?php selected( $options['layout'], 2 ) ?>>White</option>
	</select>
	<span class="description">The general look of your site.</span>
	<?php
}

/* Header Height */
add_settings_field( 'retro_layout_header_height', 'Header Height', 'retro_layout_header_height', 'retro', 'retro_layout' );

function retro_layout_header_height() {
	$options = get_option( 'retro_options' );
	?>
	<input type="text" name="retro_options[header_height]" maxlength="4" size="4" value="<?php echo esc_attr( $options['header_height'] ); ?>" />
	<span class="description"></span>
	<?php
}

/* Header Width */
add_settings_field( 'retro_layout_header_width', 'Header Width', 'retro_layout_header_width', 'retro', 'retro_layout' );

function retro_layout_header_width() {
	$options = get_option( 'retro_options' );
	?>
	<input type="text" name="retro_options[header_width]" maxlength="4" size="4" value="<?php echo esc_attr( $options['header_width'] ); ?>" />
	<span class="description"></span>
	<?php
}


/* SECTION - Comments. */
add_settings_section( 'retro_comments', 'Comments', 'retro_comments_text', 'retro' );

function retro_comments_text() {
	?>
	<p><?php _e( 'Comment and comment form options.', 'retro' ); ?></p>
	<?php
}

/* Avatar size */
add_settings_field( 'retro_comments_avatar_size', 'Avatar Size for Comments', 'retro_comments_avatar_size', 'retro', 'retro_comments' );

function retro_comments_avatar_size() {
	$options = get_option( 'retro_options' );
	?>
	<input type="text" name="retro_options[avatar_size]" maxlength="3" size="3" value="<?php echo esc_attr( $options['avatar_size'] ); ?>" />
	<span class="description">Must be [1-512]</span>
	<?php
}


/* SECTION - Misc. */
add_settings_section( 'retro_misc', 'Misc.', 'retro_misc_text', 'retro' );

function retro_misc_text() {
	?>
	<p><?php _e( 'Miscellaneous options.', 'retro' ); ?></p>
	<?php
}

/* RSD link */
add_settings_field( 'retro_misc_rsd', 'Enable RSD Link', 'retro_misc_rsd', 'retro', 'retro_misc' );

function retro_misc_rsd() {
	$options = get_option( 'retro_options' );
	?>
	<input type="checkbox" name="retro_options[rsd_link]" value="1" <?php checked( $options['rsd_link'], 1 ); ?> />
	<span class="description">If you are unsure, leave enabled.</span>
	<?php
}

/* wlmanisfest link */
add_settings_field( 'retro_misc_wlwm', 'Enable wlwmanifest.xml link', 'retro_misc_wlwm', 'retro', 'retro_misc' );

function retro_misc_wlwm() {
	$options = get_option( 'retro_options' );
	?>
	<input type="checkbox" name="retro_options[wlwm_link]" value="1" <?php checked( $options['wlwm_link'], 1 ); ?> />
	<span class="description">If you do not use Windows Live Writer, you can safely disable this.</span>
	<?php
}

/* WP Generator */
add_settings_field( 'retro_misc_wp_gen', 'Show WP Generator', 'retro_misc_wp_gen', 'retro', 'retro_misc' );

function retro_misc_wp_gen() {
	$options = get_option( 'retro_options' );
	?>
	<input type="checkbox" name="retro_options[wp_gen]" value="1" <?php checked( $options['wp_gen'], 1 ); ?> />
	<span class="description">Leaving this disabled is recommended.</span>
	<?php
}

/* Credits */
add_settings_field( 'retro_misc_credit', 'Theme Credits', 'retro_misc_credit', 'retro', 'retro_misc' );

function retro_misc_credit() {
	$options = get_option( 'retro_options' );
	?>
	<input type="checkbox" name="retro_options[show_credits]" value="1" <?php checked( $options['show_credits'], 1 ); ?> />
	<span class="description">Show the theme credits. While I appreciate it if you leave this on, feel free to disable it or even alter it in footer.php. It's your site after all. :)</span>
	<?php
}
?>
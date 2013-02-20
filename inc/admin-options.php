<?php
/* Admin stuffs */
add_action( 'admin_menu', 'retro_admin_menu' );

function retro_admin_menu() {
	$theme_page = add_theme_page( 'Retro Theme Options', 'Retro Theme Options', 'edit_theme_options', 'retro-settings', 'retro_options_page' );
	
	add_action( 'load-' . $theme_page, 'retro_load_theme_page' );
}

function retro_options_page() {
	?>
	<div class="wrap">
		<?php retro_options_page_tabs(); ?>
		<?php if ( isset( $_GET['settings-updated'] ) ) {
			echo '<div class="updated"><p>Theme settings updated successfully.</p></div>';
		} ?>
		<form action="options.php" method="post">
			<?php settings_fields( 'retro_options' ); ?>
			<?php do_settings_sections( 'retro' ); ?>
			<?php $tabs = retro_get_settings_page_tabs(); ?>
			<?php $tab = ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $tabs ) ) ? $_GET['tab'] : 'general'; ?>
			<p class="submit">
				<input name="retro_options[submit-<?php echo $tab; ?>]" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'retro' ); ?>" />
				<input name="retro_options[reset-<?php echo $tab; ?>]" type="submit" class="button-secondary" value="<?php esc_attr_e( 'Reset Defaults', 'retro' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

function retro_options_page_tabs( $current = 'general' ) {
	$tabs = retro_get_settings_page_tabs();
	$current = ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $tabs ) ) ? $_GET['tab'] : 'general';
	$links = array();
	
	foreach( $tabs as $tab => $name ) {
		if ( $tab == $current ) {
			$links[] = "<a class='nav-tab nav-tab-active' href='?page=retro-settings&tab=$tab'>$name</a>";
		} else {
			$links[] = "<a class='nav-tab' href='?page=retro-settings&tab=$tab'>$name</a>";
		}
	}
	
	screen_icon();
	echo '<h2 class="nav-tab-wrapper">';
	foreach ( $links as $link ) {
		echo $link;
	}
	echo '</h2>';
}


add_action( 'admin_init', 'retro_admin_init' );

function retro_admin_init() {
	/* Register the one lonely array of options */
	register_setting( 'retro_options', 'retro_options', 'retro_options_validate' );
}

function retro_options_validate( $input ) {
	$valid_input = get_option( 'retro_options' );
	
	$submit_general = ( ! empty( $input['submit-general'] ) ) ? true : false;
	$reset_general = ( ! empty( $input['reset-general'] ) ) ? true : false;
	$submit_webcomic = ( ! empty( $input['submit-webcomic'] ) ) ? true : false;
	$reset_webcomic = ( ! empty( $input['reset-webcomic'] ) ) ? true : false;
	$defaults = retro_get_defaults();
	
	if ( $submit_general ) {
		$valid_input['layout'] = ( 2 == intval( $input['layout'] ) ) ? 2 : 1;
		$valid_input['header_height'] = ( ( is_numeric( $input['header_height'] ) ) && ( intval( $input['header_height'] ) >= 1 ) && (  strlen( $input['header_height'] ) <= 4 ) ) ? intval( $input['header_height'] ) : $defaults['header_height'];
		$valid_input['header_width'] = ( ( is_numeric( $input['header_width'] ) ) && ( intval( $input['header_width'] ) >= 1 ) && (  strlen( $input['header_width'] ) <= 4 ) ) ? intval( $input['header_width'] ) : $defaults['header_width'];
		$valid_input['avatar_size'] = ( ( is_numeric( $input['avatar_size'] ) ) && ( intval( $input['avatar_size'] ) >= 1 ) && ( intval( $input['avatar_size'] ) <= 512 ) ) ? intval( $input['avatar_size'] ) : $defaults['avatar_size'];
		$valid_input['rsd_link'] = ( ! empty( $input['rsd_link'] ) ) ? 1 : 0;
		$valid_input['wlwm_link'] = ( ! empty( $input['wlwm_link'] ) ) ? 1 : 0;
		$valid_input['wp_gen'] = ( ! empty( $input['wp_gen'] ) ) ? 1 : 0;
		$valid_input['show_credits'] = ( ! empty( $input['show_credits'] ) ) ? 1 : 0;
	} elseif ( $reset_general ) {
		$valid_input['layout'] = $defaults['layout'];
		$valid_input['header_height'] = $defaults['header_height'];
		$valid_input['header_width'] = $defaults['header_width'];
		$valid_input['avatar_size'] = $defaults['avatar_size'];
		$valid_input['rsd_link'] = $defaults['rsd_link'];
		$valid_input['wlwm_link'] = $defaults['wlwm_link'];
		$valid_input['wp_gen'] = $defaults['wp_gen'];
		$valid_input['show_credits'] = $defaults['show_credits'];
	} elseif ( $submit_webcomic ) {
		$valid_input['webcomic_dynamic_images'] = ( ! empty( $input['webcomic_dynamic_images'] ) ) ? 1 : 0;
		$valid_input['webcomic_comic_link'] = ( $input['webcomic_comic_link'] == 1 || $input['webcomic_comic_link'] == 2 || $input['webcomic_comic_link'] == 3 || $input['webcomic_comic_link'] == 4 || $input['webcomic_comic_link'] == 5 ) ? intval( $input['webcomic_comic_link'] ) : 1;
	} elseif ( $reset_webcomic ) {
		$valid_input['webcomic_dynamic_images'] = $defaults['webcomic_dynamic_images'];
		$valid_input['webcomic_comic_link'] = $defaults['webcomic_comic_link'];
	}
	
	return $valid_input;
}

function retro_load_theme_page() {
	/* Include the correct file to show the proper options for the current tab */
	$tabs = retro_get_settings_page_tabs();
	$tab = ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $tabs ) ) ? $_GET['tab'] : 'general';
	require( dirname( __FILE__ ) . '/options-register-' . $tab . '.php' );
		
	/* Add contextual help */
	$screen = get_current_screen();
	
	$general_content = 'This is general help.';
	$webcoimc_content = 'This is webcomic help.';
	
	$screen->add_help_tab( array(
		'id' => 'retro-help-general',
		'title' => __( 'General', 'retro' ),
		'content' => $general_content
	));
	
	$screen->add_help_tab( array(
		'id' => 'retro-help-webcomic',
		'title' => __( 'Webcomic', 'retro' ),
		'content' => $webcoimc_content
	));
}
?>
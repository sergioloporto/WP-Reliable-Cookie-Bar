<?php
add_action('admin_menu', 'wprcb_menu');
add_action('admin_init', 'wprcb_api_settings_init');

function wprcb_menu()
{
	add_options_page('My Plugin Options', 'WP Reliable Cookie Bar', 'manage_options', 'wprcb-settings', 'wprcb_options');
}


function wprcb_api_settings_init()
{
	register_setting('wprcbPlugin', 'wprcb_api_settings');
	add_settings_section(
		'wprcb_api_wprcbPlugin_section',
		__('General settings', 'wprbc'),
		'wprcb_api_settings_section_callback',
		'wprcbPlugin'
	);

	add_settings_field(
		'wprcb_api_text_field_cookieMessage',
		__('Cookie Bar Text', 'wprbc'),
		'wprcb_api_text_field_cookieMessage_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);

	add_settings_field(
		'wprcb_api_color_field_backgroundColor',
		__('Background color', 'wprbc'),
		'wprcb_api_color_field_backgroundColor_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);
}


function wprcb_api_text_field_cookieMessage_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<input type='text' name='wprcb_api_settings[wprcb_api_text_field_cookieMessage]' value='<?php echo $options['wprcb_api_text_field_cookieMessage']; ?>' placeholder="This site uses internal and external cookies provide and improve our services. By using our site, you grant consent to cookies." >
<?php
}

function wprcb_api_color_field_backgroundColor_render(  ) {
    $options = get_option( 'wprcb_api_settings' );
	?>
	<input type="color" id="favcolor" name="wprcb_api_settings[wprcb_api_color_field_backgroundColor]" value="#000" > 
<?php
}

function wprcb_api_settings_section_callback()
{
	echo __('In this page you can change text and the visual aspect of the WP Reliable Cookie Bar', 'wprcb');
}


/** Step 3. */
function wprcb_options()
{
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
?>
	<form action='options.php' method='post'>
		<h2>Sitepoint Settings API Admin Page</h2>

		<?php
		settings_fields('wprcbPlugin');
		do_settings_sections('wprcbPlugin');
		submit_button();
		?>

	</form>
<?php
}

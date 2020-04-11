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

	add_settings_field(
		'wprcb_api_color_field_textColor',
		__('Text color', 'wprbc'),
		'wprcb_api_color_field_textColor_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);

	add_settings_field(
		'wprcb_api_boolean_showHide_border',
		__('Show/hide border', 'wprbc'),
		'wprcb_api_boolean_showHide_border_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);

	add_settings_field(
		'wprcb_api_number_field_barHeight',
		__('Cookie bar height', 'wprbc'),
		'wprcb_api_number_field_barHeight_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section',
		array('Choose a value in pixels')
	);

	add_settings_field(
		'wprcb_api_text_field_cookiesURL',
		__('Cookies policy URL', 'wprbc'),
		'wprcb_api_text_field_cookiesURL_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);

	add_settings_field(
		'wprcb_api_text_field_cookiesAnchor',
		__('Cookies policy anchor', 'wprbc'),
		'wprcb_api_text_field_cookiesAnchor_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section'
	);

	// Button section
	// register_setting('wprcbPlugin_Button', 'wprcb_api_settings_Button');
	add_settings_section(
		'wprcb_api_wprcbPlugin_section_button',
		__('Button properties', 'wprbc'),
		'wprcb_api_button_settings_section_callback',
		'wprcbPlugin'
	);

	add_settings_field(
		'wprcb_api_color_field_button_backgroundColor',
		__('Button background color', 'wprbc'),
		'wprcb_api_color_field_button_backgroundColor_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_button'
	);
	add_settings_field(
		'wprcb_api_color_field_button_textColor',
		__('Button text color', 'wprbc'),
		'wprcb_api_color_field_button_textColor_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_button'
	);

	// New section
	add_settings_section(
		'wprcb_api_wprcbPlugin_section_others',
		__('Need more info?', 'wprbc'),
		'wprcb_api_other_settings_section_callback',
		'wprcbPlugin'
	);
	add_settings_field(
		'wprcb_api_button_support',
		__('Need help?', 'wprbc'),
		'wprcb_api_button_support_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_others',
		array('Ask on the wordpress.org support forum"')
	);
	add_settings_field(
		'wprcb_api_button_feature_request',
		__('Feature request', 'wprbc'),
		'wprcb_api_button_feature_request_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_others',
		array('Create a new "issue" and choose the label "new feature or request"')
	);
	add_settings_field(
		'wprcb_api_button_new_bug',
		__('File a new bug', 'wprbc'),
		'wprcb_api_button_new_bug_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_others',
		array('Create a new "issue" and choose the label "bug"')
	);
	add_settings_field(
		'wprcb_api_button_contribute',
		__('Contribute to this project', 'wprbc'),
		'wprcb_api_button_contribute_render',
		'wprcbPlugin',
		'wprcb_api_wprcbPlugin_section_others',
		array('Are you a developer? Contribute to this project!')
	);
}

function wprcb_api_settings_section_callback()
{
	echo __('In this page you can change text and the visual aspect of the WP Reliable Cookie Bar', 'wprcb');
}

function wprcb_api_text_field_cookieMessage_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<input type='text' name='wprcb_api_settings[wprcb_api_text_field_cookieMessage]' value='<?php echo sanitize_text_field($options['wprcb_api_text_field_cookieMessage']) ;?>' placeholder="This site uses internal and external cookies provide and improve our services. By using our site, you grant consent to cookies.">
<?php
}

function wprcb_api_color_field_backgroundColor_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<input type="color" id="favcolor_cookiebar_background_color" name="wprcb_api_settings[wprcb_api_color_field_backgroundColor]" value="<?php echo sanitize_text_field($options['wprcb_api_color_field_backgroundColor']); ?>">
<?php
}

function wprcb_api_color_field_textColor_render()
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<input type="color" id="favcolor_cookiemessage_text_color" name="wprcb_api_settings[wprcb_api_color_field_textColor]" value="<?php echo sanitize_text_field($button_options['wprcb_api_color_field_textColor']); ?>">
<?php
}


function wprcb_api_number_field_barHeight_render($args)
{
	$options = get_option('wprcb_api_settings');
?>
	<input type='number' name='wprcb_api_settings[wprcb_api_number_field_barHeight]' value='<?php echo sanitize_text_field($options['wprcb_api_number_field_barHeight']); ?>'>
	<p class="description wprcb-height"> <?php echo $args[0] ?> </p>
<?php
}

function wprcb_api_boolean_showHide_border_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<select id="show-hide-border" name="wprcb_api_settings[wprcb_api_boolean_showHide_border]">	
		<option value="1" <?php selected( sanitize_text_field($options['wprcb_api_boolean_showHide_border']), 1 ); ?>>Show</option>
		<option value="0" <?php selected( $options['wprcb_api_boolean_showHide_border'], 0 ); ?>>Hide</option>
	</select>
<?php
}

function wprcb_api_text_field_cookiesURL_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<input type='text' name='wprcb_api_settings[wprcb_api_text_field_cookiesURL]' value='<?php echo sanitize_text_field($options['wprcb_api_text_field_cookiesURL']) ;?>' placeholder="https://linktopolicy">
<?php
}

function wprcb_api_text_field_cookiesAnchor_render()
{
	$options = get_option('wprcb_api_settings');
?>
	<input type='text' name='wprcb_api_settings[wprcb_api_text_field_cookiesAnchor]' value='<?php echo sanitize_text_field($options['wprcb_api_text_field_cookiesAnchor']) ;?>' placeholder="Learn more">
<?php
}

function wprcb_api_button_settings_section_callback()
{
	echo __('Button options', 'wprcb');
}


function wprcb_api_color_field_button_backgroundColor_render()
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<input type="color" id="favcolor_button_backgroundcolor" name="wprcb_api_settings[wprcb_api_color_field_button_backgroundColor]" value="<?php echo sanitize_text_field($button_options['wprcb_api_color_field_button_backgroundColor']); ?>">
<?php
}

function wprcb_api_color_field_button_textColor_render()
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<input type="color" id="favcolor_button_textcolor" name="wprcb_api_settings[wprcb_api_color_field_button_textColor]" value="<?php echo sanitize_text_field($button_options['wprcb_api_color_field_button_textColor']); ?>">
<?php
}


function wprcb_api_other_settings_section_callback()
{
	echo __('Other features', 'wprcb');
}

function wprcb_api_button_support_render($args)
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<button id="support" class="button" name="wprcb_api_settings[wprcb_api_button_support]" onclick="window.open('https://wordpress.org/support/forums/')">Ask for help in the official Wordpress.org forum</button>
	<p class="description wprcb-height"> <?php echo $args[0] ?> </p>
<?php
}

function wprcb_api_button_feature_request_render($args)
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<button id="feature_request_button" class="button" name="wprcb_api_settings[wprcb_api_button_feature_request]" onclick="window.open('https://github.com/sergioloporto/WP-Reliable-Cookie-Bar/issues')">Request a new feature on GitHub</button>
	<p class="description wprcb-height"> <?php echo $args[0] ?> </p>
<?php
}

function wprcb_api_button_new_bug_render($args)
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<button id="bug_button" class="button" name="wprcb_api_settings[wprcb_api_button_new_bug]" onclick="window.open('https://github.com/sergioloporto/WP-Reliable-Cookie-Bar/issues')">Issue a new bug request</button>
	<p class="description wprcb-height"> <?php echo $args[0] ?> </p>
<?php
}

function wprcb_api_button_contribute_render($args)
{
	$button_options = get_option( 'wprcb_api_settings' );
?>
	<button id="contribute_button" class="button" name="wprcb_api_settings[wprcb_api_button_contribute]" onclick="window.open('https://github.com/sergioloporto/WP-Reliable-Cookie-Bar/')">Contribute to open source</button>
	<p class="description wprcb-height"> <?php echo $args[0] ?> </p>
<?php
}




/** Step 3. */
function wprcb_options()
{
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
?>
	<form action='options.php' method='post'>
		<h2>WP Reliable Cookie Bar</h2>

		<?php
		settings_fields('wprcbPlugin');
		do_settings_sections('wprcbPlugin');

		submit_button();
		?>

	</form>
<?php
}
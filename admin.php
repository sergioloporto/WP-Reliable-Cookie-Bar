<?php
add_action( 'admin_menu', 'wprcb_menu' );

function wprcb_menu() {
	add_options_page( 'My Plugin Options', 'WP Reliable Cookie Bar', 'manage_options', 'wprcb-settings', 'wprcb_options' );
}

/** Step 3. */
function wprcb_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>
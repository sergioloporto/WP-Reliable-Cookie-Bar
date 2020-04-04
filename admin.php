<?php
add_action( 'admin_menu', 'wrcb_menu' );

function wrcb_menu() {
	add_options_page( 'My Plugin Options', 'WP Reliable Cookie Bar', 'manage_options', 'my-unique-identifier', 'wrcb_options' );
}

/** Step 3. */
function wrcb_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>
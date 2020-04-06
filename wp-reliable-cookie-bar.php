<?php
/**
 * Plugin Name: WP Realiable Cookie Bar
 * Plugin URI: https://github.com/sergioloporto/WP-Reliable-Cookie-Bar/
 * Description: A customizable cookie bar
 * Version: 0.2
 * Author: Sergio Lo Porto
 * Author URI: https://github.com/sergioloporto
 */


defined('ABSPATH') or die('No script kiddies please!');
include(plugin_dir_path(__FILE__) . 'admin.php');

$GLOBALS['wprcb_policy'] = 'https://www.google.com';


function wprcb_add_footer_styles()
{
    wp_enqueue_style('your-style-id', plugins_url('css/main.css', __FILE__));
};
add_action('get_footer', 'wprcb_add_footer_styles');

function wprcb_inject_html_into_footer()
{
    $options = get_option( 'wprcb_api_settings' );
    $text_to_display = $options['wprcb_api_text_field_cookieMessage'] ? $options['wprcb_api_text_field_cookieMessage'] : 'This site uses internal and external cookies provide and improve our services. By using our site, you grant consent to cookies.';

    $background_color = $options['wprcb_api_select_field_backgroundColor'] ? $options['wprcb_api_select_field_backgroundColor'] : '#000';

    //echo '<p><script async="" defer="" src="//widget.getyourguide.com/v2/widget.js"></script></p>';
    echo <<<COOKIEBARHTML
  <div id="wprcb-cookie-bar" class="wprcb-cookie-bar" style="display: flex; background:{$background_color}">
  <div>
    <div class="wprcb-content">
      <p class="wprcb-text">{$text_to_display}</p>
      <a class="accept-button" id="accept-button" href="#">Accept</a>
      <a class="learn-more" href="{$GLOBALS['wprcb_policy']}" target="_blank" rel="nofollow">Learn more</a>
      </div>
  </div>
</div>


<script>
const wprcb = document.getElementById("wprcb-cookie-bar");
const wprcbAcceptButton = document.getElementById("accept-button");

if (!localStorage.wpReliableCookieBarIsClosed) {
    wprcb.style.display="inherit";
  } else {
    wprcb.style.display="none";
  }

  wprcbAcceptButton.addEventListener("click", () => {
    wprcb.style.display="none";
    localStorage.wpReliableCookieBarIsClosed = 'true';
  })
</script>
COOKIEBARHTML;
}
add_action('wp_footer', 'wprcb_inject_html_into_footer');

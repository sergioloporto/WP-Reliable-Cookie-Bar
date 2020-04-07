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
  $options = get_option('wprcb_api_settings');

  $text_to_display = $options['wprcb_api_text_field_cookieMessage'] ? $options['wprcb_api_text_field_cookieMessage'] : 'This site uses internal and external cookies provide and improve our services. By using our site, you grant consent to cookies.';
  $background_color = $options['wprcb_api_color_field_backgroundColor'] ? $options['wprcb_api_color_field_backgroundColor'] : '#000';
  $text_color = $options['wprcb_api_color_field_textColor'] ? $options['wprcb_api_color_field_textColor'] : '#fff';
  $bar_height = $options['wprcb_api_number_field_barHeight'] ? $options['wprcb_api_number_field_barHeight'] : '80';
  $show_hide_border = $options['wprcb_api_boolean_showHide_border'] == 1 ? 'boder:none;' : 'border:inherit;';

  //Button
  $button_options = get_option('wprcb_api_settings');
  $button_background_color = $button_options['wprcb_api_color_field_button_backgroundColor'] ? $button_options['wprcb_api_color_field_button_backgroundColor'] : '#fff';
  $button_text_color = $button_options['wprcb_api_color_field_button_textColor'] ? $button_options['wprcb_api_color_field_button_textColor'] : '#fff';


  //echo '<p><script async="" defer="" src="//widget.getyourguide.com/v2/widget.js"></script></p>';
  echo <<<COOKIEBARHTML
  <div id="wprcb-cookie-bar" class="wprcb-cookie-bar" style="display: flex; background:{$background_color}; height:{$bar_height}px; {$show_hide_border}">
  <div>
    <div class="wprcb-content">
      <p class="wprcb-text" style="color:{$text_color};">{$text_to_display}</p>
      <a class="accept-button" id="accept-button" href="#" style="background-color:{$button_background_color};color:{$button_text_color}">Accept</a>
      <a class="learn-more" href="#" target="_blank" rel="nofollow">Learn more</a>
      </div>
  </div>
</div>


<script>
const wprcb = document.getElementById("wprcb-cookie-bar");
const wprcbAcceptButton = document.getElementById("accept-button");

if (!localStorage.wpReliableCookieBarIsClosed) {
    wprcb.style.display="inherit";
  } else {
    wprcb.style.bottom="-500px";
    // if (wprcb.style.height === '0px') {
    //   wprcb.style.display="none";
    // }
  }

  wprcbAcceptButton.addEventListener("click", () => {
    wprcb.style.bottom="-500px";
    // if (wprcb.style.height === '0px') {
    //   wprcb.style.display="none";
    // }    
    localStorage.wpReliableCookieBarIsClosed = 'true';
  })

</script>
COOKIEBARHTML;
}
add_action('wp_footer', 'wprcb_inject_html_into_footer');

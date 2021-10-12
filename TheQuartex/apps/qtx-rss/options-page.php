<?php
if(!defined('LoadOptions')) {
    die('Options not loaded');
}
//admin registering/core functionality
/*
********* ADMIN_INIT settings registering
*/
/*
* Register settings for our options page
*/
function qtxrss_register_settings() {
  //An array of strings names for our options
  //So we can process it with a for loop
  $options = array('qtxrss_label', 'qtxrss_url_list');
  /*
  * For options we get in array we will register the setting
  */
  for ($i=0; $i < count($options) ; $i++) {
    add_option( $options[$i], 'https://localhost/wordpress/wp-content/themes/TheQuartex/apps/qtx-rss/default/rss_euro');
    register_setting( 'qtxrss_options_group', $options[$i], 'qtxrss_callback' );
  }
}
add_action( 'admin_init', 'qtxrss_register_settings' );

/*
* We register the settings page itself
*/
function qtxrss_register_options_page() {
  add_options_page('QTX-RSS fetch & display', 'QTX-RSS', 'manage_options', 'qtxrss', 'qtxrss_options_page');
}
add_action('admin_menu', 'qtxrss_register_options_page');



/*
********* Echoes settings in the form qtx_rss_options_page()
*/
/*
* Settings textarea for url list array
*/
function qtxrss_settings_urls() {
	$option = get_option('qtxrss_url_list');
  echo "<th scope='row'><label for='qtxrss_url_list'>Textarea</label></th>";
	echo "<input type='textarea' id='qtxrss_url_list' name='qtxrss_url_list' rows='7' cols='20' type='textarea' value='" . $option . "'></input>";
  echo "</tr>";
}
/*
*
* Validates url on admin input
*
*
*/
function qtxrss_validate_url() {

}

/*
*****Echoes form for options
*/
function qtxrss_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <?php $test = qtx_get_arrayOfFeeds();
  var_dump($test);
  ?>
  <h2>My Plugin Page Title</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'qtxrss_options_group' ); ?>
  <table>
  <tr valign="top">
  <th scope="row"><label for="qtxrss_label">Label</label></th>
  <td><input type="text" id="qtxrss_label" name="qtxrss_label" value="<?php echo get_option('qtxrss_label'); ?>" /></td>
  </tr>
  <h3>URL LIST FOR FETCHING</h3>
  <p>You should put urls in comma separated values, because this is an array</p>
  <?php qtxrss_settings_urls(); ?>
  </table>
  <?php submit_button(); ?>
  </form>
  </div>
<?php
} ?>

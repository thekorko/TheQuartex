<?php
if(!defined('LoadFrontend')) {
    die('Frontend');
}
function qtxrss_echoForm($url) { ?>
<form action="<?php echo($url); ?>" method="post">
  <p><label for="feed-type">Choose a type of feed(rss or atom):</label></p>
  <select name="feed-type">
    <option value="">--Please choose an option--</option>
    <option value="rss">RSS feed</option>
    <option value="atom">Atom feed</option>
  </select>
 <p>Feed url: <br><input type="text" name="feed-url" /></p>
 <p><input type="submit" value="Load Feed into file" /></p>
</form>
<?php
}
function qtxrss_formSanitize($type_ofFeed, $dirty_variable) {
      //if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        //die('Not a valid URL');
      //} TODO sanitize adn validate url, use php filters
      // https://developer.wordpress.org/reference/functions/esc_url_raw/
      // https://wordpress.stackexchange.com/questions/274569/how-to-get-url-of-current-page-displayed
     $clean = True; //dangerous
     $clean_variable = $dirty_variable . "\n";
     if($clean) {
       //load config variables for filepaths
       define('LoadConfig', TRUE);
       require get_template_directory() . '/apps/qtx-rss/config.php';
      /*What kind of feed are we handling*/
       if ($type_ofFeed == "rss") {
         $any_filepath = $rss_filepath;
       } elseif ($type_ofFeed == "atom") {
         $any_filepath = $atom_filepath;
       }
       // Write the contents to the file,
      // using the FILE_APPEND flag to append the content to the end of the file
      // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
       file_put_contents($any_filepath, $clean_variable, FILE_APPEND | LOCK_EX);
       echo "<p>everything was good</p>";
     } else {
       echo "<p>Not a valid url</p>";
     }
}
function qtxrss_execFrontForm() {
  //
  global $wp;
  $url = home_url( $wp->request ); //get current url
  echo "<br><h2>Edit Feed Files</h2>";
  qtxrss_echoform($url);
  if(isset($_POST['feed-url'])) {
     //we asume our GET is dirty
     $dirty_variable = $_POST['feed-url'];
     $type_ofFeed = $_POST['feed-type'];
     echo "testing values i've got from _POST" . "<br>";
     echo $dirty_variable . "<br>";
     echo $type_ofFeed . "<br>";
     echo "<br>" . "hello";
     qtxrss_formSanitize($type_ofFeed, $dirty_variable);
     //qtxrss_feedAddToFile();
  }
}

function qtxrss_printFeeds() {
  echo "<br><h2>Print Feeds Lists</h2>";
  define('LoadConfig', TRUE);
  require(get_template_directory() . '/apps/qtx-rss/config.php');
  $file = file_get_contents($rss_filepath, true);
    echo "<br><h3>RSS FEEDS:</h3><br>$file";
  $file = file_get_contents($atom_filepath, true);
    echo "<br><h3>ATOM FEEDS:</h3><br>$file";
}
function qtxrss_resetFile() {
  echo "<br><h2>Reset Files</h2>";
  require(get_template_directory() . '/apps/qtx-rss/config.php');
  global $wp;
  $url = home_url( $wp->request ); //get current url
  if (isset($_POST['deleteRSS'])) {
    file_put_contents($rss_filepath, '');
  } elseif (isset($_POST['deleteAtom'])) {
    file_put_contents($atom_filepath, '');
  } else {
    echo "<br>resetFile was not set<br>";
  }
?>
  <form action="<?php echo($url); ?>" method="post">
    <input type="hidden" name="deleteRSS" value="yes" />
   <p><input type="submit" value="Delete RSS" /></p>
  </form>
  <form action="<?php echo($url); ?>" method="post">
    <input type="hidden" name="deleteAtom" value="yes" />
   <p><input type="submit" value="Delete Atom" /></p>
  </form>
<?php
}




?>

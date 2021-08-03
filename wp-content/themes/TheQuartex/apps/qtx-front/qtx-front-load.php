<?php
/*
*
*
*
*
*
*
*
*/










/*
*
* Script for Data and Directory validation
* features:
* Sanitize user input on url
* Check if files exists on data structure and directory
* https://github.com/thekorko
* www.quartex.net
* Code is gplv2, distribute freely, but give credits please
*
*/



/*
* End of
* Script for data validation
*
*/

//get this array from a database
//groups names used for printing and when we need them for file just strtolower($groups[$i]);
//   $amiga_groups = array('Latex','Satanic','Phantasy','Pacific','Boozombies','Planet Jazz','Chiperia','Insane','Whelpz','Traktor','Other');

//Validates if is a valid demoscene group
/*function qtx_ValidTeam() {
  //We get a variable which could be manipulated by user
  echo "undefined qtx-front.php";

 if(isset($_GET['img'])) {

    //we asume our GET is dirty
    $dirty_variable = $_GET['img'];

    //We clean the variable
    //preg_replace only:
    //[^a-z\-] alphabetic lowercase and allow -
    //[^A-Za-z\-] alphabetic lower and uppercase, allow -
    //[^A-Za-z0-9\-] alphanumeric lower and uppercase allow -
    //trim is for removing spaces
    $clean_variable = preg_replace('/[^a-z\-]/', '', trim($dirty_variable));
    //debugging echo "The GET variable is" . $clean_variable;

    //another way of doing it
    //$clean_Variable = htmlspecialchars($clean_Variable, ENT_QUOTES);

    //we check if that filename exists in our data structure(array of textfiles)
    if (in_array(ucwords(preg_replace('/[-]/', ' ', $clean_variable)), $groups) or $clean_variable = 'fullscreen') {

      //we build a filepath structure
      $filepath = $directory_name . "/" . $clean_variable . $file_format;

      //we check if the file exists
      if (file_exists($filepath)) {
        //we require said filepath
        require($filepath); //we use require instead of include because nowadays its better
      } else {
        //file not found
        echo " 404 Not found";
      }
    } else {
      //data not found
      echo " 404 Not found";
    }
  }

}*/

/*
function qtx_printTeams() {
  echo "undefined qtx-front.php";
  //It reads for every $index in our list do stuff
  //count is the total count of indexes
  /*
  for ($i=0; $i < count($groups); $i++) :

  <li><a href="?img=<?php echo preg_replace('/\s/', '-', strtolower($groups[$i])); //group name in lowercase is our filename ?>"><?php echo $groups[$i] //group name with uppercase?></a>

  <?php
  //would be something like ?img=latex(lowercase)
  endfor;
  //So u dont have to add a link everytime u add new group and texfile
}*/
 ?>

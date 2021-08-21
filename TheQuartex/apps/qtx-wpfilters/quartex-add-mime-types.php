<?php
/**
 * This file is not writen by quartex
 * https://wordpress.stackexchange.com/questions/323221/allowing-webp-uploads
 * https://developer.wordpress.org/reference/functions/wp_check_filetype_and_ext/
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_qtx_users_whitelist', 10, 4 );
function wpse_file_and_ext_qtx_users_whitelist( $types, $file, $filename, $mimes ) {
    //Allow webp picture type upload, here we check for file extensions, this is the security step
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }
    if ( false !== strpos( $filename, '.webm' ) ) {
        $types['ext'] = 'webm';
        $types['type'] = 'video/webm';
    }
    return $types;
}

if (qtx_is_staff()) {
  add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_qtx_staff_check', 10, 4 );
  function wpse_file_and_ext_qtx_staff_check( $types, $file, $filename, $mimes ) {
      //Allow for executables, rar files, 7z uploads here we check security
      if ( false !== strpos( $filename, '.exe' ) ) {
          $types['ext'] = 'exe';
          $types['type'] = 'executable/exe';
      }
      return $types;
  }
}

/**
 * Adds webp filetype to allowed mimes
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_qtx_users_file_whitelist' );
function wpse_mime_types_qtx_users_file_whitelist( $mimes ) {
    $mimes['webp'] = 'image/webp';
    $mimes['webp'] = 'video/webm';
  return $mimes;
}

if (qtx_is_staff()) {
  add_filter( 'upload_mimes', 'wpse_mime_types_qtx_staff_file_whitelist' );
  function wpse_mime_types_qtx_staff_file_whitelist( $mimes ) {
      //Allow exe upload here we whitelist the file extension
      $mimes['exe'] = 'executable/exe';
    return $mimes;
  }
}
?>

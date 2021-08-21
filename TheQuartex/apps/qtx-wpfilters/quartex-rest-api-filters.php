<?php
 /*
 * This file adds messsage errors for unauthorized and unauthenticated users
 * For using the API one needs to be logged in and an authorized role
 * Wordpress REST API
 *
 */

add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    if (qtx_is_staff() or qtx_is_API()) {
        return $result;
    } else {
        return new WP_Error( 'rest_not_authorized', 'You are not authorized to access our REST API', array( 'status' => 403 ) );
    }
});

?>

<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Additional Functions
// =============================================================================


// WP Members Redirect

add_filter( 'wpmem_login_redirect', 'my_login_redirect', 10, 2 );
 
function my_login_redirect( $redirect_to, $user_id ) {

    // return the url that the login should redirect to

    return '/public/wp-content/plugins/contact-administration/profile.php';

}


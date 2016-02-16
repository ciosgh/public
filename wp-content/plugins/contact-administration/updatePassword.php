<?php
/**
 * Template Name: User Profile
 *
 * @package WordPress
 * @subpackage CIoS-Dev
 * @since CIoS-Dev 1.0
 */

require('../../../wp-blog-header.php');
get_header(); 

global $current_user;
get_currentuserinfo();

if (!$current_user->ID) {
    header('Location: /public/?page_id=17');
} else {
	    
        //put out the user id for the correct record to change the password on
	$tmp['userid'] = $current_user->ID;	   
 

            // pull in our data - need to secure this up for production
            $form_fields = array(
                'pwd',                        
            );

            // Entify each field value to go some way to prevent oddities and hacks
                foreach ($form_fields as $this_field_name) {
                    $this_field_value = trim($_POST[$this_field_name]);
                        if ($this_field_value) {
                            $GLOBALS[$this_field_name] = htmlentities(str_replace('\\','',$this_field_value),ENT_QUOTES,'UTF-8');
                        } else {
                            $GLOBALS[$this_field_name] = NULL;
                        }
                }                
                
                //HASH up the new password
                $new_hash = wp_hash_password( $pwd );
                global $wpdb;
		$wpdb->update( $wpdb->users, array( 'user_pass' => $new_hash ), array( 'ID' => $tmp['userid'] ), array( '%s' ), array( '%d' ) );
                           
	header('Location: profile.php');

        
} 

?>
        
       
        
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
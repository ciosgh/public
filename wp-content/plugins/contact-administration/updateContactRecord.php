<?php
/**
 * Template Name: Update Contact Record
 *
 * @package WordPress
 * @subpackage CIoS-Dev
 * @since CIoS-Dev 1.0
 */
require('../../../wp-blog-header.php');
get_header(); 

// get the user from the WP session and query the CRM
            global $current_user;
	    get_currentuserinfo();
if (!$current_user->ID) {
    header('Location: /public/?page_id=17');
} else {            
	    $tmp['email'] = $current_user->user_email;
            $tmp['crmcontact'] = $current_user->crm_contact;


            function processRequest($url, $param ){
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                /*If you have troubles with SSL connection try to add next curl option:*/
                //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'rsa_rc4_128_sha');
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            }

            $token = "0683cf83c7692aa649ed5ecb367b2483";
            

?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php

                        // pull in our data - need to secure this up for production
                        $form_fields = array(
                            'contactid',
                            'first_name',
                            'last_name',
                            'email', 
                            'phone',
                            'mobile',
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

                        $upUrl = 'https://crm.zoho.com/crm/private/xml/Contacts/updateRecords';
                        $upParam = '?newFormat=1&authtoken='.$token.'&scope=crmapi&id='.$contactid.'&xmlData=<Contacts><row no="1"><FL val="First Name">'.$first_name.'</FL><FL val="Last Name">'.$last_name.'</FL><FL val="Email">'.$email.'</FL><FL val="Phone">'.$phone.'</FL><FL val="Mobile">'.$mobile.'</FL></row></Contacts>';

                        $result = processRequest($upUrl, $upParam);

                        /* check and implement wp-users record change if they've amended their details */

                        if ($tmp['email'] <> $email) {
                            global $wpdb;
                            $wpdb->update( $wpdb->users, array( 'user_email' => $email, 'user_nicename' => $firstname ), array( 'crm_contact' => $tmp['crmcontact'] ), array( '%s' ), array( '%d' ) );
                        }


                        //implement code to check for success code 200 to ensure update has occurred or post up error message if otherwise.
                        header('Location: profile.php');
                        ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
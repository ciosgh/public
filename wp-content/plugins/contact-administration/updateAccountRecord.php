<?php
/**
 * Template Name: Update Contact Record
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
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
            $tmp['crmaccount'] = $current_user->crm_account;


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

//$contactID    = $_POST['CONTACTID'];
$accountID      = $_POST['ACCOUNTID'];
$website        = $_POST['Website'];
$billingstreet  = $_POST['Billing_Street'];
$billingcity    = $_POST['Billing_City'];
$billingstate   = $_POST['Billing_State'];
$billingcode    = $_POST['Billing_Code'];
$description    = $_POST['Description'];

$upUrl = 'https://crm.zoho.com/crm/private/xml/Accounts/updateRecords';
$upParam = '?newFormat=1&authtoken='.$token.'&scope=crmapi&id='.$accountID.'&xmlData=<Accounts><row no="1">'
        . '<FL val="Website">'.$website.'</FL><FL val="Billing Street">'.$billingstreet.'</FL><FL val="Billing City">'.$billingcity.'</FL><FL val="Billing State">'.$billingstate.'</FL><FL val="Billing Code">'.$billingcode.'</FL><FL val="Description">'.$description.'</FL></row></Accounts>';

$result = processRequest($upUrl, $upParam);


//implement code to check for success code 200 to ensure update has occurred or post up error message if otherwise.
header('Location: profile.php');
?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
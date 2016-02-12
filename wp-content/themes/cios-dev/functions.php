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


// Add Shortcode
function showme_shortcode( $atts , $content = null, $email ) {

        $message = "";
	extract(shortcode_atts(array('email' => ''), $atts));



        function processRequest($url, $param ){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            /*If you have troubles with SSL connection try to add next curl option:*/
            //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'rsa_rc4_128_sha');
            $result = curl_exec($ch);
            return $result;
        }

        //header("Content-type: application/xml");
        $token = "0683cf83c7692aa649ed5ecb367b2483";
        $url = "https://crm.zoho.com/crm/private/xml/Contacts/getSearchRecordsByPDC";
        $param = "authtoken=".$token."&scope=crmapi&selectColumns=Contacts(Contact Owner,Lead Source,First Name,Last Name,Account Name)&searchColumn=email&searchValue=".$email."&version=2";


        $result = processRequest($url, $param);
        //$result = processRequest($url, 'authtoken=0683cf83c7692aa649ed5ecb367b2483&scope=crmapi&selectColumns=Contacts(Contact Owner,Lead Source,First Name,Last Name,Account Name)&searchColumn=email&searchValue=dshilson@hotmail.com&version=2');

	$xml = simplexml_load_string($result, null, LIBXML_NOCDATA);

	foreach($xml->result->Contacts as $contact){
		foreach($contact->row->FL as $FL){
			print "<b>Attributes:</b><br>";
			foreach($FL->attributes() as $attribute => $value){
				print $attribute .':'.$value."<br>";
			}
			print "Value:<br>";
			print (string)$FL."<hr>";



	}
        }





}
add_shortcode( 'showme', 'showme_shortcode' );

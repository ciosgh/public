<?php
/**
 * Template Name: Edit Contact Record
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

                        $url = "https://crm.zoho.com/crm/private/xml/Accounts/getSearchRecordsByPDC";
                        $param = "authtoken=".$token."&scope=crmapi&selectColumns=Accounts(Account Name,Website,Billing Street,Billing City,Billing State,Billing Code,Description)&searchColumn=accountid&searchValue=".$tmp['crmaccount']."&version=2";
                        $result = processRequest($url, $param);
                        $xml = simplexml_load_string($result, null, LIBXML_NOCDATA);


                        ?>

                    <form action="updateAccountRecord.php" method="post">
                    <div id="webform" style="width:600px;">

                    <?php

                    foreach($xml->result->Accounts as $account){
                      foreach($account->row->FL as $FL){
                        foreach($FL->attributes() as $attribute => $value){  
                     ?>

                          <div style="clear:both;width:100%;padding:20px">

                               <?php if ($value <> "ACCOUNTID" && $value <> "Description") { ?>
                                  <div style="float:left;width:150px;">
                                    <label for="<?php print $value; ?>"><?php print $value; ?></label>
                                  </div>
                                  <div style="float:left;">
                                    <input size="50" type="text" name="<?php print strtolower(str_replace(" ","_",$value)); ?>" value="<?php print stripslashes((string)$FL); ?>" />
                                  </div>
                              <?php } ?>
                                
                              
                               <?php if ($value == "Description") { ?>
                                        <div style="float:left;width:150px;">
                                            <label for="<?php print $value; ?>"><?php print $value; ?></label>
                                        </div>
                                
                                  <?php print '<textarea cols="60" rows="7" name='.strtolower($value).'>'.(string)$FL.'</textarea>';
                                     }

                                    if ($value == "ACCOUNTID") {
                                        print '<input type="hidden" name="'.strtolower($value).'" value='.(string)$FL.' />';
                                     }
                              ?>
                         </div>

                    <?php
                        }
                      }
                    }

                    ?>
                    <br/><br/>
                    <input style="margin-left:20px;" type="submit" id="submit" value="Update" />

                    </div>

                    </form>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
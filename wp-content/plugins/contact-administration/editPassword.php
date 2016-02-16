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
	    

	    $tmp['userid'] = $current_user->ID;
	    $tmp['email'] = $current_user->user_email;
	    $tmp['first_name'] = $current_user->user_firstname;
            $tmp['crmcontact'] = $current_user->crm_contact;
 
?>

	<div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="x-boxed-layout-active">
                    <?php /* The loop */ ?>
                    
                    <h2>Update your password</h2>
                    <p>Please try to use a combination of numbers and letters and include a character.</p> 
                    <p style="color:red;" id="validate-status"></p>
                    <form action="updatePassword.php" method="post">
                        <label for="pwd">Enter new Password</label>
                        <input type="password" id="pwd" name="pwd" size="20"/>
                        <label for="conpwd">Confirm Password</label>
                        <input type="password" id="conpwd" name="conpwd" size="20"/>
                        <br/><br/>
                        <p>Submitting this form will log you out, where you can log in with your new password.</p>
                        <input type="submit" name="submit" id="submit" value="Change Password" />
                    </form>
                    
                </div>
            </div><!-- #content -->
	</div><!-- #primary -->
        
<?php } ?>
        
        <script type='text/javascript'>//<![CDATA[
            jQuery(document).ready(function() {
                jQuery("#conpwd").keyup(validate);
            });


            function validate() {
                var pwd = jQuery("#pwd").val();
                var conpwd = jQuery("#conpwd").val();

                if(pwd == conpwd) {
                    jQuery("#validate-status").text("Passwords match, thank you");        
                } else {
                    jQuery("#validate-status").text("Passwords do not match, please check your entries");  
                }
    
            }//]]> 
        </script>
        
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
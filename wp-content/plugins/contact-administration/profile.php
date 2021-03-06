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

                        <h2>Welcome <?php echo $tmp['first_name']; ?> to your Growth Hub profile page</h2>

                        <p>You can currently select from the following</p>
                        <p><a href="editContactRecord.php" title="Edit Contact information">Edit Contact Information</a></p>
                        <p><a href="editAccountRecord.php" title="Edit Business information">Edit Business Information</a></p>
                        <p><a href="editPassword.php" title="Change password">Change password</a></p>
                </div>
            </div><!-- #content -->
	</div><!-- #primary -->
<?php } ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * IREST - Online Food Ordering Script
 *
 * PHP version 5
 *
 * @category  Front-end
 * @package   IREST_FRONTEND
 * @author    IDNS TEAM <support@idns-technologies.com>
 * @copyright 2016-2017 IDNSPro
 * @license   http://idns.com/license.txt EULA
 * @link      http://idns.com
 * Do not copy, cite, or distribute without permission of the author.
 */

/*
|--------------------------------------------------------------------------
| Frontend user profile settings page
|--------------------------------------------------------------------------
|
| It is user profile settings page
|
*/

require_once __DIR__ . '/includes/user-top.php';
/*
// Page details
$page_nofound = true;
$page_name    = $_GET['name'];
$page_name    = str_replace("/", "_", str_replace("-", " ", $page_name));
$pageInfo     = $cmsObj->fun_getPageInfoByName($page_name);

if(is_array($pageInfo) && !empty($pageInfo)) {
    $page_id            = $pageInfo['page_id'];
    $pageInfo           = $cmsObj->fun_getPageInfo($page_id);
    $page_title         = fun_db_output($pageInfo['page_title']);
    $page_content_title = fun_db_output($pageInfo['page_content_title']);
    $page_discription   = fun_db_output($pageInfo['page_discription']);
    $seo_title          = ($pageInfo['page_seo_title']!="")?$pageInfo['page_seo_title']:$seo_title;
    $seo_keywords       = ($pageInfo['page_seo_keyword']!="")?$pageInfo['page_seo_keyword']:$seo_keywords;
    $seo_description    = ($pageInfo['page_seo_discription']!="")?$pageInfo['page_seo_discription']:$seo_description;
    $page_nofound       = false;
}
*/
//form submission
$form_array = array();
$errorMsg 	= "no";

// Edit user : Start here 
if($_POST['securityKey']==md5(EDITUSER)){	
    if(trim($_POST['user_fname']) == '') {
        $form_array['user_fname_error'] = 'First Name required';
        $errorMsg = 'yes';
    }

    if(trim($_POST['user_lname']) == '') {
        $form_array['user_lname_error'] = 'Last Name required';
        $errorMsg = 'yes';
    }

    if(trim($_POST['user_fname']) == trim($_POST['user_lname'])) {
        $form_array['user_fname_error'] = 'First & Last Name is same';
        $errorMsg = 'yes';
    }

    if(trim($_POST['user_email']) == '') {
        $form_array['user_email_error'] = 'Enter valid email address';
        $errorMsg = 'yes';
    } else {
        if(preg_match(EMAIL_ID_REG_EXP_PATTERN, $_POST['user_email'])) {
            // Check if email already exist
        } else {
            $form_array['user_email_error'] = 'Enter valid email address';
            $errorMsg = 'yes';
        }
    }
    if($errorMsg == 'no' && $errorMsg != 'yes') {
        $user_id = $_POST['user_id']; // Edit User
        $usersObj->fun_editUser($user_id);
        $redirect_url = "profile-settings.php?sec=edit&user_id=".$user_id;
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
    }	
}
// Edit user : End here 
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $seo_title;?></title>
<meta name="description" content="<?php echo $seo_description;?>" />
<meta name="keywords" content="<?php echo $seo_keywords;?>" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo tranText('charset'); ?>" />
<META HTTP-EQUIV="Content-language" CONTENT="<?php echo tranText('lang_iso'); ?>">
<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo SITE_URL; ?>favicon.ico" />
<link rel="SHORTCUT ICON" href="<?php echo SITE_URL; ?>favicon.ico"/>
<link href="<?php echo SITE_CSS_INCLUDES_PATH;?>bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo SITE_JS_INCLUDES_PATH;?>jquery.min.js"><\/script>')</script>
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>bootstrap.min.js"></script>
<!-- Custom Theme files -->
<link href="<?php echo SITE_CSS_INCLUDES_PATH;?>style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>wow.min.js"></script>
<link href="<?php echo SITE_CSS_INCLUDES_PATH;?>animate.css" rel='stylesheet' type='text/css' />
<script>
    new WOW().init();
</script>
<script type="text/javascript" src="<?php echo SITE_JS_INCLUDES_PATH;?>move-top.js"></script>
<script type="text/javascript" src="<?php echo SITE_JS_INCLUDES_PATH;?>easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){        
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
        });
    });
</script>
</head>
<body>
    <!-- header -->
    <div class="header">
    <?php require_once SITE_INCLUDES_PATH . 'header.php'; ?>
    </div>
    <!-- content -->
    <div class="content user-section-page">
        <div class="container">
            <div class="user-page">
                <div class="col-md-4 wow fadeInRight" data-wow-delay="0.4s">
                    <?php require_once SITE_INCLUDES_PATH . 'user-left-links.php'; ?>
                </div>
                <div class="col-md-8 wow fadeInLeft" data-wow-delay="0.4s">
                    <h2>My homepage</h2>
                    <p class="text-danger">Hi <?php echo ucwords($users_first_name); ?> and welcome to <?php echo $sitetitle; ?>. </p>
                    <p class="text-primary">We've made the site as simple as we can and we're adding new features all the time to help you choose your perfect restaurants. Now you've registered on the site we'll keep you up to date with all the latest developments & news for <?php echo $sitetitle; ?>.</p>
                    <?php require_once SITE_INCLUDES_PATH . 'profile.php'; ?>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="footer">
    <?php require_once SITE_INCLUDES_PATH . 'footer.php'; ?>
    </div>
</body>
</html>

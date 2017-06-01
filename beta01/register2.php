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
| Frontend register 2 page
|--------------------------------------------------------------------------
|
| It is register 2 page
|
*/

require_once __DIR__ . '/includes/application-top.php';
require_once SITE_CLASSES_PATH . 'class.Users.php';
require_once SITE_CLASSES_PATH . 'class.UserSetting.php';
require_once SITE_CLASSES_PATH . 'class.Location.php';
require_once SITE_CLASSES_PATH . 'class.Email.php';

$usersObj       = new Users();
$userSettingObj = new UserSetting();
$locationObj    = new Location();


if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){ // login then redirect to its home page
    redirectURL($_SESSION['ses_user_home']);
} else {
    $user_id = "";
    if(!isset($_SESSION['registraton_id'])) {
        redirectURL("index.php");
    }
}
if($_POST['securityKey']==md5("NEWREGISTRATION2")){
    if($usersObj->sendActivationEmailToUser($_POST['user_id'])){
        redirectURL("register2.php");
    }
}
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
    <div class="content">
        <div class="main">
            <div class="container">
                <div class="register">
                    <div><span class="text-danger">Thanks ...</span> you're almost there!<br /><br />You will shortly receive a confirmation email. Just click on the link to confirm your email address</div>
                    <div>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="frmUserRegister" id="frmUserRegister">
                            <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5(NEWREGISTRATION2);?>">
                            <input type="hidden" name="user_id" id="user_id_id" value="<?php echo $_SESSION['registraton_id']; ?>">
                            <input type="hidden" name="user_pass" id="user_pass_id" value="<?php echo $_SESSION['registraton_pass']; ?>">
                            <span class="text-success">If you don't receive the email</span>
                            <br />
                            <span>The confirmation email should be with you in a few minutes. If it isn't then check your <strong>JUNK MAIL</strong> folder or <strong>SPAM</strong> folders. Failing that add <?php echo SITE_ADMIN_EMAIL;?> to your Email Address Book or Safe Sender list and click the Resend Email button below. <br /><br />It's useful to do this anyway to ensure future emails from us arrive in your inbox.</span>
                            <br />
                            <br />
                            <input type="submit" value="Resend now" class="btn btn-success col-md-3" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="footer">
    <?php require_once SITE_INCLUDES_PATH . 'footer.php'; ?>
    </div>
</body>
</html>

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
| Frontend contact page 
|--------------------------------------------------------------------------
|
| It is contact page 
|
*/

require_once __DIR__ . '/includes/application-top.php';
require_once SITE_CLASSES_PATH . 'class.Users.php';
require_once SITE_CLASSES_PATH . 'class.Email.php';
require_once SITE_CLASSES_PATH . 'class.CMS.php';

$usersObj       = new Users();
$cmsObj         = new Cms();
// Page details
$page_id            = 3;
$pageInfo           = $cmsObj->fun_getPageInfo($page_id);
$page_title         = fun_db_output($pageInfo['page_title']);
$page_content_title = fun_db_output($pageInfo['page_content_title']);
$page_discription   = fun_db_output($pageInfo['page_discription']);
$seo_title          = ($pageInfo['page_seo_title']!="")?$pageInfo['page_seo_title']:$seo_title;
$seo_keywords       = ($pageInfo['page_seo_keyword']!="")?$pageInfo['page_seo_keyword']:$seo_keywords;
$seo_description    = ($pageInfo['page_seo_discription']!="")?$pageInfo['page_seo_discription']:$seo_description;
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
    <div class="content contact-section-page">
        <div class="contact-head">
            <div class="container">
                <h3>Contact</h3>
                <p>Home/Contact</p>
            </div>
        </div>
        <div class="contact_top">
            <div class="container">
                <div class="col-md-6 contact_left wow fadeInRight" data-wow-delay="0.4s">
                    <h4>Contact Form</h4>
                    <p>Lorem ipsum dolor sit amet, adipiscing elit. Donec tincidunt dolor et tristique bibendum. Aenean sollicitudin vitae dolor ut posuere.</p>
                    <form>
                        <div class="form_details">
                            <input type="text" class="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
                            <input type="text" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}">
                            <input type="text" class="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
                            <textarea value="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
                            <div class="clearfix"> </div>
                            <div class="sub-button wow swing animated" data-wow-delay= "0.4s">
                                <input name="submit" type="submit" value="Send message">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 company-right wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1578265.0941403757!2d-98.9828708842255!3d39.41170802696131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1407515822047"> </iframe></div>
                    <div class="company-right">
                        <div class="company_ad">
                            <h3>Contact Info</h3>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit velit justo.</span>
                            <address>
                            <p>email:<a href="mail-to: info@example.com">info@display.com</a></p>
                            <p>phone:  +255 55 55 777</p>
                            <p>28-7-169, 2nd Ave South</p>
                            <p>Saskabush, SK   S7M 1T6</p>
                            </address>
                        </div>
                    </div>
                    <div class="follow-us">
                        <h3>follow us on</h3>
                        <a href="<?php echo $facebooklink; ?>" target="_blank"><i class="facebook"></i></a>
                        <a href="<?php echo $twitterlink; ?>" target="_blank"><i class="twitter"></i></a>
                        <a href="<?php echo $youtubelink; ?>" target="_blank"><i class="google-pluse"></i></a>
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

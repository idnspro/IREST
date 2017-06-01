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
require_once SITE_CLASSES_PATH . 'class.Restaurant.php';
require_once SITE_CLASSES_PATH . 'class.Location.php';

$usersObj    = new Users();
$cmsObj      = new Cms();
$restObj     = new Restaurant();
$locationObj = new Location();
/*
// Page details
$page_id            = 3;
$pageInfo           = $cmsObj->fun_getPageInfo($page_id);
$page_title         = fun_db_output($pageInfo['page_title']);
$page_content_title = fun_db_output($pageInfo['page_content_title']);
$page_discription   = fun_db_output($pageInfo['page_discription']);
$seo_title          = ($pageInfo['page_seo_title']!="")?$pageInfo['page_seo_title']:$seo_title;
$seo_keywords       = ($pageInfo['page_seo_keyword']!="")?$pageInfo['page_seo_keyword']:$seo_keywords;
$seo_description    = ($pageInfo['page_seo_discription']!="")?$pageInfo['page_seo_discription']:$seo_description;
*/
// Form submission
$rest_id    = $_REQUEST['rest_id'];
$form_array = array();
$errorMsg   = 'no';
if($_POST['securityKey']==md5("RESTAURANTREVIEW")) {
    if(trim($_POST['user_fname']) == '') {
        $form_array['user_fname_error'] = 'First Name required';
        $errorMsg = 'yes';
    }
    if(trim($_POST['user_lname']) == '') {		
        $form_array['user_lname_error'] = 'Last Name required';
        $errorMsg = 'yes';
    }
    if($_POST['user_email'] == '') {
        $form_array['user_email_error'] = 'Please enter a valid email address';
        $errorMsg = 'yes';
    }
    if(trim($_POST['review_title']) == '') {		
        $form_array['review_title_error'] = 'Review title required';
        $errorMsg = 'yes';
    }
    if(trim($_POST['review_txt']) == '') {		
        $form_array['review_txt_error'] = 'Review required';
        $errorMsg = 'yes';
    }
    if(($_SESSION['security_code'] == $_POST['image_vcode']) && ($errorMsg == 'no') && ($errorMsg != 'yes')){		
        // register as owner
        $user_fname   = trim($_POST['user_fname']);
        $user_lname   = trim($_POST['user_lname']);
        $user_email   = trim($_POST['user_email']);
        $user_country = $_POST['user_country'];
        $rest_rating  = trim($_POST['rest_rating']);
        $review_title = trim($_POST['review_title']);
        $review_txt   = trim($_POST['review_txt']);
        $status       = 1;
        if($restObj->fun_verifyRestaurantReviewUserEmail($rest_id, $user_email) == true) {
            $form_array['error_msg'] = "Error: already review added for this email id, use any other mail id!";
        } else {
            if($restObj->fun_addRestaurantReview('', $rest_id, $rest_rating, $review_title, $review_txt, $user_fname, $user_lname, $user_email, $user_country, $status) === true){
                redirectURL("restaurant-write-review.php?rest_id=".$rest_id."&review=thanks");
            } else {
                $form_array['error_msg'] = "Error: We are unable to add your review!";
            }
        }
    } else {
        $form_array['error_msg'] = "Codes must match!";
    }
}

if(isset($rest_id) && $rest_id !=""){
    $restInfo = $restObj->fun_getRestaurantInfo($rest_id);
    if(count($restInfo) > 0) {
        $rest_name           = $restInfo['rest_name'];
        $rest_title          = $restInfo['rest_title'];
        $rest_short_desc     = $restInfo['rest_short_desc'];
        $page_discription    = $restInfo['page_discription'];
        $rest_logo           = RESTAURANT_IMAGES_LOGO_PATH.$restInfo['rest_logo'];
        $rest_photo          = RESTAURANT_IMAGES_LARGE_PATH.$restInfo['rest_photo'];
        $rest_country_id     = $restInfo['rest_country_id'];
        $rest_state_id       = $restInfo['rest_state_id'];
        $rest_city_id        = $restInfo['rest_city_id'];
        $rest_address1       = $restInfo['rest_address1'];
        $rest_address2       = $restInfo['rest_address2'];
        $rest_zip            = $restInfo['rest_zip'];
        $rest_latitude       = $restInfo['rest_latitude'];
        $rest_longitude      = $restInfo['rest_longitude'];
        $rest_map_zoom_level = $restInfo['rest_map_zoom_level'];
        $created_on          = date('F j, Y', $restInfo['created_on']);
        $updated_on          = date('F j, Y', $restInfo['updated_on']);
        //Restaurant review : start here
        $restLocInfoArr      = $restObj->fun_getRestaurantLocInfoArr($rest_id);
        $propLoc             = "";
        if($restLocInfoArr['country_name'] !=""){
            $propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['country_name'])))."\" >".ucwords($restLocInfoArr['country_name'])."</a> > ";
        }
        if($restLocInfoArr['state_name'] !=""){
            $propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['state_name'])))."\" >".ucwords($restLocInfoArr['state_name'])."</a> > ";
        }
        if($restLocInfoArr['city_name'] !=""){
            $propLoc .= "<a href=\"".SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($restLocInfoArr['city_name'])))."\" >".ucwords($restLocInfoArr['city_name'])."</a> > ";
        }
        $propLoc .= ucfirst($rest_name)." ref:".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
        $fr_url = $restObj->fun_getRestaurantFriendlyLink($rest_id);
        if(isset($fr_url) && $fr_url != "") {
            $restaurant_link 	= SITE_URL."restaurant/".strtolower($fr_url);
        } else {
            if(isset($restLocInfoArr['city_name']) && $restLocInfoArr['city_name'] != "") {
                $restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['city_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
            } else {
                $restaurant_link = SITE_URL."restaurant/".str_replace(" ", "-", strtolower($restLocInfoArr['state_name']))."/".fill_zero_left($rest_id, "0", (6-strlen($rest_id)));
            }
        }
    }
} else {
    $referpage = SITE_URL;
    redirectURL($referpage);
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
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>jquery.min.js"></script>
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
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>tms-0.4.1.js"></script>
<script>
$(window).load(function(){
    $('.slider')._TMS({
        show:0,
        pauseOnHover:false,
        prevBu:'.prev',
        nextBu:'.next',
        playBu:false,
        duration:800,
        preset:'fade', 
        pagination:true,//'.pagination',true,'<ul></ul>'
        pagNums:false,
        slideshow:8000,
        numStatus:false,
        banners:false,
        waitBannerAnimation:false,
        progressBar:false
    })
});
$(window).load (
function(){
    $('.carousel1').carouFredSel({
        auto: false,
        prev: '.prev',
        next: '.next',
        width: 960,
        items: {
            visible : {min: 1, max: 4},
            height: 'auto',
            width: 240,
        },
        responsive: false, 
        scroll: 1, 
        mousewheel: false,
        swipe: {onMouse: false, onTouch: false}
    });
});      
</script>
<script src="<?php echo SITE_JS_INCLUDES_PATH;?>jquery.easydropdown.js"></script>
</head>
<body>
    <!-- header -->
    <div class="header">
    <?php require_once SITE_INCLUDES_PATH . 'header.php'; ?>
    </div>
    <!-- content -->
    <div class="order-section-page">
    <?php
    if(isset($_GET['review']) && $_GET['review'] == "thanks") {
    ?>
        <p class="push-btm15 push-top15">
            <span class="text-success">Thanks ...</span> your review has been submitted.<br>
            We're now checking to see if the content is suitable for the site. If it is we'll put it live in less <br />than 48 hrs (it's often much much less!), if it isn't then we'll drop you an email to let you know why.<br><br>
            <a href="<?php echo $restaurant_link; ?>" class="btn btn-success col-md-6">Back to restaurant</a>
        </p>
    <?php
    } else {
        require_once SITE_INCLUDES_PATH . 'review-form.php';
    }
    ?>
    </div>
    <!-- footer -->
    <div class="footer">
    <?php require_once SITE_INCLUDES_PATH . 'footer.php'; ?>
    </div>
</body>
</html>

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
| Frontend checkout page
|--------------------------------------------------------------------------
|
| It is checkout page
|
*/

require_once __DIR__ . '/includes/application-top.php';
require_once SITE_CLASSES_PATH . 'class.Users.php';
require_once SITE_CLASSES_PATH . 'class.Restaurant.php';
require_once SITE_CLASSES_PATH . 'class.Location.php';
require_once SITE_CLASSES_PATH . 'class.Email.php';


$usersObj    = new Users();
$restObj     = new Restaurant();
$locationObj = new Location();
if ( ! empty( $_SESSION['ses_user_id'] ) ) {
    $user_id          = $_SESSION['ses_user_id'];
    $userInfoArr      = $usersObj->fun_getUsersInfo($user_id);
    $users_first_name = $userInfoArr['user_fname'];
    $users_last_name  = $userInfoArr['user_lname'];
    $users_email_id   = $userInfoArr['user_email'];
    $user_full_name   = ucwords($users_first_name." ".$users_last_name);
    $country_id       = $userInfoArr['user_country'];
}
$userCurrencyArr       = $usersObj->fun_getUserCurrencyInfo($user_id);
$users_currency_id     = $userCurrencyArr['currency_id'];
$users_currency_code   = $userCurrencyArr['currency_code'];
$users_currency_symbol = $userCurrencyArr['currency_symbol'];
$users_currency_rate   = $userCurrencyArr['currency_rate'];
$users_currency_name   = $userCurrencyArr['currency_name'];
//form submission
$form_array = array();
$errorMsg   = "no";

if($_POST['securityKey']==md5("CHECKOUT")) {
    if(trim($_POST['delivery_fname']) == '') {
        $form_array['delivery_fname_error'] = 'First name required';
        $errorMsg = 'yes';
    }
    if(trim($_POST['delivery_address1']) == '') {
        $form_array['delivery_address1_error'] = 'Address required';
        $errorMsg = 'yes';
    }

    if(trim($_POST['delivery_zip']) == '') {
        $form_array['delivery_zip_error'] = 'Postal code required';
        $errorMsg = 'yes';
    }

    if(trim($_POST['dtype']) == '') {
        $form_array['dtype_error'] = 'Delivery type required';
        $errorMsg = 'yes';
    }

    if(trim($_POST['schedule']) == '') {
        $form_array['schedule_error'] = 'Schedule required';
        $errorMsg = 'yes';
    }

    if($errorMsg == 'no' && $errorMsg != 'yes' && isset($user_id) && $user_id !="") {
        //Posted variables
        $rest_id           = $_POST['rest_id'];
        $delivery_fname    = $_POST['delivery_fname'];
        $delivery_lname    = $_POST['delivery_lname'];
        $delivery_address1 = $_POST['delivery_address1'];
        $delivery_address2 = $_POST['delivery_address2'];
        $delivery_city     = $_POST['delivery_city'];
        $delivery_state    = $_POST['delivery_state'];
        $delivery_country  = $_POST['delivery_country'];
        $delivery_zip      = $_POST['delivery_zip'];
        $delivery_phone    = $_POST['delivery_phone'];
        $dtype             = $_POST['dtype'];
        $schedule          = $_POST['schedule'];
        $order_comments    = $_POST['order_comments'];
        $payment_method    = $_POST['payment_method'];
        $cc_type           = $_POST['cc_type'];
        $cc_owner          = $_POST['cc_owner'];
        $cc_number         = $_POST['cc_number'];
        $cc_expires        = $_POST['cc_expires'];
        $final_price       = $_POST['final_price'];
        $currency_id       = $_POST['currency_id'];
        $txtCouponApply    = $_POST['txtCouponApply'];
        $orders_status     = 1;
        //Step I: Add new order and get order id
        $order_id          = $restObj->fun_addNewOrder($user_id, $delivery_fname, $delivery_lname, $delivery_address1, $delivery_address2, $delivery_city, $delivery_state, $delivery_country, $delivery_zip, $delivery_phone, $dtype, $schedule, $order_comments, $payment_method, $cc_type, $cc_owner, $cc_number, $cc_expires, $final_price, $currency_id, $orders_status);
        //Step II: enter in the order status history table with the relation of order id
        $date_added        = date('Y-m-d H:i:s');
        $order_status_id   = 1;
        $customer_notified = 1;
        $comments          = "New order posted";
        $restObj->fun_addOrderStatusHistory($order_id, $order_status_id, $date_added, $customer_notified, $comments);
        //Step IV: update coupon take-up
        if(isset($txtCouponApply) && $txtCouponApply =="1") {
            $coupon_code 	= $_POST['coupon_code'];
            $restObj->fun_addCouponUserTakeup($coupon_code, $user_id, $order_id);
        }
        $restObj->fun_sendRestOrderNotification($rest_id, $order_id);
        /*
        $ipcountry         = getIPCountry();
        if(isset($ipcountry) && ($ipcountry == "IND")) {
            $restObj->fun_sendRestOrderSMSsd($rest_id, $order_id);
        } else {
            $restObj->fun_sendRestOrderSMSsg($rest_id, $order_id);
        }
        */

        $redirect_url       = "order-success.php";
        redirectURL($redirect_url);
    } else {
        $form_array['error_msg'] = "Please submit your form again!";
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
    <div class="Popular-Restaurants-content">
        <?php
        if(isset($user_id) && $user_id !="") {
            require_once SITE_INCLUDES_PATH . 'checkout-form.php';
        } else {
            require_once SITE_INCLUDES_PATH . 'login-form.php';
        }
        ?>
    </div>
    <!-- footer -->
    <div class="footer">
    <?php require_once SITE_INCLUDES_PATH . 'footer.php'; ?>
    </div>
</body>
</html>

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
| Frontend register page
|--------------------------------------------------------------------------
|
| It is register page
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
}

// Form submission
$form_array = array();
$errorMsg   = 'no';
if ( $_POST['securityKey'] == md5('NEWREGISTRATION') ) {
    if(trim($_POST['user_fname']) == '') {
        $form_array['user_fname_error'] = 'First Name required';
        $errorMsg                       = 'yes';
    }
    if(trim($_POST['user_lname']) == '') {
        $form_array['user_lname_error'] = 'Last Name required';
        $errorMsg                       = 'yes';
    }
    if($_POST['user_email'] == '') {
        $form_array['user_email_error'] = 'Please enter a valid email address';
        $errorMsg                       = 'yes';
    } else {
        if(preg_match(EMAIL_ID_REG_EXP_PATTERN, $_POST['user_email'])) {
            // Check if email already exist
            if($usersObj->fun_checkEmailAddress($_POST['user_email']) === true) {
                $form_array['user_email_error'] = 'Email address already exists <a href="'.SITE_URL.'login" style="font-size:11px; color:#357bdc; text-decoration:none;">Sign in</a>';
                $errorMsg                       = 'yes';
            }
        } else {
            $form_array['user_email_error'] = 'Please enter a valid email address';
            $errorMsg                       = 'yes';
        }
    }
    if((trim($_POST['user_pass']) == '') || (strlen($_POST['user_pass']) < 6)) {
        $form_array['user_pass_error'] = 'Minimum of 6 character password required';
        $errorMsg                      = 'yes';
    }
    if((trim($_POST['user_confirmpass']) == '') || (trim($_POST['user_confirmpass']) != trim($_POST['user_pass']))){
        $form_array['user_confirmpass_error'] = 'Please confirm your password';
        $errorMsg                             = 'yes';
    }

    if(($_SESSION['security_code'] == $_POST['image_vcode']) && ($errorMsg == 'no') && ($errorMsg != 'yes')){		
        // register as owner
        $user_email    = trim($_POST['user_email']);
        $user_pass     = trim($_POST['user_pass']);
        $user_fname    = trim($_POST['user_fname']);
        $user_lname    = trim($_POST['user_lname']);
        $user_dob      = "";
        $user_country  = "";
        $user_state    = "";
        $user_city     = "";
        $user_address1 = "";
        $user_address2 = "";
        $user_zip      = "";
        $user_ip       = trim($_POST['user_ip']);
        $is_manager    = trim($_POST['is_manager']);
        $user_id       = $usersObj->fun_registerUser($user_email, $user_pass, $user_fname, $user_lname, $user_email, $user_dob, $user_country, $user_state, $user_city, $user_address1, $user_address2, $user_zip, $user_ip, $is_manager);
        if ( $user_id != "" ) {
            $_SESSION['registraton_id']   = $user_id;
            $_SESSION['registraton_pass'] = $user_pass;
            //if($usersObj->sendActivationEmailToUser($user_id)) {
                redirectURL("register2.php");
            //}
        } else {
            redirectURL("register.php");
        }
    } else {
        $form_array['error_msg'] = "Codes must match!";
    }
}
$dayname   = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
$monthname = array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
$yearname  = array();
$startYear = date('Y') - 100;
$endYear   = date('Y') - 16;
for($counter = $endYear; $counter >= $startYear; $counter--) {
    array_push($yearname, $counter);
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
<script type="text/javascript" language="javascript">
    var x, y;
    function show_coords(event){	
        x=event.clientX;
        y=event.clientY;
        x = x-160;
        y = y+4;
        //alert(x);alert(y);
    }
    function cancelRegistration() {
        window.location = 'index.php';
    }
    function chkblnkTxtError(strFieldId, strErrorFieldId) {
        if(document.getElementById(strFieldId).value != "") {
            document.getElementById(strErrorFieldId).innerHTML = "";
        }
    }
    function validatefrm(){
        if(document.getElementById("user_fname_id").value == "") {
            document.getElementById("user_fname_errorid").innerHTML = "First Name required";
            document.getElementById("user_fname_id").focus();
            return false;
        }
        if(document.getElementById("user_lname_id").value == "") {
            document.getElementById("user_lname_errorid").innerHTML = "Last Name required";
            document.getElementById("user_lname_id").focus();
            return false;
        }
        if(document.getElementById("user_email_id").value == "") {
            document.getElementById("user_email_errorid").innerHTML = "Enter valid email address";
            document.getElementById("txtuser_email_id").focus();
            return false;
        }
        if(document.getElementById("user_pass_id").value == "") {
            document.getElementById("user_pass_errorid").innerHTML = "Password required";
            document.getElementById("user_pass_id").focus();
            return false;
        }
        document.frmUserRegister.submit();
    }
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
                    <?php if( !empty( $form_array ) ) : ?>
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> <br>
                            <ul class="list-unstyled">
                                <?php foreach( $form_array as $error ) { ?>
                                <li><?php echo $error; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form name="frmUserRegister" id="frmUserRegister" method="post" action="register.php">
                    <input type="hidden" name="securityKey" id="securityKey" value="<?php echo md5(NEWREGISTRATION);?>" />
                    <input type="hidden" name="user_ip" id="user_ip_id" value="<?php echo $_SERVER['REMOTE_ADDR']?>" />
                    <input type="hidden" name="is_manager" id="is_manager_id" value="<?php if(isset($_POST['is_manager']) && $_POST['is_manager'] == "1") { echo "1";} else {echo "0";}?>" />
                    <div class="register-top-grid">
                        <h3>PERSONAL INFORMATION</h3>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>First Name<label>*</label></span>
                            <input type="text" name="user_fname" id="user_fname_id" value="<?php if(isset($_POST['user_fname'])){echo $_POST['user_fname'];}else{echo $userInfoArr['user_fname'];}?>" onkeydown="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" onkeyup="chkblnkTxtError('user_fname_id', 'user_fname_errorid');" />
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Last Name<label>*</label></span>
                            <input type="text" name="user_lname" id="user_lname_id" value="<?php if(isset($_POST['user_lname'])){echo $_POST['user_lname'];}else{echo $userInfoArr['user_lname'];}?>" onkeydown="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" onkeyup="chkblnkTxtError('user_lname_id', 'user_lname_errorid');" />
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Email Address<label>*</label></span>
                            <input type="text" name="user_email" id="user_email_id" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];}else{echo $userInfoArr['user_email'];}?>" />
                        </div>
                        <div class="clearfix"> </div>
                        <a class="news-letter" href="#">
                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
                        </a>
                    </div>
                    <div class="register-bottom-grid">
                        <h3>LOGIN INFORMATION</h3>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Password<label>*</label></span>
                            <input type="password" name="user_pass" id="user_pass_id" value="<?php echo $_POST['user_pass']; ?>" />
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Confirm Password<label>*</label></span>
                            <input type="password" name="user_confirmpass" id="user_confirmpass_id" value="" />
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                    <div style="border-top:thin #999999 solid; padding-top: 10px;">
                        <table align="center" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td class="col-md-3" align="right" valign="middle">Type this<label>*</label></td>
                                <td align="left" valign="middle"><img src="../captchacode/securityimage.php?width=120&height=40&characters=5" alt="Word Scramble" class="RegFormScrambleImg" id="image_scode" name="image_scode" /></td>
                                <td align="left" valign="middle"> into this box</td>
                                <td align="left" valign="middle"><input name="image_vcode" id="image_vcode" type="text" value="" maxlength="5" autocomplete="off" /></td>
                                <td align="left" valign="middle"><div class="error" id="showErrorImgVCode"><?php if(array_key_exists('image_vcode', $form_array)) echo $form_array['image_vcode'];?></div></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left" colspan="4"><a href="void(0);" onclick="document.image_scode.src='../captchacode/securityimage.php?width=120&height=40&characters=5&'+Math.random();return false">Refresh this image</a></td>
                            </tr>
                        </table>
                        <p class="text-center">By clicking <strong>Register</strong> you are agreeing to the <a href="javascript:popcontact('terms.html')" class="blue">terms and conditions</a></p>
                        <hr>
                        <div class="text-center">
                            <ul class="list-unstyled list-inline text-center">
                                <li><a href="javascript:void(0);" onclick="return cancelRegistration();" class="btn btn-default"> Cancel </a></li>
                                <li><a href="javascript:void(0);" onclick="return validatefrm();" class="btn btn-success"> Register </a></li>
                            </ul>
                            
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    </form>
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
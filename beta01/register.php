<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}
	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.UserSetting.php");
	require_once(SITE_CLASSES_PATH."class.Location.php");
	require_once(SITE_CLASSES_PATH."class.Email.php");

	$usersObj 		= new Users();
	$userSettingObj	= new UserSetting();
	$locationObj 	= new Location();
	
	if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){ // login then redirect to its home page
		redirectURL($_SESSION['ses_user_home']);
	} else {
		$user_id = "";
	}

	// Form submission
	$form_array = array();
	$errorMsg 	= 'no';
	
	if($_POST['securityKey']==md5("NEWREGISTRATION")) {
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
		} else {
			if(preg_match(EMAIL_ID_REG_EXP_PATTERN, $_POST['user_email'])) {
				// Check if email already exist
				if($usersObj->fun_checkEmailAddress($_POST['user_email']) === true) {
					$form_array['user_email_error'] = 'Email address already exists <a href="'.SITE_URL.'login" style="font-size:11px; color:#357bdc; text-decoration:none;">Sign in</a>';
					$errorMsg = 'yes';
				}
			} else {
				$form_array['user_email_error'] = 'Please enter a valid email address';
				$errorMsg = 'yes';
			}
		}

		if((trim($_POST['user_pass']) == '') || (strlen($_POST['user_pass']) < 6)) {
			$form_array['user_pass_error'] = 'Minimum of 6 character password required';
			$errorMsg = 'yes';
		}

		if((trim($_POST['user_confirmpass']) == '') || (trim($_POST['user_confirmpass']) != trim($_POST['user_pass']))){
			$form_array['user_confirmpass_error'] = 'Please confirm your password';
			$errorMsg = 'yes';
		}

		if(($_SESSION['security_code'] == $_POST['image_vcode']) && ($errorMsg == 'no') && ($errorMsg != 'yes')){		
			// register as owner
			$user_email 	= trim($_POST['user_email']);
			$user_pass		= trim($_POST['user_pass']);
			$user_fname 	= trim($_POST['user_fname']);
			$user_lname 	= trim($_POST['user_lname']);
			$user_dob 		= "";
			$user_country 	= "";
			$user_state 	= "";
			$user_city 		= "";
			$user_address1 	= "";
			$user_address2 	= "";
			$user_zip 		= "";
			$user_ip 		= trim($_POST['user_ip']);
			$is_manager 	= trim($_POST['is_manager']);
			$user_id 		= $usersObj->fun_registerUser($user_email, $user_pass, $user_fname, $user_lname, $user_email, $user_dob, $user_country, $user_state, $user_city, $user_address1, $user_address2, $user_zip, $user_ip, $is_manager);
			if($user_id != "") {
				$_SESSION['registraton_id'] 	= $user_id;
				$_SESSION['registraton_pass'] 	= $user_pass;
				if($usersObj->sendActivationEmailToUser($user_id)) {
					redirectURL("register2.php");
				}
			} else {
				redirectURL("register.php");
			}
		} else {
			$form_array['error_msg'] = "Codes must match!";
		}
	}
//echo "testing 123...";
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
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
        <?php require_once(SITE_INCLUDES_PATH.'header.php'); ?>
	</div>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
		<div class="main">
			<div class="container">
				<div class="register">
					<form> 
					<div class="register-top-grid">
						<h3>PERSONAL INFORMATION</h3>
						<div class="wow fadeInLeft" data-wow-delay="0.4s">
							<span>First Name<label>*</label></span>
							<input type="text"> 
						</div>
						<div class="wow fadeInRight" data-wow-delay="0.4s">
							<span>Last Name<label>*</label></span>
							<input type="text"> 
						</div>
						<div class="wow fadeInRight" data-wow-delay="0.4s">
							<span>Email Address<label>*</label></span>
							<input type="text"> 
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
							<input type="text">
						</div>
						<div class="wow fadeInRight" data-wow-delay="0.4s">
							<span>Confirm Password<label>*</label></span>
							<input type="text">
						</div>
					</div>
					</form>
					<div class="clearfix"> </div>
					<div class="register-but">
						<form>
							<input type="submit" value="submit">
							<div class="clearfix"> </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<div class="footer">
        <?php require_once(SITE_INCLUDES_PATH.'footer.php'); ?>
	</div>
	<!-- footer-section-ends -->
</body>
</html>
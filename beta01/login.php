<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}
	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.Restaurant.php");

	$usersObj 		= new Users();
	$restObj 		= new Restaurant();

	$errorMsg 		= "";
	$form_array 	= "";
	$form_array['name_error'] 		= '';
	$form_array['password_error'] 	= '';
	$referpage = SITE_URL;
	if($_POST['securityKey'] == md5("USERLOGIN")){
		if(trim($_POST['user_name']) == ''){
			$form_array['name_error'] = 'Username required';
		}
		if(trim($_POST['user_password']) == ''){
			$form_array['password_error'] = 'Password required';
		}
		if(trim($_POST['user_name']) != '' && trim($_POST['user_password']) != ''){
			$userName 		= $_POST['user_name'];
			$userPassword 	= $_POST['user_password'];
			if($usersObj->fun_verifyUsers($userName, $userPassword)){			
				$usersDets = $usersObj->fun_getUsersInfo(0, $userName);
				if($usersDets["user_status"] == "1"){
					$_SESSION['ses_user_id'] 	= $usersDets["user_id"];
					$_SESSION['ses_user_fname'] = $usersDets["user_fname"];
					$_SESSION['ses_user_email'] = $usersDets["user_email"];
					$_SESSION['ses_user_pass'] 	= $usersDets["user_pass"];
					$usersObj->fun_updateLastSignIn($usersDets["user_id"]);
					if(isset($usersDets["is_manager"]) && ($usersDets["is_manager"]=="1")){
						$_SESSION['ses_user_home'] = SITE_URL."manager-home.php";
						if(($referpage != "") || ($referpage == "index.php")){
							$referpage = $_SESSION['ses_user_home'];
						} else {
							$referpage = SITE_URL."manager-home.php";
						}
					} else {
						$_SESSION['ses_user_home'] = SITE_URL."home.php";
						if(($referpage != "") || ($referpage == "index.php")){
							$referpage = SITE_URL."home.php";
						}
					}
					//if session cart not empty, add it to user basket
					if(is_array($_SESSION['cart'])) {
						$restObj->fun_updateUserCartFromSesCart($usersDets["user_id"]);
						$referpage = SITE_URL."checkout.php";
					}
					redirectURL($referpage);
				}
			} else {
				$errorMsg = "Invalid Username or Password!";
			}
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
		<div class="container">
			<div class="login-page">
			    <div class="dreamcrub">
					<ul class="breadcrumbs">
						<li class="home">
						   <a href="index.html" title="Go to Home Page">Home</a>&nbsp;
						   <span>&gt;</span>
						</li>
						<li class="women">
						   Login
						</li>
					</ul>
					<ul class="previous">
						<li><a href="index.html">Back to Previous Page</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="account_grid">
					<div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
						<h3>NEW CUSTOMERS</h3>
						<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
						<a class="acount-btn" href="register.html">Create an Account</a>
					</div>
					<div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
						<h3>REGISTERED CUSTOMERS</h3>
						<p>If you have an account with us, please log in.</p>
						<form>
							<div>
								<span>Email Address<label>*</label></span>
								<input type="text"> 
							</div>
							<div>
								<span>Password<label>*</label></span>
								<input type="text"> 
							</div>
							<a class="forgot" href="#">Forgot Your Password?</a>
							<input type="submit" value="Login">
						</form>
					</div>	
					<div class="clearfix"> </div>
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
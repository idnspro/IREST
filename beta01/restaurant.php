<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}


	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.Restaurant.php");
	require_once(SITE_CLASSES_PATH."class.Location.php");
	require_once(SITE_CLASSES_PATH."class.Banner.php");

	$usersObj 		= new Users();
	$restObj 		= new Restaurant();
	$locationObj 	= new Location();
	$bannerObj      = new Banner();

	if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
		$user_id 			= $_SESSION['ses_user_id'];
		$userInfoArr 		= $usersObj->fun_getUsersInfo($user_id);
		$users_first_name 	= $userInfoArr['user_fname'];
		$users_last_name 	= $userInfoArr['user_lname'];
		$users_email_id 	= $userInfoArr['user_email'];
		$user_full_name 	= ucwords($users_first_name." ".$users_last_name);
		$country_id 		= $userInfoArr['user_country'];
	}

	$userCurrencyArr		= $usersObj->fun_getUserCurrencyInfo($user_id);
	$users_currency_id		= $userCurrencyArr['currency_id'];
	$users_currency_code 	= $userCurrencyArr['currency_code'];
	$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
	$users_currency_rate 	= $userCurrencyArr['currency_rate'];
	$users_currency_name 	= $userCurrencyArr['currency_name'];

	if(isset($_GET['fr_url']) && $_GET['fr_url'] !="") {
		$fr_url		= $_GET['fr_url'];
		$fr_url		= str_replace("_", ",", $fr_url);
		$rest_id	= $restObj->fun_getRestaurantIdByFriendlyURL($fr_url);
	}  else if(isset($_GET['rest_id']) && $_GET['rest_id'] !="") {
		$rest_id	= $_GET['rest_id'];
	} else {
		redirectURL(SITE_URL."restaurants.php");
	}


	if(isset($rest_id) && $rest_id !=""){
		$restInfo					= $restObj->fun_getRestaurantInfo($rest_id);
		//print_r($restInfo);
		if(count($restInfo) > 0) {
			$rest_name				= $restInfo['rest_name'];
			$rest_title 			= $restInfo['rest_title'];
			$rest_short_desc 		= $restInfo['rest_short_desc'];
			$page_discription 		= $restInfo['page_discription'];
			$rest_logo 				= RESTAURANT_IMAGES_LOGO_PATH.$restInfo['rest_logo'];
			$rest_photo 			= RESTAURANT_IMAGES_LARGE_PATH.$restInfo['rest_photo'];
			$rest_country_id 		= $restInfo['rest_country_id'];
			$rest_state_id 			= $restInfo['rest_state_id'];
			$rest_city_id 			= $restInfo['rest_city_id'];
			$rest_address1 			= $restInfo['rest_address1'];
			$rest_address2 			= $restInfo['rest_address2'];
			$rest_zip 				= $restInfo['rest_zip'];
			$rest_latitude 			= $restInfo['rest_latitude'];
			$rest_longitude 		= $restInfo['rest_longitude'];
			$rest_map_zoom_level 	= $restInfo['rest_map_zoom_level'];
			$created_on				= date('F j, Y', $restInfo['created_on']);
			$updated_on				= date('F j, Y', $restInfo['updated_on']);
			$restConf 				= $restObj->fun_getRestaurantConf($rest_id);
			if(isset($restConf['book_table']) && $restConf['book_table'] =="1") {
				$book_table_active 	= true;
			} else {
				$book_table_active 	= false;
			}

			// Location info
			$restLocInfoArr 		= $restObj->fun_getRestaurantLocInfoArr($rest_id);
			$propLoc = "";
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
			
			// Restaurant address
			$rest_address 			= $rest_address1. ", " .$rest_address2. ", " .ucwords($restLocInfoArr['city_name']). ", " .ucwords($restLocInfoArr['state_name']). ", " .$rest_zip;

			// Restaurant currency info
			$currencyArr			= $restObj->fun_getRestaurantCurrencyInfo($rest_id);
			$rest_currency_id		= $currencyArr['currency_id'];
			$rest_currency_code 	= $currencyArr['currency_code'];
			$rest_currency_symbol 	= $currencyArr['currency_symbol'];
			$rest_currency_rate 	= $currencyArr['currency_rate'];
			$rest_currency_name 	= $currencyArr['currency_name'];
			$currency_symbol		= ($users_currency_symbol == "")?$rest_currency_symbol:$users_currency_symbol;
			$currency_code			= ($users_currency_code == "")?$rest_currency_code:$users_currency_code;

			//Restaurant review : start here
			$reviewArr 		= $restObj->fun_getRestaurantReviewsArr4RestaurantPreview($rest_id, "2");
			if(is_array($reviewArr) && count($reviewArr) > 0) {
				$total_reviews 	= count($reviewArr);
			} else {
				$total_reviews 	= "0";
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
    <!-- header-section-starts -->
	<div class="header">
        <?php require_once(SITE_INCLUDES_PATH.'header.php'); ?>
	</div>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="Popular-Restaurants-content">
		<?php require_once(SITE_INCLUDES_PATH.'restaurant-view.php'); ?>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<div class="footer">
        <?php require_once(SITE_INCLUDES_PATH.'footer.php'); ?>
	</div>
	<!-- footer-section-ends -->
</body>
</html>
<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}

	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.Restaurant.php");
	require_once(SITE_CLASSES_PATH."class.Pagination.php");
	require_once(SITE_CLASSES_PATH."class.Location.php");
	require_once(SITE_CLASSES_PATH."class.Banner.php");

	$usersObj 		= new Users();
	$restObj 		= new Restaurant();
	$locationObj 	= new Location();
	$bannerObj      = new Banner();

	if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id'] !=""){
		$user_id 			= $_SESSION['ses_user_id'];
	}

	$userCurrencyArr		= $usersObj->fun_getUserCurrencyInfo($user_id);
	$users_currency_id		= $userCurrencyArr['currency_id'];
	$users_currency_code 	= $userCurrencyArr['currency_code'];
	$users_currency_symbol 	= $userCurrencyArr['currency_symbol'];
	$users_currency_rate 	= $userCurrencyArr['currency_rate'];
	$users_currency_name 	= $userCurrencyArr['currency_name'];

	/*
	* Restaurant Search form submmision : Start here
	*/
	$page	 = form_int("page",1)+0;
	$sortby  = form_int("sortby",0,0,7);
	$sortdir = form_int("sortdir",0,0,1);
	if (form_isset("reverse")) {
		$sortdir = 1-$sortdir;
	}
	
	switch($sortdir) {
		case 0 : $orderDir = "ASC"; break;
		case 1 : $orderDir = "DESC"; break;
	}

	switch($sortby) {
		case 0: //Most Popular
			$sortbyidsArr 	= $restObj->fun_getRestIdsByVisitSort("DESC");
			if(is_array($sortbyidsArr) && count($sortbyidsArr) > 0) {
				$sortbyids 		= implode("','", array_unique($sortbyidsArr));
				$sortField  	= "Field(A.rest_id, '".$sortbyids."') ";
				$orderDir 		= "";
			} else {
				$sortField  = "A.updated_on";
				$orderDir = "DESC";
			}
		break;
		case 1: //Newest
			$sortField  = "A.updated_on";
			$orderDir = "DESC";
		break;
		case 2: //Top Rated (most review)
			$sortbyidsArr 	= $restObj->fun_getRestIdsByReviewsSort("DESC");
			if(is_array($sortbyidsArr) && count($sortbyidsArr) > 0) {
				$sortbyids 		= implode("','", array_reverse(array_unique($sortbyidsArr)));
				$sortField  	= "Field(A.rest_id, '".$sortbyids."') ";
				$orderDir 		= "DESC";
	
				//$sortField  = "C.property_rating";
				//$orderDir = "DESC";
			} else {
				$sortField  = "A.updated_on";
				$orderDir = "DESC";
			}
		break;
		case 3: //Min Order
			$sortbyidsArr 	= $restObj->fun_getRestIdsByMinOrderSort("ASC");
			if(is_array($sortbyidsArr) && count($sortbyidsArr) > 0) {
				$sortbyids 		= implode("','", array_reverse(array_unique($sortbyidsArr)));
				$sortField  	= "Field(A.rest_id, '".$sortbyids."') ";
				$orderDir 		= "";
			} else {
				$sortField  = "A.updated_on";
				$orderDir = "DESC";
			}
		break;
		default: //Most Popular
			$sortbyidsArr 	= $restObj->fun_getRestIdsByVisitSort("DESC");
			if(is_array($sortbyidsArr) && count($sortbyidsArr) > 0) {
				$sortbyids 		= implode("','", array_unique($sortbyidsArr));
				$sortField  	= "Field(A.rest_id, '".$sortbyids."') ";
				$orderDir 		= "";
			} else {
				$sortField  = "A.updated_on";
				$orderDir = "DESC";
			}
		break;
	}

	$_COOKIE['cook_country_id']= '';
	$_COOKIE['cook_state_id']= '';
	$_COOKIE['cook_city_id']= '';
	$_COOKIE['cook_address']= '';
	$_COOKIE['cook_zip']= '';

	/*
	$_SESSION['sess_country_id']= '';
	$_SESSION['sess_state_id']= '';
	$_SESSION['sess_city_id']= '';
	$_SESSION['sess_address']= '';
	$_SESSION['sess_zip']= '';
	*/	
	//print_r($_REQUEST);
	$seo_friendly 		= SITE_URL."restaurants"; // for seo friendly urls
	if(isset($_REQUEST['destinations']) && $_REQUEST['destinations'] != "") { $destinations = form_text("destinations"); $destinations = stripslashes($destinations); }
	if(isset($destinations) && $destinations !="") {
		$seo_friendly 		.= "/".$destinations;
		$destinations		= str_replace("_", "/", str_replace("-", " ", $destinations));
		//rest_country_id 	rest_state_id 	rest_city_id
		$destinationArr 	= $locationObj->fun_getDestinationInfo($destinations);
		if(isset($destinationArr['country_id']) && $destinationArr['country_id'] != "" && $destinationArr['country_id'] != "0") { $country_id = $destinationArr['country_id']; $country_id = stripslashes($country_id);}
		if(isset($destinationArr['state_id']) && $destinationArr['state_id'] != "" && $destinationArr['state_id'] != "0") { $state_id = $destinationArr['state_id']; $state_id = stripslashes($state_id);}
		if(isset($destinationArr['city_id']) && $destinationArr['city_id'] != "" && $destinationArr['city_id'] != "0") { $city_id = $destinationArr['city_id']; $city_id = stripslashes($city_id);}

		if(isset($country_id) && $country_id != "") { $_COOKIE['cook_country_id']= $country_id;}
		if(isset($state_id) && $state_id != "") { $_COOKIE['cook_state_id']= $state_id;}
		if(isset($city_id) && $city_id != "") { $_COOKIE['cook_city_id']= $city_id;}

		/*
		if(isset($country_id) && $country_id != "") { $_COOKIE['cook_country_id']= $country_id; $search_query .= "&country_id=" . html_escapeURL($country_id); }
		if(isset($state_id) && $state_id != "") { $_COOKIE['cook_state_id']= $state_id; $search_query .= "&state_id=" . html_escapeURL($state_id); }
		if(isset($city_id) && $city_id != "") { $_COOKIE['cook_city_id']= $city_id; $search_query .= "&city_id=" . html_escapeURL($city_id); }
		*/
	} else if(isset($_POST['txtLocSearch']) && $_POST['txtLocSearch'] != "") {
		$destinations = form_text("txtLocSearch");
		$destinations = stripslashes($destinations);
		$destinations = str_replace("/", "_", str_replace(" ", "-", strtolower($destinations)));
		redirectURL(SITE_URL."restaurants/".$destinations);
	} else {
		if(isset($_REQUEST['country_id']) && $_REQUEST['country_id'] != "" && $_REQUEST['country_id'] != "0") { $country_id = form_text("country_id"); $country_id = stripslashes($country_id);}
		if(isset($_REQUEST['state_id']) && $_REQUEST['state_id'] != "" && $_REQUEST['state_id'] != "0") { $state_id = form_text("state_id"); $state_id = stripslashes($state_id);}
		if(isset($_REQUEST['city_id']) && $_REQUEST['city_id'] != "" && $_REQUEST['city_id'] != "0") { $city_id = form_text("city_id"); $city_id = stripslashes($city_id);}

		if(isset($country_id) && $country_id != "") { $_COOKIE['cook_country_id']= $country_id; $search_query .= "&country_id=" . html_escapeURL($country_id); }
		if(isset($state_id) && $state_id != "") { $_COOKIE['cook_state_id']= $state_id; $search_query .= "&state_id=" . html_escapeURL($state_id); }
		if(isset($city_id) && $city_id != "") { $_COOKIE['cook_city_id']= $city_id; $search_query .= "&city_id=" . html_escapeURL($city_id); }
	}

	if(isset($_REQUEST['book_table']) && $_REQUEST['book_table'] != "") { $book_table = form_text("book_table"); $book_table = stripslashes($book_table); }
	if(isset($_REQUEST['dtype']) && $_REQUEST['dtype'] != "") { $dtype = form_text("dtype"); $dtype = stripslashes($dtype); }
	if(isset($_REQUEST['address']) && $_REQUEST['address'] != "") { $address = form_text("address"); $address = stripslashes($address); }
	if(isset($_REQUEST['zip']) && $_REQUEST['zip'] != "") { $zip = form_text("zip"); $zip = stripslashes($zip); }
	if(isset($_REQUEST['distanceids']) && $_REQUEST['distanceids'] != "") { $distanceids = $_REQUEST['distanceids']; }
	if(isset($_REQUEST['dtypeids']) && $_REQUEST['dtypeids'] != "") { $dtypeids = form_text("dtypeids"); $dtypeids = stripslashes($dtypeids); }
	if(isset($_REQUEST['cuisinesids']) && $_REQUEST['cuisinesids'] != "") { $cuisinesids = $_REQUEST['cuisinesids']; }
	if(isset($_REQUEST['featureids']) && $_REQUEST['featureids'] != "") { $featureids = $_REQUEST['featureids']; }
	if(isset($_REQUEST['priceids']) && $_REQUEST['priceids'] != "") { $priceids = $_REQUEST['priceids']; }
	if(isset($_REQUEST['paymethodids']) && $_REQUEST['paymethodids'] != "") { $paymethodids = $_REQUEST['paymethodids']; }
	if(isset($_REQUEST['schedule']) && $_REQUEST['schedule'] != "") { $schedule = form_text("schedule"); $schedule = stripslashes($schedule); }

	if(isset($book_table) && $book_table != "") { $_COOKIE['cook_book_table']= $book_table; $search_query .= "&book_table=" . html_escapeURL($book_table); }
	//if(isset($dtype) && $dtype != "") { $_COOKIE['cook_dtype']= $dtype; $search_query .= "&dtype=" . html_escapeURL($dtype); }
	if(isset($dtype) && $dtype != "") { $_COOKIE['cook_dtype']= $dtype;}
	if(isset($address) && $address != "") { $_COOKIE['cook_address']= $address; $search_query .= "&address=" . html_escapeURL($address); }
	if(isset($zip) && $zip != "") { $_COOKIE['cook_zip']= $zip; $search_query .= "&zip=" . html_escapeURL($zip); }
	if(isset($dtypeids) && $dtypeids != "") { $_COOKIE['cook_dtypeids']= $dtypeids; $search_query .= "&dtypeids=" . html_escapeURL($dtypeids); $dtypeidsArr = explode("-", $dtypeids);}
	if(isset($distanceids) && $distanceids != "" && isset($zip) && $zip != "") { $_COOKIE['cook_distanceids']= $distanceids; $search_query .= "&distanceids=" . html_escapeURL($distanceids); }
	if(isset($cuisinesids) && $cuisinesids != "") { $_COOKIE['cook_cuisinesids']= $cuisinesids; $search_query .= "&cuisinesids=" . html_escapeURL($cuisinesids); }
	if(isset($featureids) && $featureids != "") { $_COOKIE['cook_featureids']= $featureids; $search_query .= "&featureids=" . html_escapeURL($featureids); }
	if(isset($priceids) && $priceids != "") { $_COOKIE['cook_priceids']= $priceids; $search_query .= "&priceids=" . html_escapeURL($priceids); }
	if(isset($paymethodids) && $paymethodids != "") { $_COOKIE['cook_paymethodids']= $paymethodids; $search_query .= "&paymethodids=" . html_escapeURL($paymethodids); }
	//if(isset($schedule) && $schedule != "") { $_COOKIE['cook_schedule']= $schedule; $search_query .= "&schedule=" . html_escapeURL($schedule); }

	if(isset($_COOKIE['cook_records_per_page']) && $_COOKIE['cook_records_per_page'] != "") {
		$records_per_page = $_COOKIE['cook_records_per_page'];
	} else {
		$records_per_page = GLOBAL_RECORDS_PER_PAGE;
	}

	$strQueryParameter		= " ORDER BY " . $sortField . " " . $orderDir. " LIMIT ".(int)(($page-1)*(int)$records_per_page).", ".$records_per_page;
	$strQueryCountParameter	= " ORDER BY " . $sortField . " " . $orderDir;

	$rsQuery				= $restObj->fun_getRestaurantSearchArr($country_id, $state_id, $city_id, $zip, $address, $book_table, $dtypeids, $distanceids, $cuisinesids, $featureids, $priceids, $paymethodids, $schedule, $strQueryParameter);
	$rsQueryCount			= $restObj->fun_getRestaurantSearchArr($country_id, $state_id, $city_id, $zip, $address, $book_table, $dtypeids, $distanceids, $cuisinesids, $featureids, $priceids, $paymethodids, $schedule, $strQueryCountParameter);

	$sort_query   = "sortby=" . html_escapeURL($sortby) ."&sortdir=" . html_escapeURL($sortdir);

	if($dbObj->getRecordCount($rsQueryCount) > 0) {
		$restListArr 		= $dbObj->fetchAssoc($rsQuery);
		$total_restaurants 	= $dbObj->getRecordCount($rsQueryCount);
		// Determine the pagination
		$return_query 		= $search_query."&".$sort_query."&page=$page";
		$pag 				= new Pagination($rsQueryCount, $search_query."&".$sort_query, $records_per_page, $seo_friendly);
		$pag->current_page 	= $page;
		$pagination  		= $pag->Process();
	} else {
		$total_restaurants 			= 0;
		$shwnoresults = "yes";
	}

	//print_r($restListArr);
	/*
	* Restaurant Search form submmision : End here
	*/
//print_r($_REQUEST);

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
        <?php require_once(SITE_INCLUDES_PATH.'search-filter.php'); ?>
	</div>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="Popular-Restaurants-content">
        <?php require_once(SITE_INCLUDES_PATH.'search.php'); ?>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<div class="footer">
        <?php require_once(SITE_INCLUDES_PATH.'footer.php'); ?>
	</div>
	<!-- footer-section-ends -->
</body>
</html>
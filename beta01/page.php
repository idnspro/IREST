<?php
	if($_SERVER["SERVER_NAME"] == "localhost") {
		require_once($_SERVER["DOCUMENT_ROOT"]."/irest/beta01/includes/application-top.php");
	} else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/projects/wdelivered2/beta01/includes/application-top.php");
	}
	require_once(SITE_CLASSES_PATH."class.Users.php");
	require_once(SITE_CLASSES_PATH."class.CMS.php");

	$usersObj 		= new Users();
	$cmsObj         = new Cms();
	// Page details
	$page_nofound  	= true;
	$page_name  	= $_GET['name'];
	$page_name		= str_replace("/", "_", str_replace("-", " ", $page_name));
	$pageInfo 		= $cmsObj->fun_getPageInfoByName($page_name);

	if(is_array($pageInfo) && !empty($pageInfo)) {
		$page_id 				= $pageInfo['page_id'];
		$pageInfo 				= $cmsObj->fun_getPageInfo($page_id);
		$page_title 			= fun_db_output($pageInfo['page_title']);
		$page_content_title 	= fun_db_output($pageInfo['page_content_title']);
		$page_discription 		= fun_db_output($pageInfo['page_discription']);
		$seo_title 				= ($pageInfo['page_seo_title']!="")?$pageInfo['page_seo_title']:$seo_title;
		$seo_keywords 			= ($pageInfo['page_seo_keyword']!="")?$pageInfo['page_seo_keyword']:$seo_keywords;
		$seo_description 		= ($pageInfo['page_seo_discription']!="")?$pageInfo['page_seo_discription']:$seo_description;
		$page_nofound  		= false;
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
	<div class="content contact-section-page">
		<div class="contact-head">
		    <div class="container">
				<h3><?php echo $page_content_title;?></h3>
				<p>Home/<?php echo $page_content_title;?></p>
			</div>
		</div>
		<div class="contact_top">
			<div class="container">
				<div class="col-md-8 contact_left wow fadeInRight" data-wow-delay="0.4s">
					<?php echo $page_discription;?>
				</div>
				<div class="col-md-4 company-right wow fadeInLeft" data-wow-delay="0.4s">
				<h4>Advertisement</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-section-starts -->
	<div class="footer">
        <?php require_once(SITE_INCLUDES_PATH.'footer.php'); ?>
	</div>
	<!-- footer-section-ends -->
</body>
</html>
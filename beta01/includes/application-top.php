<?php
session_start();
ini_set( 'display_errors', 'Off' );

// General Variable
define( 'SITE_NAME', 'yourdomain.com' ); // Site Name 
define( 'SITE_URL', 'http://localhost/irest/beta01/' ); // Site URL
define( 'SITE_SECURE_URL', 'http://localhost/irest/beta01/' ); // Secure Site URL
define( 'SITE_ADMIN_URL', 'http://localhost/irest/siteadmin/' ); // Site Admin URL
define( 'SITE_DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/irest/beta01/' ); // Site DOC ROOT

define( 'SITE_INCLUDES_PATH', SITE_DOC_ROOT . 'includes/' );
define( 'SITE_ADMIN_INCLUDES_PATH', $_SERVER['DOCUMENT_ROOT'] . '/irest/siteadmin/includes/' );
define( 'SITE_CLASSES_PATH', SITE_ADMIN_INCLUDES_PATH . 'classes/' );
define( 'SITE_JS_INCLUDES_PATH', SITE_URL . 'js/' );
define( 'SITE_CSS_INCLUDES_PATH', SITE_URL . 'css/' );
define( 'SITE_ADMIN_JS_INCLUDES_PATH', SITE_ADMIN_URL . 'includes/js/' );
define( 'SITE_ADMIN_CSS_PATH', SITE_ADMIN_URL . 'css/' );

// Upload Path Variable
define( 'SITE_UPLOAD_DIR', SITE_DOC_ROOT . 'upload/' );
define( 'RESTAURANT_IMAGES', SITE_UPLOAD_DIR . 'restaurant_images/' );
define( 'MENU_IMAGES', SITE_UPLOAD_DIR . 'menu_images/' );
define( 'RESTAURANT_IMAGES_LOGO', RESTAURANT_IMAGES . 'logo/' );
define( 'RESTAURANT_IMAGES_BG', RESTAURANT_IMAGES . 'background/' );
define( 'RESTAURANT_IMAGES_LARGE', RESTAURANT_IMAGES . 'large/' );
define( 'RESTAURANT_IMAGES_THUMB', RESTAURANT_IMAGES . 'thumbnail/' );
define( 'RESTAURANT_IMAGES_LARGE600x270', RESTAURANT_IMAGES . 'large/600x270/' );
define( 'RESTAURANT_IMAGES_LARGE480x360', RESTAURANT_IMAGES . 'large/480x360/' );
define( 'RESTAURANT_IMAGES_THUMB168x126', RESTAURANT_IMAGES . 'thumbnail/168x126/' );
define( 'SITE_DOWNLOAD_DIR', SITE_DOC_ROOT . 'download/' );
define( 'SITE_DOWNLOAD_PDF_DIR', SITE_DOWNLOAD_DIR . 'pdf/' );
define( 'SITE_EMAIL_TAMPLATE', SITE_DOC_ROOT . 'emails/' );

// Absolute Path Variable
define( 'SITE_UPLOAD_PATH', SITE_URL . 'upload/' );
define( 'SITE_IMAGES', SITE_URL . 'images/' );
define( 'SITE_ADMIN_IMAGES', SITE_ADMIN_URL . 'images/' );
define( 'RESTAURANT_IMAGES_PATH', SITE_UPLOAD_PATH . 'restaurant_images/' );
define( 'MENU_IMAGES_PATH', SITE_UPLOAD_PATH . 'menu_images/' );
define( 'RESTAURANT_IMAGES_LOGO_PATH', RESTAURANT_IMAGES_PATH . 'logo/' );
define( 'RESTAURANT_IMAGES_BG_PATH', RESTAURANT_IMAGES_PATH . 'background/' );
define( 'RESTAURANT_IMAGES_LARGE_PATH', RESTAURANT_IMAGES_PATH . 'large/' );
define( 'RESTAURANT_IMAGES_THUMB_PATH', RESTAURANT_IMAGES_PATH . 'thumbnail/' );
define( 'RESTAURANT_IMAGES_LARGE600x270_PATH', RESTAURANT_IMAGES_LARGE_PATH . '600x270/' );
define( 'RESTAURANT_IMAGES_LARGE480x360_PATH', RESTAURANT_IMAGES_LARGE_PATH . '480x360/' );
define( 'RESTAURANT_IMAGES_THUMB168x126_PATH', RESTAURANT_IMAGES_THUMB_PATH . '168x126/' );
define( 'SITE_DOWNLOAD_PATH', SITE_URL . 'download/' );
define( 'SITE_DOWNLOAD_PDF_PATH', SITE_DOWNLOAD_PATH . 'pdf/' );

define( 'SITE_ADMIN_EMAIL', 'admin@domain.com' );
define( 'SITE_INFO_EMAIL', 'info@domain.com' );

define( 'DEFAULT_CURRENCY', '4' );
define( 'GLOBAL_RECORDS_PER_PAGE', 10 );
define( 'EMAIL_ID_REG_EXP_PATTERN', '/^[^\W][a-zA-Z0-9\_\-\.]+(\.[a-zA-Z0-9\_\-\.]+)*\@[a-zA-Z0-9\_\-]+(\.[a-zA-Z0-9\_\-]+)*\.[a-zA-Z]{2,4}$/' );
if( file_exists( SITE_INCLUDES_PATH . '/lang/en.php' ) ) {
	require_once( SITE_INCLUDES_PATH . '/lang/en.php' );
	foreach( $lang as $k => $v ) {
		define( $k, $v );		
	}
}

//require_once( $_SERVER['DOCUMENT_ROOT'] . '/irest/siteadmin/includes/common.php' );
//require_once( $_SERVER['DOCUMENT_ROOT'] . '/siteadmin/includes/common.php' );
require_once( SITE_ADMIN_INCLUDES_PATH . 'database-table.php' );
require_once( SITE_CLASSES_PATH . 'class.DB.php' );
require_once( SITE_CLASSES_PATH . 'class.System.php' );
require_once( SITE_CLASSES_PATH . 'class.Currency.php' );
require_once( SITE_CLASSES_PATH . 'class.Seo.php' );
require_once( SITE_ADMIN_INCLUDES_PATH . 'functions/general.php' );
require_once( SITE_ADMIN_INCLUDES_PATH . 'functions/form.php' );
require_once( SITE_ADMIN_INCLUDES_PATH . 'functions/html.php' );

if ( true === checkMobile() ) {
	$str_url = $_SERVER['REQUEST_URI'];
	if ( ( false === strpos( $str_url, '/mobile/' ) ) && ( empty( $_SESSION['os_mobile'] ) || ( '1' != $_SESSION['os_mobile'] ) ) ) {
		$_SESSION['os_mobile'] = '1';
		redirectURL( SITE_URL . 'mobile/index.php' );
	}
}
if ( ! empty( $_SESSION['lang_code'] ) ) {
	$lang_code = $_SESSION['lang_code'];
	$lang_name = $_SESSION['lang_name'];
	$lang_file = $lang_code . '.php';
	require_once( SITE_INCLUDES_PATH . 'lang/' . $lang_file );
	define( 'SITELANG', $lang_code );
} else {
	$lang_code = 'en';
	$lang_name = 'English (US)';
	$lang_file = $lang_code . '.php';
	require_once( SITE_INCLUDES_PATH . 'lang/' . $lang_file );
	define( 'SITELANG', $lang_code );
}

//Security: Don't delete following line
//if ( ! is_file( '/home/food247/public_html/includes/head.php' ) ) { die(); }


$dbObj = new DB();
$dbObj->fun_db_connect();

// System variables
$systemObj 		 = new System();
$siteInfoArr 	 = $systemObj->fun_getSiteVariableValue();
$twitterlink 	 = ( ! empty( $siteInfoArr[1] ) ) ? $siteInfoArr[1] : 'http://www.twitter.com';
$facebooklink 	 = ( ! empty( $siteInfoArr[2] ) ) ? $siteInfoArr[2] : 'http://www.facebook.com';
$youtubelink 	 = ( ! empty( $siteInfoArr[3] ) ) ? $siteInfoArr[3] : 'http://www.youtube.com';
$linkedinlink 	 = ( ! empty( $siteInfoArr[4] ) ) ? $siteInfoArr[4] : 'http://www.linkedin.com';
$paypalid 		 = ( ! empty( $siteInfoArr[5] ) ) ? $siteInfoArr[5] : 'paypal@domain.com';
$adminemail 	 = ( ! empty( $siteInfoArr[6] ) ) ? $siteInfoArr[6] : 'admin@domain.com';
$sitetitle 		 = ( ! empty( $siteInfoArr[7] ) ) ? $siteInfoArr[7] : $_SERVER['SERVER_NAME'];
$sitedescription = ( ! empty( $siteInfoArr[8] ) ) ? $siteInfoArr[8] : $_SERVER['SERVER_NAME'];
$sitekeywords 	 = ( ! empty( $siteInfoArr[9] ) ) ? $siteInfoArr[9] : $_SERVER['SERVER_NAME'];

//Currency rate
$currencyObj	 = new Currency();
$currencyRateArr = $currencyObj->fun_findCurrencyRate();
$ipcountry 		 = getIPCountry();
//$ipcountry 	 = 'IND';

// SEO variables
$seoObj          = new Seo();
$seoArr 		 = $seoObj->fun_getSeoInfoByURI( $_SERVER['REQUEST_URI'] );
$seo_title 		 = ( ! empty( $seoArr['seo_title'] ) ) ? $seoArr['seo_title'] : $sitetitle;
$seo_description = ( ! empty( $seoArr['seo_description'] ) ) ? $seoArr['seo_description'] : $sitedescription;
$seo_keywords 	 = ( ! empty( $seoArr['seo_keywords'] ) ) ? $seoArr['seo_keywords'] : $sitekeywords;

//Langauge translation
$display_lang 	  = $systemObj->fun_getDisplayLang();
$display_lang_arr = $systemObj->fun_getDisplayLangArr();
?>
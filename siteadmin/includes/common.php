<?php
if($_SERVER["SERVER_NAME"] == "localhost"){
	// General Variable
	define("SITE_NAME", "yourdomain.com"); // Site Name 
	define("SITE_URL", "http://localhost/irest/"); // Site URL
	define("SITE_SECURE_URL", "http://localhost/irest/"); // Secure Site URL
	define("SITE_ADMIN_URL", SITE_URL . "siteadmin/"); // Site Admin URL
	define("SITE_DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/irest/"); // Site DOC ROOT

	define("SITE_INCLUDES_PATH", SITE_DOC_ROOT . "includes/");
	define("SITE_ADMIN_INCLUDES_PATH", SITE_DOC_ROOT . "siteadmin/includes/");
	define("SITE_CLASSES_PATH", SITE_ADMIN_INCLUDES_PATH . "classes/");
	define("SITE_JS_INCLUDES_PATH", SITE_URL . "includes/js/");
	define("SITE_CSS_INCLUDES_PATH", SITE_URL . "css/");
	define("SITE_ADMIN_JS_INCLUDES_PATH", SITE_ADMIN_URL . "includes/js/");
	define("SITE_ADMIN_CSS_PATH", SITE_ADMIN_URL . "css/");

	// Upload Path Variable
	define("SITE_UPLOAD_DIR", SITE_DOC_ROOT . "upload/");
	define("RESTAURANT_IMAGES", SITE_UPLOAD_DIR . "restaurant_images/");
	define("MENU_IMAGES", SITE_UPLOAD_DIR . "menu_images/");
	define("RESTAURANT_IMAGES_LOGO", RESTAURANT_IMAGES . "logo/");
	define("RESTAURANT_IMAGES_BG", RESTAURANT_IMAGES . "background/");
	define("RESTAURANT_IMAGES_LARGE", RESTAURANT_IMAGES . "large/");
	define("RESTAURANT_IMAGES_THUMB", RESTAURANT_IMAGES . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270", RESTAURANT_IMAGES . "large/600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360", RESTAURANT_IMAGES . "large/480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126", RESTAURANT_IMAGES . "thumbnail/168x126/");
	define("SITE_DOWNLOAD_DIR", SITE_DOC_ROOT . "download/");
	define("SITE_DOWNLOAD_PDF_DIR", SITE_DOWNLOAD_DIR . "pdf/");
	define("SITE_EMAIL_TAMPLATE", SITE_DOC_ROOT . "emails/");

	// Absolute Path Variable
	define("SITE_UPLOAD_PATH", SITE_URL . "upload/");
	define("SITE_IMAGES", SITE_URL . "images/");
	define("SITE_ADMIN_IMAGES", SITE_ADMIN_URL . "images/");
	define("RESTAURANT_IMAGES_PATH", SITE_UPLOAD_PATH . "restaurant_images/");
	define("MENU_IMAGES_PATH", SITE_UPLOAD_PATH . "menu_images/");
	define("RESTAURANT_IMAGES_LOGO_PATH", RESTAURANT_IMAGES_PATH . "logo/");
	define("RESTAURANT_IMAGES_BG_PATH", RESTAURANT_IMAGES_PATH . "background/");
	define("RESTAURANT_IMAGES_LARGE_PATH", RESTAURANT_IMAGES_PATH . "large/");
	define("RESTAURANT_IMAGES_THUMB_PATH", RESTAURANT_IMAGES_PATH . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270_PATH", RESTAURANT_IMAGES_LARGE_PATH . "600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360_PATH", RESTAURANT_IMAGES_LARGE_PATH . "480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126_PATH", RESTAURANT_IMAGES_THUMB_PATH . "168x126/");
	define("SITE_DOWNLOAD_PATH", SITE_URL . "download/");
	define("SITE_DOWNLOAD_PDF_PATH", SITE_DOWNLOAD_PATH . "pdf/");

	define("SITE_ADMIN_EMAIL", "ops@idns-technologies.info");
	define("SITE_INFO_EMAIL", "ops@idns-technologies.info");
} else if($_SERVER["SERVER_NAME"] == "www.yourdomain.com" || $_SERVER['SERVER_NAME']=="yourdomain.com"){
	// General Variable
	define("SITE_NAME", "yourdomain.com"); // Site Name 
	define("SITE_URL", "http://".$_SERVER['SERVER_NAME']."/"); // Site URL
	define("SITE_SECURE_URL", "http://".$_SERVER['SERVER_NAME']."/"); // Secure Site URL
	define("SITE_ADMIN_URL", SITE_URL . "siteadmin/"); // Site Admin URL
	define("SITE_DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); // Site DOC ROOT

	define("SITE_INCLUDES_PATH", SITE_DOC_ROOT . "includes/");
	define("SITE_ADMIN_INCLUDES_PATH", SITE_DOC_ROOT . "siteadmin/includes/");
	define("SITE_CLASSES_PATH", SITE_ADMIN_INCLUDES_PATH . "classes/");
	define("SITE_JS_INCLUDES_PATH", SITE_URL . "includes/js/");
	define("SITE_CSS_INCLUDES_PATH", SITE_URL . "css/");
	define("SITE_ADMIN_JS_INCLUDES_PATH", SITE_ADMIN_URL . "includes/js/");
	define("SITE_ADMIN_CSS_INCLUDES_PATH", SITE_ADMIN_URL . "includes/css/");

	// Upload Path Variable
	define("SITE_UPLOAD_DIR", SITE_DOC_ROOT . "upload/");
	define("RESTAURANT_IMAGES", SITE_UPLOAD_DIR . "restaurant_images/");
	define("RESTAURANT_IMAGES_LOGO", RESTAURANT_IMAGES . "logo/");
	define("RESTAURANT_IMAGES_BG", RESTAURANT_IMAGES . "background/");
	define("RESTAURANT_IMAGES_LARGE", RESTAURANT_IMAGES . "large/");
	define("RESTAURANT_IMAGES_THUMB", RESTAURANT_IMAGES . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270", RESTAURANT_IMAGES . "large/600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360", RESTAURANT_IMAGES . "large/480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126", RESTAURANT_IMAGES . "thumbnail/168x126/");
	define("SITE_DOWNLOAD_DIR", SITE_DOC_ROOT . "download/");
	define("SITE_DOWNLOAD_PDF_DIR", SITE_DOWNLOAD_DIR . "pdf/");
	define("SITE_EMAIL_TAMPLATE", SITE_DOC_ROOT . "emails/");

	// Absolute Path Variable
	define("SITE_UPLOAD_PATH", SITE_URL . "upload/");
	define("SITE_IMAGES", SITE_URL . "images/");
	define("SITE_ADMIN_IMAGES", SITE_ADMIN_URL . "images/");
	define("RESTAURANT_IMAGES_PATH", SITE_UPLOAD_PATH . "restaurant_images/");
	define("RESTAURANT_IMAGES_LOGO_PATH", RESTAURANT_IMAGES_PATH . "logo/");
	define("RESTAURANT_IMAGES_BG_PATH", RESTAURANT_IMAGES_PATH . "background/");
	define("RESTAURANT_IMAGES_LARGE_PATH", RESTAURANT_IMAGES_PATH . "large/");
	define("RESTAURANT_IMAGES_THUMB_PATH", RESTAURANT_IMAGES_PATH . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270_PATH", RESTAURANT_IMAGES_LARGE_PATH . "600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360_PATH", RESTAURANT_IMAGES_LARGE_PATH . "480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126_PATH", RESTAURANT_IMAGES_THUMB_PATH . "168x126/");
	define("SITE_DOWNLOAD_PATH", SITE_URL . "download/");
	define("SITE_DOWNLOAD_PDF_PATH", SITE_DOWNLOAD_PATH . "pdf/");

	define("SITE_ADMIN_EMAIL", "ops@idns-technologies.info");
	define("SITE_INFO_EMAIL", "ops@idns-technologies.info");

} else {
	// General Variable
	define("SITE_NAME", "yourdomain.com"); // Site Name 
	define("SITE_URL", "http://".$_SERVER['SERVER_NAME']."/projects/irest/1/"); // Site URL
	define("SITE_SECURE_URL", "https://".$_SERVER['SERVER_NAME']."/projects/irest/1/"); // Secure Site URL
	define("SITE_ADMIN_URL", SITE_URL . "siteadmin/"); // Site Admin URL
	define("SITE_DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/projects/irest/1/"); // Site DOC ROOT

	define("SITE_INCLUDES_PATH", SITE_DOC_ROOT . "includes/");
	define("SITE_ADMIN_INCLUDES_PATH", SITE_DOC_ROOT . "siteadmin/includes/");
	define("SITE_CLASSES_PATH", SITE_ADMIN_INCLUDES_PATH . "classes/");
	define("SITE_JS_INCLUDES_PATH", SITE_URL . "includes/js/");
	define("SITE_CSS_INCLUDES_PATH", SITE_URL . "css/");
	define("SITE_ADMIN_JS_INCLUDES_PATH", SITE_ADMIN_URL . "includes/js/");
	define("SITE_ADMIN_CSS_INCLUDES_PATH", SITE_ADMIN_URL . "includes/css/");

	// Upload Path Variable
	define("SITE_UPLOAD_DIR", SITE_DOC_ROOT . "upload/");
	define("RESTAURANT_IMAGES", SITE_UPLOAD_DIR . "restaurant_images/");
	define("RESTAURANT_IMAGES_LOGO", RESTAURANT_IMAGES . "logo/");
	define("RESTAURANT_IMAGES_BG", RESTAURANT_IMAGES . "background/");
	define("RESTAURANT_IMAGES_LARGE", RESTAURANT_IMAGES . "large/");
	define("RESTAURANT_IMAGES_THUMB", RESTAURANT_IMAGES . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270", RESTAURANT_IMAGES . "large/600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360", RESTAURANT_IMAGES . "large/480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126", RESTAURANT_IMAGES . "thumbnail/168x126/");
	define("SITE_DOWNLOAD_DIR", SITE_DOC_ROOT . "download/");
	define("SITE_DOWNLOAD_PDF_DIR", SITE_DOWNLOAD_DIR . "pdf/");
	define("SITE_EMAIL_TAMPLATE", SITE_DOC_ROOT . "emails/");

	// Absolute Path Variable
	define("SITE_UPLOAD_PATH", SITE_URL . "upload/");
	define("SITE_IMAGES", SITE_URL . "images/");
	define("SITE_ADMIN_IMAGES", SITE_ADMIN_URL . "images/");
	define("RESTAURANT_IMAGES_PATH", SITE_UPLOAD_PATH . "restaurant_images/");
	define("RESTAURANT_IMAGES_LOGO_PATH", RESTAURANT_IMAGES_PATH . "logo/");
	define("RESTAURANT_IMAGES_BG_PATH", RESTAURANT_IMAGES_PATH . "background/");
	define("RESTAURANT_IMAGES_LARGE_PATH", RESTAURANT_IMAGES_PATH . "large/");
	define("RESTAURANT_IMAGES_THUMB_PATH", RESTAURANT_IMAGES_PATH . "thumbnail/");
	define("RESTAURANT_IMAGES_LARGE600x270_PATH", RESTAURANT_IMAGES_LARGE_PATH . "600x270/");
	define("RESTAURANT_IMAGES_LARGE480x360_PATH", RESTAURANT_IMAGES_LARGE_PATH . "480x360/");
	define("RESTAURANT_IMAGES_THUMB168x126_PATH", RESTAURANT_IMAGES_THUMB_PATH . "168x126/");
	define("SITE_DOWNLOAD_PATH", SITE_URL . "download/");
	define("SITE_DOWNLOAD_PDF_PATH", SITE_DOWNLOAD_PATH . "pdf/");

	define("SITE_ADMIN_EMAIL", "ops@idns-technologies.info");
	define("SITE_INFO_EMAIL", "ops@idns-technologies.info");
}
define('DEFAULT_CURRENCY', '4');
define("GLOBAL_RECORDS_PER_PAGE", 10);
//define("EMAIL_ID_REG_EXP_PATTERN", "/^([a-zA-Z][a-zA-Z0-9\_\-\.]*\@[a-zA-Z0-9\-]*\.[a-zA-Z]{2,4})?$/i");
define("EMAIL_ID_REG_EXP_PATTERN", "/^[^\W][a-zA-Z0-9\_\-\.]+(\.[a-zA-Z0-9\_\-\.]+)*\@[a-zA-Z0-9\_\-]+(\.[a-zA-Z0-9\_\-]+)*\.[a-zA-Z]{2,4}$/");
?>
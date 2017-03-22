<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Banner.php");

$dbObj 		= new DB();
$bannerObj  = new Banner();
$dbObj->fun_db_connect();

$strXmlContent ="";
if(isset($_GET['banner_id']) && $_GET['banner_id'] !=""){
	$banner_id = $_GET['banner_id'];
	// Step I: Select details of image
	$bannerObj->fun_delBanner($banner_id);
	$strXmlContent .="<banner>";
	$strXmlContent .="<bannerstatus>banner deleted.</bannerstatus>\n";
	$strXmlContent .="</banner>";
} else {
	$strXmlContent .="<banner>";
	$strXmlContent .="<bannerstatus>Error.</bannerstatus>\n";
	$strXmlContent .="</banner>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><banners>';
$strXml .=$strXmlContent;
$strXml .='</banners>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>
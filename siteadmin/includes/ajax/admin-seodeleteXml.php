<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Seo.php");

$dbObj 		= new DB();
$seoObj         = new Seo();
$dbObj->fun_db_connect();

$strXmlContent ="";
if(isset($_GET['seo_id']) && $_GET['seo_id'] !=""){
	$seo_id = $_GET['seo_id'];
	// Step I: Select details of image
	$seoObj->fun_delSeo($seo_id);
	$strXmlContent .="<seo>";
	$strXmlContent .="<seostatus>seo deleted.</seostatus>\n";
	$strXmlContent .="</seo>";
} else {
	$strXmlContent .="<seo>";
	$strXmlContent .="<seostatus>Error.</seostatus>\n";
	$strXmlContent .="</seo>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><seos>';
$strXml .=$strXmlContent;
$strXml .='</seos>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>
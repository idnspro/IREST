<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Restaurant.php");

$dbObj 		= new DB();
$restObj 	= new Restaurant();
$dbObj->fun_db_connect();

$strXmlContent 	= "";
if(isset($_GET['rest_id']) && $_GET['rest_id'] !=""){
	$rest_id = $_GET['rest_id'];
	// Step I: Select details of image
	$restObj->fun_delRestaurant($rest_id);
	$strXmlContent .="<restaurant>";
	$strXmlContent .="<restaurantstatus>restaurant deleted.</restaurantstatus>\n";
	$strXmlContent .="</restaurant>";
} else {
	$strXmlContent .="<restaurant>";
	$strXmlContent .="<restaurantstatus>Error.</restaurantstatus>\n";
	$strXmlContent .="</restaurant>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><restaurants>';
$strXml .=$strXmlContent;
$strXml .='</restaurants>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>